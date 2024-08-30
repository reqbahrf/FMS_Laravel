<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeneratePDSRequest;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class StaffGeneratePDSController extends Controller
{
    public function index(GeneratePDSRequest $request)
    {
       $validatedData = $request->validated();

        $html = view('staffView.outputs.DataSheetTable', $validatedData)->render();
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
        $mpdf->Output('PDSsample.pdf', 'D');
    }
}
