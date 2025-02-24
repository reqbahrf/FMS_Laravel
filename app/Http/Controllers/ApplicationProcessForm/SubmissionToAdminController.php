<?php

namespace App\Http\Controllers\ApplicationProcessForm;

use Exception;
use Illuminate\Http\Request;
use App\Services\Settings\ProjectFeeService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\SubmitToAdminService;
use App\Services\ProjectProposaldataHandlerService;

class SubmissionToAdminController extends Controller
{

    public function submitToAdmin(
        Request $request,
        SubmitToAdminService $SubmitToAdmin,
        ProjectFeeService $ProjectFee,
        ProjectProposaldataHandlerService $ProjectProposal,

    ) {
        try {
            $business_id = $request->business_id;
            $application_id = $request->application_id;
            $staff_id = Auth::user()->orgUserInfo->id;

            if (!$business_id || !$application_id || !$staff_id) {
                return response()->json(['message' => 'Invalid request data'], 400);
            }

            $SubmitToAdmin->submitForReview(
                $business_id,
                $application_id,
                $staff_id,
                $ProjectFee,
                $ProjectProposal
            );

            return response()->json(['message' => 'Submitted for review successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to approve project proposal: ' . $e->getMessage()], 400);
        }
    }
}
