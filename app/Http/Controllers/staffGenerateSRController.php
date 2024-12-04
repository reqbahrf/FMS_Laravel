<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateSRRequest;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Exception;

class staffGenerateSRController extends Controller
{
    public function index(GenerateSRRequest $request)
    {
        try {
            $ValidatedData = $request->validated();

            try {
                $html = view('StaffView.outputs.StatusReport', $ValidatedData)->render();
                $DocHeader = view('StaffView.outputs.DocHeader')->render();
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

                return response($mpdf->Output('SRsample.pdf', 'S'), 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="SRsample.pdf"',
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
}
