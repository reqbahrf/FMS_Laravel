<?php

namespace App\Http\Controllers;

use App\Models\OngoingQuarterlyReport;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;

class Coop_QuarterlyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {
            $project_id = Session::get('project_id');
            $quarterlyReportsLinks = OngoingQuarterlyReport::where('ongoing_project_id', $project_id)
                ->select('id', 'ongoing_project_id', 'quarter', 'report_status')
                ->get();

            $html = '';
            foreach ($quarterlyReportsLinks as $index => $report) {
                $signedUrl = URL::signedRoute('CooperatorViewController', [
                    'id' => hash('sha256', $report->id),
                    'ProjectId' => hash('sha256', $report->ongoing_project_id),
                    'QuarterlyPeriod' => $report->quarter,
                    'ReportStatus' => $report->report_status
                ]);

                $reportStatusClass = $report->report_status == 'open' ? 'success' : 'secondary';
                $html .= '<li>';
                $html .= '<a href="#" id="querterlyReportTab' . ($index + 1) . '" ';
                $html .= ($report->report_status == 'closed') ? 'class="disabled" onclick="return false;"' : 'onclick="loadPage(\'' . $signedUrl . '\', \'querterlyReportTab' . ($index + 1) . '\');">';
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

            return view('cooperatorView.outputs.quarterlyReport');
        } else {
            return view('cooperatorView.CooperatorDashboard');
        }
    }

    public function getQuarterlyForm(Request $request)
    {

        if($request->ajax()){
            $id = $request->route('id');
            $projectId = $request->route('ProjectId');
            $quarterlyPeriod = $request->route('QuarterlyPeriod');
            $reportStatus = $request->route('ReportStatus');
            Log::info('Quarterly Report id: ' . $id . ' Project Id: ' . $projectId . ' Quarterly Period: ' . $quarterlyPeriod . ' Report Status: ' . $reportStatus);

            return view('cooperatorView.outputs.quarterlyReport', compact('id', 'projectId', 'quarterlyPeriod', 'reportStatus'));
        }else{
            return view('cooperatorView.CooperatorDashboard');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $project_id = Session::get('project_id');
        $quarter = 'Q1';
        OngoingQuarterlyReport::create([
            'ongoing_project_id' => $project_id,
            'quarter' => $quarter,
            'report_file' => json_encode($request->all()),
        ]);
        return response()->json(['success' => true, 'message' => 'File uploaded successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $quarterProject = $request->header('X-Quarter-Project');
        $quarterPeriod = $request->header('X-Quarter-Period');
        $quarterStatus = $request->header('X-Quarter-Status');
        try {
            OngoingQuarterlyReport::whereRaw('SHA2(id, 256) = ?', $id)
                ->whereRaw('SHA2(ongoing_project_id, 256) = ?', $quarterProject)
                ->where('quarter', $quarterPeriod)
                ->where('report_status', $quarterStatus)
                ->update([
                    'report_file' => json_encode($request->all()),
                ]);

            return response()->json(['success' => true, 'message' => 'File updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
