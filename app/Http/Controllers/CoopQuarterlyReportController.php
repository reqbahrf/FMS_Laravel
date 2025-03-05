<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Models\OngoingQuarterlyReport;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Collection;
use App\Actions\GenerateQuarterlyReportUrlAction;
use App\Http\Requests\SubmitQuarterlyReportRequest;

class CoopQuarterlyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {
            $project_id = Session::get('project_id');
            $quarterlyReportsLinks = OngoingQuarterlyReport::where('ongoing_project_id', $project_id)
                ->select('id', 'ongoing_project_id', 'quarter', 'report_file', 'report_status')
                ->get();

            $html = '';
            foreach ($quarterlyReportsLinks as $index => $report) {
                $signedUrl = GenerateQuarterlyReportUrlAction::execute($report);

                $reportStatusClass = $report->report_status == 'open' ? 'success' : 'secondary';
                $html .= '<li>';
                $html .= '<a href="#" id="querterlyReportTab' . str_replace(' ', '', $report->quarter) . '" ';
                $html .= ($report->report_status == 'closed') ? 'class="disabled" onclick="return false;"' : 'onclick="loadPage(\'' . $signedUrl . '\', \'querterlyReportTab' . str_replace(' ', '', $report->quarter) . '\');">';
                $html .= '<span class="position-relative">' . $report->quarter . '</span>';
                $html .= '<span class="badge rounded-pill text-bg-' . $reportStatusClass . '">';
                $html .= ucfirst($report->report_status);
                $html .= '</span>';
                $html .= '</a>';
                $html .= '</li>';
            }

            return response()->json([
                'html' => $html,
            ], 200);
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {

            return view('cooperator-view.coop-page-tab.quarterly-report-form-tab');
        } else {
            return view('cooperator-view.Cooperator_Index');
        }
    }

    public function getQuarterlyForm(Request $request)
    {

        if ($request->ajax()) {
            $reportId = $request->route('id');
            $projectId = $request->route('projectId');
            $quarter = $request->route('quarter');
            $reportStatus = $request->route('reportStatus');
            $reportSubmitted = $request->route('reportSubmitted');

            Log::info($reportId);

            if ($reportSubmitted === 'true' && $reportStatus === 'open') {
                $Data = $this->getQuaterlyReportData($reportId, $projectId, $quarter);

                $reportData = $Data->report_file;

                return view('QuarterlyReportedForm.coopQuarterly', compact('reportId', 'projectId', 'quarter', 'reportStatus', 'reportData'));
            } else if ($reportSubmitted === 'false' && $reportStatus === 'open') {
                return view('cooperator-view.coop-page-tab.quarterly-report-form-tab', compact('reportId', 'projectId', 'quarter', 'reportStatus'));
            }
        } else {
            return view('cooperator-view.Cooperator_Index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubmitQuarterlyReportRequest $request, string $id)
    {
        $quarterProject = $request->header('X-Quarter-Project');
        $quarterPeriod = $request->header('X-Quarter-Period');
        $quarterStatus = $request->header('X-Quarter-Status');
        try {
            $report = OngoingQuarterlyReport::where('id', $id)
                ->where('ongoing_project_id', $quarterProject)
                ->where('quarter', $quarterPeriod)
                ->where('report_status', $quarterStatus)
                ->first();

            if ($report) {
                $report->update([
                    'report_file' => $request->validated(),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Quarterly report submitted successfully.',
                    'reportedFormUrl' => GenerateQuarterlyReportUrlAction::execute($report),
                    'navId' => 'querterlyReportTab' . str_replace(' ', '', $report->quarter)
                ]);
            } else {
                return response()->json(['message' => 'Report not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }



    private function getQuaterlyReportData(string $reportId, string $projectId, string $quarter): OngoingQuarterlyReport
    {
        try {
            return OngoingQuarterlyReport::where('id', $reportId)
                ->where('ongoing_project_id', $projectId)
                ->where('quarter', $quarter)
                ->select(['report_file'])
                ->first();
        } catch (Exception $e) {
            throw new Exception('Failed to get quarterly report: ' . $e->getMessage());
        }
    }
}
