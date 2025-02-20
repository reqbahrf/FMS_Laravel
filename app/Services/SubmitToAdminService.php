<?php

namespace App\Services;

use Exception;
use App\Models\User;
use App\Models\ProjectInfo;
use App\Models\ApplicationInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ProjectProposalNotification;
use App\Services\NumberFormatterService as NF;
use App\Services\RTECReportdataHandlerService;
use App\Services\ProjectProposaldataHandlerService;

class SubmitToAdminService
{
    private function updateProjectInfo(int $business_id, array $data)
    {
        try {
            ProjectInfo::create([
                'Project_id' => $data['Project_id'],
                'business_id' => $business_id,
                'evaluated_by_id' => $data['staff_id'],
                'project_title' => $data['project_title'],
                'fund_amount' => $data['fund_amount'],
                'fee_applied' => $data['fee_applied'],
                'actual_amount_to_be_refund' => $data['actual_amount_to_be_refund'],
            ]);
        } catch (Exception $e) {
            throw new Exception('Failed to update project info: ' . $e->getMessage() || 'Failed to update project info');
        }
    }
    private function updateApplicationInfo(int $business_id, int $application_id, ?array $data, string $status)
    {
        try {
            if (!in_array($status, ['new', 'evaluation', 'pending', 'approved', 'ongoing', 'completed', 'rejected'])) {
                throw new Exception('Invalid application status');
            }
            ApplicationInfo::where('business_id', $business_id)
                ->where('id', $application_id)
                ->update([
                    'Project_id' => $data['Project_id'] ?? null,
                    'application_status' => $status,
                ]);
        } catch (Exception $e) {
            throw new Exception('Failed to update application info: ' . $e->getMessage() || 'Failed to update application info');
        }
    }

    public function approved(
        int $business_id,
        int $application_id,
        int $staff_id,
        ProjectProposaldataHandlerService $ProjectProposal,
        TNAdataHandlerService $TNA,
        RTECReportdataHandlerService $RTEC

    ) {
        try {

            $this->updateApplicationInfo($business_id, $application_id, null, 'approved');
            $ProjectProposal->updateStatusToSubmitted($business_id, $application_id);
            $TNA->updateStatusToSubmitted($business_id, $application_id);
            $RTEC->updateStatusToSubmitted($business_id, $application_id);

            DB::commit();
            Cache::forget('pendingProjects');
            Cache::forget('applicants');
            // $adminUser = User::where('role', 'Admin')->get();

            return response()->json(['message' => 'Submitted to admin successfully'], 200);
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Failed to submit to admin: ' . $e->getMessage());
        }
    }

    public function submitForReview(
        int $business_id,
        int $application_id,
        int $staff_id,
        ProjectFeeService $ProjectFee,
        ProjectProposaldataHandlerService $ProjectProposal,
    ) {
        try {
            $projectProposalData = $ProjectProposal->getProjectProposalData($business_id, $application_id);

            $projectId = $this->generateProjectId();
            $projectTitle = $projectProposalData['project_title'];
            $fundAmount = NF::parseFormattedNumber($projectProposalData['project_cost']);
            $actualAmountToBeRefund = $ProjectFee->calculateProjectFee($fundAmount) + $fundAmount;

            $extractedProjectData = [
                'Project_id' => $projectId,
                'project_title' => $projectTitle,
                'staff_id' => $staff_id,
                'fund_amount' => $fundAmount,
                'fee_applied' => $ProjectFee->getProjectFee(),
                'actual_amount_to_be_refund' => $actualAmountToBeRefund,
            ];

            $extractedApplicationData = [
                'Project_id' => $extractedProjectData['Project_id'],
            ];

            DB::beginTransaction();

            $this->updateProjectInfo($business_id, $extractedProjectData);
            $this->updateApplicationInfo($business_id, $application_id, $extractedApplicationData, 'pending');

            DB::commit();
            Cache::forget('pendingProjects');
            Cache::forget('applicants');
            $adminUser = User::where('role', 'Admin')->get();
            Notification::send($adminUser, new ProjectProposalNotification([
                'project_title' => $projectTitle,
                'Project_id' => $projectId
            ], $staff_id));
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Failed to submit for review: ' . $e->getMessage());
        }
    }

    private function generateProjectId(): string
    {
        // Generate a random string of 9 characters (to make total length 15 with 'SETUP' prefix)
        $maxRetries = 10;
        $retries = 0;
        do {
            if ($retries >= $maxRetries) {
                throw new Exception('Failed to generate a unique Project ID after multiple attempts.');
            }
            $randomPart = strtoupper(substr(bin2hex(random_bytes(5)), 0, 8));
            $projectId = 'SETUP-' . $randomPart;
            $retries++;
        } while (ProjectInfo::where('project_id', $projectId)->exists());

        return $projectId;
    }
}
