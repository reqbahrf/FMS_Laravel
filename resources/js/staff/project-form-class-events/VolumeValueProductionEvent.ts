import {
    formatNumber,
    parseFormattedNumberToFloat,
} from '../../Utilities/utilFunctions';
import { customFormatNumericInput } from '../../Utilities/input-utils';
import { TableDataExtractor } from '../../Utilities/TableDataExtractor';
import * as bootstrap from 'bootstrap';
import { showToastFeedback } from '../../Utilities/feedback-toast';

/**
 * VolumeValueProductionEvent class
 *
 * Provides specialized functionality for the Volume and Value Production table, including:
 * - Modal confirmation for adding/removing rows
 * - Real-time calculation of totals based on quarters and years
 * - Strict grouping of data by year, with quarters as a secondary grouping
 */
export default class VolumeValueProductionEvent {
    private form: JQuery<HTMLFormElement>;
    private container: JQuery<HTMLElement>;
    private table: JQuery<HTMLElement>;
    private addButton: JQuery<HTMLElement>;
    private removeButton: JQuery<HTMLElement>;
    private modalAdded: boolean = false;

    /**
     * Constructor
     * @param form The form element
     */
    constructor(form: JQuery<HTMLFormElement>) {
        this.form = form;

        // Initialize class properties
        this.container = this.form.find('#volumeAndValueProduction');
        this.table = this.container.find('table#volumeAndValueProductionTable');
        this.addButton = this.container.find('#addVolumeAndValueProductionRow');
        this.removeButton = this.container.find(
            '#removeVolumeAndValueProductionRow'
        );

        // Initialize features for volume and value production table
        this._initializeVolumeValueProductionFeatures();
        this._initializeFormatters();
    }

    /**
     * Initialize numeric input formatters
     */
    private _initializeFormatters(): void {
        customFormatNumericInput(
            this.table.find('tbody'),
            'td input.sales_gross_sales'
        );
    }

    /**
     * Initialize all features for volume and value production table
     */
    private _initializeVolumeValueProductionFeatures(): void {
        // Create modal elements if they don't exist
        this._createModals();

        // Override the standard add/remove row handlers
        this._initializeCustomRowHandlers();

        // Initialize real-time calculation
        this._initializeRealTimeCalculation();

        // Organize existing rows by year
        this._reorganizeRowsByYear();

        // Calculate totals on initialization
        this._calculateTotals();
    }

    /**
     * Create modal dialogs for adding and removing rows
     */
    private _createModals(): void {
        // Only create modals if they don't already exist
        if (!this.modalAdded && $('#volumeValueAddRowModal').length === 0) {
            // Create Add Row Modal - with year as the primary selection
            const addModalHtml = /*html*/ `
                <div class="modal fade" id="volumeValueAddRowModal" tabindex="-1" aria-labelledby="volumeValueAddRowModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="volumeValueAddRowModalLabel">Add New Row</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="volumeValueAddRowYearInput" class="form-label"><strong>Year</strong></label>
                                    <input type="text" class="form-control" id="volumeValueAddRowYearInput" value="${new Date().getFullYear()}">
                                </div>
                                <div class="mb-3">
                                    <label for="volumeValueAddRowQuarterSelect" class="form-label">Select Quarter</label>
                                    <select class="form-select" id="volumeValueAddRowQuarterSelect">
                                        <option value="1ˢᵗ Quarter">1ˢᵗ Quarter</option>
                                        <option value="2ⁿᵈ Quarter">2ⁿᵈ Quarter</option>
                                        <option value="3ʳᵈ Quarter">3ʳᵈ Quarter</option>
                                        <option value="4ᵗʰ Quarter">4ᵗʰ Quarter</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="volumeValueAddRowConfirm">Add Row</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Create Remove Row Modal
            const removeModalHtml = /*html*/ `
                <div class="modal fade" id="volumeValueRemoveRowModal" tabindex="-1" aria-labelledby="volumeValueRemoveRowModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="volumeValueRemoveRowModalLabel">Remove Row</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="volumeValueRemoveRowSelect" class="form-label">Select Year and Quarter</label>
                                    <select class="form-select" id="volumeValueRemoveRowSelect">
                                        <!-- Options will be populated dynamically -->
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" id="volumeValueRemoveRowConfirm">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Append modals to body
            $('body').append(addModalHtml);
            $('body').append(removeModalHtml);

            this.modalAdded = true;
        }
    }

