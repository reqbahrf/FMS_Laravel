import '../echo';
import createConfirmationModal from '../Utilities/confirmation-modal';
import {
    showToastFeedback,
    formatNumberToCurrency,
    customDateFormatter,
    closeOffcanvasInstances,
    closeModal,
    sanitize,
    showProcessToast,
    hideProcessToast,
} from '../Utilities/utilFunctions';
import getProjectPaymentHistory from '../Utilities/project-payment-history';

import NotificationManager from '../Utilities/NotificationManager';
import ActivityLogHandler from '../Utilities/ActivityLogHandler';
import NavigationHandler from '../Utilities/TabNavigationHandler';
import DarkMode from '../Utilities/DarkModeHandler';
import AdminDashboard from './AdminDashboard';

import DataTable from 'datatables.net-bs5';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';
// import 'datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css';
// import 'datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css';
// import 'datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css';
// import 'datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css';
// import 'datatables.net-scroller-bs5/css/scroller.bootstrap5.min.css';
window.DataTable = DataTable;
import 'datatables.net-bs5';
import 'datatables.net-buttons-bs5';
import 'datatables.net-buttons/js/buttons.html5.mjs';
import 'datatables.net-fixedcolumns-bs5';
import 'datatables.net-fixedheader-bs5';
import 'datatables.net-responsive-bs5';
import 'datatables.net-scroller-bs5';
import '../Utilities/dataTableCustomConfig';

const MAIN_CONTENT_CONTAINER = $('#main-content');
const ACTIVITY_LOG_MODAL = $('#userActivityLogModal');

const darkMode = new DarkMode();
darkMode.initializeTheme();

const USER_ROLE = 'admin';
//The NOTIFICATION_ROUTE and USER_ID constants are defined in the Blade view @ Admin_Index.blade.php
const notificationManager = new NotificationManager(
    NOTIFICATION_ROUTE,
    USER_ID,
    USER_ROLE
);

notificationManager.fetchNotifications();
notificationManager.setupEventListeners();

const urlMapFunction = {
    [NAV_ROUTES.DASHBOARD]: (functions) => functions.Dashboard,
    [NAV_ROUTES.PROJECTS]: (functions) => functions.ProjectList,
    [NAV_ROUTES.APPLICATIONS]: (functions) => functions.ApplicantList,
    [NAV_ROUTES.USERS]: (functions) => functions.Users,
    [NAV_ROUTES.SETTINGS]: (functions) => functions.ProjectSettings,
};

//Initialize the navigation handler for the admin page switching tabs
const navigationHandler = new NavigationHandler(
    MAIN_CONTENT_CONTAINER,
    USER_ROLE,
    urlMapFunction,
    initializeAdminPageJs
);
navigationHandler.init();
window.loadPage = navigationHandler.loadPage.bind(navigationHandler);

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
});

const activityLog = new ActivityLogHandler(
    ACTIVITY_LOG_MODAL,
    USER_ROLE,
    'personal'
);
activityLog.initPersonalActivityLog();

