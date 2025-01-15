<?php

namespace App\Services;

use Exception;
use App\Events\ProjectEvent;
use App\Models\ApplicationInfo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ProjectStateService
{
    protected $applicationInfoModel;
    public function __construct(ApplicationInfo $applicationInfoModel)
    {
        $this->applicationInfoModel = $applicationInfoModel;
    }

    public function markProjectAsOngoing($project_id, $business_id): object
    {
        try {
            $applicationInfo = $this->findApplicationInfo($project_id, $business_id);

            $applicationInfo->application_status = 'ongoing';
            $applicationInfo->save(); // Save to trigger the updated event
            $this->refreshCache();
            event(new ProjectEvent(null, null, null, null, 'NEW_ONGOING'));

            return response()->json(['message' => 'Marked as ongoing successfully'], 200);
        } catch (Exception $e) {
            Log::error('Error marking project as ongoing: ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function markProjectAsCompleted($project_id, $business_id): object
    {
        try {
            $applicationInfo = $this->findApplicationInfo($project_id, $business_id);

            // Ensure project info and refund check exists
            if (
                !$applicationInfo->projectInfo ||
                $applicationInfo->projectInfo->actual_amount_to_be_refund !== $applicationInfo->projectInfo->refunded_amount
            ) {
                throw new Exception('Refund amount must be complete to proceed with this action');
            }

            $applicationInfo->application_status = 'completed';
            $applicationInfo->save();
            $this->refreshCache();
            event(new ProjectEvent(null, null, null, null, 'NEW_COMPLETED'));

            return response()->json(['message' => 'Marked as completed successfully'], 200);
        } catch (Exception $e) {
            Log::error('Error marking project as completed: ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    private function findApplicationInfo($project_id, $business_id): object
    {
        return $this->applicationInfoModel
            ->where('business_id', $business_id)
            ->whereHas('BusinessInfo.projectInfo', function ($query) use ($project_id) {
                $query->where('project_id', $project_id);
            })->firstOrFail();
    }

    private function refreshCache()
    {
        Cache::forget('handled_projects' . Auth::user()->orgUserInfo->id);
    }
}
