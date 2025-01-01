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

    private function getChartData($yearToLoad, $Selected_Query)
    {
        try{
            $yearToLoad = $yearToLoad ?? date('Y');
            $chartData = $this->chartYearOfModel
                ->where('year_of', '=', $yearToLoad)
                ->pluck($Selected_Query)
                ->firstOrFail();
            return $chartData;
        }catch(Exception $e){
            Log::error('Error in getChartData: ' . $e->getMessage());
            throw new Exception('Error in getChartData: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    public function getMonthlyData($yearToLoad)
    {
        try{
            $method_query = 'monthly_project_categories';
            if(!Cache::has('monthly_Data')){
                $Monthly_data = $this->getChartData($yearToLoad, $method_query);
                Cache::put('monthly_Data', $Monthly_data, 1800);
            }
            $Monthly_data = Cache::get('monthly_Data');
            return $Monthly_data;
        }catch(Exception $e){
            Log::error('Error in getMonthlyData: ' . $e->getMessage());
            throw new Exception('Error in getMonthlyData: ' . $e->getMessage(), $e->getCode(), $e);
            return [];
        }
    }

    public function getLocalData($yearToLoad)
    {
        try{
            $method_query = 'project_local_categories';
            if(!Cache::has('local_Data')){
                $Local_data = $this->getChartData($yearToLoad, $method_query);
                Cache::put('local_Data', $Local_data, 1800);
            }
            $Local_data = Cache::get('local_Data');
            return $Local_data;
        }catch(Exception $e){
            Log::error('Error in getLocalData: ' . $e->getMessage());
            throw new Exception('Error in getLocalData: ' . $e->getMessage(), $e->getCode(), $e);
            return [];
        }
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
    public function getListOfYears()
    {
        try {
            if(Cache::has('listOfYears')) {
                $listOfYears = Cache::get('listOfYears');
            }else{
                $listOfYears = $this->chartYearOfModel
                ->select('year_of')
                ->distinct()
                ->get()
                ->pluck('year_of');
                Cache::put('listOfYears', $listOfYears, 1800);
            }
            return $listOfYears;
        } catch (Exception $e) {
            Log::error('Error in getListOfYears: ' . $e->getMessage());
            return collect([]);
        }
    }
}
