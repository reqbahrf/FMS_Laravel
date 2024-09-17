window.initializeAdminPageJs = async () => {
  const functions = {
    Dashboard: () => {
      const overallProject = {
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

      const overallProjectGraph = new ApexCharts(
        document.querySelector('#overallProjectGraph'),
        overallProject
      );
      overallProjectGraph.render();

      // staff handled projects chart
      const handledBusiness = {
        theme: {
          mode: 'light',
        },
        series: [
          {
            name: 'Micro Enterprise',
            data: [21, 22, 10, 28, 16],
          },
          {
            name: 'Small Enterprise',
            data: [15, 25, 11, 19, 14],
          },
          {
            name: 'Medium Enterprise',
            data: [10, 20, 15, 24, 10],
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
          categories: ['Staff1', 'Staff2', 'Staff3', 'Staff4', 'Staff5'],
          labels: {
            style: {
              colors: ['#111111'],
              fontSize: '12px',
            },
          },
        },
      };

      new ApexCharts(
        document.querySelector('#staffHandledB'),
        handledBusiness
      ).render();

      const EnterpriseLevelOptions = {
        theme: {
          mode: 'light',
          palette: 'palette2',
        },
        series: [77, 58, 50],
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

      const pieChart = new ApexCharts(
        document.querySelector('#enterpriseLevelChart'),
        EnterpriseLevelOptions
      );
      pieChart.render();

      const TotalEnterpriseLocalOptions = {
        theme: {
          mode: 'light',
          palette: 'palette2',
        },
        series: [
          {
            name: 'Micro Enterprise',
            data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380],
          },
          {
            name: 'Small Enterprise',
            data: [300, 330, 348, 370, 440, 480, 590, 1000, 1100, 1280],
          },
          {
            name: 'Medium Enterprise',
            data: [200, 230, 248, 270, 340, 380, 490, 900, 1000, 1180],
          },
        ],
        chart: {
          type: 'bar',
          height: 350,
          stacked: true,
        },
        plotOptions: {
          bar: {
            borderRadius: 4,
            borderRadiusApplication: 'end',
            horizontal: true,
            columnWidth: '45%',
            distributed: false,
            endingShape: 'rounded',
          },
        },
        dataLabels: {
          enabled: false,
        },
        xaxis: {
          categories: [
            'Tagum City',
            'Panabo City',
            'Island Garden City of Samal',
            'Braulio E. Dujali',
            'Carmen',
            'Kapalong',
            'New Corella',
            'San Isidro',
            'Santo Tomas',
            'Talaingod',
          ],
        },
      };

      const localeChart = new ApexCharts(
        document.querySelector('#localeChart'),
        TotalEnterpriseLocalOptions
      );
      localeChart.render();
      {
      }
    },
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
      $('#ongoing').DataTable();
      $('#completed').DataTable();

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
          $('#ProjectId_fetch').val(response.Project_id);
          $('#ProjectTitle_fetch').val(response.project_title);
          $('#Amount_fetch').val(
            parseFloat(response.fund_amount).toLocaleString('en-US', {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2,
            })
          );
          $('#Applied_fetch').val(response.date_applied);
          $('#evaluated_fetch').val(response.name);

          $('#ProjectTitle_fetch').val('');
          $('#Amount_fetch').val('');
          $('#Applied_fetch').val('');
          $('#evaluated_fetch').val('');
        } catch (error) {
          console.log('Error: ' + error);
        }
      };

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

      async function getStafflist() {
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
              `<option value="${staff.staff_id}">${staff.full_name}</option>`
            );
          });
        } catch (error) {
          console.error('Error:', error);
        }
      }

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

      const approvedProjectProposal = (
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
            //window.loadPage('{{ route('admin.Project') }}', 'projectList');
          },
          error: function (xhr, status, error) {
            console.log(error);
          },
        });
      };

      //Submit the Approved Proposal
      $('#approvedButton').on('click', function () {
        if (
          typeof $('#b_id').val() !== 'undefined' &&
          typeof $('#ProjectId_fetch').val() !== 'undefined' &&
          typeof $('#Assigned_to').val() !== 'undefined'
        ) {
          approvedProjectProposal(
            $('#b_id').val(),
            $('#ProjectId_fetch').val(),
            $('#Assigned_to').val()
          );
        }
      });
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
        $('#user_staff').DataTable();
        (() => {
               'use strict'

               // Fetch all the forms we want to apply custom Bootstrap validation styles to
               const forms = document.querySelectorAll('.needs-validation')

               // Loop over them and prevent submission
               Array.from(forms).forEach(form => {
                   form.addEventListener('submit', event => {
                       if (!form.checkValidity()) {
                           event.preventDefault()
                           event.stopPropagation()
                       }

                       form.classList.add('was-validated')
                   }, false)
               })
           })();
    },
  };
  return functions;
};
