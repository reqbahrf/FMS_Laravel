<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\ProjectInfo;
use Illuminate\Http\Request;
use App\Models\ApplicationInfo;
use App\Models\ProjectProposal;
use Illuminate\Support\Facades\DB;
use App\Services\ProjectFeeService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ProjectProposalNotification;
use App\Http\Requests\SubmitProjectProposalRequest;

class ProjectProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function store(SubmitProjectProposalRequest $request, ProjectFeeService $projectFeeService)
    {
        $StaffID = Auth::user()->orgUserInfo->id;
        $validated = $request->validated();
        try {
            $proposalData = [
                'projectID' => $validated['projectID'],
                'projectTitle' => $validated['projectTitle'],
                'dateOfFundRelease' => $validated['dateOfFundRelease'],
                'fundAmount' => $validated['fundAmount'],
                'business_id' => $validated['business_id'],
                'staffId' => $StaffID
            ];

            $proposalData['equipmentDetails'] = array_map(function ($equipmentDetail) {
                return [
                    'Qty' => $equipmentDetail['Qty'],
                    'Actual_Particulars' => $equipmentDetail['Actual_Particulars'],
                    'Cost' => $equipmentDetail['Cost'],
                ];
            }, $validated['equipmentDetails']);

            $proposalData['nonEquipmentDetails'] = array_map(function ($nonEquipmentDetail) {
                return [
                    'Qty' => $nonEquipmentDetail['Qty'],
                    'Actual_Particulars' => $nonEquipmentDetail['Actual_Particulars'],
                    'Cost' => $nonEquipmentDetail['Cost'],
                ];
            }, $validated['nonEquipmentDetails']);

            $proposalData['expectedOutputs'] = $validated['expectedOutputs'];
            switch ($validated['action']) {
                case 'SubmitForm':
                    return $this->submitProjectProposal($validated['application_id'], $proposalData, $projectFeeService);
                    break;
                case 'DraftForm':
                    return $this->draftProjectProposal($validated['application_id'], $proposalData);
                    break;
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $draftedData = ProjectProposal::where('Submission_status', 'Draft')
                ->where('application_id', '=', $id)
                ->first();

            $data = $draftedData->data;
            return response()->json($data, 200);
        } catch (Exception $e) {
            Log::alert('Error fetching project proposal:', $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    protected function submitProjectProposal($ApplicationID, $proposalData, $projectFeeService)
    {
        // Remove commas and convert to float directly
        $fundAmount = floatval(str_replace(',', '', $proposalData['fundAmount']));

        // Get the fee percentage from the service
        $fee_percentage = $projectFeeService->getProjectFee();

        // Calculate the actual fund to refund
        // (1 + fee_percentage/100) multiplies the original amount by the total percentage
        $actualFundToRefund = $fundAmount * (1 + ($fee_percentage / 100));

        // Format to 2 decimal places
        $fundAmountFormatted = number_format($fundAmount, 2, '.', '');
        $actualFundToRefund = number_format($actualFundToRefund, 2, '.', '');

        // Begin a transaction for database consistency
        DB::beginTransaction();

        try {
            // Update submission status
            $ProposalInfo = ProjectInfo::updateOrCreate(
                ['Project_id' => $proposalData['projectID']],
                [
                    'business_id' => $proposalData['business_id'],
                    'evaluated_by_id' => $proposalData['staffId'],
                    'project_title' => $proposalData['projectTitle'],
                    'fund_amount' => $fundAmountFormatted,
                    'fee_applied' => $fee_percentage,
                    'actual_amount_to_be_refund' => $actualFundToRefund,
                ]
            );
            ApplicationInfo::where('id', $ApplicationID)
                ->where('business_id', $proposalData['business_id'])
                ->update([
                    'Project_id' => $proposalData['projectID'],
                    'application_status' => 'pending',
                ]);

            ProjectProposal::updateOrCreate(
                [
                    'application_id' => $ApplicationID
                ],
                [
                    'Project_id' => $proposalData['projectID'],
                    'data' => $proposalData,
                    'Submission_status' => 'Submitted'
                ]
            );
            DB::commit();
            $Evaluated_by = Auth::user()->email;
            Notification::send(Auth::user(), new ProjectProposalNotification($ProposalInfo, $Evaluated_by));
            
            Cache::forget('pendingProjects');
            return response()->json(['success' => 'true', 'message' => 'Project Proposal Submitted'], 200);
        } catch (\Exception $e) {
            // Rollback transaction if something goes wrong
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    protected function draftProjectProposal($ApplicationID, $proposalData)
    {
        try {
            ProjectProposal::updateOrCreate(
                ['application_id' => $ApplicationID],
                [
                    'data' => $proposalData,
                    'Submission_status' => 'Draft'
                ]
            );

            return response()->json(['success' => 'true', 'message' => 'Project Proposal Drafted'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
