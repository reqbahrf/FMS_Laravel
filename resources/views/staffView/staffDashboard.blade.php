
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Staff Dashboard</title>

  <link rel="icon" href="{{ asset('DOST_ICON.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('build/assets/app-DGUx_62c.css') }}">
    <script src="{{ asset('build/assets/app-DBkvPR3S.js') }}"></script>
    <link href="{{ asset('other_assets/dist-smartWizard/css/smart_wizard_all.min.css') }}" rel="stylesheet"
        type="text/css" />
    <script type="text/javascript" src="{{ asset('other_assets/dist-smartWizard/js/jquery.smartWizard.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('other_assets/apexChart/apexcharts.css') }}">
    <script src="{{ asset('other_assets/apexChart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('other_assets/date-picker-assets/moment.min.js') }}"></script>
    <script src="{{ asset('other_assets/date-picker-assets/daterangepicker.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('other_assets/date-picker-assets/daterangepicker.css') }}">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
    <link rel="stylesheet" href="{{ asset('icon_css/remixicon.css') }}">


  <style>

html {
            font-size: clamp(12px, 1vw, 24px); /* Adjusts between 10px and 18px according to viewport width */
        }

        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wdth,wght,YTLC@0,6..12,75..125,200..1000,440..540;1,6..12,75..125,200..1000,440..540&display=swap');

        :root {
            font-family: 'Nunito', sans-serif;
        }

        body, button, input, textarea, select {
        font-family: 'Nunito', sans-serif;
       }

       h1, h2, h3, h4, h5, h6 {
        font-weight: 700; /* Example: Set to semi-bold. Adjust the value as needed */
    }
    .headerlogo {
      background: #318791;
      color: white;
    }

    :root{
    --sw-toolbar-btn-background-color:  #318791;
    --sw-anchor-default-primary-color:  #f8f9fa;
    --sw-anchor-active-primary-color:  #318791;
    --sw-anchor-active-secondary-color:  #ffffff;
    --sw-anchor-done-primary-color:  #48C4D3;
    --sw-anchor-error-primary-color:  #dc3545;
    --sw-anchor-error-secondary-color:  #ffffff;
    --sw-anchor-warning-primary-color:  #ffc107;
    --sw-anchor-warning-secondary-color:  #ffffff;
    --sw-progress-color:  #318791;
    --sw-progress-background-color:  #f8f9fa;
    --sw-loader-color:  #318791;
    --sw-loader-background-color:  #f8f9fa;
    --sw-loader-background-wrapper-color:  rgba(255, 255, 255, 0.7);
}

    fieldset legend {
      position: absolute;
      /* Set position to absolute */
      top: -20px;
      /* Adjust this value to move legend up */
      color: #495057;
      border-radius: 0.25rem;
      padding: 0.5rem;
      font-size: 1rem;
      font-weight: bold;
      left: 10px;
      /* Adjust horizontally if needed */
    }


    /* Additional styling to ensure the fieldset and its contents look integrated */
    fieldset {
      position: relative;
      /* Added position relative */
      background-color: #fff;
      padding: 2rem;
      border: 2px solid #dee2e6;
      border-radius: 0.25rem;
    }

    .scrollable-main {
      overflow-y: auto;
      overflow-x: hidden;
      width: 100%;
      height: 90vh;
    }

    .flex-container {
      display: flex;
      background-color: #EEEEEE;
    }

    .nav-column {
      width: auto;
      order: 2;
    }

    .main-column {
      flex-grow: 1;
      margin-top: 0.5rem;
      margin-left: 1rem;
      margin-right: 1rem;
      width: 85%;
      order: 1;
    }

    .logo {
      width: 50px;
      height: 50px;
      border-radius: 25%;
      border: 0.5px solid white;
      background-color: white;
      object-fit: cover;
      object-position: center;
    }

    .dt-paging .page-item .page-link {
      color: #318791;
      /* Default text color */
      background-color: #fff;
      /* Default background color */
      border: 1px solid #dee2e6;
      /* Default border */
      padding: 5px 10px;
      /* Padding */
      margin: 0 2px;
      /* Margin */
      border-radius: 4px;
      /* Rounded corners */
    }

    .dt-paging .page-item .page-link:hover {
      background-color: #e9ecef;
      /* Background color on hover */
      border-color: #ddd;
      /* Border color on hover */
    }

    .dt-paging .page-item.active .page-link {
      background-color: #318791 !important;
      /* Background color for active page */
      color: white;
      /* Text color for active page */
      border-color: #318791;
      /* Border color for active page */
    }


    @media (min-width: 768px) {
      .flex-container {
        flex-direction: row;
      }

      .nav-column {
        order: 1;
      }
    }
  </style>