    /**
     * Initialize custom row handlers with modal confirmation
     */
    private _initializeCustomRowHandlers(): void {
        // Remove any existing handlers
        this.addButton.off('click');
        this.removeButton.off('click');

        // Add button handler with modal
        this.addButton.on('click', () => {
            // Show the add row modal
            const addModal = new bootstrap.Modal(
                $('#volumeValueAddRowModal')[0]
            );
            addModal.show();
        });

        // Remove button handler with modal
        this.removeButton.on('click', () => {
            const tbody = this.table.find('tbody');
            const rows = tbody.find(
                'tr:not(.subtotal-row):not(.year-total-row)'
            );

            // Only show modal if there are rows to remove
            if (rows.length > 1) {
                // Show the remove row modal
                const removeModal = new bootstrap.Modal(
                    $('#volumeValueRemoveRowModal')[0]
                );
                // Dynamically populate the year/quarter dropdown
                this._populateYearQuarterDropdown(
                    '#volumeValueRemoveRowSelect'
                );
                removeModal.show();
            } else {
                console.warn('Cannot remove the last remaining row');
            }
        });

        // Handle add modal confirm button
        $('#volumeValueAddRowConfirm')
            .off('click')
            .on('click', () => {
                const quarterSelect = $('#volumeValueAddRowQuarterSelect');
                const yearInput = $('#volumeValueAddRowYearInput');

                const quarter = quarterSelect.val() as string;
                const year = yearInput.val() as string;

                this._addNewRow(quarter, year);

                // Hide the modal
                $('#volumeValueAddRowModal').modal('hide');
            });

        // Handle remove modal confirm button
        $('#volumeValueRemoveRowConfirm')
            .off('click')
            .on('click', () => {
                const quarterYearSelect = $('#volumeValueRemoveRowSelect');
                const selectedQY = quarterYearSelect.val() as string;

                if (selectedQY) {
                    const [quarter, year] = selectedQY.split('|');
                    this._removeRow(quarter, year);
                }

                // Hide the modal
                $('#volumeValueRemoveRowModal').modal('hide');
            });
    }

    /**
     * Initialize event listeners for real-time calculation
     */
    private _initializeRealTimeCalculation(): void {
        const tbody = this.table.find('tbody');

        // Add event listener for changes to gross sales inputs
        tbody.on('input', 'input.sales_gross_sales', () => {
            this._calculateTotals();
        });

        // Add event listener for changes to quarter or year
        tbody.on(
            'change',
            'select.sales_quarter_specify, input.for_year',
            () => {
                // When year changes, reorganize the rows
                this._reorganizeRowsByYear();
                this._calculateTotals();
            }
        );
    }

    /**
     * Reorganize the existing rows to be strictly grouped by year
     * This ensures consistent year grouping regardless of the order rows were added
     */
    private _reorganizeRowsByYear(): void {
        const tbody = this.table.find('tbody');
        const rows = tbody
            .find('tr:not(.subtotal-row):not(.year-total-row)')
            .get();

        if (rows.length <= 1) return;

        // Sort the rows by year first, then by quarter
        rows.sort((a, b) => {
            const aYear =
                parseInt($(a).find('input.for_year').val() as string) || 0;
            const bYear =
                parseInt($(b).find('input.for_year').val() as string) || 0;

            // Primary sort by year
            if (aYear !== bYear) {
                return aYear - bYear;
            }

            // Secondary sort by quarter within the same year
            const quartersOrder: { [key: string]: number } = {
                '1ˢᵗ Quarter': 1,
                '2ⁿᵈ Quarter': 2,
                '3ʳᵈ Quarter': 3,
                '4ᵗʰ Quarter': 4,
                Unknown: 5,
            };

            const aQuarter = $(a)
                .find('select.sales_quarter_specify')
                .val() as string;
            const bQuarter = $(b)
                .find('select.sales_quarter_specify')
                .val() as string;

            return quartersOrder[aQuarter] - quartersOrder[bQuarter];
        });

        // Reattach the sorted rows to the tbody
        $.each(rows, function (_, row) {
            tbody.append(row);
        });
    }

