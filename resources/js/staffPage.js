import './echo';
import {
    showToastFeedback,
    formatNumberToCurrency,
    customDateFormatter,
    closeOffcanvasInstances,
    createConfirmationModal,
    customFormatNumericInput,
    closeModal,
    showProcessToast,
    hideProcessToast,
} from './Utilities/utilFunctions';
import getProjectPaymentHistory from './Utilities/ProjectPaymentHistory';
import FormEvents from './components/ProjectFormEvents';
import EsignatureHandler from './Utilities/EsignatureHandler';
import NotificationManager from './Utilities/NotificationManager';
import ActivityLogHandler from './Utilities/ActivityLogHandler';
import NavigationHandler from './Utilities/TabNavigationHandler';

import DataTable from 'datatables.net-bs5';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';
// import 'datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css';
// import 'datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css';
// import 'datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css';
// import 'datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css';
// import 'datatables.net-scroller-bs5/css/scroller.bootstrap5.min.css';

window.DataTable = DataTable;
import 'datatables.net-buttons-bs5';
import 'datatables.net-buttons/js/buttons.html5.mjs';
import 'datatables.net-fixedcolumns-bs5';
import 'datatables.net-fixedheader-bs5';
import 'datatables.net-responsive-bs5';
import 'datatables.net-scroller-bs5';
import 'smartwizard/dist/css/smart_wizard_all.css';
import smartWizard from 'smartwizard';
import { TableDataExtractor } from './Utilities/TableDataExtractor';
window.smartWizard = smartWizard;
let currentPage = null;
const MAIN_CONTENT_CONTAINER = $('#main-content');
const ACTIVITY_LOG_MODAL = $('#userActivityLogModal');

const USER_ROLE = 'staff';
//The NOTIFICATION_ROUTE and USER_ID constants are defined in the Blade view @ Staff_Index.blade.php
const notificationManager = new NotificationManager(
    NOTIFICATION_ROUTE,
    USER_ID,
    USER_ROLE
);
notificationManager.fetchNotifications();
notificationManager.setupEventListeners();

const urlMapFunctions = {
    [NAV_ROUTES.DASHBOARD]: (functions) => functions.Dashboard,
    [NAV_ROUTES.PROJECT]: (functions) => functions.Projects,
    [NAV_ROUTES.ADD_PROJECT]: (functions) => functions.AddProject,
    [NAV_ROUTES.APPLICANT]: (functions) => functions.Applicant,
};

const navigationHandler = new NavigationHandler(
    MAIN_CONTENT_CONTAINER,
    USER_ROLE,
    urlMapFunctions,
    initializeStaffPageJs
);
navigationHandler.init();
window.loadPage = navigationHandler.loadPage.bind(navigationHandler);

$(function () {
    // Line chart
    //toast feedback

    //Side Nav toggle

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
});

const activityLog = new ActivityLogHandler(ACTIVITY_LOG_MODAL, USER_ROLE, 'personal');
activityLog.initPersonalActivityLog();

