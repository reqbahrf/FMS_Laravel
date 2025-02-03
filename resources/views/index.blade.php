<!DOCTYPE html>
<html
    data-bs-theme="light"
    lang="en"
>

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title>DOST-SETUP</title>
    <link
        type="image/svg+xml"
        href="{{ asset('DOST_ICON.svg') }}"
        rel="icon"
    >
    @vite('resources/css/app.scss')
    @vite('resources/css/indexPage.css')
    <link rel="preload" href="{{ asset('hero.jpg') }}" as="image" fetchpriority="high">
</head>

<body>
    <x-header />
    <section
        class="d-flex flex-column justify-content-center align-items-center"
        id="hero"
        style="background-image: url({{ asset('hero.jpg') }});"
    >
        <div
            class="container text-center text-md-left"
            data-aos="fade-up"
        >
            <h1>Welcome to <span>SETUP</span></h1>
            <h2>We provide fund assistance to Micro, Small, Medium Businesses</h2>
            <a
                class="btn-apply scrollto"
                href="{{ route('registerpage.signup') }}"
            >Apply Now</a>
        </div>
    </section>
    <section
        class="what-we-do"
        id="what-we-do"
    >
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
                            <svg
                                id="Layer_1"
                                data-name="Layer 1"
                                width="64px"
                                height="64px"
                                viewBox="-16 -16 96.00 96.00"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="#000000"
                            >
                                <g
                                    id="SVGRepo_bgCarrier"
                                    stroke-width="0"
                                    transform="translate(0,0), scale(1)"
                                >
                                    <rect
                                        x="-16"
                                        y="-16"
                                        width="96.00"
                                        height="96.00"
                                        rx="48"
                                        fill="#7ed0ec"
                                        strokewidth="0"
                                    ></rect>
                                </g>
                                <g
                                    id="SVGRepo_tracerCarrier"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                ></g>
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
                                    <path
                                        class="cls-1"
                                        d="M47,36a15,15,0,0,1-30,0"
                                    ></path>
                                    <path
                                        class="cls-2"
                                        d="M42,36a10,10,0,0,1-20,0"
                                    ></path>
                                    <rect
                                        class="cls-2"
                                        height="4"
                                        width="6"
                                        x="23"
                                        y="1"
                                    ></rect>
                                    <rect
                                        class="cls-1"
                                        height="14"
                                        width="17"
                                        x="5"
                                        y="21"
                                    ></rect>
                                    <polygon
                                        class="cls-3"
                                        points="30 19 30 20 29 5 23 5 21 35 30 35 31 35 58 35 58 19 30 19"
                                    >
                                    </polygon>
                                    <polyline
                                        class="cls-4"
                                        points="41 15 42 5 46 5 47 15"
                                    ></polyline>
                                    <polyline
                                        class="cls-4"
                                        points="50 15 51 5 55 5 56 15"
                                    ></polyline>
                                    <polyline
                                        class="cls-4"
                                        points="32 15 33 5 37 5 38 15"
                                    ></polyline>
                                    <rect
                                        class="cls-1"
                                        height="6"
                                        rx="3"
                                        width="30"
                                        x="29"
                                        y="15"
                                    >
                                    </rect>
                                    <rect
                                        class="cls-4"
                                        height="2"
                                        width="60"
                                        x="2"
                                        y="34"
                                    ></rect>
                                    <polyline
                                        class="cls-4"
                                        points="7 21 8 11 12 11 13 21"
                                    ></polyline>
                                    <rect
                                        class="cls-2"
                                        height="6"
                                        width="4"
                                        x="34"
                                        y="25"
                                    ></rect>
                                    <rect
                                        class="cls-2"
                                        height="6"
                                        width="4"
                                        x="50"
                                        y="25"
                                    ></rect>
                                    <rect
                                        class="cls-2"
                                        height="6"
                                        width="4"
                                        x="42"
                                        y="25"
                                    ></rect>
                                    <rect
                                        class="cls-2"
                                        height="2"
                                        width="2"
                                        x="8"
                                        y="24"
                                    ></rect>
                                    <rect
                                        class="cls-2"
                                        height="2"
                                        width="2"
                                        x="12"
                                        y="24"
                                    ></rect>
                                    <rect
                                        class="cls-2"
                                        height="2"
                                        width="2"
                                        x="16"
                                        y="24"
                                    ></rect>
                                    <rect
                                        class="cls-2"
                                        height="2"
                                        width="2"
                                        x="8"
                                        y="28"
                                    ></rect>
                                    <rect
                                        class="cls-2"
                                        height="2"
                                        width="2"
                                        x="12"
                                        y="28"
                                    ></rect>
                                    <rect
                                        class="cls-2"
                                        height="2"
                                        width="2"
                                        x="16"
                                        y="28"
                                    ></rect>
                                    <circle
                                        class="cls-5"
                                        cx="32"
                                        cy="60"
                                        r="2"
                                    ></circle>
                                    <circle
                                        class="cls-5"
                                        cx="60"
                                        cy="60"
                                        r="2"
                                    ></circle>
                                    <circle
                                        class="cls-5"
                                        cx="56"
                                        cy="52"
                                        r="2"
                                    ></circle>
                                    <circle
                                        class="cls-5"
                                        cx="60"
                                        cy="44"
                                        r="2"
                                    ></circle>
                                    <circle
                                        class="cls-5"
                                        cx="4"
                                        cy="60"
                                        r="2"
                                    ></circle>
                                    <circle
                                        class="cls-5"
                                        cx="8"
                                        cy="52"
                                        r="2"
                                    ></circle>
                                    <circle
                                        class="cls-5"
                                        cx="4"
                                        cy="44"
                                        r="2"
                                    ></circle>
                                    <path
                                        class="cls-3"
                                        d="M60,57a3,3,0,0,0-2.82,2H47V55a1,1,0,0,0-.88-1L39,53.12V50.37a15.94,15.94,0,0,0,3.78-2.59L43,49.16A1,1,0,0,0,44,50h2.59l2.7,2.71A1,1,0,0,0,50,53h3.18a3,3,0,1,0,0-2H50.41l-2.7-2.71A1,1,0,0,0,47,48H44.85l-.34-2.06A16.18,16.18,0,0,0,46.82,42h3.46l.77,2.32A1,1,0,0,0,52,45h5.18a3,3,0,1,0,0-2H52.72L52,40.68A1,1,0,0,0,51,40H47.47A15.56,15.56,0,0,0,48,36H46a14,14,0,0,1-28,0H16a15.56,15.56,0,0,0,.53,4H13a1,1,0,0,0-.95.68L11.28,43H6.82a3,3,0,1,0,0,2H12a1,1,0,0,0,.95-.68L13.72,42h3.46a15.93,15.93,0,0,0,2.31,4l-.34,2H17a1,1,0,0,0-.71.29L13.59,51H10.82a3,3,0,1,0,0,2H14a1,1,0,0,0,.71-.29L17.41,50H20a1,1,0,0,0,1-.84l.22-1.38A15.91,15.91,0,0,0,25,50.37v2.75L17.88,54A1,1,0,0,0,17,55v4H6.82a3,3,0,1,0,0,2H18a1,1,0,0,0,1-1V55.88L26.12,55A1,1,0,0,0,27,54V51.19A16,16,0,0,0,31,52v5.23a3,3,0,1,0,2,0V52a16,16,0,0,0,4-.76V54a1,1,0,0,0,.88,1l7.12.89V60a1,1,0,0,0,1,1H57.18A3,3,0,1,0,60,57Zm-4-6a1,1,0,1,1-1,1A1,1,0,0,1,56,51Zm4-8a1,1,0,1,1-1,1A1,1,0,0,1,60,43ZM4,45a1,1,0,1,1,1-1A1,1,0,0,1,4,45Zm4,8a1,1,0,1,1,1-1A1,1,0,0,1,8,53ZM4,61a1,1,0,1,1,1-1A1,1,0,0,1,4,61Zm28,0a1,1,0,1,1,1-1A1,1,0,0,1,32,61Zm28,0a1,1,0,1,1,1-1A1,1,0,0,1,60,61Z"
                                    >
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <h6><a href="">Enhances business through technology.</a></h6>
                        <p>DOST-SETUP helps businesses incorporate modern technology for better operations.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                    <div class="icon-box">
                        <div class="icon"><svg
                                width="64px"
                                height="64px"
                                viewBox="-10 -10 120.00 120.00"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="#000000"
                            >
                                <g
                                    id="SVGRepo_bgCarrier"
                                    stroke-width="0"
                                >
                                    <rect
                                        x="-10"
                                        y="-10"
                                        width="120.00"
                                        height="120.00"
                                        rx="60"
                                        fill="#7ed0ec"
                                        strokewidth="0"
                                    ></rect>
                                </g>
                                <g
                                    id="SVGRepo_tracerCarrier"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                ></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        fill="#24AE5F"
                                        d="M23.25 79L0 67V32.656L51.75 7 75 19v34.5L23.25 79z"
                                    ></path>
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        fill="#1E9450"
                                        d="M0 64.554v2.983l23.193 11.932 51.622-25.356V51.13L23.193 76.486 0 64.554zm0-5.22v2.983l23.193 11.932 51.622-25.355V45.91L23.193 71.266 0 59.334zm0-10.441v2.983l23.193 11.932 51.622-25.355V35.47L23.193 60.825 0 48.893zm0 5.22v2.983l23.193 11.932 51.622-25.356v-2.983L23.193 66.046 0 54.113zm0-10.44v2.983l23.193 11.932 51.622-25.356V30.25L23.193 55.605 0 43.673zm23.251 1.462L0 33.084v3.013l23.251 12.05L75.003 22.54v-3.013L23.251 45.135zM0 38.453v2.983l23.251 11.932 51.752-25.356v-2.983L23.251 50.385 0 38.453z"
                                    >
                                    </path>
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        fill="#24AE5F"
                                        d="M48.133 91.884L24.998 79.951V50.647l51.495-25.355L100 37.299v29L48.133 91.884z"
                                    >
                                    </path>
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        fill="#1E9450"
                                        d="M25 77.085v2.983L48.25 92 100 66.644v-2.983L48.25 89.017 25 77.085zm0-5.22v2.983L48.25 86.78 100 61.424v-2.983L48.25 83.796 25 71.865zm0-10.441v2.983l23.25 11.932L100 50.983V48L48.25 73.356 25 61.424zm0 5.22v2.983L48.25 81.56 100 56.204v-2.983L48.25 78.576 25 66.644zm0-10.44v2.983l23.25 11.932L100 45.763V42.78L48.25 68.136 25 56.204zm23.25 6.367L25 50.64v2.983l23.25 11.932L100 40.199v-2.983L48.25 62.571z"
                                    >
                                    </path>
                                    <path
                                        opacity=".1"
                                        d="M23.193 45.165L0 33.25v34.344L23.25 79.5l-.057-34.335zm25 17.435L25 50.685v29.292l23.25 11.906-.057-29.283z"
                                    >
                                    </path>
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        fill="#1E9450"
                                        d="M59.996 50.609l-11.363 5.459-9.702-5.22 13.138-6.436s-.912-2.62-.354-3.019c-.01.047-19.386 9.692-19.386 9.692l16.583 8.291 17.048-8.523s-1.669.055-3.148-.006c-1.502-.06-2.816-.238-2.816-.238zm13.446-3.496L93.5 37.5l-16.299-8.849-17.032 8.515c2.582-.133 4.697.978 4.697.978l12.126-5.94 10.448 5.221-13.99 6.72-.008 2.968z"
                                    >
                                    </path>
                                    <path
                                        fill="#1E9450"
                                        d="M64.235 46.958a5.58 5.58 0 0 0 1.99-.302l-3.529-1.87-.3.078-.384.123c-.523.157-1.059.302-1.61.433-.551.131-1.111.213-1.68.246s-1.137-.001-1.702-.101a5.753 5.753 0 0 1-1.693-.597c-.574-.304-.973-.63-1.196-.977-.223-.348-.306-.694-.25-1.04.056-.346.236-.686.538-1.019a5.136 5.136 0 0 1 1.151-.924l-1.3-.689.981-.52 1.3.689a11.139 11.139 0 0 1 1.734-.57 9.4 9.4 0 0 1 1.831-.255 8.713 8.713 0 0 1 1.887.137 7.553 7.553 0 0 1 1.886.612l-2.361 1.251a3.822 3.822 0 0 0-1.564-.389c-.581-.026-1.06.061-1.437.261l2.989 1.584.509-.162.559-.171c1.045-.315 1.956-.502 2.731-.562.775-.058 1.449-.048 2.02.031.571.08 1.056.205 1.455.374.399.171.74.331 1.021.48.248.131.499.329.754.594.255.265.405.576.449.934.045.358-.059.753-.309 1.184-.251.431-.764.882-1.538 1.353l1.435.761-.981.52-1.435-.761c-1.332.61-2.69.918-4.075.924-1.385.007-2.797-.313-4.237-.959l2.344-1.242a4.315 4.315 0 0 0 2.017.541zm3.45-1.229c.143-.153.233-.311.269-.474a.693.693 0 0 0-.074-.489c-.086-.163-.264-.316-.535-.46a2.616 2.616 0 0 0-1.395-.308c-.491.028-1.154.167-1.988.418l3.242 1.718a2.6 2.6 0 0 0 .48-.406zM57.08 42.391a.76.76 0 0 0-.22.394.545.545 0 0 0 .098.413c.091.137.255.268.492.393.372.197.775.288 1.21.272.435-.016.981-.133 1.637-.349l-2.753-1.458a1.841 1.841 0 0 0-.464.335z"
                                    >
                                    </path>
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        fill="#1E9450"
                                        d="M34.583 32.609L23.22 38.068l-9.702-5.22 13.138-6.436s-.913-2.62-.354-3.019c-.01.047-19.386 9.692-19.386 9.692l16.583 8.291 17.048-8.523s-1.669.055-3.148-.006c-1.502-.06-2.816-.238-2.816-.238zm13.446-3.496L68.087 19.5l-16.299-8.849-17.032 8.515c2.582-.133 4.697.978 4.697.978l12.126-5.94 10.448 5.221-13.989 6.72-.009 2.968z"
                                    >
                                    </path>
                                    <path
                                        fill="#1E9450"
                                        d="M38.822 28.958a5.558 5.558 0 0 0 1.99-.302l-3.53-1.87-.3.078-.384.123a28.85 28.85 0 0 1-1.61.433c-.551.131-1.111.213-1.68.246s-1.136-.001-1.702-.101a5.753 5.753 0 0 1-1.693-.597c-.574-.304-.973-.63-1.196-.977-.223-.348-.306-.694-.25-1.04.057-.346.236-.685.538-1.018a5.136 5.136 0 0 1 1.151-.924l-1.3-.689.981-.52 1.3.689a11.139 11.139 0 0 1 1.734-.57 9.4 9.4 0 0 1 1.831-.255 8.713 8.713 0 0 1 1.887.137 7.553 7.553 0 0 1 1.886.612l-2.361 1.251a3.822 3.822 0 0 0-1.564-.389c-.581-.026-1.06.061-1.437.261l2.989 1.584.509-.163.559-.171c1.045-.315 1.956-.502 2.731-.562.775-.059 1.449-.048 2.02.031.571.08 1.056.205 1.455.375.399.171.74.331 1.021.48.248.131.499.329.754.594.255.265.405.576.449.934.045.358-.059.753-.309 1.184-.251.431-.764.882-1.538 1.353l1.435.761-.981.52-1.435-.761c-1.332.61-2.69.918-4.075.924-1.385.007-2.797-.313-4.237-.959l2.344-1.242c.63.345 1.303.525 2.018.54zm3.45-1.229c.143-.153.233-.311.269-.474a.693.693 0 0 0-.074-.489c-.086-.163-.264-.316-.535-.46a2.616 2.616 0 0 0-1.395-.308l-1.988.419 3.242 1.718c.178-.117.338-.252.481-.406zm-10.605-3.338a.76.76 0 0 0-.22.394.545.545 0 0 0 .098.413c.092.137.255.268.492.393.372.197.775.288 1.211.272.435-.016.981-.133 1.637-.349l-2.753-1.458a1.83 1.83 0 0 0-.465.335z"
                                    >
                                    </path>
                                </g>
                            </svg></div>
                        <h6><a href="">Provides technological assistance to MSMEs.</a></h6>
                        <p>The program specifically focuses on assisting micro, small, and medium-sized enterprises.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                    <div class="icon-box">
                        <div class="icon"><svg
                                viewBox="-8.32 -8.32 80.64 80.64"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="#000000"
                            >
                                <g
                                    id="SVGRepo_bgCarrier"
                                    stroke-width="0"
                                >
                                    <rect
                                        x="-8.32"
                                        y="-8.32"
                                        width="80.64"
                                        height="80.64"
                                        rx="40.32"
                                        fill="#7ed0ec"
                                        strokewidth="0"
                                    ></rect>
                                </g>
                                <g
                                    id="SVGRepo_tracerCarrier"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                ></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g
                                        fill="none"
                                        fill-rule="evenodd"
                                    >
                                        <rect
                                            width="54"
                                            height="33"
                                            x="5"
                                            y="12"
                                            fill="#FFAF40"
                                        ></rect>
                                        <rect
                                            width="5"
                                            height="10"
                                            x="18"
                                            y="29"
                                            fill="#595959"
                                        ></rect>
                                        <rect
                                            width="5"
                                            height="14"
                                            x="26"
                                            y="25"
                                            fill="#595959"
                                        ></rect>
                                        <rect
                                            width="5"
                                            height="18"
                                            x="34"
                                            y="21"
                                            fill="#595959"
                                        ></rect>
                                        <rect
                                            width="5"
                                            height="21"
                                            x="42"
                                            y="18"
                                            fill="#22BA8E"
                                        ></rect>
                                        <rect
                                            width="60"
                                            height="4"
                                            x="2"
                                            y="8"
                                            fill="#BD7575"
                                            rx="2"
                                        ></rect>
                                        <rect
                                            width="60"
                                            height="4"
                                            x="2"
                                            y="45"
                                            fill="#BD7575"
                                            rx="2"
                                        ></rect>
                                        <rect
                                            width="4"
                                            height="11"
                                            x="30"
                                            y="49"
                                            fill="#9D4C4C"
                                        ></rect>
                                        <rect
                                            width="12"
                                            height="4"
                                            x="26"
                                            y="58"
                                            fill="#BD7575"
                                        ></rect>
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
                <div
                    class="alert alert-light h-100"
                    role="alert"
                >
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
                                <button
                                    class="accordion-button collapsed"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#follow-up_req"
                                    type="button"
                                    aria-expanded="true"
                                    aria-controls="follow-up_req"
                                >
                                    Follow-up Requirements
                                </button>
                            </h2>
                            <div
                                class="accordion-collapse collapse"
                                id="follow-up_req"
                                data-bs-parent="#accordionExample"
                            >
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
                                            Audited Financial Statements for the past three (3) years of the
                                            enterprise.
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
                                            Board resolution authorizing the availment of financial assistance from
                                            DOST
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
    <section class="setup-benefits py-5">
        <div class="section-title">
            <h2>What can you get from SETUP</h2>
        </div>
        <div class="container">
            <!-- First Item -->
            <div class="benefit-item row align-items-center mb-5">
                <div class="col-md-5">
                    <div class="benefit-content">
                        <h6 class="mb-3">Infusion of new/advanced technologies</h6>
                        <p class="paragraph-content">The infusion of new and advanced technologies is crucial for
                            enhancing efficiency and innovation. By adopting cutting-edge tools and systems,
                            organizations can streamline processes, reduce costs, and gain a competitive advantage.
                            Implementing new technologies is essential for driving growth and staying ahead in the
                            market.</p>
                    </div>
                </div>
                <div class="col-md-7 text-center">
                    <img
                        class="img-fluid benefit-image"
                        src="{{ asset('sampleProfile/tempImage.jpg') }}"
                        alt="SETUP LOGO"
                        loading="lazy"
                    >
                </div>
            </div>

            <!-- Second Item -->
            <div class="benefit-item row align-items-center mb-5">
                <div class="col-md-7 text-center">
                    <img
                        class="img-fluid benefit-image"
                        src="{{ asset('index_image/Provision of seed funds for technology acquisition and equipment upgrading..webp') }}"
                        alt="technology acquisition"
                        loading="lazy"
                    >
                </div>
                <div class="col-md-5">
                    <div class="benefit-content">
                        <h6 class="mb-3">Provision of seed funds for technology acquisition and equipment
                            upgrading.</h6>
                        <p class="paragraph-content">The program provides financial support for acquiring new or
                            upgraded technology and equipment. This includes funding assistance for advanced tools
                            and
                            machinery to improve operations and investments in modern technology to enhance
                            productivity
                            and product quality.</p>
                    </div>
                </div>
            </div>

            <!-- Third Item -->
            <div class="benefit-item row align-items-center mb-5">
                <div class="col-md-5">
                    <div class="benefit-content">
                        <h6 class="mb-3">Technical trainings</h6>
                        <p class="paragraph-content">The program offers a comprehensive approach to quality and
                            environmental management, including training in specific technical skills. It covers
                            Hazard
                            Analysis and Critical Control Points (HACCP), Good Manufacturing Practices (GMP), and
                            Quality and Environmental Management Systems (QMS/EMS). Additionally, the program
                            provides
                            training in specialized areas such as machining for furniture, handloom weaving, seaweed
                            culture, and tissue culture production.</p>
                    </div>
                </div>
                <div class="col-md-7 text-center">
                    <img
                        class="img-fluid benefit-image"
                        src="{{ asset('index_image/Technical trainings.webp') }}"
                        alt="Technical trainings"
                        loading="lazy"
                    >
                </div>
            </div>

            <!-- Fourth Item -->
            <div class="benefit-item row align-items-center mb-5">
                <div class="col-md-7 text-center">
                    <img
                        class="img-fluid benefit-image"
                        src="{{ asset('index_image/Technical Advisory and Consultancy Services.webp') }}"
                        alt="Technical Advisory and Consultancy Services"
                        loading="lazy"
                    >
                </div>
                <div class="col-md-5">
                    <div class="benefit-content">
                        <h6 class="mb-3">Technical Advisory and Consultancy Services</h6>
                        <p class="paragraph-content">The program focuses on enhancing food safety, resource
                            efficiency,
                            and cleaner production practices. It offers manufacturing, productivity, and extension
                            programs, along with consultancy services for agricultural and manufacturing
                            productivity
                            improvement. The program also emphasizes product and process standardization,
                            productivity
                            improvement, and energy conservation and efficiency assessments.</p>
                    </div>
                </div>
            </div>

            <!-- Fifth Item -->
            <div class="benefit-item row align-items-center mb-5">
                <div class="col-md-5">
                    <div class="benefit-content">
                        <h6 class="mb-3">Design of functional packages and labels</h6>
                        <p class="paragraph-content">The program focuses on designing visually appealing and
                            practical
                            packaging solutions, developing clear and informative product labels, and creating
                            packaging
                            that protects the product while enhancing its presentation.</p>
                    </div>
                </div>
                <div class="col-md-7 text-center">
                    <img
                        class="img-fluid benefit-image"
                        src="{{ asset('index_image/Design of functional packages and labels.webp') }}"
                        alt="Design of functional packages and labels"
                        loading="lazy"
                    >
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="section-title">
            <h2>Priority Sectors</h2>
        </div>
        <div class="container">
            <div class="imgs-container row g-4">
                <div class="col-md-4">
                    <div class="img-box h-100 d-flex flex-column">
                        <div class="sector-image">
                            <img
                                class="img-fluid w-100"
                                src="{{ asset('sectors/primarySector.jpg') }}"
                                alt="Primary Sector"
                                loading="lazy"
                            >
                        </div>
                        <div class="imgbox-content flex-grow-1 d-flex flex-column">
                            <span class="sector-title">Primary Sector</span>
                            <div class="sector-description">
                                <strong>Agriculture, Forestry, and Fishing:</strong> This sector involves the
                                extraction of raw
                                materials from the natural environment. It includes:
                                <ul>
                                    <li>Crop and animal production</li>
                                    <li>Forestry and logging</li>
                                    <li>Fishing and aquaculture</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="img-box h-100 d-flex flex-column">
                        <div class="sector-image">
                            <img
                                class="img-fluid w-100"
                                src="{{ asset('sectors/secondarySector.jpg') }}"
                                alt="Secondary Sector"
                                loading="lazy"
                            >
                        </div>
                        <div class="imgbox-content flex-grow-1 d-flex flex-column">
                            <span class="sector-title">Secondary Sector</span>
                            <div class="sector-description">
                                <strong>Manufacturing:</strong> This sector involves the processing of raw materials
                                into
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
                </div>
                <div class="col-md-4">
                    <div class="img-box h-100 d-flex flex-column">
                        <div class="sector-image">
                            <img
                                class="img-fluid w-100"
                                src="{{ asset('sectors/TertiarySector.jpg') }}"
                                alt="Tertiary Sector"
                                loading="lazy"
                            >
                        </div>
                        <div class="imgbox-content flex-grow-1 d-flex flex-column">
                            <span class="sector-title">Tertiary Sector</span>
                            <div class="sector-description">
                                <strong>Services:</strong> This sector involves providing services to individuals
                                and
                                businesses. While the provided list primarily focuses on manufacturing, it also
                                includes:
                                <ul>
                                    <li>Information and Communication</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section
        class="about"
        id="about"
    >
        <div class="container">
            <div class="row">
                <div class="col-lg-12 pt-4 pt-lg-0">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="card h-100">
                                <div class="card-header bg-primary">
                                    <strong class="text-white">VISION</strong>
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
                                <div class="card-header bg-primary">
                                    <strong class="text-white">MISSION</strong>

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
                                <div class="card-header bg-primary ">
                                    <strong class="text-white">VALUES</strong>
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
    @vite('resources/js/app.ts')
    @if (session('error') || session('success'))
        <div
            class="toast-container position-fixed top-0 end-0 p-3"
            id="toastContainer"
            style="z-index: 1100;"
        >
            <div
                class="toast align-items-center"
                id="emailNofiToast"
                role="alert"
                aria-live="assertive"
                aria-atomic="true"
            >
                <div class="toast-header {{ session('error') ? 'text-bg-danger' : 'text-bg-success' }}">
                    <strong class="me-auto">{{ session('error') ? 'Error' : 'Success' }}</strong>
                    <button
                        class="btn-close btn-close-white"
                        data-bs-dismiss="toast"
                        type="button"
                        aria-label="Close"
                    ></button>
                </div>
                <div
                    class="toast-body"
                    id="successToastBody"
                >
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
                console.log("scrolling")
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
            const imgs = $('img[loading="lazy"]');

            // Create an Intersection Observer
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const $img = $(entry.target); // Get the image as a jQuery object
                        const imgElement = entry.target; // Get the native DOM element

                        // Add the 'loaded' class if the image is already loaded
                        if (imgElement.complete) {
                            $img.addClass('loaded');
                        } else {
                            // Add the 'loaded' class when the image finishes loading
                            $img.on('load', function() {
                                $img.addClass('loaded');
                            });
                        }

                        // Stop observing the image once it's in the viewport
                        observer.unobserve(imgElement);
                    }
                });
            }, {
                rootMargin: '0px', // Adjust this to trigger the observer earlier or later
                threshold: 0.1 // Trigger when 10% of the image is visible
            });

            // Observe each lazy-loaded image
            imgs.each(function() {
                observer.observe(this);
            });
        });
    </script>
</body>

</html>
