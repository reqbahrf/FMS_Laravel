<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\ChartYearOf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\OngoingQuarterlyReport;
use App\Actions\GetStaffHandledProjects;
use App\Actions\GetAvailableChartYearList;



class StaffViewController extends Controller
{

    public function index()
    {
        return view('staff-view.staff-index');
    }
    public function LoadDashboardTab(Request $request)
    {
        //dashboard logic here
        if ($request->ajax()) {

            return view('staff-view.staff-page-tab.dashboard-tab');
        } else {
            return view('staff-view.staff-index');
        }
    }

    public function getDashboardChartData($yearToLoad = null)
    {
        try {
            $listOfYears = GetAvailableChartYearList::execute();
            $selectedYear = $yearToLoad ?? ($listOfYears->isEmpty() ? null : $listOfYears[0]);

            if (Cache::has('monthly_project_categories' . $selectedYear)) {
                $monthlyData = Cache::get('monthly_project_categories' . $selectedYear);
            } else {
                $chartData = ChartYearOf::select('monthly_project_categories')->where('year_of', '=',  $selectedYear)->first();
                $monthlyData = json_decode($chartData?->monthly_project_categories, true) ?? [];
                Cache::put('monthly_project_categories' . $selectedYear, $monthlyData, 1800);
            }

            // Return data as JSON response
            return response()->json([
                'monthlyData' => $monthlyData,
                'listOfYears' => $listOfYears,
                'currentSelectedYear' => $selectedYear
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getHandledProjects()
    {
        try {
            $org_userId = Auth::user()->orgUserInfo->id;
            $handledProjects = GetStaffHandledProjects::execute($org_userId);
            return response()->json($handledProjects, 200);
        } catch (Exception $e) {
            Log::error('Error in getHandledProjects: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong:' . $e->getMessage()], 500);
        }
    }

    public function LoadProjectsTab(Request $request)
    {
        if ($request->ajax()) {
            return view('staff-view.staff-page-tab.project-tab');
        } else {
            return view('staff-view.staff-index');
        }
    }

    public function LoadApplicantTab(Request $request)
    {
        if ($request->ajax()) {
            return view('staff-view.staff-page-tab.applicant-tab');
        } else {
            return view('staff-view.staff-index');
        }
    }

    public function getAvailableQuarterlyReport(Request $request, $ProjectID)
    {
        try {

            $OngoingQuarterlyReport = OngoingQuarterlyReport::where('ongoing_project_id', $ProjectID)
                ->whereNotNull('report_file')
                ->get()
                ->sortBy(function ($report) {
                    list($quarter, $year) = explode(' ', $report->quarter);
                    return sprintf('%04d%02d', $year, array_search($quarter, ['Q1', 'Q2', 'Q3', 'Q4']));
                });

            Log::info($OngoingQuarterlyReport);

            $html = '';
            foreach ($OngoingQuarterlyReport as $report) {
                $preview_pds_url = URL::signedRoute('staff.Project.get.data-sheet', ['projectId' => $report->ongoing_project_id, 'quarter' => $report->quarter]);
                $html .= '<option data-form-url="' . $report->url . '" data-preview-pds-url="' . $preview_pds_url . '" value="' . $report->quarter . '">' . $report->quarter . '</option>';
            }

            return response()->json(['html' => $html], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
