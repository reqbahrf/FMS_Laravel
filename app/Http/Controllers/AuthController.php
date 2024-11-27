<?php

namespace App\Http\Controllers;

use App\Models\OrgUserInfo;
use App\Models\CoopUserInfo;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        Log::info('Signup method called');

        $request->validate([
            'userName' => 'required|unique:users,user_name|max:30',
            'email' => 'required|email|unique:users,email|max:255',
            'password1' => [
                'required',
                'string',
                'min:8',
                'max:32',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                'confirmed'
            ],
        ], [
            'password1.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'password1.min' => 'Password must be at least 8 characters long.',
            'password1.confirmed' => 'Password confirmation does not match.'
        ]);

        try {
            $user = new User();
            $user->user_name = $request->userName;
            $user->email = $request->email;
            $user->password = Hash::make($request->password1);

            if ($user->save()) {
                session(['user_id' => $user->id]);
                session(['user_name' => $user->user_name]);
                session(['email' => $user->email]);

                // Send verification email
                $user->sendEmailVerificationNotification();

                return response()->json([
                    'success' => true,
                    'message' => 'Account created successfully. Please verify your email.',
                    'redirect' => route('verification.notice')
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'error' => 'Account creation failed.'
                ], 422);
            }
        } catch (Exception $e) {
            Log::error('Signup failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'An unexpected error occurred. Please try again later.'
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
            'B_date' => 'required|date',
            'remember' => 'in:on,off',
        ]);

        try{

            $credentials = [
                $this->username() => $request->login,
                'password' => $request->password];

            $bDate = new DateTime($request->B_date);

            if (Auth::attempt($credentials, $request->has('remember'))) {
                $user = Auth::user();

                session(['user_id' => $user->id]);
                session(['user_name' => $user->user_name]);
                session(['role' => $user->role]);

                switch ($user->role) {
                    case 'Cooperator':
                        $coop_userInfo = CoopUserInfo::where('user_name', $user->user_name)->first();

                        if ($coop_userInfo && $coop_userInfo->birth_date->format('Y-m-d') === $bDate->format('Y-m-d')) {

                            return response()->json(['success' => 'Login successfully', 'redirect' => route('Cooperator.index')]);
                        } else if (is_null($coop_userInfo)) {
                            return response()->json(['no_record' => 'No Application Record found.', 'redirect' => route('registrationForm')]);
                        }
                        break;
                    case 'Staff':
                    case 'Admin':
                        $orgUserInfo = OrgUserInfo::where('user_name', $user->user_name)->first();

                        if ($orgUserInfo && $orgUserInfo->birthdate->format('Y-m-d') === $bDate->format('Y-m-d')) {
                            return response()->json(['success' => 'Login successfully', 'redirect' => route($user->role . '.index')], 200);
                        }
                        break;
                }
            }
            return response()->json(['error' => 'The provided credentials do not match our records.'], 401);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 401);
        }

    }

    protected function username()
    {
        $input = request()->input('login');

        if(filter_var($input, FILTER_VALIDATE_EMAIL)){
            return 'email';
        }
        return 'user_name';
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function verifyEmail($id, $hash, $timestamp)
    {
        $user = User::find($id);

        if (!$user || hash('sha256', $user->email) !== $hash) {
            return redirect()->route('home')->with('error', 'Invalid verification link.');
        }

        $currentTime = now()->timestamp;
        $timeDiffence = $currentTime - $timestamp;

        if ($timeDiffence > 1800) {
            return redirect()->route('home')->with('error', 'Verification link expired.');
        }

        if (!$user->email_verified_at) {
            $user->email_verified_at = now();
            $user->save();
        }

        return redirect()->route('home')->with('success', 'Email verified successfully.');
    }
}
