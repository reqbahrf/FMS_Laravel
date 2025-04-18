<?php

namespace App\Services;

use Exception;
use App\Models\User;
use App\Models\OrgUserInfo;
use App\Models\ApplicationForm;
use App\Actions\DocumentStatusAction as DSA;

class RTECReportdataHandlerService
{
    private const RTEC_REPORT_FORM = 'rtec_report_form';
    public function __construct(
        private ApplicationForm $RTECReportData
    ) {}
    public function getRTECReportStatus(int $business_id, int $application_id): array
    {
        try {
            $RTECReportStatus = $this->RTECReportData->where('business_id', $business_id)
                ->where('application_id', $application_id)
                ->where('key', self::RTEC_REPORT_FORM)
                ->select('status', 'reviewed_at', 'modified_at', 'reviewed_by', 'modified_by')
                ->with('reviewer')
                ->with('modifier')
                ->first();

            if (!$RTECReportStatus) {
                return [
                    'status' => null,
                    'reviewer_name' => null,
                    'modifier_name' => null,
                    'reviewed_at' => null,
                    'modified_at' => null
                ];
            }

            $RTECReportStatus['reviewer_name'] = $RTECReportStatus->reviewer ? $RTECReportStatus->reviewer->getFullNameAttribute() : null;
            $RTECReportStatus['modifier_name'] = $RTECReportStatus->modifier ? $RTECReportStatus->modifier->getFullNameAttribute() : null;

            return $RTECReportStatus->toArray();
        } catch (Exception $e) {
            throw new Exception('Error in getting RTEC Report status: ' . $e->getMessage());
        }
    }

    public function setRTECReportData(array $data, OrgUserInfo $user, int $business_id, int $application_id)
    {
        try {
            // Find the existing record
            $existingRecord = $this->RTECReportData->where([
                'business_id' => $business_id,
                'application_id' => $application_id,
                'key' => self::RTEC_REPORT_FORM
            ])->first();

            if ($user && isset($data['rtec_report_doc_status'])) {
                $documentStatus = $data['rtec_report_doc_status'];
                $filteredData = array_diff_key($data, array_flip(['rtec_report_doc_status']));

                $existingStatusData = $existingRecord ? [
                    'modified_by' => $existingRecord->modified_by,
                    'modified_at' => $existingRecord->modified_at,
                    'reviewed_by' => $existingRecord->reviewed_by,
                    'reviewed_at' => $existingRecord->reviewed_at
                ] : null;

                $statusData = DSA::determineReviewerOrModifier($documentStatus, $user, $existingStatusData);
            }

            $filteredData = $filteredData ?? $data;

            $mergeData = $existingRecord
                ? array_merge($existingRecord->data, $filteredData, [
                    'business_id' => $business_id,
                    'application_id' => $application_id
                ])
                : [...$filteredData, 'business_id' => $business_id, 'application_id' => $application_id];

            $this->RTECReportData->updateOrCreate([
                'business_id' => $business_id,
                'application_id' => $application_id,
                'key' => self::RTEC_REPORT_FORM
            ], [
                'reviewed_by' => $statusData['reviewed_by'],
                'modified_by' => $statusData['modified_by'],
                'reviewed_at' => $statusData['reviewed_at'],
                'modified_at' => $statusData['modified_at'],
                'data' => $mergeData,
                'status' => $documentStatus
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
