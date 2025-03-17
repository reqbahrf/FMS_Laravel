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
                    <table
                        class="table table-hover align-middle"
                        id="tnaTable"
                    >
                        <thead>
                            <tr>
                                <th class="fw-bold text-center">Document Status</th>
                                <th class="fw-bold text-center">Reviewed by</th>
                                <th class="fw-bold text-center">Last Modified by</th>
                                <th class="fw-bold text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-end">
                                    <button
                                        class="btn btn-primary"
                                        id="viewTNA"
                                        data-bs-toggle="modal"
                                        data-bs-target="#tnaDocContainerModal"
                                        data-action="view"
                                        type="button"
                                    >
                                        <i class="ri-file-list-3-fill me-1"></i>
                                        View
                                    </button>
                                    <button
                                        class="btn btn-primary ms-2"
                                        id="editTNA"
                                        data-bs-toggle="modal"
                                        data-bs-target="#tnaDocContainerModal"
                                        data-action="edit"
                                        type="button"
                                    >
                                        <i class="ri-file-edit-fill me-1"></i>
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
                    <table
                        class="table table-hover align-middle"
                        id="projectProposalTable"
                    >
                        <thead>
                            <tr>
                                <th class="fw-bold text-center">Document Status</th>
                                <th class="fw-bold text-center">Reviewed by</th>
                                <th class="fw-bold text-center">Last Modified by</th>
                                <th class="fw-bold text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-end">
                                    <button
                                        class="btn btn-primary"
                                        id="viewProjectProposal"
                                        data-bs-toggle="modal"
                                        data-bs-target="#projectProposalDocContainerModal"
                                        data-action="view"
                                        type="button"
                                    >
                                        <i class="ri-file-list-3-fill me-1"></i>
                                        View
                                    </button>
                                    <button
                                        class="btn btn-primary ms-2"
                                        id="editProjectProposal"
                                        data-bs-toggle="modal"
                                        data-bs-target="#projectProposalDocContainerModal"
                                        data-action="edit"
                                        type="button"
                                    >
                                        <i class="ri-file-edit-fill me-1"></i>
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <div
                class="tab-pane py-5"
                id="step-4"
                role="tabpanel"
                aria-labelledby="step-4"
            >
                <div class="card h-100">
                    <div class="card-header bg-primary">
                        <div class="fw-bold fs-6 text-white">
                            <i class="ri-file-list-3-fill"></i>
                            RTEC Report
                        </div>
                    </div>
                    <table
                        class="table table-hover align-middle"
                        id="rtecReportTable"
                    >
                        <thead>
                            <tr>
                                <th class="fw-bold text-center">Document Status</th>
                                <th class="fw-bold text-center">Reviewed by</th>
                                <th class="fw-bold text-center">Last Modified by</th>
                                <th class="fw-bold text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-end">
                                    <button
                                        class="btn btn-primary"
                                        id="viewRTECReport"
                                        data-bs-toggle="modal"
                                        data-bs-target="#rtecReportContainerModal"
                                        data-action="view"
                                        type="button"
                                    ><i class="ri-file-list-3-fill me-1"></i>View</button>
                                    <button
                                        class="btn btn-primary ms-2"
                                        id="editRTECReport"
                                        data-bs-toggle="modal"
                                        data-bs-target="#rtecReportContainerModal"
                                        data-action="edit"
                                        type="button"
                                    ><i class="ri-file-edit-fill me-1"></i>Edit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
