<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use App\Models\OrgUserInfo;
use App\Models\CoopUserInfo;
use Illuminate\Http\Request;
use App\Services\AuditService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $auditService;

    public function __construct(AuditService $auditService)
    {
        $this->auditService = $auditService;
    }
    public function signup(Request $request)
    {
        Log::info('Signup method called');

        $request->validate([
            'username' => 'required|unique:users,user_name|max:30',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:32',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                'confirmed'
            ],
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.confirmed' => 'Password confirmation does not match.'
        ]);

        try {
            $user = User::create([
                'user_name' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'Cooperator'
            ]);

            $this->auditService->createAuditLog(
                'user_signup',
                null,
                ['user_name' => $user->user_name, 'email' => $user->email, 'role' => $user->role],
                [],
                $request
            );

            Auth::login($user);
            return response()->json([
                'success' => true,
                'message' => 'Account created successfully. Please verify your email.',
                'redirect' => route('verification.notice')
            ]);
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
            'remember' => 'in:on,off',
        ]);

        try {

            $credentials = [
                $this->username() => $request->login,
                'password' => $request->password
            ];

            if (Auth::attempt($credentials, $request->has('remember'))) {
                $user = Auth::user();

                session(['user_id' => $user->id]);
                session(['user_name' => $user->user_name]);
                session(['role' => $user->role]);

                switch ($user->role) {
                    case 'Cooperator':
                        $coopUserInfo = $user->coopUserInfo->businessInfo;
                        if ($coopUserInfo->isEmpty()) {
                            return response()->json(['no_record' => 'no record found', 'redirect' => URL::signedRoute('application.form', ['id' => $user->id])]);
                        }
                        return response()->json(['success' => 'Login successfully', 'redirect' => route('Cooperator.index')]);
                        break;
                    case 'Staff':
                    case 'Admin':
                        $orgUserInfo = OrgUserInfo::where('user_name', $user->user_name)->first();

                        if ($orgUserInfo) {
                            $this->userLoginAudit();
                            return response()->json(['success' => 'Login successfully', 'redirect' => route($user->role . '.index')], 200);
                        }
                        break;
                }
            }
            return response()->json(['error' => 'Invalid credentials'], 401);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    protected function username()
    {
        $input = request()->input('login');

        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            return 'email';
        }
        return 'user_name';
    }

    protected function userLoginAudit(?object $user = null): void
    {
        $this->auditService->createAuditLog(
            'Login',
            null,
            ['last_login' => now()],
            [],
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
