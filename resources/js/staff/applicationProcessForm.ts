
import { showProcessToast, showToastFeedback, hideProcessToast, serializeFormData } from '../Utilities/utilFunctions';
import BENCHMARKTableConfig from '../Form_Config/form-table-config/tnaFormBenchMarkTableConfig';
import PROJECT_PROPOSAL_TABLE_CONFIG from '../Form_Config/form-table-config/projectProposalTableConfig';
import { TableDataExtractor } from '../Utilities/TableDataExtractor';

type Action = 'edit' | 'view'
 class TNAForm {
    private TNAModalContainer: JQuery<HTMLElement>;
    private TNAForm: JQuery<HTMLFormElement> | null
    constructor(TNAModalContainer: JQuery<HTMLElement>) {
        this.TNAModalContainer = TNAModalContainer;
        this.TNAForm = null
    }
    private async _getTNAForm(business_Id: string, application_Id: string, actionMode: Action) {
        try {
            const response = await $.ajax({
                type: 'GET',
                url: APPLICANT_TAB_ROUTE.GET_TNA_DOCUMENT.replace(
                    ':business_id',
                    business_Id
                ).replace(':application_id', application_Id).replace(':action', actionMode),
            });
            this.TNAModalContainer.find('.modal-body').html(response as string);
            if(actionMode == 'edit') {
                this.TNAForm = this._getFormInstance();
                this._initializeTNAFormSubmissionListener();
            }
        } catch (error: any) {
            console.warn('Error in Retrieving TNA form' + error);
            showToastFeedback('text-bg-danger', error.responseJSON.message || error.message);
        }
    }

    private _getFormInstance(): JQuery<HTMLFormElement> {
        return this.TNAModalContainer.find('.modal-body').find('form#TNAForm').first() as JQuery<HTMLFormElement>;
    }

    private async _saveTNAForm(TNAFormRequest: { [key: string]: string | string[] }, url: string): Promise<void> {
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
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || '',
                }
            });
            hideProcessToast();
            showToastFeedback('text-bg-success', response.message);

        }catch(error: any) {
            hideProcessToast();
            console.warn('Error in Setting TNA form' + error);
            showToastFeedback('text-bg-danger', error?.responseJSON?.message || error?.message || 'Error in Setting TNA form');
        }
    }

    private _initializeTNAFormSubmissionListener(): void {
        try {
            if(!this.TNAForm) throw new Error('Form not found');
            const form = this.TNAForm;

            form.on('submit', async (event: JQuery.SubmitEvent) => {
                event.preventDefault();
                try{

                    const url = form.attr('action');
                    const formData = form.serializeArray();
                    if(!url || !formData || !formData.length) throw new Error('Form data not found');

                    let formDataObject: { [key: string]: string | string[] } = serializeFormData(formData);

                    formDataObject = {
                        ...formDataObject,
                        ...TableDataExtractor(BENCHMARKTableConfig),
                    };
                    await this._saveTNAForm(formDataObject, url);
                }catch(SubmissionError: any) {
                    console.warn('Error in Initializing TNA form' + SubmissionError);
                    showToastFeedback('text-bg-danger', SubmissionError?.responseJSON?.message || SubmissionError?.message || 'Error in Setting TNA form');
                }
            })
        }catch(error: any) {
            hideProcessToast();
            console.warn('Error in Setting TNA form' + error);
            showToastFeedback('text-bg-danger', error?.responseJSON?.message || error?.message || 'Error in Setting TNA form');
        }
    }
    initializeTNAForm() {
        this.TNAModalContainer.on('show.bs.modal', async (event: any) => {
            const business_Id = $(event.relatedTarget).attr('data-business-id');
            const application_Id = $(event.relatedTarget).attr('data-application-id');
            const actionMode = $(event.relatedTarget).attr('data-action') as Action;
            if (!business_Id || !application_Id || !actionMode) {
                showToastFeedback('text-bg-danger', 'Invalid data Business id or Application id');
                return;
            }
            await this._getTNAForm(business_Id, application_Id, actionMode);
        });
    }
}

 class ProjectProposalForm {
    private ProjectProposalModalContainer: JQuery<HTMLElement>;
    private ProjectProposalForm: JQuery<HTMLFormElement> | null;

    constructor(ProjectProposalModalContainer: JQuery<HTMLElement>) {
        this.ProjectProposalModalContainer = ProjectProposalModalContainer;
        this.ProjectProposalForm = null
    }
    //TODO: update this method handle Project Proposal data
    async _getProjectProposalForm(business_Id: string, application_Id: string, actionMode: Action) {
        try {
            const response = await $.ajax({
                type: 'GET',
                url: APPLICANT_TAB_ROUTE.GET_PROJECT_PROPOSAL.replace(
                    ':business_id',
                    business_Id
                ).replace(':application_id', application_Id).replace(':action', actionMode),
            });
            this.ProjectProposalModalContainer.find('.modal-body').html(response as string);
            if(actionMode == 'edit') {
                this.ProjectProposalForm = this.__getFormInstance();
                this._initializeProjectProposalFormSubmissionListener();
            }
        } catch (error: any) {
            console.warn('Error in Retrieving Project Proposal' + error);
            showToastFeedback('text-bg-danger', error.responseJSON.message || error.message);
        }
    }

    private __getFormInstance(): JQuery<HTMLFormElement> {
        return this.ProjectProposalModalContainer.find('.modal-body').find('form#ProjectProposalForm').first() as JQuery<HTMLFormElement>;
    }

    private async _saveProjectProposalForm(ProjectProposalFormRequest: { [key: string]: string | string[] }, url: string): Promise<void> {
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
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || '',
                }
            });
            hideProcessToast();
            showToastFeedback('text-bg-success', response.message);

        }catch(error: any) {
            hideProcessToast();
            console.warn('Error in Setting Project Proposal form' + error);
            showToastFeedback('text-bg-danger', error?.responseJSON?.message || error?.message || 'Error in Setting Project Proposal form');
        }
    }

    private _initializeProjectProposalFormSubmissionListener(): void {
        try {
            if(!this.ProjectProposalForm) throw new Error('Form not found');
            const form = this.ProjectProposalForm;

            form.on('submit', async (event: JQuery.SubmitEvent) => {
                event.preventDefault();
                try{
                    const url = form.attr('action');
                    const formData = form.serializeArray();
                    if(!url || !formData || !formData.length) throw new Error('Form data not found');

                    let formDataObject: { [key: string]: string | string[] } = serializeFormData(formData);

                    formDataObject = {
                        ...formDataObject,
                        ...TableDataExtractor(PROJECT_PROPOSAL_TABLE_CONFIG),
                    };
                    await this._saveProjectProposalForm(formDataObject, url);
                }catch(SubmissionError: any) {
                    console.warn('Error in Initializing Project Proposal form' + SubmissionError);
                    showToastFeedback('text-bg-danger', SubmissionError?.responseJSON?.message || SubmissionError?.message || 'Error in Setting Project Proposal form');
                }
            })
        } catch (error:any) {
            console.warn('Error in Setting Project Proposal form' + error);
            showToastFeedback('text-bg-danger', error?.responseJSON?.message || error?.message || 'Error in Setting Project Proposal form');
        }

    }

    initializeProjectProposalForm() {
        this.ProjectProposalModalContainer.on('show.bs.modal', async (event: any) => {
            try {
                const business_Id = $(event.relatedTarget).attr('data-business-id');
                const application_Id = $(event.relatedTarget).attr('data-application-id');
                const actionMode = $(event.relatedTarget).attr('data-action') as Action;
                if (!business_Id || !application_Id || !actionMode) {
                    showToastFeedback('text-bg-danger', 'Invalid data Business id or Application id');
                    return;
                }
                await this._getProjectProposalForm(business_Id, application_Id, actionMode);
            } catch (error: any) {
                console.warn('Error in Retrieving Project Proposal' + error);
                showToastFeedback('text-bg-danger', error?.responseJSON?.message || error?.message || 'Error in Retrieving Project Proposal');
            }
        });
    }

}

