<div
    class="modal fade"
    id="addRequirementModal"
    data-bs-backdrop="static"
    aria-labelledby="addRequirementModalLabel"
    aria-hidden="true"
    tabindex="-1"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1
                    class="modal-title text-white"
                    id="addRequirementModalLabel"
                >Add Requirement</h1>
                <button
                    class="btn-close text-white"
                    data-bs-dismiss="modal"
                    type="button"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form id="addRequirementForm">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label
                            class="form-label"
                            for="requirement_name"
                        >File Name:</label>
                        <input
                            class="form-control"
                            id="requirement_name"
                            name="requirement_name"
                            type="text"
                        >
                        <div class="form-text">
                            Please Provide the name of the required file.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label
                            class="form-label"
                            for="requirement_description"
                        >File Description:</label>
                        <textarea
                            class="form-control"
                            id="requirement_description"
                            name="requirement_description"
                            rows="3"
                        ></textarea>
                        <div class="form-text">
                            Please Provide the description of the required file. so that the applicant can understand
                            what is required.
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button
                    class="btn"
                    data-bs-dismiss="modal"
                    type="button"
                >Close</button>
                <button
                    class="btn btn-primary"
                    id="addRequirementBtn"
                    form="addRequirementForm"
                    type="submit"
                >Add Requirement</button>
            </div>
        </div>
    </div>
</div>
