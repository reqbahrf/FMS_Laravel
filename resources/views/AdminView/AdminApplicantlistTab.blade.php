<style>
    #applicantDetails {
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
                    <tbody id="ApplicanttableBody" class="table-group-divider">
                        @if (isset($applicants) && $applicants->isNotEmpty())
                            @foreach ($applicants as $applicantInfo)
                                <tr>
                                    <input type="hidden" name="user_Id" class="user_Id"
                                        value="{{ $applicantInfo->user_id }}">
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
                                                <span
                                                    class="building">{{ number_format($applicantInfo->building_value, 2) }}</span>
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
                                        <button class="btn btn-primary viewApplicant" type="button"
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
