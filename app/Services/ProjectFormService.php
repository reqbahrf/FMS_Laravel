<?php

namespace App\Services;

use Exception;
use App\Models\ProjectInfo;
use Illuminate\Support\Facades\Log;
use App\Actions\GetPreviousQuarterAction;


class ProjectFormService
{


    public function __construct(private GetPreviousQuarterAction $getPreviousQuarterService)
    {
        $this->getPreviousQuarterService = $getPreviousQuarterService;
    }
    public function getProjectInfomationSheetData(string $projectId): object
    {
        try {
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
                'sex',
                'birth_date',
                'mobile_number',
                'landline',
                'email'
            )
                ->join('business_info', 'project_info.business_id', '=', 'business_info.id')
                ->join('coop_users_info', 'coop_users_info.id', '=', 'business_info.user_info_id')
                ->join('users', 'users.user_name', '=', 'coop_users_info.user_name')
                ->where('project_info.Project_id', $projectId)
                ->first();
        } catch (Exception $e) {
            Log::error('Error in getProjectInfomationSheetData: ' . $e->getMessage(), [
                'projectId' => $projectId
            ]);
            throw new Exception('Failed to retrieve project information sheet data: ' . $e->getMessage());
        }
    }

    public function getProjectDataSheetData(string $projectId, string $quarter): object
    {
        try {
            $previousQuarter = $this->getPreviousQuarterService->execute($quarter);

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
            Log::error('Error in getProjectDataSheetData: ' . $e->getMessage(), [
                'projectId' => $projectId,
                'quarter' => $quarter
            ]);
            throw new Exception('Failed to retrieve project data sheet data: ' . $e->getMessage());
        }
    }
}
