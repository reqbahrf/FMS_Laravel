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
        this.monthNames = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ];
        if (this.tableRefundStructure.find('tbody tr').length < 1) {
            this.generateTableStructure();
        }
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
            throw new Error('Invalid fund release date or no date selected');
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

    /**
     * Generates the HTML structure for the refund structure table
     * @param projectData - The project proposal data containing existing values
     * @param isEditable - Whether the table should be editable or read-only
     */
    public generateTableStructure(
        projectData: Record<string, string> = {},
        isEditable: boolean = true
    ): void {
        // Create table element if it doesn't exist
        if (
            this.tableRefundStructure.find('#refundStructureTable').length === 0
        ) {
            const table = $(
                '<table id="refundStructureTable" style="width: 100%; table-layout: fixed;"></table>'
            );
            const tbody = $('<tbody></tbody>');
            table.append(tbody);
            this.tableRefundStructure.empty().append(table);
        }

        const tbody = this.tableRefundStructure.find('tbody');
        tbody.empty();

        // Generate and append all rows
        tbody.append(this.generateSpacerRow());
        tbody.append(this.generateHeaderRow());

        // Add month rows
        this.monthNames.forEach((month) => {
            tbody.append(this.generateMonthRow(month, projectData, isEditable));
        });

        // Add totals row
        tbody.append(this._generateTotalsRow());

        // Calculate all totals if data is provided
        if (Object.keys(projectData).length > 0) {
            this.calculateAllTotals();
        }
    }

    /**
     * Generates a spacer row for the table
     * @returns jQuery object representing the spacer row
     */
    private generateSpacerRow(): JQuery {
        const spacerRow = $('<tr></tr>');
        for (let i = 0; i < 7; i++) {
            spacerRow.append($('<td width="14.3%"></td>'));
        }
        return spacerRow;
    }

    /**
     * Generates the header row for the table
     * @returns jQuery object representing the header row
     */
    private generateHeaderRow(): JQuery {
        const headerRow = $('<tr></tr>');
        headerRow.append($('<th style="text-align: center;">Months</th>'));
        for (let year = 1; year <= 5; year++) {
            headerRow.append(
                $(`<th style="text-align: center;">Y${year}</th>`)
            );
        }
        headerRow.append($('<th style="text-align: center;">Total</th>'));
        return headerRow;
    }

    /**
     * Generates a row for a specific month
     * @param month - The month name
     * @param projectData - The project data containing existing values
     * @param isEditable - Whether the cells should be editable
     * @returns jQuery object representing the month row
     */
    private generateMonthRow(
        month: string,
        projectData: Record<string, string>,
        isEditable: boolean
    ): JQuery {
        const row = $('<tr></tr>');
        row.append($(`<td>${month}</td>`));

        // Add year cells
        for (let year = 1; year <= 5; year++) {
            const cell = $('<td></td>');
            const fieldName = `${month}_Y${year}`;
            const value = projectData[fieldName] || '';

            if (isEditable) {
                const input = $(
                    `<input class="${month}_Y${year} form-control form-control-sm" name="${fieldName}" data-custom-numeric-input type="text" value="${value}">`
                );
                cell.append(input);
            } else {
                cell.text(value);
            }
            row.append(cell);
        }

        // Add total cell
        const totalCell = $('<td></td>');
        const totalFieldName = `${month}_total`;
        const totalValue = projectData[totalFieldName] || '';

        if (isEditable) {
            const totalInput = $(
                `<input class="${month}_total form-control form-control-plaintext" name="${totalFieldName}" data-custom-numeric-input type="text" value="${totalValue}" readonly>`
            );
            totalCell.append(totalInput);
        } else {
            totalCell.text(totalValue);
        }
        row.append(totalCell);

        return row;
    }

    /**
     * Generates the totals row for the table
     * @returns jQuery object representing the totals row
     */
    private _generateTotalsRow(): JQuery {
        const totalsRow = $('<tr></tr>');
        totalsRow.append($('<td class="bold">Total</td>'));

        // Add year total cells
        for (let year = 1; year <= 5; year++) {
            totalsRow.append($('<td class="text-center">0</td>'));
        }

        // Add grand total cell
        totalsRow.append($('<td>0</td>'));

        return totalsRow;
    }
}
