import { serializeFormData } from '../../Utilities/utilFunctions';
import {
    showProcessToast,
    hideProcessToast,
    showToastFeedback,
} from '../../Utilities/feedback-toast';

import createConfirmationModal from '../../Utilities/confirmation-modal';
import ProjectClass from './ProjectClass';
import ProjectInfoSheetEvent from '../project-form-class-events/ProjectInfoSheetEvent';

type Action = 'edit' | 'view';
export default class ProjectInfoSheet extends ProjectClass {
    private loadPISBtn: JQuery<HTMLElement>;
    private createPISBtn: JQuery<HTMLElement>;
    protected formContainer: JQuery<HTMLElement>;
    private Form: JQuery<HTMLFormElement> | null;
    private formEvent: ProjectInfoSheetEvent | null;
    private generatePDFBtn: JQuery<HTMLElement> | null;
    private pisYearToCreate: JQuery<HTMLSelectElement>;
    private pisYearToLoad: JQuery<HTMLSelectElement>;
    private dropdownItems: JQuery<HTMLElement>;
    private project_id: string;
    private business_Id: string;
    private application_Id: string;
    constructor(
        formContainer: JQuery<HTMLElement>,
        project_id: string,
        business_Id: string,
        application_Id: string
    ) {
        super(formContainer);
        this.pisYearToCreate = formContainer.find('select#pis_year_to_create');
        this.pisYearToLoad = formContainer.find('select#pis_year_to_load');
        this.loadPISBtn = formContainer.find('#loadPISbtn');
        this.createPISBtn = formContainer.find('#createPISbtn');
        this.dropdownItems = formContainer.find(
            '#pisActionDropdown .dropdown-item'
        );
        this.project_id = project_id;
        this.business_Id = business_Id;
        this.application_Id = application_Id;
        this.formContainer = formContainer;
        this.Form = null;
        this.formEvent = null;
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
                url: PROJECT_SHEETS_ROUTE.GET_PROJECT_INFORMATION_SHEET_FORM.replace(
                    ':project_id',
                    project_id
                )
                    .replace(':business_id', business_Id)
                    .replace(':application_id', application_Id)
                    .replace(':action', actionMode)
                    .replace(':year', year),
            });
            this._toggleDocumentBtnVisibility();
            this.formContainer.append(response as string);
            this.Form = this._getFormInstance();
            switch (actionMode) {
                case 'edit':
                    this._setupProjectInfoSheetSubmission();
                    this.formEvent = new ProjectInfoSheetEvent(this.Form);
                    break;
                case 'view':
                    this._setupPDFExport();
                    break;
                default:
                    throw new Error('Invalid action');
            }
        } catch (error: any) {
            this._handleError(
                'Error in Getting Project Info Sheet: ',
                error,
                true
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
                url: PROJECT_SHEETS_ROUTE.CREATE_PROJECT_INFORMATION_SHEET_FORM,
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
            hideProcessToast();
            this._handleError(
                'Error in Creating Project Info Sheet: ',
                error,
                true
            );
        } finally {
            this._getAllYearsRecords(project_id, application_Id, business_Id);
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
                url: PROJECT_SHEETS_ROUTE.GET_PROJECT_INFORMATION_YEAR_RECORDS.replace(
                    ':project_id',
                    project_id
                )
                    .replace(':business_id', business_Id)
                    .replace(':application_id', application_Id),
            });
            this._appendAllYearsRecords(response);
        } catch (error: any) {
            this._handleError('Error in Getting All Years Records: ', error);
        }
    }

    private _appendAllYearsRecords(yearsResponse: string[]): void {
        this.pisYearToLoad.empty();
        if (!yearsResponse || !yearsResponse.length) {
            this.pisYearToLoad.append(
                $('<option>', {
                    value: '',
                    text: 'No Year Records Found',
                    disabled: true,
                    selected: true,
                })
            );
        } else {
            yearsResponse.forEach((year) => {
                this.pisYearToLoad.append(
                    $('<option>', {
                        value: year,
                        text: year,
                    })
                );
            });
        }
    }

    private _getFormInstance(): JQuery<HTMLFormElement> {
        return this.formContainer
            .find('form#projectInfoSheetForm')
            .first() as JQuery<HTMLFormElement>;
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
            hideProcessToast();
            this._handleError(
                'Error in Saving Project Info Sheet: ',
                error,
                true
            );
        }
    }

    private _setupPDFExport(): void {
        try {
            this.generatePDFBtn = this.formContainer.find(
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
            this._handleError('Error in Setting PDF Export: ', error, true);
        }
    }

    private _setupProjectInfoSheetSubmission(): void {
        try {
            if (!this.Form) throw new Error('Form not found');
            const form = this.Form;
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
                    this._handleError(
                        'Error in Setting Project Info Sheet: ',
                        SubmissionError,
                        true
                    );
                }
            });
        } catch (error: any) {
            this._handleError(
                'Error in Setting Project Info Sheet: ',
                error,
                true
            );
        }
    }
    /**
     * Sets up the event handler for the Create PIS button
     * Uses consistent jQuery approach to find the select element in the same input-group
     */
    private _setupProjectInfoSheetBtnEvent(): void {
        try {
            if (!this.createPISBtn.length) {
                throw new Error('Create PIS Button not found');
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
                    throw new Error('Please select a year first');
                }

                this._createProjectInfoSheet(
                    this.project_id,
                    this.application_Id,
                    this.business_Id,
                    selectedYear
                );
            });

            // Set up event handlers for the dropdown menu items
            if (this.loadPISBtn.length) {
                // Handle dropdown items click events
                this.dropdownItems.on('click', async (e: JQuery.ClickEvent) => {
                    e.preventDefault();

                    try {
                        const clickedItem = $(e.currentTarget);
                        const action = clickedItem.data('value') as Action;
                        const select = clickedItem
                            .closest('.input-group')
                            .find('select#pis_year_to_load');
                        const selectedYear = select.val() as string;

                        if (
                            !selectedYear ||
                            selectedYear === 'No Year Records Found' ||
                            selectedYear === 'No Record Found'
                        ) {
                            showToastFeedback(
                                'text-bg-danger',
                                'Please select a year to load'
                            );
                            return;
                        }

                        const isConfirmed = await createConfirmationModal({
                            title: 'Load Project Information Sheet',
                            message: `Are you sure you want to ${action} Project Information Sheet for Project ${this.project_id} in year ${selectedYear}?`,
                            confirmText: 'Yes',
                            cancelText: 'No',
                        });

                        if (!isConfirmed) {
                            return;
                        }

                        showProcessToast(
                            'Loading Project Information Sheet...'
                        );
                        await this._getProjectInfoSheet(
                            this.project_id,
                            this.business_Id,
                            this.application_Id,
                            action,
                            selectedYear
                        );
                        hideProcessToast();
                    } catch (error: any) {
                        hideProcessToast();
                        this._handleError(
                            'Error in Loading Project Info Sheet: ',
                            error,
                            true
                        );
                    }
                });
            }
        } catch (error: any) {
            hideProcessToast();
            this._handleError(
                'Error in Setting Project Info Sheet: ',
                error,
                true
            );
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

        if (this.dropdownItems) {
            this.dropdownItems.off('click');
        }

        // Remove form and clear references
        if (this.Form) {
            this.Form.remove();
            this.Form = null;
        }

        // Clear DOM references
        this.dropdownItems.empty();
        this.pisYearToCreate.empty();
        this.pisYearToLoad.empty();
        this.generatePDFBtn = null;

        // Clear other properties
        this.project_id = '';
        this.business_Id = '';
        this.application_Id = '';
        this.formEvent = null;
        this.documentBtnSelectors.removeClass('d-none');

        // Remove any appended elements from formContainer
        this.formContainer.find('#formWrapper').remove();
    }
}
