<?php

namespace App\Http\Controllers;

use App\Services\TNAdataHandlerService;
use Illuminate\Http\Request;

class TNADocumentController extends Controller
{
    public function __construct(private TNAdataHandlerService $TNA)
    {
        $this->TNA = $TNA;
    }

    public function getTNAData(Request $request)
    {
        $business_id = $request->business_id;
        $TNAdata = $this->TNA->getTNAData($business_id);
        dd($TNAdata);
        return view('Forms.TNA', compact('TNAdata'));
    }
}
