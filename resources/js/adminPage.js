import './echo'
import Notification from './Notification';
import NotificationContainer from './NotificationContainer';


Echo.private('admin-notifications')
    .listen('.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', (e) => {
        try {

            console.log('Raw event:', e);

            // The data might be directly in the event object, not in e.data
            const NotificationData = e;

            if (!NotificationData) {
                throw new Error('Notification data is undefined');
            }

            NotificationContainer(NotificationData);


        } catch (error) {
            console.error('Error parsing notification data:', error);
            console.log('Raw data:', e.data);
        }



    });

    Notification();

function showToastFeedback(status, message) {
  const toast = $('#ActionFeedbackToast');
  const toastInstance = new bootstrap.Toast(toast);

  toast
    .find('.toast-header')
    .removeClass([
      'text-bg-danger',
      'text-bg-success',
      'text-bg-warning',
      'text-bg-info',
      'text-bg-primary',
      'text-bg-light',
      'text-bg-dark',
    ]);

  toast.find('.toast-body').text('');
  toast.find('.toast-header').addClass(status);
  toast.find('.toast-body').text(message);

  toastInstance.show();
}

function sanitize(input) {
  return $('<div>').text(input).html(); // Escape special characters
}

//close offcanvas
function closeOffcanvasInstances(offcanva_id) {
  const offcanvasElement = $(offcanva_id).get(0);
  const offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasElement);
  offcanvasInstance.hide();
}

function closeModal(modelId) {
  const model = bootstrap.Modal.getInstance(modelId);
  model.hide();
}

/**
 * Formats a number value to a string with a fixed number of decimal places.
 *
 * @param {number} value - The number to be formatted.
 * @returns {string} The formatted number as a string with exactly 2 decimal places.
 */
