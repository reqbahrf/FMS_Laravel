<?php

namespace App\Http\Controllers\ApplicationProcessForm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubmissionToAdminController extends Controller
{
    public function __invoke(Request $request){
        $business_id = $request->business_id;
        $application_id = $request->application_id;
    }
}
