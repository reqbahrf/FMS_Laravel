@props(['prefix', 'isRequired' => true, 'isContactIncluded' => true, 'sameAddressWith' => null])
<div class="card p-0">
    <div class="card-header fw-bold">
        {{ ucfirst($prefix) }} Address:
    </div>
    <div class="card-body">
        <div class="row gy-3">
            @isset($sameAddressWith)
                <div class="d-flex justify-content-end align-items-center">
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            id="same_address_with_{{ $sameAddressWith }}"
                            name="same_address_with_{{ $sameAddressWith }}"
                            type="checkbox"
                        >
                        <label
                            class="form-check-label"
                            for="same_address_with_{{ $sameAddressWith }}"
                        >Same Address With: {{ ucfirst($sameAddressWith) }}</label>
                        <div class="form-text">
                            Check this box if the address is the same as the {{ $sameAddressWith }} address.
                        </div>
                    </div>
                </div>
            @endisset
            <div class="col-12 col-md-3">
                <label
                    class="form-label"
                    for="{{ $prefix }}_region"
                >Region: {!! $isRequired ? '<span class="requiredFields">*</span>' : '' !!}</label>
                <select
                    class="form-select"
                    id="{{ $prefix }}_region"
                    name="{{ $prefix }}_region"
                    @required($isRequired)
                >
                    <option value="">Select Region</option>
                </select>
                <div class="invalid-feedback">Please select a region</div>
            </div>
            <div class="col-12 col-md-3">
                <label
                    class="form-label"
                    for="{{ $prefix }}_province"
                >Province: {!! $isRequired ? '<span class="requiredFields">*</span>' : '' !!}</label>
                <select
                    class="form-select"
                    id="{{ $prefix }}_province"
                    name="{{ $prefix }}_province"
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
                    for="{{ $prefix }}_city"
                >City: {!! $isRequired ? '<span class="requiredFields">*</span>' : '' !!}</label>
                <select
                    class="form-select"
                    id="{{ $prefix }}_city"
                    name="{{ $prefix }}_city"
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
                    for="{{ $prefix }}_barangay"
                >Barangay: {!! $isRequired ? '<span class="requiredFields">*</span>' : '' !!}</label>
                <select
                    class="form-select"
                    id="{{ $prefix }}_barangay"
                    name="{{ $prefix }}_barangay"
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
                    for="{{ $prefix }}_landmark"
                >Landmark: {!! $isRequired ? '<span class="requiredFields">*</span>' : '' !!}</label>
                <input
                    class="form-control"
                    id="{{ $prefix }}_landmark"
                    name="{{ $prefix }}_landmark"
                    type="text"
                    value="{{ old("{$prefix}_landmark") }}"
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
                    for="{{ $prefix }}_zipcode"
                >Zip Code: {!! $isRequired ? '<span class="requiredFields"> *</span>' : '' !!}</label>
                <input
                    class="form-control"
                    id="{{ $prefix }}_zipcode"
                    name="{{ $prefix }}_zipcode"
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
                        for="{{ $prefix }}_telNo"
                    >Telephone No:</label>
                    <input
                        class="form-control"
                        id="{{ $prefix }}_telNo"
                        name="{{ $prefix }}_telNo"
                        type="text"
                        value="{{ old("{$prefix}_telNo") }}"
                        placeholder="1234567"
                    >
                </div>
                <div class="col-12 col-md-4">
                    <label
                        class="form-label"
                        for="{{ $prefix }}_faxNo"
                    >Fax No:</label>
                    <input
                        class="form-control"
                        id="{{ $prefix }}_faxNo"
                        name="{{ $prefix }}_faxNo"
                        type="text"
                        value="{{ old("{$prefix}_faxNo") }}"
                        placeholder="1234567"
                    >
                </div>
                <div class="col-12 col-md-4">
                    <label
                        class="form-label"
                        for="{{ $prefix }}_emailAddress"
                    >Email Address:</label>
                    <input
                        class="form-control"
                        id="{{ $prefix }}_emailAddress"
                        name="{{ $prefix }}_emailAddress"
                        type="email"
                        value="{{ old("{$prefix}_emailAddress") }}"
                        placeholder="example@domain.com"
                    >
                </div>
            @endif

        </div>
    </div>
</div>
