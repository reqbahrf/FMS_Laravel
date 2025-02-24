<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\OngoingQuarterlyReport;

class StaffQuarterlyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|string|max:15',
        ]);

        try {
            $ongoingReports = OngoingQuarterlyReport::Select(
                'id',
                'quarter',
                'report_file',
                'open_until',
                'report_status',
            )->where('ongoing_project_id', $validated['project_id'])->get();

            $ongoingReports->each(function ($report) {
                $report->Coop_Response = $report->report_file ? 'submitted' : 'no submission';
                $report->remaining_days = $report->open_until ? round(now()->diffInDays(Carbon::parse($report->open_until))) : 'Not set';
            });

            return response()->json($ongoingReports->makeHidden('report_file'), 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'error'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'quarter' => 'required|in:Q1,Q2,Q3,Q4',
                'year' => 'required|digits:4',
                'days_open' => 'nullable|integer|min_digits:1',
                'project_id' => 'required|string'
            ]);

            $quarterPeriod = $validated['quarter'] . ' ' . $validated['year'];

            $existingReportCheck = OngoingQuarterlyReport::where('ongoing_project_id', $request->project_id)
                ->where('quarter', $quarterPeriod)
                ->first();

            if ($existingReportCheck) {
                return response()->json([
                    'message' => 'Report already exists for this quarter',
                    'status' => 'error'
                ], 409);
            }

            $openUntil = isset($validated['days_open']) ? now()->addDays((int) $validated['days_open']) : null;

            OngoingQuarterlyReport::create([
                'ongoing_project_id' => $validated['project_id'],
                'quarter' => $quarterPeriod,
                'report_file' => null,
                'open_until' => $openUntil,

            ]);
            return response()->json([
                'message' => 'Report created successfully',
                'status' => 'success'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong:' . $e->getMessage(),
                'status' => 'error'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validated = $request->validate([
                'report_status' => 'required|in:open,closed',
                'updateOpenDays' => 'nullable|integer|min_digits:1',
            ]);

            $report = OngoingQuarterlyReport::where('id', $id)->first();
            if (!$report) {
                return response()->json([
                    'message' => 'Report not found',
                    'status' => 'error'
                ], 404);
            }

            $report->report_status = $validated['report_status'];
            $report->open_until = isset($validated['updateOpenDays']) ? now()->addDays((int) $validated['updateOpenDays']) : null;
            $report->save();
            return response()->json([
                'message' => 'Report updated successfully',
                'status' => 'success',
                'project_id' => $report->ongoing_project_id
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'error'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            OngoingQuarterlyReport::where('id', $id)->delete();
            return response()->json([
                'message' => 'Report deleted successfully',
                'status' => 'success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'error'
            ], 500);
        }
    }
}
