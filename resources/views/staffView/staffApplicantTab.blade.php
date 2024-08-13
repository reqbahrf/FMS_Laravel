<style>
    #applicant_wrapper>div:first-child {
        background-color: #318791;
        padding-top: 1rem;
        padding-bottom: 1rem;
        color: white;
        margin-top: 0 !important;
    }

    #applicantDetails {
        width: 70vw;
        max-width: 100%;
    }

    .card-body label {
        font-size: clamp(12px, 1vw, 13px);
        font-weight: 600;
    }

    .fixPosition {
        position: fixed;
        height: 60vh;
        top: 10%;
        right: 0;
    }
</style>

<div>
    <h4 class="p-3">Applicant:</h4>
</div>
<div>
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
            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="fw-bold fs-6">
                            <i class="ri-briefcase-fill"></i>
                            Business Info
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <input type="hidden" id="selected_businessID">
                            <div class="col-md-6">
                                <label for="firm_name" class="form-label">Name of Firm</label>
                                <input type="text" class="form-control form-control-sm" id="firm_name" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control form-control-sm" id="address" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="contact_person" class="form-label">Contact Person:</label>
                                <input type="text" class="form-control form-control-sm" id="contact_person" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="designation" class="form-label">Designation:</label>
                                <input type="text" class="form-control form-control-sm" id="designation" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="enterpriseType" class="form-label">Type Of Enterprise:</label>
                                <input type="text" class="form-control form-control-sm" id="enterpriseType"
                                    value="Sole Proprietorship" readonly>
                            </div>
                            <div class="col-12">

                                Contact Details:

                            </div>
                            <div class="col-md-4">
                                <label for="landline" class="form-label">Landline:</label>

                                <input type="text" class="form-control form-control-sm" id="landline" readonly>

                            </div>
                            <div class="col-md-4">
                                <label for="mobile_phone" class="form-label">Mobile Phone:</label>

                                <input type="text" class="form-control form-control-sm" id="mobile_phone" readonly>

                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label">Email Address:</label>
                                <input type="text" class="form-control form-control-sm" id="email" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class=" card-header">
                        <div class="fw-bold fs-6">
                            <i class="ri-file-list-3-fill"></i>
                            Application requirements
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="fw-bold">File Name</th>
                                        <th class="fw-bold">File Type</th>
                                        <th class="fw-bold text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider" id="requirementsTables">


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="fw-bold fs-6">
                            <i class="ri-calendar-event-fill"></i>
                            Schedule an Evaluation
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="input-group date" data-date-format="mm-dd-yyyy">
                            <input type="text" id="datepicker" class=" form-control">
                            <div class="input-group-append">
                                <i class="ri-calendar-schedule-fill input-group-text"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="fw-bold fs-6">
                            <i class="ri-file-list-3-fill"></i>
                            Project Proposal
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id="projectP">
                            <div id="alertForm"
                                class="alert alert-success alert-dismissible text-bg-success border-0 fade show mx-5 d-none"
                                role="alert">
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                <strong>Success - </strong> All data successfully inserted.
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="projectTitle" name="projectTitle"
                                    placeholder="Project Title">
                                <label for="projectTitle">Project Title</label>
                            </div>
                            <div class="form-floating w-75 mx-auto">
                                <input type="text" class="form-control" id="fundAmount"
                                    name="fundAmountFormatted" placeholder="Fund Amount">
                                <label for="fundAmount">Fund Amount</label>
                                <input type="hidden" id="fundAmountHidden" name="fundAmount">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2 py-3">
                    <button type="button" class="btn btn-success">
                        <i class="ri-draft-fill"></i>
                        Draft
                    </button>
                    <button type="submit" id="submitProject" class="btn btn-primary me-2">
                        <i class="ri-file-transfer-fill"></i>
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card m-0 m-md-3">
    <div class="card-body">
        <div class="m-3 table-responsive-sm">
            <!-- Where the applicant table start -->
            <table id="applicant" class="table table-hover" style="width:100%">
                <thead>
                    <tr>

                        <th>Client Name</th>
                        <th>Designation</th>
                        <th>Firm Name</th>
                        <th>Additional Info</th>
                        <th>Date Applied</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="table-group-divider">
                    @if (isset($applicants) && count($applicants) > 0)
                        @foreach ($applicants as $item)
                            <tr>

                                <td>{{ $item->prefix }} {{ $item->f_name }} {{ $item->mid_name }} {{ $item->l_name }} {{ $item->suffix }}</td>
                                <td>{{ $item->designation }}</td>
                                <td>{{ $item->firm_name }}</td>
                                <td>
                                    <div>
                                        <strong>Business Address:</strong>
                                        <input type="hidden" id="business_id" name="business_id"
                                            value="{{ $item->id }}">
                                        <span class="b_address"> {{ $item->landMark }}, {{ $item->barangay }}, {{ $item->city }}, {{ $item->province }}, {{ $item->region }}</span><br>
                                        <strong>Type of Enterprise:</strong> <span
                                            class="enterprise_l">{{ $item->enterprise_type }}</span>
                                        <p>
                                            <strong>Assets:</strong> <br>
                                            <span class="ps-2">Building:
                                                {{ number_format($item->building_value, 2) }}</span><br>
                                            <span class="ps-2">Equipment:
                                                {{ number_format($item->equipment_value, 2) }}</span> <br>
                                            <span class="ps-2">Working Capital:
                                                {{ number_format($item->working_capital, 2) }}</span>
                                        </p>
                                        <strong>Contact Details:</strong>
                                        <p>
                                            <strong class="p-2">Landline:</strong> <span
                                                class="landline">{{ $item->landline }}</span> <br>
                                            <strong class="p-2">Mobile Phone:</strong> <span
                                                class="mobile_num">{{ $item->mobile_number }}</span> <br>
                                            <strong class="p-2">Email:</strong> <span
                                                class="email_add">{{ $item->email }}</span>
                                        </p>
                                    </div>
                                </td>
                                <td>{{ $item->date_applied }}</td>
                                <td>To be reviewed</td>
                                <td>
                                    <button class="btn btn-primary applicantDetailsBtn" type="button"
                                        data-bs-toggle="offcanvas" data-bs-target="#applicantDetails"
                                        aria-controls="applicantDetails">
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
                        <th>Firm Name</th>
                        <th>Additional Info</th>
                        <th>Date Applied</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="reviewFileModal" tabindex="-1" aria-labelledby="reviewFileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Review Requirement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row h-100">
                    <div class="col-12 col-md-8">
                        <div id="fileContent" class="h-100">

                        </div>
                    </div>
                    <div class="col-12 col-md-4 fixPosition">
                        <div class="border border-3 h-100">
                            <div class="row p-3 my-3 gy-3">
                                <div class="col-12 col-md-8">
                                    <div class="form-group">
                                        <label for="fileName">File Name:</label>
                                        <input class="form-control" type="text" id="fileName" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="filetype">File Type:</label>
                                        <input class="form-control" type="text" id="filetype" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="fileUploaded">Uploaded at:</label>
                                        <input class="form-control" type="text" id="fileUploaded" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="fileUpdated">Updated at:</label>
                                        <input class="form-control" type="text" id="fileUpdated" readonly>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="fileUploadedBy">Uploaded by:</label>
                                        <input class="form-control" type="text" id="fileUploadedBy" readonly>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Where the applicant table end -->

