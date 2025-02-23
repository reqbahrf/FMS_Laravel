<?php

namespace App\Services;

use App\Models\ApplicationForm;
use Exception;

class RTECReportdataHandlerService
{
    private const RTEC_REPORT_FORM = 'rtec_report_form';
    public function __construct(private ApplicationForm $RTECReportData) {}

    public function setRTECReportData(array $data, int $business_id, int $application_id)
    {
        try {
            // Find the existing record
            $existingRecord = $this->RTECReportData->where([
                'business_id' => $business_id,
                'application_id' => $application_id,
                'key' => self::RTEC_REPORT_FORM
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
                'key' => self::RTEC_REPORT_FORM
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
            $RTECReport = $this->RTECReportData->where('business_id', $business_id)
                ->where('application_id', $application_id)
                ->where('key', self::RTEC_REPORT_FORM)
                ->first();

            if (!$RTECReport) {
                $this->initializeRTECReportData($business_id, $application_id);
                $RTECReport = $this->RTECReportData->where('business_id', $business_id)
                    ->where('application_id', $application_id)
                    ->where('key', self::RTEC_REPORT_FORM)
                    ->first();
            }
            return $RTECReport ? $RTECReport->data : null;
        } catch (Exception $e) {
            throw new Exception('Error in getting RTEC Report data: ' . $e->getMessage());
        }
    }

    public function updateStatusToSubmitted(int $business_id, int $application_id)
    {
        try {
            $RTECReport = $this->RTECReportData->where('business_id', $business_id)
                ->where('application_id', $application_id)
                ->where('key', self::RTEC_REPORT_FORM)
                ->first();
            if (!$RTECReport) {
                throw new Exception('RTEC Report Form not found');
            }
            $RTECReport->update(['status' => 'Submitted']);
        } catch (Exception $e) {
            throw new Exception('Error in updating RTEC Report status to Submitted: ' . $e->getMessage());
        }
    }

    public function isDataExist(int $business_id, int $application_id): bool
    {
        try {
            return $this->RTECReportData->where('business_id', $business_id)
                ->where('application_id', $application_id)
                ->where('key', self::RTEC_REPORT_FORM)
                ->exists();
        } catch (Exception $e) {
            throw new Exception('Error in checking RTEC Report data existence: ' . $e->getMessage());
        }
    }

    public function initializeRTECReportData(int $business_id, int $application_id)
    {
        try {
            $initialData = [
                'business_id' => $business_id,
                'application_id' => $application_id
            ];

            $this->RTECReportData->updateOrCreate([
                'business_id' => $business_id,
                'application_id' => $application_id,
                'key' => self::RTEC_REPORT_FORM
            ], [
                'data' => $initialData,
                'status' => 'Pending'
            ]);
        } catch (Exception $e) {
            throw new Exception('Error in initializing RTEC Report data: ' . $e->getMessage());
        }
    }
}
