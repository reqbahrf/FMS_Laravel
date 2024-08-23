<?php

namespace App\Http\Controllers;

use App\Models\OrgUserInfo;
use App\Models\coopUserInfo;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        Log::info('Signup method called');

        $request->validate([
            'userName' => 'required|unique:users,user_name',
            'email' => 'required|email|unique:users,email',
            'password1' => 'required',
            'confirm1' => 'required|same:password1',
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
        } catch (\Exception $e) {
            // Log the exception message for debugging
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
            'username' => 'required',
            'password' => 'required',
            'B_date' => 'required|date',
            'remember' => 'in:on,off',
        ]);

        $credentials = ['user_name' => $request->username, 'password' => $request->password];
        $bDate = new DateTime($request->B_date);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $user = Auth::user();

            session(['user_id' => $user->id]);
            session(['user_name' => $user->user_name]);
            session(['role' => $user->role]);

            switch ($user->role) {
                case 'Cooperator':
                    $coop_userInfo = coopUserInfo::where('user_name', $user->user_name)->first();

                    if ($coop_userInfo && $coop_userInfo->birth_date->format('Y-m-d') === $bDate->format('Y-m-d')) {
                        return response()->json(['success' => 'Login successful, user is a Cooperator with matching B_date.', 'redirect' => route('Cooperator.home')]);
                    } else if (is_null($coop_userInfo)) {
                        return response()->json(['no_record' => 'User is a Cooperator match but does not have Application info.', 'redirect' => route('registrationForm')]);
                    }
                    break;
                case 'Staff':
                case 'Admin':
                    $orgUserInfo = OrgUserInfo::where('user_name', $user->user_name)->first();

                    if ($orgUserInfo && $orgUserInfo->birthdate->format('Y-m-d') === $bDate->format('Y-m-d')) {
                        session(['name' => $orgUserInfo->full_name]);
                        session(['org_userId' => $orgUserInfo->id]);
                        session(['birth_date' => $orgUserInfo->birthdate->format('Y-m-d')]);
                        return response()->json(['success' => 'Login successful, user is a '. $user->role .' with matching B_date.', 'redirect' => route($user->role . '.home')], 200);
                    } else {
                        return response()->json(['error' => 'Invalid credentials.'], 401);
                    }
                break;
            }
        }

        return response()->json(['error' => 'Invalid credentials.'], 401);
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

        if($timeDiffence > 1800) {
            return redirect()->route('home')->with('error', 'Verification link expired.');
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('home')->with('success', 'Email verified successfully.');
    }
}
