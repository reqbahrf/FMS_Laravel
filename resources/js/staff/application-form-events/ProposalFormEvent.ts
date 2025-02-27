import {
    customFormatNumericInput,
    yearInputs,
} from '../../Utilities/input-utils';
import {
    parseFormattedNumberToFloat,
    formatNumberToCurrency,
} from '../../Utilities/utilFunctions';
export default class ProposalFormEvent {
    private form: JQuery<HTMLFormElement> | null;
    private numberInputSelectors: string[] | null;
    private yearInputSelectors: string[] | null;
    private monthNames: string[] | null;

    constructor(form: JQuery<HTMLFormElement>) {
        this.form = form;
        this.numberInputSelectors = this._getNumericInputs();
        this.yearInputSelectors = this._getYearInputs();
        this.monthNames = this._getMonthNames();

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
        if (!this.form) return [];

        const months: string[] = [];
        this.form.find('[data-custom-numeric-input]').each(function () {
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
        if (!this.form) return;

        // Attach event listener to all numeric inputs for totals calculation
        this.form.on('input', '[data-custom-numeric-input]', () => {
            this._calculateAllTotals();
        });
    }

    /**
     * Calculates all totals in the table
     */
    private _calculateAllTotals(): void {
        if (!this.form || !this.monthNames) return;

        // Calculate totals for each month across all years
        this.monthNames.forEach((month) => {
            this._calculateMonthTotal(month);
        });

        // Calculate yearly totals
        for (let year = 1; year <= 5; year++) {
            this._calculateYearTotal(year);
        }

        // Calculate grand total
        this._calculateGrandTotal();
    }

    /**
     * Calculates the total for a specific month across all years
     */
    private _calculateMonthTotal(month: string): void {
        if (!this.form) return;

        let total = 0;

        // Sum values for this month across all years
        for (let year = 1; year <= 5; year++) {
            const value = this.form.find(`.${month}_Y${year}`).val();
            total += parseFormattedNumberToFloat(value as string);
        }

        // Format the total with thousand separator
        const formattedTotal = formatNumberToCurrency(total);

        // Update the month total input
        this.form
            .find(`#refundStructureTable .${month}_total`)
            .val(formattedTotal);
    }

    /**
     * Calculates the total for a specific year across all months
     */
    private _calculateYearTotal(year: number): void {
        if (!this.form || !this.monthNames) return;

        let total = 0;

        // Sum values for all months in this year
        this.monthNames.forEach((month) => {
            if (!this.form) return;
            const value = this.form.find(`.${month}_Y${year}`).val();
            total += parseFormattedNumberToFloat(value as string);
        });

        // Format the total with thousand separator
        const formattedTotal = formatNumberToCurrency(total);

        // Update the year total cell (the +1 accounts for the first column being the month names)
        this.form
            .find(
                '#refundStructureTable tr:last-child td:nth-child(' +
                    (year + 1) +
                    ')'
            )
            .text(formattedTotal);
    }

    /**
     * Calculates the grand total of all values
     */
    private _calculateGrandTotal(): void {
        if (!this.form) return;

        let total = 0;

        // Sum all year totals
        for (let year = 1; year <= 5; year++) {
            const yearTotalText = this.form
                .find(
                    '#refundStructureTable tr:last-child td:nth-child(' +
                        (year + 1) +
                        ')'
                )
                .text();
            total += parseFormattedNumberToFloat(yearTotalText);
        }

        // Format the grand total with thousand separator
        const formattedTotal = formatNumberToCurrency(total);

        // Update the grand total cell
        this.form
            .find('#refundStructureTable tr:last-child td:last-child')
            .text(formattedTotal);
    }

    destroy(): void {
        // Remove specific input event listeners
        if (
            !this.form ||
            !this.numberInputSelectors ||
            !this.yearInputSelectors
        )
            return;
        this.form.off('input', this.numberInputSelectors.join(','));
        this.form.off('input', this.yearInputSelectors.join(','));
        // Optional: Clear any references to prevent memory leaks
        this.form = null;
        this.numberInputSelectors = null;
        this.yearInputSelectors = null;
    }
}
