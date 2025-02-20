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
use Illuminate\Support\Facades\Cache;
use App\Services\SubmitToAdminService;
use App\Services\TNAdataHandlerService;
use Illuminate\Support\Facades\Notification;
use App\Services\NumberFormatterService as NF;
use App\Services\RTECReportdataHandlerService;
use App\Notifications\ProjectProposalNotification;
use App\Services\ProjectProposaldataHandlerService;

class SubmissionToAdminController extends Controller
{
    public function save(
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
            $staff_id = Auth::user()->orgUserInfo->id;

            if (!$business_id || !$application_id || !$staff_id) {
                return response()->json(['message' => 'Invalid request data'], 400);
            }

            $projectProposalData = $ProjectProposal->getProjectProposalData(
                $business_id,
                $application_id
            );

            $projectId = $this->generateProjectId();
            $projectTitle = $projectProposalData['project_title'];

            $extractedProjectData = [
                'Project_id' => $projectId,
                'project_title' => $projectTitle,
                'staff_id' => $staff_id,
                'fund_amount' => NF::parseFormattedNumber($projectProposalData['project_cost']),
                'fee_applied' => $ProjectFee->getProjectFee(),
                'actual_amount_to_be_refund' => $ProjectFee->calculateProjectFee(
                    NF::parseFormattedNumber($projectProposalData['project_cost'])
                ),
            ];

            $extractedApplicationData = [
                'Project_id' => $extractedProjectData['Project_id'],
            ];

            DB::beginTransaction();

            $SubmitToAdmin->updateProjectInfo($business_id, $extractedProjectData);
            $SubmitToAdmin->updateApplicationInfo($business_id, $application_id, $extractedApplicationData);
            $ProjectProposal->updateStatusToSubmitted($business_id, $application_id);
            $TNA->updateStatusToSubmitted($business_id, $application_id);
            $RTEC->updateStatusToSubmitted($business_id, $application_id);

            DB::commit();
            Cache::forget('pendingProjects');
            Cache::forget('applicants');
            $adminUser = User::where('role', 'Admin')->get();

            Notification::send($adminUser, new ProjectProposalNotification([
                'project_title' => $projectTitle,
                'Project_id' => $projectId
            ], $staff_id));

            return response()->json(['message' => 'Submitted to admin successfully'], 200);
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
