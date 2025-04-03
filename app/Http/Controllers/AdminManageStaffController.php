<?php

namespace App\Http\Controllers;

use App\Actions\GenerateUniqueUsernameAction;
use App\Mail\NewStaffRegistered;
use App\Models\OrgUserInfo;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminManageStaffController extends Controller
{

    public function __construct(
        private GenerateUniqueUsernameAction $generateUniqueUsernameAction
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $staffList = User::where('role', 'Staff')
                ->join('org_users_info', 'users.user_name', '=', 'org_users_info.user_name')
                ->select([
                    'users.id',
                    'users.user_name',
                    'users.email',
                    'users.avatar',
                    'org_users_info.id as staff_id',
                    'org_users_info.prefix',
                    'org_users_info.f_name',
                    'org_users_info.mid_name',
                    'org_users_info.l_name',
                    'org_users_info.suffix',
                    'org_users_info.access_to',
                ])
                ->get();

            return response()->json($staffList);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'prefix' => 'nullable',
            'f_Name' => 'required',
            'mid_Name' => 'nullable',
            'l_Name' => 'required',
            'suffix' => 'nullable',
            'email' => 'required|unique:users|email',
            'sex' => 'required',
            'role' => 'required',
            'b_date' => 'required|date_format:Y-m-d',
        ]);
        try {
            $user = (object) null;
            $orgUserInfo = (object) null;

            $username = $this->generateUniqueUsernameAction->execute($validated['f_Name']);
            $initial_password = $validated['l_Name'] . str_replace('-', '', $validated['b_date']);

            DB::transaction(function () use (&$user, &$orgUserInfo, $validated, $username,  $initial_password) {

                $user = User::create([
                    'user_name' => $username,
                    'email' => $validated['email'],
                    'email_verified_at' => now(),
                    'password' => Hash::make($initial_password),
                    'role' => $validated['role'],
                    'must_change_password' => true,
                ]);

                $orgUserInfo = OrgUserInfo::create([
                    'user_name' => $username,
                    'prefix' => $validated['prefix'],
                    'f_name' => $validated['f_Name'],
                    'mid_name' => $validated['mid_Name'],
                    'l_name' => $validated['l_Name'],
                    'suffix' => $validated['suffix'],
                    'sex' => $validated['sex'],
                    'birthdate' => $validated['b_date'],
                    'access_to' => 'Restricted',

                ]);
            }, 3);

            DB::afterCommit(function () use ($user, $orgUserInfo) {
                Mail::to($user->email)->send(new NewStaffRegistered($user, $orgUserInfo));
            });


            return response()->json(['success' => 'Staff created successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $user_name)
    {
        $validated = $request->validate([
            'access_to' => 'required|string|in:Restricted,Allowed', // Adjust validation rules as needed
        ]);

        try {
            OrgUserInfo::where('user_name', $user_name)->update([
                'access_to' => $validated['access_to'],
            ]);
            return response()->json(['success' => 'Staff updated successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $user_name)
    {
        try {
            User::where('user_name', $user_name)->delete();
            return response()->json(['success' => 'Staff deleted successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
