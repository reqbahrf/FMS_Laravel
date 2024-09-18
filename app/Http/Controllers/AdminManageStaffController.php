<?php

namespace App\Http\Controllers;

use App\Models\OrgUserInfo;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminManageStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{

            $staffList = User::where('role', 'Staff')
            ->join('org_users_info', 'users.user_name', '=', 'org_users_info.user_name')
            ->select([
                'users.id',
                'users.user_name',
                'users.email',
                'org_users_info.prefix',
                'org_users_info.f_name',
                'org_users_info.mid_name',
                'org_users_info.l_name',
                'org_users_info.suffix',
                'org_users_info.access_to',
            ])
            ->get();

            return response()->json($staffList);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'f_Name' => 'required',
            'l_Name' => 'required',
            'email' => 'required|unique:users|email',
            'gender' => 'required',
            'role' => 'required',
            'b_date' => 'required|date_format:Y-m-d',
        ]);
        try{

            $NewUser_username = 'DOST-SETUP' . '-' . strtok($validated['l_Name'], " ") .  Carbon::parse($validated['b_date'])->format('Y') . substr(md5(uniqid()), 0, 3);

            $NewUser_password = $validated['l_Name'] . Carbon::parse($validated['b_date'])->format('Y');

            DB::transaction(function () use($validated, $NewUser_username, $NewUser_password) {

                $user = User::create([
                    'user_name' => $NewUser_username,
                    'email' => $validated['email'],
                    'email_verified_at' => now(),
                    'password' => Hash::make($NewUser_password),
                    'role' => $validated['role'],
                ]);

                OrgUserInfo::create([
                    'user_name' => $NewUser_username,
                    'profile_pic' => '',
                    'prefix' => '',
                    'f_name' => $validated['f_Name'],
                    'mid_name' => '',
                    'l_name' => $validated['l_Name'],
                    'suffix' => '',
                    'gender' => $validated['gender'],
                    'birthdate' => $validated['b_date'],
                    'access_to' => 'Restricted',
                ]);
            });
            return response()->json(['success' => 'Staff created successfully.'], 200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
