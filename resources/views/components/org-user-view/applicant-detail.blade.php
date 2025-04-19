@props(['withProgress' => false])
<div
    class="offcanvas-body"
    id="applicantDetails"
>
    <div class="row g-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>
                        <i class="ri-user-3-fill"></i>
                        Contact Person Information:
                    </h2>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label
                                class="form-label"
                                for="contact_person"
                            >Contact Person:</label>
                            <input
                                class="form-control"
                                id="contact_person"
                                type="text"
                                readonly
                            >
                        </div>
                        <div class="col-md-1">
                            <label
                                class="form-label"
                                for="sex"
                            >Sex:</label>
                            <input
                                class="form-control"
                                id="sex"
                                type="text"
                                readonly
                            >
                        </div>
                        <div class="col-md-1">
                            <label
                                class="form-label"
                                for="age"
                            >Age:</label>
                            <input
                                class="form-control"
                                id="age"
                                type="text"
                                readonly
                            >
                        </div>
                        <div class="col-md-3">
                            <label
                                class="form-label"
                                for="designation"
                            >Designation:</label>
                            <input
                                class="form-control"
                                id="designation"
                                type="text"
                                readonly
                            >
                        </div>
                        <div class="col-12">
                            <label
                                class="form-label"
                                for="contantPersonAddress"
                            >
                                Home Address:
                            </label>
                            <input
                                class="form-control"
                                id="contactPersonHomeAddress"
                                type="text"
                                readonly
                            >

                        </div>
                        <div class="col-12">
                            <h3>
                                Contact Details:
                            </h3>
                        </div>
                        <div class="col-md-4">
                            <label
                                class="form-label"
                                for="landline"
                            >Landline:</label>
                            <input
                                class="form-control"
                                id="landline"
                                type="text"
                                readonly
                            >
                        </div>
                        <div class="col-md-4">
                            <label
                                class="form-label"
                                for="mobile_phone"
                            >Mobile Phone:</label>
                            <input
                                class="form-control"
                                id="mobile_phone"
                                type="text"
                                readonly
                            >
                        </div>
                        <div class="col-md-4">
                            <label
                                class="form-label"
                                for="email"
                            >Email Address:</label>
                            <input
                                class="form-control"
                                id="email"
                                type="text"
                                readonly
                            >
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h2>
                        <i class="ri-briefcase-fill"></i>
                        Business Information:
                    </h2>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <input
                            id="selected_userId"
                            type="hidden"
                        >
                        <input
                            id="selected_applicationId"
                            type="hidden"
                        >
                        <input
                            id="selected_businessID"
                            type="hidden"
                        >
                        <div class="col-md-6">
                            <label
                                class="form-label"
                                for="firm_name"
                            >Name of Firm:</label>
                            <input
                                class="form-control"
                                id="firm_name"
                                type="text"
                                readonly
                            >
                        </div>
                        <div class="col-12">
                            <label class="form-label">Factory Address:</label>
                            <input
                                class="form-control text-nowrap"
                                id="factoryAddress"
                                type="text"
                                readonly
                            >
                        </div>
                        <div class="col-12">
                            <label class="form-label">Office Address:</label>
                            <input
                                class="form-control text-nowrap"
                                id="officeAddress"
                                type="text"
                                readonly
                            >
                        </div>
                        <div class="col-md-3">
                            <label
                                class="form-label"
                                for="enterpriseType"
                            >Type of Enterprise:</label>
                            <input
                                class="form-control"
                                id="enterpriseType"
                                type="text"
                                readonly
                            >
                        </div>
                        <div class="col-md-6">
                            <label
                                class="form-label"
                                for="EnterpriseSector"
                            >Enterprise Sector:</label>
                            <input
                                class="form-control"
                                id="enterpriseSector"
                                type="text"
                                readonly
                            >
                        </div>
                        <div class="col-12">
                            <h3>
                                Assets
                            </h3>

                        </div>
                        <div class="col-md-4">
                            <label
                                class="form-label"
                                for="building"
                            >Building:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    ₱
                                </span>
                                <input
                                    class="form-control"
                                    id="building"
                                    name="building"
                                    type="text"
                                    readonly
                                >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label
                                class="form-label"
                                for="equipment"
                            >Equipment:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    ₱
                                </span>
                                <input
                                    class="form-control"
                                    id="equipment"
                                    name="equipment"
                                    type="text"
                                    readonly
                                >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label
                                class="form-label"
                                for="working_capital"
                            >Working Capital:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    ₱
                                </span>
                                <input
                                    class="form-control"
                                    id="working_capital"
                                    name="working_capital"
                                    type="text"
                                    readonly
                                >
                            </div>
                        </div>
                        <div class="col-12">
                            <h3>
                                Personnel Information:
                            </h3>
                        </div>
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Category</th>
                                        <th scope="col">Male (Regular)</th>
                                        <th scope="col">Female (Regular)</th>
                                        <th scope="col">Male (Part-time)</th>
                                        <th scope="col">Female (Part-time)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Direct Personnel</th>
                                        <td><input
                                                class="form-control"
                                                id="male_direct_re"
                                                type="text"
                                                readonly
                                            ></td>
                                        <td><input
                                                class="form-control"
                                                id="female_direct_re"
                                                type="text"
                                                readonly
                                            ></td>
                                        <td><input
                                                class="form-control"
                                                id="male_direct_part"
                                                type="text"
                                                readonly
                                            ></td>
                                        <td><input
                                                class="form-control"
                                                id="female_direct_part"
                                                type="text"
                                                readonly
                                            ></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Indirect Personnel</th>
                                        <td><input
                                                class="form-control"
                                                id="male_indirect_re"
                                                type="text"
                                                readonly
                                            ></td>
                                        <td><input
                                                class="form-control"
                                                id="female_indirect_re"
                                                type="text"
                                                readonly
                                            ></td>
                                        <td><input
                                                class="form-control"
                                                id="male_indirect_part"
                                                type="text"
                                                readonly
                                            ></td>
                                        <td><input
                                                class="form-control"
                                                id="female_indirect_part"
                                                type="text"
                                                readonly
                                            ></td>
                                    </tr>
                                    <tr>
                                        <th
                                            scope="row"
                                            colspan="4"
                                        >Total Personnel</th>
                                        <td><input
                                                class="form-control"
                                                id="total_personnel"
                                                type="text"
                                                readonly
                                            ></td>
                                    </tr>
                                </tbody>
                            </table>
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
        </div>
        @if ($withProgress)
            <div class="col-12">
                @include('staff-view.included-layout.applicant-application-progress')
            </div>
        @endif
    </div>
</div>
