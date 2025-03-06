<?php

namespace App\Services;

use Exception;
use App\Models\ProjectForm;

class StatusReportDataHandlerService
{
    private const STATUS_REPORT = 'status_report';
    public function __construct(
        private ProjectForm $projectForm
    ) {}

    public function setStatusReportData(
        array $data,
        string $project_info_id,
        int $business_info_id,
        int $application_info_id
    ): void {
        try {
            $existingRecord = $this->projectForm->where([
                'project_info_id' => $project_info_id,
                'business_info_id' => $business_info_id,
                'application_info_id' => $application_info_id,
                'key' => self::STATUS_REPORT
            ])->first();

            $mergedData = $existingRecord
                ? array_merge($existingRecord->data, $data)
                : [...$data, 'project_info_id' => $project_info_id, 'business_info_id' => $business_info_id, 'application_info_id' => $application_info_id];

            $this->projectForm->updateOrCreate(
                [
                    'project_info_id' => $project_info_id,
                    'business_info_id' => $business_info_id,
                    'application_info_id' => $application_info_id,
                    'key' => self::STATUS_REPORT
                ],
                [
                    'data' => $mergedData,
                ]
            );
        } catch (Exception $e) {
            throw new Exception("Failed to set status report data: " . $e->getMessage());
        }
    }

    public function getStatusReportData(
        string $project_info_id,
        int $business_info_id,
        int $application_info_id
    ): array {
        try {
            $projectForm = $this->projectForm->where([
                'project_info_id' => $project_info_id,
                'business_info_id' => $business_info_id,
                'application_info_id' => $application_info_id,
                'key' => self::STATUS_REPORT
            ])->first();

            if (!$projectForm) {
                $this->initializeStatusReportData($project_info_id, $business_info_id, $application_info_id);
                $projectForm = $this->projectForm->where([
                    'project_info_id' => $project_info_id,
                    'business_info_id' => $business_info_id,
                    'application_info_id' => $application_info_id,
                    'key' => self::STATUS_REPORT
                ])->first();
            }

            return $projectForm ? $projectForm->data : [];
        } catch (Exception $e) {
            throw new Exception("Failed to get status report data: " . $e->getMessage());
        }
    }

    private function initializeStatusReportData(
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
            $this->projectForm->updateOrCreate(
                [
                    'project_info_id' => $project_info_id,
                    'business_info_id' => $business_info_id,
                    'application_info_id' => $application_info_id,
                    'key' => self::STATUS_REPORT
                ],
                [
                    'data' => $initialData,
                ]
            );
        } catch (Exception $e) {
            throw new Exception("Failed to initialize status report data: " . $e->getMessage());
        }
    }
}
