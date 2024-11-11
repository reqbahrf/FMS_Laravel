
<!-- Confirmation modal start -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to go to the Home page?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="/" class="btn btn-primary">Confirm</a>
            </div>
        </div>
    </div>
</div>
<!-- Confirmation modal End -->
<div class="p-1 shadow-lg z-3  {{ request()->is('index') ? 'position-fixed' : '' }} header-cont w-100">
    <div class="container-flex px-0 px-md-5 px-lg-5 align-items-center mb-3 mb-md-0">
        <header class="d-flex flex-wrap justify-content-center">
            <a href="/" class="d-flex justify-content-between me-auto text-dark text-decoration-none">
                <div class="navlogo d-flex justify-content-center align-items-center">
                    <img src="{{ asset('DOST_ICON.svg') }}" class="pe-2">
                    <div id="logoTitle" class="row position-relative h-100 w-75">
                        <div class="position-absolute top-50">
                            <p class="sideTextMain text-black m-0 w-100"></p>
                        </div>
                        <div class="position-absolute bottom-50">
                            <p class="sideTextSec text-black m-0 w-100"></p>
                        </div>
                    </div>
                </div>
            </a>
            <ul class="nav nav-pills align-items-center">
                <li class="nav-item">
                    <a href="{{ route('home') }}" id="home"
                        class="nav-link {{ Request::route()->getName() == 'home' ? 'active' : '' }}"
                        onclick="confirmRedirect()" data-toggle="modal" data-target="#confirmModal">Home
                    </a>
                <li class="nav-item">
                    <a href="#" class="nav-link">FAQs</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">About</a>
                </li>
                @guest
                <li class="nav-item">
                    <a href="/login" class="nav-link login">Login</a>
                </li>
                @endguest
                </li>
            </ul>
        </header>
    </div>
</div>
<script type="module">
    $(document).ready(function($) {
        // Your jQuery code here using "$"
        $('#home').click(function(e) {
            e.preventDefault(); // Prevent the default behavior of the anchor tag
            let link = $(this).attr('href');
            $('#confirmModal').modal('show'); // Show the confirmation modal
            $('#confirmModal .btn-primary').attr('href', link); // Set the redirection link
        });

        $('#confirmModal .btn-primary').click(function() {
            var link = $(this).attr('href');
            window.location.href = link; // Redirect after confirmation
        });
    });
</script>
