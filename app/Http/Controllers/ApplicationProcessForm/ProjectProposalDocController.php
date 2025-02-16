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
            $action = $request->action;
            $business_id = $request->business_id;
            $application_id = $request->application_id;

            switch($action){
                case 'view':
                    $isEditable = false;
                    break;
                case 'edit':
                    $isEditable = true;
                    break;
                default:
                    throw new Exception('Invalid action');
            }

            return view('components.project-proposal-form.main', compact('isEditable'));
        }catch(Exception $e){
            Log::error('Error in getProjectProposalForm: ', [
                'business_id' => $business_id,
                'error' => $e->getMessage()
            ]);
            return response()->json(['message' => 'Error in getProjectProposalForm: ' + $e->getMessage()], 500);
        }
    }
}
