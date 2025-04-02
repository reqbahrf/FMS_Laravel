<?php

namespace App\Http\Controllers\ApplicationProcessForm;

use Exception;
use Illuminate\Http\Request;
use App\Actions\GeneratePDFAction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\TNAFormRequest;
use App\Services\TNAdataHandlerService;

class TNADocController extends Controller
{
    public function __construct(private TNAdataHandlerService $TNAservice) {}

    public function getTNAFormStatus(Request $request)
    {
        try {
            $business_id = $request->business_id;
            $application_id = $request->application_id;
            $TNAStatus = $this->TNAservice->getTNAStatus($business_id, $application_id);
            return response()->json($TNAStatus, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error retrieving TNA status'], 500);
        }
    }

    public function getTNAForm(Request $request)
    {
        try {
            $action = $request->action;
            $business_id = $request->business_id;
            $application_id = $request->application_id;
            $TNAdata = $this->TNAservice->getTNAData($business_id, $application_id);
            switch ($action) {
                case 'view':
                    $isEditable = false;
                    break;

                case 'edit':
                    $isEditable = true;
                    break;
                default:
                    throw new Exception('Invalid action');
                    break;
            }

            return view('components.t-n-a-form.main', compact('TNAdata', 'isEditable'));
        } catch (\Exception $e) {
            Log::error('Error retrieving TNA data', [
                'business_id' => $business_id,
                'error' => $e->getMessage()
            ]);
            return response()->json(['message' => 'Error retrieving TNA data'], 500);
        }
    }

    public function setTNAForm(TNAFormRequest $request)
    {
        try {
            $validated = $request->validated();

            DB::transaction(function () use ($validated, $request) {
                $this->TNAservice->setTNAData(
                    $validated,
                    $request->business_id,
                    $request->application_id,
                    $request->user(),
                );
            });

            return response()->json(['message' => 'TNA data set successfully'], 200);
        } catch (Exception $e) {
            Log::error('Error setting TNA data', [
                'business_id' => $request->business_id,
                'error' => $e->getMessage()
            ]);
            return response()->json(['error' => 'Error setting TNA data' . $e->getMessage()], 500);
        }
    }
    public function exportTNAFormToPDF(Request $request, GeneratePDFAction $generatePDF)
    {
        try {
            $business_id = $request->business_id;
            $application_id = $request->application_id;
            $TNAdata = $this->TNAservice->getTNAData($business_id, $application_id);

            if (!$TNAdata) {
                throw new Exception('TNA Data not found');
            }

            $htmlForm = view('application-process-forms.TNA', ['TNAdata' => $TNAdata, 'isEditable' => false])->render();
            return $generatePDF->execute('TNA form', $htmlForm, false);
        } catch (Exception $e) {
            Log::error('Error export TNA data', [
                'business_id' => $request->business_id,
                'error' => $e->getMessage()
            ]);
            return response()->json(['error' => 'Error export TNA data' . $e->getMessage()], 500);
        }
    }
}
