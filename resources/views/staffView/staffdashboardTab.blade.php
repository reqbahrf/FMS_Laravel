<style>
    div .cards {
        max-width: 24rem;
        min-width: 20rem;
        height: 15rem
    }

    .cards {
        transition: transform 0.3s ease-in-out;
    }

    .cards:hover {
        transform: scale(1.05);
        font-weight: bolder;
    }

    /* handleproject header color change */
    #handledProject_wrapper>div:first-child {
        background-color: #318791;
        padding-top: 1rem;
        padding-bottom: 1rem;
        color: white;
    }

    #handleProjectOff {
        width: 50vw;
        max-width: 100%;
    }

    .bottom_border {
        width: 50%;
        border-top: 0;
        border-left: 0;
        border-right: 0;
        border-bottom: 1px solid #ced4da;
    }

    .bottom_border:focus {
        outline: none;
    }
</style>
{{-- add Payment modal start --}}
<div class="modal fade" id="paymentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="paymentModalLabel">Add New Payment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="paymentForm">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label for="TransactionID">Transaction ID:</label>
                            <input type="text" name="TransactionID" class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="amount">Amount:</label>
                            <input type="text" name="amount" id="paymentAmount" class="form-control">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="paymentMethod">Payment Method:</label>
                            <input type="text" name="paymentMethod" class="form-control" list="paymentMethodList"
                                placeholder="Select Payment Method">
                            <datalist id="paymentMethodList">
                                <option value="Cash">
                                <option value="Check">
                                <option value="Credit Card">
                                <option value="Online Transfer">
                            </datalist>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="paymentStatus">Payment Status:</label>
                            <input type="text" name="paymentStatus" class="form-control" list="paymentStatusList"
                                placeholder="Select Payment Status">
                            <datalist id="paymentStatusList">
                                <option value="Paid">
                                <option value="Pending">
                                <option value="Failed">
                            </datalist>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitPayment">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- add Payment modal end --}}
