<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DOST-SETUP</title>
    <link rel="icon" href="{{ asset('DOST_ICON.svg') }}" type="image/svg+xml">
    @vite('resources/css/app.scss')
    @vite('resources/js/app.js')


    <style>
        html {
            font-size: clamp(12px, 1vw, 24px);
            /* Adjusts between 10px and 18px according to viewport width */
        }

        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wdth,wght,YTLC@0,6..12,75..125,200..1000,440..540;1,6..12,75..125,200..1000,440..540&display=swap');

        :root {
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
            /* Example: Set to semi-bold. Adjust the value as needed */
        }

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
            object-fit: cover;
            background-position: center;
            transition: width 0.5s;
        }

        .imgbox-logo {
            position: absolute;
            bottom: 1%;
            left: 50%;
            transform: translateX(-50%);
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
            opacity: 0;
            color: #fff;
            display: linear;
            transition: font-size 1s, font-weight 1s, opacity 1s linear;
        }


        .img-box img:hover {
            width: 400px
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
    </style>
</head>

<body>

    @include('mainpage.header')

    <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
        <div class="container text-center text-md-left" data-aos="fade-up">
            <h1>Welcome to <span>SETUP</span></h1>
            <h2>We provide fund assistance to Micro, Small, Medium Businesses</h2>
            <a href="{{ route('registerpage.signup') }}" class="btn-apply scrollto">Apply Now</a>
        </div>
    </section>
    <section class="img-section">
        <div class="imgs-container">
            <div class="img-box position-relative">
                <img src="https://4.img-dpreview.com/files/p/E~C667x0S5333x4000T1200x900~articles/3925134721/0266554465.jpeg"
                    class=" " alt="...">
                <div class="imgbox-logo">
                    <?xml version="1.0" encoding="iso-8859-1"?>
                    <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                    <svg height="64px" width="64px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-51.2 -51.2 614.40 614.40"
                        xml:space="preserve" fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0">
                            <rect x="-51.2" y="-51.2" width="614.40" height="614.40" rx="307.2" fill="#7ed0ec"
                                strokewidth="0"></rect>
                        </g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC"
                            stroke-width="67.584"></g>
                        <g id="SVGRepo_iconCarrier">
                            <polygon style="fill:#3E3D43;"
                                points="73.422,241.949 73.422,381.49 299.471,512 438.578,431.686 438.578,292.145 212.529,161.635 ">
                            </polygon>
                            <g>
                                <polygon style="fill:#2E2E30;"
                                    points="108.199,240.941 299.471,351.373 403.801,291.137 212.529,180.706 "></polygon>
                                <polygon style="fill:#2E2E30;"
                                    points="73.422,241.949 73.422,381.49 299.471,512 299.471,372.459 "></polygon>
                            </g>
                            <polygon style="fill:#1D1D1F;"
                                points="438.578,292.145 438.578,431.686 299.471,512 299.471,372.459 "></polygon>
                            <polygon style="fill:#FEC377;"
                                points="108.199,198.073 108.199,240.974 177.696,281.098 220.464,256.406 220.464,213.505 150.966,173.38 ">
                            </polygon>
                            <polygon style="fill:#FFB657;"
                                points="108.199,198.073 108.199,240.974 177.696,281.098 177.696,238.197 "></polygon>
                            <polygon style="fill:#FFA834;"
                                points="220.464,213.505 220.464,256.406 177.696,281.098 177.696,238.197 "></polygon>
                            <path style="fill:#898890;"
                                d="M256.036,283.918v-36.606l0,0c0.006-4.506-2.951-9.012-8.874-12.432 c-11.843-6.838-31.224-6.838-43.067,0c-5.924,3.42-8.887,7.927-8.889,12.432l0,0v36.606h0.001 c-0.007,4.506,2.947,9.011,8.864,12.428c11.829,6.83,31.211,6.83,43.067,0C253.067,292.93,256.034,288.424,256.036,283.918 L256.036,283.918z">
                            </path>
                            <path style="fill:#ACABB1;"
                                d="M204.093,234.88c-11.843,6.838-11.855,18.021-0.025,24.85c11.829,6.83,31.209,6.83,43.067,0 c11.858-6.83,11.868-18.012,0.025-24.85C235.318,228.042,215.938,228.042,204.093,234.88z">
                            </path>
                            <polygon style="fill:#FEC377;"
                                points="247.306,278.368 247.306,321.269 299.471,351.373 342.239,326.681 342.239,283.78 290.073,253.676 ">
                            </polygon>
                            <polygon style="fill:#FFB657;"
                                points="247.306,278.368 247.306,321.269 299.471,351.373 299.471,308.472 "></polygon>
                            <polygon style="fill:#FFA834;"
                                points="342.239,283.78 342.239,326.681 299.471,351.373 299.471,308.472 "></polygon>
                            <g>
                                <path style="fill:#D8D8DA;"
                                    d="M94.67,96.988v-0.004h-0.001c-0.002-0.571-0.376-1.141-1.124-1.576 c-1.502-0.871-3.961-0.874-5.467-0.004c-0.752,0.435-1.13,1.007-1.13,1.58v145.924c0,0.573,0.375,1.144,1.126,1.579 c1.504,0.868,3.963,0.869,5.467,0.004c0.754-0.435,1.13-1.008,1.129-1.583C94.67,242.908,94.67,96.989,94.67,96.988z">
                                </path>
                                <path style="fill:#D8D8DA;"
                                    d="M303.332,216.248v-0.004h-0.001c-0.002-0.571-0.376-1.141-1.124-1.576 c-1.502-0.871-3.961-0.874-5.467-0.004c-0.752,0.435-1.13,1.007-1.13,1.58v145.923c0,0.573,0.375,1.144,1.126,1.578 c1.504,0.868,3.963,0.869,5.467,0.004c0.754-0.435,1.13-1.008,1.128-1.583C303.332,362.167,303.332,216.249,303.332,216.248z">
                                </path>
                            </g>
                            <path style="fill:#C6C5CB;"
                                d="M425.051,146.686v-0.004h-0.001c-0.002-0.571-0.376-1.141-1.124-1.576 c-1.502-0.871-3.961-0.874-5.467-0.004c-0.752,0.435-1.13,1.007-1.13,1.58v145.924c0,0.573,0.375,1.144,1.126,1.578 c1.504,0.868,3.963,0.869,5.467,0.004c0.754-0.435,1.13-1.008,1.128-1.583C425.051,292.606,425.051,146.687,425.051,146.686z">
                            </path>
                            <polygon style="fill:#CD2A01;"
                                points="73.422,100.392 299.471,230.902 438.578,150.589 438.578,130.51 212.529,0 73.422,80.314 ">
                            </polygon>
                            <polygon style="fill:#AD2201;"
                                points="73.422,80.314 299.471,210.824 438.578,130.51 212.529,0 "></polygon>
                            <polygon style="fill:#CD2A01;" points="212.529,0 212.529,20.078 73.422,80.314 "></polygon>
                            <polygon style="fill:#FF3502;"
                                points="73.422,80.314 212.529,20.078 352.569,100.93 299.471,210.824 "></polygon>
                            <polygon style="fill:#2E2E30;"
                                points="116.24,27.287 116.24,105.237 268.469,193.126 277.901,187.751 277.901,109.627 125.975,21.913 ">
                            </polygon>
                            <polygon style="fill:#1D1D1F;"
                                points="268.469,193.126 277.901,187.751 277.901,109.627 268.469,115.003 "></polygon>
                            <polygon style="fill:#3E3D43;"
                                points="116.24,27.287 125.975,21.913 277.901,109.627 268.469,115.003 "></polygon>
                            <polygon style="fill:#891D00;" points="352.569,100.93 438.578,130.51 299.471,210.824 ">
                            </polygon>
                            <polygon style="fill:#791900;"
                                points="299.471,210.824 299.471,230.902 438.578,150.589 438.578,130.51 "></polygon>
                            <path style="fill:#FFFFFF;"
                                d="M154.393,71.965l-0.018,6.091l-14.856-8.577l-0.026,9.216l12.355,7.133l-0.016,5.637l-12.355-7.133 l-0.042,14.804l-6.049-3.492l0.101-35.749L154.393,71.965 M171.179,111.564c1.462,0.844,2.753,1.244,3.88,1.204 c1.126-0.036,2.081-0.399,2.856-1.097c0.78-0.69,1.369-1.638,1.764-2.841c0.399-1.201,0.604-2.535,0.608-4.012 c0.004-1.543-0.206-3.161-0.626-4.85c-0.42-1.684-1.017-3.306-1.785-4.862c-0.773-1.554-1.719-2.982-2.841-4.287 c-1.122-1.3-2.388-2.36-3.789-3.168c-1.462-0.844-2.764-1.25-3.904-1.224c-1.14,0.032-2.091,0.394-2.856,1.075 c-0.761,0.691-1.341,1.632-1.74,2.828c-0.399,1.201-0.604,2.535-0.608,4.012c-0.004,1.543,0.196,3.156,0.602,4.837 s0.993,3.298,1.766,4.852c0.768,1.557,1.719,2.993,2.84,4.315C168.469,109.666,169.745,110.737,171.179,111.564 M171.349,81.503 c2.253,1.301,4.299,3.014,6.153,5.143c1.855,2.128,3.431,4.426,4.742,6.899c1.309,2.472,2.328,5.011,3.051,7.61 c0.727,2.607,1.083,5.032,1.076,7.282c-0.006,2.38-0.39,4.44-1.158,6.162c-0.764,1.73-1.821,3.038-3.169,3.921 c-1.348,0.888-2.961,1.283-4.832,1.195c-1.875-0.09-3.905-0.769-6.096-2.033c-2.281-1.318-4.347-3.02-6.196-5.113 c-1.855-2.096-3.442-4.377-4.766-6.836c-1.324-2.464-2.347-4.995-3.074-7.602c-0.722-2.604-1.083-5.049-1.076-7.331 c0.006-2.38,0.403-4.438,1.182-6.175c0.783-1.736,1.855-3.046,3.217-3.942s2.98-1.3,4.855-1.21 C167.129,79.565,169.159,80.238,171.349,81.503 M204.308,130.692c1.458,0.841,2.753,1.244,3.88,1.204 c1.126-0.036,2.076-0.402,2.856-1.097c0.775-0.693,1.365-1.641,1.764-2.841c0.399-1.201,0.599-2.538,0.603-4.016 c0.004-1.543-0.201-3.159-0.621-4.848c-0.42-1.684-1.017-3.306-1.785-4.862c-0.773-1.554-1.719-2.982-2.845-4.29 c-1.122-1.3-2.383-2.357-3.784-3.166c-1.462-0.844-2.764-1.25-3.904-1.224c-1.14,0.032-2.095,0.391-2.856,1.075 c-0.765,0.688-1.345,1.63-1.745,2.824c-0.395,1.203-0.599,2.538-0.603,4.016c-0.004,1.543,0.196,3.156,0.602,4.837 s0.993,3.298,1.766,4.852c0.768,1.557,1.714,2.991,2.84,4.315C201.599,128.794,202.875,129.864,204.308,130.692 M204.479,100.63 c2.248,1.298,4.299,3.014,6.154,5.143c1.85,2.126,3.431,4.426,4.742,6.899s2.328,5.011,3.051,7.61 c0.722,2.604,1.083,5.032,1.076,7.282c-0.006,2.38-0.394,4.438-1.158,6.162c-0.768,1.727-1.827,3.035-3.174,3.917 c-1.348,0.888-2.957,1.286-4.832,1.196c-1.869-0.088-3.905-0.769-6.096-2.033c-2.277-1.314-4.343-3.017-6.192-5.11 c-1.855-2.096-3.442-4.377-4.766-6.835c-1.324-2.464-2.352-4.998-3.074-7.602c-0.722-2.604-1.083-5.049-1.076-7.331 c0.006-2.38,0.399-4.44,1.182-6.175c0.777-1.739,1.851-3.049,3.212-3.946c1.367-0.893,2.985-1.297,4.855-1.21 C200.258,98.692,202.289,99.365,204.479,100.63 M230.161,145.415l5.258,3.035c1.491,0.861,2.811,1.322,3.97,1.388 c1.155,0.057,2.119-0.218,2.898-0.827c0.774-0.611,1.373-1.515,1.787-2.723c0.409-1.211,0.619-2.653,0.623-4.332 c0.005-1.713-0.195-3.407-0.597-5.086c-0.405-1.681-1.002-3.271-1.79-4.767c-0.783-1.493-1.752-2.859-2.908-4.096 c-1.15-1.24-2.456-2.278-3.917-3.122l-5.258-3.035L230.161,145.415 M235.504,118.794c2.543,1.468,4.766,3.224,6.678,5.269 c1.912,2.042,3.509,4.24,4.79,6.598c1.277,2.349,2.238,4.795,2.875,7.333c0.636,2.538,0.95,5.027,0.943,7.478 c-0.007,2.72-0.372,4.971-1.093,6.758c-0.725,1.785-1.76,3.068-3.107,3.853c-1.348,0.79-2.965,1.062-4.854,0.832 c-1.884-0.232-3.995-1.024-6.333-2.374l-11.307-6.528l0.101-35.749L235.504,118.794">
                            </path>
                        </g>
                    </svg>
                    <span class="logo-text">Food Processing</span>
                </div>
            </div>
            <div class="img-box position-relative">
                <img src="https://img.photographyblog.com/reviews/fujifilm_x_a3/photos/fujifilm_x_a3_13.jpg"
                    class=" " alt="...">
                <div class="imgbox-logo">
                    <svg height="64px" width="64px" viewBox="-10.24 -10.24 84.48 84.48"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                        role="img" class="iconify iconify--emojione" preserveAspectRatio="xMidYMid meet"
                        fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)">
                            <rect x="-10.24" y="-10.24" width="84.48" height="84.48" rx="42.24" fill="#7ed0ec"
                                strokewidth="0"></rect>
                        </g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                            stroke="#CCCCCC" stroke-width="0.768"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path fill="#c94747" d="M21.2 23.8l-4.6 1.5v1.6l4.6-1.3z"> </path>
                            <path fill="#3e4347" d="M21.2 25.6l-4.6 1.3v1.8l4.6-1.3z"> </path>
                            <path fill="#7ed0ec" d="M2 51.7h60V62H2z"> </path>
                            <path
                                d="M30.2 15.6h-.1c.1-.3.1-.6.1-.9c0-1.7-1.2-3.2-2.9-3.5c-.5-2-2.3-3.5-4.4-3.5c-.6 0-1.3.1-1.8.4c-1-1.5-2.6-2.4-4.5-2.4H16C15 3.5 12.8 2 10.2 2C6.7 2 3.9 4.8 3.9 8.4s2.8 6.4 6.4 6.4c.7 0 1.4-.1 2-.3c1 1.3 2.6 2.2 4.3 2.2c1.2 0 2.3-.4 3.2-1.1c.8.8 1.9 1.3 3.1 1.3c.2 0 .4 0 .6-.1c.6 1 1.8 1.6 3 1.6c.7 0 1.3-.2 1.9-.5c.2.8.9 1.4 1.8 1.4c1 0 1.8-.8 1.8-1.8c0-1.1-.8-1.9-1.8-1.9"
                                fill="#dae3ea"> </path>
                            <path d="M33.7 18.2c-1.1-.5-2.3-.7-3.5-.7c-1.4 0-3.3.3-4.5.9l-.9 7.2h12.7l-3.8-7.4"
                                fill="#94989b"> </path>
                            <path fill="#62727a" d="M18.4 27.4l-4.5 2.1v5.2h2.7v10.9h23.6V33.8z"> </path>
                            <path fill="#b2c1c0" d="M18.4 27.4v5.5h2.7v11.8h23.6V32.9h2.8v-5.5z"> </path>
                            <path fill="#62727a" d="M21.1 47.5l-10.9 1.7v-9.1l10.9-5.4z"> </path>
                            <path
                                d="M56.3 56.9S25.5 63.4 11 58.1c-2-.7-4.3-2-7.1-4.9v-4.4s10.3-1.3 22.9-8.1c15.5-8.3 29.1-8.7 33.5-6.8c-.1-.1-4 6.2-4 23"
                                fill="#f15744"> </path>
                            <path d="M56.5 51.9c.1-3.8 1.3-5.4 2.8-7.9c5.5-8.8.9-10.1.9-10.1c-3.5 5.8-3.7 18-3.7 18"
                                fill="#d33b23"> </path>
                            <path
                                d="M59.3 35.7c-5.6-1.6-18.5-.4-32.7 7.2C14.2 49.6 4 50.1 3.9 50.1v.9c.1 0 10.5-.5 23.1-7.2c13.8-7.4 26.6-8.6 32-7.2l.3-.9"
                                fill="#ffffff"> </path>
                            <path
                                d="M59.3 35.8c-.1.3-.2.6-.3.8c.8.3 2.2 1.1 2.7 2.6c.2-.5.3-1 .3-1.4c-.8-1.1-2-1.7-2.7-2"
                                fill="#b2c1c0"> </path>
                            <path fill="#62727a" d="M21.2 25.6h23.5v1.8H21.2z"> </path>
                            <path fill="#ff9d27" d="M21.2 23.8h23.5v1.8H21.2z"> </path>
                            <path fill="#c5d0d8" d="M18.4 27.4h29.1v5.4H18.4z"> </path>
                            <g fill="#94989b">
                                <path d="M20.3 28.8h1.3v2.7h-1.3z"> </path>
                                <path d="M23.7 28.8H25v2.7h-1.3z"> </path>
                                <path d="M27.1 28.8h1.3v2.7h-1.3z"> </path>
                                <path d="M30.5 28.8h1.3v2.7h-1.3z"> </path>
                                <path d="M34 28.8h1.3v2.7H34z"> </path>
                                <path d="M37.4 28.8h1.3v2.7h-1.3z"> </path>
                                <path d="M40.8 28.8h1.3v2.7h-1.3z"> </path>
                                <path d="M44.2 28.8h1.3v2.7h-1.3z"> </path>
                            </g>
                            <g fill="#62727a">
                                <path d="M22.9 33.8h3.6v1.8h-3.6z"> </path>
                                <path d="M42.9 34.3l-3.6 1v-1.5h3.6z"> </path>
                                <path d="M33.8 33.8h3.6v1.8h-3.6z"> </path>
                                <path d="M28.4 33.8H32v1.8h-3.6z"> </path>
                            </g>
                            <g fill="#ffffff">
                                <path d="M13.5 41.4l-2.3 1.1v2.2l2.3-.9z"> </path>
                                <path d="M20.1 38.1l-2.3 1.2v2.8l2.3-.9z"> </path>
                                <path d="M16.8 39.8l-2.3 1.1v2.5l2.3-.9z"> </path>
                            </g>
                        </g>
                    </svg>
                    <span class="logo-text">Marine/Aquaculture</span>
                </div>
            </div>
            <div class="img-box position-relative">
                <img src="https://i.pinimg.com/736x/50/e1/2e/50e12ed7f59fb40feb58d139dbeb11eb.jpg" alt="">
                <div class="imgbox-logo">
                    <svg height="64px" width="64px" version="1.1" id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="-102.4 -102.4 716.80 716.80" xml:space="preserve" fill="#000000" stroke="#000000"
                        stroke-width="0.00512" transform="matrix(-1, 0, 0, 1, 0, 0)">
                        <g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)">
                            <rect x="-102.4" y="-102.4" width="716.80" height="716.80" rx="358.4" fill="#7ed0ec"
                                strokewidth="0"></rect>
                        </g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path style="fill:#4CAF50;"
                                    d="M512,316.746C485.385,278.198,440.745,256,390.361,256c-63.15,0-117.691,39.676-138.7,95.458H8.678 v-95.44c0-19.178,15.551-34.729,34.729-34.729h199.576V30.373L225.627,4.339H512l-17.356,26.034V212.61L512,229.966V316.746z">
                                </path>
                                <polygon style="fill:#535353;"
                                    points="130.169,221.288 182.237,221.288 182.237,151.864 130.169,151.864 ">
                                </polygon>
                                <polygon style="fill:#A4A4A4;"
                                    points="173.559,151.864 138.847,151.864 138.847,91.119 173.559,117.153 "></polygon>
                                <path style="fill:#535353;"
                                    d="M494.644,420.881v-34.712h-9.45c-2.456-13.251-8.157-26.711-16.393-38.279l6.673-6.673 l-22.658-22.658l-6.673,6.673c-11.568-8.235-25.027-13.937-38.279-16.393v-9.45h-34.712v9.45 c-13.251,2.456-26.711,8.157-38.279,16.393l-6.673-6.673l-22.658,22.658l6.673,6.673c-8.235,11.568-13.937,25.027-16.393,38.279 h-9.45v34.712h9.45c2.456,13.251,8.157,26.711,16.393,38.279l-6.673,6.673l22.658,22.658l6.673-6.673 c11.568,8.235,25.027,13.937,38.279,16.393v9.45h34.712v-9.45c13.251-2.456,26.711-8.157,38.279-16.393l6.673,6.673l22.658-22.658 l-6.673-6.673c8.235-11.568,13.937-25.027,16.393-38.279H494.644z">
                                </path>
                                <path style="fill:#A4A4A4;"
                                    d="M433.898,403.525c0,23.96-19.43,43.39-43.39,43.39c-23.96,0-43.39-19.43-43.39-43.39 s19.43-43.39,43.39-43.39C414.468,360.136,433.898,379.566,433.898,403.525">
                                </path>
                                <path style="fill:#FFFFFF;"
                                    d="M407.864,403.525c0,9.589-7.767,17.356-17.356,17.356c-9.589,0-17.356-7.767-17.356-17.356 s7.767-17.356,17.356-17.356C400.098,386.169,407.864,393.936,407.864,403.525">
                                </path>
                                <path style="fill:#9FD0F4;"
                                    d="M416.542,195.254h-26.034c-19.17,0-34.712-15.542-34.712-34.712v-86.78 c0-19.17,15.542-34.712,34.712-34.712h26.034c19.17,0,34.712,15.542,34.712,34.712v86.78 C451.254,179.712,435.712,195.254,416.542,195.254">
                                </path>
                                <g>
                                    <path style="fill:#A4A4A4;"
                                        d="M164.881,82.441c-4.79,0-8.678-3.888-8.678-8.678V56.407c0-4.79,3.888-8.678,8.678-8.678 s8.678,3.888,8.678,8.678v17.356C173.559,78.553,169.672,82.441,164.881,82.441">
                                    </path>
                                    <path style="fill:#A4A4A4;"
                                        d="M147.525,39.051c-4.79,0-8.678-3.888-8.678-8.678V13.017c0-4.79,3.888-8.678,8.678-8.678 s8.678,3.888,8.678,8.678v17.356C156.203,35.163,152.316,39.051,147.525,39.051">
                                    </path>
                                </g>
                                <g>
                                    <path style="fill:#535353;"
                                        d="M147.525,446.915c0,33.549-27.197,60.746-60.746,60.746s-60.746-27.197-60.746-60.746 s27.197-60.746,60.746-60.746S147.525,413.366,147.525,446.915">
                                    </path>
                                    <polygon style="fill:#535353;"
                                        points="43.39,221.288 78.102,221.288 78.102,186.576 43.39,186.576 "></polygon>
                                </g>
                                <path style="fill:#A4A4A4;"
                                    d="M84.211,186.576h-46.93c-6.213,0-11.247-5.033-11.247-11.247v-12.219 c0-6.213,5.033-11.247,11.247-11.247h46.93c6.213,0,11.247,5.033,11.247,11.247v12.219 C95.458,181.543,90.424,186.576,84.211,186.576">
                                </path>
                                <g>
                                    <path style="fill:#81C784;"
                                        d="M8.678,351.458v17.356c0,19.17,15.542,34.712,34.712,34.712h0.92 c10.952-10.726,25.93-17.356,42.47-17.356s31.518,6.63,42.47,17.356h52.988v-17.356h69.424v-34.712H8.678z">
                                    </path>
                                    <path style="fill:#81C784;"
                                        d="M52.068,282.034H8.678c-4.79,0-8.678-3.888-8.678-8.678c0-4.79,3.888-8.678,8.678-8.678h43.39 c4.79,0,8.678,3.888,8.678,8.678C60.746,278.146,56.858,282.034,52.068,282.034">
                                    </path>
                                    <path style="fill:#81C784;"
                                        d="M43.39,316.746H8.678c-4.79,0-8.678-3.888-8.678-8.678s3.888-8.678,8.678-8.678H43.39 c4.79,0,8.678,3.888,8.678,8.678S48.18,316.746,43.39,316.746">
                                    </path>
                                    <polygon style="fill:#81C784;"
                                        points="173.559,308.068 225.627,308.068 225.627,256 173.559,256 "></polygon>
                                    <polygon style="fill:#81C784;"
                                        points="86.78,316.746 138.847,316.746 138.847,282.034 86.78,282.034 ">
                                    </polygon>
                                </g>
                                <g>
                                    <path style="fill:#4CAF50;"
                                        d="M182.237,412.203h52.068v-17.356h-52.068V412.203z M242.983,429.559h-69.424 c-4.79,0-8.678-3.888-8.678-8.678v-34.712c0-4.79,3.888-8.678,8.678-8.678h69.424c4.79,0,8.678,3.888,8.678,8.678v34.712 C251.661,425.672,247.773,429.559,242.983,429.559L242.983,429.559z">
                                    </path>
                                    <path style="fill:#4CAF50;"
                                        d="M182.237,446.915h52.068v-17.356h-52.068V446.915z M242.983,464.271h-69.424 c-4.79,0-8.678-3.888-8.678-8.678v-34.712c0-4.79,3.888-8.678,8.678-8.678h69.424c4.79,0,8.678,3.888,8.678,8.678v34.712 C251.661,460.383,247.773,464.271,242.983,464.271L242.983,464.271z">
                                    </path>
                                    <path style="fill:#4CAF50;"
                                        d="M182.237,377.492h52.068v-17.356h-52.068V377.492z M242.983,394.847h-69.424 c-4.79,0-8.678-3.888-8.678-8.678v-34.712c0-4.79,3.888-8.678,8.678-8.678h69.424c4.79,0,8.678,3.888,8.678,8.678v34.712 C251.661,390.96,247.773,394.847,242.983,394.847L242.983,394.847z">
                                    </path>
                                </g>
                                <path style="fill:#9FD0F4;"
                                    d="M277.695,195.254h-34.712V39.051h34.712c19.17,0,34.712,15.542,34.712,34.712v86.78 C312.407,179.712,296.865,195.254,277.695,195.254">
                                </path>
                                <path style="fill:#A4A4A4;"
                                    d="M112.814,446.915c0,14.379-11.655,26.034-26.034,26.034s-26.034-11.655-26.034-26.034 S72.4,420.881,86.78,420.881S112.814,432.536,112.814,446.915">
                                </path>
                            </g>
                        </g>
                    </svg>
                    <span class="logo-text">horticulture</span>
                </div>
            </div>
            <div class="img-box position-relative">
                <img src="https://miro.medium.com/v2/resize:fit:1400/0*YqNLbg_0RexCF0KZ.jpg" class=" "
                    alt="...">
                <div class="imgbox-logo">
                    <svg height="64px" width="64px" version="1.1" id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="-51.2 -51.2 614.40 614.40" xml:space="preserve" fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0">
                            <rect x="-51.2" y="-51.2" width="614.40" height="614.40" rx="307.2" fill="#7ed0ec"
                                strokewidth="0"></rect>
                        </g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path style="fill:#68AEF4;"
                                    d="M482.331,339.111c-26.505-26.505-64.045-35.241-97.83-26.218l-21.117-21.117l-71.616,39.781 l103.037,63.253l50.391-13.248l61.506,61.506C518.567,407.763,510.452,367.23,482.331,339.111z">
                                </path>
                                <path style="fill:#68AEF4;"
                                    d="M199.106,127.497c9.024-33.785,0.287-71.326-26.218-97.83C144.768,1.548,104.235-6.569,68.931,5.295 l61.506,61.506l-13.248,50.391l26.218,66.002l132.467,132.467l39.784-71.612L199.106,127.497z">
                                </path>
                            </g>
                            <path style="fill:#3891E9;"
                                d="M423.872,487.547l-42.338-42.338l13.273-50.399l-67.227-67.227l35.806-35.806l-47.726-47.726 l-47.741,47.742L151.364,175.238l11.944-11.938l-46.118-46.107l-50.399,13.271L24.452,88.126L5.284,68.958 c-11.848,35.289-3.739,75.813,24.38,103.933c26.505,26.505,64.045,35.241,97.83,26.218l185.396,185.396 c-9.024,33.785-0.287,71.326,26.218,97.83c28.12,28.12,68.644,36.228,103.933,24.38L423.872,487.547z">
                            </path>
                            <path style="fill:#276AAD;"
                                d="M181.208,157.337l-23.87,23.87c-3.296,3.296-8.64,3.296-11.936,0s-3.296-8.639,0-11.936l23.87-23.87 c3.296-3.296,8.64-3.296,11.936,0C184.504,148.698,184.504,154.04,181.208,157.337z">
                            </path>
                            <polygon style="fill:#554F4E;" points="71.562,440.439 71.562,488.147 0,512 "></polygon>
                            <polygon style="fill:#7F7774;"
                                points="23.854,440.439 65.599,434.475 59.635,476.22 0,512 "></polygon>
                            <polygon style="fill:#FFAB97;"
                                points="131.197,404.657 143.125,464.292 71.562,488.147 59.635,476.22 "></polygon>
                            <polygon style="fill:#FFCDC1;"
                                points="47.708,368.877 145.86,366.14 119.27,440.439 59.635,476.22 23.854,440.439 ">
                            </polygon>
                            <polygon style="fill:#F5AC51;"
                                points="406.744,121.159 422.647,184.771 143.125,464.292 119.27,440.439 "></polygon>
                            <path style="fill:#E26142;"
                                d="M390.842,121.159l63.611,31.806l47.708-47.708c13.12-13.12,13.12-34.589,0-47.708l-23.854-23.854 L390.842,121.159z">
                            </path>
                            <polygon style="fill:#FFEAB2;"
                                points="47.708,368.877 95.417,416.585 133.584,407.042 413.105,127.52 327.231,89.354 ">
                            </polygon>
                            <rect x="242.155" y="62.31"
                                transform="matrix(0.7071 0.7071 -0.7071 0.7071 271.6105 -102.0766)"
                                style="fill:#FFD159;" width="33.734" height="429.029"></rect>
                            <path style="fill:#F1866D;"
                                d="M454.452,9.84l23.854,23.854c13.12,13.12,13.12,34.589,0,47.708l-63.611,63.611l-55.659-87.465 l47.708-47.708C419.864-3.28,441.333-3.28,454.452,9.84z">
                            </path>
                            <rect x="409.752" y="134.454"
                                transform="matrix(0.7071 0.7071 -0.7071 0.7071 235.9297 -255.6972)"
                                style="fill:#D8D1D0;" width="33.734" height="44.979"></rect>
                            <rect x="328.315" y="86.756"
                                transform="matrix(0.7071 0.7071 -0.7071 0.7071 188.2306 -235.9382)"
                                style="fill:#FFFFFF;" width="101.206" height="44.979"></rect>
                            <path style="fill:#276AAD;"
                                d="M336.761,369.071c-2.159,0-4.32-0.824-5.968-2.472c-3.296-3.296-3.296-8.639,0-11.935l23.87-23.87 c3.297-3.296,8.64-3.296,11.936,0c3.296,3.296,3.296,8.64,0,11.935l-23.87,23.87C341.081,368.248,338.92,369.071,336.761,369.071z">
                            </path>
                        </g>
                    </svg>
                    <span class="logo-text">metals and engineering</span>

                </div>
            </div>
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
                        DOST Small Enterprise Technology Upgrading Program (SETUP), we're a government agency dedicated
                        to supporting qualified businesses and sectors. We provide technical and financial assistance to
                        help them thrive. To ensure our programs are effective, we closely monitor all the assistance we
                        offer. We create progress reports for each business, allowing us to gauge the impact of our
                        support. As part of the government, we prioritize maintaining strong relationships with our
                        stakeholders. This commitment is reflected in our core values: our mandate, vision, and mission,
                        which you'll find below.
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Vision</h4>
                            <p class="text-center">DOST XI envisions an agile and proactive organization with
                                performance excellence in providing public service through Science, Engineering,
                                Technology, and Innovation (SETI) for inclusive and sustainable development of the
                                Philippines by 2025.
                                The vision of DOST is to ensure the performance excellence in providing public service
                                through SETI, which means that all their stakeholders who want to seek help for their
                                assistance will be assisted by the DOST to ensure and provide good quality of services
                                of the specific organization. This will be both beneficial to the organization as well
                                as to their stakeholders.
                            </p>
                        </div>
                        <div class="col-md-6 mt-4 mt-md-0">
                            <h4>Mission</h4>
                            <p class="text-center">To inspire and transform communities through Science, Engineering,
                                Technology, and Innovation (SETI).
                                The mission of the DOST is to assist sectors to upgrade their process in providing
                                services through the use of technology. To easily provide an output or product that will
                                be beneficial to the country.
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
