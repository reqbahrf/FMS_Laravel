import {
    showProcessToast,
    showToastFeedback,
    hideProcessToast,
} from '../Utilities/feedback-toast';
import {
    customDateFormatter,
    serializeFormData,
} from '../Utilities/utilFunctions';
import BENCHMARKTableConfig from '../Form_Config/form-table-config/tnaFormBenchMarkTableConfig';
import PROJECT_PROPOSAL_TABLE_CONFIG from '../Form_Config/form-table-config/projectProposalTableConfig';
import { TableDataExtractor } from '../Utilities/TableDataExtractor';
import TNAFormEvent from './application-form-events/TNAFormEvent';
import ProposalFormEvent from './application-form-events/ProposalFormEvent';
import RTECFormEvent from './application-form-events/RTECFormEvent';
type Action = 'edit' | 'view';
class TNAForm {
    private TNAModalContainer: JQuery<HTMLElement>;
    private TNAForm: JQuery<HTMLFormElement> | null;
    private TNAFormEvent: TNAFormEvent | null;
    private GeneratePDFBtn: JQuery<HTMLButtonElement> | null;
    private business_Id: string | null;
    private application_Id: string | null;
    private statusTable: JQuery<HTMLTableElement> | null;
    constructor(TNAModalContainer: JQuery<HTMLElement>) {
        this.TNAModalContainer = TNAModalContainer;
        this.statusTable = $('table#tnaTable');
        this.business_Id = null;
        this.application_Id = null;
        this.TNAForm = null;
        this.TNAFormEvent = null;
        this.GeneratePDFBtn = null;
    }
    public setId(business_Id: string, application_Id: string): void {
        this.business_Id = business_Id;
        this.application_Id = application_Id;
        this._getTNAFormStatus();
    }
    private async _getTNAFormStatus(): Promise<void> {
        try {
            if (!this.business_Id || !this.application_Id) {
                throw new Error('Business ID or Application ID not found');
            }
            const response = await $.ajax({
                type: 'GET',
                url: APPLICANT_TAB_ROUTE.GET_TNA_FORM_STATUS.replace(
                    ':business_id',
                    this.business_Id
                ).replace(':application_id', this.application_Id),
            });
            this._updateStatusTable(response);
        } catch (error: any) {
            console.warn('Error in Retrieving TNA form status' + error);
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message || error?.message
            );
        }
    }
    private _updateStatusTable(response: any) {
        this.statusTable?.find('tbody td:nth-child(-n+3)').empty();
        this.statusTable
            ?.find('tbody td:nth-child(1)')
            .html(
                /*html*/ `<span class="badge rounded-pill bg-${response.status == 'pending' ? 'secondary' : 'success'} text-center">${response.status}</span>`
            );
        this.statusTable
            ?.find('tbody td:nth-child(2)')
            .html(
                /*html*/ `${response.reviewer_name || ''}&nbsp;<span class="badge rounded-pill bg-success text-center">${customDateFormatter(response.reviewed_at) || 'Not Reviewed yet'}</span>`
            );
        this.statusTable
            ?.find('tbody td:nth-child(3)')
            .html(
                /*html*/ `${response.modifier_name || ''}&nbsp;<span class="badge rounded-pill bg-success text-center">${customDateFormatter(response.modified_at) || 'Not Modified yet'}</span>`
            );
    }
    private async _getTNAForm(
        business_Id: string,
        application_Id: string,
        actionMode: Action
    ) {
        try {
            const response = await $.ajax({
                type: 'GET',
                url: APPLICANT_TAB_ROUTE.GET_TNA_DOCUMENT.replace(
                    ':business_id',
                    business_Id
                )
                    .replace(':application_id', application_Id)
                    .replace(':action', actionMode),
            });
            this.TNAModalContainer.find('.modal-body').html(response as string);
            this.TNAForm = this._getFormInstance();
            switch (actionMode) {
                case 'edit':
                    this._setupTNAFormSubmission();
                    if (this.TNAFormEvent) {
                        this.TNAFormEvent.destroy();
                    }
                    this.TNAFormEvent = new TNAFormEvent(this.TNAForm);
                    break;
                case 'view':
                    this._setupTNAPDFExport();
                    break;
                default:
                    throw new Error('Invalid action');
            }
        } catch (error: any) {
            console.warn('Error in Retrieving TNA form' + error);
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message || error?.message
            );
        }
    }

    private _getFormInstance(): JQuery<HTMLFormElement> {
        return this.TNAModalContainer.find('.modal-body')
            .find('form#TNAForm')
            .first() as JQuery<HTMLFormElement>;
    }

    private async _saveTNAForm(
        TNAFormRequest: { [key: string]: string | string[] },
        url: string
    ): Promise<void> {
        try {
            showProcessToast('Setting TNA form...');
            const response = await $.ajax({
                type: 'PUT',
                url: url,
                data: JSON.stringify(TNAFormRequest),
                contentType: 'application/json',
                dataType: 'json',
                processData: false,
                headers: {
                    'X-CSRF-TOKEN':
                        $('meta[name="csrf-token"]').attr('content') || '',
                },
            });
            hideProcessToast();
            showToastFeedback('text-bg-success', response.message);
        } catch (error: any) {
            hideProcessToast();
            console.warn('Error in Setting TNA form' + error);
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message ||
                    error?.message ||
                    'Error in Setting TNA form'
            );
        } finally {
            this._getTNAFormStatus();
        }
    }

    private _setupTNAFormSubmission(): void {
        try {
            if (!this.TNAForm) throw new Error('Form not found');
            const form = this.TNAForm;

            form.on('submit', async (event: JQuery.SubmitEvent) => {
                event.preventDefault();
                try {
                    const url = form.attr('action');
                    const formData = form.serializeArray();
                    if (!url || !formData || !formData.length)
                        throw new Error('Form data not found');

                    let formDataObject: { [key: string]: string | string[] } =
                        serializeFormData(formData);

                    formDataObject = {
                        ...formDataObject,
                        ...TableDataExtractor(BENCHMARKTableConfig),
                    };
                    await this._saveTNAForm(formDataObject, url);
                } catch (SubmissionError: any) {
                    console.warn(
                        'Error in Initializing TNA form' + SubmissionError
                    );
                    showToastFeedback(
                        'text-bg-danger',
                        SubmissionError?.responseJSON?.message ||
                            SubmissionError?.message ||
                            'Error in Setting TNA form'
                    );
                }
            });
        } catch (error: any) {
            hideProcessToast();
            console.warn('Error in Setting TNA form' + error);
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message ||
                    error?.message ||
                    'Error in Setting TNA form'
            );
        }
    }

    private _setupTNAPDFExport(): void {
        try {
            this.GeneratePDFBtn = this.TNAModalContainer.find(
                '#exportTNAFormToPDF'
            );

            if (!this.GeneratePDFBtn)
                throw new Error('Generate PDF Button not found');

            this.GeneratePDFBtn.on('click', async () => {
                const generateUrl =
                    this.GeneratePDFBtn?.attr('data-generated-url');
                if (!generateUrl) throw new Error('Generate URL not found');
                window.open(generateUrl, '_blank');
            });
        } catch (error: any) {
            console.warn('Error in Setting TNA form' + error);
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message ||
                    error?.message ||
                    'Error in Setting TNA form'
            );
        }
    }
    initializeTNAForm() {
        console.log('this is initializeTNAForm');
        this.TNAModalContainer.on('show.bs.modal', async (event: any) => {
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
                showToastFeedback(
                    'text-bg-danger',
                    'Invalid data Business id or Application id'
                );
                return;
            }
            await this._getTNAForm(business_Id, application_Id, actionMode);
        });
    }
}

