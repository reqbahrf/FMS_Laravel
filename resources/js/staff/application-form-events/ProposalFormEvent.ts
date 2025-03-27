import { showToastFeedback } from '../../Utilities/feedback-toast';
import {
    customFormatNumericInput,
    yearInputs,
} from '../../Utilities/input-utils';
import { parseFormattedNumberToFloat } from '../../Utilities/utilFunctions';
import RefundStructureCalculator from '../../Utilities/RefundStructureCalculator';

export default class ProposalFormEvent {
    private form: JQuery<HTMLFormElement> | null;
    private tableRefundStructure: JQuery<HTMLTableElement>;
    private calculateRefundStructureButton: JQuery<HTMLButtonElement>;
    private numberInputSelectors: string[] | null;
    private yearInputSelectors: string[] | null;
    private refundCalculator: RefundStructureCalculator;

    constructor(form: JQuery<HTMLFormElement>) {
        this.form = form;
        this.tableRefundStructure = form.find('#refundStructureTable');
        this.calculateRefundStructureButton = form.find(
            '#calculateRefundStructure'
        );
        this.numberInputSelectors = this._getNumericInputs();
        this.yearInputSelectors = this._getYearInputs();

        // Initialize the refund calculator
        this.refundCalculator = new RefundStructureCalculator(
            this.tableRefundStructure
        );

        this._initAutoRefundStructureCalculator();

        customFormatNumericInput(this.form, this.numberInputSelectors);
        yearInputs(this.form, this.yearInputSelectors);
        this._initTableTotalsCalculator();
        this.refundCalculator.calculateAllTotals();
    }

    private _getNumericInputs(): string[] {
        if (!this.form) return [];
        return this.form
            .find('[data-custom-numeric-input]')
            .map((idx, el) =>
                el.getAttribute('name')
                    ? `input[name="${el.getAttribute('name')}"]`
                    : `input.${el.getAttribute('class')}`
            )
            .toArray()
            .filter(Boolean);
    }

    private _getYearInputs(): string[] {
        if (!this.form) return [];
        return this.form
            .find('[data-year-input]')
            .map((idx, el) =>
                el.getAttribute('name')
                    ? `input[name="${el.getAttribute('name')}"]`
                    : `input.${el.getAttribute('class')}`
            )
            .toArray()
            .filter(Boolean);
    }

    /**
     * Initialize the table totals calculator
     */
    private _initTableTotalsCalculator(): void {
        if (!this.tableRefundStructure) return;

        this.tableRefundStructure.on(
            'input',
            '[data-custom-numeric-input]',
            () => {
                this.refundCalculator.calculateAllTotals();
            }
        );
    }

    private _initAutoRefundStructureCalculator(): void {
        try {
            if (!this.calculateRefundStructureButton) {
                throw new Error('Calculate refund structure button not found');
            }

            this.calculateRefundStructureButton.on('click', () => {
                try {
                    this.refundCalculator.clearTableValues();
                    const fundReleasedDate = this.form
                        ?.find('#fund_release_date')
                        .val() as string;
                    const refundDurationYears =
                        parseInt(
                            this.form?.find('#refund_duration').val() as string
                        ) || 3;
                    const totalAmount = this.form
                        ?.find('#amount_requested')
                        .val() as string;
                    const parsedTotalAmount =
                        parseFormattedNumberToFloat(totalAmount);
                    if (isNaN(parsedTotalAmount)) {
                        throw new Error('Invalid total amount');
                    }

                    this.refundCalculator.calculatePaymentStructure(
                        new Date(fundReleasedDate),
                        refundDurationYears,
                        parsedTotalAmount
                    );
                } catch (error: any) {
                    console.error(error);
                    showToastFeedback(
                        'text-bg-danger',
                        error ||
                            'An unexpected error occurred. while calculating refund structure'
                    );
                }
            });
        } catch (error) {
            console.error(error);
        }
    }

    destroy(): void {
        if (
            !this.form ||
            !this.numberInputSelectors ||
            !this.yearInputSelectors
        )
            return;
        this.form.off('input', this.numberInputSelectors.join(','));
        this.form.off('input', this.yearInputSelectors.join(','));
        this.form.off('input', '[data-custom-numeric-input]');
        this.tableRefundStructure.off('input', '[data-custom-numeric-input]');
        this.form = null;
        this.numberInputSelectors = null;
        this.yearInputSelectors = null;
    }
}