const formatToString = (value) => {
    return value.toLocaleString('en-US', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2,
    });
  };

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
        let applicants = Array(12).fill(null);
        let ongoing = Array(12).fill(null);
        let completed = Array(12).fill(null);

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

        await Promise.all(
          Object.keys(monthlyData).map(async (month) => {
            const data = monthlyData[month];

            // Assuming 'month' matches 'Sep', 'Oct' etc.
            const monthIndex = months.indexOf(month.slice(0, 3));

            // For each series, push the respective data

            if (monthIndex !== -1) {
              // Update the arrays for the respective data
              applicants[monthIndex] = data.Applicants || null;
              ongoing[monthIndex] = data.Ongoing || null;
              completed[monthIndex] = data.Completed || null;
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
            microCounts.push(localData[city]['Micro Enterprise']);
            smallCounts.push(localData[city]['Small Enterprise']);
            mediumCounts.push(localData[city]['Medium Enterprise']);
          }
        }

        let totalMicro = microCounts.reduce((a, b) => a + b, 0);
        let totalSmall = smallCounts.reduce((a, b) => a + b, 0);
        let totalMedium = mediumCounts.reduce((a, b) => a + b, 0);

        return Promise.all([
          createLocalDataChart(cities, microCounts, smallCounts, mediumCounts),
          createEnterpriseLevels(totalMicro, totalSmall, totalMedium),
        ]);
      };

      const processHandleStaffProjectChart = async (handleProject) => {

        const staffNames = handleProject.map(item => item.Staff_Name);
        const microEnterprisData = handleProject
        .map(item => item['Micro Enterprise']);
        const smallEnterpriseData = handleProject
        .map(item => item['Small Enterprise']);
        const mediumEnterpriseData = handleProject
        .map(item => item['Medium Enterprise']);
        return Promise.all([
            createhandledProjectsChart(staffNames, microEnterprisData, smallEnterpriseData, mediumEnterpriseData),
        ]);

      }

      /**
       * Creates a monthly data chart with the provided applicants, ongoing, and completed data.
       *
       * @param {number[]} applicants - An array of applicant data for each month.
       * @param {number[]} ongoing - An array of ongoing data for each month.
       * @param {number[]} completed - An array of completed data for each month.
       * @return {Promise<void>} A promise that resolves when the chart is rendered.
       */
      const createMonthlyDataChart = async (applicants, ongoing, completed) => {
        const overallProject = {
          theme: {
            mode: 'light',
          },
          series: [
            {
              name: 'Applicants',
              data: applicants,
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
                opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] +
                ''
              );
            },
          },
        };
        return new Promise((resolve) => {
          const overallProjectGraph = new ApexCharts(
            document.querySelector('#overallProjectGraph'),
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
      const createLocalDataChart = async (
        cities,
        microCounts,
        smallCounts,
        mediumCounts
      ) => {
        const options = {
          chart: {
            type: 'bar',
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
              name: 'Micro Enterprises',
              data: microCounts,
            },
            {
              name: 'Small Enterprises',
              data: smallCounts,
            },
            {
              name: 'Medium Enterprises',
              data: mediumCounts,
            },
          ],
          dataLabels: {
            enabled: false,
          },
          yaxis: {
            title: {
              text: 'Count',
            },
          },
          xaxis: {
            labels: {
              show: false,
            },
            tickPlacement: 'on',
            type: 'category',
            categories: cities,
            title: {
              text: 'Cities',
            },
            Tooltip: {
              enabled: true,
              formatter: function (val, opts) {
                return opts.w.globals.labels[opts.dataPointIndex];
              },
            },
          },
          title: {
            text: 'Number of Micro, Small, and Medium Enterprises by City',
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
          const chart = new ApexCharts(
            document.querySelector('#localeChart'),
            options
          );
          chart.render();
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
            mode: 'light',
            palette: 'palette2',
          },
          series: [totalMicro, totalSmall, totalMedium],
          labels: ['Micro Enterprise', 'Small Enterprise', 'Medium Enterprise'],
          chart: {
            width: 300,
            type: 'pie',
          },
          legend: {
            show: false,
          },
          responsive: [
            {
              breakpoint: 480,
              options: {
                chart: {
                  width: 200,
                },
                legend: {
                  position: 'bottom',
                },
              },
            },
          ],
        };

        return new Promise((resolve) => {
          const pieChart = new ApexCharts(
            document.querySelector('#enterpriseLevelChart'),
            EnterpriseLevelOptions
          );
          pieChart.render();
          resolve();
        });
      };
      const createhandledProjectsChart = async (staffNames, microEnterprisData, smallEnterpriseData, mediumEnterpriseData) => {
        const handledBusiness = {
          theme: {
            mode: 'light',
          },
          series: [
            {
              name: 'Micro Enterprise',
              data: microEnterprisData,
            },
            {
              name: 'Small Enterprise',
              data: smallEnterpriseData,
            },
            {
              name: 'Medium Enterprise',
              data: mediumEnterpriseData,
            },
          ],
          chart: {
            height: 350,
            type: 'bar',
            stacked: true,
            events: {
              click: function (chart, w, e) {
                // console.log(chart, w, e)
              },
            },
          },
          colors: ['#008ffb', '#00e396', '#feb019'],
          plotOptions: {
            bar: {
              columnWidth: '45%',
              distributed: false,
              borderRadius: 10,
              borderRadiusApplication: 'end',
              borderRadiusWhenStacked: 'last',
            },
          },
          dataLabels: {
            enabled: false,
          },
          legend: {
            show: true,
            position: 'bottom',
          },
          xaxis: {
            categories: staffNames,
            labels: {
              style: {
                colors: ['#111111'],
                fontSize: '12px',
              },
            },
          },
        };
        return new Promise((resolve) => {
          new ApexCharts(
            document.querySelector('#staffHandledB'),
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
            type: 'GET',
            url: DASHBOARD_ROUTE.GET_DASHBOARD_CHARTS_DATA,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
          });

          // Parse the JSON response if it's a string
          const monthlyData = await JSON.parse(response.monthlyData[0]);
          const localData = await JSON.parse(response.localData); // Assumes it's a valid JSON string
          const handleProject = await response.staffhandledProjects;
          return Promise.all([
            processMonthlyDataChart(monthlyData),
            processLocalDataChart(localData),
            processHandleStaffProjectChart(handleProject),
          ]);
        } catch (error) {
          console.error('Error fetching chart data:', error);
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
      $('#forApproval').DataTable({
        columnDefs: [
          {
            targets: 2,
            width: '30%',
          },
          {
            targets: 3,
            width: '15%',
          },
          {
            targets: 4,
            width: '8%',
          },
          {
            targets: 5,
            width: '5%',
          },
        ],
      }); // Then initialize DataTables
      $('#ongoing').DataTable({
        responsive: true,
        autoWidth: false,
        fixedColumns: true,
        columns: [
          {
            title: 'Project #',
          },
          {
            title: 'Project Title',
          },
          {
            title: 'Firm',
          },
          {
            title: 'Cooperator Name',
          },
          {
            title: 'Progress',
          },
          {
            title: 'Action',
          },
        ],
        columnDefs: [
          {
            targets: 0,
            width: '15%',
            className: 'text-center',
          },
          {
            targets: 1,
            width: '30%',
          },
          {
            targets: 2,
            width: '15%',
          },
          {
            targets: 3,
            width: '20%',
          },
          {
            targets: 4,
            width: '20%',
            className: 'text-end',
          },
          {
            targets: 5,
            width: '10%',
            orderable: false,
            className: 'text-center',
          },
        ],
      });
      $('#completedTable').DataTable({
        responsive: true,
        autoWidth: false,
        fixedColumns: true,
        columns: [
          {
            title: 'Project #',
          },
          {
            title: 'Project Title',
          },
          {
            title: 'Firm',
          },
          {
            title: 'Cooperator Name',
          },
          {
            title: 'Progress',
          },
          {
            title: 'Action',
          },
        ],
        columnDefs: [
          {
            targets: 0,
            width: '15%',
            className: 'text-center',
          },
          {
            targets: 1,
            width: '30%',
          },
          {
            targets: 2,
            width: '15%',
          },
          {
            targets: 3,
            width: '20%',
          },
          {
            targets: 4,
            width: '30%',
            className: 'text-end'
          },
          {
            targets: 5,
            width: '10%',
            orderable: false,
            className: 'text-center',
          },
        ],
      });
      $('#paymentHistoryTable').DataTable({
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
      });

      /**
       * Fetches a project proposal for a given business ID and updates the form fields with the response data.
       *
       * @param {number} businessId - The ID of the business.
       * @return {Promise<void>} - A promise that resolves when the form fields are updated.
       */
      const getProjectProposal = async (businessId) => {
        try {
          const response = await $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: PROJECT_LIST_ROUTE.GET_PROJECTS_PROPOSAL,
            type: 'POST',
            data: {
              business_id: businessId,
            },
            dataType: 'json', // Expect a JSON response
          });
          console.log(response);
          $('#ProjectId_fetch').val(response.Project_id);
          $('#ProjectTitle_fetch').val(response.project_title);
          $('#Amount_fetch').val(
            parseFloat(response.fund_amount).toLocaleString('en-US', {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2,
            })
          );
          $('#Applied_fetch').val(response.date_applied);
          $('#evaluated_fetch').val(
            `${response?.prefix} ${response.f_name} ${response.mid_name} ${response.l_name} ${response?.suffix}`
          );
        } catch (error) {
          $('#ProjectTitle_fetch').val('');
          $('#Amount_fetch').val('');
          $('#Applied_fetch').val('');
          $('#evaluated_fetch').val('');
          console.log('Error: ' + error);
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
      $('#ApprovaltableBody').on('click', '.viewApproval', function () {
        const row = $(this).closest('tr');
        const inputs = row.find('input');

        const formatCurrency = (value) => {
          return parseFloat(value.replace(/,/g, '')).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          });
        };

        // Cache the input values
        const cooperatorName = row.find('td:eq(0)').text().trim();
        const designation = inputs.filter('.designation').val();
        const businessId = inputs.filter('.business_id').val();
        const businessAddress = inputs.filter('.business_address').val();
        const typeOfEnterprise = inputs.filter('.type_of_enterprise').val();
        const landline = inputs.filter('.landline').val();
        const mobilePhone = inputs.filter('.mobile_number').val();
        const email = inputs.filter('.email').val();
        const buildingAssets = inputs.filter('.building_Assets').val();
        const equipmentAssets = inputs.filter('.equipment_Assets').val();
        const workingCapitalAssets = inputs
          .filter('.working_capital_Assets')
          .val();

        // Update form fields
        $('#cooperatorName').val(cooperatorName);
        $('#designation').val(designation);
        $('#b_id').val(businessId);
        $('#businessAddress').val(businessAddress);
        $('#typeOfEnterprise').val(typeOfEnterprise);
        $('#landline').val(landline);
        $('#mobilePhone').val(mobilePhone);
        $('#email').val(email);
        $('#building').val(formatCurrency(buildingAssets));
        $('#equipment').val(formatCurrency(equipmentAssets));
        $('#workingCapital').val(formatCurrency(workingCapitalAssets));

        // Trigger additional actions
        getProjectProposal(businessId);
        getStafflist();
      });

      $('#OngoingTableBody').on('click', '.ongoingProjectInfo', function () {
        const row = $(this).closest('tr');
        const inputs = row.find('input');
        const readonlyInputs = $('#ongoingDetails').find('input');

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
          enterprise_type: inputs.filter('.enterprise_type').val(),
          enterprise_level: inputs.filter('.enterprise_level').val(),
          building_assets: parseFloat(inputs.filter('.building_assets').val()),
          equipment_assets: parseFloat(inputs.filter('.equipment_assets').val()),
          working_capital_assets: parseFloat(inputs.filter('.working_capital_assets').val()),
        };

        const projectDetails = {
          project_id: inputs.filter('.project_id').val(),
          project_title: row.find('td:nth-child(2)').text().trim(),
          project_fund_amount: parseFloat(inputs.filter('.project_fund_amount').val()),
          project_amount_to_be_refunded: parseFloat(inputs.filter('.amount_to_be_refunded').val()),
          project_refunded_amount: parseFloat(inputs.filter('.amount_refunded').val()),
          date_applied: inputs.filter('.date_applied').val(),
          project_date_approved: inputs.filter('.date_approved').val(),
          evaluated_by: inputs.filter('.evaluated_by').val(),
          handle_by: inputs.filter('.handled_by').val(),
        };


        readonlyInputs.filter('.cooperatorName').val(personalDetails.cooperName);
        readonlyInputs.filter('.designation').val(personalDetails.designaition);
        readonlyInputs.filter('.mobile_number').val(personalDetails.mobile_number);
        readonlyInputs.filter('.email').val(personalDetails.email);
        readonlyInputs.filter('.landline').val(personalDetails.landline);

        readonlyInputs.filter('.b_id').val(businessDetails.business_id);
        readonlyInputs.filter('.firmName').val(businessDetails.firmName);
        readonlyInputs.filter('.businessAddress').val(businessDetails.address);
        readonlyInputs.filter('.typeOfEnterprise').val(businessDetails.enterprise_type);
        readonlyInputs.filter('.enterpriseLevel').val(businessDetails.enterprise_level);
        readonlyInputs.filter('.building').val(formatToString(businessDetails.building_assets));
        readonlyInputs.filter('.equipment').val(formatToString(businessDetails.equipment_assets));
        readonlyInputs.filter('.workingCapital').val(formatToString(businessDetails.working_capital_assets));

        readonlyInputs.filter('.ProjectId').val(projectDetails.project_id);
        readonlyInputs.filter('.ProjectTitle').val(projectDetails.project_title);
        readonlyInputs.filter('.funded_amount').val(formatToString(projectDetails.project_fund_amount));
        readonlyInputs.filter('.amount_to_be_refunded').val(formatToString(projectDetails.project_amount_to_be_refunded));
        readonlyInputs.filter('.refunded').val(formatToString(projectDetails.project_refunded_amount));
        readonlyInputs.filter('.date_applied').val(projectDetails.date_applied);
        readonlyInputs.filter('.evaluated_by').val(projectDetails.evaluated_by);
        readonlyInputs.filter('.handle_by').val(projectDetails.handle_by);

        getPaymentHistory(projectDetails.project_id);
      });

      $('#CompletedTableBody').on('click', '.completedProjectInfo', function() {
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
          enterprise_type: inputs.filter('.enterprise_type').val(),
          enterprise_level: inputs.filter('.enterprise_level').val(),
          building_assets: parseFloat(inputs.filter('.building_assets').val()),
          equipment_assets: parseFloat(
            inputs.filter('.equipment_assets').val()
          ),
          working_capital_assets: parseFloat(
            inputs.filter('.working_capital_assets').val()
          ),
        };

        const projectDetails = {
          project_id: inputs.filter('.project_id').val(),
          project_title: row.find('td:nth-child(2)').text().trim(),
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
          project_date_approved: inputs.filter('.date_approved').val(),
          evaluated_by: inputs.filter('.evaluated_by').val(),
          handle_by: inputs.filter('.handle_by').val(),
        };

        readonlyInputs
        .filter('.cooperatorName')
        .val(personalDetails.cooperName);
      readonlyInputs.filter('.designation').val(personalDetails.designaition);
      readonlyInputs
        .filter('.mobile_number')
        .val(personalDetails.mobile_number);
      readonlyInputs.filter('.email').val(personalDetails.email);
      readonlyInputs.filter('.landline').val(personalDetails.landline);

      readonlyInputs.filter('.b_id').val(businessDetails.business_id);
      readonlyInputs.filter('.firmName').val(businessDetails.firmName);
      readonlyInputs.filter('.businessAddress').val(businessDetails.address);
      readonlyInputs
        .filter('.typeOfEnterprise')
        .val(businessDetails.enterprise_type);
      readonlyInputs
        .filter('.enterpriseLevel')
        .val(businessDetails.enterprise_level);
      readonlyInputs
        .filter('.building')
        .val(formatToString(businessDetails.building_assets));
      readonlyInputs
        .filter('.equipment')
        .val(formatToString(businessDetails.equipment_assets));
      readonlyInputs
        .filter('.workingCapital')
        .val(formatToString(businessDetails.working_capital_assets));

      readonlyInputs.filter('.ProjectId').val(projectDetails.project_id);
      readonlyInputs
        .filter('.ProjectTitle')
        .val(projectDetails.project_title);
      readonlyInputs
        .filter('.funded_amount')
        .val(formatToString(projectDetails.project_fund_amount));
      readonlyInputs
        .filter('.amount_to_be_refunded')
        .val(formatToString(projectDetails.project_amount_to_be_refunded));
      readonlyInputs
        .filter('.refunded')
        .val(formatToString(projectDetails.project_refunded_amount));
      readonlyInputs.filter('.date_applied').val(projectDetails.date_applied);
      readonlyInputs.filter('.evaluated_by').val(projectDetails.evaluated_by);
      readonlyInputs.filter('.handle_by').val(projectDetails.handle_by);

      })

       // TODO: Add Js docs and reuse the data formatter object
       async function getPaymentHistory(projectId) {
        try {
          const response = await $.ajax({
            type: 'GET',
            url:
            PROJECT_LIST_ROUTE.GET_PAYMENT_RECORDS +
              '?project_id=' +
              projectId,
          });

          const paymentHistoryTable = $('#paymentHistoryTable').DataTable();
          paymentHistoryTable.clear();
          paymentHistoryTable.rows.add(
            response.map((payment) => {
                const createdAtDate = new Date(payment.created_at);
                const formattedDate = createdAtDate.toLocaleString('en-US', {
                  month: '2-digit',
                  day: '2-digit',
                  year: '2-digit',
                  hour: '2-digit',
                  minute: '2-digit',
                  hour12: true
                });
                return [
                  payment.transaction_id,
                  formatToString(parseFloat(payment.amount)),
                  payment.payment_method,
                  payment.payment_status,
                  formattedDate
                ];
              })
          );
          paymentHistoryTable.draw();

          let totalAmount = 0;
          response.forEach((payment) => {
            totalAmount += parseFloat(payment.amount);
          });
        //   return totalAmount;
        } catch (error) {
          console.log(error)
        }
      }

      /**
       * Retrieves a list of staff members and populates the Assigned_to dropdown.
       *
       * @return {void}
       */
      const getStafflist = async () => {
        try {
          const response = await fetch(PROJECT_LIST_ROUTE.GET_STAFFLIST, {
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            dataType: 'json',
          });
          const data = await response.json();
          const staffList = $('#Assigned_to');
          staffList.empty();
          data.forEach((staff) => {
            staffList.append(
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
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
              },
              dataType: 'json',
            }
          );
          const data = await response.json();
          let table = $('#forApproval').DataTable();
          table.clear().draw();
          data.forEach((project) => {
            table.row
              .add([
                `${project.f_name} ${project.mid_name}. ${project.l_name} ${
                  project.suffix
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
                              project.landline ?? ''
                            }">`,
                `${project.firm_name} <input type="hidden" class="business_id" value="${project.id}">
                            <input type="hidden" class="business_address" value=" ${project.landMark} ${project.barangay}, ${project.city}, ${project.province}, ${project.region}, ${project.zip_code}">
                            <input type="hidden" class="type_of_enterprise" value="${project.enterprise_type}">
                            <input type="hidden" class="Enterpriselevel" value="${project.enterprise_level}">
                            <input type="hidden" class="building_Assets" value="${project.building_value}">
                            <input type="hidden" class="equipment_Assets" value="${project.equipment_value}">
                            <input type="hidden" class="working_capital_Assets" value="${project.working_capital}">`,
                `${project.project_title}
                            <input type="hidden" class="project_title" value="${project.Project_id}">
                            <input type="hidden" class="date_proposed" value="${project.evaluated_by_id}">
                            <input type="hidden" class="assigned_to" value="${project.full_name}">
                            <input type="hidden" class="application_status" value="${project.fund_amount}">`,
                `${project.date_proposed}`,
                `<span class="badge bg-primary">${project.application_status}</span>`,
                `<button class="btn btn-primary viewApproval" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#approvalDetails" aria-controls="approvalDetails">
                                <i class="ri-menu-unfold-4-line ri-1x"></i>
                            </button>`,
              ])
              .draw(false);
          });
        } catch (error) {
          console.error('Error:', error);
        }
      }
      getforApprovalProject();

      const approvedProjectProposal = async (
        businessId,
        projectId,
        assignedStaff_Id
      ) => {
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
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
                showToastFeedback('text-bg-success', response.message);
                getforApprovalProject();
                closeOffcanvasInstances('#approvalDetails');
            }
          },
          error: function (xhr, status, error) {
            showToastFeedback('text-bg-danger', error);
          },
        });
      };

      //Submit the Approved Proposal
      $('#approvedButton').on('click', function () {
        const businessId = $('#b_id').val();
        const projectId = $('#ProjectId_fetch').val();
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
          const response = await fetch(PROJECT_LIST_ROUTE.GET_ONGOING_PROJECTS, {
            method: 'GET',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            dataType: 'json',
          });
          const data = await response.json();
          console.log(data);
          const OngoingDatatable = $('#ongoing').DataTable();
          OngoingDatatable.clear().draw();
          data.forEach((Ongoing) => {
            const fund_amount = parseFloat(Ongoing.fund_amount);
            const amount_refunded = parseFloat(Ongoing.amount_refunded);
            const to_be_refunded = parseFloat(Ongoing.to_be_refunded);

            const percentage = Math.ceil((amount_refunded / to_be_refunded) * 100);
            OngoingDatatable.row
              .add([
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
                      ' ' +
                      Ongoing.evaluated_by_f_name +
                      ' ' +
                      Ongoing?.evaluated_by_mid_name +
                      ' ' +
                      Ongoing.evaluated_by_l_name +
                      ' ' +
                      Ongoing?.evaluated_by_suffix
                    }">
                    <input type="hidden" class="handled_by" value="${
                      Ongoing?.handled_by_prefix +
                      ' ' +
                      Ongoing.handled_by_f_name +
                      ' ' +
                      Ongoing?.handled_by_mid_name +
                      ' ' +
                      Ongoing.handled_by_l_name +
                      ' ' +
                      Ongoing?.handled_by_suffix
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
                    <input type="hidden" class="email" value="${Ongoing.email}">
                    <input type="hidden" class="landline" value="${
                      Ongoing.landline ?? ''
                    }">`,
                `${
                  formatToString(amount_refunded) +
                  ' / ' +
                  formatToString(to_be_refunded)
                } <span class="badge text-white bg-primary">${percentage}%</span>`,
                `<button class="btn btn-primary ongoingProjectInfo" type="button" data-bs-toggle="offcanvas"
                                                data-bs-target="#ongoingDetails" aria-controls="ongoingDetails">
                                                <i class="ri-menu-unfold-4-line ri-1x"></i>
                    </button>`,
              ])
              .draw();
          });
        } catch (error) {
          console.error('Error:', error);
        }
      }

      async function getCompletedProjects() {
        try {
            const response = await fetch(PROJECT_LIST_ROUTE.GET_COMPLETED_PROJECTS, {
                method: 'GET',
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                dataType: 'json',
              });
              const data = await response.json();
              const completedDatatable = $('#completedTable').DataTable();
              completedDatatable.clear().draw();
              data.forEach((completed) => {
                const fund_amount = parseFloat(completed.fund_amount);
                const amount_refunded = parseFloat(completed.amount_refunded);
                const to_be_refunded = parseFloat(completed.to_be_refunded);

                const percentage = Math.ceil(
                  (amount_refunded / to_be_refunded) * 100
                );
                completedDatatable.row
                  .add([
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
                          ' ' +
                          completed.evaluated_by_f_name +
                          ' ' +
                          completed?.evaluated_by_mid_name +
                          ' ' +
                          completed.evaluated_by_l_name +
                          ' ' +
                          completed?.evaluated_by_suffix
                        }">
                        <input type="hidden" class="handled_by" value="${
                          completed?.handled_by_prefix +
                          ' ' +
                          completed.handled_by_f_name +
                          ' ' +
                          completed?.handled_by_mid_name +
                          ' ' +
                          completed.handled_by_l_name +
                          ' ' +
                          completed?.handled_by_suffix
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
                        <input type="hidden" class="email" value="${completed.email}">
                        <input type="hidden" class="landline" value="${
                          completed.landline ?? ''
                        }">`,
                    `${
                      formatToString(amount_refunded) +
                      ' / ' +
                      formatToString(to_be_refunded)
                    } <span class="badge text-white bg-primary">${percentage}%</span>`,
                    `<button class="btn btn-primary completedProjectInfo" type="button" data-bs-toggle="offcanvas"
                                                data-bs-target="#completedDetails" aria-controls="completedDetails">
                                                <i class="ri-menu-unfold-4-line ri-1x"></i>
                                            </button>`,
                  ])
                  .draw();
              });
        }catch(error){
            console.error('Error:', error);

        }
      }

      getOngoingProjects();
      getCompletedProjects();
    },


    ApplicantList: () => {
      $('#applicant').DataTable();

      $('#ApplicanttableBody').on('click', '.viewApplicant', function () {
        const row = $(this).closest('tr');

        const cooperatorName = row.find('td:nth-child(2)').text().trim();
        const designation = row.find('td:nth-child(3)').text().trim();
        const businessId = row.find('#business_id').val();
        const businessAddress = row.find('.business_Address').text().trim();
        const typeOfEnterprise = row.find('.Type_Enterprise').text().trim();
        const landline = row.find('.landline').text().trim();
        const mobilePhone = row.find('.MobileNum').text().trim();
        const email = row.find('.Email').text().trim();
        const building = row.find('.building').text().trim();
        const equipment = row.find('.Equipment').text().trim();
        const workingCapital = row.find('.Working_C').text().trim();

        $('#cooperatorName').val(cooperatorName);
        $('#designation').val(designation);
        $('#b_id').val(businessId);
        $('#businessAddress').val(businessAddress);
        $('#typeOfEnterprise').val(typeOfEnterprise);
        $('#landline').val(landline);
        $('#mobilePhone').val(mobilePhone);
        $('#email').val(email);
        $('#building').val(building);
        $('#equipment').val(equipment);
        $('#workingCapital').val(workingCapital);
      });
    },

    Users: () => {
      $('#user_staff').DataTable({
        autoWidth: false,
        responsive: true,
        columns: [
          { title: '#' },
          { title: 'Name' },
          { title: 'Email' },
          { title: 'Username' },
          { title: 'Access Status' },
          { title: 'Action' },
        ],
        columnDefs: [
          {
            targets: 0,
            width: '5%',
            className: 'text-center',
          },
          {
            targets: 1,
            width: '30%',
          },
          {
            targets: 2,
            width: '20%',
          },
          {
            targets: 3,
            width: '20%',
          },
          {
            targets: 4,
            width: '15%',
          },
          {
            targets: 5,
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
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
          });

          const staffUserTable = $('#user_staff').DataTable();

          staffUserTable.clear();

          staffUserTable.rows.add(
            response.map((staff) => [
              staff.id,
              `${staff?.prefix || ''} ${staff.f_name || ''} ${
                staff?.mid_name || ''
              } ${staff.l_name || ''} ${staff?.suffix || ''}`,
              staff.email,
              staff.user_name,
              `<span class="badge ${
                staff.access_to === 'Restricted' ? 'bg-danger' : 'bg-success'
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
          showToastFeedback('text-bg-danger', error.responseJSON.message);
        }
      };

      getStaffUserLists();

      (() => {
        'use strict';

        // Fetch all forms that need validation
        const NewUsersForms = document.querySelectorAll('.needs-validation');

        // Attach form validation and submission to the submit button click event
        $('#submitNewUser').on('click', function (event) {
          // Prevent default button action
          event.preventDefault();

          // Loop through each form with 'needs-validation'
          Array.from(NewUsersForms).forEach((form) => {
            // Check if the form is valid
            if (!form.checkValidity()) {
              event.stopPropagation();
              form.classList.add('was-validated');
            } else {
              // If valid, trigger the AJAX form submission
              addStaffUser(form);
            }
          });
        });
      })();

      const addStaffUser = async (form) => {
        try {
          // Create FormData object from the form element
          const formData = new FormData(form);

          const response = await $.ajax({
            type: 'POST',
            url: USERS_LIST_ROUTE.GET_STAFF_USER_LISTS,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            processData: false, // Don't process the data
            contentType: false, // Let jQuery set the content type based on formData
            data: formData,
          });
          getStaffUserLists();
          closeModal('#AddUserModal');
          showToastFeedback('text-bg-success', response.success);
        } catch (error) {
          showToastFeedback('text-bg-danger', error.responseJSON.message);
        }
      };

      const updateStaffUser = async (user_name) => {
        try {
          const toggleStaffAccess = $('#toggleStaffAccess').prop('checked')
            ? 'Allowed'
            : 'Restricted';
          const response = await $.ajax({
            type: 'PUT',
            url: USERS_LIST_ROUTE.UPDATE_STAFF_USER.replace(
              ':user_name',
              user_name
            ),
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
              access_to: toggleStaffAccess,
            },
          });
          getStaffUserLists();
          showToastFeedback('text-bg-success', response.success);
        } catch (error) {
          showToastFeedback('text-bg-danger', error.responseJSON.message);
        }
      };

      const deleteStaffUser = async (user_name) => {
        try {
          const response = await $.ajax({
            type: 'DELETE',
            url: USERS_LIST_ROUTE.DELETE_STAFF_USER.replace(
              ':user_name',
              user_name
            ),
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
          });
          getStaffUserLists();
          showToastFeedback('text-bg-success', response.success);
        } catch (error) {
          console.log(error);
        }
      };

      $('#UpdateAndDeleteResourcesModal').on('show.bs.modal', function (e) {
        const triggerdButton = $(e.relatedTarget);
        const buttonRow = triggerdButton.closest('tr');
        const optionType = triggerdButton.data('option-type');

        // Cache DOM elements
        const accessTo = buttonRow.find('td:nth-child(5)').text().trim();
        const staffName = buttonRow.find('td:nth-child(2)').text().trim();
        const userName = buttonRow.find('td:nth-child(4)').text().trim();
        const modal = $(this);
        const modalHeader = modal.find('.modal-header');
        const modalTitle = modal.find('.modal-title');
        const modalBody = modal.find('.modal-body');
        const modalActionButton = modal.find('#actionToPerform');

        modalActionButton.removeData('action-type').removeData('unique-val');

        // Update modal content
        const modalHeaderContent =
          optionType === 'updateUser' ? 'Update User' : 'Delete User';

        modalHeader
          .removeClass('bg-danger bg-primary')
          .addClass(optionType === 'deleteUser' ? 'bg-danger' : 'bg-primary');

        modalTitle.text(modalHeaderContent);

        const modalBodyContent =
          optionType === 'updateUser'
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
          .find('#toggleStaffAccess')
          .prop('checked', accessTo === 'Restricted');

        // Update action button
        modalActionButton
          .removeClass('btn-danger btn-primary')
          .addClass(optionType === 'deleteUser' ? 'btn-danger' : 'btn-primary')
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
      });

      // Helper function for sanitization

      $('#viewUserOffcanvas').on('show.bs.offcanvas', function (e) {
        const triggerdButton = $(e.relatedTarget);
        const buttonRow = triggerdButton.closest('tr');
        const StaffName = buttonRow.find('td:nth-child(2)').text().trim();
        const Email = buttonRow.find('td:nth-child(3)').text().trim();
        const UserName = buttonRow.find('td:nth-child(4)').text().trim();

        const offcanvas = $(this);

        offcanvas.find('#StaffName').text(StaffName);
      });
    },
  };
  return functions;
};
