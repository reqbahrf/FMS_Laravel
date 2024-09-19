<?php

namespace App\Http\Controllers;

use App\Models\applicationInfo;
use App\Models\projectInfo;
use App\Models\businessInfo;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class AdminViewController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            return view('AdminView.adminDashboardTab');
        }else
        {
            return view('AdminView.adminDashboard');
        }

    }

    public function projectTabGet(Request $request){

        if($request->ajax())
        {
           return view('AdminView.adminProjectlistTab');

        }
        else
        {
            return view('AdminView.adminDashboard');

        }

    }


    public function pendingProjectGet(Request $request)
    {
        try
        {
        $pendingProjects = DB::table('business_info')
            ->select([
                'business_info.id',
                'business_info.firm_name',
                'business_info.enterprise_type',
                'business_info.enterprise_level',
                'business_info.zip_code',
                'business_info.landMark',
                'business_info.barangay',
                'business_info.city',
                'business_info.province',
                'business_info.region',
                'assets.building_value',
                'assets.equipment_value',
                'assets.working_capital',
                'application_info.application_status',
                'project_info.Project_id',
                'project_info.project_title',
                'project_info.evaluated_by_id',
                'project_info.fund_amount',
                'project_info.created_at as date_proposed',
                'org_users_info.prefix',
                'org_users_info.f_name',
                'org_users_info.mid_name',
                'org_users_info.l_name',
                'org_users_info.suffix',
                'coop_users_info.f_name',
                'coop_users_info.mid_name',
                'coop_users_info.l_name',
                'coop_users_info.suffix',
                'coop_users_info.designation',
                'coop_users_info.mobile_number',
                'coop_users_info.landline',
                'users.email'
            ])
                ->join('project_info', 'project_info.business_id', '=', 'business_info.id')
                ->join('assets', 'assets.id', '=', 'business_info.id')
                ->join('application_info', 'application_info.business_id', '=', 'business_info.id')
                ->join('org_users_info', 'project_info.evaluated_by_id', '=', 'org_users_info.id')
                ->join('coop_users_info', 'business_info.user_info_id', '=', 'coop_users_info.id')
                ->join('users', 'users.user_name', '=', 'coop_users_info.user_name')
                ->where('application_info.application_status', 'pending')
                ->whereNotNull('project_info.business_id')
            ->get();

            if ($pendingProjects->isEmpty()) {
                return response()->json(['error' => 'No data found.'], 404);
            } else {
                return response()->json($pendingProjects);
            }
        }catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function applicantTabGet(Request $request)
    {
        if($request->ajax())
        {
            $applicants = DB::table('users')
                ->select([
                    'users.id as user_id',
                    'users.email',
                    'coop_users_info.prefix',
                    'coop_users_info.f_name',
                    'coop_users_info.mid_name',
                    'coop_users_info.l_name',
                    'coop_users_info.suffix',
                    'coop_users_info.designation',
                    'coop_users_info.mobile_number',
                    'coop_users_info.landline',
                    'business_info.firm_name',
                    'business_info.enterprise_type',
                    'business_info.landMark',
                    'business_info.barangay',
                    'business_info.city',
                    'business_info.province',
                    'business_info.region',
                    'assets.building_value',
                    'assets.equipment_value',
                    'assets.working_capital',
                    'application_info.created_at as date_applied',
                    'business_info.id'
                ])
                ->join('coop_users_info', 'users.user_name', '=', 'coop_users_info.user_name')
                ->join('business_info', 'business_info.user_info_id', '=', 'coop_users_info.id')
                ->join('assets', 'assets.id', '=', 'business_info.id')
                ->join('application_info', 'application_info.business_id', '=', 'business_info.id')
                ->where('application_info.application_status', 'waiting')
                ->get();
            return view('AdminView.adminApplicantlistTab', compact('applicants'));
        }
        else
        {
            return view('AdminView.adminDashboard');
        }
    }

    public function userGet(Request $request){

        if($request->ajax())
        {
            return view('AdminView.adminUsersTab');
        }
        else
        {
            return view('AdminView.adminDashboard');
        }

    }

    public function staffGet(Request $request)
    {
        try{

            $stafflist = User::select([
                'users.user_name',
                'users.role',
                'org_users_info.id as staff_id',
                'org_users_info.prefix',
                'org_users_info.f_name',
                'org_users_info.mid_name',
                'org_users_info.l_name',
                'org_users_info.suffix',
            ])
            ->join('org_users_info', 'users.user_name', '=', 'org_users_info.user_name')
            ->where('users.role', '=', 'Staff')
            ->get();

            if($stafflist){
                return response()->json($stafflist);
            }else{
                return response()->json(['error' => 'No Registered Staff'], 404);
            }
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        };

    }

    public function projectProposalGet(Request $request)
    {

        $validated = $request->validate([
            'business_id' => 'required|integer',
        ]);

        $projectProposal = businessInfo::select([
            'business_info.id as business_id',
            'project_info.Project_id',
            'project_info.project_title',
            'project_info.fund_amount',
            'application_info.created_at as date_applied',
            'org_users_info.prefix',
            'org_users_info.f_name',
            'org_users_info.mid_name',
            'org_users_info.l_name',
            'org_users_info.suffix',

        ])
        ->join('project_info', 'project_info.business_id', '=', 'business_info.id')
        ->join('org_users_info', 'project_info.evaluated_by_id', '=', 'org_users_info.id')
        ->join('application_info', 'application_info.business_id', '=', 'business_info.id')
        ->where('application_info.application_status', 'pending')
        ->where('business_info.id', '=', $validated['business_id'])
        ->first();

        if ($projectProposal) {
            return response()->json($projectProposal);
        } else {
            return response()->json(['error' => 'No data found.'], 404);
        }

    }
    public function approvedProjectProposal(Request $request)
    {

        $validated = $request->validate([
            'project_id' => 'required|string',
            'business_id' => 'required|integer',
            'assigned_staff_id' => 'required|integer',
        ]);

        try{

            DB::beginTransaction();

            $project = projectInfo::where('Project_id',$validated['project_id'])
                ->where('business_id',$validated['business_id'])
                ->firstOrFail();

            $project->handled_by_id = $validated['assigned_staff_id'];
            $project->save();

            $application = applicationInfo::where ('business_id', $validated['business_id'])
                ->firstOrFail();
            $application->application_status = 'approved';
            $application->save();

            DB::commit();

            return response()->json([
                'message' => 'Project proposal approved successfully.',
                'status' => 'success',
            ], 200);

        }catch(\Exception $e){
            DB::rollBack();
            Log::error($e->getMessage());

            return response()->json([
                'message' => 'Failed to approve project proposal.',
                'status' => 'error',
            ], 500);

        }

    }
}
