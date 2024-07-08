<style>
  .navbar-nav {
    width: auto;
    margin: 5px;
    height: -webkit-fill-available;
    padding-left: 10px;
  }

  .color {
    fill: #f1f1f1;
  }

  .sidenav a {
    padding: 6px 8px 6px 6px;
    text-decoration: none;
    font-size: 20px;
    color: #818181;
    display: block;


  }

  .sidenav a:hover {
    filter: grayscale(0%) opacity(1);
    color: white;
  }

  .sidenav a:hover svg path {
    fill: #FFFFFF;
  }

  .hide-text {
    letter-spacing: -10px;
    display: none;
  }

  .rotate-icon {
    transform: rotate(-180deg);
    transition: transform 0.3s ease;
  }

  .my-profile {
    width: 40px;
    height: 40px;
    object-fit: cover;
  }

  @media only screen and (max-width: 600px) {
    nav.sidenav {
      position: fixed;
      bottom: 0;
      width: 100vw;
      height: 3.5rem;
      overflow: hidden;
      background-color: #111;
    }

    li.minimize {
      display: none;
    }

    .navbar-nav {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
    }

    .nav-item a {
      justify-content: center;
    }

    span {
      letter-spacing: -10px;
      display: none;
    }

    nav.sidenav .navbar-nav li {
      flex-grow: 1;
      text-align: center;
    }

    .nav-item a.active svg path {
      fill: #FFFFFF;
    }

    .nav-item a.active {
      color: #FFFFFF;
    }
  }

  /* Large screens */
  @media only screen and (min-width: 600px) {
    nav.sidenav {
      display: inline-flex;
      flex-direction: column;
      justify-content: flex-start;
      height: calc(100vh - 60px);
      width: auto;
      min-width: 4rem;
      max-width: 15rem;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #111;
      overflow-x: hidden;
      overflow-y: hidden;
      padding-top: 20px;
      transition: width 200ms ease;
    }

    .sidenav ul li:last-child {
      margin-top: auto;
    }

    .nav-text {
      width: auto;
    }

    .nav-item a.active {
      color: #000000;
      background-color: #FFFFFF;
      border-top-left-radius: 25px;
      border-bottom-left-radius: 25px;
      border-top-right-radius: 50px;
      border-bottom-right-radius: 50px;
      position: relative;
      filter: opacity(1);

    }

    .nav-item a.active::after {
      content: '';
      position: absolute;
      top: 0;
      right: -25px;
      width: 50px;
      height: 100%;
      background-color: #FFFFFF;
      border-radius: 0 50px 50px 0;
      z-index: -1;
    }

    .nav-item a.active svg path {
      fill: #000000;
    }

  }
</style>

