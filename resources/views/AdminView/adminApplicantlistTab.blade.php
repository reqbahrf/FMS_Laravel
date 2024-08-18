<style>
    #applicantDetails{
        width: 50vw;
        max-width: 100%;
    }
</style>
<div class="p-3">
    <h4>Applicant</h4>
</div>
<div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="applicantDetails"
    aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header bg-primary">
        <h5 class="offcanvas-title text-white fs-4" id="staticBackdropLabel">
            <i class="ri-id-card-fill ri-lg"></i>
            Applicant Details
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row gy-3">
            <div class="card p-0">
                <div class="card-header">
                    <h5>
                        <i class="ri-contacts-fill"></i>
                        Personal Info
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row gy-2">
                        <div class="col-12 col-md-8">
                            <label for="cooperatorName">Cooperator Name:</label>
                            <input type="text" id="cooperatorName" class="form-control" readonly>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="designation">Designation:</label>
                            <input type="text" id="designation" class="form-control" readonly>
                        </div>
                        <h6>Contact Details:</h6>
                        <div class="col-12 col-md-4">
                            <label for="landline">Landline:</label>
                            <input type="text" id="landline" class="form-control" readonly>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="mobilePhone">Mobile Phone:</label>
                            <input type="text" id="mobilePhone" class="form-control" readonly>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="email">Email:</label>
                            <input type="text" id="email" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-0">
                <div class="card-header">
                    <span class="fw-bold fs-5">
                        <i class="ri-briefcase-fill"></i>
                        Business Info
                    </span>
                </div>
                <div class="card-body">
                    <div class="row gy-2">
                        <input type="hidden" name="b_id" id="b_id">
                        <div class="col-12">
                            <label for="businessAddress">Business Address:</label>
                            <input type="text" id="businessAddress" class="form-control" readonly>
                        </div>
                        <div class="col-12">
                            <label for="typeOfEnterprise">Type of Enterprise:</label>
                            <input type="text" id="typeOfEnterprise" class="form-control" readonly>
                        </div>
                        <h6>Assets:</h6>
                        <div class="col-12 col-md-4">
                            <label for="building" class="ps-2">Building:</label>
                            <input type="text" id="building" class="form-control" readonly>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="equipment" class="ps-2">Equipment:</label>
                            <input type="text" id="equipment" class="form-control" readonly>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="land" class="ps-2">Land:</label>
                            <input type="text" id="workingCapital" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-0">
                <div class="card-header">
                    <span class=" fw-bold fs-5">
                        <i class="ri-draft-fill"></i>
                        Project Proposal
                    </span>
                </div>
                <div class="card-body">
                    <div class="row gy-2">
                        <div class="col-12 col-md-3">
                            <label for="ProjectId_fetch">Project Id:</label>
                            <input type="text" id="ProjectId_fetch" class="form-control" readonly value="">
                        </div>
                        <div class="col-12 col-md-9">
                            <label for="ProjectTitle_fetch">Project Title:</label>
                            <input type="text" id="ProjectTitle_fetch" class="form-control" readonly value="">
                        </div>
                        <div class="col-12 col-md-8">
                            <label for="Amount_fetch">Amount:</label>
                            <input type="text" id="Amount_fetch" class="form-control" readonly value="">
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="Applied_fetch">Date Applied:</label>
                            <input type="text" id="Applied_fetch" class="form-control" readonly value="">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="evaluated_fetch">Evaluated by:</label>
                            <input type="text" id="evaluated_fetch" class="form-control" readonly value="">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="Assigned_to">Assigned to:</label>
                            <select name="Assigned_to" id="Assigned_to" class="form-select">

                            </select>
                        </div>
                        <div class="col-12 d-flex justify-content-end align-items-end">
                            <button type="button" class="btn btn-primary" id="approvedButton">Approved</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card p-0 m-0 m-md-3">
    <div class="card-body">
        <div class="py-4 bg-white rounded-5">

            <div class="mx-2 table-responsive-xl">
                <table id="applicant" class="table table-hover mx-2" style="width:100%">
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Designation</th>
                            <th>Business Info</th>
                            <th>Date Applied</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="table-group-divider">
                        @if (isset($applicants) && $applicants->isNotEmpty())
                            @foreach ($applicants as $applicantInfo)
                                <tr>
                                    <input type="hidden" name="user_Id" class="user_Id" value="{{ $applicantInfo->user_id }}">
                                    <td>{{ $applicantInfo->prefix . ' ' . $applicantInfo->f_name . ' ' . $applicantInfo->mid_name . ' ' . $applicantInfo->l_name . ' ' . $applicantInfo->suffix }}
                                    </td>
                                    <td>{{ $applicantInfo->designation }}</td>
                                    <td>
                                        <div>
                                            <strong>Business Name:</strong>
                                            <span class="firm_name">
                                                {{ $applicantInfo->firm_name }}
                                            </span><br>
                                            <strong>Business Address:</strong>
                                            <input type="hidden" name="business_id" id="business_id"
                                                value="{{ $applicantInfo->id }}">
                                            <span
                                                class="business_Address">{{ $applicantInfo->landMark . ', ' . $applicantInfo->barangay . ', ' . $applicantInfo->city . ', ' . $applicantInfo->province . ', ' . $applicantInfo->region }}
                                            </span>
                                            <br>
                                            <strong>Type of Enterprise:</strong> <span
                                                class="Type_Enterprise">{{ $applicantInfo->enterprise_type }}</span>
                                        </div>
                                        <div>
                                            <Strong>Assets:</Strong> <br>
                                            <span class="ps-2">
                                                Building:
                                                <span class="building">{{ number_format($applicantInfo->building_value, 2) }}</span>
                                            </span><br>
                                            <span class="ps-2">Equipment:
                                                <span
                                                    class="Equipment">{{ number_format($applicantInfo->equipment_value, 2) }}</span>
                                            </span> <br>
                                            <span class="ps-2">Working Capital:
                                                <span
                                                    class="Working_C">{{ number_format($applicantInfo->working_capital, 2) }}</span>
                                            </span>
                                        </div>
                                        <strong>Contact Details:</strong>
                                        <p>
                                            <span class="p-2">Landline:</span>
                                            <span class="landline">{{ $applicantInfo->landline }}</span>
                                            <br>
                                            <span class="p-2">Mobile Phone:</span>
                                            <span class="MobileNum">{{ $applicantInfo->mobile_number }}</span><br>
                                            <span class="p-2">Email:</span>
                                            <span class="Email">{{ $applicantInfo->email }}</span>
                                            <br>
                                        </p>
                                    </td>
                                    <td>{{ $applicantInfo->date_applied }}</td>
                                    <td>To be reviewed</td>
                                    <td>
                                        <button class="btn btn-primary viewApplicant" type="button" data-bs-toggle="offcanvas"
                                            data-bs-target="#applicantDetails" aria-controls="applicantDetails">
                                            <i class="ri-menu-unfold-4-line ri-1x"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Client Name</th>
                            <th>Designation</th>
                            <th>Business Info</th>
                            <th>Date Applied</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="module">
    $(document).ready(function() {
          $('#applicant').DataTable();

           $('.viewApplicant').on('click', function() {
            let row = $(this).closest('tr');

            $('#cooperatorName').val(row.find('td:nth-child(2)').text().trim());
            $('#designation').val(row.find('td:nth-child(3)').text().trim());
            $('#b_id').val(row.find('#business_id').val());
            $('#businessAddress').val(row.find('.business_Address').text().trim());
            $('#typeOfEnterprise').val(row.find('.Type_Enterprise').text().trim());
            $('#landline').val(row.find('.landline').text().trim());
            $('#mobilePhone').val(row.find('.MobileNum').text().trim());
            $('#email').val(row.find('.Email').text().trim());
            $('#building').val(row.find('.building').text().trim());
            $('#equipment').val(row.find('.Equipment').text().trim());
            $('#workingCapital').val(row.find('.Working_C').text().trim());

            getProjectProposal($('#b_id').val());
            getStafflist();
        });

        function getStafflist()
        {
            fetch('{{ route('admin.Stafflist') }}', {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
            })
                .then(response => response.json())
                .then(data => {
                    let staffList = $('#Assigned_to');
                    staffList.empty();
                    data.forEach(staff => {
                        staffList.append(`<option value="${staff.staff_id}">${staff.full_name}</option>`);
                    });

                }).catch(error => {
                    console.error('Error:', error);
                });
        }

          window.getProjectProposal = function(businessId){

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('admin.Project.GetProposalDetails') }}',
                type: 'POST',
                data: {
                    business_id: businessId
                },
                dataType: 'json', // Expect a JSON response
                success: function(response) {
                        $('#ProjectId_fetch').val(response.Project_id);
                        $('#ProjectTitle_fetch').val(response.project_title);
                        $('#Amount_fetch').val(parseFloat(response.fund_amount)
                            .toLocaleString('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }));
                        $('#Applied_fetch').val(response.date_applied);
                        $('#evaluated_fetch').val(response.name);
                },
                error: function(xhr, status, error) {
                    $('#ProjectTitle_fetch').val('');
                    $('#Amount_fetch').val('');
                    $('#Applied_fetch').val('');
                    $('#evaluated_fetch').val('');
                }
            });
        }

        window.approvedProjectProposal = function(businessId, projectId, assignedStaff_Id){

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('admin.Project.ApprovedProjectProposal') }}',
                type: 'POST',
                data: {
                    business_id: businessId,
                    project_id: projectId,
                    assigned_staff_id: assignedStaff_Id
                },
                success: function(response) {
                   window.loadPage('{{ route('admin.Applicant') }}','applicantList');
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }

        $('#approvedButton').on('click', function() {
            if (typeof $('#b_id').val() !== 'undefined' && typeof $('#ProjectId_fetch').val() !== 'undefined' && typeof $('#Assigned_to').val() !== 'undefined')
            {
                approvedProjectProposal($('#b_id').val(), $('#ProjectId_fetch').val(), $('#Assigned_to').val());
            }
        })
    });

</script>
