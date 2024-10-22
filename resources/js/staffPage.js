if (import.meta.hot) {
  import.meta.hot.accept();
}
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

const dateFormatter = (date) => {
    const dateObj = new Date(date)

    return dateObj.toLocaleString('en-US', {
        month: '2-digit',
        day: '2-digit',
        year: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
})
}

//close offcanvas
function closeOffcanvasInstances(offcanva_id) {
  const offcanvasElement = $(offcanva_id).get(0);
  const offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasElement);
  offcanvasInstance.hide();
}

//format currency

function formatToNumber(inputSelector) {
  $(inputSelector).on('input', function () {
    const value = $(this)
      .val()
      .replace(/[^0-9.]/g, '');
    if (value.includes('.')) {
      const parts = value.split('.');
      parts[1] = parts[1].substring(0, 2);
      value = parts.join('.');
    }
    const formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    $(this).val(formattedValue);
  });
}

function closeModal(modelId) {
  const model = bootstrap.Modal.getInstance(modelId);
  model.hide();
}

$(document).on('DOMContentLoaded', function () {
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
window.initializeStaffPageJs = async () => {
  const functions = {
    Dashboard: () => {
      formatToNumber('#days_open');
      formatToNumber('#updateOpenDays');
      /**
       * Creates a monthly data chart with the provided data for applicants, ongoing, and completed items.
       *
       * @param {Array} applicant - Data for the 'Applicant' category.
       * @param {Array} ongoing - Data for the 'Ongoing' category.
       * @param {Array} completed - Data for the 'Completed' category.
       * @returns {Promise} A promise that resolves after rendering the monthly data chart.
       */
      const createMonthlyDataChart = async (applicant, ongoing, completed) => {
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
                opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] +
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

            const monthIndex = months.indexOf(month.slice(0, 3));

            if (monthIndex !== -1) {
              applicant[monthIndex] = data.Applicants || null;
              ongoing[monthIndex] = data.Ongoing || null;
              completed[monthIndex] = data.Completed || null;
            }
          })
        );
        await createMonthlyDataChart(applicant, ongoing, completed);
      };

      const getDashboardChartData = async () => {
        try {
          const response = await $.ajax({
            type: 'GET',
            url: DASHBBOARD_TAB_ROUTE.GET_MONTHLY_PROJECTS_CHARTDATA,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
          });
          const monthlyData = await JSON.parse(
            response.monthlyData[0].mouthly_project_categories
          );
          processMonthlyDataChart(monthlyData);
        } catch (error) {
          console.error(error);
        }
      };

      getDashboardChartData();

      // initialize datatable
      $('#handledProject').DataTable({
        autoWidth: false,
        responsive: true,
        columns: [
            {
                title: 'ID',
            },
            {
                title: 'Project Title'
            },
            {
                title: 'Firm Name'
            },
            {
                title: 'Owner Name'
            },
            {
                title: 'Refund Progress'
            },
            {
                title: 'Status'
            },
            {
                title: 'Action'
            }
        ],
        columnDefs: [
            {
                targets: 0,
                width: '5%',
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
                className: 'text-end'
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

      //Foramt Input with Id paymentAmount
      formatToNumber('#paymentAmount');

      $('#linkTable').DataTable({
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
          },
        ],
        columnDefs: [
          {
            targets: 0,
            width: '15%',
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
        ],
      });

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
      toggleMenu('#nav-details-tab', '.AttachlinkTabMenu, .GeneratedSheetsTabMenu', null);

      // Tab: nav-link-tab
      toggleMenu('#nav-link-tab', '.GeneratedSheetsTabMenu', '.AttachlinkTabMenu');

      // Tab: nav-Quarterly-tab
      toggleMenu('#nav-Quarterly-tab', '.AttachlinkTabMenu, .GeneratedSheetsTabMenu', null);

      // Tab: nav-GeneratedSheets-tab
      toggleMenu('#nav-GeneratedSheets-tab', '.AttachlinkTabMenu', '.GeneratedSheetsTabMenu');


      const isRefundCompleted = (boolean) => {
        const completedButton = $('#MarkCompletedProjectBtn');
        boolean
        ? completedButton.prop('disabled', false).show()
        : completedButton.prop('disabled', true).hide();

      }

      /**
       * Fetches handled projects from the server and updates the handled project table.
       *
       * @return {void}
       */
      const getHandleProject = async () => {
        const response = await fetch(
          DASHBBOARD_TAB_ROUTE.GET_HANDLED_PROJECTS,
          {
            method: 'GET',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
          }
        );
        const data = await response.json();
        const handledProjectTable = $('#handledProject').DataTable();
        handledProjectTable.clear();

        data.forEach((project) => {
          const refunded_amount = parseFloat(project.Refunded_Amount) || 0;
          const Actual_Amount = parseFloat(project.Actual_Amount) || 0;

          const percentage = Math.ceil((refunded_amount / Actual_Amount) * 100);
          handledProjectTable.row.add([
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
              project.prefix +
              ' ' +
              project.f_name +
              ' ' +
              project.l_name +
              ' ' +
              project.suffix
            }</p>
                <input type="hidden" class="gender" value="${project.gender}">
                <input type="hidden" class="birth_date" value="${
                  project.birth_date
                }">
                <input type="hidden" class="landline" value="${
                  project.landline ?? ''
                }">
                <input type="hidden" class="mobile_phone" value="${
                  project.mobile_number
                }">
                <input type="hidden" class="email" value="${project.email}">`,
            `${
              formatToString(refunded_amount) +
              '/' +
              formatToString(Actual_Amount)
            }<span class="badge ms-1 text-white bg-primary">${percentage}%</span>
            <input type="hidden" class="approved_amount" value="${
              project.Approved_Amount
            }">
            <input type="hidden" class="actual_amount" value="${Actual_Amount}">`,
            `<span class="badge ${
              project.application_status === 'approved'
                ? 'bg-warning'
                : project.application_status === 'ongoing'
                ? 'bg-primary'
                : project.application_status === 'completed'
                ? 'bg-success'
                : null
            }">${project.application_status}</span>`,
            `<button class="btn btn-primary handleProjectbtn" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#handleProjectOff" aria-controls="handleProjectOff">
                    <i class="ri-menu-unfold-4-line ri-1x"></i>
                </button>`,
          ]);
        });
        handledProjectTable.draw();
      };

      getHandleProject();

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
              .find('.ongoingProjectContent')
              .addClass('d-none');
          },
          ongoing: async () => {
            handleProjectOffcanvas
              .find('.ongoingProjectContent')
              .removeClass('d-none');
            handleProjectOffcanvas
              .find('.approvedProjectContent')
              .addClass('d-none');
            handleProjectOffcanvas
              .find('#paymentHistoryContainer')
              .html(await paymentHistoryTable());

            $('#paymentHistoryTable').DataTable({
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
            });
          },
          completed: () => {},
        };

        await content[project_status]();
      }

      //Generate payment history datatable
      const paymentHistoryTable = async () => {
        const paymentHistoryTable = `
                <table class="table table-hover table-sm" id="paymentHistoryTable" syle="width:100%">

                </table>
            `;
        return paymentHistoryTable;
      };

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
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: formData,
          });

          closeModal('#paymentModal');
          await getPaymentHistoryAndCalculation(project_id);
          setTimeout(() => {
            showToastFeedback('text-bg-success', response.message);
          }, 500);
        } catch (error) {
            setTimeout(() => {
                showToastFeedback('text-bg-danger', error.responseJSON.message);
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
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: formData + '&project_id=' + project_id,
          });

          closeModal('#paymentModal');
          await getPaymentHistoryAndCalculation($('#ProjectID').val());
          setTimeout(() => {
            showToastFeedback('text-bg-success', response.message);
          }, 500);
        } catch (error) {
          showToastFeedback('text-bg-danger', error.responseJSON.message);
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
      $('#submitPayment').on('click', function () {
        const submissionMethod = $(this).attr('data-submissionmethod');

        console.log(submissionMethod)

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
            type: 'GET',
            url:
              DASHBBOARD_TAB_ROUTE.GET_PAYMENT_RECORDS +
              '?project_id=' +
              projectId,
          });

          const paymentHistoryTable = $('#paymentHistoryTable').DataTable();
          paymentHistoryTable.clear();
          paymentHistoryTable.rows.add(
            response.map((payment) => [
              payment.transaction_id,
              formatToString(parseFloat(payment.amount)),
              payment.payment_method,
              payment.payment_status,
              dateFormatter(payment.created_at),
              `<button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#paymentModal"
                                        data-action="Update"><i class="ri-file-edit-fill"></i></button>
                        <button class="btn btn-danger btn-sm deleteRecord" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" data-delete-record-type="projectPayment"><i class="ri-delete-bin-2-fill"></i></button>`,
            ])
          );
          paymentHistoryTable.draw();

          let totalAmount = 0;
          response.forEach((payment) => {
            payment.payment_status === 'Paid'
            ? totalAmount += parseFloat(payment.amount)
            : totalAmount += 0;
          });
          return totalAmount;
        } catch (error) {
          console.log(error);
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
          retrieve_the_selected_record_TO_UPDATE(button.closest('tr'));
        }
      });

      async function retrieve_the_selected_record_TO_UPDATE(selected_row) {
        const selected_transaction_id = selected_row
          .find('td:eq(0)')
          .text()
          .trim();
        const selected_amount = selected_row.find('td:eq(1)').text().trim();
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

      $('#handledProjectTableBody').on(
        'click',
        '.handleProjectbtn',
        function () {
          const handledProjectRow = $(this).closest('tr');
          const hiddenInputs = handledProjectRow.find('input[type="hidden"]');
          const offCanvaReadonlyInputs = $('#handleProjectOff').find('input');

          // Cache values from the row
          const project_status = handledProjectRow
            .find('td:eq(5)')
            .text()
            .trim();
          const project_id = handledProjectRow.find('td:eq(0)').text().trim();
          const projectTitle = handledProjectRow.find('td:eq(1)').text().trim();
          const firmName = handledProjectRow
            .find('td:eq(2) p.firm_name')
            .text()
            .trim();
          const cooperatorName = handledProjectRow
            .find('td:eq(3) p.owner_name')
            .text()
            .trim();

          // Cache hidden input values
          const business_id = hiddenInputs.filter('.business_id').val();
          const birthDate = new Date(hiddenInputs.filter('.birth_date').val());
          const dateApplied = hiddenInputs.filter('.dateApplied').val();
          const gender = hiddenInputs.filter('.gender').val();
          const landline = hiddenInputs.filter('.landline').val();
          const mobilePhone = hiddenInputs.filter('.mobile_phone').val();
          const email = hiddenInputs.filter('.email').val();
          const enterpriseType = hiddenInputs
            .filter('.business_enterprise_type')
            .val();
          const enterpriseLevel = hiddenInputs
            .filter('.business_enterprise_level')
            .val();
          const buildingAsset = parseFloat(hiddenInputs.filter('.building_value').val());
          const equipmentAsset = parseFloat(hiddenInputs.filter('.equipment_value').val());
          const workingCapitalAsset = parseFloat(hiddenInputs
            .filter('.working_capital')
            .val());
          const approved_amount = hiddenInputs.filter('.approved_amount').val();
          const actual_amount = hiddenInputs.filter('.actual_amount').val();

          // Calculate age
          const age = Math.floor(
            (new Date() - birthDate) / (365.25 * 24 * 60 * 60 * 1000)
          );

          // Update form fields
          offCanvaReadonlyInputs.filter('#hiddenbusiness_id').val(business_id);
          offCanvaReadonlyInputs.filter('#age').val(age);
          offCanvaReadonlyInputs.filter('#ProjectID').val(project_id);
          offCanvaReadonlyInputs.filter('#ProjectTitle').val(projectTitle);
          offCanvaReadonlyInputs
            .filter('#ApprovedAmount')
            .val(formatToString(parseFloat(approved_amount)));
          offCanvaReadonlyInputs.filter('#appliedDate').val(dateApplied);
          offCanvaReadonlyInputs.filter('#FirmName').val(firmName);
          offCanvaReadonlyInputs.filter('#CooperatorName').val(cooperatorName);
          offCanvaReadonlyInputs.filter('#Gender').val(gender);
          offCanvaReadonlyInputs.filter('#landline').val(landline);
          offCanvaReadonlyInputs.filter('#mobilePhone').val(mobilePhone);
          offCanvaReadonlyInputs.filter('#email').val(email);
          offCanvaReadonlyInputs.filter('#enterpriseType').val(enterpriseType);
          offCanvaReadonlyInputs
            .filter('#EnterpriseLevel')
            .val(enterpriseLevel);
          offCanvaReadonlyInputs.filter('#buildingAsset').val(formatToString(buildingAsset));
          offCanvaReadonlyInputs.filter('#equipmentAsset').val(formatToString(equipmentAsset));
          offCanvaReadonlyInputs.filter('#workingCapitalAsset').val(formatToString(workingCapitalAsset));

          handleProjectOffcanvasContent(project_status);
          getPaymentHistoryAndCalculation(project_id, actual_amount);
          getProjectLinks(project_id);
          getQuarterlyReports(project_id);
          getAvailableQuarterlyReports(project_id);
        }
      );

      const getPaymentHistoryAndCalculation = async (
        project_id,
        actual_amount = 0
      ) => {
        try {
          const totalAmount = await getPaymentHistory(project_id);

          const fundedAmount = parseFloat(actual_amount.replace(/,/g, ''));
          const remainingAmount = fundedAmount - totalAmount;
          const percentage = Math.round((totalAmount / fundedAmount) * 100);
          $('#totalPaid').text(formatToString(totalAmount));
          $('#FundedAmount').text(formatToString(fundedAmount));
          $('#remainingBalance').text(formatToString(remainingAmount));

          percentage == 100 ? isRefundCompleted(true) : isRefundCompleted(false);
          setTimeout(() => {
            InitializeviewCooperatorProgress(percentage);
          }, 500);
        } catch (error) {
          console.log(error);
        }
      };

      $('#addRequirement').on('click', function () {
        let RequirementLinkContent = $('#linkContainer');

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

      $('#linkContainer').on('click', '.removeRequirement', function () {
        $(this).closest('.linkConstInstance').remove();
      });

      //link validation
      $('#linkContainer').on(
        'blur',
        'input[name="requirements_link"]',
        function () {
          const linkConstInstance = $(this).closest('.linkConstInstance');
          const inputField = $(this);
          const inputtedLink = $(this).val();
          const proxyUrl = `/proxy?url=${encodeURIComponent(inputtedLink)}`;

          if (inputtedLink) {
            const spinner = `<div class="spinner-border spinner-border-sm text-primary ms-3" role="status" style="width: 1rem; height: 1rem; border-width: 2px; border-radius: 50%;">
                        <span class="visually-hidden"></span>
                    </div>`;

            inputField.after(spinner);
            fetch(proxyUrl)
              .then((response) => response.json())
              .then((data) => {
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
              })
              .catch((error) => {
                console.error('Error fetching the link:', error);
                linkConstInstance
                  .find('input[name="requirements_link"]')
                  .addClass('is-invalid')
                  .removeClass('is-valid');
              })
              .finally(() => {
                linkConstInstance.find('.spinner-border').remove();
              });
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
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
          });

          const linkDataTable = $('#linkTable').DataTable();
          linkDataTable.clear();
          linkDataTable.rows.add(
            response.map((link) => [
              link.file_name,
              link.file_link,
              link.created_at,
              `<a class="btn btn-outline-primary btn-sm" target="_blank" href="${link.file_link}"><i class="ri-eye-fill"></i></a>
                        <button class="btn btn-primary btn-sm updateLinkRecord" data-bs-toggle="modal" data-bs-target="#projectLinkModal"><i class="ri-pencil-fill" ></i></button>
                        <button class="btn btn-danger btn-sm deleteRecord" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" data-delete-record-type="projectLink"> <i class="ri-delete-bin-6-fill"></i></button>`,
            ])
          );
          linkDataTable.draw();
        } catch (error) {
          showToastFeedback('text-bg-danger', error.responseJSON.message);
        }
      };

      //Save the inputted links to the database
      $('.SaveLinkProjectBtn').on('click', async function () {
        try {
          const projectID = $('#ProjectID').val();
          let requirementLinks = {};
          $('.linkConstInstance').each(function () {
            let name = $(this).find('input[name="requirements_name"]').val();
            let link = $(this).find('input[name="requirements_link"]').val();
            requirementLinks[name] = link;
          });
          const response = await $.ajax({
            type: 'POST',
            url: DASHBBOARD_TAB_ROUTE.STORE_PAYMENT_LINKS,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
              project_id: projectID,
              linklist: requirementLinks,
            },
          });

          getProjectLinks(projectID);
          showToastFeedback('text-bg-success', response.message);
        } catch (error) {
          showToastFeedback('text-bg-danger', error.responseJSON.message);
        }
      });

      $('#UpdateProjectLink').on('click', async () => {
        try {
          const projectID = $('#ProjectID').val();
          const updatedProjectLinks = $('#projectLinkForm').serialize();
          const projectName = $('#HiddenProjectNameToUpdate').val();

          const response = await $.ajax({
            type: 'PUT',
            url: DASHBBOARD_TAB_ROUTE.UPDATE_PROJECT_LINKS.replace(
              ':project_link_name',
              projectName
            ),
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: updatedProjectLinks + '&project_id=' + projectID,
          });

          getProjectLinks(projectID);
          closeModal('#projectLinkModal');
          showToastFeedback('text-bg-success', response.message);
        } catch (error) {
          showToastFeedback('text-bg-danger', error);
        }
      });

      $('#projectLinkModal').on('show.bs.modal', function (event) {
        const triggeredbutton = $(event.relatedTarget);
        const selectedRow = triggeredbutton.closest('tr');

        const projectName = selectedRow.find('td:eq(0)').text();
        const projectLink = selectedRow.find('td:eq(1)').text();

        const modal = $(this);
        modal.find('input#HiddenProjectNameToUpdate').val(projectName);
        modal.find('input#projectNameUpdated').val(projectName);
        modal.find('textarea#projectLink').val(projectLink);
      });

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
      $('#deleteRecordModal').on('show.bs.modal', function (event) {
        const triggeredDeleteButton = $(event.relatedTarget);
        const action = triggeredDeleteButton.data('delete-record-type');
        const recordRow = triggeredDeleteButton.closest('tr');

        console.log(triggeredDeleteButton.data('record-to-delete'));
        console.log(action);

        const modal = $(this);

        if (action === 'projectPayment') {
          const paymentTransactionID = recordRow.find('td:eq(0)').text();
          const paymentAmount = recordRow.find('td:eq(1)').text();

          modal
            .find('.modal-body')
            .html(
              `Are you sure you want to delete this transaction <strong>${paymentTransactionID}</strong> with amount of <strong>${paymentAmount}</strong>?`
            );
          modal
            .find('#deleteRecord')
            .attr('data-record-to-delete', 'paymentRecord')
            .attr('data-unique-val', paymentTransactionID);
        } else if (action === 'projectLink') {
          const projectName = recordRow.find('td:eq(0)').text();
          const projectLink = recordRow.find('td:eq(1)').text();

          modal
            .find('.modal-body')
            .html(
              `Are you sure you want to delete this link <a href="${projectLink}" target="_blank">${projectLink}</a> with a file named ${projectName}?`
            );
          modal
            .find('#deleteRecord')
            .attr('data-record-to-delete', 'projectLinkRecord')
            .attr('data-unique-val', projectName);
        } else if (action === 'quarterlyRecord') {
          const quarterlyRecord_id = triggeredDeleteButton.data('record-id');
          const quarterPeriod = recordRow.find('td:eq(0)').text();
          console.log(quarterPeriod, quarterlyRecord_id);
          modal
            .find('.modal-body')
            .html(
              `Are you sure you want to delete this quarterly record <strong>${quarterPeriod}</strong>?`
            );
          modal
            .find('#deleteRecord')
            .attr('data-record-to-delete', 'quarterlyRecord')
            .attr('data-unique-val', quarterlyRecord_id);
        }
        modal
          .find('#deleteRecord')
          .off('click')
          .on('click', async function () {
            const recordToDelete = $(this).attr('data-record-to-delete');
            const uniqueVal = $(this).attr('data-unique-val');
            console.log(recordToDelete, uniqueVal);
            const deleteRoute =
              recordToDelete === 'paymentRecord'
                ? DASHBBOARD_TAB_ROUTE.DELETE_PAYMENT_RECORDS.replace(
                    ':transaction_id',
                    uniqueVal
                  )
                : recordToDelete === 'projectLinkRecord'
                ? DASHBBOARD_TAB_ROUTE.DELETE_PROJECT_LINK.replace(
                    ':project_link_name',
                    uniqueVal
                  )
                : recordToDelete === 'quarterlyRecord'
                ? DASHBBOARD_TAB_ROUTE.DELETE_QUARTERLY_REPORT.replace(
                    ':record_id',
                    uniqueVal
                  )
                : '';
            try {
              const project_id = $('#ProjectID').val();
              const response = await $.ajax({
                type: 'DELETE',
                url: deleteRoute,
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
              });
              showToastFeedback('text-bg-success', response.message);
              closeModal('#deleteRecordModal');
              modal.hide();
              recordToDelete === 'projectLinkRecord'
                ? getProjectLinks(project_id)
                : recordToDelete === 'paymentRecord'
                ? getPaymentHistoryAndCalculation(project_id)
                : recordToDelete === 'quarterlyRecord'
                ? getQuarterlyReports(project_id)
                : null;
            } catch (error) {
              console.log(error);
              showToastFeedback('text-bg-danger', error.responseJSON.message);
            }
          });
      });

      $('#MarkOngoingProjectBtn').on('click', function () {
        $.ajax({
          type: 'PUT',
          url: DASHBBOARD_TAB_ROUTE.SET_PROJECT_TO_ONGOING,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
          data: {
            project_id: $('#ProjectID').val(),
            business_id: $('#hiddenbusiness_id').val(),
          },
          success: function (response) {
            closeOffcanvasInstances('#handleProjectOff');
            setTimeout(() => {
              showToastFeedback(
                'text-bg-success',
                'Project is now move to ongoing'
              );
            }, 500);
          },
          error: function (error) {
            showToastFeedback('text-bg-danger', error.responseJSON.message);
          },
        });
      });

      const projectStateBtn = $('.updateProjectState');

      //Cooperator Payment Progress
      projectStateBtn.on('click', async function () {
        const action = $(this).data('project-state');
        const projectID = $('#ProjectID').val();
        const businessID = $('#hiddenbusiness_id').val();
       try {
        const response = $.ajax({
            type: 'PUT',
            url: DASHBBOARD_TAB_ROUTE.UPDATE_PROJECT_STATE,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
                action: action,
                project_id: projectID,
                business_id: businessID
            },
        })
        const data = await response;
            showToastFeedback('text-bg-success', data.message);
        } catch (error) {
            showToastFeedback('text-bg-danger', error.responseJSON.message);
        }
      })

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
          console.log(paymentProgress);
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
          const response = await $.ajax({
            type: 'GET',
            url: GENERATE_SHEETS_ROUTE.GET_AVAILABLE_QUARTERLY_REPORT.replace(
              ':project_id',
              Project_id
            ),
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
          });
          $('#Select_quarter_to_Generate').append(response.html);
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
            type: 'GET',
            url: GENERATE_SHEETS_ROUTE.GET_PROJECT_SHEET_FORM.replace(
              ':type',
              formType
            )
              .replace(':project_id', Project_id)
              .replace(':quarter_of', QuartertoUsed ? QuartertoUsed : ''),
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
          });

          toggleDocumentSelector();
          $('#SheetFormDocumentContainer').append(response);
        } catch (error) {
          console.log(error);
        }
      };

      $('button[data-form-type]').on('click', async function () {
        const formType = $(this).data('form-type');
        const Project_id = $('#ProjectID').val();
        const QuartertoUsed = $('#Select_quarter_to_Generate').val();
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
        const value = thisInput.val().replace(/[^0-9.]/g, '');

        if ((value.match(/\./g) || []).length > 1) {
          value =
            value.substring(0, value.indexOf('.') + 1) +
            value.substring(value.indexOf('.') + 1).replace(/\./g, '');
        }
        let [integerPart, decimalPart] = value.split('.');

        integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

        if (decimalPart !== undefined) decimalPart = decimalPart.slice(0, 2);

        thisInput.val(
          decimalPart !== undefined
            ? `${integerPart}.${decimalPart}`
            : integerPart
        );
      }

      const parseValue = (value) => {
        return parseFloat(value?.replace(/,/g, '')) || 0;
      };

      function PISFormEvents() {
        function caculateTotalAssests() {
          const landAssets = parseValue($('#land_val').val());
          const buildingAssets = parseValue($('#building_val').val());
          const equipmentAssets = parseValue($('#equipment_val').val());
          const workingCapital = parseValue($('#workingCapital_val').val());
          const totalAssests =
            landAssets + buildingAssets + equipmentAssets + workingCapital;
          $('#totalAssests').val(
            totalAssests.toLocaleString('en-US', {
              minimumFractionDigits: 2,
            })
          );
        }

        $('#land_val, #building_val, #equipment_val, #workingCapital_val').on(
          'input',
          function () {
            const thisInput = $(this);
            inputsToCurrencyFormatter(thisInput);
            caculateTotalAssests();
          }
        );

        const calculateTotalEmploymentGenerated = () => {
          let manMonthTotal = 0;

          $('#totalEmploymentContainer tr').each(function () {
            const thisTableRow = $(this);

            const male = parseValue(thisTableRow.find('.maleInput').val());
            const female = parseValue(thisTableRow.find('.femaleInput').val());
            const subtotal = male + female;
            thisTableRow.find('.thisRowSubtotal').val(
              subtotal.toLocaleString('en-US', {
                minimumFractionDigits: 2,
              })
            );

            manMonthTotal += subtotal;
          });
          $('#TotalmanMonths').val(
            manMonthTotal.toLocaleString('en-US', {
              minimumFractionDigits: 2,
            })
          );
        };

        $('#totalEmploymentContainer').on(
          'input',
          'td input.maleInput, td input.femaleInput',
          function () {
            console.log('Input Changed');
            const thisInput = $(this);
            inputsToCurrencyFormatter(thisInput);
            calculateTotalEmploymentGenerated();
          }
        );

        const calculateTotalGrossSales = () => {
          console.log('Input Changed');

          const localProduct = parseValue($('#localProduct_Val').val());
          const exportProduct = parseValue($('#exportProduct_Val').val());
          const totalGrossSales = localProduct + exportProduct;
          $('#totalGrossSales').val(
            totalGrossSales.toLocaleString('en-US', {
              minimumFractionDigits: 2,
            })
          );

          console.log(totalGrossSales);
        };

        $('#localProduct_Val, #exportProduct_Val').on('input', function () {
          const thisInput = $(this);
          inputsToCurrencyFormatter(thisInput);
          calculateTotalGrossSales();
        });
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
          $('#totalEmployment tr').each(function () {
            const totalMalePersonel = parseValue(
              $(this).find('.maleInput').val()
            );
            const totalFemalePersonel = parseValue(
              $(this).find('.femaleInput').val()
            );
            const workDays = parseValue($(this).find('.workdayInput').val());
            const thisRowManMonth =
              (totalMalePersonel + totalFemalePersonel) * (workDays / 20);
            $(this)
              .find('.totalManMonth')
              .val(
                thisRowManMonth.toLocaleString('en-US', {
                  minimumFractionDigits: 2,
                })
              );

            totalNumPersonel += totalMalePersonel + totalFemalePersonel;

            totalManMonth += parseValue($(this).find('.totalManMonth').val());
          });
          $('#TotalManMonth').val(
            totalManMonth.toLocaleString('en-US', {
              minimumFractionDigits: 2,
            })
          );
          $('#TotalEmployment').val(
            totalNumPersonel.toLocaleString('en-US', {
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
         * @param {Object} event - The input event object.
         * @param {HTMLElement} event.target - The input element that triggered the event.
         * @param {Object} event.delegateTarget - The element that the event was delegated to.
         *
         * @fires calculateTotalEmployment
         */
        $('#totalEmployment').on(
          'input',
          'td input.maleInput, td input.femaleInput, td input.workdayInput',
          function () {
            const thisEmployeeRow = $(this);
            inputsToCurrencyFormatter(thisEmployeeRow);

            const employeeRow = thisEmployeeRow.closest('tr');
            const maleVal = parseValue(employeeRow.find('.maleInput').val());
            const femaleVal = parseValue(
              employeeRow.find('.femaleInput').val()
            );
            const workDays = parseValue(
              employeeRow.find('.workdayInput').val()
            );

            const totalManMonth = (workDays / 20) * (maleVal + femaleVal);
            employeeRow.find('.totalManMonth').val(totalManMonth);

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

          $('#localProducts tr, #exportProducts tr').each(function () {
            const tableRow = $(this);
            let grossSales = parseValue(tableRow.find('.grossSales_val').val());
            let productionCost = parseValue(
              tableRow.find('.productionCost_val').val()
            );

            let netSales = grossSales - productionCost;

            let FormattedNetSales = netSales.toLocaleString('en-US', {
              minimumFractionDigits: 2,
            });

            tableRow.find('.netSales_val').val(FormattedNetSales);

            totalGrossSales += grossSales;
            totalProductionCost += productionCost;
            totalNetSales += netSales;
          });

          $('#totalGrossSales').val(
            `₱ ${totalGrossSales.toLocaleString('en-US', {
              minimumFractionDigits: 2,
            })}`
          );
          $('#totalProductionCost').val(
            `₱ ${totalProductionCost.toLocaleString('en-US', {
              minimumFractionDigits: 2,
            })}`
          );
          $('#totalNetSales').val(
            `₱ ${totalNetSales.toLocaleString('en-US', {
              minimumFractionDigits: 2,
            })}`
          );

          $('.CurrentgrossSales_val').val(
            totalGrossSales.toLocaleString('en-US', {
                minimumFractionDigits: 2,
              })
          )
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
         * @param {object} thisInput - The input element that triggered the event.
         * @fires calculateTotals
         */
        $('#localProducts, #exportProducts').on(
          'input',
          'td input.grossSales_val, td input.productionCost_val',
          function () {
            const thisInput = $(this);
            inputsToCurrencyFormatter(thisInput);

            const $productRow = thisInput.closest('tr');
            const grossSales = parseValue(
              $productRow.find('.grossSales_val').val()
            );
            const estimatedProductionCost = parseValue(
              $productRow.find('.productionCost_val').val()
            );
            const netSales = grossSales - estimatedProductionCost;

            $productRow
              .find('.netSales_val')
              .val(
                netSales.toLocaleString('en-US', { minimumFractionDigits: 2 })
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
            '#ToBeAccomplished .increaseInProductivity'
          );

          const CurrentAndPreviousgrossSales = $('#ToBeAccomplished td .CurrentgrossSales_val, td .PreviousgrossSales_val, td .TotalgrossSales_val').closest('tr');

          const CurrentgrossSales = parseValue(CurrentAndPreviousgrossSales
            .find('.CurrentgrossSales_val')
            .val());
          const PreviousgrossSales = parseValue(CurrentAndPreviousgrossSales
            .find('.PreviousgrossSales_val')
            .val());


          increaseInProductivityRow.find('.CurrentgrossSales_val_cal').text(
            CurrentgrossSales.toLocaleString('en-US', {
              minimumFractionDigits: 2,
            })
          );
          increaseInProductivityRow.find('.PreviousgrossSales_val_cal').text(
            PreviousgrossSales.toLocaleString('en-US', {
              minimumFractionDigits: 2,
            })
          );

          const TotalgrossSales = CurrentgrossSales - PreviousgrossSales;
          CurrentAndPreviousgrossSales.find('.TotalgrossSales_val').val(
            TotalgrossSales.toLocaleString('en-US', {
              minimumFractionDigits: 2,
            })
          );

          const increaseInProductivityByPercent =
            ((CurrentgrossSales - PreviousgrossSales) / PreviousgrossSales) *
            100;
          increaseInProductivityRow
            .find('.totalgrossSales_percent')
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
        $('#ToBeAccomplished').on(
          'input',
          'td .CurrentgrossSales_val, td .PreviousgrossSales_val',
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
            '#ToBeAccomplished .increaseInEmployment'
          );

          const CurrentAndPreviousEmployment = $('#ToBeAccomplished td .CurrentEmployment_val, td .PreviousEmployment_val, td .TotalEmployment_val').closest('tr');

          const CurrentEmployment = parseInt(CurrentAndPreviousEmployment
            .find('.CurrentEmployment_val').val());

          const PreviousEmployment = parseInt(CurrentAndPreviousEmployment
            .find('.PreviousEmployment_val').val());

          increaseInEmploymentRow.find('.CurrentEmployment_val_cal').text(
            CurrentEmployment
          );
          increaseInEmploymentRow.find('.PreviousEmployment_val_cal').text(
            PreviousEmployment
          );

          const TotalEmployment = CurrentEmployment - PreviousEmployment;
          CurrentAndPreviousEmployment.find('.TotalEmployment_val').val(
            TotalEmployment
          );

          const increaseInEmploymentByPercent =
            ((CurrentEmployment - PreviousEmployment) / PreviousEmployment) *
            100;
          increaseInEmploymentRow
            .find('.totalEmployment_percent')
            .val(`${increaseInEmploymentByPercent.toFixed(2)}%`);
        };

        $('#ToBeAccomplished').on(
          'input',
          'td .CurrentEmployment_val , td .PreviousEmployment_val',
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
      $('#SheetFormDocumentContainer').on(
        'click',
        '.breadcrumb-item:not(.active) a',
        function () {
          $('#PISFormContainer , #PDSFormContainer, #SRFormContainer').remove();
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
      $('#SheetFormDocumentContainer')
        .off('click', '.ExportPDF')
        .on('click', '.ExportPDF', async function (e) {
          e.preventDefault();

          try {
            const ExportPDF_BUTTON_DATA_VALUE = $(this).data('to-export');
            const route_url = await {
              PIS: GENERATE_SHEETS_ROUTE.GENERATE_PROJECT_INFORMATION_SHEET,
              PDS: GENERATE_SHEETS_ROUTE.GENERATE_DATA_SHEET_REPORT,
              SR: GENERATE_SHEETS_ROUTE.GENERATE_STATUS_REPORT,
            }[ExportPDF_BUTTON_DATA_VALUE];
            const data = await requestDATA(ExportPDF_BUTTON_DATA_VALUE);
            const response = await $.ajax({
              type: 'POST',
              url: route_url,
              data: data,
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
              },
              xhrFields: {
                responseType: 'blob',
              },
            });

            const blob = new Blob([response], { type: 'application/pdf' });
            const url = window.URL.createObjectURL(blob);
            window.open(url, '_blank'); // Open the PDF in a new browser tab

            console.log('PDF successfully generated and opened in a new tab.');
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
              $('#projectInfoForm').serialize() +
              '&' +
              $('#PIS_checklistsForm').serialize()
            );
          },

          PDS: function () {
            const thisFormData = $('#projectDataForm').serializeArray();
            let thisFormObject = {};
            $.each(thisFormData, function (i, v) {
              thisFormObject[v.name] = v.value;
            });

            const localProductsRow = $('#localProducts tr');
            const exportProductsRow = $('#exportProducts tr');
            const localProductData = [];
            const exportProductData = [];

            localProductsRow.each(function () {
              const tableRow = $(this);
              const localProductDetails = {
                productName: tableRow.find('.productName').val(),
                packingDetails: tableRow.find('.packingDetails').val(),
                volumeOfProduction: tableRow
                  .find('.volumeOfProduction_val')
                  .val(),
                grossSales: tableRow.find('.grossSales_val').val(),
                productionCost: tableRow.find('.productionCost_val').val(),
                netSales: tableRow.find('.netSales_val').val(),
              };
              localProductData.push(localProductDetails);
            });

            thisFormObject.localProduct = localProductData;

            exportProductsRow.each(function () {
              const tableRow = $(this);
              const exportProductDetails = {
                productName: tableRow.find('.productName').val(),
                packingDetails: tableRow.find('.packingDetails').val(),
                volumeOfProduction: tableRow
                  .find('.volumeOfProduction_val')
                  .val(),
                grossSales: tableRow.find('.grossSales_val').val(),
                productionCost: tableRow.find('.productionCost_val').val(),
                netSales: tableRow.find('.netSales_val').val(),
              };
              exportProductData.push(exportProductDetails);
            });

            thisFormObject.exportProduct = exportProductData;

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
            const expectedAndActualTableRow = FormContainer.find(
              '.expectedAndActual_tableRow tr'
            );
            const equipmentTableRow = FormContainer.find(
              '.equipment_tableRow tr'
            );
            const nonEquipmentTableRow = FormContainer.find(
              '.non_equipment_tableRow tr'
            );
            const salesTableRow = FormContainer.find('.sales_tableRow tr');
            const employmentGeneratedTableRow = FormContainer.find(
              '.employment_generated_tableRow tr'
            );
            const indirectEmploymentTableRow = FormContainer.find(
              '.indirect_employment_tableRow tr'
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
                  Expected_Output: tableRowInputs.find('.expectedOutput').val(),
                  Actual_Accomplishment: tableRowInputs
                    .find('.actualAccomplishment')
                    .val(),
                  Remarks_Justification: tableRowInputs
                    .find('.remarksJustification')
                    .val(),
                };
                expectedAndActualData.push(expectedAndActualDetails);
              });

              equipmentTableRow.each(function () {
                const tableRowInputs = $(this);
                const equipmentDetails = {
                  Approved_qty: tableRowInputs.find('.approved_qty').val(),
                  Approved_Particulars: tableRowInputs
                    .find('.approved_particulars')
                    .val(),
                  Approved_cost: tableRowInputs.find('.approved_cost').val(),
                  Actual_qty: tableRowInputs.find('.actual_qty').val(),
                  Actual_Particulars: tableRowInputs
                    .find('.actual_particulars')
                    .val(),
                  Actual_cost: tableRowInputs.find('.actual_cost').val(),
                  acknowledgement: tableRowInputs
                    .find('.acknowledgement')
                    .val(),
                  remarks: tableRowInputs.find('.remarks').val(),
                };
                equipmentData.push(equipmentDetails);
              });

              nonEquipmentTableRow.each(function () {
                const tableRowInputs = $(this);
                const nonEquipmentDetails = {
                  Approved_qty: tableRowInputs
                    .find('.non_equipment_approved_qty')
                    .val(),
                  Approved_Particulars: tableRowInputs
                    .find('.non_equipment_approved_particulars')
                    .val(),
                  Approved_cost: tableRowInputs
                    .find('.non_equipment_approved_cost')
                    .val(),
                  Actual_qty: tableRowInputs
                    .find('.non_equipment_actual_qty')
                    .val(),
                  Actual_Particulars: tableRowInputs
                    .find('.non_equipment_actual_particulars')
                    .val(),
                  Actual_cost: tableRowInputs
                    .find('.non_equipment_actual_cost')
                    .val(),
                  remarks: tableRowInputs.find('.non_equipment_remarks').val(),
                };
                nonEquipmentData.push(nonEquipmentDetails);
              });

              salesTableRow.each(function () {
                const tableRowInputs = $(this);
                const salesDetails = {
                  ProductService: tableRowInputs
                    .find('.sales_product_service')
                    .val(),
                  SalesVolumeProduction: tableRowInputs
                    .find('.sales_volume_production')
                    .val(),
                  SalesQuarter: tableRowInputs
                    .find('.sales_quarter_specify')
                    .val(),
                  GrossSales: tableRowInputs.find('.sales_gross_sales').val(),
                };
                salesData.push(salesDetails);
              });
              employmentGeneratedTableRow.each(function () {
                const tableRowInputs = $(this);
                const employmentGeneratedDetails = {
                  Employment_total: tableRowInputs
                    .find('.employment_total')
                    .val(),
                  Employment_Male: tableRowInputs
                    .find('.employment_male')
                    .val(),
                  Employment_Female: tableRowInputs
                    .find('.employment_female')
                    .val(),
                  Employment_PWD: tableRowInputs.find('.employment_pwd').val(),
                };
                employmentGeneratedData.push(employmentGeneratedDetails);
              });

              indirectEmploymentTableRow.each(function () {
                const tableRowInputs = $(this);
                const indirectEmploymentDetails = {
                  IndirectEmployment_total: tableRowInputs
                    .find('.indirect_employment_total')
                    .val(),
                  IndirectEmployment_ForwardMale: tableRowInputs
                    .find('.indirect_employment_forward_male')
                    .val(),
                  IndirectEmployment_ForwardFemale: tableRowInputs
                    .find('.indirect_employment_forward_female')
                    .val(),
                  InderectEmplyment_ForwardTotal: tableRowInputs
                    .find('.indirect_employment_forward_total')
                    .val(),
                  IndirectEmployment_BackwardMale: tableRowInputs
                    .find('.indirect_employment_backward_male')
                    .val(),
                  IndirectEmployment_BackwardFemale: tableRowInputs
                    .find('.indirect_employment_backward_female')
                    .val(),
                  IndirectEmployment_BackwardTotal: tableRowInputs
                    .find('.indirect_employment_backward_total')
                    .val(),
                };
                indirectEmploymentData.push(indirectEmploymentDetails);
              });

              return {
                ExpectedAndActualData: expectedAndActualData,
                EquipmentData: equipmentData,
                NonEquipmentData: nonEquipmentData,
                SalesData: salesData,
                EmploymentGeneratedData: employmentGeneratedData,
                IndirectEmploymentData: indirectEmploymentData,
              };
            };

            console.log(TableData());

            return (thisFormObject = { ...thisFormObject, ...TableData() });
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
      $('#CreateQuarterlyReportForm').on('submit', function (e) {
        e.preventDefault();
        const project_id = $('#ProjectID').val();
        const formData = $(this).serialize() + '&project_id=' + project_id;
        $.ajax({
          type: 'POST',
          url: DASHBBOARD_TAB_ROUTE.STORE_NEW_QUARTERLY_REPORT,
          data: formData,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
          success: function (response) {
            getQuarterlyReports(project_id);
            showToastFeedback('text-bg-success', response.message);
          },
          error: function (error) {
            showToastFeedback('text-bg-danger', error.responseJSON.message);
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
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
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
              quarterOrder.indexOf(quarterA) - quarterOrder.indexOf(quarterB)
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
            report.report_status === 'open' ? 'bg-primary' : 'text-bg-secondary'
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
          console.log(error);
          showToastFeedback('text-bg-danger', error.responseJSON.message);
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
      $('#updateQuarterlyRecordModal').on('show.bs.modal', function (event) {
        const triggeredbutton = $(event.relatedTarget);
        const record = triggeredbutton.data('record-id');
        const triggeredButtonRow = triggeredbutton.closest('tr');

        const modal = $(this);
        const reportStatus =
          triggeredButtonRow.find('span.badge:contains("open")').length > 0
            ? 'open'
            : 'closed';
        modal.find('#updateQuarterlyRecord').attr('data-record-id', record);

        modal
          .find('#toogleReport')
          .prop('checked', reportStatus === 'open' ? true : false);
        modal.find('#updateQuarterlyRecord').attr('data-record-id', record);

        $('#updateQuarterlyRecord').on('click', function () {
          const record_id = $(this).data('record-id');
          updateQuarterlyReport(record_id);
        });
      });

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
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
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
          showToastFeedback('text-bg-danger', error.responseJSON.message);
        }
      };
    },
    Projects: () => {
      $('#approvedTable').DataTable({
        columnDefs: [
          {
            targets: 0,
            width: '5%',
          },
          {
            targets: 1,
            width: '10%',
          },
          {
            targets: 2,
            width: '15%',
          },
          {
            targets: 3,
            width: '30%',
          },
          {
            targets: 4,
            width: '10%',
          },
          {
            targets: 5,
            width: '2%',
          },
        ],
      });
      $('#ongoingTable').DataTable({
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

      $('#ApprovedtableBody').on('click', '.approvedProjectInfo', function () {
        const row = $(this).closest('tr');
        const inputs = row.find('input');

        const values = {
          cooperatorName: row.find('td:eq(1)').text().trim(),
          designation: inputs.filter('.designation').val(),
          b_id: inputs.filter('.business_id').val(),
          businessAddress: inputs.filter('.business_address').val(),
          typeOfEnterprise: inputs.filter('.enterprise_type').val(),
          enterpriseLevel: inputs.filter('.enterprise_level').val(),
          landline: inputs.filter('.landline').val(),
          mobilePhone: inputs.filter('.mobile_number').val(),
          email: inputs.filter('.email').val(),
          ProjectId: row.find('td:eq(0)').text().trim(),
          ProjectTitle: row.find('td:eq(3)').text().trim(),
          Amount: parseFloat(
            inputs.filter('.fund_amount').val().replace(/,/g, '')
          ),
          Applied: inputs.filter('.dateApplied').val(),
          evaluated: inputs.filter('.evaluated_by').val(),
          Assigned_to: inputs.filter('.assigned_to').val(),
          building: parseFloat(
            inputs.filter('.building_Assets').val().replace(/,/g, '')
          ),
          equipment: parseFloat(
            inputs.filter('.equipment_Assets').val().replace(/,/g, '')
          ),
          workingCapital: parseFloat(
            inputs.filter('.working_capital_Assets').val().replace(/,/g, '')
          ),
        };

        $('#cooperatorName').val(values.cooperatorName);
        $('#designation').val(values.designation);
        $('#b_id').val(values.b_id);
        $('#businessAddress').val(values.businessAddress);
        $('#typeOfEnterprise').val(values.typeOfEnterprise);
        $('#enterpriseLevel').val(values.enterpriseLevel);
        $('#landline').val(values.landline);
        $('#mobilePhone').val(values.mobilePhone);
        $('#email').val(values.email);
        $('#ProjectId').val(values.ProjectId);
        $('#ProjectTitle').val(values.ProjectTitle);
        $('#Amount').val(
          values.Amount.toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
        );
        $('#Applied').val(values.Applied);
        $('#evaluated').val(values.evaluated);
        $('#Assigned_to').val(values.Assigned_to);
        $('#building').val(
          values.building.toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
        );
        $('#equipment').val(
          values.equipment.toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
        );
        $('#workingCapital').val(
          values.workingCapital.toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
        );

        const approvedProjectOffcanvas = $('#approvedDetails');
        const userName = inputs.filter('.staffUserName').val();
        const authUserName = '{{ Auth::user()->user_name }}';
        if (
          userName !== undefined &&
          userName !== null &&
          authUserName === userName
        ) {
          approvedProjectOffcanvas.find('.offcanvas-body').after(`
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
          approvedProjectOffcanvas.find('.menu-container').remove();
        }
      });

      $('#addRequirement').on('click', function () {
        let RequirementLinkContent = $('#linkContainer');
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

      $('#linkContainer').on('click', '.removeRequirement', function () {
        $(this).closest('.linkConstInstance').remove();
      });

      $('#approvedDetails').on('click', '[data-display-section]', function () {
        // Cache the data attribute value
        let sectionId = $(this).data('display-section');
        // Cache the section container selector
        let sectionContainer = $('.section-container');

        // Hide all sections in one go, instead of calling hide() on each element
        sectionContainer.hide();

        // Toggle the display of the selected section
        $('#' + sectionId).toggle();
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
      });
      async function getApprovedProjects() {
        try {
          const response = await fetch(
            PROJECT_TAB_ROUTE.GET_APPROVED_PROJECTS,
            {
              method: 'GET',
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
              },
              dataType: 'json',
            }
          );
          const data = await response.json();
          const ApprovedDatatable = $('#approvedTable').DataTable();
          ApprovedDatatable.clear().draw();
          data.forEach((Approved) => {
            ApprovedDatatable.row
              .add([
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
                                        <input type="hidden" class="dateApplied" value="${
                                          Approved.date_applied
                                        }">
                                        <input type="hidden" class="staffUserName" value="${
                                          Approved.staffUserName
                                        }">
                                        <input type="hidden" class="evaluated_by" value="${
                                          Approved?.evaluated_by_prefix +
                                          '' +
                                          Approved.evaluated_by_f_name +
                                          ' ' +
                                          Approved?.evaluated_by_mid_name +
                                          ' ' +
                                          Approved?.evaluated_by_l_name +
                                          ' ' +
                                          Approved?.evaluated_by_suffix
                                        }">
                                        <input type="hidden" class="assigned_to" value="${
                                          Approved?.handled_by_prefix +
                                          '' +
                                          Approved.handled_by_f_name +
                                          ' ' +
                                          Approved?.handled_by_mid_name +
                                          ' ' +
                                          Approved?.handled_by_l_name +
                                          ' ' +
                                          Approved?.handled_by_suffix
                                        }">`,
                `${Approved.date_approved}`,
                ` <button class="btn btn-primary approvedProjectInfo" type="button"
                                                                data-bs-toggle="offcanvas" data-bs-target="#approvedDetails"
                                                                aria-controls="approvedDetails">
                                                                <i class="ri-menu-unfold-4-line ri-1x"></i>
                                                            </button>`,
              ])
              .draw(false);
          });
        } catch (error) {
          console.error('Error:', error);
        }
      }

      async function getOngoingProjects() {
        try {
          const response = await fetch(PROJECT_TAB_ROUTE.GET_ONGOING_PROJECTS, {
            method: 'GET',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            dataType: 'json',
          });
          const data = await response.json();
          const OngoingDatatable = $('#ongoingTable').DataTable();
          OngoingDatatable.clear().draw();
          data.forEach((Ongoing) => {
            const fund_amount = parseFloat(Ongoing.fund_amount);
            const amount_refunded = parseFloat(Ongoing.amount_refunded);
            const to_be_refunded = parseFloat(Ongoing.to_be_refunded);

            const percentage = Math.ceil(
              (amount_refunded / to_be_refunded) * 100
            );
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
                ` <button class="btn btn-primary ongoingProjectInfo" type="button" data-bs-toggle="offcanvas"
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
            const response = await fetch(PROJECT_TAB_ROUTE.GET_COMPLETED_PROJECTS, {
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
                    `<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
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

      getApprovedProjects();
      getOngoingProjects();
      getCompletedProjects();
    },
    Applicant: () => {
      new DataTable('#applicant'); // Then initialize DataTables
      $('#evaluationSchedule-datepicker').on('change', function(){
        const selectedDate = new Date(this.value);
        const currentDate = new Date();

        if (selectedDate < currentDate) {
            this.value = this.min;
        }

      });
      formatToNumber('#fundAmount');

      console.log('this event is triggered');
      $('#ApplicantTableBody').on(
        'click',
        '.applicantDetailsBtn',
        async function () {
          console.log('This is clicked');
          const row = $(this).closest('tr');

          const fullName = row.find('td:nth-child(1)').text().trim();
          const designation = row.find('td:nth-child(2)').text().trim();
          const firmName = row
            .find('td:nth-child(3) span.firm_name')
            .text()
            .trim();
          const userID = row.find('td:nth-child(3) input[name="userID"]').val();
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
          // Add more fields as needed
          console.log(businessID);

          $('#firm_name').val(firmName);
          $('#selected_userId').val(userID);
          $('#selected_businessID').val(businessID);
          $('#address').val(businessAddress);
          $('#contact_person').val(fullName); // Add corresponding value
          $('#designation').val(designation);
          $('#enterpriseType').val(enterpriseType);
          $('#landline').val(landline);
          $('#mobile_phone').val(mobilePhone);
          $('#email').val(emailAddress);

          getEvaluationScheduledDate(businessID);

          // Get requirement and call the populateReqTable function
          try {
            const response = await $.ajax({
              type: 'GET',
              url: ApplicantTabRoute.getApplicantRequirementsLink,
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
              },
              data: {
                selected_businessID: $('#selected_businessID').val(),
              },
            });
            populateReqTable(response);
          } catch (error) {
            console.log(error);
          }
        }
      );

      function getEvaluationScheduledDate(businessID) {
        $.ajax({
          type: 'GET',
          url: ApplicantTabRoute.getEvaluationScheduleDate,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
          data: {
            business_id: businessID,
          },
          success: function (response) {
            let nofi_dateCont = $('#nofi_ScheduleCont');
            let setAndUpdateBtn = $('#setEvaluationDate');
            nofi_dateCont.empty();
            if (response.Scheduled_date) {
              nofi_dateCont.append(
                '<div class="alert alert-primary my-auto" role="alert">An evaluation date of <strong>' +
                  response.Scheduled_date +
                  '</strong> has been set for this applicant. <p class="my-auto text-secondary">Applicant is already notified through email and notification.</p></div>'
              );
              setAndUpdateBtn.text('Update');
            } else {
              nofi_dateCont.append(
                '<div class="alert alert-primary my-auto" role="alert">No evaluation date has been set for this applicant.</div>'
              );
            }
          },
          error: function (error) {
            console.log(error);
          },
        });
      }
      //Get applicant requirements to populate the requirements table
      function populateReqTable(response) {
        let requimentTableBody = $('#requirementsTables');

        requimentTableBody.empty();

        $.each(response, function (index, requirement) {
          const row = $('<tr>');
          row.append('<td>' + requirement.file_name + '</td>');
          row.append('<td>' + requirement.file_type + '</td>');
          row.append(
            '<td class="text-center">' +
              '<button class="btn btn-primary viewReq">View</button>' +
              '</td>'
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
      $('#requirementsTables').on('click', '.viewReq', function () {
        const row = $(this).closest('tr');
        const file_Name = row.find('td:nth-child(1)').text();
        const fileUrl = row.find('input[type="hidden"][name="file_url"]').val();
        const fileType = row.find('td:nth-child(2)').text();
        const uploadedDate = row
          .find('input[type="hidden"][name="created_at"]')
          .val();
        const updatedDate = row
          .find('input[type="hidden"][name="updated_at"]')
          .val();
        const uploader = $('#contact_person').val();

        $('#fileName').val(file_Name);
        $('#filetype').val(fileType);
        $('#fileUploaded').val(uploadedDate);
        $('#fileUploadedBy').val(updatedDate);
        $('#fileUploadedBy').val(uploader);
        retrieveAndDisplayFile(fileUrl, fileType);
      });

      //retrieve and display file function as base64 format for both pdf and img type
      async function retrieveAndDisplayFile(fileUrl, fileType) {
        try {
          const response = await $.ajax({
            url: ApplicantTabRoute.getRequirementFiles,
            method: 'GET',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
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
              'data:application/pdf;base64,' + response.base64File + '';
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
            document.getElementById('reviewFileModal')
          );
          reviewFileModal.show();
        }
      }

      //set evaluation date
      $('#setEvaluationDate').on('click', function () {
        let user_id = $('#selected_userId').val();
        let business_id = $('#selected_businessID').val();
        let Scheduledate = $('#evaluationSchedule-datepicker').val();

        $.ajax({
          type: 'PUT',
          url: ApplicantTabRoute.setEvaluationScheduleDate,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
          data: {
            user_id: user_id,
            business_id: business_id,
            evaluation_date: Scheduledate,
          },
          success: function (response) {
            console.log(response);
            if (response.success == true) {
              getEvaluationScheduledDate(business_id);
            }
          },
          error: function (error) {
            console.log(error);
          },
        });
      });

      //submit project proposal
      $('#submitProjectProposal').on('click', async function (event) {
        event.preventDefault();

        let b_id = $('#selected_businessID').val();
        let formdata =
          $('#projectProposal').serialize() + '&business_id=' + b_id;

        try {
          const response = await $.ajax({
            type: 'POST',
            url: ApplicantTabRoute.submitProjectProposal,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: formdata,
          });

          if (response.success == 'true') {
            closeOffcanvasInstances('#applicantDetails');
            setTimeout(() => {
              showToastFeedback('text-bg-success', response.message);
            }, 500);
          }
        } catch (error) {
          showToastFeedback('text-bg-danger', error.responseJSON.message);
        }
      });
    },
  };
  return functions;
};
