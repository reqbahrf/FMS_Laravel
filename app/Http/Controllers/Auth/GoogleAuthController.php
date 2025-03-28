<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\User as GoogleUser;

class GoogleAuthController extends Controller
{
    public function AuthenticateWithGoogle()
    {
        $previousRequest = app('request')->create(url()->previous());

        // Match the request to a route
        $route = app('router')->getRoutes()->match($previousRequest);

        // Get the route name
        $routeName = $route->getName();

        // Store the route name in the session
        Session::put('request_from_route', $routeName);
        return Socialite::driver('google')
            ->redirect();
    }

    public function handleGoogleAuth(Request $request)
    {
        try {
            // Get the previous route name
            $previousRoute = Session::get('request_from_route');

            Log::info($previousRoute);

            $googleUser = Socialite::driver('google')->user();

            // Check if user exists with this Google account
            $existingUser = User::where('email', $googleUser->getEmail())->first();

            // Determine action based on previous route
            switch ($previousRoute) {
                case 'login':
                    // If user exists, login
                    if ($existingUser) {
                        return $this->handleGoogleLogin($existingUser, $googleUser);
                    }
                    // If no existing user on login page, redirect to login with error
                    return redirect()->route('login')->withErrors([
                        'login' => 'No account found. Please sign up first.'
                    ]);

                case 'registerpage.signup':
                    // If user already exists, redirect to login
                    if ($existingUser) {
                        return redirect()->route('registerpage.signup')->withErrors([
                            'login' => 'Account already exists. Please log in.'
                        ]);
                    }
                    // Proceed with signup
                    return $this->handleGoogleSignup($googleUser);

                default:
                    // Fallback to login logic if route is unrecognized
                    if ($existingUser) {
                        return $this->handleGoogleLogin($existingUser, $googleUser);
                    }
                    return redirect()->route('login')->withErrors([
                        'login' => 'Unable to authenticate. Please try again.'
                    ]);
            }
        } catch (Exception $e) {
            Log::error('Error in Google Authentication: ' . $e->getMessage());
            return redirect()->route('login')->withErrors([
                'login' => 'Authentication failed: ' . $e->getMessage()
            ]);
        }
    }

    protected function handleGoogleLogin(User $user, GoogleUser $googleUser)
    {
        try {
            // Validate user role
            if (!in_array($user->role, ['Admin', 'Staff', 'Cooperator'])) {
                Log::warning("User {$user->email} has an invalid role: {$user->role}");
                return redirect()->route('home')->withErrors([
                    'login' => 'Invalid user role. Please contact support.'
                ]);
            }

            // Login the user
            Auth::login($user);

            // Update provider information
            $user->avatar = $googleUser->getAvatar();
            $user->provider = 'google';
            $user->provider_id = $googleUser->getId();

            if (!$user->save()) {
                Log::error("Failed to save user provider information for {$user->email}");
                return redirect()->route('login')->withErrors([
                    'login' => 'Unable to update user profile. Please try again.'
                ]);
            }

            // Log the login event
            Log::info("User {$user->email} logged in via Google");

            // Redirect based on user role
            return match ($user->role) {
                'Admin' => redirect()->route('Admin.index'),
                'Staff' => redirect()->route('Staff.index'),
                'Cooperator' => $this->CoopIntentedRoute($user),
                default => redirect()->route('home')
            };
        } catch (Exception $e) {
            Log::error("Google login error for user {$user->email}: " . $e->getMessage());
            return redirect()->route('login')->withErrors([
                'login' => 'An unexpected error occurred. Please try again.'
            ]);
        }
    }

    protected function handleGoogleSignup(GoogleUser $googleUser)
    {
        try {
            // Check if email already exists (optional, depends on your requirements)
            $existingEmailUser = User::where('email', $googleUser->getEmail())
                ->where('provider', '!=', 'google')
                ->first();

            if ($existingEmailUser) {
                return redirect()->route('login')->withErrors([
                    'email' => 'An account with this email already exists. Please log in directly.'
                ]);
            }

            $username = $this->generateUniqueUsername($googleUser->user['given_name']);

            // Create new user
            $newUser = User::create([
                'email' => $googleUser->getEmail(),
                'user_name' => $username,
                'email_verified_at' => now(),
                'avatar' => $googleUser->getAvatar(),
                'provider' => 'google',
                'provider_id' => $googleUser->getId(),
                'role' => 'Cooperator', // Default role
                'password' => Hash::make(Str::random(16)) // Random password for social users
            ]);

            // Optional: Additional setup for new users
            // For example, creating a profile or sending a welcome email

            Auth::login($newUser);
            return $this->CoopIntentedRoute($newUser);
        } catch (Exception $e) {
            Log::error("Google signup error: " . $e->getMessage());
            return redirect()->route('registerpage.signup')->withErrors([
                'error' => 'An unexpected error occurred. Please try again.'
            ]);
        }
    }

    protected function generateUniqueUsername(string $name)
    {
        // Generate a unique username based on name
        $baseUsername = '@' . Str::slug(strtolower($name));
        $username = $baseUsername;
        $counter = 1;

        while (User::where('user_name', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        return $username;
    }

    protected function CoopIntentedRoute(User $user)
    {
        try {
            return is_null($user->coopUserInfo) ? redirect()->route('application.form') : redirect()->route('Cooperator.index');
        } catch (Exception $e) {
            Log::error("Failed to get intended route for user {$user->email}: " . $e->getMessage());
            return redirect()->route('home');
        }
    }
}
