import { showToastFeedback } from '../../Utilities/feedback-toast';
import {
    customFormatNumericInput,
    yearInputs,
} from '../../Utilities/input-utils';
import { parseFormattedNumberToFloat } from '../../Utilities/utilFunctions';
import RefundStructureCalculator from '../../Utilities/RefundStructureCalculator';
import {
    addNewRowHandler,
    removeRowHandler,
} from '../../Utilities/add-and-remove-table-row-handler';

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
        this._initWorkerTotalsCalculator();
        this.refundCalculator.calculateAllTotals();
        this._initTableAddRowEvent();
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

    private _initWorkerTotalsCalculator(): void {
        if (!this.form) return;

        const workerCategories = [
            'direct_workers',
            'production',
            'non_production',
            'indirect_contract_workers',
        ];

        workerCategories.forEach((category) => {
            if (!this.form) return;
            const maleInput = this.form.find(
                `input[name="${category}_male"]`
            ) as JQuery<HTMLInputElement>;
            const femaleInput = this.form.find(
                `input[name="${category}_female"]`
            ) as JQuery<HTMLInputElement>;
            const totalInput = this.form.find(
                `input[name="${category}_total"]`
            ) as JQuery<HTMLInputElement>;

            maleInput.on('input', () => {
                this._calculateCategoryTotal(
                    maleInput,
                    femaleInput,
                    totalInput
                );
            });

            femaleInput.on('input', () => {
                this._calculateCategoryTotal(
                    maleInput,
                    femaleInput,
                    totalInput
                );
            });
        });

        // Calculate total male, female, and employee total
        const calculateOverallTotals = () => {
            const totalMaleInputs = workerCategories.map(
                (category) =>
                    parseFormattedNumberToFloat(
                        this.form
                            ?.find(`input[name="${category}_male"]`)
                            .val() as string
                    ) || 0
            );
            const totalFemaleInputs = workerCategories.map(
                (category) =>
                    parseFormattedNumberToFloat(
                        this.form
                            ?.find(`input[name="${category}_female"]`)
                            .val() as string
                    ) || 0
            );

            const totalMale = totalMaleInputs.reduce((a, b) => a + b, 0);
            const totalFemale = totalFemaleInputs.reduce((a, b) => a + b, 0);
            const employeeTotal = totalMale + totalFemale;

            this.form
                ?.find('input[name="total_male"]')
                .val(totalMale.toLocaleString());
            this.form
                ?.find('input[name="total_female"]')
                .val(totalFemale.toLocaleString());
            this.form
                ?.find('input[name="employee_total"]')
                .val(employeeTotal.toLocaleString());

            // Calculate grand total
            this._calculateGrandTotal();
        };

        workerCategories.forEach((category) => {
            if (!this.form) return;
            this.form
                .find(`input[name="${category}_male"]`)
                .on('input', calculateOverallTotals);
            this.form
                .find(`input[name="${category}_female"]`)
                .on('input', calculateOverallTotals);
        });

        // Add event listener for employee_total to trigger grand total calculation
        this.form.find('input[name="employee_total"]').on('input', () => {
            this._calculateGrandTotal();
        });
    }

    private _calculateCategoryTotal(
        maleInput: JQuery<HTMLInputElement>,
        femaleInput: JQuery<HTMLInputElement>,
        totalInput: JQuery<HTMLInputElement>
    ): void {
        const maleValue =
            parseFormattedNumberToFloat(maleInput.val() as string) || 0;
        const femaleValue =
            parseFormattedNumberToFloat(femaleInput.val() as string) || 0;
        const total = maleValue + femaleValue;

        totalInput.val(total.toLocaleString());
    }

    private _calculateGrandTotal(): void {
        if (!this.form) return;

        // Get the employee total value
        const employeeTotalInput = this.form.find(
            'input[name="employee_total"]'
        );
        const employeeTotal =
            parseFormattedNumberToFloat(employeeTotalInput.val() as string) ||
            0;

        // Assuming there might be other inputs for grand total calculation
        // You can modify this logic based on your specific requirements
        const grandTotalInput = this.form.find('input[name="grand_total"]');

        // For now, just set the grand total to be the same as employee total
        // You might want to add more complex logic here if needed
        grandTotalInput.val(employeeTotal.toLocaleString());
    }

    private _initTableAddRowEvent(): void {
        if (!this.form) return;
        addNewRowHandler(
            '#addTechnicalConstraintRow',
            this.form.find('#technicalConstraintTableContainer')
        );
        removeRowHandler(
            '#removeTechnicalConstraintRow',
            this.form.find('#technicalConstraintTableContainer')
        );

        addNewRowHandler(
            '#addEquipmentRow',
            this.form.find('#equipmentTableContainer')
        );
        removeRowHandler(
            '#removeEquipmentRow',
            this.form.find('#equipmentTableContainer')
        );

        addNewRowHandler(
            '#addBudgetRow',
            this.form.find('#budgetTableContainer')
        );
        removeRowHandler(
            '#removeBudgetRow',
            this.form.find('#budgetTableContainer')
        );

        addNewRowHandler('#addRiskRow', this.form.find('#riskTableContainer'));
        removeRowHandler(
            '#removeRiskRow',
            this.form.find('#riskTableContainer')
        );
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
        const workerCategories = [
            'direct_workers',
            'production',
            'non_production',
            'indirect_contract_workers',
        ];
        workerCategories.forEach((category) => {
            this.form?.find(`input[name="${category}_male"]`).off('input');
            this.form?.find(`input[name="${category}_female"]`).off('input');
        });
        this.form?.find('input[name="total_male"]').off('input');
        this.form?.find('input[name="total_female"]').off('input');
        this.form?.find('input[name="employee_total"]').off('input');
        this.form?.find('input[name="grand_total"]').off('input');
        this.form = null;
        this.numberInputSelectors = null;
        this.yearInputSelectors = null;
    }
}
