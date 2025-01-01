<?php

namespace App\Actions;

use Exception;
use Illuminate\Support\Facades\Log;

class GetPreviousQuarterAction
{
    public function execute(String $quarter): string
    {
        try {
            list($currentQuarter, $currentYear) = explode(' ', $quarter);
            $currentQuarterNumber = (int) substr($currentQuarter, 1);
            $previousQuarterNumber = $currentQuarterNumber - 1;
            $previousYear = $currentYear;

            if ($previousQuarterNumber < 1) {
                $previousQuarterNumber = 4;
                $previousYear -= 1;
            }
            return "Q{$previousQuarterNumber} {$previousYear}";
        } catch (Exception $e) {
            Log::error('Error in GetPreviousQuarterAction: ' . $e->getMessage(), [
                'quarter' => $quarter
            ]);
            throw new Exception('Failed to retrieve previous quarter: ' . $e->getMessage());
        }
    }
}