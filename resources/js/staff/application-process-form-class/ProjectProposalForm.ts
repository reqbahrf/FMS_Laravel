import { BaseApplicationForm, Action } from './BaseApplicationForm';
import ProposalFormEvent from '../application-process-form-events/ProposalFormEvent';
import PROJECT_PROPOSAL_TABLE_CONFIG from '../../Form_Config/form-table-config/projectProposalTableConfig';
/**
 * Project Proposal Form class that extends the base functionality
 */
export default class ProjectProposalForm extends BaseApplicationForm {
    protected formSelector: string = 'form#ProjectProposalForm';
    protected pdfButtonSelector: string = '#exportProjectProposalFormToPDF';
    protected formName: string = 'Project Proposal';
    protected routeKeys = {
        getStatus: APPLICANT_TAB_ROUTE.GET_PROJECT_PROPOSAL_STATUS,
        getForm: APPLICANT_TAB_ROUTE.GET_PROJECT_PROPOSAL,
    };
    private ProjectProposalFormEvent: ProposalFormEvent | null = null;

    constructor(ProjectProposalModalContainer: JQuery<HTMLElement>) {
        super(ProjectProposalModalContainer, 'table#projectProposalTable');
    }

    protected _setupFormByActionMode(actionMode: Action): void {
        this._updateStatusModalLabel();
        switch (actionMode) {
            case 'edit':
                this.form = this.__getFormInstance();
                this._setupFormSubmission(PROJECT_PROPOSAL_TABLE_CONFIG);
                this._createFormEvent();
                break;
            case 'view':
                this._setupPDFExport();
                break;
            default:
                throw new Error('Invalid action');
        }
    }

    protected _createFormEvent(): void {
        if (this.ProjectProposalFormEvent) {
            this.ProjectProposalFormEvent.destroy();
        }
        if (this.form) {
            this.ProjectProposalFormEvent = new ProposalFormEvent(this.form);
        }
    }

    // Keep the original method for backward compatibility or specific implementation
    private __getFormInstance(): JQuery<HTMLFormElement> {
        return this.modalContainer
            .find('.modal-body')
            .find('form#ProjectProposalForm')
            .first() as JQuery<HTMLFormElement>;
    }

    // Public method for backward compatibility
    public initializeProjectProposalForm(): void {
        this.initializeForm();
    }
}
