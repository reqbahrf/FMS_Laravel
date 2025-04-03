@props(['ownerId', 'draft_type', 'personalInfo'])
<div class="container mt-5 shadow">
    <div id="smartwizard">
        <ul class="nav nav-progress">
            <li class="nav-item">
                <a
                    class="nav-link default active"
                    href="#step-1"
                >
                    <div class="num">1</div>
                    Personal Info
                </a>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link default"
                    href="#step-2"
                >
                    <span class="num">2</span>
                    Business Info
                </a>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link default"
                    href="#step-3"
                >
                    <span class="num">3</span>
                    Requirements
                </a>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link default"
                    href="#step-4"
                >
                    <span class="num">4</span>
                    Confirm Details
                </a>
            </li>
        </ul>
        {{-- Form will be here --}}
        <x-application-form.form
            :ownerId="$ownerId"
            :draft_type="$draft_type"
        >
            <div
                class="tab-content h-auto"
                style="height: auto;"
            >
                <div
                    class="alert alert-primary m-0"
                    role="alert"
                >
                    <i class="ri-information-2-fill ri-lg"></i>
                    Please fill out all the <span class="requiredFields">*</span> required fields
                </div>
                <div
                    class="tab-pane py-5"
                    id="step-1"
                    role="tabpanel"
                    aria-labelledby="step-1"
                    style="position: static; left: 0px; display: block;"
                >
                    <x-application-form.personal-info :$personalInfo />
                </div>
                <div
                    class="tab-pane py-5"
                    id="step-2"
                    role="tabpanel"
                    aria-labelledby="step-2"
                    style="position: static; left: 0px; display: none;"
                >
                    <x-application-form.business-info :withFileInput="true" />
                </div>
                <div
                    class="tab-pane py-5"
                    id="step-3"
                    role="tabpanel"
                    aria-labelledby="step-3"
                    style="position: static; left: 0px; display: none;"
                >
                    <x-application-form.file-requirements />
                </div>
                <div
                    class="tab-pane py-5"
                    id="step-4"
                    role="tabpanel"
                    aria-labelledby="step-4"
                    style="position: static; left: 0px; display: none;"
                >
                    <x-application-form.review-details />
                </div>
            </div>
        </x-application-form.form>
        @if (!auth()->user()->isStaff)
            {{-- Modal Start --}}
            <div
                class="modal fade"
                id="confirmationModal"
                data-bs-backdrop="static"
                role="dialog"
                aria-labelledby="confirmationModalLabel"
                aria-hidden="true"
                tabindex="-1"
            >
                <div
                    class="modal-dialog"
                    role="document"
                >
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5
                                class="modal-title"
                                id="confirmationModalLabel"
                            >Confirmation</h5>
                        </div>
                        <div class="modal-body">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h6>Data Privacy Consent</h6>
                                </div>
                                <div class="card-body">
                                    <p class="paragraph-content">The Department of Science and Technology XI respect
                                        your
                                        privacy and are committed to
                                        protecting
                                        your personal data. This Data Privacy Consent informs you about how we collect,
                                        use,
                                        store, and
                                        disclose your personal data when you use this information system.
                                    </p>
                                    <p class="paragraph-content">
                                        <strong>Information We Collect:</strong> Login credentials: Username, password,
                                        security questions/answers (if
                                        applicable) Personal information: Name, email address, contact number, other
                                        information you
                                        provide during registration or use of the system. Usage data: Log data (e.g.
                                        access
                                        times), system
                                        navigation data, information about your use of features and functionalities
                                    </p>
                                    <p class="paragraph-content">
                                        <strong>How We Use Your Information:</strong> Provide access to the information
                                        system: Verify your identity and
                                        authenticate your login. Manage your account: Process your registration,
                                        maintain
                                        your profile, and
                                        respond to your inquiries. Operate and improve the system: Analyze usage data to
                                        optimize
                                        performance and troubleshoot issues. Communicate with you: Send system updates,
                                        announcements, and support messages.
                                    </p>
                                    <p class="paragraph-content">
                                        <strong>Disclosure of Your Information:</strong> We will not disclose your
                                        personal
                                        data to any third party without
                                        your explicit consent, except as required by law or to comply with legal
                                        process. We
                                        may share
                                        aggregate and anonymized data with third-party service providers for analytics
                                        and
                                        performance
                                        improvement purposes.
                                    </p>
                                    <p class="paragraph-content">
                                        <strong>Your Rights:</strong> You have the right to access, rectify, erase, and
                                        restrict the processing of your personal
                                        data. You have the right to withdraw your consent at any time. You have the
                                        right to
                                        complain to the
                                        relevant data protection authority if you believe your rights have been
                                        violated.
                                    </p>
                                    <p class="paragraph-content">
                                        By logging in to this information system, you acknowledge that you have read and
                                        understood this
                                        Data Privacy Consent and agree to the collection, use, and disclosure of your
                                        personal data as
                                        described herein.
                                    </p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h6>Terms and Conditions</h6>
                                </div>
                                <div class="card-body text-justify">
                                    <p class="paragraph-content">Welcome to DOST-SETUP-SYS. By accessing and using this
                                        website, you agree to comply with and be bound by the following terms and
                                        conditions:
                                    </p>
                                    <p class="paragraph-content">
                                        <strong>Acceptance of Terms:</strong> By using this website, you acknowledge
                                        that
                                        you have read, understood, and agree to be bound by these terms and conditions
                                    </p>
                                    <p>
                                        <strong>Use of the Website:</strong> You agree to use this website only for
                                        lawful
                                        purposes and in a manner that does not infringe the rights of, restrict, or
                                        inhibit
                                        anyone else's use and enjoyment of the website.
                                    </p>
                                    <p class="paragraph-content">
                                        <strong>
                                            User Accounts:
                                        </strong>
                                        If you create an account on this website, you are responsible for maintaining
                                        the
                                        confidentiality of your account information and for all activities that occur
                                        under
                                        your account.
                                    </p>
                                    <p class="paragraph-content">
                                        <strong>Changes to Terms:</strong> We reserve the right to modify these terms
                                        and
                                        conditions at any time. Your continued use of the website after any changes
                                        indicates your acceptance of the new terms.
                                    </p>
                                    <p class="paragraph-content">
                                        <strong>Governing Law:</strong> These terms and conditions are governed by and
                                        construed in accordance with the laws of the Philippines.
                                    </p>

                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            id="detail_confirm"
                                            name="detail_confirm"
                                            type="checkbox"
                                            required
                                        >
                                        <label
                                            class="form-check-label"
                                            for="detail_confirm"
                                        > - I hereby confirm that the
                                            information I provided is true and correct.</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            id="agree_terms"
                                            name="agree_terms"
                                            type="checkbox"
                                            required
                                        >
                                        <label
                                            class="form-check-label"
                                            for="agree_terms"
                                        > - I have read and agree to the
                                            terms and conditions.</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            id="make_available"
                                            name="make_available"
                                            type="checkbox"
                                            required
                                        >
                                        <label
                                            class="form-check-label"
                                            for="make_available"
                                        > - The applicant shall, at the earliest opportunity, make available to the DOST
                                            Regional Office No. <span class="text-decoration-underline">XI</span> (DOST
                                            <span class="text-decoration-underline">XI</span>) all information
                                            (manuals,
                                            procedures, etc.)
                                            required to establish the technology status of the selected core business
                                            functions and management systems;</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            id="satisfied_requirements"
                                            name="satisfied_requirements"
                                            type="checkbox"
                                            required
                                        >
                                        <label
                                            class="form-check-label"
                                            for="satisfied_requirements"
                                        > - If DOST <span class="text-decoration-underline">XI</span> is not satisfied
                                            that
                                            all the requirements for business registration
                                            are complied with, it shall inform the applicant of the observed
                                            deficiencies
                                            before starting the assessment;</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            id="when_inputs_supplied"
                                            name="when_inputs_supplied"
                                            type="checkbox"
                                            required
                                        >
                                        <label
                                            class="form-check-label"
                                            for="when_inputs_supplied"
                                        > - When the required inputs to the assessment are already supplied by the
                                            applicant,
                                            including Attachment A, the DOST <span
                                                class="text-decoration-underline">XI</span>
                                            will assess the firm through the core
                                            business functions and management systems, whichever is applicable, to
                                            identify
                                            technology needs and verify compliance to standards vis-à-vis existing
                                            practices;</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            id="report_prepared"
                                            name="report_prepared"
                                            type="checkbox"
                                            required
                                        >
                                        <label
                                            class="form-check-label"
                                            for="report_prepared"
                                        > - When the DOST <span class="text-decoration-underline">XI</span> has
                                            completed
                                            the
                                            technology assessment, a report will be prepared
                                            on the results of the assessment with accompanying recommendations and
                                            opportunities
                                            for improvement. The report prepared will define the scope of activities,
                                            functions,
                                            management practices and locations assessed. The applicant shall not claim
                                            or
                                            otherwise imply that the report applies to other locations, product or
                                            activities
                                            not
                                            covered by the report;</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            id="report_permission"
                                            name="report_permission"
                                            type="checkbox"
                                            required
                                        >
                                        <label
                                            class="form-check-label"
                                            for="report_permission"
                                        > - The applicant agrees that the report will not be used until permission has
                                            been
                                            granted by the DOST <span class="text-underline">XI</span>;</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            id="receipt_acknowledgment"
                                            name="receipt_acknowledgment"
                                            type="checkbox"
                                            required
                                        >
                                        <label
                                            class="form-check-label"
                                            for="receipt_acknowledgment"
                                        > - The applicant agrees that the receipt or acknowledgment of the report ends
                                            the
                                            assessment stage; any technical assistance ensuing from the recommendations
                                            of
                                            the
                                            report will be viewed as a separate project.</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                class="btn"
                                id="cancelButton"
                                data-bs-dismiss="modal"
                                type="button"
                            >Cancel</button>
                            <button
                                class="btn btn-primary"
                                id="confirmButton"
                                type="button"
                                disabled
                            >Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modal End --}}
        @endif
    </div>
</div>
