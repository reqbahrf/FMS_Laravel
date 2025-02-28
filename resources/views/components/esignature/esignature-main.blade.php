@props(['hasDate' => false, 'layout' => 'default'])
<div
    class="col-12 mt-3"
    id="esignature-section"
>
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">E-Signature</h5>
        </div>
        <div class="card-body">
            <div class="row esignature-row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label
                            class="form-label"
                            for="esignature-name"
                        >Name:</label>
                        <input
                            class="form-control esignature-name"
                            type="text"
                        >
                    </div>
                    @if ($layout === 'default')
                        <div class="mb-3">
                            <label
                                class="form-label"
                                for="esignature-top-text"
                            >Top Text:</label>
                            <input
                                class="form-control esignature-top-text"
                                type="text"
                            >
                        </div>
                        <div class="mb-3">
                            <label
                                class="form-label"
                                for="esignature-bottom-text"
                            >Bottom Text:</label>
                            <input
                                class="form-control esignature-bottom-text"
                                type="text"
                            >
                        </div>
                    @endif
                    @if ($layout === 'formal')
                        <div class="mb-3">
                            <label
                                class="form-label"
                                for="esignature-position"
                            >Position</label>
                            <input
                                class="form-control esignature-position"
                                type="text"
                            >
                        </div>
                    @endif
                    @if ($hasDate)
                        <div class="mb-3">
                            <label
                                class="form-label"
                                for="esignature-date"
                            >Date:</label>
                            <input
                                class="form-control esignature-date"
                                type="date"
                            >
                        </div>
                    @endIf
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label
                            class="form-label"
                            for="esignature-image"
                        >Signature:</label>
                        <input
                            class="form-control esignature-image"
                            type="file"
                            accept="image/png"
                        >
                    </div>
                    <div class="mb-3">
                        <canvas
                            class="border rounded w-100 esignature-canvas"
                            width="300"
                            height="180"
                        ></canvas>
                    </div>
                    <div class="d-flex gap-2">
                        <button
                            class="btn btn-secondary clear-signature"
                            type="button"
                        >
                            <i class="fas fa-eraser"></i> Clear
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
