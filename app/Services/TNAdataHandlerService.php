<?php

namespace App\Services;

use App\Models\ApplicationForm;
use Exception;

class TNAdataHandlerService
{
    public function __construct(private ApplicationForm $TNAForm)
    {
        $this->TNAForm = $TNAForm;
    }

    public function setTNAData(array $data, int $business_id, int $application_id, string $key = 'tna_form')
    {
        try {
            // Find the existing record
            $existingRecord = $this->TNAForm->where([
                'business_id' => $business_id,
                'application_id' => $application_id,
                'key' => $key
            ])->first();

            // If existing record exists, merge the data
            $mergedData = $existingRecord
                ? array_merge($existingRecord->data, $data, [
                    'business_id' => $business_id,
                    'application_id' => $application_id
                ])
                : [...$data, 'business_id' => $business_id, 'application_id' => $application_id];

            // Update or create the record
            $this->TNAForm->updateOrCreate([
                'business_id' => $business_id,
                'application_id' => $application_id,
                'key' => $key
            ], [
                'data' => $mergedData,
                'status' => 'Pending'
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getTNAData(int $business_id, int $application_id, string $key = 'tna_form')
    {
        try {
            $TNAForm = $this->TNAForm->where('business_id', $business_id)
                ->where('application_id', $application_id)
                ->where('key', $key)
                ->first();
            return $TNAForm ? $TNAForm->data : null;
        } catch (Exception $e) {
            throw new Exception('Error in getting TNA data: ' . $e->getMessage());
        }
    }
}
