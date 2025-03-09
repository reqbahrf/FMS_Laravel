<?php

namespace App\Services;

use Exception;
use App\Models\ProjectForm;

class StatusReportDataHandlerService
{
    private const STATUS_REPORT = 'status_report';
    public function __construct(
        private ProjectForm $projectStatusReport
    ) {}

    public function setStatusReportData(
        array $data,
        string $project_info_id,
        string $for_year,
        int $business_info_id,
        int $application_info_id
    ): void {
        try {
            $existingRecord = $this->projectStatusReport->where([
                'project_info_id' => $project_info_id,
                'business_info_id' => $business_info_id,
                'application_info_id' => $application_info_id,
                'key' => self::STATUS_REPORT . '_Y' . $for_year
            ])->first();

            $mergedData = $existingRecord
                ? array_merge($existingRecord->data, $data)
                : [...$data, 'project_info_id' => $project_info_id, 'business_info_id' => $business_info_id, 'application_info_id' => $application_info_id];

            $this->projectStatusReport->updateOrCreate(
                [
                    'project_info_id' => $project_info_id,
                    'business_info_id' => $business_info_id,
                    'application_info_id' => $application_info_id,
                    'key' => self::STATUS_REPORT . '_Y' . $for_year
                ],
                [
                    'data' => $mergedData,
                ]
            );
        } catch (Exception $e) {
            throw new Exception("Failed to set status report data: " . $e->getMessage());
        }
    }

    public function getStatusReportSheetData(
        string $project_info_id,
        string $for_year,
        int $business_info_id,
        int $application_info_id
    ): array {
        try {
            $projectForm = $this->projectStatusReport->where([
                'project_info_id' => $project_info_id,
                'business_info_id' => $business_info_id,
                'application_info_id' => $application_info_id,
                'key' => self::STATUS_REPORT . '_Y' . $for_year
            ])->first();

            return $projectForm ? $projectForm->data : [];
        } catch (Exception $e) {
            throw new Exception("Failed to get status report data: " . $e->getMessage());
        }
    }
    public function getAllProjectStatusRepordSheetYear(
        string $project_info_id,
        int $business_info_id,
        int $application_info_id
    ): array {
        try {
            $projectForm = $this->projectStatusReport->where([
                'project_info_id' => $project_info_id,
                'business_info_id' => $business_info_id,
                'application_info_id' => $application_info_id,
            ])->where('key', 'LIKE', self::STATUS_REPORT . '_Y%')
                ->get();

            return $projectForm->map(function ($record) {
                return str_replace(self::STATUS_REPORT . '_Y', '', $record->key);
            })->toArray();
        } catch (Exception $e) {
            throw new Exception("Failed to get all project status report sheet years: " . $e->getMessage());
        }
    }

    public function initializeStatusReportData(
        string $project_info_id,
        string $for_year,
        int $business_info_id,
        int $application_info_id
    ): void {
        try {
            if ($this->isDataExists($project_info_id, $for_year, $business_info_id, $application_info_id)) {
                throw new Exception('Data already exists');
            }

            $initialData = [
                'project_info_id' => $project_info_id,
                'business_info_id' => $business_info_id,
                'application_info_id' => $application_info_id,
                'for_period' => $for_year
            ];
            $this->projectStatusReport->updateOrCreate(
                [
                    'project_info_id' => $project_info_id,
                    'business_info_id' => $business_info_id,
                    'application_info_id' => $application_info_id,
                    'key' => self::STATUS_REPORT . '_Y' . $for_year
                ],
                [
                    'data' => $initialData,
                ]
            );
        } catch (Exception $e) {
            throw new Exception("Failed to create status report data: " . $e->getMessage());
        }
    }

    protected function isDataExists(
        string $project_info_id,
        string $forYear,
        int $business_info_id,
        int $application_info_id
    ): bool {
        try {
            return $this->projectStatusReport->where([
                'project_info_id' => $project_info_id,
                'business_info_id' => $business_info_id,
                'application_info_id' => $application_info_id,
                'key' => self::STATUS_REPORT . '_Y' . $forYear
            ])->exists();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