<div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="handleProjectOff"
    aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header bg-primary">
        <h5 class="offcanvas-title text-white" id="staticBackdropLabel">
            Handled Project
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-details-tab" data-bs-toggle="tab" data-bs-target="#nav-details"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">Project Details</button>
                <button class="nav-link" id="nav-link-tab" data-bs-toggle="tab" data-bs-target="#nav-link"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Attach File
                    Link
                </button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-details" role="tabpanel" aria-labelledby="nav-home-tab"
                tabindex="0">
                <div class="row gy-3">
                    <div class="col-12">
                        <div class="card p-0">
                            <div class="card-header">
                                <h5 class="card-title">Project Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="row gy-3">
                                    <input type="hidden" id="hiddenbusiness_id">
                                    <div class="col-4">
                                        <label for="ProjectID">Project ID</label>
                                        <input type="text" class="form-control" id="ProjectID" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="ProjectTitle">Project Title:</label>
                                        <input type="text" class="form-control" id="ProjectTitle" readonly>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <label for="amount">Amount:</label>
                                        <input type="text" class="form-control" id="amount" readonly>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="appliedDate">Approved Date:</label>
                                        <input type="text" class="form-control" id="appliedDate" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card p-0">
                            <div class="card-header">
                                <h5 class="card-title">Business Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row gy-3">
                                    <div class="col-12">
                                        <label for="FirmName">Firm Name:</label>
                                        <input type="text" class="form-control" id="FirmName" readonly>
                                    </div>
                                    <div class="col-8">
                                        <label for="CooperatorName">Cooperator Name:</label>
                                        <input type="text" class="form-control" id="CooperatorName" readonly>
                                    </div>
                                    <div class="col-2">
                                        <label for="Gender">Gender:</label">
                                            <input type="text" class="form-control" id="Gender" readonly>
                                    </div>
                                    <div class="col-2">
                                        <label for="age">Age:</label">
                                            <input type="text" class="form-control" id="age" readonly>
                                    </div>
                                    <div class="col-12">
                                        <h6>Contact Details:</h6>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="landline">Landline:</label>
                                        <input type="text" class="form-control" id="landline" readonly>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="mobilePhone">Mobile Phone:</label>
                                        <input type="text" class="form-control" id="mobilePhone" readonly>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="email">Email:</label>
                                        <input type="text" class="form-control" id="email" readonly>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="enterpriseType">Enterprise Type:</label>
                                        <input type="text" class="form-control" id="enterpriseType" readonly>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="EnterpriseLevel">Enterprise Level</label>
                                        <input type="text" class="form-control" id="EnterpriseLevel" readonly>
                                    </div>
                                    <div class="col-12">
                                        <h6>Assets:</h6>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="buildingAsset">Building:</label>
                                        <div class="input-group">
                                            <span class="input-group-text">₱</span>
                                            <input type="text" class="form-control" id="buildingAsset" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="equipmentAsset">Equipment:</label>
                                        <div class="input-group">
                                            <span class="input-group-text">₱</span>
                                            <input type="text" class="form-control" id="equipmentAsset" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="workingCapitalAsset">Working Capital:</label>
                                        <div class="input-group">
                                            <span class="input-group-text">₱</span>
                                            <input type="text" class="form-control" id="workingCapitalAsset"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 ongoingProjectContent">
                        <div class="card p-0">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title me-auto">Payment History</h5>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#paymentModal"><i
                                            class="ri-sticky-note-add-fill"></i></button>
                                </div>
                            </div>
                            <div class="card-body" id="paymentHistoryContainer">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-link" role="tabpanel" aria-labelledby="nav-link-tab"
                tabindex="0">
                <div id="linkContainer">
                    <div class="table-responsive my-3">
                        <table class="table table-hover table-sm" id="linkTable">
                            <thead>
                                <tr>
                                    <th width="20%">File Name</th>
                                    <th width="70%">Links</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody id="linkTableBody">
                                <tr>
                                    <td colspan="3" class="text-center">No data available</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-between align-items-center">
                        <h6>Cooperator Requirements:</h6>
                        <button type="button" class="btn btn-primary ms-auto" id="addRequirement"><i
                                class="ri-add-fill ri-lg"></i></button>
                    </div>
                    <div class="col-12 linkConstInstance">
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
                </div>
            </div>
        </div>
    </div>
    <div class="approvedProjectContent">
        <div class="d-flex justify-content-end p-3 projectDetailsTabMenu">
            <button class="btn btn-primary" id="MarkhandleProjectBtn">Mark as Ongoing</button>
        </div>
        <div class="d-flex justify-content-end p-3 d-none AttachlinkTabMenu">
            <button class="btn btn-primary" id="SaveLinkProjectBtn">Save</button>
        </div>
    </div>
    <div class="ongoingProjectContent">
        <div class="d-flex justify-content-end p-3 projectDetailsTabMenu">
            <button class="btn btn-primary" id="">View Quarterly Report</button>
        </div>
        <div class="d-flex justify-content-end d-none p-3 AttachlinkTabMenu">
            <button class="btn btn-primary" id="">Save</button>
        </div>
    </div>
</div>

<div class="modal fade" id="handleProjectModal" tabindex="-1" aria-labelledby="handleProjectModalLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="handleProjectModalLabel">Handled Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Project title:</h6>
                <p class="ps-2">Imploving the Business.....</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="dashboardLink"
                    onclick="loadPage('/org-access/viewCooperatorInfo.php','projectLink');"
                    data-bs-dismiss="modal">View</button>
                <button class="btn btn-secondary">Edit</button>
            </div>
        </div>
    </div>
</div>
<div>
    <h4 class="p-3">Dashboard</h4>
