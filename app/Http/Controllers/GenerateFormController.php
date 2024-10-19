<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectInfo;

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

                return view('staffView.SheetFormTemplete.PISFormTemplete', compact('projectData'));
                break;

            case 'PDS':
                $projectData = $this->getProjectDataSheetData($projectId, $quarter);

                $quarterlyData = $projectData->quarterlyReport->first()->report_file;

                return view('staffView.SheetFormTemplete.PDSFormTemplete', compact('projectData', 'quarterlyData'));
                break;
            case 'SR':
                return view('staffView.SheetFormTemplete.SRForm');
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

    private function getProjectDataSheetData(string $projectId, string $quarter): object
    {
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
            ->with(['quarterlyReport' => function ($query) use ($quarter) {
                $query->select('ongoing_project_id', 'quarter', 'report_file')
                    ->where('quarter',  $quarter);
            }])
            ->where('project_info.Project_id', $projectId)
            ->firstOrFail();
    }
}
