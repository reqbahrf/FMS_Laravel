<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\ProjectStateService;

class UpdateProjectStateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function updateProjectState(Request $request, ProjectStateService $projectStateService)
    {
        $validated = $request->validate([
            'action' => 'required|string|in:Ongoing,Completed',
            'business_id' => 'required|integer',
            'project_id' => 'required|string|max:15',
        ]);
        $project_id = $validated['project_id'];
        $business_id = $validated['business_id'];
        try {
            switch ($validated['action']) {
                case 'Ongoing':
                    $result = $projectStateService->markProjectAsOngoing($project_id, $business_id);
                    break;
                case 'Completed':
                    $result = $projectStateService->markProjectAsCompleted($project_id, $business_id);
                    break;
            }

            return $result;
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
