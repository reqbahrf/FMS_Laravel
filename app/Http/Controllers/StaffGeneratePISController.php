<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Mpdf\Mpdf;

class StaffGeneratePISController extends Controller
{

    public function index(Request $request)
    {
        $html = view('staffView.outputs.InformationSheetTable')->render();
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'margin_top' => 5,
            'margin_bottom' => 5,
            'margin_left' => 5,
            'margin_right' => 5
        ]);
        $mpdf->WriteHTML($html);
        $mpdf->Output('hello.pdf', 'D'); // Download the PDF with the filename hello.pdf

    }

}
