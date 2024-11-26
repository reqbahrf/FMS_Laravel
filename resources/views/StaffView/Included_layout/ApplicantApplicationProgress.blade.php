<div class="container mt-5 shadow">
    <div id="ApplicationProgress">
        <ul class="nav nav-progress">
            <li class="nav-item">
                <a class="nav-link default active" href="#step-1">
                    <div class="num">1</div>
                    Requirement Verification
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link default" href="#step-2">
                    <span class="num">2</span>
                    Conduct TNA
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link default" href="#step-3">
                    <span class="num">3</span>
                    Project Proposal
                </a>
            </li>
        </ul>
        <div class="tab-content overflow-y-visible">
            <div id="step-1" class="tab-pane py-5" role="tabpanel" aria-labelledby="step-1">
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
                                <tbody class="table-group-divider" id="requirementsTables">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="step-2" class="tab-pane py-5 overflow-auto" role="tabpanel" aria-labelledby="step-2">
                <!-- Where Conduct TNA Info Displayed -->
                <div class="card h-100">
                    <div class="card-header bg-primary">
                        <div class="fw-bold fs-6 text-white">
                            <i class="ri-calendar-event-fill"></i>
                            Schedule an Evaluation
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-between h-100">
                            <div class="col-9">
                                    <input type="datetime-local" id="evaluationSchedule-datepicker"
                                        class="form-control" min="{{ date('Y-m-d\TH:i') }}">
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-primary mx-auto" id="setEvaluationDate">
                                    SET
                                </button>
                            </div>
                            <div class="col-12 mb-auto">
                                <div id="nofi_ScheduleCont" class="mt-3">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="step-3" class="tab-pane py-5" role="tabpanel" aria-labelledby="step-3">
                <!-- Where Project Proposal Info Displayed -->
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="fw-bold fs-6 text-white">
                            <i class="ri-file-list-3-fill"></i>
                            Project Proposal
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" id="projectProposal">
                            <div class="row mb-3 ">
                                <div class="d-flex justify-content-end p-2">
                                    <button type="button" class="btn btn-primary btn-sm revertButton" disabled><i
                                            class="ri-arrow-go-back-fill"></i>
                                    </button>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="projectID">Project ID:</label>
                                    <input type="text" class="form-control" id="projectID" name="projectID"
                                    placeholder="Project ID" required data-initial-key="projectID">
                                </div>
                                <div class="col-12 col-md-9">
                                        <label for="projectTitle">Project Title:</label>
                                        <input type="text" class="form-control" id="projectTitle" name="projectTitle"
                                            placeholder="Project Title" required data-initial-key="projectTitle">
                                </div>
                            </div>
                            <div class="card p-0 mb-3">
                                <div class="card-body" id="ExpectedOutputTextareaContainer">
                                        <h6>Expected Outputs</h6>
                                        <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                                            <button type="button" class="btn btn-success btn-sm me-2 addNewRowButton">
                                                <i class="ri-add-fill"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm removeRowButton">
                                                <i class="ri-subtract-fill"></i>
                                            </button>
                                        </div>
                                    <div class="row input_list">
                                            <div class="col-12">
                                                <textarea class="form-control"
                                                name="expectedOutputs[]"
                                                rows="3"></textarea>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card p-0 mb-3">
                                <div class="card-body" id="ApprovedEquipmentContainer">
                                            <h6>Approved S&T Intervention Related
                                                Equipment</h6>
                                                <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                                                    <button type="button" class="btn btn-success btn-sm me-2 addNewRowButton">
                                                        <i class="ri-add-fill"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm removeRowButton">
                                                        <i class="ri-subtract-fill"></i>
                                                    </button>
                                                </div>
                                    <div class="row">
                                        <div>
                                            <div class="col-12">
                                                <table class="table" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th width="10%">Qty</th>
                                                            <th width="60%">Particulars</th>
                                                            <th width="30%">(₱)&nbsp;Cost</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="EquipmentTableBody">
                                                        <tr>
                                                            <td>
                                                                <input type="number" class="form-control EquipmentQTY">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control Particulars" >
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control EquipmentCost" >
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
                                <div class="card-body" id="ApprovedNonEquipmentContainer">
                                    <h6>Approved Items of Expenditure(Non-Equipment)</h6>
                                        <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                                            <button type="button" class="btn btn-success btn-sm me-2 addNewRowButton">
                                                <i class="ri-add-fill"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm removeRowButton">
                                                <i class="ri-subtract-fill"></i>
                                            </button>
                                        </div>
                                    <div class="row">
                                        <div>
                                            <div class="col-12">
                                                <table class="table" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th width="10%">Qty</th>
                                                            <th width="60%">Particulars</th>
                                                            <th width="30%">(₱)&nbsp;Cost</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="NonEquipmentTableBody">
                                                        <tr>
                                                            <td>
                                                                <input type="number" class="form-control NonEquipmentQTY">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control NonParticulars" >
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control NonEquipmentCost" >
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
                                            <input type="date" class="form-control" id="dateOfFundRelease"
                                                name="dateOfFundRelease" placeholder="Date of Fund Release" required data-initial-key="dateOfFundRelease">
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <label for="fundAmount">Fund Amount:</label>
                                            <input type="text" class="form-control" id="fundAmount"
                                                name="fundAmount" placeholder="Fund Amount" required data-initial-key="fundAmount">
                                         </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="button" class="btn btn-success m-2" data-action="DraftForm" id="DraftProjectProposal">Draft</button>
                                    <button type="button" class="btn btn-primary m-2" data-action="SubmitForm" id="submitProjectProposal">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
