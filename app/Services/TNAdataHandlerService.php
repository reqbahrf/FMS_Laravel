<?php

namespace App\Services;

use App\Models\ApplicationForm;
use Exception;

class TNAdataHandlerService
{
    private const TNA_FORM = 'tna_form';
    public function __construct(private ApplicationForm $TNAFormData) {}

    public function setTNAData(array $data, int $business_id, int $application_id)
    {
        try {
            // Find the existing record
            $existingRecord = $this->TNAFormData->where([
                'business_id' => $business_id,
                'application_id' => $application_id,
                'key' => self::TNA_FORM
            ])->first();

            // If existing record exists, merge the data
            $mergedData = $existingRecord
                ? array_merge($existingRecord->data, $data, [
                    'business_id' => $business_id,
                    'application_id' => $application_id
                ])
                : [...$data, 'business_id' => $business_id, 'application_id' => $application_id];

            // Update or create the record
            $this->TNAFormData->updateOrCreate([
                'business_id' => $business_id,
                'application_id' => $application_id,
                'key' => self::TNA_FORM
            ], [
                'data' => $mergedData,
                'status' => 'Pending'
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
