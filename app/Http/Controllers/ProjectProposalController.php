<?php

namespace App\Http\Controllers;

use App\Models\ApplicationInfo;
use App\Models\ProjectInfo;
use App\Models\ProjectProposal;
use App\Notifications\ProjectProposalNotification;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $StaffID = Auth::user()->orgUserInfo->id;
        $validated = $request->validate([
            'projectID' => 'required|string',
            'projectTitle' => 'required|string',
            'dateOfFundRelease' => 'required|date',
            'fundAmount' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
            'expectedOutputs' => 'required|array',
            'equipmentDetails' => 'required|array',
            'nonEquipmentDetails' => 'required|array',
            'action' => 'required|in:DraftForm,SubmitForm',
            'application_id' => 'required|numeric',
            'business_id' => 'required|numeric',
        ]);
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
                    return $this->submitProjectProposal($validated['application_id'], $proposalData);
                    break;
                case 'DraftForm':
                    return $this->draftProjectProposal($validated['application_id'], $proposalData);
                    break;
            }
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->getDraftedData($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

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

    protected function submitProjectProposal($ApplicationID, $proposalData)
    {
         // Format fund amount and calculate actual fund to be refunded
    $fundAmount = str_replace(',', '', $proposalData['fundAmount']);
    $fundAmountFormatted = number_format($fundAmount, 2, '.', '');
    $actualFundToRefund = number_format($fundAmountFormatted * 1.05, 2, '.', ''); // Includes the 5% addition

    // Find the project proposal
    // $ProjectProposal = ProjectProposal::where('application_id', $ApplicationID)->first();

    // if (!$ProjectProposal) {
    //     return response()->json(['error' => 'Project Proposal not found'], 404);
    // }

    // Begin a transaction for database consistency
    DB::beginTransaction();

    try {
        // Update submission status
        // $ProjectProposal->update(['Submission_status' => 'Submitted']);

        // Create or update ProjectInfo
      $ProposalInfo = ProjectInfo::updateOrCreate(
            ['Project_id' => $proposalData['projectID']],
            [
                'business_id' => $proposalData['business_id'],
                'evaluated_by_id' => $proposalData['staffId'],
                'project_title' => $proposalData['projectTitle'],
                'fund_amount' => $fundAmountFormatted,
                'actual_amount_to_be_refund' => $actualFundToRefund,
            ]
        );

        // Update ApplicationInfo
        ApplicationInfo::where('business_id', $proposalData['business_id'])
            ->update([
                'Project_id' => $proposalData['projectID'],
                'application_status' => 'pending',
            ]);


            DB::commit();
            $Admin = User::where('role', 'Admin')->first();
            $notification = new ProjectProposalNotification($ProposalInfo);
            $Admin->notify($notification);


        return response()->json(['success' => 'true', 'message' => 'Project Proposal Submitted'], 200);

    } catch (\Exception $e) {
        // Rollback transaction if something goes wrong
        DB::rollBack();
        return response()->json(['error' => $e->getMessage()], 500);
    }

    }

    protected function draftProjectProposal($ApplicationID, $proposalData)
    {
        try{
            ProjectProposal::updateOrCreate(
               ['application_id' => $ApplicationID],
               [
                 'data' => json_encode($proposalData),
                 'Submission_status' => 'Draft'
               ]);

            return response()->json(['success' => 'true', 'message' => 'Project Proposal Drafted'], 200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    protected function getDraftedData($ApplicationID)
    {
        $draftedData = ProjectProposal::where('Submission_status', 'Draft')
            ->where('application_id', '=', $ApplicationID)
            ->first();

        $data =json_decode($draftedData->data, true);
            return $data;
    }
}
