<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordChangeController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = User::find(Auth::user()->id);

            // Check if current password matches
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
            }

            // Update password
            $user->password = Hash::make($request->new_password);
            $user->must_change_password = false;
            $user->save();

            return redirect()->route(Auth::user()->role . '.index')->with('success', 'Password changed successfully');
        } catch (Exception $e) {
            Log::error("Failed to change password for user:", [
                'user' => $user->id,
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->withErrors(['error' => 'Something went wrong. Please try again']);
        }
    }
}
