<?php

namespace App\Http\Controllers;

use Exception;
use App\Events\ProjectEvent;
use Illuminate\Http\Request;
use App\Models\ApplicationInfo;

class UpdateProjectStateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function updateProjectState(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|string|in:MarkOngoing,MarkCompleted',
            'business_id' => 'required|integer',
            'project_id' => 'required|string|max:15',
        ]);
        $project_id = $validated['project_id'];
        $business_id = $validated['business_id'];
        try {
            switch ($validated['action']) {
                case 'MarkOngoing':
                   $result = $this->updateProjectToOngoing($project_id, $business_id);
                    break;
                case 'MarkCompleted':
                   $result = $this->updateProjectToCompleted($project_id, $business_id);
                    break;
            }

            return $result;
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    protected function updateProjectToOngoing($project_id, $business_id)
    {
        $applicationInfo = ApplicationInfo::where('business_id', $business_id)
            ->whereHas('BusinessInfo.projectInfo', function ($query) use ($project_id) {
                $query->where('project_id', $project_id);
            })->first(); // Fetch the model

        if ($applicationInfo) {
            $applicationInfo->application_status = 'ongoing';
            $applicationInfo->save(); // Save to trigger the updated event
            event(new ProjectEvent(null, null, null, null, 'NEW_ONGOING'));
            return response()->json(['message' => 'Marked as ongoing successfully'], 200);
        }

        return response()->json(['message' => 'Project not found'], 404);
    }

    protected function updateProjectToCompleted($project_id, $business_id)
    {
        $applicationInfo = ApplicationInfo::where('business_id', $business_id)
            ->whereHas('BusinessInfo.projectInfo', function ($query) use ($project_id) {
                $query->where('project_id', $project_id);
            })->first();

        if ($applicationInfo) {
            if ($applicationInfo->projectInfo->actual_amount_to_be_refund !== $applicationInfo->projectInfo->refunded_amount) {
                return response()->json(['message' => 'Refund amount must be complete to proceed with this action'], 400);
            } else {
                $applicationInfo->application_status = 'completed';
                $applicationInfo->save(); // Save to trigger the updated event
                event(new ProjectEvent(null, null, null, null, 'NEW_COMPLETED'));
               
                return response()->json(['message' => 'Marked as completed successfully'], 200);
            }
        }
        return response()->json(['message' => 'Project not found'], 404);
    }
}
