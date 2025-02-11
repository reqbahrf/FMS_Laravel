@if (session('error') || session('success') || session('status'))
<div
    class="toast-container position-fixed top-0 end-0 p-3"
    id="ssrtoastContainer"
    style="z-index: 1100;"
>
    <div
        class="toast align-items-center"
        id="ssrNotiToast"
        role="alert"
        aria-live="assertive"
        aria-atomic="true"
    >
        <div class="toast-header {{ session('error') ? 'text-bg-danger' : session('success') ? 'text-bg-success': session('status') ? 'text-bg-info' : '' }}">
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
            id="ssrsuccessToastBody"
        >
            {{ session('error') ? session('error') : session('success') || session('status') }}
        </div>
    </div>
</div>
<script type="module">
    $(document).ready(function() {
        setTimeout(() => {
            const toastElement = document.getElementById('ssrNotiToast');
            const toast = new bootstrap.Toast(toastElement);
            toast.show();
        }, 500);
    });
</script>
@endif
