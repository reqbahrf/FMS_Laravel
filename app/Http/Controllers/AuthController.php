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
            'userName1' => 'required|unique:users,user_name',
            'email' => 'required|email|unique:users,email',
            'password1' => 'required',
            'confirm1' => 'required|same:password1',
        ]);

            $user = new User();
            $user->user_name = $request->userName1;
            $user->email = $request->email;
            $user->password = Hash::make($request->password1);

            $user->save();

            session(['user_id' => $user->id]);
            session(['user_name' => $user->user_name]);
            session(['email' => $user->email]);

            if ($user->save()) {
                // try{
                // }
                // catch(\Exception $e){
                //     return response()->json(['error' => $e], 422);
                // }

                return response()->json(['success' => 'Account created successfully. Please verify your email.', 'redirect' => route('verification.notice')]);
            }else
            {
                return response()->json(['error' => 'Account creation failed.'], 422);
            }



    }

    public function login(Request $request)
    {
        Log::info('Login method called');

        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'B_date' => 'required|date',
        ]);

        $credentials = ['user_name' => $request->username, 'password' => $request->password];
        $bDate = new DateTime($request->B_date);

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user();

            session(['user_id' => $user->id]);
            session(['user_name' => $user->user_name]);
            session(['role' => $user->role]);

            if ($user->role === 'Cooperator') {
                $coop_userInfo = coopUserInfo::where('user_name', $user->user_name)->first();



                if ($coop_userInfo && $coop_userInfo->birth_date->format('Y-m-d') === $bDate->format('Y-m-d')) {
                    session(['birth_date' => $coop_userInfo->birth_date->format('Y-m-d')]);
                    // The user is a Cooperator, has a record in personnel_info, and B_date matches.
                    // Proceed with your logic here, e.g., redirecting the user or returning a success response.
                    return response()->json(['success' => 'Login successful, user is a Cooperator with matching B_date.', 'redirect' => route('Cooperator.home')]);
                } else {
                    log::info($coop_userInfo->birth_date);
                    // Handle the case where the user is a Cooperator but doesn't have matching personnel_info or B_date.
                    return response()->json(['error' => 'User is a Cooperator but B_date does not match or missing personnel info.'], 422);
                }
            }

            if ($user->role === 'Staff') {
                $orgUserInfo = OrgUserInfo::where('user_name', $user->user_name)->first();

                session(['name' => $orgUserInfo->full_name]);

                if ($orgUserInfo && $orgUserInfo->birthdate->format('Y-m-d') === $bDate->format('Y-m-d')) {
                    session(['birth_date' => $orgUserInfo->birthdate->format('Y-m-d')]);
                    return response()->json(['message' => 'Login successful, user is a Staff with matching B_date.']);
                } else {
                    return response()->json(['error' => 'User is a Staff but B_date does not match or missing org info.'], 422);
                }
            }

            if ($user->role === 'Admin') {
                $orgUserInfo = OrgUserInfo::where('user_name', $user->user_name)->first();

                session(['name' => $orgUserInfo->full_name]);

                if ($orgUserInfo && $orgUserInfo->birthdate->format('Y-m-d') === $bDate->format('Y-m-d')) {
                    return response()->json(['message' => 'Login successful, user is an Admin with matching B_date.']);
                } else {
                    return response()->json(['error' => 'User is an Admin but B_date does not match or missing org info.'], 422);
                }
            } else {
                // Handle logic for users with roles other than Cooperator.
                return response()->json(['message' => 'Login successful, user is not a Cooperator.']);
            }
        }

        // Handle failed authentication.
        return response()->json(['error' => 'Authentication failed.'], 401);
    }

    public function verifyEmail($id, $hash)
    {
        $user = User::find($id);

        if (!$user || sha1($user->email) !== $hash) {
            return redirect()->route('home')->with('error', 'Invalid verification link.');
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('home')->with('success', 'Email verified successfully.');
    }
}
