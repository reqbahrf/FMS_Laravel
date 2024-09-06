<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeneratePISRequest;
use Mpdf\Mpdf;

class StaffGeneratePISController extends Controller
{
    //TODO: Provide more values for this PIS sheet
    public function index(GeneratePISRequest $request)
    {


        $validatedData = $request->validated();


        // TODO: change some of the content text alignment on this view InformationSheet
        $html = view('staffView.outputs.InformationSheetTable', $validatedData)->render();
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
        return response($mpdf->Output('PISsample.pdf', 'S'), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="PISsample.pdf"',
        ]);


    }

}
