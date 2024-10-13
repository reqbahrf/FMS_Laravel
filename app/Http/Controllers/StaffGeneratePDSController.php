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

        $html = view('staffView.outputs.ProjectDataSheet', $validatedData)->render();
        $DocHeader = view('staffView.outputs.DocHeader')->render();
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'margin_top' => 20,
            'margin_bottom' => 5,
            'margin_left' => 5,
            'margin_right' => 5
        ]);
        $mpdf->SetHTMLHeader($DocHeader);
        $mpdf->WriteHTML($html);

        return response($mpdf->Output('PDSsample.pdf', 'S'), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="PDSsample.pdf"',
        ]);
    }
}
