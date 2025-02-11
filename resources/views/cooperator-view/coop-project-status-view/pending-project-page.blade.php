<style>
    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    #arrow {
        animation: rotate 60s linear infinite;
        /* Increased from 60s to 120s */
        transform-origin: center;
    }

    @media (min-width: 768px) {
        .waiting-clock {
            display: flex;
            margin-top: 40vh;
            justify-content: center;
            align-items: center;
            width: 50%;
            height: 50%;
        }


    }

    @media (max-width: 768px) {
        .waiting-clock {
            display: flex;
            margin-top: 10vh;
            justify-content: center;
            align-items: center;
            width: 90%;
            height: calc(100vh - 100px);
        }


        .waiting-clock h3 {
            font-size: 15px;
        }

        .waiting-clock h4 {
            font-size: 10px;
        }

        .waitingClock {
            width: 200px;
            height: 200px;
        }



    }

    .wrapperWait {
        overflow: hidden;
        var(--ct-body-color);
        width: 100%;
        height: 100%;
    }

    .backgroundColor {
        background-color: var(--ct-body-color);
    }

    .notification-banner {
        position: fixed;
        width: 40vw;
        top: 13%;
    }
</style>
<div class="wrapper-waiting">
    <x-my-account-modal :businessInfos="$businessInfos" />
    <x-toast-alert />
    <div class="topNav shadow-sm position-fixed container-fluid">
        <div class="d-flex justify-content-between align-items-center h-100 w-75">
            <img src="{{ asset('DOST_ICON.svg') }}" class="pe-2">
            <div id="logoTitle" class="row position-relative h-100 w-100">
                <div class="position-absolute top-50 ">
                    <p class="sideTextMain  m-0 w-100"></p>
                </div>
                <div class="position-absolute bottom-50">
                    <p class="sideTextSec  m-0 w-100"></p>
                </div>
            </div>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        <div>
            <ul class="list-unstyled d-flex align-items-center m-0 gap-3 ">
                <li class="nofi-li">
                    <a class="position-relative text-decoration-none nav-link" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ri-notification-3-line ri-2x"></i>
                        @if ($notifications->count() > 0)
                            <div id="badge--container">
                                <span class="badge rounded-pill bg-danger">{{ $notifications->count() }}</span>
                            </div>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                        <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                            <div class="row align-items-center">
                                <div class="col">
                                    <p class="m-0 font-16 fw-semibold">Notification</p>
                                </div>
                                <div class="col-auto">
                                    <a href="#" class="text-dark text-decoration-underline">
                                        <small>Clear All</small>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="px-2" id="notification--container" style="max-height: 300px; overflow-y: auto;">
                            <h5 class="text-muted font-13 fw-normal mt-2">Today</h5>
                            @if ($notifications && $notifications->isNotEmpty())
                                @php
                                    // Filter notifications for the specific application_id
                                    $filteredNotifications = $notifications->filter(function ($notification) {
                                        return $notification['data']['application_id'] ==
                                            Session::get('application_id');
                                    });
                                @endphp

                                @if ($filteredNotifications->isEmpty())
                                    <p>No notifications available.</p>
                                @else
                                    @foreach ($filteredNotifications as $notification)
                                        <a href="#"
                                            class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-2">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="notify-icon bg-primary">
                                                            <i class="mdi mdi-comment-account-outline"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 text-truncate ms-2">
                                                        <p>{{ $notification['data']['message'] }}</p>
                                                        <p><small>{{ $notification['created_at']->diffForHumans() }}</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @endif
                            @else
                                <p>No notifications available.</p>
                            @endif

                            <div class="text-center">
                            </div>
                        </div>
                        <a href="#" class="dropdown-item text-center text-primary notify-item border-top py-2">
                            View All
                        </a>
                    </div>
                </li>
                <li class="avatar-li">
                    <a class="text-decoration-none nav-link" data-bs-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        <div class="account-avatar d-flex align-items-center justify-content-center gap-2">
                            <div class="profile-logo rounded-circle border border-1 border-white bg-primary">
                                {{ strtoupper(substr(trim((string) Auth::user()->coopUserInfo->f_name), 0, 1)) }}
                            </div>
                            <p class="m-0 fw-bold">
                                {{ Auth::user()->coopUserInfo->f_name . ' ' . (Auth::user()->coopUserInfo->mid_name ? substr(Auth::user()->coopUserInfo->mid_name, 0, 1) . '.' : '') . ' ' . Auth::user()->coopUserInfo->l_name }}
                            </p>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated py-0"
                        style="max-height: 300px; width:10vw;">
                        <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                            <div class="row align-items-center">
                                <div class="col">
                                    <p class="m-0 font-16 fw-semibold">Account</p>
                                </div>
                            </div>
                        </div>
                        <div class="px-2">
                            <button type="button" class="dropdown-item py-2" data-bs-toggle="modal"
                                data-bs-target="#myAccountModal">
                                <p>
                                    <i class="ri-user-3-line me-2"></i>My Account
                                </p>
                            </button>
                            <a href="{{ route('logout') }}" class="dropdown-item py-2"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <p><i class="ri-logout-box-line me-2"></i>Logout</p>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <main class="overflow-y-auto vh-100 backgroundColor">
        <div class="d-flex flex-column justify-content-center align-items-center m-0 h-100">
            @if ($notifications->isEmpty())
                <div class="waiting-clock">
                    <div
                        class="container d-flex flex-column justify-content-center align-items-center p-4 shadow rounded-5">
                        <div>
                            <h3>Your Application is still in the process</h3>
                        </div>
                        <div class="w-auto">
                            <!-- SVG content here -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="waitingClock" viewBox="0 0 64 64"
                                width="170" height="170">
                                <g id="clock" transform="scale(-1, 1) translate(-64, 0)">
                                    <path
                                        d="M32 6C25.563809 6 19.527204 8.3098104 14.773438 12.533203L11.175781 9.0058594L9.2421875 21.353516L21.550781 19.177734L17.634766 15.337891C21.623806 11.883136 26.650401 10 32 10C44.131 10 54 19.869 54 32C54 44.131 44.131 54 32 54C19.869 54 10 44.131 10 32C10 31.468 10.019641 30.940969 10.056641 30.417969L6.0664062 30.132812C6.0224062 30.749813 6 31.372 6 32C6 46.336 17.664 58 32 58C46.336 58 58 46.336 58 32C58 17.664 46.336 6 32 6 z M 30.5 14L31 18L33 18L33.5 14L30.5 14 z M 14 30.5L14 33.5L18 33L18 31L14 30.5 z M 50 30.5L46 31L46 33L50 33.5L50 30.5 z M 31 46L30.5 50L33.5 50L33 46L31 46 z"
                                        fill="var(--ct-text-color)" />
                                </g>
                                <g id="arrow" transform="scale(-1, 1) translate(-64, 0)">
                                    <path
                                        d="M 44.021484 18.564453L33.25 28.203125 A 4 4 0 0 0 32 28 A 4 4 0 0 0 32 36 A 4 4 0 0 0 32.722656 35.931641L40.816406 42.638672L42.640625 40.816406L35.931641 32.720703 A 4 4 0 0 0 35.796875 30.75L45.435547 19.978516L44.021484 18.564453 z"
                                        fill="var(--ct-text-color)" />
                                </g>
                            </svg>
                        </div>
                        <div class="w-auto">
                            <h6 class="text-muted text-center">Please wait for the Evaluation or you may reach out to <a class="tect-black" href="mailto:psto.davaodelnorte@region11.dost.gov.ph"
                                class="text-white">psto.davaodelnorte@region11.dost.gov.ph</a> for more information</h6>
                        </div>
                    </div>
                </div>
            @else
                @php
                    // Find the first notification that matches the condition
                    $notification = $notifications->first(function ($notification) {
                        return $notification['type'] === 'App\Notifications\EvaluationScheduleNotification' &&
                            $notification['data']['application_id'] == Session::get('application_id');
                    });
                @endphp

                @if ($notification)
                    <div class="alert alert-success alert-dismissible notification-banner" role="alert">
                        <div>
                            <h6><i class="ri-information-2-fill"></i> Evaluation Schedule</h6>
                            <p>{{ $notification['data']['message'] }}</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
            @endif


            @php
                $businessId = Auth::user()->coopUserInfo->businessInfo()->first()->id;
            @endphp
            <x-applicant-requirements :business-id="$businessId" />
        </div>
    </main>
