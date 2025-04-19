import { showToastFeedback } from '../../Utilities/feedback-toast';
import {
    customFormatNumericInput,
    yearInputs,
} from '../../Utilities/input-utils';
import { InitializeFilePond } from '../../Utilities/FilepondHandlers';
import { parseFormattedNumberToFloat } from '../../Utilities/utilFunctions';
import RefundStructureCalculator from '../../Utilities/RefundStructureCalculator';
import {
    addNewRowHandler,
    removeRowHandler,
} from '../../Utilities/add-and-remove-table-row-handler';
import FilePond from 'filepond';

export default class ProposalFormEvent {
    private form: JQuery<HTMLFormElement> | null;
    private tableRefundStructure: JQuery<HTMLTableElement>;
    private calculateRefundStructureButton: JQuery<HTMLButtonElement>;
    private numberInputSelectors: string[] | null;
    private yearInputSelectors: string[] | null;
    private refundCalculator: RefundStructureCalculator;
    private filePondInstance: {
        [key: string]: FilePond.FilePond | null;
    };

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
        this.filePondInstance = {
            organizationalChart: null,
            plantSiteOrLocation: null,
            proposedPlantLayout: null,
        };
        this._initTableTotalsCalculator();
        this._initWorkerTotalsCalculator();
        this._initEquipmentTableCalculator();
        this._initBudgetTableCalculator();
        this.refundCalculator.calculateAllTotals();
        this._initTableAddRowEvent();
        this._initFilePondUploadInput();
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

    private _initFilePondUploadInput(): void {
        if (!this.form) return;
        this.filePondInstance.organizationalChart = InitializeFilePond(
            'proposal_organizationalChart',
            { acceptedFileTypes: ['image/png', 'image/jpeg'] },
            'proposal_organizationalChartFileID_Data_Handler'
        );
        this.filePondInstance.plantSiteOrLocation = InitializeFilePond(
            'proposal_plantSiteOrLocation',
            { acceptedFileTypes: ['image/png', 'image/jpeg'] },
            'proposal_plantSiteOrLocationFileID_Data_Handler'
        );
        this.filePondInstance.proposedPlantLayout = InitializeFilePond(
            'proposal_proposedPlantLayout',
            { acceptedFileTypes: ['image/png', 'image/jpeg'] },
            'proposal_proposedPlantLayoutFileID_Data_Handler'
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
                        ?.find('#fund_released_date')
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

        const employeeTotalInput = this.form.find(
            'input[name="employee_total"]'
        );
        const employeeTotal =
            parseFormattedNumberToFloat(employeeTotalInput.val() as string) ||
            0;

        const grandTotalInput = this.form.find('input[name="grand_total"]');

        grandTotalInput.val(employeeTotal.toLocaleString());
    }

    private _initEquipmentTableCalculator(): void {
        const equipmentTable = this.form?.find(
            '#equipmentTable'
        ) as JQuery<HTMLTableElement>;
        if (!equipmentTable) return;
        const calculateEquipmentTable =
            this._calculateEquipmentTableFooterTotal;
        calculateEquipmentTable(equipmentTable);

        equipmentTable.on('input', '.Qty, .Unit_cost', function () {
            const row = $(this).closest('tr');
            const qty =
                parseFormattedNumberToFloat(row.find('.Qty').val() as string) ||
                0;
            const unitCost =
                parseFormattedNumberToFloat(
                    row.find('.Unit_cost').val() as string
                ) || 0;
            const totalCost = qty * unitCost;

            row.find('.Total_cost').val(totalCost.toLocaleString());

            calculateEquipmentTable(equipmentTable as JQuery<HTMLTableElement>);
        });
    }

    private _calculateEquipmentTableFooterTotal(
        table: JQuery<HTMLTableElement>
    ): void {
        let totalCost = 0;
        table.find('tbody tr').each(function () {
            const rowTotalCost =
                parseFormattedNumberToFloat(
                    $(this).find('.Total_cost').val() as string
                ) || 0;
            totalCost += rowTotalCost;
        });

        table.find('tfoot td:last-child').text(totalCost.toLocaleString());
    }

    private _initBudgetTableCalculator(): void {
        const budgetTable = this.form?.find(
            '#budgetTable'
        ) as JQuery<HTMLTableElement>;
        if (!budgetTable) return;
        const calculateBudgetTable = this._calculateBudgetTableFooterTotal;
        calculateBudgetTable(budgetTable);

        budgetTable.on('input', '.SETUP, .LGIA, .Cooperator', function () {
            const row = $(this).closest('tr');
            const setupCost =
                parseFormattedNumberToFloat(
                    row.find('.SETUP').val() as string
                ) || 0;
            const lgiaCost =
                parseFormattedNumberToFloat(
                    row.find('.LGIA').val() as string
                ) || 0;
            const cooperatorCost =
                parseFormattedNumberToFloat(
                    row.find('.Cooperator').val() as string
                ) || 0;

            const totalCost = setupCost + lgiaCost + cooperatorCost;
            row.find('.Total_cost').val(totalCost.toLocaleString());

            calculateBudgetTable(budgetTable as JQuery<HTMLTableElement>);
        });
    }

    private _calculateBudgetTableFooterTotal(
        table: JQuery<HTMLTableElement>
    ): void {
        let totalSETUP = 0;
        let totalLGIA = 0;
        let totalCooperator = 0;
        let grandTotal = 0;

        table.find('tbody tr').each(function () {
            const setupCost =
                parseFormattedNumberToFloat(
                    $(this).find('.SETUP').val() as string
                ) || 0;
            const lgiaCost =
                parseFormattedNumberToFloat(
                    $(this).find('.LGIA').val() as string
                ) || 0;
            const cooperatorCost =
                parseFormattedNumberToFloat(
                    $(this).find('.Cooperator').val() as string
                ) || 0;
            const rowTotal = setupCost + lgiaCost + cooperatorCost;

            totalSETUP += setupCost;
            totalLGIA += lgiaCost;
            totalCooperator += cooperatorCost;
            grandTotal += rowTotal;
        });

        const footerRow = table.find('tfoot tr');
        footerRow.find('td:nth-child(2)').text(totalSETUP.toLocaleString());
        footerRow.find('td:nth-child(3)').text(totalLGIA.toLocaleString());
        footerRow
            .find('td:nth-child(4)')
            .text(totalCooperator.toLocaleString());
        footerRow.find('td:nth-child(5)').text(grandTotal.toLocaleString());
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
