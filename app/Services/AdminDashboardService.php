<?php

namespace App\Services;

use Exception;
use App\Models\ChartYearOf;
use App\Models\OrgUserInfo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class AdminDashboardService {

    protected $chartYearOfModel;
    protected $orgUserInfoModel;

    public function __construct(ChartYearOf $chartYearOfModel, OrgUserInfo $orgUserInfoModel) {
        $this->chartYearOfModel = $chartYearOfModel;
        $this->orgUserInfoModel = $orgUserInfoModel;
    }

    public function getChartData()
    {
        if(Cache::has('chartData')) {
            $chartData = Cache::get('chartData');
        }else{
            $chartData = $this->chartYearOfModel
                ->select('monthly_project_categories', 'project_local_categories')
                ->where('year_of', '=', date('Y'))
                ->get();

            Cache::put('chartData', $chartData, 1800);
        }

        return $chartData;
    }

    public function getStaffHandledProjects()
    {

        try {
            if(Cache::has('staffhandledProjects')) {
                $staffhandledProjects = Cache::get('staffhandledProjects');
            }else{
                $staffhandledProjects = $this->orgUserInfoModel
                ->whereHas('user', function ($query) {
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
                Cache::put('staffhandledProjects', $staffhandledProjects, 1800);
            }


            return $staffhandledProjects;
        } catch (Exception $e) {
            Log::error('Error in getStaffHandledProjects: ' . $e->getMessage());
            return collect([]);
        }


    }
}
