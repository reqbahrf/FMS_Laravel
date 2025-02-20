<?php

namespace App\Http\Controllers\ApplicationProcessForm;

use Exception;
use App\Models\ProjectInfo;
use Illuminate\Http\Request;
use App\Services\ProjectFeeService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\SubmitToAdminService;
use App\Services\TNAdataHandlerService;
use App\Services\NumberFormatterService as NF;
use App\Services\RTECReportdataHandlerService;
use App\Services\ProjectProposaldataHandlerService;

class SubmissionToAdminController extends Controller
{
    public function save(
        Request $request,
        SubmitToAdminService $SubmitToAdmin,
        ProjectFeeService $ProjectFee,
        ProjectProposaldataHandlerService $ProjectProposal,
        TNAdataHandlerService $TNA,
        RTECReportdataHandlerService $RTEC
    )
    {
        try {
            $business_id = $request->business_id;
            $application_id = $request->application_id;
            $staff_id = Auth::user()->orgUserInfo->id;

            if (!$business_id || !$application_id || !$staff_id) {
                return response()->json(['message' => 'Invalid request data'], 400);
            }

            $projectProposalData = $ProjectProposal->getProjectProposalData($business_id, $application_id);

            $extractedProjectData = [
                'Project_id' => $this->generateProjectId(),
                'project_title' => $projectProposalData['project_title'],
                'staff_id' => $staff_id,
                'fund_amount' => NF::parseFormattedNumber($projectProposalData['project_cost']),
                'fee_applied' => $ProjectFee->getProjectFee(),
                'actual_amount_to_be_refund' => $ProjectFee->calculateProjectFee(NF::parseFormattedNumber($projectProposalData['project_cost'])),
            ];

            $extractedApplicationData = [
                'Project_id' => $extractedProjectData['Project_id'],
            ];

            $SubmitToAdmin->updateProjectInfo($business_id, $extractedProjectData);
            $SubmitToAdmin->updateApplicationInfo($business_id, $application_id, $extractedApplicationData);
            $ProjectProposal->updateStatusToSubmitted($business_id, $application_id);
            $TNA->updateStatusToSubmitted($business_id, $application_id);
            $RTEC->updateStatusToSubmitted($business_id, $application_id);
            
            return response()->json(['message' => 'Successfully submitted to admin']);
        } catch (Exception $e) {
            throw new Exception('Failed to submit to admin: ' . $e->getMessage());
        }
    }
    private function generateProjectId(): string
    {
        // Generate a random string of 9 characters (to make total length 15 with 'SETUP' prefix)
        do {
            $randomPart = strtoupper(substr(bin2hex(random_bytes(5)), 0, 9));
            $projectId = 'SETUP' . $randomPart;
        } while (ProjectInfo::where('project_id', $projectId)->exists());

        return $projectId;
    }
}
