<?php

namespace App\Http\Controllers;

use App\Models\ApplicationInfo;
use App\Models\ProjectInfo;
use App\Models\BusinessInfo;
use App\Models\ChartCache;
use App\Models\OrgUserInfo;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;


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

    public function getDashboardChartData(Request $request)
    {
        try {
            $chartData = ChartCache::select('mouthly_project_categories', 'project_local_categories')->where('year_of', '=', date('Y'))->get();

            $monthlyData = $chartData->pluck('mouthly_project_categories');
            $localData = $chartData->pluck('project_local_categories');
            $staffhandledProjects = $this->getStaffHandledProjects();

            return response()->json([
                'monthlyData' => $monthlyData,
                'localData' => $localData,
                'staffhandledProjects' => $staffhandledProjects
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    private function getStaffHandledProjects()
    {
        try {

            return OrgUserInfo::whereHas('user', function ($query) {
                $query->where('role', 'Staff');
            })
                ->with(['handledProjects.businessInfo'])
                ->get()
                ->map(function ($staff) {

                    $enterpriseCount = [
                        'Micro Enterprise' => 0,
                        'Small Enterprise' => 0,
                        'Medium Enterprise' => 0,
                    ];

                    $groupedEnterpriseLevels = $staff->handledProjects->groupBy('businessInfo.enterprise_level')
                        ->map(function ($projects) {
                            return $projects->count();
                        });

                    foreach ($groupedEnterpriseLevels as $level => $count) {
                        if (array_key_exists($level, $enterpriseCount)) {
                            $enterpriseCount[$level] = $count;
                        }
                    }

                    return (object) [
                        'Staff_Name' => $staff->prefix . ' ' . $staff->f_name . ' ' . $staff->mid_name . ' ' . $staff->l_name . ' ' . $staff->suffix,
                        'Micro Enterprise' => $enterpriseCount['Micro Enterprise'],
                        'Small Enterprise' => $enterpriseCount['Small Enterprise'],
                        'Medium Enterprise' => $enterpriseCount['Medium Enterprise'],
                    ];
                });

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }


    public function pendingProjectGet(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function applicantTabGet(Request $request)
    {
        if ($request->ajax()) {
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
            return view('AdminView.AdminApplicantlistTab', compact('applicants'));
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

    public function projectProposalGet(Request $request)
    {

        $validated = $request->validate([
            'business_id' => 'required|integer',
        ]);

        $projectProposal = BusinessInfo::select([
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

        try {

            DB::beginTransaction();

            $project = ProjectInfo::where('Project_id', $validated['project_id'])
                ->where('business_id', $validated['business_id'])
                ->firstOrFail();

            $project->handled_by_id = $validated['assigned_staff_id'];
            $project->save();

            $application = ApplicationInfo::where('business_id', $validated['business_id'])
                ->firstOrFail();
            $application->application_status = 'approved';
            $application->save();

            DB::commit();

            return response()->json([
                'message' => 'Project proposal approved successfully.',
                'status' => 'success',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'error',
            ], 500);
        }
    }

    public function getOngoingProjects()
    {
        try {
            if(Cache::has('ongoing_projects')) {
                $ongoingProjects = Cache::get('ongoing_projects');
            } else {
                $ongoingProjects = DB::table('users')
                ->join('coop_users_info', 'coop_users_info.user_name', '=', 'users.user_name')
                ->join('business_info', 'business_info.user_info_id', '=', 'coop_users_info.id')
                ->join('assets', 'assets.id', '=', 'business_info.id')
                ->join('project_info as PI', 'PI.business_id', '=', 'business_info.id')
                ->join('application_info', 'application_info.business_id', '=', 'business_info.id')
                ->leftJoin('org_users_info as handled_by', function ($join) {
                    $join->on('PI.handled_by_id', '=', 'handled_by.id');
                })->leftJoin('org_users_info as evaluated_by', function ($join) {
                    $join->on('PI.evaluated_by_id', '=', 'evaluated_by.id');
                })
                ->where('application_info.application_status', 'ongoing')
                ->where('users.role', 'Cooperator')
                ->whereNotNull('PI.handled_by_id')
                ->whereNotNull('PI.evaluated_by_id')
                ->select(
                    'users.user_name',
                    'users.email',
                    'users.role',
                    'coop_users_info.f_name',
                    'coop_users_info.l_name',
                    'coop_users_info.designation',
                    'coop_users_info.mobile_number',
                    'coop_users_info.landline',
                    'business_info.id as business_id',
                    'business_info.firm_name',
                    'business_info.landmark',
                    'business_info.barangay',
                    'business_info.city',
                    'business_info.province',
                    'business_info.region',
                    'business_info.enterprise_type',
                    'business_info.enterprise_level',
                    'assets.building_value',
                    'assets.equipment_value',
                    'assets.working_capital',
                    'PI.Project_id',
                    'PI.project_title',
                    'PI.fund_amount',
                    'PI.actual_amount_to_be_refund as to_be_refunded',
                    'PI.refunded_amount as amount_refunded',
                    'PI.created_at as date_approved',
                    'evaluated_by.prefix as evaluated_by_prefix',
                    'evaluated_by.f_name as evaluated_by_f_name',
                    'evaluated_by.mid_name as evaluated_by_mid_name',
                    'evaluated_by.l_name as evaluated_by_l_name',
                    'evaluated_by.suffix as evaluated_by_suffix',
                    'handled_by.prefix as handled_by_prefix',
                    'handled_by.f_name as handled_by_f_name',
                    'handled_by.mid_name as handled_by_mid_name',
                    'handled_by.l_name as handled_by_l_name',
                    'handled_by.suffix as handled_by_suffix',
                    'handled_by.user_name as staffUserName',
                    'application_info.created_at as date_applied',
                    'application_info.application_status'
                )->get();

            Cache::put('ongoing_projects', $ongoingProjects, 1800);
        }
        return response()->json($ongoingProjects);

        }catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        };
    }
}
