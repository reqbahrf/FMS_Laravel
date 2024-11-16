<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\ProjectInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProjectLedgerController extends Controller
{
    public function index($Project_id)
    {
        $validated = validator::make(
            ['Project_id' => $Project_id],
            ['Project_id' => 'required|string'])->validate();
        try {

            $projectLedger = ProjectInfo::where('Project_id', $validated['Project_id'])->select('project_ledger_link')->first();

            if(!$projectLedger) {
                return response()->json(['message' => 'No project ledger found'], 404);
            }
            return response()->json($projectLedger, 200);

        } catch (Exception $e) {
            Log::error('Error fetching project ledger: ' . $e->getMessage());
            return response()->json(['message' => 'Error fetching project ledger'], 500);
        }
    }

    public function saveOrupdate(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|string',
            'project_ledger_link' => 'required|url:http,https',
        ]);

        try {
            ProjectInfo::updateOrCreate(
                ['Project_id' => $validated['project_id']],
                ['project_ledger_link' => $validated['project_ledger_link']]
            );
            return response()->json(['success' => true, 'message' => 'Project ledger link updated successfully'], 200);

        } catch (Exception $e) {
            Log::error('Error updating project ledger: ' . $e->getMessage());
            return response()->json(['message' => 'Error updating project ledger'], 500);
        }
    }
}
