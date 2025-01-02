import './echo';
import {
    showToastFeedback,
    dateFormatter,
    formatToString,
    formatToNumber,
    parseValueToFloat,
    createConfirmationModal,
    showProcessToast,
    hideProcessToast,
    closeModal,
} from './Utilities/utilFunctions';
import {
    FormDraftHandler  
} from './Utilities/FormDraftHandler';
import QUARTERLY_REPORTING_FORM_CONFIG from './Form_Config/QUARTERLY_REPORTING_CONFIG';
import { 
    AddNewRowHandler, 
    RemoveRowHandler 
} from './Utilities/AddAndRemoveTableRowHandler';
import 'smartwizard/dist/css/smart_wizard_all.css';
import SmartWizard from 'smartwizard';
import { TableDataExtractor } from './Utilities/TableDataExtractor';
import NotificationManager from './Utilities/NotificationManager';
const USER_ROLE = 'coop';
const ExportAndLocalMktTableConfig = {
    ExportProduct: {
        id: 'ExportOutletTable',
        selectors: {
            ProductName: '.productName',
            PackingDetails: '.packingDetails',
            volumeOfProduction: {
                value: '.productionVolume_val',
                unit: '.volumeUnit'
            },
            grossSales: '.grossSales_val',
            estimatedCostOfProduction: '.estimatedCostOfProduction_val',
            netSales: '.netSales_val',
        },
        requiredFields: ['ProductName']
    },
    LocalProduct: {
        id: 'LocalOutletTable',
        selectors: {
            ProductName: '.productName',
            PackingDetails: '.packingDetails',
            volumeOfProduction: {
                value: '.productionVolume_val',
                unit: '.volumeUnit'
            },
            grossSales: '.grossSales_val',
            estimatedCostOfProduction: '.estimatedCostOfProduction_val',
            netSales: '.netSales_val',
        },
        requiredFields: ['ProductName']
    }
};
//The NOTIFICATION_ROUTE and USER_ID constants are defined in the Blade view @ CooperatorApprovedPage.blade.php
const notificationManager = new NotificationManager(NOTIFICATION_ROUTE, USER_ID, USER_ROLE);
notificationManager.fetchNotifications();
notificationManager.setupEventListeners();

$(window).on('beforeunload', function () {
    return 'Are you sure you want to leave?';
});
$(function () {
    const lastUrl = sessionStorage.getItem('CoopLastUrl');
    const lastActive = sessionStorage.getItem('CoopLastActive');
    if (lastUrl && lastActive) {
        loadPage(lastUrl, lastActive);
    } else {
        loadPage(NAV_ROUTES.DASHBOARD, 'InformationTab');
    }
});

const setActiveLink = (activeLink) => {
    $('.nav-item a').removeClass('active');
    const defaultLink = 'dashboardLink';
    const linkToActivate = $('#' + (activeLink || defaultLink));
    linkToActivate.addClass('active');
};

window.loadPage = async (url, activeLink) => {
    try {
        $('.spinner').removeClass('d-none');
        $('#main-content').hide();
        const cachedPage = sessionStorage.getItem(url);
        if (cachedPage) {
            // If cached, use the cached response
            handleAjaxSuccess(cachedPage, activeLink, url);
        } else {
            // If not cached, make the AJAX request
            const response = await $.ajax({
                url: url,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
            });
            //sessionStorage.setItem(url, response);
            await handleAjaxSuccess(response, activeLink, url);
        }
    } catch (error) {
        console.log('Error: ', error);
    } finally {
        $('.spinner').addClass('d-none');
        $('#main-content').show();
    }
};

