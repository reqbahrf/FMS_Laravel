<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\ProjectSetting;
use Illuminate\Http\JsonResponse;

class ProjectSettingController extends Controller
{
    public function updateProjectSetting(
        Request $request
    ): JsonResponse {
        try {
            $newSettings = $request->validate([
                'fee_percentage' => 'required|numeric|min:0|max:100',
                'notify_duration' => 'required|numeric|min:0',
                'notify_interval' => 'required|numeric|min:0',
            ]);

            foreach ($newSettings as $key => $value) {
                $this->updateOrCreateSetting($key, $value);
            }


            return response()->json(['message' => 'Project settings updated successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    protected function updateOrCreateSetting(string $key, mixed $value)
    {
        try {
            ProjectSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
