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
            <div class="row mb-4">
                <div class="col-md-12">
                    <h5 class="mb-3">Personal Information</h5>
                </div>

                <!-- Email -->
                <div class="col-md-6 mb-3">
                    <label
                        class="form-label"
                        for="email"
                    >Email Address <span class="text-danger">*</span></label>
                    <input
                        class="form-control"
                        id="email"
                        name="email"
                        type="email"
                        required
                    >
                </div>

                <!-- First Name -->
                <div class="col-md-6 mb-3">
                    <label
                        class="form-label"
                        for="firstName"
                    >First Name <span class="text-danger">*</span></label>
                    <input
                        class="form-control"
                        id="firstName"
                        name="firstName"
                        type="text"
                        required
                    >
                </div>

                <!-- Middle Name -->
                <div class="col-md-6 mb-3">
                    <label
                        class="form-label"
                        for="middleName"
                    >Middle Name</label>
                    <input
                        class="form-control"
                        id="middleName"
                        name="middleName"
                        type="text"
                    >
                </div>

                <!-- Last Name -->
                <div class="col-md-6 mb-3">
                    <label
                        class="form-label"
                        for="lastName"
                    >Last Name <span class="text-danger">*</span></label>
                    <input
                        class="form-control"
                        id="lastName"
                        name="lastName"
                        type="text"
                        required
                    >
                </div>

                <!-- Suffix -->
                <div class="col-md-3 mb-3">
                    <label
                        class="form-label"
                        for="suffix"
                    >Suffix</label>
                    <select
                        class="form-select"
                        id="suffix"
                        name="suffix"
                    >
                        <option
                            value=""
                            selected
                        >None</option>
                        <option value="Jr.">Jr.</option>
                        <option value="Sr.">Sr.</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                    </select>
                </div>

                <!-- Sex -->
                <div class="col-md-3 mb-3">
                    <label
                        class="form-label"
                        for="sex"
                    >Sex <span class="text-danger">*</span></label>
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
                <div class="col-md-3 mb-3">
                    <label
                        class="form-label"
                        for="designation"
                    >Designation <span class="text-danger">*</span></label>
                    <input
                        class="form-control"
                        id="designation"
                        name="designation"
                        type="text"
                        placeholder="e.g. CEO, Owner"
                        required
                    >
                </div>

                <!-- Birth Date -->
                <div class="col-md-3 mb-3">
                    <label
                        class="form-label"
                        for="birthDate"
                    >Birth Date <span class="text-danger">*</span></label>
                    <input
                        class="form-control"
                        id="birthDate"
                        name="birthDate"
                        type="date"
                        required
                    >
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <h5 class="mb-3">Contact Information</h5>
                </div>

                <!-- Mobile Number -->
                <x-custom-input.mobile-num-input />

                <!-- Landline -->
                <div class="col-md-6 mb-3">
                    <label
                        class="form-label"
                        for="landline"
                    >Landline</label>
                    <input
                        class="form-control"
                        id="landline"
                        name="landline"
                        type="tel"
                        placeholder="XXX-XXXX"
                    >
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <button
                        class="btn btn-primary"
                        type="submit"
                    >Submit</button>
                    <button
                        class="btn btn-secondary"
                        type="reset"
                    >Reset</button>
                </div>
            </div>
        </form>
    </div>
</div>
