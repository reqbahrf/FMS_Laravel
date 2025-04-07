<div class="p-3">
    <h1>Applicant</h1>
</div>
<div
    class="offcanvas offcanvas-end"
    id="applicantDetails"
    data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel"
    tabindex="-1"
>
    <div class="offcanvas-header bg-primary">
        <h1
            class="offcanvas-title text-white fs-4"
            id="staticBackdropLabel"
        >
            <i class="ri-id-card-fill ri-lg"></i>
            Applicant Details
        </h1>
        <button
            class="btn-close"
            data-bs-dismiss="offcanvas"
            type="button"
            aria-label="Close"
        ></button>
    </div>
    <div class="offcanvas-body">
        <div class="row gy-3">
            <div class="card p-0">
                <div class="card-header">
                    <h2 class="text-black mb-0">
                        <i class="ri-contacts-fill"></i>
                        Personal Info
                    </h2>
                </div>
                <div class="card-body">
                    <div class="row gy-2">
                        <div class="col-12 col-md-8">
                            <label for="cooperatorName">Cooperator Name:</label>
                            <input
                                class="form-control cooperator-name"
                                type="text"
                                readonly
                            >
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="designation">Designation:</label>
                            <input
                                class="form-control designation"
                                type="text"
                                readonly
                            >
                        </div>
                        <h3>Contact Details:</h3>
                        <div class="col-12 col-md-4">
                            <label for="landline">Landline:</label>
                            <input
                                class="form-control landline"
                                type="text"
                                readonly
                            >
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="mobilePhone">Mobile Phone:</label>
                            <input
                                class="form-control mobile-phone"
                                type="text"
                                readonly
                            >
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="email">Email:</label>
                            <input
                                class="form-control email"
                                type="text"
                                readonly
                            >
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-0">
                <div class="card-header">
                    <h2 class="text-black mb-0">
                        <i class="ri-briefcase-fill"></i>
                        Business Info
                    </h2>
                </div>
                <div class="card-body">
                    <div class="row gy-2">
                        <input
                            class="business-id"
                            type="hidden"
                        >
                        <div class="col-12">
                            <label for="factoryAddress">Factory Address:</label>
                            <input
                                class="form-control factory-address"
                                type="text"
                                readonly
                            >
                        </div>
                        <div class="col-12">
                            <label for="officeAddress">Office Address:</label>
                            <input
                                class="form-control office-address"
                                type="text"
                                readonly
                            >
                        </div>
                        <div class="col-12">
                            <label for="typeOfEnterprise">Type of Enterprise:</label>
                            <input
                                class="form-control type-of-enterprise"
                                type="text"
                                readonly
                            >
                        </div>
                        <h3>Assets:</h3>
                        <div class="col-12 col-md-4">
                            <label
                                class="ps-2"
                                for="building"
                            >Building:</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input
                                    class="form-control building"
                                    type="text"
                                    readonly
                                >
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <label
                                class="ps-2"
                                for="equipment"
                            >Equipment:</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input
                                    class="form-control equipment"
                                    type="text"
                                    readonly
                                >
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <label
                                class="ps-2"
                                for="land"
                            >Working Capital:</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input
                                    class="form-control working-capital"
                                    type="text"
                                    readonly
                                >
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <h4 class="text-center">
                                Requested Fund Amount by the Applicant:
                            </h4>
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="input-group w-50">
                                    <span class="input-group-text">₱</span>
                                    <input
                                        class="form-control fw-bold"
                                        id="requested_fund_amount"
                                        type="text"
                                        readonly
                                    >
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card p-0">
                <div class="card-header">
                    <h2 class="text-black mb-0">
                        <i class="ri-team-fill"></i>
                        Personnel Information
                    </h2>
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
                                    <input
                                        class="form-control form-control-sm personnel-male-direct-re"
                                        type="text"
                                        readonly
                                    >
                                </td>
                                <td>
                                    <input
                                        class="form-control form-control-sm personnel-female-direct-re"
                                        type="text"
                                        readonly
                                    >
                                </td>
                                <td>
                                    <input
                                        class="form-control form-control-sm personnel-direct-re-total"
                                        type="text"
                                        readonly
                                    >
                                </td>
                            </tr>
                            <tr>
                                <td>Direct Part-time Employees</td>
                                <td>
                                    <input
                                        class="form-control form-control-sm personnel-male-direct-part"
                                        type="text"
                                        readonly
                                    >
                                </td>
                                <td>
                                    <input
                                        class="form-control form-control-sm personnel-female-direct-part"
                                        type="text"
                                        readonly
                                    >
                                </td>
                                <td>
                                    <input
                                        class="form-control form-control-sm personnel-direct-part-total"
                                        type="text"
                                        readonly
                                    >
                                </td>
                            </tr>
                            <tr>
                                <td>Indirect Regular Employees</td>
                                <td>
                                    <input
                                        class="form-control form-control-sm personnel-male-indirect-re"
                                        type="text"
                                        readonly
                                    >
                                </td>
                                <td>
                                    <input
                                        class="form-control form-control-sm personnel-female-indirect-re"
                                        type="text"
                                        readonly
                                    >
                                </td>
                                <td>
                                    <input
                                        class="form-control form-control-sm personnel-indirect-re-total"
                                        type="text"
                                        readonly
                                    >
                                </td>
                            </tr>
                            <tr>
                                <td>Indirect Part-time Employees</td>
                                <td>
                                    <input
                                        class="form-control form-control-sm personnel-male-indirect-part"
                                        type="text"
                                        readonly
                                    >
                                </td>
                                <td>
                                    <input
                                        class="form-control form-control-sm personnel-female-indirect-part"
                                        type="text"
                                        readonly
                                    >
                                </td>
                                <td>
                                    <input
                                        class="form-control form-control-sm personnel-indirect-part-total"
                                        type="text"
                                        readonly
                                    >
                                </td>
                            </tr>
                            <tr class="table-active">
                                <td><strong>Total Personnel</strong></td>
                                <td colspan="2"></td>
                                <td>
                                    <input
                                        class="form-control form-control-sm personnel-total fw-bold"
                                        type="text"
                                        readonly
                                    >
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
        <div class="py-4">
            <div class="mx-2 table-responsive-xl">
                <table
                    class="table table-hover mx-2"
                    id="applicant"
                    style="width:100%"
                >
                    <tbody
                        class="table-group-divider"
                        id="ApplicanttableBody"
                    >
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
