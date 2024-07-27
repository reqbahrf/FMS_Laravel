<body class="overflow-hidden">
    <div class="wrapper">
        <nav class="sidenav expanded">
            <ul class="navbar-nav">
                <li class="nav-item mb-2 minimize">
                    <div class="navlogo d-flex justify-content-center align-items-center">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px"
                            viewBox="0 0 74.488 75.079" enable-background="new 0 0 74.488 75.079" xml:space="preserve"
                            class="m-1 logo">
                            <g>
                                <rect x="19.235" y="19.699" width="36" height="36" />
                                <circle fill="#48C4D3" cx="19.235" cy="19.699" r="18" />
                                <g>
                                    <circle fill="#48C4D3" cx="19.195" cy="19.648" r="18" />
                                    <path fill="#FFFFFF"
                                        d="M19.323,37.598c9.918-0.027,17.953-8.071,17.953-17.997c0-9.925-8.034-17.972-17.952-17.998L19.323,37.598z" />
                                    <path
                                        d="M37.192,19.601C37.166,9.682,29.12,1.648,19.195,1.648S1.224,9.682,1.198,19.601H37.192z" />
                                </g>
                                <g>
                                    <circle fill="#48C4D3" cx="55.315" cy="19.651" r="18" />
                                    <path fill="#FFFFFF"
                                        d="M37.319,19.651c0.027,9.918,8.07,17.952,17.996,17.952c9.925,0,17.972-8.034,17.998-17.952L37.319,19.651z" />
                                    <path
                                        d="M55.315,37.648c9.919-0.027,17.953-8.072,17.953-17.997c0-9.925-8.034-17.972-17.952-17.998L55.315,37.648z" />
                                </g>
                                <g>
                                    <circle fill="#48C4D3" cx="55.315" cy="55.649" r="18" />
                                    <path fill="#FFFFFF"
                                        d="M55.269,37.605c-9.918,0.027-17.953,8.072-17.953,17.997s8.035,17.972,17.953,17.999V37.605z" />
                                    <path
                                        d="M37.317,55.649c0.028,9.919,8.073,17.952,17.999,17.952c9.923,0,17.97-8.033,17.997-17.952H37.317z" />
                                </g>
                                <g>
                                    <circle fill="#48C4D3" cx="19.315" cy="55.725" r="18" />
                                    <path fill="#FFFFFF"
                                        d="M37.313,55.628c-0.027-9.919-8.072-17.953-17.997-17.953c-9.926,0-17.972,8.034-17.999,17.952L37.313,55.628z" />
                                    <path
                                        d="M19.268,37.682C9.349,37.709,1.315,45.754,1.315,55.679S9.349,73.65,19.268,73.677V37.682z" />
                                </g>
                            </g>
                        </svg>
                        <div id="logoTitle" class="row position-relative h-100 w-75">
                            <div class="position-absolute top-50">
                                <p class="sideTextMain text-white m-0 w-100"></p>
                            </div>
                            <div class="position-absolute bottom-50">
                                <p class="sideTextSec text-white m-0 w-100"></p>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item main-Nav mb-2">
                    <a href="#" id="InformationTab"
                        onclick="loadPage('{{ route('Cooperator.dashboard') }}','InformationTab');"
                        class="mb-2 d-flex align-items-center">
                        <i class="ri-dashboard-3-fill ri-2x"></i>
                        <span class="nav-text ml-2">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item main-Nav mb-2">
                    <a href="#" id="requirementTab"
                        onclick="loadPage('{{ route('Cooperator.Requirements') }}','requirementTab');"
                        class="mb-2 d-flex align-items-center">
                        <i class="ri-file-list-2-fill ri-2x"></i>
                        <span class="nav-text ml-2">Requirements</span>
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="#" id="querterlyReportTab" class="mb-2 d-flex align-items-center">
                        <i class="ri-draft-fill ri-2x"></i>
                        <span class="nav-text ml-2">Quarterly Report</span>

                    </a>
                    <div class="d-none" id="sidebarTasks">
                        <ul class="list-unstyled ps-5">
                            <li>
                                <a href="#" id="querterlyReportTab1" onclick="loadPage('{{ route('Cooperator.QuarterlyReport') }}','querterlyReportTab1');">Quarter 1 <span class="badge rounded-pill text-bg-success">Open</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="disabled-li-report">Quarter 2 <span
                                        class="badge rounded-pill text-bg-secondary">Close</span></a>
                            </li>
                            <li>
                                <a href="#" class="disabled-li-report">Quarter 3 <span
                                        class="badge rounded-pill text-bg-secondary">Close</span></a>
                            </li>
                            <li>
                                <a href="#" class="disabled-li-report">Quarter 4 <span
                                        class="badge rounded-pill text-bg-secondary">Close</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="toggle-left-margin" class="content-row navExpanded">
            <div class="topNav shadow-sm px-3 container-fluid">
                <div class="d-flex align-items-center justify-content-between">
                    <button onclick="toggleSidebar()" class="btn">
                        <i class="ri-menu-unfold-fill ri-2x"></i>
                    </button>
                </div>
                <ul class="list-unstyled d-flex align-items-center m-0 gap-3 ">
                    <li class="nofi-li">
                        <a class="position-relative text-decoration-none nav-link" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ri-notification-3-line ri-2x"></i>
                            <span class="notifi-bagde p-1 bg-danger border border-light rounded-circle"></span>
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
                            <div class="px-2" style="max-height: 300px; width:20vw; overflow-y: auto;">
                                <h5 class="text-muted font-13 fw-normal mt-2">Today</h5>
                                <a href="#"
                                    class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-2">
                                    <div class="card-body">
                                        <span class="float-end noti-close-btn text-muted"><i
                                                class="mdi mdi-close"></i></span>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="notify-icon bg-primary">
                                                    <i class="mdi mdi-comment-account-outline"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 text-truncate ms-2">
                                                <p class="m-0">New user registered</p>
                                                <p class="m-0 text-muted">2 min ago</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="text-center">
                                </div>
                            </div>
                            <a href="#"
                                class="dropdown-item text-center text-primary notify-item border-top py-2">
                                View All
                            </a>
                        </div>
                    </li>
                    <li class="avatar-li">
                        <a class="text-decoration-none nav-link" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="account-avatar d-flex align-items-center justify-content-center gap-2">
                                <img src="{{ asset('sampleProfile/raf,360x360,075,t,fafafa_ca443f4786.jpg') }}"
                                    width="32" height="32"
                                    class="object-fit-cover rounded-circle border border-1 border-black"
                                    alt="">
                                <p class="m-0 fw-bold">John Doe</p>
                            </span>
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
                                <a href="#" class="dropdown-item py-2">
                                    <p><i class="ri-user-3-line me-2"></i>My Account</p>
                                </a>
                                <a href="#" class="dropdown-item py-2">
                                    <p><i class="ri-logout-box-line me-2"></i>Logout</p>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="main-content">
                <main class="main-column scrollable-main" id="main-content">
                </main>
            </div>

        </div>

    </div>
    <script type="module">
        $(window).on('beforeunload', function() {
            return 'Are you sure you want to leave?';
        });
        $(document).ready(function() {
            let lastUrl = sessionStorage.getItem('CoopLastUrl');
            let lastActive = sessionStorage.getItem('CoopLastActive');
            if (lastUrl && lastActive) {
                loadPage(lastUrl, lastActive);
            } else {
                loadPage('{{ route('Cooperator.dashboard') }}', 'InformationTab');
            }
        });

        window.loadPage = function(url, activeLink) {
            // Check if the response is already cached
            let cachedPage = sessionStorage.getItem(url);
            if (cachedPage) {
                // If cached, use the cached response
                handleAjaxSuccess(cachedPage, activeLink, url);
            } else {
                // If not cached, make the AJAX request
                $.ajax({
                    url: url,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Cache the response
                        //sessionStorage.setItem(url, response);
                        handleAjaxSuccess(response, activeLink, url);
                    },
                    error: function(error) {
                        console.log('Error: ' + error);
                    }
                });
            }
        };

        function handleAjaxSuccess(response, activeLink, url) {
            $('#main-content').html(response);
            setActiveLink(activeLink);
            history.pushState(null, '', url);

            if (url === '{{ route('Cooperator.dashboard') }}') {
                initializeStackedChartPer();
                initializeProgressPer();
            }

            if (url === '{{ route('Cooperator.Requirements') }}') {
                initializeFilePond();
            }

            sessionStorage.setItem('CoopLastUrl', url);
            sessionStorage.setItem('CoopLastActive', activeLink);
        }

        function initializeFilePond() {
            console.log('DOM is fully loaded');
            // Initialize FilePond
            const inputElement = document.querySelector('.filepond-receipt-upload');
        FilePond.create(inputElement, {
            acceptedFileTypes: ['image/*'],
            imagePreviewHeight: 170,
            imageCropAspectRatio: '1:1',
            imageResizeTargetWidth: 200,
            imageResizeTargetHeight: 200,
            server: {
                process: {
                    url: '/upload/Img',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    onload: (response) => {
                        const data = JSON.parse(response);
                        if (data.temp_file_path && data.unique_id) {
                            // Store unique_id in a hidden input field or as a data attribute
                            document.querySelector('input[name="unique_id"]').value = data.unique_id;
                        }
                    }
                },
                revert: null // Revert is not needed for temporary files
            }
        });

        const form = document.getElementById('uploadForm');
    const successMessage = document.getElementById('successMessage');
    const submitBtn = document.getElementById('submitButton');

    submitButton.addEventListener('click', function(event) {
        event.preventDefault();

        const formData = new FormData(form);

        fetch('{{ route('receipts.store') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                successMessage.textContent = data.success;
                successMessage.style.display = 'block';
                successMessage.classList.add('alert', 'alert-success');
            } else {
                console.error(data.error);
            }
        })
        .catch(error => console.error('Error:', error));
    });
        }

        function initializeStackedChartPer() {
            var options = {
                series: [{
                    name: 'Building',
                    data: [500, 55, 41, 67, 22, 43, 21, 49]
                }, {
                    name: 'Equipment',
                    data: [13, 23, 20, 8, 13, 27, 33, 12]
                }, {
                    name: 'Working Capital',
                    data: [11, 17, 15, 15, 21, 14, 15, 13]
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    stacked: true,
                    stackType: '100%'
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        legend: {
                            position: 'bottom',
                            offsetX: -10,
                            offsetY: 0
                        }
                    }
                }],
                xaxis: {
                    categories: ['2011 Q1', '2011 Q2', '2011 Q3', '2011 Q4', '2012 Q1', '2012 Q2',
                        '2012 Q3', '2012 Q4'
                    ],
                },
                fill: {
                    opacity: 1
                },
                legend: {
                    position: 'right',
                    offsetX: 0,
                    offsetY: 50
                },
            };

            var chart = new ApexCharts(document.querySelector("#stackColumnChartPercent"), options);
            chart.render();
        }

        function initializeProgressPer() {
            var options = {
                series: [75],
                chart: {
                    height: 250,
                    width: 250,
                    type: 'radialBar',
                    toolbar: {
                        show: true
                    }
                },
                plotOptions: {
                    radialBar: {
                        startAngle: -135,
                        endAngle: 225,
                        hollow: {
                            margin: 0,
                            size: '70%',
                            background: '#fff',
                            image: undefined,
                            imageOffsetX: 0,
                            imageOffsetY: 0,
                            position: 'front',
                            dropShadow: {
                                enabled: true,
                                top: 3,
                                left: 0,
                                blur: 4,
                                opacity: 0.24
                            }
                        },
                        track: {
                            background: '#fff',
                            strokeWidth: '50%',
                            margin: 0, // margin is in pixels
                            dropShadow: {
                                enabled: true,
                                top: -3,
                                left: 0,
                                blur: 4,
                                opacity: 0.35
                            }
                        },

                        dataLabels: {
                            show: true,
                            name: {
                                offsetY: -10,
                                show: true,
                                color: '#888',
                                fontSize: '17px'
                            },
                            value: {
                                formatter: function(val) {
                                    return parseInt(val);
                                },
                                color: '#111',
                                fontSize: '36px',
                                show: true,
                            }
                        }
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'dark',
                        type: 'horizontal',
                        shadeIntensity: 0.5,
                        gradientToColors: ['#ABE5A1'],
                        inverseColors: true,
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100]
                    }
                },
                stroke: {
                    lineCap: 'round'
                },
                labels: ['Percent'],
            };

            var chart = new ApexCharts(document.querySelector("#ProgressPer"), options);
            chart.render();
        }
    </script>
    <script type="module">
        window.toggleSidebar = function() {
            const sidebar = document.querySelector('.sidenav');
            const logoDescription = document.querySelector('#logoTitle');
            logoDescription.classList.toggle('d-none');

            sidebar.classList.toggle('expanded');
            sidebar.classList.toggle('minimized');
            const container = $('#toggle-left-margin');
            if (container.hasClass('navExpanded')) {
                container.removeClass('navExpanded').addClass('navMinimized');
            } else {
                container.removeClass('navMinimized').addClass('navExpanded');
            };
            //side bar minimize
            $('.sidenav a span').each(function() {
                $(this).toggleClass('d-none');
            });

            $('.sidenav a').each(function() {
                $(this).toggleClass('justify-content-center');
            });
            //size bar minimize rotation
            $('#hover-link').toggleClass('rotate-icon');

        }

        window.setActiveLink = function(activeLink) {
            $('.nav-item a').removeClass('active');
            var defaultLink = 'dashboardLink';
            var linkToActivate = $('#' + (activeLink || defaultLink));
            linkToActivate.addClass('active');
        }

        //  Sidebar dropdown

        $('#querterlyReportTab').click(function() {
            $('#sidebarTasks').toggleClass('d-none');
        });
    </script>
</body>
