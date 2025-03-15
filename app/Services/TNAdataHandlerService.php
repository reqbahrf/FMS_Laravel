<?php

namespace App\Services;

use Exception;
use App\Models\User;
use App\Models\ApplicationForm;
use App\Actions\DocumentStatusAction as DSA;
use Illuminate\Support\Facades\Log;

class TNAdataHandlerService
{
    private const TNA_FORM = 'tna_form';
    public function __construct(
        private ApplicationForm $TNAFormData
    ) {}
    public function getTNAStatus(int $business_id, int $application_id): ApplicationForm
    {
        try {
            $TNAStatus = $this->TNAFormData->where('business_id', $business_id)
                ->where('application_id', $application_id)
                ->where('key', self::TNA_FORM)
                ->select('status', 'reviewed_by', 'reviewed_at', 'modified_by', 'modified_at')
                ->first();

            return $TNAStatus;
        } catch (Exception $e) {
            throw new Exception('Error in getting TNA status: ' . $e->getMessage());
        }
    }

    public function setTNAData(array $data, User $user, int $business_id, int $application_id)
    {
        try {
            // Find the existing record
            $existingRecord = $this->TNAFormData->where([
                'business_id' => $business_id,
                'application_id' => $application_id,
                'key' => self::TNA_FORM
            ])->first();

            $documentStatus = $data['tna_doc_status'];
            $filteredData = array_diff_key($data, array_flip(['tna_doc_status']));
            $statusData = DSA::determineReviewerOrModifier($documentStatus, $user);

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
                'reviewed_by' => $statusData['reviewed_by'],
                'modified_by' => $statusData['modified_by'],
                'reviewed_at' => $statusData['reviewed_at'],
                'modified_at' => $statusData['modified_at'],
                'data' => $mergedData,
                'status' => $documentStatus
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
}
