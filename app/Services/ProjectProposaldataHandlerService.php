<?php

namespace App\Services;

use Exception;
use App\Models\ApplicationForm;

class ProjectProposaldataHandlerService
{
    private const PROJECT_PROPOSAL_FORM = 'project_proposal_form';
    public function __construct(private ApplicationForm $ProjectProposalForm)
    {
        $this->ProjectProposalForm = $ProjectProposalForm;
    }

    public function setProjectProposalData(array $data, int $business_id, int $application_id)
    {
        try {
            $existingRecord = $this->ProjectProposalForm->where([
                'business_id' => $business_id,
                'application_id' => $application_id,
                'key' => self::PROJECT_PROPOSAL_FORM
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
                'key' => self::PROJECT_PROPOSAL_FORM
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
            $ProjectProposalForm = $this->ProjectProposalForm->where('business_id', $business_id)
                ->where('application_id', $application_id)
                ->where('key', self::PROJECT_PROPOSAL_FORM)
                ->first();

            if (!$ProjectProposalForm) {
                $this->initializeProjectProposalData($business_id, $application_id);
                $ProjectProposalForm = $this->ProjectProposalForm->where('business_id', $business_id)
                    ->where('application_id', $application_id)
                    ->where('key', self::PROJECT_PROPOSAL_FORM)
                    ->first();
            }
            return $ProjectProposalForm ? $ProjectProposalForm->data : null;
        } catch (Exception $e) {
            throw new Exception('Error in getting Project Proposal data: ' . $e->getMessage());
        }
    }

    public function updateStatusToSubmitted(int $business_id, int $application_id)
    {
        try {
            $ProjectProposalForm = $this->ProjectProposalForm->where('business_id', $business_id)
                ->where('application_id', $application_id)
                ->where('key', self::PROJECT_PROPOSAL_FORM)
                ->first();
            if (!$ProjectProposalForm) {
                throw new Exception('Project Proposal Form not found');
            }
            $ProjectProposalForm->update(['status' => 'Submitted']);
        } catch (Exception $e) {
            throw new Exception('Error in updating Project Proposal status to Submitted: ' . $e->getMessage());
        }
    }

    public function isDataExist(int $business_id, int $application_id): bool
    {
        try {
            return $this->ProjectProposalForm->where('business_id', $business_id)
                ->where('application_id', $application_id)
                ->where('key', self::PROJECT_PROPOSAL_FORM)
                ->exists();
        } catch (Exception $e) {
            throw new Exception('Error in checking Project Proposal data existence: ' . $e->getMessage());
        }
    }

    public function initializeProjectProposalData(int $business_id, int $application_id)
    {
        try {
            $initialData = [
                'business_id' => $business_id,
                'application_id' => $application_id
            ];

            $this->ProjectProposalForm->updateOrCreate([
                'business_id' => $business_id,
                'application_id' => $application_id,
                'key' => self::PROJECT_PROPOSAL_FORM
            ], [
                'data' => $initialData,
                'status' => 'Pending'
            ]);
        } catch (Exception $e) {
            throw new Exception('Error in initializing Project Proposal data: ' . $e->getMessage());
        }
    }
}
