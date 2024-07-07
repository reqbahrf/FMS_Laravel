<?php
$session_expiration = 3600;

// Check if the session is not active
if (session_status() == PHP_SESSION_NONE) {
    session_set_cookie_params($session_expiration);
    session_start();
}
?>
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
      justify-content: center;
      align-items: center;
      width: 50%;
      height: calc(100vh - 100px);
    }


  }

  @media (max-width: 768px) {
    .waiting-clock {
      display: flex;
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
</style>

<body class="overflow-hidden">
  <div class="container-fluid px-0 headerlogo z-3">
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
        <h4 class="text-white">DOST-SETUP Funding Monitoring System</h4>
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
  <div class=" flex-container d-flex flex-column flex-md-row mobileView bg-white">
    <main class="main-column overflow-hidden vh-100" id="main-content">
      <div class="d-flex justify-content-center align-items-center m-0">
        <div class="waiting-clock z-3">
          <div class="container d-flex flex-column justify-content-center align-items-center bg-white p-4 shadow rounded-5 ">
            <div>
              <h3>Your Application is still in the process</h3>
            </div>
            <div class="w-auto">
              <!-- SVG content here -->
              <svg xmlns="http://www.w3.org/2000/svg" class="waitingClock" viewBox="0 0 64 64" width="256" height="256">
                <g id="clock" transform="scale(-1, 1) translate(-64, 0)">
                  <path d="M32 6C25.563809 6 19.527204 8.3098104 14.773438 12.533203L11.175781 9.0058594L9.2421875 21.353516L21.550781 19.177734L17.634766 15.337891C21.623806 11.883136 26.650401 10 32 10C44.131 10 54 19.869 54 32C54 44.131 44.131 54 32 54C19.869 54 10 44.131 10 32C10 31.468 10.019641 30.940969 10.056641 30.417969L6.0664062 30.132812C6.0224062 30.749813 6 31.372 6 32C6 46.336 17.664 58 32 58C46.336 58 58 46.336 58 32C58 17.664 46.336 6 32 6 z M 30.5 14L31 18L33 18L33.5 14L30.5 14 z M 14 30.5L14 33.5L18 33L18 31L14 30.5 z M 50 30.5L46 31L46 33L50 33.5L50 30.5 z M 31 46L30.5 50L33.5 50L33 46L31 46 z" fill="#000000" />
                </g>
                <g id="arrow" transform="scale(-1, 1) translate(-64, 0)">
                  <path d="M 44.021484 18.564453L33.25 28.203125 A 4 4 0 0 0 32 28 A 4 4 0 0 0 32 36 A 4 4 0 0 0 32.722656 35.931641L40.816406 42.638672L42.640625 40.816406L35.931641 32.720703 A 4 4 0 0 0 35.796875 30.75L45.435547 19.978516L44.021484 18.564453 z" fill="#000000" />
                </g>
              </svg>
            </div>
            <div class="w-auto">
              <h4>Please Wait for the approval</h4>
            </div>
          </div>

        </div>

      </div>
    </main>
  </div>
</body>