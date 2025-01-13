<?php

namespace App\Http\Controllers;

use App\Actions\GetStaffHandledProjects;
use Exception;
use Carbon\Carbon;
use App\Models\ChartYearOf;
use App\Models\ProjectInfo;
use Illuminate\Http\Request;
use App\Models\ApplicationInfo;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\OngoingQuarterlyReport;
use App\Notifications\ProjectProposal;
use Illuminate\Support\Facades\Storage;


class StaffViewController extends Controller
{
    public function LoadDashboardTab(Request $request)
    {
        //dashboard logic here
        if ($request->ajax()) {

            return view('StaffView.StaffdashboardTab');
        } else {
            return view('StaffView.Staff_Index');
        }
    }

    public function getDashboardChartData()
{
    try {
        if(Cache::has('monthly_project_categories')) {
            $monthlyData = Cache::get('monthly_project_categories');
        }else{
            $chartData = ChartYearOf::select('monthly_project_categories')->where('year_of', '=', date('Y'))->first();
            $monthlyData = json_decode($chartData->monthly_project_categories, true);
            Cache::put('monthly_project_categories', $monthlyData, 1800);
        }

        // Return data as JSON response
        return response()->json($monthlyData, 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getHandledProjects()
    {
        try{
            $org_userId = Auth::user()->orgUserInfo->id;
            $handledProjects = GetStaffHandledProjects::execute($org_userId);
            return response()->json($handledProjects, 200);
        }catch(Exception $e){
            Log::error('Error in getHandledProjects: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong:' . $e->getMessage()], 500);
        }
    }

    public function LoadProjectsTab(Request $request)
    {
        if ($request->ajax()) {
            return view('StaffView.StaffProjectTab');
        } else {
            return view('StaffView.Staff_Index');
        }
    }

    public function LoadApplicantTab(Request $request)
    {
        if ($request->ajax()) {
            return view('StaffView.StaffApplicantTab');
        } else {
            return view('StaffView.Staff_Index');
        }
    }

    public function getApprovedProjects()
    {
        try {
            if (Cache::has('approved_projects')) {
                $approvedProjects = Cache::get('approved_projects');
            } else {
                $approvedProjects = DB::table('application_info')
                ->join('business_info', 'business_info.id', '=', 'application_info.business_id')
                ->join('coop_users_info', 'coop_users_info.id', '=', 'business_info.user_info_id')
                ->join('users', 'users.user_name', '=', 'coop_users_info.user_name')
                ->join('assets', 'assets.id', '=', 'business_info.id')
                ->join('project_info AS pi', 'pi.business_id', '=', 'business_info.id')
                ->leftJoin('org_users_info as handled_by', function ($join) {
                    $join->on('pi.handled_by_id', '=', 'handled_by.id');
                })->leftJoin('org_users_info as evaluated_by', function ($join) {
                    $join->on('pi.evaluated_by_id', '=', 'evaluated_by.id');
                })
                ->where('pi.handled_by_id', '!=', null)
                ->where('pi.evaluated_by_id', '!=', null)
                ->where('application_info.application_status', 'approved')
                ->where('users.role', 'Cooperator')
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
                        'pi.Project_id',
                        'pi.project_title',
                        'pi.fund_amount',
                        'pi.created_at as date_approved',
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
                    )
                    ->get();
                Cache::put('approved_projects', $approvedProjects, 1800);
            }

            return response()->json($approvedProjects);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getAvailableQuarterlyReport(Request $request, $ProjectID)
    {
        try {

            $OngoingQuarterlyReport = OngoingQuarterlyReport::where('ongoing_project_id', $ProjectID)
                ->whereNotNull('report_file')
                ->select('quarter')
                ->get()
                ->sortBy(function ($report) {
                    list($quarter, $year) = explode(' ', $report->quarter);
                    return sprintf('%04d%02d', $year, array_search($quarter, ['Q1', 'Q2', 'Q3', 'Q4']));
                });

            $html = '';
            foreach ($OngoingQuarterlyReport as $report) {
                $html .= '<option value="' . $report->quarter . '">' . $report->quarter . '</option>';
            }

            return response()->json(['html' => $html], 200);
        } catch (Exception $e) {
            response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
