import createConfirmationModal from '../../Utilities/confirmation-modal';
import {
    InitializeFilePond,
    handleFilePondSelectorDisabling,
} from '../../Utilities/FilepondHandlers';
import { customFormatNumericInput } from '../../Utilities/input-utils';
import { processError } from '../../Utilities/error-handler-util';
import {
    hideProcessToast,
    showProcessToast,
    showToastFeedback,
} from '../../Utilities/feedback-toast';
import { serializeFormData } from '../../Utilities/utilFunctions';

export default class AddApplicant {
    private formElement: JQuery<HTMLFormElement> | null;
    private applicantListTable: JQuery<HTMLTableElement> | null;
    constructor() {
        this.formElement = null;
        this.applicantListTable = null;
    }

    public setupFormSubmitHandler() {
        this.formElement = $('#addApplicantForm');
        try {
            if (!this.formElement) throw new Error('Form element not found');
            const form = this.formElement;
            form.on('submit', async (event: JQuery.SubmitEvent) => {
                event.preventDefault();
                const isConfirmed = await createConfirmationModal({
                    title: 'Confirm Applicant Addition',
                    message: 'Are you sure you want to add this applicant?',
                    confirmText: 'Yes',
                    cancelText: 'No',
                });
                if (!isConfirmed) return;
                try {
                    const url = form.attr('action');
                    const formData = form.serializeArray();
                    if (!formData || !formData.length || !url)
                        throw new Error('Form data not found');
                    const formDataObject = serializeFormData(formData);
                    await this._saveApplicant(formDataObject, url);
                } catch (error: any) {
                    processError('Error in Adding Applicant: ', error, true);
                }
            });
        } catch (error) {
            processError('Error in Setting Up Form Submit Handler: ', error);
        }
    }

    public setupApplicantTableActionListener() {
        this.applicantListTable = $('#applicantListTable');
        try {
            if (!this.applicantListTable)
                throw new Error('Applicant list table not found');
            const table = this.applicantListTable;
            table
                .find('tbody')
                .on(
                    'click',
                    '.editApplicantForm',
                    async (event: JQuery.ClickEvent) => {
                        const button = $(event.target);
                        const secureFormLink = button.data('secure-form-link');
                        if (!secureFormLink)
                            throw new Error('Secure form link not found');
                        await window.loadPage(secureFormLink, 'projectLink');

                        const applicationJsModule = await import(
                            '../../application-page.js'
                        );
                        if (applicationJsModule.initializeForm) {
                            applicationJsModule.initializeForm();
                        }
                    }
                );
        } catch (error) {
            processError(
                'Error in Setting Up Applicant Table Action Listener: ',
                error,
                true
            );
        }
    }

    private async _saveApplicant(
        formData: { [key: string]: any },
        url: string
    ) {
        const processToast = showProcessToast('Saving Applicant...');
        try {
            const response = await $.ajax({
                type: 'POST',
                url: url,
                data: JSON.stringify(formData),
                contentType: 'application/json',
                dataType: 'json',
                processData: false,
                headers: {
                    'X-CSRF-TOKEN':
                        $('meta[name="csrf-token"]').attr('content') || '',
                },
            });
            hideProcessToast(processToast);
            showToastFeedback('text-bg-success', response?.message);
        } catch (error: any) {
            hideProcessToast(processToast);
            processError('Error in Saving Applicant: ', error, true);
        }
    }

    public initializeApplicantDetailedForm() {
        customFormatNumericInput('form', [
            '#initial_capitalization',
            '#present_capitalization',
        ]);
        customFormatNumericInput('#productAndSupplyChainTable tbody', [
            'tr td:nth-child(3) input.UnitCost',
            'tr td:nth-child(4) input.VolumeUsed',
        ]);
        customFormatNumericInput('#productionTable', [
            'tr td:nth-child(3) .UnitCost',
            'tr td:nth-child(4) .AnnualCost',
        ]);
        customFormatNumericInput('#productionEquipmentTable', ['.Capacity']);

        const API_BASE_URL = 'https://psgc.gitlab.io/api';

        const organizationalStructureInstance = InitializeFilePond(
            'organizationalStructure',
            { acceptedFileTypes: ['image/png', 'image/jpeg'] },
            'OrganizationalStructureFileID_Data_Handler'
        );

        const planLayoutInstance = InitializeFilePond(
            'planLayout',
            { acceptedFileTypes: ['image/png', 'image/jpeg'] },
            'PlanLayoutFileID_Data_Handler'
        );

        const processFlowInstance = InitializeFilePond(
            'processFlow',
            { acceptedFileTypes: ['image/png', 'image/jpeg'] },
            'ProcessFlowFileID_Data_Handler'
        );

        // Intent File
        const intentInstance = InitializeFilePond(
            'intentFile',
            { acceptedFileTypes: ['application/pdf'] },
            'IntentFileID_Data_Handler'
        );

        // DTI/SEC/CDA File
        const dtiSecCdaInstance = InitializeFilePond(
            'DTI_SEC_CDA_File',
            { acceptedFileTypes: ['application/pdf'] },
            'DtiSecCdaFileID_Data_Handler',
            'DtiSecCdaSelector'
        );

        // Business Permit File
        const businessPermitInstance = InitializeFilePond(
            'businessPermitFile',
            { acceptedFileTypes: ['application/pdf'] },
            'BusinessPermitFileID_Data_Handler'
        );

        // FDA LTO File
        const fdaLtoInstance = InitializeFilePond(
            'fdaLtoFile',
            { acceptedFileTypes: ['application/pdf'] },
            'FdaLtoFileID_Data_Handler',
            'fdaLtoSelector'
        );

        // Receipt File
        const receiptInstance = InitializeFilePond(
            'receiptFile',
            { acceptedFileTypes: ['application/pdf'] },
            'ReceiptFileID_Data_Handler'
        );

        // Government ID File
        const govIdInstance = InitializeFilePond(
            'govIdFile',
            {
                acceptedFileTypes: ['image/png', 'image/jpeg'],
                captureMethod: 'environment',
            },
            'GovIdFileID_Data_Handler',
            'GovIdSelector'
        );

        // BIR File
        const birInstance = InitializeFilePond(
            'BIRFile',
            { acceptedFileTypes: ['application/pdf'] },
            'BIRFileID_Data_Handler'
        );

        if (dtiSecCdaInstance && govIdInstance && fdaLtoInstance) {
            handleFilePondSelectorDisabling(
                'DtiSecCdaSelector',
                dtiSecCdaInstance
            );
            handleFilePondSelectorDisabling('fdaLtoSelector', fdaLtoInstance);
            handleFilePondSelectorDisabling('GovIdSelector', govIdInstance);
        }
    }
}
