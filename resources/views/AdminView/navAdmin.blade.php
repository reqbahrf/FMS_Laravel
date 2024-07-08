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
      height: calc(100vh - 80px);
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
      <a href="#" id="dashboardLink" onclick="loadPage('{{ route('admin.Dashboard') }}', 'dashboardLink');" class="mb-2 d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="30" height="30">
          <path d="M26 8 A 3 3 0 0 0 23.033203 10.574219L17.054688 14.560547L19.273438 17.888672L25.251953 13.902344 A 3 3 0 0 0 26 14 A 3 3 0 0 0 26 8 z M 50 12 A 3 3 0 0 0 47.117188 14.171875L40.957031 18.488281L43.251953 21.761719L48.916016 17.794922 A 3 3 0 0 0 50 18 A 3 3 0 0 0 50 12 z M 30.992188 13.164062L28.164062 15.992188L35.007812 22.835938 A 3 3 0 0 0 38 26 A 3 3 0 0 0 38 20 A 3 3 0 0 0 37.835938 20.007812L30.992188 13.164062 z M 14 16 A 3 3 0 0 0 14 22 A 3 3 0 0 0 14 16 z M 22 27L22 52L18 52L18 35L10 35L10 52L8 52L8 56L56 56L56 52L54 52L54 31L46 31L46 52L42 52L42 39L34 39L34 52L30 52L30 27L22 27 z" fill="#5B5B5B" />
        </svg>
        <span class="nav-text ml-2">Dashboard</span>
      </a>
    </li>
    <li class="nav-item mb-2">
      <a href="#" id="projectList" onclick="loadPage('{{ route('admin.Project') }}', 'projectList');" class="mb-2 d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="30" height="30">
          <path d="M8,8v48h48V8H8z M19,47c-1.657,0-3-1.343-3-3s1.343-3,3-3s3,1.343,3,3S20.657,47,19,47z M19,35c-1.657,0-3-1.343-3-3s1.343-3,3-3s3,1.343,3,3S20.657,35,19,35z M19,23c-1.657,0-3-1.343-3-3s1.343-3,3-3s3,1.343,3,3S20.657,23,19,23z M49,46H28v-4h21V46z M49,34H28v-4h21V34z M49,22H28v-4h21V22z" fill="#5B5B5B" />
        </svg>
        <span class="nav-text ml-2">Project List</span>
      </a>
    </li>
    <li class="nav-item mb-2">
      <a href="#" id="userList" onclick="loadPage('{{ route('admin.Users-list') }}','userList');" class="mb-2 d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="30" height="30">
          <path d="M53,10c-13,0-19-4-19-4h-4c0,0-6,4-19,4l-2,2v20c0,19,23,26,23,26s23-7,23-26V12L53,10z M27,22c0-2.76,2.24-5,5-5s5,2.24,5,5v0.71c0,2.77-2.14,5.72-5,5.72s-5-2.95-5-5.72V22z M32,43c-4.46,0-8.42-2.09-10.98-5.33l0.41-2.12c0.19-0.97,0.89-1.75,1.82-2.07C25.06,32.87,28.3,32,32,32s6.94,0.87,8.75,1.48c0.94,0.32,1.63,1.11,1.82,2.07l0.41,2.11C40.42,40.91,36.46,43,32,43z" fill="#5B5B5B" />
        </svg>
        <span class="nav-text ml-2">Users</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="#">
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
