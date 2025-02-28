<?php

namespace App\Http\Controllers;

use Exception;
use Mpdf\Mpdf;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Actions\GeneratePDFAction;
use App\Actions\GenerateEsignElement;
use App\Http\Requests\GeneratePDSRequest;
use App\Services\ProjectDataSheetDataHandlerService;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StaffPDSDocController extends Controller
{
    public function getPDFDocument(
        Request $request,
        GenerateEsignElement $generateEsignElement,
        GeneratePDFAction $generatePDFAction
    ): JsonResponse | StreamedResponse {
        try {
            $validatedData = $request->validated();
            $esignatureElement = $generateEsignElement->execute($validatedData['signatures']);

            try {
                $html = view('staff-view.outputs.ProjectDataSheet', [...$validatedData, 'esignatureElement' => $esignatureElement])->render();
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
