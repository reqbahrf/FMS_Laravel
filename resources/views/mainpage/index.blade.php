
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DOST-SETUP</title>
  <link rel="icon" href="{{ asset('DOST_ICON.svg') }}" type="image/svg+xml">
  <link rel="stylesheet" href="{{ asset('build/assets/app-DGUx_62c.css') }}">
  <script src="{{ asset('build/assets/app-DBkvPR3S.js') }}"></script>


  <style>
    /*--------------------------------------------------------------
    # Hero Section
    --------------------------------------------------------------*/
    body {
      position: relative;
      z-index: -2;
    }

    #hero {
      width: 100%;
      height: 90vh;
      background-image: url({{ 'herobackground.svg' }});
      background-size: cover;
      background-position: center;
      position: relative;
      padding: 0;
      z-index: -1;
    }

    #hero:before {
      content: "";
      background: rgba(56, 64, 70, 0.7);
      position: absolute;
      bottom: 0;
      top: 0;
      left: 0;
      right: 0;
    }

    #hero .container {
      position: relative;
      z-index: 2 !important;
    }

    #hero h1 {
      margin: 0 0 10px 0;
      font-size: 48px;
      font-weight: 700;
      line-height: 56px;
      color: #fff;
    }

    #hero h1 span {
      border-bottom: 4px solid #3498db;
    }

    #hero h2 {
      color: rgba(255, 255, 255, 0.8);
      margin-bottom: 30px;
      font-size: 24px;
    }

    #hero .btn-apply {
      font-family: "Poppins", sans-serif;
      font-weight: 700;
      font-size: 13px;
      letter-spacing: 2px;
      display: inline-block;
      padding: 12px 28px;
      border-radius: 4px;
      transition: ease-in-out 0.3s;
      color: #fff;
      background: #318791;
      text-transform: uppercase;
      text-decoration: none;
      position: relative;
      z-index: 2 !important;
      box-shadow: 1px 10px 10px rgba(0, 0, 0, 0.5);
    }

    #hero .btn-apply:hover {
      background: #48C4D3;
    }

    @media (max-width: 992px) {
      #hero {
        height: calc(100vh - 70px);
      }
    }

    @media (max-width: 768px) {
      #hero h1 {
        font-size: 30px;
        line-height: 36px;
      }

      #hero h2 {
        font-size: 18px;
        line-height: 24px;
        margin-bottom: 30px;
      }
    }


    /*--------------------------------------------------------------
    # Sections General
    --------------------------------------------------------------*/
    section {
      padding: 60px 0;
    }

    .section-bg {
      background-color: #f7fbfe;
    }

    .section-title {
      text-align: center;
      padding-bottom: 30px;
    }

    .section-title h2 {
      font-size: 32px;
      font-weight: 600;
      margin-bottom: 20px;
      padding-bottom: 20px;
      position: relative;
    }

    .section-title h2::before {
      content: "";
      position: absolute;
      display: block;
      width: 120px;
      height: 1px;
      background: #ddd;
      bottom: 1px;
      left: calc(50% - 60px);
    }

    .section-title h2::after {
      content: "";
      position: absolute;
      display: block;
      width: 40px;
      height: 3px;
      background: #3498db;
      bottom: 0;
      left: calc(50% - 20px);
    }

    .section-title p {
      margin-bottom: 0;
    }

    .what-we-do .icon-box {
      text-align: center;
      padding: 30px 20px;
      transition: all ease-in-out 0.3s;
      background: #fff;
    }

    .what-we-do .icon-box .icon {
      margin: 0 auto;
      width: 64px;
      height: 64px;
      background: #eaf4fb;
      border-radius: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
      transition: ease-in-out 0.3s;
    }

    .what-we-do .icon-box .icon i {
      color: #3498db;
      font-size: 28px;
    }

    .what-we-do .icon-box h4 {
      font-weight: 700;
      margin-bottom: 15px;
      font-size: 24px;
    }

    .what-we-do .icon-box h4 a {
      color: #384046;
      transition: ease-in-out 0.3s;
    }

    .what-we-do .icon-box p {
      line-height: 24px;
      font-size: 14px;
      margin-bottom: 0;
    }

    .what-we-do .icon-box:hover {
      border-color: #fff;
      box-shadow: 0px 0 25px 0 rgba(0, 0, 0, 0.1);
    }

    .what-we-do .icon-box:hover h4 a,
    .what-we-do .icon-box:hover .icon i {
      color: #3498db;
    }

    .about {
      padding: 10px 0;
    }

    .about h3 {
      font-weight: 600;
      font-size: 32px;
    }

    .about ul {
      list-style: none;
      padding: 0;
      font-size: 15px;
    }

    .about ul li+li {
      margin-top: 10px;
    }

    .about ul li {
      position: relative;
      padding-left: 26px;
    }

    .about ul i {
      position: absolute;
      left: 0;
      top: 0;
      font-size: 22px;
      color: #3498db;
    }

    .text-justify {
      text-align: justify;
    }
  </style>
