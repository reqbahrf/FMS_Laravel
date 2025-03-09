<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\ProjectForm;

use Exception;
use Mpdf\Mpdf;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Actions\GeneratePDFAction;
use App\Http\Controllers\Controller;
use App\Actions\GenerateEsignElement;
use App\Http\Requests\GenerateSRRequest;
use App\Services\StatusReportDataHandlerService;
use Symfony\Component\HttpFoundation\StreamedResponse;


class SRDocController extends Controller
{
    public function __construct(
        private StatusReportDataHandlerService $statusReportDataHandlerService
    ) {}
    public function createSRData(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'project_id' => 'required|exists:project_info,Project_id',
                'application_id' => 'required|exists:application_info,id',
                'business_id' => 'required|exists:business_info,id',
                'for_year' => 'required|date_format:Y',
            ]);

            $this->statusReportDataHandlerService->initializeStatusReportData(
                $validated['project_id'],
                $validated['for_year'],
                $validated['business_id'],
                $validated['application_id'],
            );

            return response()->json(['message' => 'Project Status Report form created successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function getAllYearsRecords(Request $request)
    {
        try {
            $projectId = $request->projectId;
            $businessId = $request->businessId;
            $applicationId = $request->applicationId;

            $yearRecords = $this->statusReportDataHandlerService->getAllProjectStatusRepordSheetYear(
                $projectId,
                $businessId,
                $applicationId
            );

            return response()->json($yearRecords, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error getting all years records ' . $e->getMessage()], 500);
        }
    }

    public function getProjectStatusReportForm(Request $request)
    {
        try {
            $action = $request->action;
            $projectId = $request->projectId;
            $applicationId = $request->applicationId;
            $businessId = $request->businessId;
            $forYear = $request->forYear;
            $projectStatusReportData = $this->statusReportDataHandlerService
                ->getStatusReportSheetData(
                    $projectId,
                    $forYear,
                    $businessId,
                    $applicationId
                );
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
            return view('components.project-status-report-sheet.main', compact('projectStatusReportData', 'isEditable'));
        } catch (Exception $e) {
            return response()->json(['message' => 'Error getting project status report form ' . $e->getMessage()], 500);
        }
    }
    public function getExportSR(
        Request $request,
        GeneratePDFAction $generatePDFAction
    ): JsonResponse | StreamedResponse {
        try {
            $projectId = $request->projectId;
            $applicationId = $request->applicationId;
            $businessId = $request->businessId;
            $forYear = $request->forYear;
            try {
                $projectStatusReportData = $this->statusReportDataHandlerService
                    ->getStatusReportSheetData(
                        $projectId,
                        $forYear,
                        $businessId,
                        $applicationId
                    );
                $isEditable = false;
                $html = view('project-forms.status-report-sheet', compact('projectStatusReportData', 'isEditable'))->render();
            } catch (Exception $e) {
                return response()->json([
                    'message' => 'Error generating report template',
                    'error' => $e->getMessage()
                ], 500);
            }
            try {
                return $generatePDFAction->execute('Status Report', $html, true, [
                    'margin_top' => 35,
                    'margin_left' => 0,
                    'margin_right' => 0,
                    'margin_bottom' => 20.4,
                ]);
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

    public function setStatusReportData(
        GenerateSRRequest $request,
        StatusReportDataHandlerService $statusReportDataHandlerService
    ): JsonResponse {
        try {
            $validatedData = $request->validated();
            $projectId = $request->projectId;
            $businessId = $request->businessId;
            $applicationId = $request->applicationId;
            $forYear = $request->forYear;

            $statusReportDataHandlerService->setStatusReportData(
                $validatedData,
                $projectId,
                $forYear,
                $businessId,
                $applicationId
            );

            return response()->json([
                'message' => 'Project Status Report data set successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred: ' . $e->getMessage()
            ], 500);
        }
    }
}
