<?php

namespace App\Http\Controllers\ApplicationProcessForm;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectInfo;
use App\Services\ProjectFeeService;
use App\Services\ProjectProposaldataHandlerService;
use App\Services\SubmitToAdminService;
use App\Services\NumberFormatterService as NF;

class SubmissionToAdminController extends Controller
{
    public function save(
        Request $request,
        SubmitToAdminService $SubmitToAdmin,
        ProjectFeeService $ProjectFee,
        ProjectProposaldataHandlerService $ProjectProposal
    )
    {
        try {
            $business_id = $request->business_id;
            $application_id = $request->application_id;
            $staff_id = $request->staff_id;

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
