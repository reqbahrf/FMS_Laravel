import SignaturePad from 'signature_pad';
import {
    formatNumberToCurrency,
    customFormatNumericInput,
    parseFormattedNumberToFloat,
} from '../Utilities/utilFunctions';

export class FormEvents {
    constructor(formType) {
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
                $('#land_val').val()
            );
            const buildingAssets = parseFormattedNumberToFloat(
                $('#building_val').val()
            );
            const equipmentAssets = parseFormattedNumberToFloat(
                $('#equipment_val').val()
            );
            const workingCapital = parseFormattedNumberToFloat(
                $('#workingCapital_val').val()
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
                    thisTableRow.find('.maleInput').val()
                );
                const female = parseFormattedNumberToFloat(
                    thisTableRow.find('.femaleInput').val()
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
                $('#localProduct_Val').val()
            );
            const exportProduct = parseFormattedNumberToFloat(
                $('#exportProduct_Val').val()
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

        const EsignnatureContainer = $('#esignature-section');

        const initializeBtns = () => {
            const addRowBtn = `<button type="button" class="btn btn-success btn-sm me-2 add-row-btn">
            <i class="ri-add-fill"></i>
            </button>`;
            const deleteRowBtn = `<button type="button" class="btn btn-danger btn-sm me-2 delete-row-btn">
            <i class="ri-subtract-fill"></i>
            </button>`;
            const btnContainer = document.createElement('div');
            btnContainer.classList.add('d-flex', 'justify-content-end', 'mb-2', 'addAndRemoveButton_Container');
            btnContainer.innerHTML = addRowBtn + deleteRowBtn;
            EsignnatureContainer.find('.card-body').prepend(btnContainer);
        }

        initializeBtns();

        const initializeSignaturePad = (canvas) => {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            const ctx = canvas.getContext('2d');
            ctx.scale(ratio, ratio);
            
            return new SignaturePad(canvas, {
                minWidth: 2,
                maxWidth: 5,
            });
        };

        const toggleDeleteButton = () => {
            const rows = EsignnatureContainer.find('.esignature-row');
            const deleteBtn = EsignnatureContainer.find('.delete-row-btn');
            deleteBtn.prop('disabled', rows.length <= 1);
        };

        // Initialize first signature pad
        const firstCanvas = EsignnatureContainer.find('.esignature-canvas')[0];
        let signaturePads = [initializeSignaturePad(firstCanvas)];

        // Call initially to set correct state
        toggleDeleteButton();

        EsignnatureContainer.on('click', '.add-row-btn', function () {
            console.log('Adding new signature row');
            const container = $(this).closest('.card-body');
            const originalRow = container.find('.esignature-row').first();
            const newRow = originalRow.clone();
        
            // Clear all input values in the new row
            newRow.find('input').val('');
            
            // Remove the old canvas and create a fresh one
            const oldCanvas = newRow.find('.esignature-canvas');
            const newCanvas = $('<canvas>')
                .addClass('border rounded w-100 esignature-canvas')
                .attr('width', '300')
                .attr('height', '180');
            oldCanvas.replaceWith(newCanvas);
            
            // Append the new row after the last existing row
            container.find('.esignature-row:last').after(newRow);
            
            // Initialize the new signature pad
            const newPad = initializeSignaturePad(newCanvas[0]);
            signaturePads.push(newPad);
            
            toggleDeleteButton();
        });

        EsignnatureContainer.on('click', '.delete-row-btn', function () {
            const container = $(this).closest('.card-body');
            const rows = container.find('.esignature-row');
            
            if (rows.length > 1) {
                signaturePads.pop(); // Remove the last signature pad from our array
                rows.last().remove();
                toggleDeleteButton();
            }
        });

        // Handle clear signature - use event delegation for dynamically added elements
        EsignnatureContainer.on('click', '.clear-signature', function() {
            const row = $(this).closest('.esignature-row');
            const canvas = row.find('.esignature-canvas')[0];
            const padIndex = EsignnatureContainer.find('.esignature-row').index(row);
            if (signaturePads[padIndex]) {
                signaturePads[padIndex].clear();
            }
        });

        // Handle file upload preview - use event delegation
        EsignnatureContainer.on('change', '.esignature-image', function() {
            const file = this.files[0];
            const row = $(this).closest('.esignature-row');
            const padIndex = EsignnatureContainer.find('.esignature-row').index(row);
            
            if (file && signaturePads[padIndex]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = new Image();
                    img.onload = function() {
                        const canvas = row.find('.esignature-canvas')[0];
                        const ctx = canvas.getContext('2d');
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle signature save - use event delegation
        EsignnatureContainer.on('click', '.add-esignature', function() {
            const row = $(this).closest('.esignature-row');
            const padIndex = EsignnatureContainer.find('.esignature-row').index(row);
            
            if (signaturePads[padIndex] && !signaturePads[padIndex].isEmpty()) {
                const signatureData = signaturePads[padIndex].toDataURL();
                const name = row.find('.esignature-name').val();
                const topText = row.find('.esignature-top-text').val();
                const bottomText = row.find('.esignature-bottom-text').val();

                console.log('Signature saved:', {
                    name,
                    topText,
                    bottomText,
                    signatureData
                });
            } else {
                alert('Please provide a signature first.');
            }
        });

        // Handle window resize
        $(window).on('resize', function() {
            EsignnatureContainer.find('.esignature-canvas').each(function(index) {
                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                this.width = this.offsetWidth * ratio;
                this.height = this.offsetHeight * ratio;
                const ctx = this.getContext('2d');
                ctx.scale(ratio, ratio);
                
                // Reinitialize signature pad
                signaturePads[index] = initializeSignaturePad(this);
            });
        });
    }

    PDSFormEvents() {
        const calculateTotalEmployment = () => {
            let totalNumPersonel = 0;
            let totalManMonth = 0;
            $('#totalEmployment tr').each(function () {
                const totalMalePersonel = parseFormattedNumberToFloat(
                    $(this).find('.maleInput').val()
                );
                const totalFemalePersonel = parseFormattedNumberToFloat(
                    $(this).find('.femaleInput').val()
                );
                const workDays = parseFormattedNumberToFloat(
                    $(this).find('.workdayInput').val()
                );
                const thisRowManMonth =
                    (totalMalePersonel + totalFemalePersonel) * (workDays / 20);
                $(this)
                    .find('.totalManMonth')
                    .val(formatNumberToCurrency(thisRowManMonth));

                totalNumPersonel += totalMalePersonel + totalFemalePersonel;

                totalManMonth += parseFormattedNumberToFloat(
                    $(this).find('.totalManMonth').val()
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
                    employeeRow.find('.maleInput').val()
                );
                const femaleVal = parseFormattedNumberToFloat(
                    employeeRow.find('.femaleInput').val()
                );
                const workDays = parseFormattedNumberToFloat(
                    employeeRow.find('.workdayInput').val()
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
                    tableRow.find('.grossSales_val').val()
                );
                let productionCost = parseFormattedNumberToFloat(
                    tableRow.find('.productionCost_val').val()
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
                    $productRow.find('.grossSales_val').val()
                );
                const estimatedProductionCost = parseFormattedNumberToFloat(
                    $productRow.find('.productionCost_val').val()
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
                ).val()
            );
            const PreviousgrossSales = parseFormattedNumberToFloat(
                CurrentAndPreviousgrossSales.find(
                    '.PreviousgrossSales_val'
                ).val()
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
                ).val()
            );

            const PreviousEmployment = parseInt(
                CurrentAndPreviousEmployment.find(
                    '.PreviousEmployment_val'
                ).val()
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
        const toggleDeleteRowButton = (container, elementSelector) => {
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

        $('.number_input_only').on('input', function () {
            this.value = this.value.replace(/[^0-9.]/g, '');
        });

        const CurrencyInputs = $(
            '#StatusReportForm table td input.approved_cost, #StatusReportForm table td input.actual_cost, #StatusReportForm table td input.non_equipment_approved_cost, #StatusReportForm table td input.non_equipment_actual_cost, #StatusReportForm input.total_approved_project_cost, #StatusReportForm input.amount_utilized, #StatusReportForm input.total_amount_to_be_refunded, #StatusReportForm input.total_amount_already_due, #StatusReportForm input.total_amount_refunded, #StatusReportForm input.unsetted_refund, #StatusReportForm table td input.sales_gross_sales'
        );

        CurrencyInputs.on('input', function () {
            inputsToCurrencyFormatter($(this));
        });

        const $openButton = $('#open-floating-window');
        const $content = $('#floating-content');
        const $input = $('#projectLedgerLink');
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

            const url = $input.val().trim();
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
