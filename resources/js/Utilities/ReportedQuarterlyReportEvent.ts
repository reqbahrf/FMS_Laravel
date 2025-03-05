import { customFormatNumericInput } from './input-utils';
import {
    AddNewRowHandler,
    RemoveRowHandler,
} from './add-and-remove-table-row-handler';
import {
    parseFormattedNumberToFloat,
    formatNumberToCurrency,
    showProcessToast,
    hideProcessToast,
    serializeFormData,
    showToastFeedback,
} from './utilFunctions';
import createConfirmationModal from './confirmation-modal';
import { TableDataExtractor } from './TableDataExtractor';
export default class ReportedQuarterlyReportEvent {
    private form: JQuery<HTMLFormElement>;
    private exportAndLocalTableBody: JQuery<HTMLElement>;
    private inputContainers: JQuery<HTMLElement>;
    private productAndSalesInputContainer: JQuery<HTMLElement>;
    private initialData: { [key: string]: any };
    constructor() {
        this.form = $('#ReportedQuarterlyData');
        this.inputContainers = this.form.find(
            '#AssetsInputs, #EmploymentInputs, #marketOutletInputs'
        );
        this.productAndSalesInputContainer = this.form.find(
            '#ProductionAndSalesInputs'
        );
        this.initialData = {};
        this.exportAndLocalTableBody = this.form.find(
            '.ExportData, .LocalData'
        );
    }

    public static ExportAndLocalMktTableConfig = {
        ExportProduct: {
            id: 'ExportOutletTable',
            selectors: {
                ProductName: '.productName',
                PackingDetails: '.packingDetails',
                volumeOfProduction: {
                    value: '.productionVolume_val',
                    unit: '.volumeUnit',
                },
                grossSales: '.grossSales_val',
                estimatedCostOfProduction: '.estimatedCostOfProduction_val',
                netSales: '.netSales_val',
            },
            requiredFields: ['ProductName'],
        },
        LocalProduct: {
            id: 'LocalOutletTable',
            selectors: {
                ProductName: '.productName',
                PackingDetails: '.packingDetails',
                volumeOfProduction: {
                    value: '.productionVolume_val',
                    unit: '.volumeUnit',
                },
                grossSales: '.grossSales_val',
                estimatedCostOfProduction: '.estimatedCostOfProduction_val',
                netSales: '.netSales_val',
            },
            requiredFields: ['ProductName'],
        },
    };

    public initInputEventFormatter(): void {
        customFormatNumericInput(
            this.form,
            '#BuildingAsset, #Equipment, #WorkingCapital'
        );

        customFormatNumericInput(
            '#directLaborCard, #indirectLaborCard',
            'input'
        );

        customFormatNumericInput(
            this.exportAndLocalTableBody,
            'tr td:nth-child(n+3):nth-child(-n+6) input'
        );

        AddNewRowHandler(
            '.addNewProductRow',
            'div.productLocal, div.productExport'
        );
        RemoveRowHandler(
            '.removeRowButton',
            'div.productLocal, div.productExport'
        );
    }
    public initStoreInitialValue(): void {
        this.inputContainers.each((index, element) => {
            const container = $(element);
            const containerId = container.attr('id'); // Store the id in a variable

            if (containerId !== undefined) {
                // Check if containerId is defined
                this.initialData[containerId] =
                    this._storeInitialValues(container);
            }
        });

        this.initialData['ProductionAndSalesInputs'] = TableDataExtractor(
            ReportedQuarterlyReportEvent.ExportAndLocalMktTableConfig
        );
    }

    private _storeInitialValues(container: JQuery<HTMLElement>): {
        [key: string]: any;
    } {
        const containerData: { [key: string]: any } = {};
        container.find('input, textarea').each(function (index, input) {
            const inputElement = input as HTMLInputElement;
            containerData[inputElement.name] = $(input).val();
        });
        return containerData;
    }

