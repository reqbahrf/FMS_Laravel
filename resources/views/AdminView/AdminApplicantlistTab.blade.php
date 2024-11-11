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
                    <tbody id="ApplicanttableBody" class="table-group-divider">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
