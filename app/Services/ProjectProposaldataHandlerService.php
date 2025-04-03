<?php

namespace App\Services;

use Exception;
use App\Models\User;
use App\Models\OrgUserInfo;
use App\Models\ApplicationForm;
use App\Constants\ProjectRefundConstants;
use App\Actions\DocumentStatusAction as DSA;

class ProjectProposaldataHandlerService
{
    private const PROJECT_PROPOSAL_FORM = 'project_proposal_form';
    public function __construct(private ApplicationForm $ProjectProposalForm)
    {
        $this->ProjectProposalForm = $ProjectProposalForm;
    }

    public function getProjectProposalStatus(int $business_id, int $application_id): array
    {
        try {
            $ProjectProposalForm = $this->ProjectProposalForm->where('business_id', $business_id)
                ->where('application_id', $application_id)
                ->where('key', self::PROJECT_PROPOSAL_FORM)
                ->select('status', 'reviewed_at', 'modified_at', 'reviewed_by', 'modified_by')
                ->with('reviewer')
                ->with('modifier')
                ->first();

            if (!$ProjectProposalForm) {
                return [
                    'status' => null,
                    'reviewer_name' => null,
                    'modifier_name' => null,
                    'reviewed_at' => null,
                    'modified_at' => null
                ];
            }

            $ProjectProposalForm['reviewer_name'] = $ProjectProposalForm->reviewer ? $ProjectProposalForm->reviewer->getFullNameAttribute() : null;
            $ProjectProposalForm['modifier_name'] = $ProjectProposalForm->modifier ? $ProjectProposalForm->modifier->getFullNameAttribute() : null;

            return $ProjectProposalForm->toArray();
        } catch (Exception $e) {
            throw new Exception('Error in getting Project Proposal status: ' . $e->getMessage());
        }
    }

    public function setProjectProposalData(array $data, OrgUserInfo $user, int $business_id, int $application_id)
    {
        try {
            $existingRecord = $this->ProjectProposalForm->where([
                'business_id' => $business_id,
                'application_id' => $application_id,
                'key' => self::PROJECT_PROPOSAL_FORM
            ])->first();

            $documentStatus = $data['project_proposal_doc_status'];
            $filteredData = array_diff_key($data, array_flip(['project_proposal_doc_status']));
            $statusData = DSA::determineReviewerOrModifier($documentStatus, $user);

            $mergedData = $existingRecord
                ? array_merge($existingRecord->data, $filteredData, [
                    'business_id' => $business_id,
                    'application_id' => $application_id
                ])
                : [...$filteredData, 'business_id' => $business_id, 'application_id' => $application_id];

            $this->ProjectProposalForm->updateOrCreate([
                'business_id' => $business_id,
                'application_id' => $application_id,
                'key' => self::PROJECT_PROPOSAL_FORM
            ], [
                'reviewed_by' => $statusData['reviewed_by'],
                'modified_by' => $statusData['modified_by'],
                'reviewed_at' => $statusData['reviewed_at'],
                'modified_at' => $statusData['modified_at'],
                'data' => $mergedData,
                'status' => $documentStatus,
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

    /**
     * Retrieves the refund payment structure and fund release date for a given business and application.
     *
     * @param int $business_id The ID of the business.
     * @param int $application_id The ID of the application.
     *
     * @return array An array containing the payment structure and fund release date.
     * @throws Exception If there is an error retrieving the refund payment structure.
     */
    public function getRefundPaymentStructure(int $business_id, int $application_id): array
    {
        try {
            $projectProposalData = $this->getProjectProposalData($business_id, $application_id);

            $fundReleaseDate = $projectProposalData['fund_release_date'];

            $paymentStructure = PaymentProcessingService::extractPaymentStructure($projectProposalData);

            return [
                $paymentStructure,
                $fundReleaseDate
            ];
        } catch (Exception $e) {
            throw new Exception('Error in getting Refund Payment Structure: ' . $e->getMessage());
        }
    }
}
