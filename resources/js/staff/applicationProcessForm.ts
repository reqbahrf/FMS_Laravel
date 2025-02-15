
import { showProcessToast, showToastFeedback, hideProcessToast } from '../Utilities/utilFunctions';
import BENCHMARKTableConfig from '../Form_Config/form-table-config/tnaFormBenchMarkTableConfig';
import { TableDataExtractor } from '../Utilities/TableDataExtractor';
 class TNAForm {
    private TNAModalContainer: JQuery<HTMLElement>;
    private TNAForm: JQuery<HTMLFormElement> | null
    constructor(TNAModalContainer: JQuery<HTMLElement>) {
        this.TNAModalContainer = TNAModalContainer;
        this.TNAForm = null
    }
    private async getTNAForm(business_Id: string, application_Id: string, action: string) {
        try {
            const response = await $.ajax({
                type: 'GET',
                url: APPLICANT_TAB_ROUTE.GET_TNA_DOCUMENT.replace(
                    ':business_id',
                    business_Id
                ).replace(':application_id', application_Id).replace(':action', action),
            });
            this.TNAModalContainer.find('.modal-body').html(response as string);
            if(action == 'edit') {
                this.TNAForm = this.getFormInstance();
                this.initializeTNAFormSubmissionListener();
            }
        } catch (error: any) {
            console.warn('Error in Retrieving TNA form' + error);
            showToastFeedback('text-bg-danger', error.responseJSON.message || error.message);
        }
    }

    private getFormInstance(): JQuery<HTMLFormElement> {
        return this.TNAModalContainer.find('.modal-body').find('form#TNAForm').first() as JQuery<HTMLFormElement>;
    }

    private async saveTNAForm(TNAFormRequest: { [key: string]: string | string[] }, url: string): Promise<void> {
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
            console.warn('Error in Setting TNA form' + error);
            showToastFeedback('text-bg-danger', error.responseJSON.message || error.message);
        }
    }

    private initializeTNAFormSubmissionListener(): void {
        try {
            if(!this.TNAForm) throw new Error('Form not found');
            console.log(this.TNAForm);
            const form = this.TNAForm;
            form.on('submit', async (event: JQuery.SubmitEvent) => {
                event.preventDefault();
                let FormDataObject: { [key: string]: string | string[] } = {};

                const url = form.attr('action');
                const formData = form.serializeArray();
                if(!url || !formData) throw new Error('Form data not found');

                $.each(formData, function (i, v) {
                    if (v.name.includes('[]')) {
                        FormDataObject[v.name] = FormDataObject[v.name]
                            ? [...FormDataObject[v.name], v.value]
                            : [v.value];
                    } else {
                        FormDataObject[v.name] = v.value;
                    }
                });

                FormDataObject = {
                    ...FormDataObject,
                    ...TableDataExtractor(BENCHMARKTableConfig),
                };
                await this.saveTNAForm(FormDataObject, url);
            })

        }catch(error: any) {
            console.warn('Error in Setting TNA form' + error);
            showToastFeedback('text-bg-danger', error.responseJSON.message || error.message);
        }
    }
    initializeTNAForm() {
        this.TNAModalContainer.on('show.bs.modal', async (event: any) => {
            const business_Id = $(event.relatedTarget).attr('data-business-id');
            const application_Id = $(event.relatedTarget).attr('data-application-id');
            const action = $(event.relatedTarget).attr('data-action');
            if (!business_Id || !application_Id || !action) {
                showToastFeedback('text-bg-danger', 'Invalid data Business id or Application id');
                return;
            }
            await this.getTNAForm(business_Id, application_Id, action);
        });
    }
}

 class ProjectProposalForm {
    private ProjectProposalModalContainer: JQuery<HTMLElement>;

    constructor(ProjectProposalModalContainer: JQuery<HTMLElement>) {
        this.ProjectProposalModalContainer = ProjectProposalModalContainer;
    }
    //TODO: update this method handle Project Proposal data
    async getProjectProposalForm(business_Id: string|undefined, application_Id: string|undefined) {
        try {
            const response = await $.ajax({
                type: 'GET',
                url: APPLICANT_TAB_ROUTE.GET_PROJECT_PROPOSAL.replace(
                    ':business_id',
                    business_Id ?? ''
                ),
            });
            this.ProjectProposalModalContainer.find('.modal-body').html(response as string);
        } catch (error: any) {
            console.warn('Error in Retrieving Project Proposal' + error);
            showToastFeedback('text-bg-danger', error.responseJSON.message || error.message);
        }
    }

    initializeProjectProposalForm() {
        this.ProjectProposalModalContainer.on('show.bs.modal', async (event: any) => {
            const business_Id = $(event.relatedTarget).attr('business-id');
            const application_Id = $(event.relatedTarget).attr('application-id');
            // if (!business_Id || !application_Id) {
            //     showToastFeedback('text-bg-danger', 'Invalid data Business id or Application id');
            //     return;
            // }
            await this.getProjectProposalForm(business_Id, application_Id);
        });
    }

}

class RTECReportForm {
    private RTECReportModalContainer: JQuery<HTMLElement>;

    constructor(RTECReportModalContainer: JQuery<HTMLElement>) {
        this.RTECReportModalContainer = RTECReportModalContainer;
    }

    async getRTECReportForm(business_Id: string|undefined, application_Id: string|undefined) {
        try {
            const response = await $.ajax({
                type: 'GET',
                url: APPLICANT_TAB_ROUTE.GET_RTEC_REPORT.replace(
                    ':business_id',
                    business_Id ?? ''
                ).replace(':application_id', application_Id ?? ''),
            });
            this.RTECReportModalContainer.find('.modal-body').html(response as string);
        } catch (error: any) {
            console.warn('Error in Retrieving RTEC Report' + error);
            showToastFeedback('text-bg-danger', error.responseJSON.message || error.message);
        }
    }

    initializeRTECReportForm() {
        this.RTECReportModalContainer.on('show.bs.modal', async (event: any) => {
            const business_Id = $(event.relatedTarget).attr('business-id');
            const application_Id = $(event.relatedTarget).attr('application-id');
            // if (!business_Id || !application_Id) {
            //     showToastFeedback('text-bg-danger', 'Invalid data Business id or Application id');
            //     return;
            // }
            await this.getRTECReportForm(business_Id, application_Id);
        });
    }
}

export {TNAForm, ProjectProposalForm, RTECReportForm}
