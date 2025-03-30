@props(['prefix', 'isRequired' => true, 'isContactIncluded' => true])
<div class="card p-0">
    <div class="card-header fw-bold">
        {{ ucfirst($prefix) }} Address:
    </div>
    <div class="card-body">
        <div class="row gy-3">
            <div class="col-12 col-md-3">
                <label
                    class="form-label"
                    for="{{ $prefix }}Region"
                >Region: {!! $isRequired ? '<span class="requiredFields">*</span>' : '' !!}</label>
                <select
                    class="form-select"
                    id="{{ $prefix }}Region"
                    name="{{ $prefix }}Region"
                    @required($isRequired)
                >
                    <option value="">Select Region</option>
                </select>
                <div class="invalid-feedback">Please select a region</div>
            </div>
            <div class="col-12 col-md-3">
                <label
                    class="form-label"
                    for="province"
                >Province: {!! $isRequired ? '<span class="requiredFields">*</span>' : '' !!}</label>
                <select
                    class="form-select"
                    id="{{ $prefix }}Province"
                    name="{{ $prefix }}Province"
                    @required($isRequired)
                    disabled
                >
                    <option value="">Select Province</option>
                </select>
                <div class="invalid-feedback">Please select a Province</div>
            </div>
            <div class="col-12 col-md-3">
                <label
                    class="form-label"
                    for="city"
                >City: {!! $isRequired ? '<span class="requiredFields">*</span>' : '' !!}</label>
                <select
                    class="form-select"
                    id="{{ $prefix }}City"
                    name="{{ $prefix }}City"
                    @required($isRequired)
                    disabled
                >
                    <option value="">Select City</option>
                </select>
                <div class="invalid-feedback">Please select a City</div>
            </div>
            <div class="col-12 col-md-3">
                <label
                    class="form-label"
                    for="{{ $prefix }}Barangay"
                >Barangay: {!! $isRequired ? '<span class="requiredFields">*</span>' : '' !!}</label>
                <select
                    class="form-select"
                    id="{{ $prefix }}Barangay"
                    name="{{ $prefix }}Barangay"
                    @required($isRequired)
                    disabled
                >
                    <option value="">Select Barangay</option>
                </select>
                <div class="invalid-feedback">Please select a Barangey</div>
            </div>
            <div class="col-12 col-md-10">
                <label
                    class="form-label"
                    for="Landmark"
                >Landmark: {!! $isRequired ? '<span class="requiredFields">*</span>' : '' !!}</label>
                <input
                    class="form-control"
                    id="{{ $prefix }}Landmark"
                    name="{{ $prefix }}Landmark"
                    type="text"
                    value="{{ old("{$prefix}Landmark") }}"
                    placeholder="Street Name, or Purok, Building No."
                    @required($isRequired)
                >
                <div class="invalid-feedback">
                    Please enter the landmark.
                </div>
            </div>
            <div class="col-12 col-md-2">
                <label
                    class="form-label"
                    for="{{ $prefix }}Zipcode"
                >Zip Code: {!! $isRequired ? '<span class="requiredFields"> *</span>' : '' !!}</label>
                <input
                    class="form-control"
                    id="{{ $prefix }}Zipcode"
                    name="{{ $prefix }}Zipcode"
                    type="text"
                    value="{{ old("{$prefix}Zipcode") }}"
                    placeholder="8000"
                    @required($isRequired)
                >
                <div class="invalid-feedback">
                    Please enter the zipcode.
                </div>
            </div>
            @if ($isContactIncluded)
                <div class="col-12 col-md-4">
                    <label
                        class="form-label"
                        for="{{ $prefix }}TelNo"
                    >Telephone No:</label>
                    <input
                        class="form-control"
                        id="{{ $prefix }}TelNo"
                        name="{{ $prefix }}TelNo"
                        type="text"
                        value="{{ old("{$prefix}TelNo") }}"
                        placeholder="1234567"
                    >
                </div>
                <div class="col-12 col-md-4">
                    <label
                        class="form-label"
                        for="{{ $prefix }}FaxNo"
                    >Fax No:</label>
                    <input
                        class="form-control"
                        id="{{ $prefix }}FaxNo"
                        name="{{ $prefix }}FaxNo"
                        type="text"
                        value="{{ old("{$prefix}FaxNo") }}"
                        placeholder="1234567"
                    >
                </div>
                <div class="col-12 col-md-4">
                    <label
                        class="form-label"
                        for="{{ $prefix }}EmailAddress"
                    >Email Address:</label>
                    <input
                        class="form-control"
                        id="{{ $prefix }}EmailAddress"
                        name="{{ $prefix }}EmailAddress"
                        type="email"
                        value="{{ old("{$prefix}EmailAddress") }}"
                        placeholder="example@domain.com"
                    >
                </div>
            @endif

        </div>
    </div>
</div>