class ProjectProposalForm {
    private ProjectProposalModalContainer: JQuery<HTMLElement>;
    private ProjectProposalForm: JQuery<HTMLFormElement> | null;
    private ProjectProposalFormEvent: ProposalFormEvent | null;
    private GeneratePDFBtn: JQuery<HTMLElement> | null;
    private business_Id: string | null;
    private application_Id: string | null;
    private statusTable: JQuery<HTMLElement> | null;
    constructor(ProjectProposalModalContainer: JQuery<HTMLElement>) {
        this.ProjectProposalModalContainer = ProjectProposalModalContainer;
        this.statusTable = $('table#projectProposalTable');
        this.business_Id = null;
        this.application_Id = null;
        this.ProjectProposalForm = null;
        this.ProjectProposalFormEvent = null;
        this.GeneratePDFBtn = null;
    }
    public setId(business_Id: string, application_Id: string): void {
        this.business_Id = business_Id;
        this.application_Id = application_Id;
        this._getProjectProposalFormStatus();
    }
    private async _getProjectProposalFormStatus(): Promise<void> {
        try {
            if (!this.business_Id || !this.application_Id) {
                throw new Error('Business ID or Application ID not found');
            }
            const response = await $.ajax({
                type: 'GET',
                url: APPLICANT_TAB_ROUTE.GET_PROJECT_PROPOSAL_STATUS.replace(
                    ':business_id',
                    this.business_Id
                ).replace(':application_id', this.application_Id),
            });
            this._updateStatusTable(response);
        } catch (error: any) {
            console.warn(
                'Error in Retrieving Project Proposal form status' + error
            );
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message || error?.message
            );
        }
    }

    private _updateStatusTable(response: any) {
        this.statusTable?.find('tbody td:nth-child(-n+3)').empty();
        this.statusTable
            ?.find('tbody td:nth-child(1)')
            .html(
                /*html*/ `<span class="badge rounded-pill bg-${response.status == 'pending' ? 'secondary' : 'success'} text-center">${response.status}</span>`
            );
        this.statusTable
            ?.find('tbody td:nth-child(2)')
            .html(
                /*html*/ `${response.reviewer_name || ''}&nbsp;<span class="badge rounded-pill bg-success text-center">${customDateFormatter(response.reviewed_at) || 'Not Reviewed yet'}</span>`
            );
        this.statusTable
            ?.find('tbody td:nth-child(3)')
            .html(
                /*html*/ `${response.modifier_name || ''}&nbsp;<span class="badge rounded-pill bg-success text-center">${customDateFormatter(response.modified_at) || 'Not Modified yet'}</span>`
            );
    }

    private async _getProjectProposalForm(
        business_Id: string,
        application_Id: string,
        actionMode: Action
    ) {
        try {
            const response = await $.ajax({
                type: 'GET',
                url: APPLICANT_TAB_ROUTE.GET_PROJECT_PROPOSAL.replace(
                    ':business_id',
                    business_Id
                )
                    .replace(':application_id', application_Id)
                    .replace(':action', actionMode),
            });
            this.ProjectProposalModalContainer.find('.modal-body').html(
                response as string
            );
            switch (actionMode) {
                case 'edit':
                    this.ProjectProposalForm = this.__getFormInstance();
                    this._setupProjectProposalFormSubmissionListener();
                    if (this.ProjectProposalFormEvent) {
                        this.ProjectProposalFormEvent.destroy();
                    }
                    this.ProjectProposalFormEvent = new ProposalFormEvent(
                        this.ProjectProposalForm
                    );
                    break;
                case 'view':
                    this._setupProjectProposalPDFExport();
                    break;
            }
        } catch (error: any) {
            console.warn('Error in Retrieving Project Proposal' + error);
            showToastFeedback(
                'text-bg-danger',
                error.responseJSON.message || error.message
            );
        }
    }

    private __getFormInstance(): JQuery<HTMLFormElement> {
        return this.ProjectProposalModalContainer.find('.modal-body')
            .find('form#ProjectProposalForm')
            .first() as JQuery<HTMLFormElement>;
    }

    private async _saveProjectProposalForm(
        ProjectProposalFormRequest: { [key: string]: string | string[] },
        url: string
    ): Promise<void> {
        try {
            showProcessToast('Setting Project Proposal form...');
            const response = await $.ajax({
                type: 'PUT',
                url: url,
                data: JSON.stringify(ProjectProposalFormRequest),
                contentType: 'application/json',
                dataType: 'json',
                processData: false,
                headers: {
                    'X-CSRF-TOKEN':
                        $('meta[name="csrf-token"]').attr('content') || '',
                },
            });
            hideProcessToast();
            showToastFeedback('text-bg-success', response.message);
        } catch (error: any) {
            hideProcessToast();
            console.warn('Error in Setting Project Proposal form' + error);
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message ||
                    error?.message ||
                    'Error in Setting Project Proposal form'
            );
        } finally {
            this._getProjectProposalFormStatus();
        }
    }

    private _setupProjectProposalFormSubmissionListener(): void {
        try {
            if (!this.ProjectProposalForm) throw new Error('Form not found');
            const form = this.ProjectProposalForm;

            form.on('submit', async (event: JQuery.SubmitEvent) => {
                event.preventDefault();
                try {
                    const url = form.attr('action');
                    const formData = form.serializeArray();
                    if (!url || !formData || !formData.length)
                        throw new Error('Form data not found');

                    let formDataObject: { [key: string]: string | string[] } =
                        serializeFormData(formData);

                    formDataObject = {
                        ...formDataObject,
                        ...TableDataExtractor(PROJECT_PROPOSAL_TABLE_CONFIG),
                    };
                    await this._saveProjectProposalForm(formDataObject, url);
                } catch (SubmissionError: any) {
                    console.warn(
                        'Error in Initializing Project Proposal form' +
                            SubmissionError
                    );
                    showToastFeedback(
                        'text-bg-danger',
                        SubmissionError?.responseJSON?.message ||
                            SubmissionError?.message ||
                            'Error in Setting Project Proposal form'
                    );
                }
            });
        } catch (error: any) {
            console.warn('Error in Setting Project Proposal form' + error);
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message ||
                    error?.message ||
                    'Error in Setting Project Proposal form'
            );
        }
    }

    private _setupProjectProposalPDFExport(): void {
        try {
            this.GeneratePDFBtn = this.ProjectProposalModalContainer.find(
                '#exportProjectProposalFormToPDF'
            );
            if (!this.GeneratePDFBtn) throw new Error('Button not found');
            this.GeneratePDFBtn.on('click', async () => {
                try {
                    const generateUrl =
                        this.GeneratePDFBtn?.attr('data-generated-url');
                    if (!generateUrl) throw new Error('Generate URL not found');
                    window.open(generateUrl, '_blank');
                } catch (error: any) {
                    throw error;
                }
            });
        } catch (error: any) {
            console.warn('Error in Setting Project Proposal form' + error);
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message ||
                    error?.message ||
                    'Error in Setting Project Proposal form'
            );
        }
    }

    initializeProjectProposalForm() {
        this.ProjectProposalModalContainer.on(
            'show.bs.modal',
            async (event: any) => {
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
                        showToastFeedback(
                            'text-bg-danger',
                            'Invalid data Business id or Application id'
                        );
                        return;
                    }
                    await this._getProjectProposalForm(
                        business_Id,
                        application_Id,
                        actionMode
                    );
                } catch (error: any) {
                    console.warn(
                        'Error in Retrieving Project Proposal' + error
                    );
                    showToastFeedback(
                        'text-bg-danger',
                        error?.responseJSON?.message ||
                            error?.message ||
                            'Error in Retrieving Project Proposal'
                    );
                }
            }
        );
    }
}