</head>

<body class="overflow-hidden">
  <div class="container-fluid px-0 headerlogo">
    <div class="d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center">
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 74.488 75.079" enable-background="new 0 0 74.488 75.079" xml:space="preserve" class="m-3 logo">
          <g>
            <rect x="19.235" y="19.699" width="36" height="36" />
            <circle fill="#48C4D3" cx="19.235" cy="19.699" r="18" />
            <g>
              <circle fill="#48C4D3" cx="19.195" cy="19.648" r="18" />
              <path fill="#FFFFFF" d="M19.323,37.598c9.918-0.027,17.953-8.071,17.953-17.997c0-9.925-8.034-17.972-17.952-17.998L19.323,37.598z" />
              <path d="M37.192,19.601C37.166,9.682,29.12,1.648,19.195,1.648S1.224,9.682,1.198,19.601H37.192z" />
            </g>
            <g>
              <circle fill="#48C4D3" cx="55.315" cy="19.651" r="18" />
              <path fill="#FFFFFF" d="M37.319,19.651c0.027,9.918,8.07,17.952,17.996,17.952c9.925,0,17.972-8.034,17.998-17.952L37.319,19.651z" />
              <path d="M55.315,37.648c9.919-0.027,17.953-8.072,17.953-17.997c0-9.925-8.034-17.972-17.952-17.998L55.315,37.648z" />
            </g>
            <g>
              <circle fill="#48C4D3" cx="55.315" cy="55.649" r="18" />
              <path fill="#FFFFFF" d="M55.269,37.605c-9.918,0.027-17.953,8.072-17.953,17.997s8.035,17.972,17.953,17.999V37.605z" />
              <path d="M37.317,55.649c0.028,9.919,8.073,17.952,17.999,17.952c9.923,0,17.97-8.033,17.997-17.952H37.317z" />
            </g>
            <g>
              <circle fill="#48C4D3" cx="19.315" cy="55.725" r="18" />
              <path fill="#FFFFFF" d="M37.313,55.628c-0.027-9.919-8.072-17.953-17.997-17.953c-9.926,0-17.972,8.034-17.999,17.952L37.313,55.628z" />
              <path d="M19.268,37.682C9.349,37.709,1.315,45.754,1.315,55.679S9.349,73.65,19.268,73.677V37.682z" />
            </g>
          </g>
        </svg>
        <h4 class="text-white">DOST-SETUP Fund Monitoring System</h4>
      </div>
      <div>
        <button class="btn position-relative pe-4">
          <svg xmlns=" http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="30" height="30">
            <path d="M47.841797 5.0351562C47.05125 4.9672344 46.262109 5.4091719 45.943359 6.2011719L45.246094 7.9394531C37.943094 4.7824531 32.698625 6.4574844 30.640625 10.021484C23.743625 21.966484 16.695906 26.420828 15.628906 27.048828L49.583984 45.121094C49.880984 42.010094 51.171375 34.723891 56.734375 25.087891C58.792375 21.522891 57.621328 16.142484 51.236328 11.396484L52.392578 9.9257812C53.095578 9.0297812 52.841469 7.7193906 51.855469 7.1503906L48.615234 5.2792969C48.368734 5.1370469 48.105312 5.0577969 47.841797 5.0351562 z M 11.449219 27.326172C10.230984 27.331562 7.4444219 27.949797 4.6386719 32.810547L28.820312 46.771484C27.923145 49.295954 28.910806 52.176668 31.314453 53.564453C33.718585 54.952518 36.707485 54.368453 38.445312 52.328125L50 59C53.741 52.52 50.96875 49.839844 50.96875 49.839844L12.087891 27.390625C12.087891 27.390625 11.855297 27.324375 11.449219 27.326172 z" fill="#FFFFFF" />
          </svg>
          <span class="position-absolute top-25 start-75 translate-middle p-1 bg-danger border border-light rounded-circle">
            <span class="visually-hidden">New alerts</span>
          </span>
        </button>
      </div>
    </div>
  </div>
  <div class="flex-container d-flex flex-column flex-md-row mobileView">
    <div class="nav-column">
       @include('staffView.navStaff')
    </div>
    <main class="main-column scrollable-main" id="main-content">

    </main>
  </div>
  <script>
    $(window).on('beforeunload', function() {
        return 'Are you sure you want to leave?';
    });

    $(document).ready(function() {
      let lastUrl = sessionStorage.getItem('StafflastUrl')
      let lastActive = sessionStorage.getItem('StafflastActive')
      if(lastUrl && lastActive){
        loadPage(lastUrl, lastActive);
      }else {
        loadPage('{{ route('staff.dashboard') }}', 'dashboardLink');
      }

    });

    function loadPage(url, activeLink) {
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
                sessionStorage.setItem(url, response);
                handleAjaxSuccess(response, activeLink, url);
            },
            error: function(error) {
                console.log('Error: ' + error);
            }
        });
    }
}

