<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\ProjectFeeService;
use App\Services\AdminDashboardService;
use App\Actions\GetAvailableChartYearList;


class AdminViewController extends Controller
{
    public function index(){
        return view('admin-view.Admin_Index');
    }
    public function LoadDashboardTab(Request $request)
    {
        if ($request->ajax()) {
            return view('admin-view.admin-page-tab.dashboardTab');
        } else {
            return view('admin-view.Admin_Index');
        }
    }

    public function LoadProjectTab(Request $request)
    {

        if ($request->ajax()) {
            return view('admin-view.admin-page-tab.projectlistTab');
        } else {
            return view('admin-view.Admin_Index');
        }
    }

    public function getDashboardChartData(AdminDashboardService $adminDashboard, $yearToLoad = null)
    {
        try {

            $staffhandledProjects = $adminDashboard->getStaffHandledProjects();
            $listOfYears = GetAvailableChartYearList::execute();

            $selectedYear = $yearToLoad ?? $listOfYears[0];

            $monthlyData = $adminDashboard->getMonthlyData($selectedYear) ?? [];
            $localData = $adminDashboard->getLocalData($selectedYear) ?? [];

            return response()->json([
                'monthlyData' => $monthlyData,
                'localData' => $localData,
                'staffhandledProjects' => $staffhandledProjects,
                'listOfYears' => $listOfYears,
                'currentSelectedYear' => $selectedYear
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    public function LoadApplicantTab(Request $request)
    {
        if ($request->ajax()) {
            return view('admin-view.admin-page-tab.applicantlistTab');
        } else {
            return view('admin-view.Admin_Index');
        }
    }

    public function LoadUsersTab(Request $request)
    {

        if ($request->ajax()) {
            return view('admin-view.admin-page-tab.usersTab');
        } else {
            return view('admin-view.Admin_Index');
        }
    }

    public function LoadProjectSettingTab(Request $request, ProjectFeeService $projectFeeService)
    {
        if ($request->ajax()) {
            $fee_percentage = $projectFeeService->getProjectFee();
            return view('admin-view.admin-page-tab.projectSettingsTab', compact('fee_percentage'));
        } else {
            return view('admin-view.Admin_Index');
        }
    }

}
