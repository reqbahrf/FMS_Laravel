import "./echo";
import Notification from "./Notification";
import NotificationContainer from "./NotificationContainer";
import {
    showToastFeedback,
    formatToString,
    dateFormatter,
    closeOffcanvasInstances,
    formatToNumber,
    closeModal,
} from "./ReusableJS/utilFunctions";

import DataTable from "datatables.net-bs5";
window.DataTable = DataTable;
import "datatables.net-buttons-bs5";
import "datatables.net-buttons/js/buttons.html5.mjs";
import "datatables.net-fixedcolumns-bs5";
import "datatables.net-fixedheader-bs5";
import "datatables.net-responsive-bs5";
import "datatables.net-scroller-bs5";

Echo.private(`staff-notifications.${USER_ID}`).listen(
    ".Illuminate\\Notifications\\Events\\BroadcastNotificationCreated",
    (e) => {
        try {
            console.log("Raw event:", e);
            const NotificationData = e;

            if (!NotificationData) {
                throw new Error("Notification data is undefined");
            }

            NotificationContainer(NotificationData);
        } catch (error) {
            console.error("Error parsing notification data:", error);
            console.log("Raw data:", e.data);
        }
    }
);

Notification();

$(document).on("DOMContentLoaded", function () {
    // Line chart
    //toast feedback

    //Side Nav toggle

    $(".sideNavButtonSmallScreen").on("click", function () {
        new bootstrap.Offcanvas($("#MobileNavOffcanvas")).show();
    });

    $(".sideNavButtonLargeScreen").on("click", function () {
        $(".sidenav").toggleClass("expanded minimized");
        $("#toggle-left-margin").toggleClass("navExpanded navMinimized");
        $(".logoTitleLScreen").toggle();
        //side bar minimize
        $(".sidenav a span").each(function () {
            $(this).toggleClass("d-none");
        });

        $(".sidenav a").each(function () {
            $(this).toggleClass("justify-content-center");
        });
        //size bar minimize rotation
        $("#hover-link").toggleClass("rotate-icon");
    });
});

$(function () {
    let lastUrl = sessionStorage.getItem("StafflastUrl");
    let lastActive = sessionStorage.getItem("StafflastActive");
    if (lastUrl && lastActive) {
        loadPage(lastUrl, lastActive);
    } else {
        loadPage(NAV_ROUTES.DASHBOARD, "dashboardLink");
    }
});

const setActiveLink = (activeLink) => {
    $(".nav-item a").removeClass("active");
    const defaultLink = "dashboardLink";
    const linkToActivate = $("#" + (activeLink || defaultLink));
    linkToActivate.addClass("active");
};