<nav class="sidenav">
  <ul class="navbar-nav">
    <li class="nav-item mb-2 minimize">
      <a href="#" class="mb-2 d-flex align-items-center" onclick="toggleSidebar()">
        <svg id="hover-link" class=" bg-secondary rounded-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="30" height="30">
          <path d="M16.113281 6.2050781L13.064453 8.7949219L31.578125 32.003906L13.0625 55.308594L16.115234 57.892578L37.701172 33.9375L39.451172 31.996094L37.697266 30.056641L16.113281 6.2050781 z M 33.113281 6.2050781L30.064453 8.7949219L48.578125 32.003906L30.0625 55.308594L33.115234 57.892578L54.701172 33.9375L56.451172 31.996094L54.697266 30.056641L33.113281 6.2050781 z" fill="#FFFFFF" />
        </svg>
        <span class="nav-text ml-2">Minimize</span>
      </a>

    </li>
    <li class="nav-item mb-2">

      <a href="#" id="dashboardLink" onclick="loadPage('{{ route('staff.dashboard') }}','dashboardLink');" class="mb-2 d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="30" height="30">
          <path d="M26 8 A 3 3 0 0 0 23.033203 10.574219L17.054688 14.560547L19.273438 17.888672L25.251953 13.902344 A 3 3 0 0 0 26 14 A 3 3 0 0 0 26 8 z M 50 12 A 3 3 0 0 0 47.117188 14.171875L40.957031 18.488281L43.251953 21.761719L48.916016 17.794922 A 3 3 0 0 0 50 18 A 3 3 0 0 0 50 12 z M 30.992188 13.164062L28.164062 15.992188L35.007812 22.835938 A 3 3 0 0 0 38 26 A 3 3 0 0 0 38 20 A 3 3 0 0 0 37.835938 20.007812L30.992188 13.164062 z M 14 16 A 3 3 0 0 0 14 22 A 3 3 0 0 0 14 16 z M 22 27L22 52L18 52L18 35L10 35L10 52L8 52L8 56L56 56L56 52L54 52L54 31L46 31L46 52L42 52L42 39L34 39L34 52L30 52L30 27L22 27 z" fill="#5B5B5B" />
        </svg>
        <span class="nav-text ml-2">Dashboard</span>
      </a>

    </li>
    <li class="nav-item mb-2">

      <a href="#" id="projectLink" onclick="loadPage('{{ route('staff.Project') }}','projectLink');" class="mb-2 d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="30" height="30">
          <path d="M10,7v52h44V7H10z M20,16h24v3H20V16z M20,36h12v3H20V36z M36,48H20v-3h16V48z M36,30H20v-3h16V30z M43.5,49c-1.381,0-2.5-1.119-2.5-2.5c0-1.381,1.119-2.5,2.5-2.5s2.5,1.119,2.5,2.5C46,47.881,44.881,49,43.5,49z M43.5,40c-1.381,0-2.5-1.119-2.5-2.5c0-1.381,1.119-2.5,2.5-2.5s2.5,1.119,2.5,2.5C46,38.881,44.881,40,43.5,40z M43.5,31c-1.381,0-2.5-1.119-2.5-2.5c0-1.381,1.119-2.5,2.5-2.5s2.5,1.119,2.5,2.5C46,29.881,44.881,31,43.5,31z" fill="#5B5B5B" />
        </svg>
        <span class="nav-text ml-2">Projects</span>
      </a>

    </li>
    <li class="nav-item mb-2">

      <a href="#" id="Applicationlink" onclick="loadPage('{{ route('staff.Applicant') }}', 'Applicationlink');" class="mb-2 d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="30" height="30">
          <path d="M32 3C29.951 3 28.193875 4.236 27.421875 6L22 6L22 12C22 13.105 22.895 14 24 14L40 14C41.105 14 42 13.105 42 12L42 6L36.578125 6C35.806125 4.236 34.049 3 32 3 z M 11 6L11 60L53 60L53 6L44 6L44 11L49 11L49 49C49 51 44 51 44 51C44 51 44 56 41 56L15 56L15 11L20 11L20 6L11 6 z M 32 6C33.105 6 34 6.895 34 8C34 9.105 33.105 10 32 10C30.895 10 30 9.105 30 8C30 6.895 30.895 6 32 6 z M 32 18C26.477 18 22 22.477 22 28C22 33.523 26.477 38 32 38C37.523 38 42 33.523 42 28C42 22.477 37.523 18 32 18 z M 32 21C33.45 21 34.625 22.175 34.625 23.625L34.625 24C34.625 25.45 33.5 27 32 27C30.5 27 29.375 25.45 29.375 24L29.375 23.625C29.375 22.175 30.55 21 32 21 z M 32.001953 29C34.022953 29 35.79225 29.476594 36.78125 29.808594C37.29225 29.980594 37.672391 30.411406 37.775391 30.941406L38 32.09375C36.599 33.86775 34.434047 35.009766 31.998047 35.009766C29.563047 35.009766 27.4 33.868703 26 32.095703L26.226562 30.941406C26.330562 30.411406 26.708703 29.980594 27.220703 29.808594C28.209703 29.476594 29.981953 29 32.001953 29 z M 22 41L22 44L42 44L42 41L22 41 z M 24 47L24 50L40 50L40 47L24 47 z" fill="#5B5B5B" />
        </svg>
        <span class="nav-text ml-2">Applicant</span>
      </a>

    </li>
    <li class="nav-item mb-2">

      <a href="#" class="mb-2 d-flex align-items-center">
        <img src="../assets/img/raf,360x360,075,t,fafafa_ca443f4786.jpg" class="rounded-circle border border-1 border-white my-profile">
        <span class="nav-text ps-2">Account</span>
      </a>
    </li>
  </ul>
</nav>

<script>
  function toggleSidebar() {
    //side bar minimize
    var spans = document.querySelectorAll('.sidenav a span');
    spans.forEach(function(span) {
      span.classList.toggle('hide-text');
    });
    //size bar minimize rotation

    var svgIcon = document.getElementById('hover-link');
    svgIcon.classList.toggle('rotate-icon');
  }

  function setActiveLink(activeLink) {
    document.querySelectorAll('.nav-item a').forEach(function(link) {
      link.classList.remove('active');
    });
    var defaultLink = 'dashboardLink';
    var linkToActivate = document.getElementById(activeLink || defaultLink);
    linkToActivate.classList.add('active');
  }
</script>
