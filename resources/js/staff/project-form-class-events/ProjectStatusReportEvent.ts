import { InitializeFloatingWindow } from '../../Utilities/FloatingWindow';
import {
    addNewRowHandler,
    removeRowHandler,
} from '../../Utilities/add-and-remove-table-row-handler';
import { customFormatNumericInput } from '../../Utilities/input-utils';
import {
    formatNumber,
    parseFormattedNumberToFloat,
} from '../../Utilities/utilFunctions';
import { TableDataExtractor } from '../../Utilities/TableDataExtractor';
import VolumeValueProductionEvent from './VolumeValueProductionEvent';
export default class ProjectStatusReportEvent {
    protected form: JQuery<HTMLFormElement>;
    private parentFormWrapper: JQuery<HTMLElement>;
    private floatingWindowContainer: JQuery<HTMLElement>;
    private volumeValueProductionEvent: VolumeValueProductionEvent;

    constructor(form: JQuery<HTMLFormElement>) {
        this.form = form;
        this.parentFormWrapper = this.form.closest('#formWrapper');
        this.floatingWindowContainer =
            this.parentFormWrapper.find('#floating-window');
        this._initializeInputFormatters();
        this._initializeFloatingWindow();
        this._initializeAddAndRemoveTableRow();
        this._initializeIndirectEmploymentCalculation();
        this._initializeQuarterTablesHandlers();

        // Initialize the volume value production event handler
        this.volumeValueProductionEvent = new VolumeValueProductionEvent(
            this.form
        );
    }

    private _initializeInputFormatters() {
        customFormatNumericInput(
            this.form.find('div#projectInfo table tbody td'),
            'input.amount_of_setup_assistance'
        );
        customFormatNumericInput(
            this.form.find('table#equipmentAndFacilitiesTable tbody'),
            [
                'td input.approved_qty',
                'td input.approved_cost',
                'td input.actual_qty',
                'td input.actual_cost',
            ]
        );
        customFormatNumericInput(
            this.form.find('table#nonEquipmentItemsTable tbody'),
            [
                'td input.approved_qty',
                'td input.approved_cost',
                'td input.actual_qty',
                'td input.actual_cost',
            ]
        );

        customFormatNumericInput(
            this.form.find('div#statusFundUtilization table'),
            [
                'td input[name="total_approved_project_cost"]',
                'td input[name="amount_utilized_per_financial_report"]',
            ]
        );

        customFormatNumericInput(this.form.find('div#statusOfRefund table'), [
            'td input[name="total_amount_to_be_refunded"]',
            'td input[name="total_amount_already_due"]',
            'td input[name="total_amount_refunded"]',
        ]);

        customFormatNumericInput(
            this.form.find('table#volumeAndValueProductionTable tbody'),
            'td input.sales_gross_sales'
        );

        customFormatNumericInput(
            this.form.find('table#indirectEmploymentTable tbody'),
            [
                'td input.forward_male',
                'td input.forward_female',
                'td input.backward_male',
                'td input.backward_female',
            ]
        );

        // Add numeric formatters for employment tables
        this._initializeEmploymentInputFormatters();
    }

    private _initializeAddAndRemoveTableRow() {
        try {
            addNewRowHandler(
                '#addEquipmentAndFacilitiesRow',
                '#equipmentAndFacilitiesPurchased'
            );
            removeRowHandler(
                '#removeEquipmentAndFacilitiesRow',
                '#equipmentAndFacilitiesPurchased'
            );

            addNewRowHandler('#addNonEquipmentRow', '#nonEquipmentItems');
            removeRowHandler('#removeNonEquipmentRow', '#nonEquipmentItems');

            addNewRowHandler(
                '#addNewIndirectEmploymentRow',
                '#newIndirectEmploymentFromTheProject'
            );
            removeRowHandler(
                '#removeNewIndirectEmploymentRow',
                '#newIndirectEmploymentFromTheProject'
            );
        } catch (error) {
            console.error(
                'Error initializing add and remove table row:',
                error
            );
        }
    }

    private _initializeFloatingWindow() {
        console.log('this Floating Window is initialize');
        const openButton = this.parentFormWrapper.find(
            'button#open-floating-window'
        );

        const f_content =
            this.floatingWindowContainer.find('#floating-content');
        const f_input = $('#projectLedgerLink') as JQuery<HTMLInputElement>;
        const f_window = this.floatingWindowContainer;
        const f_header = this.floatingWindowContainer.find('#floating-header');
        const f_closeButton =
            this.floatingWindowContainer.find('#close-button');

        openButton.on('click', async function () {
            try {
                console.log('Floating Window is opened');
                const module = InitializeFloatingWindow({
                    f_content,
                    f_input,
                    f_window,
                    f_header,
                    f_closeButton,
                });
                module.open();
            } catch (error) {
                console.error('Error initializing floating window:', error);
            }
        });
    }

