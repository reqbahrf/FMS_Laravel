
<!-- Where the business info displayed -->
<div class="row g-3">
    <div class="col-12 col-md-8">
        <label
            class="form-label"
            for="firm_name"
        >Name of Firm: <span class="requiredFields">
                *</span></label>
        <input
            class="form-control"
            id="firm_name"
            name="firm_name"
            type="text"
            value="{{ old('firm_name') }}"
            placeholder="ABC Company"
            required
        >
        <div class="invalid-feedback">
            Please enter the name of the firm.
        </div>
    </div>
    <div class="col-12 col-md-4">
        <label
            class="form-label"
            for="enterpriseType"
        >Type Of Enterprise <span class="requiredFields">
                *</span></label>
        <select
            class="form-select"
            id="enterpriseType"
            name="enterpriseType"
            required
        >
            <option value="">Select Enterprise</option>
            <option value="Sole Proprietorship">Sole
                Proprietorship</option>
            <option value="Partnership">Partnership
            </option>
            <option value="Corporation (Non-Profit)">Corporation (Non-Profit)
            </option>
            <option value="Corporation (Profit)">Corporation (Profit)
            </option>
        </select>
        <div class="invalid-feedback">
            Please select a type of enterprise.
        </div>
    </div>
    <div class="col-12 col-md-12">
        <label
            class="form-label"
            for="briefBackground"
        >Brief Enterprise Background: <span class="requiredFields">
                *</span></label>
        <textarea
            class="form-control"
            id="briefBackground"
            name="brief_background"
            rows="3"
            placeholder="Enter Brief Enterprise Background"
            required
        ></textarea>
        <div class="invalid-feedback">
            Please enter the brief enterprise background.
        </div>
    </div>
    <div class="col-12 col-md-6">
        <label
            class="form-label"
            for="website"
        >Website:</label>
        <input
            class="form-control"
            id="website"
            name="website"
            type="url"
            value="{{ old('website') }}"
            placeholder="https://example.com"
        >
        <div class="invalid-feedback">
            Please enter a valid website.
        </div>
    </div>
    <div class="col-12 col-md-6">
        <label
            class="form-label"
            for="yearEstablished"
        >Year Enterprise Was Established: <span class="requiredFields">
                *</span></label>
        <input
            class="form-control"
            id="yearEstablished"
            name="yearEstablished"
            type="text"
            value=""
            placeholder="YYYY"
            pattern="^(19[0-9]{2}|20[0-9]{2})$"
            maxlength="4"
            min="1900"
            max="{{ date('Y') }}"
            inputmode="numeric"
            required
        >
        <div class="invalid-feedback">
            Please enter the year enterprise was established.
        </div>
    </div>

    <div class="col-12 col-md-6">
        <label
            class="form-label"
            for="businessPermitNo"
        >Business Permit No.: <span class="requiredFields">
                *</span></label>
        <input
            class="form-control"
            id="business_permit_No"
            name="business_permit_No"
            type="text"
            placeholder="Enter Business Permit No."
            required
        >
        <div class="invalid-feedback">
            Please enter the business permit no.
        </div>
    </div>

    <div class="col-12 col-md-6">
        <label
            class="form-label"
            for="yearRegistered"
        >Year Registered: <span class="requiredFields">
                *</span></label>
        <input
            class="form-control"
            id="permitYearRegistered"
            name="permit_year_registered"
            type="text"
            value=""
            placeholder="YYYY"
            pattern="^(19[0-9]{2}|20[0-9]{2})$"
            maxlength="4"
            min="1900"
            max="{{ date('Y') }}"
            inputmode="numeric"
            required
        >
        <div class="invalid-feedback">
            Please enter the year registered.
        </div>
    </div>

    <div class="col-12 col-md-6">
        <label
            class="form-label"
            for="enterpriseRegistrationNo"
        >Enterprise Registration No.: <span class="requiredFields">
                *</span></label>
        <input
            class="form-control"
            id="enterpriseRegistrationNo"
            name="enterpriseRegistrationNo"
            type="text"
            value="{{ old('enterpriseRegistrationNo') }}"
            placeholder="Enter Enterprise Registration No."
            required
        >
        <div class="invalid-feedback">
            Please enter the enterprise registration no.
        </div>
    </div>

    <div class="col-12 col-md-6">
        <label
            class="form-label"
            for="yearEnterpriseRegistered"
        >Year Enterprise Registered: <span class="requiredFields">
                *</span></label>
        <input
            class="form-control"
            id="yearEnterpriseRegistered"
            name="yearEnterpriseRegistered"
            type="text"
            value=""
            placeholder="YYYY"
            pattern="^(19[0-9]{2}|20[0-9]{2})$"
            maxlength="4"
            min="1900"
            max="{{ date('Y') }}"
            inputmode="numeric"
            required
        >
        <div class="invalid-feedback">
            Please enter the year enterprise registered.
        </div>
    </div>
    <div class="col-12 col-md-4">
        <label
            class="form-label"
            for="initialCapitalization"
        >Initial Capitalization: <span class="requiredFields">
                *</span></label>
        <div class="input-group">
            <span class="input-group-text">₱</span>
            <input
                class="form-control"
                id="initial_capitalization"
                name="initial_capitalization"
                type="text"
                value="{{ old('initialCapitalization') }}"
                placeholder="900,000.00"
                required
            >
        </div>
        <div class="invalid-feedback">
            Please enter the initial capitalization.
        </div>
    </div>
    <div class="col-12 col-md-4">
        <label
            class="form-label"
            for="presentCapitalization"
        >Present Capitalization: <span class="requiredFields">
                *</span></label>
        <div class="input-group">
            <span class="input-group-text">₱</span>
            <input
                class="form-control"
                id="present_capitalization"
                name="present_capitalization"
                type="text"
                placeholder="900,000.00"
                required
            >
        </div>
        <div class="invalid-feedback">
            Please enter the present capitalization.
        </div>
    </div>
    <div class="card p-0">
        <div class="card-header fw-bold">
            Office Address:
        </div>
        <div class="card-body">
            <div class="row gy-3">
                <div class="col-12 col-md-3">
                    <label
                        class="form-label"
                        for="region"
                    >Region:<span class="requiredFields">*</span></label>
                    <select
                        class="form-select"
                        id="officeRegion"
                        name="officeRegion"
                        required
                    >
                        <option value="">Select Region</option>
                    </select>
                    <div class="invalid-feedback">Please select a region</div>
                </div>
                <div class="col-12 col-md-3">
                    <label
                        class="form-label"
                        for="province"
                    >Province:<span class="requiredFields">*</span></label>
                    <select
                        class="form-select"
                        id="officeProvince"
                        name="officeProvince"
                        required
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
                    >City:<span class="requiredFields">*</span></label>
                    <select
                        class="form-select"
                        id="officeCity"
                        name="officeCity"
                        required
                        disabled
                    >
                        <option value="">Select City</option>
                    </select>
                    <div class="invalid-feedback">Please select a City</div>
                </div>
                <div class="col-12 col-md-3">
                    <label
                        class="form-label"
                        for="barangay"
                    >Barangay:<span class="requiredFields">*</span></label>
                    <select
                        class="form-select"
                        id="officeBarangay"
                        name="officeBarangay"
                        required
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
                    >Landmark: <span class="requiredFields">
                            *</span></label>
                    <input
                        class="form-control"
                        id="officeLandmark"
                        name="officeLandmark"
                        type="text"
                        value="{{ old('officeLandmark') }}"
                        placeholder="Street Name, or Purok, Building No."
                        required
                    >
                    <div class="invalid-feedback">
                        Please enter the landmark.
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <label
                        class="form-label"
                        for="zipcode"
                    >Zip Code: <span class="requiredFields"> *</span">
                    </label>
                    <input
                        class="form-control"
                        id="officeZipcode"
                        name="officeZipcode"
                        type="text"
                        value="{{ old('officeZipcode') }}"
                        placeholder="8000"
                        required
                    >
                    <div class="invalid-feedback">
                        Please enter the zipcode.
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <label
                        class="form-label"
                        for="telNo"
                    >Telephone No:</label>
                    <input
                        class="form-control"
                        id="officeTelNo"
                        name="officeTelNo"
                        type="text"
                        value="{{ old('officeTelNo') }}"
                        placeholder="1234567"
                    >
                </div>
                <div class="col-12 col-md-4">
                    <label
                        class="form-label"
                        for="faxNo"
                    >Fax No:</label>
                    <input
                        class="form-control"
                        id="officeFaxNo"
                        name="officeFaxNo"
                        type="text"
                        value="{{ old('officeFaxNo') }}"
                        placeholder="1234567"
                    >
                </div>
                <div class="col-12 col-md-4">
                    <label
                        class="form-label"
                        for="emailAddress"
                    >Email Address:</label>
                    <input
                        class="form-control"
                        id="officeEmailAddress"
                        name="officeEmailAddress"
                        type="email"
                        value="{{ old('emailAddress') }}"
                        placeholder="example@domain.com"
                    >
                </div>

            </div>
        </div>
    </div>
    <div class="card p-0">
        <div class="card-header fw-bold">
            Factory Address:
        </div>
        <div class="card-body">
            <div class="row gy-3">
                <div class="col-12 col-md-3">
                    <label
                        class="form-label"
                        for="region"
                    >Region:<span class="requiredFields">*</span></label>
                    <select
                        class="form-select"
                        id="factoryRegion"
                        name="factoryRegion"
                        required
                    >
                        <option value="">Select Region</option>
                    </select>
                    <div class="invalid-feedback">Please select a region</div>
                </div>
                <div class="col-12 col-md-3">
                    <label
                        class="form-label"
                        for="province"
                    >Province:<span class="requiredFields">*</span></label>
                    <select
                        class="form-select"
                        id="factoryProvince"
                        name="factoryProvince"
                        required
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
                    >City:<span class="requiredFields">*</span></label>
                    <select
                        class="form-select"
                        id="factoryCity"
                        name="factoryCity"
                        required
                        disabled
                    >
                        <option value="">Select City</option>
                    </select>
                    <div class="invalid-feedback">Please select a City</div>
                </div>
                <div class="col-12 col-md-3">
                    <label
                        class="form-label"
                        for="barangay"
                    >Barangay:<span class="requiredFields">*</span></label>
                    <select
                        class="form-select"
                        id="factoryBarangay"
                        name="factoryBarangay"
                        required
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
                    >Landmark: <span class="requiredFields">
                            *</span></label>
                    <input
                        class="form-control"
                        id="factoryLandmark"
                        name="factoryLandmark"
                        type="text"
                        value="{{ old('factoryLandmark') }}"
                        placeholder="Street Name, or Purok, Building No."
                        required
                    >
                    <div class="invalid-feedback">
                        Please enter the landmark.
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <label
                        class="form-label"
                        for="zipcode"
                    >Zip Code: <span class="requiredFields"> *</span">
                    </label>
                    <input
                        class="form-control"
                        id="factoryZipcode"
                        name="factoryZipcode"
                        type="text"
                        value="{{ old('factoryZipcode') }}"
                        placeholder="8000"
                        required
                    >
                    <div class="invalid-feedback">
                        Please enter the zipcode.
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <label
                        class="form-label"
                        for="telNo"
                    >Telephone No:</label>
                    <input
                        class="form-control"
                        id="factoryTelNo"
                        name="factoryTelNo"
                        type="text"
                        placeholder="1234567"
                    >
                </div>
                <div class="col-12 col-md-4">
                    <label
                        class="form-label"
                        for="faxNo"
                    >Fax No:</label>
                    <input
                        class="form-control"
                        id="factoryFaxNo"
                        name="factoryFaxNo"
                        type="text"
                        placeholder="1234567"
                    >
                </div>
                <div class="col-12 col-md-4">
                    <label
                        class="form-label"
                        for="emailAddress"
                    >Email Address:</label>
                    <input
                        class="form-control"
                        id="factoryEmailAddress"
                        name="factoryEmailAddress"
                        type="email"
                        placeholder="example@domain.com"
                    >
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center my-1 g-3">
    <div class="card p-0">
        <div class="card-header fw-bold">
            Assets:
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-4">
                    <label
                        class="form-label"
                        for="buildings"
                    >Buildings: <span class="requiredFields">
                            *</span></label>
                    <div class="input-group">
                        <span class="input-group-text">
                            ₱
                        </span>
                        <input
                            class="form-control"
                            id="buildings"
                            name="buildings"
                            type="text"
                            value="{{ old('buildings') }}"
                            placeholder="500,000.00"
                            required
                        >
                    </div>
                    <div class="invalid-feedback">
                        Please enter the value of buildings.
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <label
                        class="form-label"
                        for="equipments"
                    >Equipments: <span class="requiredFields">
                            *</span></label>
                    <div class="input-group">
                        <span class="input-group-text">
                            ₱
                        </span>
                        <input
                            class="form-control"
                            id="equipments"
                            name="equipments"
                            type="text"
                            value="{{ old('equipments') }}"
                            placeholder="500,000.00"
                            required
                        >
                    </div>
                    <div class="invalid-feedback">
                        Please enter the value of equipments.
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <label
                        class="form-label"
                        for="working_capital"
                    >Working Capital: <span class="requiredFields">
                            *</span></label>
                    <div class="input-group">
                        <span class="input-group-text">
                            ₱
                        </span>
                        <input
                            class="form-control"
                            id="working_capital"
                            name="working_capital"
                            type="text"
                            value="{{ old('working_capital') }}"
                            placeholder="500,000.00"
                            required
                        >
                    </div>
                    <div class="invalid-feedback">
                        Please enter the value of working capital.
                    </div>
                </div>
            </div>
            <div class="row text-center mt-3">
                <div class="col-12 col-md-6">
                    <p class="fw-normal">Total Assets: <span id="to_Assets"></span></p>

                </div>
                <div class="col-12 col-md-6">
                    <p class="fw-normal">Enterprise Level: <span id="Enterprise_Level"></span>
                    </p>

                </div>
            </div>
            <input
                id="EnterpriseLevelInput"
                name="enterprise_level"
                type="hidden"
            >
        </div>
    </div>
    <div class="card p-0">
        <div class="card-header fw-bold">
            Business Activity
        </div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label">Business Activity:</label>
                <div class="d-flex align-items-center mb-2">
                    <div class="form-check mr-3">
                        <input
                            class="form-check-input"
                            id="food_processing_activity"
                            name="food_processing_activity"
                            type="checkbox"
                        >
                    </div>
                    <label
                        class="form-check-label flex-grow-1"
                        for="food_processing_activity"
                    >
                        Food processing (please specify specific sector)
                    </label>
                    <input
                        class="form-control ml-3"
                        id="food_processing_specific_sector"
                        name="food_processing_specific_sector"
                        type="text"
                        style="max-width: 300px;"
                    >
                </div>

                <div class="d-flex align-items-center mb-2">
                    <div class="form-check mr-3">
                        <input
                            class="form-check-input"
                            id="furniture_activity"
                            name="furniture_activity"
                            type="checkbox"
                        >
                    </div>
                    <label
                        class="form-check-label flex-grow-1"
                        for="furniture"
                    >
                        Furniture (please specify specific sector)
                    </label>
                    <input
                        class="form-control ml-3"
                        id="furniture_specific_sector"
                        name="furniture_specific_sector"
                        type="text"
                        style="max-width: 300px;"
                    >
                </div>

                <div class="d-flex align-items-center mb-2">
                    <div class="form-check mr-3">
                        <input
                            class="form-check-input"
                            id="natural_fibers_activity"
                            name="natural_fibers_activity"
                            type="checkbox"
                        >
                    </div>
                    <label
                        class="form-check-label flex-grow-1"
                        for="natural_fibers_activity"
                    >
                        Natural fibers, gifts and home decors and fashion accessories (please
                        specify specific sector)
                    </label>
                    <input
                        class="form-control ml-3"
                        id="natural_fibers_specific_sector"
                        name="natural_fibers_specific_sector"
                        type="text"
                        style="max-width: 300px;"
                    >
                </div>

                <div class="d-flex align-items-center mb-2">
                    <div class="form-check mr-3">
                        <input
                            class="form-check-input"
                            id="metals_and_engineering_activity"
                            name="metals_and_engineering_activity"
                            type="checkbox"
                        >
                    </div>
                    <label
                        class="form-check-label flex-grow-1"
                        for="metals_and_engineering_activity"
                    >
                        Metals and engineering (please specify specific sector)
                    </label>
                    <input
                        class="form-control ml-3"
                        id="metals_and_engineering_specific_sector"
                        name="metals_and_engineering_specific_sector"
                        type="text"
                        style="max-width: 300px;"
                    >
                </div>

                <div class="d-flex align-items-center mb-2">
                    <div class="form-check mr-3">
                        <input
                            class="form-check-input"
                            id="aquatic_and_marine_activity"
                            name="aquatic_and_marine_activity"
                            type="checkbox"
                        >
                    </div>
                    <label
                        class="form-check-label flex-grow-1"
                        for="aquatic"
                    >
                        Aquatic and marine resources (please specify specific sector)
                    </label>
                    <input
                        class="form-control ml-3"
                        id="aquatic_and_marine_specific_sector"
                        name="aquatic_and_marine_specific_sector"
                        type="text"
                        style="max-width: 300px;"
                    >
                </div>

                <div class="d-flex align-items-center mb-2">
                    <div class="form-check mr-3">
                        <input
                            class="form-check-input"
                            id="horticulture_activity"
                            name="horticulture_activity"
                            type="checkbox"
                        >
                    </div>
                    <label
                        class="form-check-label flex-grow-1"
                        for="horticulture_activity"
                    >
                        Horticulture/Agriculture (please specify specific sector)
                    </label>
                    <input
                        class="form-control ml-3"
                        name="horticulture_specific_sector"
                        type="text"
                        style="max-width: 300px;"
                    >
                </div>

                <div class="d-flex align-items-center">
                    <div class="form-check mr-3">
                        <input
                            class="form-check-input"
                            id="other_activity"
                            name="other_activity"
                            type="checkbox"
                        >
                    </div>
                    <label
                        class="form-check-label flex-grow-1"
                        for="other_activity"
                    >
                        Others, please specify
                    </label>
                    <input
                        class="form-control ml-3"
                        name="other_specific_sector"
                        type="text"
                        style="max-width: 300px;"
                    >
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <label
                        class="form-label"
                        for="specificProductOrService"
                    >
                        1. Specific product or service the enterprise offers its customers:
                    </label>
                    <textarea
                        class="form-control"
                        id="specificProductOrService"
                        name="specificProductOrService"
                        rows="3"
                    ></textarea>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <label
                        class="form-label"
                        for="reasonsWhyAssistanceIsBeingSought"
                    >
                        2. Reasons why assistance is being sought:
                    </label>
                    <textarea
                        class="form-control"
                        id="reasonsWhyAssistanceIsBeingSought"
                        name="reasonsWhyAssistanceIsBeingSought"
                        rows="3"
                    ></textarea>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">
                        3. Have you consulted any other individual/organization on any assistance?
                    </label>
                    <div class="ms-3">
                        <div class="mb-3">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    id="consultationYes"
                                    name="consultationAnswer"
                                    type="radio"
                                    value="yes"
                                >
                                <label
                                    class="form-check-label"
                                    for="consultationYes"
                                >
                                    Yes, from what company/agency
                                </label>
                            </div>
                            <input
                                class="form-control consultation-input"
                                id="fromWhatCompanyAgency"
                                name="fromWhatCompanyAgency"
                                type="text"
                            >
                            <label class="form-label mt-2">Please specify the type of assistance
                                sought</label>
                            <textarea
                                class="form-control consultation-input"
                                id="pleaseSpecifyTheTypeOfAssistanceSought"
                                name="pleaseSpecifyTheTypeOfAssistanceSought"
                                rows="3"
                            ></textarea>
                        </div>
                        <div>
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    id="consultationNo"
                                    name="consultationAnswer"
                                    type="radio"
                                    value="no"
                                >
                                <label
                                    class="form-check-label"
                                    for="consultationNo"
                                >
                                    No, why not?
                                </label>
                            </div>
                            <textarea
                                class="form-control consultation-input"
                                id="whyNot"
                                name="whyNot"
                                rows="3"
                            ></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label
                            class="form-label"
                            for="organizationalStructure"
                        >
                            Please attach Organizational Structure:
                        </label>
                        <input
                            class=""
                            id="organizationalStructure"
                            name="organizationalStructure"
                            type="file"
                            {{ auth()->user()->hasRole('Cooperator') ? 'required' : '' }}
                        >
                        <div class="invalid-feedback">
                            Please upload the Organization Structure.
                        </div>
                        <div class="form-text">Accepted formats: .jpeg, .png. Maximum file size:
                            10MB</div>
                        <input
                            id="OrganizationalStructureFileID_Data_Handler"
                            name="OrganizationalStructureFileID_Data_Handler"
                            type="hidden"
                        >
                    </div>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <label
                        class="form-label"
                        for="enterprisePlanForTheNext5Years"
                    >
                        4. Enterprise plan for the next 5 years:
                    </label>
                    <textarea
                        class="form-control"
                        id="enterprisePlanForTheNext5Years"
                        name="enterprisePlanForTheNext5Years"
                        rows="3"
                    ></textarea>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <label
                        class="form-label ms-2"
                        for="nextTenYears"
                    >
                        Next 10 years?
                    </label>
                    <textarea
                        class="form-control"
                        id="nextTenYears"
                        name="nextTenYears"
                        rows="3"
                    ></textarea>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <label
                        class="form-label"
                        for="currentAgreementAndAlliancesUndertaken"
                    >
                        5. Current agreement and alliances undertaken:
                    </label>
                    <textarea
                        class="form-control"
                        id="currentAgreementAndAlliancesUndertaken"
                        name="currentAgreementAndAlliancesUndertaken"
                        rows="3"
                    ></textarea>
                </div>
            </div>

        </div>
    </div>
    <div class="card p-0">
        <div class="card-header fw-bold">
            BENCHMARK INFORMATION
        </div>
        <div class="card-body">
            <hr>
            <h6 class="my-4">*Product and Supply Chain</h6>
            <hr>
            <div id="productAndSupplyChainContainer">
                <div class="mt-2">
                    <div class="d-flex justify-content-end p-2 addAndRemoveButton_Container">
                        <button
                            class="btn btn-primary addProductAndSupplyChainRow"
                            data-toggle="tooltip"
                            type="button"
                            title="Add a new row"
                        >
                            <i class="ri-add-box-fill"></i>
                        </button>
                        <button
                            class="btn btn-danger removeRowButton mx-2"
                            data-toggle="tooltip"
                            type="button"
                            title="Delete row"
                            disabled
                        >
                            <i class="ri-subtract-fill"></i>
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table
                        class="table table-bordered"
                        id="productAndSupplyChainTable"
                    >
                        <thead>
                            <tr>
                                <th scope="col">Raw Material</th>
                                <th scope="col">Source</th>
                                <th scope="col">Unit Cost (₱)</th>
                                <th scope="col">Volume Used/Year</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input
                                        class="form-control RawMaterial"
                                        type="text"
                                    />
                                </td>
                                <td>
                                    <input
                                        class="form-control Source"
                                        type="text"
                                    />
                                </td>
                                <td>
                                    <input
                                        class="form-control UnitCost"
                                        type="text"
                                    />
                                </td>
                                <td>
                                    <input
                                        class="form-control VolumeUsed"
                                        type="text"
                                    />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <h6 class="my-4">*Production</h6>
            <hr>
            <div id="productionContainer">

                <div class="mt-2">
                    <div class="d-flex justify-content-end p-2 addAndRemoveButton_Container">
                        <button
                            class="btn btn-primary addProductionRow"
                            data-toggle="tooltip"
                            type="button"
                            title="Add a new row"
                        >
                            <i class="ri-add-box-fill"></i>
                        </button>
                        <button
                            class="btn btn-danger removeRowButton mx-2"
                            data-toggle="tooltip"
                            type="button"
                            title="Delete row"
                            disabled
                        >
                            <i class="ri-subtract-fill"></i>
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table
                        class="table table-bordered"
                        id="productionTable"
                    >
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Volume of Production/Year</th>
                                <th scope="col">Unit Cost of Production (₱)</th>
                                <th scope="col">Annual Cost of Production (₱)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input
                                        class="form-control Product"
                                        type="text"
                                    />
                                </td>
                                <td>
                                    <input
                                        class="form-control VolumeProduction"
                                        type="text"
                                    />
                                </td>
                                <td>
                                    <input
                                        class="form-control UnitCost"
                                        type="text"
                                    />
                                </td>
                                <td>
                                    <input
                                        class="form-control AnnualCost"
                                        type="text"
                                    />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <h6 class="my-4">*Production Equipment</h6>
            <hr>
            <div id="productionEquipmentContainer">
                <div class="mt-2">
                    <div class="d-flex justify-content-end p-2 addAndRemoveButton_Container">
                        <button
                            class="btn btn-primary addProductionEquipmentRow"
                            data-toggle="tooltip"
                            type="button"
                            title="Add a new row"
                        >
                            <i class="ri-add-box-fill"></i>
                        </button>
                        <button
                            class="btn btn-danger removeRowButton mx-2"
                            data-toggle="tooltip"
                            type="button"
                            title="Delete row"
                            disabled
                        >
                            <i class="ri-subtract-fill"></i>
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table
                        class="table table-bordered"
                        id="productionEquipmentTable"
                    >
                        <thead>
                            <tr>
                                <th scope="col">Type of Equipment</th>
                                <th scope="col">Specification</th>
                                <th scope="col">Capacity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input
                                        class="form-control TypeOfEquipment"
                                        type="text"
                                    />
                                </td>
                                <td>
                                    <input
                                        class="form-control Specification"
                                        type="text"
                                    />
                                </td>
                                <td>
                                    <input
                                        class="form-control Capacity"
                                        type="text"
                                    />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row gy-3">
                <div class="col-12">
                    <label
                        class="form-label"
                        for="ProductionProblemAndConcern"
                    >-Production Problem and Concern</label>
                    <textarea
                        class="form-control"
                        id="ProductionProblemAndConcern"
                        name="ProductionProblemAndConcern"
                        rows="3"
                    ></textarea>
                </div>
                <div class="col-12">
                    <label
                        class="form-label"
                        for="ProductionWasteManageSystem"
                    >-Production Waste Management System</label>
                    <textarea
                        class="form-control"
                        id="ProductionWasteManageSystem"
                        name="ProductionWasteManageSystem"
                        rows="3"
                    ></textarea>
                </div>
                <div class="col-12">
                    <label
                        class="form-label"
                        for="ProductionPlan"
                    >-Production Plan</label>
                    <textarea
                        class="form-control"
                        id="ProductionPlan"
                        name="ProductionPlan"
                        rows="3"
                    ></textarea>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label
                            class="form-label"
                            for="PlanLayout"
                        >-Plan Lay-out</label>
                        <input
                            id="planLayout"
                            name="planLayout"
                            type="file"
                            {{ auth()->user()->hasRole('Cooperator') ? 'required' : '' }}
                        >
                        <div class="invalid-feedback">
                            Please upload the Plan Lay-out.
                        </div>
                        <div class="form-text">Accepted formats: .jpeg, .png. Maximum file size:
                            10MB</div>
                        <input
                            id="PlanLayoutFileID_Data_Handler"
                            name="PlanLayoutFileID_Data_Handler"
                            type="hidden"
                        >
                    </div>
                    <div class="mb-3">
                        <label
                            class="form-label"
                            for="processFlow"
                        >-Process Flow</label>
                        <input
                            id="processFlow"
                            name="processFlow"
                            type="file"
                            {{ auth()->user()->hasRole('Cooperator') ? 'required' : '' }}
                        >
                        <div class="invalid-feedback">
                            Please upload the Process Flow.
                        </div>
                        <div class="form-text">Accepted formats: .jpeg, .png. Maximum file size:
                            10MB</div>
                        <input
                            id="ProcessFlowFileID_Data_Handler"
                            name="ProcessFlowFileID_Data_Handler"
                            type="hidden"
                        >
                    </div>
                </div>
                <div class="col-12">
                    <label
                        class="form-label"
                        for="InventorySystem"
                    >-Inventory System</label>
                    <textarea
                        class="form-control"
                        id="InventorySystem"
                        name="InventorySystem"
                        rows="3"
                    ></textarea>
                </div>
                <div class="col-12">
                    <label
                        class="form-label"
                        for="MaintenanceProgram"
                    >-Maintenance Program</label>
                    <textarea
                        class="form-control"
                        id="MaintenanceProgram"
                        name="MaintenanceProgram"
                        rows="3"
                    ></textarea>
                </div>
                <div class="col-12">
                    <label
                        class="form-label"
                        for="cGMPHACCPActivities"
                    >-cGMP/HACCP Activities</label>
                    <textarea
                        class="form-control"
                        id="cGMPHACCPActivities"
                        name="cGMPHACCPActivities"
                        rows="3"
                    ></textarea>
                </div>
                <div class="col-12">
                    <label
                        class="form-label"
                        for="SuppliesPurchasingSystem"
                    >-Supplies/Purchasing System</label>
                    <textarea
                        class="form-control"
                        id="SuppliesPurchasingSystem"
                        name="SuppliesPurchasingSystem"
                        rows="3"
                    ></textarea>
                </div>
            </div>
            <hr>
            <h6 class="my-4">*Marketing</h6>
            <hr>
            <div class="row gy-3">
                <div class="col-12">
                    <label
                        class="form-label"
                        for="MarketingPlan"
                    >-Marketing Plan</label>
                    <textarea
                        class="form-control"
                        id="MarketingPlan"
                        name="MarketingPlan"
                        rows="3"
                    ></textarea>
                </div>
                <div class="col-12">
                    <label
                        class="form-label"
                        for="MarketOutletsAndNumber"
                    >-Market Outlets and Number</label>
                    <textarea
                        class="form-control"
                        id="MarketOutletsAndNumber"
                        name="MarketOutletsAndNumber"
                        rows="3"
                    ></textarea>
                </div>
                <div class="col-12">
                    <label
                        class="form-label"
                        for="PromotionalStrategies"
                    >-Promotional Strategies</label>
                    <textarea
                        class="form-control"
                        id="PromotionalStrategies"
                        name="PromotionalStrategies"
                        rows="3"
                    ></textarea>
                </div>
                <div class="col-12">
                    <label
                        class="form-label"
                        for="MarketCompetitors"
                    >-Market Competitors</label>
                    <textarea
                        class="form-control"
                        id="MarketCompetitors"
                        name="MarketCompetitors"
                        rows="3"
                    ></textarea>
                </div>
                <h6>-Packaging</h6>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="form-check mb-2">
                                <input
                                    class="form-check-input"
                                    id="nutritionEvaluation"
                                    name="nutritionEvaluation"
                                    type="checkbox"
                                >
                                <label
                                    class="form-check-label"
                                    for="nutritionEvaluation"
                                >
                                    Nutrition Evaluation
                                </label>
                            </div>
                            <input
                                class="form-control mt-2 ms-2"
                                id="nutritionEvaluationDetails"
                                name="nutritionEvaluationDetails"
                                type="text"
                            >
                        </div>
                        <div class="form-group">
                            <div class="form-check mb-2">
                                <input
                                    class="form-check-input"
                                    id="barCode"
                                    name="barCode"
                                    type="checkbox"
                                >
                                <label
                                    class="form-check-label"
                                    for="barCode"
                                >
                                    Bar Code
                                </label>
                            </div>
                            <input
                                class="form-control mt-2 ms-2"
                                id="barCodeDetails"
                                name="barCodeDetails"
                                type="text"
                            >
                        </div>

                        <div class="form-group">
                            <div class="form-check mb-2">
                                <input
                                    class="form-check-input"
                                    id="productLabel"
                                    name="productLabel"
                                    type="checkbox"
                                >
                                <label
                                    class="form-check-label"
                                    for="productLabel"
                                >
                                    Product Label
                                </label>
                            </div>
                            <input
                                class="form-control mt-2 ms-2"
                                id="productLabelDetails"
                                name="productLabelDetails"
                                type="text"
                            >
                        </div>

                        <div class="form-group">
                            <div class="form-check mb-2">
                                <input
                                    class="form-check-input"
                                    id="expiryDate"
                                    name="expiryDate"
                                    type="checkbox"
                                >
                                <label
                                    class="form-check-label"
                                    for="expiryDate"
                                >
                                    Expiry Date
                                </label>
                            </div>
                            <input
                                class="form-control mt-2 ms-2"
                                id="expiryDateDetails"
                                name="expiryDateDetails"
                                type="text"
                            >
                        </div>
                    </div>
                </div>

            </div>
            <hr>
            <h6 class="my-4">Finance</h6>
            <hr>
            <div class="row gy-3">
                <div class="col-12">
                    <label
                        class="form-label"
                        for="CashFlowAndRelatedDocuments"
                    >
                        Cash Flow or other related documents:
                    </label>
                    <textarea
                        class="form-control"
                        id="CashFlowAndRelatedDocuments"
                        name="CashFlowAndRelatedDocuments"
                        rows="3"
                    ></textarea>
                </div>
                <div class="col-12">
                    <label
                        class="form-label"
                        for="SourceOfCapitalCredit"
                    >
                        Source(s) of capital/credit:
                    </label>
                    <textarea
                        class="form-control"
                        id="SourceOfCapitalCredit"
                        name="SourceOfCapitalCredit"
                        rows="3"
                    ></textarea>
                </div>
                <div class="col-12">
                    <label
                        class="form-label"
                        for="AccountingSystem"
                    >
                        Accounting System:
                    </label>
                    <textarea
                        class="form-control"
                        id="AccountingSystem"
                        name="AccountingSystem"
                        rows="3"
                    ></textarea>
                </div>

            </div>
            <hr>
            <h6 class="my-4">Human Resources</h6>
            <hr>
            <div class="row gy-3">
                <div class="col-12">
                    <label
                        class="form-label"
                        for="HiringAndCriteria"
                    >
                        Hiring and Criteria:
                    </label>
                    <textarea
                        class="form-control"
                        id="HiringAndCriteria"
                        name="HiringAndCriteria"
                        rows="3"
                    ></textarea>
                </div>
                <div class="col-12">
                    <label
                        class="form-label"
                        for="IncentivesToEmployees"
                    >
                        Incentives to Employees:
                    </label>
                    <textarea
                        class="form-control"
                        id="IncentivesToEmployees"
                        name="IncentivesToEmployees"
                        rows="3"
                    ></textarea>
                </div>
                <div class="col-12">
                    <label
                        class="form-label"
                        for="TrainingAndDevelopment"
                    >
                        Training and Development:
                    </label>
                    <textarea
                        class="form-control"
                        id="TrainingAndDevelopment"
                        name="TrainingAndDevelopment"
                        rows="3"
                    ></textarea>
                </div>
                <div class="col-12">
                    <label
                        class="form-label"
                        for="SafetyMeasuresPracticed"
                    >
                        Safety Measures Practiced:
                    </label>
                    <textarea
                        class="form-control"
                        id="SafetyMeasuresPracticed"
                        name="SafetyMeasuresPracticed"
                        rows="3"
                    ></textarea>
                </div>
                <div class="col-12">
                    <label
                        class="form-label"
                        for="OtherEmployeeWelfare"
                    >
                        Other Employee Welfare:
                    </label>
                    <textarea
                        class="form-control"
                        id="OtherEmployeeWelfare"
                        name="OtherEmployeeWelfare"
                        rows="3"
                    ></textarea>
                </div>
            </div>
            <hr>
            <h6 class="my-4">Other Concerns</h6>
            <hr>
            <div class="row gy-3">
                <div class="col-12">
                    <label
                        class="form-label"
                        for="OtherConcerns"
                    >
                        Other Concerns:
                    </label>
                    <textarea
                        class="form-control"
                        id="OtherConcerns"
                        name="OtherConcerns"
                        rows="3"
                    ></textarea>
                </div>
            </div>

        </div>
    </div>
    <div
        class="row p-0 mt-0 g-3"
        id="personnelContainer"
    >
        <div class="col-12 p-0">
            <div class="card">
                <div class="card-header fw-bold">
                    Number of Personnel Direct(Production):
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12 col-md-8">
                            <div
                                class="alert alert-primary"
                                role="alert"
                            >
                                <h5 class="alert-heading"> <i class="ri-information-2-fill"></i>
                                    Direct Personnel
                                </h5>
                                <p>Direct personnel are those who are actively involved in the
                                    production process of the products, an example are
                                    operators, assemblers, and quality control inspectors.</p>
                                <hr>
                                <p class="mb-0 text-secondary text-small">You may enter zero if
                                    none
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header">
                                            Regular
                                        </div>
                                        <div class="card-body">
                                            <div class="col-12">
                                                <label
                                                    class="form-label"
                                                    for="m_personelDiRe"
                                                >Male:
                                                </label>
                                                <input
                                                    class="form-control num_only"
                                                    id="m_personnelDiRe"
                                                    name="m_personnelDiRe"
                                                    type="text"
                                                    value="{{ old('m_personnelDiRe') }}"
                                                    placeholder="No. Male Regular"
                                                >

                                            </div>
                                            <div class="col-12">
                                                <label
                                                    class="form-label"
                                                    for="f_personnelDiRe"
                                                >Female:
                                                </label>
                                                <input
                                                    class="form-control num_only"
                                                    id="f_personnelDiRe"
                                                    name="f_personnelDiRe"
                                                    type="text"
                                                    value="{{ old('f_personnelDiRe') }}"
                                                    placeholder="No. Female Regular"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header">
                                            Part-time
                                        </div>
                                        <div class="card-body">
                                            <div class="col-12">
                                                <label
                                                    class="form-label"
                                                    for="m_personnelDiPart"
                                                >Male:
                                                </label>
                                                <input
                                                    class="form-control num_only"
                                                    id="m_personnelDiPart"
                                                    name="m_personnelDiPart"
                                                    type="text"
                                                    value="{{ old('m_personnelDiPart') }}"
                                                    placeholder="No. Male Part-time"
                                                >
                                            </div>
                                            <div class="col-12">
                                                <label
                                                    class="form-label"
                                                    for="f_personnelDiPart"
                                                >Female:
                                                </label>
                                                <input
                                                    class="form-control num_only"
                                                    id="f_personnelDiPart"
                                                    name="f_personnelDiPart"
                                                    type="text"
                                                    value="{{ old('f_personnelDiPart') }}"
                                                    placeholder="Number of Female Part-time"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 p-0">
            <div class="card p-0">
                <div class="card-header fw-bold">
                    Number of Personnel Indirect(Admin and Marketing):
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12 col-md-8">
                            <div
                                class="alert alert-primary"
                                role="alert"
                            >
                                <h5 class="alert-heading"> <i class="ri-information-2-fill"></i>
                                    Indirect Personnel
                                </h5>
                                <p>Indirect personnel are those who are not actively involved in
                                    the production process of the products, such as
                                    administrative staff, managers, and maintenance workers.</p>
                                <hr>
                                <p class="mb-0 text-secondary text-small">You may enter zero if
                                    none</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header">
                                            Regular
                                        </div>
                                        <div class="card-body">
                                            <div class="col-12">
                                                <label
                                                    class="form-label"
                                                    for="m_personnelIndRe"
                                                >Male:
                                                </label>
                                                <input
                                                    class="form-control num_only"
                                                    id="m_personnelIndRe"
                                                    name="m_personnelIndRe"
                                                    type="text"
                                                    value="{{ old('m_personnelIndRe') }}"
                                                    placeholder="No. Male Regular"
                                                >

                                            </div>
                                            <div class="col-12">
                                                <label
                                                    class="form-label"
                                                    for="f_personnelIndRe"
                                                >Female:
                                                </label>
                                                <input
                                                    class="form-control num_only"
                                                    id="f_personnelIndRe"
                                                    name="f_personnelIndRe"
                                                    type="text"
                                                    value="{{ old('f_personnelIndRe') }}"
                                                    placeholder="No. Female Regular"
                                                >

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header">
                                            Part-time
                                        </div>
                                        <div class="card-body">
                                            <div class="col-12">
                                                <label
                                                    class="form-label"
                                                    for="m_personnelIndPart"
                                                >Male</label>
                                                <input
                                                    class="form-control num_only"
                                                    id="m_personnelIndPart"
                                                    name="m_personnelIndPart"
                                                    type="text"
                                                    value="{{ old('m_personnelIndPart') }}"
                                                    placeholder="No. Male Part-time"
                                                >

                                            </div>
                                            <div class="col-12">
                                                <label
                                                    class="form-label"
                                                    for="f_personnelIndPart"
                                                >Female</label>
                                                <input
                                                    class="form-control num_only"
                                                    id="f_personnelIndPart"
                                                    name="f_personnelIndPart"
                                                    type="text"
                                                    value="{{ old('f_personnelIndPart') }}"
                                                    placeholder="Number of Female Part-time"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mb-3 p-0">
        <div class="card">
            <div class="card-header fw-bold">
                Market Outlet
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div
                            class="alert alert-primary"
                            role="alert"
                        >
                            <i class="ri-information-2-fill ri-lg"></i>
                            Please input the Products name for the Export and Local Market
                        </div>
                    </div>
                    <div
                        class="col-12 mb-4"
                        id="localMarketContainer"
                    >
                        <h5>Local Market Products</h5>
                        <div class="mt-2">
                            <div class="d-flex justify-content-end p-2 addAndRemoveButton_Container">
                                <button
                                    class="btn btn-primary addNewProductRow"
                                    data-toggle="tooltip"
                                    type="button"
                                    title="Add a new row"
                                >
                                    <i class="ri-add-box-fill"></i>
                                </button>
                                <button
                                    class="btn btn-danger removeRowButton mx-2"
                                    data-toggle="tooltip"
                                    type="button"
                                    title="Delete row"
                                    disabled
                                >
                                    <i class="ri-subtract-fill"></i>
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table
                                class="table table-bordered"
                                id="localMarketTable"
                            >
                                <thead>
                                    <tr>
                                        <th>Enterprise Location</th>
                                        <th>Sell Product</th>
                                        <th>Volume</th>
                                        <th>Unit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input
                                                class="form-control location"
                                                type="text"
                                                placeholder="Enter location"
                                            ></td>
                                        <td><input
                                                class="form-control product"
                                                type="text"
                                                placeholder="Enter product"
                                            ></td>
                                        <td><input
                                                class="form-control volume"
                                                type="number"
                                                placeholder="Enter volume"
                                            ></td>
                                        <td>
                                            <select class="form-select unit">
                                                <option value="kg">Kilogram (kg)</option>
                                                <option value="g">Gram (g)</option>
                                                <option value="l">Liter (L)</option>
                                                <option value="ml">Milliliter (ml)</option>
                                                <option value="pcs">Pieces (pcs)</option>
                                                <option value="dozen">Dozen</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div
                        class="col-12"
                        id="exportMarketContainer"
                    >
                        <h5>Export Market Products</h5>
                        <div class="mt-2">
                            <div class="d-flex justify-content-end p-2 addAndRemoveButton_Container">
                                <button
                                    class="btn btn-primary addNewProductRow"
                                    data-toggle="tooltip"
                                    type="button"
                                    title="Add a new row"
                                >
                                    <i class="ri-add-box-fill"></i>
                                </button>
                                <button
                                    class="btn btn-danger removeRowButton mx-2"
                                    data-toggle="tooltip"
                                    type="button"
                                    title="Delete row"
                                    disabled
                                >
                                    <i class="ri-subtract-fill"></i>
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table
                                class="table table-bordered"
                                id="exportMarketTable"
                            >
                                <thead>
                                    <tr>
                                        <th>Enterprise Location</th>
                                        <th>Sell Product</th>
                                        <th>Volume</th>
                                        <th>Unit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input
                                                class="form-control location"
                                                type="text"
                                                placeholder="Enter location"
                                            ></td>
                                        <td><input
                                                class="form-control product"
                                                type="text"
                                                placeholder="Enter product"
                                            ></td>
                                        <td><input
                                                class="form-control volume"
                                                type="number"
                                                placeholder="Enter volume"
                                            ></td>
                                        <td>
                                            <select class="form-select unit">
                                                <option value="kg">Kilogram (kg)</option>
                                                <option value="g">Gram (g)</option>
                                                <option value="l">Liter (L)</option>
                                                <option value="ml">Milliliter (ml)</option>
                                                <option value="pcs">Pieces (pcs)</option>
                                                <option value="dozen">Dozen</option>
                                            </select>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
