<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeneratePISRequest;
use Mpdf\Mpdf;
use Exception;

class StaffGeneratePISController extends Controller
{
    public function index(GeneratePISRequest $request)
    {
        try {
            $validatedData = $request->validated();

            try {
                $html = view('StaffView.outputs.ProjectInformationSheet', $validatedData)->render();
                $DocHeader = view('StaffView.outputs.DocHeader')->render();
            } catch (Exception $e) {
                return response()->json([
                    'message' => 'Error generating information sheet template',
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
                $mpdf->WriteHTML($html);

                return response($mpdf->Output('PISsample.pdf', 'S'), 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'attachment; filename="PISsample.pdf"',
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
