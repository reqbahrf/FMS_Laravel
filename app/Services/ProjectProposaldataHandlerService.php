<?php

namespace App\Services;

use Exception;
use App\Models\ApplicationForm;

class ProjectProposaldataHandlerService
{
    public function __construct(private ApplicationForm $ProjectProposalForm)
    {
        $this->ProjectProposalForm = $ProjectProposalForm;
    }

    public function setProjectProposalData(array $data, int $business_id, int $application_id)
    {
        try {
            $key = 'project_proposal_form';
            $existingRecord = $this->ProjectProposalForm->where([
                'business_id' => $business_id,
                'application_id' => $application_id,
                'key' => $key
            ])->first();

            $mergedData = $existingRecord
                ? array_merge($existingRecord->data, $data, [
                    'business_id' => $business_id,
                    'application_id' => $application_id
                ])
                : [...$data, 'business_id' => $business_id, 'application_id' => $application_id];

            $this->ProjectProposalForm->updateOrCreate([
                'business_id' => $business_id,
                'application_id' => $application_id,
                'key' => $key
            ], [
                'data' => $mergedData,
                'status' => 'Pending'
            ]);
        } catch (Exception $e) {
            throw new Exception("Failed to set project proposal data: " . $e->getMessage());
        }
    }

    public function getProjectProposalData(int $business_id, int $application_id)
    {
        try {
            $key = 'project_proposal_form';
            $ProjectProposalForm = $this->ProjectProposalForm->where('business_id', $business_id)
                ->where('application_id', $application_id)
                ->where('key', $key)
                ->firstOrFail();
            return $ProjectProposalForm ? $ProjectProposalForm->data : null;
        } catch (Exception $e) {
            throw new Exception('Error in getting Project Proposal data: ' . $e->getMessage());
        }
    }
}
