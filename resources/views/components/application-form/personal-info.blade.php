<!-- Where Personal Info Displayed -->
@props(['withRequestRefundInput' => true, 'personalInfo' => null, 'coopUserInfo' => null])
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
            value="{{ $personalInfo->f_name ?? ($coopUserInfo->f_name ?? '') }}"
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
            value="{{ $coopUserInfo->mid_name ?? '' }}"
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
            value="{{ $personalInfo->l_name ?? ($coopUserInfo->l_name ?? '') }}"
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
                    <option
                        value="Male"
                        {{ $coopUserInfo->sex ?? '' === 'Male' ? 'selected' : '' }}
                    >Male</option>
                    <option
                        value="Female"
                        {{ $coopUserInfo->sex ?? '' === 'Female' ? 'selected' : '' }}
                    >Female</option>
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
                    value="{{ $coopUserInfo->designation ?? '' }}"
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
                    value="{{ \Carbon\Carbon::parse($coopUserInfo->birth_date)->format('Y-m-d') ?? '' }}"
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
            <x-custom-input.mobile-num-input :mobileNumber="$coopUserInfo->mobile_number ?? ''" />
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
                    value="{{ $coopUserInfo->landline ?? '' }}"
                    placeholder="(XX) YYY ZZZZ"
                >
                <div class="invalid-feedback">
                    Please enter a valid landline number.
                </div>
            </div>
        </div>
    </div>
    @if ($withRequestRefundInput)
        <div class="col-12">
            <h4 class="text-center">
                Requested Fund Amount by the Applicant:<span class="text-danger">*</span>
            </h4>
            <div class="d-flex align-items-center justify-content-center">
                <div class="input-group w-50">
                    <span class="input-group-text">₱</span>
                    <input
                        class="form-control fw-bold"
                        id="requested_fund_amount"
                        name="requested_fund_amount"
                        type="text"
                    >
                </div>
            </div>
        </div>
    @endif
    <div class="col-12">
        <x-custom-input.address-card-select
            prefix="home"
            :isContactIncluded="false"
            :isRequired="true"
        />
    </div>
</div>
