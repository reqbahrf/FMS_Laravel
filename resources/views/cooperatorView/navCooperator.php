<?php
$session_expiration = 3600;

// Check if the session is not active
if (session_status() == PHP_SESSION_NONE) {
    session_set_cookie_params($session_expiration);
    session_start();
}
?>
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

  .nav-item a.active svg path {
    fill: #FFFFFF;
  }

  .nav-item a.active {
    color: #FFFFFF;
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

    span.nav-text {
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

  <!-- Modal -->
  <div class="modal fade" id="logoutModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="logoutModalLabel">Account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="d-flex align-items-center">
          <img src="../assets/img/raf,360x360,075,t,fafafa_ca443f4786.jpg" class="rounded-circle border border-1 border-white account" height="150" width="150">
          <h6 class="ms-3">{USER NAME}</h6>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmLogoutModal">Logout</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="confirmLogoutModal" tabindex="-1" aria-labelledby="confirmLogoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmLogoutModalLabel">Confirm Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">cancel</button>
                <button type="button" class="btn btn-danger" onclick="window.location.href='../index.php'">Confirm</button>
            </div>
        </div>
    </div>
</div>
<nav class="sidenav">
  <ul class="navbar-nav">
    <li class="nav-item mb-2 minimize">
      <a href="#" class="mb-2 d-flex align-items-center" onclick="toggleSidebar()">
        <svg id="hover-link" class=" bg-secondary rounded-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="30" height="30">
          <path d="M16.113281 6.2050781L13.064453 8.7949219L31.578125 32.003906L13.0625 55.308594L16.115234 57.892578L37.701172 33.9375L39.451172 31.996094L37.697266 30.056641L16.113281 6.2050781 z M 33.113281 6.2050781L30.064453 8.7949219L48.578125 32.003906L30.0625 55.308594L33.115234 57.892578L54.701172 33.9375L56.451172 31.996094L54.697266 30.056641L33.113281 6.2050781 z" fill="#FFFFFF" />
        </svg>
        <span class="nav-text ml2">Minimize</span>
      </a>
    </li>
    <li class="nav-item mb-2">
      <a href="#" id="InformationTab" onclick="loadPage('/my/CooperatorInformationTab.php','InformationTab');" class="mb-2 d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="30" height="30">
          <path d="M26 8 A 3 3 0 0 0 23.033203 10.574219L17.054688 14.560547L19.273438 17.888672L25.251953 13.902344 A 3 3 0 0 0 26 14 A 3 3 0 0 0 26 8 z M 50 12 A 3 3 0 0 0 47.117188 14.171875L40.957031 18.488281L43.251953 21.761719L48.916016 17.794922 A 3 3 0 0 0 50 18 A 3 3 0 0 0 50 12 z M 30.992188 13.164062L28.164062 15.992188L35.007812 22.835938 A 3 3 0 0 0 38 26 A 3 3 0 0 0 38 20 A 3 3 0 0 0 37.835938 20.007812L30.992188 13.164062 z M 14 16 A 3 3 0 0 0 14 22 A 3 3 0 0 0 14 16 z M 22 27L22 52L18 52L18 35L10 35L10 52L8 52L8 56L56 56L56 52L54 52L54 31L46 31L46 52L42 52L42 39L34 39L34 52L30 52L30 27L22 27 z" fill="#5B5B5B" />
        </svg>
        <span class="nav-text ml-2">Dashboard</span>
      </a>
    </li>
    <li class="nav-item mb-2">
      <a href="#" id="requirementTab" onclick="loadPage('/my/CooperatorRequirement.php','requirementTab');" class="mb-2 d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="30" height="30">
          <path d="M10 2L10 60L31.628906 60C30.971906 58.785 30.934234 57.284203 31.615234 56.033203L31.964844 55.392578C31.852844 55.144578 31.749297 54.893578 31.654297 54.642578L29.378906 53.898438L28 53.447266L28 51.996094L28 49.490234C28 47.663234 29.223609 46.026766 30.974609 45.509766L31.673828 45.302734C31.769828 45.046734 31.873375 44.794828 31.984375 44.548828L30.904297 42.416016L30.248047 41.123047L31.273438 40.097656L33.044922 38.326172C33.829922 37.541172 34.872422 37.109375 35.982422 37.109375C36.673422 37.109375 37.359797 37.285234 37.966797 37.615234L38.609375 37.964844C38.857375 37.852844 39.106422 37.747344 39.357422 37.652344L40.103516 35.376953L40.552734 34L42.003906 34L44.509766 34C46.336766 34 47.973234 35.223609 48.490234 36.974609L48.697266 37.673828C48.953266 37.769828 49.205172 37.873375 49.451172 37.984375L51.583984 36.904297L52.876953 36.248047L53.902344 37.273438L54 37.371094L54 2L10 2 z M 48.939453 6.9394531L51.060547 9.0605469L43 17.121094L37.939453 12.060547L40.060547 9.9394531L43 12.878906L48.939453 6.9394531 z M 16 11L34 11L34 14L16 14L16 11 z M 48.939453 18.939453L51.060547 21.060547L43 29.121094L37.939453 24.060547L40.060547 21.939453L43 24.878906L48.939453 18.939453 z M 16 23L34 23L34 26L16 26L16 23 z M 16 36L27 36L27 39L16 39L16 36 z M 42.003906 36L40.945312 39.232422C40.108312 39.469422 39.315313 39.806703 38.570312 40.220703L37.011719 39.373047C36.173719 38.917047 35.133984 39.067188 34.458984 39.742188L32.6875 41.513672L34.222656 44.542969C33.806656 45.286969 33.482141 46.086828 33.244141 46.923828L31.542969 47.427734C30.628969 47.697734 30 48.537234 30 49.490234L30 51.996094L33.232422 53.054688C33.469422 53.891688 33.806703 54.684687 34.220703 55.429688L33.373047 56.988281C32.917047 57.826281 33.067188 58.866016 33.742188 59.541016L35.513672 61.3125L38.542969 59.777344C39.286969 60.193344 40.087828 60.517859 40.923828 60.755859L41.425781 62.455078C41.696781 63.371078 42.537187 64 43.492188 64L45.996094 64L47.054688 60.767578C47.891688 60.530578 48.684687 60.193297 49.429688 59.779297L50.988281 60.626953C51.826281 61.082953 52.866016 60.932813 53.541016 60.257812L55.3125 58.486328L53.775391 55.457031C54.192391 54.713031 54.515906 53.912172 54.753906 53.076172L56.457031 52.572266C57.372031 52.302266 58 51.461813 58 50.507812L58 48.003906L54.767578 46.945312C54.530578 46.108312 54.193297 45.315313 53.779297 44.570312L54.626953 43.011719C55.082953 42.173719 54.932813 41.133984 54.257812 40.458984L52.486328 38.6875L49.457031 40.222656C48.713031 39.806656 47.913172 39.482141 47.076172 39.244141L46.572266 37.542969C46.302266 36.628969 45.462766 36 44.509766 36L42.003906 36 z M 44 44C47.314 44 50 46.686 50 50C50 53.314 47.314 56 44 56C40.686 56 38 53.314 38 50C38 46.686 40.686 44 44 44 z M 16 49L23 49L23 52L16 52L16 49 z" fill="#5B5B5B" />
        </svg>
        <span class="nav-text ml-2">Requirements</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="mb-2 d-flex align-items-center">
      </a>
    </li>
    <li class="nav-item mb-2">
      <a href="#" class="mb-2 d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#logoutModal">
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
    var defaultLink = 'InformationTab';
    var linkToActivate = document.getElementById(activeLink || defaultLink);
    linkToActivate.classList.add('active');
  }
</script>