    /**
     * Add a new row to the table for the specified quarter and year
     * Enforces strict grouping by year
     * @param quarter The quarter to add (e.g., "1ˢᵗ Quarter")
     * @param year The year to add (e.g., "2023")
     */
    private _addNewRow(quarter: string, year: string): void {
        const tbody = this.table.find('tbody');

        // Create a new row
        const newRow = $(/*html*/ `
            <tr>
                <td>
                    <input class="name_of_product_service" type="text" value="">
                </td>
                <td>
                    <input class="volume_of_production" type="text" value="">
                </td>
                <td>
                    <select class="sales_quarter_specify form-select">
                        <option value="1ˢᵗ Quarter">1ˢᵗ Quarter</option>
                        <option value="2ⁿᵈ Quarter">2ⁿᵈ Quarter</option>
                        <option value="3ʳᵈ Quarter">3ʳᵈ Quarter</option>
                        <option value="4ᵗʰ Quarter">4ᵗʰ Quarter</option>
                    </select>
                    <input class="for_year" type="text" value="">
                </td>
                <td>
                    <input class="sales_gross_sales" type="text" value="">
                </td>
            </tr>
        `);

        // Set the selected quarter and year
        newRow.find('select.sales_quarter_specify').val(quarter);
        newRow.find('input.for_year').val(year);

        // Add the row to the table
        tbody.append(newRow);
        showToastFeedback(
            'text-bg-success',
            `Row for quarter ${quarter} and year ${year} added successfully!`
        );

        // Initialize formatters for the new row
        customFormatNumericInput(newRow, 'td input.sales_gross_sales');

        // Reorganize all rows to ensure year-based grouping
        this._reorganizeRowsByYear();

        // Recalculate totals
        this._calculateTotals();
    }

    /**
     * Remove a row from the table for the specified quarter and year
     * @param quarter The quarter to remove (e.g., "1ˢᵗ Quarter")
     * @param year The year to remove (e.g., "2023")
     */
    private _removeRow(quarter: string, year: string): void {
        const tbody = this.table.find('tbody');

        // Find all non-total rows that match the quarter and year
        const matchingRows = tbody
            .find('tr:not(.subtotal-row):not(.year-total-row)')
            .filter(function () {
                const rowQuarter = $(this)
                    .find('select.sales_quarter_specify')
                    .val();
                const rowYear = $(this).find('input.for_year').val();
                return rowQuarter === quarter && rowYear === year;
            });

        // Remove the last matching row
        if (matchingRows.length > 0) {
            matchingRows.last().remove();
            showToastFeedback(
                'text-bg-success',
                `Row for quarter ${quarter} and year ${year} removed successfully!`
            );

            // Recalculate totals
            this._calculateTotals();
        }

        // Ensure at least one row remains
        const remainingRows = tbody.find(
            'tr:not(.subtotal-row):not(.year-total-row)'
        );
        if (remainingRows.length === 0) {
            this._addNewRow('1ˢᵗ Quarter', new Date().getFullYear().toString());
        }
    }