const handleAjaxSuccess = async (response, activeLink, url) => {
    try {
        $('#main-content').html(response);
        setActiveLink(activeLink);
        history.pushState(null, '', url);

        const parsedUrl = new URL(url);
        const urlParts = parsedUrl.pathname.split('/');
        const reportSubmitted = urlParts[urlParts.length - 1] === 'true';
        const quarterlyReportUrlPath = `${parsedUrl.pathname.split('/').slice(0, 3).join('/')}`;
        const functions = await initilizeCoopPageJs();

        const urlMapFunction = {
            [NAV_ROUTES.DASHBOARD]: functions.Dashboard,
            [NAV_ROUTES.REQUIREMENTS]: functions.Requirements,
            [NAV_ROUTES.QUARTERLY_REPORT]: reportSubmitted
                ? functions.ReportedQuarterlyReport
                : functions.QuarterlyReport,
        };

        if (quarterlyReportUrlPath === NAV_ROUTES.QUARTERLY_REPORT) {
            await urlMapFunction[NAV_ROUTES.QUARTERLY_REPORT]();
        } else if (urlMapFunction[url]) {
            await urlMapFunction[url]();
        }

        sessionStorage.setItem('CoopLastUrl', url);
        sessionStorage.setItem('CoopLastActive', activeLink);
    } catch (error) {
        console.log('Error: ', error);
    } finally {
        //    $('.spinner').addClass('d-none');
        //    $('#main-content').show();
    }
};

const getQuarterlyReportLinks = async () => {
    try {
        const response = await $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type: 'GET',
            url: GET_AVAILABLE_QUARTERLY_REPORT_URL,
        });

        const QuarterlyReportContainer = $(
            '#quarterlyReportContainerLargeScreen, #quarterlyReportContainerMobileScreen'
        );
        QuarterlyReportContainer.html(
            response ? response.html : '<li>No quarterly report</li>'
        );
    } catch (error) {}
};

getQuarterlyReportLinks();

