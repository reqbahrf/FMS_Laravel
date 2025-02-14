<div class="container pt-5 shadow-sm  border border-2">
    <div id="ApplicationProgress">
        <ul class="nav nav-progress">
            <li class="nav-item">
                <a
                    class="nav-link default active"
                    href="#step-1"
                >
                    <div class="num">1</div>
                    Requirement Verification
                </a>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link default"
                    href="#step-2"
                >
                    <span class="num">2</span>
                    Conduct TNA
                </a>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link default"
                    href="#step-3"
                >
                    <span class="num">3</span>
                    Project Proposal
                </a>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link default"
                    href="#step-4"
                >
                    <span class="num">4</span>
                    RTEC Report
                </a>
            </li>
        </ul>
        <div class="tab-content h-100">
            <div
                class="tab-pane py-5"
                id="step-1"
                role="tabpanel"
                aria-labelledby="step-1"
            >
                <!-- Where Requirement Verification Info Displayed -->
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="fw-bold fs-6 text-white">
                            <i class="ri-file-list-3-fill"></i>
                            Application requirements
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="fw-bold">File Name</th>
                                        <th class="fw-bold">File Type</th>
                                        <th class="fw-bold text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="table-group-divider"
                                    id="requirementsTables"
                                >
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="tab-pane py-5 overflow-auto"
                id="step-2"
                role="tabpanel"
                aria-labelledby="step-2"
            >
                <div class="card h-100">
                    <div class="card-header bg-primary">
                        <div class="fw-bold fs-6 text-white">
                            <i class="ri-file-list-3-fill"></i>
                            TNA
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-end">
                        <button
                            class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#tnaDocContainerModal"
                            type="button"
                            id="viewTNA"
                        >
                            <i class="ri-file-list-3-fill me-1"></i>
                            View TNA document
                        </button>
                    </div>
                </div>
                    <!-- Where Conduct TNA Info Displayed -->
                    <div class="card h-100 mt-3">
                        <div class="card-header bg-primary">
                            <div class="fw-bold fs-6 text-white">
                                <i class="ri-calendar-event-fill"></i>
                                Schedule an Evaluation
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-between h-100">
                                <div class="col-9">
                                    <input
                                        class="form-control"
                                        id="evaluationSchedule-datepicker"
                                        type="datetime-local"
                                        min="{{ date('Y-m-d\TH:i') }}"
                                    >
                                </div>
                                <div class="col-3">
                                    <button
                                        class="btn btn-primary mx-auto"
                                        id="setEvaluationDate"
                                        type="button"
                                    >
                                        SET
                                    </button>
                                </div>
                                <div class="col-12 mb-auto">
                                    <div
                                        class="mt-3"
                                        id="nofi_ScheduleCont"
                                    >

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="col-12 mt-3 d-flex justify-content-end">
                                        <button
                                            class="btn btn-success"
                                            id="acceptEvaluation"
                                            type="button"
                                        >
                                            Accept
                                        </button>
                                        <button
                                            class="btn btn-danger mx-2"
                                            id="rejectEvaluation"
                                            data-bs-target="#tnaEvaluationResultModal"
                                            data-bs-toggle="modal"
                                            type="button"
                                        >
                                            Reject
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="tab-pane py-5"
                    id="step-3"
                    role="tabpanel"
                    aria-labelledby="step-3"
                >
                <div class="card h-100">
                    <div class="card-header bg-primary">
                        <div class="fw-bold fs-6 text-white">
                            <i class="ri-file-list-3-fill"></i>
                            Project Proposal
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-end">
                        <button
                            class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#projectProposalDocContainerModal"
                            type="button"
                            id="viewProjectProposal"
                        >
                            <i class="ri-file-list-3-fill me-1"></i>
                            View Project Proposal document
                        </button>
                    </div>
                </div>
                    <!-- Where Project Proposal Info Displayed -->
                    <div class="card mt-3">
                        <div class="card-header bg-primary">
                            <div class="fw-bold fs-6 text-white">
                                <i class="ri-file-list-3-fill"></i>
                                Project Proposal
                            </div>
                        </div>
                        <div class="card-body">
                            <form
                                id="projectProposal"
                                method="post"
                            >
                                <div class="row mb-3 ">
                                    <div class="d-flex justify-content-end p-2">
                                        <button
                                            class="btn btn-primary btn-sm revertButton"
                                            type="button"
                                            disabled
                                        ><i class="ri-arrow-go-back-fill"></i>
                                        </button>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="projectID">Project ID:</label>
                                        <input
                                            class="form-control"
                                            id="projectID"
                                            name="projectID"
                                            data-initial-key="projectID"
                                            type="text"
                                            placeholder="Project ID"
                                            required
                                        >
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <label for="projectTitle">Project Title:</label>
                                        <input
                                            class="form-control"
                                            id="projectTitle"
                                            name="projectTitle"
                                            data-initial-key="projectTitle"
                                            type="text"
                                            placeholder="Project Title"
                                            required
                                        >
                                    </div>
                                </div>
                                <div class="card p-0 mb-3">
                                    <div
                                        class="card-body"
                                        id="ExpectedOutputTextareaContainer"
                                    >
                                        <h6>Expected Outputs</h6>
                                        <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                                            <button
                                                class="btn btn-success btn-sm me-2 addNewRowButton"
                                                type="button"
                                            >
                                                <i class="ri-add-fill"></i>
                                            </button>
                                            <button
                                                class="btn btn-danger btn-sm removeRowButton"
                                                type="button"
                                            >
                                                <i class="ri-subtract-fill"></i>
                                            </button>
                                        </div>
                                        <div class="row input_list">
                                            <div class="col-12">
                                                <textarea
                                                    class="form-control"
                                                    name="expectedOutputs[]"
                                                    rows="3"
                                                ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card p-0 mb-3">
                                    <div
                                        class="card-body"
                                        id="ApprovedEquipmentContainer"
                                    >
                                        <h6>Approved S&T Intervention Related
                                            Equipment</h6>
                                        <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                                            <button
                                                class="btn btn-success btn-sm me-2 addNewRowButton"
                                                type="button"
                                            >
                                                <i class="ri-add-fill"></i>
                                            </button>
                                            <button
                                                class="btn btn-danger btn-sm removeRowButton"
                                                type="button"
                                            >
                                                <i class="ri-subtract-fill"></i>
                                            </button>
                                        </div>
                                        <div class="row">
                                            <div>
                                                <div class="col-12">
                                                    <table
                                                        class="table"
                                                        id="EquipmentTable"
                                                        style="width:100%"
                                                    >
                                                        <thead>
                                                            <tr>
                                                                <th width="10%">Qty</th>
                                                                <th width="60%">Particulars</th>
                                                                <th width="30%">(₱)&nbsp;Cost</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <input
                                                                        class="form-control EquipmentQTY"
                                                                        type="number"
                                                                    >
                                                                </td>
                                                                <td>
                                                                    <input
                                                                        class="form-control Particulars"
                                                                        type="text"
                                                                    >
                                                                </td>
                                                                <td>
                                                                    <input
                                                                        class="form-control EquipmentCost"
                                                                        type="text"
                                                                    >
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card p-0 mb-3">
                                    <div
                                        class="card-body"
                                        id="ApprovedNonEquipmentContainer"
                                    >
                                        <h6>Approved Items of Expenditure(Non-Equipment)</h6>
                                        <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                                            <button
                                                class="btn btn-success btn-sm me-2 addNewRowButton"
                                                type="button"
                                            >
                                                <i class="ri-add-fill"></i>
                                            </button>
                                            <button
                                                class="btn btn-danger btn-sm removeRowButton"
                                                type="button"
                                            >
                                                <i class="ri-subtract-fill"></i>
                                            </button>
                                        </div>
                                        <div class="row">
                                            <div>
                                                <div class="col-12">
                                                    <table
                                                        class="table"
                                                        id="NonEquipmentTable"
                                                        style="width:100%"
                                                    >
                                                        <thead>
                                                            <tr>
                                                                <th width="10%">Qty</th>
                                                                <th width="60%">Particulars</th>
                                                                <th width="30%">(₱)&nbsp;Cost</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <input
                                                                        class="form-control NonEquipmentQTY"
                                                                        type="number"
                                                                    >
                                                                </td>
                                                                <td>
                                                                    <input
                                                                        class="form-control NonParticulars"
                                                                        type="text"
                                                                    >
                                                                </td>
                                                                <td>
                                                                    <input
                                                                        class="form-control NonEquipmentCost"
                                                                        type="text"
                                                                    >
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row justify-content-md-end">
                                            <div class="col-12 col-md-3">
                                                <label for="dateOfFundRelease">Date of Fund Release:</label>
                                                <input
                                                    class="form-control"
                                                    id="dateOfFundRelease"
                                                    name="dateOfFundRelease"
                                                    data-initial-key="dateOfFundRelease"
                                                    type="date"
                                                    placeholder="Date of Fund Release"
                                                    required
                                                >
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <label for="fundAmount">Fund Amount:</label>
                                                <input
                                                    class="form-control"
                                                    id="fundAmount"
                                                    name="fundAmount"
                                                    data-initial-key="fundAmount"
                                                    type="text"
                                                    placeholder="Fund Amount"
                                                    required
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button
                                            class="btn btn-success m-2"
                                            id="DraftProjectProposal"
                                            data-action="DraftForm"
                                            type="button"
                                        >Draft</button>
                                        <button
                                            class="btn btn-primary m-2"
                                            id="submitProjectProposal"
                                            data-action="SubmitForm"
                                            type="button"
                                        >Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane py-5" id="step-4" role="tabpanel" aria-labelledby="step-4">
                    <div class="card h-100">
                        <div class="card-header bg-primary">
                            <div class="fw-bold fs-6 text-white">
                                <i class="ri-file-list-3-fill"></i>
                                RTEC Report
                            </div>
                        </div>
                        <div class="card-body d-flex justify-content-end">
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#rtecReportContainerModal"><i class="ri-eye-fill"></i> view RTEC Report</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