class RTECReportForm {
    private RTECReportModalContainer: JQuery<HTMLElement>;
    private RTECReportForm: JQuery<HTMLFormElement> | null;
    private RTECReportFormEvent: RTECFormEvent | null;
    private GeneratePDFBtn: JQuery<HTMLElement> | null;
    private business_Id: string | null;
    private application_Id: string | null;
    private statusTable: JQuery<HTMLElement> | null;

    constructor(RTECReportModalContainer: JQuery<HTMLElement>) {
        this.RTECReportModalContainer = RTECReportModalContainer;
        this.statusTable = $('table#rtecReportTable');
        this.RTECReportForm = null;
        this.RTECReportFormEvent = null;
        this.GeneratePDFBtn = null;
        this.business_Id = null;
        this.application_Id = null;
    }

    public setId(business_Id: string, application_Id: string): void {
        this.business_Id = business_Id;
        this.application_Id = application_Id;
        this._getRTECReportFormStatus();
    }

    private async _getRTECReportFormStatus(): Promise<void> {
        try {
            if (!this.business_Id || !this.application_Id) {
                throw new Error('Business ID or Application ID not found');
            }
            const response = await $.ajax({
                url: APPLICANT_TAB_ROUTE.GET_RTEC_REPORT_STATUS.replace(
                    ':business_id',
                    this.business_Id
                ).replace(':application_id', this.application_Id),
            });
            this._updateStatusTable(response);
        } catch (error: any) {
            console.warn('Error in Retrieving RTEC Report' + error);
        }
    }