    /**
     * Initialize real-time calculation for indirect employment data
     */
    private _initializeIndirectEmploymentCalculation() {
        const table = this.form.find('table#indirectEmploymentTable');
        const tbody = table.find('tbody');

        // Event delegation for input changes
        tbody.on(
            'input',
            'td input.forward_male, td input.forward_female, td input.backward_male, td input.backward_female',
            () => {
                console.log('Input changed');
                this._calculateIndirectEmploymentTotals(table);
            }
        );
        this._calculateIndirectEmploymentTotals(table);
        this.form
            .find(
                '#addNewIndirectEmploymentRow, #removeNewIndirectEmploymentRow'
            )
            .on('click', () => {
                setTimeout(() => {
                    this._calculateIndirectEmploymentTotals(table);
                }, 100);
            });
    }

    /**
     * Calculate totals for indirect employment data
     * This mirrors the PHP backend calculation logic
     */
    private _calculateIndirectEmploymentTotals(table: JQuery<HTMLElement>) {
        const rows = table.find('tbody tr');

        // Initialize grand totals
        const grandTotals = {
            forward: {
                male: 0,
                female: 0,
                total: 0,
            },
            backward: {
                male: 0,
                female: 0,
                total: 0,
            },
        };

        // Process each row
        rows.each((_, row) => {
            const $row = $(row);

            const forwardMale = parseFormattedNumberToFloat(
                $row.find('input.forward_male').val() as string
            );
            const forwardFemale = parseFormattedNumberToFloat(
                $row.find('input.forward_female').val() as string
            );
            const backwardMale = parseFormattedNumberToFloat(
                $row.find('input.backward_male').val() as string
            );
            const backwardFemale = parseFormattedNumberToFloat(
                $row.find('input.backward_female').val() as string
            );

            const forwardTotal = forwardMale + forwardFemale;
            const backwardTotal = backwardMale + backwardFemale;

            $row.find('td.forward_total').text(
                formatNumber(forwardTotal, false)
            );
            $row.find('td.backward_total').text(
                formatNumber(backwardTotal, false)
            );

            grandTotals.forward.male += forwardMale;
            grandTotals.forward.female += forwardFemale;
            grandTotals.backward.male += backwardMale;
            grandTotals.backward.female += backwardFemale;
        });

        grandTotals.forward.total =
            grandTotals.forward.male + grandTotals.forward.female;
        grandTotals.backward.total =
            grandTotals.backward.male + grandTotals.backward.female;

        const tfoot = table.find('tfoot');
        tfoot
            .find('td.forward_male_total')
            .text(formatNumber(grandTotals.forward.male, false));
        tfoot
            .find('td.forward_female_total')
            .text(formatNumber(grandTotals.forward.female, false));
        tfoot
            .find('td.forward_total_sum')
            .text(formatNumber(grandTotals.forward.total, false));
        tfoot
            .find('td.backward_male_total')
            .text(formatNumber(grandTotals.backward.male, false));
        tfoot
            .find('td.backward_female_total')
            .text(formatNumber(grandTotals.backward.female, false));
        tfoot
            .find('td.backward_total_sum')
            .text(formatNumber(grandTotals.backward.total, false));
    }

    /**
     * Initialize formatters for employment table inputs
     */
    private _initializeEmploymentInputFormatters() {
        customFormatNumericInput(this.form.find('#newEmploymentGenerated'), [
            'td input.noOfEmployees',
            'td input.noOfMale',
            'td input.noOfFemale',
            'td input.noOfPersonWithDisability',
        ]);
    }

    /**
     * Initialize event handlers for adding and removing quarter tables
     */
    private _initializeQuarterTablesHandlers() {
        try {
            console.log('Initializing quarter tables handlers');

            const container = this.form.find('#newEmploymentGenerated');
            const addButton = container.find('#addQuarterTableButton');
            const removeButton = container.find('#removeQuarterTableButton');
            const quarterTablesContainer = container.find(
                '#quarterTablesContainer'
            );

            addButton.off('click').on('click', () => {
                const quarterTables =
                    quarterTablesContainer.find('.quarter-table');
                const currentQuarterCount = quarterTables.length;

                if (currentQuarterCount < 4) {
                    const nextQuarterNum = currentQuarterCount + 1;
                    this._addNewQuarterTable(
                        quarterTablesContainer,
                        nextQuarterNum
                    );

                    removeButton.prop('disabled', false);

                    if (nextQuarterNum === 4) {
                        addButton.prop('disabled', true);
                    }

                    this._initializeEmploymentInputFormatters();
                }
            });

            removeButton.off('click').on('click', () => {
                const quarterTables =
                    quarterTablesContainer.find('.quarter-table');
                const currentQuarterCount = quarterTables.length;

                if (currentQuarterCount > 1) {
                    quarterTablesContainer
                        .find('.quarter-table:last-child')
                        .remove();

                    if (currentQuarterCount - 1 === 1) {
                        removeButton.prop('disabled', true);
                    }
                    addButton.prop('disabled', false);
                }
            });
        } catch (error) {
            console.error('Error initializing quarter tables handlers:', error);
        }
    }

