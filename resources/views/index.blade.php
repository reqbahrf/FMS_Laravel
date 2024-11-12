<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DOST-SETUP</title>
    <link rel="icon" href="{{ asset('DOST_ICON.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('icon_css/remixicon.css') }}">
    @vite('resources/css/app.scss')




    <style>


        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wdth,wght,YTLC@0,6..12,75..125,200..1000,440..540;1,6..12,75..125,200..1000,440..540&display=swap');

        :root {
            font-size: clamp(0.75rem, 1vw, 1.5rem);
            font-family: 'Nunito', sans-serif;
        }

        body,
        button,
        input,
        textarea,
        select {
            font-family: 'Nunito', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 700;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-x: hidden;
        }

        /*--------------------------------------------------------------
    # Hero Section
    --------------------------------------------------------------*/
        #hero {
            width: 100%;
            height: 100vh;
            background-image: url({{ 'herobackground.svg' }});
            background-size: cover;
            background-position: center;
            position: relative;
            padding: 0;
            z-index: 1;
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
            font-size: 0.8125rem;
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
            padding: 60px 0 30px 0;
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

        .what-we-do .icon-box h6 {
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 20px;
        }

        .what-we-do .icon-box h6 a {
            color: #384046;
            text-decoration: none;
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

        .paragraph-content {
            text-align: justify;
        }

        .imgs-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .img-box img {
            width: 100px;
            height: 500px;
            margin: 10px;
            border-radius: 50px;
            filter: brightness(0.8);
            object-fit: cover;
            background-position: center;
            transition: width 0.5s;
        }

        .imgbox-logo {
            position: absolute;
            bottom: 1%;
            left: 50%;
            transform: translateX(0);
            transition: left 0.5s linear;

        }

        .imgbox-logo svg {
            background-color: #fff;
            border: 3px solid #3498db;
            border-radius: 50%;
        }

        .imgbox-logo span {
            font-size: 0px;
            font-weight: 0;
            margin-left: 30px;
            opacity: 0;
            color: #fff;
            display: linear;
            transition: font-size 1s, font-weight 1s, opacity 1s linear;
        }

        .imgbox-text {
            display: none;
            text-align: justify;
            color: #fff;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 1);
            position: absolute;
            opacity: 0;
            top: 0;
            left: 0;
            transform: translateX(0%);
            transform: translateY(0%);
            transition: left 0.5s linear;
        }

        .Values-list li::first-letter {
            font-weight: bold;
        }

        .secondary-info-text {
            font-size: 11px;
            font-weight: lighter;
        }

        .sub-list {
            list-style-type: lower-alpha;
        }


        /* .img-box img:hover {
            width: 400px;
        }

        .img-box img:hover+.imgbox-logo {
            position: absolute;
            left: 0%;
            transform: translateX(0%);
        }

        .img-box img:hover+.imgbox-logo span {
            font-size: 30px;
            font-weight: 700;
            opacity: 1;
        }

        .img-box img:hover+.imgbox-logo div.imgbox-text {
            top: -600%;
            height: 100%;
            width: 350px;
            transform: translateX(-50%);
            transform: translateY(-350%);
            opacity: 1;
        } */
    </style>
</head>

<body>
    <x-header />
    <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
        <div class="container text-center text-md-left" data-aos="fade-up">
            <h1>Welcome to <span>SETUP</span></h1>
            <h2>We provide fund assistance to Micro, Small, Medium Businesses</h2>
            <a href="{{ route('registerpage.signup') }}" class="btn-apply scrollto">Apply Now</a>
        </div>
    </section>
    <section id="what-we-do" class="what-we-do">
        <div class="container">
            <div class="section-title">
                <h2>What We Do</h2>
                <p> DOST Small Enterprise Technology Upgrading Program (SETUP), we're a government agency dedicated
                    to supporting qualified businesses and sectors. We provide technical and financial assistance to
                    help them thrive. To ensure our programs are effective, we closely monitor all the assistance we
                    offer. We create progress reports for each business, allowing us to gauge the impact of our
                    support. As part of the government, we prioritize maintaining strong relationships with our
                    stakeholders.</p>
            </div>
            <div class="row mb-3">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="icon-box">
                        <div class="icon">
                            <svg width="64px" height="64px" viewBox="-16 -16 96.00 96.00"
                                data-name="Layer 1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)">
                                    <rect x="-16" y="-16" width="96.00" height="96.00" rx="48" fill="#7ed0ec"
                                        strokewidth="0"></rect>
                                </g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <defs>
                                        <style>
                                            .cls-1 {
                                                fill: #ba9bc9;
                                            }

                                            .cls-2 {
                                                fill: #f4ecce;
                                            }

                                            .cls-3 {
                                                fill: #838bc5;
                                            }

                                            .cls-4 {
                                                fill: #8f6c56;
                                            }

                                            .cls-5 {
                                                fill: #65c8d0;
                                            }
                                        </style>
                                    </defs>
                                    <path class="cls-1" d="M47,36a15,15,0,0,1-30,0"></path>
                                    <path class="cls-2" d="M42,36a10,10,0,0,1-20,0"></path>
                                    <rect class="cls-2" height="4" width="6" x="23" y="1"></rect>
                                    <rect class="cls-1" height="14" width="17" x="5" y="21"></rect>
                                    <polygon class="cls-3"
                                        points="30 19 30 20 29 5 23 5 21 35 30 35 31 35 58 35 58 19 30 19"></polygon>
                                    <polyline class="cls-4" points="41 15 42 5 46 5 47 15"></polyline>
                                    <polyline class="cls-4" points="50 15 51 5 55 5 56 15"></polyline>
                                    <polyline class="cls-4" points="32 15 33 5 37 5 38 15"></polyline>
                                    <rect class="cls-1" height="6" rx="3" width="30" x="29" y="15">
                                    </rect>
                                    <rect class="cls-4" height="2" width="60" x="2" y="34"></rect>
                                    <polyline class="cls-4" points="7 21 8 11 12 11 13 21"></polyline>
                                    <rect class="cls-2" height="6" width="4" x="34" y="25"></rect>
                                    <rect class="cls-2" height="6" width="4" x="50" y="25"></rect>
                                    <rect class="cls-2" height="6" width="4" x="42" y="25"></rect>
                                    <rect class="cls-2" height="2" width="2" x="8" y="24"></rect>
                                    <rect class="cls-2" height="2" width="2" x="12" y="24"></rect>
                                    <rect class="cls-2" height="2" width="2" x="16" y="24"></rect>
                                    <rect class="cls-2" height="2" width="2" x="8" y="28"></rect>
                                    <rect class="cls-2" height="2" width="2" x="12" y="28"></rect>
                                    <rect class="cls-2" height="2" width="2" x="16" y="28"></rect>
                                    <circle class="cls-5" cx="32" cy="60" r="2"></circle>
                                    <circle class="cls-5" cx="60" cy="60" r="2"></circle>
                                    <circle class="cls-5" cx="56" cy="52" r="2"></circle>
                                    <circle class="cls-5" cx="60" cy="44" r="2"></circle>
                                    <circle class="cls-5" cx="4" cy="60" r="2"></circle>
                                    <circle class="cls-5" cx="8" cy="52" r="2"></circle>
                                    <circle class="cls-5" cx="4" cy="44" r="2"></circle>
                                    <path class="cls-3"
                                        d="M60,57a3,3,0,0,0-2.82,2H47V55a1,1,0,0,0-.88-1L39,53.12V50.37a15.94,15.94,0,0,0,3.78-2.59L43,49.16A1,1,0,0,0,44,50h2.59l2.7,2.71A1,1,0,0,0,50,53h3.18a3,3,0,1,0,0-2H50.41l-2.7-2.71A1,1,0,0,0,47,48H44.85l-.34-2.06A16.18,16.18,0,0,0,46.82,42h3.46l.77,2.32A1,1,0,0,0,52,45h5.18a3,3,0,1,0,0-2H52.72L52,40.68A1,1,0,0,0,51,40H47.47A15.56,15.56,0,0,0,48,36H46a14,14,0,0,1-28,0H16a15.56,15.56,0,0,0,.53,4H13a1,1,0,0,0-.95.68L11.28,43H6.82a3,3,0,1,0,0,2H12a1,1,0,0,0,.95-.68L13.72,42h3.46a15.93,15.93,0,0,0,2.31,4l-.34,2H17a1,1,0,0,0-.71.29L13.59,51H10.82a3,3,0,1,0,0,2H14a1,1,0,0,0,.71-.29L17.41,50H20a1,1,0,0,0,1-.84l.22-1.38A15.91,15.91,0,0,0,25,50.37v2.75L17.88,54A1,1,0,0,0,17,55v4H6.82a3,3,0,1,0,0,2H18a1,1,0,0,0,1-1V55.88L26.12,55A1,1,0,0,0,27,54V51.19A16,16,0,0,0,31,52v5.23a3,3,0,1,0,2,0V52a16,16,0,0,0,4-.76V54a1,1,0,0,0,.88,1l7.12.89V60a1,1,0,0,0,1,1H57.18A3,3,0,1,0,60,57Zm-4-6a1,1,0,1,1-1,1A1,1,0,0,1,56,51Zm4-8a1,1,0,1,1-1,1A1,1,0,0,1,60,43ZM4,45a1,1,0,1,1,1-1A1,1,0,0,1,4,45Zm4,8a1,1,0,1,1,1-1A1,1,0,0,1,8,53ZM4,61a1,1,0,1,1,1-1A1,1,0,0,1,4,61Zm28,0a1,1,0,1,1,1-1A1,1,0,0,1,32,61Zm28,0a1,1,0,1,1,1-1A1,1,0,0,1,60,61Z">
                                    </path>
                                </g>
                            </svg></div>
                        <h6><a href="">Enhances business through technology.</a></h6>
                        <p>DOST-SETUP helps businesses incorporate modern technology for better operations.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                    <div class="icon-box">
                        <div class="icon"><svg width="64px" height="64px" viewBox="-10 -10 120.00 120.00"
                                xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0">
                                    <rect x="-10" y="-10" width="120.00" height="120.00" rx="60"
                                        fill="#7ed0ec" strokewidth="0"></rect>
                                </g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#24AE5F"
                                        d="M23.25 79L0 67V32.656L51.75 7 75 19v34.5L23.25 79z"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#1E9450"
                                        d="M0 64.554v2.983l23.193 11.932 51.622-25.356V51.13L23.193 76.486 0 64.554zm0-5.22v2.983l23.193 11.932 51.622-25.355V45.91L23.193 71.266 0 59.334zm0-10.441v2.983l23.193 11.932 51.622-25.355V35.47L23.193 60.825 0 48.893zm0 5.22v2.983l23.193 11.932 51.622-25.356v-2.983L23.193 66.046 0 54.113zm0-10.44v2.983l23.193 11.932 51.622-25.356V30.25L23.193 55.605 0 43.673zm23.251 1.462L0 33.084v3.013l23.251 12.05L75.003 22.54v-3.013L23.251 45.135zM0 38.453v2.983l23.251 11.932 51.752-25.356v-2.983L23.251 50.385 0 38.453z">
                                    </path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#24AE5F"
                                        d="M48.133 91.884L24.998 79.951V50.647l51.495-25.355L100 37.299v29L48.133 91.884z">
                                    </path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#1E9450"
                                        d="M25 77.085v2.983L48.25 92 100 66.644v-2.983L48.25 89.017 25 77.085zm0-5.22v2.983L48.25 86.78 100 61.424v-2.983L48.25 83.796 25 71.865zm0-10.441v2.983l23.25 11.932L100 50.983V48L48.25 73.356 25 61.424zm0 5.22v2.983L48.25 81.56 100 56.204v-2.983L48.25 78.576 25 66.644zm0-10.44v2.983l23.25 11.932L100 45.763V42.78L48.25 68.136 25 56.204zm23.25 6.367L25 50.64v2.983l23.25 11.932L100 40.199v-2.983L48.25 62.571z">
                                    </path>
                                    <path opacity=".1"
                                        d="M23.193 45.165L0 33.25v34.344L23.25 79.5l-.057-34.335zm25 17.435L25 50.685v29.292l23.25 11.906-.057-29.283z">
                                    </path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#1E9450"
                                        d="M59.996 50.609l-11.363 5.459-9.702-5.22 13.138-6.436s-.912-2.62-.354-3.019c-.01.047-19.386 9.692-19.386 9.692l16.583 8.291 17.048-8.523s-1.669.055-3.148-.006c-1.502-.06-2.816-.238-2.816-.238zm13.446-3.496L93.5 37.5l-16.299-8.849-17.032 8.515c2.582-.133 4.697.978 4.697.978l12.126-5.94 10.448 5.221-13.99 6.72-.008 2.968z">
                                    </path>
                                    <path fill="#1E9450"
                                        d="M64.235 46.958a5.58 5.58 0 0 0 1.99-.302l-3.529-1.87-.3.078-.384.123c-.523.157-1.059.302-1.61.433-.551.131-1.111.213-1.68.246s-1.137-.001-1.702-.101a5.753 5.753 0 0 1-1.693-.597c-.574-.304-.973-.63-1.196-.977-.223-.348-.306-.694-.25-1.04.056-.346.236-.686.538-1.019a5.136 5.136 0 0 1 1.151-.924l-1.3-.689.981-.52 1.3.689a11.139 11.139 0 0 1 1.734-.57 9.4 9.4 0 0 1 1.831-.255 8.713 8.713 0 0 1 1.887.137 7.553 7.553 0 0 1 1.886.612l-2.361 1.251a3.822 3.822 0 0 0-1.564-.389c-.581-.026-1.06.061-1.437.261l2.989 1.584.509-.162.559-.171c1.045-.315 1.956-.502 2.731-.562.775-.058 1.449-.048 2.02.031.571.08 1.056.205 1.455.374.399.171.74.331 1.021.48.248.131.499.329.754.594.255.265.405.576.449.934.045.358-.059.753-.309 1.184-.251.431-.764.882-1.538 1.353l1.435.761-.981.52-1.435-.761c-1.332.61-2.69.918-4.075.924-1.385.007-2.797-.313-4.237-.959l2.344-1.242a4.315 4.315 0 0 0 2.017.541zm3.45-1.229c.143-.153.233-.311.27-.474a.693.693 0 0 0-.074-.489c-.086-.163-.264-.316-.535-.459a2.616 2.616 0 0 0-1.395-.308c-.491.028-1.154.167-1.988.418l3.242 1.718a2.6 2.6 0 0 0 .48-.406zM57.08 42.391a.76.76 0 0 0-.22.394.545.545 0 0 0 .098.413c.091.137.255.268.492.393.372.197.775.288 1.21.272.435-.016.981-.133 1.637-.349l-2.753-1.458a1.841 1.841 0 0 0-.464.335z">
                                    </path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#1E9450"
                                        d="M34.583 32.609L23.22 38.068l-9.702-5.22 13.138-6.436s-.913-2.62-.354-3.019c-.01.047-19.386 9.692-19.386 9.692l16.583 8.291 17.048-8.523s-1.669.055-3.148-.006c-1.502-.06-2.816-.238-2.816-.238zm13.446-3.496L68.087 19.5l-16.299-8.849-17.032 8.515c2.582-.133 4.697.978 4.697.978l12.126-5.94 10.448 5.221-13.989 6.72-.009 2.968z">
                                    </path>
                                    <path fill="#1E9450"
                                        d="M38.822 28.958a5.558 5.558 0 0 0 1.99-.302l-3.53-1.87-.3.078-.384.123a28.85 28.85 0 0 1-1.61.433c-.551.131-1.111.213-1.68.246s-1.136-.001-1.702-.101a5.753 5.753 0 0 1-1.693-.597c-.574-.304-.973-.63-1.196-.977-.223-.348-.306-.694-.25-1.04.057-.346.236-.685.538-1.018a5.136 5.136 0 0 1 1.151-.924l-1.3-.689.981-.52 1.3.689a11.139 11.139 0 0 1 1.734-.57 9.4 9.4 0 0 1 1.831-.255 8.713 8.713 0 0 1 1.887.137 7.553 7.553 0 0 1 1.886.612l-2.361 1.251a3.822 3.822 0 0 0-1.564-.389c-.581-.026-1.06.061-1.437.261l2.989 1.584.509-.163.559-.171c1.045-.315 1.956-.502 2.731-.562.775-.059 1.449-.048 2.02.031.571.08 1.056.205 1.455.375.399.171.74.331 1.021.48.248.131.499.329.754.594.255.265.405.576.449.934.045.358-.059.753-.309 1.184-.251.431-.764.882-1.538 1.353l1.435.761-.981.52-1.435-.761c-1.332.61-2.69.918-4.075.924-1.385.007-2.797-.313-4.237-.959l2.344-1.242c.63.345 1.303.525 2.018.54zm3.45-1.229c.143-.153.233-.311.269-.474a.693.693 0 0 0-.074-.489c-.086-.163-.264-.316-.535-.46a2.616 2.616 0 0 0-1.395-.308l-1.988.419 3.242 1.718c.178-.117.338-.252.481-.406zm-10.605-3.338a.76.76 0 0 0-.22.394.545.545 0 0 0 .098.413c.092.137.255.268.492.393.372.197.775.288 1.211.272.435-.016.981-.133 1.637-.349l-2.753-1.458a1.83 1.83 0 0 0-.465.335z">
                                    </path>
                                </g>
                            </svg></div>
                        <h6><a href="">Provides technological assistance to MSMEs.</a></h6>
                        <p>The program specifically focuses on assisting micro, small, and medium-sized enterprises.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                    <div class="icon-box">
                        <div class="icon"><svg viewBox="-8.32 -8.32 80.64 80.64" xmlns="http://www.w3.org/2000/svg"
                                fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0">
                                    <rect x="-8.32" y="-8.32" width="80.64" height="80.64" rx="40.32"
                                        fill="#7ed0ec" strokewidth="0"></rect>
                                </g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g fill="none" fill-rule="evenodd">
                                        <rect width="54" height="33" x="5" y="12" fill="#FFAF40"></rect>
                                        <rect width="5" height="10" x="18" y="29" fill="#595959"></rect>
                                        <rect width="5" height="14" x="26" y="25" fill="#595959"></rect>
                                        <rect width="5" height="18" x="34" y="21" fill="#595959"></rect>
                                        <rect width="5" height="21" x="42" y="18" fill="#22BA8E"></rect>
                                        <rect width="60" height="4" x="2" y="8" fill="#BD7575"
                                            rx="2"></rect>
                                        <rect width="60" height="4" x="2" y="45" fill="#BD7575"
                                            rx="2"></rect>
                                        <rect width="4" height="11" x="30" y="49" fill="#9D4C4C"></rect>
                                        <rect width="12" height="4" x="26" y="58" fill="#BD7575"></rect>
                                    </g>
                                </g>
                            </svg></div>
                        <h6><a href="">Boosts productivity and competitiveness.</a></h6>
                        <p>By providing technological solutions, DOST-SETUP aims to increase business output and
                            efficiency.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="section-title">
            <h2>Application Requirements</h2>
        </div>
        <div class="row justify-content-center mx-3">
            <div class="col-12 col-md-6">
                <div class="alert alert-light h-100" role="alert">
                    <h4 class="alert-heading mb-3">Who may Apply?</h4>
                    <ul>
                        <li>
                            <strong>Business Type:</strong><br>
                            Your business must be a small or medium-scale enterprise.
                        </li>
                        <li>
                            <strong>Ownership:</strong><br>
                            The business should be wholly owned by Filipino citizens.
                        </li>
                        <li>
                            <strong>Industry:</strong><br>
                            Your business should fall under one of the identified priority sectors.
                        </li>
                        <li>
                            <strong>Willingness to adopt technology:</strong><br>
                            Your business should be open to incorporating technological improvements into its
                            operations.
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="alert alert-light h-100">
                    <h4 class="alert-header mb-3">What documents are required?</h4>
                    <ol class="">
                        <li>Letter of Intent</li>
                        <li>DTI/SEC/CDA(Certificate of Registration)
                            <span class="secondary-info-text">Department of Trade and Industry(DTI), Securit and
                                Exchange Commission(SEC), and Cooperative Development Authority(CDA)
                            </span>
                        </li>
                        <li>Business Permit</li>
                        <li>BIR(Certificate of Registration)
                            <span class="secondary-info-text">
                                Bureau of Internal Revenue(BIR) Certificate of Registration
                            </span>
                        </li>
                        <li>FDA/LTO(if applicable) </li>
                        <li>Official Receipt of the Business</li>
                        <li>Copy of Government Valid ID</li>
                    </ol>
                    <P class="fw-lighter text-secondary">Below are the List of Required Documents:</P>
                    <div class="accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#follow-up_req" aria-expanded="true"
                                    aria-controls="follow-up_req">
                                    Follow-up Requirements
                                </button>
                            </h2>
                            <div id="follow-up_req" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ol>
                                        <li>
                                            Proponent's Barangay Certification
                                        </li>
                                        <li>
                                            Lease Contract (if applicable)
                                        </li>
                                        <li>
                                            Co-maker’s Government Issued ID
                                        </li>
                                        <li>
                                            Audited Financial Statements for the past three (3) years of the enterprise.
                                            The Audited Financial Report must contain the following statements:
                                            <ul class="sub-list">
                                                <li>
                                                    Statement of Financial Condition

                                                </li>
                                                <li>
                                                    Statement of Financial Position

                                                </li>
                                                <li>
                                                    Statement of Cash Flows

                                                </li>
                                                <li>
                                                    Statement of Changes in Net Assets/Equity

                                                </li>
                                                <li>
                                                    Notes to Financial Statement

                                                </li>

                                            </ul>
                                        </li>
                                        <li>
                                            Omnibus affidavit
                                        </li>
                                        <li>
                                            Quotations for Equipment to be acquired from 3 different suppliers
                                        </li>
                                        <li>
                                            Board resolution authorizing the availment of financial assistance from DOST
                                            XI and designating authorized signatory for the financial assistance.
                                        </li>
                                        <li>
                                            Authenticated copy of the Articles of Incorporation showing original
                                            incorporators/organizers (for corp/coop)
                                        </li>
                                        <li>
                                            Secretary's certificate of incumbent officers (for corp/coop)
                                        </li>
                                        <li>
                                            Certificate of Filing with SEC/Certificate of Approval by CDA (for
                                            corp/coop)
                                        </li>
                                        <li>
                                            Proponent's Biodata
                                        </li>
                                        <li>
                                            37 Landbank Post-Dated Checks
                                        </li>
                                        <li>
                                            Project Proposal
                                        </li>
                                    </ol>

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p class="m-0">
                        <i class="ri-information-2-fill ri-lg"></i> The 7 documents above are required for the
                        Application submission process.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="section-title">
            <h2>What can you get from SETUP</h2>
        </div>
        <div class="row g-3 justify-content-center">
            <div class="col-12 col-md-10">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <h6>
                            Infusion of new/advanced technologies
                        </h6>
                        <p class="paragraph-content">The infusion of new and advanced technologies is crucial for
                            enhancing efficiency and innovation. By adopting cutting-edge tools and systems,
                            organizations can streamline processes, reduce costs, and gain a competitive advantage.
                            Implementing new technologies is essential for driving growth and staying ahead in the
                            market.</p>
                    </div>
                    <div class="col-12 col-md-8 text-center">
                        <img src="{{ asset('sampleProfile/tempImage.jpg') }}" class="object-fit-cover w-75"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-10">
                <div class="row">
                    <div class="col-12 col-md-8">

                    </div>
                    <div class="col-12 col-md-4">
                        <h6>
                            Provision of seed funds for technology acquisition and equipment upgrading.
                        </h6>
                        <p class="paragraph-content">The program provides financial support for acquiring new or
                            upgraded technology and equipment. This includes funding assistance for advanced tools and
                            machinery to improve operations and investments in modern technology to enhance productivity
                            and product quality.</p>
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-10">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <h6>
                            Technical trainings
                        </h6>
                        <p class="paragraph-content">The program offers a comprehensive approach to quality and
                            environmental management, including training in specific technical skills. It covers Hazard
                            Analysis and Critical Control Points (HACCP), Good Manufacturing Practices (GMP), and
                            Quality and Environmental Management Systems (QMS/EMS). Additionally, the program provides
                            training in specialized areas such as machining for furniture, handloom weaving, seaweed
                            culture, and tissue culture production.</p>
                    </div>
                    <div class="col-12 col-md-8">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-10">
                <div class="row">
                    <div class="col-12 col-md-8">

                    </div>
                    <div class="col-12 col-md-4">
                        <h6>
                            Technical Advisory and Consultancy Services
                        </h6>
                        <p class="paragraph-content">The program focuses on enhancing food safety, resource efficiency,
                            and cleaner production practices. It offers manufacturing, productivity, and extension
                            programs, along with consultancy services for agricultural and manufacturing productivity
                            improvement. The program also emphasizes product and process standardization, productivity
                            improvement, and energy conservation and efficiency assessments.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-10">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <h6>
                            Design of functional packages and labels
                        </h6>
                        <p class="paragraph-content">The program focuses on designing visually appealing and practical
                            packaging solutions, developing clear and informative product labels, and creating packaging
                            that protects the product while enhancing its presentation.</p>
                    </div>
                    <div class="col-12 col-md-8">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-10">
                <div class="row">
                    <div class="col-12 col-md-8">
                    </div>
                    <div class="col-12 col-md-4">
                        <h6>
                            Support in the establishment of product standard including testing and calibration
                        </h6>
                        <p class="paragraph-content">The program provides assistance in developing product
                            specifications and quality criteria. It also conducts product testing and evaluation to
                            ensure compliance with standards and offers calibration services for measurement equipment
                            to maintain accuracy.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="img-section">
        <div class="section-title">
            <h2>Priority Sectors</h2>
        </div>
        <div class="imgs-container">
            <div class="img-box position-relative">
                <img src="{{ asset('sectors/primarySector.jpg') }}" class=" " alt="...">

                <div class="imgbox-logo">
                    <span class="logo-text">Primary Sector</span>
                    <div class="imgbox-text">
                        <strong>Agriculture, Forestry, and Fishing:</strong> This sector involves the extraction of raw
                        materials from the natural environment. It includes:
                        <ul>
                            <li>Crop and animal production</li>
                            <li>Forestry and logging</li>
                            <li>Fishing and aquaculture</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="img-box position-relative">
                <img src="{{ asset('sectors/secondarySector.jpg') }}" class=" " alt="...">
                <div class="imgbox-logo">
                    <span class="logo-text">Secondary Sector</span>
                    <div class="imgbox-text">
                        <strong>Manufacturing:</strong> This sector involves the processing of raw materials into
                        finished goods. It includes:
                        <ul>
                            <li>Food processing</li>
                            <li>Fabricated metal products manufacturing</li>
                            <li>Non-metallic mineral products manufacturing</li>
                            <li>Machinery and equipment manufacturing</li>
                            <li>Leather and related products manufacturing</li>
                            <li>Furniture manufacturing</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="img-box position-relative">
                <img src="{{ asset('sectors/TertiarySector.jpg') }}" alt="">
                <div class="imgbox-logo">
                    <span class="logo-text">Tertiary Sector</span>
                    <div class="imgbox-text">
                        <strong>Services:</strong> This sector involves providing services to individuals and
                        businesses. While the provided list primarily focuses on manufacturing, it also include:
                        <ul>
                            <li>Information and Communication</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 pt-4 pt-lg-0">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <strong>VISION</strong>
                                </div>
                                <div class="card-body">
                                    <p class="paragraph-content">
                                        An agile and proactive organization with mastery in providing excellent
                                        public service through Science, Engineering, Technology and Innovation
                                        (SETI) for inclusive and sustainable development of Mindanao by 2025.
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <strong>MISSION</strong>

                                </div>
                                <div class="card-body">
                                    <p class="paragraph-content">
                                        To inspire and transform communities through Science,
                                        Engineering, Technology and Innovation (SETI).
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <strong>VALUES</strong>
                                </div>
                                <div class="card-body">
                                    <ul class="Values-list">
                                        <li>
                                            Relevance
                                        </li>
                                        <li>
                                            Excellence
                                        </li>
                                        <li>
                                            Cooperation
                                        </li>
                                        <li>
                                            Integrity
                                        </li>
                                        <li>
                                            Professionalism
                                        </li>
                                        <li>
                                            Effectiveness (Cost)
                                        </li>
                                        <li>
                                            Service Innovation
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-footer />
    @vite('resources/js/app.js')
    @if (session('error') || session('success'))
        <div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer" style="z-index: 1100;">
            <div id="emailNofiToast" class="toast align-items-center" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="toast-header {{ session('error') ? 'text-bg-danger' : 'text-bg-success' }}">
                    <strong class="me-auto">{{ session('error') ? 'Error' : 'Success' }}</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
                <div class="toast-body" id="successToastBody">
                    {{ session('error') ? session('error') : session('success') }}
                </div>
            </div>
        </div>
    @endif
    @if (session('error') || session('success'))
        <script type="module">
            $(document).ready(function() {
                setTimeout(() => {
                    const toastElement = document.getElementById('emailNofiToast');
                    const toast = new bootstrap.Toast(toastElement);
                    toast.show();
                }, 500);
            });
        </script>
    @endif
   
    <script type="module">
        $(document).ready(function() {
            let previousScrollPosition = 0;
            let scrollPosition = 0;
            let isScrolling = false;
            let scrollTimeout = null;

            $('body').on('scroll', function() {
                scrollPosition = $(this).scrollTop();
                if (scrollPosition !== previousScrollPosition) {

                    previousScrollPosition = scrollPosition;
                    isScrolling = true;
                    clearTimeout(scrollTimeout);
                    scrollTimeout = setTimeout(function() {
                        isScrolling = false;

                        $('.header-cont').addClass('show').removeClass('hide');
                    }, 400); // adjust the timeout value as needed
                }
                if (scrollPosition && isScrolling) {
                    $('.header-cont').addClass('hide').removeClass('show');
                }
            });
        });
        $(document).ready(function() {
            let currentIndex = 0;
            const imgBoxes = $(".img-box");
            const totalImgBoxes = imgBoxes.length;

            function applyEffect(index) {
                const imgBox = imgBoxes.eq(index);
                const img = imgBox.find("img");
                const logo = imgBox.find(".imgbox-logo");
                const logoText = logo.find("span");
                const imgBoxText = logo.find(".imgbox-text");

                img.css("width", "400px");
                logo.css("left", "0%");
                logoText.css({
                    "font-size": "30px",
                    "font-weight": "700",
                    "opacity": "1"
                });
                imgBoxText.css({
                    "display": "block",
                    "top": "-600%",
                    "height": "100%",
                    "width": "350px",
                    "transform": "translateX(10%) translateY(-350%)",
                    "opacity": "1"
                });

                setTimeout(function() {
                    resetEffect(index);
                    currentIndex = (currentIndex + 1) % totalImgBoxes;
                    applyEffect(currentIndex);
                }, 3000);
            }

            function resetEffect(index) {
                const imgBox = imgBoxes.eq(index);
                const img = imgBox.find("img");
                const logo = imgBox.find(".imgbox-logo");
                const logoText = logo.find("span");
                const imgBoxText = logo.find(".imgbox-text");

                img.css("width", "100px");
                logo.css("left", "50%");
                logoText.css({
                    "font-size": "0px",
                    "font-weight": "0",
                    "opacity": "0"
                });
                imgBoxText.css({
                    "display": "none",
                    "top": "0",
                    "height": "0",
                    "width": "0",
                    "transform": "translateX(0%) translateY(0%)",
                    "opacity": "0"
                });
            }

            applyEffect(currentIndex);

            $('#confirmModal .btn-primary').click(function() {
                window.location.href = '/'; // Redirect after confirmation
            });
        });
    </script>
</body>

</html>