    private _updateStatusTable(response: any) {
        this.statusTable?.find('tbody td:nth-child(-n+3)').empty();
        this.statusTable
            ?.find('tbody td:nth-child(1)')
            .html(
                /*html*/ `<span class="badge rounded-pill bg-${response.status == 'pending' ? 'secondary' : 'success'} text-center">${response.status}</span>`
            );
        this.statusTable
            ?.find('tbody td:nth-child(2)')
            .html(
                /*html*/ `${response.reviewer_name || ''}&nbsp;<span class="badge rounded-pill bg-success text-center">${customDateFormatter(response.reviewed_at) || 'Not Reviewed yet'}</span>`
            );
        this.statusTable
            ?.find('tbody td:nth-child(3)')
            .html(
                /*html*/ `${response.modifier_name || ''}&nbsp;<span class="badge rounded-pill bg-success text-center">${customDateFormatter(response.modified_at) || 'Not Modified yet'}</span>`
            );
    }
    private async _getRTECReportForm(
        business_Id: string,
        application_Id: string,
        actionMode: Action
    ) {
        try {
            const response = await $.ajax({
                type: 'GET',
                url: APPLICANT_TAB_ROUTE.GET_RTEC_REPORT.replace(
                    ':business_id',
                    business_Id
                )
                    .replace(':application_id', application_Id)
                    .replace(':action', actionMode),
            });
            this.RTECReportModalContainer.find('.modal-body').html(
                response as string
            );
            this.RTECReportForm = this._getFormInstance();
            switch (actionMode) {
                case 'edit':
                    this._setupRTECFormSubmissionListener();
                    if (this.RTECReportFormEvent) {
                        this.RTECReportFormEvent.destroy();
                    }
                    this.RTECReportFormEvent = new RTECFormEvent(
                        this.RTECReportForm
                    );
                    break;
                case 'view':
                    this._setupRTECPDFExport();
                    break;
                default:
                    throw new Error('Invalid action');
            }
        } catch (error: any) {
            console.warn('Error in Retrieving RTEC Report' + error);
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message ||
                    error?.message ||
                    'Error in Retrieving RTEC Report'
            );
        }
    }

    private _getFormInstance(): JQuery<HTMLFormElement> {
        return this.RTECReportModalContainer.find('.modal-body')
            .find('form#RTECReportForm')
            .first() as JQuery<HTMLFormElement>;
    }

    private async _saveRTECReportForm(
        RTECReportFormRequest: { [key: string]: string | string[] },
        url: string
    ): Promise<void> {
        try {
            showProcessToast('Setting RTEC Report form');
            const response = await $.ajax({
                type: 'PUT',
                url: url,
                data: JSON.stringify(RTECReportFormRequest),
                contentType: 'application/json',
                dataType: 'json',
                processData: false,
                headers: {
                    'X-CSRF-TOKEN':
                        $('meta[name="csrf-token"]').attr('content') || '',
                },
            });
            hideProcessToast();
            showToastFeedback('text-bg-success', response.message);
        } catch (error: any) {
            hideProcessToast();
            console.warn('Error in Setting RTEC Report form' + error);
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message ||
                    error?.message ||
                    'Error in Setting RTEC Report form'
            );
        } finally {
            this._getRTECReportFormStatus();
        }
    }

    private _setupRTECFormSubmissionListener(): void {
        try {
            if (!this.RTECReportForm) throw new Error('Form not found');
            const form = this.RTECReportForm;

            form.on('submit', async (event: JQuery.SubmitEvent) => {
                event.preventDefault();
                try {
                    const url = form.attr('action');
                    const formData = form.serializeArray();

                    if (!url || !formData || !formData.length)
                        throw new Error('Form data not found');

                    let formDataObject: { [key: string]: string | string[] } =
                        serializeFormData(formData);

                    //TODO : add table config for this form table
                    // formDataObject = {
                    //     ...formDataObject,
                    //     ...TableDataExtractor(BENCHMARKTableConfig),
                    // };
                    await this._saveRTECReportForm(formDataObject, url);
                } catch (SubmissionError: any) {
                    console.warn(
                        'Error in Initializing RTEC Report form' +
                            SubmissionError
                    );
                    showToastFeedback(
                        'text-bg-danger',
                        SubmissionError?.responseJSON?.message ||
                            SubmissionError?.message ||
                            'Error in Setting RTEC Report form'
                    );
                }
            });
        } catch (error: any) {
            console.warn('Error in Setting RTEC Report form' + error);
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message ||
                    error?.message ||
                    'Error in Setting RTEC Report form'
            );
        }
    }

    private _setupRTECPDFExport(): void {
        try {
            this.GeneratePDFBtn = this.RTECReportModalContainer.find(
                'button#exportRTECReportFormToPDF'
            );

            this.GeneratePDFBtn.on('click', async () => {
                const generateUrl =
                    this.GeneratePDFBtn?.attr('data-generated-url');
                if (!generateUrl) throw new Error('Generate URL not found');
                window.open(generateUrl, '_blank');
            });
        } catch (error: any) {
            console.warn('Error in Setting RTEC Report form' + error);
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message ||
                    error?.message ||
                    'Error in Setting RTEC Report form'
            );
        }
    }

    initializeRTECReportForm() {
        this.RTECReportModalContainer.on(
            'show.bs.modal',
            async (event: any) => {
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
                    showToastFeedback(
                        'text-bg-danger',
                        'Invalid data Business id or Application id'
                    );
                    return;
                }
                await this._getRTECReportForm(
                    business_Id,
                    application_Id,
                    actionMode
                );
            }
        );
    }
}

export { TNAForm, ProjectProposalForm, RTECReportForm };