class RTECReportForm {
    private RTECReportModalContainer: JQuery<HTMLElement>;
    private RTECReportForm: JQuery<HTMLFormElement> | null;

    constructor(RTECReportModalContainer: JQuery<HTMLElement>) {
        this.RTECReportModalContainer = RTECReportModalContainer;
        this.RTECReportForm = null;
    }

    async getRTECReportForm(business_Id: string, application_Id: string, actionMode: Action) {
        try {
            const response = await $.ajax({
                type: 'GET',
                url: APPLICANT_TAB_ROUTE.GET_RTEC_REPORT.replace(
                    ':business_id',
                    business_Id
                ).replace(':application_id', application_Id).replace(':action', actionMode),
            });
            this.RTECReportModalContainer.find('.modal-body').html(response as string);
            if(actionMode == 'edit') {
                this.RTECReportForm = this._getFormInstance();
                this._initializeRTECReportFormSubmissionListener();
            }
        } catch (error: any) {
            console.warn('Error in Retrieving RTEC Report' + error);
            showToastFeedback('text-bg-danger', error?.responseJSON?.message || error?.message || 'Error in Retrieving RTEC Report');
        }
    }

    private _getFormInstance(): JQuery<HTMLFormElement> {
        return this.RTECReportModalContainer.find('.modal-body').find('form#RTECReportForm').first() as JQuery<HTMLFormElement>;
    }

