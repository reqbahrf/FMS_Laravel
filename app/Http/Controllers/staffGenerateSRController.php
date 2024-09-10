<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mpdf\Mpdf;

class staffGenerateSRController extends Controller
{
    public function index(Request $request)
    {
        $html = view('staffView.outputs.StatusReport')->render();
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
        ]);

        $mpdf->WriteHTML($html);
        return response($mpdf->Output('SRsample.pdf', 'D'));

    }
}
