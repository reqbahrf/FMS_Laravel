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
            $existingUser = User::updateOrCreate(
                [
                    'email' => $googleUser->getEmail()
                ],[
                    'provider' => 'google',
                    'provider_id' => $googleUser->getId()
                ]);

            // Determine action based on previous route
            switch ($previousRoute) {
                case 'login':
                    // If user exists, login
                    if ($existingUser) {
                        return $this->handleGoogleLogin($existingUser);
                    }
                    // If no existing user on login page, redirect to login with error
                    return redirect()->route('login')->withErrors([
                        'login' => 'No account found. Please sign up first.'
                    ]);

                case 'registerpage.signup':
                    // If user already exists, redirect to login
                    if ($existingUser) {
                        return redirect()->route('login')->withErrors([
                            'login' => 'Account already exists. Please log in.'
                        ]);
                    }
                    // Proceed with signup
                    return $this->handleGoogleSignup($googleUser);

                default:
                    // Fallback to login logic if route is unrecognized
                    if ($existingUser) {
                        return $this->handleGoogleLogin($existingUser);
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

    protected function handleGoogleLogin(User $user)
    {
        // Specific login logic
        Auth::login($user);
        
        // Redirect based on user role
        return match($user->role) {
            'Admin' => redirect()->route('Admin.index'),
            'Staff' => redirect()->route('Staff.index'),
            'Cooperator' => is_null($user->coop_user_info) ? redirect()->route('registrationForm') : redirect()->route('Cooperator.index'),
            default => redirect()->route('home')
        };
    }

    protected function handleGoogleSignup(GoogleUser $googleUser)
    {
        // Check if email already exists (optional, depends on your requirements)
        $existingEmailUser = User::where('email', $googleUser->getEmail())
            ->where('provider', '!=', 'google')
            ->first();
        
        if ($existingEmailUser) {
            return redirect()->route('login')->withErrors([
                'email' => 'An account with this email already exists. Please log in directly.'
            ]);
        }

        // Create new user
        $newUser = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'user_name' => $this->generateUniqueUsername($googleUser->getName()),
            'avatar' => $googleUser->getAvatar(),
            'provider' => 'google',
            'provider_id' => $googleUser->getId(),
            'role' => 'Cooperator', // Default role
            'password' => Hash::make(Str::random(16)) // Random password for social users
        ]);

        // Optional: Additional setup for new users
        // For example, creating a profile or sending a welcome email
        
        Auth::login($newUser);
        return redirect()->route('Cooperator.index');
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

}