</div>
<x-toast-ssr-notification />
<script type="module">
    const UPDATEFILE = '{{ route('Applicant-Requirements.update', ['Applicant_Requirement' => ':id']) }}'

    function showToastFeedback(status, message) {
        const toast = $('#ActionFeedbackToast');
        const toastInstance = new bootstrap.Toast(toast);

        toast
            .find('.toast-header')
            .removeClass([
                'text-bg-danger',
                'text-bg-success',
                'text-bg-warning',
                'text-bg-info',
                'text-bg-primary',
                'text-bg-light',
                'text-bg-dark',
            ]);

        toast.find('.toast-body').text('');
        toast.find('.toast-header').addClass(status);
        toast.find('.toast-body').text(message);

        toastInstance.show();
    }
    const newFileUpload = document.querySelector('#updateFile');
    console.log(newFileUpload)
    const pondInstance = FilePond.create(newFileUpload, {
        allowMultiple: false,
        allowFileTypeValidation: true,
        allowFileSizeValidation: true,
        maxFileSize: '10MB',
        instantUpload: false,
    });

    const updateForm = $('#updateFileForm');
    const updateFileModal = new bootstrap.Modal($('#updateFileModal'));
    const confirmationModal = new bootstrap.Modal($('#confirmationModal'));

    $('#requirementsTableBody').on('click', '[data-bs-target="#updateFileModal"]', function() {
        const fileType = $(this).closest('tr').find('td:nth-child(2)').text();
        const FileId = $(this).data('id');
        const FileLink = $(this).data('file-link');

        updateForm.find('#file_id').val(FileId);
        updateForm.find('#file_link').val(FileLink);

        pondInstance.setOptions({
            acceptedFileTypes: [fileType === 'pdf' ? 'application/pdf' : 'image/*'],
        })
    })
    $('#updateFileSubmit').click(function() {
        updateFileModal.hide();
        confirmationModal.show();
    });

    updateForm.on('submit', function(e) {
        e.preventDefault();
        confirmationModal.hide();

        const formData = new FormData(this);
        const file = pondInstance.getFiles()[0].file;
        formData.append('file', file);
        formData.append('_method', 'PUT');

        $.ajax({
            url: UPDATEFILE.replace(':id', updateForm.find('#file_id').val()),
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                showToastFeedback('text-bg-success', response.success);
            },
            error: function(xhr, status, error) {
                showToastFeedback('text-bg-danger', error);
            }
        });
    });

    $('#confirmUpdate').click(function() {
        updateForm.submit();
    });
</script>