    /**
     * Populate the year/quarter dropdown with existing data from the table
     * Groups data strictly by year first, then by quarter
     * @param selectSelector The selector for the dropdown to populate
     */
    private _populateYearQuarterDropdown(selectSelector: string): void {
        const select = $(selectSelector);
        select.empty();

        const tbody = this.table.find('tbody');
        const rows = tbody.find('tr:not(.subtotal-row):not(.year-total-row)');

        // Group all data by year
        const yearBasedGroups: {
            [year: string]: Array<{
                quarter: string;
                row: JQuery<HTMLElement>;
            }>;
        } = {};

        rows.each(function () {
            const $row = $(this);
            const year = $row.find('input.for_year').val() as string;
            const quarter = $row
                .find('select.sales_quarter_specify')
                .val() as string;

            if (year) {
                // Initialize the year array if it doesn't exist
                if (!yearBasedGroups[year]) {
                    yearBasedGroups[year] = [];
                }

                // Add this row's data to the year group
                yearBasedGroups[year].push({ quarter, row: $row });
            }
        });

        // Sort years numerically
        const sortedYears = Object.keys(yearBasedGroups).sort((a, b) => {
            return parseInt(a) - parseInt(b);
        });

        // Create option groups for each year
        for (const year of sortedYears) {
            const entries = yearBasedGroups[year];

            // Create an optgroup for the year
            const optgroup = $(`<optgroup label="Year ${year}"></optgroup>`);

            // Sort quarters within the year
            const quartersOrder: { [key: string]: number } = {
                '1ˢᵗ Quarter': 1,
                '2ⁿᵈ Quarter': 2,
                '3ʳᵈ Quarter': 3,
                '4ᵗʰ Quarter': 4,
                Unknown: 5,
            };

            entries.sort((a, b) => {
                return quartersOrder[a.quarter] - quartersOrder[b.quarter];
            });

            // Generate option for each entry in this year
            for (let i = 0; i < entries.length; i++) {
                const { quarter } = entries[i];
                const combo = `${quarter}|${year}`;

                // Create descriptive label that emphasizes the year grouping
                const label = `${year} - ${quarter}`;

                optgroup.append(`<option value="${combo}">${label}</option>`);
            }

            // Add the year group to the select
            select.append(optgroup);
        }

        // If there are no entries, add a placeholder
        if (sortedYears.length === 0) {
            select.append(
                '<option value="" disabled selected>No entries available</option>'
            );
        }
    }

    /**
     * Calculate and update totals for the Volume and Value Production table
     * Groups data by year first, then by quarter
     */
    private _calculateTotals(): void {
        const tbody = this.table.find('tbody');

        // Clear all existing subtotal and year total rows
        tbody.find('tr.subtotal-row, tr.year-total-row').remove();

        // Group rows by year and quarter
        const groupedData: {
            [year: string]: {
                [quarter: string]: {
                    rows: JQuery<HTMLElement>[];
                    total: number;
                };
            };
        } = {};

        // Process each row to group by year and quarter
        const rows = tbody.find('tr:not(.subtotal-row):not(.year-total-row)');
        rows.each((_, row) => {
            const $row = $(row);
            const quarter =
                ($row.find('select.sales_quarter_specify').val() as string) ||
                'Unknown';
            const year =
                ($row.find('input.for_year').val() as string) || 'Unknown';
            const grossSales = parseFormattedNumberToFloat(
                $row.find('input.sales_gross_sales').val() as string
            );

            // Initialize year and quarter objects if they don't exist
            if (!groupedData[year]) {
                groupedData[year] = {};
            }

            if (!groupedData[year][quarter]) {
                groupedData[year][quarter] = {
                    rows: [],
                    total: 0,
                };
            }

            // Add row to the group and update the total
            groupedData[year][quarter].rows.push($row);
            groupedData[year][quarter].total += grossSales;
        });

        // Insert subtotal rows for each quarter
        let yearTotals: { [year: string]: number } = {};
        let grandTotal = 0;

        // Sort years numerically
        const sortedYears = Object.keys(groupedData).sort((a, b) => {
            return parseInt(a) - parseInt(b);
        });

        for (const year of sortedYears) {
            if (!yearTotals[year]) {
                yearTotals[year] = 0;
            }

            // Sort quarters
            const quartersOrder: { [key: string]: number } = {
                '1ˢᵗ Quarter': 1,
                '2ⁿᵈ Quarter': 2,
                '3ʳᵈ Quarter': 3,
                '4ᵗʰ Quarter': 4,
                Unknown: 5,
            };

            const sortedQuarters = Object.keys(groupedData[year]).sort(
                (a, b) => quartersOrder[a] - quartersOrder[b]
            );

            for (const quarter of sortedQuarters) {
                const { rows, total } = groupedData[year][quarter];

                // Add quarter total to year total
                yearTotals[year] += total;

                // Get the last row of this quarter group
                const lastRow = rows[rows.length - 1];

                // Create quarter subtotal row
                const subtotalRow = $(`
                    <tr class="subtotal-row">
                        <td style="text-align: left;" colspan="3">Total</td>
                        <td style="font-weight: bold;">${formatNumber(total)}</td>
                    </tr>
                `);

                // Insert subtotal row after the last row of the group
                lastRow.after(subtotalRow);
            }

            // Add to grand total
            grandTotal += yearTotals[year];

            // Create year total row
            // const yearTotalRow = $(`
            //     <tr class="year-total-row">
            //         <td style="text-align: left;" colspan="3">${year} Annual Total</td>
            //         <td style="font-weight: bold;">${formatNumber(yearTotals[year])}</td>
            //     </tr>
            // `);

            // Find the last subtotal row for this year
            const lastQuarter = sortedQuarters[sortedQuarters.length - 1];
            const lastGroupRows = groupedData[year][lastQuarter].rows;
            const lastRowOfYear = lastGroupRows[lastGroupRows.length - 1];
            const lastSubtotalRowOfYear = lastRowOfYear.next('tr.subtotal-row');

            // Insert year total after the last subtotal row of the year
            // lastSubtotalRowOfYear.after(yearTotalRow);
        }

        // Create grand total row if there are multiple years
        // if (Object.keys(yearTotals).length > 1) {
        //     const grandTotalRow = $(`
        //         <tr class="year-total-row" style="background-color: #d0d0d0;">
        //             <td style="text-align: left;" colspan="3">Grand Total</td>
        //             <td style="font-weight: bold;">${formatNumber(grandTotal)}</td>
        //         </tr>
        //     `);

        //     // Append grand total row to the end
        //     tbody.append(grandTotalRow);
        // }
    }

