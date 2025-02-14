
import { showToastFeedback } from '../Utilities/utilFunctions';
 class TNAForm {
    private TNAModalContainer: JQuery<HTMLElement>;
    constructor(TNAModalContainer: JQuery<HTMLElement>) {
        this.TNAModalContainer = TNAModalContainer;
    }
    async getTNAForm(business_Id: string, application_Id: string) {
        try {
            const response = await $.ajax({
                type: 'GET',
                url: APPLICANT_TAB_ROUTE.GET_TNA_DOCUMENT.replace(
                    ':business_id',
                    business_Id
                ).replace(':application_id', application_Id),
            });
            this.TNAModalContainer.find('.modal-body').html(response as string);
        } catch (error: any) {
            console.warn('Error in Retrieving TNA form' + error);
            showToastFeedback('text-bg-danger', error.responseJSON.message || error.message);
        }
    }
    initializeTNAForm() {
        this.TNAModalContainer.on('show.bs.modal', async (event: any) => {
            const business_Id = $(event.relatedTarget).attr('data-business-id');
            const application_Id = $(event.relatedTarget).attr('data-application-id');
            if (!business_Id || !application_Id) {
                showToastFeedback('text-bg-danger', 'Invalid data Business id or Application id');
                return;
            }
            await this.getTNAForm(business_Id, application_Id);
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
