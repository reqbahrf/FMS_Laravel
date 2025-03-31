import createConfirmationModal from '../../Utilities/confirmation-modal';
import APPLICATION_FORM_CONFIG from '../../Form_Config/APPLICATION_CONFIG';
import { customFormatNumericInput } from '../../Utilities/input-utils';
import { processError } from '../../Utilities/error-handler-util';
import calculateEnterpriseLevel from '../../Utilities/calculate-enterprise-level';
import { AddressFormInput } from '../../Utilities/AddressInputHandler';
import BENCHMARKTableConfig from '../../Form_Config/form-table-config/tnaFormBenchMarkTableConfig';
import {
    hideProcessToast,
    showProcessToast,
    showToastFeedback,
} from '../../Utilities/feedback-toast';
import { serializeFormData } from '../../Utilities/utilFunctions';
import { FormDraftHandler } from '../../Utilities/FormDraftHandler';

export default class AddApplicant {
    private formElement: JQuery<HTMLFormElement> | null;
    private applicantListContainer: JQuery<HTMLDivElement> | null;
    private draftClass: FormDraftHandler | null;
    constructor() {
        this.formElement = null;
        this.applicantListContainer = null;
        this.draftClass = null;
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

    public setupListApplicantActionListener() {
        this.applicantListContainer = $('#applicantListContainer');
        try {
            if (!this.applicantListContainer)
                throw new Error('Applicant list table not found');
            const table = this.applicantListContainer?.find(
                '#applicantListTable'
            );

            const addNewApplicantBtn = this.applicantListContainer?.find(
                '#addNewApplicantBtn'
            );
            if (!table || !addNewApplicantBtn)
                throw new Error('Table or button not found');
            table
                .find('tbody')
                .on(
                    'click',
                    '.editApplicantForm',
                    async (event: JQuery.ClickEvent) => {
                        const isConfirmed = await createConfirmationModal({
                            title: 'Confirm Applicant Edit',
                            message:
                                'Are you sure you want to edit this applicant?',
                            confirmText: 'Yes',
                            cancelText: 'No',
                        });
                        if (!isConfirmed) return;
                        try {
                            const button = $(event.target);
                            const secureFormLink =
                                button.data('secure-form-link');
                            if (!secureFormLink)
                                throw new Error('Secure form link not found');
                            await window.loadTab(secureFormLink, 'projectLink');
                            this.formElement = $('#applicationForm');
                            this.initializeApplicantDetailedForm();
                            if (
                                this.formElement.length &&
                                this.formElement.is(':visible')
                            ) {
                                this._initSyncApplicantDetail();
                            }
                        } catch (error: any) {
                            processError(
                                'Error in edit Applicant: ',
                                error,
                                true
                            );
                        }
                    }
                );

            addNewApplicantBtn?.on('click', async () => {
                try {
                    if (!NAV_ROUTES.ADD_APPLICANT)
                        throw new Error('Add applicant route not found');
                    await loadTab(NAV_ROUTES.ADD_APPLICANT, 'projectLink', {
                        'X-ADD-APPLICANT-FORM': true,
                    });
                } catch (error: any) {
                    processError('Error in add new applicant: ', error, true);
                }
            });
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

    private _initSyncApplicantDetail() {
        if (!this.formElement) throw new Error('Form element not found');
        if (!this.draftClass) {
            this.draftClass = new FormDraftHandler(this.formElement);
        }
        this.draftClass.syncTextInputData();
        this.draftClass.syncTablesData('#productAndSupplyChainTable tbody', {
            productAndSupply: BENCHMARKTableConfig.productAndSupply,
        });
        this.draftClass.syncTablesData('#productionTable tbody', {
            production: BENCHMARKTableConfig.production,
        });
        this.draftClass.syncTablesData('#productionEquipmentTable tbody', {
            productionEquipment: BENCHMARKTableConfig.productionEquipment,
        });

        this.draftClass.loadDraftData(
            APPLICATION_FORM_CONFIG,
            undefined,
            undefined,
            undefined,
            {
                loadOfficeAddressDropdowns:
                    AddressFormInput.loadOfficeAddressDropdowns,
                loadFactoryAddressDropdowns:
                    AddressFormInput.loadFactoryAddressDropdowns,
            }
        );
    }

    public initializeApplicantDetailedForm() {
        if (!this.formElement) throw new Error('Form element not found');
        customFormatNumericInput(this.formElement, [
            '#initial_capitalization',
            '#present_capitalization',
        ]);

        customFormatNumericInput(this.formElement, [
            '#buildings',
            '#equipments',
            '#working_capital',
        ]);

        this.formElement.on('input', () => {
            if (!this.formElement) return;
            calculateEnterpriseLevel(this.formElement.find('#assetsCard'));
        });

        customFormatNumericInput(
            this.formElement.find('#productAndSupplyChainTable tbody'),
            ['input.UnitCost', 'input.VolumeUsed']
        );
        customFormatNumericInput(
            this.formElement.find('#productionTable tbody'),
            ['input.UnitCost', 'input.AnnualCost']
        );
        customFormatNumericInput(
            this.formElement.find('#productionEquipmentTable tbody'),
            '.Capacity'
        );

        customFormatNumericInput(
            this.formElement.find('div#personnelContainer'),
            'input'
        );

        this.formElement
            .find(
                '#yearEstablished, #yearEnterpriseRegistered, #permitYearRegistered'
            )
            .on('input', function (e: JQuery.TriggeredEvent) {
                const target = e.target as HTMLInputElement;
                if (target) {
                    target.value = target.value.replace(/[^0-9]/g, '');
                }
            });

        const addressForms = [
            new AddressFormInput({ prefix: 'office' }),
            new AddressFormInput({ prefix: 'factory' }),
        ];
    }
}
