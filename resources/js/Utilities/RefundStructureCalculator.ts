import { parseFormattedNumberToFloat, formatNumber } from './utilFunctions';

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

/**
 * A calculator for managing and computing refund payment structures in a table format.
 * Handles monthly and yearly payment calculations, distributes amounts across specified
 * time periods, and maintains totals for months, years, and grand total.
 * Provides methods to calculate payment structures based on fund release date,
 * refund duration, and total amount.
 */
export default class RefundStructureCalculator {
    private tableRefundStructure: JQuery<HTMLTableElement>;
    private monthNames: string[];

    constructor(tableRefundStructure: JQuery<HTMLTableElement>) {
        this.tableRefundStructure = tableRefundStructure;
        this.monthNames = this._getMonthNames();
    }

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
     * Calculates all totals in the table
     */
    public calculateAllTotals(): void {
        if (!this.monthNames) return;

        this.monthNames.forEach((month) => {
            this.calculateMonthTotal(month);
        });

        for (let year = 1; year <= 5; year++) {
            this.calculateYearTotal(year);
        }

        this.calculateGrandTotal();
    }

    /**
     * Calculates the total for a specific month across all years
     */
    public calculateMonthTotal(month: string): void {
        if (!this.tableRefundStructure) return;

        let total = 0;

        for (let year = 1; year <= 5; year++) {
            const value = this.tableRefundStructure
                .find(`.${month}_Y${year}`)
                .val();
            total += parseFormattedNumberToFloat(value as string);
        }

        const formattedTotal = formatNumber(total);

        this.tableRefundStructure.find(`.${month}_total`).val(formattedTotal);
    }

    /**
     * Calculates the total for a specific year across all months
     */
    public calculateYearTotal(year: number): void {
        if (!this.tableRefundStructure || !this.monthNames) return;

        let total = 0;

        this.monthNames.forEach((month) => {
            const value = this.tableRefundStructure
                .find(`.${month}_Y${year}`)
                .val();
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
    public calculateGrandTotal(): void {
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

    /**
     * Calculates the payment structure based on input parameters
     */
    public calculatePaymentStructure(
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
        this.clearTableValues();

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

            const targetYear = yearIndex;

            this.setTableValue(targetMonth, targetYear, formattedPayment);

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

        this.calculateAllTotals();
    }

    /**
     * Sets a value in the refund structure table
     */
    public setTableValue(month: string, year: number, value: string): void {
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

    /**
     * Clears all values in the refund structure table
     */
    public clearTableValues(): void {
        this.tableRefundStructure.find('[data-custom-numeric-input]').val('');
        this.tableRefundStructure
            .find('tbody tr:last-child td:not(:first-child)')
            .text('0');
    }
}
