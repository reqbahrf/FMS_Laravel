import {
    showProcessToast,
    showToastFeedback,
    hideProcessToast,
} from '../../Utilities/feedback-toast';
import {
    customDateFormatter,
    serializeFormData,
} from '../../Utilities/utilFunctions';
import { processError } from '../../Utilities/error-handler-util';
import '../../../css/pdf-loading.css';
import { TableDataExtractor } from '../../Utilities/TableDataExtractor';
import generatePDF from '../../Utilities/loading-overlay-pdf-generation';
export type Action = 'edit' | 'view';

/**
 * Abstract base class for application form processing
 * Contains common functionality for all form types
 */
abstract class BaseApplicationForm {
    protected modalContainer: JQuery<HTMLElement>;
    protected form: JQuery<HTMLFormElement> | null;
    protected formEvent: any | null;
    protected generatePDFBtn: JQuery<HTMLElement> | null;
    protected business_Id: string | null;
    protected application_Id: string | null;
    protected statusTable: JQuery<HTMLElement> | null;

    protected abstract formSelector: string;
    protected abstract pdfButtonSelector: string;
    protected abstract routeKeys: {
        getStatus: string;
        getForm: string;
    };
    protected abstract formName: string;

    constructor(
        modalContainer: JQuery<HTMLElement>,
        statusTableSelector: string
    ) {
        this.modalContainer = modalContainer;
        this.statusTable = $(statusTableSelector);
        this.business_Id = null;
        this.application_Id = null;
        this.form = null;
        this.formEvent = null;
        this.generatePDFBtn = null;
    }

    /**
     * Sets business and application IDs and fetches form status
     */
    public setId(business_Id: string, application_Id: string): void {
        this.business_Id = business_Id;
        this.application_Id = application_Id;
        this._getFormStatus();
    }

    protected _updateStatusModalLabel(): void {
        // Get status label text once and trim it
        const statusLabel =
            this.statusTable?.find('tbody td:nth-child(1)')?.text()?.trim() ||
            '';

        // Determine badge text based on status
        let badgeText: string;
        switch (statusLabel) {
            case 'pending':
                badgeText = 'Modified By:';
                break;
            case 'reviewed':
                badgeText = 'Reviewed By:';
                break;
            default:
                badgeText = 'Not Reviewed';
                break;
        }
        // Get the appropriate label element based on status
        let label: JQuery<HTMLElement>;
        switch (statusLabel) {
            case 'pending':
                label =
                    this.statusTable?.find('tbody td:nth-child(3)')?.clone() ||
                    $('<span></span>');
                break;
            case 'reviewed':
                label =
                    this.statusTable?.find('tbody td:nth-child(2)')?.clone() ||
                    $('<span></span>');
                break;
            default:
                label =
                    this.statusTable?.find('tbody td:nth-child(1)')?.clone() ||
                    $('<span></span>');
                break;
        }

        // Update the modal container
        const statusLabelElement = this.modalContainer.find('.status-label');
        statusLabelElement.empty();
        statusLabelElement.append(badgeText);
        statusLabelElement.append(label);
    }

    /**
     * Get status of the form from the server
     */
    protected async _getFormStatus(): Promise<void> {
        try {
            if (!this.business_Id || !this.application_Id) {
                throw new Error('Business ID or Application ID not found');
            }
            const response = await $.ajax({
                type: 'GET',
                url: this.routeKeys.getStatus
                    .replace(':business_id', this.business_Id)
                    .replace(':application_id', this.application_Id),
            });
            this._updateStatusTable(response);
        } catch (error: any) {
            processError(
                `Error in Retrieving ${this.formName} form status:`,
                error,
                true
            );
        }
    }

    /**
     * Updates status table with response data
     */
    protected _updateStatusTable(response: any) {
        this.statusTable?.find('tbody td:nth-child(-n+3)').empty();
        this.statusTable
            ?.find('tbody td:nth-child(1)')
            .html(
                /*html*/ `<span class="badge rounded-pill bg-${response.status == 'pending' ? 'secondary' : 'success'} text-center document-status">${response.status}</span>`
            );
        this.statusTable
            ?.find('tbody td:nth-child(2)')
            .html(
                /*html*/ `<span class="badge rounded-pill bg-success text-center">${response.reviewer_name ? response.reviewer_name + '@' : ''}&nbsp;${customDateFormatter(response.reviewed_at) || 'Not Reviewed yet'}</span>`
            );
        this.statusTable
            ?.find('tbody td:nth-child(3)')
            .html(
                /*html*/ `<span class="badge rounded-pill bg-success text-center">${response.modifier_name ? response.modifier_name + '@' : ''}&nbsp;${customDateFormatter(response.modified_at) || 'Not Modified yet'}</span>`
            );
    }

