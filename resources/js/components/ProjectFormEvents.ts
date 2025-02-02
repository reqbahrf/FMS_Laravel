
import {
    formatNumberToCurrency,
    customFormatNumericInput,
    parseFormattedNumberToFloat,
} from '../Utilities/utilFunctions';

enum FormType {
    PIS = 'PIS',
    PDS = 'PDS',
    SR = 'SR',
}

export default class FormEvents {
    private formType: FormType;
    constructor(formType: FormType) {
        this.formType = formType;
        this.initializeFormEvents();
    }

    initializeFormEvents() {
        const Form_Events = {
            PIS: () => {
                this.PISFormEvents();
            },
            PDS: () => {
                this.PDSFormEvents();
            },
            SR: () => {
                this.SRFormEvents();
            },
        }[this.formType];

        if (Form_Events) {
            Form_Events();
        } else {
            console.log(`Form Type ${this.formType} not found`);
        }
    }

    PISFormEvents() {
        function caculateTotalAssests() {
            const landAssets = parseFormattedNumberToFloat(
                $('#land_val').val() as string
            );
            const buildingAssets = parseFormattedNumberToFloat(
                $('#building_val').val() as string
            );
            const equipmentAssets = parseFormattedNumberToFloat(
                $('#equipment_val').val() as string
            );
            const workingCapital = parseFormattedNumberToFloat(
                $('#workingCapital_val').val() as string
            );
            const totalAssests =
                landAssets + buildingAssets + equipmentAssets + workingCapital;
            $('#totalAssests').val(formatNumberToCurrency(totalAssests));
        }

        $('#land_val, #building_val, #equipment_val, #workingCapital_val').on(
            'input',
            function () {
                const thisInputId = $(this).attr('id');
                console.log(thisInputId);
                customFormatNumericInput(`#${thisInputId}`);
                caculateTotalAssests();
            }
        );

        const calculateTotalEmploymentGenerated = () => {
            let manMonthTotal = 0;

            $('#totalEmploymentContainer tr').each(function () {
                const thisTableRow = $(this);

                const male = parseFormattedNumberToFloat(
                    thisTableRow.find('.maleInput').val() as string
                );
                const female = parseFormattedNumberToFloat(
                    thisTableRow.find('.femaleInput').val() as string
                );
                const subtotal = male + female;
                thisTableRow.find('.thisRowSubtotal').val(
                    subtotal.toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                    })
                );

                manMonthTotal += subtotal;
            });
            $('#TotalmanMonths').val(formatNumberToCurrency(manMonthTotal));
        };

        $('#totalEmploymentContainer').on(
            'input',
            'td input.maleInput, td input.femaleInput',
            function () {
                console.log('Input Changed');
                const thisInputId = $(this).attr('id');
                console.log(thisInputId);
                customFormatNumericInput(`#${thisInputId}`);
                calculateTotalEmploymentGenerated();
            }
        );

        const calculateTotalGrossSales = () => {
            console.log('Input Changed');

            const localProduct = parseFormattedNumberToFloat(
                $('#localProduct_Val').val() as string
            );
            const exportProduct = parseFormattedNumberToFloat(
                $('#exportProduct_Val').val() as string
            );
            const totalGrossSales = localProduct + exportProduct;
            $('#totalGrossSales').val(formatNumberToCurrency(totalGrossSales));

            console.log(totalGrossSales);
        };

        $('#localProduct_Val, #exportProduct_Val').on('input', function () {
            const thisInputId = $(this).attr('id');
            customFormatNumericInput(`#${thisInputId}`);
            calculateTotalGrossSales();
        });
    }

    PDSFormEvents() {
        const calculateTotalEmployment = () => {
            let totalNumPersonel = 0;
            let totalManMonth = 0;
            $('#totalEmployment tr').each(function () {
                const totalMalePersonel = parseFormattedNumberToFloat(
                    $(this).find('.maleInput').val() as string
                );
                const totalFemalePersonel = parseFormattedNumberToFloat(
                    $(this).find('.femaleInput').val() as string
                );
                const workDays = parseFormattedNumberToFloat(
                    $(this).find('.workdayInput').val() as string
                );
                const thisRowManMonth =
                    (totalMalePersonel + totalFemalePersonel) * (workDays / 20);
                $(this)
                    .find('.totalManMonth')
                    .val(formatNumberToCurrency(thisRowManMonth));

                totalNumPersonel += totalMalePersonel + totalFemalePersonel;

                totalManMonth += parseFormattedNumberToFloat(
                    $(this).find('.totalManMonth').val() as string
                );
            });
            $('#TotalManMonth').val(formatNumberToCurrency(totalManMonth));
            $('#TotalEmployment').val(formatNumberToCurrency(totalNumPersonel));
        };

        $('#totalEmployment').on(
            'input',
            'td input.maleInput, td input.femaleInput, td input.workdayInput',
            function () {
                const thisEmployeeRow = $(this);
                customFormatNumericInput(`#${thisEmployeeRow.attr('id')}`);

                const employeeRow = thisEmployeeRow.closest('tr');
                const maleVal = parseFormattedNumberToFloat(
                    employeeRow.find('.maleInput').val() as string
                );
                const femaleVal = parseFormattedNumberToFloat(
                    employeeRow.find('.femaleInput').val() as string
                );
                const workDays = parseFormattedNumberToFloat(
                    employeeRow.find('.workdayInput').val() as string
                );

                const totalManMonth = (workDays / 20) * (maleVal + femaleVal);
                employeeRow.find('.totalManMonth').val(totalManMonth);

                calculateTotalEmployment();
            }
        );

        const calculateTotals = () => {
            let totalGrossSales = 0;
            let totalProductionCost = 0;
            let totalNetSales = 0;

            $('#localProducts tr, #exportProducts tr').each(function () {
                const tableRow = $(this);
                let grossSales = parseFormattedNumberToFloat(
                    tableRow.find('.grossSales_val').val() as string
                );
                let productionCost = parseFormattedNumberToFloat(
                    tableRow.find('.productionCost_val').val() as string
                );

                let netSales = grossSales - productionCost;

                let FormattedNetSales = formatNumberToCurrency(netSales);

                tableRow.find('.netSales_val').val(FormattedNetSales);

                totalGrossSales += grossSales;
                totalProductionCost += productionCost;
                totalNetSales += netSales;
            });

            $('#totalGrossSales').val(
                `₱ ${formatNumberToCurrency(totalGrossSales)}`
            );
            $('#totalProductionCost').val(
                `₱ ${formatNumberToCurrency(totalProductionCost)}`
            );
            $('#totalNetSales').val(
                `₱ ${formatNumberToCurrency(totalNetSales)}`
            );

            $('.CurrentgrossSales_val').val(
                formatNumberToCurrency(totalGrossSales)
            );
        };

        $('#localProducts, #exportProducts').on(
            'input',
            'td input.grossSales_val, td input.productionCost_val',
            function () {
                const thisInput = $(this);
                customFormatNumericInput(`.${thisInput.attr('id')}`);

                const $productRow = thisInput.closest('tr');
                const grossSales = parseFormattedNumberToFloat(
                    $productRow.find('.grossSales_val').val() as string
                );
                const estimatedProductionCost = parseFormattedNumberToFloat(
                    $productRow.find('.productionCost_val').val() as string
                );
                const netSales = grossSales - estimatedProductionCost;

                $productRow
                    .find('.netSales_val')
                    .val(formatNumberToCurrency(netSales));

                calculateTotals();
            }
        );

        const calculateToBeAccomplishedProductivity = () => {
            const increaseInProductivityRow = $(
                '#ToBeAccomplished .increaseInProductivity'
            );

            const CurrentAndPreviousgrossSales = $(
                '#ToBeAccomplished td .CurrentgrossSales_val, td .PreviousgrossSales_val, td .TotalgrossSales_val'
            ).closest('tr');

            const CurrentgrossSales = parseFormattedNumberToFloat(
                CurrentAndPreviousgrossSales.find(
                    '.CurrentgrossSales_val'
                ).val() as string
            );
            const PreviousgrossSales = parseFormattedNumberToFloat(
                CurrentAndPreviousgrossSales.find(
                    '.PreviousgrossSales_val'
                ).val() as string
            );

            increaseInProductivityRow
                .find('.CurrentgrossSales_val_cal')
                .text(formatNumberToCurrency(CurrentgrossSales));

            increaseInProductivityRow
                .find('.PreviousgrossSales_val_cal')
                .text(formatNumberToCurrency(PreviousgrossSales));

            const TotalgrossSales = CurrentgrossSales - PreviousgrossSales;
            CurrentAndPreviousgrossSales.find('.TotalgrossSales_val').val(
                formatNumberToCurrency(TotalgrossSales)
            );

            const increaseInProductivityByPercent =
                ((CurrentgrossSales - PreviousgrossSales) /
                    PreviousgrossSales) *
                100;
            increaseInProductivityRow
                .find('.totalgrossSales_percent')
                .val(`${increaseInProductivityByPercent.toFixed(2)}%`);
        };

        $('#ToBeAccomplished').on(
            'input',
            'td .CurrentgrossSales_val, td .PreviousgrossSales_val',
            function () {
                const thisInputClass = $(this).attr('class');
                customFormatNumericInput(`.${thisInputClass}`);
                calculateToBeAccomplishedProductivity();
            }
        );

        const calculateToBeAccomplishedEmployment = () => {
            const increaseInEmploymentRow = $(
                '#ToBeAccomplished .increaseInEmployment'
            );

            const CurrentAndPreviousEmployment = $(
                '#ToBeAccomplished td .CurrentEmployment_val, td .PreviousEmployment_val, td .TotalEmployment_val'
            ).closest('tr');

            const CurrentEmployment = parseInt(
                CurrentAndPreviousEmployment.find(
                    '.CurrentEmployment_val'
                ).val() as string
            );

            const PreviousEmployment = parseInt(
                CurrentAndPreviousEmployment.find(
                    '.PreviousEmployment_val'
                ).val() as string
            );

            increaseInEmploymentRow
                .find('.CurrentEmployment_val_cal')
                .text(CurrentEmployment);
            increaseInEmploymentRow
                .find('.PreviousEmployment_val_cal')
                .text(PreviousEmployment);

            const TotalEmployment = CurrentEmployment - PreviousEmployment;
            CurrentAndPreviousEmployment.find('.TotalEmployment_val').val(
                TotalEmployment
            );

            const increaseInEmploymentByPercent =
                ((CurrentEmployment - PreviousEmployment) /
                    PreviousEmployment) *
                100;
            increaseInEmploymentRow
                .find('.totalEmployment_percent')
                .val(`${increaseInEmploymentByPercent.toFixed(2)}%`);
        };

        $('#ToBeAccomplished').on(
            'input',
            'td .CurrentEmployment_val , td .PreviousEmployment_val',
            function () {
                const thisInputClass = $(this).attr('class');
                customFormatNumericInput(`.${thisInputClass}`);
                calculateToBeAccomplishedEmployment();
            }
        );

        calculateTotalEmployment();
        calculateTotals();
        calculateToBeAccomplishedProductivity();
        calculateToBeAccomplishedEmployment();
    }

    SRFormEvents() {
        const toggleDeleteRowButton = (container : JQuery, elementSelector : string) => {
            const element = container.find(elementSelector);
            const deleteRowButton = container
                .children('.addAndRemoveButton_Container')
                .find('.removeRowButton');
            element.length === 1
                ? deleteRowButton.prop('disabled', true)
                : deleteRowButton.prop('disabled', false);
        };
        // Add event listener to the add row button
        $('.addNewRowButton').on('click', function () {
            const container = $(this).closest('.card-body');

            const table = container.find('table');
            if (table.length) {
                const lastRow = table.find('tbody tr:last-child');
                const newRow = lastRow.clone();
                newRow.find('input, textarea').val('');
                table.find('tbody').append(newRow);
                toggleDeleteRowButton(container, 'tbody tr');
            } else {
                const divContainer = container.find('.input_list');
                const newDiv = divContainer.last().clone();
                newDiv.find('input, textarea').val('');
                container.append(newDiv);
                toggleDeleteRowButton(container, '.input_list');
            }
        });

        // Add event listener to the delete row button
        $('.removeRowButton').on('click', function () {
            const container = $(this).closest('.card-body');

            const table = container.find('table');
            if (table.length) {
                const lastRow = table.find('tbody tr:last-child');
                lastRow.remove();
                toggleDeleteRowButton(container, 'tbody tr');
            } else {
                const divContainer = container.find('.input_list');
                divContainer.last().remove();
                toggleDeleteRowButton(container, '.input_list');
            }
        });

        $('#StatusReportForm .card-body').each(function () {
            const container = $(this);

            const table = container.find('table');
            if (table.length) {
                toggleDeleteRowButton(container, 'tbody tr');
            } else {
                toggleDeleteRowButton(container, '.input_list');
            }
        });

        $('.number_input_only').on('input', function (this: HTMLInputElement) {
            const inputClass = $(this).attr('class');
            customFormatNumericInput(`.${inputClass}`);
        });

        const CurrencyInputs = $(
            '#StatusReportForm table td input.approved_cost, #StatusReportForm table td input.actual_cost, #StatusReportForm table td input.non_equipment_approved_cost, #StatusReportForm table td input.non_equipment_actual_cost, #StatusReportForm input.total_approved_project_cost, #StatusReportForm input.amount_utilized, #StatusReportForm input.total_amount_to_be_refunded, #StatusReportForm input.total_amount_already_due, #StatusReportForm input.total_amount_refunded, #StatusReportForm input.unsetted_refund, #StatusReportForm table td input.sales_gross_sales'
        );

        CurrencyInputs.on('input', function (this: HTMLInputElement) {
            const inputClass = $(this).attr('class');
            customFormatNumericInput(`.${inputClass}`);
        });

        const $openButton = $('#open-floating-window');
        const $content = $('#floating-content');
        const $input = $('#projectLedgerLink') as JQuery<HTMLInputElement>;
        const $window = $('#floating-window');
        const $header = $('#floating-header');
        const $closeButton = $('#close-button');

        $openButton.on('click', async function () {
            const module = await import('../Utilities/FloatingWindow');
            if (module.InitializeFloatingWindow) {
                module.InitializeFloatingWindow({
                    $content,
                    $input,
                    $window,
                    $header,
                    $closeButton,
                });
            }

            const url = $input?.val()?.trim();
            if (!url) {
                alert('Please enter a valid URL!');
                return;
            }
            $content.html('<p>Loading...</p>');
            $content.html(`<iframe src="${url}"></iframe>`);
            $window.show();
        });
    }
}
