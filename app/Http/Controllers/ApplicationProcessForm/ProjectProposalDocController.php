<?php

namespace App\Http\Controllers\ApplicationProcessForm;

use Exception;
use Illuminate\Http\Request;
use App\Actions\GeneratePDFAction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectProposalRequest;
use App\Services\ProjectProposaldataHandlerService;

class ProjectProposalDocController extends Controller
{
    public function __construct(private ProjectProposaldataHandlerService $ProjectProposal)
    {
        $this->ProjectProposal = $ProjectProposal;
    }
    public function getProjectProposalStatus(Request $request)
    {
        try {
            $business_id = $request->business_id;
            $application_id = $request->application_id;
            return $this->ProjectProposal->getProjectProposalStatus($business_id, $application_id);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error in getProjectProposalStatus: ' . $e->getMessage()], 500);
        }
    }
    public function getProjectProposalForm(Request $request)
    {
        try {
            $action = $request->action;
            $business_id = $request->business_id;
            $application_id = $request->application_id;
            $ProjectProposaldata = $this->ProjectProposal->getProjectProposalData($business_id, $application_id);
            switch ($action) {
                case 'view':
                    $isEditable = false;
                    break;
                case 'edit':
                    $isEditable = true;
                    break;
                default:
                    throw new Exception('Invalid action');
            }

            return view('components.project-proposal-form.main', compact('ProjectProposaldata', 'isEditable'));
        } catch (Exception $e) {
            Log::error('Error in getProjectProposalForm: ', [
                'business_id' => $business_id,
                'error' => $e->getMessage()
            ]);
            return response()->json(['message' => 'Error in getProjectProposalForm: ' . $e->getMessage()], 500);
        }
    }

    public function setProjectProposalForm(ProjectProposalRequest $request)
    {
        try {
            $validated = $request->validated();
            DB::transaction(function () use ($validated, $request) {
                $this->ProjectProposal->setProjectProposalData(
                    $validated,
                    $request->user()->orgUserInfo,
                    $request->business_id,
                    $request->application_id
                );
            });

            return response()->json(['message' => 'Project Proposal data set successfully'], 200);
        } catch (Exception $e) {
            Log::error('Error setting Project Proposal data', [
                'business_id' => $request->business_id,
                'error' => $e->getMessage()
            ]);
            return response()->json(['message' => 'Error setting Project Proposal data' . $e->getMessage()], 500);
        }
    }

    public function exportProjectProposalToPDF(Request $request, GeneratePDFAction $generatePDF)
    {
        try {
            $business_id = $request->business_id;
            $application_id = $request->application_id;
            $ProjectProposaldata = $this->ProjectProposal->getProjectProposalData($business_id, $application_id);

            if (!$ProjectProposaldata) {
                throw new Exception('Project Proposal Data not found');
            }

            $htmlForm = view('application-process-forms.Project-proposal', ['ProjectProposaldata' => $ProjectProposaldata, 'isEditable' => false])->render();
            return $generatePDF->execute('Project Proposal form', $htmlForm, true);
        } catch (Exception $e) {
            Log::error('Error export Project Proposal data', [
                'business_id' => $request->business_id,
                'error' => $e->getMessage()
            ]);
            return response()->json(['error' => 'Error export Project Proposal data' . $e->getMessage()], 500);
        }
    }
}
