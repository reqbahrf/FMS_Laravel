import '../echo';
import { customFormatNumericInput } from '../Utilities/input-utils';
import createConfirmationModal from '../Utilities/confirmation-modal';
import {
    showToastFeedback,
    customDateFormatter,
    formatNumberToCurrency,
    parseFormattedNumberToFloat,
    showProcessToast,
    hideProcessToast,
    closeModal,
} from '../Utilities/utilFunctions';
import { FormDraftHandler } from '../Utilities/FormDraftHandler';
import QUARTERLY_REPORTING_FORM_CONFIG from '../Form_Config/QUARTERLY_REPORTING_CONFIG';
import {
    AddNewRowHandler,
    RemoveRowHandler,
} from '../Utilities/add-and-remove-table-row-handler';
import DarkMode from '../Utilities/DarkModeHandler';
import 'smartwizard/dist/css/smart_wizard_all.css';
import SmartWizard from 'smartwizard';
import { TableDataExtractor } from '../Utilities/TableDataExtractor';
import NotificationManager from '../Utilities/NotificationManager';
import ActivityLogHandler from '../Utilities/ActivityLogHandler';
import CoopPageNavHandler from './CoopPageNavHandler';

const MAIN_CONTENT_CONTAINER = $('#main-content');
const ACTIVITY_LOG_MODAL = $('#userActivityLogModal');
const USER_ROLE = 'coop';
const ExportAndLocalMktTableConfig = {
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

const darkMode = new DarkMode();
darkMode.initializeTheme();
//The NOTIFICATION_ROUTE and USER_ID constants are defined in the Blade view @ CooperatorApprovedPage.blade.php
const notificationManager = new NotificationManager(
    NOTIFICATION_ROUTE,
    USER_ID,
    USER_ROLE
);
notificationManager.fetchNotifications();
notificationManager.setupEventListeners();

const urlMapFunction = {
    [NAV_ROUTES.DASHBOARD]: (functions) => functions.Dashboard,
    [NAV_ROUTES.REFUND_STRUCTURE]: (functions) => functions.Refund,
    [NAV_ROUTES.PROJECT]: (functions) => functions.Project,
    [NAV_ROUTES.QUARTERLY_REPORT]: (functions, reportSubmitted) =>
        reportSubmitted
            ? functions.ReportedQuarterlyReport
            : functions.QuarterlyReport,
};

const navigationHandler = new CoopPageNavHandler(
    MAIN_CONTENT_CONTAINER,
    USER_ROLE,
    urlMapFunction,
    initilizeCoopPageJs
);
navigationHandler.init();
window.loadPage = navigationHandler.loadPage.bind(navigationHandler);

// $(window).on('beforeunload', function () {
//     return 'Are you sure you want to leave?';
// });

const activityLog = new ActivityLogHandler(
    ACTIVITY_LOG_MODAL,
    USER_ROLE,
    'personal'
);
activityLog.initPersonalActivityLog();

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
    } catch (error) {
        showToastFeedback(
            'text-bg-danger',
            error?.responseJSON?.message ||
                error?.message ||
                'Error in getting quarterly report'
        );
    }
};

getQuarterlyReportLinks();

$(function () {
    // Cache selectors
    const mobileNavOffcanvas = $('#MobileNavOffcanvas');
    const sidenav = $('.sidenav');
    const toggleLeftMargin = $('#toggle-left-margin');
    const logoTitleLScreen = $('.logoTitleLScreen');
    const sidenavLinks = $('.sidenav a span');
    const hoverLink = $('#hover-link');

    // Debounce function
    function debounce(func, delay) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    // Side Nav toggle for small screen
    $('.sideNavButtonSmallScreen').on(
        'click',
        debounce(function () {
            new bootstrap.Offcanvas(mobileNavOffcanvas).show();
        }, 300)
    );

    // Side Nav toggle for large screen
    $('.sideNavButtonLargeScreen').on(
        'click',
        debounce(function () {
            sidenav.toggleClass('expanded minimized');
            toggleLeftMargin.toggleClass('navExpanded navMinimized');
            logoTitleLScreen.toggle();

            // Minimize sidebar
            sidenavLinks.each(function () {
                $(this).toggleClass('d-none');
            });

            sidenav.find('a').each(function () {
                $(this).toggleClass('justify-content-center');
            });

            // Sidebar minimize rotation
            hoverLink.toggleClass('rotate-icon');
        }, 300)
    );
});

