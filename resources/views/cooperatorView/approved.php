<?php 
$session_expiration = 3600;

// Check if the session is not active
if (session_status() == PHP_SESSION_NONE) {
    session_set_cookie_params($session_expiration);
    session_start();
}
?>
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
        <button class="btn position-relative">
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
  <div class=" flex-container d-flex flex-column flex-md-row mobileView">
    <div class="overflow-y-auto">
      <?php include("navCooperator.php"); ?>
    </div>
    <main class="main-column scrollable-main" id="main-content">
    </main>
  </div>
</body>
<script>
  $(document).ready(function() {
    loadPage('/my/CooperatorInformationTab.php', 'InformationTab');
  });

  function loadPage(url, activeLink) {
    $.ajax({
      url: url,
      type: 'GET',
      success: function(response) {
        $('#main-content').html(response);
        setActiveLink(activeLink);
        if (url === '/my/CooperatorInformationTab.php') {
          initializeStackedChartPer();
          initializeProgressPer();
        }
      },
      error: function(error) {
        console.log('Error: ' + error);
      },
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