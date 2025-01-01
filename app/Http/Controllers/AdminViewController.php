<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;

use App\Models\ChartYearOf;
use App\Models\OrgUserInfo;
use App\Services\AdminDashboardService;
use App\Services\ProjectFeeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Concurrency;

class AdminViewController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return view('AdminView.AdminDashboardTab');
        } else {
            return view('AdminView.Admin_Index');
        }
    }

    public function projectTabGet(Request $request) 
    {

        if ($request->ajax()) {
            return view('AdminView.AdminProjectlistTab');
        } else {
            return view('AdminView.Admin_Index');
        }
    }

    public function getDashboardChartData(AdminDashboardService $adminDashboard, $yearToLoad = null)
    {
        try {

            $staffhandledProjects = $adminDashboard->getStaffHandledProjects();
            $listOfYears = $adminDashboard->getListOfYears();

            $monthlyData = $adminDashboard->getMonthlyData($yearToLoad);
            $localData = $adminDashboard->getLocalData($yearToLoad);

            return response()->json([
                'monthlyData' => $monthlyData,
                'localData' => $localData,
                'staffhandledProjects' => $staffhandledProjects,
                'listOfYears' => $listOfYears
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }



    public function pendingProjectGet(Request $request)
    {
        try {
            if(Cache::has('pendingProjects')) {
                $pendingProjects = Cache::get('pendingProjects');
            }else {
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

                Cache::put('pendingProjects', $pendingProjects, 1800);
            }

            if ($pendingProjects->isEmpty()) {
                return response()->json(['error' => 'No data found.'], 404);
            } else {
                return response()->json($pendingProjects);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function applicantTabGet(Request $request)
    {
        if ($request->ajax()) {
            return view('AdminView.AdminApplicantlistTab');
        } else {
            return view('AdminView.Admin_Index');
        }
    }

    public function userGet(Request $request)
    {

        if ($request->ajax()) {
            return view('AdminView.AdminUsersTab');
        } else {
            return view('AdminView.Admin_Index');
        }
    }

    public function ProjectSettingView(Request $request, ProjectFeeService $projectFeeService)
    {
        if ($request->ajax()) {
            $fee_percentage = $projectFeeService->getProjectFee();
            return view('AdminView.AdminProjectSettingsTab', compact('fee_percentage'));
        } else {
            return view('AdminView.Admin_Index');
        }
    }

    public function staffGet(Request $request)
    {
        try {
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

            if ($stafflist) {
                return response()->json($stafflist);
            } else {
                return response()->json(['error' => 'No Registered Staff'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        };
    }
}
