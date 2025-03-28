<!-- Where Personal Info Displayed -->
<div class="row mb-3 gy-3">
    <h5>Contact Person:</h5>
    <x-custom-input.prefix-input />
    <div class="col-12 col-md-3">
        <label
            class="form-label"
            for="f_name"
        >First Name: <span class="requiredFields"> *</span></label>
        <input
            class="form-control"
            id="f_name"
            name="f_name"
            type="text"
            value="{{ old('f_name') }}"
            placeholder="John"
            required
        >
        <div class="invalid-feedback">
            Please enter your first name.
        </div>
    </div>
    <div class="col-12 col-md-2">
        <label
            class="form-label"
            for="mid_name"
        >Middle Name:</label>
        <input
            class="form-control"
            id="mid_name"
            name="mid_name"
            type="text"
            value="{{ old('mid_name') }}"
            placeholder="Doe"
        >
    </div>
    <div class="col-12 col-md-3">
        <label
            class="form-label"
            for="l_name"
        >Last Name: <span class="requiredFields"> *</span></label>
        <input
            class="form-control"
            id="l_name"
            name="l_name"
            type="text"
            value="{{ old('l_name') }}"
            placeholder="Doe"
            required
        >
        <div class="invalid-feedback">
            Please enter your last name.
        </div>
    </div>
    <x-custom-input.suffix-input />
    <div class="col-12 col-md-4">
        <div class="row">
            <div class="col-12 me-auto">
                <label
                    class="form-label"
                    for="sex"
                >sex: <span class="requiredFields">*</span></label>
                <select
                    class="form-select"
                    id="sex"
                    name="sex"
                    required
                >
                    <option value="">Select...</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <div class="invalid-feedback">
                    Please select your sex.
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="row">
            <div class="col-12 mx-auto">
                <label
                    class="form-label"
                    for="designation"
                >Designation: <span class="requiredFields">*</span>
                </label>
                <input
                    class="form-control"
                    id="designation"
                    name="designation"
                    data-bs-toggle="tooltip"
                    data-bs-placement="right"
                    type="text"
                    value="{{ old('designation') }}"
                    title="Example: Manager, Owner, CEO, etc."
                    placeholder="Designation"
                    required
                >
                <div class="invalid-feedback">
                    Please enter your Designation.
                </div>

            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="row">
            <div class="col-12 ms-auto">
                <label
                    class="form-label"
                    for="b_date"
                >Birth Date: <span class="requiredFields">
                        *</span></label>

                <input
                    class="form-control"
                    id="b_date"
                    name="b_date"
                    type="date"
                    value="{{ old('b_date') }}"
                    placeholder="DD/MM/YYYY"
                    required
                >
                <div class="invalid-feedback">
                    Please enter your Birth Date.
                </div>

            </div>
        </div>
    </div>

    <div class="col-12 ">
        <h5>Contact Info:</h5>
        <div class="row">
            <x-custom-input.mobile-num-input />
            <div class="col-12 col-md-6">
                <label
                    class="form-label"
                    for="landline"
                >Landline:</label>
                <input
                    class="form-control"
                    id="landline"
                    name="landline"
                    type="tel"
                    value="{{ old('landline') }}"
                    placeholder="(XX) YYY ZZZZ"
                >
                <div class="invalid-feedback">
                    Please enter a valid landline number.
                </div>
            </div>
        </div>
    </div>
</div>
