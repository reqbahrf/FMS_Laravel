<?php

namespace App\Actions;

use Illuminate\Support\Facades\URL;
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
        return URL::signedRoute('CooperatorViewController', [
            'id' => $quarterly_report->id,
            'projectId' => $quarterly_report->ongoing_project_id,
            'quarter' => $quarterly_report->quarter,
            'reportStatus' => $quarterly_report->report_status,
            'reportSubmitted' => $quarterly_report->report_file_state,
        ]);
    }
}
