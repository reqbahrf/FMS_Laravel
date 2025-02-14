<?php

namespace App\Http\Controllers\ApplicationProcessForm;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class RTECReportDocController extends Controller
{
    public function getRTECReportForm(Request $request)
    {
        try{
            return view('components.rtec-report-form.main');
        }catch(Exception $e){
            Log::error('Error in getRTECReportForm: ', [$e->getMessage()]);
        }

    }
}
