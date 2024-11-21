<?php

namespace App\Http\Controllers;

use App\Models\ProjectInfo;
use Illuminate\Http\Request;
use App\Models\ApplicationInfo;
use Illuminate\Support\Facades\DB;
use Exception;

class AdminProjectController extends Controller
{
    public function approvedProjectProposal(Request $request)
    {

        $validated = $request->validate([
            'project_id' => 'required|string',
            'business_id' => 'required|integer',
            'assigned_staff_id' => 'required|integer',
        ]);

        try {

            DB::beginTransaction();

            $project = ProjectInfo::where('Project_id', $validated['project_id'])
                ->where('business_id', $validated['business_id'])
                ->firstOrFail();

            $project->handled_by_id = $validated['assigned_staff_id'];
            $project->save();

            $application = ApplicationInfo::where('business_id', $validated['business_id'])
                ->firstOrFail();
            $application->application_status = 'approved';
            $application->save();

            DB::commit();

            return response()->json([
                'message' => 'Project proposal approved successfully.',
                'status' => 'success',
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'error',
            ], 500);
        }
    }

    public function assignNewStaff(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|string',
            'business_id' => 'required|integer',
            'new_assigned_staff_id' => 'required|exists:org_users_info,id|integer',
        ]);

        try {

            $project = ProjectInfo::where('Project_id', $validated['project_id'])
                ->where('business_id', $validated['business_id'])
                ->firstOrFail();

            $project->handled_by_id = $validated['new_assigned_staff_id'];
            $project->save();

            return response()->json([
                'message' => 'Project assigned successfully.',
                'status' => 'success',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'error',
            ], 500);
        }

    }
}
