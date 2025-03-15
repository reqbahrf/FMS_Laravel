<?php

namespace App\Services;

use Exception;
use App\Models\ApplicationForm;
use App\Actions\DocumentStatusAction as DSA;
use App\Models\User;

class ProjectProposaldataHandlerService
{
    private const PROJECT_PROPOSAL_FORM = 'project_proposal_form';
    public function __construct(private ApplicationForm $ProjectProposalForm)
    {
        $this->ProjectProposalForm = $ProjectProposalForm;
    }

    public function getProjectProposalStatus(int $business_id, int $application_id)
    {
        try {
            $ProjectProposalForm = $this->ProjectProposalForm->where('business_id', $business_id)
                ->where('application_id', $application_id)
                ->where('key', self::PROJECT_PROPOSAL_FORM)
                ->select('status', 'reviewed_by', 'reviewed_at', 'modified_by', 'modified_at')
                ->first();
            return $ProjectProposalForm ?: null;
        } catch (Exception $e) {
            throw new Exception('Error in getting Project Proposal status: ' . $e->getMessage());
        }
    }

    public function setProjectProposalData(array $data, User $user, int $business_id, int $application_id)
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
                'reviewed_at' => $statusData['reviewed_at'],
                'modified_by' => $statusData['modified_by'],
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

            $keys = [
                'January_Y1',
                'January_Y2',
                'January_Y3',
                'January_Y4',
                'January_Y5',
                'February_Y1',
                'February_Y2',
                'February_Y3',
                'February_Y4',
                'February_Y5',
                'March_Y1',
                'March_Y2',
                'March_Y3',
                'March_Y4',
                'March_Y5',
                'April_Y1',
                'April_Y2',
                'April_Y3',
                'April_Y4',
                'April_Y5',
                'May_Y1',
                'May_Y2',
                'May_Y3',
                'May_Y4',
                'May_Y5',
                'June_Y1',
                'June_Y2',
                'June_Y3',
                'June_Y4',
                'June_Y5',
                'July_Y1',
                'July_Y2',
                'July_Y3',
                'July_Y4',
                'July_Y5',
                'August_Y1',
                'August_Y2',
                'August_Y3',
                'August_Y4',
                'August_Y5',
                'September_Y1',
                'September_Y2',
                'September_Y3',
                'September_Y4',
                'September_Y5',
                'October_Y1',
                'October_Y2',
                'October_Y3',
                'October_Y4',
                'October_Y5',
                'November_Y1',
                'November_Y2',
                'November_Y3',
                'November_Y4',
                'November_Y5',
                'December_Y1',
                'December_Y2',
                'December_Y3',
                'December_Y4',
                'December_Y5',

                'January_total',
                'February_total',
                'March_total',
                'April_total',
                'May_total',
                'June_total',
                'July_total',
                'August_total',
                'September_total',
                'October_total',
                'November_total',
                'December_total',
            ];

            // Create an array with keys as keys and 0 values
            $keysArray = array_fill_keys($keys, 0);

            // Use array_intersect_key to filter the project proposal data
            $paymentStructure = array_intersect_key($projectProposalData, $keysArray);

            return [
                $paymentStructure,
                $fundReleaseDate
            ];
        } catch (Exception $e) {
            throw new Exception('Error in getting Refund Payment Structure: ' . $e->getMessage());
        }
    }
}
