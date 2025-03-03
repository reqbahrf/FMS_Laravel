{{-- Feedback Toast --}}
<div class="toast-container position-fixed top-0 end-0 p-3" id="toastFeedbackContainer" style="z-index: 1200;">
    <div id="ActionFeedbackToast" class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Message</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
        <div class="toast-body" id="ToastBody">

        </div>
    </div>
</div>

{{-- Process Toast --}}
<div class="toast-container position-fixed top-0 end-0 p-3" id="toastProcessContainer" style="z-index: 1200;">
    <div id="ProcessToast" class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header text-bg-success">
            <div class="spinner-border spinner-border-sm me-2" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <strong class="me-auto">Processing...</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
        <div class="toast-body" id="ProcessToastBody">
        </div>
    </div>
</div>
