<?php

namespace App\Http\Controllers;

use App\Services\TNAdataHandlerService;
use Exception;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class TestPDFGeneration extends Controller
{
    public function generatePDF(TNAdataHandlerService $TNA)
    {
        try {
            $TNAdata = $TNA->getTNAData(367, 356, 'tna_form');
            $DocHeader = view('staff-view.outputs.DocHeader')->render();
            $html = view('Forms.TNA', ['TNAdata' => $TNAdata])->render();

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

            $mpdf->Output('TNA-document' . date('Y-m-d') . '.pdf', 'I');
            return;
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }


    }
}
