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
                <div class="card-header bg-primary">
                    <h5 class="text-white mb-0">
                        <i class="ri-contacts-fill"></i>
                        Personal Info
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row gy-2">
                        <div class="col-12 col-md-8">
                            <label for="cooperatorName">Cooperator Name:</label>
                            <input type="text" class="form-control cooperator-name" readonly>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="designation">Designation:</label>
                            <input type="text" class="form-control designation" readonly>
                        </div>
                        <h6>Contact Details:</h6>
                        <div class="col-12 col-md-4">
                            <label for="landline">Landline:</label>
                            <input type="text" class="form-control landline" readonly>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="mobilePhone">Mobile Phone:</label>
                            <input type="text" class="form-control mobile-phone" readonly>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control email" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-0">
                <div class="card-header bg-primary">
                    <h6 class="text-white mb-0">
                        <i class="ri-briefcase-fill"></i>
                        Business Info
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row gy-2">
                        <input type="hidden" class="business-id">
                        <div class="col-12">
                            <label for="businessAddress">Business Address:</label>
                            <input type="text" class="form-control business-address" readonly>
                        </div>
                        <div class="col-12">
                            <label for="typeOfEnterprise">Type of Enterprise:</label>
                            <input type="text" class="form-control type-of-enterprise" readonly>
                        </div>
                        <h6>Assets:</h6>
                        <div class="col-12 col-md-4">
                            <label for="building" class="ps-2">Building:</label>
                            <input type="text" class="form-control building" readonly>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="equipment" class="ps-2">Equipment:</label>
                            <input type="text" class="form-control equipment" readonly>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="land" class="ps-2">Working Capital:</label>
                            <input type="text" class="form-control working-capital" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-0">
                <div class="card-header bg-primary">
                    <h6 class="text-white mb-0">
                        <i class="ri-team-fill"></i>
                        Personnel Information
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Personnel Category</th>
                                <th>Male</th>
                                <th>Female</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Direct Regular Employees</td>
                                <td>
                                    <input type="text" class="form-control form-control-sm personnel-male-direct-re" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm personnel-female-direct-re" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm personnel-direct-re-total" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td>Direct Part-time Employees</td>
                                <td>
                                    <input type="text" class="form-control form-control-sm personnel-male-direct-part" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm personnel-female-direct-part" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm personnel-direct-part-total" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td>Indirect Regular Employees</td>
                                <td>
                                    <input type="text" class="form-control form-control-sm personnel-male-indirect-re" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm personnel-female-indirect-re" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm personnel-indirect-re-total" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td>Indirect Part-time Employees</td>
                                <td>
                                    <input type="text" class="form-control form-control-sm personnel-male-indirect-part" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm personnel-female-indirect-part" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm personnel-indirect-part-total" readonly>
                                </td>
                            </tr>
                            <tr class="table-active">
                                <td><strong>Total Personnel</strong></td>
                                <td colspan="2"></td>
                                <td>
                                    <input type="text" class="form-control form-control-sm personnel-total fw-bold" readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
                    <tbody id="ApplicanttableBody" class="table-group-divider">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