    private async _saveRTECReportForm(RTECReportFormRequest: { [key: string]: string | string[] }, url: string): Promise<void> {
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
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || '',
                }
            });
            hideProcessToast();
            showToastFeedback('text-bg-success', response.message);

        } catch (error: any) {
            hideProcessToast();
            console.warn('Error in Setting RTEC Report form' + error);
            showToastFeedback('text-bg-danger', error?.responseJSON?.message || error?.message || 'Error in Setting RTEC Report form');
        }
    }

    private _initializeRTECReportFormSubmissionListener(): void {
        try{
            if(!this.RTECReportForm) throw new Error('Form not found');
            const form = this.RTECReportForm;

            form.on('submit', async (event: JQuery.SubmitEvent) => {
                event.preventDefault();
               try {
                    const url = form.attr('action');
                    const formData = form.serializeArray();

                    if(!url || !formData || !formData.length) throw new Error('Form data not found');

                    let formDataObject: { [key: string]: string | string[] } = serializeFormData(formData);

                    //TODO : add table config for this form table
                    // formDataObject = {
                    //     ...formDataObject,
                    //     ...TableDataExtractor(BENCHMARKTableConfig),
                    // };
                    await this._saveRTECReportForm(formDataObject, url);

               } catch (SubmissionError: any) {
                console.warn('Error in Initializing RTEC Report form' + SubmissionError);
                    showToastFeedback('text-bg-danger', SubmissionError?.responseJSON?.message || SubmissionError?.message || 'Error in Setting RTEC Report form');

               }
            });
        }catch(error: any){
            console.warn('Error in Setting RTEC Report form' + error);
            showToastFeedback('text-bg-danger', error?.responseJSON?.message || error?.message || 'Error in Setting RTEC Report form');
        }
    }

    initializeRTECReportForm() {
        this.RTECReportModalContainer.on('show.bs.modal', async (event: any) => {
            const business_Id = $(event.relatedTarget).attr('data-business-id');
            const application_Id = $(event.relatedTarget).attr('data-application-id');
            const actionMode = $(event.relatedTarget).attr('data-action') as Action;
            if (!business_Id || !application_Id || !actionMode) {
                showToastFeedback('text-bg-danger', 'Invalid data Business id or Application id');
                return;
            }
            await this.getRTECReportForm(business_Id, application_Id, actionMode);
        });
    }
}

export {TNAForm, ProjectProposalForm, RTECReportForm}
