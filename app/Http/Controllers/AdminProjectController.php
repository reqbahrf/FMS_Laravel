<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\OrgUserInfo;
use App\Models\ProjectInfo;
use App\Jobs\ProcessPayment;
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

class AdminProjectController extends Controller
{
    public function approvedProjectProposal(
        Request $request,
        ProjectProposaldataHandlerService $ProjectProposalService,
    ) {

        $validated = $request->validate([
            'project_id' => 'required|string',
            'business_id' => 'required|integer',
            'assigned_staff_id' => 'required|integer|exists:org_users_info,id',
        ]);

        try {

            DB::beginTransaction();

            $project = ProjectInfo::where('Project_id', $validated['project_id'])
                ->where('business_id', $validated['business_id'])
                ->firstOrFail();

            $project->handled_by_id = $validated['assigned_staff_id'];
            $project->save();

            $application = ApplicationInfo::where('business_id', $validated['business_id'])
                ->firstOrFail();
            $application->application_status = 'approved';
            $application->save();

            // Get the business info and associated user
            $business = BusinessInfo::with('userInfo.user')->findOrFail($validated['business_id']);

            // Send email notification to business owner
            if ($business->userInfo && $business->userInfo->user) {
                Mail::to($business->userInfo->user->email)->send(new ProjectApprovalMail($project));
            }

            // Send notification to assigned staff's user account
            $assignedStaff = OrgUserInfo::with('user')->findOrFail($validated['assigned_staff_id']);
            if ($assignedStaff->user) {
                $assignedStaff->user->notify(new ProjectAssignmentNotification($project));
            }

            if ($project->wasChanged('handled_by_id')) {
                Cache::forget('handled_projects' . $validated['assigned_staff_id']);
                Cache::forget('ongoing_projects');
                Cache::forget('pendingProjects');
                Cache::forget('staffhandledProjects');
            }
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
            DB::commit();

            if (empty($fundReleaseDate) || !strtotime($fundReleaseDate)) {
                Log::error('Invalid fund release date', ['fundReleaseDate' => $fundReleaseDate]);
                throw new Exception('Invalid fund release date');
            }

            //PaymentProcessingService::processPayments($fundReleaseDate, $paymentStructure, $project_id);

            ProcessPayment::dispatchAfterResponse($fundReleaseDate, $paymentStructure, $project_id);
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

    public function assignNewStaff(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|string',
            'business_id' => 'required|integer',
            'staff_id' => 'required|exists:org_users_info,id|integer',
        ]);

        try {

            $project = ProjectInfo::where('Project_id', $validated['project_id'])
                ->where('business_id', $validated['business_id'])
                ->firstOrFail();

            $project->handled_by_id = $validated['staff_id'];
            $project->save();

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
}