async function initializeStaffPageJs() {
    const functions = {
        Dashboard: async () => {
            //Foramt Input with Id paymentAmount
            customFormatNumericInput('#paymentAmount');
            customFormatNumericInput('#days_open');
            customFormatNumericInput('#updateOpenDays');

            // initialize datatable
            const HandledProjectDataTable = $('#handledProject').DataTable({
                autoWidth: false,
                responsive: true,
                columns: [
                    {
                        title: 'ID',
                    },
                    {
                        title: 'Project Title',
                    },
                    {
                        title: 'Firm Name',
                    },
                    {
                        title: 'Owner Name',
                    },
                    {
                        title: 'Refund Progress',
                    },
                    {
                        title: 'Status',
                    },
                    {
                        title: 'Action',
                    },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        width: '10%',
                    },
                    {
                        targets: 1,
                        width: '20%',
                    },
                    {
                        targets: 2,
                        width: '15%',
                    },
                    {
                        targets: 3,
                        width: '15%',
                    },
                    {
                        targets: 4,
                        width: '15%',
                        className: 'text-end',
                    },
                    {
                        targets: 5,
                        width: '5%',
                        className: 'text-center',
                    },
                    {
                        targets: 6,
                        width: '5%',
                        orderable: false,
                        className: 'text-center',
                    },
                ],
            });
            const ProjectFileLinkDataTable = $('#linkTable').DataTable({
                autoWidth: false,
                responsive: true,
                columns: [
                    {
                        title: 'File Name',
                    },
                    {
                        title: 'Link',
                    },
                    {
                        title: 'Date Created',
                    },
                    {
                        title: 'Action',
                        className: 'text-center',
                    },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        width: '15%',
                    },
                    {
                        targets: 1,
                        width: '40%',
                    },
                    {
                        targets: 2,
                        width: '20%',
                    },
                    {
                        targets: 3,
                        width: '10%',
                    },
                ],
            });

            const PaymentHistoryDataTable = $('#paymentHistoryTable').DataTable(
                {
                    responsive: true,
                    columns: [
                        {
                            title: 'Transaction #',
                        },
                        {
                            title: 'Amount',
                        },
                        {
                            title: 'Payment Method',
                        },
                        {
                            title: 'Status',
                        },
                        {
                            title: 'Date Created',
                        },
                        {
                            title: 'Action',
                        },
                    ],
                    columnDefs: [
                        {
                            targets: 5,
                            width: '8%',
                        },
                    ],
                }
            );

            const UploadedReceiptDataTable = $(
                '#uploadedReceiptTable'
            ).DataTable({
                autoWidth: false,
                responsive: true,
                columns: [
                    {
                        title: 'Receipt Name',
                        width: '20%',
                    },
                    {
                        title: 'Receipt Image',
                        width: '25%',
                    },
                    {
                        title: 'Uploaded Date',
                        width: '20%',
                    },
                    {
                        title: 'Status',
                        width: '10%',
                    },
                    {
                        title: 'Action',
                        width: '10%',
                    },
                ],
            });

            function populateYearDropdown(selectElementId) {
                const $select = $(`#${selectElementId}`);
                const currentYear = new Date().getFullYear();

                $select.empty().append(
                    $('<option>', {
                        value: '',
                        text: 'Select Year',
                        disabled: true,
                        selected: true,
                    })
                );

                // Add current year and next 3 years
                for (let i = 0; i < 4; i++) {
                    const year = currentYear + i;
                    $select.append($('<option>', { value: year, text: year }));
                }
            }

            populateYearDropdown('yearSelect');
            /**
             * Creates a monthly data chart with the provided data for applicants, ongoing, and completed items.
             *
             * @param {Array} applicant - Data for the 'Applicant' category.
             * @param {Array} ongoing - Data for the 'Ongoing' category.
             * @param {Array} completed - Data for the 'Completed' category.
             * @returns {Promise} A promise that resolves after rendering the monthly data chart.
             */
            const createMonthlyDataChart = (applicant, ongoing, completed) => {
                const monthlyDataChart = {
                    theme: {
                        mode: 'light',
                    },
                    series: [
                        {
                            name: 'Applicant',
                            data: applicant,
                        },
                        {
                            name: 'Ongoing',
                            data: ongoing,
                        },
                        {
                            name: 'Completed',
                            data: completed,
                        },
                    ],
                    chart: {
                        height: 350,
                        type: 'bar',
                    },
                    stroke: {
                        width: [6, 6, 6],
                        curve: 'smooth',
                        dashArray: [0, 0, 0],
                    },
                    markers: {
                        size: 0,
                    },
                    xaxis: {
                        categories: [
                            'Jan',
                            'Feb',
                            'Mar',
                            'Apr',
                            'May',
                            'Jun',
                            'Jul',
                            'Aug',
                            'Sep',
                            'Oct',
                            'Nov',
                            'Dec',
                        ],
                    },
                    yaxis: {
                        title: {
                            text: 'Count',
                        },
                    },
                    legend: {
                        tooltipHoverFormatter: function (val, opts) {
                            return (
                                val +
                                ' - ' +
                                opts.w.globals.series[opts.seriesIndex][
                                    opts.dataPointIndex
                                ] +
                                ''
                            );
                        },
                    },
                };

                return new Promise((resolve) => {
                    const lineChart = new ApexCharts(
                        document.querySelector('#lineChart'),
                        monthlyDataChart
                    );
                    lineChart.render();
                    resolve();
                }).catch((error) => {
                    throw new Error('Error rendering line chart: ' + error);
                });
            };

            const displayCurrentMonthStats = async (monthlyData) => {
                // Get current month index (0-11)
                const currentMonth = new Date().getMonth();
                const months = [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec',
                ];

                // Get current month's data
                const currentMonthKey = Object.keys(monthlyData).find(
                    (month) => month.slice(0, 3) === months[currentMonth]
                );

                const currentData = currentMonthKey
                    ? monthlyData[currentMonthKey]
                    : {
                          Applicants: 0,
                          Ongoing: 0,
                          Completed: 0,
                      };

                // Function to format numbers with commas
                const formatNumber = (value) => {
                    return value
                        .toString()
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                };

                // Update stat counts
                $('#applicantCount').text(
                    formatNumber(currentData.Applicants || 0)
                );
                $('#ongoingCount').text(formatNumber(currentData.Ongoing || 0));
                $('#completedCount').text(
                    formatNumber(currentData.Completed || 0)
                );

                // Calculate and update overall projects
                // Calculate overall total across all months
                const overallProjects = Object.values(monthlyData).reduce(
                    (total, month) => {
                        return (
                            total +
                            (month.Applicants || 0) +
                            (month.Ongoing || 0) +
                            (month.Completed || 0)
                        );
                    },
                    0
                );
                $('#overallCount').text(formatNumber(overallProjects));

                // Add animation class to stat cards
                $('.stat-count').each(function () {
                    $(this).addClass('animate__animated animate__heartBeat');
                    setTimeout(() => {
                        $(this).removeClass(
                            'animate__animated animate__heartBeat'
                        );
                    }, 1000);
                });
            };

            /**
             * Processes monthly data and generates a chart with applicant, ongoing, and completed data.
             *
             * @param {Object} monthlyData - An object containing the data for each month.
             * @param {Object[]} monthlyData[].Applicants - The number of applicants for the month.
             * @param {Object[]} monthlyData[].Ongoing - The number of ongoing processes for the month.
             * @param {Object[]} monthlyData[].Completed - The number of completed processes for the month.
             * @returns {Promise<void>} - A promise that resolves when the chart has been created.
             */
            const processMonthlyDataChart = async (monthlyData) => {
                try {
                    let applicant = Array(12).fill(0);
                    let ongoing = Array(12).fill(0);
                    let completed = Array(12).fill(0);
                    const months = [
                        'Jan',
                        'Feb',
                        'Mar',
                        'Apr',
                        'May',
                        'Jun',
                        'Jul',
                        'Aug',
                        'Sep',
                        'Oct',
                        'Nov',
                        'Dec',
                    ];

                    Object.keys(monthlyData).forEach((month) => {
                        const data = monthlyData[month];

                        const monthIndex = months.indexOf(month.slice(0, 3));

                        if (monthIndex !== -1) {
                            applicant[monthIndex] = data.Applicants || 0;
                            ongoing[monthIndex] = data.Ongoing || 0;
                            completed[monthIndex] = data.Completed || 0;
                        }
                    });
                    await createMonthlyDataChart(applicant, ongoing, completed);
                    await displayCurrentMonthStats(monthlyData);
                } catch (error) {
                    throw new Error(
                        'Failed to process monthly data: ' + error.message
                    );
                }
            };

            const getDashboardChartData = async () => {
                try {
                    const response = await $.ajax({
                        type: 'GET',
                        url: DASHBBOARD_TAB_ROUTE.GET_MONTHLY_PROJECTS_CHARTDATA,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                    });
                    await processMonthlyDataChart(response);
                } catch (error) {
                    throw new Error(
                        'Failed to get dashboard chart data: ' + error.message
                    );
                }
            };
            //Handled Project Offcanvas Button Events

            function toggleMenu(tab, addClassMenu, removeClassMenu) {
                $(tab).on('shown.bs.tab', () => {
                    $(addClassMenu).addClass('d-none');
                    $(removeClassMenu).removeClass('d-none');
                });
                $(tab).on('hidden.bs.tab', () => {
                    $(addClassMenu).removeClass('d-none');
                    $(removeClassMenu).addClass('d-none');
                });
            }

            // Tab: nav-details-tab
            toggleMenu(
                '#nav-details-tab',
                '.AttachlinkTabMenu, .GeneratedSheetsTabMenu',
                null
            );

            // Tab: nav-link-tab
            toggleMenu(
                '#nav-link-tab',
                '.GeneratedSheetsTabMenu',
                '.AttachlinkTabMenu'
            );

            // Tab: nav-Quarterly-tab
            toggleMenu(
                '#nav-Quarterly-tab',
                '.AttachlinkTabMenu, .GeneratedSheetsTabMenu',
                null
            );

            // Tab: nav-GeneratedSheets-tab
            toggleMenu(
                '#nav-GeneratedSheets-tab',
                '.AttachlinkTabMenu',
                '.GeneratedSheetsTabMenu'
            );

            const isRefundCompleted = (boolean) => {
                const completedButton = $('#MarkCompletedProjectBtn');
                boolean
                    ? completedButton.prop('disabled', false).show()
                    : completedButton.prop('disabled', true).hide();
            };

            /**
             * Fetches handled projects from the server and updates the handled project table.
             *
             * @return {void}
             */
            const getHandleProject = async () => {
                try {
                    const response = await fetch(
                        DASHBBOARD_TAB_ROUTE.GET_HANDLED_PROJECTS,
                        {
                            method: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $(
                                    'meta[name="csrf-token"]'
                                ).attr('content'),
                            },
                        }
                    );
                    const data = await response.json();
                    HandledProjectDataTable.clear();
                    HandledProjectDataTable.rows.add(
                        data.map((project) => {
                            const refunded_amount =
                                parseFloat(project.Refunded_Amount) || 0;
                            const Actual_Amount =
                                parseFloat(project.Actual_Amount) || 0;
                            const percentage = Math.ceil(
                                (refunded_amount / Actual_Amount) * 100
                            );
                            return [
                                project.Project_id,
                                project.project_title,
                                `<p class="firm_name">${project.firm_name}</p>
                            <input type="hidden" class="business_id" value="${
                                project.business_id
                            }">
                            <input type="hidden" class="business_enterprise_type" value="${
                                project.enterprise_type
                            }">
                            <input type="hidden" class="business_enterprise_level" value="${
                                project.enterprise_level
                            }">
                            <input type="hidden" class="business_address" value="${
                                project.landMark +
                                ', ' +
                                project.barangay +
                                ', ' +
                                project.city +
                                ', ' +
                                project.province +
                                ', ' +
                                project.region
                            }">
                            <input type="hidden" class="dateApplied" value="${
                                project.date_applied
                            }">
                            <input type="hidden" class="building_value" value="${
                                project.building_value
                            }">
                            <input type="hidden" class="equipment_value" value="${
                                project.equipment_value
                            }">
                            <input type="hidden" class="working_capital" value="${
                                project.working_capital
                            }">`,
                                `<p class="owner_name">${
                                    (project.prefix ? project.prefix : '') +
                                    ' ' +
                                    project.f_name +
                                    ' ' +
                                    project.l_name +
                                    ' ' +
                                    (project.suffix ? project.suffix : ' ')
                                }</p>
                            <input type="hidden" class="sex" value="${project.sex}">
                            <input type="hidden" class="birth_date" value="${
                                project.birth_date
                            }">
                            <input type="hidden" class="landline" value="${
                                project.landline ?? ''
                            }">
                            <input type="hidden" class="mobile_phone" value="${
                                project.mobile_number
                            }">
                            <input type="hidden" class="email" value="${
                                project.email
                            }">`,
                                `${
                                    formatNumberToCurrency(refunded_amount) +
                                    '/' +
                                    formatNumberToCurrency(Actual_Amount)
                                }<span class="badge ms-1 text-white bg-primary">${percentage}%</span>
                        <input type="hidden" class="approved_amount" value="${
                            project.Approved_Amount
                        }">
                        <input type="hidden" class="actual_amount" value="${Actual_Amount}">`,
                                `<span class="badge ${
                                    project.application_status === 'approved'
                                        ? 'bg-warning'
                                        : project.application_status ===
                                            'ongoing'
                                          ? 'bg-primary'
                                          : project.application_status ===
                                              'completed'
                                            ? 'bg-success'
                                            : null
                                }">${project.application_status}</span>`,
                                `<button class="btn btn-primary handleProjectbtn" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#handleProjectOff" aria-controls="handleProjectOff">
                                <i class="ri-menu-unfold-4-line ri-1x"></i>
                            </button>`,
                            ];
                        })
                    );
                    HandledProjectDataTable.draw();
                } catch (error) {
                    throw new Error(
                        'Error fetching handled projects: ' + error
                    );
                }
            };

            /**
             * Handles the content of the project offcanvas based on the project status.
             *
             * @param {string} project_status - The status of the project (approved, ongoing, completed)
             * @return {Promise<void>} A promise that resolves when the offcanvas content has been updated
             */
            async function handleProjectOffcanvasContent(project_status) {
                const handleProjectOffcanvas = $('#handleProjectOff');
                const content = {
                    approved: () => {
                        handleProjectOffcanvas
                            .find('.approvedProjectContent')
                            .removeClass('d-none');
                        handleProjectOffcanvas
                            .find(
                                '.ongoingProjectContent, .completedProjectContent, .paymentProjectContent'
                            )
                            .addClass('d-none');
                    },
                    ongoing: () => {
                        handleProjectOffcanvas
                            .find(
                                '.ongoingProjectContent, .paymentProjectContent'
                            )
                            .removeClass('d-none');
                        handleProjectOffcanvas
                            .find(
                                '.approvedProjectContent, .completedProjectContent'
                            )
                            .addClass('d-none');
                    },
                    completed: () => {
                        handleProjectOffcanvas
                            .find(
                                '.completedProjectContent, .paymentProjectContent'
                            )
                            .removeClass('d-none');
                        handleProjectOffcanvas
                            .find(
                                '.approvedProjectContent, .ongoingProjectContent'
                            )
                            .addClass('d-none');
                    },
                };

                await content[project_status]();
            }

            /**
             * Stores payment records for a project by sending a POST request to the server.
             *
             * @param {number} project_id - The ID of the project for which payment records are being stored.
             * @return {void}
             */
            async function storePaymentRecords(project_id) {
                const formData =
                    $('#paymentForm').serialize() + '&project_id=' + project_id;

                try {
                    const response = await $.ajax({
                        type: 'POST',
                        url: DASHBBOARD_TAB_ROUTE.STORE_PAYMENT_RECORDS,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                        data: formData,
                    });

                    await getPaymentHistoryAndCalculation(
                        project_id,
                        getAmountRefund(),
                        PaymentHistoryDataTable
                    );
                    hideProcessToast();
                    setTimeout(() => {
                        showToastFeedback('text-bg-success', response.message);
                    }, 500);
                } catch (error) {
                    hideProcessToast();
                    setTimeout(() => {
                        showToastFeedback(
                            'text-bg-danger',
                            error.responseJSON.message
                        );
                    }, 200);
                }
            }

            /**
             * Updates the payment records for a project by sending a PUT request to the server.
             *
             * @return {void}
             */
            async function update_payment_records() {
                try {
                    const project_id = $('#ProjectID').val();
                    const transaction_id = $('#TransactionID').val();
                    const formData = $('#paymentForm').serialize();
                    const response = await $.ajax({
                        type: 'PUT',
                        url: DASHBBOARD_TAB_ROUTE.UPDATE_PAYMENT_RECORDS.replace(
                            ':transaction_id',
                            transaction_id
                        ),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                        data: formData + '&project_id=' + project_id,
                    });

                    await getPaymentHistoryAndCalculation(
                        project_id,
                        getAmountRefund(),
                        PaymentHistoryDataTable
                    );
                    hideProcessToast();
                    setTimeout(() => {
                        showToastFeedback('text-bg-success', response.message);
                    }, 500);
                } catch (error) {
                    hideProcessToast();
                    showToastFeedback(
                        'text-bg-danger',
                        error.responseJSON.message
                    );
                }
            }

            //TODO: refactor this method in the future
            /**
             * Event listener for the submit payment button click event.
             *
             * Handles the submission of payment records based on the submission method.
             * If the submission method is 'add', it calls the storePaymentRecords function.
             * If the submission method is 'update', it calls the update_payment_records function.
             *
             * @param {Event} event - The click event triggered by the submit payment button.
             */
            $('#submitPayment').on('click', async function () {
                const submissionMethod = $(this).attr('data-submissionmethod');

                closeModal('#paymentModal');
                const isConfirmed = await createConfirmationModal({
                    title: 'Save Payment Record',
                    titleBg: 'bg-primary',
                    message:
                        'Are you sure you want to save this payment record?',
                    confirmText: 'Yes',
                    confirmButtonClass: 'btn-primary',
                    cancelText: 'No',
                });

                if (!isConfirmed) {
                    return;
                }
                showProcessToast();

                if (submissionMethod === 'add') {
                    const project_id = $('#ProjectID').val();
                    if (project_id) {
                        storePaymentRecords(project_id);
                    } else {
                        console.error('Project ID is null');
                    }
                } else if (submissionMethod === 'update') {
                    update_payment_records();
                } else {
                    console.error('Submission method is not defined');
                }
            });

            async function getUploadedReceipts(projectId) {
                try {
                    const response = await $.ajax({
                        type: 'GET',
                        url: DASHBBOARD_TAB_ROUTE.GET_UPLOADED_RECEIPTS.replace(
                            ':project_id',
                            projectId
                        ),
                    });

                    UploadedReceiptDataTable.clear();
                    UploadedReceiptDataTable.rows.add(
                        response.map((receipt) => [
                            `${receipt.receipt_name}
                    <input type="hidden" class="receipt_id" value="${receipt.id}">
                    <input type="hidden" class="receipt_description" value="${receipt.receipt_description}">
                    `,
                            `<img src="data:image/png;base64,${receipt.receipt_image}" alt="${receipt.receipt_name}" style="max-width: 100px; max-height: 100px;">`,
                            customDateFormatter(receipt.created_at),
                            `<span class="badge ${
                                receipt.remark === 'Pending'
                                    ? 'bg-info'
                                    : receipt.remark === 'Approved'
                                      ? 'bg-success'
                                      : receipt.remark === 'Rejected'
                                        ? 'bg-danger'
                                        : ''
                            }">${receipt.remark}</span>
                      <input type="hidden" class="comment" value="${
                          receipt.comment
                      }">`,
                            `<button class="btn btn-primary btn-sm viewReceipt" data-receipt-id="${receipt.ongoing_project_id}">View</button>`,
                        ])
                    );
                    UploadedReceiptDataTable.draw();
                } catch (error) {
                    throw new Error(
                        'Error fetching uploaded receipts: ' + error
                    );
                }
            }

            $('#paymentModal').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget);
                const action = button.data('action');

                const modal = $(this);
                const modalTitle = modal.find('.modal-title');
                const submitButton = modal.find('#submitPayment');

                if (action === 'Add') {
                    modalTitle.text('Add Payment');
                    submitButton.text('Add Payment');
                    submitButton.attr('data-submissionMethod', 'add');
                } else if (action === 'Update') {
                    modalTitle.text('Update Payment');
                    submitButton.text('Update Payment');
                    submitButton.attr('data-submissionMethod', 'update');
                    retrieve_the_selected_record_TO_UPDATE(
                        button.closest('tr')
                    );
                }
            });

            //TODO: refactor this function in the future
            function retrieve_the_selected_record_TO_UPDATE(selected_row) {
                const selected_transaction_id = selected_row
                    .find('td:eq(0)')
                    .text()
                    .trim();
                const selected_amount = selected_row
                    .find('td:eq(1)')
                    .text()
                    .trim();
                const selected_payment_method = selected_row
                    .find('td:eq(2)')
                    .text()
                    .trim();
                const selected_payment_status = selected_row
                    .find('td:eq(3)')
                    .text()
                    .trim();

                $('#TransactionID').val(selected_transaction_id);
                $('#paymentAmount').val(selected_amount);
                $('#paymentMethod').val(selected_payment_method);
                $('#paymentStatus').val(selected_payment_status);
            }

            const ProjectLedgerInput = $('#projectLedgerLink');
            const ProjectLedgerSubmitBtn = $('#saveProjectLedgerLink');

            //TODO: refactor this function in the future
            ProjectLedgerSubmitBtn.on('click', function () {
                const project_id = $('#ProjectID').val();
                const ProjectLedgerLink = $('#projectLedgerLink').val();
                const action = $(this).attr('data-action');
                console.log(action);
                if (action === 'edit') {
                    ProjectLedgerInput.prop('readonly', false);
                    $(this).attr('data-action', 'save').text('Save');
                } else if (action === 'save') {
                    updateOrCreateProjectLedger(project_id, ProjectLedgerLink);
                } else {
                    console.error('Action is not defined');
                }
            });

            const updateOrCreateProjectLedger = async (
                project_id,
                ProjectLedgerLink
            ) => {
                try {
                    const response = await $.ajax({
                        type: 'PUT',
                        url: DASHBBOARD_TAB_ROUTE.UPDATE_OR_CREATE_PROJECT_LEDGER,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                        data: {
                            project_id: project_id,
                            project_ledger_link: ProjectLedgerLink,
                        },
                    });
                    showToastFeedback('text-bg-success', response.message);
                    getProjectLedger(project_id);
                } catch (error) {
                    showToastFeedback(
                        'text-bg-danger',
                        error.responseJSON.message
                    );
                }
            };

            const getProjectLedger = async (project_id) => {
                try {
                    const response = await $.ajax({
                        type: 'GET',
                        url: DASHBBOARD_TAB_ROUTE.GET_PROJECT_LEDGER.replace(
                            ':project_id',
                            project_id
                        ),
                    });
                    response
                        ? (ProjectLedgerSubmitBtn.text('Edit').attr(
                              'data-action',
                              'edit'
                          ),
                          ProjectLedgerInput.prop('readonly', true))
                        : ProjectLedgerSubmitBtn.text('Save').attr(
                              'data-action',
                              'save'
                          );
                    ProjectLedgerInput.val(response.project_ledger_link);
                } catch (error) {
                    throw new Error('Error fetching project ledger: ' + error);
                }
            };

            $('#handledProjectTableBody').on(
                'click',
                '.handleProjectbtn',
                function () {
                    const handledProjectRow = $(this).closest('tr');
                    const hiddenInputs = handledProjectRow.find(
                        'input[type="hidden"]'
                    );
                    const offCanvaReadonlyInputs = $('#handleProjectOff').find(
                        'input, #FundedAmount'
                    );

                    // Cache values from the row
                    const project_status = handledProjectRow
                        .find('td:eq(5)')
                        .text()
                        .trim();
                    const project_id = handledProjectRow
                        .find('td:eq(0)')
                        .text()
                        .trim();
                    const projectTitle = handledProjectRow
                        .find('td:eq(1)')
                        .text()
                        .trim();
                    const firmName = handledProjectRow
                        .find('td:eq(2) p.firm_name')
                        .text()
                        .trim();
                    const cooperatorName = handledProjectRow
                        .find('td:eq(3) p.owner_name')
                        .text()
                        .trim();

                    // Cache hidden input values
                    const business_id = hiddenInputs
                        .filter('.business_id')
                        .val();
                    const birthDate = new Date(
                        hiddenInputs.filter('.birth_date').val()
                    );
                    const dateApplied = hiddenInputs
                        .filter('.dateApplied')
                        .val();
                    const sex = hiddenInputs.filter('.sex').val();
                    const landline = hiddenInputs.filter('.landline').val();
                    const mobilePhone = hiddenInputs
                        .filter('.mobile_phone')
                        .val();
                    const email = hiddenInputs.filter('.email').val();
                    const enterpriseType = hiddenInputs
                        .filter('.business_enterprise_type')
                        .val();
                    const enterpriseLevel = hiddenInputs
                        .filter('.business_enterprise_level')
                        .val();
                    const buildingAsset = parseFloat(
                        hiddenInputs.filter('.building_value').val()
                    );
                    const equipmentAsset = parseFloat(
                        hiddenInputs.filter('.equipment_value').val()
                    );
                    const workingCapitalAsset = parseFloat(
                        hiddenInputs.filter('.working_capital').val()
                    );
                    const approved_amount = hiddenInputs
                        .filter('.approved_amount')
                        .val();
                    const actual_amount = hiddenInputs
                        .filter('.actual_amount')
                        .val();

                    // Calculate age
                    const age = Math.floor(
                        (new Date() - birthDate) /
                            (365.25 * 24 * 60 * 60 * 1000)
                    );

                    // Update form fields
                    offCanvaReadonlyInputs
                        .filter('#hiddenbusiness_id')
                        .val(business_id);
                    offCanvaReadonlyInputs.filter('#age').val(age);
                    offCanvaReadonlyInputs.filter('#ProjectID').val(project_id);
                    offCanvaReadonlyInputs
                        .filter('#ProjectTitle')
                        .val(projectTitle);
                    offCanvaReadonlyInputs
                        .filter('#ApprovedAmount')
                        .val(
                            formatNumberToCurrency(parseFloat(approved_amount))
                        );
                    offCanvaReadonlyInputs
                        .filter('#appliedDate')
                        .val(customDateFormatter(dateApplied));
                    offCanvaReadonlyInputs.filter('#FirmName').val(firmName);
                    offCanvaReadonlyInputs
                        .filter('#CooperatorName')
                        .val(cooperatorName);
                    offCanvaReadonlyInputs.filter('#sex').val(sex);
                    offCanvaReadonlyInputs.filter('#landline').val(landline);
                    offCanvaReadonlyInputs
                        .filter('#mobilePhone')
                        .val(mobilePhone);
                    offCanvaReadonlyInputs.filter('#email').val(email);
                    offCanvaReadonlyInputs
                        .filter('#enterpriseType')
                        .val(enterpriseType);
                    offCanvaReadonlyInputs
                        .filter('#EnterpriseLevel')
                        .val(enterpriseLevel);
                    offCanvaReadonlyInputs
                        .filter('#buildingAsset')
                        .val(formatNumberToCurrency(buildingAsset));
                    offCanvaReadonlyInputs
                        .filter('#equipmentAsset')
                        .val(formatNumberToCurrency(equipmentAsset));
                    offCanvaReadonlyInputs
                        .filter('#workingCapitalAsset')
                        .val(formatNumberToCurrency(workingCapitalAsset));

                    offCanvaReadonlyInputs
                        .filter('#FundedAmount')
                        .text(
                            formatNumberToCurrency(parseFloat(actual_amount))
                        );

                    handleProjectOffcanvasContent(project_status);
                    getPaymentHistoryAndCalculation(
                        project_id,
                        actual_amount,
                        PaymentHistoryDataTable
                    );
                    getUploadedReceipts(project_id);
                    getProjectLedger(project_id);
                    getProjectLinks(project_id);
                    getQuarterlyReports(project_id);
                    getAvailableQuarterlyReports(project_id);
                }
            );

            const getAmountRefund = () => {
                const actual_amount = $('#FundedAmount').text();
                return actual_amount;
            };

            /**
             * Calculates and displays payment statistics for a project.
             *
             * @async
             * @param {number|string} project_id - The project identifier
             * @param {string} actual_amount - Total funded amount (currency string)
             * @param {DataTable.Api} paymentDataTableInstance - DataTable for payment history
             * @throws {Error} If payment history fetch fails
             *
             * @description
             * Fetches payment history, calculates statistics (total paid, remaining balance,
             * completion percentage), and updates the UI with payment information and progress.
             */
            const getPaymentHistoryAndCalculation = async (
                project_id,
                actual_amount,
                paymentDataTableInstance
            ) => {
                try {
                    const totalAmount = await getProjectPaymentHistory(
                        project_id,
                        paymentDataTableInstance,
                        true
                    );

                    const fundedAmount = parseFloat(
                        actual_amount.replace(/,/g, '')
                    );
                    const remainingAmount = fundedAmount - totalAmount;
                    const percentage = Math.round(
                        (totalAmount / fundedAmount) * 100
                    );
                    $('#totalPaid').text(formatNumberToCurrency(totalAmount));
                    $('#remainingBalance').text(
                        formatNumberToCurrency(remainingAmount)
                    );

                    percentage == 100
                        ? isRefundCompleted(true)
                        : isRefundCompleted(false);
                    setTimeout(() => {
                        InitializeviewCooperatorProgress(percentage);
                    }, 500);
                } catch (error) {
                    throw new Error('Error fetching payment history: ' + error);
                }
            };

            const RequirementContainer = $('#RequirementContainer');

            const uploadFileRequirements =
                document.getElementById('requirements_file');

            //TODO: use reuseable filepond form the Utilities js folder
            const FilePondInstance = FilePond.create(uploadFileRequirements, {
                allowMultiple: false,
                allowFileTypeValidation: true,
                allowFileSizeValidation: true,
                acceptedFileTypes: ['application/pdf', 'image/*'],
                allowRevert: true,
                maxFileSize: '10MB',
                server: {
                    process: {
                        url: '/FileRequirementsUpload',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                        onload: (response) => {
                            const data = JSON.parse(response);
                            if (data.unique_id && data.file_path) {
                                uploadFileRequirements.setAttribute(
                                    'data-unique_id',
                                    data.unique_id
                                );
                                uploadFileRequirements.setAttribute(
                                    'data-file_path',
                                    data.file_path
                                );
                            }
                            return data.unique_id;
                        },
                        onerror: (error) => {
                            console.error(error);
                        },
                    },
                    revert: (load, error) => {
                        const unique_id =
                            uploadFileRequirements.getAttribute(
                                'data-unique_id'
                            );
                        const file_path =
                            uploadFileRequirements.getAttribute(
                                'data-file_path'
                            );
                        if (unique_id && file_path) {
                            try {
                                const response = fetch(
                                    `/FileRequirementsRevert/${unique_id}`,
                                    {
                                        method: 'DELETE',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': $(
                                                'meta[name="csrf-token"]'
                                            ).attr('content'),
                                        },
                                        body: JSON.stringify({
                                            unique_id: unique_id,
                                            file_path: file_path,
                                        }),
                                    }
                                );
                                if (response.ok) {
                                    load();
                                } else {
                                    error();
                                }
                            } catch (error) {
                                error();
                            }
                        }
                    },
                },
            });

            //link validation
            RequirementContainer.on(
                'blur',
                'input[name="requirements_link"]',
                async function () {
                    const linkConstInstance = $(this).closest('.linkContainer');
                    const inputField = $(this);
                    const inputtedLink = $(this).val();
                    const proxyUrl = `/proxy?url=${encodeURIComponent(
                        inputtedLink
                    )}`;

                    if (inputtedLink) {
                        const spinner = `<div class="spinner-border spinner-border-sm text-primary ms-3" role="status" style="width: 1rem; height: 1rem; border-width: 2px; border-radius: 50%;">
                        <span class="visually-hidden"></span>
                    </div>`;

                        inputField.after(spinner);
                        try {
                            const response = await fetch(proxyUrl);
                            const data = await response.json();
                            if (data.status === 200) {
                                linkConstInstance
                                    .find('input[name="requirements_link"]')
                                    .addClass('is-valid')
                                    .removeClass('is-invalid');
                            } else {
                                linkConstInstance
                                    .find('input[name="requirements_link"]')
                                    .addClass('is-invalid')
                                    .removeClass('is-valid');
                            }
                        } catch (error) {
                            console.error('Error fetching the link:', error);
                            linkConstInstance
                                .find('input[name="requirements_link"]')
                                .addClass('is-invalid')
                                .removeClass('is-valid');
                            throw new Error(
                                'Error fetching the link: ' + error
                            );
                        } finally {
                            linkConstInstance.find('.spinner-border').remove();
                        }
                    } else {
                        linkConstInstance
                            .find('input[name="requirements_link"]')
                            .removeClass(['is-valid', 'is-invalid']);
                    }
                }
            );

            const getProjectLinks = async (Project_id) => {
                try {
                    const response = await $.ajax({
                        type: 'GET',
                        url:
                            DASHBBOARD_TAB_ROUTE.GET_PROJECT_LINKS +
                            '?project_id=' +
                            Project_id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                    });
                    ProjectFileLinkDataTable.clear();
                    ProjectFileLinkDataTable.rows.add(
                        response.map((link) => {
                            // For internal files, create a route to view the file using its ID
                            const viewButton = link.is_external
                                ? link.file_link.match(/^https?:\/\//i)
                                    ? `<a class="btn btn-outline-primary btn-sm" target="_blank" href="${link.file_link}"><i class="ri-eye-fill"></i></a>`
                                    : `<a class="btn btn-outline-primary btn-sm" target="_blank" href="https://${link.file_link}"><i class="ri-eye-fill"></i></a>`
                                : `<a class="btn btn-outline-primary btn-sm" target="_blank" href="/view-project-file/${link.id}"><i class="ri-eye-fill"></i></a>`;

                            return [
                                `${link.file_name}
                       <input type="hidden" class="linkID" value="${link.id}">`,
                                link.file_link,
                                customDateFormatter(link.created_at),
                                `${viewButton}
                        <button class="btn btn-primary btn-sm updateLinkRecord" data-is-external="${link.is_external}" data-bs-toggle="modal" data-bs-target="#projectLinkModal"><i class="ri-pencil-fill"></i></button>
                        <button class="btn btn-danger btn-sm deleteRecord" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" data-delete-record-type="projectLink"> <i class="ri-delete-bin-6-fill"></i></button>`,
                            ];
                        })
                    );
                    ProjectFileLinkDataTable.draw();
                } catch (error) {
                    showToastFeedback(
                        'text-bg-danger',
                        error?.responseJSON.message
                    );
                    throw new Error('Error fetching project links: ' + error);
                }
            };

            const SaveProjectFileLinks = async (projectID, action) => {
                try {
                    showProcessToast('Saving Project Link...');
                    let requirementLinks = {};
                    const linkContainer =
                        RequirementContainer.find('.linkContainer');
                    linkContainer.each(function () {
                        let name = $(this)
                            .find('input[name="requirements_name"]')
                            .val();
                        let link = $(this)
                            .find('input[name="requirements_link"]')
                            .val();
                        requirementLinks[name] = link;
                    });

                    const response = await $.ajax({
                        type: 'POST',
                        url: DASHBBOARD_TAB_ROUTE.STORE_PROJECT_FILES,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                        data: {
                            action: action,
                            project_id: projectID,
                            linklist: requirementLinks,
                        },
                    });

                    getProjectLinks(projectID);
                    closeModal('#requirementModal');
                    hideProcessToast();
                    showToastFeedback('text-bg-success', response.message);
                } catch (error) {
                    hideProcessToast();
                    showToastFeedback(
                        'text-bg-danger',
                        error.responseJSON.message
                    );
                }
            };
            const SaveProjectFile = async (projectID, action, businesID) => {
                try {
                    showProcessToast('Saving Project File...');
                    const name = $('#requirements_file_name').val();
                    const file_path =
                        uploadFileRequirements.getAttribute('data-file_path');
                    const response = await $.ajax({
                        type: 'POST',
                        url: DASHBBOARD_TAB_ROUTE.STORE_PROJECT_FILES,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                        data: {
                            action: action,
                            business_id: businesID,
                            project_id: projectID,
                            name: name,
                            file_path: file_path,
                        },
                    });
                    getProjectLinks(projectID);
                    closeModal('#requirementModal');
                    hideProcessToast();
                    showToastFeedback('text-bg-success', response.message);
                    toggleRequirementUploadType();
                } catch (error) {
                    hideProcessToast();
                    showToastFeedback(
                        'text-bg-danger',
                        error.responseJSON.message
                    );
                }
            };

            //Save the inputted links to the database
            $('button[data-selected-action]')
                .off('click')
                .on('click', async function () {
                    let action = $(this).attr('data-selected-action');
                    const projectID = $('#ProjectID').val();
                    const businesID = $('input#hiddenbusiness_id').val();

                    const isConfirmed = await createConfirmationModal({
                        title: 'Save Requirements',
                        titleBg: 'bg-primary',
                        message:
                            'Are you sure you want to save this Requirements?',
                        confirmText: 'Yes',
                        confirmButtonClass: 'btn-primary',
                        cancelText: 'No',
                    });
                    if (!isConfirmed) {
                        return;
                    }
                    action === 'ProjectLink'
                        ? SaveProjectFileLinks(projectID, action)
                        : action === 'ProjectFile'
                          ? SaveProjectFile(projectID, action, businesID)
                          : null;
                });

            $('#UpdateProjectLink').on('click', async () => {
                try {
                    const projectID = $('#ProjectID').val();
                    const updatedProjectLinks =
                        $('#projectLinkForm').serialize();
                    const file_id = $('input#HiddenFileIDToUpdate').val();

                    const isConfirmed = await createConfirmationModal({
                        title: 'Update Requirements',
                        titleBg: 'bg-primary',
                        message:
                            'Are you sure you want to update this Requirements?',
                        confirmText: 'Yes',
                        confirmButtonClass: 'btn-primary',
                        cancelText: 'No',
                    });

                    if (!isConfirmed) {
                        return;
                    }

                    showProcessToast('Updating...');

                    const response = await $.ajax({
                        type: 'PUT',
                        url: DASHBBOARD_TAB_ROUTE.UPDATE_PROJECT_LINKS.replace(
                            ':file_id',
                            file_id
                        ),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                        data: updatedProjectLinks + '&project_id=' + projectID,
                    });

                    getProjectLinks(projectID);
                    closeModal('#projectLinkModal');
                    hideProcessToast();
                    showToastFeedback('text-bg-success', response.message);
                    toggleRequirementUploadType();
                } catch (error) {
                    hideProcessToast();
                    showToastFeedback(
                        'text-bg-danger',
                        error.responseJSON.message
                    );
                }
            });

            $('#projectLinkModal').on('show.bs.modal', function (event) {
                const triggeredbutton = $(event.relatedTarget);
                const selectedRow = triggeredbutton.closest('tr');
                const is_external = triggeredbutton.attr('data-is-external');
                console.log(is_external);

                const file_id = selectedRow.find('input.linkID').val();
                const projectName = selectedRow.find('td:eq(0)').text();
                const projectLink = selectedRow.find('td:eq(1)').text();

                const modal = $(this);
                modal.find('input#HiddenFileIDToUpdate').val(file_id);
                modal.find('input#HiddenProjectNameToUpdate').val(projectName);
                modal.find('input#projectNameUpdated').val(projectName);
                modal
                    .find('textarea#projectLink')
                    .val(projectLink)
                    .prop('readonly', is_external == '1' ? false : true);
            });

            //TODO: refactor this logic of this function
            // Function to toggle requirement upload type containers
            function toggleRequirementUploadType() {
                const uploadTypeRadios = $('[name="requirement_upload_type"]');
                const linkContainer = $('.linkContainer');
                const fileContainer = $('.FileContainer');
                const saveButton = $('button[data-selected-action]');

                // Remove any existing event listeners first
                uploadTypeRadios.off('change');

                // Reset containers and inputs to initial state
                linkContainer.show();
                fileContainer.hide();
                saveButton.attr('data-selected-action', 'ProjectLink');

                // Reset all inputs
                $('#requirements_name').val('');
                $('#requirements_link').val('');
                $('#requirements_file').val('');
                $('#requirements_file_name').val('');

                // Re-add event listeners
                uploadTypeRadios.on('change', function () {
                    if (this.value === 'link') {
                        linkContainer.show();
                        fileContainer.hide();

                        // Reset file input
                        $('#requirements_file').val('');
                        $('#requirements_file_name').val('');

                        // Update save button action
                        saveButton.attr('data-selected-action', 'ProjectLink');
                    } else {
                        linkContainer.hide();
                        fileContainer.show();

                        // Reset link inputs
                        $('#requirements_name').val('');
                        $('#requirements_link').val('');

                        // Update save button action
                        saveButton.attr('data-selected-action', 'ProjectFile');
                    }
                });

                // Add event listener to file input to update file name
                $('#requirements_file')
                    .off('change')
                    .on('change', function (e) {
                        const fileName = e.target.files[0]
                            ? e.target.files[0].name
                            : '';
                        $('#requirements_file_name').val(fileName);
                    });
            }

            toggleRequirementUploadType();

            /**
             * Event listener for showing the delete confirmation modal.
             *
             * This listener triggers when the '#deleteRecordModal' modal is shown. It dynamically populates
             * the modal's content based on the type of record to be deleted. The record type and associated data are
             * determined by the `getRecordData` function. It also attaches a click handler (`handleDeleteClick`) to the
             * modal's delete button, which is responsible for sending the DELETE request to the server.
             *
             * @event show.bs.modal
             * @param {Event} event - The event object triggered when the modal is shown.
             * @listens show.bs.modal - Listens for the Bootstrap modal 'show' event.
             *
             * @property {jQuery} modal - The jQuery object representing the modal element.
             * @property {jQuery} triggeredDeleteButton - The button element that triggered the modal.
             * @property {jQuery} recordRow - The table row (`<tr>`) element associated with the record to be deleted.
             * @property {string} action - The type of record to delete (e.g., 'projectPayment', 'projectLink', 'quarterlyRecord').
             *
             * @see getRecordData
             * @see handleDeleteClick
             */
            $('#deleteRecordModal').on('show.bs.modal', function (event) {
                const modal = $(this);
                const triggeredDeleteButton = $(event.relatedTarget);
                const recordRow = triggeredDeleteButton.closest('tr');
                const action = triggeredDeleteButton.data('delete-record-type');

                const recordData = getRecordData(
                    action,
                    recordRow,
                    triggeredDeleteButton
                );

                // Update modal content
                modal.find('.modal-body').html(recordData.message);
                modal
                    .find('#deleteRecord')
                    .attr('data-record-to-delete', recordData.recordType)
                    .attr('data-unique-val', recordData.uniqueVal)
                    .off('click') // Remove previous click handlers
                    .on('click', handleDeleteClick.bind(modal, recordData));
            });

            /**
             * Retrieves data for the delete confirmation modal based on the specified action.
             *
             * This function determines the appropriate message, record type, unique identifier, delete route, and
             * after-delete action based on the provided `action`. It uses an object-based lookup (`recordTypes`) to
             * store the specific logic for each supported action type.
             *
             * @param {string} action - The type of record to be deleted (e.g., 'projectPayment', 'projectLink', 'quarterlyRecord').
             * @param {jQuery} recordRow - The table row (`<tr>`) element associated with the record.
             * @param {jQuery} triggeredDeleteButton - The button element that triggered the modal.
             *
             * @returns {{message: string, recordType: string, uniqueVal: string, deleteRoute: function, afterDelete: function}}
             *   An object containing the following properties:
             *   - `message`: The message to be displayed in the modal body.
             *   - `recordType`: The type of record being deleted (used for the `data-record-to-delete` attribute).
             *   - `uniqueVal`: The unique identifier of the record (used for the `data-unique-val` attribute and the delete route).
             *   - `deleteRoute`: A function that takes the `uniqueVal` and returns the URL for the DELETE request.
             *   - `afterDelete`: A function to be executed after a successful deletion, typically for UI updates.
             *
             * @throws {Error} Throws an error if an unknown action is provided.
             */
            function getRecordData(action, recordRow, triggeredDeleteButton) {
                const recordTypes = {
                    projectPayment: {
                        getMessage: () => {
                            const paymentTransactionID = recordRow
                                .find('td:eq(0)')
                                .text();
                            const paymentAmount = recordRow
                                .find('td:eq(1)')
                                .text();
                            return `Are you sure you want to delete this transaction <strong>${paymentTransactionID}</strong> with amount of <strong>${paymentAmount}</strong>?`;
                        },
                        recordType: 'paymentRecord',
                        getUniqueVal: () => recordRow.find('td:eq(0)').text(),
                        getDeleteRoute: (uniqueVal) =>
                            DASHBBOARD_TAB_ROUTE.DELETE_PAYMENT_RECORDS.replace(
                                ':transaction_id',
                                uniqueVal
                            ),
                        afterDelete: async (project_id) =>
                            await getPaymentHistoryAndCalculation(
                                project_id,
                                getAmountRefund(),
                                PaymentHistoryDataTable
                            ),
                    },
                    projectLink: {
                        getMessage: () => {
                            const fileId = recordRow.find('input.linkID').val();
                            const projectName = recordRow
                                .find('td:eq(0)')
                                .text();
                            const projectLink = recordRow
                                .find('td:eq(1)')
                                .text();
                            return `Are you sure you want to delete this link <a href="${projectLink}" target="_blank">${projectLink}</a> with a file named ${projectName}?`;
                        },
                        recordType: 'projectLinkRecord',
                        getUniqueVal: () =>
                            recordRow.find('input.linkID').val(),
                        getDeleteRoute: (uniqueVal) =>
                            DASHBBOARD_TAB_ROUTE.DELETE_PROJECT_LINK.replace(
                                ':file_id',
                                uniqueVal
                            ),
                        afterDelete: async (project_id) =>
                            await getProjectLinks(project_id),
                    },
                    quarterlyRecord: {
                        getMessage: () => {
                            const quarterPeriod = recordRow
                                .find('td:eq(0)')
                                .text();
                            return `Are you sure you want to delete this quarterly record <strong>${quarterPeriod}</strong>?`;
                        },
                        recordType: 'quarterlyRecord',
                        getUniqueVal: () =>
                            triggeredDeleteButton.data('record-id'),
                        getDeleteRoute: (uniqueVal) =>
                            DASHBBOARD_TAB_ROUTE.DELETE_QUARTERLY_REPORT.replace(
                                ':record_id',
                                uniqueVal
                            ),
                        afterDelete: async (project_id) =>
                            await getQuarterlyReports(project_id),
                    },
                };

                const recordType = recordTypes[action];
                if (!recordType) {
                    console.error('Unknown action:', action);
                    throw new Error('Unknown action: ' + action);
                }

                return {
                    message: recordType.getMessage(),
                    recordType: recordType.recordType,
                    uniqueVal: recordType.getUniqueVal(),
                    deleteRoute: recordType.getDeleteRoute,
                    afterDelete: recordType.afterDelete,
                };
            }

            /**
             * Handles the click event on the delete button within the confirmation modal.
             *
             * This function sends an AJAX DELETE request to the server to delete the specified record. The URL for the
             * request is determined by the `deleteRoute` function within the `recordData` object. After a successful
             * deletion, it calls the `afterDelete` function, also provided by `recordData`, to perform any necessary UI
             * updates. It also handles displaying success or error messages using toast notifications and closes the modal.
             *
             * @async
             * @function handleDeleteClick
             * @this {jQuery} - The modal element, bound using `bind` in the event listener.
             * @param {{message: string, recordType: string, uniqueVal: string, deleteRoute: function, afterDelete: function}} recordData -
             *   The data object for the record to be deleted, obtained from `getRecordData`.
             *
             * @property {string} uniqueVal - The unique identifier of the record to be deleted, extracted from the modal's data attribute.
             * @property {function} deleteRouteFn - The function to generate the delete route URL.
             * @property {function} afterDeleteFn - The function to be called after a successful deletion.
             * @property {string} deleteRoute - The generated URL for the DELETE request.
             * @property {string} project_id - The ID of the project, extracted from the '#ProjectID' element.
             *
             * @fires $.ajax DELETE - Sends a DELETE request to the server to delete the specified record.
             *
             * @returns {Promise<void>} A promise that resolves when the delete operation is complete.
             */
            async function handleDeleteClick(recordData) {
                const modal = this; // 'this' is bound to the modal
                const uniqueVal = $(modal)
                    .find('#deleteRecord')
                    .attr('data-unique-val');
                const deleteRouteFn = recordData.deleteRoute;
                const afterDeleteFn = recordData.afterDelete;
                const deleteRoute = deleteRouteFn(uniqueVal);

                showProcessToast('Deleting Record...');

                try {
                    const project_id = $('#ProjectID').val();
                    const response = await $.ajax({
                        type: 'DELETE',
                        url: deleteRoute,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                    });

                    hideProcessToast();
                    showToastFeedback('text-bg-success', response.message);
                    closeModal('#deleteRecordModal');
                    modal.hide();

                    if (afterDeleteFn) {
                        await afterDeleteFn(project_id);
                    }
                } catch (error) {
                    hideProcessToast();
                    showToastFeedback(
                        'text-bg-danger',
                        error.responseJSON.message
                    );
                }
            }

            const projectStateBtn = $('.updateProjectState');

            //Cooperator Payment Progress
            projectStateBtn.on('click', async function () {
                const action = $(this).data('project-state');
                const projectID = $('#ProjectID').val();
                const businessID = $('#hiddenbusiness_id').val();
                try {
                    const response = await $.ajax({
                        type: 'PUT',
                        url: DASHBBOARD_TAB_ROUTE.UPDATE_PROJECT_STATE,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                        data: {
                            action: action,
                            project_id: projectID,
                            business_id: businessID,
                        },
                    });
                    const data = await response;
                    showToastFeedback('text-bg-success', data.message);
                } catch (error) {
                    showToastFeedback(
                        'text-bg-danger',
                        error.responseJSON.message
                    );
                }
            });

            let paymentProgress;

            function InitializeviewCooperatorProgress(percentage) {
                const options = {
                    series: [percentage],
                    chart: {
                        type: 'radialBar',
                        width: '100%',
                        height: '200px',
                        sparkline: {
                            enabled: true,
                        },
                    },
                    colors: ['#00D8B6'],
                    plotOptions: {
                        radialBar: {
                            startAngle: -90,
                            endAngle: 90,
                            track: {
                                background: '#e7e7e7',
                                strokeWidth: '97%',
                                margin: 5, // margin is in pixels
                                dropShadow: {
                                    enabled: true,
                                    top: 2,
                                    left: 0,
                                    color: '#999',
                                    opacity: 1,
                                    blur: 2,
                                },
                            },
                            dataLabels: {
                                name: {
                                    show: false,
                                },
                                value: {
                                    offsetY: -2,
                                    fontSize: '22px',
                                },
                            },
                        },
                    },
                    grid: {
                        padding: {
                            top: -10,
                        },
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'light',
                            shadeIntensity: 0.4,
                            inverseColors: false,
                            opacityFrom: 1,
                            opacityTo: 1,
                            stops: [0, 50, 53, 91],
                        },
                    },
                    labels: ['Average Results'],
                };

                if (paymentProgress) {
                    paymentProgress.destroy();
                }

                paymentProgress = new ApexCharts(
                    document.querySelector('#progressPercentage'),
                    options
                );
                paymentProgress.render();
            }

            /**
             * This function sends an AJAX request to the server to get the available
             * quarterly reports for the given project_id. The server will return a
             * list of available quarterly reports in the form of a select field. The
             * function will then append the received response to the appropriate
             * element on the page.
             *
             * @param {string} Project_id - the id of the project
             *
             * @returns {Promise<void>}
             */
            const getAvailableQuarterlyReports = async (Project_id) => {
                try {
                    const QuarterlySelector = $('#Select_quarter_to_Generate');
                    QuarterlySelector.empty();
                    const response = await $.ajax({
                        type: 'GET',
                        url: GENERATE_SHEETS_ROUTE.GET_AVAILABLE_QUARTERLY_REPORT.replace(
                            ':project_id',
                            Project_id
                        ),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                    });
                    if (response && response.html) {
                        QuarterlySelector.append(response.html);
                    }
                } catch (error) {
                    throw new Error(
                        'Error fetching quarterly reports: ' + error
                    );
                }
            };

            const FormDocumentContainer = $('#SheetFormDocumentContainer');

            const GET_PROJECT_SHEET_FORM = async (
                formType,
                Project_id,
                QuartertoUsed = null
            ) => {
                const isConfirmed = await createConfirmationModal({
                    title: 'Retrieve Selected Form',
                    titleBg: 'bg-primary',
                    message: 'Are you sure you want to Retrieve this form?',
                    confirmText: 'Yes',
                    confirmButtonClass: 'btn-primary',
                    cancelText: 'No',
                });
                if (!isConfirmed) {
                    return;
                }
                showProcessToast('Retrieving Form...');
                try {
                    const response = await $.ajax({
                        type: 'GET',
                        url: GENERATE_SHEETS_ROUTE.GET_PROJECT_SHEET_FORM.replace(
                            ':type',
                            formType
                        )
                            .replace(':project_id', Project_id)
                            .replace(
                                ':quarter_of',
                                QuartertoUsed ? QuartertoUsed : ''
                            ),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                    });
                    hideProcessToast();
                    toggleDocumentSelector();
                    if (!response) {
                        throw new Error('No response received');
                    }
                    FormDocumentContainer.append(response);
                } catch (error) {
                    hideProcessToast();
                    throw new Error(
                        'Error fetching project sheet form: ' +
                            error.responseJSON.message
                    );
                }
            };

            FormDocumentContainer.on(
                'click',
                'button[data-form-type]',
                async function () {
                    try {
                        cleanupFormHandlers();
                        const formType = $(this).data('form-type');
                        const Project_id = $('#ProjectID').val();
                        const QuartertoUsed = $(
                            '#Select_quarter_to_Generate'
                        ).val();
                        await GET_PROJECT_SHEET_FORM(
                            formType,
                            Project_id,
                            QuartertoUsed
                        );
                        // Initialize form events if not already initialized

                        window.formEvents = {
                            [formType]: new FormEvents(formType),
                        };
                        // Initialize signature handler if not already initialized
                        window.esignatureHandler = new EsignatureHandler(
                            '#esignature-section'
                        );
                    } catch (error) {
                        showToastFeedback('text-bg-danger', error);
                    }
                }
            );
            const cleanupFormHandlers = () => {
                // Cleanup form events
                if (window.formEvents) {
                    Object.keys(window.formEvents).forEach((key) => {
                        // Add any cleanup needed for FormEvents
                        delete window.formEvents[key];
                    });
                    delete window.formEvents;
                }

                // Cleanup signature handler
                if (window.esignatureHandler) {
                    if (Array.isArray(window.esignatureHandler.signaturePads)) {
                        window.esignatureHandler.signaturePads.forEach(
                            (pad) => {
                                if (pad && typeof pad.clear === 'function') {
                                    pad.clear();
                                }
                            }
                        );
                    }
                    delete window.esignatureHandler;
                }
            };

            //TODO: Make this reusable and efficient

            /**
             * Attaches a click event listener to non-active breadcrumb items within the #SheetFormDocumentContainer element.
             * When a non-active breadcrumb item is clicked, it removes the #PISFormContainer and #PDSFormContainer elements
             * and toggles the visibility of the document selector element (#selectDOC_toGenerate).
             *
             * @function
             * @name clickBreadcrumbItem
             * @memberof jQuery
             * @param {Event} event - The click event object.
             * @return {void}
             */
            FormDocumentContainer.on(
                'click',
                '.breadcrumb-item:not(.active) a',
                function () {
                    $(
                        '#PISFormContainer , #PDSFormContainer, #SRFormContainer'
                    ).remove();
                    toggleDocumentSelector();
                }
            );

            const toggleDocumentSelector = () =>
                $('#selectDOC_toGenerate').toggleClass('d-none');

            /**
             * Attaches a click event listener to elements with the class `ExportPDF` within the `#SheetFormDocumentContainer` element.
             *
             * @event click
             * @param {HTMLElement} element - The element that triggered the event.
             * @param {Event} e - The click event object.
             *
             * @description When clicked, this event listener generates a PDF based on the selected export type and opens it in a new browser tab.
             *
             * @fires requestDATA
             * @fires $.ajax
             *
             * @throws {Error} If there is an error generating the PDF.
             */
            async function handlePDFExport(e) {
                e.preventDefault();

                // Show confirmation modal
                const isconfirmed = await createConfirmationModal({
                    title: 'Export to PDF',
                    titleBg: 'bg-primary',
                    message: 'Are you sure you want to Export this to PDF?',
                    confirmText: 'Yes',
                    confirmButtonClass: 'btn-primary',
                    cancelText: 'No',
                });

                if (!isconfirmed) {
                    return;
                }
                showProcessToast('Generating PDF...');

                try {
                    // Get export type and route
                    const ExportPDF_BUTTON_DATA_VALUE =
                        $(this).attr('data-to-export');
                    const route_url = {
                        PIS: GENERATE_SHEETS_ROUTE.GENERATE_PROJECT_INFORMATION_SHEET,
                        PDS: GENERATE_SHEETS_ROUTE.GENERATE_DATA_SHEET_REPORT,
                        SR: GENERATE_SHEETS_ROUTE.GENERATE_STATUS_REPORT,
                    }[ExportPDF_BUTTON_DATA_VALUE];

                    // Get form data
                    const data = await requestDATA(ExportPDF_BUTTON_DATA_VALUE);
                    const esignatureObjects =
                        window.esignatureHandler.collectSignatures();

                    // Convert URL-encoded string to object
                    const params = new URLSearchParams(data);
                    const dataObject = Object.fromEntries(params);

                    // Add signatures to the object
                    dataObject.signatures = esignatureObjects;
                    // Make the request using jQuery ajax for better blob handling
                    const response = await $.ajax({
                        type: 'POST',
                        url: route_url,
                        data: dataObject,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                        xhrFields: {
                            responseType: 'blob',
                        },
                    });

                    // Check if response is JSON (error message)
                    const contentType = response.type;
                    if (contentType === 'application/json') {
                        // Read the blob as text to get error message
                        const reader = new FileReader();
                        reader.onload = function () {
                            const errorData = JSON.parse(this.result);
                            hideProcessToast();
                            showToastFeedback(
                                'text-bg-danger',
                                errorData.message || 'Failed to generate PDF'
                            );
                        };
                        reader.readAsText(response);
                        return;
                    }

                    // If we get here, it's a PDF response
                    const blob = new Blob([response], {
                        type: 'application/pdf',
                    });
                    const url = window.URL.createObjectURL(blob);

                    // Open PDF in new window
                    window.open(url, '_blank');

                    // Show success message
                    hideProcessToast();
                    showToastFeedback(
                        'text-bg-success',
                        'PDF generated successfully'
                    );

                    // Clean up the blob URL after a delay to ensure the PDF loads
                    setTimeout(() => {
                        window.URL.revokeObjectURL(url);
                    }, 1000);
                } catch (error) {
                    console.error('Error generating PDF:', error);

                    if (error.responseType === 'blob') {
                        // Handle blob error response
                        const reader = new FileReader();
                        reader.onload = function () {
                            try {
                                const errorData = JSON.parse(this.result);
                                hideProcessToast();
                                showToastFeedback(
                                    'text-bg-danger',
                                    errorData.message || 'Error generating PDF'
                                );
                            } catch (e) {
                                hideProcessToast();
                                showToastFeedback(
                                    'text-bg-danger',
                                    'An error occurred while generating the PDF'
                                );
                            }
                        };
                        reader.readAsText(error.response);
                    } else {
                        hideProcessToast();
                        showToastFeedback(
                            'text-bg-danger',
                            error.message ||
                                'An error occurred while generating the PDF'
                        );
                    }
                }
            }

            // Attach the event handler
            $('#SheetFormDocumentContainer')
                .off('click', '.ExportPDF')
                .on('click', '.ExportPDF', handlePDFExport);

            const ExportAndLocalProductsConfig = {
                localProduct: {
                    id: 'exportMarketTable',
                    selectors: {
                        productName: '.productName',
                        packingDetails: '.packingDetails',
                        volumeOfProduction: '.volumeOfProduction_val',
                        grossSales: '.grossSales_val',
                        productionCost: '.productionCost_val',
                        netSales: '.netSales_val',
                    },
                    requiredFields: ['productName'],
                },
                exportProduct: {
                    id: 'exportProductTable',
                    selectors: {
                        productName: '.productName',
                        packingDetails: '.packingDetails',
                        volumeOfProduction: '.volumeOfProduction_val',
                        grossSales: '.grossSales_val',
                        productionCost: '.productionCost_val',
                        netSales: '.netSales_val',
                    },
                    requiredFields: ['productName'],
                },
            };

            const ExpectedAndActualOutputTableConfig = {
                ExpectedAndActualData: {
                    id: 'expectedAndActualTable',
                    selectors: {
                        expectedOutput: '.expectedOutput',
                        actualAccomplishment: '.actualAccomplishment',
                        remarksJustification: '.remarksJustification',
                    },
                    requiredFields: [
                        'expectedOutput',
                        'actualAccomplishment',
                        'remarksJustification',
                    ],
                },
            };

            const EquipmentTableConfig = {
                EquipmentData: {
                    id: 'equipmentTable',
                    selectors: {
                        Approved: {
                            qty: '.approved_qty',
                            particulars: '.approved_particulars',
                            cost: '.approved_cost',
                        },
                        Actual: {
                            qty: '.actual_qty',
                            particulars: '.actual_particulars',
                            cost: '.actual_cost',
                        },
                        acknowledgement: '.acknowledgement',
                        remarks: '.remarks',
                    },
                    requiredFields: [
                        'Approved.qty',
                        'Approved.particulars',
                        'Approved.cost',
                        'Actual.qty',
                        'Actual.particulars',
                        'Actual.cost',
                        'acknowledgement',
                        'remarks',
                    ],
                },
            };

            const NonEquipmentTableConfig = {
                NonEquipmentData: {
                    id: 'nonEquipmentTable',
                    selectors: {
                        Approved: {
                            qty: '.non_equipment_approved_qty',
                            particulars: '.non_equipment_approved_particulars',
                            cost: '.non_equipment_approved_cost',
                        },
                        Actual: {
                            qty: '.non_equipment_actual_qty',
                            particulars: '.non_equipment_actual_particulars',
                            cost: '.non_equipment_actual_cost',
                        },
                        remarks: '.non_equipment_remarks',
                    },
                    requiredFields: [
                        'Approved.qty',
                        'Approved.particulars',
                        'Approved.cost',
                        'Actual.qty',
                        'Actual.particulars',
                        'Actual.cost',
                        'remarks',
                    ],
                },
            };

            const salesTableConfig = {
                SalesData: {
                    id: 'salesTable',
                    selectors: {
                        ProductService: '.sales_product_service',
                        SalesVolumeProduction: '.sales_volume_production',
                        SalesQuarter: '.sales_quarter_specify',
                        GrossSales: '.sales_gross_sales',
                    },
                    requiredFields: [
                        'ProductService',
                        'SalesVolumeProduction',
                        'SalesQuarter',
                        'GrossSales',
                    ],
                },
            };

            const EmploymentGeneratedTableConfig = {
                EmploymentGeneratedData: {
                    id: 'employmentGeneratedTable',
                    selectors: {
                        Employment_total: '.employment_total',
                        Employment_Male: '.employment_male',
                        Employment_Female: '.employment_female',
                        Employment_PWD: '.employment_pwd',
                    },
                    requiredFields: [
                        'Employment_total',
                        'Employment_Male',
                        'Employment_Female',
                        'Employment_PWD',
                    ],
                },
            };

            const IndirectEmploymentTableConfig = {
                IndirectEmploymentData: {
                    id: 'indirectEmploymentTable',
                    selectors: {
                        IndirectEmployment_total: '.indirect_employment_total',
                        IndirectEmployment_ForwardMale:
                            '.indirect_employment_forward_male',
                        IndirectEmployment_ForwardFemale:
                            '.indirect_employment_forward_female',
                        InderectEmplyment_ForwardTotal:
                            '.indirect_employment_forward_total',
                        IndirectEmployment_BackwardMale:
                            '.indirect_employment_backward_male',
                        IndirectEmployment_BackwardFemale:
                            '.indirect_employment_backward_female',
                        IndirectEmployment_BackwardTotal:
                            '.indirect_employment_backward_total',
                    },
                    requiredFields: [
                        'IndirectEmployment_total',
                        'IndirectEmployment_ForwardMale',
                        'IndirectEmployment_ForwardFemale',
                        'InderectEmplyment_ForwardTotal',
                        'IndirectEmployment_BackwardMale',
                        'IndirectEmployment_BackwardFemale',
                        'IndirectEmployment_BackwardTotal',
                    ],
                },
            };

            /**
             * Prepares and returns the required data for the specified export type.
             *
             * @param {string} ExportPDF_BUTTON_DATA_VALUE - The type of export (PIS or PDS)
             * @return {object|string} The prepared data for the specified export type
             */
            const requestDATA = async (ExportPDF_BUTTON_DATA_VALUE) => {
                const formDATAToBESent = {
                    PIS: function () {
                        return (
                            $('#projectInfoForm').serialize() +
                            '&' +
                            $('#PIS_checklistsForm').serialize()
                        );
                    },

                    PDS: function () {
                        const thisFormData =
                            $('#projectDataForm').serializeArray();
                        let thisFormObject = {};
                        $.each(thisFormData, function (i, v) {
                            if (v.name.includes('[]')) {
                                thisFormObject[v.name] = thisFormObject[v.name]
                                    ? [...thisFormObject[v.name], v.value]
                                    : [v.value];
                            } else {
                                thisFormObject[v.name] = v.value;
                            }
                        });

                        thisFormObject = {
                            ...thisFormObject,
                            ...TableDataExtractor(ExportAndLocalProductsConfig),
                        };

                        return thisFormObject;
                    },

                    SR: function () {
                        const FormContainer = $('#StatusReportForm');
                        const thisFormData = FormContainer.serializeArray();
                        console.log(thisFormData);
                        let thisFormObject = {};
                        $.each(thisFormData, function (i, v) {
                            if (v.name.includes('[]')) {
                                thisFormObject[v.name] = thisFormObject[v.name]
                                    ? [...thisFormObject[v.name], v.value]
                                    : [v.value];
                            } else {
                                thisFormObject[v.name] = v.value;
                            }
                        });

                        return (thisFormObject = {
                            ...thisFormObject,
                            ...TableDataExtractor(
                                ExpectedAndActualOutputTableConfig
                            ),
                            ...TableDataExtractor(EquipmentTableConfig),
                            ...TableDataExtractor(NonEquipmentTableConfig),
                            ...TableDataExtractor(salesTableConfig),
                            ...TableDataExtractor(
                                EmploymentGeneratedTableConfig
                            ),
                            ...TableDataExtractor(
                                IndirectEmploymentTableConfig
                            ),
                        });
                    },
                };
                return formDATAToBESent[ExportPDF_BUTTON_DATA_VALUE]();
            };

            /**
             * Handles the submission of the Create Quarterly Report form.
             *
             * @event submit
             * @memberof $('#CreateQuarterlyReportForm')
             * @param {Event} e - The submit event.
             * @description Prevents default form submission behavior and sends a POST request to the server to create a new quarterly report.
             */
            $('#CreateQuarterlyReportForm').on('submit', async function (e) {
                e.preventDefault();

                const isConfirmed = await createConfirmationModal({
                    title: 'Create Quarterly Report',
                    titleBg: 'bg-primary',
                    message:
                        'Are you sure you want to Create this Quarterly Report?',
                    confirmText: 'Yes',
                    confirmButtonClass: 'btn-primary',
                    cancelText: 'No',
                });

                if (!isConfirmed) {
                    return;
                }
                showProcessToast();
                const project_id = $('#ProjectID').val();
                const formData =
                    $(this).serialize() + '&project_id=' + project_id;
                $.ajax({
                    type: 'POST',
                    url: DASHBBOARD_TAB_ROUTE.STORE_NEW_QUARTERLY_REPORT,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content'
                        ),
                    },
                    success: function (response) {
                        getQuarterlyReports(project_id);
                        hideProcessToast();
                        showToastFeedback('text-bg-success', response.message);
                    },
                    error: function (error) {
                        hideProcessToast();
                        showToastFeedback(
                            'text-bg-danger',
                            error.responseJSON.message
                        );
                    },
                });
            });

            /**
             * Retrieves quarterly reports for a given project ID and populates the quarterly table body with the response data.
             *
             * @param {number} project_id - The ID of the project for which to retrieve quarterly reports
             * @return {void}
             */
            const getQuarterlyReports = async (project_id) => {
                const TableContainer = $('#quarterlyTableBody');

                try {
                    const response = await $.ajax({
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                        url:
                            DASHBBOARD_TAB_ROUTE.GET_QUARTERLY_REPORT_RECORDS +
                            '?project_id=' +
                            project_id,
                    });
                    response !== null && TableContainer.empty();

                    response.sort((a, b) => {
                        const quarterA = a.quarter.split(' ')[0];
                        const yearA = a.quarter.split(' ')[1];
                        const quarterB = b.quarter.split(' ')[0];
                        const yearB = b.quarter.split(' ')[1];

                        if (yearA < yearB) return -1;
                        if (yearA > yearB) return 1;

                        const quarterOrder = ['Q1', 'Q2', 'Q3', 'Q4'];
                        return (
                            quarterOrder.indexOf(quarterA) -
                            quarterOrder.indexOf(quarterB)
                        );
                    });
                    response.forEach((report) => {
                        const newRow = `
        <tr>
          <td class="text-center">
          ${report.quarter}
          </td>
          <td class="text-center">
          <span class="badge rounded-pill ${
              report.Coop_Response === 'submitted'
                  ? 'bg-success'
                  : 'text-bg-secondary'
          }">${report.Coop_Response}
          </span>
          </td>
          <td class="text-center">
          <span class="badge rounded-pill ${
              report.report_status === 'open'
                  ? 'bg-primary'
                  : 'text-bg-secondary'
          }">
          ${report.report_status}
          </span>
          </td>
          <td class="text-center">
          <span>
          ${report.open_until ?? 'Not set'}
          </span><br/>
          <span class="text-secondary fst-italic">  ${
              report.open_until
                  ? 'will close in ' + report.remaining_days + ' Day/s'
                  : ' '
          }
          </span>
          </td>
          <td class="text-center">
          <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateQuarterlyRecordModal" data-record-id="${
              report.id
          }"><i class="ri-file-edit-fill"></i></button>
          <button type="button" class="btn btn-danger btn-sm deleteQuarterlyRecord" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" data-record-id="${
              report.id
          }" data-delete-record-type="quarterlyRecord"><i class="ri-delete-bin-fill"></i></button>
          </td>
        </tr>
      `;
                        // Append the new row to the table body
                        TableContainer.append(newRow);
                    });
                } catch (error) {
                    throw new Error(
                        'Error fetching quarterly reports: ' + error
                    );
                }
            };

            /**
             * Event listener for when the #updateQuarterlyRecordModal modal is shown.
             *
             * @event show.bs.modal
             * @memberof #updateQuarterlyRecordModal
             * @param {Object} event - The event object.
             * @param {HTMLElement} event.relatedTarget - The element that triggered the modal.
             *
             * @description Sets up the modal with the record ID and report status from the triggered button.
             *              Also sets up a click event listener for the #updateQuarterlyRecord button.
             */
            $('#updateQuarterlyRecordModal').on(
                'show.bs.modal',
                function (event) {
                    const triggeredbutton = $(event.relatedTarget);
                    const record = triggeredbutton.data('record-id');
                    const triggeredButtonRow = triggeredbutton.closest('tr');

                    const modal = $(this);
                    const reportStatus =
                        triggeredButtonRow.find('span.badge:contains("open")')
                            .length > 0
                            ? 'open'
                            : 'closed';
                    modal
                        .find('#updateQuarterlyRecord')
                        .attr('data-record-id', record);

                    modal
                        .find('#toogleReport')
                        .prop(
                            'checked',
                            reportStatus === 'open' ? true : false
                        );
                    modal
                        .find('#updateQuarterlyRecord')
                        .attr('data-record-id', record);

                    $('#updateQuarterlyRecord').on('click', function () {
                        const record_id = $(this).data('record-id');
                        updateQuarterlyReport(record_id);
                    });
                }
            );

            /**
             * Updates a quarterly report by sending a PUT request to the server.
             *
             * @param {number} report_id - The ID of the quarterly report to be updated.
             * @return {Promise} A promise that resolves when the update is successful, or rejects with an error message.
             */
            const updateQuarterlyReport = async (report_id) => {
                const form = $('#updateQuarterlyRecordForm').serialize();
                const report_status = $('#toogleReport').prop('checked')
                    ? 'open'
                    : 'closed';

                try {
                    const response = await $.ajax({
                        type: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                        url: DASHBBOARD_TAB_ROUTE.UPDATE_QUARTERLY_REPORT.replace(
                            ':record_id',
                            report_id
                        ),
                        data: form + '&report_status=' + report_status,
                    });

                    getQuarterlyReports(response.project_id);
                    closeModal('#updateQuarterlyRecordModal');
                    showToastFeedback('text-bg-success', response.message);
                } catch (error) {
                    showToastFeedback(
                        'text-bg-danger',
                        error.responseJSON.message
                    );
                }
            };

            await getDashboardChartData();
            await getHandleProject();
            console.log('resolved');
        },
        Projects: async () => {
            const ApprovedDataTable = $('#approvedTable').DataTable({
                responsive: true,
                autoWidth: false,
                fixedColumns: false,
                columns: [
                    {
                        title: 'Project #',
                        width: '5%',
                    },
                    {
                        title: 'Cooperator Name',
                        width: '10%',
                    },
                    {
                        title: 'Firm Name',
                        width: '10%',
                    },
                    {
                        title: 'Project Title',
                        width: '25%',
                    },
                    {
                        title: 'Date Approved',
                        width: '12%',
                    },
                    {
                        title: 'Action',
                        width: '5%',
                        orderable: false,
                        className: 'text-center',
                    },
                ],
            });
            const OngoingDataTable = $('#ongoingTable').DataTable({
                responsive: true,
                autoWidth: false,
                fixedColumns: false,
                columns: [
                    {
                        title: 'Project #',
                        width: '15%',
                        className: 'text-center',
                    },
                    {
                        title: 'Project Title',
                        width: '30%',
                    },
                    {
                        title: 'Firm',
                        width: '15%',
                    },
                    {
                        title: 'Cooperator Name',
                        width: '20%',
                    },
                    {
                        title: 'Progress',
                        className: 'text-end',
                        width: '30%',
                    },
                    {
                        title: 'Action',
                        orderable: false,
                        className: 'text-center',
                        width: '10%',
                    },
                ],
            });
            const CompletedDataTable = $('#completedTable').DataTable({
                responsive: true,
                autoWidth: false,
                fixedColumns: true,
                columns: [
                    {
                        title: 'Project #',
                        width: '15%',
                        className: 'text-center',
                    },
                    {
                        title: 'Project Title',
                        width: '30%',
                    },
                    {
                        title: 'Firm',
                        width: '15%',
                    },
                    {
                        title: 'Cooperator Name',
                        width: '20%',
                    },
                    {
                        title: 'Progress',
                        width: '30%',
                        className: 'text-end',
                    },
                    {
                        title: 'Action',
                        width: '10%',
                        orderable: false,
                        className: 'text-center',
                    },
                ],
            });

            const paymentTableConfig = {
                autoWidth: true,
                responsive: true,
                columns: [
                    {
                        title: 'Transaction #',
                    },
                    {
                        title: 'Amount',
                    },
                    {
                        title: 'Payment Method',
                    },
                    {
                        title: 'Status',
                    },
                    {
                        title: 'Date Created',
                    },
                ],
            };
            const OngoingPaymentHistoryDataTable = $(
                '#OngoingPaymentHistoryTable'
            ).DataTable(paymentTableConfig);
            const CompletePaymentHistoryDataTable = $(
                '#CompletePaymentHistoryTable'
            ).DataTable(paymentTableConfig);

            const addProjectBtn = $('#addProjectManualy');

            addProjectBtn.on('click', async () => {
                await loadPage(NAV_ROUTES.ADD_PROJECT, 'projectLink');
            });

            $('#ApprovedtableBody').on(
                'click',
                '.approvedProjectInfo',
                function () {
                    const row = $(this).closest('tr');
                    const inputs = row.find('input');
                    const readonlyInputs = $('#approvedDetails').find('input');

                    const values = {
                        cooperatorName: row.find('td:eq(1)').text().trim(),
                        designation: inputs.filter('.designation').val(),
                        b_id: inputs.filter('.business_id').val(),
                        businessAddress: inputs
                            .filter('.business_address')
                            .val(),
                        typeOfEnterprise: inputs
                            .filter('.enterprise_type')
                            .val(),
                        enterpriseLevel: inputs
                            .filter('.enterprise_level')
                            .val(),
                        landline: inputs.filter('.landline').val(),
                        mobilePhone: inputs.filter('.mobile_number').val(),
                        email: inputs.filter('.email').val(),
                        ProjectId: row.find('td:eq(0)').text().trim(),
                        ProjectTitle: row.find('td:eq(3)').text().trim(),
                        Amount: parseFloat(
                            inputs
                                .filter('.fund_amount')
                                .val()
                                .replace(/,/g, '')
                        ),
                        Applied: inputs.filter('.dateApplied').val(),
                        evaluated: inputs.filter('.evaluated_by').val(),
                        Assigned_to: inputs.filter('.assigned_to').val(),
                        building: parseFloat(
                            inputs
                                .filter('.building_Assets')
                                .val()
                                .replace(/,/g, '')
                        ),
                        equipment: parseFloat(
                            inputs
                                .filter('.equipment_Assets')
                                .val()
                                .replace(/,/g, '')
                        ),
                        workingCapital: parseFloat(
                            inputs
                                .filter('.working_capital_Assets')
                                .val()
                                .replace(/,/g, '')
                        ),
                    };

                    readonlyInputs
                        .filter('#cooperatorName')
                        .val(values.cooperatorName);
                    readonlyInputs
                        .filter('#designation')
                        .val(values.designation);
                    readonlyInputs.filter('#b_id').val(values.b_id);
                    readonlyInputs
                        .filter('#businessAddress')
                        .val(values.businessAddress);
                    readonlyInputs
                        .filter('#typeOfEnterprise')
                        .val(values.typeOfEnterprise);
                    readonlyInputs
                        .filter('#enterpriseLevel')
                        .val(values.enterpriseLevel);
                    readonlyInputs.filter('#landline').val(values.landline);
                    readonlyInputs
                        .filter('#mobilePhone')
                        .val(values.mobilePhone);
                    readonlyInputs.filter('#email').val(values.email);
                    readonlyInputs.filter('#ProjectId').val(values.ProjectId);
                    readonlyInputs
                        .filter('#ProjectTitle')
                        .val(values.ProjectTitle);
                    readonlyInputs
                        .filter('#Amount')
                        .val(formatNumberToCurrency(values.Amount));
                    readonlyInputs.filter('#Applied').val(values.Applied);
                    readonlyInputs.filter('#evaluated').val(values.evaluated);
                    readonlyInputs
                        .filter('#Assigned_to')
                        .val(values.Assigned_to);
                    readonlyInputs
                        .filter('#building')
                        .val(formatNumberToCurrency(values.building));
                    readonlyInputs
                        .filter('#equipment')
                        .val(formatNumberToCurrency(values.equipment));
                    readonlyInputs
                        .filter('#workingCapital')
                        .val(formatNumberToCurrency(values.workingCapital));
                }
            );

            $('#OngoingTableBody').on(
                'click',
                '.ongoingProjectInfo',
                function () {
                    const row = $(this).closest('tr');
                    const inputs = row.find('input');
                    const readonlyInputs = $('#ongoingDetails').find('input');
                    console.log(inputs);

                    const personalDetails = {
                        cooperName: row.find('td:nth-child(4)').text().trim(),
                        designaition: inputs.filter('.designation').val(),
                        email: inputs.filter('.email').val(),
                        mobile_number: inputs.filter('.mobile_number').val(),
                        landline: inputs.filter('.landline').val(),
                    };

                    const businessDetails = {
                        business_id: inputs.filter('.business_id').val(),
                        firmName: row.find('td:nth-child(3)').text().trim(),
                        address: inputs.filter('.address').val(),
                        enterprise_type: inputs
                            .filter('.enterprise_type')
                            .val(),
                        enterprise_level: inputs
                            .filter('.enterprise_level')
                            .val(),
                        building_assets: parseFloat(
                            inputs.filter('.building_assets').val()
                        ),
                        equipment_assets: parseFloat(
                            inputs.filter('.equipment_assets').val()
                        ),
                        working_capital_assets: parseFloat(
                            inputs.filter('.working_capital_assets').val()
                        ),
                    };

                    const projectDetails = {
                        project_id: inputs.filter('.project_id').val(),
                        project_title: row
                            .find('td:nth-child(2)')
                            .text()
                            .trim(),
                        project_fund_amount: parseFloat(
                            inputs.filter('.project_fund_amount').val()
                        ),
                        project_amount_to_be_refunded: parseFloat(
                            inputs.filter('.amount_to_be_refunded').val()
                        ),
                        project_refunded_amount: parseFloat(
                            inputs.filter('.amount_refunded').val()
                        ),
                        date_applied: inputs.filter('.date_applied').val(),
                        project_date_approved: inputs
                            .filter('.date_approved')
                            .val(),
                        evaluated_by: inputs.filter('.evaluated_by').val(),
                        handle_by: inputs.filter('.handled_by').val(),
                    };

                    readonlyInputs
                        .filter('.cooperatorName')
                        .val(personalDetails.cooperName);
                    readonlyInputs
                        .filter('.designation')
                        .val(personalDetails.designaition);
                    readonlyInputs
                        .filter('.mobile_number')
                        .val(personalDetails.mobile_number);
                    readonlyInputs.filter('.email').val(personalDetails.email);
                    readonlyInputs
                        .filter('.landline')
                        .val(personalDetails.landline);

                    readonlyInputs
                        .filter('.b_id')
                        .val(businessDetails.business_id);
                    readonlyInputs
                        .filter('.firmName')
                        .val(businessDetails.firmName);
                    readonlyInputs
                        .filter('.businessAddress')
                        .val(businessDetails.address);
                    readonlyInputs
                        .filter('.typeOfEnterprise')
                        .val(businessDetails.enterprise_type);
                    readonlyInputs
                        .filter('.enterpriseLevel')
                        .val(businessDetails.enterprise_level);
                    readonlyInputs
                        .filter('.building')
                        .val(
                            formatNumberToCurrency(
                                businessDetails.building_assets
                            )
                        );
                    readonlyInputs
                        .filter('.equipment')
                        .val(
                            formatNumberToCurrency(
                                businessDetails.equipment_assets
                            )
                        );
                    readonlyInputs
                        .filter('.workingCapital')
                        .val(
                            formatNumberToCurrency(
                                businessDetails.working_capital_assets
                            )
                        );

                    readonlyInputs
                        .filter('.ProjectId')
                        .val(projectDetails.project_id);
                    readonlyInputs
                        .filter('.ProjectTitle')
                        .val(projectDetails.project_title);
                    readonlyInputs
                        .filter('.funded_amount')
                        .val(
                            formatNumberToCurrency(
                                projectDetails.project_fund_amount
                            )
                        );
                    readonlyInputs
                        .filter('.amount_to_be_refunded')
                        .val(
                            formatNumberToCurrency(
                                projectDetails.project_amount_to_be_refunded
                            )
                        );
                    readonlyInputs
                        .filter('.refunded')
                        .val(
                            formatNumberToCurrency(
                                projectDetails.project_refunded_amount
                            )
                        );
                    readonlyInputs
                        .filter('.date_applied')
                        .val(customDateFormatter(projectDetails.date_applied));
                    readonlyInputs
                        .filter('.evaluated_by')
                        .val(projectDetails.evaluated_by);
                    readonlyInputs
                        .filter('.handle_by')
                        .val(projectDetails.handle_by);

                    getProjectPaymentHistory(
                        projectDetails.project_id,
                        OngoingPaymentHistoryDataTable
                    );
                }
            );

            $('#CompletedTableBody').on(
                'click',
                '.completedProjectInfo',
                async function () {
                    const row = $(this).closest('tr');
                    const inputs = row.find('input');
                    const readonlyInputs = $('#completedDetails').find('input');

                    const personalDetails = {
                        cooperName: row.find('td:nth-child(4)').text().trim(),
                        designaition: inputs.filter('.designation').val(),
                        email: inputs.filter('.email').val(),
                        mobile_number: inputs.filter('.mobile_number').val(),
                        landline: inputs.filter('.landline').val(),
                    };

                    const businessDetails = {
                        business_id: inputs.filter('.business_id').val(),
                        firmName: row.find('td:nth-child(3)').text().trim(),
                        address: inputs.filter('.address').val(),
                        enterprise_type: inputs
                            .filter('.enterprise_type')
                            .val(),
                        enterprise_level: inputs
                            .filter('.enterprise_level')
                            .val(),
                        building_assets: parseFloat(
                            inputs.filter('.building_assets').val()
                        ),
                        equipment_assets: parseFloat(
                            inputs.filter('.equipment_assets').val()
                        ),
                        working_capital_assets: parseFloat(
                            inputs.filter('.working_capital_assets').val()
                        ),
                    };

                    const projectDetails = {
                        project_id: inputs.filter('.project_id').val(),
                        project_title: row
                            .find('td:nth-child(2)')
                            .text()
                            .trim(),
                        project_fund_amount: parseFloat(
                            inputs.filter('.project_fund_amount').val()
                        ),
                        project_amount_to_be_refunded: parseFloat(
                            inputs.filter('.amount_to_be_refunded').val()
                        ),
                        project_refunded_amount: parseFloat(
                            inputs.filter('.amount_refunded').val()
                        ),
                        date_applied: inputs.filter('.date_applied').val(),
                        project_date_approved: inputs
                            .filter('.date_approved')
                            .val(),
                        evaluated_by: inputs.filter('.evaluated_by').val(),
                        handled_by: inputs.filter('.handled_by').val(),
                    };

                    readonlyInputs
                        .filter('.cooperatorName')
                        .val(personalDetails.cooperName);
                    readonlyInputs
                        .filter('.designation')
                        .val(personalDetails.designaition);
                    readonlyInputs
                        .filter('.mobile_number')
                        .val(personalDetails.mobile_number);
                    readonlyInputs.filter('.email').val(personalDetails.email);
                    readonlyInputs
                        .filter('.landline')
                        .val(personalDetails.landline);

                    readonlyInputs
                        .filter('.b_id')
                        .val(businessDetails.business_id);
                    readonlyInputs
                        .filter('.firmName')
                        .val(businessDetails.firmName);
                    readonlyInputs
                        .filter('.businessAddress')
                        .val(businessDetails.address);
                    readonlyInputs
                        .filter('.typeOfEnterprise')
                        .val(businessDetails.enterprise_type);
                    readonlyInputs
                        .filter('.enterpriseLevel')
                        .val(businessDetails.enterprise_level);
                    readonlyInputs
                        .filter('.building')
                        .val(
                            formatNumberToCurrency(
                                businessDetails.building_assets
                            )
                        );
                    readonlyInputs
                        .filter('.equipment')
                        .val(
                            formatNumberToCurrency(
                                businessDetails.equipment_assets
                            )
                        );
                    readonlyInputs
                        .filter('.workingCapital')
                        .val(
                            formatNumberToCurrency(
                                businessDetails.working_capital_assets
                            )
                        );

                    readonlyInputs
                        .filter('.ProjectId')
                        .val(projectDetails.project_id);
                    readonlyInputs
                        .filter('.ProjectTitle')
                        .val(projectDetails.project_title);
                    readonlyInputs
                        .filter('.funded_amount')
                        .val(
                            formatNumberToCurrency(
                                projectDetails.project_fund_amount
                            )
                        );
                    readonlyInputs
                        .filter('.amount_to_be_refunded')
                        .val(
                            formatNumberToCurrency(
                                projectDetails.project_amount_to_be_refunded
                            )
                        );
                    readonlyInputs
                        .filter('.refunded')
                        .val(
                            formatNumberToCurrency(
                                projectDetails.project_refunded_amount
                            )
                        );
                    readonlyInputs
                        .filter('.date_applied')
                        .val(customDateFormatter(projectDetails.date_applied));
                    readonlyInputs
                        .filter('.evaluated_by')
                        .val(projectDetails.evaluated_by);
                    readonlyInputs
                        .filter('.handle_by')
                        .val(projectDetails.handled_by);

                    await getProjectPaymentHistory(
                        projectDetails.project_id,
                        CompletePaymentHistoryDataTable
                    );
                }
            );

            async function getApprovedProjects() {
                try {
                    const response = await fetch(
                        PROJECT_TAB_ROUTE.GET_APPROVED_PROJECTS,
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
                    ApprovedDataTable.clear();
                    ApprovedDataTable.rows.add(
                        data.map((Approved) => {
                            return [
                                `${Approved.Project_id}`,
                                `${Approved.f_name} ${Approved.l_name}
                                          <input type="hidden" class="designation" value="${
                                              Approved.designation
                                          }">
                                          <input type="hidden" class="mobile_number" value="${
                                              Approved.mobile_number
                                          }">
                                          <input type="hidden" class="email" value="${
                                              Approved.email
                                          }">
                                          <input type="hidden" class="landline" value="${
                                              Approved.landline ?? ''
                                          }">`,
                                `${Approved.firm_name}
                                          <input type="hidden" class="business_id" value="${Approved.business_id}">
                                          <input type="hidden" class="enterprise_type" value="${Approved.enterprise_type}">
                                          <input type="hidden" class="enterprise_level" value="${Approved.enterprise_level}">
                                          <input type="hidden" class="building_Assets" value="${Approved.building_value}">
                                          <input type="hidden" class="equipment_Assets" value="${Approved.equipment_value}">
                                          <input type="hidden" class="working_capital_Assets" value="${Approved.working_capital}">
                                          <input type="hidden" class="business_address" value="${Approved.landmark} ${Approved.barangay}, ${Approved.city}, ${Approved.province}, ${Approved.region}">`,
                                `${Approved.project_title}
                                          <input type="hidden" class="fund_amount" value="${
                                              Approved.fund_amount
                                          }">
                                          <input type="hidden" class="dateApplied" value="${customDateFormatter(
                                              Approved.date_applied
                                          )}">
                                          <input type="hidden" class="staffUserName" value="${
                                              Approved.staffUserName
                                          }">
                                          <input type="hidden" class="evaluated_by" value="${
                                              (Approved.evaluated_by_prefix
                                                  ? Approved.evaluated_by_suffix
                                                  : '') +
                                              ' ' +
                                              Approved.evaluated_by_f_name +
                                              ' ' +
                                              (Approved.evaluated_by_mid_name
                                                  ? Approved.evaluated_by_suffix
                                                  : '') +
                                              ' ' +
                                              Approved.evaluated_by_l_name +
                                              ' ' +
                                              (Approved.evaluated_by_suffix
                                                  ? Approved.evaluated_by_suffix
                                                  : '')
                                          }">
                                          <input type="hidden" class="assigned_to" value="${
                                              (Approved.handled_by_prefix
                                                  ? Approved.handled_by_suffix
                                                  : '') +
                                              '' +
                                              Approved.handled_by_f_name +
                                              ' ' +
                                              (Approved.handled_by_mid_name
                                                  ? Approved.handled_by_suffix
                                                  : '') +
                                              ' ' +
                                              Approved?.handled_by_l_name +
                                              ' ' +
                                              (Approved.handled_by_suffix
                                                  ? Approved.handled_by_suffix
                                                  : '')
                                          }">`,
                                `${customDateFormatter(Approved.date_approved)}`,
                                ` <button class="btn btn-primary approvedProjectInfo" type="button"
                                                                  data-bs-toggle="offcanvas" data-bs-target="#approvedDetails"
                                                                  aria-controls="approvedDetails">
                                                                  <i class="ri-menu-unfold-4-line ri-1x"></i>
                                                              </button>`,
                            ];
                        })
                    );

                    ApprovedDataTable.draw();
                } catch (error) {
                    console.error('Error:', error);
                }
            }

            async function getOngoingProjects() {
                try {
                    const response = await fetch(
                        PROJECT_TAB_ROUTE.GET_ONGOING_PROJECTS,
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

                    OngoingDataTable.clear();
                    OngoingDataTable.rows.add(
                        data.map((Ongoing) => {
                            const fund_amount = parseFloat(Ongoing.fund_amount);
                            const amount_refunded = parseFloat(
                                Ongoing.amount_refunded
                            );
                            const to_be_refunded = parseFloat(
                                Ongoing.to_be_refunded
                            );

                            const percentage = Math.ceil(
                                (amount_refunded / to_be_refunded) * 100
                            );
                            return [
                                `${Ongoing.Project_id}`,
                                `${Ongoing.project_title}
                      <input type="hidden" class="project_id" value="${
                          Ongoing.Project_id
                      }">
                      <input type="hidden" class="project_fund_amount" value="${fund_amount}">
                      <input type="hidden" class="amount_to_be_refunded" value="${to_be_refunded}">
                      <input type="hidden" class="amount_refunded" value="${amount_refunded}">
                      <input type="hidden" class="date_applied" value="${
                          Ongoing.date_applied
                      }">
                      <input type="hidden" class="date_approved" value="${
                          Ongoing.date_approved
                      }">
                      <input type="hidden" class="evaluated_by" value="${
                          (Ongoing.evaluated_by_prefix
                              ? Ongoing.evaluated_by_prefix
                              : '') +
                          ' ' +
                          Ongoing.evaluated_by_f_name +
                          ' ' +
                          (Ongoing.evaluated_by_mid_name
                              ? Ongoing.evaluated_by_mid_name
                              : '') +
                          ' ' +
                          Ongoing.evaluated_by_l_name +
                          ' ' +
                          (Ongoing.evaluated_by_suffix
                              ? Ongoing.evaluated_by_suffix
                              : '')
                      }">
                      <input type="hidden" class="handled_by" value="${
                          (Ongoing.handled_by_prefix
                              ? Ongoing.handled_by_prefix
                              : '') +
                          ' ' +
                          Ongoing.handled_by_f_name +
                          ' ' +
                          (Ongoing.handled_by_mid_name
                              ? Ongoing.handled_by_mid_name
                              : '') +
                          ' ' +
                          Ongoing.handled_by_l_name +
                          ' ' +
                          (Ongoing.handled_by_suffix
                              ? Ongoing.handled_by_suffix
                              : '')
                      }">`,
                                `${Ongoing.firm_name}
                      <input type="hidden" class="business_id" value="${
                          Ongoing.business_id
                      }">
                      <input type="hidden" class="address" value="${
                          Ongoing.landmark +
                          ', ' +
                          Ongoing.barangay +
                          ', ' +
                          Ongoing.city +
                          ', ' +
                          Ongoing.province +
                          ', ' +
                          Ongoing.region
                      }">
                      <input type="hidden" class="enterprise_type" value="${
                          Ongoing.enterprise_type
                      }">
                      <input type="hidden" class="enterprise_level" value="${
                          Ongoing.enterprise_level
                      }">
                      <input type="hidden" class="building_assets" value="${
                          Ongoing.building_value
                      }">
                      <input type="hidden" class="equipment_assets" value="${
                          Ongoing.equipment_value
                      }">
                      <input type="hidden" class="working_capital_assets" value="${
                          Ongoing.working_capital
                      }">`,
                                `${Ongoing.f_name + ' ' + Ongoing.l_name}
                      <input type="hidden" class="designation" value="${
                          Ongoing.designation
                      }">
                      <input type="hidden" class="mobile_number" value="${
                          Ongoing.mobile_number
                      }">
                      <input type="hidden" class="email" value="${
                          Ongoing.email
                      }">
                      <input type="hidden" class="landline" value="${
                          Ongoing.landline ?? ''
                      }">`,
                                `${
                                    formatNumberToCurrency(amount_refunded) +
                                    ' / ' +
                                    formatNumberToCurrency(to_be_refunded)
                                } <span class="badge text-white bg-primary">${percentage}%</span>`,
                                ` <button class="btn btn-primary ongoingProjectInfo" type="button" data-bs-toggle="offcanvas"
                                                  data-bs-target="#ongoingDetails" aria-controls="ongoingDetails">
                                                  <i class="ri-menu-unfold-4-line ri-1x"></i>
                      </button>`,
                            ];
                        })
                    );

                    OngoingDataTable.draw();
                } catch (error) {
                    console.error('Error:', error);
                }
            }

            async function getCompletedProjects() {
                try {
                    const response = await fetch(
                        PROJECT_TAB_ROUTE.GET_COMPLETED_PROJECTS,
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
                    CompletedDataTable.clear();
                    CompletedDataTable.rows.add(
                        data.map((completed) => {
                            const fund_amount = parseFloat(
                                completed.fund_amount
                            );
                            const amount_refunded = parseFloat(
                                completed.amount_refunded
                            );
                            const to_be_refunded = parseFloat(
                                completed.to_be_refunded
                            );

                            const percentage = Math.ceil(
                                (amount_refunded / to_be_refunded) * 100
                            );
                            return [
                                `${completed.Project_id}`,
                                `${completed.project_title}
                          <input type="hidden" class="project_id" value="${
                              completed.Project_id
                          }">
                          <input type="hidden" class="project_fund_amount" value="${fund_amount}">
                          <input type="hidden" class="amount_to_be_refunded" value="${to_be_refunded}">
                          <input type="hidden" class="amount_refunded" value="${amount_refunded}">
                          <input type="hidden" class="date_applied" value="${
                              completed.date_applied
                          }">
                          <input type="hidden" class="date_approved" value="${
                              completed.date_approved
                          }">
                          <input type="hidden" class="evaluated_by" value="${
                              (completed.evaluated_by_prefix
                                  ? completed.evaluated_by_prefix
                                  : '') +
                              ' ' +
                              completed.evaluated_by_f_name +
                              ' ' +
                              (completed.evaluated_by_mid_name
                                  ? completed?.evaluated_by_mid_name
                                  : '') +
                              ' ' +
                              completed.evaluated_by_l_name +
                              ' ' +
                              (completed.evaluated_by_suffix
                                  ? completed.evaluated_by_suffix
                                  : '')
                          }">
                          <input type="hidden" class="handled_by" value="${
                              (completed.handled_by_prefix
                                  ? completed.handled_by_prefix
                                  : '') +
                              ' ' +
                              completed.handled_by_f_name +
                              ' ' +
                              (completed.handled_by_mid_name
                                  ? completed.handled_by_mid_name
                                  : '') +
                              ' ' +
                              completed.handled_by_l_name +
                              ' ' +
                              (completed.handled_by_suffix
                                  ? completed.handled_by_suffix
                                  : '')
                          }">`,
                                `${completed.firm_name}
                          <input type="hidden" class="business_id" value="${
                              completed.business_id
                          }">
                          <input type="hidden" class="address" value="${
                              completed.landmark +
                              ', ' +
                              completed.barangay +
                              ', ' +
                              completed.city +
                              ', ' +
                              completed.province +
                              ', ' +
                              completed.region
                          }">
                          <input type="hidden" class="enterprise_type" value="${
                              completed.enterprise_type
                          }">
                          <input type="hidden" class="enterprise_level" value="${
                              completed.enterprise_level
                          }">
                          <input type="hidden" class="building_assets" value="${
                              completed.building_value
                          }">
                          <input type="hidden" class="equipment_assets" value="${
                              completed.equipment_value
                          }">
                          <input type="hidden" class="working_capital_assets" value="${
                              completed.working_capital
                          }">`,
                                `${completed.f_name + ' ' + completed.l_name}
                          <input type="hidden" class="designation" value="${
                              completed.designation
                          }">
                          <input type="hidden" class="mobile_number" value="${
                              completed.mobile_number
                          }">
                          <input type="hidden" class="email" value="${
                              completed.email
                          }">
                          <input type="hidden" class="landline" value="${
                              completed.landline ?? ''
                          }">`,
                                `${
                                    formatNumberToCurrency(amount_refunded) +
                                    ' / ' +
                                    formatNumberToCurrency(to_be_refunded)
                                } <span class="badge text-white bg-primary">${percentage}%</span>`,
                                `<button class="btn btn-primary completedProjectInfo" type="button" data-bs-toggle="offcanvas"
                                                  data-bs-target="#completedDetails" aria-controls="completedDetails">
                                                  <i class="ri-menu-unfold-4-line ri-1x"></i>
                                              </button>`,
                            ];
                        })
                    );
                    CompletedDataTable.draw();
                } catch (error) {
                    console.error('Error:', error);
                }
            }

            await getApprovedProjects();
            await getOngoingProjects();
            await getCompletedProjects();
        },

        AddProject: async () => {
            const module = await import('./applicationPage');
            // If you know specific functions that need to be called
            if (module.initializeForm) {
                module.initializeForm();
            }

            function toggleProjectInputs() {
                const selectedStatus = $('#projectStatus').val();
                const ongoingProjectInputs = $(
                    'input[data-status-dependency="ongoing"]'
                );

                if (selectedStatus === 'new') {
                    ongoingProjectInputs
                        .prop('disabled', true)
                        .closest('.col-12')
                        .hide();
                } else {
                    ongoingProjectInputs
                        .prop('disabled', false)
                        .closest('.col-12')
                        .show();
                }
            }

            customFormatNumericInput('#step-1', 'input#funded_amount');

            // Initial check on page load
            toggleProjectInputs();

            // Add event listener for status changes
            $('#projectStatus').on('change', toggleProjectInputs);
        },
        Applicant: async () => {
            new smartWizard();
            const APPLICANT_VIEWING_CHANNEL = 'viewing-Applicant-events';
            const TNArejectionModal = $('#tnaEvaluationResultModal');
            const ReviewFileModalContainer = $('#reviewFileModal');
            const ReviewedFileFormContainer =
                ReviewFileModalContainer.find('#reviewedFileForm');
            const ApplicantDetailsContainer = $('#applicantDetails');
            const ApplicantProgressContainer = $('#ApplicationProgress');
            const RequirementsTable = $('#requirementsTables');
            let currentlyViewingApplicantId = null;
            let echoChannel = null;

            const initializeEchoListeners = () => {
                if (echoChannel) {
                    cleanupEchoListeners();
                }

                echoChannel = Echo.private(APPLICANT_VIEWING_CHANNEL);

                echoChannel.listenForWhisper('viewing', (e) => {
                    updateViewingState(e.applicant_id, e.reviewed_by);
                });

                // When viewing ends
                echoChannel.listenForWhisper('viewing-closed', (e) => {
                    removeViewingState(e.applicant_id);
                });

                Echo.join(APPLICANT_VIEWING_CHANNEL)
                    .here((staff) => {
                        console.log('Current members:', staff);
                    })
                    .joining((staff) => {
                        console.log('New member joining:', staff);
                        if (currentlyViewingApplicantId) {
                            echoChannel.whisper('viewing', {
                                applicant_id: currentlyViewingApplicantId,
                                reviewed_by: AUTH_USER_NAME,
                            });
                        }
                    })
                    .leaving((staff) => {
                        console.log('Member leaving:', staff);
                    });
            };

            const cleanupEchoListeners = () => {
                if (currentlyViewingApplicantId) {
                    echoChannel?.whisper('viewing-closed', {
                        applicant_id: currentlyViewingApplicantId,
                    });
                    currentlyViewingApplicantId = null;
                }

                if (echoChannel) {
                    Echo.leaveChannel(`private-${APPLICANT_VIEWING_CHANNEL}`);
                    Echo.leaveChannel(`presence-${APPLICANT_VIEWING_CHANNEL}`);
                    echoChannel = null;
                }
            };

            function updateViewingState(applicantId, reviewedBy) {
                const applicantButton = $(
                    `#ApplicantTableBody button[data-applicant-id="${applicantId}"]`
                );
                const buttonParentTd = applicantButton.closest('td');

                if (!buttonParentTd.data('original-content')) {
                    buttonParentTd.data(
                        'original-content',
                        buttonParentTd.html()
                    );
                }

                applicantButton.css('display', 'none');
                if (reviewedBy) {
                    const initials = reviewedBy
                        .split(' ')
                        .map((n) => n[0])
                        .join('');
                    // Create a container for the initial and name
                    const reviewerContainer = $(
                        `<div class="reviewer-container"></div>`
                    );
                    reviewerContainer.append(
                        `<span class="reviewer-initial">${initials}</span>`
                    );
                    reviewerContainer.append(
                        `<span class="reviewer-name">${reviewedBy}</span>`
                    );
                    reviewerContainer.append(
                        `<span class="badge rounded-pill text-bg-success reviewer-badge">reviewing</span>`
                    );

                    buttonParentTd
                        .append(reviewerContainer)
                        .addClass('reviewer-name-cell');
                }
            }
            // Function to remove viewing state from UI
            function removeViewingState(applicantId) {
                const applicantButton = $(
                    `#ApplicantTableBody button[data-applicant-id="${applicantId}"]`
                );
                const buttonParentTd = applicantButton.closest('td');

                if (buttonParentTd.data('original-content')) {
                    buttonParentTd
                        .html(buttonParentTd.data('original-content'))
                        .removeClass('reviewer-name-cell');
                }
            }

            $(document).on('page:changing', function (e, data) {
                const { from, to } = data;
                if (from === 'Applicationlink') {
                    cleanupEchoListeners();
                }
            });

            let ProjectProposalFormInitialValue = {};
            const applicantDataTable = $('#applicant').DataTable({
                responsive: true,
                autoWidth: false,
                fixedColumns: true,
                columns: [
                    {
                        title: 'Applicant',
                        width: '25%',
                    },
                    {
                        title: 'Designation',
                        width: '10%',
                    },
                    {
                        title: 'Business Info',
                        width: '35%',
                        orderable: false,
                    },
                    {
                        title: 'Date Applied',
                        width: '15%',
                        type: 'date',
                    },
                    {
                        title: 'Status',
                        width: '10%',
                        className: 'text-center',
                    },
                    {
                        title: 'Action',
                        width: '5%',
                        orderable: false,
                    },
                ],
            });

            const getApplicants = async () => {
                const response = await fetch(
                    APPLICANT_TAB_ROUTE.GET_APPLICANTS,
                    {
                        method: 'GET',
                        dataType: 'json',
                    }
                );
                const data = await response.json();
                applicantDataTable.clear();
                applicantDataTable.rows
                    .add(
                        data.map((item) => {
                            return [
                                `${
                                    (item?.prefix ?? '') +
                                    ' ' +
                                    item.f_name +
                                    ' ' +
                                    (item?.mid_name ?? '') +
                                    ' ' +
                                    item.l_name +
                                    ' ' +
                                    (item?.suffix ?? '')
                                }
                                <input type="hidden" name="sex" value="${
                                    item.sex
                                }">`,
                                `${item.designation}`,
                                `<div>
                    <strong>Firm Name:</strong> <span class="firm_name">${
                        item.firm_name
                    }</span><br>
                    <strong>Business Address:</strong>
                    <input type="hidden" name="userID" value="${item.user_id}">
                    <input type="hidden" name="applicationID" value="${
                        item.Application_ID
                    }">
                    <input type="hidden" name="businessID" value="${
                        item.business_id
                    }">
                    <input type="hidden" name="male_direct_re" value="${
                        item.male_direct_re || '0'
                    }">
                    <input type="hidden" name="female_direct_re" value="${
                        item.female_direct_re || '0'
                    }">
                    <input type="hidden" name="male_direct_part" value="${
                        item.male_direct_part || '0'
                    }">
                    <input type="hidden" name="female_direct_part" value="${
                        item.female_direct_part || '0'
                    }">
                    <input type="hidden" name="male_indirect_re" value="${
                        item.male_indirect_re || '0'
                    }">
                    <input type="hidden" name="female_indirect_re" value="${
                        item.female_indirect_re || '0'
                    }">
                    <input type="hidden" name="male_indirect_part" value="${
                        item.male_indirect_part || '0'
                    }">
                    <input type="hidden" name="female_indirect_part" value="${
                        item.female_indirect_part || '0'
                    }">
                    <input type="hidden" name="total_personnel" value="${
                        parseInt(item.male_direct_re || 0) +
                        parseInt(item.female_direct_re || 0) +
                        parseInt(item.male_direct_part || 0) +
                        parseInt(item.female_direct_part || 0) +
                        parseInt(item.male_indirect_re || 0) +
                        parseInt(item.female_indirect_re || 0) +
                        parseInt(item.male_indirect_part || 0) +
                        parseInt(item.female_indirect_part || 0)
                    }">
                    <span class="b_address text-truncate">${item.landMark}, ${
                        item.barangay
                    }, ${item.city}, ${item.province}, ${item.region}</span><br>
                    <strong>Type of Enterprise:</strong> <span class="enterprise_l">${
                        item.enterprise_type
                    }</span>
                    <p>
                        <strong>Assets:</strong> <br>
                        <span class="ps-2">Building: ${formatNumberToCurrency(
                            parseFloat(item.building_value)
                        )}</span><br>
                        <span class="ps-2">Equipment: ${formatNumberToCurrency(
                            parseFloat(item.equipment_value)
                        )}</span> <br>
                        <span class="ps-2">Working Capital: ${formatNumberToCurrency(
                            parseFloat(item.working_capital)
                        )}</span>
                    </p>
                    <strong>Contact Details:</strong>
                    <p>
                        <strong class="p-2">Landline:</strong> <span class="landline">${
                            item.landline
                        }</span> <br>
                        <strong class="p-2">Mobile Phone:</strong> <span class="mobile_num">${
                            item.mobile_number
                        }</span> <br>
                        <strong class="p-2">Email:</strong> <span class="email_add">${
                            item.email
                        }</span>
                    </p>
                </div>`,
                                `${customDateFormatter(item.date_applied)}`,
                                `<span class="badge ${
                                    item.application_status === 'new'
                                        ? 'bg-primary'
                                        : item.application_status ===
                                            'evaluation'
                                          ? 'bg-info'
                                          : item.application_status ===
                                              'pending'
                                            ? 'bg-primary'
                                            : 'bg-danger'
                                }">${item.application_status}</span>`,
                                `   <button class="btn btn-primary applicantDetailsBtn" data-applicant-id="${item.Application_ID}" type="button"
                                            data-bs-toggle="offcanvas" data-bs-target="#applicantDetails"
                                            aria-controls="applicantDetails">
                                            <i class="ri-menu-unfold-4-line ri-1x"></i>
                                    </button>`,
                            ];
                        })
                    )
                    .draw();
                initializeEchoListeners();
            };

            $('#evaluationSchedule-datepicker').on('change', function () {
                const selectedDate = new Date(this.value);
                const currentDate = new Date();

                if (selectedDate < currentDate) {
                    this.value = this.min;
                }
            });
            customFormatNumericInput('#EquipmentTableBody', [
                '.EquipmentCost',
                '.EquipmentQTY',
            ]);
            customFormatNumericInput('#NonEquipmentTableBody', [
                '.NonEquipmentQTY',
                '.NonEquipmentCost',
            ]);

            customFormatNumericInput('#fundAmount');

            //TODO: update this the logic of this
            $('#ApplicantTableBody').on(
                'click',
                '.applicantDetailsBtn',
                async function () {
                    const row = $(this).closest('tr');
                    const fullName = row.find('td:nth-child(1)').text().trim();
                    const sex = row
                        .find("td:nth-child(1) input[name='sex']")
                        .val();
                    console.log(sex);
                    const designation = row
                        .find('td:nth-child(2)')
                        .text()
                        .trim();
                    const firmName = row
                        .find('td:nth-child(3) span.firm_name')
                        .text()
                        .trim();
                    const userID = row
                        .find('td:nth-child(3) input[name="userID"]')
                        .val();
                    const ApplicationID = row
                        .find('td:nth-child(3) input[name="applicationID"]')
                        .val();
                    const businessID = row
                        .find('td:nth-child(3) input[name="businessID"]')
                        .val();
                    const businessAddress = row
                        .find('td:nth-child(3) span.b_address')
                        .text()
                        .trim();
                    const enterpriseType = row
                        .find('td:nth-child(3) span.enterprise_l')
                        .text()
                        .trim();
                    const landline = row
                        .find('td:nth-child(3) span.landline')
                        .text()
                        .trim();
                    const mobilePhone = row
                        .find('td:nth-child(3) span.mobile_num')
                        .text()
                        .trim();
                    const emailAddress = row
                        .find('td:nth-child(3) span.email_add')
                        .text()
                        .trim();

                    const personnel = {
                        male_direct_re: row
                            .find('input[name="male_direct_re"]')
                            .val(),
                        female_direct_re: row
                            .find('input[name="female_direct_re"]')
                            .val(),
                        male_direct_part: row
                            .find('input[name="male_direct_part"]')
                            .val(),
                        female_direct_part: row
                            .find('input[name="female_direct_part"]')
                            .val(),
                        male_indirect_re: row
                            .find('input[name="male_indirect_re"]')
                            .val(),
                        female_indirect_re: row
                            .find('input[name="female_indirect_re"]')
                            .val(),
                        male_indirect_part: row
                            .find('input[name="male_indirect_part"]')
                            .val(),
                        female_indirect_part: row
                            .find('input[name="female_indirect_part"]')
                            .val(),
                        total_personnel: row
                            .find('input[name="total_personnel"]')
                            .val(),
                    };

                    const ApplicantDetails = ApplicantDetailsContainer.find(
                        '.businessInfo input'
                    );

                    ApplicantDetails.filter('#firm_name').val(firmName);
                    ApplicantDetails.filter('#selected_userId').val(userID);
                    ApplicantDetails.filter('#selected_businessID').val(
                        businessID
                    );
                    ApplicantDetails.filter('#selected_applicationId').val(
                        ApplicationID
                    );
                    ApplicantDetails.filter('#address').val(businessAddress);
                    ApplicantDetails.filter('#contact_person').val(fullName); // Add corresponding value
                    ApplicantDetails.filter('#designation').val(designation);
                    ApplicantDetails.filter('#sex').val(sex);
                    ApplicantDetails.filter('#enterpriseType').val(
                        enterpriseType
                    );
                    ApplicantDetails.filter('#landline').val(landline);
                    ApplicantDetails.filter('#mobile_phone').val(mobilePhone);
                    ApplicantDetails.filter('#email').val(emailAddress);
                    ApplicantDetails.filter('#male_direct_re').val(
                        personnel.male_direct_re || '0'
                    );
                    ApplicantDetails.filter('#female_direct_re').val(
                        personnel.female_direct_re || '0'
                    );
                    ApplicantDetails.filter('#male_direct_part').val(
                        personnel.male_direct_part || '0'
                    );
                    ApplicantDetails.filter('#female_direct_part').val(
                        personnel.female_direct_part || '0'
                    );
                    ApplicantDetails.filter('#male_indirect_re').val(
                        personnel.male_indirect_re || '0'
                    );
                    ApplicantDetails.filter('#female_indirect_re').val(
                        personnel.female_indirect_re || '0'
                    );
                    ApplicantDetails.filter('#male_indirect_part').val(
                        personnel.male_indirect_part || '0'
                    );
                    ApplicantDetails.filter('#female_indirect_part').val(
                        personnel.female_indirect_part || '0'
                    );
                    ApplicantDetails.filter('#total_personnel').val(
                        personnel.total_personnel || '0'
                    );

                    Echo.private('viewing-Applicant-events').whisper(
                        'viewing',
                        {
                            applicant_id: ApplicationID,
                            reviewed_by: AUTH_USER_NAME,
                        }
                    );
                    currentlyViewingApplicantId = ApplicationID;

                    getApplicantRequirements(businessID);
                    getEvaluationScheduledDate(businessID, ApplicationID);
                    getProposalDraft(ApplicationID);
                }
            );

            ApplicantDetailsContainer.on('hidden.bs.offcanvas', function () {
                const FormContainer =
                    ApplicantDetailsContainer.find('#projectProposal');
                const ApplicantID = ApplicantDetailsContainer.find(
                    '#selected_applicationId'
                ).val();
                currentlyViewingApplicantId = null;
                Echo.private('viewing-Applicant-events').whisper(
                    'viewing-closed',
                    {
                        applicant_id: ApplicantID,
                    }
                );

                FormContainer.find('input, textarea').val('');
                FormContainer.find(
                    '.input_list, #EquipmentTableBody, #NonEquipmentTableBody'
                ).each(function () {
                    $(this).children().slice(1).remove();
                });
                RequirementsTable.empty();
                clearInitialValues();
            });

            const getApplicantRequirements = async (businessID) => {
                try {
                    const response = await $.ajax({
                        type: 'GET',
                        url: APPLICANT_TAB_ROUTE.GET_APPLICANT_REQUIREMENTS.replace(
                            ':id',
                            businessID
                        ),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                    });
                    populateReqTable(response);
                } catch (error) {
                    console.log(error);
                }
            };

            async function getEvaluationScheduledDate(
                businessID,
                applicationID
            ) {
                try {
                    const response = await $.ajax({
                        type: 'GET',
                        url: APPLICANT_TAB_ROUTE.getEvaluationScheduleDate,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                        data: {
                            business_id: businessID,
                            application_id: applicationID,
                        },
                    });
                    const nofi_dateCont = $('#nofi_ScheduleCont');
                    const setAndUpdateBtn = $('#setEvaluationDate');
                    nofi_dateCont.empty();
                    if (response.Scheduled_date) {
                        nofi_dateCont.append(
                            '<div class="alert alert-primary mb-auto" role="alert">An evaluation date of <strong>' +
                                response.Scheduled_date +
                                '</strong> has been set for this applicant. <p class="my-auto text-secondary">Applicant is already notified through email and notification.</p></div>'
                        );
                        setAndUpdateBtn.text('Update');
                    } else {
                        nofi_dateCont.append(
                            '<div class="alert alert-primary my-auto" role="alert">No evaluation date has been set for this applicant.</div>'
                        );
                    }
                } catch (error) {
                    console.log(error);
                }
            }
            //Get applicant requirements to populate the requirements table
            function populateReqTable(response) {
                RequirementsTable.empty();

                $.each(response, function (index, requirement) {
                    const row = $('<tr>');
                    row.append('<td>' + requirement.file_name + '</td>');
                    row.append('<td>' + requirement.file_type + '</td>');
                    row.append(
                        `<td class="text-center">
              <button class="btn btn-primary viewReq position-relative">View <span class="position-absolute top-0 start-100 translate-middle p-2 ${
                  requirement.remarks === 'Pending'
                      ? 'bg-info'
                      : requirement.remarks === 'Approved'
                        ? 'bg-primary'
                        : 'bg-danger'
              } border border-light rounded-circle">
    <span class="visually-hidden">New alerts</span>
  </span>
</button>
              </td>`
                    );
                    row.append(
                        '<input type="hidden"  name="file_id" value="' +
                            requirement.id +
                            '">'
                    );
                    row.append(
                        '<input type="hidden"  name="file_url" value="' +
                            requirement.full_url +
                            '">'
                    );
                    row.append(
                        '<input type="hidden"  name="can_edit" value="' +
                            requirement.can_edit +
                            '">'
                    );
                    row.append(
                        '<input type="hidden"  name"remark" value="' +
                            requirement.remarks +
                            '">'
                    );
                    row.append(
                        '<input type="hidden"  name="created_at" value="' +
                            requirement.created_at +
                            '">'
                    );
                    row.append(
                        '<input type="hidden"  name="updated_at" value="' +
                            requirement.updated_at +
                            '">'
                    );

                    RequirementsTable.append(row);
                });
            }
            //View applicant requirements
            RequirementsTable.on('click', '.viewReq', async function () {
                showProcessToast('Retrieving file...');
                const row = $(this).closest('tr');
                const fileID = row
                    .find('input[type="hidden"][name="file_id"]')
                    .val();
                const file_Name = row.find('td:nth-child(1)').text();
                const fileUrl = row
                    .find('input[type="hidden"][name="file_url"]')
                    .val();
                const fileType = row.find('td:nth-child(2)').text();
                const uploadedDate = row
                    .find('input[type="hidden"][name="created_at"]')
                    .val();
                const updatedDate = row
                    .find('input[type="hidden"][name="updated_at"]')
                    .val();
                const uploader = $('#contact_person').val();

                const reviewFileModalInput =
                    ReviewFileModalContainer.find('input');

                reviewFileModalInput.filter('#selectedFile_ID').val(fileID);
                reviewFileModalInput.filter('#fileName').val(file_Name);
                reviewFileModalInput.filter('#filetype').val(fileType);
                reviewFileModalInput.filter('#file_url').val(fileUrl);
                reviewFileModalInput.filter('#fileUploaded').val(uploadedDate);
                reviewFileModalInput.filter('#fileUploadedBy').val(updatedDate);
                reviewFileModalInput.filter('#fileUploadedBy').val(uploader);
                await retrieveAndDisplayFile(fileUrl, fileType);
                hideProcessToast();
            });

            //retrieve and display file function as base64 format for both pdf and img type
            async function retrieveAndDisplayFile(fileUrl, fileType) {
                try {
                    const response = await $.ajax({
                        url: APPLICANT_TAB_ROUTE.SHOW_REQUIREMENT_FILE,
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                        data: {
                            file_url: fileUrl,
                        },
                    });

                    const fileContent = $('#fileContent');
                    fileContent.empty(); // Clear any previous content

                    if (fileType === 'pdf') {
                        // Display PDF in an iframe
                        const base64PDF =
                            'data:application/pdf;base64,' +
                            response.base64File +
                            '';
                        const embed = $('<iframe>', {
                            src: base64PDF,
                            type: 'application/pdf',
                            width: '100%',
                            height: '100%',
                            frameborder: '0',
                            allow: 'fullscreen',
                        });
                        fileContent.append(embed);
                    } else {
                        // Display Image
                        const img = $('<img>', {
                            src: `data:${fileType};base64,${response.base64File}`,
                            class: 'img-fluid',
                        });
                        fileContent.append(img);
                    }
                } catch (error) {
                    console.log(error);
                } finally {
                    const reviewFileModal = new bootstrap.Modal(
                        $('#reviewFileModal')[0]
                    );
                    reviewFileModal.show();
                }
            }

            //TODO: need some working
            ReviewedFileFormContainer.on('submit', async function (e) {
                e.preventDefault();

                const action = $(e.originalEvent.submitter).val();
                const selected_id = ReviewFileModalContainer.find(
                    'input[type="hidden"]#selectedFile_ID'
                ).val();
                const isconfimed = await createConfirmationModal({
                    title: 'Review File',
                    titleBg: 'bg-primary',
                    message: `Are you sure you want to ${action} this file?`,
                    confirmText: 'Yes',
                    confirmButtonClass: 'btn-primary',
                    cancelText: 'No',
                });
                if (!isconfimed) {
                    return;
                }
                showProcessToast();
                const formData = $(this).serialize() + '&action=' + action;
                try {
                    const response = await $.ajax({
                        method: 'PUT',
                        url: APPLICANT_TAB_ROUTE.UPDATE_APPLICANT_REQUIREMENTS.replace(
                            ':id',
                            selected_id
                        ),
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                        processData: false,
                    });
                    hideProcessToast();
                    setTimeout(() => {
                        showToastFeedback('text-bg-success', response.success);
                    }, 500);
                } catch (error) {
                    showToastFeedback(
                        'text-bg-danger',
                        error.responseJSON.error
                    );
                }
            });

            //set evaluation date
            $('#setEvaluationDate').on('click', async function () {
                const container =
                    ApplicantDetailsContainer.find('.businessInfo');
                const user_id = container.find('#selected_userId').val();
                const application_id = container
                    .find('#selected_applicationId')
                    .val();
                const business_id = container
                    .find('#selected_businessID')
                    .val();
                const Scheduledate = $('#evaluationSchedule-datepicker').val();
                const confirmed = await createConfirmationModal({
                    title: 'Evaluation Date',
                    titleBg: 'bg-primary',
                    message:
                        'Are you sure you want to set an evaluation date for this applicant?',
                    confirmText: 'Yes',
                    confirmButtonClass: 'btn-primary',
                    cancelText: 'No',
                });

                if (!confirmed) {
                    return;
                }
                showProcessToast('Setting evaluation date...');
                try {
                    const response = await $.ajax({
                        type: 'PUT',
                        url: APPLICANT_TAB_ROUTE.setEvaluationScheduleDate,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                        data: {
                            user_id: user_id,
                            application_id: application_id,
                            business_id: business_id,
                            evaluation_date: Scheduledate,
                        },
                    });
                    if (response.success == true) {
                        hideProcessToast();
                        await getEvaluationScheduledDate(
                            business_id,
                            application_id
                        );
                        showToastFeedback('text-bg-success', response.message);
                    }
                } catch (error) {
                    hideProcessToast();
                    showToastFeedback(
                        'text-bg-danger',
                        error.responseJSON.error
                    );
                }
            });

            TNArejectionModal.on('show.bs.modal', function () {
                const selectedApplicantUserId = ApplicantDetailsContainer.find(
                    'input[type="hidden"]#selected_userId'
                ).val();
                const selectedApplicantApplicationId =
                    ApplicantDetailsContainer.find(
                        'input[type="hidden"]#selected_applicationId'
                    ).val();
                const modalHiddenInput = $(this).find('input[type="hidden"]');
                modalHiddenInput
                    .filter('input[name="applicant_id"]')
                    .val(selectedApplicantUserId);
                modalHiddenInput
                    .filter('input[name="application_id"]')
                    .val(selectedApplicantApplicationId);
            });

            $('#TNARejectionForm').on('submit', async function (e) {
                e.preventDefault();
                const isConfirmed = await createConfirmationModal({
                    title: 'TNA Rejection',
                    titleBg: 'bg-danger',
                    message: 'Are you sure you want to reject this applicant?',
                    confirmText: 'Yes',
                    confirmButtonClass: 'btn-primary',
                    cancelText: 'No',
                });

                if (!isConfirmed) {
                    return;
                }

                showProcessToast('Rejecting applicant...');
                const formData = new FormData(this);
                try {
                    const response = await $.ajax({
                        type: 'POST',
                        url: APPLICANT_TAB_ROUTE.REJECT_APPLICATION_TNA,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                    });

                    if (response.success == true) {
                        hideProcessToast();
                        closeModal('#tnaEvaluationResultModal');
                        showToastFeedback('text-bg-success', response.message);
                    }
                } catch (error) {
                    hideProcessToast();
                    showToastFeedback(
                        'text-bg-danger',
                        error.responseJSON.error
                    );
                }
            });

            const toggleDeleteRowButton = (container, elementSelector) => {
                const element = container.find(elementSelector);
                const deleteRowButton = container
                    .children('.addAndRemoveButton_Container')
                    .find('.removeRowButton');
                element.length === 1
                    ? deleteRowButton.prop('disabled', true)
                    : deleteRowButton.prop('disabled', false);
            };

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

            $('#projectProposal .card-body').each(function () {
                const container = $(this);

                const table = container.find('table');
                if (table.length) {
                    toggleDeleteRowButton(container, 'tbody tr');
                } else {
                    toggleDeleteRowButton(container, '.input_list');
                }
            });

            const equipmentAndNonEquipmentTablesConfigs = {
                equipmentDetails: {
                    id: 'EquipmentTable',
                    selectors: {
                        Qty: '.EquipmentQTY',
                        Actual_Particulars: '.Particulars',
                        Cost: '.EquipmentCost',
                    },
                    requiredFields: ['Qty', 'Actual_Particulars', 'Cost'],
                },
                nonEquipmentDetails: {
                    id: 'NonEquipmentTable',
                    selectors: {
                        Qty: '.NonEquipmentQTY',
                        Actual_Particulars: '.NonParticulars',
                        Cost: '.NonEquipmentCost',
                    },
                    requiredFields: ['Qty', 'Actual_Particulars', 'Cost'],
                },
            };

            function projectProposalFormData() {
                const FormContainer = $('#projectProposal');
                const FormData = FormContainer.serializeArray();
                let FormDataObjects = {};

                $.each(FormData, function (i, v) {
                    if (v.name.includes('[]')) {
                        FormDataObjects[v.name] = FormDataObjects[v.name]
                            ? [...FormDataObjects[v.name], v.value]
                            : [v.value];
                    } else {
                        FormDataObjects[v.name] = v.value;
                    }
                });

                return (FormDataObjects = {
                    ...FormDataObjects,
                    ...TableDataExtractor(
                        equipmentAndNonEquipmentTablesConfigs
                    ),
                });
            }

            const revertbutton = $('.revertButton');

            const populateProjectProposalForm = (draftData) => {
                storeInitialValues('projectID', draftData.projectID);
                storeInitialValues('projectTitle', draftData.projectTitle);
                storeInitialValues(
                    'dateOfFundRelease',
                    draftData.dateOfFundRelease
                );
                storeInitialValues('fundAmount', draftData.fundAmount);

                $('#projectID').val(draftData.projectID);
                $('#projectTitle').val(draftData.projectTitle);
                $('#dateOfFundRelease').val(draftData.dateOfFundRelease);
                $('#fundAmount').val(draftData.fundAmount);

                // Populate expected outputs
                const expectedOutputsContainer = $(
                    '#ExpectedOutputTextareaContainer .input_list'
                );
                expectedOutputsContainer.empty();
                draftData.expectedOutputs.forEach((output, index) => {
                    const outputKey = `expectedOutputs[${index}]`;
                    storeInitialValues(outputKey, output);
                    expectedOutputsContainer.append(`
                <div class="col-12 mb-2">
                    <textarea class="form-control" name="expectedOutputs[]" rows="3" data-initial-key="${outputKey}">${output}</textarea>
                </div>
            `);
                });

                // Populate equipment details
                const equipmentTableBody = $('#EquipmentTable body tr');
                equipmentTableBody.empty();
                draftData.equipmentDetails.forEach((equipment, index) => {
                    const qtyKey = `equipmentQty[${index}]`;
                    const particularsKey = `equipmentParticulars[${index}]`;
                    const costKey = `equipmentCost[${index}]`;

                    storeInitialValues(qtyKey, equipment.Qty);
                    storeInitialValues(
                        particularsKey,
                        equipment.Actual_Particulars
                    );
                    storeInitialValues(costKey, equipment.Cost || '');

                    equipmentTableBody.append(`
                <tr>
                    <td><input type="number" class="form-control EquipmentQTY" data-initial-key="${qtyKey}" value="${
                        equipment.Qty
                    }"/></td>
                    <td><input type="text" class="form-control Particulars" data-initial-key="${particularsKey}" value="${
                        equipment.Actual_Particulars
                    }"/></td>
                    <td><input type="text" class="form-control EquipmentCost" data-initial-key="${costKey}" value="${
                        equipment.Cost || ''
                    }"/></td>
                </tr>
            `);
                });

                // Populate non-equipment details
                const nonEquipmentTableBody = $('#NonEquipmentTable body tr');
                nonEquipmentTableBody.empty();
                draftData.nonEquipmentDetails.forEach((nonEquipment, index) => {
                    const qtyKey = `nonEquipmentQty[${index}]`;
                    const particularsKey = `nonEquipmentParticulars[${index}]`;
                    const costKey = `nonEquipmentCost[${index}]`;

                    storeInitialValues(qtyKey, nonEquipment.Qty);
                    storeInitialValues(
                        particularsKey,
                        nonEquipment.Actual_Particulars
                    );
                    storeInitialValues(costKey, nonEquipment.Cost || '');

                    nonEquipmentTableBody.append(`
                <tr>
                    <td><input type="number" class="form-control NonEquipmentQTY" data-initial-key="${qtyKey}" value="${
                        nonEquipment.Qty
                    }"/></td>
                    <td><input type="text" class="form-control NonParticulars" data-initial-key="${particularsKey}" value="${
                        nonEquipment.Actual_Particulars
                    }"/></td>
                    <td><input type="text" class="form-control NonEquipmentCost" data-initial-key="${costKey}" value="${
                        nonEquipment.Cost || ''
                    }"/></td>
                </tr>
            `);
                });
                trackChanges();
            };
            const storeInitialValues = (key, value) => {
                ProjectProposalFormInitialValue[key] = value;
            };

            const clearInitialValues = () => {
                ProjectProposalFormInitialValue = {};
            };

            // Function to track changes in form inputs
            function trackChanges() {
                $('#projectProposal').on(
                    'input',
                    'input, textarea',
                    function () {
                        let isModified = false;

                        // Check if any field has been modified
                        $('#projectProposal')
                            .find('input, textarea')
                            .each(function () {
                                const key = $(this).data('initial-key');
                                const currentValue = $(this).val();
                                const initialValue =
                                    ProjectProposalFormInitialValue[key];

                                if (currentValue !== initialValue) {
                                    isModified = true;
                                    return false; // Exit loop if a modification is found
                                }
                            });

                        // Enable or disable the revert button based on whether there are changes
                        revertbutton.prop('disabled', !isModified);
                    }
                );
            }

            // Handle revert button click
            revertbutton.on('click', function () {
                // Revert all fields to their initial values
                $('#projectProposal')
                    .find('input, textarea')
                    .each(function () {
                        const key = $(this).data('initial-key');
                        const initialValue =
                            ProjectProposalFormInitialValue[key];
                        $(this).val(initialValue);
                    });

                // Disable the revert button again after reverting
                revertbutton.prop('disabled', true);
            });

            const getProposalDraft = async (applicationID) => {
                try {
                    const response = await $.ajax({
                        type: 'GET',
                        url: APPLICANT_TAB_ROUTE.GET_PROJECT_PROPOSAL_DRAFT.replace(
                            ':ApplicationId',
                            applicationID
                        ),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                    });

                    response ? populateProjectProposalForm(response) : null;
                } catch (error) {
                    console.error(error);
                }
            };

            //submit project proposal
            $('#DraftProjectProposal, #submitProjectProposal').on(
                'click',
                async function (event) {
                    const action = $(this).data('action');
                    event.preventDefault();

                    const thisAction =
                        action == 'DraftForm' ? 'Draft' : 'Submit';

                    const isconfirmed = await createConfirmationModal({
                        title: `${thisAction} Project Proposal`,
                        titleBg: 'bg-primary',
                        message: `Are you sure you want to ${thisAction} this file?`,
                        confirmText: 'Yes',
                        confirmButtonClass: 'btn-primary',
                        cancelText: 'No',
                    });

                    if (!isconfirmed) {
                        return;
                    }

                    showProcessToast(`${thisAction}ing Project Proposal...`);

                    const application_Id = $('#selected_applicationId').val();
                    const business_id = $('#selected_businessID').val();

                    const formdata = projectProposalFormData();
                    console.log(formdata);
                    formdata.action = action;
                    formdata.application_id = application_Id;
                    formdata.business_id = business_id;

                    try {
                        const response = await $.ajax({
                            type: 'POST',
                            url: APPLICANT_TAB_ROUTE.STORE_PROJECT_PROPOSAL,
                            headers: {
                                'X-CSRF-TOKEN': $(
                                    'meta[name="csrf-token"]'
                                ).attr('content'),
                            },
                            data: formdata,
                        });

                        if (response.success === 'true') {
                            hideProcessToast();
                            closeOffcanvasInstances('#applicantDetails');
                            setTimeout(() => {
                                showToastFeedback(
                                    'text-bg-success',
                                    response.message
                                );
                            }, 500);
                        }
                    } catch (error) {
                        hideProcessToast();
                        showToastFeedback(
                            'text-bg-danger',
                            error.responseJSON.message
                        );
                    }
                }
            );

            ApplicantProgressContainer.smartWizard({
                selected: 0,
                theme: 'dots',
                transition: {
                    animation: 'slideHorizontal',
                },
                toolbar: {
                    showNextButton: true, // show/hide a Next button
                    showPreviousButton: true, // show/hide a Previous button
                    position: 'both buttom', // none/ top/ both bottom
                },
            });

            await getApplicants();
        },
    };
    return functions;
}
