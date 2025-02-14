<?php

namespace App\Services;

use App\Models\ApplicationForm;
use Exception;

class ProjectProposaldataHandlerService
{
    public function __construct(private ApplicationForm $ProjectProposalForm)
    {
        $this->ProjectProposalForm = $ProjectProposalForm;
    }

    public function setProjectProposalData(array $data, int $business_id, int $application_id, string $key = 'project_proposal_form')
    {
        try {
            $this->ProjectProposalForm->updateOrCreate([
                'business_id' => $business_id,
                'application_id' => $application_id,
                'key' => $key
            ], [
                'data' => [...$data, 'business_id' => $business_id, 'application_id' => $application_id],
                'status' => 'Pending'
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getProjectProposalData(int $business_id, int $application_id, string $key = 'project_proposal_form')
    {
        try {
            $ProjectProposalForm = $this->ProjectProposalForm->where('business_id', $business_id)
                ->where('application_id', $application_id)
                ->where('key', $key)
                ->first();
            return $ProjectProposalForm ? $ProjectProposalForm->data : null;
        } catch (Exception $e) {
            throw new Exception('Error in getting Project Proposal data: ' . $e->getMessage());
        }
    }
}
