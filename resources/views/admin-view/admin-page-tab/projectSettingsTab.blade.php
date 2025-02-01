<div class="p-3">
    <h4>Project Settings</h4>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="card shadow-sm m-0 m-md-3">
            <div class="card-header bg-primary">
                <h6 class="mb-0 text-white">Project Fee</h6>
            </div>
            <div class="card-body">
                <form id="projectFeeForm">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="fee_percentage">Fee Percentage (%):</label>
                        <input
                            class="form-control"
                            id="fee_percentage"
                            name="fee_percentage"
                            type="number"
                            value="{{  $fee_percentage ? $fee_percentage : 0 }}"
                            min="0"
                            max="100"
                            step="1"
                            required
                        >
                    </div>
                    <button
                        class="btn btn-primary ms-auto d-block"
                        type="submit"
                    >Update</button>

                </form>
            </div>
        </div>
    </div>
</div>

