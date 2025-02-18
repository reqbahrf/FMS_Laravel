<?php

namespace App\Http\Controllers\ApplicationProcessForm;

use Exception;
use Illuminate\Http\Request;
use App\Actions\GeneratePDFAction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\RTECReportdataHandlerService;

class RTECReportDocController extends Controller
{
    public function __construct(private RTECReportdataHandlerService $RTECReportService){}
    public function getRTECReportForm(Request $request)
    {
        try{
            $action = $request->action;
            $business_id = $request->business_id;
            $application_id = $request->application_id;
            $RTECReportdata = $this->RTECReportService->getRTECReportData($business_id, $application_id);

            switch($action){
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

            return view('components.rtec-report-form.main', ['RTECReportdata' => $RTECReportdata, 'isEditable' => $isEditable]);
        }catch(Exception $e){
            Log::error('Error in getRTECReportForm: ', [$e->getMessage()]);
            return response()->json(['message' => 'Error in getRTECReportForm: ' . $e->getMessage()], 500);
        }
    }

    public function setRTECReportForm(Request $request)
    {
        try{
            $validated = $request->validated();
            DB::transaction(function () use ($validated, $request) {
                $this->RTECReportService->setRTECReportData(
                    $validated,
                    $request->business_id,
                    $request->application_id
                );
            });

            return response()->json(['message' => 'RTEC Report data set successfully'], 200);

        }catch(Exception $e){
            Log::error('Error in setRTECReportForm: ', [$e->getMessage()]);
            return response()->json(['error' => 'Error in setRTECReportForm: ' . $e->getMessage()], 500);
        }
    }

    public function exportRTECReportFormToPDF(Request $request, GeneratePDFAction $generatePDF)
    {
        try{
            $business_id = $request->business_id;
            $application_id = $request->application_id;
            $RTECReportdata = $this->RTECReportService->getRTECReportData($business_id, $application_id);

            if (!$RTECReportdata) {
                throw new Exception('RTEC Report Data not found');
            }

            $htmlForm = view('application-process-forms.RTEC-report', ['RTECReportdata' => $RTECReportdata, 'isEditable' => false])->render();
            return $generatePDF->execute('RTECReportForm', $htmlForm);
        }catch(Exception $e){
            Log::error('Error in exportRTECReportFormToPDF: ', [
               'Error' => $e->getMessage()
            ]);
            return response()->json(['error' => 'Error in exportRTECReportFormToPDF: ' . $e->getMessage()], 500);
        }
    }
}
