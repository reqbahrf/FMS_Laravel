import { Action, BaseApplicationForm } from './BaseApplicationForm';
import RTECFormEvent from '../application-process-form-events/RTECFormEvent';
import RTECTableConfig from '../../Form_Config/form-table-config/rtec-table-config';
/**
 * RTEC Report Form class that extends the base functionality
 */
export default class RTECReportForm extends BaseApplicationForm {
    protected formSelector: string = 'form#RTECReportForm';
    protected pdfButtonSelector: string = 'button#exportRTECReportFormToPDF';
    protected formName: string = 'RTEC Report';
    protected routeKeys = {
        getStatus: APPLICANT_TAB_ROUTE.GET_RTEC_REPORT_STATUS,
        getForm: APPLICANT_TAB_ROUTE.GET_RTEC_REPORT,
    };
    private RTECReportFormEvent: RTECFormEvent | null = null;

    constructor(RTECReportModalContainer: JQuery<HTMLElement>) {
        super(RTECReportModalContainer, 'table#rtecReportTable');
    }

    protected _setupFormByActionMode(actionMode: Action): void {
        this._updateStatusModalLabel();
        switch (actionMode) {
            case 'edit':
                this._setupFormSubmission(RTECTableConfig);
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
        if (this.RTECReportFormEvent) {
            this.RTECReportFormEvent.destroy();
        }
        if (this.form) {
            this.RTECReportFormEvent = new RTECFormEvent(this.form);
        }
    }

    // Public method for backward compatibility
    public initializeRTECReportForm(): void {
        this.initializeForm();
    }
}
