import { processError } from '../../Utilities/error-handler-util';
import {
    showProcessToast,
    hideProcessToast,
    showToastFeedback,
} from '../../Utilities/feedback-toast';
import createConfirmationModal from '../../Utilities/confirmation-modal';
export default class NewRequirements {
    private addRequirementModal: JQuery<HTMLElement>;
    private addRequirementForm: JQuery<HTMLFormElement>;
    private businessId: string | null;
    private applicationId: string | null;
    private routes: { [key: string]: string };
    constructor() {
        this.businessId = null;
        this.applicationId = null;
        this.addRequirementModal = $('#addRequirementModal');
        this.addRequirementForm = this.addRequirementModal.find(
            '#addRequirementForm'
        );
        this.routes = {
            ADD_NEW_REQUIREMENT: APPLICANT_TAB_ROUTE.ADD_NEW_REQUIREMENT,
        };
        this.initilizeSubmissionEvent();
    }

    public setId(businessId: string, applicationId: string) {
        if (!businessId || !applicationId) {
            throw new Error('Business ID and Application ID are required');
        }
        this.businessId = businessId;
        this.applicationId = applicationId;
    }

    private initilizeSubmissionEvent() {
        try {
            this.addRequirementForm.one('submit', async (e) => {
                e.preventDefault();
                const isConfirmed = await createConfirmationModal({
                    title: 'Confirm Requirement Addition',
                    message: 'Are you sure you want to add this requirement?',
                    confirmText: 'Yes',
                    cancelText: 'No',
                });
                if (!isConfirmed) return;
                const processToast = showProcessToast('Adding Requirement...');
                try {
                    const formData = new FormData(this.addRequirementForm[0]);
                    await this._saveRequirement(formData);
                } catch (error) {
                    processError(
                        'Error in submitting new requirement: ',
                        error,
                        true
                    );
                } finally {
                    hideProcessToast(processToast);
                }
            });
        } catch (error) {
            processError('Error in Initialize Submission Event: ', error);
        }
    }

    private async _saveRequirement(formData: FormData) {
        try {
            if (!this.businessId || !this.applicationId) {
                throw new Error('Business ID and Application ID are required');
            }
            console.log('This method is called');
            const url = this.routes.ADD_NEW_REQUIREMENT.replace(
                ':business_id',
                this.businessId as string
            ).replace(':application_id', this.applicationId as string);
            console.log(url);
            console.log(formData);
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN':
                        $('meta[name="csrf-token"]').attr('content') || '',
                },
                body: formData,
            });
            const data = await response.json();
            if (response.ok) {
                showToastFeedback('success', data?.message);
            } else {
                throw new Error(data?.message || 'Failed to add requirement');
            }
        } catch (error: any) {
            processError(
                'Error in Adding Requirement: ',
                error.message || error,
                true
            );
        }
    }

    destroy() {
        try {
            this.addRequirementForm.off('submit');
        } catch (error) {
            processError('Error in Destroying Event Listener: ', error);
        }
    }
}