    public initEditMode(): void {
        const self = this;
        this.exportAndLocalTableBody.on(
            'input',
            'tr td:nth-child(n+4):nth-child(-n+5) input',
            function () {
                const row = $(this).closest('tr');
                const grossSales = parseFormattedNumberToFloat(
                    row.find('.grossSales_val').val() as string
                ) as number;
                const estimatedCostOfProduction = parseFormattedNumberToFloat(
                    row.find('.estimatedCostOfProduction_val').val() as string
                ) as number;
                const netSales = grossSales - estimatedCostOfProduction;
                const formattedNetSales = formatNumberToCurrency(netSales);
                row.find('.netSales_val').val(formattedNetSales);
            }
        );
        const Products = {
            exportProduct:
                this.productAndSalesInputContainer.find('.productExport'),
            localProduct:
                this.productAndSalesInputContainer.find('.productLocal'),
        };

        this.inputContainers.on('click', '.editButton', function () {
            // Get the specific card-body container where the button was clicked
            const cardBody = $(this).closest('div.card-body');

            // Toggle the readonly state for all input and textarea elements within the card-body
            cardBody
                .find('input, textarea')
                .prop('readonly', function (i, val) {
                    return !val; // Toggle the current readonly value (true/false)
                });

            // Enable or disable the Revert button based on the readonly state
            const isReadonly = cardBody
                .find('input, textarea')
                .prop('readonly'); // Check if inputs are readonly
            if (!isReadonly) {
                cardBody.find('.revertButton').prop('disabled', false); // Enable Revert if inputs are editable
            } else {
                cardBody.find('.revertButton').prop('disabled', true); // Disable Revert if inputs are readonly again
            }
        });

        this.inputContainers.on('click', '.revertButton', function () {
            console.log('revert');
            const cardBody = $(this).closest('div.card-body');
            const containerId = cardBody.attr('id');
            if (!containerId) {
                return;
            }

            // Revert inputs back to initial values within this container
            cardBody.find('input, textarea').each(function (index, input) {
                const inputElement = input as HTMLInputElement;
                $(inputElement).val(
                    self.initialData[containerId][inputElement.name]
                );
            });

            // Disable Revert button after reverting within this container
            cardBody.find('input, textarea').prop('readonly', true);
            cardBody.find('.revertButton').prop('disabled', true);
        });

        this.productAndSalesInputContainer.on(
            'click',
            '.editButton',
            function () {
                const cardBody = $(this).closest('div.card-body');
                cardBody
                    .find('input, textarea')
                    .prop('readonly', function (i, val) {
                        return !val;
                    });

                const isReadonly = cardBody
                    .find('input, textarea')
                    .prop('readonly');
                if (!isReadonly) {
                    cardBody.find('.revertButton').prop('disabled', false);
                    cardBody.find('.addNewProductRow').prop('disabled', false);
                } else {
                    cardBody.find('.revertButton').prop('disabled', true);
                    cardBody.find('.addNewProductRow').prop('disabled', true);
                }
            }
        );

        this.productAndSalesInputContainer.on(
            'click',
            '.revertButton',
            function () {
                const initialProductData =
                    self.initialData['ProductionAndSalesInputs'];

                // Revert export product table
                Products.exportProduct
                    .find('.ExportData .table_row')
                    .each(function (index, row) {
                        const currentRow = $(row);
                        if (initialProductData.ExportProduct[index]) {
                            currentRow
                                .find('.productName')
                                .val(
                                    initialProductData.ExportProduct[index]
                                        .productName
                                );
                            currentRow
                                .find('.packingDetails')
                                .val(
                                    initialProductData.ExportProduct[index]
                                        .packingDetails
                                );
                            currentRow
                                .find('.productionVolume_val')
                                .val(
                                    initialProductData.ExportProduct[index]
                                        .volumeOfProduction
                                );
                            currentRow
                                .find('.grossSales_val')
                                .val(
                                    initialProductData.ExportProduct[index]
                                        .grossSales
                                );
                            currentRow
                                .find('.estimatedCostOfProduction_val')
                                .val(
                                    initialProductData.ExportProduct[index]
                                        .productionCost
                                );
                            currentRow
                                .find('.netSales_val')
                                .val(
                                    initialProductData.ExportProduct[index]
                                        .netSales
                                );
                        } else {
                            currentRow.find('.productName').val('');
                            currentRow.find('.packingDetails').val('');
                            currentRow.find('.productionVolume_val').val('');
                            currentRow.find('.grossSales_val').val('');
                            currentRow
                                .find('.estimatedCostOfProduction_val')
                                .val('');
                            currentRow.find('.netSales_val').val('');
                        }
                    });

                // Revert local product table
                Products.localProduct
                    .find('.LocalData .table_row')
                    .each(function (index, row) {
                        const currentRow = $(row);
                        if (initialProductData.LocalProduct[index]) {
                            currentRow
                                .find('.productName')
                                .val(
                                    initialProductData.LocalProduct[index]
                                        .productName
                                );
                            currentRow
                                .find('.packingDetails')
                                .val(
                                    initialProductData.LocalProduct[index]
                                        .packingDetails
                                );
                            currentRow
                                .find('.productionVolume_val')
                                .val(
                                    initialProductData.LocalProduct[index]
                                        .volumeOfProduction
                                );
                            currentRow
                                .find('.grossSales_val')
                                .val(
                                    initialProductData.LocalProduct[index]
                                        .grossSales
                                );
                            currentRow
                                .find('.estimatedCostOfProduction_val')
                                .val(
                                    initialProductData.LocalProduct[index]
                                        .productionCost
                                );
                            currentRow
                                .find('.netSales_val')
                                .val(
                                    initialProductData.LocalProduct[index]
                                        .netSales
                                );
                        } else {
                            // Clear the inputs if no initial data for local product
                            console.log(
                                'No initial data for local row, clearing inputs:',
                                index
                            );
                            currentRow.find('.productName').val('');
                            currentRow.find('.packingDetails').val('');
                            currentRow.find('.productionVolume_val').val('');
                            currentRow.find('.grossSales_val').val('');
                            currentRow
                                .find('.estimatedCostOfProduction_val')
                                .val('');
                            currentRow.find('.netSales_val').val('');
                        }
                    });

                // Disable Revert button after reverting
                this.find('.addNewProductRow').prop('disabled', true);
                this.find('input, textarea').prop('readonly', true);
                this.find('.revertButton').prop('disabled', true);
            }
        );

        this.form.on('submit', async function (e) {
            e.preventDefault();
            const isConfirmed = await createConfirmationModal({
                title: 'Confirm Update',
                message:
                    'Are you sure you want to update this quarterly report?',
                confirmText: 'Update',
                cancelText: 'Cancel',
                confirmButtonClass: 'btn-primary',
            });

            if (!isConfirmed) {
                return;
            }
            showProcessToast('Updating Quarterly Report...');
            const form = $(this);
            const url = form.attr('action');
            form.find('button[type="submit"]').prop('disabled', true);
            form.find('input, textarea').prop('readonly', true);
            const quarterId = form.data('quarter-id');
            const quarterProject = form.data('quarter-project');
            const quarterPeriod = form.data('quarter-period');
            const quarterStatus = form.data('quarter-status');

            const updatedFormData = form.serializeArray();
            let formDataObject = serializeFormData(updatedFormData);
            formDataObject = {
                ...formDataObject,
                ...TableDataExtractor(
                    ReportedQuarterlyReportEvent.ExportAndLocalMktTableConfig
                ),
            };

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                    'X-Quarter-Project': quarterProject,
                    'X-Quarter-Period': quarterPeriod,
                    'X-Quarter-Status': quarterStatus,
                },
                type: 'PUT',
                url: url,
                data: JSON.stringify(formDataObject),
                contentType: 'application/json',
                success: function (response) {
                    hideProcessToast();
                    showToastFeedback('text-bg-success', response.message);
                },
                error: function (error) {
                    hideProcessToast();
                    showToastFeedback(
                        'text-bg-danger',
                        error?.responseJSON?.message ||
                            'Error in Updating Quarterly Report'
                    );
                    form.find('button[type="submit"]').prop('disabled', false);
                    form.find('input, textarea').prop('readonly', false);
                },
            });
        });
    }
}
