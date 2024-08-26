<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;

class StaffGeneratePISController extends Controller
{

    public function index(Request $request)
    {
       $samplePDF = view('staffView.outputs.InformationSheetTable')->render();

       Browsershot::html($samplePDF)
            ->format('A4')
            ->save(public_path('pis.pdf'));

            return response()->download(public_path('pis.pdf'));
    }
}
