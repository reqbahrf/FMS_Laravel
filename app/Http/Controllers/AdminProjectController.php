<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\OrgUserInfo;
use App\Models\ProjectInfo;
use App\Jobs\ProcessPayment;
use App\Jobs\SendProjectApprovalEmail;
use App\Jobs\NotifyAssignedStaff;
use App\Jobs\TransferRequirementFiles;
use App\Models\BusinessInfo;
use Illuminate\Http\Request;
use App\Models\ApplicationInfo;
use App\Mail\ProjectApprovalMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Services\PaymentProcessingService;
use App\Services\ProjectProposaldataHandlerService;
use App\Notifications\ProjectAssignmentNotification;
use App\Services\RequirementToProjectFileTransferService;

class AdminProjectController extends Controller
{
    public function approvedProjectProposal(
        Request $request,
        ProjectProposaldataHandlerService $ProjectProposalService,
        RequirementToProjectFileTransferService $fileTransferService
    ) {

        $validated = $request->validate([
            'project_id' => 'required|string',
            'business_id' => 'required|integer',
            'assigned_staff_id' => 'required|integer|exists:org_users_info,id',
        ]);

        try {

            DB::beginTransaction();

            $project = $this->asignStaffToProject($validated['project_id'], $validated['assigned_staff_id'], $validated['business_id']);
            $application = $this->updateApplicationStatusToApproved($validated['business_id']);

            $project_id = $project->Project_id;
            $application_id = $application->id;
            $business_id = $project->business_id;

            if (!$project_id || !$application_id || !$business_id) {
                throw new Exception('Project not found');
            }
            [$paymentStructure, $fundReleaseDate] = $ProjectProposalService->getRefundPaymentStructure($validated['business_id'], $application->id);

            if (!$paymentStructure || !$fundReleaseDate) {
                throw new Exception('Failed to retrieve payment structure and fund release date');
            }
            if (empty($fundReleaseDate) || !strtotime($fundReleaseDate)) {
                Log::error('Invalid fund release date', ['fundReleaseDate' => $fundReleaseDate]);
                throw new Exception('Invalid fund release date');
            }
            DB::commit();

            $this->dispatchBackgroundJobs($validated, $project, $fileTransferService, $fundReleaseDate, $paymentStructure);
            return response()->json([
                'message' => 'Project proposal approved successfully.',
                'status' => 'success',
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'error',
            ], 500);
        }
    }

    private function dispatchBackgroundJobs(
        array $validated,
        ProjectInfo $project,
        RequirementToProjectFileTransferService $fileTransferService,
        string $fundReleaseDate,
        array $paymentStructure
    ): void {
        // Get business info for background jobs
        $business = BusinessInfo::with('userInfo.user', 'requirementInfo')
            ->findOrFail($validated['business_id']);

        // File transfer job
        if ($business->requirementInfo->isNotEmpty()) {
            TransferRequirementFiles::dispatchAfterResponse(
                $business->requirementInfo,
                $validated['project_id'],
                $fileTransferService
            );
        }

        // Email notification job
        if ($business->userInfo && $business->userInfo->user) {
            SendProjectApprovalEmail::dispatchAfterResponse($business->userInfo->user, $project);
        }

        // Staff notification job
        $orgUserInfo = OrgUserInfo::with('user')->findOrFail($validated['assigned_staff_id']);
        if ($orgUserInfo && $orgUserInfo->user) {
            NotifyAssignedStaff::dispatchAfterResponse($orgUserInfo, $project);
        }

        // Clear cache if needed
        if ($project->wasChanged('handled_by_id')) {
            $this->clearCache($validated['assigned_staff_id']);
        }

        // Payment processing job
        ProcessPayment::dispatchAfterResponse($fundReleaseDate, $paymentStructure, $project->Project_id);
    }

    public function assignNewStaff(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|string',
            'business_id' => 'required|integer',
            'staff_id' => 'required|exists:org_users_info,id|integer',
        ]);

        try {

            $project = $this->asignStaffToProject($validated['project_id'], $validated['staff_id'], $validated['business_id']);

            Cache::forget('handled_projects' . $validated['staff_id']);

            if ($project->wasChanged('handled_by_id')) {
                Cache::forget('handled_projects' . $project->getOriginal('handled_by_id'));
                Cache::forget('ongoing_projects');
                Cache::forget('staffhandledProjects');
            }

            return response()->json([
                'message' => 'Project assigned successfully.',
                'status' => 'success',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'error',
            ], 500);
        }
    }


    private function asignStaffToProject(string $project_id, int $staff_id, int $business_id): ProjectInfo
    {
        try {
            $project = ProjectInfo::where('Project_id', $project_id)
                ->where('business_id', $business_id)
                ->firstOrFail();

            $project->handled_by_id = $staff_id;
            $project->save();

            return $project;
        } catch (Exception $e) {
            throw new Exception('Failed to assign staff to project: ' . $e->getMessage() || 'Failed to assign staff to project');
        }
    }
    private function updateApplicationStatusToApproved(int $businessId): ApplicationInfo
    {
        try {
            $application = ApplicationInfo::where('business_id', $businessId)
                ->firstOrFail();
            $application->application_status = 'approved';
            $application->save();

            return $application;
        } catch (Exception $e) {
            throw new Exception('Failed to update application status: ' . $e->getMessage() || 'Failed to update application status');
        }
    }

    private function emailCooperatoor(User $user, ProjectInfo $project)
    {
        try {
            if ($user->email) {
                Mail::to($user->email)->send(new ProjectApprovalMail($project));
            }
        } catch (Exception $e) {
            throw new Exception('Failed to send email to business owner: ' . $e->getMessage() || 'Failed to send email to business owner');
        }
    }

    private function notifyAssignedStaff(OrgUserInfo $staff, ProjectInfo $project): void
    {
        try {
            if ($staff->user) {
                $staff->user->notify(new ProjectAssignmentNotification($project));
            }
        } catch (Exception $e) {
            throw new Exception('Failed to notify assigned staff: ' . $e->getMessage() || 'Failed to notify assigned staff');
        }
    }

    private function clearCache(int $staffId): void
    {
        try {
            Cache::forget('handled_projects' . $staffId);
            Cache::forget('ongoing_projects');
            Cache::forget('pendingProjects');
            Cache::forget('staffhandledProjects');
        } catch (Exception $e) {
            throw new Exception('Failed to clear cache: ' . $e->getMessage());
        }
    }
}
