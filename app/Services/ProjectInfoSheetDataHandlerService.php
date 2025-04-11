<?php

namespace App\Services;

use Exception;
use App\Models\ProjectForm;
use App\Models\ProjectInfo;
use Illuminate\Support\Facades\Log;

class ProjectInfoSheetDataHandlerService
{
    private const PROJECT_INFO_SHEET = 'project_info_sheet';
    public function __construct(
        private ProjectForm $ProjectInfoSheet
    ) {}

    public function setProjectInfoSheetData(
        array $data,
        string $projectInfoId,
        string $forYear,
        int $businessInfoId,
        int $applicationInfoId
    ): void {
        try {
            $existingRecord = $this->ProjectInfoSheet->where([
                'project_info_id' => $projectInfoId,
                'business_info_id' => $businessInfoId,
                'application_info_id' => $applicationInfoId,
                'key' => self::PROJECT_INFO_SHEET . '_Y' . $forYear
            ])->first();

            $mergedData = $existingRecord
                ? array_merge($existingRecord->data, $data, [
                    'project_info_id' => $projectInfoId,
                    'business_info_id' => $businessInfoId,
                    'application_info_id' => $applicationInfoId,
                ])
                : [...$data, 'project_info_id' => $projectInfoId, 'business_info_id' => $businessInfoId, 'application_info_id' => $applicationInfoId];

            $this->ProjectInfoSheet->updateOrCreate([
                'project_info_id' => $projectInfoId,
                'business_info_id' => $businessInfoId,
                'application_info_id' => $applicationInfoId,
                'key' => self::PROJECT_INFO_SHEET . '_Y' . $forYear
            ], [
                'data' => $mergedData,
            ]);
        } catch (Exception $e) {
            throw new Exception('Error in setting Project Info Sheet data: ' . $e->getMessage());
        }
    }

    public function getProjectInfoSheetData(
        string $project_info_id,
        string $forYear,
        int $business_info_id,
        int $application_info_id
    ): array {
        try {

            $ProjectInfoSheet = $this->ProjectInfoSheet->where([
                'project_info_id' => $project_info_id,
                'business_info_id' => $business_info_id,
                'application_info_id' => $application_info_id,
                'key' => self::PROJECT_INFO_SHEET . '_Y' . $forYear
            ])->first();
            return $ProjectInfoSheet ? $ProjectInfoSheet->data : [];
        } catch (Exception $e) {
            throw new Exception('Error in getting Project Info Sheet data: ' . $e->getMessage());
        }
    }
    public function getAllProjectInfoSheetYear(
        string $project_info_id,
        int $business_info_id,
        int $application_info_id
    ): array {
        try {
            $projectInfoSheetYears = $this->ProjectInfoSheet->where([
                'project_info_id' => $project_info_id,
                'business_info_id' => $business_info_id,
                'application_info_id' => $application_info_id,
            ])->where('key', 'LIKE', self::PROJECT_INFO_SHEET . '_Y%')
                ->get();

            return $projectInfoSheetYears->map(function ($record) {
                return str_replace(self::PROJECT_INFO_SHEET . '_Y', '', $record->key);
            })->toArray();
        } catch (Exception $e) {
            throw new Exception('Error in getting all Project Info Sheet data: ' . $e->getMessage());
        }
    }

    public function initializeProjectInfoSheetData(
        string $project_info_id,
        string $forYear,
        int $business_info_id,
        int $application_info_id
    ): void {
        try {
            if ($this->isDataExists($project_info_id, $forYear, $business_info_id, $application_info_id)) {
                throw new Exception('Data already exists');
            }

            $initialData = [
                'project_info_id' => $project_info_id,
                'business_info_id' => $business_info_id,
                'application_info_id' => $application_info_id,
                'for_period' => $forYear
            ];

            $this->ProjectInfoSheet->updateOrCreate([
                'project_info_id' => $project_info_id,
                'business_info_id' => $business_info_id,
                'application_info_id' => $application_info_id,
                'key' => self::PROJECT_INFO_SHEET . '_Y' . $forYear
            ], [
                'data' => $initialData,
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    protected function isDataExists(
        string $project_info_id,
        string $forYear,
        int $business_info_id,
        int $application_info_id
    ): bool {
        try {
            return $this->ProjectInfoSheet->where([
                'project_info_id' => $project_info_id,
                'business_info_id' => $business_info_id,
                'application_info_id' => $application_info_id,
                'key' => self::PROJECT_INFO_SHEET . '_Y' . $forYear
            ])->exists();
        } catch (Exception $e) {
            throw new Exception('Error in checking Project Info Sheet data: ' . $e->getMessage());
        }
    }

    public function getProjectInfoData(string $projectId): object
    {
        try {
            return ProjectInfo::select(
                'Project_id',
                'project_title',
                'business_id',
                'firm_name',
                'enterprise_type',
                'f_name',
                'mid_name',
                'l_name',
                'suffix',
                'sex',
                'birth_date',
                'mobile_number',
                'landline',
                'email',
                'office_landmark',
                'office_barangay',
                'office_city',
                'office_province',
                'office_region',
                'office_zip_code',
            )
                ->join('business_info', 'project_info.business_id', '=', 'business_info.id')
                ->join('business_address_info', 'business_info.id', '=', 'business_address_info.business_info_id')
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
}
