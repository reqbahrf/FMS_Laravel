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

    public function setTNAData(array $data, int $business_id, string $key = 'tna_form')
    {
        try {
            $this->TNAForm->updateOrCreate([
                'business_id' => $business_id,
                'key' => $key
            ], [
                'data' => $data,
                'status' => 'Pending'
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getTNAData(int $business_id, string $key = 'tna_form')
    {
        try {
            $TNAForm = $this->TNAForm->where('business_id', $business_id)
                ->where('key', $key)
                ->first();
            return $TNAForm ? $TNAForm->data : null;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
