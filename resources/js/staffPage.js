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

//close offcanvas
function closeOffcanvasInstances(offcanva_id) {
  const offcanvasElement = $(offcanva_id).get(0);
  const offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasElement);
  offcanvasInstance.hide();
}

//format currency

function formatCurrency(inputSelector) {
  $(inputSelector).on('input', function () {
    let value = $(this)
      .val()
      .replace(/[^0-9.]/g, '');
    if (value.includes('.')) {
      let parts = value.split('.');
      parts[1] = parts[1].substring(0, 2);
      value = parts.join('.');
    }
    let formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    $(this).val(formattedValue);
  });
}

function closeModal(modelId) {
  const model = bootstrap.Modal.getInstance(modelId);
  model.hide();
}

$(document).on('DOMContentLoaded', function () {
  function makeData() {
    var data = [];
    for (var i = 0; i < 10; i++) {
      data.push(Math.floor(Math.random() * 100)); // Generates random numbers between 0 and 99
    }
    console.log(data);
    return data;
  }

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
      const lineChartOptions = {
        theme: {
          mode: 'light',
        },
        series: [
          {
            name: 'Applicant',
            data: [10, 20, 15, 30, 25, 40, 35, 50, 45, 60],
          },
          {
            name: 'Ongoing',
            data: [5, 10, 7, 12, 9, 15, 11, 18, 13, 20],
          },
          {
            name: 'Completed',
            data: [2, 4, 3, 6, 5, 8, 7, 10, 9, 12],
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

      const lineChart = new ApexCharts(
        document.querySelector('#lineChart'),
        lineChartOptions
      );
      lineChart.render();

      // initialize datatable
      new DataTable('#handledProject');

      //Foramt Input with Id paymentAmount
      formatCurrency('#paymentAmount');

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
      $('#nav-GeneratedSheets-tab').on('shown.bs.tab', () => {
        $('.GeneratedSheetsTabMenu').removeClass('d-none');
        $('.AttachlinkTabMenu').addClass('d-none');
      });
      $('#nav-GeneratedSheets-tab').on('hidden.bs.tab', () => {
        $('.GeneratedSheetsTabMenu').addClass('d-none');
        $('.AttachlinkTabMenu').removeClass('d-none');
      });

      $('#nav-link-tab').on('shown.bs.tab', () =>
        $('.GeneratedSheetsTabMenu').addClass('d-none')
      );
      $('#nav-link-tab').on('hidden.bs.tab', () =>
        $('.GeneratedSheetsTabMenu').removeClass('d-none')
      );
      $('#nav-details-tab').on('shown.bs.tab', () => {
        $('.AttachlinkTabMenu').addClass('d-none');
        $('.GeneratedSheetsTabMenu').addClass('d-none');
      });
      $('#nav-details-tab').on('hidden.bs.tab', () => {
        $('.AttachlinkTabMenu').removeClass('d-none');
        $('.GeneratedSheetsTabMenu').removeClass('d-none');
      });

      /**
       * Fetches handled projects from the server and updates the handled project table.
       *
       * @return {void}
       */
      const getHandleProject = async () => {
        const response = await fetch(DashboardTabRoute.GET_HANDLED_PROJECTS, {
          method: 'GET',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
        });
        const data = await response.json();
        const handledProjectTable = $('#handledProject').DataTable();
        handledProjectTable.clear();
        handledProjectTable.rows.add(
          data.map((project) => [
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
                <input type="hidden" class="building_value" value="${parseFloat(
                  project.building_value
                ).toLocaleString('en-US', { minimumFractionDigits: 2 })}">
                <input type="hidden" class="equipment_value" value="${parseFloat(
                  project.equipment_value
                ).toLocaleString('en-US', { minimumFractionDigits: 2 })}">
                <input type="hidden" class="working_capital" value="${parseFloat(
                  project.working_capital
                ).toLocaleString('en-US', { minimumFractionDigits: 2 })}">`,
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
            `${parseFloat(project.fund_amount).toLocaleString('en-US', {
              minimumFractionDigits: 2,
            })}`,
            `<span class="badge ${
              project.application_status === 'approved'
                ? 'bg-warning'
                : project.application_status === 'ongoing'
                ? 'bg-primary'
                : project.application_status === 'completed'
                ? 'bg-sucesss'
                : 'bg-danger'
            }">${project.application_status}</span>`,
            `<button class="btn btn-primary handleProjectbtn" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#handleProjectOff" aria-controls="handleProjectOff">
                    <i class="ri-menu-unfold-4-line ri-1x"></i>
                </button>`,
          ])
        );
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
            url: DashboardTabRoute.STORE_PAYMENT_RECORDS,
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
          showToastFeedback('text-bg-danger', error.responseJSON.message);
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
            url: DashboardTabRoute.UPDATE_PAYMENT_RECORDS.replace(
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
        const submissionMethod = $(this).data('submissionmethod');

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
              DashboardTabRoute.GET_PAYMENT_RECORDS +
              '?project_id=' +
              projectId,
          });

          const paymentHistoryTable = $('#paymentHistoryTable').DataTable();
          paymentHistoryTable.clear();
          paymentHistoryTable.rows.add(
            response.map((payment) => [
              payment.transaction_id,
              parseFloat(payment.amount).toLocaleString('en-US', {
                minimumFractionDigits: 2,
              }),
              payment.payment_method,
              payment.payment_status,
              payment.created_at,
              `<button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#paymentModal"
                                        data-action="Update"><i class="ri-file-edit-fill"></i></button>
                        <button class="btn btn-danger btn-sm deleteRecord" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" data-delete-record-type="projectPayment"><i class="ri-delete-bin-2-fill"></i></button>`,
            ])
          );
          paymentHistoryTable.draw();

          let totalAmount = 0;
          response.forEach((payment) => {
            totalAmount += parseFloat(payment.amount);
          });
          return totalAmount;
        } catch (error) {
          showToastFeedback('text-bg-danger', error.responseJSON.message);
          throw error;
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

          // Cache values from the row
          const project_status = handledProjectRow
            .find('td:eq(5)')
            .text()
            .trim();
          const project_id = handledProjectRow.find('td:eq(0)').text().trim();
          const projectTitle = handledProjectRow.find('td:eq(1)').text().trim();
          const amount = handledProjectRow.find('td:eq(4)').text().trim();
          const firmName = handledProjectRow
            .find('td:eq(2) p.firm_name')
            .text()
            .trim();
          const cooperatorName = handledProjectRow
            .find('td:eq(3) p.owner_name')
            .text()
            .trim();

          handleProjectOffcanvasContent(project_status);
          getPaymentHistoryAndCalculation(project_id);
          getProjectLinks(project_id);
          getQuarterlyReports(project_id);
          getAvailableQuarterlyReports(project_id);

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
          const buildingAsset = hiddenInputs.filter('.building_value').val();
          const equipmentAsset = hiddenInputs.filter('.equipment_value').val();
          const workingCapitalAsset = hiddenInputs
            .filter('.working_capital')
            .val();

          // Calculate age
          const age = Math.floor(
            (new Date() - birthDate) / (365.25 * 24 * 60 * 60 * 1000)
          );

          // Update form fields
          $('#hiddenbusiness_id').val(business_id);
          $('#age').val(age);
          $('#ProjectID').val(project_id);
          $('#ProjectTitle').val(projectTitle);
          $('#amount').val(amount);
          $('#appliedDate').val(dateApplied);
          $('#FirmName').val(firmName);
          $('#CooperatorName').val(cooperatorName);
          $('#Gender').val(gender);
          $('#landline').val(landline);
          $('#mobilePhone').val(mobilePhone);
          $('#email').val(email);
          $('#enterpriseType').val(enterpriseType);
          $('#EnterpriseLevel').val(enterpriseLevel);
          $('#buildingAsset').val(buildingAsset);
          $('#equipmentAsset').val(equipmentAsset);
          $('#workingCapitalAsset').val(workingCapitalAsset);
        }
      );

      const getPaymentHistoryAndCalculation = async (project_id) => {
        try {
          const totalAmount = await getPaymentHistory(project_id);
          const amount = $('#amount').val();
          const fundedAmount = parseFloat(amount.replace(/,/g, ''));
          const remainingAmount = fundedAmount - totalAmount;
          const percentage = Math.round((totalAmount / fundedAmount) * 100);
          $('#totalPaid').text(
            totalAmount.toLocaleString('en-US', {
              minimumFractionDigits: 2,
            })
          );
          $('#FundedAmount').text(
            fundedAmount.toLocaleString('en-US', {
              minimumFractionDigits: 2,
            })
          );
          $('#remainingBalance').text(
            remainingAmount.toLocaleString('en-US', {
              minimumFractionDigits: 2,
            })
          );

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
              DashboardTabRoute.GET_PROJECT_LINKS + '?project_id=' + Project_id,
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
            url: DashboardTabRoute.STORE_PAYMENT_LINKS,
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
            url: DashboardTabRoute.UPDATE_PROJECT_LINKS.replace(
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
                ? DashboardTabRoute.DELETE_PAYMENT_RECORDS.replace(
                    ':transaction_id',
                    uniqueVal
                  )
                : recordToDelete === 'projectLinkRecord'
                ? DashboardTabRoute.DELETE_PROJECT_LINK.replace(
                    ':project_link_name',
                    uniqueVal
                  )
                : recordToDelete === 'quarterlyRecord'
                ? DashboardTabRoute.DELETE_QUARTERLY_REPORT.replace(
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
                ? getQuarterlyReports(project_id) : null;
            } catch (error) {
              console.log(error);
              showToastFeedback('text-bg-danger', error.responseJSON.message);
            }
          });
      });

      $('#MarkhandleProjectBtn').on('click', function () {
        $.ajax({
          type: 'PUT',
          url: DashboardTabRoute.SET_PROJECT_TO_ONGOING,
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

      //Cooperator Payment Progress
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
          console.log(paymentProgress);
          paymentProgress.destroy();
        }

        paymentProgress = new ApexCharts(
          document.querySelector('#progressPercentage'),
          options
        );
        paymentProgress.render();
      }

      const getAvailableQuarterlyReports = async (Project_id) => {
        try {
            const response = await $.ajax({
                type: 'GET',
                url: GenerateSheetsRoute.GET_AVAILABLE_QUARTERLY_REPORT.replace(':project_id', Project_id),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });
            $('#Select_quarter_to_Generate').append(response.html);
        } catch (error) {
            console.log(error);
        }
      }



      //TODO: Implement spinner for the ajax request

      const getProjectSheetForm = async (formType, Project_id,  {QuartertoUsed} = {}) => {
        try {
          const response = await $.ajax({
            type: 'GET',
            url:
              GenerateSheetsRoute.getProjectSheetForm
               .replace(':type', formType)
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
        await getProjectSheetForm(formType, Project_id, {QuartertoUsed: QuartertoUsed});

        const Form_EventListener = {
          PIS: () => {
            PISFormEvents();
          },
          PDS: () => {
            PDSFormEvents();
          },
        }[formType];
        Form_EventListener();
      });

      function inputsToCurrencyFormatter(thisInput) {
        let value = thisInput.val().replace(/[^0-9.]/g, '');

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
        console.log('Data Sheet Form Events Loaded');
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
        const calculateToBeAccomplishedProductivity = (
          CurrentgrossSales,
          PreviousgrossSales
        ) => {
          const increaseInProductivityRow = $(
            '#ToBeAccomplished .increaseInProductivity'
          );

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

          const increaseInProductivityByPercent =
            ((CurrentgrossSales - PreviousgrossSales) / PreviousgrossSales) *
            100;
          console.log(increaseInProductivityByPercent);
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

            const thisRow = thisInput.closest('tr');
            const CurrentgrossSales = parseValue(
              thisRow.find('.CurrentgrossSales_val').val()
            );
            const PreviousgrossSales = parseValue(
              thisRow.find('.PreviousgrossSales_val').val()
            );

            const TotalgrossSales = CurrentgrossSales - PreviousgrossSales;
            thisRow.find('.TotalgrossSales_val').val(
              TotalgrossSales.toLocaleString('en-US', {
                minimumFractionDigits: 2,
              })
            );
            calculateToBeAccomplishedProductivity(
              CurrentgrossSales,
              PreviousgrossSales
            );
          }
        );

        /**
         * Calculates the percentage increase in employment.
         *
         * @param {number} CurrentEmployment - The current employment value.
         * @param {number} PreviousEmployment - The previous employment value.
         * @return {void}
         */
        const calculateToBeAccomplishedEmployment = (
          CurrentEmployment,
          PreviousEmployment
        ) => {
          const increaseInEmploymentRow = $(
            '#ToBeAccomplished .increaseInEmployment'
          );

          increaseInEmploymentRow.find('.CurrentEmployment_val_cal').text(
            CurrentEmployment.toLocaleString('en-US', {
              minimumFractionDigits: 2,
            })
          );
          increaseInEmploymentRow.find('.PreviousEmployment_val_cal').text(
            PreviousEmployment.toLocaleString('en-US', {
              minimumFractionDigits: 2,
            })
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

            const thisRow = thisInput.closest('tr');
            const CurrentEmployment = parseValue(
              thisRow.find('.CurrentEmployment_val').val()
            );
            const PreviousEmployment = parseValue(
              thisRow.find('.PreviousEmployment_val').val()
            );
            const TotalEmployment = CurrentEmployment - PreviousEmployment;
            thisRow.find('.TotalEmployment_val').val(
              TotalEmployment.toLocaleString('en-US', {
                minimumFractionDigits: 2,
              })
            );
            calculateToBeAccomplishedEmployment(
              CurrentEmployment,
              PreviousEmployment
            );
          }
        );

        calculateTotalEmployment();
        calculateTotals();
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
          $('#PISFormContainer , #PDSFormContainer').remove();
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
            let route_url = await {
              PIS: GenerateSheetsRoute.generateProjectInformationSheet,
              PDS: GenerateSheetsRoute.generateDataSheetReport,
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
          url: DashboardTabRoute.STORE_NEW_QUARTERLY_REPORT,
          data: formData,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
          success: function (response) {
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
              DashboardTabRoute.GET_QUARTERLY_REPORT_RECORDS +
              '?project_id=' +
              project_id,
          });
          response !== null && TableContainer.empty();
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
            url: DashboardTabRoute.UPDATE_QUARTERLY_REPORT.replace(
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
            width: '20%',
          },
          {
            targets: 4,
            width: '10%',
          },
          {
            targets: 5,
            width: '5%',
          },
        ],
      });
      $('#ongoingTable').DataTable();
      $('#completed').DataTable();

      $('#ApprovedtableBody').on('click', '.approvedProjectInfo', function () {
        const row = $(this).closest('tr');
        const inputs = row.find('input');

        $('#cooperatorName').val(row.find('td:eq(1)').text().trim());
        $('#designation').val(inputs.filter('.designation').val());
        $('#b_id').val(inputs.filter('.business_id').val());
        $('#businessAddress').val(inputs.filter('.business_address').val());
        $('#typeOfEnterprise').val(inputs.filter('.enterprise_type').val());
        $('#enterpriseLevel').val(inputs.filter('.enterprise_level').val());
        $('#landline').val(inputs.filter('.landline').val());
        $('#mobilePhone').val(inputs.filter('.mobile_number').val());
        $('#email').val(inputs.filter('.email').val());
        $('#ProjectId').val(row.find('td:eq(0)').text().trim());
        $('#ProjectTitle').val(row.find('td:eq(3)').text().trim());
        $('#Amount').val(
          parseFloat(
            inputs.filter('.fund_amount').val().replace(/,/g, '')
          ).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
        );
        const dateAppliedValue = inputs.filter('.dateApplied').val();
        console.log(dateAppliedValue);
        $('#Applied').val(inputs.filter('.dateApplied').val());
        $('#evaluated').val(inputs.filter('.evaluated_by').val());
        $('#Assigned_to').val(inputs.filter('.assigned_to').val());
        $('#building').val(
          parseFloat(
            inputs.filter('.building_Assets').val().replace(/,/g, '')
          ).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
        );
        $('#equipment').val(
          parseFloat(
            inputs.filter('.equipment_Assets').val().replace(/,/g, '')
          ).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
        );
        $('#workingCapital').val(
          parseFloat(
            inputs.filter('.working_capital_Assets').val().replace(/,/g, '')
          ).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
        );

        const approvedProjectOffcanvas = $('#approvedDetails');
        const userName = inputs.filter('.staffUserName').val();
        const authUserName = '{{ Auth::user()->user_name }}';
        console.log(userName);
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

      fetch(ProjectTabRoute.projectApprovalLink, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        dataType: 'json',
      })
        .then((response) => response.json())
        .then((data) => {
          let ApprovedDatatable = $('#approvedTable').DataTable();
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
                                      <input type="hidden" class="fund_amount" value="${Approved.fund_amount}">
                                      <input type="hidden" class="dateApplied" value="${Approved.date_applied}">
                                      <input type="hidden" class="staffUserName" value="${Approved.staffUserName}">
                                      <input type="hidden" class="evaluated_by" value="${Approved.evaluated_by}">
                                      <input type="hidden" class="assigned_to" value="${Approved.assinged_to}">`,
                `${Approved.date_approved}`,
                ` <button class="btn btn-primary approvedProjectInfo" type="button"
                                                              data-bs-toggle="offcanvas" data-bs-target="#approvedDetails"
                                                              aria-controls="approvedDetails">
                                                              <i class="ri-menu-unfold-4-line ri-1x"></i>
                                                          </button>`,
              ])
              .draw(false);
          });
        })
        .catch((error) => {
          console.error('Error:', error);
        });
    },
    Applicant: () => {
      new DataTable('#applicant'); // Then initialize DataTables
      $('#evaluationSchedule-datepicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        opens: 'center',
        drops: 'up',
        autoUpdateInput: false,
        timePicker: true,
        locale: {
          format: 'MM/DD/YYYY h:mm A',
        },
      });

      $('#evaluationSchedule-datepicker').on(
        'apply.daterangepicker',
        function (ev, picker) {
          $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm'));
        }
      );

      $('#evaluationSchedule-datepicker').on(
        'cancel.daterangepicker',
        function (ev, picker) {
          $(this).val('');
        }
      );

      console.log('this line in executed');

      formatCurrency('#fundAmount');

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