    /**
     * Add a new quarter table to the container
     * @param container The container element to add the quarter table to
     * @param quarterNum The quarter number (1-4)
     */
    private _addNewQuarterTable(
        container: JQuery<HTMLElement>,
        quarterNum: number
    ) {
        let suffix = '';
        switch (quarterNum) {
            case 1:
                suffix = 'ˢᵗ';
                break;
            case 2:
                suffix = 'ⁿᵈ';
                break;
            case 3:
                suffix = 'ʳᵈ';
                break;
            case 4:
                suffix = 'ᵗʰ';
                break;
        }

        const firstQuarterTable = container.find('.quarter-table:first-child');
        const newQuarterTable = firstQuarterTable.clone();

        newQuarterTable.attr('data-quarter', quarterNum);
        newQuarterTable.find('p').text(`${quarterNum}${suffix} Quarter`);
        newQuarterTable
            .find('table')
            .attr('id', `newEmploymentGeneratedForQuarter${quarterNum}`);

        newQuarterTable.find('input').val('');

        container.append(newQuarterTable);
    }

    /**
     * Extract data from all employment quarter tables
     *
     * This method extracts data from all quarter tables in the new employment generated section.
     * It returns an object with a 'newEmploymentGenerated' key containing data for each quarter.
     * Each quarter's data includes the number of employees, males, females, and persons with disability.
     *
     * @returns {Object} An object with newEmploymentGenerated data organized by quarters
     *
     * Example return value:
     * {
     *   newEmploymentGenerated: {
     *     quarter1: {
     *       noOfEmployees: "10",
     *       noOfMale: "6",
     *       noOfFemale: "4",
     *       noOfPersonWithDisability: "1"
     *     },
     *     quarter2: {
     *       noOfEmployees: "15",
     *       noOfMale: "8",
     *       noOfFemale: "7",
     *       noOfPersonWithDisability: "2"
     *     }
     *   }
     * }
     */
    public extractEmploymentGeneratedData(): {
        newEmploymentGenerated: { [key: string]: any };
    } {
        try {
            const container = this.form.find('#newEmploymentGenerated');
            const quarterTables = container.find('.quarter-table');
            const result: { newEmploymentGenerated: { [key: string]: any } } = {
                newEmploymentGenerated: {},
            };

            // Configure TableDataExtractor for each quarter table
            const tableConfigs: { [key: string]: any } = {};

            quarterTables.each((index, quarterTableElement) => {
                const $quarterTable = $(quarterTableElement);
                const quarterNum = $quarterTable.attr('data-quarter');
                const tableId = `newEmploymentGeneratedForQuarter${quarterNum}`;

                // Create a configuration for this quarter's table
                tableConfigs[`quarter${quarterNum}`] = {
                    id: tableId,
                    selectors: {
                        noOfEmployees: 'td input.noOfEmployees',
                        noOfMale: 'td input.noOfMale',
                        noOfFemale: 'td input.noOfFemale',
                        noOfPersonWithDisability:
                            'td input.noOfPersonWithDisability',
                    },
                    requiredFields: [], // We don't require any specific fields to be filled
                };
            });

            if (Object.keys(tableConfigs).length > 0) {
                // Extract data using TableDataExtractor
                const extractedData = TableDataExtractor(tableConfigs);

                // Process the extracted data into the desired format
                for (const quarterKey in extractedData) {
                    // Since each table only has one row, we can take the first item
                    if (extractedData[quarterKey].length > 0) {
                        result.newEmploymentGenerated[quarterKey] =
                            extractedData[quarterKey][0];
                    } else {
                        // Create an empty object if no data was found
                        result.newEmploymentGenerated[quarterKey] = {
                            noOfEmployees: '',
                            noOfMale: '',
                            noOfFemale: '',
                            noOfPersonWithDisability: '',
                        };
                    }
                }
            }

            return result;
        } catch (error) {
            console.error('Error extracting employment generated data:', error);
            // Return an empty result if there's an error
            return { newEmploymentGenerated: {} };
        }
    }

    /**
     * Extract all form data including volume and value production data
     *
     * @returns Combined data from all form sections
     */
    public extractAllFormData() {
        // Extract employment data
        const employmentData = this.extractEmploymentGeneratedData();

        // Extract volume and value production data using the specialized handler
        // const volumeValueData =
        //     this.volumeValueProductionEvent.extractVolumeValueData();

        // Combine all data
        return {
            ...employmentData,
            // ...volumeValueData,
        };
    }
}
