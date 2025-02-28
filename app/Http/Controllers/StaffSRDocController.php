<?php

namespace App\Http\Controllers;

use Exception;
use Mpdf\Mpdf;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Actions\GeneratePDFAction;
use App\Actions\GenerateEsignElement;
use App\Http\Requests\GenerateSRRequest;
use App\Services\StatusReportDataHandlerService;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StaffSRDocController extends Controller
{
    public function getPDFDocument(
        Request $request,
        GenerateEsignElement $generateEsignElement,
        GeneratePDFAction $generatePDFAction
    ): JsonResponse | StreamedResponse {
        try {
            $ValidatedData = $request->validated();
            $esignatureElement = $generateEsignElement->execute($ValidatedData['signatures']);

            try {
                $html = view('staff-view.outputs.StatusReport', [...$ValidatedData, 'esignatureElement' => $esignatureElement])->render();
            } catch (Exception $e) {
                return response()->json([
                    'message' => 'Error generating report template',
                    'error' => $e->getMessage()
                ], 500);
            }
            try {
                return $generatePDFAction->execute('Status Report', $html, true);
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

    public function setSRData(
        GenerateSRRequest $request,
        StatusReportDataHandlerService $statusReportDataHandlerService
    ): JsonResponse {
        try {
            $validatedData = $request->validated();
            $statusReportDataHandlerService->setStatusReportData(
                $validatedData,
                $validatedData['project_info_id'],
                $validatedData['business_info_id'],
                $validatedData['application_info_id']
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
