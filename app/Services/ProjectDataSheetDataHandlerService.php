<?php

namespace App\Services;

use App\Actions\GetPreviousQuarterAction;
use Exception;
use App\Models\ProjectForm;
use App\Models\ProjectInfo;
use App\Models\OngoingQuarterlyReport;

class ProjectDataSheetDataHandlerService
{
    private const PROJECT_DATA_SHEET = 'project_data_sheet';

    public function __construct(
        private ProjectForm $projectDataSheet,
        private GetPreviousQuarterAction $getPreviousQuarter
    ) {}

    public function setProjectDataSheetData(
        array $data,
        string $quarter,
        string $project_info_id,
        int $business_info_id,
        int $application_info_id
    ): void {
        try {
            $existingRecord = $this->projectDataSheet->where([
                'project_info_id' => $project_info_id,
                'business_info_id' => $business_info_id,
                'application_info_id' => $application_info_id,
                'key' => self::PROJECT_DATA_SHEET . '_' . $quarter
            ])->first();

            $mergedData = $existingRecord
                ? array_merge($existingRecord->data, $data)
                : [...$data, 'project_info_id' => $project_info_id, 'business_info_id' => $business_info_id, 'application_info_id' => $application_info_id];

            $this->projectDataSheet->updateOrCreate([
                'project_info_id' => $project_info_id,
                'business_info_id' => $business_info_id,
                'application_info_id' => $application_info_id,
                'key' => self::PROJECT_DATA_SHEET . '_' . $quarter
            ], [
                'data' => $mergedData,
            ]);
        } catch (Exception $e) {
            throw new Exception('Error in setting Project Data Sheet data: ' . $e->getMessage());
        }
    }

    public function getProjectDataSheetData(
        string $project_info_id,
        int $business_info_id,
        int $application_info_id,
        string $quarter
    ): array {
        try {
            $ProjectDataSheet = $this->projectDataSheet->where([
                'project_info_id' => $project_info_id,
                'business_info_id' => $business_info_id,
                'application_info_id' => $application_info_id,
                'key' => self::PROJECT_DATA_SHEET . '_' . $quarter
            ])->first();

            if (!$ProjectDataSheet) {
                $this->initializeProjectDataSheetData($project_info_id, $business_info_id, $application_info_id, $quarter);
                $ProjectDataSheet = $this->projectDataSheet->where([
                    'project_info_id' => $project_info_id,
                    'business_info_id' => $business_info_id,
                    'application_info_id' => $application_info_id,
                    'key' => self::PROJECT_DATA_SHEET . '_' . $quarter
                ])->first();
            }

            return $ProjectDataSheet ? $ProjectDataSheet->data : [];
        } catch (Exception $e) {
            throw new Exception('Error in getting Project Data Sheet data: ' . $e->getMessage());
        }
    }

    public function getQuarterlyReportData(string $reportId, string $projectId, string $quarter): OngoingQuarterlyReport
    {
        try {
            return OngoingQuarterlyReport::where('id', $reportId)
                ->where('ongoing_project_id', $projectId)
                ->where('quarter', $quarter)
                ->select(['report_file'])
                ->first();
        } catch (Exception $e) {
            throw new Exception('Failed to get quarterly report: ' . $e->getMessage());
        }
    }

    public function getCooperatorReportedData(string $projectId, string $quarter): object
    {
        try {
            $previousQuarter = $this->getPreviousQuarter->execute($quarter);

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
                ->where('project_info.Project_id', $projectId)
                ->with([
                    'currentQuarterlyReport' => function ($query) use ($quarter) {
                        $query->select('ongoing_project_id', 'quarter', 'report_file')
                            ->where('quarter',  $quarter);
                    },
                    'previousQuarterlyReport' => function ($query) use ($previousQuarter) {
                        $query->select('ongoing_project_id', 'quarter', 'report_file')
                            ->where('quarter',  $previousQuarter);
                    }
                ])
                ->first();
        } catch (Exception $e) {
            throw new Exception('Failed to retrieve project data sheet data: ' . $e->getMessage());
        }
    }

    public function initializeProjectDataSheetData(
        string $project_info_id,
        int $business_info_id,
        int $application_info_id,
        string $quarter
    ): void {
        try {
            $initialData = [
                'project_info_id' => $project_info_id,
                'business_info_id' => $business_info_id,
                'application_info_id' => $application_info_id,
            ];
            $this->projectDataSheet->updateOrCreate([
                'project_info_id' => $project_info_id,
                'business_info_id' => $business_info_id,
                'application_info_id' => $application_info_id,
                'key' => self::PROJECT_DATA_SHEET . '_' . $quarter
            ], [
                'data' => $initialData
            ]);
        } catch (Exception $e) {
            throw new Exception('Error in initializing Project Data Sheet data: ' . $e->getMessage());
        }
    }
}
