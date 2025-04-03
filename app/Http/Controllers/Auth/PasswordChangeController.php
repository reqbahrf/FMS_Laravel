<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Http\Controllers\Controller;
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
                'new_password' => [
                    'required',
                    'string',
                    'min:8',
                    'max:32',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                    'confirmed'
                ],
            ], [
                'new_password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
                'new_password.min' => 'Password must be at least 8 characters long.',
                'new_password.confirmed' => 'Password confirmation does not match.'
            ]);

            if ($validator->fails()) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'errors' => $validator->errors()
                    ], 422);
                }
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = User::find(Auth::user()->id);

            // Check if current password matches
            if (!Hash::check($request->current_password, $user->password)) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'errors' => ['current_password' => 'Current password is incorrect']
                    ], 422);
                }
                return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
            }

            // Update password
            $user->password = Hash::make($request->new_password);
            $user->must_change_password = false;
            $user->save();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Password changed successfully'
                ]);
            }

            return redirect()->route(Auth::user()->role . '.index')->with('success', 'Password changed successfully');
        } catch (Exception $e) {
            Log::error("Failed to change password for user:", [
                'user' => $user->id ?? 'Unknown',
                'error' => $e->getMessage()
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => ['error' => 'Something went wrong. Please try again']
                ], 500);
            }

            return redirect()->back()->withErrors(['error' => 'Something went wrong. Please try again']);
        }
    }
}
