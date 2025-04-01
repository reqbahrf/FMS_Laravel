import { processError } from '../../Utilities/error-handler-util';
import { customFormatNumericInput } from '../../Utilities/input-utils';
import RefundStructureCalculator from '../../Utilities/RefundStructureCalculator';
import { parseFormattedNumberToFloat } from '../../Utilities/utilFunctions';
import { AddressFormInput } from '../../Utilities/AddressInputHandler';
import calculateEnterpriseLevel from '../../Utilities/calculate-enterprise-level';
import { setupPhoneNumberInput } from '../../Utilities/phone-formatter';

export default class AddProject {
    private form: JQuery<HTMLFormElement> | null;
    private refundStrutureTable: JQuery<HTMLTableElement> | null;
    private refundCalculator: RefundStructureCalculator | null;
    private calculationBtn: JQuery<HTMLButtonElement> | null;
    constructor() {
        this.form = null;
        this.refundStrutureTable = null;
        this.refundCalculator = null;
        this.calculationBtn = null;
        this._initDependencies();
        this._initTableTotalsCalculator();
        this._initRefundCalculationBtn();
    }

    private _initDependencies() {
        this.form = $('#projectInfoForm');
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
            new AddressFormInput({ prefix: 'office' }),
            new AddressFormInput({ prefix: 'factory' }),
        ];
    }

    private _initRefundCalculationBtn() {
        if (!this.form || !this.calculationBtn) return;
        this.calculationBtn.on('click', () => {
            try {
                const fundReleaseDate = this.form
                    ?.find('input#fund_release_date')
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
