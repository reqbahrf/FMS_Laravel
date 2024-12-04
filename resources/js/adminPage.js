import "./echo";
import Notification from "./Notification";
import NotificationContainer from "./NotificationContainer";
import {
    showToastFeedback,
    formatToString,
    dateFormatter,
    closeOffcanvasInstances,
    closeModal,
    sanitize,
    createConfirmationModal,
    showProcessToast,
    hideProcessToast,
} from "./ReusableJS/utilFunctions";

import DataTable from "datatables.net-bs5";
window.DataTable = DataTable;
import "datatables.net-bs5";
import "datatables.net-buttons-bs5";
import "datatables.net-buttons/js/buttons.html5.mjs";
import "datatables.net-fixedcolumns-bs5";
import "datatables.net-fixedheader-bs5";
import "datatables.net-responsive-bs5";
import "datatables.net-scroller-bs5";

Echo.private(`admin-notifications.${USER_ID}`).listen(
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

$(function () {
    const lastUrl = sessionStorage.getItem("AdminlastUrl");
    const lastActive = sessionStorage.getItem("AdminLastActive");
    if (lastUrl && lastActive) {
        loadPage(lastUrl, lastActive);
    } else {
        loadPage(NAV_ROUTE.DASHBOARD, "dashboardLink");
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
        // Check if the response is already cached
        const cachePage = sessionStorage.getItem(url);
        if (cachePage) {
            // If cached, use the cached response
            handleAjaxSuccess(cachePage, activeLink, url);
        } else {
            // If not cached, make the AJAX request
            const response = await $.ajax({
                url: url,
                type: "GET",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            // Cache the response
            //sessionStorage.setItem(url, response);
            await handleAjaxSuccess(response, activeLink, url);
        }
    } catch (error) {
        console.error(error);
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

        const functions = await initializeAdminPageJs();

        const urlMapFunction = {
            [NAV_ROUTE.DASHBOARD]: functions.Dashboard,
            [NAV_ROUTE.PROJECTS]: functions.ProjectList,
            [NAV_ROUTE.APPLICATIONS]: functions.ApplicantList,
            [NAV_ROUTE.USERS]: functions.Users,
        };
        if (urlMapFunction[url]) {
            await urlMapFunction[url]();
        }
        // if (url === '/org-access/viewCooperatorInfo.php') {
        //     InitializeviewCooperatorProgress();
        // }
        sessionStorage.setItem("AdminlastUrl", url);
        sessionStorage.setItem("AdminLastActive", activeLink);
    } catch (error) {
        console.error(error);
    }
};

$(function () {
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

window.initializeAdminPageJs = async () => {
    const functions = {
        Dashboard: async () => {
            /**
             * Processes monthly data for chart creation.
             *
             * @param {object} monthlyData - An object containing monthly data for chart creation.
             * @return {Promise<void>} A promise that resolves when the data is processed.
             */
            const processMonthlyDataChart = async (monthlyData) => {
                let applicants = Array(12).fill(0);
                let ongoing = Array(12).fill(0);
                let completed = Array(12).fill(0);

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

                        // Assuming 'month' matches 'Sep', 'Oct' etc.
                        const monthIndex = months.indexOf(month.slice(0, 3));

                        // For each series, push the respective data

                        if (monthIndex !== -1) {
                            // Update the arrays for the respective data
                            applicants[monthIndex] = data.Applicants || 0;
                            ongoing[monthIndex] = data.Ongoing || 0;
                            completed[monthIndex] = data.Completed || 0;
                        }
                    })
                );
                await createMonthlyDataChart(applicants, ongoing, completed);
            };

            /**
             * Processes local data for chart creation, calculating total enterprise levels and creating a local data chart.
             *
             * @param {object} localData - An object containing local data for chart creation, with city names as keys and enterprise data as values.
             * @return {Promise<void>} A promise that resolves when the data is processed and charts are created.
             */
            const processLocalDataChart = async (localData) => {
                let cities = [];
                let microCounts = [];
                let smallCounts = [];
                let mediumCounts = [];

                for (const city in localData) {
                    if (localData.hasOwnProperty(city)) {
                        cities.push(city);
                        microCounts.push(localData[city]["Micro Enterprise"]);
                        smallCounts.push(localData[city]["Small Enterprise"]);
                        mediumCounts.push(localData[city]["Medium Enterprise"]);
                    }
                }

                let totalMicro = microCounts.reduce((a, b) => a + b, 0);
                let totalSmall = smallCounts.reduce((a, b) => a + b, 0);
                let totalMedium = mediumCounts.reduce((a, b) => a + b, 0);

                return Promise.all([
                    createLocalDataChart(
                        cities,
                        microCounts,
                        smallCounts,
                        mediumCounts
                    ),
                    createEnterpriseLevels(totalMicro, totalSmall, totalMedium),
                ]);
            };

            const processHandleStaffProjectChart = async (handleProject) => {
                const staffNames = handleProject.map((item) => item.Staff_Name);
                const microEnterprisData = handleProject.map(
                    (item) => item["Micro Enterprise"]
                );
                const smallEnterpriseData = handleProject.map(
                    (item) => item["Small Enterprise"]
                );
                const mediumEnterpriseData = handleProject.map(
                    (item) => item["Medium Enterprise"]
                );
                return Promise.all([
                    createhandledProjectsChart(
                        staffNames,
                        microEnterprisData,
                        smallEnterpriseData,
                        mediumEnterpriseData
                    ),
                ]);
            };

            /**
             * Creates a monthly data chart with the provided applicants, ongoing, and completed data.
             *
             * @param {number[]} applicants - An array of applicant data for each month.
             * @param {number[]} ongoing - An array of ongoing data for each month.
             * @param {number[]} completed - An array of completed data for each month.
             * @return {Promise<void>} A promise that resolves when the chart is rendered.
             */
            const createMonthlyDataChart = async (
                applicants,
                ongoing,
                completed
            ) => {
                const overallProject = {
                    theme: {
                        mode: "light",
                    },
                    series: [
                        {
                            name: "Applicants",
                            data: applicants,
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
                    const overallProjectGraph = new ApexCharts(
                        document.querySelector("#overallProjectGraph"),
                        overallProject
                    );
                    overallProjectGraph.render();
                    resolve();
                });
            };

            /**
             * Creates a local data chart with the provided cities and enterprise counts.
             *
             * @param {string[]} cities - An array of city names.
             * @param {number[]} microCounts - An array of micro enterprise counts.
             * @param {number[]} smallCounts - An array of small enterprise counts.
             * @param {number[]} mediumCounts - An array of medium enterprise counts.
             * @return {void}
             */
            let barChart;
            let pieChart;

            const createLocalDataChart = async (
                cities,
                microCounts,
                smallCounts,
                mediumCounts
            ) => {
                const options = {
                    chart: {
                        type: "bar",
                        height: 350,
                        stacked: true,
                        toolbar: {
                            show: true,
                            offsetX: 0,
                            offsetY: 0,
                            tools: {
                                download: false,
                                selection: true,
                                zoom: true,
                                zoomin: true,
                                zoomout: true,
                                pan: true,
                                reset: false,
                            },
                        },
                    },
                    series: [
                        {
                            name: "Micro Enterprises",
                            data: microCounts,
                        },
                        {
                            name: "Small Enterprises",
                            data: smallCounts,
                        },
                        {
                            name: "Medium Enterprises",
                            data: mediumCounts,
                        },
                    ],
                    dataLabels: {
                        enabled: false,
                    },
                    yaxis: {
                        title: {
                            text: "Count",
                        },
                    },
                    xaxis: {
                        labels: {
                            show: true,
                        },
                        tickPlacement: "on",
                        type: "category",
                        categories: cities,
                        title: {
                            text: "Cities",
                        },
                        Tooltip: {
                            enabled: true,
                            formatter: function (val, opts) {
                                return opts.w.globals.labels[
                                    opts.dataPointIndex
                                ];
                            },
                        },
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            dataLabels: {
                                enabled: false, // Disable data labels
                            },
                        },
                    },
                };
                return new Promise((resolve) => {
                    barChart = new ApexCharts(
                        document.querySelector("#localeChart"),
                        options
                    );
                    barChart.render();
                    resolve();
                });
            };

            const createEnterpriseLevels = async (
                totalMicro,
                totalSmall,
                totalMedium
            ) => {
                const EnterpriseLevelOptions = {
                    theme: {
                        mode: "light",
                    },
                    series: [totalMicro, totalSmall, totalMedium],
                    labels: [
                        `Micro Enterprise`,
                        `Small Enterprise`,
                        `Medium Enterprise`,
                    ],
                    chart: {
                        type: "pie",
                        width: "100%",
                        height: 350,
                    },
                    legend: {
                        show: true,
                        position: "bottom",
                        fontSize: "10px",
                        horizontalAlign: "center",
                        floating: false,
                        offsetY: 0,
                        itemMargin: {
                            horizontal: 5,
                            vertical: 2,
                        },
                    },
                    dataLabels: {
                        enabled: true,
                        style: {
                            fontSize: "12px",
                        },
                    },
                    responsive: [
                        {
                            breakpoint: 480,
                            options: {
                                chart: {
                                    height: 300,
                                },
                                legend: {
                                    fontSize: "8px",
                                    itemMargin: {
                                        horizontal: 2,
                                        vertical: 1,
                                    },
                                },
                                dataLabels: {
                                    style: {
                                        fontSize: "10px",
                                    },
                                },
                            },
                        },
                    ],
                };

                return new Promise((resolve) => {
                    pieChart = new ApexCharts(
                        document.querySelector("#enterpriseLevelChart"),
                        EnterpriseLevelOptions
                    );
                    pieChart.render();
                    resolve();
                });
            };
            const createhandledProjectsChart = async (
                staffNames,
                microEnterprisData,
                smallEnterpriseData,
                mediumEnterpriseData
            ) => {
                const handledBusiness = {
                    theme: {
                        mode: "light",
                    },
                    series: [
                        {
                            name: "Micro Enterprise",
                            data: microEnterprisData,
                        },
                        {
                            name: "Small Enterprise",
                            data: smallEnterpriseData,
                        },
                        {
                            name: "Medium Enterprise",
                            data: mediumEnterpriseData,
                        },
                    ],
                    chart: {
                        height: 350,
                        type: "bar",
                        stacked: true,
                        events: {
                            click: function (chart, w, e) {
                                // console.log(chart, w, e)
                            },
                        },
                    },
                    colors: ["#008ffb", "#00e396", "#feb019"],
                    plotOptions: {
                        bar: {
                            columnWidth: "45%",
                            distributed: false,
                            borderRadius: 10,
                            borderRadiusApplication: "end",
                            borderRadiusWhenStacked: "last",
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    legend: {
                        show: true,
                        position: "bottom",
                    },
                    xaxis: {
                        categories: staffNames,
                        labels: {
                            style: {
                                colors: ["#111111"],
                                fontSize: "0.75rem",
                            },
                        },
                    },
                };
                return new Promise((resolve) => {
                    new ApexCharts(
                        document.querySelector("#staffHandledB"),
                        handledBusiness
                    ).render();
                    resolve();
                });
            };

            /**
             * Retrieves dashboard chart data from the server and processes it.
             *
             * @return {Promise<void>} A promise that resolves when the data is fetched and processed.
             */
            const getDashboardChartData = async () => {
                try {
                    const response = await $.ajax({
                        type: "GET",
                        url: DASHBOARD_ROUTE.GET_DASHBOARD_CHARTS_DATA,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });

                    // Parse the JSON response if it's a string
                    const monthlyData =
                        (await JSON.parse(response.monthlyData)) ||
                        response.monthlyData;
                    const localData =
                        (await JSON.parse(response.localData)) ||
                        response.localData; // Assumes it's a valid JSON string
                    const handleProject = await response.staffhandledProjects;
                    return Promise.all([
                        processMonthlyDataChart(monthlyData),
                        processLocalDataChart(localData),
                        processHandleStaffProjectChart(handleProject),
                    ]);
                } catch (error) {
                    console.error("Error fetching chart data:", error);
                }
            };

            const loadAllCharts = async () => {
                await Promise.all([
                    (() => {
                        getDashboardChartData();
                    })(),
                ]);
            };

            await loadAllCharts();
        },

        /**
         * Initializes the project list view by setting up DataTables and event listeners.
         * It also defines several helper functions for fetching project proposals, staff lists, and approved projects.
         *
         * @return {void}
         */
        ProjectList: () => {
            const ForApprovalDataTable = $("#forApproval").DataTable({
                responsive: true,
                autoWidth: false,
                fixedColumns: true,
                columns: [
                    {
                        title: "Applicant Name",
                    },
                    {
                        title: "Firm Name",
                    },
                    {
                        title: "Project title",
                    },
                    {
                        title: "Date Submitted",
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
                        width: "20%",
                    },
                    {
                        targets: 1,
                        width: "15%",
                    },
                    {
                        targets: 2,
                        width: "30%",
                    },
                    {
                        targets: 3,
                        width: "15%",
                    },
                    {
                        targets: 4,
                        width: "8%",
                    },
                    {
                        targets: 5,
                        width: "5%",
                    },
                ],
            }); // Then initialize DataTables
            const OngoingDataTable = $("#ongoing").DataTable({
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
                        width: "20%",
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
            // Common configuration for payment history tables
            const paymentTableConfig = {
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
            };

            // Initialize separate instances
            const OngoingPaymentHistoryDataTable = $(
                "#paymentHistoryTable"
            ).DataTable(paymentTableConfig);
            const CompletedPaymentHistoryDataTable = $(
                "#CompletedpaymentTable"
            ).DataTable(paymentTableConfig);

            const populateProjectProposalContainer = (data) => {
                const ProjectProposalContainer = $("#projectProposalContainer");

                ProjectProposalContainer.find("#ProjectId").val(
                    data.proposal_data.projectID
                );
                ProjectProposalContainer.find("#ProjectTitle").val(
                    data.proposal_data.projectTitle
                );
                ProjectProposalContainer.find("#funded_Amount").val(
                    data.proposal_data.fundAmount
                );

                ProjectProposalContainer.find(
                    "#ExpectedOutputContainer"
                ).append(
                    data.proposal_data.expectedOutputs.map(
                        (item) => `<li>${item}</li>`
                    )
                );

                ProjectProposalContainer.find(
                    "#ApprovedEquipmentContainer"
                ).append(
                    data.proposal_data.equipmentDetails.map((item) => {
                        return `<tr>
                <td>${item.Qty}</td>
                <td>${item.Actual_Particulars}</td>
                <td>${item.Cost}</td>
            </tr>`;
                    })
                );

                ProjectProposalContainer.find(
                    "#ApprovedNonEquipmentContainer"
                ).append(
                    data.proposal_data.nonEquipmentDetails.map((item) => {
                        return `<tr>
                <td>${item.Qty}</td>
                <td>${item.Actual_Particulars}</td>
                <td>${item.Cost}</td>
            </tr>`;
                    })
                );
                ProjectProposalContainer.find("#To_Be_Refunded").val(
                    formatToString(parseFloat(data.To_Be_Refunded))
                );
                ProjectProposalContainer.find("#Date_FundRelease").val(
                    dateFormatter(data.proposal_data.dateOfFundRelease)
                );
                ProjectProposalContainer.find("#Applied").val(
                    dateFormatter(data.date_applied)
                );
                ProjectProposalContainer.find("#evaluated").val(
                    `${data?.prefix} ${data.f_name} ${data.mid_name} ${data.l_name} ${data?.suffix}`
                );
            };

            /**
             * Fetches a project proposal for a given business ID and project ID and updates the form fields with the response data.
             *
             * @param {number} businessId - The ID of the business.
             * @param {number} projectId - The ID of the project.
             * @return {Promise<void>} - A promise that resolves when the form fields are updated.
             */
            const getProjectProposal = async (businessId, projectId) => {
                try {
                    const response = await $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        url: PROJECT_LIST_ROUTE.GET_PROJECTS_PROPOSAL.replace(
                            ":business_id",
                            businessId
                        ).replace(":project_id", projectId),
                        type: "GET",
                        dataType: "json", // Expect a JSON response
                    });

                    populateProjectProposalContainer(response);
                } catch (error) {
                    console.log("Error: " + error);
                }
            };

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
            $("#ApprovaltableBody").on("click", ".viewApproval", function () {
                const row = $(this).closest("tr");
                const inputs = row.find("input");
                const offCanvaReadonlyInputs =
                    $("#approvalDetails").find("input");

                const cooperatorName = row.find("td:eq(0)").text().trim();
                const designation = inputs.filter(".designation").val();
                const businessId = inputs.filter(".business_id").val();
                const Project_id = inputs.filter(".Project_id").val();
                const businessAddress = inputs
                    .filter(".business_address")
                    .val();
                const typeOfEnterprise = inputs
                    .filter(".type_of_enterprise")
                    .val();
                const landline = inputs.filter(".landline").val();
                const mobilePhone = inputs.filter(".mobile_number").val();
                const email = inputs.filter(".email").val();
                const buildingAssets = parseFloat(
                    inputs.filter(".building_Assets").val()
                );
                const equipmentAssets = parseFloat(
                    inputs.filter(".equipment_Assets").val()
                );
                const workingCapitalAssets = parseFloat(
                    inputs.filter(".working_capital_Assets").val()
                );

                // Update form fields
                offCanvaReadonlyInputs
                    .filter(".cooperatorName")
                    .val(cooperatorName);
                offCanvaReadonlyInputs.filter(".designation").val(designation);
                offCanvaReadonlyInputs.filter("#b_id").val(businessId);
                offCanvaReadonlyInputs
                    .filter("#businessAddress")
                    .val(businessAddress);
                offCanvaReadonlyInputs
                    .filter("#typeOfEnterprise")
                    .val(typeOfEnterprise);
                offCanvaReadonlyInputs.filter(".landline").val(landline);
                offCanvaReadonlyInputs.filter(".mobilePhone").val(mobilePhone);
                offCanvaReadonlyInputs.filter(".emailAddress").val(email);
                offCanvaReadonlyInputs
                    .filter("#building")
                    .val(formatToString(buildingAssets));
                offCanvaReadonlyInputs
                    .filter("#equipment")
                    .val(formatToString(equipmentAssets));
                offCanvaReadonlyInputs
                    .filter("#workingCapital")
                    .val(formatToString(workingCapitalAssets));

                const staffListSelector = $("#Assigned_to");
                // Trigger additional actions
                getProjectProposal(businessId, Project_id);
                getStafflist(staffListSelector);
            });

            $("#OngoingTableBody").on(
                "click",
                ".ongoingProjectInfo",
                function () {
                    const row = $(this).closest("tr");
                    const inputs = row.find("input");
                    const readonlyInputs = $("#ongoingDetails").find("input");

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
                        .val(dateFormatter(projectDetails.date_applied));
                    readonlyInputs
                        .filter(".evaluated_by")
                        .val(projectDetails.evaluated_by);
                    readonlyInputs
                        .filter(".handle_by")
                        .val(projectDetails.handle_by);

                    getPaymentHistory(
                        projectDetails.project_id,
                        OngoingPaymentHistoryDataTable
                    );
                    const staffListSelector = $("#AssignNewStaffSelector");
                    getStafflist(staffListSelector);
                }
            );

            $("#newStaffAssignment").on("submit", async function (event) {
                event.preventDefault();
                const inConfirm = await createConfirmationModal({
                    title: "Assign New Staff",
                    titleBg: "bg-primary",
                    message: "Are you sure you want to this new staff?",
                    confirmText: "Yes",
                    confirmButtonClass: "btn-primary",
                    cancelText: "No",
                });
                if (!inConfirm) {
                    return;
                }
                showProcessToast("Assigning new staff...");
                const formdata = new FormData(this);
                formdata.append("project_id", $("#OngoingProjectID").val());
                formdata.append("business_id", $("#OngoingBusinessId").val());

                try {
                    const response = await $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        url: PROJECT_LIST_ROUTE.ASSIGNED_NEW_STAFF,
                        type: "POST",
                        data: formdata,
                        contentType: false,
                        processData: false,
                        dataType: "json", // Expect a JSON response
                    });

                    hideProcessToast();
                    showToastFeedback("text-bg-success", response.message);
                    getOngoingProjects();
                    closeModal("#assignNewStaffModal");
                } catch (error) {
                    hideProcessToast();
                    showToastFeedback(
                        "text-bg-danger",
                        error.responseJSON.message
                    );
                }
            });

            $("#CompletedTableBody").on(
                "click",
                ".completedProjectInfo",
                function () {
                    const row = $(this).closest("tr");
                    const inputs = row.find("input");
                    const readonlyInputs = $("#completedDetails").find("input");

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
                        .val(dateFormatter(projectDetails.date_applied));
                    readonlyInputs
                        .filter(".evaluated_by")
                        .val(projectDetails.evaluated_by);
                    readonlyInputs
                        .filter(".handle_by")
                        .val(projectDetails.handle_by);

                    getPaymentHistory(
                        projectDetails.project_id,
                        CompletedPaymentHistoryDataTable
                    );
                }
            );

            async function getPaymentHistory(projectId, dataTableObject) {
                try {
                    const response = await $.ajax({
                        type: "GET",
                        url:
                            PROJECT_LIST_ROUTE.GET_PAYMENT_RECORDS +
                            "?project_id=" +
                            projectId,
                    });

                    dataTableObject.clear();
                    dataTableObject.rows.add(
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
                    dataTableObject.draw();

                    let totalAmount = 0;
                    response.forEach((payment) => {
                        totalAmount += parseFloat(payment.amount);
                    });
                    //   return totalAmount;
                } catch (error) {
                    console.log(error);
                }
            }

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
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                            dataType: "json",
                        }
                    );
                    const data = await response.json();
                    selector_element.children("option:not(:first)").remove();
                    data.forEach((staff) => {
                        selector_element.append(
                            `<option value="${staff.staff_id}">${staff?.prefix} ${staff.f_name} ${staff.mid_name} ${staff.l_name} ${staff?.suffix}</option>`
                        );
                    });
                } catch (error) {
                    console.error("Error:", error);
                }
            };

            async function getforApprovalProject() {
                try {
                    const response = await fetch(
                        PROJECT_LIST_ROUTE.GET_APPROVED_PROJECTS,
                        {
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                            dataType: "json",
                        }
                    );
                    const data = await response.json();
                    ForApprovalDataTable.clear();
                    ForApprovalDataTable.rows.add(
                        data.map((project) => {
                            return [
                                `${project.prefix ? project.prefix : ""} ${
                                    project.f_name
                                } ${project.mid_name}. ${project.l_name} ${
                                    project.suffix ? project.suffix : ""
                                }
                                <input type="hidden" class="designation" value="${
                                    project.designation
                                }">
                                <input type="hidden" class="mobile_number" value="${
                                    project.mobile_number
                                }">
                                <input type="hidden" class="email" value="${
                                    project.email
                                }">
                                <input type="hidden" class="landline" value="${
                                    project.landline ?? ""
                                }">`,
                                `${project.firm_name} <input type="hidden" class="business_id" value="${project.id}">
                                <input type="hidden" class="business_address" value=" ${project.landMark} ${project.barangay}, ${project.city}, ${project.province}, ${project.region}, ${project.zip_code}">
                                <input type="hidden" class="type_of_enterprise" value="${project.enterprise_type}">
                                <input type="hidden" class="Enterpriselevel" value="${project.enterprise_level}">
                                <input type="hidden" class="building_Assets" value="${project.building_value}">
                                <input type="hidden" class="equipment_Assets" value="${project.equipment_value}">
                                <input type="hidden" class="working_capital_Assets" value="${project.working_capital}">`,
                                `${project.project_title}
                                <input type="hidden" class="Project_id" value="${project.Project_id}">
                                <input type="hidden" class="project_title" value="${project.Project_id}">
                                <input type="hidden" class="date_proposed" value="${project.evaluated_by_id}">
                                <input type="hidden" class="assigned_to" value="${project.full_name}">
                                <input type="hidden" class="application_status" value="${project.fund_amount}">`,
                                `${dateFormatter(project.date_proposed)}`,
                                `<span class="badge bg-primary">${project.application_status}</span>`,
                                `<button class="btn btn-primary viewApproval" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#approvalDetails" aria-controls="approvalDetails">
                                    <i class="ri-menu-unfold-4-line ri-1x"></i>
                                </button>`,
                            ];
                        })
                    );

                    ForApprovalDataTable.draw();
                } catch (error) {
                    console.error("Error:", error);
                }
            }
            getforApprovalProject();

            const approvedProjectProposal = async (
                businessId,
                projectId,
                assignedStaff_Id
            ) => {
                const isConfirmed = await createConfirmationModal({
                    title: "Approve Project",
                    titleBg: "bg-primary",
                    message: "Are you sure you want to approve this project?",
                    confirmText: "Yes",
                    confirmButtonClass: "btn-primary",
                    cancelText: "No",
                });
                if (!isConfirmed) {
                    return;
                }

                showProcessToast("Approving Project...");
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    url: PROJECT_LIST_ROUTE.APPROVED_PROJECT,
                    type: "POST",
                    data: {
                        business_id: businessId,
                        project_id: projectId,
                        assigned_staff_id: assignedStaff_Id,
                    },
                    success: function (response) {
                        if (response.status === "success") {
                            hideProcessToast();
                            showToastFeedback(
                                "text-bg-success",
                                response.message
                            );
                            getforApprovalProject();
                            closeOffcanvasInstances("#approvalDetails");
                        }
                    },
                    error: function (xhr, status, error) {
                        hideProcessToast();
                        showToastFeedback("text-bg-danger", error);
                    },
                });
            };

            //Submit the Approved Proposal
            $("#approvedButton").on("click", function () {
                const businessId = $("#b_id").val();
                const projectId = $("#ProjectId").val();
                const assignedStaff_Id = $("#Assigned_to").val();

                if (
                    typeof businessId !== "undefined" &&
                    typeof projectId !== "undefined" &&
                    typeof assignedStaff_Id !== "undefined"
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
                                `<button class="btn btn-primary ongoingProjectInfo" type="button" data-bs-toggle="offcanvas"
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
                        PROJECT_LIST_ROUTE.GET_COMPLETED_PROJECTS,
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

            getOngoingProjects();
            getCompletedProjects();
        },

        ApplicantList: () => {
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
                                    (item.prefix ? item.prefix : "") +
                                    " " +
                                    item.f_name +
                                    " " +
                                    (item.mid_name ? item.mid_name : "") +
                                    " " +
                                    (item.suffix ? item.suffix : "")
                                }`,
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
                    <input type="hidden" name="personnelMaleDirectRe" value="${
                        item.male_direct_re || 0
                    }">
                    <input type="hidden" name="personnelFemaleDirectRe" value="${
                        item.female_direct_re || 0
                    }">
                    <input type="hidden" name="personnelMaleDirectPart" value="${
                        item.male_direct_part || 0
                    }">
                    <input type="hidden" name="personnelFemaleDirectPart" value="${
                        item.female_direct_part || 0
                    }">
                    <input type="hidden" name="personnelMaleIndirectRe" value="${
                        item.male_indirect_re || 0
                    }">
                    <input type="hidden" name="personnelFemaleIndirectRe" value="${
                        item.female_indirect_re || 0
                    }">
                    <input type="hidden" name="personnelMaleIndirectPart" value="${
                        item.male_indirect_part || 0
                    }">
                    <input type="hidden" name="personnelFemaleIndirectPart" value="${
                        item.female_indirect_part || 0
                    }">
                    <input type="hidden" name="personnelTotal" value="${
                        item.total_personnel || 0
                    }">
                    <span class="b_address text-truncate">${item.landMark}, ${
                                    item.barangay
                                }, ${item.city}, ${item.province}, ${
                                    item.region
                                }</span><br>
                    <strong>Type of Enterprise:</strong> <span class="enterprise_type">${
                        item.enterprise_type
                    }</span>
                    <p>
                        <strong>Assets:</strong> <br>
                        <span class="ps-2 building_assets">Building: <span class="building_value">${formatToString(
                            parseFloat(item.building_value)
                        )}</span></span><br>
                        <span class="ps-2 equipment_assets">Equipment: <span class="equipment_value">${formatToString(
                            parseFloat(item.equipment_value)
                        )}</span></span> <br>
                        <span class="ps-2 working_capital_assets">Working Capital: <span class="working_capital">${formatToString(
                            parseFloat(item.working_capital)
                        )}</span></span>
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
                                ` <button class="btn btn-primary viewApplicant" type="button"
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

            $("#ApplicanttableBody").on("click", ".viewApplicant", function () {
                const row = $(this).closest("tr");
                const offCanvaReadonlyInputs =
                    $("#applicantDetails").find("input");

                const cooperatorName = row
                    .find("td:nth-child(2)")
                    .text()
                    .trim();
                const designation = row.find("td:nth-child(3)").text().trim();
                const businessId = row.find('input[name="businessID"]').val();
                const businessAddress = row.find(".b_address").text().trim();

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
                    .find(".enterprise_type")
                    .text()
                    .trim();
                const landline = row.find(".landline").text().trim();
                const mobilePhone = row.find(".mobile_num").text().trim();
                const email = row.find(".email_add").text().trim();
                const building = row.find(".building_value").text().trim();
                const equipment = row.find(".equipment_value").text().trim();
                const workingCapital = row
                    .find(".working_capital")
                    .text()
                    .trim();

                console.log(offCanvaReadonlyInputs);
                offCanvaReadonlyInputs
                    .filter(".cooperator-name")
                    .val(cooperatorName);
                offCanvaReadonlyInputs.filter(".designation").val(designation);
                offCanvaReadonlyInputs.filter(".business-id").val(businessId);
                offCanvaReadonlyInputs
                    .filter(".business-address")
                    .val(businessAddress);
                offCanvaReadonlyInputs
                    .filter(".type-of-enterprise")
                    .val(typeOfEnterprise);
                offCanvaReadonlyInputs.filter(".landline").val(landline);
                offCanvaReadonlyInputs.filter(".mobile-phone").val(mobilePhone);
                offCanvaReadonlyInputs.filter(".email").val(email);
                offCanvaReadonlyInputs.filter(".building").val(building);
                offCanvaReadonlyInputs.filter(".equipment").val(equipment);
                offCanvaReadonlyInputs
                    .filter(".working-capital")
                    .val(workingCapital);

                offCanvaReadonlyInputs
                    .filter(".personnel-male-direct-re")
                    .val(personnelMaleDirectRe);
                offCanvaReadonlyInputs
                    .filter(".personnel-female-direct-re")
                    .val(personnelFemaleDirectRe);
                offCanvaReadonlyInputs
                    .filter(".personnel-direct-re-total")
                    .val(
                        parseInt(personnelMaleDirectRe || 0) +
                            parseInt(personnelFemaleDirectRe || 0)
                    );

                offCanvaReadonlyInputs
                    .filter(".personnel-male-direct-part")
                    .val(personnelMaleDirectPart);
                offCanvaReadonlyInputs
                    .filter(".personnel-female-direct-part")
                    .val(personnelFemaleDirectPart);
                offCanvaReadonlyInputs
                    .filter(".personnel-direct-part-total")
                    .val(
                        parseInt(personnelMaleDirectPart || 0) +
                            parseInt(personnelFemaleDirectPart || 0)
                    );

                offCanvaReadonlyInputs
                    .filter(".personnel-male-indirect-re")
                    .val(personnelMaleIndirectRe);
                offCanvaReadonlyInputs
                    .filter(".personnel-female-indirect-re")
                    .val(personnelFemaleIndirectRe);
                offCanvaReadonlyInputs
                    .filter(".personnel-indirect-re-total")
                    .val(
                        parseInt(personnelMaleIndirectRe || 0) +
                            parseInt(personnelFemaleIndirectRe || 0)
                    );

                offCanvaReadonlyInputs
                    .filter(".personnel-male-indirect-part")
                    .val(personnelMaleIndirectPart);
                offCanvaReadonlyInputs
                    .filter(".personnel-female-indirect-part")
                    .val(personnelFemaleIndirectPart);
                offCanvaReadonlyInputs
                    .filter(".personnel-indirect-part-total")
                    .val(
                        parseInt(personnelMaleIndirectPart || 0) +
                            parseInt(personnelFemaleIndirectPart || 0)
                    );

                offCanvaReadonlyInputs
                    .filter(".personnel-total")
                    .val(personnelTotal);
            });
        },

        Users: () => {
            $("#user_staff").DataTable({
                autoWidth: false,
                responsive: true,
                columns: [
                    { title: "#" },
                    { title: "Name" },
                    { title: "Email" },
                    { title: "Username" },
                    { title: "Access Status" },
                    { title: "Action" },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        width: "5%",
                        className: "text-center",
                    },
                    {
                        targets: 1,
                        width: "30%",
                    },
                    {
                        targets: 2,
                        width: "20%",
                    },
                    {
                        targets: 3,
                        width: "20%",
                    },
                    {
                        targets: 4,
                        width: "15%",
                    },
                    {
                        targets: 5,
                        width: "10%",
                    },
                ],
            });

            const getStaffUserLists = async () => {
                try {
                    const response = await $.ajax({
                        type: "GET",
                        url: USERS_LIST_ROUTE.GET_STAFF_USER_LISTS,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });

                    const staffUserTable = $("#user_staff").DataTable();

                    staffUserTable.clear();

                    staffUserTable.rows.add(
                        response.map((staff) => [
                            staff.id,
                            `${staff?.prefix || ""} ${staff.f_name || ""} ${
                                staff?.mid_name || ""
                            } ${staff.l_name || ""} ${staff?.suffix || ""}`,
                            staff.email,
                            staff.user_name,
                            `<span class="badge ${
                                staff.access_to === "Restricted"
                                    ? "bg-danger"
                                    : "bg-success"
                            }">${staff.access_to}</span>`,
                            ` <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#viewUserOffcanvas" aria-controls="viewUserOffcanvas">
                                    <i class="ri-eye-fill"></i>
                                </button>
                <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#UpdateAndDeleteResourcesModal" data-option-type="updateUser">
                <i class="ri-pencil-fill"></i>
                </button>
                <button class="btn btn-danger btn-sm"
                data-bs-toggle="modal" data-bs-target="#UpdateAndDeleteResourcesModal" data-option-type="deleteUser"
                type="button">
                <i class="ri-delete-bin-6-fill"></i>
                </button>`,
                        ])
                    );

                    staffUserTable.draw();
                } catch (error) {
                    showToastFeedback(
                        "text-bg-danger",
                        error.responseJSON.message
                    );
                }
            };

            getStaffUserLists();

            (() => {
                "use strict";

                // Fetch all forms that need validation
                const NewUsersForms =
                    document.querySelectorAll(".needs-validation");

                // Attach form validation and submission to the submit button click event
                $("#newUserForm").on("submit", async function (event) {
                    // Prevent default button action
                    event.preventDefault();

                    // Loop through each form with 'needs-validation'
                    Array.from(NewUsersForms).forEach(async (form) => {
                        // Check if the form is valid
                        if (!form.checkValidity()) {
                            event.stopPropagation();
                            form.classList.add("was-validated");
                        } else {
                            // If valid, trigger the AJAX form submission
                            const isConfirmed = await createConfirmationModal({
                                title: "Add New Organization User",
                                titleBg: "bg-primary",
                                message:
                                    "Are you sure you want to add this user?",
                                confirmText: "Yes",
                                confirmButtonClass: "btn-primary",
                                cancelText: "No",
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
                    showProcessToast("Adding Staff User...");
                    // Create FormData object from the form element
                    const formData = new FormData(form);

                    const response = await $.ajax({
                        type: "POST",
                        url: USERS_LIST_ROUTE.GET_STAFF_USER_LISTS,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        processData: false, // Don't process the data
                        contentType: false, // Let jQuery set the content type based on formData
                        data: formData,
                    });
                    getStaffUserLists();
                    hideProcessToast();
                    closeModal("#AddUserModal");
                    showToastFeedback("text-bg-success", response.success);
                } catch (error) {
                    hideProcessToast();
                    showToastFeedback(
                        "text-bg-danger",
                        error.responseJSON.message
                    );
                }
            };

            const updateStaffUser = async (user_name) => {
                try {
                    const isConfirmed = await createConfirmationModal({
                        title: "Update Access Status",
                        titleBg: "bg-primary",
                        message:
                            "Are you sure you want to update the access status?",
                        confirmText: "Yes",
                        confirmButtonClass: "btn-primary",
                        cancelText: "No",
                    });
                    if (!isConfirmed) {
                        return;
                    }
                    showProcessToast("Updating Access Status...");
                    const toggleStaffAccess = $("#toggleStaffAccess").prop(
                        "checked"
                    )
                        ? "Allowed"
                        : "Restricted";
                    const response = await $.ajax({
                        type: "PUT",
                        url: USERS_LIST_ROUTE.UPDATE_STAFF_USER.replace(
                            ":user_name",
                            user_name
                        ),
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        data: {
                            access_to: toggleStaffAccess,
                        },
                    });
                    getStaffUserLists();
                    hideProcessToast();
                    showToastFeedback("text-bg-success", response.success);
                } catch (error) {
                    hideProcessToast();
                    showToastFeedback(
                        "text-bg-danger",
                        error.responseJSON.message
                    );
                }
            };

            const deleteStaffUser = async (user_name) => {
                try {
                    const isConfirmed = await createConfirmationModal({
                        title: "Delete User",
                        titleBg: "bg-danger",
                        message:
                            "Are you sure you want to delete this user their might still projects handled by this user?",
                        confirmText: "Yes",
                        confirmButtonClass: "btn-danger",
                        cancelText: "No",
                    });
                    if (!isConfirmed) {
                        return;
                    }
                    showProcessToast("Deleting User...");
                    const response = await $.ajax({
                        type: "DELETE",
                        url: USERS_LIST_ROUTE.DELETE_STAFF_USER.replace(
                            ":user_name",
                            user_name
                        ),
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });
                    getStaffUserLists();
                    hideProcessToast();
                    showToastFeedback("text-bg-success", response.success);
                } catch (error) {
                    hideProcessToast();
                    showToastFeedback(
                        "text-bg-danger",
                        error.responseJSON.message
                    );
                }
            };

            $("#UpdateAndDeleteResourcesModal").on(
                "show.bs.modal",
                function (e) {
                    const triggerdButton = $(e.relatedTarget);
                    const buttonRow = triggerdButton.closest("tr");
                    const optionType = triggerdButton.data("option-type");

                    // Cache DOM elements
                    const accessTo = buttonRow
                        .find("td:nth-child(5)")
                        .text()
                        .trim();
                    const staffName = buttonRow
                        .find("td:nth-child(2)")
                        .text()
                        .trim();
                    const userName = buttonRow
                        .find("td:nth-child(4)")
                        .text()
                        .trim();
                    const modal = $(this);
                    const modalHeader = modal.find(".modal-header");
                    const modalTitle = modal.find(".modal-title");
                    const modalBody = modal.find(".modal-body");
                    const modalActionButton = modal.find("#actionToPerform");

                    modalActionButton
                        .removeData("action-type")
                        .removeData("unique-val");

                    // Update modal content
                    const modalHeaderContent =
                        optionType === "updateUser"
                            ? "Update User"
                            : "Delete User";

                    modalHeader
                        .removeClass("bg-danger bg-primary")
                        .addClass(
                            optionType === "deleteUser"
                                ? "bg-danger"
                                : "bg-primary"
                        );

                    modalTitle.text(modalHeaderContent);

                    const modalBodyContent =
                        optionType === "updateUser"
                            ? `<div class="form-check form-switch">
               <input class="form-check-input" type="checkbox" role="switch" id="toggleStaffAccess">
               <label class="form-check-label" for="toogleStaffAccess">Are you sure you want to update Access for this user <strong>${sanitize(
                   staffName
               )}?</strong></label>
             </div>`
                            : `<p>Are you sure you want to delete <strong>${sanitize(
                                  staffName
                              )}?</strong></p>`;

                    modalBody.html(modalBodyContent);

                    // Set toggle switch state
                    modal
                        .find("#toggleStaffAccess")
                        .prop("checked", accessTo === "Restricted");

                    // Update action button
                    modalActionButton
                        .removeClass("btn-danger btn-primary")
                        .addClass(
                            optionType === "deleteUser"
                                ? "btn-danger"
                                : "btn-primary"
                        )
                        .text(optionType === "deleteUser" ? "Delete" : "Update")
                        .attr("data-action-type", optionType)
                        .attr("data-unique-val", userName);

                    modalActionButton.off("click").on("click", function () {
                        const optionType = $(this).data("action-type");
                        const uniqueVal = $(this).data("unique-val");

                        if (optionType === "updateUser") {
                            updateStaffUser(uniqueVal);
                        } else if (optionType === "deleteUser") {
                            deleteStaffUser(uniqueVal);
                        }
                    });
                }
            );

            // Helper function for sanitization

            $("#viewUserOffcanvas").on("show.bs.offcanvas", function (e) {
                const triggerdButton = $(e.relatedTarget);
                const buttonRow = triggerdButton.closest("tr");
                const StaffName = buttonRow
                    .find("td:nth-child(2)")
                    .text()
                    .trim();
                const Email = buttonRow.find("td:nth-child(3)").text().trim();
                const UserName = buttonRow
                    .find("td:nth-child(4)")
                    .text()
                    .trim();

                const offcanvas = $(this);

                offcanvas.find("#StaffName").text(StaffName);
            });
        },
    };
    return functions;
};
