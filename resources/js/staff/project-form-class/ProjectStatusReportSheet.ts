import ProjectClass from './ProjectClass';
import { serializeFormData } from '../../Utilities/utilFunctions';
import {
    showProcessToast,
    hideProcessToast,
    showToastFeedback,
} from '../../Utilities/feedback-toast';
import createConfirmationModal from '../../Utilities/confirmation-modal';
type Action = 'edit' | 'view';
export default class ProjectStatusReportSheet extends ProjectClass {
    private loadSRBtn: JQuery<HTMLButtonElement>;
    private createSRBtn: JQuery<HTMLButtonElement>;
    private generatePDFBtn: JQuery<HTMLButtonElement> | null;
    private psrYearToCreate: JQuery<HTMLSelectElement>;
    private psrYearToLoad: JQuery<HTMLSelectElement>;
    private form: JQuery<HTMLFormElement> | null;
    private formEvent: null;
    private project_id: string;
    private business_id: string;
    private application_id: string;
    constructor(
        formContainer: JQuery<HTMLElement>,
        project_id: string,
        business_id: string,
        application_id: string
    ) {
        super(formContainer);
        this.loadSRBtn = formContainer.find('#loadSRbtn');
        this.createSRBtn = formContainer.find('#createSRbtn');
        this.psrYearToCreate = formContainer.find('select#psr_year_to_create');
        this.psrYearToLoad = formContainer.find('select#psr_year_to_load');
        this.project_id = project_id;
        this.business_id = business_id;
        this.application_id = application_id;
        this.formContainer = formContainer;
        this.form = null;
        this.formEvent = null;
        this.generatePDFBtn = null;
        this._setupProjectStatusReportBtnEvent();
        this._getAllYearsRecords(project_id, application_id, business_id);
    }

    private async _getProjectStatusReportSheet(
        project_id: string,
        business_id: string,
        application_id: string,
        actionMode: Action,
        year: string
    ) {
        try {
            const response = await $.ajax({
                type: 'GET',
                url: PROJECT_SHEETS_ROUTE.GET_STATUS_REPORT_DATA.replace(
                    ':project_id',
                    project_id
                )
                    .replace(':application_id', application_id)
                    .replace(':business_id', business_id)
                    .replace(':action', actionMode)
                    .replace(':year', year),
            });
            this._toggleDocumentBtnVisibility();
            this.formContainer.append(response as string);
            this.form = this._getFormInstance();
            switch (actionMode) {
                case 'edit':
                    this._setupProjectStatusReportSubmission();
                    break;
                case 'view':
                    this._setupPDFExport();
                    break;
                default:
                    throw new Error('Invalid action');
            }
        } catch (error: any) {
            this._handleError(error, true);
        }
    }

    private async _createProjectStatusReport(
        project_id: string,
        application_id: string,
        business_id: string,
        year: string
    ): Promise<void> {
        try {
            const isConfirmed = await createConfirmationModal({
                title: 'Create Project Status Report',
                message: `Are you sure you want to create a new project status report for project ${project_id} in year ${year}?`,
                confirmText: 'Yes',
                cancelText: 'No',
            });
            if (!isConfirmed) {
                return;
            }
            showProcessToast('Creating Project Status Report...');
            const response = await $.ajax({
                type: 'POST',
                url: PROJECT_SHEETS_ROUTE.CREATE_STATUS_REPORT_FORM,
                data: {
                    project_id: project_id,
                    application_id: application_id,
                    business_id: business_id,
                    for_year: year,
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN':
                        $('meta[name="csrf-token"]').attr('content') || '',
                },
            });
            hideProcessToast();
            showToastFeedback('text-bg-success', response.message);
        } catch (error: any) {
            hideProcessToast();
            this._handleError(error, true);
        } finally {
            this._getAllYearsRecords(project_id, application_id, business_id);
        }
    }

    private _appendAllYearsRecords(yearsResponse: string[]): void {
        this.psrYearToLoad.empty();
        yearsResponse.forEach((year) => {
            this.psrYearToLoad.append(
                $('<option>', {
                    value: year,
                    text: year,
                })
            );
        });
    }

    private _getFormInstance(): JQuery<HTMLFormElement> {
        return this.formContainer
            .find('form#projectStatusReportForm')
            .first() as JQuery<HTMLFormElement>;
    }

