import {
    showProcessToast,
    showToastFeedback,
    hideProcessToast,
    serializeFormData,
} from '../../Utilities/utilFunctions';

import createConfirmationModal from '../../Utilities/confirmation-modal';
import ProjectClass from './ProjectClass';
import ReportedQuarterlyReportEvent from '../../Utilities/ReportedQuarterlyReportEvent';

type Action = 'edit' | 'view';

export default class ProjectDataSheet extends ProjectClass {
    private selectedQuarter: string | null;
    private Form: JQuery<HTMLFormElement> | null;
    private loadPDSBtn: JQuery<HTMLElement> | null;
    constructor(
        protected FormContainer: JQuery<HTMLElement>,
        private project_id: string,
        private business_Id: string,
        private application_Id: string
    ) {
        super(FormContainer);
        this.FormContainer = FormContainer;
        this.project_id = project_id;
        this.business_Id = business_Id;
        this.application_Id = application_Id;
        this.selectedQuarter = null;
        this.Form = null;
        this.loadPDSBtn = FormContainer.find('#loadPDSbtn');
        this._setupProjectDataSheetBtnEvent();
        this._getAvailableQuartersReport();
    }

    private async _getProjectDataSheet(url: string, actionMode: Action) {
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
            this.FormContainer.append(response as string);
            this.Form = this._getFormInstance();
            switch (actionMode) {
                case 'edit':
                    break;
                case 'view':
                    break;
                default:
                    throw new Error('Invalid action');
            }
            hideProcessToast();
        } catch (error: any) {
            console.warn('Error in Retrieving Project Data Sheet' + error);
            hideProcessToast();
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message || error?.message
            );
        }
    }

    private async _getAvailableQuartersReport() {
        try {
            const quarterlySelector = this.FormContainer.find(
                'select#pds_quarter_to_load'
            );
            quarterlySelector.empty();
            const response = await $.ajax({
                type: 'GET',
                url: GENERATE_SHEETS_ROUTE.GET_AVAILABLE_QUARTERLY_REPORT.replace(
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
        return this.FormContainer.find(
            'form#projectDataSheetForm'
        ).first() as JQuery<HTMLFormElement>;
    }

    private _setupProjectDataSheetBtnEvent(): void {
        if (this.loadPDSBtn) {
            this.loadPDSBtn.on('click', async (e: JQuery.TriggeredEvent) => {
                const btn = $(e.currentTarget);
                const inputGroup = btn.closest('.input-group');
                const select = inputGroup.find('select#pds_quarter_to_load');
                const url = select
                    .find('option:selected')
                    .attr('data-view-url') as string;
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
    }

    public destroy(): void {
        // Remove event listeners
        if (this.loadPDSBtn) {
            this.loadPDSBtn.off('click');
        }

        // Remove form and clear references
        if (this.Form) {
            this.Form.remove();
            this.Form = null;
        }

        // Clear DOM references
        const quarterlySelector = this.FormContainer.find(
            'select#pds_quarter_to_load'
        );
        quarterlySelector.empty();
        this.loadPDSBtn = null;

        // Clear other properties
        this.selectedQuarter = null;
        this.project_id = '';
        this.business_Id = '';
        this.application_Id = '';
        this.documentBtnSelectors.removeClass('d-none');

        // Remove any appended elements from FormContainer
        this.FormContainer.find('#formWrapper').remove();
    }
}
