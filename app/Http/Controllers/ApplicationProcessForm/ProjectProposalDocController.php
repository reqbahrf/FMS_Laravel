<?php

namespace App\Http\Controllers\ApplicationProcessForm;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;


class ProjectProposalDocController extends Controller
{
    //TODO : Add service and Data handling logic based on the submitter Business_id
    public function getProjectProposalForm(Request $request){
        try{
            return view('components.project-proposal-form.main');
        }catch(Exception $e){
            Log::error('Error in getProjectProposalForm: ', [$e->getMessage()]);
        }
    }
}
