<?php

namespace App\Http\Controllers\ProjectForm;

use Exception;
use Mpdf\Mpdf;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Actions\GeneratePDFAction;
use App\Http\Controllers\Controller;
use App\Actions\GenerateEsignElement;
use App\Http\Requests\GeneratePISRequest;
use App\Services\ProjectInfoSheetDataHandlerService;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PISDocController extends Controller
{
    public function __construct(
        private ProjectInfoSheetDataHandlerService $projectInfoSheetDataHandlerService
    ) {}
    public function createPISData(Request $request)
    {
        try {
            $validated = $request->validate([
                'project_id' => 'required|exists:project_info,Project_id',
                'application_id' => 'required|exists:application_info,id',
                'business_id' => 'required|exists:business_info,id',
                'for_year' => 'required|date_format:Y',
            ]);

            $this->projectInfoSheetDataHandlerService->initializeProjectInfoSheetData(
                $validated['project_id'],
                $validated['for_year'],
                $validated['business_id'],
                $validated['application_id'],
            );

            return response()->json(['message' => 'Project Information Sheet form created successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error creating Project Information Sheet form ' . $e->getMessage()], 500);
        }
    }

    public function getAllYearsRecords(Request $request)
    {
        try {
            $projectId = $request->projectId;
            $businessId = $request->businessId;
            $applicationId = $request->applicationId;

            $yearRecords = $this->projectInfoSheetDataHandlerService->getAllProjectInfoSheetYear(
                $projectId,
                $businessId,
                $applicationId
            );

            return response()->json($yearRecords, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error getting all years records ' . $e->getMessage()], 500);
        }
    }
    public function getProjectInfoSheetForm(Request $request)
    {
        try {
            $action = $request->action;
            $projectId = $request->projectId;
            $applicationId = $request->applicationId;
            $businessId = $request->businessId;
            $forYear = $request->forYear;
            $projectInfoSheetData = $this->projectInfoSheetDataHandlerService
                ->getProjectInfoSheetData(
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
            return view('components.project-info-sheet.main', compact('projectInfoSheetData', 'isEditable'));
        } catch (Exception $e) {
            return response()->json(['message' => 'Error retrieving Project Information Sheet form' . $e->getMessage()], 500);
        }
    }
    public function getExportPIS(
        Request $request,
        GeneratePDFAction $generatePDFAction
    ): JsonResponse | StreamedResponse {
        try {
            $projectId = $request->projectId;
            $applicationId = $request->applicationId;
            $businessId = $request->businessId;
            $forYear = $request->forYear;

            $projectInfoSheetData = $this->projectInfoSheetDataHandlerService
                ->getProjectInfoSheetData(
                    $projectId,
                    $forYear,
                    $businessId,
                    $applicationId
                );

            try {
                $html = view('project-forms.Project-infomation-sheet', compact('projectInfoSheetData'))->render();
            } catch (Exception $e) {
                return response()->json([
                    'message' => 'Error generating information sheet template',
                    'error' => $e->getMessage()
                ], 500);
            }

            try {
                return $generatePDFAction->execute('Project Information Sheet', $html, true);
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

    public function setPISData(
        GeneratePISRequest $request,
        ProjectInfoSheetDataHandlerService $projectInfoSheetDataHandlerService
    ): JsonResponse {
        try {
            $validatedData = $request->validated();
            $projectId = $request->projectId;
            $businessId = $request->businessId;
            $applicationId = $request->applicationId;
            $forYear = $request->forYear;
            $projectInfoSheetDataHandlerService->setProjectInfoSheetData(
                $validatedData,
                $projectId,
                $forYear,
                $businessId,
                $applicationId
            );

            return response()->json([
                'message' => 'Project Information Sheet data set successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred: ' . $e->getMessage()
            ], 500);
        }
    }
}
