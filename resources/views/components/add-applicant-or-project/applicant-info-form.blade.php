<div>
    <h4 class="p-3">Add Applicant</h4>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb px-3">
        <li class="breadcrumb-item"><a
                href="#"
                onclick="loadPage('{{ route('staff.Project') }}', 'projectLink')"
            >Projects</a></li>
        <li class="breadcrumb-item active">Add Applicant</li>
    </ol>
</nav>
<div class="card m-0 m-md-3">
    <div class="card-body">
        <form class="p-4">
            <div class="row mb-4 gy-3">
                <div class="col-md-12">
                    <h5 class="mb-3">Personal Information</h5>
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <label
                        class="form-label"
                        for="email"
                    >Email Address: <span class="text-danger">*</span></label>
                    <input
                        class="form-control"
                        id="email"
                        name="email"
                        type="email"
                        title="Please enter a valid email address"
                        required
                    >
                    <div class="form-text text-muted">To ensure successful delivery of login
                        credentials, please enter a valid email address for the user registration.</div>
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>
                <div class="col-12">
                    <hr>
                </div>
                <x-custom-input.prefix-input />

                <!-- First Name -->
                <div class="col-md-3">
                    <label
                        class="form-label"
                        for="firstName"
                    >First Name: <span class="text-danger">*</span></label>
                    <input
                        class="form-control"
                        id="firstName"
                        name="firstName"
                        type="text"
                        required
                    >
                    <div class="invalid-feedback">Please enter a valid first name.</div>
                </div>

                <!-- Middle Name -->
                <div class="col-md-2">
                    <label
                        class="form-label"
                        for="middleName"
                    >Middle Name:</label>
                    <input
                        class="form-control"
                        id="middleName"
                        name="middleName"
                        type="text"
                    >
                    <div class="invalid-feedback">Please enter a valid middle name.</div>
                </div>

                <!-- Last Name -->
                <div class="col-md-3">
                    <label
                        class="form-label"
                        for="lastName"
                    >Last Name: <span class="text-danger">*</span></label>
                    <input
                        class="form-control"
                        id="lastName"
                        name="lastName"
                        type="text"
                        required
                    >
                    <div class="invalid-feedback">Please enter a valid last name.</div>
                </div>

                <x-custom-input.suffix-input />

                <!-- Sex -->
                <div class="col-md-3">
                    <label
                        class="form-label"
                        for="sex"
                    >Sex: <span class="text-danger">*</span></label>
                    <select
                        class="form-select"
                        id="sex"
                        name="sex"
                        required
                    >
                        <option
                            value=""
                            selected
                            disabled
                        >Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <!-- Designation -->
                <div class="col-md-3">
                    <label
                        class="form-label"
                        for="designation"
                    >Designation: <span class="text-danger">*</span></label>
                    <input
                        class="form-control"
                        id="designation"
                        name="designation"
                        type="text"
                        placeholder="e.g. CEO, Owner"
                        required
                    >
                    <div class="invalid-feedback">Please enter a valid designation.</div>
                </div>

                <!-- Birth Date -->
                <div class="col-md-3">
                    <label
                        class="form-label"
                        for="birthDate"
                    >Birth Date: <span class="text-danger">*</span></label>
                    <input
                        class="form-control"
                        id="birthDate"
                        name="birthDate"
                        type="date"
                        required
                    >
                    <div class="invalid-feedback">Please enter a valid birth date.</div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <h5 class="mb-3">Contact Information</h5>
                </div>

                <!-- Mobile Number -->
                <x-custom-input.mobile-num-input />

                <!-- Landline -->
                <div class="col-md-6">
                    <label
                        class="form-label"
                        for="landline"
                    >Landline:</label>
                    <input
                        class="form-control"
                        id="landline"
                        name="landline"
                        type="tel"
                        placeholder="XXX-XXXX"
                    >
                </div>
                <div class="col-12">
                    <hr>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-end mb-3">
                <div class="d-flex flex-column align-items-start">
                    <h5 class="mb-3">Mode of Application:</h5>
                    <div>
                        <div class="form-check mb-2">
                            <input
                                class="form-check-input"
                                id="mode1"
                                name="mode"
                                type="radio"
                                value="1"
                            >
                            <label
                                class="form-check-label"
                                for="mode1"
                            >Fill the application form in applicant's stead</label>
                            <div class="form-text text-muted">Will redirect to applicant's application page</div>
                        </div>
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                id="mode2"
                                name="mode"
                                type="radio"
                                value="2"
                            >
                            <label
                                class="form-check-label"
                                for="mode2"
                            >Let the applicant fill-up the form</label>
                            <div class="form-text text-muted">Will send the application form to the applicant's email
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-end">
                    <button
                        class="btn btn-primary"
                        type="submit"
                    >Save</button>
                    <button
                        class="btn btn-secondary"
                        type="reset"
                    >Reset</button>
                </div>
            </div>
        </form>
    </div>
</div>
