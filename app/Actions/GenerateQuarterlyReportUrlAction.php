<?php

namespace App\Actions;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use App\Models\OngoingQuarterlyReport;

class GenerateQuarterlyReportUrlAction
{
    /**
     * Generate the signed URL for the Cooperator View Controller.
     *
     * @param OngoingQuarterlyReport $quarterly_report The quarterly report model instance.
     * @return string The signed URL for the Cooperator View Controller.
     */
    public static function execute(OngoingQuarterlyReport $quarterly_report): string
    {
        try {
            $role = Auth::user()->role;
            switch ($role) {
                case 'Cooperator':
                    $route_to_use = 'coop.quarterly.report.form';
                    break;
                case 'Staff':
                    $route_to_use = 'staff.quarterly.report.form';
                    break;
                default:
                    throw new Exception('Invalid role: ' . $role);
            }
            return URL::signedRoute($route_to_use, [
                'id' => $quarterly_report->id,
                'projectId' => $quarterly_report->ongoing_project_id,
                'quarter' => $quarterly_report->quarter,
                'reportStatus' => $quarterly_report->report_status,
                'reportSubmitted' => $quarterly_report->report_file_state,
            ]);
        } catch (Exception $e) {
            Log::error('Error generating quarterly report URL: ' . $e->getMessage());
            throw $e;
        }
    }
}
