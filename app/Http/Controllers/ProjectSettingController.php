<?php

namespace App\Http\Controllers;

use App\Services\ProjectFeeService;
use Illuminate\Http\Request;
use Exception;

class ProjectSettingController extends Controller
{
    public function getFee(ProjectFeeService $projectFeeService)
    {
        try {
            return $projectFeeService->getProjectFee();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateFee(Request $request, ProjectFeeService $projectFeeService)
    {
        try {
            $feePercentage = $request->validate([
                'fee_percentage' => 'required|numeric|min:0|max:100'
                ])['fee_percentage'];
           return $projectFeeService->updateProjectFee($feePercentage);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
