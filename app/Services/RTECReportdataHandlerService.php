<?php

namespace App\Services;

use App\Models\ApplicationForm;
use Exception;

class RTECReportdataHandlerService
{
    public function __construct(private ApplicationForm $RTECReportData)
    {}

    public function setRTECReportData(array $data, int $business_id, int $application_id)
    {
        try {
            $key = 'rtec_report_form';
            // Find the existing record
            $existingRecord = $this->RTECReportData->where([
                'business_id' => $business_id,
                'application_id' => $application_id,
                'key' => $key
            ])->first();

            $mergeData = $existingRecord
                ? array_merge($existingRecord->data, $data, [
                    'business_id' => $business_id,
                    'application_id' => $application_id
                ])
                : [...$data, 'business_id' => $business_id, 'application_id' => $application_id];

            $this->RTECReportData->updateOrCreate([
                'business_id' => $business_id,
                'application_id' => $application_id,
                'key' => $key
            ], [
                'data' => $mergeData,
                'status' => 'Pending'
            ]);
        } catch (Exception $e) {
            throw new Exception("Failed to set RTEC Report data: " . $e->getMessage());
        }
    }
    public function getRTECReportData(int $business_id, int $application_id)
    {
        try {
            $key = 'rtec_report_form';
            $RTECReport = $this->RTECReportData->where('business_id', $business_id)
                ->where('application_id', $application_id)
                ->where('key', $key)
                ->first();
            return $RTECReport ? $RTECReport->data : null;
        } catch (Exception $e) {
            throw new Exception('Error in getting RTEC Report data: ' . $e->getMessage());
        }
    }

    public function updateStatusToSubmitted(int $business_id, int $application_id)
    {
        try {
            $key = 'rtec_report_form';
            $RTECReport = $this->RTECReportData->where('business_id', $business_id)
                ->where('application_id', $application_id)
                ->where('key', $key)
                ->first();
            if (!$RTECReport) {
                throw new Exception('RTEC Report Form not found');
            }
            $RTECReport->update(['status' => 'Submitted']);
        } catch (Exception $e) {
            throw new Exception('Error in updating RTEC Report status to Submitted: ' . $e->getMessage());
        }
    }

}

