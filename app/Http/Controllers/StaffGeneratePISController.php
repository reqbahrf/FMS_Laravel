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
            'margin_top' => 2,
            'margin_bottom' => 2,
            'margin_left' => 2,
            'margin_right' => 2,
            'tempDir' => storage_path('app/mpdf'), // Use a custom temporary directory
        ]);

        $mpdf->WriteHTML($html);
        $mpdf->Output('hello.pdf', 'D'); // Download the PDF with the filename hello.pdf

    }

}