$(function () {
    $('.sideNavButtonSmallScreen').on('click', function () {
        new bootstrap.Offcanvas($('#MobileNavOffcanvas')).show();
    });

    $('.sideNavButtonLargeScreen').on('click', function () {
        $('.sidenav').toggleClass('expanded minimized');
        $('#toggle-left-margin').toggleClass('navExpanded navMinimized');
        $('.logoTitleLScreen').toggle();
        //side bar minimize
        $('.sidenav a span').each(function () {
            $(this).toggleClass('d-none');
        });

        $('.sidenav a').each(function () {
            $(this).toggleClass('justify-content-center');
        });
        //size bar minimize rotation
        $('#hover-link').toggleClass('rotate-icon');
    });

    //  Sidebar dropdown

    $('.querterlyReportTab').on('click', function () {
        const activeNav = $(this).closest('li');
        const sideBarTasks = activeNav
            .find('.sidebarTasks')
            .toggleClass('d-none');
        activeNav
            .find('.ri-arrow-right-s-line, .ri-arrow-down-s-line')
            .toggleClass('d-block d-none');
    });
});

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
                            show: true,
                        },
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
                                    opacity: 0.24,
                                },
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
                                    opacity: 0.35,
                                },
                            },

                            dataLabels: {
                                show: true,
                                name: {
                                    offsetY: -10,
                                    show: true,
                                    color: '#888',
                                    fontSize: '17px',
                                },
                                value: {
                                    formatter: function (val) {
                                        return parseInt(val);
                                    },
                                    color: '#111',
                                    fontSize: '36px',
                                    show: true,
                                },
                            },
                        },
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
                            stops: [0, 100],
                        },
                    },
                    stroke: {
                        lineCap: 'round',
                    },
                    labels: ['Percent'],
                };

                const chart = new ApexCharts(
                    document.querySelector('#ProgressPer'),
                    options
                ).render();
            };

            const getProgress = async () => {
                const paymentTextPer = $('#ProgressPerText');
                try {
                    const response = await fetch(
                        DASHBOARD_ROUTE.GET_COOPERATOR_PROGRESS,
                        {
                            method: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $(
                                    'meta[name="csrf-token"]'
                                ).attr('content'),
                            },
                            dataType: 'json',
                        }
                    );
                    const data = await response.json();
                    paymentTableProcess(data.paymentList || null);

                    const actual_amount =
                        parseFloat(data.progress?.actual_amount_to_be_refund) ||
                        0;
                    const refunded_amount =
                        parseFloat(data.progress?.refunded_amount) || 0;
                    const percentage =
                        actual_amount > 0
                            ? Math.ceil((refunded_amount / actual_amount) * 100)
                            : 0;

                    paymentTextPer.html(
                        `<h5>${formatToString(refunded_amount)} / ${formatToString(actual_amount)}</h5>`
                    );
                    progressPercentage(percentage);
                } catch (error) {
                    console.error(error);
                }
            };

            const paymentTableProcess = (data) => {
                const paymentTable = $('#PaymentTable').find('tbody');
                paymentTable.empty();
                if (!data) {
                    const row = `<tr>
                  <td colspan="3" class="text-center">No payment yet</td>
                 </tr>`;
                    paymentTable.append(row);
                } else {
                    $.each(data, function (key, value) {
                        const statusClass =
                            value.payment_status === 'Paid'
                                ? 'bg-success'
                                : 'bg-danger';
                        const row = `<tr>
                      <td class="text-center">${formatToString(value.amount)}</td>
                      <td class="text-center">${value.payment_method}</td>
                      <td class="text-center"><span class="badge rounded-pill ${statusClass}">${value.payment_status}</span></td>
                     </tr>`;
                        paymentTable.append(row);
                    });
                }
            };

            getProgress();
        },

        Requirements: () => {
            function initializeFilePond() {
                const inputElement = document.querySelector(
                    '.filepond-receipt-upload'
                );
                const receiptFilePondInit = FilePond.create(inputElement, {
                    acceptedFileTypes: ['image/*'],
                    allowFileTypeValidation: true,
                    allowFileSizeValidation: true,
                    allowRevert: true,
                    imagePreviewHeight: 170,
                    imageCropAspectRatio: '1:1',
                    imageResizeTargetWidth: 200,
                    imageResizeTargetHeight: 200,
                    server: {
                        process: {
                            url: '/FileRequirementsUpload',
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document
                                    .querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                            },
                            onload: (response) => {
                                const data = JSON.parse(response);
                                if (data.file_path && data.unique_id) {
                                    // Store unique_id in a hidden input field or as a data attribute
                                    document.querySelector(
                                        'input[name="unique_id"]'
                                    ).value = data.unique_id;
                                    inputElement.setAttribute(
                                        'data-unique-id',
                                        data.unique_id
                                    );
                                    if (data.file_path) {
                                        inputElement.setAttribute(
                                            'data-file-path',
                                            data.file_path
                                        );
                                    }
                                }
                                return data.unique_id;
                            },
                        },
                        revert: (uniqueFileId, load, error) => {
                            const receiptPath =
                                inputElement.getAttribute('data-file-path');
                            const unique_id =
                                inputElement.getAttribute('data-unique-id');

                            console.log(
                                'Reverting file with path:',
                                receiptPath,
                                'and unique ID:',
                                unique_id
                            );

                            fetch(`/FileRequirementsRevert/${unique_id}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document
                                        .querySelector(
                                            'meta[name="csrf-token"]'
                                        )
                                        .getAttribute('content'),
                                },
                                body: JSON.stringify({
                                    file_path: receiptPath,
                                }),
                            })
                                .then((response) => {
                                    if (response.ok) {
                                        load();
                                    } else {
                                        console.error(
                                            'Failed to delete file:',
                                            response.statusText
                                        );
                                    }
                                })
                                .catch(() => {
                                    error('Failed to delete file');
                                });
                        }, // Revert is not needed for temporary files
                    },
                });

                const form = $('#uploadForm');
                const submissionModal = new bootstrap.Modal(
                    document.getElementById('receiptModal')
                );

                form.on('submit', async (event) => {
                    event.preventDefault();
                    const isConfirmed = await createConfirmationModal({
                        title: 'Confirm Submission',
                        message:
                            'Are you sure you want to submit this receipt?',
                    });

                    if (!isConfirmed) {
                        return;
                    }

                    showProcessToast();
                    const formData = new FormData(form[0]);

                    try {
                        const response = await $.ajax({
                            url: REQUIREMENTS_ROUTE.STORE_RECEIPTS,
                            method: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                            },
                        });

                        if (response.success) {
                            closeModal('#receiptModal');
                            getReceipt();
                            hideProcessToast();
                            setTimeout(() => {
                                showToastFeedback(
                                    'text-bg-success',
                                    response.success
                                );
                            }, 500);
                        }
                    } catch (error) {
                        hideProcessToast();
                        console.error(error);
                        showToastFeedback(
                            'text-bg-danger',
                            error.responseJSON.error
                        );
                    }
                });
            }

            async function getReceipt() {
                try {
                    const response = await fetch(
                        REQUIREMENTS_ROUTE.GET_RECEIPTS,
                        {
                            method: 'GET',
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': document
                                    .querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                            },
                        }
                    );

                    const data = await response.json();
                    const tableBody = $('#expenseReceipt_tbody');
                    tableBody.empty(); // Clear the existing rows

                    if (!data || data.length === 0) {
                        const row = `<tr>
                        <td colspan="6" class="text-center">No receipt uploaded yet</td>
                    </tr>`;
                        tableBody.append(row);
                    } else {
                        data.forEach((value) => {
                            const receiptImage = `<img src="data:image/png;base64,${value.receipt_image}" alt="${value.receipt_name}" style="max-width: 200px; max-height: 200px;" />`;
                            const row = `<tr>
                        <td>${value.receipt_name}</td>
                        <td>${value.receipt_description}</td>
                        <td class="img-Content">${receiptImage}</td>
                        <td>${dateFormatter(value.created_at)}</td>
                        <td>
                            <span class="badge rounded-pill ${value.remark === 'Pending' ? 'bg-info' : value.remark === 'Approved' ? 'bg-success' : value.remark === 'Rejected' ? 'bg-danger' : ''}">
                                ${value.remark}
                            </span>
                        </td>
                        <td></td>
                    </tr>`;

                            tableBody.append(row);
                        });
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            }

            initializeFilePond();
            getReceipt();
        },

        QuarterlyReport: () => {
            new SmartWizard();
            
            formatToNumber('#BuildingAsset, #Equipment, #WorkingCapital');

            formatToNumber('#directLaborCard, #indirectLaborCard', 'input');
            formatToNumber('.ExportData, .LocalData', 'tr td:nth-child(n+3):nth-child(-n+6) input');

            AddNewRowHandler('.addNewProductRow', 'div.productLocal, div.productExport');
            RemoveRowHandler('.removeRowButton', 'div.productLocal, div.productExport');




            $('.ExportData, .LocalData').on(
                'input',
                'tr td:nth-child(n+4):nth-child(-n+5) input',
                function () {
                    const row = $(this).closest('tr');
                    const grossSales = parseValueToFloat(
                        row.find('.grossSales_val').val()
                    );
                    const estimatedCostOfProduction = parseValueToFloat(
                        row.find('.estimatedCostOfProduction_val').val()
                    );
                    const netSales = grossSales - estimatedCostOfProduction;
                    const formattedNetSales = formatToString(netSales);

                    row.find('.netSales_val').val(formattedNetSales);
                }
            );

            $('#smartwizard').smartWizard({
                selected: 0,
                theme: 'dots',
                transition: {
                    animation: 'slideHorizontal',
                },
                toolbar: {
                    showNextButton: true, // show/hide a Next button
                    showPreviousButton: true, // show/hide a Previous button
                    position: 'both buttom', // none/ top/ both bottom
                    extraHtml: `<button type="button" class="btn btn-success" onclick="showConfirm()">Submit</button>
                                  <button class="btn btn-secondary" onclick="onCancel()">Cancel</button>`,
                },
            });
            $('#smartwizard').on(
                'showStep',
                function (
                    e,
                    anchorObject,
                    stepIndex,
                    stepDirection,
                    stepPosition
                ) {
                    if (stepIndex === 3 && stepPosition === 'last') {
                        console.log('Arriving at Last Step - Showing Buttons');
                        $('.btn-success, .btn-secondary').show();
                    } else {
                        console.log(
                            'Not Arriving at Last Step - Hiding Buttons'
                        );
                        $('.btn-success, .btn-secondary').hide();
                    }
                }
            );
            $('#smartwizard').on('click', 'button', function () {
                // Your function goes here
                $('#smartwizard').smartWizard('fixHeight');
            });

            window.showConfirm = function () {
                event.preventDefault();
                window.confirmationModal = new bootstrap.Modal(
                    document.getElementById('confirmationModal')
                );
                confirmationModal.show();
            };

            const confirmTrueInfo = $('input[type="checkbox"]#detail_confirm');
            const confirmAgreeInfo = $('input[type="checkbox"]#agree_terms');
            const confirmButton = $('#confirmButton');

            confirmTrueInfo.add(confirmAgreeInfo).on('change', function () {
                confirmButton.prop('disabled', !(
                    confirmTrueInfo.is(':checked') &&
                    confirmAgreeInfo.is(':checked')
                ));
            });

            confirmButton.on('click', function () {
                submitQuarterlyForm();
            });

            const QuarterlyForm = $('#quarterlyForm');
          
            function submitQuarterlyForm() {
                showProcessToast('Submitting Quarterly Report...');

                const formData = QuarterlyForm.serializeArray();
                const quarterId = QuarterlyForm.data('quarter-id');
                const quarterProject =
                    QuarterlyForm.data('quarter-project');
                const quarterPeriod =
                    QuarterlyForm.data('quarter-period');
                const quarterStatus =
                    QuarterlyForm.data('quarter-status');

                let dataObject = {};
                $.each(formData, function (i, v) {
                    dataObject[v.name] = v.value;
                });

                dataObject = {
                    ...dataObject, 
                    ...TableDataExtractor(ExportAndLocalMktTableConfig)
                };


                // Send form data using AJAX
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
                    url: QUARTERLY_REPORT_ROUTE.STORE_REPORT.replace(
                        ':quarterId',
                        quarterId
                    ),
                    data: JSON.stringify(dataObject), // Send the new data object
                    contentType: 'application/json', // Set content type to JSON
                    success: function (response) {
                        // Handle the response if needed
                        hideProcessToast();
                        setTimeout(() => {
                            confirmationModal.hide();
                            showToastFeedback(
                                'text-bg-success',
                                response.message
                            );
                        }, 500);
                    },
                    error: function (xhr, status, error) {
                        hideProcessToast();
                        showToastFeedback(
                            'text-bg-danger',
                            'Failed to submit quarterly report'
                        );
                    },
                });
            }

            const QUARTERLY_FORM = $('#quarterlyForm');
            const QUARTER_PERIOD = QUARTERLY_FORM.data(
                'quarter-period'
            )
            console.log(QUARTER_PERIOD);
            const DRAFT_TYPE = `Quarterly_report_${QUARTER_PERIOD}`.replace(/\s/g, '');

            const formDraftHandler = new FormDraftHandler(QUARTERLY_FORM, DRAFT_TYPE);

            formDraftHandler.syncTextInputData();
            formDraftHandler.syncTablesData('#LocalOutletTable tr, #ExportOutletTable tr', ExportAndLocalMktTableConfig);
           
            (async () => {
                await formDraftHandler.loadDraftData( 
                    QUARTERLY_REPORTING_FORM_CONFIG,
                );
            })()

        },

        ReportedQuarterlyReport: () => {
            console.log('initilizeCoopPageJs.ReportedQuarterlyReport');
            formatToNumber('#BuildingAsset, #Equipment, #WorkingCapital');
            formatToNumber('#directLaborCard, #indirectLaborCard', 'input');
            formatToNumber('.ExportData, .LocalData', 'tr td:nth-child(n+3):nth-child(-n+6) input');

            AddNewRowHandler('.addNewProductRow', 'div.productLocal, div.productExport');
            RemoveRowHandler('.removeRowButton', 'div.productLocal, div.productExport');

            $('.ExportData, .LocalData').on(
                'input',
                'tr td:nth-child(n+4):nth-child(-n+5) input',
                function () {
                    const row = $(this).closest('tr');
                    const grossSales = parseValueToFloat(
                        row.find('.grossSales_val').val()
                    );
                    const estimatedCostOfProduction = parseValueToFloat(
                        row.find('.estimatedCostOfProduction_val').val()
                    );
                    const netSales = grossSales - estimatedCostOfProduction;
                    const formattedNetSales = formatToString(netSales);
                    row.find('.netSales_val').val(formattedNetSales);
                }
            );

            const inputContainers = $(
                '#AssetsInputs, #EmploymentInputs, #marketOutletInputs'
            );
            const ProductAndSalesContainer = $('#ProductionAndSalesInputs');

            const Products = {
                exportProduct: ProductAndSalesContainer.find('.productExport'),
                localProduct: ProductAndSalesContainer.find('.productLocal'),
            };

            function storeInitialValues(container) {
                const containerData = {};
                container.find('input, textarea').each(function (index, input) {
                    containerData[input.name] = $(input).val();
                });
                return containerData;
            }

            const initialData = {};
            inputContainers.each(function () {
                const container = $(this);
                initialData[container.attr('id')] =
                    storeInitialValues(container);
            });

            initialData['ProductionAndSalesInputs'] = TableDataExtractor(ExportAndLocalMktTableConfig);

            console.log(initialData);

            inputContainers.on('click', '.editButton', function () {
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

            inputContainers.on('click', '.revertButton', function () {
                console.log('revert');
                const cardBody = $(this).closest('div.card-body');

                console.log(cardBody);
                const containerId = cardBody.attr('id');
                console.log(containerId);

                // Revert inputs back to initial values within this container
                cardBody.find('input, textarea').each(function (index, input) {
                    $(input).val(initialData[containerId][input.name]);
                });

                // Disable Revert button after reverting within this container
                cardBody.find('input, textarea').prop('readonly', true);
                cardBody.find('.revertButton').prop('disabled', true);
            });

            ProductAndSalesContainer.on('click', '.editButton', function () {
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
            });

            ProductAndSalesContainer.on('click', '.revertButton', function () {
                const initialProductData =
                    initialData['ProductionAndSalesInputs'];

                // Revert export product table
                Products.exportProduct
                    .find('.ExportData .table_row')
                    .each(function (index, row) {
                        if (initialProductData.ExportProduct[index]) {
                            $(row)
                                .find('.productName')
                                .val(
                                    initialProductData.ExportProduct[index]
                                        .productName
                                );
                            $(row)
                                .find('.packingDetails')
                                .val(
                                    initialProductData.ExportProduct[index]
                                        .packingDetails
                                );
                            $(row)
                                .find('.productionVolume_val')
                                .val(
                                    initialProductData.ExportProduct[index]
                                        .volumeOfProduction
                                );
                            $(row)
                                .find('.grossSales_val')
                                .val(
                                    initialProductData.ExportProduct[index]
                                        .grossSales
                                );
                            $(row)
                                .find('.estimatedCostOfProduction_val')
                                .val(
                                    initialProductData.ExportProduct[index]
                                        .productionCost
                                );
                            $(row)
                                .find('.netSales_val')
                                .val(
                                    initialProductData.ExportProduct[index]
                                        .netSales
                                );
                        } else {
                            // If no initial data exists, clear the inputs
                            console.log(
                                'No initial data for export row, clearing inputs:',
                                index
                            );
                            $(row).find('.productName').val('');
                            $(row).find('.packingDetails').val('');
                            $(row).find('.productionVolume_val').val('');
                            $(row).find('.grossSales_val').val('');
                            $(row)
                                .find('.estimatedCostOfProduction_val')
                                .val('');
                            $(row).find('.netSales_val').val('');
                        }
                    });

                // Revert local product table
                Products.localProduct
                    .find('.LocalData .table_row')
                    .each(function (index, row) {
                        if (initialProductData.LocalProduct[index]) {
                            $(row)
                                .find('.productName')
                                .val(
                                    initialProductData.LocalProduct[index]
                                        .productName
                                );
                            $(row)
                                .find('.packingDetails')
                                .val(
                                    initialProductData.LocalProduct[index]
                                        .packingDetails
                                );
                            $(row)
                                .find('.productionVolume_val')
                                .val(
                                    initialProductData.LocalProduct[index]
                                        .volumeOfProduction
                                );
                            $(row)
                                .find('.grossSales_val')
                                .val(
                                    initialProductData.LocalProduct[index]
                                        .grossSales
                                );
                            $(row)
                                .find('.estimatedCostOfProduction_val')
                                .val(
                                    initialProductData.LocalProduct[index]
                                        .productionCost
                                );
                            $(row)
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
                            $(row).find('.productName').val('');
                            $(row).find('.packingDetails').val('');
                            $(row).find('.productionVolume_val').val('');
                            $(row).find('.grossSales_val').val('');
                            $(row)
                                .find('.estimatedCostOfProduction_val')
                                .val('');
                            $(row).find('.netSales_val').val('');
                        }
                    });

                // Disable Revert button after reverting
                ProductAndSalesContainer.find('.addNewProductRow').prop(
                    'disabled',
                    true
                );
                ProductAndSalesContainer.find('input, textarea').prop(
                    'readonly',
                    true
                );
                ProductAndSalesContainer.find('.revertButton').prop(
                    'disabled',
                    true
                );
            });

            //TODO: Implove the form Update functionalities
            $('#updateQuarterlyData').on('submit', async function (e) {
                e.preventDefault();
                const isConfirmed = await createConfirmationModal({
                    title: 'Confirm Update',
                    message:
                        'Are you sure you want to update this quarterly report?',
                    confirmButtonText: 'Update',
                    cancelButtonText: 'Cancel',
                    confirmButtonClass: 'btn-primary',
                });

                if (!isConfirmed) {
                    return;
                }
                showProcessToast('Updating Quarterly Report...');
                const form = $(this);
                form.find('button[type="submit"]').prop('disabled', true);
                form.find('input, textarea').prop('readonly', true);
                const quarterId = form.data('quarter-id');
                const quarterProject = form.data('quarter-project');
                const quarterPeriod = form.data('quarter-period');
                const quarterStatus = form.data('quarter-status');

                let formDataObject = {};
                const updatedFormData = form.serializeArray();

                $.each(updatedFormData, function (i, v) {
                    formDataObject[v.name] = v.value;
                });

                formDataObject = {
                    ...formDataObject,
                    ...TableDataExtractor(ExportAndLocalMktTableConfig),
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
                    url: QUARTERLY_REPORT_ROUTE.UPDATE_REPORT.replace(
                        ':quarterId',
                        quarterId
                    ),
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
                            error.responseJSON.message
                        );
                        form.find('button[type="submit"]').prop(
                            'disabled',
                            false
                        );
                        form.find('input, textarea').prop('readonly', false);
                        console.log(error);
                    },
                });
            });
        },
    };
    return functions;
};
