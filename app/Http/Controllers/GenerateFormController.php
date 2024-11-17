<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\ProjectInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GenerateFormController extends Controller
{
    public function getProjectSheetsForm(Request $request, $type, $projectId, $quarter = null)
    {
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
                $projectData = $this->getProjectInfomationSheetData($projectId);

                return view('StaffView.SheetFormTemplete.PISFormTemplete', compact('projectData'));
                break;

            case 'PDS':
                $projectData = $quarter ? $this->getProjectDataSheetData($projectId, $quarter) : null;

                $CurrentQuarterlyData = $quarter ? $projectData->quarterlyReport->first()->report_file : null;
                $PreviousQuarterlyData = $quarter ? $projectData->previousQuarterlyReport->first()->report_file : null;

                $CurrentQuarterlyData = $quarter ? array_merge(['quarter' => $quarter], $CurrentQuarterlyData) : null;
                $PreviousQuarterlyData = $PreviousQuarterlyData != null
                    ? array_merge(['quarter' => $this->getPreviousQuarter($quarter)], $PreviousQuarterlyData)
                    : null;

                return view('StaffView.SheetFormTemplete.PDSFormTemplete', compact('projectData', 'CurrentQuarterlyData', 'PreviousQuarterlyData'));
                break;
            case 'SR':
                return view('StaffView.SheetFormTemplete.SRForm');
                break;
        }
    }

    private function getProjectInfomationSheetData(string $projectId): object
    {
        return ProjectInfo::select(
            'Project_id',
            'project_title',
            'business_id',
            'firm_name',
            'enterprise_type',
            'zip_code',
            'landMark',
            'barangay',
            'city',
            'province',
            'region',
            'f_name',
            'mid_name',
            'l_name',
            'suffix',
            'gender',
            'birth_date',
            'mobile_number',
            'landline',
            'email'
        )
            ->join('business_info', 'project_info.business_id', '=', 'business_info.id')
            ->join('coop_users_info', 'coop_users_info.id', '=', 'business_info.user_info_id')
            ->join('users', 'users.user_name', '=', 'coop_users_info.user_name')
            ->where('project_info.Project_id', $projectId)
            ->firstOrFail();
    }

    private function getProjectDataSheetData(string $projectId, string $quarter = null): object
    {
        try {
            $previousQuarter = $quarter ? $this->getPreviousQuarter($quarter) : null;

            return ProjectInfo::select(
                'project_info.Project_id',
                'project_info.project_title',
                'business_info.firm_name',
                'business_info.landMark',
                'business_info.barangay',
                'business_info.city',
                'business_info.province',
                'business_info.region',
                'business_info.zip_code',
                'coop_users_info.f_name',
                'coop_users_info.mid_name',
                'coop_users_info.l_name',
                'coop_users_info.suffix',
                'coop_users_info.designation',
                'coop_users_info.landline',
                'coop_users_info.mobile_number',
                'users.email'
            )
                ->join('business_info', 'project_info.business_id', '=', 'business_info.id')
                ->join('coop_users_info', 'coop_users_info.id', '=', 'business_info.user_info_id')
                ->join('users', 'users.user_name', '=', 'coop_users_info.user_name')
                ->with([
                    'quarterlyReport' => function ($query) use ($quarter) {
                        $query->select('ongoing_project_id', 'quarter', 'report_file')
                            ->where('quarter',  $quarter);
                    },
                    'previousQuarterlyReport' => function ($query) use ($previousQuarter) {
                        $query->select('ongoing_project_id', 'quarter', 'report_file')
                            ->where('quarter',  $previousQuarter);
                    }
                ])
                ->where('project_info.Project_id', $projectId)
                ->firstOrFail();
        } catch (Exception $e) {
           Log::info($e);
        }
    }

    protected function getPreviousQuarter(String $quarter): string
    {
        list($currentQuarter, $currentYear) = explode(' ', $quarter);
        $currentQuarterNumber = (int) substr($currentQuarter, 1);
        $previousQuarterNumber = $currentQuarterNumber - 1;
        $previousYear = $currentYear;

        if ($previousQuarterNumber < 1) {
            $previousQuarterNumber = 4;
            $previousYear -= 1;
        }
        return "Q{$previousQuarterNumber} {$previousYear}";
    }
}
