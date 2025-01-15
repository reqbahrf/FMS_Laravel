<div class="col-12 mt-3" id="esignature-section">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">E-Signature</h5>
        </div>
        <div class="card-body">
            <div class="row esignature-row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="esignature-name" class="form-label">Name:</label>
                        <input type="text" class="form-control esignature-name">
                    </div>
                    <div class="mb-3">
                        <label for="esignature-top-text" class="form-label">Top Text:</label>
                        <input type="text" class="form-control esignature-top-text">
                    </div>
                    <div class="mb-3">
                        <label for="esignature-bottom-text" class="form-label">Bottom Text:</label>
                        <input type="text" class="form-control esignature-bottom-text">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="esignature-image" class="form-label">Signature:</label>
                        <input type="file" class="form-control esignature-image" accept="image/png">
                    </div>
                    <div class="mb-3">
                        <canvas class="border rounded w-100 esignature-canvas" width="300" height="180"></canvas>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-secondary clear-signature">
                            <i class="fas fa-eraser"></i> Clear
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>