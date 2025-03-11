import { showToastFeedback } from '../../Utilities/feedback-toast';
import {
    customFormatNumericInput,
    yearInputs,
} from '../../Utilities/input-utils';
import {
    parseFormattedNumberToFloat,
    formatNumber,
} from '../../Utilities/utilFunctions';

interface YearTotals {
    y1: number;
    y2: number;
    y3: number;
    y4: number;
    y5: number;
    [key: string]: number; // Index signature
}

interface MonthTotals {
    January: number;
    February: number;
    March: number;
    April: number;
    May: number;
    June: number;
    July: number;
    August: number;
    September: number;
    October: number;
    November: number;
    December: number;
    [key: string]: number; // Index signature
}
export default class ProposalFormEvent {
    private form: JQuery<HTMLFormElement> | null;
    private tableRefundStructure: JQuery<HTMLTableElement>;
    private calculateRefundStructureButton: JQuery<HTMLButtonElement>;
    private numberInputSelectors: string[] | null;
    private yearInputSelectors: string[] | null;
    private monthNames: string[] | null;

    constructor(form: JQuery<HTMLFormElement>) {
        this.form = form;
        this.tableRefundStructure = form.find('#refundStructureTable');
        this.calculateRefundStructureButton = form.find(
            '#calculateRefundStructure'
        );
        this.numberInputSelectors = this._getNumericInputs();
        this.yearInputSelectors = this._getYearInputs();
        this.monthNames = this._getMonthNames();
        this._initAutoRefundStructureCalculator();

        customFormatNumericInput(this.form, this.numberInputSelectors);
        yearInputs(this.form, this.yearInputSelectors);
        this._initTableTotalsCalculator();
        this._calculateAllTotals();
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
     * Extracts month names from the table inputs
     */
    private _getMonthNames(): string[] {
        if (!this.tableRefundStructure) return [];

        const months: string[] = [];
        this.tableRefundStructure
            .find('[data-custom-numeric-input]')
            .each(function () {
                const name = $(this).attr('name');
                if (name && name.includes('_Y')) {
                    const month = name.split('_Y')[0];
                    if (!months.includes(month)) {
                        months.push(month);
                    }
                }
            });

        return months;
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
                this._calculateAllTotals();
            }
        );
    }

    /**
     * Calculates all totals in the table
     */
    private _calculateAllTotals(): void {
        if (!this.form || !this.monthNames) return;

        this.monthNames.forEach((month) => {
            this._calculateMonthTotal(month);
        });

        for (let year = 1; year <= 5; year++) {
            this._calculateYearTotal(year);
        }

        this._calculateGrandTotal();
    }

    /**
     * Calculates the total for a specific month across all years
     */
    private _calculateMonthTotal(month: string): void {
        if (!this.form) return;

        let total = 0;

        for (let year = 1; year <= 5; year++) {
            const value = this.form.find(`.${month}_Y${year}`).val();
            total += parseFormattedNumberToFloat(value as string);
        }

        const formattedTotal = formatNumber(total);

        this.tableRefundStructure.find(`.${month}_total`).val(formattedTotal);
    }

    /**
     * Calculates the total for a specific year across all months
     */
    private _calculateYearTotal(year: number): void {
        if (!this.form || !this.monthNames) return;

        let total = 0;

        this.monthNames.forEach((month) => {
            if (!this.form) return;
            const value = this.form.find(`.${month}_Y${year}`).val();
            total += parseFormattedNumberToFloat(value as string);
        });

        const formattedTotal = formatNumber(total);

        this.tableRefundStructure
            .find('tr:last-child td:nth-child(' + (year + 1) + ')')
            .text(formattedTotal);
    }

    /**
     * Calculates the grand total of all values
     */
    private _calculateGrandTotal(): void {
        if (!this.tableRefundStructure) return;

        let total = 0;

        for (let year = 1; year <= 5; year++) {
            const yearTotalText = this.tableRefundStructure
                .find('tr:last-child td:nth-child(' + (year + 1) + ')')
                .text();
            total += parseFormattedNumberToFloat(yearTotalText);
        }

        const formattedTotal = formatNumber(total);

        this.tableRefundStructure
            .find('tr:last-child td:last-child')
            .text(formattedTotal);
    }

    private _calculatePaymentStructure(
        fundReleaseDate: Date,
        refundDurationYears: number,
        totalAmount: number
    ): void {
        if (
            !(fundReleaseDate instanceof Date) ||
            isNaN(fundReleaseDate.getTime())
        ) {
            throw new Error('Invalid fund release date');
        }
        if (
            !Number.isInteger(refundDurationYears) ||
            refundDurationYears <= 0 ||
            refundDurationYears > 5
        ) {
            throw new Error(
                'Refund duration must be a positive integer not exceeding 5 years'
            );
        }

        if (isNaN(totalAmount) || totalAmount <= 0) {
            throw new Error('Total amount must be a positive number');
        }

        // Clear the table first
        this._clearTableValues();

        const totalMonths: number = refundDurationYears * 12;
        const baseMonthlyPayment: number = Math.floor(
            totalAmount / totalMonths
        );
        let remainder: number = totalAmount - baseMonthlyPayment * totalMonths;

        const yearTotals: YearTotals = {
            y1: 0,
            y2: 0,
            y3: 0,
            y4: 0,
            y5: 0,
        };

        const monthTotals: MonthTotals = {
            January: 0,
            February: 0,
            March: 0,
            April: 0,
            May: 0,
            June: 0,
            July: 0,
            August: 0,
            September: 0,
            October: 0,
            November: 0,
            December: 0,
        };

        const months: string[] = Object.keys(monthTotals);
        let grandTotal: number = 0;

        let endDate = new Date(fundReleaseDate);
        endDate.setMonth(endDate.getMonth() + totalMonths - 1);

        let currentDate = new Date(fundReleaseDate);
        let monthsRemaining = totalMonths;

        while (monthsRemaining > 0) {
            const currentMonth = currentDate.getMonth();
            let yearIndex = Math.floor(
                currentDate.getFullYear() - fundReleaseDate.getFullYear() + 1
            );

            if (yearIndex > 5) {
                yearIndex = 5;
            }

            // if (yearIndex > 5) break;

            const monthName = months[currentMonth];
            let payment = baseMonthlyPayment;

            if (monthsRemaining === 1 && remainder > 0) {
                payment += remainder;
                remainder = 0;
            }

            const formattedPayment = formatNumber(payment);

            const targetMonth =
                yearIndex === 5 &&
                currentDate.getFullYear() > fundReleaseDate.getFullYear() + 4
                    ? 'December'
                    : monthName;
            console.log('targetMonth', targetMonth);
            const targetYear = yearIndex;

            this._setTableValue(targetMonth, targetYear, formattedPayment);

            yearTotals[`y${yearIndex}`] += payment;
            monthTotals[targetMonth] += payment;
            grandTotal += payment;
            currentDate.setMonth(currentDate.getMonth() + 1);
            monthsRemaining--;
        }

        for (let year = 1; year <= 5; year++) {
            const formattedYearTotal = formatNumber(yearTotals[`y${year}`]);
            this.tableRefundStructure
                .find(`tbody tr:last-child td:nth-child(${year + 1})`)
                .text(yearTotals[`y${year}`] > 0 ? formattedYearTotal : '0');
        }

        this._calculateAllTotals();
    }

    private _setTableValue(month: string, year: number, value: string): void {
        const input: JQuery<HTMLInputElement> = this.tableRefundStructure.find(
            `.${month}_Y${year}`
        );
        if (month === 'December' && year === 5 && input.length) {
            const initialValue = input.val() as string;
            const parsedInitialValue =
                parseFormattedNumberToFloat(initialValue);
            const parsedValue = parseFormattedNumberToFloat(value);
            const finalValue = parsedInitialValue + parsedValue;
            const formattedFinalValue = formatNumber(finalValue);
            input.val(formattedFinalValue);
        } else {
            input.val(value);
        }
    }

    private _clearTableValues(): void {
        this.tableRefundStructure.find('[data-custom-numeric-input]').val('');
        this.tableRefundStructure
            .find('tbody tr:last-child td:not(:first-child)')
            .text('0');
    }

    private _initAutoRefundStructureCalculator(): void {
        try {
            if (!this.calculateRefundStructureButton) {
                throw new Error('Calculate refund structure button not found');
            }

            this.calculateRefundStructureButton.on('click', () => {
                try {
                    this._clearTableValues();
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
                    this._calculatePaymentStructure(
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
