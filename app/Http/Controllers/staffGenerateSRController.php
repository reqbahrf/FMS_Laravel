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

        $html = view('staffView.outputs.StatusReport', $ValidatedData)->render();
        $DocHeader = view('staffView.outputs.DocHeader')->render();
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'margin_top' => 35,
            'margin_bottom' => 5,
            'margin_left' => 5,
            'margin_right' => 5
        ]);
        $mpdf->SetHTMLHeader($DocHeader);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->WriteHTML($html, 0);
        return response($mpdf->Output('SRsample.pdf', 'S'), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="SRsample.pdf"',
        ]);

    }
}