<script type="module">
    $(document).ready(function() {
        new DataTable('#applicant'); // Then initialize DataTables
        $('#datepicker').daterangepicker({
            "singleDatePicker": true,
            "showDropdowns": true,
            "opens": "center",
            "drops": "up",
            "autoUpdateInput": false
        });

        $('#datepicker').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY'));
        });

        $('#datepicker').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        // Get all checkboxes and their corresponding 'Reviewed' spans
        const checkboxes = document.querySelectorAll('.form-check-input');
        const reviewedSpans = document.querySelectorAll('.badge.bg-success');

        // Hide all 'Reviewed' spans initially
        reviewedSpans.forEach(span => {
            span.style.display = 'none';
        });

        // Add event listener to each checkbox
        checkboxes.forEach((checkbox, index) => {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    // Show confirmation modal
                    // You can customize the modal content and appearance based on your requirements
                    $('#myModal').modal('show');

                    // Show 'Reviewed' span if checkbox is checked
                    reviewedSpans[index].style.display = 'inline';
                } else {
                    reviewedSpans[index].style.display =
                        'none'; // Hide 'Reviewed' span if checkbox is unchecked
                }
            });
        });

    });
</script>
<script type="module">
    // jQuery code to populate modal fields with table row values
    $(document).ready(function() {

        $('#fundAmount').on('input', function() {
            let value = $(this).val().replace(/[^0-9.]/g, ''); // Include decimal point in regex

            // Ensure two decimal places
            if (value.includes('.')) {
                let parts = value.split('.');
                parts[1] = parts[1].substring(0, 2); // Limit to two decimal places
                value = parts.join('.');
            }

            // Add commas every three digits
            let formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            // Set the new value to the input field
            $(this).val(formattedValue);

            // Update the hidden field with the clean value
            $('#fundAmountHidden').val(value);
        });


        $('.applicantDetailsBtn').on('click', function() {
            let row = $(this).closest('tr');

            let fullName = row.find('td:nth-child(1)').text();
            let designation = row.find('td:nth-child(2)').text();
            let firmName = row.find('td:nth-child(3)').text();
            let businessID = row.find('td:nth-child(4) input#business_id').val();
            let businessAddress = row.find('td:nth-child(4) span.b_address').text();
            let enterpriseType = row.find('td:nth-child(4) span.enterprise_l').text();
            let landline = row.find('td:nth-child(4) span.landline').text();
            let mobilePhone = row.find('td:nth-child(4) span.mobile_num').text();
            let emailAddress = row.find('td:nth-child(4) span.email_add').text();
            // Add more fields as needed
            console.log(businessID);

            $('#firm_name').val(firmName);
            $('#selected_businessID').val(businessID);
            $('#address').val(businessAddress);
            $('#contact_person').val(fullName); // Add corresponding value
            $('#designation').val(designation);
            $('#enterpriseType').val(enterpriseType);
            $('#landline').val(landline);
            $('#mobile_phone').val(mobilePhone);
            $('#email').val(emailAddress);
            // Add more fields as needed
            $.ajax({
                type: 'GET',
                url: '{{ route('staff.Applicant.Requirement') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    selected_businessID: $('#selected_businessID').val()
                },
                success: function(response) {
                    populateReqTable(response);
                },
                error: function(error) {
                    console.log(error);
                }
            })
        });

        function populateReqTable(response) {
            const requimentTableBody = $('#requirementsTables');

            $.each(response, function(index, requirement) {
                const row = $('<tr>');
                row.append('<td>' + requirement.file_name + '</td>');
                row.append('<td>' + requirement.file_type + '</td>');
                row.append('<td class="text-center">' +
                    '<button class="btn btn-primary viewReq">View</button>' + '</td>');
                row.append('<input type="hidden"  name="file_url" value="' + requirement.full_url + '">')
                row.append('<input type="hidden"  name="can_edit" value="' + requirement.can_edit + '">');
                row.append('<input type="hidden"  name"remark" value="' + requirement.remarks + '">');
                row.append('<input type="hidden"  name="created_at" value="' +
                    requirement.created_at + '">');
                row.append('<input type="hidden"  name="updated_at" value="' +
                    requirement.updated_at + '">');


                requimentTableBody.append(row);
            })



        }

        $('#requirementsTables').on('click', '.viewReq', function() {
            let row = $(this).closest('tr');
            let file_Name = row.find('td:nth-child(1)').text();
            let fileUrl = row.find('input[type="hidden"][name="file_url"]').val();
            let fileType = row.find('td:nth-child(2)').text();
            let uploadedDate = row.find('input[type="hidden"][name="created_at"]').val();
            let updatedDate = row.find('input[type="hidden"][name="updated_at"]').val();
            let uploader = $('#contact_person').val();


            $('#fileName').val(file_Name);
            $('#filetype').val(fileType);
            $('#fileUploaded').val(uploadedDate);
            $('#fileUploadedBy').val(updatedDate);
            $('#fileUploadedBy').val(uploader);
            retrieveAndDisplayFile(fileUrl, fileType);
        });

       function retrieveAndDisplayFile(fileUrl, fileType) {
            $.ajax({
                url: '{{ route('staff.Applicant.Requirement.View') }}',
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    file_url: fileUrl
                },
                success: function(data) {
                    const fileContent = $('#fileContent');
                    fileContent.empty(); // Clear any previous content

                    if (fileType === 'pdf') {
                        // Display PDF in an iframe
                        const base64PDF = 'data:application/pdf;base64,' + data.base64File + '';
                        const embed = $('<iframe>', {
                            src: base64PDF,
                            type: 'application/pdf',
                            width: '100%',
                            height: '100%',
                            frameborder: '0',
                            allow: 'fullscreen'
                        });
                        fileContent.append(embed);


                    } else {
                        // Display Image
                        const img = $('<img>', {
                            src: `data:${fileType};base64,${data.base64File}`,
                            class: 'img-fluid',
                        });
                        fileContent.append(img);
                    }
                },
                error: function(error) {
                    console.log(error);
                }

            })

            const reviewFileModal = new bootstrap.Modal(document.getElementById('reviewFileModal'));
            reviewFileModal.show();

        }
    });
</script>
<script type="module">
    $(document).ready(function() {

    });
</script>
