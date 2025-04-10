import BENCHMARKTableConfig from '../../Form_Config/form-table-config/tnaFormBenchMarkTableConfig';
import TNAFormEvent from '../application-process-form-events/TNAFormEvent';
import { BaseApplicationForm, Action } from './BaseApplicationForm';
/**
 * TNA Form class that extends the base functionality
 */
export default class TNAForm extends BaseApplicationForm {
    protected formSelector: string = 'form#TNAForm';
    protected pdfButtonSelector: string = '#exportTNAFormToPDF';
    protected formName: string = 'TNA';
    protected routeKeys = {
        getStatus: APPLICANT_TAB_ROUTE.GET_TNA_FORM_STATUS,
        getForm: APPLICANT_TAB_ROUTE.GET_TNA_DOCUMENT,
    };
    private TNAFormEvent: TNAFormEvent | null = null;

    constructor(TNAModalContainer: JQuery<HTMLElement>) {
        super(TNAModalContainer, 'table#tnaTable');
    }

    protected _setupFormByActionMode(actionMode: Action): void {
        this._updateStatusModalLabel();
        switch (actionMode) {
            case 'edit':
                this._setupFormSubmission(BENCHMARKTableConfig);
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
        if (this.TNAFormEvent) {
            this.TNAFormEvent.destroy();
        }
        if (this.form) {
            this.TNAFormEvent = new TNAFormEvent(this.form);
        }
    }

    // Public method for backward compatibility
    public initializeTNAForm(): void {
        console.log('this is initializeTNAForm');
        this.initializeForm();
    }
}
