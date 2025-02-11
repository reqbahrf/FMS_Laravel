@if (session('error') || session('success'))
<div
    class="toast-container position-fixed top-0 end-0 p-3"
    id="toastContainer"
    style="z-index: 1100;"
>
    <div
        class="toast align-items-center"
        id="emailNofiToast"
        role="alert"
        aria-live="assertive"
        aria-atomic="true"
    >
        <div class="toast-header {{ session('error') ? 'text-bg-danger' : 'text-bg-success' }}">
            <strong class="me-auto">{{ session('error') ? 'Error' : 'Success' }}</strong>
            <button
                class="btn-close btn-close-white"
                data-bs-dismiss="toast"
                type="button"
                aria-label="Close"
            ></button>
        </div>
        <div
            class="toast-body"
            id="successToastBody"
        >
            {{ session('error') ? session('error') : session('success') }}
        </div>
    </div>
</div>
<script type="module">
    $(document).ready(function() {
        setTimeout(() => {
            const toastElement = document.getElementById('emailNofiToast');
            const toast = new bootstrap.Toast(toastElement);
            toast.show();
        }, 500);
    });
</script>
@endif
