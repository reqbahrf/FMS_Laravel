import { processError } from '../../Utilities/error-handler-util';
import { customFormatNumericInput } from '../../Utilities/input-utils';
import RefundStructureCalculator from '../../Utilities/RefundStructureCalculator';
import {
    parseFormattedNumberToFloat,
    serializeFormData,
} from '../../Utilities/utilFunctions';
import { AddressFormInput } from '../../Utilities/AddressInputHandler';
import calculateEnterpriseLevel from '../../Utilities/calculate-enterprise-level';
import { setupPhoneNumberInput } from '../../Utilities/phone-formatter';
import createConfirmationModal from '../../Utilities/confirmation-modal';
import {
    showProcessToast,
    hideProcessToast,
    showToastFeedback,
} from '../../Utilities/feedback-toast';
import EXISTING_PROJECT_FORM_CONFIG from '../../Form_Config/EXISTING_PROJECT_CONFIG';
import { FormDraftHandler } from '../../Utilities/FormDraftHandler';

export default class AddProject {
    private form: JQuery<HTMLFormElement> | null;
    private refundStrutureTable: JQuery<HTMLTableElement> | null;
    private refundCalculator: RefundStructureCalculator | null;
    private calculationBtn: JQuery<HTMLButtonElement> | null;
    private draftClass: FormDraftHandler | null;
    constructor() {
        this.form = null;
        this.refundStrutureTable = null;
        this.refundCalculator = null;
        this.calculationBtn = null;
        this.draftClass = null;
        this._initDependencies();
        this._initTableTotalsCalculator();
        this._initRefundCalculationBtn();
        this._initFormDataSubmitEvent();
    }

    private _initDependencies() {
        this.form = $('#ExistingProjectForm');
        if (!this.form) return;
        this.refundStrutureTable = this.form.find('#refundStructureTable');

        this.refundCalculator = new RefundStructureCalculator(
            this.refundStrutureTable,
            true
        );
        this.refundCalculator.generateTableStructure();
        this.calculationBtn = this.form.find('button#generateRefundStructure');

        customFormatNumericInput(this.form, 'input#funded_amount');
        customFormatNumericInput(
            this.refundStrutureTable.find('tbody'),
            'input[type="text"]:not([readonly])'
        );

        setupPhoneNumberInput('input#mobile_no');

        const ASSET_CARD = this.form?.find('div#assetsCard');

        customFormatNumericInput(ASSET_CARD, [
            '#buildings',
            '#equipments',
            '#working_capital',
        ]);

        ASSET_CARD.find('#buildings, #equipments, #working_capital').on(
            'input',
            () => calculateEnterpriseLevel(ASSET_CARD)
        );

        customFormatNumericInput(
            this.form.find('#personnelContainer'),
            'input'
        );

        const addressInputHandler = [
            new AddressFormInput({ prefix: 'home' }),
            new AddressFormInput({ prefix: 'office' }),
            new AddressFormInput({ prefix: 'factory' }),
        ];

        this.draftClass = new FormDraftHandler(this.form);
        this.draftClass.syncTextInputData();
        this.draftClass.loadDraftData(
            EXISTING_PROJECT_FORM_CONFIG,
            undefined,
            undefined,
            undefined,
            {
                loadHomeAddressDropdowns:
                    AddressFormInput.loadHomeAddressDropdowns,
                loadOfficeAddressDropdowns:
                    AddressFormInput.loadOfficeAddressDropdowns,
                loadFactoryAddressDropdowns:
                    AddressFormInput.loadFactoryAddressDropdowns,
            }
        );
        this._initDeleteDraftEvent();
    }

    private _initFormDataSubmitEvent() {
        if (!this.form) return;
        this.form.on('submit', async (e: JQuery.SubmitEvent) => {
            e.preventDefault();
            const isConfirmed = await createConfirmationModal({
                title: 'Confirm Project Addition',
                message: 'Are you sure you want to add this project?',
                confirmText: 'Yes',
                cancelText: 'No',
            });
            if (!isConfirmed) return;
            const processToast = showProcessToast('Adding Project...');
            try {
                if (!this.form) throw new Error('Form not found');
                const url = this.form.attr('action');
                const formData = this.form.serializeArray();
                if (!formData || !formData.length || !url)
                    throw new Error('Form data not found');
                const formDataObject = serializeFormData(formData);
                await this._saveProject(formDataObject, url);
            } catch (error: any) {
                processError('Error in Adding Project: ', error, true);
            } finally {
                hideProcessToast(processToast);
            }
        });
    }

    private _initDeleteDraftEvent() {
        if (!this.form) return;
        this.form.find('#deleteDraftButton').on('click', async () => {
            try {
                console.log('This is triggered');
                if (!this.draftClass) return;
                await this.draftClass.deleteDraft();
            } catch (error) {
                processError('Error in Deleting Draft: ', error, true);
            }
        });
    }

    private async _saveProject(formData: { [key: string]: any }, url: string) {
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
            showToastFeedback('text-bg-success', response?.message);
        } catch (error: any) {
            console.log(error);
            throw new Error(
                error?.responseJSON?.message || error?.message || error
            );
        }
    }

    private _initRefundCalculationBtn() {
        if (!this.form || !this.calculationBtn) return;
        this.calculationBtn.on('click', () => {
            try {
                const fundReleaseDate = this.form
                    ?.find('input#fund_released_date')
                    .val() as string;
                const refundDurationYears = parseInt(
                    this.form?.find('input#project_duration').val() as string
                );
                const totalAmount = this.form
                    ?.find('input#funded_amount')
                    .val() as string;
                const parsedTotalAmount =
                    parseFormattedNumberToFloat(totalAmount);
                if (isNaN(parsedTotalAmount)) {
                    throw new Error('Invalid total amount');
                }
                if (!this.refundCalculator) return;
                this.refundCalculator.calculatePaymentStructure(
                    new Date(fundReleaseDate),
                    refundDurationYears,
                    parsedTotalAmount
                );
            } catch (error) {
                processError(
                    'Error while calculating refund structure: ',
                    error,
                    true
                );
            }
        });
    }

    private _initTableTotalsCalculator() {
        if (!this.refundStrutureTable || !this.refundCalculator) return;

        this.refundStrutureTable.on(
            'input',
            '[data-custom-numeric-input]',
            () => {
                if (!this.refundCalculator) return;
                this.refundCalculator.calculateAllTotals();
            }
        );
    }
}
