//Staff Main Page JS and dashboard Charts

// TODO Modularie these charts function initializations

$(document).on('DOMContentLoaded', function() {
      window.InitdashboardChar = function() {
          const lineChartOptions = {
              theme: {
                  mode: "light",
              },
              series: [
                  {
                      name: "Applicant",
                      data: [10, 20, 15, 30, 25, 40, 35, 50, 45, 60],
                  },
                  {
                      name: "Ongoing",
                      data: [5, 10, 7, 12, 9, 15, 11, 18, 13, 20],
                  },
                  {
                      name: "Completed",
                      data: [2, 4, 3, 6, 5, 8, 7, 10, 9, 12],
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

          const lineChart = new ApexCharts(
              document.querySelector("#lineChart"),
              lineChartOptions
          );
          lineChart.render();

          // initialize datatable
          new DataTable("#handledProject");
      }

       function makeData() {
          var data = [];
          for (var i = 0; i < 10; i++) {
              data.push(Math.floor(Math.random() * 100)); // Generates random numbers between 0 and 99
          }
          console.log(data);
          return data;
      }

      window.InitializeviewCooperatorProgress = function() {
         const Progressoptions = {
              series: [75],
              chart: {
                  height: 250,
                  type: "radialBar",
                  toolbar: {
                      show: true,
                  },
              },
              plotOptions: {
                  radialBar: {
                      startAngle: -135,
                      endAngle: 225,
                      hollow: {
                          margin: 0,
                          size: "70%",
                          background: "#fff",
                          image: undefined,
                          imageOffsetX: 0,
                          imageOffsetY: 0,
                          position: "front",
                          dropShadow: {
                              enabled: true,
                              top: 3,
                              left: 0,
                              blur: 4,
                              opacity: 0.24,
                          },
                      },
                      track: {
                          background: "#fff",
                          strokeWidth: "67%",
                          margin: 0, // margin is in pixels
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
                              color: "#888",
                              fontSize: "17px",
                          },
                          value: {
                              formatter: function (val) {
                                  return parseInt(val);
                              },
                              color: "#111",
                              fontSize: "36px",
                              show: true,
                          },
                      },
                  },
              },
              fill: {
                  type: "gradient",
                  gradient: {
                      shade: "dark",
                      type: "horizontal",
                      shadeIntensity: 0.5,
                      gradientToColors: ["#ABE5A1"],
                      inverseColors: true,
                      opacityFrom: 1,
                      opacityTo: 1,
                      stops: [0, 100],
                  },
              },
              stroke: {
                  lineCap: "round",
              },
              labels: ["Percent"],
          };

         const progresschart = new ApexCharts(
             document.querySelector("#progressBar"),
             Progressoptions
         );
          progresschart.render();

          //TODO: Production Generated Chart
          const productionGeneoptions = {
              series: [
                  {
                      name: "Growth",
                      data: [10, 15, 7, -12],
                  },
              ],
              chart: {
                  type: "bar",
                  height: 350,
              },
              plotOptions: {
                  bar: {
                      colors: {
                          ranges: [
                              {
                                  from: -100,
                                  to: -46,
                                  color: "#F15B46",
                              },
                              {
                                  from: -45,
                                  to: 0,
                                  color: "#FEB019",
                              },
                          ],
                      },
                      columnWidth: "80%",
                  },
              },
              dataLabels: {
                  enabled: false,
              },
              yaxis: {
                  title: {
                      text: "Growth",
                  },
                  labels: {
                      formatter: function (y) {
                          return y.toFixed(0) + "%";
                      },
                  },
              },
              xaxis: {
                  categories: [
                      "Quarter 1",
                      "Quarter 2",
                      "Quarter 3",
                      "Quarter 4",
                  ],
                  labels: {
                      rotate: -90,
                  },
              },
          };

          const productionGenechart = new ApexCharts(
              document.querySelector("#productionGeneChart"),
              productionGeneoptions
          );
          productionGenechart.render();

          //TODO: Employment Generated Chart

          const employmentGeneoptions = {
              series: [
                  {
                      name: "Growth",
                      data: [2, -2, 4, 5],
                  },
              ],
              chart: {
                  type: "bar",
                  height: 350,
              },
              plotOptions: {
                  bar: {
                      colors: {
                          ranges: [
                              {
                                  from: -100,
                                  to: -46,
                                  color: "#F15B46",
                              },
                              {
                                  from: -45,
                                  to: 0,
                                  color: "#FEB019",
                              },
                          ],
                      },
                      columnWidth: "80%",
                  },
              },
              dataLabels: {
                  enabled: false,
              },
              yaxis: {
                  title: {
                      text: "Growth",
                  },
                  labels: {
                      formatter: function (y) {
                          return y.toFixed(0) + "%";
                      },
                  },
              },
              xaxis: {
                  categories: [
                      "Quarter 1",
                      "Quarter 2",
                      "Quarter 3",
                      "Quarter 4",
                  ],
                  labels: {
                      rotate: -90,
                  },
              },
          };

          const employmentGenechart = new ApexCharts(
              document.querySelector("#employmentGeneChart"),
              employmentGeneoptions
          );
          employmentGenechart.render();
      }

      // Line chart
      //toast feedback
      window.showToastFeedback = function (status, message) {
          const toast = $("#ActionFeedbackToast");
          const toastInstance = new bootstrap.Toast(toast);

          toast
              .find(".toast-header")
              .removeClass([
                  "text-bg-danger",
                  "text-bg-success",
                  "text-bg-warning",
                  "text-bg-info",
                  "text-bg-primary",
                  "text-bg-light",
                  "text-bg-dark",
              ]);

          toast.find(".toast-body").text("");

          toast.find(".toast-header").addClass(status);
          toast.find(".toast-body").text(message);

          toastInstance.show();
      };

      //close offcanvas
      window.closeOffcanvasInstances = function (offcanva_id) {
          const offcanvasElement = $(offcanva_id).get(0);
          const offcanvasInstance =
              bootstrap.Offcanvas.getInstance(offcanvasElement);
          offcanvasInstance.hide();
      };

      //format currency

      window.formatCurrency = function (inputSelector) {
          $(inputSelector).on("input", function () {
              let value = $(this)
                  .val()
                  .replace(/[^0-9.]/g, ""); // Include decimal point in regex
              // Ensure two decimal places
              if (value.includes(".")) {
                  let parts = value.split(".");
                  parts[1] = parts[1].substring(0, 2); // Limit to two decimal places
                  value = parts.join(".");
              }

              // Add commas every three digits
              let formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

              // Set the new value to the input field
              $(this).val(formattedValue);
          });
      };

      window.closeModal = function (modelId) {
          const model = bootstrap.Modal.getInstance(modelId);
          model.hide();
      };

      //Side Nav toggle

      $('#sidebar_toggle').on('click', function () {
          const sidebar = document.querySelector(".sidenav");
          const logoDescription = document.querySelector("#logoTitle");
          logoDescription.classList.toggle("d-none");

          sidebar.classList.toggle("expanded");
          sidebar.classList.toggle("minimized");
          const container = $("#toggle-left-margin");
          if (container.hasClass("navExpanded")) {
              container.removeClass("navExpanded").addClass("navMinimized");
          } else {
              container.removeClass("navMinimized").addClass("navExpanded");
          }
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

       window.setActiveLink = function(activeLink) {
           $(".nav-item a").removeClass("active");
           var defaultLink = "dashboardLink";
           var linkToActivate = $("#" + (activeLink || defaultLink));
           linkToActivate.addClass("active");
       }
    //Dashboard Tab JS
    window.initializeDashboardTabEvents = function(){

        //Foramt Input with Id paymentAmount
         formatCurrency("#paymentAmount");

         $("#linkTable").DataTable({
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
                     render: function (data, type, row) {
                         return `<button class="btn btn-primary">Open</button>`;
                     },
                 },
             ],
         });

         //Handled Project Offcanvas Button Events
         $("#nav-GeneratedSheets-tab").on("shown.bs.tab", () => {
             $('.GeneratedSheetsTabMenu').removeClass("d-none");
             $(".AttachlinkTabMenu").addClass("d-none");
         });
         $("#nav-GeneratedSheets-tab").on("hidden.bs.tab", () => {
             $(".GeneratedSheetsTabMenu").addClass("d-none");
             $(".AttachlinkTabMenu").removeClass("d-none");
         });

         $("#nav-link-tab").on("shown.bs.tab", () =>
             $(".GeneratedSheetsTabMenu").addClass("d-none")
         );
         $("#nav-link-tab").on("hidden.bs.tab", () =>
             $(".GeneratedSheetsTabMenu").removeClass("d-none")
         );
         $("#nav-details-tab").on("shown.bs.tab", () => {
             $(".AttachlinkTabMenu").addClass("d-none")
             $(".GeneratedSheetsTabMenu").addClass("d-none");
         });
         $("#nav-details-tab").on("hidden.bs.tab", () => {
             $(".AttachlinkTabMenu").removeClass("d-none")
             $(".GeneratedSheetsTabMenu").removeClass("d-none")
         });

         fetchHandleProject();

         function fetchHandleProject() {
             fetch(DashboardTabRoute.getHandledProjects, {
                 method: "GET",
                 headers: {
                     "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                         "content"
                     ),
                 },
             })
                 .then((response) => response.json())
                 .then((data) => {
                     const handledProjectTable =
                         $("#handledProject").DataTable();
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
                    <input type="hidden" class="building_value" value="${parseFloat(
                        project.building_value
                    ).toLocaleString("en-US", { minimumFractionDigits: 2 })}">
                    <input type="hidden" class="equipment_value" value="${parseFloat(
                        project.equipment_value
                    ).toLocaleString("en-US", { minimumFractionDigits: 2 })}">
                    <input type="hidden" class="working_capital" value="${parseFloat(
                        project.working_capital
                    ).toLocaleString("en-US", { minimumFractionDigits: 2 })}">`,
                             `<p class="owner_name">${
                                 project.prefix +
                                 " " +
                                 project.f_name +
                                 " " +
                                 project.l_name +
                                 " " +
                                 project.suffix
                             }</p>
                    <input type="hidden" class="gender" value="${
                        project.gender
                    }">
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
                             `${parseFloat(project.fund_amount).toLocaleString(
                                 "en-US",
                                 { minimumFractionDigits: 2 }
                             )}`,
                             `<span class="badge ${
                                 project.application_status === "approved"
                                     ? "bg-warning"
                                     : project.application_status === "ongoing"
                                     ? "bg-primary"
                                     : project.application_status ===
                                       "completed"
                                     ? "bg-sucesss"
                                     : "bg-danger"
                             }">${project.application_status}</span>`,
                             `<button class="btn btn-primary handleProjectbtn" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#handleProjectOff" aria-controls="handleProjectOff">
                        <i class="ri-menu-unfold-4-line ri-1x"></i>
                    </button>`,
                         ])
                     );
                     handledProjectTable.draw();
                 });
         }

         //Determine The Content to be displayed on offcanvas based on the project status
         function handleProjectOffcanvasContent(project_status) {
             const handleProjectOffcanvas = $("#handleProjectOff");
             const content = {
                 approved: () => {
                     handleProjectOffcanvas
                         .find(".approvedProjectContent")
                         .removeClass("d-none");
                     handleProjectOffcanvas
                         .find(".ongoingProjectContent")
                         .addClass("d-none");
                 },
                 ongoing: () => {
                     handleProjectOffcanvas
                         .find(".ongoingProjectContent")
                         .removeClass("d-none");
                     handleProjectOffcanvas
                         .find(".approvedProjectContent")
                         .addClass("d-none");
                     handleProjectOffcanvas
                         .find("#paymentHistoryContainer")
                         .html(paymentHistoryTable());

                     $("#paymentHistoryTable").DataTable({
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
                     });
                 },
                 completed: () => {},
             };

             content[project_status]();
         }

         //Generate payment history datatable
         function paymentHistoryTable() {
             const paymentHistoryTable = `
                <table class="table table-hover table-sm" id="paymentHistoryTable" syle="width:100%">

                </table>
            `;
             return paymentHistoryTable;
         }

         $("#submitPayment").on("click", function () {
             let project_id = $("#ProjectID").val();

             let formData =
                 $("#paymentForm").serialize() + "&project_id=" + project_id;
             $.ajax({
                 type: "POST",
                 url: DashboardTabRoute.storePaymentRecords,
                 headers: {
                     "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                         "content"
                     ),
                 },
                 data: formData,
                 success: function (response) {
                     closeModal("#paymentModal");
                     fetchPaymentHistory(project_id);
                     setTimeout(() => {
                         showToastFeedback("text-bg-success", response.message);
                     }, 500);
                 },
                 error: function (error) {
                     showToastFeedback(
                         "text-bg-danger",
                         error.responseJSON.message
                     );
                 },
             });
         });

         //get the payment history

         async function fetchPaymentHistory(projectId) {
             try {
                 const response = await $.ajax({
                     type: "GET",
                     url:
                         DashboardTabRoute.getPaymentRecords +
                         "?project_id=" +
                         projectId,
                 });

                 const paymentHistoryTable = $(
                     "#paymentHistoryTable"
                 ).DataTable();
                 paymentHistoryTable.clear();
                 paymentHistoryTable.rows.add(
                     response.map((payment) => [
                         payment.transaction_id,
                         parseFloat(payment.amount).toLocaleString("en-US", {
                             minimumFractionDigits: 2,
                         }),
                         payment.payment_method,
                         payment.payment_status,
                         payment.created_at,
                     ])
                 );
                 paymentHistoryTable.draw();

                 let totalAmount = 0;
                 response.forEach((payment) => {
                     totalAmount += parseFloat(payment.amount);
                 });
                 return totalAmount;
             } catch (error) {
                 showToastFeedback(
                     "text-bg-danger",
                     error.responseJSON.message
                 );
                 throw error;
             }
         }

         //TODO: Implove the this event listener for the Offcanvas handled project
         $("#handledProjectTableBody").on(
             "click",
             ".handleProjectbtn",
             function () {
                 const handledProjectRow = $(this).closest("tr");
                 const hiddenInputs = handledProjectRow.find(
                     'input[type="hidden"]'
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
                 const amount = handledProjectRow
                     .find("td:eq(4)")
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

                 handleProjectOffcanvasContent(project_status);
                 fetchPaymentHistory(project_id)
                     .then((totalAmount) => {
                         const fundedAmount = parseFloat(
                             amount.replace(/,/g, "")
                         );
                         const remainingAmount = fundedAmount - totalAmount;
                         const percentage = Math.round(
                             (totalAmount / fundedAmount) * 100
                         );
                         $("#totalPaid").text(
                             totalAmount.toLocaleString("en-US", {
                                 minimumFractionDigits: 2,
                             })
                         );
                         $("#FundedAmount").text(
                             fundedAmount.toLocaleString("en-US", {
                                 minimumFractionDigits: 2,
                             })
                         );

                         setTimeout(() => {
                             InitializeviewCooperatorProgress(percentage);
                         }, 500);
                     })
                     .catch((error) => {
                         console.log(error);
                     });
                 fetchProjectLinks(project_id);

                 // Cache hidden input values
                 const business_id = hiddenInputs.filter(".business_id").val();
                 const birthDate = new Date(
                     hiddenInputs.filter(".birth_date").val()
                 );
                 const dateApplied = hiddenInputs.filter(".dateApplied").val();
                 const gender = hiddenInputs.filter(".gender").val();
                 const landline = hiddenInputs.filter(".landline").val();
                 const mobilePhone = hiddenInputs.filter(".mobile_phone").val();
                 const email = hiddenInputs.filter(".email").val();
                 const enterpriseType = hiddenInputs
                     .filter(".business_enterprise_type")
                     .val();
                 const enterpriseLevel = hiddenInputs
                     .filter(".business_enterprise_level")
                     .val();
                 const buildingAsset = hiddenInputs
                     .filter(".building_value")
                     .val();
                 const equipmentAsset = hiddenInputs
                     .filter(".equipment_value")
                     .val();
                 const workingCapitalAsset = hiddenInputs
                     .filter(".working_capital")
                     .val();

                 // Calculate age
                 const age = Math.floor(
                     (new Date() - birthDate) / (365.25 * 24 * 60 * 60 * 1000)
                 );

                 // Update form fields
                 $("#hiddenbusiness_id").val(business_id);
                 $("#age").val(age);
                 $("#ProjectID").val(project_id);
                 $("#ProjectTitle").val(projectTitle);
                 $("#amount").val(amount);
                 $("#appliedDate").val(dateApplied);
                 $("#FirmName").val(firmName);
                 $("#CooperatorName").val(cooperatorName);
                 $("#Gender").val(gender);
                 $("#landline").val(landline);
                 $("#mobilePhone").val(mobilePhone);
                 $("#email").val(email);
                 $("#enterpriseType").val(enterpriseType);
                 $("#EnterpriseLevel").val(enterpriseLevel);
                 $("#buildingAsset").val(buildingAsset);
                 $("#equipmentAsset").val(equipmentAsset);
                 $("#workingCapitalAsset").val(workingCapitalAsset);
             }
         );

         $("#addRequirement").on("click", function () {
             let RequirementLinkContent = $("#linkContainer");

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

         //link validation
         $("#linkContainer").on(
             "blur",
             'input[name="requirements_link"]',
             function () {
                 const linkConstInstance =
                     $(this).closest(".linkConstInstance");
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
                     fetch(proxyUrl)
                         .then((response) => response.json())
                         .then((data) => {
                             if (data.status === 200) {
                                 console.log("Link is valid:", data.status);
                                 linkConstInstance
                                     .find('input[name="requirements_link"]')
                                     .addClass("is-valid")
                                     .removeClass("is-invalid");
                             } else {
                                 console.log("Link is invalid:", data.status);
                                 linkConstInstance
                                     .find('input[name="requirements_link"]')
                                     .addClass("is-invalid")
                                     .removeClass("is-valid");
                             }
                         })
                         .catch((error) => {
                             console.error("Error fetching the link:", error);
                             linkConstInstance
                                 .find('input[name="requirements_link"]')
                                 .addClass("is-invalid")
                                 .removeClass("is-valid");
                         })
                         .finally(() => {
                             linkConstInstance.find(".spinner-border").remove();
                         });
                 } else {
                     linkConstInstance
                         .find('input[name="requirements_link"]')
                         .removeClass(["is-valid", "is-invalid"]);
                 }
             }
         );

         //Save the inputted links to the database
         $(".SaveLinkProjectBtn").on("click", function () {
             let requirementLinks = {};
             $(".linkConstInstance").each(function () {
                 let name = $(this)
                     .find('input[name="requirements_name"]')
                     .val();
                 let link = $(this)
                     .find('input[name="requirements_link"]')
                     .val();
                 requirementLinks[name] = link;
             });

             $.ajax({
                 type: "POST",
                 url: DashboardTabRoute.storeProjectLinks,
                 headers: {
                     "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                         "content"
                     ),
                 },
                 data: {
                     project_id: $("#ProjectID").val(),
                     linklist: requirementLinks,
                 },
                 success: function (response) {
                     showToastFeedback(
                         "text-bg-success",
                         "Links added successfully"
                     );
                 },
                 error: function (error) {
                     showToastFeedback(
                         "text-bg-danger",
                         error.responseJSON.message
                     );
                 },
             });
         });

         function fetchProjectLinks(Project_id) {
             $.ajax({
                 type: "GET",
                 url:
                     DashboardTabRoute.getProjectLinks +
                     "?project_id=" +
                     Project_id,
                 headers: {
                     "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                         "content"
                     ),
                 },
                 success: function (response) {
                     const linkDataTable = $("#linkTable").DataTable();
                     linkDataTable.clear();
                     linkDataTable.rows.add(
                         response.map((link) => [
                             link.file_name,
                             link.file_link,
                             link.created_at,
                         ])
                     );
                     linkDataTable.draw();
                 },
                 error: function (error) {
                     showToastFeedback(
                         "text-bg-danger",
                         error.responseJSON.message
                     );
                 },
             });
         }

         //Mark Approved Project to Ongoing
         $("#MarkhandleProjectBtn").on("click", function () {
             $.ajax({
                 type: "PUT",
                 url: DashboardTabRoute.setProjectToOngoing,
                 headers: {
                     "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                         "content"
                     ),
                 },
                 data: {
                     project_id: $("#ProjectID").val(),
                     business_id: $("#hiddenbusiness_id").val(),
                 },
                 success: function (response) {
                     closeOffcanvasInstances("#handleProjectOff");
                     setTimeout(() => {
                         showToastFeedback(
                             "text-bg-success",
                             "Project is now move to ongoing"
                         );
                     }, 500);
                 },
                 error: function (error) {
                     showToastFeedback(
                         "text-bg-danger",
                         error.responseJSON.message
                     );
                 },
             });
         });

         //Cooperator Payment Progress
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
                 console.log(paymentProgress);
                 paymentProgress.destroy();
             }

             paymentProgress = new ApexCharts(
                 document.querySelector("#progressPercentage"),
                 options
             );
             paymentProgress.render();
         }

         //Generate Project Information Sheets

         $('.GeneratePIS').on('click', async () => {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            try{
                let project_id = $("#ProjectID").val();
                let business_id = $("#hiddenbusiness_id").val();
                let form = $("#PIS_checklistsForm");
                const data = { ...form.serializeArray(), project_id, business_id };
                const response = await $.post(
                    GenerateSheetsRoute.generateProjectInformationSheet,
                    data,
                    null,
                );

                // $("#PIS_Modal_container").html(response);
                // ProjectInformationSheetModel.show();
            } catch(error){
                console.log(error);
            }
         });

    }



    //Project Tab JS

    window.initializeProjectTabEvents = function(){

        $("#approvedTable").DataTable({
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
                    width: "20%",
                },
                {
                    targets: 4,
                    width: "10%",
                },
                {
                    targets: 5,
                    width: "5%",
                },
            ],
        });
        $("#ongoingTable").DataTable();
        $("#completed").DataTable();

         $("#ApprovedtableBody").on("click", ".approvedProjectInfo", function () {
             const row = $(this).closest("tr");
             const inputs = row.find("input");
             console.log(inputs);

             $("#cooperatorName").val(row.find("td:eq(1)").text().trim());
             $("#designation").val(inputs.filter(".designation").val());
             $("#b_id").val(inputs.filter(".business_id").val());
             $("#businessAddress").val(inputs.filter(".business_address").val());
             $("#typeOfEnterprise").val(inputs.filter(".enterprise_type").val());
             $("#enterpriseLevel").val(inputs.filter(".enterprise_level").val());
             $("#landline").val(inputs.filter(".landline").val());
             $("#mobilePhone").val(inputs.filter(".mobile_number").val());
             $("#email").val(inputs.filter(".email").val());
             $("#ProjectId").val(row.find("td:eq(0)").text().trim());
             $("#ProjectTitle").val(row.find("td:eq(3)").text().trim());
             $("#Amount").val(
                 parseFloat(
                     inputs.filter(".fund_amount").val().replace(/,/g, "")
                 ).toLocaleString("en-US", {
                     minimumFractionDigits: 2,
                     maximumFractionDigits: 2,
                 })
             );
             const dateAppliedValue = inputs.filter(".dateApplied").val();
             console.log(dateAppliedValue);
             $("#Applied").val(inputs.filter(".dateApplied").val());
             $("#evaluated").val(inputs.filter(".evaluated_by").val());
             $("#Assigned_to").val(inputs.filter(".assigned_to").val());
             $("#building").val(
                 parseFloat(
                     inputs.filter(".building_Assets").val().replace(/,/g, "")
                 ).toLocaleString("en-US", {
                     minimumFractionDigits: 2,
                     maximumFractionDigits: 2,
                 })
             );
             $("#equipment").val(
                 parseFloat(
                     inputs.filter(".equipment_Assets").val().replace(/,/g, "")
                 ).toLocaleString("en-US", {
                     minimumFractionDigits: 2,
                     maximumFractionDigits: 2,
                 })
             );
             $("#workingCapital").val(
                 parseFloat(
                     inputs
                         .filter(".working_capital_Assets")
                         .val()
                         .replace(/,/g, "")
                 ).toLocaleString("en-US", {
                     minimumFractionDigits: 2,
                     maximumFractionDigits: 2,
                 })
             );

             const approvedProjectOffcanvas = $("#approvedDetails");
             const userName = inputs.filter(".staffUserName").val();
             const authUserName = "{{ Auth::user()->user_name }}";
             console.log(userName);
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
                 approvedProjectOffcanvas.find(".menu-container").remove();
             }
         });

          $("#addRequirement").on("click", function () {
              let RequirementLinkContent = $("#linkContainer");

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
                     let sectionId = $(this).data("display-section");
                     // Cache the section container selector
                     let sectionContainer = $(".section-container");

                     // Hide all sections in one go, instead of calling hide() on each element
                     sectionContainer.hide();

                     // Toggle the display of the selected section
                     $("#" + sectionId).toggle();
                 }
             );

                 fetch(ProjectTabRoute.projectApprovalLink, {
                     method: "POST",
                     headers: {
                         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                             "content"
                         ),
                     },
                     dataType: "json",
                 })
                     .then((response) => response.json())
                     .then((data) => {
                         let ApprovedDatatable =
                             $("#approvedTable").DataTable();
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
                         console.error("Error:", error);
                     });

    }
    //Applcant Tab JS
    window.InitializeApplicantTabEvents = function(){
         new DataTable("#applicant"); // Then initialize DataTables
         $("#evaluationSchedule-datepicker").daterangepicker({
             singleDatePicker: true,
             showDropdowns: true,
             opens: "center",
             drops: "up",
             autoUpdateInput: false,
             timePicker: true,
             locale: {
                 format: "MM/DD/YYYY h:mm A",
             },
         });

         $("#evaluationSchedule-datepicker").on(
             "apply.daterangepicker",
             function (ev, picker) {
                 $(this).val(picker.startDate.format("YYYY-MM-DD HH:mm"));
             }
         );

         $("#evaluationSchedule-datepicker").on(
             "cancel.daterangepicker",
             function (ev, picker) {
                 $(this).val("");
             }
         );

         // Get all checkboxes and their corresponding 'Reviewed' spans
         const checkboxes = document.querySelectorAll(".form-check-input");
         const reviewedSpans = document.querySelectorAll(".badge.bg-success");

         // Hide all 'Reviewed' spans initially
         reviewedSpans.forEach((span) => {
             span.style.display = "none";
         });

         // Add event listener to each checkbox
         checkboxes.forEach((checkbox, index) => {
             checkbox.addEventListener("change", function () {
                 if (this.checked) {
                     // Show confirmation modal
                     // You can customize the modal content and appearance based on your requirements
                     $("#myModal").modal("show");

                     // Show 'Reviewed' span if checkbox is checked
                     reviewedSpans[index].style.display = "inline";
                 } else {
                     reviewedSpans[index].style.display = "none"; // Hide 'Reviewed' span if checkbox is unchecked
                 }
             });
         });

           formatCurrency('#fundAmount');


        $(".applicantDetailsBtn").on("click", function () {
            const row = $(this).closest("tr");

            const fullName = row.find("td:nth-child(1)").text().trim();
            const designation = row.find("td:nth-child(2)").text().trim();
            const firmName = row
                .find("td:nth-child(3) span.firm_name")
                .text()
                .trim();
            const userID = row
                .find('td:nth-child(3) input[name="userID"]')
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
            // Add more fields as needed
            console.log(businessID);

            $("#firm_name").val(firmName);
            $("#selected_userId").val(userID);
            $("#selected_businessID").val(businessID);
            $("#address").val(businessAddress);
            $("#contact_person").val(fullName); // Add corresponding value
            $("#designation").val(designation);
            $("#enterpriseType").val(enterpriseType);
            $("#landline").val(landline);
            $("#mobile_phone").val(mobilePhone);
            $("#email").val(emailAddress);

            notifDatePopulate(businessID);

            // Get requirement and call the populateReqTable function
            $.ajax({
                type: "GET",
                url: ApplicantTabRoute.getApplicantRequirementsLink,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: {
                    selected_businessID: $("#selected_businessID").val(),
                },
                success: function (response) {
                    populateReqTable(response);
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

           function notifDatePopulate(businessID) {
               $.ajax({
                   type: "GET",
                   url: ApplicantTabRoute.getEvaluationScheduleDate,
                   headers: {
                       "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                           "content"
                       ),
                   },
                   data: {
                       business_id: businessID,
                   },
                   success: function (response) {
                       let nofi_dateCont = $("#nofi_ScheduleCont");
                       let setAndUpdateBtn = $("#setEvaluationDate");
                       nofi_dateCont.empty();
                       if (response.Scheduled_date) {
                           nofi_dateCont.append(
                               '<div class="alert alert-primary my-auto" role="alert">An evaluation date of <strong>' +
                                   response.Scheduled_date +
                                   '</strong> has been set for this applicant. <p class="my-auto text-secondary">Applicant is already notified through email and notification.</p></div>'
                           );
                           setAndUpdateBtn.text("Update");
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
               let requimentTableBody = $("#requirementsTables");

               requimentTableBody.empty();

               $.each(response, function (index, requirement) {
                   const row = $("<tr>");
                   row.append("<td>" + requirement.file_name + "</td>");
                   row.append("<td>" + requirement.file_type + "</td>");
                   row.append(
                       '<td class="text-center">' +
                           '<button class="btn btn-primary viewReq">View</button>' +
                           "</td>"
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

               $("#fileName").val(file_Name);
               $("#filetype").val(fileType);
               $("#fileUploaded").val(uploadedDate);
               $("#fileUploadedBy").val(updatedDate);
               $("#fileUploadedBy").val(uploader);
               retrieveAndDisplayFile(fileUrl, fileType);
           });

           //retrieve and display file function as base64 format for both pdf and img type
           function retrieveAndDisplayFile(fileUrl, fileType) {
               $.ajax({
                   url: ApplicantTabRoute.getRequirementFiles,
                   method: "GET",
                   headers: {
                       "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                           "content"
                       ),
                   },
                   data: {
                       file_url: fileUrl,
                   },
                   success: function (data) {
                       const fileContent = $("#fileContent");
                       fileContent.empty(); // Clear any previous content

                       if (fileType === "pdf") {
                           // Display PDF in an iframe
                           const base64PDF =
                               "data:application/pdf;base64," +
                               data.base64File +
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
                               src: `data:${fileType};base64,${data.base64File}`,
                               class: "img-fluid",
                           });
                           fileContent.append(img);
                       }
                   },
                   error: function (error) {
                       console.log(error);
                   },
               });

               const reviewFileModal = new bootstrap.Modal(
                   document.getElementById("reviewFileModal")
               );
               reviewFileModal.show();
           }

           //set evaluation date
           $("#setEvaluationDate").on("click", function () {
               let user_id = $("#selected_userId").val();
               let business_id = $("#selected_businessID").val();
               let Scheduledate = $("#evaluationSchedule-datepicker").val();

               $.ajax({
                   type: "PUT",
                   url: ApplicantTabRoute.setEvaluationScheduleDate,
                   headers: {
                       "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                           "content"
                       ),
                   },
                   data: {
                       user_id: user_id,
                       business_id: business_id,
                       evaluation_date: Scheduledate,
                   },
                   success: function (response) {
                       console.log(response);
                       if (response.success == true) {
                           notifDatePopulate(business_id);
                       }
                   },
                   error: function (error) {
                       console.log(error);
                   },
               });
           });

           //submit project proposal
           $("#submitProjectProposal").on("click", function () {
               event.preventDefault();

               let b_id = $("#selected_businessID").val();
               let formdata =
                   $("#projectProposal").serialize() + "&business_id=" + b_id;

               $.ajax({
                   type: "POST",
                   url: ApplicantTabRoute.submitProjectProposal,
                   headers: {
                       "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                           "content"
                       ),
                   },
                   data: formdata,
                   success: function (response) {
                       if (response.success == "true") {
                           closeOffcanvasInstances("#applicantDetails");
                           setTimeout(() => {
                               showToastFeedback(
                                   "text-bg-success",
                                   response.message
                               );
                           }, 500);
                       }
                   },
                   error: function (error) {
                       console.log(error);
                   },
               });
           });
    }
});