</div>
<div class="">
    <div class="card m-3">
        <div class="card-header">
            <p class="fw-bold fs-5 m-0 text-center"> Projects</p>
        </div>
        <div class="card-body">
            <div id="lineChart">
            </div>
        </div>
    </div>
    <div class="card m-3">
        <div class="card-header">
            <p class="fw-bold fs-5 m-0 text-center">Handled Project</p>
        </div>
        <div class="card-body">
            <table id="handledProject" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Project ID</th>
                        <th>Project Title</th>
                        <th>Firm Name</th>
                        <th>Owner Name</th>
                        <th>Refund Progress</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="handledProjectTableBody">

                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Project Title</th>
                        <th>Firm Info</th>
                        <th>Owner Info</th>
                        <th>Refund Progress</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script type="module">
    $(document).ready(function() {

        formatCurrency('#paymentAmount');

        $('#nav-link-tab').on('shown.bs.tab', () => $('.projectDetailsTabMenu').addClass('d-none'));
        $('#nav-link-tab').on('hidden.bs.tab', () => $('.projectDetailsTabMenu').removeClass('d-none'));
        $('#nav-details-tab').on('shown.bs.tab', () => $('.AttachlinkTabMenu').addClass('d-none'));
        $('#nav-details-tab').on('hidden.bs.tab', () => $('.AttachlinkTabMenu').removeClass('d-none'));

        fetchHandleProject();

        function fetchHandleProject() {
            fetch('{{ route('staff.Dashboard.getHandledProjects') }}', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                }).then(response => response.json())
                .then(data => {
                    const handledProjectTable = $('#handledProject').DataTable();
                    handledProjectTable.clear();
                    handledProjectTable.rows.add(data.map(project => ([
                        project.Project_id,
                        project.project_title,
                        `<p class="firm_name">${project.firm_name}</p>
                    <input type="hidden" class="business_id" value="${project.business_id}">
                    <input type="hidden" class="business_enterprise_type" value="${project.enterprise_type}">
                    <input type="hidden" class="business_enterprise_level" value="${project.enterprise_level}">
                    <input type="hidden" class="business_address" value="${project.landMark + ', ' + project.barangay + ', ' + project.city + ', ' + project.province + ', ' + project.region}">
                    <input type="hidden" class="dateApplied" value="${project.date_applied}">
                    <input type="hidden" class="building_value" value="${parseFloat(project.building_value).toLocaleString('en-US', { minimumFractionDigits: 2 })}">
                    <input type="hidden" class="equipment_value" value="${parseFloat(project.equipment_value).toLocaleString('en-US', { minimumFractionDigits: 2 })}">
                    <input type="hidden" class="working_capital" value="${parseFloat(project.working_capital).toLocaleString('en-US', { minimumFractionDigits: 2 })}">`,
                        `<p class="owner_name">${project.prefix + ' ' + project.f_name + ' ' + project.l_name + ' ' + project.suffix}</p>
                    <input type="hidden" class="gender" value="${project.gender}">
                    <input type="hidden" class="birth_date" value="${project.birth_date}">
                    <input type="hidden" class="landline" value="${project.landline ?? ''}">
                    <input type="hidden" class="mobile_phone" value="${project.mobile_number}">
                    <input type="hidden" class="email" value="${project.email}">`,
                        `${parseFloat(project.fund_amount).toLocaleString('en-US', { minimumFractionDigits: 2 })}`,
                        `<span class="badge ${project.application_status === 'approved' ? 'bg-warning' : project.application_status === 'ongoing' ? 'bg-primary' : project.application_status === 'completed' ? 'bg-sucesss' : 'bg-danger'}">${project.application_status}</span>`,
                        `<button class="btn btn-primary handleProjectbtn" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#handleProjectOff" aria-controls="handleProjectOff">
                        <i class="ri-menu-unfold-4-line ri-1x"></i>
                    </button>`
                    ])));
                    handledProjectTable.draw();
                });
        }

        function handleProjectOffcanvasContent(project_status) {
            const handleProjectOffcanvas = $('#handleProjectOff');
            const content = {
                approved: () => {
                    handleProjectOffcanvas.find('.approvedProjectContent').removeClass('d-none');
                    handleProjectOffcanvas.find('.ongoingProjectContent').addClass('d-none');



                },
                ongoing: () => {
                    handleProjectOffcanvas.find('.ongoingProjectContent').removeClass('d-none');
                    handleProjectOffcanvas.find('.approvedProjectContent').addClass('d-none');
                    handleProjectOffcanvas.find('#paymentHistoryContainer').html(paymentHistoryTable());

                    $('#paymentHistoryTable').DataTable({
                        columns: [{
                                title: 'Transaction #'
                            },
                            {
                                title: 'Amount'
                            },
                            {
                                title: 'Payment Method'
                            },
                            {
                                title: 'Status'
                            },
                            {
                                title: 'Date Created'
                            },
                        ]
                    });


                },
                completed: () => {

                }
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

        $('#submitPayment').on('click', function() {
            let project_id = $('#ProjectID').val();

            let formData = $('#paymentForm').serialize() + '&project_id=' + project_id;
            $.ajax({
                type: 'POST',
                url:'{{ route('PaymentRecord.Store') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                success: function(response) {
                    //TODO: handle success message
                    closeModal('#paymentModal');
                    fetchPaymentHistory(project_id);
                    setTimeout(() => {
                        showToastFeedback('text-bg-success', response.message);
                    }, 500);
                },
                error: function(error) {
                    console.log(error);
                }

            })
        })

        //get the payment history

    function fetchPaymentHistory(projectId) {
        $.ajax({
            type: 'GET',
            url: '{{ route('PaymentRecord.Index') }}',
            data: {
                'project_id': projectId
            },
            success: function(response) {
                const paymentHistoryTable = $('#paymentHistoryTable').DataTable();
                paymentHistoryTable.clear();
                paymentHistoryTable.rows.add(response.map(payment => [
                    payment.transaction_id,
                    parseFloat(payment.amount).toLocaleString('en-US', { minimumFractionDigits: 2 }),
                    payment.payment_method,
                    payment.payment_status,
                    payment.created_at
                ]));

                paymentHistoryTable.draw();

            },
            error: function(error) {
                console.log(error);
            }
        })
    }



       $('#handledProjectTableBody').on('click', '.handleProjectbtn', function() {
    const handledProjectRow = $(this).closest('tr');
    const hiddenInputs = handledProjectRow.find('input[type="hidden"]');

    // Cache values from the row
    const project_status = handledProjectRow.find('td:eq(5)').text().trim();
    const project_id = handledProjectRow.find('td:eq(0)').text().trim();
    const projectTitle = handledProjectRow.find('td:eq(1)').text().trim();
    const amount = handledProjectRow.find('td:eq(4)').text().trim();
    const firmName = handledProjectRow.find('td:eq(2) p.firm_name').text().trim();
    const cooperatorName = handledProjectRow.find('td:eq(3) p.owner_name').text().trim();

    handleProjectOffcanvasContent(project_status);
    fetchPaymentHistory(project_id);

    // Cache hidden input values
    const business_id = hiddenInputs.filter('.business_id').val();
    const birthDate = new Date(hiddenInputs.filter('.birth_date').val());
    const dateApplied = hiddenInputs.filter('.dateApplied').val();
    const gender = hiddenInputs.filter('.gender').val();
    const landline = hiddenInputs.filter('.landline').val();
    const mobilePhone = hiddenInputs.filter('.mobile_phone').val();
    const email = hiddenInputs.filter('.email').val();
    const enterpriseType = hiddenInputs.filter('.business_enterprise_type').val();
    const enterpriseLevel = hiddenInputs.filter('.business_enterprise_level').val();
    const buildingAsset = hiddenInputs.filter('.building_value').val();
    const equipmentAsset = hiddenInputs.filter('.equipment_value').val();
    const workingCapitalAsset = hiddenInputs.filter('.working_capital').val();

    // Calculate age
    const age = Math.floor((new Date() - birthDate) / (365.25 * 24 * 60 * 60 * 1000));

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
});


        $('#addRequirement').on('click', function() {
            let RequirementLinkContent = $('#linkContainer')

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

        $('#linkContainer').on('click', '.removeRequirement', function() {
            $(this).closest('.linkConstInstance').remove();
        });

        //Mark Approved Project to Ongoing
        $('#MarkhandleProjectBtn').on('click', function() {

            $.ajax({
                type: 'PUT',
                url: '{{ route('staff.Dashboard.updateProjectStatusToOngoing') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    project_id: $('#ProjectID').val(),
                    business_id: $('#hiddenbusiness_id').val(),
                },
                success: function(response) {
                    closeOffcanvasInstances('#handleProjectOff');
                    setTimeout(() => {
                        showToastFeedback('text-bg-success',
                            'Project is now move to ongoing');
                    }, 500);
                },
                error: function(error) {
                    console.log(error);
                }

            })
        })
    })
</script>