function handleAjaxSuccess(response, activeLink, url) {
    $('#main-content').html(response);
    setActiveLink(activeLink);
    history.pushState(null, '', url);

    if (url === '{{ route('staff.dashboard') }}') {
        InitdashboardChar();
    }

    if (url === '/org-access/viewCooperatorInfo.php') {
        InitializeviewCooperatorProgress();
    }

    sessionStorage.setItem('StafflastUrl', url);
    sessionStorage.setItem('StafflastActive', activeLink);
}


    //TODO: Charts for Applicant, Ongoing and Completed Projects

    function InitdashboardChar() {
      var randomizeArray = function(arg) {
        var array = arg.slice();
        var currentIndex = array.length,
          temporaryValue, randomIndex;

        while (0 !== currentIndex) {

          randomIndex = Math.floor(Math.random() * currentIndex);
          currentIndex -= 1;

          temporaryValue = array[currentIndex];
          array[currentIndex] = array[randomIndex];
          array[randomIndex] = temporaryValue;
        }

        return array;
      }
      var sparklineData = [47, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46];
      var applicationChar = {
        chart: {
          id: 'Applicant',
          type: 'area',
          height: 160,
          sparkline: {
            enabled: true
          },
        },
        stroke: {
          curve: 'straight'
        },
        fill: {
          opacity: 1,
        },
        series: [{
          name: 'Applicants',
          data: randomizeArray(sparklineData)
        }],
        labels: [...Array(24).keys()].map(n => `2018-09-0${n+1}`),
        yaxis: {
          min: 0
        },
        xaxis: {
          type: 'datetime',
        },
        colors: ['#48C4D3'],
        title: {
          text: '52',
          offsetX: 30,
          style: {
            fontSize: '24px',
            cssClass: 'apexcharts-yaxis-title'
          }
        },
        subtitle: {
          text: 'Applicants',
          offsetX: 30,
          style: {
            fontSize: '14px',
            cssClass: 'apexcharts-yaxis-title'
          }
        }
      }

      var OngoingChar = {
        chart: {
          id: 'Ongoing',
          type: 'area',
          height: 160,
          sparkline: {
            enabled: true
          },
        },
        stroke: {
          curve: 'straight'
        },
        fill: {
          opacity: 1,
        },
        series: [{
          name: 'Ongoing',
          data: randomizeArray(sparklineData)
        }],
        labels: [...Array(24).keys()].map(n => `2018-09-0${n+1}`),
        yaxis: {
          min: 0
        },
        xaxis: {
          type: 'datetime',
        },
        colors: ['#48C4D3'],
        title: {
          text: '312',
          offsetX: 30,
          style: {
            fontSize: '24px',
            cssClass: 'apexcharts-yaxis-title'
          }
        },
        subtitle: {
          text: 'Ongoing',
          offsetX: 30,
          style: {
            fontSize: '14px',
            cssClass: 'apexcharts-yaxis-title'
          }
        }
      }

      var completedChar = {
        chart: {
          id: 'Completed',
          type: 'area',
          height: 160,
          sparkline: {
            enabled: true
          },
        },
        stroke: {
          curve: 'straight'
        },
        fill: {
          opacity: 1,
        },
        series: [{
          name: 'Completed',
          data: randomizeArray(sparklineData)
        }],
        labels: [...Array(24).keys()].map(n => `2018-09-0${n+1}`),
        xaxis: {
          type: 'datetime',
        },
        yaxis: {
          min: 0
        },
        colors: ['#48C4D3'],
        title: {
          text: '13',
          offsetX: 30,
          style: {
            fontSize: '24px',
            cssClass: 'apexcharts-yaxis-title'
          }
        },
        subtitle: {
          text: 'Completed',
          offsetX: 30,
          style: {
            fontSize: '14px',
            cssClass: 'apexcharts-yaxis-title'
          }
        }
      }
      new ApexCharts(document.querySelector("#Applicant"), applicationChar).render();
      new ApexCharts(document.querySelector("#Ongoing"), OngoingChar).render();
      new ApexCharts(document.querySelector("#Completed"), completedChar).render();
      // initialize datatable
      new DataTable("#handledProject");
    }

    function makeData() {
      var data = [];
      for (var i = 0; i < 10; i++) {
        data.push(Math.floor(Math.random() * 100)); // Generates random numbers between 0 and 99
      }
      console.log(data);
      return data;
    }


    function InitializeviewCooperatorProgress() {
      var options = {
        series: [75],
        chart: {
          height: 250,
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
              strokeWidth: '67%',
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

      var chart = new ApexCharts(document.querySelector("#progressBar"), options);
      chart.render();

      //TODO: Production Generated Chart
      var options = {
        series: [{
          name: 'Growth',
          data: [10, 15, 7, -12]
        }],
        chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            colors: {
              ranges: [{
                from: -100,
                to: -46,
                color: '#F15B46'
              }, {
                from: -45,
                to: 0,
                color: '#FEB019'
              }]
            },
            columnWidth: '80%',
          }
        },
        dataLabels: {
          enabled: false,
        },
        yaxis: {
          title: {
            text: 'Growth',
          },
          labels: {
            formatter: function(y) {
              return y.toFixed(0) + "%";
            }
          }
        },
        xaxis: {
          categories: [
            'Quarter 1', 'Quarter 2', 'Quarter 3', 'Quarter 4'
          ],
          labels: {
            rotate: -90
          }
        }
      };

      var chart = new ApexCharts(document.querySelector("#productionGeneChart"), options);
      chart.render();

      //TODO: Employment Generated Chart

      var options = {
        series: [{
          name: 'Growth',
          data: [2, -2, 4, 5]
        }],
        chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            colors: {
              ranges: [{
                from: -100,
                to: -46,
                color: '#F15B46'
              }, {
                from: -45,
                to: 0,
                color: '#FEB019'
              }]
            },
            columnWidth: '80%',
          }
        },
        dataLabels: {
          enabled: false,
        },
        yaxis: {
          title: {
            text: 'Growth',
          },
          labels: {
            formatter: function(y) {
              return y.toFixed(0) + "%";
            }
          }
        },
        xaxis: {
          categories: [
            'Quarter 1', 'Quarter 2', 'Quarter 3', 'Quarter 4'
          ],
          labels: {
            rotate: -90
          }
        }
      };

      var chart = new ApexCharts(document.querySelector("#employmentGeneChart"), options);
      chart.render();

    }
  </script>

</body>

</html>
