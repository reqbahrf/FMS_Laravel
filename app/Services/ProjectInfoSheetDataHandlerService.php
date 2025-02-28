<?php

namespace App\Services;

use Exception;
use App\Models\ProjectForm;

class ProjectInfoSheetDataHandlerService
{
    private const PROJECT_INFO_SHEET = 'project_info_sheet';
    public function __construct(
        private ProjectForm $ProjectInfoSheet
    ) {}

    public function setProjectInfoSheetData(
        array $data,
        string $project_info_id,
        int $business_info_id,
        int $application_info_id
    ): void {
        try {
            $existingRecord = $this->ProjectInfoSheet->where([
                'project_info_id' => $project_info_id,
                'business_info_id' => $business_info_id,
                'application_info_id' => $application_info_id,
                'key' => self::PROJECT_INFO_SHEET
            ])->first();

            $mergedData = $existingRecord
                ? array_merge($existingRecord->data, $data, [
                    'project_info_id' => $project_info_id,
                    'business_info_id' => $business_info_id,
                    'application_info_id' => $application_info_id,
                ])
                : [...$data, 'project_info_id' => $project_info_id, 'business_info_id' => $business_info_id, 'application_info_id' => $application_info_id];

            $this->ProjectInfoSheet->updateOrCreate([
                'project_info_id' => $project_info_id,
                'business_info_id' => $business_info_id,
                'application_info_id' => $application_info_id,
                'key' => self::PROJECT_INFO_SHEET
            ], [
                'data' => $mergedData,
            ]);
        } catch (Exception $e) {
            throw new Exception('Error in setting Project Info Sheet data: ' . $e->getMessage());
        }
    }

    public function getProjectInfoSheetData(
        string $project_info_id,
        int $business_info_id,
        int $application_info_id
    ): array {
        try {

            $ProjectInfoSheet = $this->ProjectInfoSheet->where([
                'project_info_id' => $project_info_id,
                'business_info_id' => $business_info_id,
                'application_info_id' => $application_info_id,
                'key' => self::PROJECT_INFO_SHEET
            ])->first();

            if (!$ProjectInfoSheet) {
                $this->initializeProjectInfoSheetData($project_info_id, $business_info_id, $application_info_id);
                $ProjectInfoSheet = $this->ProjectInfoSheet->where([
                    'project_info_id' => $project_info_id,
                    'business_info_id' => $business_info_id,
                    'application_info_id' => $application_info_id,
                    'key' => self::PROJECT_INFO_SHEET
                ])->first();
            }
            return $ProjectInfoSheet ? $ProjectInfoSheet->data : [];
        } catch (Exception $e) {
            throw new Exception('Error in getting Project Info Sheet data: ' . $e->getMessage());
        }
    }

    public function initializeProjectInfoSheetData(
        string $project_info_id,
        int $business_info_id,
        int $application_info_id
    ): void {
        try {
            $initialData = [
                'project_info_id' => $project_info_id,
                'business_info_id' => $business_info_id,
                'application_info_id' => $application_info_id,
            ];

            $this->ProjectInfoSheet->updateOrCreate([
                'project_info_id' => $project_info_id,
                'business_info_id' => $business_info_id,
                'application_info_id' => $application_info_id,
                'key' => self::PROJECT_INFO_SHEET
            ], [
                'data' => $initialData,
            ]);
        } catch (Exception $e) {
            throw new Exception('Error in initializing Project Info Sheet data: ' . $e->getMessage());
        }
    }
}
