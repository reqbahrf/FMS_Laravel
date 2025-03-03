import {
    showProcessToast,
    showToastFeedback,
    hideProcessToast,
    serializeFormData,
} from '../../Utilities/utilFunctions';

import createConfirmationModal from '../../Utilities/confirmation-modal';
import ProjectClass from './ProjectClass';

type Action = 'edit' | 'view';
export default class ProjectInfoSheet extends ProjectClass {
    private loadPISBtn: JQuery<HTMLElement>;
    private createPISBtn: JQuery<HTMLElement>;
    protected FormContainer: JQuery<HTMLElement>;
    private Form: JQuery<HTMLFormElement> | null;
    private FormEvent: null;
    private generatePDFBtn: JQuery<HTMLElement> | null;
    private pisYearToCreate: JQuery<HTMLSelectElement>;
    private pisYearToLoad: JQuery<HTMLSelectElement>;
    private project_id: string;
    private business_Id: string;
    private application_Id: string;
    constructor(
        FormContainer: JQuery<HTMLElement>,
        project_id: string,
        business_Id: string,
        application_Id: string
    ) {
        super(FormContainer);
        this.pisYearToCreate = FormContainer.find('select#pis_year_to_create');
        this.pisYearToLoad = FormContainer.find('select#pis_year_to_load');
        this.loadPISBtn = FormContainer.find('#loadPISbtn');
        this.createPISBtn = FormContainer.find('#createPISbtn');
        this.project_id = project_id;
        this.business_Id = business_Id;
        this.application_Id = application_Id;
        this.FormContainer = FormContainer;
        this.Form = null;
        this.FormEvent = null;
        this.generatePDFBtn = null;
        this._setupProjectInfoSheetBtnEvent();
        this._getAllYearsRecords(project_id, application_Id, business_Id);
    }

