import {
    showProcessToast,
    showToastFeedback,
    hideProcessToast,
    serializeFormData,
} from '../../Utilities/utilFunctions';

type Action = 'edit' | 'view';
export default class ProjectInfoSheet {
    private loadPISBtn: JQuery<HTMLElement>;
    private createPISBtn: JQuery<HTMLElement>;
    private FormContainer: JQuery<HTMLElement>;
    private Form: JQuery<HTMLFormElement> | null;
    private FormEvent: null;
    private generatePDFBtn: JQuery<HTMLElement> | null;
    private pisYearToCreate: JQuery<HTMLSelectElement>;
    private pisYearToLoad: JQuery<HTMLSelectElement>;
    private project_id: string;
    private business_Id: number;
    private application_Id: number;
    constructor(
        FormContainer: JQuery<HTMLElement>,
        project_id: string,
        business_Id: number,
        application_Id: number
    ) {
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
    }

    private async _getProjectInfoSheet(
        project_id: string,
        business_Id: number,
        application_Id: number,
        actionMode: Action
    ) {
        try {
            const response = await $.ajax({
                type: 'GET',
                url: '',
            });
            this.FormContainer.find('.modal-body').html(response as string);
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
                    // this._setupProjectInfoSheetPDFExport();
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

    private _getFormInstance(): JQuery<HTMLFormElement> {
        return this.FormContainer.find(
            'form'
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
                data: ProjectInfoSheetRequest,
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

            // Show processing indicator
            showProcessToast('Creating Project Information Sheet...');
        });

        // Similarly for the Load PIS button if needed
        if (this.loadPISBtn.length) {
            this.loadPISBtn.on('click', (e: JQuery.TriggeredEvent) => {
                const btn = $(e.currentTarget);
                const inputGroup = btn.closest('.input-group');
                const select = inputGroup.find('select#pis_year_to_load');
                const selectedYear = select.val() as string;

                if (!selectedYear) {
                    showToastFeedback('error', 'Please select a year to load');
                    return;
                }

                showProcessToast('Loading Project Information Sheet...');
                //this._loadProjectInfoSheet(selectedYear);
            });
        }
    }
}
