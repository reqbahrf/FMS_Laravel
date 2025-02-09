<?php

namespace App\Http\Controllers;

use Exception;
use Mpdf\Mpdf;
use Illuminate\Http\Request;
use App\Actions\GenerateEsignElement;
use App\Http\Requests\GenerateSRRequest;

class staffGenerateSRController extends Controller
{
    public function index(GenerateSRRequest $request, GenerateEsignElement $generateEsignElement)
    {
        try {
            $ValidatedData = $request->validated();
            $esignatureElement = $generateEsignElement->execute($ValidatedData['signatures']);

            try {
                $html = view('staff-view.outputs.StatusReport', [...$ValidatedData, 'esignatureElement' => $esignatureElement])->render();
                $DocHeader = view('staff-view.outputs.DocHeader')->render();
            } catch (Exception $e) {
                return response()->json([
                    'message' => 'Error generating report template',
                    'error' => $e->getMessage()
                ], 500);
            }

            try {
                $mpdf = new Mpdf([
                    'mode' => 'utf-8',
                    'format' => 'A4',
                    'orientation' => 'P',
                    'margin_top' => 35,
                    'margin_left' => 10,
                    'margin_right' => 10,
                    'margin_bottom' => 10,
                    'default_font_size' => 9,
                    'default_font' => 'arial'
                ]);
                $mpdf->SetHTMLHeader($DocHeader);
                $mpdf->WriteHTML($html, 0);

                $mpdf->Output('SR-document-' . date('Y-m-d') . '.pdf', 'I');
                return;
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
}