    private async _getProjectInfoSheet(
        project_id: string,
        business_Id: string,
        application_Id: string,
        actionMode: Action,
        year: string
    ) {
        try {
            const response = await $.ajax({
                type: 'GET',
                url: GENERATE_SHEETS_ROUTE.GET_PROJECT_INFORMATION_SHEET_FORM.replace(
                    ':project_id',
                    project_id
                )
                    .replace(':business_id', business_Id)
                    .replace(':application_id', application_Id)
                    .replace(':action', actionMode)
                    .replace(':year', year),
            });
            this._toggleDocumentBtnVisibility();
            this.FormContainer.append(response as string);
            this.Form = this._getFormInstance();
            switch (actionMode) {
                case 'edit':
                    this._setupProjectInfoSheetSubmission();
                    if (this.FormEvent) {
                        // this.FormEvent.destroy();
                    }
                    //this.FormEvent = new ProjectInfoSheetEvent(this.Form);
                    break;
                case 'view':
                    this._setupPDFExport();
                    break;
                default:
                    throw new Error('Invalid action');
            }
        } catch (error: any) {
            console.warn('Error in Retrieving Project Info Sheet' + error);
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message || error?.message
            );
        }
    }

    private async _createProjectInfoSheet(
        project_id: string,
        application_Id: string,
        business_Id: string,
        year: string
    ): Promise<void> {
        try {
            const isConfirmed = await createConfirmationModal({
                title: 'Create Project Info Sheet',
                message: `Are you sure you want to create a new Project Info Sheet for Project ${project_id} in year ${year}?`,
                confirmText: 'Yes',
                cancelText: 'No',
            });

            if (!isConfirmed) {
                return;
            }
            showProcessToast();
            const response = await $.ajax({
                type: 'POST',
                url: GENERATE_SHEETS_ROUTE.CREATE_PROJECT_INFORMATION_SHEET_FORM,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
                dataType: 'json',
                data: {
                    project_id: project_id,
                    application_id: application_Id,
                    business_id: business_Id,
                    for_year: year,
                },
            });
            hideProcessToast();
            showToastFeedback('text-bg-success', response.message);
        } catch (error: any) {
            console.warn('Error in Creating Project Info Sheet' + error);
            hideProcessToast();
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message || error?.message
            );
        } finally {
            this._getAllYearsRecords(project_id, business_Id, application_Id);
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
                url: GENERATE_SHEETS_ROUTE.GET_ALL_YEARS_RECORDS.replace(
                    ':project_id',
                    project_id
                )
                    .replace(':business_id', business_Id)
                    .replace(':application_id', application_Id),
            });
            this.appendAllYearsRecords(response);
        } catch (error: any) {
            console.error(
                'Error in Getting All Project Info Sheet' +
                    error?.responseJSON?.message || error?.message
            );
        }
    }

    private appendAllYearsRecords(yearsResponse: string[]): void {
        this.pisYearToLoad.empty();
        yearsResponse.forEach((year) => {
            this.pisYearToLoad.append(
                $('<option>', {
                    value: year,
                    text: year,
                })
            );
        });
    }

    private _getFormInstance(): JQuery<HTMLFormElement> {
        return this.FormContainer.find(
            'form#projectInfoSheetForm'
        ).first() as JQuery<HTMLFormElement>;
    }

    private async _saveProjectInfoSheet(
        ProjectInfoSheetRequest: { [key: string]: string | string[] },
        url: string
    ): Promise<void> {
        try {
            showProcessToast('Saving Project Info Sheet...');
            const response = await $.ajax({
                type: 'PUT',
                url: url,
                data: JSON.stringify(ProjectInfoSheetRequest),
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
            console.warn('Error in Setting Project Info Sheet' + error);
            hideProcessToast();
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message ||
                    error?.message ||
                    'Error in Setting Project Info Sheet'
            );
        }
    }

    private _setupPDFExport(): void {
        try {
            this.generatePDFBtn = this.FormContainer.find(
                'button#exportProjectInfoSheetFormToPDF'
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
            console.warn('Error in Setting Project Info Sheet' + error);
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message ||
                    error?.message ||
                    'Error in Setting Project Info Sheet'
            );
        }
    }

    private _setupProjectInfoSheetSubmission(): void {
        if (!this.Form) throw new Error('Form not found');
        const form = this.Form;
        try {
            form.on('submit', async (event: JQuery.SubmitEvent) => {
                event.preventDefault();
                try {
                    const url = form.attr('action');
                    const formData = form.serializeArray();
                    if (!url || !formData || !formData.length)
                        throw new Error('Form data not found');

                    let formDataObject: { [key: string]: string | string[] } =
                        serializeFormData(formData);

                    await this._saveProjectInfoSheet(formDataObject, url);
                } catch (SubmissionError: any) {
                    console.warn(
                        'Error in Initializing Project Info Sheet' +
                            SubmissionError
                    );
                    showToastFeedback(
                        'text-bg-danger',
                        SubmissionError?.responseJSON?.message ||
                            SubmissionError?.message ||
                            'Error in Setting Project Info Sheet'
                    );
                }
            });
        } catch (error: any) {
            console.warn('Error in Setting Project Info Sheet' + error);
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message ||
                    error?.message ||
                    'Error in Setting Project Info Sheet'
            );
        }
    }
    /**
     * Sets up the event handler for the Create PIS button
     * Uses consistent jQuery approach to find the select element in the same input-group
     */
    private _setupProjectInfoSheetBtnEvent(): void {
        if (!this.createPISBtn.length) {
            console.error('Create PIS Button not found');
            return;
        }

        const currentYear = new Date().getFullYear();
        const pisYearToCreate = this.pisYearToCreate;
        for (let i = 0; i < 4; i++) {
            const year = currentYear + i;
            const option = $('<option>', {
                value: year,
                text: year,
            });
            pisYearToCreate.append(option);
        }

        this.createPISBtn.on('click', (e: JQuery.TriggeredEvent) => {
            const btn = $(e.currentTarget);
            const inputGroup = btn.closest('.input-group');
            const select = inputGroup.find('select#pis_year_to_create');
            const selectedYear = select.val() as string;

            if (!selectedYear) {
                showToastFeedback('error', 'Please select a year first');
                return;
            }

            this._createProjectInfoSheet(
                this.project_id,
                this.application_Id,
                this.business_Id,
                selectedYear
            );
        });

        // Similarly for the Load PIS button if needed
        if (this.loadPISBtn.length) {
            this.loadPISBtn.on('click', async (e: JQuery.TriggeredEvent) => {
                try {
                    const btn = $(e.currentTarget);
                    const inputGroup = btn.closest('.input-group');
                    const select = inputGroup.find('select#pis_year_to_load');
                    const action = inputGroup
                        .find('select#pis_action_to_load')
                        .val() as Action;
                    const selectedYear = select.val() as string;

                    const isConfirmed = await createConfirmationModal({
                        title: 'Load Project Information Sheet',
                        message: `Are you sure you want to load Project Information Sheet for Project ${this.project_id} in year ${selectedYear}?`,
                        confirmText: 'Yes',
                    });

                    if (!isConfirmed) {
                        return;
                    }

                    if (!selectedYear) {
                        showToastFeedback(
                            'error',
                            'Please select a year to load'
                        );
                        return;
                    }

                    showProcessToast('Loading Project Information Sheet...');
                    await this._getProjectInfoSheet(
                        this.project_id,
                        this.business_Id,
                        this.application_Id,
                        action,
                        selectedYear
                    );
                    hideProcessToast();
                } catch (error: any) {
                    showToastFeedback(
                        'error',
                        error?.responseJSON?.message || error?.message
                    );
                    hideProcessToast();
                }
            });
        }
    }

    public destroy(): void {
        // Remove event listeners
        if (this.loadPISBtn) {
            this.loadPISBtn.off('click');
        }
        if (this.createPISBtn) {
            this.createPISBtn.off('click');
        }

        // Remove form and clear references
        if (this.Form) {
            this.Form.remove();
            this.Form = null;
        }

        // Clear DOM references
        this.pisYearToCreate.empty();
        this.pisYearToLoad.empty();
        this.generatePDFBtn = null;

        // Clear other properties
        this.project_id = '';
        this.business_Id = '';
        this.application_Id = '';
        this.FormEvent = null;
        this.documentBtnSelectors.removeClass('d-none');

        // Remove any appended elements from FormContainer
        this.FormContainer.find('#formWrapper').remove();
    }
}
