import createConfirmationModal from '../../Utilities/confirmation-modal';
import { processError } from '../../Utilities/error-handler-util';
import {
    hideProcessToast,
    showProcessToast,
    showToastFeedback,
} from '../../Utilities/feedback-toast';
import { serializeFormData } from '../../Utilities/utilFunctions';

export default class AddApplicant {
    private formElement: JQuery<HTMLFormElement> | null;
    private applicantListTable: JQuery<HTMLTableElement> | null;
    constructor() {
        this.formElement = null;
        this.applicantListTable = null;
    }

    public setupFormSubmitHandler() {
        this.formElement = $('#addApplicantForm');
        try {
            if (!this.formElement) throw new Error('Form element not found');
            const form = this.formElement;
            form.on('submit', async (event: JQuery.SubmitEvent) => {
                event.preventDefault();
                const isConfirmed = await createConfirmationModal({
                    title: 'Confirm Applicant Addition',
                    message: 'Are you sure you want to add this applicant?',
                    confirmText: 'Yes',
                    cancelText: 'No',
                });
                if (!isConfirmed) return;
                try {
                    const url = form.attr('action');
                    const formData = form.serializeArray();
                    if (!formData || !formData.length || !url)
                        throw new Error('Form data not found');
                    const formDataObject = serializeFormData(formData);
                    await this._saveApplicant(formDataObject, url);
                } catch (error: any) {
                    processError('Error in Adding Applicant: ', error, true);
                }
            });
        } catch (error) {
            processError('Error in Setting Up Form Submit Handler: ', error);
        }
    }

    public setupApplicantTableActionListener() {
        this.applicantListTable = $('#applicantListTable');
        try {
            if (!this.applicantListTable)
                throw new Error('Applicant list table not found');
            const table = this.applicantListTable;
            table
                .find('tbody')
                .on(
                    'click',
                    '.editApplicantForm',
                    (event: JQuery.ClickEvent) => {
                        const button = $(event.target);
                        const secureFormLink = button.data('secure-form-link');
                        if (!secureFormLink)
                            throw new Error('Secure form link not found');
                        window.loadPage(secureFormLink, 'projectLink');
                    }
                );
        } catch (error) {
            processError(
                'Error in Setting Up Applicant Table Action Listener: ',
                error,
                true
            );
        }
    }

    private async _saveApplicant(
        formData: { [key: string]: any },
        url: string
    ) {
        const processToast = showProcessToast('Saving Applicant...');
        try {
            const response = await $.ajax({
                type: 'POST',
                url: url,
                data: JSON.stringify(formData),
                contentType: 'application/json',
                dataType: 'json',
                processData: false,
                headers: {
                    'X-CSRF-TOKEN':
                        $('meta[name="csrf-token"]').attr('content') || '',
                },
            });
            hideProcessToast(processToast);
            showToastFeedback('text-bg-success', response?.message);
        } catch (error: any) {
            hideProcessToast(processToast);
            processError('Error in Saving Applicant: ', error, true);
        }
    }
}
