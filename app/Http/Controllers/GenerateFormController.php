<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\ProjectInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\ProjectFormService;
use App\Actions\GetPreviousQuarterAction;

class GenerateFormController extends Controller
{

    public function __construct(private ProjectFormService $projectFormService, private GetPreviousQuarterAction $getPreviousQuarterAction)
    {
        $this->projectFormService = $projectFormService;
        $this->getPreviousQuarterAction = $getPreviousQuarterAction;

    }
    public function getProjectSheetsForm(Request $request, $type, $projectId, $quarter = null)
    {
        try {
            $rule = [
                'type' => 'required|string|in:PIS,PDS,SR',
                'projectId' => 'required|string|max:15',
                'quarter' => 'nullable'
            ];

            $validated = validator([
                'type' => $type,
                'projectId' => $projectId,
                'quarter' => $quarter,
            ], $rule)->validate();

            $formType = $validated['type'];
            $projectId = $validated['projectId'];
            $quarter = $validated['quarter'];

            switch ($formType) {
                case 'PIS':
                    $projectData = $this->projectFormService->getProjectInfomationSheetData($projectId);
                    return view('StaffView.SheetFormTemplete.PISFormTemplete', compact('projectData'));

                case 'PDS':
                    $projectData = $this->projectFormService->getProjectDataSheetData($projectId, $quarter);
                    $CurrentQuarterlyData = $projectData->quarterlyReport->first()->report_file;
                    $PreviousQuarterlyData = $projectData->previousQuarterlyReport->first()->report_file;

                    $CurrentQuarterlyData = array_merge(['quarter' => $quarter], $CurrentQuarterlyData);
                    $PreviousQuarterlyData = $PreviousQuarterlyData != null
                        ? array_merge(['quarter' => $this->getPreviousQuarterAction->execute($quarter)], $PreviousQuarterlyData)
                        : null;

                    return view('StaffView.SheetFormTemplete.PDSFormTemplete', compact('projectData', 'CurrentQuarterlyData', 'PreviousQuarterlyData'));

                case 'SR':
                    return view('StaffView.SheetFormTemplete.SRForm');

                default:
                    throw new Exception("Invalid form type provided");
            }
        } catch (Exception $e) {
            Log::error('Error in getProjectSheetsForm: ' . $e->getMessage(), [
                'type' => $type,
                'projectId' => $projectId,
                'quarter' => $quarter
            ]);
            return response()->json([
                'error' => 'An error occurred while generating the form',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
