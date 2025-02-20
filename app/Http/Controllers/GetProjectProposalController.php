<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessInfo;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Log;

class GetProjectProposalController extends Controller
{

    //TODO: deprecated this controller
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $business_id, $project_id)
    {

        $validator = Validator::make(['business_id' => $business_id, 'project_id' => $project_id], [
            'business_id' => 'required|integer',
            'project_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid parameters'], 400);
        }

        $ValidatedInfo = $validator->validated();
        $business_id = $ValidatedInfo['business_id'];
        $project_id = $ValidatedInfo['project_id'];

        try {

            $projectProposal = BusinessInfo::select([
                'project_info.actual_amount_to_be_refund as To_Be_Refunded',
                'application_info.created_at as date_applied',
                'org_users_info.prefix',
                'org_users_info.f_name',
                'org_users_info.mid_name',
                'org_users_info.l_name',
                'org_users_info.suffix',
            ])
                ->join('project_info', 'project_info.business_id', '=', 'business_info.id')
                ->join('org_users_info', 'project_info.evaluated_by_id', '=', 'org_users_info.id')
                ->join('application_info', 'application_info.business_id', '=', 'business_info.id')
                ->where('application_info.application_status', 'pending')
                ->where('business_info.id', '=',   $business_id)
                ->where('project_info.Project_id', '=',  $project_id)
                ->first();

            return response()->json($projectProposal, 200);
        } catch (Exception $e) {
            Log::error('Error retrieving project proposal: ' . $e->getMessage());

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