async function initializeAdminPageJs() {
    const functions = {
        Dashboard: async () => {
            const adminDashboard = new AdminDashboard();
            await adminDashboard.init();
        },

        /**
         * Initializes the project list view by setting up DataTables and event listeners.
         * It also defines several helper functions for fetching project proposals, staff lists, and approved projects.
         *
         * @return {void}
         */
        ProjectList: async () => {
            const ForApprovalDataTable = $('#forApproval').DataTable({
                responsive: true,
                autoWidth: false,
                fixedColumns: true,
                columns: [
                    {
                        title: 'Applicant Name',
                        width: '20%',
                    },
                    {
                        title: 'Firm Name',
                        width: '15%',
                    },
                    {
                        title: 'Project title',
                        width: '30%',
                    },
                    {
                        title: 'Date Submitted',
                        width: '15%',
                    },
                    {
                        title: 'Status',
                        width: '8%',
                    },
                    {
                        title: 'Action',
                        width: '5%',
                    },
                ],
            }); // Then initialize DataTables
            const OngoingDataTable = $('#ongoing').DataTable({
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
                        width: '20%',
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
            // Common configuration for payment history tables
            const paymentTableConfig = {
                autoWidth: true,
                responsive: true,
                columns: [
                    {
                        title: 'Reference #',
                    },
                    {
                        title: 'Amount(₱)',
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
                        title: 'Date Created',
                    },
                ],
                order: [[4, 'asc']],
            };

            // Initialize separate instances
            const OngoingPaymentHistoryDataTable = $(
                '#paymentHistoryTable'
            ).DataTable(paymentTableConfig);
            const CompletedPaymentHistoryDataTable = $(
                '#CompletedpaymentTable'
            ).DataTable(paymentTableConfig);

            //TODO: deprecate this function
            // const populateProjectProposalContainer = (data) => {
            //     const ProjectProposalContainer = $('#projectProposalContainer');

            //     ProjectProposalContainer.find('#ProjectId').val(
            //         data.proposal_data.projectID
            //     );
            //     ProjectProposalContainer.find('#ProjectTitle').val(
            //         data.proposal_data.projectTitle
            //     );
            //     ProjectProposalContainer.find('#funded_Amount').val(
            //         data.proposal_data.fundAmount
            //     );

            //     ProjectProposalContainer.find(
            //         '#ExpectedOutputContainer'
            //     ).append(
            //         data.proposal_data.expectedOutputs.map(
            //             (item) => `<li>${item}</li>`
            //         )
            //     );

            //     ProjectProposalContainer.find(
            //         '#ApprovedEquipmentContainer'
            //     ).append(
            //         data.proposal_data.equipmentDetails.map((item) => {
            //             return /*html*/ `<tr>
            //     <td>${item.Qty}</td>
            //     <td>${item.Actual_Particulars}</td>
            //     <td>${item.Cost}</td>
            // </tr>`;
            //         })
            //     );

            //     ProjectProposalContainer.find(
            //         '#ApprovedNonEquipmentContainer'
            //     ).append(
            //         data.proposal_data.nonEquipmentDetails.map((item) => {
            //             return /*html*/ `<tr>
            //     <td>${item.Qty}</td>
            //     <td>${item.Actual_Particulars}</td>
            //     <td>${item.Cost}</td>
            // </tr>`;
            //         })
            //     );
            //     ProjectProposalContainer.find('#To_Be_Refunded').val(
            //         formatNumberToCurrency(parseFloat(data.To_Be_Refunded))
            //     );
            //     ProjectProposalContainer.find('#Date_FundRelease').val(
            //         customDateFormatter(data.proposal_data.dateOfFundRelease)
            //     );
            //     ProjectProposalContainer.find('#Applied').val(
            //         customDateFormatter(data.date_applied)
            //     );
            //     ProjectProposalContainer.find('#evaluated').val(
            //         `${data?.prefix} ${data.f_name} ${data.mid_name} ${data.l_name} ${data?.suffix}`
            //     );
            // };
            //TODO: deprecate this function
            // const getProjectProposal = async (businessId, projectId) => {
            //     try {
            //         const response = await $.ajax({
            //             headers: {
            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
            //                     'content'
            //                 ),
            //             },
            //             url: PROJECT_LIST_ROUTE.GET_PROJECTS_PROPOSAL.replace(
            //                 ':business_id',
            //                 businessId
            //             ).replace(':project_id', projectId),
            //             type: 'GET',
            //             dataType: 'json', // Expect a JSON response
            //         });

            //         populateProjectProposalContainer(response);
            //     } catch (error) {
            //         console.log('Error: ' + error);
            //     }
            // };

            /**
             * Event listener for the click event on the .viewApproval button.
             * Retrieves the input values from the clicked table row and updates the form fields.
             * Triggers additional actions such as fetching the project proposal and staff list.
             *
             * @event click
             * @memberof #ApprovaltableBody
             * @param {Event} event - The click event object.
             * @return {void}
             */
            $('#ApprovaltableBody').on('click', '.viewApproval', function () {
                const row = $(this).closest('tr');
                const inputs = row.find('input');
                const offCanvaReadonlyInputs =
                    $('#approvalDetails').find('input[type="text"]');

                const cooperatorName = row.find('td:eq(0)').text().trim();
                const evaluated_by = inputs.filter('.evaluated_by_name').val();
                const applicationId = inputs.filter('.application_id').val();
                const designation = inputs.filter('.designation').val();
                const businessId = inputs.filter('.business_id').val();
                const Project_id = inputs.filter('.Project_id').val();
                const businessAddress = inputs
                    .filter('.business_address')
                    .val();
                const typeOfEnterprise = inputs
                    .filter('.type_of_enterprise')
                    .val();
                const landline = inputs.filter('.landline').val();
                const mobilePhone = inputs.filter('.mobile_number').val();
                const email = inputs.filter('.email').val();
                const buildingAssets = parseFloat(
                    inputs.filter('.building_Assets').val()
                );
                const equipmentAssets = parseFloat(
                    inputs.filter('.equipment_Assets').val()
                );
                const workingCapitalAssets = parseFloat(
                    inputs.filter('.working_capital_Assets').val()
                );

                const fee_applied = `with ${inputs.filter('.fee_applied').val()} %`;
                console.log(fee_applied);

                // Update form fields
                offCanvaReadonlyInputs
                    .filter('.cooperatorName')
                    .val(cooperatorName);
                offCanvaReadonlyInputs.filter('#evaluated').val(evaluated_by);
                offCanvaReadonlyInputs.filter('.designation').val(designation);
                offCanvaReadonlyInputs.filter('#b_id').val(businessId);
                offCanvaReadonlyInputs
                    .filter('#businessAddress')
                    .val(businessAddress);
                offCanvaReadonlyInputs
                    .filter('#typeOfEnterprise')
                    .val(typeOfEnterprise);
                offCanvaReadonlyInputs.filter('.landline').val(landline);
                offCanvaReadonlyInputs.filter('.mobilePhone').val(mobilePhone);
                offCanvaReadonlyInputs.filter('.emailAddress').val(email);
                offCanvaReadonlyInputs
                    .filter('#building')
                    .val(formatNumberToCurrency(buildingAssets));
                offCanvaReadonlyInputs
                    .filter('#equipment')
                    .val(formatNumberToCurrency(equipmentAssets));
                offCanvaReadonlyInputs
                    .filter('#workingCapital')
                    .val(formatNumberToCurrency(workingCapitalAssets));

                const staffListSelector = $('#Assigned_to');
                getProjectFormList(businessId, applicationId);
                getStafflist(staffListSelector);
            });

            $('#OngoingTableBody').on(
                'click',
                '.ongoingProjectInfo',
                function () {
                    const row = $(this).closest('tr');
                    const inputs = row.find('input');
                    const readonlyInputs = $('#ongoingDetails').find(
                        'input, .amount-to-be-refunded-label'
                    );

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
                        .filter('.amount-to-be-refunded-label')
                        .html(
                            /*html*/ `Amount to be refunded:  <span class="text-muted fw-light">(${projectDetails.fee_applied}%)</span>`
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
                    const staffListSelector = $('#AssignNewStaffSelector');
                    getStafflist(staffListSelector);
                }
            );

            $('#newStaffAssignment').on('submit', async function (event) {
                event.preventDefault();
                const inConfirm = await createConfirmationModal({
                    title: 'Assign New Staff',
                    titleBg: 'bg-primary',
                    message: 'Are you sure you want to this new staff?',
                    confirmText: 'Yes',
                    confirmButtonClass: 'btn-primary',
                    cancelText: 'No',
                });
                if (!inConfirm) {
                    return;
                }
                showProcessToast('Assigning new staff...');
                const formdata = new FormData(this);
                formdata.append('project_id', $('#OngoingProjectID').val());
                formdata.append('business_id', $('#OngoingBusinessId').val());

                try {
                    const response = await $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                        url: PROJECT_LIST_ROUTE.ASSIGNED_NEW_STAFF,
                        type: 'POST',
                        data: formdata,
                        contentType: false,
                        processData: false,
                        dataType: 'json', // Expect a JSON response
                    });

                    hideProcessToast();
                    showToastFeedback('text-bg-success', response.message);
                    getOngoingProjects();
                    closeModal('#assignNewStaffModal');
                } catch (error) {
                    hideProcessToast();
                    showToastFeedback(
                        'text-bg-danger',
                        error.responseJSON.message
                    );
                }
            });

            $('#CompletedTableBody').on(
                'click',
                '.completedProjectInfo',
                function () {
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
                        handle_by: inputs.filter('.handle_by').val(),
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
                        CompletedPaymentHistoryDataTable
                    );
                }
            );

            /**
             * Retrieves a list of staff members and populates the Assigned_to dropdown.
             *
             * @return {void}
             */
            const getStafflist = async (selector_element) => {
                try {
                    const response = await fetch(
                        PROJECT_LIST_ROUTE.GET_STAFFLIST,
                        {
                            headers: {
                                'X-CSRF-TOKEN': $(
                                    'meta[name="csrf-token"]'
                                ).attr('content'),
                            },
                            dataType: 'json',
                        }
                    );
                    const data = await response.json();
                    selector_element.children('option:not(:first)').remove();
                    data.forEach((staff) => {
                        selector_element.append(
                            `<option value="${staff.staff_id}">${staff?.prefix} ${staff.f_name} ${staff.mid_name} ${staff.l_name} ${staff?.suffix}</option>`
                        );
                    });
                } catch (error) {
                    console.error('Error:', error);
                }
            };

            async function getforApprovalProject() {
                try {
                    const response = await fetch(
                        PROJECT_LIST_ROUTE.GET_APPROVED_PROJECTS,
                        {
                            headers: {
                                'X-CSRF-TOKEN': $(
                                    'meta[name="csrf-token"]'
                                ).attr('content'),
                            },
                            dataType: 'json',
                        }
                    );
                    const data = await response.json();
                    ForApprovalDataTable.clear();
                    ForApprovalDataTable.rows.add(
                        data.map((project) => {
                            return [
                                /*html*/ `
                                ${[
                                    project?.applicant_prefix,
                                    project?.applicant_f_name,
                                    project?.applicant_mid_name,
                                    project?.applicant_l_name,
                                    project?.applicant_suffix,
                                ]
                                    .filter(Boolean)
                                    .map(String)
                                    .map((part) => part.trim())
                                    .join(' ')}
                                    <input
                                        type="hidden"
                                        class="designation"
                                        value="${project?.applicant_designation}"
                                    />
                                    <input
                                        type="hidden"
                                        class="application_id"
                                        value="${project?.application_id}"
                                    />
                                    <input
                                        type="hidden"
                                        class="mobile_number"
                                        value="${project?.applicant_mobile_number}"
                                    />
                                    <input
                                        type="hidden"
                                        class="email"
                                        value="${project?.applicant_email}"
                                    />
                                    <input
                                        type="hidden"
                                        class="landline"
                                        value="${project?.applicant_landline ?? ''}"
                                    />`,
                                /*html*/ `${project?.firm_name}
                                    <input
                                        type="hidden"
                                        class="business_id"
                                        value="${project?.id}"
                                    />
                                    <input
                                        type="hidden"
                                        class="business_address"
                                        value=" ${[
                                            project?.landMark,
                                            project?.barangay,
                                            project?.city,
                                            project?.province,
                                            project?.region,
                                            project?.zip_code,
                                        ]
                                            .filter(Boolean)
                                            .map(String)
                                            .map((part) => part.trim())
                                            .join(', ')}"
                                    />
                                    <input
                                        type="hidden"
                                        class="type_of_enterprise"
                                        value="${project?.enterprise_type}"
                                    />
                                    <input
                                        type="hidden"
                                        class="Enterpriselevel"
                                        value="${project.enterprise_level}"
                                    />
                                    <input
                                        type="hidden"
                                        class="building_Assets"
                                        value="${project.building_value}"
                                    />
                                    <input
                                        type="hidden"
                                        class="equipment_Assets"
                                        value="${project.equipment_value}"
                                    />
                                    <input
                                        type="hidden"
                                        class="working_capital_Assets"
                                        value="${project.working_capital}"
                                    />`,
                                /*html*/ `${project.project_title}
                                    <input
                                        type="hidden"
                                        class="Project_id"
                                        value="${project.Project_id}"
                                    />
                                    <input
                                        type="hidden"
                                        class="evaluated_by_id"
                                        value="${project.evaluated_by_id}"
                                    />
                                    <input
                                        type="hidden"
                                        class="evaluated_by_name"
                                        value="${[
                                            project?.evaluated_by_prefix,
                                            project?.evaluated_by_f_name,
                                            project?.evaluated_by_mid_name,
                                            project?.evaluated_by_l_name,
                                            project?.evaluated_by_suffix,
                                        ]
                                            .filter(Boolean)
                                            .map(String)
                                            .map((part) => part.trim())
                                            .join(' ')}"
                                    />
                                    <input
                                        type="hidden"
                                        class="project_title"
                                        value="${project.Project_id}"
                                    />
                                    <input
                                        type="hidden"
                                        class="date_proposed"
                                        value="${project.evaluated_by_id}"
                                    />
                                    <input
                                        type="hidden"
                                        class="assigned_to"
                                        value="${project.full_name}"
                                    />
                                    <input
                                        type="hidden"
                                        class="fee_applied"
                                        value="${project.fee_applied}"
                                    />
                                    <input
                                        type="hidden"
                                        class="application_status"
                                        value="${project.fund_amount}"
                                    />`,
                                `${customDateFormatter(project.date_proposed)}`,
                                /*html*/ `<span class="badge bg-primary"
                                    >${project.application_status}</span
                                >`,
                                /*html*/ `<button
                                    class="btn btn-primary viewApproval"
                                    type="button"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#approvalDetails"
                                    aria-controls="approvalDetails"
                                >
                                    <i class="ri-menu-unfold-4-line ri-1x"></i>
                                </button>`,
                            ];
                        })
                    );

                    ForApprovalDataTable.draw();
                } catch (error) {
                    throw new Error(
                        'Error fetching for approval projects: ' + error
                    );
                }
            }

            const formatFormKey = (key) => {
                // Predefined map of specific acronyms to their uppercase versions
                const acronymMap = {
                    tna: 'TNA',
                    rtec: 'RTEC',
                };

                return key
                    .split('_')
                    .map((word) => {
                        // Check if the word is in our predefined acronym map
                        if (acronymMap[word.toLowerCase()]) {
                            return acronymMap[word.toLowerCase()];
                        }
                        // Check if the word is an acronym (all uppercase letters)
                        if (/^[A-Z]+$/.test(word)) {
                            return word; // Keep the word in its original uppercase form
                        }
                        // Otherwise, capitalize the first letter
                        return word.charAt(0).toUpperCase() + word.slice(1);
                    })
                    .join(' ');
            };

            const getProjectFormList = async (businessId, applicationId) => {
                const projectForm = $('#projectFormsTable tbody');
                try {
                    const response = await $.ajax({
                        url: PROJECT_LIST_ROUTE.GET_PROJECT_FORMS.replace(
                            ':business_id',
                            businessId
                        ).replace(':application_id', applicationId),
                        type: 'GET',
                    });

                    // Corrected mapping and HTML generation
                    const formList = response
                        .map(
                            (form) => /*html*/ `
                        <tr>
                            <td>${formatFormKey(form.key ?? '')}</td>
                            <td>${customDateFormatter(form.created_at ?? '')}</td>
                            <td>${customDateFormatter(form.updated_at ?? '')}</td>
                            <td>
                                <button
                                    class="btn btn-primary viewForm"
                                    type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#viewProjectForm"
                                    data-form-key="${form.key}"
                                    data-business-id="${businessId}"
                                    data-application-id="${applicationId}"
                                    aria-controls="viewProjectForm"
                                >
                                <i class="ri-eye-line ri-1x"></i>
                                </button>
                            </td>
                        </tr>
                    `
                        )
                        .join(''); // Important: join the array of strings

                    projectForm.empty().append(formList);
                } catch (error) {
                    console.error('Error fetching project forms:', error);
                    // Consider showing a user-friendly error message
                    projectForm.empty().append(`
                        <tr>
                            <td colspan="4" class="text-center text-danger">
                                Unable to load project forms
                            </td>
                        </tr>
                    `);
                }
            };

            const getProjectForm = async (
                businessId,
                applicationId,
                formKey
            ) => {
                const projectFormModal = $('#viewProjectForm .modal-body');
                try {
                    let resourceToFetch = '';
                    switch (formKey) {
                        case 'tna_form':
                            resourceToFetch =
                                PROJECT_LIST_ROUTE.GET_TNA_DOCUMENT;
                            break;
                        case 'project_proposal_form':
                            resourceToFetch =
                                PROJECT_LIST_ROUTE.GET_PROJECT_PROPOSAL;
                            break;
                        case 'rtec_report_form':
                            resourceToFetch =
                                PROJECT_LIST_ROUTE.GET_RTEC_REPORT;
                            break;
                        default:
                            throw new Error('Invalid form key');
                    }
                    const response = await $.ajax({
                        url: resourceToFetch
                            .replace(':business_id', businessId)
                            .replace(':application_id', applicationId),
                        type: 'GET',
                    });
                    projectFormModal.empty().html(response);
                } catch (error) {
                    throw error;
                }
            };

            const projectFormModal = $('#viewProjectForm');
            projectFormModal.on('show.bs.modal', async function (event) {
                try {
                    const btn = $(event.relatedTarget);
                    const businessId = btn.attr('data-business-id');
                    const applicationId = btn.attr('data-application-id');
                    const formKey = btn.attr('data-form-key');
                    await getProjectForm(businessId, applicationId, formKey);
                } catch (error) {
                    showToastFeedback(
                        'text-bg-danger',
                        error?.message || 'Error in Retrieving Project Form'
                    );
                }
            });

            const approvedProjectProposal = async (
                businessId,
                projectId,
                assignedStaff_Id
            ) => {
                const isConfirmed = await createConfirmationModal({
                    title: 'Approve Project',
                    titleBg: 'bg-primary',
                    message: 'Are you sure you want to approve this project?',
                    confirmText: 'Yes',
                    confirmButtonClass: 'btn-primary',
                    cancelText: 'No',
                });
                if (!isConfirmed) {
                    return;
                }

                showProcessToast('Approving Project...');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content'
                        ),
                    },
                    url: PROJECT_LIST_ROUTE.APPROVED_PROJECT,
                    type: 'POST',
                    data: {
                        business_id: businessId,
                        project_id: projectId,
                        assigned_staff_id: assignedStaff_Id,
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            hideProcessToast();
                            showToastFeedback(
                                'text-bg-success',
                                response.message
                            );
                            getforApprovalProject();
                            closeOffcanvasInstances('#approvalDetails');
                        }
                    },
                    error: function (xhr, status, error) {
                        hideProcessToast();
                        showToastFeedback('text-bg-danger', error);
                    },
                });
            };

            //Submit the Approved Proposal
            $('#approvedButton').on('click', function () {
                const businessId = $('#b_id').val();
                const projectId = $('#ProjectId').val();
                const assignedStaff_Id = $('#Assigned_to').val();

                if (
                    typeof businessId !== 'undefined' &&
                    typeof projectId !== 'undefined' &&
                    typeof assignedStaff_Id !== 'undefined'
                ) {
                    approvedProjectProposal(
                        businessId,
                        projectId,
                        assignedStaff_Id
                    );
                }
            });

            async function getOngoingProjects() {
                try {
                    const response = await fetch(
                        PROJECT_LIST_ROUTE.GET_ONGOING_PROJECTS,
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
                    console.log(data);
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
                                        class="fee_applied"
                                        value="${Ongoing.fee_applied}"
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
                                            Ongoing?.evaluated_by_prefix +
                                            ' ' +
                                            Ongoing.evaluated_by_f_name +
                                            ' ' +
                                            Ongoing?.evaluated_by_mid_name +
                                            ' ' +
                                            Ongoing.evaluated_by_l_name +
                                            ' ' +
                                            Ongoing?.evaluated_by_suffix
                                        }"
                                    />
                                    <input
                                        type="hidden"
                                        class="handled_by"
                                        value="${
                                            Ongoing?.handled_by_prefix +
                                            ' ' +
                                            Ongoing.handled_by_f_name +
                                            ' ' +
                                            Ongoing?.handled_by_mid_name +
                                            ' ' +
                                            Ongoing.handled_by_l_name +
                                            ' ' +
                                            Ongoing?.handled_by_suffix
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
                                `${
                                    formatNumberToCurrency(amount_refunded) +
                                    ' / ' +
                                    formatNumberToCurrency(to_be_refunded)
                                }<span class="badge text-white bg-primary">${percentage}%</span>`,
                                /*html*/ `<button
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
                    throw new Error(
                        'Error fetching ongoing projects: ' + error
                    );
                }
            }

            async function getCompletedProjects() {
                try {
                    const response = await fetch(
                        PROJECT_LIST_ROUTE.GET_COMPLETED_PROJECTS,
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
                                            completed?.evaluated_by_prefix +
                                            ' ' +
                                            completed.evaluated_by_f_name +
                                            ' ' +
                                            completed?.evaluated_by_mid_name +
                                            ' ' +
                                            completed.evaluated_by_l_name +
                                            ' ' +
                                            completed?.evaluated_by_suffix
                                        }"
                                    />
                                    <input
                                        type="hidden"
                                        class="handled_by"
                                        value="${
                                            completed?.handled_by_prefix +
                                            ' ' +
                                            completed.handled_by_f_name +
                                            ' ' +
                                            completed?.handled_by_mid_name +
                                            ' ' +
                                            completed.handled_by_l_name +
                                            ' ' +
                                            completed?.handled_by_suffix
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
                                    formatNumberToCurrency(amount_refunded) +
                                    ' / ' +
                                    formatNumberToCurrency(to_be_refunded)
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
                    throw new Error(
                        'Error fetching completed projects: ' + error
                    );
                }
            }

            await getforApprovalProject();
            await getOngoingProjects();
            await getCompletedProjects();
        },

        ApplicantList: async () => {
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
                                    (item.prefix ? item.prefix : '') +
                                    ' ' +
                                    item.f_name +
                                    ' ' +
                                    (item.mid_name ? item.mid_name : '') +
                                    ' ' +
                                    (item.suffix ? item.suffix : '')
                                }`,
                                `${item.designation}`,
                                /*html*/ `<div>
                                    <strong>Firm Name:</strong>
                                    <span class="firm_name"
                                        >${item.firm_name}</span
                                    ><br />
                                    <strong>Business Address:</strong>
                                    <input
                                        type="hidden"
                                        name="userID"
                                        value="${item.user_id}"
                                    />
                                    <input
                                        type="hidden"
                                        name="applicationID"
                                        value="${item.Application_ID}"
                                    />
                                    <input
                                        type="hidden"
                                        name="businessID"
                                        value="${item.business_id}"
                                    />
                                    <input
                                        type="hidden"
                                        name="personnelMaleDirectRe"
                                        value="${item.male_direct_re || 0}"
                                    />
                                    <input
                                        type="hidden"
                                        name="personnelFemaleDirectRe"
                                        value="${item.female_direct_re || 0}"
                                    />
                                    <input
                                        type="hidden"
                                        name="personnelMaleDirectPart"
                                        value="${item.male_direct_part || 0}"
                                    />
                                    <input
                                        type="hidden"
                                        name="personnelFemaleDirectPart"
                                        value="${item.female_direct_part || 0}"
                                    />
                                    <input
                                        type="hidden"
                                        name="personnelMaleIndirectRe"
                                        value="${item.male_indirect_re || 0}"
                                    />
                                    <input
                                        type="hidden"
                                        name="personnelFemaleIndirectRe"
                                        value="${item.female_indirect_re || 0}"
                                    />
                                    <input
                                        type="hidden"
                                        name="personnelMaleIndirectPart"
                                        value="${item.male_indirect_part || 0}"
                                    />
                                    <input
                                        type="hidden"
                                        name="personnelFemaleIndirectPart"
                                        value="${
                                            item.female_indirect_part || 0
                                        }"
                                    />
                                    <input
                                        type="hidden"
                                        name="personnelTotal"
                                        value="${item.total_personnel || 0}"
                                    />
                                    <span class="b_address text-truncate"
                                        >${item.landMark}, ${item.barangay},
                                        ${item.city}, ${item.province},
                                        ${item.region}</span
                                    ><br />
                                    <strong>Type of Enterprise:</strong>
                                    <span class="enterprise_type"
                                        >${item.enterprise_type}</span
                                    >
                                    <p>
                                        <strong>Assets:</strong> <br />
                                        <span class="ps-2 building_assets"
                                            >Building:
                                            <span class="building_value"
                                                >${formatNumberToCurrency(
                                                    parseFloat(
                                                        item.building_value
                                                    )
                                                )}</span
                                            ></span
                                        ><br />
                                        <span class="ps-2 equipment_assets"
                                            >Equipment:
                                            <span class="equipment_value"
                                                >${formatNumberToCurrency(
                                                    parseFloat(
                                                        item.equipment_value
                                                    )
                                                )}</span
                                            ></span
                                        >
                                        <br />
                                        <span
                                            class="ps-2 working_capital_assets"
                                            >Working Capital:
                                            <span class="working_capital"
                                                >${formatNumberToCurrency(
                                                    parseFloat(
                                                        item.working_capital
                                                    )
                                                )}</span
                                            ></span
                                        >
                                    </p>
                                    <strong>Contact Details:</strong>
                                    <p>
                                        <strong class="p-2">Landline:</strong>
                                        <span class="landline"
                                            >${item.landline}</span
                                        >
                                        <br />
                                        <strong class="p-2"
                                            >Mobile Phone:</strong
                                        >
                                        <span class="mobile_num"
                                            >${item.mobile_number}</span
                                        >
                                        <br />
                                        <strong class="p-2">Email:</strong>
                                        <span class="email_add"
                                            >${item.email}</span
                                        >
                                    </p>
                                </div>`,
                                `${customDateFormatter(item.date_applied)}`,
                                /*html*/ `<span
                                    class="badge ${
                                        item.application_status === 'new'
                                            ? 'bg-primary'
                                            : item.application_status ===
                                                'evaluation'
                                              ? 'bg-info'
                                              : item.application_status ===
                                                  'pending'
                                                ? 'bg-primary'
                                                : 'bg-danger'
                                    }"
                                    >${item.application_status}</span
                                >`,
                                /*html*/ ` <button
                                    class="btn btn-primary viewApplicant"
                                    type="button"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#applicantDetails"
                                    aria-controls="applicantDetails"
                                >
                                    <i class="ri-menu-unfold-4-line ri-1x"></i>
                                </button>`,
                            ];
                        })
                    )
                    .draw();
            };

            $('#ApplicanttableBody').on('click', '.viewApplicant', function () {
                const row = $(this).closest('tr');
                const offCanvaReadonlyInputs =
                    $('#applicantDetails').find('input');

                const cooperatorName = row
                    .find('td:nth-child(2)')
                    .text()
                    .trim();
                const designation = row.find('td:nth-child(3)').text().trim();
                const businessId = row.find('input[name="businessID"]').val();
                const businessAddress = row.find('.b_address').text().trim();

                const personnelMaleDirectRe = row
                    .find('input[name="personnelMaleDirectRe"]')
                    .val();
                const personnelFemaleDirectRe = row
                    .find('input[name="personnelFemaleDirectRe"]')
                    .val();
                const personnelMaleDirectPart = row
                    .find('input[name="personnelMaleDirectPart"]')
                    .val();
                const personnelFemaleDirectPart = row
                    .find('input[name="personnelFemaleDirectPart"]')
                    .val();
                const personnelMaleIndirectRe = row
                    .find('input[name="personnelMaleIndirectRe"]')
                    .val();
                const personnelFemaleIndirectRe = row
                    .find('input[name="personnelFemaleIndirectRe"]')
                    .val();
                const personnelMaleIndirectPart = row
                    .find('input[name="personnelMaleIndirectPart"]')
                    .val();
                const personnelFemaleIndirectPart = row
                    .find('input[name="personnelFemaleIndirectPart"]')
                    .val();
                const personnelTotal = row
                    .find('input[name="personnelTotal"]')
                    .val();

                const typeOfEnterprise = row
                    .find('.enterprise_type')
                    .text()
                    .trim();
                const landline = row.find('.landline').text().trim();
                const mobilePhone = row.find('.mobile_num').text().trim();
                const email = row.find('.email_add').text().trim();
                const building = row.find('.building_value').text().trim();
                const equipment = row.find('.equipment_value').text().trim();
                const workingCapital = row
                    .find('.working_capital')
                    .text()
                    .trim();

                console.log(offCanvaReadonlyInputs);
                offCanvaReadonlyInputs
                    .filter('.cooperator-name')
                    .val(cooperatorName);
                offCanvaReadonlyInputs.filter('.designation').val(designation);
                offCanvaReadonlyInputs.filter('.business-id').val(businessId);
                offCanvaReadonlyInputs
                    .filter('.business-address')
                    .val(businessAddress);
                offCanvaReadonlyInputs
                    .filter('.type-of-enterprise')
                    .val(typeOfEnterprise);
                offCanvaReadonlyInputs.filter('.landline').val(landline);
                offCanvaReadonlyInputs.filter('.mobile-phone').val(mobilePhone);
                offCanvaReadonlyInputs.filter('.email').val(email);
                offCanvaReadonlyInputs.filter('.building').val(building);
                offCanvaReadonlyInputs.filter('.equipment').val(equipment);
                offCanvaReadonlyInputs
                    .filter('.working-capital')
                    .val(workingCapital);

                offCanvaReadonlyInputs
                    .filter('.personnel-male-direct-re')
                    .val(personnelMaleDirectRe);
                offCanvaReadonlyInputs
                    .filter('.personnel-female-direct-re')
                    .val(personnelFemaleDirectRe);
                offCanvaReadonlyInputs
                    .filter('.personnel-direct-re-total')
                    .val(
                        parseInt(personnelMaleDirectRe || 0) +
                            parseInt(personnelFemaleDirectRe || 0)
                    );

                offCanvaReadonlyInputs
                    .filter('.personnel-male-direct-part')
                    .val(personnelMaleDirectPart);
                offCanvaReadonlyInputs
                    .filter('.personnel-female-direct-part')
                    .val(personnelFemaleDirectPart);
                offCanvaReadonlyInputs
                    .filter('.personnel-direct-part-total')
                    .val(
                        parseInt(personnelMaleDirectPart || 0) +
                            parseInt(personnelFemaleDirectPart || 0)
                    );

                offCanvaReadonlyInputs
                    .filter('.personnel-male-indirect-re')
                    .val(personnelMaleIndirectRe);
                offCanvaReadonlyInputs
                    .filter('.personnel-female-indirect-re')
                    .val(personnelFemaleIndirectRe);
                offCanvaReadonlyInputs
                    .filter('.personnel-indirect-re-total')
                    .val(
                        parseInt(personnelMaleIndirectRe || 0) +
                            parseInt(personnelFemaleIndirectRe || 0)
                    );

                offCanvaReadonlyInputs
                    .filter('.personnel-male-indirect-part')
                    .val(personnelMaleIndirectPart);
                offCanvaReadonlyInputs
                    .filter('.personnel-female-indirect-part')
                    .val(personnelFemaleIndirectPart);
                offCanvaReadonlyInputs
                    .filter('.personnel-indirect-part-total')
                    .val(
                        parseInt(personnelMaleIndirectPart || 0) +
                            parseInt(personnelFemaleIndirectPart || 0)
                    );

                offCanvaReadonlyInputs
                    .filter('.personnel-total')
                    .val(personnelTotal);
            });

            await getApplicants();
        },

        Users: async () => {
            $('#user_staff').DataTable({
                autoWidth: false,
                responsive: true,
                columns: [
                    {
                        title: '#',
                        width: '5%',
                        className: 'text-center',
                    },
                    {
                        title: 'Name',
                        width: '30%',
                    },
                    {
                        title: 'Email',
                        width: '20%',
                    },
                    {
                        title: 'Username',
                        width: '20%',
                    },
                    {
                        title: 'Access Status',
                        width: '15%',
                    },
                    {
                        title: 'Action',
                        width: '10%',
                    },
                ],
            });

            const getStaffUserLists = async () => {
                try {
                    const response = await $.ajax({
                        type: 'GET',
                        url: USERS_LIST_ROUTE.GET_STAFF_USER_LISTS,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                    });

                    const staffUserTable = $('#user_staff').DataTable();

                    staffUserTable.clear();

                    staffUserTable.rows.add(
                        response.map((staff) => [
                            staff.id,
                            /*html*/ `
                            <div class="d-flex align-items-center justify-content-left gap-2">
                                <div class="profile-logo d-flex align-items-center justify-content-center rounded-circle border border-1 border-white bg-primary text-white fw-bold" style="width: 40px; height: 40px; font-size: 1.25rem;">
                                    ${
                                        staff.avatar
                                            ? '<img src="' +
                                              staff.avatar +
                                              '" class="img-fluid rounded-circle">'
                                            : staff.f_name.charAt(0)
                                    }
                                </div>
                                <div class="profile-name">
                                    <p class="m-0 text-dark fw-semibold">
                                        ${staff?.prefix || ''} ${staff.f_name || ''} ${staff?.mid_name || ''} ${staff.l_name || ''} ${staff?.suffix || ''}
                                    </p>
                                </div>
                            </div>`,
                            staff.email,
                            staff.user_name,
                            /*html*/ `<span
                                class="badge ${
                                    staff.access_to === 'Restricted'
                                        ? 'bg-danger'
                                        : 'bg-success'
                                }"
                                >${staff.access_to}</span
                            >`,
                            /*html*/ ` <button
                                    class="btn btn-primary btn-sm"
                                    type="button"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#viewUserOffcanvas"
                                    aria-controls="viewUserOffcanvas"
                                >
                                    <i class="ri-eye-fill"></i>
                                </button>
                                <button
                                    class="btn btn-primary btn-sm"
                                    type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#UpdateAndDeleteResourcesModal"
                                    data-option-type="updateUser"
                                >
                                    <i class="ri-pencil-fill"></i>
                                </button>
                                <button
                                    class="btn btn-danger btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#UpdateAndDeleteResourcesModal"
                                    data-option-type="deleteUser"
                                    type="button"
                                >
                                    <i class="ri-delete-bin-6-fill"></i>
                                </button>`,
                        ])
                    );

                    staffUserTable.draw();
                } catch (error) {
                    showToastFeedback(
                        'text-bg-danger',
                        error.responseJSON.message
                    );
                }
            };

            (() => {
                'use strict';

                // Fetch all forms that need validation
                const NewUsersForms =
                    document.querySelectorAll('.needs-validation');

                // Attach form validation and submission to the submit button click event
                $('#newUserForm').on('submit', async function (event) {
                    // Prevent default button action
                    event.preventDefault();

                    // Loop through each form with 'needs-validation'
                    Array.from(NewUsersForms).forEach(async (form) => {
                        // Check if the form is valid
                        if (!form.checkValidity()) {
                            event.stopPropagation();
                            form.classList.add('was-validated');
                        } else {
                            // If valid, trigger the AJAX form submission
                            const isConfirmed = await createConfirmationModal({
                                title: 'Add New Organization User',
                                titleBg: 'bg-primary',
                                message:
                                    'Are you sure you want to add this user?',
                                confirmText: 'Yes',
                                confirmButtonClass: 'btn-primary',
                                cancelText: 'No',
                            });

                            if (!isConfirmed) {
                                return;
                            }
                            addStaffUser(form);
                        }
                    });
                });
            })();

            const addStaffUser = async (form) => {
                try {
                    showProcessToast('Adding Staff User...');
                    // Create FormData object from the form element
                    const formData = new FormData(form);

                    const response = await $.ajax({
                        type: 'POST',
                        url: USERS_LIST_ROUTE.GET_STAFF_USER_LISTS,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                        processData: false, // Don't process the data
                        contentType: false, // Let jQuery set the content type based on formData
                        data: formData,
                    });
                    getStaffUserLists();
                    hideProcessToast();
                    closeModal('#AddUserModal');
                    showToastFeedback('text-bg-success', response.success);
                } catch (error) {
                    hideProcessToast();
                    showToastFeedback(
                        'text-bg-danger',
                        error.responseJSON.message
                    );
                }
            };

            const updateStaffUser = async (user_name) => {
                try {
                    const isConfirmed = await createConfirmationModal({
                        title: 'Update Access Status',
                        titleBg: 'bg-primary',
                        message:
                            'Are you sure you want to update the access status?',
                        confirmText: 'Yes',
                        confirmButtonClass: 'btn-primary',
                        cancelText: 'No',
                    });
                    if (!isConfirmed) {
                        return;
                    }
                    showProcessToast('Updating Access Status...');
                    const toggleStaffAccess = $('#toggleStaffAccess').prop(
                        'checked'
                    )
                        ? 'Allowed'
                        : 'Restricted';
                    const response = await $.ajax({
                        type: 'PUT',
                        url: USERS_LIST_ROUTE.UPDATE_STAFF_USER.replace(
                            ':user_name',
                            user_name
                        ),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                        data: {
                            access_to: toggleStaffAccess,
                        },
                    });
                    getStaffUserLists();
                    hideProcessToast();
                    showToastFeedback('text-bg-success', response.success);
                } catch (error) {
                    hideProcessToast();
                    showToastFeedback(
                        'text-bg-danger',
                        error.responseJSON.message
                    );
                }
            };

            const deleteStaffUser = async (user_name) => {
                try {
                    const isConfirmed = await createConfirmationModal({
                        title: 'Delete User',
                        titleBg: 'bg-danger',
                        message:
                            'Are you sure you want to delete this user their might still projects handled by this user?',
                        confirmText: 'Yes',
                        confirmButtonClass: 'btn-danger',
                        cancelText: 'No',
                    });
                    if (!isConfirmed) {
                        return;
                    }
                    showProcessToast('Deleting User...');
                    const response = await $.ajax({
                        type: 'DELETE',
                        url: USERS_LIST_ROUTE.DELETE_STAFF_USER.replace(
                            ':user_name',
                            user_name
                        ),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                    });
                    getStaffUserLists();
                    hideProcessToast();
                    showToastFeedback('text-bg-success', response.success);
                } catch (error) {
                    hideProcessToast();
                    showToastFeedback(
                        'text-bg-danger',
                        error.responseJSON.message
                    );
                }
            };

            $('#UpdateAndDeleteResourcesModal').on(
                'show.bs.modal',
                function (e) {
                    const triggerdButton = $(e.relatedTarget);
                    const buttonRow = triggerdButton.closest('tr');
                    const optionType = triggerdButton.data('option-type');

                    // Cache DOM elements
                    const accessTo = buttonRow
                        .find('td:nth-child(5)')
                        .text()
                        .trim();
                    const staffName = buttonRow
                        .find('td:nth-child(2)')
                        .text()
                        .trim();
                    const userName = buttonRow
                        .find('td:nth-child(4)')
                        .text()
                        .trim();
                    const modal = $(this);
                    const modalHeader = modal.find('.modal-header');
                    const modalTitle = modal.find('.modal-title');
                    const modalBody = modal.find('.modal-body');
                    const modalActionButton = modal.find('#actionToPerform');

                    modalActionButton
                        .removeData('action-type')
                        .removeData('unique-val');

                    // Update modal content
                    const modalHeaderContent =
                        optionType === 'updateUser'
                            ? 'Update User'
                            : 'Delete User';

                    modalHeader
                        .removeClass('bg-danger bg-primary')
                        .addClass(
                            optionType === 'deleteUser'
                                ? 'bg-danger'
                                : 'bg-primary'
                        );

                    modalTitle.text(modalHeaderContent);

                    const modalBodyContent =
                        optionType === 'updateUser'
                            ? /*html*/ `<div class="form-check form-switch">
               <input class="form-check-input" type="checkbox" role="switch" id="toggleStaffAccess">
               <label class="form-check-label" for="toogleStaffAccess">Are you sure you want to update Access for this user <strong>${sanitize(
                   staffName
               )}?</strong></label>
             </div>`
                            : /*html*/ `<p>Are you sure you want to delete <strong>${sanitize(
                                  staffName
                              )}?</strong></p>`;

                    modalBody.html(modalBodyContent);

                    // Set toggle switch state
                    modal
                        .find('#toggleStaffAccess')
                        .prop('checked', accessTo === 'Restricted');

                    // Update action button
                    modalActionButton
                        .removeClass('btn-danger btn-primary')
                        .addClass(
                            optionType === 'deleteUser'
                                ? 'btn-danger'
                                : 'btn-primary'
                        )
                        .text(optionType === 'deleteUser' ? 'Delete' : 'Update')
                        .attr('data-action-type', optionType)
                        .attr('data-unique-val', userName);

                    modalActionButton.off('click').on('click', function () {
                        const optionType = $(this).data('action-type');
                        const uniqueVal = $(this).data('unique-val');

                        if (optionType === 'updateUser') {
                            updateStaffUser(uniqueVal);
                        } else if (optionType === 'deleteUser') {
                            deleteStaffUser(uniqueVal);
                        }
                    });
                }
            );

            // Helper function for sanitization
            const VIEW_USER_OFFCANVAS = $('#viewUserOffcanvas');

            const staffAuditLogs = new ActivityLogHandler(
                VIEW_USER_OFFCANVAS,
                USER_ROLE,
                'selectedStaff'
            );

            const changeProfilePicStyle = (userProfile) => {
                const tempElement = $('<div>').html(userProfile);

                // Find the element with the style attribute you want to modify
                const targetElement = tempElement.find('.profile-logo');

                // Modify the style attribute (if the element is found)
                if (targetElement.length > 0) {
                    targetElement.css({
                        width: '60px',
                        height: '60px',
                    });
                }

                // Get the modified HTML
                return tempElement.html();
            };
            VIEW_USER_OFFCANVAS.on('show.bs.offcanvas', function (e) {
                try {
                    const triggerdButton = $(e.relatedTarget);
                    const buttonRow = triggerdButton.closest('tr');
                    const staff_id = buttonRow
                        .find('td:nth-child(1)')
                        .text()
                        .trim();
                    const userProfile = buttonRow
                        .find('td:nth-child(2)')
                        .html();
                    const StaffName = buttonRow
                        .find('td:nth-child(2) .profile-name p')
                        .text()
                        .trim();
                    const Email = buttonRow
                        .find('td:nth-child(3)')
                        .text()
                        .trim();
                    const UserName = buttonRow
                        .find('td:nth-child(4)')
                        .text()
                        .trim();

                    const offcanvas = $(this);

                    offcanvas
                        .find('#userProfile')
                        .html(changeProfilePicStyle(userProfile));
                    staffAuditLogs.getSelectedStaffActivityLog(staff_id);
                } catch (error) {
                    showToastFeedback('text-bg-danger', error);
                }
            });

            await getStaffUserLists();
        },
        ProjectSettings: () => {
            const ProjectFeeForm = $('#projectFeeForm');

            ProjectFeeForm.on('submit', async function (event) {
                event.preventDefault();
                const isConfirmed = await createConfirmationModal({
                    title: 'Update Project Fee',
                    titleBg: 'bg-primary',
                    message: 'Are you sure you want to update the project fee?',
                    confirmText: 'Yes',
                    confirmButtonClass: 'btn-primary',
                    cancelText: 'No',
                });
                if (!isConfirmed) {
                    return;
                }
                showProcessToast('Updating Project Fee...');
                try {
                    const formData = new FormData(this);
                    const response = await $.ajax({
                        type: 'POST',
                        url: PROJECT_SETTINGS_ROUTE.UPDATE_PROJECT_FEE,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                        processData: false, // Don't process the data
                        contentType: false, // Let jQuery set the content type based on formData
                        data: formData,
                    });
                    hideProcessToast();
                    showToastFeedback('text-bg-success', response.message);
                } catch (error) {
                    hideProcessToast();
                    showToastFeedback(
                        'text-bg-danger',
                        error.responseJSON.message
                    );
                }
            });
        },
    };
    return functions;
}
