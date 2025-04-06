<?php

namespace App\Services;

use Exception;
use App\Models\User;
use App\Models\ApplicationForm;
use App\Models\OrgUserInfo;
use App\Actions\DocumentStatusAction as DSA;
use Illuminate\Support\Facades\Log;

class TNAdataHandlerService
{
    private const TNA_FORM = 'tna_form';
    public function __construct(
        private ApplicationForm $TNAFormData,
        private ApplicantFileHandlerService $applicantFileHandler
    ) {}
    /**
     * Get TNA status with user information
     *
     * @param int $business_id
     * @param int $application_id
     * @return array
     * @throws Exception
     */
    public function getTNAStatus(int $business_id, int $application_id): array
    {
        try {
            // Get the TNA status with a single query
            $TNAStatus = $this->TNAFormData
                ->where([
                    'business_id' => $business_id,
                    'application_id' => $application_id,
                    'key' => self::TNA_FORM
                ])
                ->select('status', 'reviewed_at', 'modified_at', 'reviewed_by', 'modified_by')
                ->with('reviewer')
                ->with('modifier')
                ->first();

            if (!$TNAStatus) {
                return [
                    'status' => null,
                    'reviewer_name' => null,
                    'modifier_name' => null,
                    'reviewed_at' => null,
                    'modified_at' => null
                ];
            }

            // Add null checks before accessing properties
            $TNAStatus['reviewer_name'] = $TNAStatus->reviewer ? $TNAStatus->reviewer->getFullNameAttribute() : null;
            $TNAStatus['modifier_name'] = $TNAStatus->modifier ? $TNAStatus->modifier->getFullNameAttribute() : null;

            return $TNAStatus->toArray();
        } catch (Exception $e) {
            Log::error('Error in getting TNA status: ' . $e->getMessage());
            throw new Exception('Error in getting TNA status: ' . $e->getMessage());
        }
    }

    public function setTNAData(array $data, int $business_id, int $application_id, ?OrgUserInfo $user = null)
    {
        try {
            // Find the existing record
            $existingRecord = $this->TNAFormData->where([
                'business_id' => $business_id,
                'application_id' => $application_id,
                'key' => self::TNA_FORM
            ])->first();

            if ($user && isset($data['tna_doc_status'])) {
                $documentStatus = $data['tna_doc_status'];
                $filteredData = array_diff_key($data, array_flip(['tna_doc_status']));

                $existingStatusData = $existingRecord ? [
                    'modified_by' => $existingRecord->modified_by,
                    'modified_at' => $existingRecord->modified_at,
                    'reviewed_by' => $existingRecord->reviewed_by,
                    'reviewed_at' => $existingRecord->reviewed_at
                ] : null;


                $file_to_insert = [
                    'OrganizationalStructurePath' => $data['OrganizationalStructureFileID_Data_Handler'] ?? '',
                    'PlanLayoutPath' => $data['PlanLayoutFileID_Data_Handler'] ?? '',
                    'ProcessFlowPath' => $data['ProcessFlowFileID_Data_Handler'] ?? '',
                ];

                $fileNames = [
                    'OrganizationalStructurePath' => 'Organizational Structure',
                    'PlanLayoutPath' => 'Plan Layout',
                    'ProcessFlowPath' => 'Process Flow',
                ];

                $file_to_insert = array_filter($file_to_insert);

                foreach ($file_to_insert as $filekey => $fileIdentifier) {
                    $this->applicantFileHandler->replaceOrCreateRequirementFile($business_id, $filekey, $fileIdentifier, $fileNames);
                }
                $statusData = DSA::determineReviewerOrModifier($documentStatus, $user, $existingStatusData);
            }

            $filteredData = $filteredData ?? $data;

            $mergedData = $existingRecord
                ? array_merge($existingRecord->data, $filteredData, [
                    'business_id' => $business_id,
                    'application_id' => $application_id
                ])
                : [...$filteredData, 'business_id' => $business_id, 'application_id' => $application_id];

            // Update or create the record
            $this->TNAFormData->updateOrCreate([
                'business_id' => $business_id,
                'application_id' => $application_id,
                'key' => self::TNA_FORM
            ], [
                'reviewed_by' => $statusData['reviewed_by'] ?? null,
                'modified_by' => $statusData['modified_by'] ?? null,
                'reviewed_at' => $statusData['reviewed_at'] ?? null,
                'modified_at' => $statusData['modified_at'] ?? null,
                'data' => $mergedData,
                'status' => $data['tna_doc_status'] ?? 'Pending'
            ]);
        } catch (Exception $e) {
            throw new Exception("Failed to set TNA data: " . $e->getMessage());
        }
    }

    public function getTNAData(int $business_id, int $application_id)
    {
        try {
            $TNAForm = $this->TNAFormData->where('business_id', $business_id)
                ->where('application_id', $application_id)
                ->where('key', self::TNA_FORM)
                ->first();

            if (!$TNAForm) {
                $this->initializeTNAData($business_id, $application_id);
                $TNAForm = $this->TNAFormData->where('business_id', $business_id)
                    ->where('application_id', $application_id)
                    ->where('key', self::TNA_FORM)
                    ->first();
            }
            return $TNAForm ? $TNAForm->data : null;
        } catch (Exception $e) {
            throw new Exception('Error in getting TNA data: ' . $e->getMessage());
        }
    }

    public function updateStatusToSubmitted(int $business_id, int $application_id)
    {
        try {
            $TNAForm = $this->TNAFormData->where('business_id', $business_id)
                ->where('application_id', $application_id)
                ->where('key', self::TNA_FORM)
                ->first();
            if (!$TNAForm) {
                throw new Exception('TNA Form not found');
            }
            $TNAForm->update(['status' => 'Submitted']);
        } catch (Exception $e) {
            throw new Exception('Error in updating TNA status to Submitted: ' . $e->getMessage());
        }
    }

    public function isDataExist(int $business_id, int $application_id): bool
    {
        try {
            return $this->TNAFormData->where('business_id', $business_id)
                ->where('application_id', $application_id)
                ->where('key', self::TNA_FORM)
                ->exists();
        } catch (Exception $e) {
            throw new Exception('Error in checking TNA data existence: ' . $e->getMessage());
        }
    }

    public function initializeTNAData(int $business_id, int $application_id)
    {
        try {
            $initialData = [
                'business_id' => $business_id,
                'application_id' => $application_id
            ];

            $this->TNAFormData->updateOrCreate([
                'business_id' => $business_id,
                'application_id' => $application_id,
                'key' => self::TNA_FORM
            ], [
                'data' => $initialData,
                'status' => 'Pending'
            ]);
        } catch (Exception $e) {
            throw new Exception('Error in initializing TNA data: ' . $e->getMessage());
        }
    }

    private function handlerTNAUploadImage(): void {}
}