window.loadPage = async (url, activeLink) => {
    try {
        $(".spinner").removeClass("d-none");
        $("#main-content").hide();
        const cachedPage = sessionStorage.getItem(url);
        if (cachedPage) {
            handleAjaxSuccess(cachedPage, activeLink, url);
        } else {
            const response = await $.ajax({
                url,
                type: "GET",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            await handleAjaxSuccess(response, activeLink, url);
        }
    } catch (error) {
        console.log("Error: ", error);
    } finally {
        $(".spinner").addClass("d-none");
        $("#main-content").show();
    }
};

const handleAjaxSuccess = async (response, activeLink, url) => {
    try {
        $("#main-content").html(response);
        setActiveLink(activeLink);
        history.pushState(null, "", url);

        const functions = await initializeStaffPageJs();

        const urlMapFunctions = {
            [NAV_ROUTES.DASHBOARD]: functions.Dashboard,
            [NAV_ROUTES.PROJECT]: functions.Projects,
            [NAV_ROUTES.ADD_PROJECT]: functions.AddProject,
            [NAV_ROUTES.APPLICANT]: functions.Applicant,
        };

        if (urlMapFunctions[url]) {
            urlMapFunctions[url]();
        }

        //  if (url === '/org-access/viewCooperatorInfo.php') {
        //      await InitializeviewCooperatorProgress();
        //  }

        sessionStorage.setItem("StafflastUrl", url);
        sessionStorage.setItem("StafflastActive", activeLink);
    } catch (error) {
        console.log("Error: ", error);
    }
};

window.initializeStaffPageJs = async () => {
    const functions = {
        Dashboard: () => {
            //Foramt Input with Id paymentAmount
            formatToNumber("#paymentAmount");
            formatToNumber("#days_open");
            formatToNumber("#updateOpenDays");

            // initialize datatable
            const HandledProjectDataTable = $("#handledProject").DataTable({
                autoWidth: false,
                responsive: true,
                columns: [
                    {
                        title: "ID",
                    },
                    {
                        title: "Project Title",
                    },
                    {
                        title: "Firm Name",
                    },
                    {
                        title: "Owner Name",
                    },
                    {
                        title: "Refund Progress",
                    },
                    {
                        title: "Status",
                    },
                    {
                        title: "Action",
                    },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        width: "10%",
                    },
                    {
                        targets: 1,
                        width: "20%",
                    },
                    {
                        targets: 2,
                        width: "15%",
                    },
                    {
                        targets: 3,
                        width: "15%",
                    },
                    {
                        targets: 4,
                        width: "15%",
                        className: "text-end",
                    },
                    {
                        targets: 5,
                        width: "5%",
                        className: "text-center",
                    },
                    {
                        targets: 6,
                        width: "5%",
                        orderable: false,
                        className: "text-center",
                    },
                ],
            });
            const ProjectFileLinkDataTable = $("#linkTable").DataTable({
                autoWidth: false,
                responsive: true,
                columns: [
                    {
                        title: "File Name",
                    },
                    {
                        title: "Link",
                    },
                    {
                        title: "Date Created",
                    },
                    {
                        title: "Action",
                        className: "text-center",
                    },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        width: "15%",
                    },
                    {
                        targets: 1,
                        width: "40%",
                    },
                    {
                        targets: 2,
                        width: "20%",
                    },
                    {
                        targets: 3,
                        width: "10%",
                    },
                ],
            });

            const PaymentHistoryDataTable = $("#paymentHistoryTable").DataTable(
                {
                    responsive: true,
                    columns: [
                        {
                            title: "Transaction #",
                        },
                        {
                            title: "Amount",
                        },
                        {
                            title: "Payment Method",
                        },
                        {
                            title: "Status",
                        },
                        {
                            title: "Date Created",
                        },
                        {
                            title: "Action",
                        },
                    ],
                    columnDefs: [
                        {
                            targets: 5,
                            width: "8%",
                        },
                    ],
                }
            );

            const UploadedReceiptDataTable = $(
                "#uploadedReceiptTable"
            ).DataTable({
                autoWidth: false,
                responsive: true,
                columns: [
                    {
                        title: "Receipt Name",
                        width: "20%",
                    },
                    {
                        title: "Receipt Image",
                        width: "25%",
                    },
                    {
                        title: "Uploaded Date",
                        width: "20%",
                    },
                    {
                        title: "Status",
                        width: "10%",
                    },
                    {
                        title: "Action",
                        width: "10%",
                    },
                ],
            });

            function populateYearDropdown(selectElementId) {
                const $select = $(`#${selectElementId}`);
                const currentYear = new Date().getFullYear();

                $select.empty().append(
                    $('<option>', { value: '', text: 'Select Year', disabled: true, selected: true })
                );

                // Add current year and next 3 years
                for (let i = 0; i < 4; i++) {
                    const year = currentYear + i;
                    $select.append($('<option>', { value: year, text: year }));
                }
            }

            populateYearDropdown('yearSelect')
            /**
             * Creates a monthly data chart with the provided data for applicants, ongoing, and completed items.
             *
             * @param {Array} applicant - Data for the 'Applicant' category.
             * @param {Array} ongoing - Data for the 'Ongoing' category.
             * @param {Array} completed - Data for the 'Completed' category.
             * @returns {Promise} A promise that resolves after rendering the monthly data chart.
             */
            const createMonthlyDataChart = async (
                applicant,
                ongoing,
                completed
            ) => {
                const monthlyDataChart = {
                    theme: {
                        mode: "light",
                    },
                    series: [
                        {
                            name: "Applicant",
                            data: applicant,
                        },
                        {
                            name: "Ongoing",
                            data: ongoing,
                        },
                        {
                            name: "Completed",
                            data: completed,
                        },
                    ],
                    chart: {
                        height: 350,
                        type: "bar",
                    },
                    stroke: {
                        width: [6, 6, 6],
                        curve: "smooth",
                        dashArray: [0, 0, 0],
                    },
                    markers: {
                        size: 0,
                    },
                    xaxis: {
                        categories: [
                            "Jan",
                            "Feb",
                            "Mar",
                            "Apr",
                            "May",
                            "Jun",
                            "Jul",
                            "Aug",
                            "Sep",
                            "Oct",
                            "Nov",
                            "Dec",
                        ],
                    },
                    yaxis: {
                        title: {
                            text: "Count",
                        },
                    },
                    legend: {
                        tooltipHoverFormatter: function (val, opts) {
                            return (
                                val +
                                " - " +
                                opts.w.globals.series[opts.seriesIndex][
                                    opts.dataPointIndex
                                ] +
                                ""
                            );
                        },
                    },
                };

                return new Promise((resolve) => {
                    const lineChart = new ApexCharts(
                        document.querySelector("#lineChart"),
                        monthlyDataChart
                    );
                    lineChart.render();
                    resolve();
                });
            };

            const displayCurrentMonthStats = async (monthlyData) => {
                // Get current month index (0-11)
                const currentMonth = new Date().getMonth();
                const months = [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
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
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                };

                // Update stat counts
                $("#applicantCount").text(
                    formatNumber(currentData.Applicants || 0)
                );
                $("#ongoingCount").text(formatNumber(currentData.Ongoing || 0));
                $("#completedCount").text(
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
                $("#overallCount").text(formatNumber(overallProjects));

                // Add animation class to stat cards
                $(".stat-count").each(function () {
                    $(this).addClass("animate__animated animate__heartBeat");
                    setTimeout(() => {
                        $(this).removeClass(
                            "animate__animated animate__heartBeat"
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
                let applicant = Array(12).fill(null);
                let ongoing = Array(12).fill(null);
                let completed = Array(12).fill(null);
                const months = [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ];

                await Promise.all(
                    Object.keys(monthlyData).map(async (month) => {
                        const data = monthlyData[month];

                        const monthIndex = months.indexOf(month.slice(0, 3));

                        if (monthIndex !== -1) {
                            applicant[monthIndex] = data.Applicants || null;
                            ongoing[monthIndex] = data.Ongoing || null;
                            completed[monthIndex] = data.Completed || null;
                        }
                    })
                );
                await createMonthlyDataChart(applicant, ongoing, completed);
                await displayCurrentMonthStats(monthlyData);
            };

            const getDashboardChartData = async () => {
                try {
                    const response = await $.ajax({
                        type: "GET",
                        url: DASHBBOARD_TAB_ROUTE.GET_MONTHLY_PROJECTS_CHARTDATA,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });
                    processMonthlyDataChart(response);
                } catch (error) {
                    console.error(error);
                }
            };

            getDashboardChartData();

            //Handled Project Offcanvas Button Events

            function toggleMenu(tab, addClassMenu, removeClassMenu) {
                $(tab).on("shown.bs.tab", () => {
                    $(addClassMenu).addClass("d-none");
                    $(removeClassMenu).removeClass("d-none");
                });
                $(tab).on("hidden.bs.tab", () => {
                    $(addClassMenu).removeClass("d-none");
                    $(removeClassMenu).addClass("d-none");
                });
            }

            // Tab: nav-details-tab
            toggleMenu(
                "#nav-details-tab",
                ".AttachlinkTabMenu, .GeneratedSheetsTabMenu",
                null
            );

            // Tab: nav-link-tab
            toggleMenu(
                "#nav-link-tab",
                ".GeneratedSheetsTabMenu",
                ".AttachlinkTabMenu"
            );

            // Tab: nav-Quarterly-tab
            toggleMenu(
                "#nav-Quarterly-tab",
                ".AttachlinkTabMenu, .GeneratedSheetsTabMenu",
                null
            );

            // Tab: nav-GeneratedSheets-tab
            toggleMenu(
                "#nav-GeneratedSheets-tab",
                ".AttachlinkTabMenu",
                ".GeneratedSheetsTabMenu"
            );

            const isRefundCompleted = (boolean) => {
                const completedButton = $("#MarkCompletedProjectBtn");
                boolean
                    ? completedButton.prop("disabled", false).show()
                    : completedButton.prop("disabled", true).hide();
            };

            /**
             * Fetches handled projects from the server and updates the handled project table.
             *
             * @return {void}
             */
            const getHandleProject = async () => {
                const response = await fetch(
                    DASHBBOARD_TAB_ROUTE.GET_HANDLED_PROJECTS,
                    {
                        method: "GET",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
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
                            ", " +
                            project.barangay +
                            ", " +
                            project.city +
                            ", " +
                            project.province +
                            ", " +
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
                                project.prefix +
                                " " +
                                project.f_name +
                                " " +
                                project.l_name +
                                " " +
                                project.suffix
                            }</p>
                        <input type="hidden" class="sex" value="${project.sex}">
                        <input type="hidden" class="birth_date" value="${
                            project.birth_date
                        }">
                        <input type="hidden" class="landline" value="${
                            project.landline ?? ""
                        }">
                        <input type="hidden" class="mobile_phone" value="${
                            project.mobile_number
                        }">
                        <input type="hidden" class="email" value="${
                            project.email
                        }">`,
                            `${
                                formatToString(refunded_amount) +
                                "/" +
                                formatToString(Actual_Amount)
                            }<span class="badge ms-1 text-white bg-primary">${percentage}%</span>
                    <input type="hidden" class="approved_amount" value="${
                        project.Approved_Amount
                    }">
                    <input type="hidden" class="actual_amount" value="${Actual_Amount}">`,
                            `<span class="badge ${
                                project.application_status === "approved"
                                    ? "bg-warning"
                                    : project.application_status === "ongoing"
                                    ? "bg-primary"
                                    : project.application_status === "completed"
                                    ? "bg-success"
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
            };

            getHandleProject();

            /**
             * Handles the content of the project offcanvas based on the project status.
             *
             * @param {string} project_status - The status of the project (approved, ongoing, completed)
             * @return {Promise<void>} A promise that resolves when the offcanvas content has been updated
             */
            async function handleProjectOffcanvasContent(project_status) {
                const handleProjectOffcanvas = $("#handleProjectOff");
                const content = {
                    approved: () => {
                        handleProjectOffcanvas
                            .find(".approvedProjectContent")
                            .removeClass("d-none");
                        handleProjectOffcanvas
                            .find(
                                ".ongoingProjectContent, .completedProjectContent, .paymentProjectContent"
                            )
                            .addClass("d-none");
                    },
                    ongoing: async () => {
                        handleProjectOffcanvas
                            .find(
                                ".ongoingProjectContent, .paymentProjectContent"
                            )
                            .removeClass("d-none");
                        handleProjectOffcanvas
                            .find(
                                ".approvedProjectContent, .completedProjectContent"
                            )
                            .addClass("d-none");
                    },
                    completed: async () => {
                        handleProjectOffcanvas
                            .find(
                                ".completedProjectContent, .paymentProjectContent"
                            )
                            .removeClass("d-none");
                        handleProjectOffcanvas
                            .find(
                                ".approvedProjectContent, .ongoingProjectContent"
                            )
                            .addClass("d-none");
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
                    $("#paymentForm").serialize() + "&project_id=" + project_id;

                try {
                    const response = await $.ajax({
                        type: "POST",
                        url: DASHBBOARD_TAB_ROUTE.STORE_PAYMENT_RECORDS,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        data: formData,
                    });

                    closeModal("#paymentModal");
                    await getPaymentHistoryAndCalculation(
                        project_id,
                        getAmountRefund()
                    );
                    setTimeout(() => {
                        showToastFeedback("text-bg-success", response.message);
                    }, 500);
                } catch (error) {
                    setTimeout(() => {
                        showToastFeedback(
                            "text-bg-danger",
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
                    const project_id = $("#ProjectID").val();
                    const transaction_id = $("#TransactionID").val();
                    const formData = $("#paymentForm").serialize();
                    const response = await $.ajax({
                        type: "PUT",
                        url: DASHBBOARD_TAB_ROUTE.UPDATE_PAYMENT_RECORDS.replace(
                            ":transaction_id",
                            transaction_id
                        ),
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        data: formData + "&project_id=" + project_id,
                    });

                    closeModal("#paymentModal");
                    await getPaymentHistoryAndCalculation(
                        project_id,
                        getAmountRefund()
                    );
                    setTimeout(() => {
                        showToastFeedback("text-bg-success", response.message);
                    }, 500);
                } catch (error) {
                    showToastFeedback(
                        "text-bg-danger",
                        error.responseJSON.message
                    );
                }
            }

            /**
             * Event listener for the submit payment button click event.
             *
             * Handles the submission of payment records based on the submission method.
             * If the submission method is 'add', it calls the storePaymentRecords function.
             * If the submission method is 'update', it calls the update_payment_records function.
             *
             * @param {Event} event - The click event triggered by the submit payment button.
             */
            $("#submitPayment").on("click", function () {
                const submissionMethod = $(this).attr("data-submissionmethod");

                console.log(submissionMethod);

                if (submissionMethod === "add") {
                    const project_id = $("#ProjectID").val();
                    if (project_id) {
                        storePaymentRecords(project_id);
                    } else {
                        console.error("Project ID is null");
                    }
                } else if (submissionMethod === "update") {
                    update_payment_records();
                } else {
                    console.error("Submission method is not defined");
                }
            });

            /**
             * Fetches payment history for a given project ID and populates the payment history table.
             *
             * @param {string} projectId - The ID of the project to fetch payment history for.
             * @return {Promise} A promise that resolves when the payment history table has been populated.
             * @throws {Error} If there is an error fetching the payment history.
             */
            async function getPaymentHistory(projectId) {
                try {
                    const response = await $.ajax({
                        type: "GET",
                        url:
                            DASHBBOARD_TAB_ROUTE.GET_PAYMENT_RECORDS +
                            "?project_id=" +
                            projectId,
                    });

                    PaymentHistoryDataTable.clear();
                    PaymentHistoryDataTable.rows.add(
                        response.map((payment) => [
                            payment.transaction_id,
                            formatToString(parseFloat(payment.amount)),
                            payment.payment_method,
                            `<span class="badge bg-${
                                payment.payment_status === "Paid"
                                    ? "success"
                                    : payment.payment_status === "Pending"
                                    ? "warning"
                                    : "danger"
                            } ">${payment.payment_status}</span>`,
                            dateFormatter(payment.created_at),
                            `<button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#paymentModal"
                                        data-action="Update"><i class="ri-file-edit-fill"></i></button>
                        <button class="btn btn-danger btn-sm deleteRecord" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" data-delete-record-type="projectPayment"><i class="ri-delete-bin-2-fill"></i></button>`,
                        ])
                    );
                    PaymentHistoryDataTable.draw();

                    let totalAmount = 0;
                    response.forEach((payment) => {
                        payment.payment_status === "Paid"
                            ? (totalAmount += parseFloat(payment.amount))
                            : (totalAmount += 0);
                    });
                    return totalAmount;
                } catch (error) {
                    console.log(error);
                }
            }

            async function getUploadedReceipts(projectId) {
                try {
                    const response = await $.ajax({
                        type: "GET",
                        url: DASHBBOARD_TAB_ROUTE.GET_UPLOADED_RECEIPTS.replace(
                            ":project_id",
                            projectId
                        ),
                    });

                    UploadedReceiptDataTable.clear();
                    UploadedReceiptDataTable.rows.add(
                        response.map((receipt) => [
                            `receipt.receipt_name
                    <input type="hidden" class="receipt_id" value="${receipt.id}">
                    <input type="hidden" class="receipt_description" value="${receipt.receipt_description}">
                    `,
                            `<img src="data:image/png;base64,${receipt.receipt_image}" alt="${receipt.receipt_name}" style="max-width: 100px; max-height: 100px;">`,
                            dateFormatter(receipt.created_at),
                            `<span class="badge ${
                                receipt.remark === "Pending"
                                    ? "bg-info"
                                    : receipt.remark === "Approved"
                                    ? "bg-success"
                                    : receipt.remark === "Rejected"
                                    ? "bg-danger"
                                    : ""
                            }">${receipt.remark}</span>
                      <input type="hidden" class="comment" value="${
                          receipt.comment
                      }">`,
                            `<button class="btn btn-primary btn-sm viewReceipt" data-receipt-id="${receipt.ongoing_project_id}">View</button>`,
                        ])
                    );
                    UploadedReceiptDataTable.draw();
                } catch (error) {
                    console.error("Error fetching uploaded receipts:", error);
                    showToastFeedback(
                        "text-bg-danger",
                        "Failed to fetch uploaded receipts"
                    );
                }
            }

            $("#paymentModal").on("show.bs.modal", function (event) {
                const button = $(event.relatedTarget);
                const action = button.data("action");

                const modal = $(this);
                const modalTitle = modal.find(".modal-title");
                const submitButton = modal.find("#submitPayment");

                if (action === "Add") {
                    modalTitle.text("Add Payment");
                    submitButton.text("Add Payment");
                    submitButton.attr("data-submissionMethod", "add");
                } else if (action === "Update") {
                    modalTitle.text("Update Payment");
                    submitButton.text("Update Payment");
                    submitButton.attr("data-submissionMethod", "update");
                    retrieve_the_selected_record_TO_UPDATE(
                        button.closest("tr")
                    );
                }
            });

            async function retrieve_the_selected_record_TO_UPDATE(
                selected_row
            ) {
                const selected_transaction_id = selected_row
                    .find("td:eq(0)")
                    .text()
                    .trim();
                const selected_amount = selected_row
                    .find("td:eq(1)")
                    .text()
                    .trim();
                const selected_payment_method = selected_row
                    .find("td:eq(2)")
                    .text()
                    .trim();
                const selected_payment_status = selected_row
                    .find("td:eq(3)")
                    .text()
                    .trim();

                $("#TransactionID").val(selected_transaction_id);
                $("#paymentAmount").val(selected_amount);
                $("#paymentMethod").val(selected_payment_method);
                $("#paymentStatus").val(selected_payment_status);
            }

            const ProjectLedgerInput = $("#projectLedgerLink");
            const ProjectLedgerSubmitBtn = $("#saveProjectLedgerLink");

            ProjectLedgerSubmitBtn.on("click", function () {
                const project_id = $("#ProjectID").val();
                const ProjectLedgerLink = $("#projectLedgerLink").val();
                const action = $(this).attr("data-action");
                console.log(action);
                if (action === "edit") {
                    ProjectLedgerInput.prop("readonly", false);
                    $(this).attr("data-action", "save").text("Save");
                } else if (action === "save") {
                    updateOrCreateProjectLedger(project_id, ProjectLedgerLink);
                } else {
                    console.error("Action is not defined");
                }
            });

            const updateOrCreateProjectLedger = async (
                project_id,
                ProjectLedgerLink
            ) => {
                try {
                    const response = await $.ajax({
                        type: "PUT",
                        url: DASHBBOARD_TAB_ROUTE.UPDATE_OR_CREATE_PROJECT_LEDGER,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        data: {
                            project_id: project_id,
                            project_ledger_link: ProjectLedgerLink,
                        },
                    });
                    showToastFeedback("text-bg-success", response.message);
                    getProjectLedger(project_id);
                } catch (error) {
                    showToastFeedback(
                        "text-bg-danger",
                        error.responseJSON.message
                    );
                }
            };

            const getProjectLedger = async (project_id) => {
                try {
                    const response = await $.ajax({
                        type: "GET",
                        url: DASHBBOARD_TAB_ROUTE.GET_PROJECT_LEDGER.replace(
                            ":project_id",
                            project_id
                        ),
                    });
                    response
                        ? (ProjectLedgerSubmitBtn.text("Edit").attr(
                              "data-action",
                              "edit"
                          ),
                          ProjectLedgerInput.prop("readonly", true))
                        : ProjectLedgerSubmitBtn.text("Save").attr(
                              "data-action",
                              "save"
                          );
                    ProjectLedgerInput.val(response.project_ledger_link);
                } catch (error) {
                    console.error(error);
                }
            };

            $("#handledProjectTableBody").on(
                "click",
                ".handleProjectbtn",
                function () {
                    const handledProjectRow = $(this).closest("tr");
                    const hiddenInputs = handledProjectRow.find(
                        'input[type="hidden"]'
                    );
                    const offCanvaReadonlyInputs = $("#handleProjectOff").find(
                        "input, #FundedAmount"
                    );

                    // Cache values from the row
                    const project_status = handledProjectRow
                        .find("td:eq(5)")
                        .text()
                        .trim();
                    const project_id = handledProjectRow
                        .find("td:eq(0)")
                        .text()
                        .trim();
                    const projectTitle = handledProjectRow
                        .find("td:eq(1)")
                        .text()
                        .trim();
                    const firmName = handledProjectRow
                        .find("td:eq(2) p.firm_name")
                        .text()
                        .trim();
                    const cooperatorName = handledProjectRow
                        .find("td:eq(3) p.owner_name")
                        .text()
                        .trim();

                    // Cache hidden input values
                    const business_id = hiddenInputs
                        .filter(".business_id")
                        .val();
                    const birthDate = new Date(
                        hiddenInputs.filter(".birth_date").val()
                    );
                    const dateApplied = hiddenInputs
                        .filter(".dateApplied")
                        .val();
                    const sex = hiddenInputs.filter(".sex").val();
                    const landline = hiddenInputs.filter(".landline").val();
                    const mobilePhone = hiddenInputs
                        .filter(".mobile_phone")
                        .val();
                    const email = hiddenInputs.filter(".email").val();
                    const enterpriseType = hiddenInputs
                        .filter(".business_enterprise_type")
                        .val();
                    const enterpriseLevel = hiddenInputs
                        .filter(".business_enterprise_level")
                        .val();
                    const buildingAsset = parseFloat(
                        hiddenInputs.filter(".building_value").val()
                    );
                    const equipmentAsset = parseFloat(
                        hiddenInputs.filter(".equipment_value").val()
                    );
                    const workingCapitalAsset = parseFloat(
                        hiddenInputs.filter(".working_capital").val()
                    );
                    const approved_amount = hiddenInputs
                        .filter(".approved_amount")
                        .val();
                    const actual_amount = hiddenInputs
                        .filter(".actual_amount")
                        .val();

                    // Calculate age
                    const age = Math.floor(
                        (new Date() - birthDate) /
                            (365.25 * 24 * 60 * 60 * 1000)
                    );

                    // Update form fields
                    offCanvaReadonlyInputs
                        .filter("#hiddenbusiness_id")
                        .val(business_id);
                    offCanvaReadonlyInputs.filter("#age").val(age);
                    offCanvaReadonlyInputs.filter("#ProjectID").val(project_id);
                    offCanvaReadonlyInputs
                        .filter("#ProjectTitle")
                        .val(projectTitle);
                    offCanvaReadonlyInputs
                        .filter("#ApprovedAmount")
                        .val(formatToString(parseFloat(approved_amount)));
                    offCanvaReadonlyInputs
                        .filter("#appliedDate")
                        .val(dateApplied);
                    offCanvaReadonlyInputs.filter("#FirmName").val(firmName);
                    offCanvaReadonlyInputs
                        .filter("#CooperatorName")
                        .val(cooperatorName);
                    offCanvaReadonlyInputs.filter("#sex").val(sex);
                    offCanvaReadonlyInputs.filter("#landline").val(landline);
                    offCanvaReadonlyInputs
                        .filter("#mobilePhone")
                        .val(mobilePhone);
                    offCanvaReadonlyInputs.filter("#email").val(email);
                    offCanvaReadonlyInputs
                        .filter("#enterpriseType")
                        .val(enterpriseType);
                    offCanvaReadonlyInputs
                        .filter("#EnterpriseLevel")
                        .val(enterpriseLevel);
                    offCanvaReadonlyInputs
                        .filter("#buildingAsset")
                        .val(formatToString(buildingAsset));
                    offCanvaReadonlyInputs
                        .filter("#equipmentAsset")
                        .val(formatToString(equipmentAsset));
                    offCanvaReadonlyInputs
                        .filter("#workingCapitalAsset")
                        .val(formatToString(workingCapitalAsset));

                    offCanvaReadonlyInputs
                        .filter("#FundedAmount")
                        .text(formatToString(parseFloat(actual_amount)));

                    handleProjectOffcanvasContent(project_status);
                    getPaymentHistoryAndCalculation(project_id, actual_amount);
                    getUploadedReceipts(project_id);
                    getProjectLedger(project_id);
                    getProjectLinks(project_id);
                    getQuarterlyReports(project_id);
                    getAvailableQuarterlyReports(project_id);
                }
            );

            const getAmountRefund = () => {
                const actual_amount = $("#FundedAmount").text();

                return actual_amount;
            };

            const getPaymentHistoryAndCalculation = async (
                project_id,
                actual_amount
            ) => {
                try {
                    const totalAmount = await getPaymentHistory(project_id);

                    const fundedAmount = parseFloat(
                        actual_amount.replace(/,/g, "")
                    );
                    const remainingAmount = fundedAmount - totalAmount;
                    const percentage = Math.round(
                        (totalAmount / fundedAmount) * 100
                    );
                    $("#totalPaid").text(formatToString(totalAmount));
                    $("#remainingBalance").text(
                        formatToString(remainingAmount)
                    );

                    percentage == 100
                        ? isRefundCompleted(true)
                        : isRefundCompleted(false);
                    setTimeout(() => {
                        InitializeviewCooperatorProgress(percentage);
                    }, 500);
                } catch (error) {
                    console.log(error);
                }
            };

            const RequirementContainer =  $("#RequirementContainer");

            const uploadFileRequirements = document.getElementById('requirements_file');

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
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        onload: (response) => {
                            const data = JSON.parse(response);
                            if(data.unique_id && data.file_path){
                                uploadFileRequirements.setAttribute('data-unique_id', data.unique_id);
                                uploadFileRequirements.setAttribute('data-file_path', data.file_path);
                            }
                            return data.unique_id;
                        },
                        onerror: (error) => {
                            console.error(error);
                        }


                    },
                    revert: (load, error) => {
                        const unique_id = uploadFileRequirements.getAttribute('data-unique_id');
                        const file_path = uploadFileRequirements.getAttribute('data-file_path');
                        if (unique_id && file_path) {
                           try {

                               const response = fetch(`/FileRequirementsRevert/${unique_id}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    body: JSON.stringify({
                                        unique_id: unique_id,
                                        file_path: file_path
                                    })
                                });
                                if(response.ok){
                                    load();
                                }else{
                                    error();
                                }
                           } catch (error) {
                               error();
                            }

                           }
                    }

                }

            })


            //link validation
            RequirementContainer.on(
                "blur",
                'input[name="requirements_link"]',
                async function () {
                    const linkConstInstance =
                        $(this).closest(".linkContainer");
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
                                    .addClass("is-valid")
                                    .removeClass("is-invalid");
                            } else {
                                linkConstInstance
                                    .find('input[name="requirements_link"]')
                                    .addClass("is-invalid")
                                    .removeClass("is-valid");
                            }
                        } catch (error) {
                            console.error(
                                "Error fetching the link:",
                                error
                            );
                            linkConstInstance
                                .find('input[name="requirements_link"]')
                                .addClass("is-invalid")
                                .removeClass("is-valid");
                        } finally {
                            linkConstInstance
                                .find(".spinner-border")
                                .remove();
                        }
                    } else {
                        linkConstInstance
                            .find('input[name="requirements_link"]')
                            .removeClass(["is-valid", "is-invalid"]);
                    }
                }
            );

            const getProjectLinks = async (Project_id) => {
                try {
                    const response = await $.ajax({
                        type: "GET",
                        url:
                            DASHBBOARD_TAB_ROUTE.GET_PROJECT_LINKS +
                            "?project_id=" +
                            Project_id,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });
                    ProjectFileLinkDataTable.clear();
            ProjectFileLinkDataTable.rows.add(
                response.map((link) => {
                    // For internal files, create a route to view the file using its ID
                    const viewButton = link.is_external
                        ? `<a class="btn btn-outline-primary btn-sm" target="_blank" href="https://${link.file_link}"><i class="ri-eye-fill"></i></a>`
                        : `<a class="btn btn-outline-primary btn-sm" target="_blank" href="/view-project-file/${link.id}"><i class="ri-eye-fill"></i></a>`;

                    return [
                        `${link.file_name}
                       <input type="hidden" class="linkID" value="${link.id}">`,
                        link.file_link,
                        dateFormatter(link.created_at),
                        `${viewButton}
                        <button class="btn btn-primary btn-sm updateLinkRecord" data-bs-toggle="modal" data-bs-target="#projectLinkModal"><i class="ri-pencil-fill"></i></button>
                        <button class="btn btn-danger btn-sm deleteRecord" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" data-delete-record-type="projectLink"> <i class="ri-delete-bin-6-fill"></i></button>`,
                    ];
                })
            )
                    ProjectFileLinkDataTable.draw();
                } catch (error) {
                    showToastFeedback(
                        "text-bg-danger",
                        error?.responseJSON.message
                    );
                }
            };

            const SaveProjectFileLinks = async (projectID, action) => {
                try {
                    let requirementLinks = {};
                     const linkContainer = RequirementContainer.find(".linkContainer")
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
                        type: "POST",
                        url: DASHBBOARD_TAB_ROUTE.STORE_PROJECT_FILES,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        data: {
                            action: action,
                            project_id: projectID,
                            linklist: requirementLinks,
                        },
                    });

                    getProjectLinks(projectID);
                    closeModal('#requirementModal')
                    showToastFeedback("text-bg-success", response.message);

                } catch (error) {
                    showToastFeedback(
                        "text-bg-danger",
                        error.responseJSON.message
                    );
                }

            }
            const SaveProjectFile = async (projectID, action) => {
                try {
                    const name = $("#requirements_file_name").val();
                    const file_path = uploadFileRequirements.getAttribute('data-file_path');
                    const response = await $.ajax({
                        type: "POST",
                        url: DASHBBOARD_TAB_ROUTE.STORE_PROJECT_FILES,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        data: {
                            action: action,
                            project_id: projectID,
                            name: name,
                            file_path: file_path,
                        },
                    });
                    getProjectLinks(projectID);
                    closeModal('#requirementModal')
                    showToastFeedback("text-bg-success", response.message);
                    toggleRequirementUploadType();

                } catch (error) {
                    showToastFeedback(
                        "text-bg-danger",
                        error.responseJSON.message
                    );
                }
            }

            //Save the inputted links to the database
            $("button[data-selected-action]").off("click").on("click", async function () {
               let action = $(this).attr("data-selected-action");
               const projectID = $("#ProjectID").val();

               action === 'ProjectLink'
               ? SaveProjectFileLinks(projectID, action)
               : action === 'ProjectFile'
               ? SaveProjectFile(projectID, action)
               : null
            });

            $("#UpdateProjectLink").on("click", async () => {
                try {
                    const projectID = $("#ProjectID").val();
                    const updatedProjectLinks =
                        $("#projectLinkForm").serialize();
                    const file_id = $("input#HiddenFileIDToUpdate").val();

                    const response = await $.ajax({
                        type: "PUT",
                        url: DASHBBOARD_TAB_ROUTE.UPDATE_PROJECT_LINKS.replace(
                            ":file_id",
                            file_id
                        ),
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        data: updatedProjectLinks + "&project_id=" + projectID,
                    });

                    getProjectLinks(projectID);
                    closeModal("#projectLinkModal");
                    showToastFeedback("text-bg-success", response.message);
                    toggleRequirementUploadType();
                } catch (error) {
                    showToastFeedback("text-bg-danger", error);
                }
            });

            $("#projectLinkModal").on("show.bs.modal", function (event) {
                const triggeredbutton = $(event.relatedTarget);
                const selectedRow = triggeredbutton.closest("tr");

                const file_id = selectedRow.find("input.linkID").val();
                const projectName = selectedRow.find("td:eq(0)").text();
                const projectLink = selectedRow.find("td:eq(1)").text();

                const modal = $(this);
                modal.find("input#HiddenFileIDToUpdate").val(file_id);
                modal.find("input#HiddenProjectNameToUpdate").val(projectName);
                modal.find("input#projectNameUpdated").val(projectName);
                modal.find("textarea#projectLink").val(projectLink);
            });

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
                uploadTypeRadios.on('change', function() {
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
                $('#requirements_file').off('change').on('change', function(e) {
                    const fileName = e.target.files[0] ? e.target.files[0].name : '';
                    $('#requirements_file_name').val(fileName);
                });
            }

            toggleRequirementUploadType();


            /**
             * Event listener for showing the delete confirmation modal.
             *
             * This listener triggers when the '#deleteRecordModal' modal is shown. It dynamically updates
             * the modal's content based on the type of record that is being deleted (e.g., project payment,
             * project link, or quarterly report). Once confirmed, it sends an AJAX DELETE request to the
             * appropriate endpoint to delete the specified record.
             *
             * @event show.bs.modal
             * @param {Event} event - The event object triggered when the modal is shown.
             * @listens show.bs.modal
             *
             * @property {jQuery} triggeredDeleteButton - The button element that triggered the modal, containing data attributes used for determining the record type and details.
             * @property {string} action - The type of record to delete (e.g., 'projectPayment', 'projectLink', or 'quarterlyRecord').
             * @property {jQuery} recordRow - The table row (`<tr>`) element closest to the triggered button, used to extract record details from the table.
             *
             * @property {string} paymentTransactionID - The transaction ID of the payment record to delete (if `action === 'projectPayment'`).
             * @property {string} paymentAmount - The amount of the payment to delete (if `action === 'projectPayment'`).
             *
             * @property {string} projectName - The name of the project link record to delete (if `action === 'projectLink'`).
             * @property {string} projectLink - The URL of the project link to delete (if `action === 'projectLink'`).
             *
             * @property {string} quarterlyRecord_id - The ID of the quarterly report record to delete (if `action === 'quarterlyRecord'`).
             * @property {string} quarterPeriod - The quarter period of the quarterly report record to delete (if `action === 'quarterlyRecord'`).
             *
             * @fires $.ajax DELETE - Sends a DELETE request to the server to delete the specified record.
             *
             * @function handleDeleteClick - Handles the click event on the delete button within the modal.
             *   This sends the appropriate DELETE request and updates the UI accordingly.
             *
             * @returns {void}
             */
            //TODO: Refrash the Record once the request is successful
            $("#deleteRecordModal").on("show.bs.modal", function (event) {
                const triggeredDeleteButton = $(event.relatedTarget);
                const action = triggeredDeleteButton.data("delete-record-type");
                const recordRow = triggeredDeleteButton.closest("tr");

                console.log(triggeredDeleteButton.data("record-to-delete"));
                console.log(action);

                const modal = $(this);

                if (action === "projectPayment") {
                    const paymentTransactionID = recordRow
                        .find("td:eq(0)")
                        .text();
                    const paymentAmount = recordRow.find("td:eq(1)").text();

                    modal
                        .find(".modal-body")
                        .html(
                            `Are you sure you want to delete this transaction <strong>${paymentTransactionID}</strong> with amount of <strong>${paymentAmount}</strong>?`
                        );
                    modal
                        .find("#deleteRecord")
                        .attr("data-record-to-delete", "paymentRecord")
                        .attr("data-unique-val", paymentTransactionID);
                } else if (action === "projectLink") {
                    const fileId = recordRow.find("input.linkID").val();
                    const projectName = recordRow.find("td:eq(0)").text();
                    const projectLink = recordRow.find("td:eq(1)").text();

                    modal
                        .find(".modal-body")
                        .html(
                            `Are you sure you want to delete this link <a href="${projectLink}" target="_blank">${projectLink}</a> with a file named ${projectName}?`
                        );
                    modal
                        .find("#deleteRecord")
                        .attr("data-record-to-delete", "projectLinkRecord")
                        .attr("data-unique-val", fileId);
                } else if (action === "quarterlyRecord") {
                    const quarterlyRecord_id =
                        triggeredDeleteButton.data("record-id");
                    const quarterPeriod = recordRow.find("td:eq(0)").text();
                    console.log(quarterPeriod, quarterlyRecord_id);
                    modal
                        .find(".modal-body")
                        .html(
                            `Are you sure you want to delete this quarterly record <strong>${quarterPeriod}</strong>?`
                        );
                    modal
                        .find("#deleteRecord")
                        .attr("data-record-to-delete", "quarterlyRecord")
                        .attr("data-unique-val", quarterlyRecord_id);
                }
                modal
                    .find("#deleteRecord")
                    .off("click")
                    .on("click", async function () {
                        const recordToDelete = $(this).attr(
                            "data-record-to-delete"
                        );
                        const uniqueVal = $(this).attr("data-unique-val");
                        console.log(recordToDelete, uniqueVal);
                        const deleteRoute =
                            recordToDelete === "paymentRecord"
                                ? DASHBBOARD_TAB_ROUTE.DELETE_PAYMENT_RECORDS.replace(
                                      ":transaction_id",
                                      uniqueVal
                                  )
                                : recordToDelete === "projectLinkRecord"
                                ? DASHBBOARD_TAB_ROUTE.DELETE_PROJECT_LINK.replace(
                                      ":file_id",
                                      uniqueVal
                                  )
                                : recordToDelete === "quarterlyRecord"
                                ? DASHBBOARD_TAB_ROUTE.DELETE_QUARTERLY_REPORT.replace(
                                      ":record_id",
                                      uniqueVal
                                  )
                                : "";
                        try {
                            const project_id = $("#ProjectID").val();
                            const response = await $.ajax({
                                type: "DELETE",
                                url: deleteRoute,
                                headers: {
                                    "X-CSRF-TOKEN": $(
                                        'meta[name="csrf-token"]'
                                    ).attr("content"),
                                },
                            });
                            showToastFeedback(
                                "text-bg-success",
                                response.message
                            );
                            closeModal("#deleteRecordModal");
                            modal.hide();
                            recordToDelete === "projectLinkRecord"
                                ? getProjectLinks(project_id)
                                : recordToDelete === "paymentRecord"
                                ? getPaymentHistoryAndCalculation(
                                      project_id,
                                      getAmountRefund()
                                  )
                                : recordToDelete === "quarterlyRecord"
                                ? getQuarterlyReports(project_id)
                                : null;
                        } catch (error) {
                            console.log(error);
                            showToastFeedback(
                                "text-bg-danger",
                                error.responseJSON.message
                            );
                        }
                    });
            });

            const projectStateBtn = $(".updateProjectState");

            //Cooperator Payment Progress
            projectStateBtn.on("click", async function () {
                const action = $(this).data("project-state");
                const projectID = $("#ProjectID").val();
                const businessID = $("#hiddenbusiness_id").val();
                try {
                    const response = $.ajax({
                        type: "PUT",
                        url: DASHBBOARD_TAB_ROUTE.UPDATE_PROJECT_STATE,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        data: {
                            action: action,
                            project_id: projectID,
                            business_id: businessID,
                        },
                    });
                    const data = await response;
                    showToastFeedback("text-bg-success", data.message);
                } catch (error) {
                    showToastFeedback(
                        "text-bg-danger",
                        error.responseJSON.message
                    );
                }
            });

            let paymentProgress;

            function InitializeviewCooperatorProgress(percentage) {
                const options = {
                    series: [percentage],
                    chart: {
                        type: "radialBar",
                        width: "100%",
                        height: "200px",
                        sparkline: {
                            enabled: true,
                        },
                    },
                    colors: ["#00D8B6"],
                    plotOptions: {
                        radialBar: {
                            startAngle: -90,
                            endAngle: 90,
                            track: {
                                background: "#e7e7e7",
                                strokeWidth: "97%",
                                margin: 5, // margin is in pixels
                                dropShadow: {
                                    enabled: true,
                                    top: 2,
                                    left: 0,
                                    color: "#999",
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
                                    fontSize: "22px",
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
                        type: "gradient",
                        gradient: {
                            shade: "light",
                            shadeIntensity: 0.4,
                            inverseColors: false,
                            opacityFrom: 1,
                            opacityTo: 1,
                            stops: [0, 50, 53, 91],
                        },
                    },
                    labels: ["Average Results"],
                };

                if (paymentProgress) {
                    paymentProgress.destroy();
                }

                paymentProgress = new ApexCharts(
                    document.querySelector("#progressPercentage"),
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
                    const response = await $.ajax({
                        type: "GET",
                        url: GENERATE_SHEETS_ROUTE.GET_AVAILABLE_QUARTERLY_REPORT.replace(
                            ":project_id",
                            Project_id
                        ),
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });
                    $("#Select_quarter_to_Generate").append(response.html);
                } catch (error) {
                    console.log(error);
                }
            };

            //TODO: Implement spinner for the ajax request

            const GET_PROJECT_SHEET_FORM = async (
                formType,
                Project_id,
                { QuartertoUsed } = {}
            ) => {
                try {
                    const response = await $.ajax({
                        type: "GET",
                        url: GENERATE_SHEETS_ROUTE.GET_PROJECT_SHEET_FORM.replace(
                            ":type",
                            formType
                        )
                            .replace(":project_id", Project_id)
                            .replace(
                                ":quarter_of",
                                QuartertoUsed ? QuartertoUsed : ""
                            ),
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });

                    toggleDocumentSelector();
                    $("#SheetFormDocumentContainer").append(response);
                } catch (error) {
                    console.log(error);
                }
            };

            $("button[data-form-type]").on("click", async function () {
                const formType = $(this).data("form-type");
                const Project_id = $("#ProjectID").val();
                const QuartertoUsed = $("#Select_quarter_to_Generate").val();
                await GET_PROJECT_SHEET_FORM(formType, Project_id, {
                    QuartertoUsed: QuartertoUsed,
                });

                const Form_EventListener = {
                    PIS: () => {
                        PISFormEvents();
                    },
                    PDS: () => {
                        PDSFormEvents();
                    },
                    SR: () => {
                        SRFormEvents();
                    },
                }[formType];
                Form_EventListener();
            });

            function inputsToCurrencyFormatter(thisInput) {
                const value = thisInput.val().replace(/[^0-9.]/g, "");

                if ((value.match(/\./g) || []).length > 1) {
                    value =
                        value.substring(0, value.indexOf(".") + 1) +
                        value
                            .substring(value.indexOf(".") + 1)
                            .replace(/\./g, "");
                }
                let [integerPart, decimalPart] = value.split(".");

                integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                if (decimalPart !== undefined)
                    decimalPart = decimalPart.slice(0, 2);

                thisInput.val(
                    decimalPart !== undefined
                        ? `${integerPart}.${decimalPart}`
                        : integerPart
                );
            }

            const parseValue = (value) => {
                return parseFloat(value?.replace(/,/g, "")) || 0;
            };

            function PISFormEvents() {
                function caculateTotalAssests() {
                    const landAssets = parseValue($("#land_val").val());
                    const buildingAssets = parseValue($("#building_val").val());
                    const equipmentAssets = parseValue(
                        $("#equipment_val").val()
                    );
                    const workingCapital = parseValue(
                        $("#workingCapital_val").val()
                    );
                    const totalAssests =
                        landAssets +
                        buildingAssets +
                        equipmentAssets +
                        workingCapital;
                    $("#totalAssests").val(
                        totalAssests.toLocaleString("en-US", {
                            minimumFractionDigits: 2,
                        })
                    );
                }

                $(
                    "#land_val, #building_val, #equipment_val, #workingCapital_val"
                ).on("input", function () {
                    const thisInput = $(this);
                    inputsToCurrencyFormatter(thisInput);
                    caculateTotalAssests();
                });

                const calculateTotalEmploymentGenerated = () => {
                    let manMonthTotal = 0;

                    $("#totalEmploymentContainer tr").each(function () {
                        const thisTableRow = $(this);

                        const male = parseValue(
                            thisTableRow.find(".maleInput").val()
                        );
                        const female = parseValue(
                            thisTableRow.find(".femaleInput").val()
                        );
                        const subtotal = male + female;
                        thisTableRow.find(".thisRowSubtotal").val(
                            subtotal.toLocaleString("en-US", {
                                minimumFractionDigits: 2,
                            })
                        );

                        manMonthTotal += subtotal;
                    });
                    $("#TotalmanMonths").val(
                        manMonthTotal.toLocaleString("en-US", {
                            minimumFractionDigits: 2,
                        })
                    );
                };

                $("#totalEmploymentContainer").on(
                    "input",
                    "td input.maleInput, td input.femaleInput",
                    function () {
                        console.log("Input Changed");
                        const thisInput = $(this);
                        inputsToCurrencyFormatter(thisInput);
                        calculateTotalEmploymentGenerated();
                    }
                );

                const calculateTotalGrossSales = () => {
                    console.log("Input Changed");

                    const localProduct = parseValue(
                        $("#localProduct_Val").val()
                    );
                    const exportProduct = parseValue(
                        $("#exportProduct_Val").val()
                    );
                    const totalGrossSales = localProduct + exportProduct;
                    $("#totalGrossSales").val(
                        totalGrossSales.toLocaleString("en-US", {
                            minimumFractionDigits: 2,
                        })
                    );

                    console.log(totalGrossSales);
                };

                $("#localProduct_Val, #exportProduct_Val").on(
                    "input",
                    function () {
                        const thisInput = $(this);
                        inputsToCurrencyFormatter(thisInput);
                        calculateTotalGrossSales();
                    }
                );
            }

            /**
             * Initializes and sets up event listeners for the PDS form, handling calculations and updates for employment and sales data.
             *
             * @return {void}
             */
            function PDSFormEvents() {
                //TODO: Update the Js docs of this PDS events
                const calculateTotalEmployment = () => {
                    let totalNumPersonel = 0;
                    let totalManMonth = 0;
                    $("#totalEmployment tr").each(function () {
                        const totalMalePersonel = parseValue(
                            $(this).find(".maleInput").val()
                        );
                        const totalFemalePersonel = parseValue(
                            $(this).find(".femaleInput").val()
                        );
                        const workDays = parseValue(
                            $(this).find(".workdayInput").val()
                        );
                        const thisRowManMonth =
                            (totalMalePersonel + totalFemalePersonel) *
                            (workDays / 20);
                        $(this)
                            .find(".totalManMonth")
                            .val(
                                thisRowManMonth.toLocaleString("en-US", {
                                    minimumFractionDigits: 2,
                                })
                            );

                        totalNumPersonel +=
                            totalMalePersonel + totalFemalePersonel;

                        totalManMonth += parseValue(
                            $(this).find(".totalManMonth").val()
                        );
                    });
                    $("#TotalManMonth").val(
                        totalManMonth.toLocaleString("en-US", {
                            minimumFractionDigits: 2,
                        })
                    );
                    $("#TotalEmployment").val(
                        totalNumPersonel.toLocaleString("en-US", {
                            minimumFractionDigits: 2,
                        })
                    );
                };

                /**
                 * Event listener for input changes on employee data table cells.
                 *
                 * Listens for changes on 'maleInput', 'femaleInput', and 'workdayInput' cells within the '#totalEmployment' table.
                 * When a change occurs, updates the corresponding 'totalManMonth' cell and recalculates the overall total employment values.
                 *
                 * @event input
                 * @listener
                 * @param {object} event - The input event object.
                 * @param {HTMLElement} event.target - The input element that triggered the event.
                 *
                 * @fires calculateTotalEmployment
                 */
                $("#totalEmployment").on(
                    "input",
                    "td input.maleInput, td input.femaleInput, td input.workdayInput",
                    function () {
                        const thisEmployeeRow = $(this);
                        inputsToCurrencyFormatter(thisEmployeeRow);

                        const employeeRow = thisEmployeeRow.closest("tr");
                        const maleVal = parseValue(
                            employeeRow.find(".maleInput").val()
                        );
                        const femaleVal = parseValue(
                            employeeRow.find(".femaleInput").val()
                        );
                        const workDays = parseValue(
                            employeeRow.find(".workdayInput").val()
                        );

                        const totalManMonth =
                            (workDays / 20) * (maleVal + femaleVal);
                        employeeRow.find(".totalManMonth").val(totalManMonth);

                        calculateTotalEmployment();
                    }
                );

                /**
                 * Calculates the total gross sales, production cost, and net sales
                 * from the local and export products tables.
                 *
                 * @return {void}
                 */
                const calculateTotals = () => {
                    let totalGrossSales = 0;
                    let totalProductionCost = 0;
                    let totalNetSales = 0;

                    $("#localProducts tr, #exportProducts tr").each(
                        function () {
                            const tableRow = $(this);
                            let grossSales = parseValue(
                                tableRow.find(".grossSales_val").val()
                            );
                            let productionCost = parseValue(
                                tableRow.find(".productionCost_val").val()
                            );

                            let netSales = grossSales - productionCost;

                            let FormattedNetSales = netSales.toLocaleString(
                                "en-US",
                                {
                                    minimumFractionDigits: 2,
                                }
                            );

                            tableRow
                                .find(".netSales_val")
                                .val(FormattedNetSales);

                            totalGrossSales += grossSales;
                            totalProductionCost += productionCost;
                            totalNetSales += netSales;
                        }
                    );

                    $("#totalGrossSales").val(
                        `₱ ${totalGrossSales.toLocaleString("en-US", {
                            minimumFractionDigits: 2,
                        })}`
                    );
                    $("#totalProductionCost").val(
                        `₱ ${totalProductionCost.toLocaleString("en-US", {
                            minimumFractionDigits: 2,
                        })}`
                    );
                    $("#totalNetSales").val(
                        `₱ ${totalNetSales.toLocaleString("en-US", {
                            minimumFractionDigits: 2,
                        })}`
                    );

                    $(".CurrentgrossSales_val").val(
                        totalGrossSales.toLocaleString("en-US", {
                            minimumFractionDigits: 2,
                        })
                    );
                };

                /**
                 * Event listener for input changes on gross sales and production cost fields.
                 *
                 * Calculates the net sales by subtracting the estimated production cost from the gross sales,
                 * updates the corresponding net sales field, and recalculates totals.
                 *
                 * @event input
                 * @listener
                 * @param {object} event - The input event object.
                 * @param {HTMLElement} event.target - The input element that triggered the event.
                 *
                 * @fires calculateTotals
                 */
                $("#localProducts, #exportProducts").on(
                    "input",
                    "td input.grossSales_val, td input.productionCost_val",
                    function () {
                        const thisInput = $(this);
                        inputsToCurrencyFormatter(thisInput);

                        const $productRow = thisInput.closest("tr");
                        const grossSales = parseValue(
                            $productRow.find(".grossSales_val").val()
                        );
                        const estimatedProductionCost = parseValue(
                            $productRow.find(".productionCost_val").val()
                        );
                        const netSales = grossSales - estimatedProductionCost;

                        $productRow.find(".netSales_val").val(
                            netSales.toLocaleString("en-US", {
                                minimumFractionDigits: 2,
                            })
                        );

                        calculateTotals();
                    }
                );

                /**
                 * Calculates the productivity increase percentage based on current and previous gross sales.
                 *
                 * @param {number} CurrentgrossSales - The current gross sales value.
                 * @param {number} PreviousgrossSales - The previous gross sales value.
                 * @return {void}
                 */
                const calculateToBeAccomplishedProductivity = () => {
                    const increaseInProductivityRow = $(
                        "#ToBeAccomplished .increaseInProductivity"
                    );

                    const CurrentAndPreviousgrossSales = $(
                        "#ToBeAccomplished td .CurrentgrossSales_val, td .PreviousgrossSales_val, td .TotalgrossSales_val"
                    ).closest("tr");

                    const CurrentgrossSales = parseValue(
                        CurrentAndPreviousgrossSales.find(
                            ".CurrentgrossSales_val"
                        ).val()
                    );
                    const PreviousgrossSales = parseValue(
                        CurrentAndPreviousgrossSales.find(
                            ".PreviousgrossSales_val"
                        ).val()
                    );

                    increaseInProductivityRow
                        .find(".CurrentgrossSales_val_cal")
                        .text(
                            CurrentgrossSales.toLocaleString("en-US", {
                                minimumFractionDigits: 2,
                            })
                        );
                    increaseInProductivityRow
                        .find(".PreviousgrossSales_val_cal")
                        .text(
                            PreviousgrossSales.toLocaleString("en-US", {
                                minimumFractionDigits: 2,
                            })
                        );

                    const TotalgrossSales =
                        CurrentgrossSales - PreviousgrossSales;
                    CurrentAndPreviousgrossSales.find(
                        ".TotalgrossSales_val"
                    ).val(
                        TotalgrossSales.toLocaleString("en-US", {
                            minimumFractionDigits: 2,
                        })
                    );

                    const increaseInProductivityByPercent =
                        ((CurrentgrossSales - PreviousgrossSales) /
                            PreviousgrossSales) *
                        100;
                    increaseInProductivityRow
                        .find(".totalgrossSales_percent")
                        .val(`${increaseInProductivityByPercent.toFixed(2)}%`);
                };

                /**
                 * Event listener for input changes on table cells containing current and previous gross sales values.
                 *
                 * @event input
                 * @memberof #ToBeAccomplished
                 * @param {object} event - The input event object.
                 * @param {HTMLElement} event.target - The table cell that triggered the event.
                 *
                 * @description Formats the input value, calculates the difference between current and previous gross sales,
                 * updates the total gross sales value, and recalculates productivity metrics.
                 *
                 * @fires calculateToBeAccomplishedProductivity
                 */
                $("#ToBeAccomplished").on(
                    "input",
                    "td .CurrentgrossSales_val, td .PreviousgrossSales_val",
                    function () {
                        const thisInput = $(this);
                        inputsToCurrencyFormatter(thisInput);
                        calculateToBeAccomplishedProductivity();
                    }
                );

                /**
                 * Calculates the percentage increase in employment.
                 *
                 * @param {number} CurrentEmployment - The current employment value.
                 * @param {number} PreviousEmployment - The previous employment value.
                 * @return {void}
                 */
                const calculateToBeAccomplishedEmployment = () => {
                    const increaseInEmploymentRow = $(
                        "#ToBeAccomplished .increaseInEmployment"
                    );

                    const CurrentAndPreviousEmployment = $(
                        "#ToBeAccomplished td .CurrentEmployment_val, td .PreviousEmployment_val, td .TotalEmployment_val"
                    ).closest("tr");

                    const CurrentEmployment = parseInt(
                        CurrentAndPreviousEmployment.find(
                            ".CurrentEmployment_val"
                        ).val()
                    );

                    const PreviousEmployment = parseInt(
                        CurrentAndPreviousEmployment.find(
                            ".PreviousEmployment_val"
                        ).val()
                    );

                    increaseInEmploymentRow
                        .find(".CurrentEmployment_val_cal")
                        .text(CurrentEmployment);
                    increaseInEmploymentRow
                        .find(".PreviousEmployment_val_cal")
                        .text(PreviousEmployment);

                    const TotalEmployment =
                        CurrentEmployment - PreviousEmployment;
                    CurrentAndPreviousEmployment.find(
                        ".TotalEmployment_val"
                    ).val(TotalEmployment);

                    const increaseInEmploymentByPercent =
                        ((CurrentEmployment - PreviousEmployment) /
                            PreviousEmployment) *
                        100;
                    increaseInEmploymentRow
                        .find(".totalEmployment_percent")
                        .val(`${increaseInEmploymentByPercent.toFixed(2)}%`);
                };

                $("#ToBeAccomplished").on(
                    "input",
                    "td .CurrentEmployment_val , td .PreviousEmployment_val",
                    function () {
                        const thisInput = $(this);
                        inputsToCurrencyFormatter(thisInput);

                        calculateToBeAccomplishedEmployment();
                    }
                );

                calculateTotalEmployment();
                calculateTotals();
                calculateToBeAccomplishedProductivity();
                calculateToBeAccomplishedEmployment();
            }

            function SRFormEvents() {
                const toggleDeleteRowButton = (container, elementSelector) => {
                    const element = container.find(elementSelector);
                    const deleteRowButton = container
                        .children(".addAndRemoveButton_Container")
                        .find(".removeRowButton");
                    element.length === 1
                        ? deleteRowButton.prop("disabled", true)
                        : deleteRowButton.prop("disabled", false);
                };
                // Add event listener to the add row button
                $(".addNewRowButton").on("click", function () {
                    const container = $(this).closest(".card-body");

                    const table = container.find("table");
                    if (table.length) {
                        const lastRow = table.find("tbody tr:last-child");
                        const newRow = lastRow.clone();
                        newRow.find("input, textarea").val("");
                        table.find("tbody").append(newRow);
                        toggleDeleteRowButton(container, "tbody tr");
                    } else {
                        const divContainer = container.find(".input_list");
                        const newDiv = divContainer.last().clone();
                        newDiv.find("input, textarea").val("");
                        container.append(newDiv);
                        toggleDeleteRowButton(container, ".input_list");
                    }
                });

                // Add event listener to the delete row button
                $(".removeRowButton").on("click", function () {
                    const container = $(this).closest(".card-body");

                    const table = container.find("table");
                    if (table.length) {
                        const lastRow = table.find("tbody tr:last-child");
                        lastRow.remove();
                        toggleDeleteRowButton(container, "tbody tr");
                    } else {
                        const divContainer = container.find(".input_list");
                        divContainer.last().remove();
                        toggleDeleteRowButton(container, ".input_list");
                    }
                });

                $("#StatusReportForm .card-body").each(function () {
                    const container = $(this);

                    const table = container.find("table");
                    if (table.length) {
                        toggleDeleteRowButton(container, "tbody tr");
                    } else {
                        toggleDeleteRowButton(container, ".input_list");
                    }
                });

                $(".number_input_only").on("input", function () {
                    this.value = this.value.replace(/[^0-9.]/g, "");
                });

                const CurrencyInputs = $(
                    "#StatusReportForm table td input.approved_cost, #StatusReportForm table td input.actual_cost, #StatusReportForm table td input.non_equipment_approved_cost, #StatusReportForm table td input.non_equipment_actual_cost, #StatusReportForm input.total_approved_project_cost, #StatusReportForm input.amount_utilized, #StatusReportForm input.total_amount_to_be_refunded, #StatusReportForm input.total_amount_already_due, #StatusReportForm input.total_amount_refunded, #StatusReportForm input.unsetted_refund, #StatusReportForm table td input.sales_gross_sales"
                );

                CurrencyInputs.on("input", function () {
                    inputsToCurrencyFormatter($(this));
                });
            }

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
            $("#SheetFormDocumentContainer").on(
                "click",
                ".breadcrumb-item:not(.active) a",
                function () {
                    $(
                        "#PISFormContainer , #PDSFormContainer, #SRFormContainer"
                    ).remove();
                    toggleDocumentSelector();
                }
            );

            const toggleDocumentSelector = () =>
                $("#selectDOC_toGenerate").toggleClass("d-none");

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
            $("#SheetFormDocumentContainer")
                .off("click", ".ExportPDF")
                .on("click", ".ExportPDF", async function (e) {
                    e.preventDefault();

                    try {
                        const ExportPDF_BUTTON_DATA_VALUE =
                            $(this).data("to-export");
                        const route_url = await {
                            PIS: GENERATE_SHEETS_ROUTE.GENERATE_PROJECT_INFORMATION_SHEET,
                            PDS: GENERATE_SHEETS_ROUTE.GENERATE_DATA_SHEET_REPORT,
                            SR: GENERATE_SHEETS_ROUTE.GENERATE_STATUS_REPORT,
                        }[ExportPDF_BUTTON_DATA_VALUE];
                        const data = await requestDATA(
                            ExportPDF_BUTTON_DATA_VALUE
                        );
                        const response = await $.ajax({
                            type: "POST",
                            url: route_url,
                            data: data,
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                            xhrFields: {
                                responseType: "blob",
                            },
                        });

                        const blob = new Blob([response], {
                            type: "application/pdf",
                        });
                        const url = window.URL.createObjectURL(blob);
                        window.open(url, "_blank"); // Open the PDF in a new browser tab

                        console.log(
                            "PDF successfully generated and opened in a new tab."
                        );
                    } catch (error) {
                        console.log(error);
                    }
                });

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
                            $("#projectInfoForm").serialize() +
                            "&" +
                            $("#PIS_checklistsForm").serialize()
                        );
                    },

                    PDS: function () {
                        const thisFormData =
                            $("#projectDataForm").serializeArray();
                        let thisFormObject = {};
                        $.each(thisFormData, function (i, v) {
                            if (v.name.includes("[]")) {
                                thisFormObject[v.name] = thisFormObject[v.name]
                                    ? [...thisFormObject[v.name], v.value]
                                    : [v.value];
                            } else {
                                thisFormObject[v.name] = v.value;
                            }
                        });

                        const localProductsRow = $("#localProducts tr");
                        const exportProductsRow = $("#exportProducts tr");
                        const localProductData = [];
                        const exportProductData = [];

                        localProductsRow.each(function () {
                            const tableRow = $(this);
                            const localProductDetails = {
                                productName: tableRow
                                    .find(".productName")
                                    .val(),
                                packingDetails: tableRow
                                    .find(".packingDetails")
                                    .val(),
                                volumeOfProduction: tableRow
                                    .find(".volumeOfProduction_val")
                                    .val(),
                                grossSales: tableRow
                                    .find(".grossSales_val")
                                    .val(),
                                productionCost: tableRow
                                    .find(".productionCost_val")
                                    .val(),
                                netSales: tableRow.find(".netSales_val").val(),
                            };
                            localProductData.push(localProductDetails);
                        });

                        thisFormObject.localProduct = localProductData;

                        exportProductsRow.each(function () {
                            const tableRow = $(this);
                            const exportProductDetails = {
                                productName: tableRow
                                    .find(".productName")
                                    .val(),
                                packingDetails: tableRow
                                    .find(".packingDetails")
                                    .val(),
                                volumeOfProduction: tableRow
                                    .find(".volumeOfProduction_val")
                                    .val(),
                                grossSales: tableRow
                                    .find(".grossSales_val")
                                    .val(),
                                productionCost: tableRow
                                    .find(".productionCost_val")
                                    .val(),
                                netSales: tableRow.find(".netSales_val").val(),
                            };
                            exportProductData.push(exportProductDetails);
                        });

                        thisFormObject.exportProduct = exportProductData;

                        return thisFormObject;
                    },

                    SR: function () {
                        const FormContainer = $("#StatusReportForm");
                        const thisFormData = FormContainer.serializeArray();
                        console.log(thisFormData);
                        let thisFormObject = {};
                        $.each(thisFormData, function (i, v) {
                            if (v.name.includes("[]")) {
                                thisFormObject[v.name] = thisFormObject[v.name]
                                    ? [...thisFormObject[v.name], v.value]
                                    : [v.value];
                            } else {
                                thisFormObject[v.name] = v.value;
                            }
                        });
                        const expectedAndActualTableRow = FormContainer.find(
                            ".expectedAndActual_tableRow tr"
                        );
                        const equipmentTableRow = FormContainer.find(
                            ".equipment_tableRow tr"
                        );
                        const nonEquipmentTableRow = FormContainer.find(
                            ".non_equipment_tableRow tr"
                        );
                        const salesTableRow =
                            FormContainer.find(".sales_tableRow tr");
                        const employmentGeneratedTableRow = FormContainer.find(
                            ".employment_generated_tableRow tr"
                        );
                        const indirectEmploymentTableRow = FormContainer.find(
                            ".indirect_employment_tableRow tr"
                        );

                        const TableData = () => {
                            const expectedAndActualData = [];
                            const equipmentData = [];
                            const nonEquipmentData = [];
                            const salesData = [];
                            const employmentGeneratedData = [];
                            const indirectEmploymentData = [];

                            expectedAndActualTableRow.each(function () {
                                const tableRowInputs = $(this);
                                const expectedAndActualDetails = {
                                    Expected_Output: tableRowInputs
                                        .find(".expectedOutput")
                                        .val(),
                                    Actual_Accomplishment: tableRowInputs
                                        .find(".actualAccomplishment")
                                        .val(),
                                    Remarks_Justification: tableRowInputs
                                        .find(".remarksJustification")
                                        .val(),
                                };
                                expectedAndActualData.push(
                                    expectedAndActualDetails
                                );
                            });

                            equipmentTableRow.each(function () {
                                const tableRowInputs = $(this);
                                const equipmentDetails = {
                                    Approved_qty: tableRowInputs
                                        .find(".approved_qty")
                                        .val(),
                                    Approved_Particulars: tableRowInputs
                                        .find(".approved_particulars")
                                        .val(),
                                    Approved_cost: tableRowInputs
                                        .find(".approved_cost")
                                        .val(),
                                    Actual_qty: tableRowInputs
                                        .find(".actual_qty")
                                        .val(),
                                    Actual_Particulars: tableRowInputs
                                        .find(".actual_particulars")
                                        .val(),
                                    Actual_cost: tableRowInputs
                                        .find(".actual_cost")
                                        .val(),
                                    acknowledgement: tableRowInputs
                                        .find(".acknowledgement")
                                        .val(),
                                    remarks: tableRowInputs
                                        .find(".remarks")
                                        .val(),
                                };
                                equipmentData.push(equipmentDetails);
                            });

                            nonEquipmentTableRow.each(function () {
                                const tableRowInputs = $(this);
                                const nonEquipmentDetails = {
                                    Approved_qty: tableRowInputs
                                        .find(".non_equipment_approved_qty")
                                        .val(),
                                    Approved_Particulars: tableRowInputs
                                        .find(
                                            ".non_equipment_approved_particulars"
                                        )
                                        .val(),
                                    Approved_cost: tableRowInputs
                                        .find(".non_equipment_approved_cost")
                                        .val(),
                                    Actual_qty: tableRowInputs
                                        .find(".non_equipment_actual_qty")
                                        .val(),
                                    Actual_Particulars: tableRowInputs
                                        .find(
                                            ".non_equipment_actual_particulars"
                                        )
                                        .val(),
                                    Actual_cost: tableRowInputs
                                        .find(".non_equipment_actual_cost")
                                        .val(),
                                    remarks: tableRowInputs
                                        .find(".non_equipment_remarks")
                                        .val(),
                                };
                                nonEquipmentData.push(nonEquipmentDetails);
                            });

                            salesTableRow.each(function () {
                                const tableRowInputs = $(this);
                                const salesDetails = {
                                    ProductService: tableRowInputs
                                        .find(".sales_product_service")
                                        .val(),
                                    SalesVolumeProduction: tableRowInputs
                                        .find(".sales_volume_production")
                                        .val(),
                                    SalesQuarter: tableRowInputs
                                        .find(".sales_quarter_specify")
                                        .val(),
                                    GrossSales: tableRowInputs
                                        .find(".sales_gross_sales")
                                        .val(),
                                };
                                salesData.push(salesDetails);
                            });
                            employmentGeneratedTableRow.each(function () {
                                const tableRowInputs = $(this);
                                const employmentGeneratedDetails = {
                                    Employment_total: tableRowInputs
                                        .find(".employment_total")
                                        .val(),
                                    Employment_Male: tableRowInputs
                                        .find(".employment_male")
                                        .val(),
                                    Employment_Female: tableRowInputs
                                        .find(".employment_female")
                                        .val(),
                                    Employment_PWD: tableRowInputs
                                        .find(".employment_pwd")
                                        .val(),
                                };
                                employmentGeneratedData.push(
                                    employmentGeneratedDetails
                                );
                            });

                            indirectEmploymentTableRow.each(function () {
                                const tableRowInputs = $(this);
                                const indirectEmploymentDetails = {
                                    IndirectEmployment_total: tableRowInputs
                                        .find(".indirect_employment_total")
                                        .val(),
                                    IndirectEmployment_ForwardMale:
                                        tableRowInputs
                                            .find(
                                                ".indirect_employment_forward_male"
                                            )
                                            .val(),
                                    IndirectEmployment_ForwardFemale:
                                        tableRowInputs
                                            .find(
                                                ".indirect_employment_forward_female"
                                            )
                                            .val(),
                                    InderectEmplyment_ForwardTotal:
                                        tableRowInputs
                                            .find(
                                                ".indirect_employment_forward_total"
                                            )
                                            .val(),
                                    IndirectEmployment_BackwardMale:
                                        tableRowInputs
                                            .find(
                                                ".indirect_employment_backward_male"
                                            )
                                            .val(),
                                    IndirectEmployment_BackwardFemale:
                                        tableRowInputs
                                            .find(
                                                ".indirect_employment_backward_female"
                                            )
                                            .val(),
                                    IndirectEmployment_BackwardTotal:
                                        tableRowInputs
                                            .find(
                                                ".indirect_employment_backward_total"
                                            )
                                            .val(),
                                };
                                indirectEmploymentData.push(
                                    indirectEmploymentDetails
                                );
                            });

                            return {
                                ExpectedAndActualData: expectedAndActualData,
                                EquipmentData: equipmentData,
                                NonEquipmentData: nonEquipmentData,
                                SalesData: salesData,
                                EmploymentGeneratedData:
                                    employmentGeneratedData,
                                IndirectEmploymentData: indirectEmploymentData,
                            };
                        };

                        return (thisFormObject = {
                            ...thisFormObject,
                            ...TableData(),
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
            $("#CreateQuarterlyReportForm").on("submit", function (e) {
                e.preventDefault();
                const project_id = $("#ProjectID").val();
                const formData =
                    $(this).serialize() + "&project_id=" + project_id;
                $.ajax({
                    type: "POST",
                    url: DASHBBOARD_TAB_ROUTE.STORE_NEW_QUARTERLY_REPORT,
                    data: formData,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        getQuarterlyReports(project_id);
                        showToastFeedback("text-bg-success", response.message);
                    },
                    error: function (error) {
                        showToastFeedback(
                            "text-bg-danger",
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
                const TableContainer = $("#quarterlyTableBody");

                try {
                    const response = await $.ajax({
                        type: "GET",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        url:
                            DASHBBOARD_TAB_ROUTE.GET_QUARTERLY_REPORT_RECORDS +
                            "?project_id=" +
                            project_id,
                    });
                    response !== null && TableContainer.empty();

                    response.sort((a, b) => {
                        const quarterA = a.quarter.split(" ")[0];
                        const yearA = a.quarter.split(" ")[1];
                        const quarterB = b.quarter.split(" ")[0];
                        const yearB = b.quarter.split(" ")[1];

                        if (yearA < yearB) return -1;
                        if (yearA > yearB) return 1;

                        const quarterOrder = ["Q1", "Q2", "Q3", "Q4"];
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
              report.Coop_Response === "submitted"
                  ? "bg-success"
                  : "text-bg-secondary"
          }">${report.Coop_Response}
          </span>
          </td>
          <td class="text-center">
          <span class="badge rounded-pill ${
              report.report_status === "open"
                  ? "bg-primary"
                  : "text-bg-secondary"
          }">
          ${report.report_status}
          </span>
          </td>
          <td class="text-center">
          <span>
          ${report.open_until ?? "Not set"}
          </span><br/>
          <span class="text-secondary fst-italic">  ${
              report.open_until
                  ? "will close in " + report.remaining_days + " Day/s"
                  : " "
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
                    console.log(error);
                    showToastFeedback(
                        "text-bg-danger",
                        error.responseJSON.message
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
            $("#updateQuarterlyRecordModal").on(
                "show.bs.modal",
                function (event) {
                    const triggeredbutton = $(event.relatedTarget);
                    const record = triggeredbutton.data("record-id");
                    const triggeredButtonRow = triggeredbutton.closest("tr");

                    const modal = $(this);
                    const reportStatus =
                        triggeredButtonRow.find('span.badge:contains("open")')
                            .length > 0
                            ? "open"
                            : "closed";
                    modal
                        .find("#updateQuarterlyRecord")
                        .attr("data-record-id", record);

                    modal
                        .find("#toogleReport")
                        .prop(
                            "checked",
                            reportStatus === "open" ? true : false
                        );
                    modal
                        .find("#updateQuarterlyRecord")
                        .attr("data-record-id", record);

                    $("#updateQuarterlyRecord").on("click", function () {
                        const record_id = $(this).data("record-id");
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
                const form = $("#updateQuarterlyRecordForm").serialize();
                const report_status = $("#toogleReport").prop("checked")
                    ? "open"
                    : "closed";

                try {
                    const response = await $.ajax({
                        type: "PUT",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        url: DASHBBOARD_TAB_ROUTE.UPDATE_QUARTERLY_REPORT.replace(
                            ":record_id",
                            report_id
                        ),
                        data: form + "&report_status=" + report_status,
                    });

                    getQuarterlyReports(response.project_id);
                    closeModal("#updateQuarterlyRecordModal");
                    showToastFeedback("text-bg-success", response.message);
                } catch (error) {
                    showToastFeedback(
                        "text-bg-danger",
                        error.responseJSON.message
                    );
                }
            };
        },
        Projects: () => {
            const ApprovedDataTable = $("#approvedTable").DataTable({
                responsive: true,
                autoWidth: true,
                fixedColumns: true,
                columnDefs: [
                    {
                        targets: 0,
                        width: "5%",
                    },
                    {
                        targets: 1,
                        width: "10%",
                    },
                    {
                        targets: 2,
                        width: "15%",
                    },
                    {
                        targets: 3,
                        width: "30%",
                    },
                    {
                        targets: 4,
                        width: "10%",
                    },
                    {
                        targets: 5,
                        width: "2%",
                    },
                ],
            });
            const OngoingDataTable = $("#ongoingTable").DataTable({
                responsive: true,
                autoWidth: false,
                fixedColumns: false,
                columns: [
                    {
                        title: "Project #",
                    },
                    {
                        title: "Project Title",
                    },
                    {
                        title: "Firm",
                    },
                    {
                        title: "Cooperator Name",
                    },
                    {
                        title: "Progress",
                    },
                    {
                        title: "Action",
                    },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        width: "15%",
                        className: "text-center",
                    },
                    {
                        targets: 1,
                        width: "30%",
                    },
                    {
                        targets: 2,
                        width: "15%",
                    },
                    {
                        targets: 3,
                        width: "20%",
                    },
                    {
                        targets: 4,
                        width: "30%",
                        className: "text-end",
                    },
                    {
                        targets: 5,
                        width: "10%",
                        orderable: false,
                        className: "text-center",
                    },
                ],
            });
            const CompletedDataTable = $("#completedTable").DataTable({
                responsive: true,
                autoWidth: false,
                fixedColumns: true,
                columns: [
                    {
                        title: "Project #",
                    },
                    {
                        title: "Project Title",
                    },
                    {
                        title: "Firm",
                    },
                    {
                        title: "Cooperator Name",
                    },
                    {
                        title: "Progress",
                    },
                    {
                        title: "Action",
                    },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        width: "15%",
                        className: "text-center",
                    },
                    {
                        targets: 1,
                        width: "30%",
                    },
                    {
                        targets: 2,
                        width: "15%",
                    },
                    {
                        targets: 3,
                        width: "20%",
                    },
                    {
                        targets: 4,
                        width: "30%",
                        className: "text-end",
                    },
                    {
                        targets: 5,
                        width: "10%",
                        orderable: false,
                        className: "text-center",
                    },
                ],
            });
            const PaymentHistoryDataTable = $("#paymentHistoryTable").DataTable(
                {
                    autoWidth: true,
                    responsive: true,
                    columns: [
                        {
                            title: "Transaction #",
                        },
                        {
                            title: "Amount",
                        },
                        {
                            title: "Payment Method",
                        },
                        {
                            title: "Status",
                        },
                        {
                            title: "Date Created",
                        },
                    ],
                }
            );

            const addProjectBtn = $("#addProjectManualy");

            addProjectBtn.on("click", async () => {
                await loadPage(NAV_ROUTES.ADD_PROJECT, "projectLink");
            });

            $("#ApprovedtableBody").on(
                "click",
                ".approvedProjectInfo",
                function () {
                    const row = $(this).closest("tr");
                    const inputs = row.find("input");

                    const values = {
                        cooperatorName: row.find("td:eq(1)").text().trim(),
                        designation: inputs.filter(".designation").val(),
                        b_id: inputs.filter(".business_id").val(),
                        businessAddress: inputs
                            .filter(".business_address")
                            .val(),
                        typeOfEnterprise: inputs
                            .filter(".enterprise_type")
                            .val(),
                        enterpriseLevel: inputs
                            .filter(".enterprise_level")
                            .val(),
                        landline: inputs.filter(".landline").val(),
                        mobilePhone: inputs.filter(".mobile_number").val(),
                        email: inputs.filter(".email").val(),
                        ProjectId: row.find("td:eq(0)").text().trim(),
                        ProjectTitle: row.find("td:eq(3)").text().trim(),
                        Amount: parseFloat(
                            inputs
                                .filter(".fund_amount")
                                .val()
                                .replace(/,/g, "")
                        ),
                        Applied: inputs.filter(".dateApplied").val(),
                        evaluated: inputs.filter(".evaluated_by").val(),
                        Assigned_to: inputs.filter(".assigned_to").val(),
                        building: parseFloat(
                            inputs
                                .filter(".building_Assets")
                                .val()
                                .replace(/,/g, "")
                        ),
                        equipment: parseFloat(
                            inputs
                                .filter(".equipment_Assets")
                                .val()
                                .replace(/,/g, "")
                        ),
                        workingCapital: parseFloat(
                            inputs
                                .filter(".working_capital_Assets")
                                .val()
                                .replace(/,/g, "")
                        ),
                    };

                    $("#cooperatorName").val(values.cooperatorName);
                    $("#designation").val(values.designation);
                    $("#b_id").val(values.b_id);
                    $("#businessAddress").val(values.businessAddress);
                    $("#typeOfEnterprise").val(values.typeOfEnterprise);
                    $("#enterpriseLevel").val(values.enterpriseLevel);
                    $("#landline").val(values.landline);
                    $("#mobilePhone").val(values.mobilePhone);
                    $("#email").val(values.email);
                    $("#ProjectId").val(values.ProjectId);
                    $("#ProjectTitle").val(values.ProjectTitle);
                    $("#Amount").val(
                        values.Amount.toLocaleString("en-US", {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2,
                        })
                    );
                    $("#Applied").val(values.Applied);
                    $("#evaluated").val(values.evaluated);
                    $("#Assigned_to").val(values.Assigned_to);
                    $("#building").val(
                        values.building.toLocaleString("en-US", {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2,
                        })
                    );
                    $("#equipment").val(
                        values.equipment.toLocaleString("en-US", {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2,
                        })
                    );
                    $("#workingCapital").val(
                        values.workingCapital.toLocaleString("en-US", {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2,
                        })
                    );

                    const approvedProjectOffcanvas = $("#approvedDetails");
                    const userName = inputs.filter(".staffUserName").val();
                    const authUserName = "{{ Auth::user()->user_name }}";
                    if (
                        userName !== undefined &&
                        userName !== null &&
                        authUserName === userName
                    ) {
                        approvedProjectOffcanvas.find(".offcanvas-body").after(`
                              <div class="menu-container">
                        <div class="menu-button z-3 p-3 text-white">
                            <i class="ri-menu-2-fill ri-lg" id="menu-icon-state"></i>
                        </div>
                        <div class="menu" id="menu">
                            <div class="menu-item text-nowrap">
                                <button class="btn text-white" data-display-section="cooperatorRequirementsLinks"
                                    id="attachlink">
                                    <i class="ri-user-fill"></i>
                                    Attach Link
                                </button>
                            </div>
                            <div class="menu-item text-nowrap">
                                <button class="btn text-white" data-display-section="createPIS" id="createPIS">
                                    <i class="ri-home-fill"></i>
                                    Create PIS
                                </button>
                            </div>
                            <div class="menu-item text-nowrap menuBtn">
                                <button class="btn text-white" data-display-section="cooperatorDetails" id="cooperatorDetails">
                                    <i class="ri-file-add-fill"></i>
                                    Details
                                </button>
                            </div>
                        </div>
                    </div>`);
                    } else {
                        approvedProjectOffcanvas
                            .find(".menu-container")
                            .remove();
                    }
                }
            );

            $("#addRequirement").on("click", function () {
                const RequirementLinkContent = $("#linkContainer");

                RequirementLinkContent.append(`
                            <div class="col-12 linkConstInstance">
                                        <div class="row">
                                            <div class="col-11">
                                                <div class="col-12 m-2">
                                                    <label for="requirements_name" class="">Name:</label>
                                                    <input type="text" name="requirements_name" class=" bottom_border">
                                                </div>
                                                <div class="input-group">
                                                    <label for="requirements_link" class="input-group-text"><i
                                                            class="ri-links-fill"></i></label>
                                                    <input type="text" name="requirements_link" class="form-control">
                                                </div>
                                            </div>
                                             <div class="col-1 align-content-center">
                                                <button class="btn removeRequirement"><i class="ri-close-large-fill"></i></button>
                                            </div>
                                        </div>
                                </div>
                            `);
            });

            $("#linkContainer").on("click", ".removeRequirement", function () {
                $(this).closest(".linkConstInstance").remove();
            });

            $("#approvedDetails").on(
                "click",
                "[data-display-section]",
                function () {
                    // Cache the data attribute value
                    const sectionId = $(this).data("display-section");
                    // Cache the section container selector
                    const sectionContainer = $(".section-container");

                    // Hide all sections in one go, instead of calling hide() on each element
                    sectionContainer.hide();

                    // Toggle the display of the selected section
                    $("#" + sectionId).toggle();
                }
            );

            $("#OngoingTableBody").on(
                "click",
                ".ongoingProjectInfo",
                function () {
                    const row = $(this).closest("tr");
                    const inputs = row.find("input");
                    const readonlyInputs = $("#ongoingDetails").find("input");
                    console.log(inputs);

                    const personalDetails = {
                        cooperName: row.find("td:nth-child(4)").text().trim(),
                        designaition: inputs.filter(".designation").val(),
                        email: inputs.filter(".email").val(),
                        mobile_number: inputs.filter(".mobile_number").val(),
                        landline: inputs.filter(".landline").val(),
                    };

                    const businessDetails = {
                        business_id: inputs.filter(".business_id").val(),
                        firmName: row.find("td:nth-child(3)").text().trim(),
                        address: inputs.filter(".address").val(),
                        enterprise_type: inputs
                            .filter(".enterprise_type")
                            .val(),
                        enterprise_level: inputs
                            .filter(".enterprise_level")
                            .val(),
                        building_assets: parseFloat(
                            inputs.filter(".building_assets").val()
                        ),
                        equipment_assets: parseFloat(
                            inputs.filter(".equipment_assets").val()
                        ),
                        working_capital_assets: parseFloat(
                            inputs.filter(".working_capital_assets").val()
                        ),
                    };

                    const projectDetails = {
                        project_id: inputs.filter(".project_id").val(),
                        project_title: row
                            .find("td:nth-child(2)")
                            .text()
                            .trim(),
                        project_fund_amount: parseFloat(
                            inputs.filter(".project_fund_amount").val()
                        ),
                        project_amount_to_be_refunded: parseFloat(
                            inputs.filter(".amount_to_be_refunded").val()
                        ),
                        project_refunded_amount: parseFloat(
                            inputs.filter(".amount_refunded").val()
                        ),
                        date_applied: inputs.filter(".date_applied").val(),
                        project_date_approved: inputs
                            .filter(".date_approved")
                            .val(),
                        evaluated_by: inputs.filter(".evaluated_by").val(),
                        handle_by: inputs.filter(".handled_by").val(),
                    };

                    readonlyInputs
                        .filter(".cooperatorName")
                        .val(personalDetails.cooperName);
                    readonlyInputs
                        .filter(".designation")
                        .val(personalDetails.designaition);
                    readonlyInputs
                        .filter(".mobile_number")
                        .val(personalDetails.mobile_number);
                    readonlyInputs.filter(".email").val(personalDetails.email);
                    readonlyInputs
                        .filter(".landline")
                        .val(personalDetails.landline);

                    readonlyInputs
                        .filter(".b_id")
                        .val(businessDetails.business_id);
                    readonlyInputs
                        .filter(".firmName")
                        .val(businessDetails.firmName);
                    readonlyInputs
                        .filter(".businessAddress")
                        .val(businessDetails.address);
                    readonlyInputs
                        .filter(".typeOfEnterprise")
                        .val(businessDetails.enterprise_type);
                    readonlyInputs
                        .filter(".enterpriseLevel")
                        .val(businessDetails.enterprise_level);
                    readonlyInputs
                        .filter(".building")
                        .val(formatToString(businessDetails.building_assets));
                    readonlyInputs
                        .filter(".equipment")
                        .val(formatToString(businessDetails.equipment_assets));
                    readonlyInputs
                        .filter(".workingCapital")
                        .val(
                            formatToString(
                                businessDetails.working_capital_assets
                            )
                        );

                    readonlyInputs
                        .filter(".ProjectId")
                        .val(projectDetails.project_id);
                    readonlyInputs
                        .filter(".ProjectTitle")
                        .val(projectDetails.project_title);
                    readonlyInputs
                        .filter(".funded_amount")
                        .val(
                            formatToString(projectDetails.project_fund_amount)
                        );
                    readonlyInputs
                        .filter(".amount_to_be_refunded")
                        .val(
                            formatToString(
                                projectDetails.project_amount_to_be_refunded
                            )
                        );
                    readonlyInputs
                        .filter(".refunded")
                        .val(
                            formatToString(
                                projectDetails.project_refunded_amount
                            )
                        );
                    readonlyInputs
                        .filter(".date_applied")
                        .val(projectDetails.date_applied);
                    readonlyInputs
                        .filter(".evaluated_by")
                        .val(projectDetails.evaluated_by);
                    readonlyInputs
                        .filter(".handle_by")
                        .val(projectDetails.handle_by);

                    getPaymentHistory(projectDetails.project_id);
                }
            );

            $("#CompletedTableBody").on(
                "click",
                ".completedProjectInfo",
                function () {
                    const row = $(this).closest("tr");
                    const inputs = row.find("input");
                    const readonlyInputs = $("#completedDetails").find("input");
                    console.log(readonlyInputs);

                    const personalDetails = {
                        cooperName: row.find("td:nth-child(4)").text().trim(),
                        designaition: inputs.filter(".designation").val(),
                        email: inputs.filter(".email").val(),
                        mobile_number: inputs.filter(".mobile_number").val(),
                        landline: inputs.filter(".landline").val(),
                    };

                    const businessDetails = {
                        business_id: inputs.filter(".business_id").val(),
                        firmName: row.find("td:nth-child(3)").text().trim(),
                        address: inputs.filter(".address").val(),
                        enterprise_type: inputs
                            .filter(".enterprise_type")
                            .val(),
                        enterprise_level: inputs
                            .filter(".enterprise_level")
                            .val(),
                        building_assets: parseFloat(
                            inputs.filter(".building_assets").val()
                        ),
                        equipment_assets: parseFloat(
                            inputs.filter(".equipment_assets").val()
                        ),
                        working_capital_assets: parseFloat(
                            inputs.filter(".working_capital_assets").val()
                        ),
                    };

                    const projectDetails = {
                        project_id: inputs.filter(".project_id").val(),
                        project_title: row
                            .find("td:nth-child(2)")
                            .text()
                            .trim(),
                        project_fund_amount: parseFloat(
                            inputs.filter(".project_fund_amount").val()
                        ),
                        project_amount_to_be_refunded: parseFloat(
                            inputs.filter(".amount_to_be_refunded").val()
                        ),
                        project_refunded_amount: parseFloat(
                            inputs.filter(".amount_refunded").val()
                        ),
                        date_applied: inputs.filter(".date_applied").val(),
                        project_date_approved: inputs
                            .filter(".date_approved")
                            .val(),
                        evaluated_by: inputs.filter(".evaluated_by").val(),
                        handle_by: inputs.filter(".handle_by").val(),
                    };

                    readonlyInputs
                        .filter(".cooperatorName")
                        .val(personalDetails.cooperName);
                    readonlyInputs
                        .filter(".designation")
                        .val(personalDetails.designaition);
                    readonlyInputs
                        .filter(".mobile_number")
                        .val(personalDetails.mobile_number);
                    readonlyInputs.filter(".email").val(personalDetails.email);
                    readonlyInputs
                        .filter(".landline")
                        .val(personalDetails.landline);

                    readonlyInputs
                        .filter(".b_id")
                        .val(businessDetails.business_id);
                    readonlyInputs
                        .filter(".firmName")
                        .val(businessDetails.firmName);
                    readonlyInputs
                        .filter(".businessAddress")
                        .val(businessDetails.address);
                    readonlyInputs
                        .filter(".typeOfEnterprise")
                        .val(businessDetails.enterprise_type);
                    readonlyInputs
                        .filter(".enterpriseLevel")
                        .val(businessDetails.enterprise_level);
                    readonlyInputs
                        .filter(".building")
                        .val(formatToString(businessDetails.building_assets));
                    readonlyInputs
                        .filter(".equipment")
                        .val(formatToString(businessDetails.equipment_assets));
                    readonlyInputs
                        .filter(".workingCapital")
                        .val(
                            formatToString(
                                businessDetails.working_capital_assets
                            )
                        );

                    readonlyInputs
                        .filter(".ProjectId")
                        .val(projectDetails.project_id);
                    readonlyInputs
                        .filter(".ProjectTitle")
                        .val(projectDetails.project_title);
                    readonlyInputs
                        .filter(".funded_amount")
                        .val(
                            formatToString(projectDetails.project_fund_amount)
                        );
                    readonlyInputs
                        .filter(".amount_to_be_refunded")
                        .val(
                            formatToString(
                                projectDetails.project_amount_to_be_refunded
                            )
                        );
                    readonlyInputs
                        .filter(".refunded")
                        .val(
                            formatToString(
                                projectDetails.project_refunded_amount
                            )
                        );
                    readonlyInputs
                        .filter(".date_applied")
                        .val(projectDetails.date_applied);
                    readonlyInputs
                        .filter(".evaluated_by")
                        .val(projectDetails.evaluated_by);
                    readonlyInputs
                        .filter(".handle_by")
                        .val(projectDetails.handle_by);
                }
            );

            async function getPaymentHistory(projectId) {
                try {
                    const response = await $.ajax({
                        type: "GET",
                        url:
                            PROJECT_TAB_ROUTE.GET_PAYMENT_RECORDS +
                            "?project_id=" +
                            projectId,
                    });

                    PaymentHistoryDataTable.clear();
                    PaymentHistoryDataTable.rows.add(
                        response.map((payment) => {
                            const formattedDate = dateFormatter(
                                payment.created_at
                            );
                            return [
                                payment.transaction_id,
                                formatToString(parseFloat(payment.amount)),
                                payment.payment_method,
                                `<span class="badge bg-${
                                    payment.payment_status === "Paid"
                                        ? "success"
                                        : payment.payment_status === "Pending"
                                        ? "warning"
                                        : "danger"
                                } ">${payment.payment_status}</span>`,
                                formattedDate,
                            ];
                        })
                    );
                    PaymentHistoryDataTable.draw();

                    let totalAmount = 0;
                    response.forEach((payment) => {
                        totalAmount += parseFloat(payment.amount);
                    });
                    //   return totalAmount;
                } catch (error) {}
            }
            async function getApprovedProjects() {
                try {
                    const response = await fetch(
                        PROJECT_TAB_ROUTE.GET_APPROVED_PROJECTS,
                        {
                            method: "GET",
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                            dataType: "json",
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
                                              Approved.landline ?? ""
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
                                          <input type="hidden" class="dateApplied" value="${
                                              Approved.date_applied
                                          }">
                                          <input type="hidden" class="staffUserName" value="${
                                              Approved.staffUserName
                                          }">
                                          <input type="hidden" class="evaluated_by" value="${
                                              Approved?.evaluated_by_prefix +
                                              " " +
                                              Approved.evaluated_by_f_name +
                                              " " +
                                              Approved?.evaluated_by_mid_name +
                                              " " +
                                              Approved.evaluated_by_l_name +
                                              " " +
                                              Approved?.evaluated_by_suffix
                                          }">
                                          <input type="hidden" class="assigned_to" value="${
                                              Approved?.handled_by_prefix +
                                              "" +
                                              Approved.handled_by_f_name +
                                              " " +
                                              Approved?.handled_by_mid_name +
                                              " " +
                                              Approved?.handled_by_l_name +
                                              " " +
                                              Approved?.handled_by_suffix
                                          }">`,
                                `${Approved.date_approved}`,
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
                    console.error("Error:", error);
                }
            }

            async function getOngoingProjects() {
                try {
                    const response = await fetch(
                        PROJECT_TAB_ROUTE.GET_ONGOING_PROJECTS,
                        {
                            method: "GET",
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                            dataType: "json",
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
                          Ongoing?.evaluated_by_prefix +
                          " " +
                          Ongoing.evaluated_by_f_name +
                          " " +
                          Ongoing?.evaluated_by_mid_name +
                          " " +
                          Ongoing.evaluated_by_l_name +
                          " " +
                          Ongoing?.evaluated_by_suffix
                      }">
                      <input type="hidden" class="handled_by" value="${
                          Ongoing?.handled_by_prefix +
                          " " +
                          Ongoing.handled_by_f_name +
                          " " +
                          Ongoing?.handled_by_mid_name +
                          " " +
                          Ongoing.handled_by_l_name +
                          " " +
                          Ongoing?.handled_by_suffix
                      }">`,
                                `${Ongoing.firm_name}
                      <input type="hidden" class="business_id" value="${
                          Ongoing.business_id
                      }">
                      <input type="hidden" class="address" value="${
                          Ongoing.landmark +
                          ", " +
                          Ongoing.barangay +
                          ", " +
                          Ongoing.city +
                          ", " +
                          Ongoing.province +
                          ", " +
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
                                `${Ongoing.f_name + " " + Ongoing.l_name}
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
                          Ongoing.landline ?? ""
                      }">`,
                                `${
                                    formatToString(amount_refunded) +
                                    " / " +
                                    formatToString(to_be_refunded)
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
                    console.error("Error:", error);
                }
            }

            async function getCompletedProjects() {
                try {
                    const response = await fetch(
                        PROJECT_TAB_ROUTE.GET_COMPLETED_PROJECTS,
                        {
                            method: "GET",
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                            dataType: "json",
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
                              completed?.evaluated_by_prefix +
                              " " +
                              completed.evaluated_by_f_name +
                              " " +
                              completed?.evaluated_by_mid_name +
                              " " +
                              completed.evaluated_by_l_name +
                              " " +
                              completed?.evaluated_by_suffix
                          }">
                          <input type="hidden" class="handled_by" value="${
                              completed?.handled_by_prefix +
                              " " +
                              completed.handled_by_f_name +
                              " " +
                              completed?.handled_by_mid_name +
                              " " +
                              completed.handled_by_l_name +
                              " " +
                              completed?.handled_by_suffix
                          }">`,
                                `${completed.firm_name}
                          <input type="hidden" class="business_id" value="${
                              completed.business_id
                          }">
                          <input type="hidden" class="address" value="${
                              completed.landmark +
                              ", " +
                              completed.barangay +
                              ", " +
                              completed.city +
                              ", " +
                              completed.province +
                              ", " +
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
                                `${completed.f_name + " " + completed.l_name}
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
                              completed.landline ?? ""
                          }">`,
                                `${
                                    formatToString(amount_refunded) +
                                    " / " +
                                    formatToString(to_be_refunded)
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
                    console.error("Error:", error);
                }
            }

            getApprovedProjects();
            getOngoingProjects();
            getCompletedProjects();
        },

        AddProject: async () => {
            const module = await import("./applicationPage");
            // If you know specific functions that need to be called
            if (module.initializeForm) {
                module.initializeForm();
            }
        },
        Applicant: () => {
            let ProjectProposalFormInitialValue = {};
            const applicantDataTable = $("#applicant").DataTable({
                responsive: true,
                autoWidth: false,
                fixedColumns: true,
                columns: [
                    {
                        title: "Applicant",
                        width: "25%",
                    },
                    {
                        title: "Designation",
                        width: "10%",
                    },
                    {
                        title: "Business Info",
                        width: "35%",
                        orderable: false,
                    },
                    {
                        title: "Date Applied",
                        width: "15%",
                        type: "date",
                    },
                    {
                        title: "Status",
                        width: "10%",
                        className: "text-center",
                    },
                    {
                        title: "Action",
                        width: "5%",
                        orderable: false,
                    },
                ],
            });

            const getApplicants = async () => {
                const response = await fetch(
                    APPLICANT_TAB_ROUTE.GET_APPLICANTS,
                    {
                        method: "GET",
                        dataType: "json",
                    }
                );
                const data = await response.json();
                applicantDataTable.clear();
                applicantDataTable.rows
                    .add(
                        data.map((item) => {
                            return [
                                `${
                                    item.prefix +
                                    " " +
                                    item.f_name +
                                    " " +
                                    item.mid_name +
                                    " " +
                                    item.suffix
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
                        item.male_direct_re || "0"
                    }">
                    <input type="hidden" name="female_direct_re" value="${
                        item.female_direct_re || "0"
                    }">
                    <input type="hidden" name="male_direct_part" value="${
                        item.male_direct_part || "0"
                    }">
                    <input type="hidden" name="female_direct_part" value="${
                        item.female_direct_part || "0"
                    }">
                    <input type="hidden" name="male_indirect_re" value="${
                        item.male_indirect_re || "0"
                    }">
                    <input type="hidden" name="female_indirect_re" value="${
                        item.female_indirect_re || "0"
                    }">
                    <input type="hidden" name="male_indirect_part" value="${
                        item.male_indirect_part || "0"
                    }">
                    <input type="hidden" name="female_indirect_part" value="${
                        item.female_indirect_part || "0"
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
                                }, ${item.city}, ${item.province}, ${
                                    item.region
                                }</span><br>
                    <strong>Type of Enterprise:</strong> <span class="enterprise_l">${
                        item.enterprise_type
                    }</span>
                    <p>
                        <strong>Assets:</strong> <br>
                        <span class="ps-2">Building: ${formatToString(
                            parseFloat(item.building_value)
                        )}</span><br>
                        <span class="ps-2">Equipment: ${formatToString(
                            parseFloat(item.equipment_value)
                        )}</span> <br>
                        <span class="ps-2">Working Capital: ${formatToString(
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
                                `${dateFormatter(item.date_applied)}`,
                                `<span class="badge ${
                                    item.application_status === "new"
                                        ? "bg-primary"
                                        : item.application_status ===
                                          "evaluation"
                                        ? "bg-info"
                                        : item.application_status === "pending"
                                        ? "bg-primary"
                                        : "bg-danger"
                                }">${item.application_status}</span>`,
                                `   <button class="btn btn-primary applicantDetailsBtn" type="button"
                                            data-bs-toggle="offcanvas" data-bs-target="#applicantDetails"
                                            aria-controls="applicantDetails">
                                            <i class="ri-menu-unfold-4-line ri-1x"></i>
                                        </button>`,
                            ];
                        })
                    )
                    .draw();
            };

            getApplicants();

            $("#evaluationSchedule-datepicker").on("change", function () {
                const selectedDate = new Date(this.value);
                const currentDate = new Date();

                if (selectedDate < currentDate) {
                    this.value = this.min;
                }
            });
            formatToNumber("#fundAmount, .EquipmentCost");

            //TODO: update this the logic of this
            $("#ApplicantTableBody").on(
                "click",
                ".applicantDetailsBtn",
                async function () {
                    const row = $(this).closest("tr");
                    const fullName = row.find("td:nth-child(1)").text().trim();
                    const sex = row.find("td:nth-child(1) input[name='sex']").val();
                    console.log(sex)
                    const designation = row
                        .find("td:nth-child(2)")
                        .text()
                        .trim();
                    const firmName = row
                        .find("td:nth-child(3) span.firm_name")
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
                        .find("td:nth-child(3) span.b_address")
                        .text()
                        .trim();
                    const enterpriseType = row
                        .find("td:nth-child(3) span.enterprise_l")
                        .text()
                        .trim();
                    const landline = row
                        .find("td:nth-child(3) span.landline")
                        .text()
                        .trim();
                    const mobilePhone = row
                        .find("td:nth-child(3) span.mobile_num")
                        .text()
                        .trim();
                    const emailAddress = row
                        .find("td:nth-child(3) span.email_add")
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

                    console.log(personnel);

                    const ApplicantDetails = $(
                        "#applicantDetails .businessInfo"
                    ).find("input");

                    ApplicantDetails.filter("#firm_name").val(firmName);
                    ApplicantDetails.filter("#selected_userId").val(userID);
                    ApplicantDetails.filter("#selected_businessID").val(
                        businessID
                    );
                    ApplicantDetails.filter("#selected_applicationId").val(
                        ApplicationID
                    );
                    ApplicantDetails.filter("#address").val(businessAddress);
                    ApplicantDetails.filter("#contact_person").val(fullName); // Add corresponding value
                    ApplicantDetails.filter("#designation").val(designation);
                    ApplicantDetails.filter("#sex").val(sex);
                    ApplicantDetails.filter("#enterpriseType").val(
                        enterpriseType
                    );
                    ApplicantDetails.filter("#landline").val(landline);
                    ApplicantDetails.filter("#mobile_phone").val(mobilePhone);
                    ApplicantDetails.filter("#email").val(emailAddress);
                    ApplicantDetails.filter("#male_direct_re").val(
                        personnel.male_direct_re || "0"
                    );
                    ApplicantDetails.filter("#female_direct_re").val(
                        personnel.female_direct_re || "0"
                    );
                    ApplicantDetails.filter("#male_direct_part").val(
                        personnel.male_direct_part || "0"
                    );
                    ApplicantDetails.filter("#female_direct_part").val(
                        personnel.female_direct_part || "0"
                    );
                    ApplicantDetails.filter("#male_indirect_re").val(
                        personnel.male_indirect_re || "0"
                    );
                    ApplicantDetails.filter("#female_indirect_re").val(
                        personnel.female_indirect_re || "0"
                    );
                    ApplicantDetails.filter("#male_indirect_part").val(
                        personnel.male_indirect_part || "0"
                    );
                    ApplicantDetails.filter("#female_indirect_part").val(
                        personnel.female_indirect_part || "0"
                    );
                    ApplicantDetails.filter("#total_personnel").val(
                        personnel.total_personnel || "0"
                    );

                    getApplicantRequirements(businessID);
                    getEvaluationScheduledDate(businessID, ApplicationID);
                    getProposalDraft(ApplicationID);
                }
            );

            const ApplicantDetailsContainer = $("#applicantDetails");

            ApplicantDetailsContainer.on("hidden.bs.offcanvas", function () {
                const FormContainer =
                    ApplicantDetailsContainer.find("#projectProposal");
                FormContainer.find("input, textarea").val("");
                FormContainer.find(
                    ".input_list, #EquipmentTableBody, #NonEquipmentTableBody"
                ).each(function () {
                    $(this).children().slice(1).remove();
                });
                ApplicantDetailsContainer.find("#requirementsTables").empty();
                clearInitialValues();
            });

            const getApplicantRequirements = async (businessID) => {
                try {
                    const response = await $.ajax({
                        type: "GET",
                        url: APPLICANT_TAB_ROUTE.GET_APPLICANT_REQUIREMENTS.replace(
                            ":id",
                            businessID
                        ),
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
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
                        type: "GET",
                        url: APPLICANT_TAB_ROUTE.getEvaluationScheduleDate,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        data: {
                            business_id: businessID,
                            application_id: applicationID,
                        },
                    });
                    const nofi_dateCont = $("#nofi_ScheduleCont");
                    const setAndUpdateBtn = $("#setEvaluationDate");
                    nofi_dateCont.empty();
                    if (response.Scheduled_date) {
                        nofi_dateCont.append(
                            '<div class="alert alert-primary mb-auto" role="alert">An evaluation date of <strong>' +
                                response.Scheduled_date +
                                '</strong> has been set for this applicant. <p class="my-auto text-secondary">Applicant is already notified through email and notification.</p></div>'
                        );
                        setAndUpdateBtn.text("Update");
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
                const requimentTableBody = $("#requirementsTables");

                requimentTableBody.empty();

                $.each(response, function (index, requirement) {
                    const row = $("<tr>");
                    row.append("<td>" + requirement.file_name + "</td>");
                    row.append("<td>" + requirement.file_type + "</td>");
                    row.append(
                        `<td class="text-center">
              <button class="btn btn-primary viewReq position-relative">View <span class="position-absolute top-0 start-100 translate-middle p-2 ${
                  requirement.remarks === "Pending"
                      ? "bg-info"
                      : requirement.remarks === "Approved"
                      ? "bg-primary"
                      : "bg-danger"
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

                    requimentTableBody.append(row);
                });
            }
            //View applicant requirements
            $("#requirementsTables").on("click", ".viewReq", function () {
                const row = $(this).closest("tr");
                const fileID = row
                    .find('input[type="hidden"][name="file_id"]')
                    .val();
                const file_Name = row.find("td:nth-child(1)").text();
                const fileUrl = row
                    .find('input[type="hidden"][name="file_url"]')
                    .val();
                const fileType = row.find("td:nth-child(2)").text();
                const uploadedDate = row
                    .find('input[type="hidden"][name="created_at"]')
                    .val();
                const updatedDate = row
                    .find('input[type="hidden"][name="updated_at"]')
                    .val();
                const uploader = $("#contact_person").val();

                $("#selectedFile_ID").val(fileID);
                $("#fileName").val(file_Name);
                $("#filetype").val(fileType);
                $("#file_url").val(fileUrl);
                $("#fileUploaded").val(uploadedDate);
                $("#fileUploadedBy").val(updatedDate);
                $("#fileUploadedBy").val(uploader);
                retrieveAndDisplayFile(fileUrl, fileType);
            });

            //retrieve and display file function as base64 format for both pdf and img type
            async function retrieveAndDisplayFile(fileUrl, fileType) {
                try {
                    const response = await $.ajax({
                        url: APPLICANT_TAB_ROUTE.SHOW_REQUIREMENT_FILE,
                        method: "GET",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        data: {
                            file_url: fileUrl,
                        },
                    });

                    const fileContent = $("#fileContent");
                    fileContent.empty(); // Clear any previous content

                    if (fileType === "pdf") {
                        // Display PDF in an iframe
                        const base64PDF =
                            "data:application/pdf;base64," +
                            response.base64File +
                            "";
                        const embed = $("<iframe>", {
                            src: base64PDF,
                            type: "application/pdf",
                            width: "100%",
                            height: "100%",
                            frameborder: "0",
                            allow: "fullscreen",
                        });
                        fileContent.append(embed);
                    } else {
                        // Display Image
                        const img = $("<img>", {
                            src: `data:${fileType};base64,${response.base64File}`,
                            class: "img-fluid",
                        });
                        fileContent.append(img);
                    }
                } catch (error) {
                    console.log(error);
                } finally {
                    const reviewFileModal = new bootstrap.Modal(
                        document.getElementById("reviewFileModal")
                    );
                    reviewFileModal.show();
                }
            }

            const reviewFileFormContainer = $("#reviewFileForm");

            //TODO: need some working
            reviewFileFormContainer.on("submit", async function (e) {
                e.preventDefault();
                const action = $(e.originalEvent.submitter).val();
                console.log(action);
                const formData = $(this).serialize() + "&action=" + action;
                try {
                    console.log(
                        APPLICANT_TAB_ROUTE.UPDATE_APPLICANT_REQUIREMENTS
                    );
                    const response = await $.ajax({
                        method: "PUT",
                        url: APPLICANT_TAB_ROUTE.UPDATE_APPLICANT_REQUIREMENTS.replace(
                            ":id",
                            $("#selectedFile_ID").val()
                        ),
                        data: formData,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        processData: false,
                    });
                    setTimeout(() => {
                        showToastFeedback("text-bg-success", response.success);
                    }, 500);
                } catch (error) {
                    showToastFeedback(
                        "text-bg-danger",
                        error.responseJSON.error
                    );
                }
            });

            //set evaluation date
            $("#setEvaluationDate").on("click", async function () {
                const container = $("#applicantDetails .businessInfo");
                const user_id = container.find("#selected_userId").val();
                const application_id = container
                    .find("#selected_applicationId")
                    .val();
                const business_id = container
                    .find("#selected_businessID")
                    .val();
                const Scheduledate = $("#evaluationSchedule-datepicker").val();

                try {
                    const response = await $.ajax({
                        type: "PUT",
                        url: APPLICANT_TAB_ROUTE.setEvaluationScheduleDate,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
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
                        await getEvaluationScheduledDate(
                            business_id,
                            application_id
                        );
                        showToastFeedback("text-bg-success", response.message);
                    }
                } catch (error) {
                    showToastFeedback(
                        "text-bg-danger",
                        error.responseJSON.error
                    );
                }
            });

            const toggleDeleteRowButton = (container, elementSelector) => {
                const element = container.find(elementSelector);
                const deleteRowButton = container
                    .children(".addAndRemoveButton_Container")
                    .find(".removeRowButton");
                element.length === 1
                    ? deleteRowButton.prop("disabled", true)
                    : deleteRowButton.prop("disabled", false);
            };

            $(".addNewRowButton").on("click", function () {
                const container = $(this).closest(".card-body");

                const table = container.find("table");
                if (table.length) {
                    const lastRow = table.find("tbody tr:last-child");
                    const newRow = lastRow.clone();
                    newRow.find("input, textarea").val("");
                    table.find("tbody").append(newRow);
                    toggleDeleteRowButton(container, "tbody tr");
                } else {
                    const divContainer = container.find(".input_list");
                    const newDiv = divContainer.last().clone();
                    newDiv.find("input, textarea").val("");
                    container.append(newDiv);
                    toggleDeleteRowButton(container, ".input_list");
                }
            });

            $(".removeRowButton").on("click", function () {
                const container = $(this).closest(".card-body");

                const table = container.find("table");
                if (table.length) {
                    const lastRow = table.find("tbody tr:last-child");
                    lastRow.remove();
                    toggleDeleteRowButton(container, "tbody tr");
                } else {
                    const divContainer = container.find(".input_list");
                    divContainer.last().remove();
                    toggleDeleteRowButton(container, ".input_list");
                }
            });

            $("#projectProposal .card-body").each(function () {
                const container = $(this);

                const table = container.find("table");
                if (table.length) {
                    toggleDeleteRowButton(container, "tbody tr");
                } else {
                    toggleDeleteRowButton(container, ".input_list");
                }
            });

            function projectProposalFormData() {
                const FormContainer = $("#projectProposal");
                const FormData = FormContainer.serializeArray();
                let FormDataObjects = {};

                $.each(FormData, function (i, v) {
                    if (v.name.includes("[]")) {
                        FormDataObjects[v.name] = FormDataObjects[v.name]
                            ? [...FormDataObjects[v.name], v.value]
                            : [v.value];
                    } else {
                        FormDataObjects[v.name] = v.value;
                    }
                });

                const equipmentFacilities = FormContainer.find(
                    "#EquipmentTableBody tr"
                );
                const nonEquipment = FormContainer.find(
                    "#NonEquipmentTableBody tr"
                );
                const TableData = () => {
                    const EquipmentObject = [];
                    const NonEquipmentObject = [];

                    equipmentFacilities.each(function () {
                        const tableRowInputs = $(this).find("input");
                        const equipmentDetails = {
                            Qty: tableRowInputs[0].value,
                            Actual_Particulars: tableRowInputs[1].value,
                            Cost: tableRowInputs[2].value,
                        };

                        EquipmentObject.push(equipmentDetails);
                    });

                    nonEquipment.each(function () {
                        const tableRowInputs = $(this).find("input");
                        const nonEquipmentDetails = {
                            Qty: tableRowInputs[0].value,
                            Actual_Particulars: tableRowInputs[1].value,
                            Cost: tableRowInputs[2].value,
                        };
                        NonEquipmentObject.push(nonEquipmentDetails);
                    });

                    return {
                        equipmentDetails: EquipmentObject,
                        nonEquipmentDetails: NonEquipmentObject,
                    };
                };
                return (FormDataObjects = {
                    ...FormDataObjects,
                    ...TableData(),
                });
            }

            const revertbutton = $(".revertButton");

            const populateProjectProposalForm = (draftData) => {
                storeInitialValues("projectID", draftData.projectID);
                storeInitialValues("projectTitle", draftData.projectTitle);
                storeInitialValues(
                    "dateOfFundRelease",
                    draftData.dateOfFundRelease
                );
                storeInitialValues("fundAmount", draftData.fundAmount);

                $("#projectID").val(draftData.projectID);
                $("#projectTitle").val(draftData.projectTitle);
                $("#dateOfFundRelease").val(draftData.dateOfFundRelease);
                $("#fundAmount").val(draftData.fundAmount);

                // Populate expected outputs
                const expectedOutputsContainer = $(
                    "#ExpectedOutputTextareaContainer .input_list"
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
                const equipmentTableBody = $("#EquipmentTableBody");
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
                    storeInitialValues(costKey, equipment.Cost || "");

                    equipmentTableBody.append(`
                <tr>
                    <td><input type="number" class="form-control EquipmentQTY" data-initial-key="${qtyKey}" value="${
                        equipment.Qty
                    }"/></td>
                    <td><input type="text" class="form-control Particulars" data-initial-key="${particularsKey}" value="${
                        equipment.Actual_Particulars
                    }"/></td>
                    <td><input type="text" class="form-control EquipmentCost" data-initial-key="${costKey}" value="${
                        equipment.Cost || ""
                    }"/></td>
                </tr>
            `);
                });

                // Populate non-equipment details
                const nonEquipmentTableBody = $("#NonEquipmentTableBody");
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
                    storeInitialValues(costKey, nonEquipment.Cost || "");

                    nonEquipmentTableBody.append(`
                <tr>
                    <td><input type="number" class="form-control NonEquipmentQTY" data-initial-key="${qtyKey}" value="${
                        nonEquipment.Qty
                    }"/></td>
                    <td><input type="text" class="form-control NonParticulars" data-initial-key="${particularsKey}" value="${
                        nonEquipment.Actual_Particulars
                    }"/></td>
                    <td><input type="text" class="form-control NonEquipmentCost" data-initial-key="${costKey}" value="${
                        nonEquipment.Cost || ""
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
                $("#projectProposal").on(
                    "input",
                    "input, textarea",
                    function () {
                        let isModified = false;

                        // Check if any field has been modified
                        $("#projectProposal")
                            .find("input, textarea")
                            .each(function () {
                                const key = $(this).data("initial-key");
                                const currentValue = $(this).val();
                                const initialValue =
                                    ProjectProposalFormInitialValue[key];

                                if (currentValue !== initialValue) {
                                    isModified = true;
                                    return false; // Exit loop if a modification is found
                                }
                            });

                        // Enable or disable the revert button based on whether there are changes
                        revertbutton.prop("disabled", !isModified);
                    }
                );
            }

            // Handle revert button click
            revertbutton.on("click", function () {
                // Revert all fields to their initial values
                $("#projectProposal")
                    .find("input, textarea")
                    .each(function () {
                        const key = $(this).data("initial-key");
                        const initialValue =
                            ProjectProposalFormInitialValue[key];
                        $(this).val(initialValue);
                    });

                // Disable the revert button again after reverting
                revertbutton.prop("disabled", true);
            });

            const getProposalDraft = async (applicationID) => {
                try {
                    const response = await $.ajax({
                        type: "GET",
                        url: APPLICANT_TAB_ROUTE.GET_PROJECT_PROPOSAL_DRAFT.replace(
                            ":ApplicationId",
                            applicationID
                        ),
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });

                    response ? populateProjectProposalForm(response) : null;
                } catch (error) {
                    console.error(error);
                }
            };

            //submit project proposal
            $("#DraftProjectProposal, #submitProjectProposal").on(
                "click",
                async function (event) {
                    const action = $(this).data("action");
                    event.preventDefault();

                    const application_Id = $("#selected_applicationId").val();
                    const business_id = $("#selected_businessID").val();

                    const formdata = projectProposalFormData();
                    console.log(formdata);
                    formdata.action = action;
                    formdata.application_id = application_Id;
                    formdata.business_id = business_id;

                    try {
                        const response = await $.ajax({
                            type: "POST",
                            url: APPLICANT_TAB_ROUTE.STORE_PROJECT_PROPOSAL,
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                            data: formdata,
                        });

                        if (response.success === "true") {
                            closeOffcanvasInstances("#applicantDetails");
                            setTimeout(() => {
                                showToastFeedback(
                                    "text-bg-success",
                                    response.message
                                );
                            }, 500);
                        }
                    } catch (error) {
                        showToastFeedback(
                            "text-bg-danger",
                            error.responseJSON.message
                        );
                    }
                }
            );
        },
    };
    return functions;
};
