<div class="m-3">
    <h1>Add Project</h1>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb px-3">
        <li class="breadcrumb-item"><a
                href="#"
                onclick="loadTab('{{ route('staff.Project') }}', 'projectLink')"
            >Projects</a></li>
        <li class="breadcrumb-item active">Add Project</li>
    </ol>
</nav>

<div class="card m-0 m-md-3">
    <div class="card-body">
        <form
            id="ExistingProjectForm"
            method="POST"
            action="{{ URL::signedRoute('staff.Project.submit.new.project', ['staffId' => $staffId]) }}"
        >
            @csrf
            <div class="row mb-3">
                <div class="col-md-12">
                    <h2>Project Information</h2>
                </div>
                <div class="col-12">
                    <label
                        class="form-label"
                        for="email"
                    >Email Address: <span class="text-danger">*</span></label>
                    <input
                        class="form-control w-50"
                        id="email"
                        name="email"
                        type="email"
                        title="Please enter a valid email address"
                        required
                    >
                    <div class="form-text text-muted">To ensure successful delivery of login
                        credentials, please enter a valid email address for the user registration.</div>
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label
                            class="form-label"
                            for="project_id"
                        >Project ID</label>
                        <input
                            class="form-control"
                            id="project_id"
                            name="project_id"
                            type="text"
                            value="{{ old('project_id') }}"
                            maxlength="15"
                            required
                        >
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label
                            class="form-label"
                            for="project_title"
                        >Project Title</label>
                        <input
                            class="form-control"
                            id="project_title"
                            name="project_title"
                            type="text"
                            value="{{ old('project_title') }}"
                            required
                        >
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label
                            class="form-label"
                            for="fund_released_date"
                        >Fund Released Date</label>
                        <input
                            class="form-control"
                            id="fund_released_date"
                            name="fund_released_date"
                            type="date"
                            value=""
                            max="{{ now()->toDateString() }}"
                            required
                        >
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label
                            class="form-label"
                            for="project_duration"
                        >Project Duration (years)</label>
                        <input
                            class="form-control"
                            id="project_duration"
                            name="project_duration"
                            type="number"
                            value="3"
                            min="1"
                            max="6"
                            required
                        >
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label
                            class="form-label"
                            for="funded_amount"
                        >Funded Amount</label>
                        <div class="input-group">
                            <span class="input-group-text">₱</span>
                            <input
                                class="form-control"
                                id="funded_amount"
                                name="funded_amount"
                                type="text"
                                value=""
                                placeholder="1,000,000"
                                required
                            >
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label
                            class="form-label"
                            for="fee_percentage"
                        >Fee Percentage (%)</label>
                        <div class="input-group">
                            <input
                                class="form-control"
                                id="fee_percentage"
                                name="fee_percentage"
                                type="number"
                                value="0"
                                step="0.01"
                                min="0"
                                max="100"
                                required
                            >
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gy-3">
                <div class="col-md-12 d-flex align-items-center justify-content-between">
                    <h3 class="mb-3 ps-3">Refund Structure Table</h3>
                    <button
                        class="btn btn-primary"
                        id="generateRefundStructure"
                        type="button"
                    >Generate Refund</button>
                </div>
                <table
                    class="table table-bordered"
                    id="refundStructureTable"
                >
                    <tbody>
                        <tr>
                            <td class="text-center">No Refund Structure yet</td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-md-12">
                <h2 class="mb-3">Cooperator's</h2>
            </div>
            <div class="col-md-12">
                <h3 class="mb-3 ps-3">Personal Information</h3>
            </div>
            <x-application-form.personal-info />
            <div class="col-12">
                <hr>
            </div>
            <div class="col-md-12">
                <h3 class="mb-3 ps-3">Business Information</h3>
            </div>
            <x-application-form.business-info
                :withFileInput="false"
                :withBenchmarkInfoInputs="false"
                :withAdditionalBusinessActivityInfo="false"
            />
            <div class="col-12">
                <hr>
            </div>
            <div class="row mt-4">
                <div class="col-12 text-end">
                    <button
                        class="btn btn-primary"
                        type="submit"
                    >Save Project</button>
                    <button
                        class="btn btn-secondary"
                        type="button"
                        onclick="loadTab('{{ route('staff.Project') }}', 'projectLink')"
                    >Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
