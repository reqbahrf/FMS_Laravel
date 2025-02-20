<?php

namespace App\Http\Controllers\ApplicationProcessForm;

use Exception;
use Illuminate\Http\Request;
use App\Models\ApplicationForm;
use App\Http\Controllers\Controller;

class GetProjectFormListController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $projectInfo = ApplicationForm::where('application_id', $request->application_id)
                ->where('business_id', $request->business_id)
                ->select(['key', 'created_at', 'updated_at'])
                ->get();

            return response()->json($projectInfo, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to get project form list: ' . $e->getMessage()], 500);
        }
    }
}
