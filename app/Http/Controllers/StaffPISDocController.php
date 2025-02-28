<?php

namespace App\Http\Controllers;

use Exception;
use Mpdf\Mpdf;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Actions\GeneratePDFAction;
use App\Actions\GenerateEsignElement;
use App\Http\Requests\GeneratePISRequest;
use App\Services\ProjectInfoSheetDataHandlerService;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StaffPISDocController extends Controller
{
    public function getPDFDocument(
        Request $request,
        GenerateEsignElement $generateEsignElement,
        GeneratePDFAction $generatePDFAction
    ): JsonResponse | StreamedResponse {
        try {
            $validatedData = $request->validated();
            $esignatureElement = $generateEsignElement->execute($validatedData['signatures'], 'left', 1, 'default');

            try {
                $html = view('staff-view.outputs.project-information-sheet', [...$validatedData, 'esignatureElement' => $esignatureElement])->render();
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
            $projectInfoSheetDataHandlerService->setProjectInfoSheetData(
                $validatedData,
                $validatedData['project_info_id'],
                $validatedData['business_info_id'],
                $validatedData['application_info_id']
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
