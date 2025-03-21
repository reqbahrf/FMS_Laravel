import '../echo';
import { customFormatNumericInput } from '../Utilities/input-utils';
import createConfirmationModal from '../Utilities/confirmation-modal';
import {
    formatNumber,
    customDateFormatter,
    closeOffcanvasInstances,
    closeModal,
} from '../Utilities/utilFunctions';
import {
    showToastFeedback,
    showProcessToast,
    hideProcessToast,
} from '../Utilities/feedback-toast';
import getProjectPaymentHistory from '../Utilities/project-payment-history';
import FormEvents from '../components/ProjectFormEvents';
import EsignatureHandler from '../Utilities/EsignatureHandler';
import NotificationManager from '../Utilities/NotificationManager';
import ActivityLogHandler from '../Utilities/ActivityLogHandler';
import NavigationHandler from '../Utilities/TabNavigationHandler';
import DarkMode from '../Utilities/DarkModeHandler';
import ApplicantDataTable from '../Utilities/applicant-datatable';
import PaymentHandler from './PaymentHandler';
import ProjectInfoSheet from './project-form-class/ProjectInfoSheet';
import ProjectDataSheet from './project-form-class/ProjectDataSheet';
import ProjectStatusReportSheet from './project-form-class/ProjectStatusReportSheet';
import FileCoopRequirementHandler from '../staff/FileCoopRequirementHandler';

import DataTable from 'datatables.net-bs5';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';
// import 'datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css';
// import 'datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css';
// import 'datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css';
// import 'datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css';
// import 'datatables.net-scroller-bs5/css/scroller.bootstrap5.min.css';
import '../Utilities/dataTableCustomConfig';
window.DataTable = DataTable;
import 'datatables.net-buttons-bs5';
import 'datatables.net-buttons/js/buttons.html5.mjs';
import 'datatables.net-fixedcolumns-bs5';
import 'datatables.net-fixedheader-bs5';
import 'datatables.net-responsive-bs5';
import 'datatables.net-scroller-bs5';
import 'smartwizard/dist/css/smart_wizard_all.css';
import smartWizard from 'smartwizard';
import { processError } from '../Utilities/error-handler-util';
window.smartWizard = smartWizard;
const MAIN_CONTENT_CONTAINER = $('#main-content');
const ACTIVITY_LOG_MODAL = $('#userActivityLogModal');

const darkMode = new DarkMode();
darkMode.initializeTheme();

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

const activityLog = new ActivityLogHandler(
    ACTIVITY_LOG_MODAL,
    USER_ROLE,
    'personal'
);
activityLog.initPersonalActivityLog();

/**
 * Initializes the staff page by setting up event listeners and calling the necessary functions.
 *
 * @returns {Promise<functions>} An Object containing the function for Dashboard, Projects, and AddProject.
 */
