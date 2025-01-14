<?php 

namespace App\Actions;

use Exception;
use App\Models\ChartYearOf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class GetAvailableChartYearList
{
    public static function execute()
    {
        try {
            if(Cache::has('listOfYears')) {
                $listOfYears = Cache::get('listOfYears');
            }else{
                $listOfYears = ChartYearOf::select('year_of')
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