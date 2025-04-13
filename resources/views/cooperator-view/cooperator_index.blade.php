<!DOCTYPE html>
<html
    data-bs-theme="light"
    lang="en"
>

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >
    <title>Personal Dashboard</title>

    <link
        type="image/svg+xml"
        href="{{ asset('DOST_ICON.svg') }}"
        rel="icon"
    >
    @vite('resources/css/app.scss')
    @vite('resources/css/coopPage.css')
    @vite('resources/js/app.ts')
</head>

<body class="overflow-hidden">
    @if (!Session::has('application_status'))
        <x-logout-confirmation-modal />
        <div
            class="row justify-content-center align-items-center"
            style="height: 100vh"
        >
            <div class="col-12 text-end">
                <a
                    class="py-2 text-decoration-none me-3 text-danger"
                    data-bs-toggle="modal"
                    data-bs-target="#logoutConfirmationModal"
                    href="{{ route('logout') }}"
                >
                    <i class="ri-logout-box-line me-2"></i>Logout
                </a>
            </div>
            <div class="col-12">
                <h1 class="text-center">
                    Welcome to SETUP!
                </h1>
            </div>
            <div class="col-12">
                <div
                    class="mx-auto"
                    style=" width: 15rem; height: 15rem; border-radius: 50%; background-color: #318791; color: white; display: flex;align-items: center; justify-content: center; font-size: 5.5rem;
        "
                >
                    {{ strtoupper(substr(trim((string) Auth::user()->coopUserInfo->f_name), 0, 1)) }}

                </div>
            </div>
            <div class="col-12">
                <h2 class="text-center">
                    {{ Auth::user()->coopUserInfo->full_name }}
                </h2>
            </div>
            <div class="col-md-4">
                <form
                    class="w-100"
                    method="POST"
                    action="{{ route('Cooperator.Projects') }}"
                >
                    @csrf

                    <!-- Business Selection -->
                    <div
                        class="form-group mb-3"
                        id="business-selection"
                    >
                        <label
                            class="form-label"
                            for="business"
                        >Select Business:</label>
                        <div class="dropdown">
                            <button
                                class="btn btn-secondary dropdown-toggle w-100"
                                id="businessDropdown"
                                data-bs-toggle="dropdown"
                                type="button"
                                aria-expanded="false"
                            >
                                -- Choose a Business --
                            </button>
                            <ul
                                class="dropdown-menu w-100"
                                aria-labelledby="businessDropdown"
                            >
                                @foreach ($businessInfos as $business)
                                    <li>
                                        <a
                                            class="dropdown-item business-option"
                                            data-id="{{ $business->id }}"
                                            href="#"
                                        >{{ $business->firm_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Application Selection -->
                    <!-- Application Selection -->
                    <div
                        class="form-group mb-3 d-none"
                        id="application-selection"
                    >
                        <label
                            class="form-label"
                            for="application"
                        >Select Application:</label>
                        <div class="dropdown">
                            <button
                                class="btn btn-secondary dropdown-toggle w-100"
                                id="applicationDropdown"
                                data-bs-toggle="dropdown"
                                type="button"
                                aria-expanded="false"
                            >
                                -- Choose an Application --
                            </button>
                            <ul
                                class="dropdown-menu w-100"
                                id="applicationDropdownMenu"
                                aria-labelledby="applicationDropdown"
                            >
                                <!-- Applications will be dynamically loaded here -->
                            </ul>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button
                                class="btn mt-3"
                                id="revertButton"
                                type="button"
                            ><i class="ri-arrow-left-line"></i>Back</button>
                        </div>
                    </div>

                    <button
                        class="btn btn-primary w-100 mt-3"
                        type="submit"
                    >Submit</button>
                    <input
                        id="business_id"
                        name="business_id"
                        type="hidden"
                    >
                    <input
                        id="application_id"
                        name="application_id"
                        type="hidden"
                    >
                </form>

            </div>
        </div>
        <script type="module">
            // JavaScript for dynamically loading applications based on selected business
            const businessInfos = @json($businessInfos);

            $(document).ready(function() {
                const $businessSelection = $('#business-selection');
                const $applicationSelection = $('#application-selection');
                const $businessIdInput = $('#business_id');
                const $applicationIdInput = $('#application_id');
                const $applicationDropdownMenu = $('#applicationDropdownMenu'); // Select the UL element

                // Handle business selection
                $('.business-option').on('click', function(e) {
                    e.preventDefault();
                    const businessId = $(this).data('id');
                    const businessName = $(this).text();

                    // Set business ID and update UI
                    $businessIdInput.val(businessId);
                    $('#businessDropdown').text(businessName);
                    loadApplications(businessId);

                    // Switch to application selection
                    $businessSelection.addClass('d-none');
                    $applicationSelection.removeClass('d-none');
                });

                // Handle revert button
                $('#revertButton').on('click', function() {
                    // Reset state and switch back to business selection
                    $businessIdInput.val('');
                    $applicationIdInput.val('');
                    $('#businessDropdown').text('-- Choose a Business --');
                    $applicationDropdownMenu.empty().append(
                        '<li><a class="dropdown-item" href="#">-- Choose an Application --</a></li>');
                    $businessSelection.removeClass('d-none');
                    $applicationSelection.addClass('d-none');
                });

                // Handle application selection
                $applicationDropdownMenu.on('click', '.application-option', function(e) {
                    e.preventDefault();
                    const applicationId = $(this).data('id');
                    const applicationName = $(this).text();

                    // Set application ID and update UI
                    $applicationIdInput.val(applicationId);
                    $('#applicationDropdown').text(
                        applicationName); // Update the button text with the selected application
                });

                // Load applications dynamically
                function loadApplications(businessId) {
                    const selectedBusiness = businessInfos.find(business => business.id == businessId);

                    // Clear existing options
                    $applicationDropdownMenu.empty();
                    if (selectedBusiness && selectedBusiness.application_info.length > 0) {
                        selectedBusiness.application_info.forEach(application => {
                            const badgeClass =
                                application.application_status === 'approved' ?
                                'info' :
                                application.application_status === 'rejected' ?
                                'danger' :
                                application.application_status === 'ongoing' ?
                                'primary' :
                                application.application_status === 'completed' ?
                                'success' :
                                'warning';

                            // Append each application as a new LI in the dropdown menu
                            $applicationDropdownMenu.append(
                                `<li>
                        <a class="dropdown-item application-option" href="#" data-id="${application.id}">
                            Application ID: ${application.id} <span class="badge bg-${badgeClass}">${application.application_status}</span>
                        </a>
                    </li>`
                            );
                        });
                    } else {
                        $applicationDropdownMenu.append(
                            '<li><a class="dropdown-item" href="#">No Applications Available</a></li>');
                    }
                }
            });
        </script>
    @else
        @if (in_array(Session::get('application_status'), ['approved', 'ongoing', 'completed']))
            @include('cooperator-view.coop-project-status-view.approved-project-page')
        @elseif(in_array(Session::get('application_status'), ['new', 'evaluation', 'pending']))
            @include('cooperator-view.coop-project-status-view.pending-applicant-page')
        @endif
    @endif
</body>

</html>