async function initializeStaffPageJs() {
    const functions = {
        Dashboard: async () => {
            let classInstance = {
                paymentHandler: null,
                pisClass: null,
                pdsClass: null,
                psrClass: null,
                projectFileClass: null,
            };

            const yearToLoadSelector = $('#yearSelector');
            //Foramt Input with Id paymentAmount
            customFormatNumericInput('#paymentAmount');
            customFormatNumericInput('#days_open');
            customFormatNumericInput('#updateOpenDays');

            const processYearListSelector = (
                yearsArray,
                currentSelectedYear
            ) => {
                return new Promise((resolve, reject) => {
                    try {
                        if (!Array.isArray(yearsArray)) {
                            throw new Error(
                                'Years must be provided as an array'
                            );
                        }

                        if (!yearToLoadSelector || !yearToLoadSelector.length) {
                            throw new Error('Year selector not found');
                        }

                        const currentYear = new Date().getFullYear();
                        yearToLoadSelector.empty();

                        const options = yearsArray.map((year) => {
                            const selected =
                                year == (currentSelectedYear ?? currentYear);
                            return $('<option>', {
                                value: year,
                                text: year,
                                selected: selected,
                            });
                        });

                        yearToLoadSelector.append(options);
                        resolve();
                    } catch (error) {
                        console.error(
                            'Error in processYearListSelector:',
                            error
                        );
                        reject(error);
                    }
                });
            };

            yearToLoadSelector.on('change', async function () {
                const selectedYear = $(this).val();
                await getDashboardChartData(selectedYear);
            });
            // initialize datatable
            const HandledProjectDataTable = $('#handledProject').DataTable({
                autoWidth: false,
                responsive: true,
                columns: [
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
                        title: 'Date Approved',
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
                        width: '20%',
                    },
                    {
                        targets: 1,
                        width: '15%',
                    },
                    {
                        targets: 2,
                        width: '15%',
                    },
                    {
                        targets: 3,
                        width: '15%',
                        className: 'text-end',
                    },
                    {
                        targets: 4,
                        width: '15%',
                        className: 'text-center',
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
            //Data table custom sorter for quarter

            const PaymentHistoryTable = $('#paymentHistoryTable');
            //TODO: add quarterly column on this table
            const PaymentHistoryDataTable = PaymentHistoryTable.DataTable({
                fixedColumns: true,
                autoWidth: false,
                responsive: true,
                columns: [
                    {
                        title: 'Reference #',
                        width: '10%',
                    },
                    {
                        title: 'Amount (₱)',
                        width: '10%',
                    },
                    {
                        title: 'Payment Method',
                        width: '10%',
                    },
                    {
                        title: 'Status',
                        width: '5%',
                    },
                    {
                        title: 'Quarter',
                        width: '10%',
                        type: 'quarter',
                    },
                    {
                        title: 'Due Date',
                        width: '15%',
                    },
                    {
                        title: 'Date Completed',
                        width: '15%',
                    },
                    {
                        title: 'Last Modified',
                        width: '15%',
                    },
                    {
                        title: 'Action',
                        width: '3%',
                    },
                ],
                order: [[4, 'asc']],
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
            let ChartData = null;
            const createMonthlyDataChart = (applicant, ongoing, completed) => {
                const monthlyDataChart = {
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
                    if (ChartData) {
                        ChartData.destroy();
                    }
                    ChartData = new ApexCharts(
                        document.querySelector('#lineChart'),
                        monthlyDataChart
                    );
                    ChartData.render();
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

            const getDashboardChartData = async (year = null) => {
                try {
                    const selectedYear = year || '';
                    const response = await $.ajax({
                        type: 'GET',
                        url: DASHBOARD_TAB_ROUTE.GET_MONTHLY_PROJECTS_CHARTDATA.replace(
                            ':yearToLoad',
                            selectedYear
                        ),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                    });
                    const monthlyData = response.monthlyData;
                    const listOfYears = response.listOfYears;
                    const currentSelectedYear = response.currentSelectedYear;
                    await processYearListSelector(
                        listOfYears,
                        currentSelectedYear
                    );
                    await processMonthlyDataChart(monthlyData);
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

            const getHandleProject = async () => {
                try {
                    const response = await fetch(
                        DASHBOARD_TAB_ROUTE.GET_HANDLED_PROJECTS,
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
                                /*html*/ `<p class="project-title">${project.project_title}</p><input type="hidden" class="project-id" value="${project.Project_id}">`,
                                /*html*/ `<p class="firm_name">
                                        ${project.firm_name}
                                    </p>
                                    <input
                                        type="hidden"
                                        class="business_id"
                                        value="${project.business_id}"
                                    />
                                    <input
                                        type="hidden"
                                        class="business_enterprise_type"
                                        value="${project.enterprise_type}"
                                    />
                                    <input
                                        type="hidden"
                                        class="business_enterprise_level"
                                        value="${project.enterprise_level}"
                                    />
                                    <input
                                        type="hidden"
                                        class="business_address"
                                        value="${
                                            project.landMark +
                                            ', ' +
                                            project.barangay +
                                            ', ' +
                                            project.city +
                                            ', ' +
                                            project.province +
                                            ', ' +
                                            project.region
                                        }"
                                    />
                                    <input
                                        type="hidden"
                                        class="dateApplied"
                                        value="${project.date_applied}"
                                    />
                                    <input
                                        type="hidden"
                                        class="building_value"
                                        value="${project.building_value}"
                                    />
                                    <input
                                        type="hidden"
                                        class="equipment_value"
                                        value="${project.equipment_value}"
                                    />
                                    <input
                                        type="hidden"
                                        class="working_capital"
                                        value="${project.working_capital}"
                                    />`,
                                /*html*/ `<p class="owner_name">
                                        ${
                                            (project.prefix
                                                ? project.prefix
                                                : '') +
                                            ' ' +
                                            project.f_name +
                                            ' ' +
                                            project.l_name +
                                            ' ' +
                                            (project.suffix
                                                ? project.suffix
                                                : ' ')
                                        }
                                    </p>
                                    <input
                                        type="hidden"
                                        class="sex"
                                        value="${project.sex}"
                                    />
                                    <input
                                        type="hidden"
                                        class="birth_date"
                                        value="${project.birth_date}"
                                    />
                                    <input
                                        type="hidden"
                                        class="landline"
                                        value="${project.landline ?? ''}"
                                    />
                                    <input
                                        type="hidden"
                                        class="mobile_phone"
                                        value="${project.mobile_number}"
                                    />
                                    <input
                                        type="hidden"
                                        class="email"
                                        value="${project.email}"
                                    />`,
                                /*html*/ `${
                                    formatNumber(refunded_amount) +
                                    '/' +
                                    formatNumber(Actual_Amount)
                                }<span
                                        class="badge ms-1 text-white bg-primary"
                                        >${percentage}%
                                </span>
                                    <input
                                        type="hidden"
                                        class="approved_amount"
                                        value="${project.Approved_Amount}"
                                    />
                                    <input
                                        type="hidden"
                                        class="fee_applied"
                                        value="${project.fee_applied}"
                                    />
                                    <input
                                        type="hidden"
                                        class="actual_amount"
                                        value="${Actual_Amount}"
                                    />`,
                                customDateFormatter(project.date_approved),
                                /*html*/ `<span
                                   class="badge ${(() => {
                                       switch (project.application_status) {
                                           case 'approved':
                                               return 'bg-warning';
                                           case 'ongoing':
                                               return 'bg-primary';
                                           case 'completed':
                                               return 'bg-success';
                                           default:
                                               return '';
                                       }
                                   })()} project-status"
                                    >${project.application_status}</span
                                ><input type="hidden" class="application_id" value="${project.application_id}">`,
                                /*html*/ `<button
                                    class="btn btn-primary handleProjectbtn"
                                    type="button"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#handleProjectOff"
                                    aria-controls="handleProjectOff"
                                >
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
             * @param {string<'approved' | 'ongoing' | 'completed'>} project_status - The status of the project (approved, ongoing, completed)
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
                try {
                    const submissionMethod = $(this).attr(
                        'data-submissionmethod'
                    );

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
                    switch (submissionMethod) {
                        case 'add':
                            await classInstance.paymentHandler.storePaymentRecords();
                            break;
                        case 'update':
                            await classInstance.paymentHandler.updatePaymentRecords();
                            break;
                        default:
                            throw new Error('Submission method is not defined');
                    }
                } catch (error) {
                    showToastFeedback(
                        'text-bg-danger',
                        error?.responseJSON?.message ||
                            error?.message ||
                            'Failed to save payment record'
                    );
                }
            });

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
                    PaymentHandler.toUpdatePaymentRecord(
                        button.closest('tr'),
                        modal.find('#paymentForm')
                    );
                }
            });

            const ProjectLedgerInput = $('#projectLedgerLink');
            const ProjectLedgerSubmitBtn = $('#saveProjectLedgerLink');

            ProjectLedgerSubmitBtn.on('click', function () {
                const project_id = $('#ProjectID').val();
                const ProjectLedgerLink = $('#projectLedgerLink').val();
                const action = $(this).attr('data-action');
                try {
                    switch (action) {
                        case 'edit':
                            ProjectLedgerInput.prop('readonly', false);
                            $(this).attr('data-action', 'save').text('Save');
                            break;
                        case 'save':
                            updateOrCreateProjectLedger(
                                project_id,
                                ProjectLedgerLink
                            );
                            break;
                        default:
                            throw new Error('Action is not defined');
                    }
                } catch (error) {
                    processError('Failed to save project ledger', error);
                }
            });

            const updateOrCreateProjectLedger = async (
                project_id,
                ProjectLedgerLink
            ) => {
                try {
                    const response = await $.ajax({
                        type: 'PUT',
                        url: DASHBOARD_TAB_ROUTE.UPDATE_OR_CREATE_PROJECT_LEDGER,
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
                        url: DASHBOARD_TAB_ROUTE.GET_PROJECT_LEDGER.replace(
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

            let pisClass;
            let pdsClass;
            let psrClass;
            let projectFileClass;

            $('#handledProjectTableBody').on(
                'click',
                '.handleProjectbtn',
                async function () {
                    try {
                        const handledProjectRow = $(this).closest('tr');
                        const hiddenInputs = handledProjectRow.find(
                            'input[type="hidden"]'
                        );
                        const offCanvaReadonlyInputs = $(
                            '#handleProjectOff'
                        ).find('input, #FundedAmount');

                        // Cache values from the row
                        const project_status = handledProjectRow
                            .find('span.project-status')
                            .text()
                            .trim();
                        const application_id = hiddenInputs
                            .filter('.application_id')
                            .val();
                        const project_id = hiddenInputs
                            .filter('.project-id')
                            .val();
                        const projectTitle = handledProjectRow
                            .find('p.project-title')
                            .text()
                            .trim();
                        const firmName = handledProjectRow
                            .find('p.firm_name')
                            .text()
                            .trim();
                        const cooperatorName = handledProjectRow
                            .find('p.owner_name')
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

                        const fee_applied = hiddenInputs
                            .filter('.fee_applied')
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
                        offCanvaReadonlyInputs
                            .filter('#ProjectID')
                            .val(project_id);
                        offCanvaReadonlyInputs
                            .filter('#ProjectTitle')
                            .val(projectTitle);
                        offCanvaReadonlyInputs
                            .filter('#ApprovedAmount')
                            .val(formatNumber(parseFloat(approved_amount)));
                        offCanvaReadonlyInputs
                            .filter('#appliedDate')
                            .val(customDateFormatter(dateApplied));
                        offCanvaReadonlyInputs
                            .filter('#FirmName')
                            .val(firmName);
                        offCanvaReadonlyInputs
                            .filter('#CooperatorName')
                            .val(cooperatorName);
                        offCanvaReadonlyInputs.filter('#sex').val(sex);
                        offCanvaReadonlyInputs
                            .filter('#landline')
                            .val(landline);
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
                            .val(formatNumber(buildingAsset));
                        offCanvaReadonlyInputs
                            .filter('#equipmentAsset')
                            .val(formatNumber(equipmentAsset));
                        offCanvaReadonlyInputs
                            .filter('#workingCapitalAsset')
                            .val(formatNumber(workingCapitalAsset));

                        offCanvaReadonlyInputs
                            .filter('#FundedAmount')
                            .html(
                                /*html*/ `${formatNumber(parseFloat(actual_amount))} <span class="fee_text text-muted">(applied ${fee_applied} %)</span>`
                            );
                        const formContainer = $('#SheetFormDocumentContainer');

                        if (classInstance.pisClass) {
                            classInstance.pisClass.destroy();
                        }

                        if (classInstance.pdsClass) {
                            classInstance.pdsClass.destroy();
                        }

                        classInstance.pisClass = new ProjectInfoSheet(
                            formContainer,
                            project_id,
                            business_id,
                            application_id
                        );

                        if (classInstance.projectFileClass) {
                            classInstance.projectFileClass.destroy();
                        }

                        classInstance.projectFileClass =
                            new FileCoopRequirementHandler(
                                ProjectFileLinkDataTable
                            );

                        classInstance.pdsClass = new ProjectDataSheet(
                            formContainer,
                            project_id
                        );

                        if (classInstance.psrClass) {
                            classInstance.psrClass.destroy();
                        }
                        classInstance.psrClass = new ProjectStatusReportSheet(
                            formContainer,
                            project_id,
                            business_id,
                            application_id
                        );

                        handleProjectOffcanvasContent(project_status);
                        if (classInstance.paymentHandler) {
                            classInstance.paymentHandler.destroy();
                        }
                        classInstance.paymentHandler = new PaymentHandler(
                            PaymentHistoryDataTable,
                            project_id,
                            actual_amount
                        );
                        const results = await Promise.allSettled([
                            classInstance.paymentHandler.getPaymentAndCalculation(),
                            getProjectLedger(project_id),
                            classInstance.projectFileClass.getProjectLinks(
                                project_id
                            ),
                            getQuarterlyReports(project_id),
                        ]);

                        results.forEach((result) => {
                            if (result.status === 'rejected') {
                                console.error('Promise failed:', result.reason);
                            }
                        });
                    } catch (error) {
                        processError(
                            'Error loading project details: ',
                            error,
                            true
                        );
                    }
                }
            );

            PaymentHistoryTable.on(
                'click',
                '.delete--payment--Btn',
                function (e) {
                    const selectedRow = $(this).closest('tr');
                    const reference_number = selectedRow
                        .find('td:eq(0)')
                        .text()
                        .trim();
                    paymentHandler
                        .deletePaymentRecord(reference_number, {
                            options: {
                                confirm: `Are you sure you want to delete this payment record? ${reference_number}`,
                            },
                        })
                        .then(() => {
                            selectedRow.remove();
                        });
                }
            );

            //     // Add event listener to file input to update file name
            //     $('#requirements_file')
            //         .off('change')
            //         .on('change', function (e) {
            //             const fileName = e.target.files[0]
            //                 ? e.target.files[0].name
            //                 : '';
            //             $('#requirements_file_name').val(fileName);
            //         });
            // }

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
                            DASHBOARD_TAB_ROUTE.DELETE_PROJECT_LINK.replace(
                                ':file_id',
                                uniqueVal
                            ),
                        afterDelete: async (project_id) =>
                            await projectFileClass.getProjectLinks(project_id),
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
                            DASHBOARD_TAB_ROUTE.DELETE_QUARTERLY_REPORT.replace(
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

                const processToast = showProcessToast('Deleting Record...');

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

                    hideProcessToast(processToast);
                    showToastFeedback('text-bg-success', response.message);
                    closeModal('#deleteRecordModal');
                    modal.hide();

                    if (afterDeleteFn) {
                        await afterDeleteFn(project_id);
                    }
                } catch (error) {
                    hideProcessToast(processToast);
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
                        url: DASHBOARD_TAB_ROUTE.UPDATE_PROJECT_STATE,
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
                    showToastFeedback(
                        'text-bg-success',
                        response?.message || response?.responseJSON?.message
                    );
                } catch (error) {
                    showToastFeedback(
                        'text-bg-danger',
                        error.responseJSON.message
                    );
                } finally {
                    await getHandleProject();
                }
            });

            const ExportAndLocalProductsConfig = {
                localProduct: {
                    id: 'localMarketTable',
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
                        'Are you sure you want to create this quarterly report?',
                    confirmText: 'Yes',
                    confirmButtonClass: 'btn-primary',
                    cancelText: 'No',
                });

                if (!isConfirmed) {
                    return;
                }
                const processToast = showProcessToast(
                    'Creating Quarterly Report...'
                );
                const project_id = $('#ProjectID').val();
                const formData =
                    $(this).serialize() + '&project_id=' + project_id;
                $.ajax({
                    type: 'POST',
                    url: DASHBOARD_TAB_ROUTE.STORE_NEW_QUARTERLY_REPORT,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content'
                        ),
                    },
                    success: function (response) {
                        getQuarterlyReports(project_id);
                        hideProcessToast(processToast);
                        showToastFeedback('text-bg-success', response.message);
                    },
                    error: function (error) {
                        hideProcessToast(processToast);
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
             * @return {Promise<void>}
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
                            DASHBOARD_TAB_ROUTE.GET_QUARTERLY_REPORT_RECORDS +
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
                        const newRow = /*html*/ `
                            <tr>
                                <td class="text-center">${report.quarter}</td>
                                <td class="text-center">
                                    <span
                                        class="badge rounded-pill ${
                                            report.coop_response === 'Submitted'
                                                ? 'bg-success'
                                                : 'text-bg-secondary'
                                        }"
                                        >${report.coop_response}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span
                                        class="badge rounded-pill ${
                                            report.report_status === 'open'
                                                ? 'bg-primary'
                                                : 'text-bg-secondary'
                                        }"
                                    >
                                        ${report.report_status}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span>
                                        ${report.open_until ?? 'Not set'} </span
                                    ><br />
                                    <span class="text-secondary fst-italic">
                                        ${
                                            report.open_until
                                                ? 'will close in ' +
                                                  report.remaining_days +
                                                  ' Day/s'
                                                : ' '
                                        }
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button
                                        type="button"
                                        class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#updateQuarterlyRecordModal"
                                        data-record-id="${report.id}"
                                    >
                                        <i class="ri-file-edit-fill"></i>
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-danger btn-sm deleteQuarterlyRecord"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteRecordModal"
                                        data-record-id="${report.id}"
                                        data-delete-record-type="quarterlyRecord"
                                    >
                                        <i class="ri-delete-bin-fill"></i>
                                    </button>
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
                        url: DASHBOARD_TAB_ROUTE.UPDATE_QUARTERLY_REPORT.replace(
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
                        title: 'Requirement #',
                    },
                    {
                        title: 'Amount',
                    },
                    {
                        title: 'Payment Method',
                    },
                    {
                        title: 'Payment Status',
                    },
                    {
                        title: 'Quarter',
                        type: 'quarter',
                    },
                    {
                        title: 'Due Date',
                    },
                    {
                        title: 'Date Completed',
                    },
                    {
                        title: 'Date Created',
                    },
                ],
                order: [[4, 'asc']],
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
                        .val(formatNumber(values.Amount));
                    readonlyInputs.filter('#Applied').val(values.Applied);
                    readonlyInputs.filter('#evaluated').val(values.evaluated);
                    readonlyInputs
                        .filter('#Assigned_to')
                        .val(values.Assigned_to);
                    readonlyInputs
                        .filter('#building')
                        .val(formatNumber(values.building));
                    readonlyInputs
                        .filter('#equipment')
                        .val(formatNumber(values.equipment));
                    readonlyInputs
                        .filter('#workingCapital')
                        .val(formatNumber(values.workingCapital));
                }
            );

            $('#OngoingTableBody').on(
                'click',
                '.ongoingProjectInfo',
                function () {
                    const row = $(this).closest('tr');
                    const inputs = row.find('input');
                    const readonlyInputs = $('#ongoingDetails').find(
                        'input, .amount-to-be-refunded-label'
                    );
                    console.log(readonlyInputs);

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
                        fee_applied: parseFloat(
                            inputs.filter('.fee_applied').val()
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
                        .val(formatNumber(businessDetails.building_assets));
                    readonlyInputs
                        .filter('.equipment')
                        .val(formatNumber(businessDetails.equipment_assets));
                    readonlyInputs
                        .filter('.workingCapital')
                        .val(
                            formatNumber(businessDetails.working_capital_assets)
                        );

                    readonlyInputs
                        .filter('.ProjectId')
                        .val(projectDetails.project_id);
                    readonlyInputs
                        .filter('.ProjectTitle')
                        .val(projectDetails.project_title);
                    readonlyInputs
                        .filter('.funded_amount')
                        .val(formatNumber(projectDetails.project_fund_amount));
                    readonlyInputs
                        .filter('.amount-to-be-refunded-label')
                        .html(
                            /*html*/ `Amount to be refunded:  <span class="text-muted fw-light">(${projectDetails.fee_applied}%)</span>`
                        );
                    readonlyInputs
                        .filter('.amount_to_be_refunded')
                        .val(
                            formatNumber(
                                projectDetails.project_amount_to_be_refunded
                            )
                        );
                    readonlyInputs
                        .filter('.refunded')
                        .val(
                            formatNumber(projectDetails.project_refunded_amount)
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
                        .val(formatNumber(businessDetails.building_assets));
                    readonlyInputs
                        .filter('.equipment')
                        .val(formatNumber(businessDetails.equipment_assets));
                    readonlyInputs
                        .filter('.workingCapital')
                        .val(
                            formatNumber(businessDetails.working_capital_assets)
                        );

                    readonlyInputs
                        .filter('.ProjectId')
                        .val(projectDetails.project_id);
                    readonlyInputs
                        .filter('.ProjectTitle')
                        .val(projectDetails.project_title);
                    readonlyInputs
                        .filter('.funded_amount')
                        .val(formatNumber(projectDetails.project_fund_amount));
                    readonlyInputs
                        .filter('.amount_to_be_refunded')
                        .val(
                            formatNumber(
                                projectDetails.project_amount_to_be_refunded
                            )
                        );
                    readonlyInputs
                        .filter('.refunded')
                        .val(
                            formatNumber(projectDetails.project_refunded_amount)
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
                                /*html*/ `${Approved.f_name} ${Approved.l_name}
                                    <input
                                        type="hidden"
                                        class="designation"
                                        value="${Approved.designation}"
                                    />
                                    <input
                                        type="hidden"
                                        class="mobile_number"
                                        value="${Approved.mobile_number}"
                                    />
                                    <input
                                        type="hidden"
                                        class="email"
                                        value="${Approved.email}"
                                    />
                                    <input
                                        type="hidden"
                                        class="landline"
                                        value="${Approved.landline ?? ''}"
                                    />`,
                                /*html*/ `${Approved.firm_name}
                                    <input
                                        type="hidden"
                                        class="business_id"
                                        value="${Approved.business_id}"
                                    />
                                    <input
                                        type="hidden"
                                        class="enterprise_type"
                                        value="${Approved.enterprise_type}"
                                    />
                                    <input
                                        type="hidden"
                                        class="enterprise_level"
                                        value="${Approved.enterprise_level}"
                                    />
                                    <input
                                        type="hidden"
                                        class="building_Assets"
                                        value="${Approved.building_value}"
                                    />
                                    <input
                                        type="hidden"
                                        class="equipment_Assets"
                                        value="${Approved.equipment_value}"
                                    />
                                    <input
                                        type="hidden"
                                        class="working_capital_Assets"
                                        value="${Approved.working_capital}"
                                    />
                                    <input
                                        type="hidden"
                                        class="business_address"
                                        value="${Approved.landmark} ${Approved.barangay}, ${Approved.city}, ${Approved.province}, ${Approved.region}"
                                    />`,
                                /*html*/ `${Approved.project_title}
                                    <input
                                        type="hidden"
                                        class="fund_amount"
                                        value="${Approved.fund_amount}"
                                    />
                                    <input
                                        type="hidden"
                                        class="dateApplied"
                                        value="${customDateFormatter(
                                            Approved.date_applied
                                        )}"
                                    />
                                    <input
                                        type="hidden"
                                        class="staffUserName"
                                        value="${Approved.staffUserName}"
                                    />
                                    <input
                                        type="hidden"
                                        class="evaluated_by"
                                        value="${
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
                                        }"
                                    />
                                    <input
                                        type="hidden"
                                        class="assigned_to"
                                        value="${
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
                                            Approved.handled_by_l_name +
                                            ' ' +
                                            (Approved.handled_by_suffix
                                                ? Approved.handled_by_suffix
                                                : '')
                                        }"
                                    />`,
                                `${customDateFormatter(Approved.date_approved)}`,
                                /*html*/ ` <button
                                    class="btn btn-primary approvedProjectInfo"
                                    type="button"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#approvedDetails"
                                    aria-controls="approvedDetails"
                                >
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
                                /*html*/ `${Ongoing.project_title}
                                    <input
                                        type="hidden"
                                        class="project_id"
                                        value="${Ongoing.Project_id}"
                                    />
                                    <input
                                        type="hidden"
                                        class="project_fund_amount"
                                        value="${fund_amount}"
                                    />
                                    <input
                                        type="hidden"
                                        class="amount_to_be_refunded"
                                        value="${to_be_refunded}"
                                    />
                                    <input
                                        type="hidden"
                                        class="fee_applied"
                                        value="${Ongoing.fee_applied}"
                                    />
                                    <input
                                        type="hidden"
                                        class="amount_refunded"
                                        value="${amount_refunded}"
                                    />
                                    <input
                                        type="hidden"
                                        class="date_applied"
                                        value="${Ongoing.date_applied}"
                                    />
                                    <input
                                        type="hidden"
                                        class="date_approved"
                                        value="${Ongoing.date_approved}"
                                    />
                                    <input
                                        type="hidden"
                                        class="evaluated_by"
                                        value="${
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
                                        }"
                                    />
                                    <input
                                        type="hidden"
                                        class="handled_by"
                                        value="${
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
                                        }"
                                    />`,
                                /*html*/ `${Ongoing.firm_name}
                                    <input
                                        type="hidden"
                                        class="business_id"
                                        value="${Ongoing.business_id}"
                                    />
                                    <input
                                        type="hidden"
                                        class="address"
                                        value="${
                                            Ongoing.landmark +
                                            ', ' +
                                            Ongoing.barangay +
                                            ', ' +
                                            Ongoing.city +
                                            ', ' +
                                            Ongoing.province +
                                            ', ' +
                                            Ongoing.region
                                        }"
                                    />
                                    <input
                                        type="hidden"
                                        class="enterprise_type"
                                        value="${Ongoing.enterprise_type}"
                                    />
                                    <input
                                        type="hidden"
                                        class="enterprise_level"
                                        value="${Ongoing.enterprise_level}"
                                    />
                                    <input
                                        type="hidden"
                                        class="building_assets"
                                        value="${Ongoing.building_value}"
                                    />
                                    <input
                                        type="hidden"
                                        class="equipment_assets"
                                        value="${Ongoing.equipment_value}"
                                    />
                                    <input
                                        type="hidden"
                                        class="working_capital_assets"
                                        value="${Ongoing.working_capital}"
                                    />`,
                                /*html*/ `${Ongoing.f_name + ' ' + Ongoing.l_name}
                                    <input
                                        type="hidden"
                                        class="designation"
                                        value="${Ongoing.designation}"
                                    />
                                    <input
                                        type="hidden"
                                        class="mobile_number"
                                        value="${Ongoing.mobile_number}"
                                    />
                                    <input
                                        type="hidden"
                                        class="email"
                                        value="${Ongoing.email}"
                                    />
                                    <input
                                        type="hidden"
                                        class="landline"
                                        value="${Ongoing.landline ?? ''}"
                                    />`,
                                /*html*/ `${
                                    formatNumber(amount_refunded) +
                                    ' / ' +
                                    formatNumber(to_be_refunded)
                                }
                                    <span class="badge text-white bg-primary"
                                        >${percentage}%</span
                                    >`,
                                /*html*/ ` <button
                                    class="btn btn-primary ongoingProjectInfo"
                                    type="button"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#ongoingDetails"
                                    aria-controls="ongoingDetails"
                                >
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
                                /*html*/ `${completed.project_title}
                                    <input
                                        type="hidden"
                                        class="project_id"
                                        value="${completed.Project_id}"
                                    />
                                    <input
                                        type="hidden"
                                        class="project_fund_amount"
                                        value="${fund_amount}"
                                    />
                                    <input
                                        type="hidden"
                                        class="amount_to_be_refunded"
                                        value="${to_be_refunded}"
                                    />
                                    <input
                                        type="hidden"
                                        class="amount_refunded"
                                        value="${amount_refunded}"
                                    />
                                    <input
                                        type="hidden"
                                        class="date_applied"
                                        value="${completed.date_applied}"
                                    />
                                    <input
                                        type="hidden"
                                        class="date_approved"
                                        value="${completed.date_approved}"
                                    />
                                    <input
                                        type="hidden"
                                        class="evaluated_by"
                                        value="${
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
                                        }"
                                    />
                                    <input
                                        type="hidden"
                                        class="handled_by"
                                        value="${
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
                                        }"
                                    />`,
                                /*html*/ `${completed.firm_name}
                                    <input
                                        type="hidden"
                                        class="business_id"
                                        value="${completed.business_id}"
                                    />
                                    <input
                                        type="hidden"
                                        class="address"
                                        value="${
                                            completed.landmark +
                                            ', ' +
                                            completed.barangay +
                                            ', ' +
                                            completed.city +
                                            ', ' +
                                            completed.province +
                                            ', ' +
                                            completed.region
                                        }"
                                    />
                                    <input
                                        type="hidden"
                                        class="enterprise_type"
                                        value="${completed.enterprise_type}"
                                    />
                                    <input
                                        type="hidden"
                                        class="enterprise_level"
                                        value="${completed.enterprise_level}"
                                    />
                                    <input
                                        type="hidden"
                                        class="building_assets"
                                        value="${completed.building_value}"
                                    />
                                    <input
                                        type="hidden"
                                        class="equipment_assets"
                                        value="${completed.equipment_value}"
                                    />
                                    <input
                                        type="hidden"
                                        class="working_capital_assets"
                                        value="${completed.working_capital}"
                                    />`,
                                /*html*/ `${
                                    completed.f_name + ' ' + completed.l_name
                                }
                                    <input
                                        type="hidden"
                                        class="designation"
                                        value="${completed.designation}"
                                    />
                                    <input
                                        type="hidden"
                                        class="mobile_number"
                                        value="${completed.mobile_number}"
                                    />
                                    <input
                                        type="hidden"
                                        class="email"
                                        value="${completed.email}"
                                    />
                                    <input
                                        type="hidden"
                                        class="landline"
                                        value="${completed.landline ?? ''}"
                                    />`,
                                /*html*/ `${
                                    formatNumber(amount_refunded) +
                                    ' / ' +
                                    formatNumber(to_be_refunded)
                                }
                                    <span class="badge text-white bg-primary"
                                        >${percentage}%</span
                                    >`,
                                /*html*/ `<button
                                    class="btn btn-primary completedProjectInfo"
                                    type="button"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#completedDetails"
                                    aria-controls="completedDetails"
                                >
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
            const module = await import('../application-page');
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
            const TNArejectionModal = $('#tnaEvaluationResultModal');
            const ReviewFileModalContainer = $('#reviewFileModal');
            const ReviewedFileFormContainer =
                ReviewFileModalContainer.find('#reviewedFileForm');
            const ApplicantDetailsContainer = $('#applicantDetails');
            const ApplicantProgressContainer = $('#ApplicationProgress');
            const RequirementsTable = $('#requirementsTables');

            let tnaForm;
            let projectProposalForm;
            let rtecReportForm;

            $('#evaluationSchedule-datepicker').on('change', function () {
                const selectedDate = new Date(this.value);
                const currentDate = new Date();

                if (selectedDate < currentDate) {
                    this.value = this.min;
                }
            });

            const applicantTable = new ApplicantDataTable(AUTH_USER_NAME);
            await applicantTable.init();
            $('#ApplicantTableBody').on(
                'click',
                '.applicantDetailsBtn',
                async function () {
                    const row = $(this).closest('tr');
                    const fullName = row.find('td:nth-child(1)').text().trim();
                    const actionBtn = ApplicantProgressContainer.find(
                        '#viewTNA, #editTNA, #viewProjectProposal, #editProjectProposal, #viewRTECReport, #editRTECReport, #submitToAdmin'
                    );
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

                    actionBtn
                        .attr('data-business-id', businessID)
                        .attr('data-application-id', ApplicationID);

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

                    applicantTable.broadcastViewingEvent(
                        ApplicationID,
                        AUTH_USER_NAME
                    );

                    getApplicantRequirements(businessID);
                    getEvaluationScheduledDate(businessID, ApplicationID);

                    tnaForm.setId(businessID, ApplicationID);
                    projectProposalForm.setId(businessID, ApplicationID);
                    rtecReportForm.setId(businessID, ApplicationID);

                    console.log(tnaForm, projectProposalForm, rtecReportForm);
                }
            );

            ApplicantProgressContainer.on(
                'click',
                'button#submitToAdmin',
                async function (e) {
                    const isConfirmed = await createConfirmationModal({
                        title: 'Submit to Admin',
                        message:
                            'Are you sure you want to submit this application to admin?',
                        confirmText: 'Submit',
                    });
                    if (!isConfirmed) {
                        return;
                    }
                    const processToast = showProcessToast(
                        'Submitting to Admin...'
                    );
                    try {
                        const business_id =
                            e.target.attributes['data-business-id'].value;
                        const application_id =
                            e.target.attributes['data-application-id'].value;

                        if (!business_id || !application_id) {
                            throw new Error(
                                'Business ID or Application ID is missing'
                            );
                        }
                        const response = await $.ajax({
                            url: APPLICANT_TAB_ROUTE.SUBMIT_TO_ADMIN.replace(
                                ':business_id',
                                business_id
                            ).replace(':application_id', application_id),
                            type: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': $(
                                    'meta[name="csrf-token"]'
                                ).attr('content'),
                            },
                        });
                        showToastFeedback(
                            'text-bg-success',
                            response?.message ||
                                'Project submitted to admin successfully'
                        );
                        hideProcessToast(processToast);
                    } catch (error) {
                        hideProcessToast(processToast);
                        showToastFeedback(
                            'text-bg-danger',
                            error?.responseJSON?.message ||
                                error?.message ||
                                'Error submitting application to admin'
                        );
                    } finally {
                        closeOffcanvasInstances('#applicantDetails');
                    }
                }
            );

            ApplicantDetailsContainer.on('hidden.bs.offcanvas', function () {
                applicantTable.broadcastClosedViewingEvent();

                RequirementsTable.empty();
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
                        nofi_dateCont.append(/*html*/ `<div class="alert alert-primary mb-auto" role="alert">An evaluation date of <strong>' +
                                ${response.Scheduled_date} +
                                '</strong> has been set for this applicant. <p class="my-auto text-secondary">Applicant is already notified through email and notification.</p></div>`);
                        setAndUpdateBtn.text('Update');
                    } else {
                        nofi_dateCont.append(
                            /*html*/ `<div class="alert alert-primary my-auto" role="alert">No evaluation date has been set for this applicant.</div>`
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
                    row.append(/*html*/ `<td class="text-center">
                            <button
                                class="btn btn-primary viewReq position-relative"
                            >
                                View
                                <span
                                    class="position-absolute top-0 start-100 translate-middle p-2 ${
                                        requirement.remarks === 'Pending'
                                            ? 'bg-info'
                                            : requirement.remarks === 'Approved'
                                              ? 'bg-primary'
                                              : 'bg-danger'
                                    } border border-light rounded-circle"
                                >
                                    <span class="visually-hidden"
                                        >New alerts</span
                                    >
                                </span>
                            </button>
                        </td>`);
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
                const processToast = showProcessToast('Retrieving file...');
                try {
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
                    reviewFileModalInput
                        .filter('#fileUploaded')
                        .val(uploadedDate);
                    reviewFileModalInput
                        .filter('#fileUploadedBy')
                        .val(updatedDate);
                    reviewFileModalInput
                        .filter('#fileUploadedBy')
                        .val(uploader);

                    // Wait for the file to be fully loaded
                    await retrieveAndDisplayFile(fileUrl, fileType);
                } catch (error) {
                    console.error('Error viewing file:', error);
                    showToastFeedback(
                        'text-bg-danger',
                        'Failed to load file. Please try again.'
                    );
                } finally {
                    hideProcessToast(processToast);
                }
            });

            async function retrieveAndDisplayFile(fileUrl, fileType) {
                return new Promise((resolve, reject) => {
                    try {
                        const fileContent =
                            ReviewFileModalContainer.find('#fileContent');
                        fileContent.empty();

                        if (fileType === 'pdf') {
                            const embed = $('<iframe>', {
                                src: fileUrl,
                                type: 'application/pdf',
                                width: '100%',
                                height: '100%',
                                frameborder: '0',
                                allow: 'fullscreen',
                            });

                            embed.on('load', function () {
                                resolve();
                            });

                            embed.on('error', function () {
                                reject(new Error('Failed to load PDF'));
                            });

                            fileContent.append(embed);
                        } else {
                            const img = $('<img>', {
                                src: fileUrl,
                                class: 'img-fluid',
                            });
                            img.on('load', function () {
                                resolve();
                            });
                            img.on('error', function () {
                                reject(new Error('Failed to load image'));
                            });

                            fileContent.append(img);
                        }

                        // Show the modal
                        const reviewFileModal = new bootstrap.Modal(
                            ReviewFileModalContainer[0]
                        );
                        reviewFileModal.show();
                    } catch (error) {
                        reject(
                            new Error(
                                'Error in file retrieval and display: ' + error
                            )
                        );
                    }
                });
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
                const processToast = showProcessToast();
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
                    hideProcessToast(processToast);
                    setTimeout(() => {
                        showToastFeedback('text-bg-success', response.success);
                    }, 500);
                } catch (error) {
                    hideProcessToast(processToast);
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
                const processToast = showProcessToast(
                    'Setting evaluation date...'
                );
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
                        hideProcessToast(processToast);
                        await getEvaluationScheduledDate(
                            business_id,
                            application_id
                        );
                        showToastFeedback('text-bg-success', response.message);
                    }
                } catch (error) {
                    hideProcessToast(processToast);
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

                const processToast = showProcessToast('Rejecting applicant...');
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
                        hideProcessToast(processToast);
                        closeModal('#tnaEvaluationResultModal');
                        showToastFeedback('text-bg-success', response.message);
                    }
                } catch (error) {
                    hideProcessToast(processToast);
                    showToastFeedback(
                        'text-bg-danger',
                        error.responseJSON.error
                    );
                }
            });

            const smartWizardInstance = ApplicantProgressContainer.smartWizard({
                selected: 0,
                theme: 'dots',
                transition: {
                    animation: 'slideHorizontal',
                },
                toolbar: {
                    showNextButton: true, // show/hide a Next button
                    showPreviousButton: true, // show/hide a Previous button
                    position: 'both buttom', // none/ top/ both bottom
                    extraHtml: /*html*/ `<button class="btn btn-success hidden" id="submitToAdmin" data-action="DraftForm">Submit To Admin</button>`,
                },
            });

            smartWizardInstance.on(
                'showStep',
                function (
                    e,
                    anchorObject,
                    stepIndex,
                    stepDirection,
                    stepPosition
                ) {
                    const submitToAdminBtn =
                        ApplicantProgressContainer.find('#submitToAdmin');
                    console.log(stepPosition);
                    if (stepPosition !== 'last') {
                        submitToAdminBtn.hide();
                    } else {
                        submitToAdminBtn.show();
                    }
                }
            );

            const { TNAForm, ProjectProposalForm, RTECReportForm } =
                await import('./application-process-form-class');
            const TNADocumentContainerModal = $('#tnaDocContainerModal');
            const ProjectProposalDocumentContainerModal = $(
                '#projectProposalDocContainerModal'
            );
            const RTECReportContainerModal = $('#rtecReportContainerModal');

            tnaForm = new TNAForm(TNADocumentContainerModal);
            tnaForm.initializeTNAForm();

            projectProposalForm = new ProjectProposalForm(
                ProjectProposalDocumentContainerModal
            );

            projectProposalForm.initializeProjectProposalForm();

            rtecReportForm = new RTECReportForm(RTECReportContainerModal);
            rtecReportForm.initializeRTECReportForm();
        },
    };
    return functions;
}
