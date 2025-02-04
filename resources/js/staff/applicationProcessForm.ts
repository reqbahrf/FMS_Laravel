
import { showToastFeedback } from '../Utilities/utilFunctions';
 class TNAForm {
    private TNAModalContainer: JQuery<HTMLElement>;
    constructor(TNAModalContainer: JQuery<HTMLElement>) {
        this.TNAModalContainer = TNAModalContainer;
    }
    async getTNAForm(business_Id: number) {
        try {
            const response = await $.ajax({
                type: 'GET',
                url: APPLICANT_TAB_ROUTE.GET_TNA_DOCUMENT.replace(
                    ':business_id',
                    business_Id.toString()
                ),
            });
            this.TNAModalContainer.find('.modal-body').html(response as string);
        } catch (error: any) {
            showToastFeedback('text-bg-danger', error.responseJSON.message);
        }
    }
    initializeTNAForm() {
        this.TNAModalContainer.on('show.bs.modal', async (event: any) => {
            const business_Id = $(event.relatedTarget).data('business-id');
            await this.getTNAForm(business_Id);
        });
    }
}

 class ProjectProposalForm {
    private ProjectProposalModalContainer: JQuery<HTMLElement>;

    constructor(ProjectProposalModalContainer: JQuery<HTMLElement>) {
        this.ProjectProposalModalContainer = ProjectProposalModalContainer;
    }
    async getProjectProposalForm(business_Id: number) {
        try {
            const response = await $.ajax({
                type: 'GET',
                url: APPLICANT_TAB_ROUTE.GET_PROJECT_PROPOSAL.replace(
                    ':business_id',
                    business_Id.toString()
                ),
            });
            this.ProjectProposalModalContainer.find('.modal-body').html(response as string);
        } catch (error: any) {
            showToastFeedback('text-bg-danger', error.responseJSON.message);
        }
    }

    initializeProjectProposalForm() {
        this.ProjectProposalModalContainer.on('show.bs.modal', async (event: any) => {
            const business_Id = $(event.relatedTarget).data('business-id');
            await this.getProjectProposalForm(business_Id);
        });
    }

}

export {TNAForm, ProjectProposalForm}
