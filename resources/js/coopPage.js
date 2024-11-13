
import "./echo"
import Notification from './Notification';
import NotificationContainer from './NotificationContainer';
import "smartwizard/dist/css/smart_wizard_all.css";
import smartWizard from 'smartwizard';
window.smartWizard = smartWizard;


Echo.private(`coop-notifications.${USER_ID}`)
    .listen('.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', (e) => {
        try {
            console.log('Raw event:', e);
            const NotificationData = e;

            if (!NotificationData) {
                throw new Error('Notification data is undefined');
            }

            NotificationContainer(NotificationData);

        }
        catch (error) {
            console.error('Error parsing notification data:', error);
            console.log('Raw data:', e.data);
        }
    });

    Notification();

window.initilizeCoopPageJs = async () => {
    const functions = {
        Dashboard: () => {

            const progressPercentage = (percentage) => {
                const options = {
                    series: [percentage],
                    chart: {
                        height: 250,
                        width: 250,
                        type: 'radialBar',
                        toolbar: {
                            show: true
                        }
                    },
                    plotOptions: {
                        radialBar: {
                            startAngle: -135,
                            endAngle: 225,
                            hollow: {
                                margin: 0,
                                size: '70%',
                                background: '#fff',
                                image: undefined,
                                imageOffsetX: 0,
                                imageOffsetY: 0,
                                position: 'front',
                                dropShadow: {
                                    enabled: true,
                                    top: 3,
                                    left: 0,
                                    blur: 4,
                                    opacity: 0.24
                                }
                            },
                            track: {
                                background: '#fff',
                                strokeWidth: '50%',
                                margin: 0, // margin is in pixels
                                dropShadow: {
                                    enabled: true,
                                    top: -3,
                                    left: 0,
                                    blur: 4,
                                    opacity: 0.35
                                }
                            },

                            dataLabels: {
                                show: true,
                                name: {
                                    offsetY: -10,
                                    show: true,
                                    color: '#888',
                                    fontSize: '17px'
                                },
                                value: {
                                    formatter: function(val) {
                                        return parseInt(val);
                                    },
                                    color: '#111',
                                    fontSize: '36px',
                                    show: true,
                                }
                            }
                        }
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'dark',
                            type: 'horizontal',
                            shadeIntensity: 0.5,
                            gradientToColors: ['#ABE5A1'],
                            inverseColors: true,
                            opacityFrom: 1,
                            opacityTo: 1,
                            stops: [0, 100]
                        }
                    },
                    stroke: {
                        lineCap: 'round'
                    },
                    labels: ['Percent'],
                };

                const chart = new ApexCharts(document.querySelector("#ProgressPer"), options).render();
              ;
            }


            const formatToString = (value) => {
            return value.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            });
        };

        const getProgress = async () => {
            const paymentTextPer = $('#ProgressPerText')
            try {
                const response = await fetch(DASHBOARD_ROUTE.GET_COOPERATOR_PROGRESS, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json'
                });
                const data = await response.json();
                paymentTableProcess(data.paymentList);

                 const actual_amount = parseFloat(data.progress.actual_amount_to_be_refund) || 0;
                 const refunded_amount = parseFloat(data.progress.refunded_amount) || 0;
                 const percentage = Math.ceil((refunded_amount / actual_amount) * 100);

                 paymentTextPer.html(`<h5>${formatToString(refunded_amount)} / ${formatToString(actual_amount)}</h5>`);
                progressPercentage(percentage);


            } catch (error) {
                console.error(error)

            }
        }



        const paymentTableProcess = (data) => {
            const paymentTable = $('#PaymentTable').find('tbody');
            paymentTable.empty();
            $.each(data, function(key, value) {
                const statusClass = value.payment_status === "Paid" ? "bg-success" : "bg-danger";
                const row = `<tr>
                  <td class="text-center">${formatToString(value.amount)}</td>
                  <td class="text-center">${value.payment_method}</td>
                  <td class="text-center"><span class="badge rounded-pill ${statusClass}">${value.payment_status}</span></td>
                 </tr>`;
                paymentTable.append(row);
            });
        }

        getProgress();

        },

        Requirements: () => {
            function initializeFilePond() {
                const inputElement = document.querySelector('.filepond-receipt-upload');
                const receiptFilePondInit = FilePond.create(inputElement, {
                    acceptedFileTypes: ['image/*'],
                    imagePreviewHeight: 170,
                    imageCropAspectRatio: '1:1',
                    imageResizeTargetWidth: 200,
                    imageResizeTargetHeight: 200,
                    server: {
                        process: {
                            url: '/upload/Img',
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            onload: (response) => {
                                const data = JSON.parse(response);
                                if (data.temp_file_path && data.unique_id) {
                                    // Store unique_id in a hidden input field or as a data attribute
                                    document.querySelector('input[name="unique_id"]').value = data.unique_id;
                                    inputElement.setAttribute('data-unique-id', data.unique_id);
                                    if (data.temp_file_path) {
                                        inputElement.setAttribute('data-file-path', data.temp_file_path);
                                    }
                                }
                                return data.unique_id;
                            }
                        },
                        revert: (uniqueFileId, load, error) => {
                            const receiptPath = inputElement.getAttribute('data-file-path');
                            const unique_id = inputElement.getAttribute('data-unique-id');

                            console.log('Reverting file with path:', receiptPath, 'and unique ID:', unique_id);

                            fetch(`/delete/Img/{uniqueId}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content')
                                },
                                body: JSON.stringify({
                                    receiptfilePath: receiptPath
                                })
                            }).then(response => {
                                if (response.ok) {
                                    load();
                                } else {
                                    console.error('Failed to delete file:', response.statusText);
                                }
                            }).catch(() => {
                                error('Failed to delete file');
                            });
                        } // Revert is not needed for temporary files
                    }
                })

                const form = document.getElementById('uploadForm');
                const receiptName = document.getElementById('receiptName');
                window.submissionModal = new bootstrap.Modal(document.getElementById('receiptModal'));
                const successMessage = document.getElementById('successMessage');
                const submitBtn = document.getElementById('submitButton');

                submitButton.addEventListener('click', function(event) {
                    event.preventDefault();

                    const formData = new FormData(form);

                    fetch(REQUIREMENTS_ROUTE.STORE_RECEIPTS, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                successMessage.textContent = data.success;
                                successMessage.style.display = 'block';
                                successMessage.classList.add('alert', 'alert-success');

                                setTimeout(() => {
                                    receiptName.value = '';
                                    receiptFilePondInit.removeFile();
                                    successMessage.style.display = 'none';
                                    successMessage.classList.remove('alert', 'alert-success');
                                    submissionModal.hide();
                                    getReceipt();
                                }, 1000);
                            } else {
                                console.error(data.error);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            }

            function getReceipt() {
                fetch(REQUIREMENTS_ROUTE.GET_RECEIPTS, {
                        method: 'GET',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        let tableBody = $('#expenseReceipt_tbody');
                        tableBody.empty(); // Clear the existing rows

                        $.each(data, function(key, value) {
                            const receiptImage =
                                `<img src="data:image/png;base64,${value.receipt_image}" alt="${value.receipt_name}" style="max-width: 200px; max-height: 200px;" />`;
                            const row = `<tr>
                        <td>${value.receipt_name}</td>
                        <td>${value.receipt_description}</td>
                        <td class="img-Content">${receiptImage}</td>
                        <td>${value.created_at}</td>
                        <td>${value.remark}</td>
                        <td></td>
                    </tr>`;

                            tableBody.append(row);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            }


            initializeFilePond();
            getReceipt();
        },

        QuarterlyReport: () => {
            new smartWizard();
            $('#BuildingAsset, #Equipment, #WorkingCapital').on('input', function() {
                // Remove any non-digit characters
                let value = $(this).val().replace(/[^0-9]/g, '');

                // Add commas every three digits
                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                // Set the new value to the input field
                $(this).val(value);
            });

            $('#employment input').on('input', function() {
                // Remove any non-digit characters
                let value = $(this).val().replace(/[^0-9]/g, '');

                // Set the new value to the input field
                $(this).val(value);
            });

            $('.ExportData, .LocalData').on('input', 'tr td:nth-child(n+3):nth-child(-n+6) input', function() {
                // Remove any non-digit characters
                let value = $(this).val().replace(/[^0-9]/g, '');

                // Add commas every three digits
                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                // Set the new value to the input field
                $(this).val(value);
            });

            function parseValue(value){
                return parseFloat(value.replace(/,/g, '')) || 0;
            }

            //ADD The Function for add row and delete row for the Export and Local Products here

            const toggleDeleteRowButton = (container, elementSelector) => {
                const element = container.find(elementSelector);
                const deleteRowButton = container
                .find('.removeRowButton');
                element.length === 1
                  ? deleteRowButton.prop('disabled', true)
                  : deleteRowButton.prop('disabled', false);
              };

            const addProductBtn = $('.addNewProductRow');
            const deleteProductBtn = $('.removeRowButton');

            addProductBtn.on('click', function() {
                const container = $(this).closest('div.productLocal, div.productExport');

                const table = container.find('table');
                if (table.length) {
                    const lastRow = table.find('tbody tr:last-child');
                    const newRow = lastRow.clone();
                    newRow.find('input, textarea').val('');
                    table.find('tbody').append(newRow);
                    toggleDeleteRowButton(container, 'tbody tr');
                } else {
                    const tableRow = container.find('.table_row');
                    const newRow = tableRow.last().clone();
                    newRow.find('input, textarea').val('');
                    container.append(newRow);
                    toggleDeleteRowButton(container, '.table_row');
                }
            })

            deleteProductBtn.on('click', function() {
                const container = $(this).closest('div.productLocal, div.productExport');

                const table = container.find('table');
                if(table.length){
                    const lastRow = table.find('tbody tr:last-child');
                    lastRow.remove();
                    toggleDeleteRowButton(container, 'tbody tr');
                }else{
                    const tableRow = container.find('.table_row');
                    tableRow.last().remove();
                    toggleDeleteRowButton(container, '.table_row');
                }
            })


            $('.ExportData, .LocalData').on('input', 'tr td:nth-child(n+4):nth-child(-n+5) input', function() {
                let row = $(this).closest('tr');
                let grossSales = parseValue(row.find('.grossSales_val').val());
                let estimatedCostOfProduction = parseValue(row.find('.estimatedCostOfProduction_val').val());
                let netSales = grossSales - estimatedCostOfProduction;
                let formattedNetSales = netSales.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                console.log(grossSales, estimatedCostOfProduction, formattedNetSales);
                row.find('.netSales_val').val(formattedNetSales);
            });

            $('#smartwizard').smartWizard({
                selected: 0,
                theme: 'dots',
                transition: {
                    animation: 'slideHorizontal'
                },
                toolbar: {
                    showNextButton: true, // show/hide a Next button
                    showPreviousButton: true, // show/hide a Previous button
                    position: 'both buttom', // none/ top/ both bottom
                    extraHtml: `<button type="button" class="btn btn-success" onclick="showConfirm()">Submit</button>
                                  <button class="btn btn-secondary" onclick="onCancel()">Cancel</button>`
                },
            });
            $("#smartwizard").on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {

                if (stepIndex === 3 && stepPosition === 'last') {
                    console.log("Arriving at Last Step - Showing Buttons");
                    $('.btn-success, .btn-secondary').show();
                } else {
                    console.log("Not Arriving at Last Step - Hiding Buttons");
                    $('.btn-success, .btn-secondary').hide();
                }
            });
            $('#smartwizard').on('click', 'button', function() {
                // Your function goes here
                $('#smartwizard').smartWizard('fixHeight');
            });

            window.showConfirm = function() {
                event.preventDefault();
                window.confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                confirmationModal.show();
            }

            const confirmTrueInfo = $('input[type="checkbox"]#detail_confirm');
            const confirmAgreeInfo = $('input[type="checkbox"]#agree_terms');
            const confirmButton = document.getElementById('confirmButton');

            confirmTrueInfo.add(confirmAgreeInfo).change(function() {
                confirmButton.disabled = !(confirmTrueInfo.is(':checked') && confirmAgreeInfo.is(':checked'));
            });

            confirmButton.addEventListener('click', function() {
                submitQuarterlyForm();
            });

            $('.number_input_only').on('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            })


            function submitQuarterlyForm() {

                const formData = $('#quarterlyForm').serializeArray();
                const quarterId = $('#quarterlyForm').data('quarter-id');
                const quarterProject = $('#quarterlyForm').data('quarter-project');
                const quarterPeriod = $('#quarterlyForm').data('quarter-period');
                const quarterStatus = $('#quarterlyForm').data('quarter-status');

                let dataObject = {};
                $.each(formData, function(i, v) {
                    dataObject[v.name] = v.value;
                });

                const ExportTable_row = $('.ExportData .table_row');
                const LocalTable_row = $('.LocalData .table_row');
                const ExportTable_data = [];
                const LocalTable_data = [];


            ExportTable_row.each(function() {
                const row = $(this); // Wrap `this` with jQuery to use jQuery methods
                const exporttable_row = {
                    ProductName: row.find('.productName').val(),
                    PackingDetails: row.find('.packingDetails').val(),
                    volumeOfProduction: row.find('.productionVolume_val').val() + ' ' + row.find('.volumeUnit').val(),
                    grossSales: row.find('.grossSales_val').val(),
                    estimatedCostOfProduction: row.find('.estimatedCostOfProduction_val').val(),
                    netSales: row.find('.netSales_val').val()
                };
                exporttable_row.ProductName && exporttable_row.ProductName !== null
                ? ExportTable_data.push(exporttable_row)
                : null;
            });

            // const ExportwrappedData = {ExportProductInfo: ExportTable_data};
           dataObject.ExportProduct = ExportTable_data;


            LocalTable_row.each(function() {
                const row = $(this); // Wrap `this` with jQuery to use jQuery methods
                const localtable_row = {
                    ProductName: row.find('.productName').val(),
                    PackingDetails: row.find('.packingDetails').val(),
                    volumeOfProduction: row.find('.productionVolume_val').val() + ' ' + row.find('.volumeUnit').val(),
                    grossSales: row.find('.grossSales_val').val(),
                    estimatedCostOfProduction: row.find('.estimatedCostOfProduction_val').val(),
                    netSales: row.find('.netSales_val').val()
                };
                localtable_row.ProductName && localtable_row.ProductName.trim() !== null
                ? LocalTable_data.push(localtable_row)
                : null;
            });

            // const LocalwrappedData = {LocalProductInfo: localTable_data};
            dataObject.LocalProduct = LocalTable_data;


                // Send form data using AJAX
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-Quarter-Project': quarterProject,
                        'X-Quarter-Period': quarterPeriod,
                        'X-Quarter-Status': quarterStatus
                    },
                    type: 'PUT',
                    url: QUARTERLY_REPORT_ROUTE.STORE_REPORT.replace(':quarterId', quarterId),
                    data: JSON.stringify(dataObject), // Send the new data object
                    contentType: 'application/json', // Set content type to JSON
                    success: function(response) {
                        // Handle the response if needed
                        setTimeout(() => {
                                confirmationModal.hide();
                                const toastElement = document.getElementById('successToast');
                                const toast = new bootstrap.Toast(toastElement);
                                toast.show();
                            }, 500);
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle any errors
                    }
                });
            }

        }

    }
    return functions
}
