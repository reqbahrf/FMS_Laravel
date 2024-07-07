<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function signup(Request $request){
        Log::info('Signup method called');

        $request->validate([
            'userName1' => 'required|unique:users,user_name',
            'email' => 'required|email|unique:users,email',
            'password1' => 'required',
            'confirm1' => 'required|same:password1',
        ]);

        try {
            $user = new User();
            $user->user_name = $request->userName1;
            $user->email = $request->email;
            $user->password = Hash::make($request->password1);

            $user->save();

            session(['user_id' => $user->id]);
            session(['user_name' => $user->user_name]);

            // Auth::login($user);

            if ($request->ajax()) {
                Log::info('AJAX request handled successfully');
                return response()->json(['success' => true, 'redirect' => route('registrationForm')]);
            }

            return redirect()->route('registrationForm')->with('success', 'Account created successfully');
        } catch (\Exception $e) {
            Log::error('Signup error: ' . $e->getMessage());

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Failed to create account']);
            }

            return redirect()->route('home')->with('error', 'Failed to create account');
        }
    }
}