    /**
     * Gets form HTML from server and initializes it
     */
    protected async _getFormData(
        business_Id: string,
        application_Id: string,
        actionMode: Action
    ) {
        try {
            const response = await $.ajax({
                type: 'GET',
                url: this.routeKeys.getForm
                    .replace(':business_id', business_Id)
                    .replace(':application_id', application_Id)
                    .replace(':action', actionMode),
            });
            this.modalContainer.find('.modal-body').html(response as string);
            this.form = this._getFormInstance();

            this._setupFormByActionMode(actionMode);
        } catch (error: any) {
            processError(
                `Error in Retrieving ${this.formName} form:`,
                error,
                true
            );
        }
    }

    /**
     * Get form element from the DOM
     */
    protected _getFormInstance(): JQuery<HTMLFormElement> {
        return this.modalContainer
            .find('.modal-body')
            .find(this.formSelector)
            .first() as JQuery<HTMLFormElement>;
    }

    /**
     * Handle form setup based on action mode (edit or view)
     */
    protected abstract _setupFormByActionMode(actionMode: Action): void;

    /**
     * Creates form event handler based on form type
     */
    protected abstract _createFormEvent(): void;

    /**
     * Save form data to server
     */
    protected async _saveFormData(
        formRequest: { [key: string]: string | string[] },
        url: string
    ): Promise<void> {
        const processToast = showProcessToast(
            `Setting ${this.formName} form...`
        );
        try {
            const response = await $.ajax({
                type: 'PUT',
                url: url,
                data: JSON.stringify(formRequest),
                contentType: 'application/json',
                dataType: 'json',
                processData: false,
                headers: {
                    'X-CSRF-TOKEN':
                        $('meta[name="csrf-token"]').attr('content') || '',
                },
            });
            hideProcessToast(processToast);
            showToastFeedback('text-bg-success', response.message);
        } catch (error: any) {
            hideProcessToast(processToast);
            processError(`Error setting ${this.formName} form: `, error, true);
        } finally {
            this._getFormStatus();
        }
    }

    /**
     * Set up form submission event handling
     */
    protected _setupFormSubmission(tableConfig?: any): void {
        try {
            if (!this.form) throw new Error('Form not found');
            const form = this.form;

            form.on('submit', async (event: JQuery.SubmitEvent) => {
                event.preventDefault();
                try {
                    const url = form.attr('action');
                    const formData = form.serializeArray();
                    if (!url || !formData || !formData.length)
                        throw new Error('Form data not found');

                    let formDataObject: { [key: string]: string | string[] } =
                        serializeFormData(formData);

                    if (tableConfig) {
                        formDataObject = {
                            ...formDataObject,
                            ...TableDataExtractor(tableConfig),
                        };
                    }

                    await this._saveFormData(formDataObject, url);
                } catch (submissionError: any) {
                    processError(
                        `Error in Setting ${this.formName} form:`,
                        submissionError,
                        true
                    );
                }
            });
        } catch (error: any) {
            processError(
                `Error in Setting ${this.formName} form:`,
                error,
                true
            );
        }
    }

    /**
     * Set up PDF export button functionality
     */
    protected _setupPDFExport(): void {
        try {
            this.generatePDFBtn = this.modalContainer.find(
                this.pdfButtonSelector
            );

            if (!this.generatePDFBtn)
                throw new Error('Generate PDF Button not found');

            this.generatePDFBtn.on('click', async () => {
                const generateUrl =
                    this.generatePDFBtn?.attr('data-generated-url');
                if (!generateUrl) throw new Error('Generate URL not found');

                await generatePDF(generateUrl, this.formName);
            });
        } catch (error: any) {
            processError(
                `Error in Setting ${this.formName} form:`,
                error,
                true
            );
        }
    }

    /**
     * Initialize form modal event handlers
     */
    public initializeForm(): void {
        this.modalContainer.on('show.bs.modal', async (event: any) => {
            try {
                const business_Id =
                    this.business_Id ||
                    $(event.relatedTarget).attr('data-business-id');
                const application_Id =
                    this.application_Id ||
                    $(event.relatedTarget).attr('data-application-id');
                const actionMode = $(event.relatedTarget).attr(
                    'data-action'
                ) as Action;

                if (!business_Id || !application_Id || !actionMode) {
                    throw new Error(
                        'Invalid data Business id or Application id'
                    );
                }

                await this._getFormData(
                    business_Id,
                    application_Id,
                    actionMode
                );
            } catch (error: any) {
                processError(
                    `Error in Setting ${this.formName} form:`,
                    error,
                    true
                );
            }
        });
    }
}

export { BaseApplicationForm };
