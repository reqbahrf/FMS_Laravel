<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateSRRequest;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class staffGenerateSRController extends Controller
{
    public function index(GenerateSRRequest $request)
    {
        $ValidatedData = $request->validated();

        $html = view('StaffView.outputs.StatusReport', $ValidatedData)->render();
        $DocHeader = view('StaffView.outputs.DocHeader')->render();
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
            'Content-Disposition' => 'attachment; filename="SRsample.pdf"',
        ]);
    }
}