</head>

<body>

      @include('mainpage.header')

  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="container text-center text-md-left" data-aos="fade-up">
      <h1>Welcome to <span>SETUP</span></h1>
      <h2>We provide fund assistance to any Micro, Small, Medium Businesses</h2>
      <a href="{{ route('registerpage.signup') }}" class="btn-apply scrollto">Apply Now</a>
    </div>
  </section>
  <section id="what-we-do" class="what-we-do">
    <div class="container">

      <div class="section-title">
        <h2>What We Do</h2>
        <p>Magnam dolores commodi suscipit consequatur ex aliquid</p>
      </div>

      <div class="row">
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
          <div class="icon-box">
            <div class="icon"><i class="bx bxl-dribbble"></i></div>
            <h4><a href="">Lorem Ipsum</a></h4>
            <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
          <div class="icon-box">
            <div class="icon"><i class="bx bx-file"></i></div>
            <h4><a href="">Sed ut perspiciatis</a></h4>
            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
          <div class="icon-box">
            <div class="icon"><i class="bx bx-tachometer"></i></div>
            <h4><a href="">Magni Dolores</a></h4>
            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="about" class="about">
    <div class="container">
      <div class="row">
        <!-- <div class="col-lg-6">
          <img src="" class="img-fluid" alt="">
        </div> -->
        <div class="col-lg-12 pt-4 pt-lg-0">
          <h3>About Us</h3>
          <p class="text-justify m-2">
            DOST Small Enterprise Technology Upgrading Program (SETUP), we're a government agency dedicated to supporting qualified businesses and sectors. We provide technical and financial assistance to help them thrive. To ensure our programs are effective, we closely monitor all the assistance we offer. We create progress reports for each business, allowing us to gauge the impact of our support. As part of the government, we prioritize maintaining strong relationships with our stakeholders. This commitment is reflected in our core values: our mandate, vision, and mission, which you'll find below.
          </p>
          <div class="row">
            <div class="col-md-6">
              <h4>Vision</h4>
              <p class="text-center">DOST XI envisions an agile and proactive organization with performance excellence in providing public service through Science, Engineering, Technology, and Innovation (SETI) for inclusive and sustainable development of the Philippines by 2025.
                The vision of DOST is to ensure the performance excellence in providing public service through SETI, which means that all their stakeholders who want to seek help for their assistance will be assisted by the DOST to ensure and provide good quality of services of the specific organization. This will be both beneficial to the organization as well as to their stakeholders.
              </p>
            </div>
            <div class="col-md-6 mt-4 mt-md-0">
              <h4>Mission</h4>
              <p class="text-center">To inspire and transform communities through Science, Engineering, Technology, and Innovation (SETI).
                The mission of the DOST is to assist sectors to upgrade their process in providing services through the use of technology. To easily provide an output or product that will be beneficial to the country.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @include('mainpage.footer')
</body>

</html>
