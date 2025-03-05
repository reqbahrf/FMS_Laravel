<?php

namespace App\Services;

use Exception;
use App\Models\ProjectForm;
use App\Models\OngoingQuarterlyReport;

class ProjectDataSheetDataHandlerService
{
    private const PROJECT_DATA_SHEET = 'project_data_sheet';

    public function __construct(
        private ProjectForm $projectDataSheet
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

    public function getQuaterlyReportData(string $reportId, string $projectId, string $quarter): OngoingQuarterlyReport
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