    /**
     * Extract data from volume and value production table
     * Returns an array of objects representing the data in each row
     *
     * @returns {Array} Array of objects with productService, volumeOfProduction, salesQuarter, and grossSales keys
     */
    public extractVolumeValueProductionData(): any[] {
        const result: any[] = [];
        const tbody = this.table.find('tbody');

        // Find all non-total rows
        const rows = tbody.find('tr:not(.subtotal-row):not(.year-total-row)');

        rows.each(function () {
            const $row = $(this);

            const productService = $row
                .find('input.name_of_product_service')
                .val() as string;
            const volumeOfProduction = $row
                .find('input.volume_of_production')
                .val() as string;
            const quarter = $row
                .find('select.sales_quarter_specify')
                .val() as string;
            const year = $row.find('input.for_year').val() as string;
            const grossSales = $row
                .find('input.sales_gross_sales')
                .val() as string;

            // Only include rows with at least some data
            if (productService || volumeOfProduction || grossSales) {
                result.push({
                    productService,
                    volumeOfProduction,
                    salesQuarter: {
                        quarter,
                        year,
                    },
                    grossSales,
                });
            }
        });

        return result;
    }

    /**
     * Alternative method to extract data using a TableDataExtractor if available
     */
    public extractVolumeValueData() {
        try {
            // If TableDataExtractor is available, use it
            if (typeof TableDataExtractor !== 'undefined') {
                const tableConfig = {
                    volumeValueProduction: {
                        id: 'volumeAndValueProductionTable',
                        selectors: {
                            product_name: 'td input.name_of_product_service',
                            volume_of_production:
                                'td input.volume_of_production',
                            sales_quarter: 'td select.sales_quarter_specify',
                            for_year: 'td input.for_year',
                            sales_gross_sales: 'td input.sales_gross_sales',
                        },
                        requiredFields: [],
                    },
                };

                return TableDataExtractor(tableConfig);
            } else {
                // Fall back to the standard extraction method
                return {
                    volumeValueProduction:
                        this.extractVolumeValueProductionData(),
                };
            }
        } catch (error) {
            console.error('Error extracting volume value data:', error);
            return { volumeValueProduction: [] };
        }
    }
}
