<?php

namespace App\Http\Controllers\ApplicationProcessForm;

use Exception;
use App\Models\User;
use App\Models\ProjectInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\ProjectFeeService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\SubmitToAdminService;
use App\Services\TNAdataHandlerService;
use App\Services\RTECReportdataHandlerService;
use App\Services\ProjectProposaldataHandlerService;

class SubmissionToAdminController extends Controller
{
    public function approvedProject(
        Request $request,
        ProjectProposaldataHandlerService $ProjectProposal,
        SubmitToAdminService $SubmitToAdmin,
        ProjectFeeService $ProjectFee,
        TNAdataHandlerService $TNA,
        RTECReportdataHandlerService $RTEC
    ) {
        try {
            $business_id = $request->business_id;
            $application_id = $request->application_id;
            $staff_id = $request->staff_id;

            if (!$business_id || !$application_id || !$staff_id) {
                return response()->json(['message' => 'Invalid request data'], 400);
            }

            $SubmitToAdmin->approved(
                $business_id,
                $application_id,
                $staff_id,
                $ProjectProposal,
                $TNA,
                $RTEC
            );

            return response()->json(['message' => 'Submitted to admin successfully'], 200);
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Failed to submit to admin: ' . $e->getMessage());
        }
    }

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