    private async _saveStatusReport(
        ProjectStatusReportRequest: { [key: string]: string | string[] },
        url: string
    ): Promise<void> {
        try {
            showProcessToast('Saving Project Status Report...');
            const response = await $.ajax({
                type: 'PUT',
                url: url,
                data: JSON.stringify(ProjectStatusReportRequest),
                contentType: 'application/json',
                dataType: 'json',
                processData: false,
                headers: {
                    'X-CSRF-TOKEN':
                        $('meta[name="csrf-token"]').attr('content') || '',
                },
            });
            hideProcessToast();
            showToastFeedback(
                'text-bg-success',
                response?.message || 'Successfuly Saved'
            );
        } catch (error: any) {
            hideProcessToast();
            this._handleError(error, true);
        } finally {
            this._getAllYearsRecords(
                this.project_id,
                this.application_id,
                this.business_id
            );
        }
    }

    private async _getAllYearsRecords(
        project_id: string,
        application_Id: string,
        business_Id: string
    ): Promise<void> {
        try {
            const response = await $.ajax({
                type: 'GET',
                url: PROJECT_SHEETS_ROUTE.GET_STATUS_REPORT_YEAR_RECORDS.replace(
                    ':project_id',
                    project_id
                )
                    .replace(':application_id', application_Id)
                    .replace(':business_id', business_Id),
            });
            this._appendAllYearsRecords(response);
        } catch (error) {
            this._handleError(error, true);
        }
    }

    private _setupPDFExport(): void {
        try {
            this.generatePDFBtn = this.formContainer.find(
                'button#exportProjectStatusReportFormToPDF'
            );
            if (!this.generatePDFBtn)
                throw new Error('Generate PDF Button not found');
            this.generatePDFBtn.on('click', async () => {
                const generateUrl =
                    this.generatePDFBtn?.attr('data-generated-url');
                if (!generateUrl) throw new Error('Generate URL not found');
                window.open(generateUrl, '_blank');
            });
        } catch (error: any) {
            this._handleError(error, true);
        }
    }

    private _setupProjectStatusReportSubmission(): void {
        try {
            if (!this.form) throw new Error('Form not found');
            const form = this.form;
            form.on('submit', async (event: JQuery.SubmitEvent) => {
                event.preventDefault();
                try {
                    const url = form.attr('action');
                    const formData = form.serializeArray();
                    if (!url || !formData || !formData.length)
                        throw new Error('Form data not found');
                    let formDataObject: { [key: string]: string | string[] } =
                        serializeFormData(formData);
                    await this._saveStatusReport(formDataObject, url);
                } catch (SubmissionError: any) {
                    this._handleError(SubmissionError, true);
                }
            });
        } catch (error: any) {
            this._handleError(error, true);
        }
    }
    private _setupProjectStatusReportBtnEvent(): void {
        try {
            if (!this.createSRBtn.length || !this.psrYearToCreate.length) {
                throw new Error('Create SR Button or Year Select not found');
            }
            const currentYear = new Date().getFullYear();
            const psrYearToCreate = this.psrYearToCreate;
            for (let i = 0; i < 4; i++) {
                const year = currentYear + i;
                const option = $('<option>', {
                    value: year,
                    text: year,
                });
                psrYearToCreate.append(option);
            }
            this.createSRBtn.on('click', (e: JQuery.TriggeredEvent) => {
                const btn = $(e.currentTarget);
                const inputGroup = btn.closest('.input-group');
                const select = inputGroup.find('select#psr_year_to_create');
                const selectedYear = select.val() as string;
                if (!selectedYear) {
                    showToastFeedback('error', 'Please select a year first');
                    return;
                }
                this._createProjectStatusReport(
                    this.project_id,
                    this.application_id,
                    this.business_id,
                    selectedYear
                );
            });
            this.loadSRBtn.on('click', (e: JQuery.TriggeredEvent) => {
                const btn = $(e.currentTarget);
                const inputGroup = btn.closest('.input-group');
                const select = inputGroup.find('select#psr_year_to_load');
                const action = inputGroup
                    .find('select#psr_action_to_load')
                    .val() as Action;
                const selectedYear = select.val() as string;
                if (!selectedYear) {
                    showToastFeedback('error', 'Please select a year first');
                    return;
                }
                this._getProjectStatusReportSheet(
                    this.project_id,
                    this.application_id,
                    this.business_id,
                    action,
                    selectedYear
                );
            });
        } catch (error: any) {
            this._handleError(error, true);
        }
    }

    public destroy(): void {
        if (this.loadSRBtn) {
            this.loadSRBtn.off('click');
        }
        if (this.createSRBtn) {
            this.createSRBtn.off('click');
        }
        if (this.generatePDFBtn) {
            this.generatePDFBtn.off('click');
        }

        if (this.form) {
            this.form.remove();
            this.form = null;
        }

        this.psrYearToCreate.empty();
        this.psrYearToLoad.empty();
        this.generatePDFBtn = null;

        this.project_id = '';
        this.business_id = '';
        this.application_id = '';
        this.formEvent = null;
        this.documentBtnSelectors.removeClass('d-none');
    }
}
