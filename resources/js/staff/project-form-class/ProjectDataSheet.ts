import {
    showProcessToast,
    showToastFeedback,
    hideProcessToast,
} from '../../Utilities/feedback-toast';

import createConfirmationModal from '../../Utilities/confirmation-modal';
import ProjectClass from './ProjectClass';
import ReportedQuarterlyReportEvent from '../../Utilities/ReportedQuarterlyReportEvent';

type Action = 'edit' | 'view';

export default class ProjectDataSheet extends ProjectClass {
    private form: JQuery<HTMLFormElement> | null;
    private formEvent: ReportedQuarterlyReportEvent | null;
    private loadPDSBtn: JQuery<HTMLButtonElement> | null;
    private generatePDFBtn: JQuery<HTMLButtonElement> | null;
    private previewPDSBtn: JQuery<HTMLButtonElement> | null;
    constructor(
        protected formContainer: JQuery<HTMLElement>,
        private project_id: string
    ) {
        super(formContainer);
        this.formContainer = formContainer;
        this.project_id = project_id;
        this.form = null;
        this.formEvent = null;
        this.loadPDSBtn = formContainer.find('#loadPDSbtn');
        this.previewPDSBtn = formContainer.find('#previewPDSbtn');
        this.generatePDFBtn = null;
        this._setupProjectDataSheetBtnEvent();
        this._getAvailableQuartersReport();
    }

    private async _getProjectDataSheet(
        url: string,
        actionMode: Action = 'view'
    ) {
        try {
            showProcessToast('Loading Project Data Sheet...');
            const response = await $.ajax({
                type: 'GET',
                url: url,
                headers: {
                    'X-ACTION_MODE': actionMode,
                },
                dataType: 'html',
            });
            this._toggleDocumentBtnVisibility();
            this.formContainer.append(response as string);
            this.form = this._getFormInstance();
            if (this.formEvent) {
                this.formEvent.destroy();
            }
            switch (actionMode) {
                case 'edit':
                    this.formEvent = new ReportedQuarterlyReportEvent(
                        this.form
                    );
                    this.formEvent.initInputEventFormatter();
                    this.formEvent.initStoreInitialValue();
                    this.formEvent.initEditMode();
                    break;
                case 'view':
                    this._setupPDFExport();
                    break;
                default:
                    throw new Error('Invalid action');
            }
            hideProcessToast();
        } catch (error: any) {
            hideProcessToast();
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message ||
                    error?.message ||
                    'Error in Retrieving Project Data Sheet'
            );
        }
    }

    private async _getAvailableQuartersReport() {
        try {
            const quarterlySelector = this.formContainer.find(
                'select#pds_quarter_to_load, select#pds_year_to_export'
            );
            quarterlySelector.empty();
            const response = await $.ajax({
                type: 'GET',
                url: PROJECT_SHEETS_ROUTE.GET_AVAILABLE_QUARTERLY_REPORT.replace(
                    ':project_id',
                    this.project_id
                ),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
            });
            if (response && response.html) {
                quarterlySelector.append(response.html);
            }
        } catch (error) {
            console.warn(
                'Error in Retrieving Available Quarters Report' + error
            );
        }
    }
    private _getFormInstance(): JQuery<HTMLFormElement> {
        return this.formContainer
            .find('form#ReportedQuarterlyData')
            .first() as JQuery<HTMLFormElement>;
    }

    private _setupProjectDataSheetBtnEvent(): void {
        if (this.loadPDSBtn) {
            this.loadPDSBtn.on('click', async (e: JQuery.TriggeredEvent) => {
                const btn = $(e.currentTarget);
                const inputGroup = btn.closest('.input-group');
                const select = inputGroup.find('select#pds_quarter_to_load');
                const url = select
                    .find('option:selected')
                    .attr('data-form-url') as string;
                const action = inputGroup
                    .find('select#pds_action_to_load')
                    .val() as Action;
                const quarter = select.val() as string;

                const isConfirmed = await createConfirmationModal({
                    title: 'Load Project Data Sheet',
                    message: `Are you sure you want to load a Project Data Sheet for Project ${this.project_id} in quarter ${quarter}?`,
                    confirmText: 'Yes',
                    cancelText: 'No',
                });
                if (!isConfirmed) {
                    return;
                }
                this._getProjectDataSheet(url, action);
            });
        }
        if (this.previewPDSBtn) {
            this.previewPDSBtn.on('click', async (e) => {
                const btn = $(e.currentTarget);
                const inputGroup = btn.closest('.input-group');
                const select = inputGroup.find('select#pds_year_to_export');
                const url = select
                    .find('option:selected')
                    .attr('data-preview-pds-url') as string;
                const quarter = select.val() as string;

                const isConfirmed = await createConfirmationModal({
                    title: 'Preview Project Data Sheet',
                    message: `Are you sure you want to preview a Project Data Sheet for Project ${this.project_id} in year ${quarter}?`,
                    confirmText: 'Yes',
                    cancelText: 'No',
                });
                if (!isConfirmed) {
                    return;
                }
                this._getProjectDataSheet(url);
            });
        }
    }

    private _setupPDFExport(): void {
        try {
            this.generatePDFBtn = this.formContainer.find(
                'button#exportProjectDataSheetFormToPDF'
            );
            if (!this.generatePDFBtn)
                throw new Error('Generate PDF Button not found');
            this.generatePDFBtn.on('click', async () => {
                const generateUrl =
                    this.generatePDFBtn?.attr('data-generated-url');
                if (!generateUrl) throw new Error('Generate URL not found');
                window.open(generateUrl, '_blank');
            });
        } catch (error) {
            console.warn('Error in setting up PDF export' + error);
        }
    }

    public destroy(): void {
        // Remove event listeners
        if (this.loadPDSBtn) {
            this.loadPDSBtn.off('click');
            this.loadPDSBtn = null;
        }
        if (this.previewPDSBtn) {
            this.previewPDSBtn.off('click');
            this.previewPDSBtn = null;
        }
        if (this.generatePDFBtn) {
            this.generatePDFBtn.off('click');
            this.generatePDFBtn = null;
        }

        // Remove form and clear references
        if (this.form) {
            this.form.remove();
            this.form = null;
        }

        // Clear DOM references
        const quarterlySelector = this.formContainer.find(
            'select#pds_quarter_to_load, select#pds_year_to_export'
        );
        quarterlySelector.empty();

        // Clear other properties
        this.project_id = '';
        this.documentBtnSelectors.removeClass('d-none');

        // Remove any appended elements from formContainer
        this.formContainer.find('#formWrapper').remove();
    }
}
