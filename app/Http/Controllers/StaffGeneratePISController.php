<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeneratePISRequest;
use Mpdf\Mpdf;

class StaffGeneratePISController extends Controller
{
    //TODO: Provide more values for this PIS sheet
    public function index(GeneratePISRequest $request)
    {


        $validated = $request->validated();

        $PISdata = [
            'projectTitle' => $validated['projectTitle'],
            'firmName' => $validated['firmName'],
            'name' => $validated['name'],
            'gender' => $validated['gender'],
            'age' => $validated['age'],
            'typeOfOrganization' => $validated['typeOfOrganization'],
            'businessAddress' => $validated['businessAddress'],
            'landline' => $validated['landline'],
            'fax' => $validated['fax'],
            'mobile_phone' => $validated['mobile_phone'],
            'email' => $validated['email'],
        ];

        // TODO: change some of the content text alignment on this view InformationSheet
        $html = view('staffView.outputs.InformationSheetTable', compact('PISdata'))->render();
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
        $mpdf->Output('hello.pdf', 'D');

    }

}
