@if (!auth()->user()->isStaff)
    <div class="row mb-3">
        <div class="col-md-12 mb-4">
            <h5>Review and confirm the details provided before submission.</h5>
        </div>
        <div
            class="row gy-3"
            id="reviewInputsContainer"
        >
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Personal Infomation
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-6">
                                <label
                                    class="form-label"
                                    for="re_full_name"
                                >Full Name</label>
                                <input
                                    class="form-control mb-3"
                                    id="re_Full_name"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-4">
                                <label
                                    class="form-label"
                                    for="designa"
                                >Designation</label>
                                <input
                                    class="form-control mb-3"
                                    id="re_designa"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-2">
                                <label
                                    class="form-label"
                                    for="b_Date"
                                >Birth Date</label>
                                <input
                                    class="form-control mb-3"
                                    id="re_b_Date"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-4">
                                <label
                                    class="form-label"
                                    for="Mobile_no"
                                >Mobile Number</label>
                                <input
                                    class="form-control mb-3"
                                    id="re_Mobile_no"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-4">
                                <label
                                    class="form-label"
                                    for="landline"
                                >Landline</label>
                                <input
                                    class="form-control mb-3"
                                    id="re_landline"
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
                        Business Information
                    </div>
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-12 col-md-8">
                                <label
                                    class="form-label"
                                    for="firm_name"
                                >Firm Name</label>
                                <input
                                    class="form-control mb-3"
                                    id="re_firm_name"
                                    type="text"
                                    readonly
                                >

                            </div>
                            <div class="col-12 col-md-4">
                                <label
                                    class="form-label"
                                    for="type_enterprise"
                                >Type of Enterprise</label>
                                <input
                                    class="form-control mb-3"
                                    id="re_type_enterprise"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-12">
                                <label
                                    class="form-label"
                                    for="briefBackground"
                                >Brief Enterprise Background: <span class="requiredFields">
                                        *</span></label>
                                <textarea
                                    class="form-control"
                                    id="re_brief_background"
                                    name="brief_background"
                                    rows="3"
                                    readonly
                                ></textarea>
                                <div class="invalid-feedback">
                                    Please enter the brief enterprise background.
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label
                                    class="form-label"
                                    for="re_business_permit_No"
                                >Business Permit No.: <span class="requiredFields">
                                        *</span></label>
                                <input
                                    class="form-control"
                                    id="re_business_permit_No"
                                    type="text"
                                    readonly
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
                                    id="re_yearRegistered"
                                    name="yearRegistered"
                                    type="text"
                                    readonly
                                >
                                <div class="invalid-feedback">
                                    Please enter the year registered.
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label
                                    class="form-label"
                                    for="enterpriseRegistrationNo"
                                >Enterprise Registration No.:
                                    <span class="requiredFields">
                                        *</span></label>
                                <input
                                    class="form-control"
                                    id="re_enterpriseRegistrationNo"
                                    name="enterpriseRegistrationNo"
                                    type="text"
                                    value="{{ old('enterpriseRegistrationNo') }}"
                                    readonly
                                >
                                <div class="invalid-feedback">
                                    Please enter the enterprise registration no.
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label
                                    class="form-label"
                                    for="yearEnterpriseRegistered"
                                >Year Enterprise Registered:
                                    <span class="requiredFields">
                                        *</span></label>
                                <input
                                    class="form-control"
                                    id="re_yearEnterpriseRegistered"
                                    name="yearEnterpriseRegistered"
                                    type="text"
                                    readonly
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
                                <input
                                    class="form-control"
                                    id="re_initial_capitalization"
                                    name="initial_capitalization"
                                    type="text"
                                    value="{{ old('initialCapitalization') }}"
                                    readonly
                                >
                                <div class="invalid-feedback">
                                    Please enter the initial capitalization.
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label
                                    class="form-label"
                                    for="re_present_capitalization"
                                >Present Capitalization: <span class="requiredFields">
                                        *</span></label>
                                <input
                                    class="form-control"
                                    id="re_present_capitalization"
                                    name="present_capitalization"
                                    type="text"
                                    readonly
                                >
                                <div class="invalid-feedback">
                                    Please enter the present capitalization.
                                </div>
                            </div>
                            <div class="col-12">
                                <label
                                    class="form-label"
                                    for="Address"
                                >Office Address</label>
                                <input
                                    class="form-control mb-3"
                                    id="re_OfficeAddress"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-4">
                                <label
                                    class="form-label"
                                    for="officeTelNo"
                                >Telephone No:</label>
                                <input
                                    class="form-control mb-3"
                                    id="re_officeTelNo"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-4">
                                <label
                                    class="form-label"
                                    for="officeFaxNo"
                                >Fax No:</label>
                                <input
                                    class="form-control mb-3"
                                    id="re_officeFaxNo"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-4">
                                <label
                                    class="form-label"
                                    for="officeEmailAddress"
                                >Email Address:</label>
                                <input
                                    class="form-control mb-3"
                                    id="re_officeEmailAddress"
                                    type="email"
                                    readonly
                                >
                            </div>
                            <div class="col-12">
                                <label
                                    class="form-label"
                                    for="factoryAddress"
                                >Factory Address</label>
                                <input
                                    class="form-control mb-3"
                                    id="re_factoryAddress"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-4">
                                <label
                                    class="form-label"
                                    for="factoryTelNo"
                                >Telephone No:</label>
                                <input
                                    class="form-control mb-3"
                                    id="re_factoryTelNo"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-4">
                                <label
                                    class="form-label"
                                    for="factoryFaxNo"
                                >Fax No:</label>
                                <input
                                    class="form-control mb-3"
                                    id="re_factoryFaxNo"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-4">
                                <label
                                    class="form-label"
                                    for="factoryEmailAddress"
                                >Email Address:</label>
                                <input
                                    class="form-control mb-3"
                                    id="re_factoryEmailAddress"
                                    type="email"
                                    readonly
                                >
                            </div>
                            <div class="card my-3">
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
                                                    id="re_foodProcessing"
                                                    type="checkbox"
                                                    readonly
                                                >
                                            </div>
                                            <label
                                                class="form-check-label flex-grow-1"
                                                for="re_foodProcessing"
                                            >
                                                Food processing (please specify specific sector)
                                            </label>
                                            <input
                                                class="form-control ml-3"
                                                id="re_foodProcessingSpecificSector"
                                                type="text"
                                                style="max-width: 300px;"
                                                readonly
                                            >
                                        </div>

                                        <div class="d-flex align-items-center mb-2">
                                            <div class="form-check mr-3">
                                                <input
                                                    class="form-check-input"
                                                    id="re_furniture"
                                                    type="checkbox"
                                                    readonly
                                                >
                                            </div>
                                            <label
                                                class="form-check-label flex-grow-1"
                                                for="re_furniture"
                                            >
                                                Furniture (please specify specific sector)
                                            </label>
                                            <input
                                                class="form-control ml-3"
                                                id="re_furnitureSpecificSector"
                                                type="text"
                                                style="max-width: 300px;"
                                                readonly
                                            >
                                        </div>

                                        <div class="d-flex align-items-center mb-2">
                                            <div class="form-check mr-3">
                                                <input
                                                    class="form-check-input"
                                                    id="re_naturalFibers"
                                                    type="checkbox"
                                                    readonly
                                                >
                                            </div>
                                            <label
                                                class="form-check-label flex-grow-1"
                                                for="re_naturalFibers"
                                            >
                                                Natural fibers, gifts and home decors and fashion
                                                accessories (please specify specific sector)
                                            </label>
                                            <input
                                                class="form-control ml-3"
                                                id="re_naturalFibersSpecificSector"
                                                type="text"
                                                style="max-width: 300px;"
                                                readonly
                                            >
                                        </div>

                                        <div class="d-flex align-items-center mb-2">
                                            <div class="form-check mr-3">
                                                <input
                                                    class="form-check-input"
                                                    id="re_metals"
                                                    type="checkbox"
                                                    readonly
                                                >
                                            </div>
                                            <label
                                                class="form-check-label flex-grow-1"
                                                for="re_metals"
                                            >
                                                Metals and engineering (please specify specific
                                                sector)
                                            </label>
                                            <input
                                                class="form-control ml-3"
                                                id="re_metalsSpecificSector"
                                                type="text"
                                                style="max-width: 300px;"
                                                readonly
                                            >
                                        </div>

                                        <div class="d-flex align-items-center mb-2">
                                            <div class="form-check mr-3">
                                                <input
                                                    class="form-check-input"
                                                    id="re_aquatic"
                                                    type="checkbox"
                                                    readonly
                                                >
                                            </div>
                                            <label
                                                class="form-check-label flex-grow-1"
                                                for="re_aquatic"
                                            >
                                                Aquatic and marine resources (please specify
                                                specific
                                                sector)
                                            </label>
                                            <input
                                                class="form-control ml-3"
                                                id="re_aquaticSpecificSector"
                                                type="text"
                                                style="max-width: 300px;"
                                                readonly
                                            >
                                        </div>

                                        <div class="d-flex align-items-center mb-2">
                                            <div class="form-check mr-3">
                                                <input
                                                    class="form-check-input"
                                                    id="re_horticulture"
                                                    type="checkbox"
                                                    readonly
                                                >
                                            </div>
                                            <label
                                                class="form-check-label flex-grow-1"
                                                for="re_horticulture"
                                            >
                                                Horticulture/Agriculture (please specify specific
                                                sector)
                                            </label>
                                            <input
                                                class="form-control ml-3"
                                                id="re_horticultureSpecificSector"
                                                type="text"
                                                style="max-width: 300px;"
                                                readonly
                                            >
                                        </div>

                                        <div class="d-flex align-items-center">
                                            <div class="form-check mr-3">
                                                <input
                                                    class="form-check-input"
                                                    id="re_others"
                                                    type="checkbox"
                                                    readonly
                                                >
                                            </div>
                                            <label
                                                class="form-check-label flex-grow-1"
                                                for="re_others"
                                            >
                                                Others, please specify
                                            </label>
                                            <input
                                                class="form-control ml-3"
                                                id="re_othersSpecificSector"
                                                type="text"
                                                style="max-width: 300px;"
                                                readonly
                                            >
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label
                                                class="form-label"
                                                for="re_specificProductOrService"
                                            >
                                                Specific product or service the enterprise offers
                                                its
                                                customers:
                                            </label>
                                            <textarea
                                                class="form-control"
                                                id="re_specificProductOrService"
                                                name="specificProductOrService"
                                                rows="3"
                                                readonly
                                            ></textarea>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label
                                                class="form-label"
                                                for="re_reasonsWhyAssistanceIsBeingSought"
                                            >
                                                Reasons why assistance is being sought:
                                            </label>
                                            <textarea
                                                class="form-control"
                                                id="re_reasonsWhyAssistanceIsBeingSought"
                                                name="reasonsWhyAssistanceIsBeingSought"
                                                rows="3"
                                                readonly
                                            ></textarea>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label">
                                                3. Have you consulted any other
                                                individual/organization
                                                on any assistance?
                                            </label>
                                            <div class="ms-3">
                                                <div class="form-check mb-2">
                                                    <input
                                                        class="form-check-input"
                                                        id="re_consultationYes"
                                                        name="consultationAnswer"
                                                        type="radio"
                                                        value="yes"
                                                        readonly
                                                    >
                                                    <label
                                                        class="form-check-label"
                                                        for="re_consultationYes"
                                                    >
                                                        Yes, from what company/agency
                                                    </label>
                                                    <div
                                                        class="ms-4 mt-2"
                                                        id="re_yesConsultationDetails"
                                                    >
                                                        <input
                                                            class="form-control mb-3"
                                                            id="re_fromWhatCompanyAgency"
                                                            name="fromWhatCompanyAgency"
                                                            type="text"
                                                            readonly
                                                        >
                                                        <label class="form-label">Please specify
                                                            the
                                                            type of assistance sought</label>
                                                        <textarea
                                                            class="form-control"
                                                            id="re_pleaseSpecifyTheTypeOfAssistanceSought"
                                                            name="pleaseSpecifyTheTypeOfAssistanceSought"
                                                            rows="3"
                                                            readonly
                                                        ></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        id="re_consultationNo"
                                                        name="consultationAnswer"
                                                        type="radio"
                                                        value="no"
                                                        readonly
                                                    >
                                                    <label
                                                        class="form-check-label"
                                                        for="re_consultationNo"
                                                    >
                                                        No, why not?
                                                    </label>
                                                    <div
                                                        class="ms-4 mt-2"
                                                        id="re_noConsultationDetails"
                                                    >
                                                        <textarea
                                                            class="form-control"
                                                            id="re_whyNot"
                                                            name="whyNot"
                                                            rows="3"
                                                            readonly
                                                        ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label
                                                class="form-label"
                                                for="re_enterprisePlanForTheNext5Years"
                                            >
                                                4. Enterprise plan for the next 5 years:
                                            </label>
                                            <textarea
                                                class="form-control"
                                                id="re_enterprisePlanForTheNext5Years"
                                                rows="3"
                                                readonly
                                            ></textarea>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label
                                                class="form-label ms-2"
                                                for="re_nextTenYears"
                                            >
                                                Next 10 years?
                                            </label>
                                            <textarea
                                                class="form-control"
                                                id="re_nextTenYears"
                                                rows="3"
                                                readonly
                                            ></textarea>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label
                                                class="form-label"
                                                for="re_currentAgreementAndAlliancesUndertaken"
                                            >
                                                5. Current agreement and alliances undertaken:
                                            </label>
                                            <textarea
                                                class="form-control"
                                                id="re_currentAgreementAndAlliancesUndertaken"
                                                rows="3"
                                                readonly
                                            ></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 my-3">
                                <div class="card">
                                    <div class="card-header">
                                        Assets
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <label
                                                    class="form-label"
                                                    for="buildings"
                                                >Buildings</label>
                                                <input
                                                    class="form-control mb-3"
                                                    id="re_buildings"
                                                    type="text"
                                                    readonly
                                                >
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label
                                                    class="form-label"
                                                    for="equipments"
                                                >Equipments</label>
                                                <input
                                                    class="form-control mb-3"
                                                    id="re_equipments"
                                                    type="text"
                                                    readonly
                                                >
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="working_capital">Working
                                                    Capital</label>
                                                <input
                                                    class="form-control mb-3"
                                                    id="re_working_capital"
                                                    type="text"
                                                    readonly
                                                >
                                            </div>
                                            <div class="row text-center">
                                                <div class="col-12 col-md-6">
                                                    <p>Total Assets: <span id="re_to_Assets"></span>
                                                    </p>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <p>Enterprise Level: <span id="re_Enterprise_Level"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <div class="card">
                                            <div class="card-header">
                                                Number of Personnel Direct(Production):
                                            </div>
                                            <div class="card-body">
                                                <div class="card">
                                                    <div class="card-header">
                                                        Regular
                                                    </div>
                                                    <div class="card-body">

                                                        <div class="col-12">
                                                            <label
                                                                class="form-label"
                                                                for="re_m_personnelDiRe"
                                                            >Male</label>
                                                            <div class="mb-3">
                                                                <input
                                                                    class="form-control"
                                                                    id="re_m_personnelDiRe"
                                                                    name="re_m_personnelDiRe"
                                                                    type="text"
                                                                    readonly
                                                                >
                                                            </div>

                                                        </div>
                                                        <div class="col-12">
                                                            <label
                                                                class="form-label"
                                                                for="re_f_personnelDiRe"
                                                            >Female</label>
                                                            <div class="mb-3">
                                                                <input
                                                                    class="form-control"
                                                                    id="re_f_personnelDiRe"
                                                                    name="re_f_personnelDiRe"
                                                                    type="text"
                                                                    readonly
                                                                >
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="card my-3">
                                                    <div class="card-header">
                                                        Part-time
                                                    </div>
                                                    <div class="card-body">

                                                        <div class="col-12">
                                                            <label
                                                                class="form-label"
                                                                for=""
                                                            >Male</label>
                                                            <div class="mb-3">
                                                                <input
                                                                    class="form-control"
                                                                    id="re_m_personnelDiPart"
                                                                    name="re_m_personnelDiPart"
                                                                    type="text"
                                                                    readonly
                                                                >
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <label
                                                                class="form-label"
                                                                for=""
                                                            >Female</label>
                                                            <div class="mb-3">
                                                                <input
                                                                    class="form-control"
                                                                    id="re_f_personnelDiPart"
                                                                    name="re_f_personnelDiPart"
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
                                    <div class="col-12 col-md-3">
                                        <div class="card">
                                            <div class="card-header">
                                                Number of Personnel Indirect(Admin and Marketing):
                                            </div>
                                            <div class="card-body">
                                                <div class="card">
                                                    <div class="card-header">
                                                        Regular
                                                    </div>
                                                    <div class="card-body">

                                                        <div class="col-12">
                                                            <label
                                                                class="form-label"
                                                                for="re_m_personnelIndRe"
                                                            >Male
                                                            </label>
                                                            <div class="mb-3">
                                                                <input
                                                                    class="form-control"
                                                                    id="re_m_personnelIndRe"
                                                                    name="re_m_personnelIndRe"
                                                                    type="text"
                                                                    readonly
                                                                >
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <label
                                                                class="form-label"
                                                                for="re_f_personnelIndRe"
                                                            >Female</label>
                                                            <div class="mb-3">
                                                                <input
                                                                    class="form-control"
                                                                    id="re_f_personnelIndRe"
                                                                    name="re_f_personnelIndRe"
                                                                    type="text"
                                                                    readonly
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card my-3">
                                                    <div class="card-header">
                                                        Part-time
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="col-12">
                                                            <label
                                                                class="form-label"
                                                                for="re_m_personnelIndPart"
                                                            >Male</label>
                                                            <div class="mb-3">
                                                                <input
                                                                    class="form-control"
                                                                    id="re_m_personnelIndPart"
                                                                    name="re_m_personnelIndPart"
                                                                    type="text"
                                                                    readonly
                                                                >
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <label
                                                                class="form-label"
                                                                for="re_f_personnelIndPart"
                                                            >Female</label>
                                                            <div class="mb-3">
                                                                <input
                                                                    class="form-control"
                                                                    id="re_f_personnelIndPart"
                                                                    name="re_f_personnelIndPart"
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
                                    <div class="col-12 col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                Market Outlet
                                            </div>
                                            <div class="card-body">
                                                <div class="col-12">
                                                    <label
                                                        class="form-label"
                                                        for="Export"
                                                    >Export</label>
                                                    <textarea
                                                        class="form-control mb-3"
                                                        id="re_ExportMar"
                                                        readonly
                                                    ></textarea>
                                                </div>
                                                <div class="col-12">
                                                    <label
                                                        class="form-label"
                                                        for="Local"
                                                    >Local</label>
                                                    <textarea
                                                        class="form-control mb-3"
                                                        id="re_LocalMar"
                                                        readonly
                                                    ></textarea>
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
    </div>
@endif
