<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\Settings\ProjectFeeService;
use App\Services\AdminDashboardService;
use App\Actions\GetAvailableChartYearList;
use App\Services\Settings\NotifyOnService;

class AdminViewController extends Controller
{
    public function index()
    {
        return view('admin-view.admin-index');
    }
    public function LoadDashboardTab(Request $request)
    {
        if ($request->ajax()) {
            return view('admin-view.admin-page-tab.dashboard-tab');
        } else {
            return view('admin-view.admin-index');
        }
    }

    public function LoadProjectTab(Request $request)
    {

        if ($request->ajax()) {
            return view('admin-view.admin-page-tab.projectlist-tab');
        } else {
            return view('admin-view.admin-index');
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
            return view('admin-view.admin-page-tab.applicant-list-tab');
        } else {
            return view('admin-view.admin-index');
        }
    }

    public function LoadUsersTab(Request $request)
    {

        if ($request->ajax()) {
            return view('admin-view.admin-page-tab.users-tab');
        } else {
            return view('admin-view.admin-index');
        }
    }

    public function LoadProjectSettingTab(
        Request $request,
        ProjectFeeService $projectFeeService,
        NotifyOnService $notifyOnService
    ) {
        if ($request->ajax()) {
            $fee_percentage = $projectFeeService->getProjectFee();
            $notify_duration = $notifyOnService->getNotifyDuration();
            $notify_interval = $notifyOnService->getNotifyEvery();
            return view(
                'admin-view.admin-page-tab.project-settings-tab',
                compact(
                    'fee_percentage',
                    'notify_duration',
                    'notify_interval'
                )
            );
        } else {
            return view('admin-view.admin-index');
        }
    }
}