/**
 * Initializes and returns an object containing asynchronous functions for various coop page sections.
 *
 * @returns {Promise<object>} An object containing functions for Dashboard, Requirements, Project, QuarterlyReport, and ReportedQuarterlyReport.
 */
async function initilizeCoopPageJs() {
    const functions = {
        Dashboard: async () => {
            let progressDataChart;
            console.log('this is called');
            const progressPercentage = (percentage = 0) => {
                const options = {
                    series: [percentage],
                    chart: {
                        type: 'radialBar',
                        height: 350,
                        width: '100%',
                        toolbar: {
                            show: false,
                        },
                    },
                    plotOptions: {
                        radialBar: {
                            startAngle: -160,
                            endAngle: 160,
                            hollow: {
                                margin: 0,
                                size: '70%',
                                background: '#fff',
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
                                strokeWidth: '67%',
                                margin: 0,
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
                                        return parseInt(val) + '%';
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
                    labels: ['Progress'],
                };

                return new Promise((resolve) => {
                    if (progressDataChart) {
                        progressDataChart.destroy();
                    }
                    progressDataChart = new ApexCharts(
                        document.querySelector('#ProgressPer'),
                        options
                    );
                    progressDataChart.render();
                    resolve();
                }).catch((error) => {
                    throw new Error(
                        'Error initializing progress chart: ' + error
                    );
                });
            };

            const getProgress = async () => {
                const paymentTextPer = $('#ProgressPerText');
                try {
                    const response = await fetch(
                        DASHBOARD_TAB_ROUTE.GET_COOPERATOR_PROGRESS,
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
                    const data = (await response?.json()) || {};
                    console.log(data);

                    // Handle empty array case
                    const progress = data.progress ? data.progress : {};
                    const paymentList = data.paymentList
                        ? data.paymentList
                        : {};

                    paymentTableProcess(paymentList);

                    const actual_amount =
                        parseFloat(progress?.actual_amount_to_be_refund) || 0;
                    const refunded_amount =
                        parseFloat(progress?.refunded_amount) || 0;
                    const percentage =
                        actual_amount > 0
                            ? Math.ceil((refunded_amount / actual_amount) * 100)
                            : 0;
                    paymentTextPer.html(
                        /*html*/ `<h5>${formatNumberToCurrency(refunded_amount)} / ${formatNumberToCurrency(actual_amount)}</h5>`
                    );
                    await progressPercentage(percentage);
                } catch (error) {
                    throw new Error('Error fetching progress data: ' + error);
                }
            };

            const paymentTableProcess = (data) => {
                const paymentTable = $('#PaymentTable').find('tbody');
                paymentTable.empty();
                if (!data) {
                    const row = /*html*/ `<tr><td colspan="3" class="text-center">No payment yet</td></tr>`;
                    paymentTable.append(row);
                } else {
                    $.each(data, function (key, value) {
                        const statusClass =
                            value.payment_status === 'Paid'
                                ? 'bg-success'
                                : 'bg-danger';
                        const row = /*html*/ `<tr>
                            <td class="text-center">
                                ${formatNumberToCurrency(value.amount)}
                            </td>
                            <td class="text-center">${value.payment_method}</td>
                            <td class="text-center">
                                <span class="badge rounded-pill ${statusClass}"
                                    >${value.payment_status}</span
                                >
                            </td>
                        </tr>`;
                        paymentTable.append(row);
                    });
                }
            };

            await getProgress();
        },

        PaymentStructure: async () => {},

        Project: async () => {
            // TODO: add functions for new project Application
            return null;
        },

        QuarterlyReport: async () => {
            new SmartWizard();

            customFormatNumericInput(
                '#BuildingAsset, #Equipment, #WorkingCapital'
            );

            customFormatNumericInput(
                '#directLaborCard, #indirectLaborCard',
                'input'
            );
            customFormatNumericInput(
                '.ExportData, .LocalData',
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

            $('.ExportData, .LocalData').on(
                'input',
                'tr td:nth-child(n+4):nth-child(-n+5) input',
                function () {
                    const row = $(this).closest('tr');
                    const grossSales = parseFormattedNumberToFloat(
                        row.find('.grossSales_val').val()
                    );
                    const estimatedCostOfProduction =
                        parseFormattedNumberToFloat(
                            row.find('.estimatedCostOfProduction_val').val()
                        );
                    const netSales = grossSales - estimatedCostOfProduction;
                    const formattedNetSales = formatNumberToCurrency(netSales);

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
                    extraHtml: /*html*/ `<button
                            type="button"
                            class="btn btn-success"
                            onclick="showConfirm()"
                        >
                            Submit
                        </button>
                        <button
                            class="btn btn-secondary"
                            onclick="onCancel()"
                        >
                            Cancel
                        </button>`,
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
                confirmButton.prop(
                    'disabled',
                    !(
                        confirmTrueInfo.is(':checked') &&
                        confirmAgreeInfo.is(':checked')
                    )
                );
            });

            confirmButton.on('click', function () {
                submitQuarterlyForm();
            });

            const QuarterlyForm = $('#quarterlyForm');

            function submitQuarterlyForm() {
                showProcessToast('Submitting Quarterly Report...');

                const formData = QuarterlyForm.serializeArray();
                const quarterId = QuarterlyForm.data('quarter-id');
                const quarterProject = QuarterlyForm.data('quarter-project');
                const quarterPeriod = QuarterlyForm.data('quarter-period');
                const quarterStatus = QuarterlyForm.data('quarter-status');

                let dataObject = {};
                $.each(formData, function (i, v) {
                    dataObject[v.name] = v.value;
                });

                dataObject = {
                    ...dataObject,
                    ...TableDataExtractor(ExportAndLocalMktTableConfig),
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
            const QUARTER_PERIOD = QUARTERLY_FORM.data('quarter-period');
            console.log(QUARTER_PERIOD);
            const DRAFT_TYPE = `Quarterly_report_${QUARTER_PERIOD}`.replace(
                /\s/g,
                ''
            );

            const formDraftHandler = new FormDraftHandler(
                QUARTERLY_FORM,
                DRAFT_TYPE
            );

            formDraftHandler.syncTextInputData();
            formDraftHandler.syncTablesData(
                '#LocalOutletTable tr, #ExportOutletTable tr',
                ExportAndLocalMktTableConfig
            );

            await formDraftHandler.loadDraftData(
                QUARTERLY_REPORTING_FORM_CONFIG
            );
        },

        ReportedQuarterlyReport: () => {
            console.log('initilizeCoopPageJs.ReportedQuarterlyReport');
            customFormatNumericInput(
                '#BuildingAsset, #Equipment, #WorkingCapital'
            );
            customFormatNumericInput(
                '#directLaborCard, #indirectLaborCard',
                'input'
            );
            customFormatNumericInput(
                '.ExportData, .LocalData',
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

            $('.ExportData, .LocalData').on(
                'input',
                'tr td:nth-child(n+4):nth-child(-n+5) input',
                function () {
                    const row = $(this).closest('tr');
                    const grossSales = parseFormattedNumberToFloat(
                        row.find('.grossSales_val').val()
                    );
                    const estimatedCostOfProduction =
                        parseFormattedNumberToFloat(
                            row.find('.estimatedCostOfProduction_val').val()
                        );
                    const netSales = grossSales - estimatedCostOfProduction;
                    const formattedNetSales = formatNumberToCurrency(netSales);
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

            initialData['ProductionAndSalesInputs'] = TableDataExtractor(
                ExportAndLocalMktTableConfig
            );

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
}
