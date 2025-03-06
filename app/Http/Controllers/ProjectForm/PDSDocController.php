<?php

namespace App\Http\Controllers\ProjectForm;

use Exception;
use Mpdf\Mpdf;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Actions\GeneratePDFAction;
use App\Http\Controllers\Controller;
use App\Actions\GenerateEsignElement;
use App\Http\Requests\GeneratePDSRequest;
use App\Services\ProjectDataSheetDataHandlerService;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PDSDocController extends Controller
{
    public function __construct(
        private ProjectDataSheetDataHandlerService $projectDataSheetDataHandlerService
    ) {}
    public function getPDFDocument(
        Request $request,
        GeneratePDFAction $generatePDFAction
    ): JsonResponse | StreamedResponse {
        try {
            $validatedData = $request->validate([
                'projectId' => 'required|string|exists:project_info,Project_id',
                'quarter' => 'required|string',
            ]);

            $project_id = $validatedData['projectId'];
            $quarter = $validatedData['quarter'];
            $reportData = $this->projectDataSheetDataHandlerService->getCooperatorReportedData($project_id, $quarter);
            $currentQuarter = $reportData->currentQuarterReport->report_file;
            $previousQuarter = $reportData->previousQuarterReport->report_file;
            $reportData = $reportData->report_file;

            try {
                $html = view('components.project-data-sheet.main', compact('reportData', 'currentQuarter', 'previousQuarter'))->render();
            } catch (Exception $e) {
                return response()->json([
                    'message' => 'Error generating project data sheet template',
                    'error' => $e->getMessage()
                ], 500);
            }

            try {
                return $generatePDFAction->execute('Project Data Sheet', $html, true);
            } catch (\Mpdf\MpdfException $e) {
                return response()->json([
                    'message' => 'Error generating PDF',
                    'error' => $e->getMessage()
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getProjectDataSheetForm(Request $request)
    {
        try {
            $projectId = $request->projectId;
            $quarter = $request->quarter;

            $reportData = $this->projectDataSheetDataHandlerService->getCooperatorReportedData($projectId, $quarter);
            $currentQuarter = $reportData->currentQuarterlyReport->first()->report_file;
            $previousQuarter = $reportData->previousQuarterlyReport->first()->report_file;

            return view('components.project-data-sheet.main', compact('reportData', 'currentQuarter', 'previousQuarter', 'projectId', 'quarter'));
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getQuarterlyReportfor(Request $request)
    {
        try {
            $reportId = $request->id;
            $projectId = $request->projectId;
            $quarter = $request->quarter;
            $reportStatus = $request->reportStatus;
            $reportSubmitted = $request->reportSubmitted;
            $isEditable = $request->header('X-ACTION_MODE') == 'edit' ? true : false;

            $Data = $this->projectDataSheetDataHandlerService->getQuaterlyReportData($reportId, $projectId, $quarter);

            $reportData = $Data->report_file;

            return view('components.reported-quarterly-form-data.main', compact('reportId', 'projectId', 'quarter', 'reportStatus', 'reportData', 'isEditable'));
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred ' . $e->getMessage(),
            ], 500);
        }
    }

    public function setPDSData(
        GeneratePDSRequest $request,
        ProjectDataSheetDataHandlerService $projectDataSheetDataHandlerService
    ): JsonResponse {
        try {
            $validatedData = $request->validated();

            $projectDataSheetDataHandlerService->setProjectDataSheetData(
                $validatedData,
                $validatedData['quarter'],
                $validatedData['project_info_id'],
                $validatedData['business_info_id'],
                $validatedData['application_info_id']
            );

            return response()->json([
                'message' => 'Project Data Sheet data set successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
}
