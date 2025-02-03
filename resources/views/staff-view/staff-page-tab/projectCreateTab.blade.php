<style>
    * label {
        font-weight: 500;
        opacity: 0.7;
    }

    ul#myTab li.nav-item button.tab-Nav.active {
        background-color: #318791 !important;
        font-weight: bold;
        color: white;
        border-top: 6px solid;
        border-top-right-radius: 10px;
        /* Adjust the radius value as needed */
        border-top-left-radius: 10px;
    }

    ul#myTab li.nav-item button.tab-Nav {
        background-color: white;
        /* Your desired color */
        color: black;
        /* Adjust text color accordingly */
        border: 1px solid #318791;
        /* Adjust border color */
        border-bottom: none;
    }

    ul#myTab li.nav-item button.tab-Nav:hover {
        background-color: #318791;
        /* Hover state color */
        color: white;
    }

    .checkbox-wrapper-26 {
        /* Temporary, for debugging */
        position: relative;
        /* Ensure this is set to contain absolutely positioned children */
        padding-bottom: 40px;
    }

    .checkbox-wrapper-26 span {
        margin-left: 10px;
        /* Adjust the spacing to your preference */
    }

    .checkbox-wrapper-26 * {
        -webkit-tap-highlight-color: transparent;
        outline: none;
    }

    .checkbox-wrapper-26 input[type="checkbox"] {
        display: none;
    }

    .checkbox-wrapper-26 input[type="checkbox"]:disabled+label {
        background-color: #e0e0e0;
        /* Light grey background */
        box-shadow: 0 var(--shadow) #ccc;
        /* Lighter shadow */
    }

    .checkbox-wrapper-26 input[type="checkbox"]:disabled+label:before {
        background-color: #f9f9f9;
        /* Very light grey for the inner circle */
    }

    .checkbox-wrapper-26 input[type="checkbox"]:disabled+label .tick_mark:before,
    .checkbox-wrapper-26 input[type="checkbox"]:disabled+label .tick_mark:after {
        background-color: #ccc;
        /* Light grey tick marks */
        box-shadow: none;
        /* No shadow for tick marks */
    }

    .checkbox-wrapper-26 label {
        --size: 30px;
        --shadow: calc(var(--size) * .07) calc(var(--size) * .1);
        position: relative;
        display: block;
        width: var(--size);
        height: var(--size);
        margin: 0;
        /* Changed from 'margin: 0 auto;' to 'margin: 0;' */
        background-color: #0D6EFD;
        border-radius: 50%;
        box-shadow: 0 var(--shadow) #ffbeb8;
        cursor: pointer;
        transition: 0.2s ease transform, 0.2s ease background-color,
            0.2s ease box-shadow;
        overflow: hidden;
        z-index: 1;
    }

    .checkbox-wrapper-26 label:before {
        content: "";
        position: absolute;
        top: 50%;
        right: 0;
        left: 0;
        width: calc(var(--size) * .7);
        height: calc(var(--size) * .7);
        margin: 0 auto;
        background-color: #fff;
        transform: translateY(-50%);
        border-radius: 50%;
        box-shadow: inset 0 var(--shadow) #ffbeb8;
        transition: 0.2s ease width, 0.2s ease height;
    }

    .checkbox-wrapper-26 label:hover:before {
        width: calc(var(--size) * .55);
        height: calc(var(--size) * .55);
        box-shadow: inset 0 var(--shadow) #ff9d96;
    }

    .checkbox-wrapper-26 label:active {
        transform: scale(0.9);
    }

    .checkbox-wrapper-26 .tick_mark {
        position: absolute;
        top: -1px;
        right: 0;
        left: calc(var(--size) * -.05);
        width: calc(var(--size) * .6);
        height: calc(var(--size) * .6);
        margin: 0 auto;
        margin-left: calc(var(--size) * .14);
        transform: rotateZ(-40deg);
    }

    .checkbox-wrapper-26 .tick_mark:before,
    .checkbox-wrapper-26 .tick_mark:after {
        content: "";
        position: absolute;
        background-color: #fff;
        border-radius: 2px;
        opacity: 0;
        transition: 0.2s ease transform, 0.2s ease opacity;
    }

    .checkbox-wrapper-26 .tick_mark:before {
        left: 0;
        bottom: 0;
        width: calc(var(--size) * .1);
        height: calc(var(--size) * .3);
        box-shadow: -2px 0 5px rgba(0, 0, 0, 0.23);
        transform: translateY(calc(var(--size) * -.68));
    }

    .checkbox-wrapper-26 .tick_mark:after {
        left: 0;
        bottom: 0;
        width: 100%;
        height: calc(var(--size) * .1);
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.23);
        transform: translateX(calc(var(--size) * .78));
    }

    .checkbox-wrapper-26 input[type="checkbox"]:checked+label {
        background-color: #07d410;
        box-shadow: 0 var(--shadow) #92ff97;
    }

    .checkbox-wrapper-26 input[type="checkbox"]:checked+label:before {
        width: 0;
        height: 0;
    }

    .checkbox-wrapper-26 input[type="checkbox"]:checked+label .tick_mark:before,
    .checkbox-wrapper-26 input[type="checkbox"]:checked+label .tick_mark:after {
        transform: translate(0);
        opacity: 1;
    }

    .line {
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 30px;
        background-color: #000;
        visibility: hidden;
        z-index: 10;
    }

    .checkbox-wrapper-26 span {
        font-weight: bolder;
        min-width: 60%;
        max-width: 70%;
    }

    #sw-AddProjectData th {
        font-size: 12px;
    }
</style>

<div>
    <h4 class="p-4">{Project title}</h4>
</div>
<div>
    <ul
        class="nav nav-tabs"
        id="myTab"
        role="tablist"
    >
        <li
            class="nav-item"
            role="presentation"
        >
            <button
                class="nav-link  tab-Nav active"
                id="Checklist-tab"
                data-bs-toggle="tab"
                data-bs-target="#Checklist-tab-pane"
                type="button"
                role="tab"
                aria-controls="Checklist-tab-pane"
                aria-selected="true"
            >Requirements Checklist</button>
        </li>
        <li
            class="nav-item"
            role="presentation"
        >
            <button
                class="nav-link  tab-Nav"
                id="Project-tab"
                data-bs-toggle="tab"
                data-bs-target="#Project-tab-pane"
                type="button"
                role="tab"
                aria-controls="Project-tab-pane"
                aria-selected="false"
            >Project Information
                Sheets</button>
        </li>
        <li
            class="nav-item"
            role="presentation"
        >
            <button
                class="nav-link  tab-Nav"
                id="ProjectData-tab"
                data-bs-toggle="tab"
                data-bs-target="#ProjectData-tab-pane"
                type="button"
                role="tab"
                aria-controls="ProjectData-tab-pane"
                aria-selected="false"
            >Project Data Sheets</button>
        </li>
        <li
            class="nav-item"
            role="presentation"
        >
            <button
                class="nav-link  tab-Nav"
                id="Client-tab"
                data-bs-toggle="tab"
                data-bs-target="#Client-tab-pane"
                type="button"
                role="tab"
                aria-controls="Client-tab-pane"
                aria-selected="false"
            >Client's
                Information</button>
        </li>
    </ul>

</div>
<div
    class="tab-content bg-white"
    id="myTabContent"
>
    <div
        class="tab-pane fade show active"
        id="Checklist-tab-pane"
        role="tabpanel"
        aria-labelledby="Checklist-tab"
        tabindex="0"
    >
        <Div class="m-2 p-5">
            <!-- TODO: add a line connection with the checkboxes -->
            <form action="">

                <div>
                    <div class="checkbox-wrapper-26 ms-3">
                        <div class="d-flex align-items-center justify-content-start">
                            <input
                                id="_checkbox-TNA"
                                type="checkbox"
                                value="TNA"
                                onclick="checkOrder(this, null)"
                            >
                            <label
                                class="me-2"
                                for="_checkbox-TNA"
                            >
                                <div class="tick_mark"></div>
                            </label>
                            <span>TNA</span>
                        </div>
                        <div class="line position-absolute"></div>
                    </div>
                    <div class="checkbox-wrapper-26 ms-3">
                        <div class="d-flex align-items-center justify-content-start">
                            <input
                                id="_checkbox-PDA"
                                type="checkbox"
                                value="Project Deliberation Approval"
                                onclick="checkOrder(this, '_checkbox-TNA')"
                                disabled
                            >
                            <label
                                class="me-2"
                                for="_checkbox-PDA"
                            >
                                <div class="tick_mark"></div>
                            </label>
                            <span>Project Deliberation Approval</span>
                        </div>
                        <div class="line position-absolute"></div>
                    </div>
                    <div class="checkbox-wrapper-26 ms-3">
                        <div class="d-flex align-items-center justify-content-start">
                            <input
                                id="_checkbox-PDC"
                                type="checkbox"
                                value="PDC-post Dated Cheque"
                                onclick="checkOrder(this, '_checkbox-PDA')"
                                disabled
                            >
                            <label
                                class="me-2"
                                for="_checkbox-PDC"
                            >
                                <div class="tick_mark"></div>
                            </label>
                            <span>PDC-post Dated Cheque</span>
                        </div>
                        <div class="line position-absolute"></div>
                    </div>
                    <div class="checkbox-wrapper-26 ms-3">
                        <div class="d-flex align-items-center justify-content-start">
                            <input
                                id="_checkbox-FR"
                                type="checkbox"
                                value="Fund release"
                                onclick="checkOrder(this, '_checkbox-PDC')"
                                disabled
                            >
                            <label
                                class="me-2"
                                for="_checkbox-FR"
                            >
                                <div class="tick_mark"></div>
                            </label>
                            <span>Fund release</span>
                        </div>
                    </div>
                </div>
            </form>
        </Div>
    </div>
    <div
        class="tab-pane fade"
        id="Project-tab-pane"
        role="tabpanel"
        aria-labelledby="Project-tab"
        tabindex="0"
    >
        <!-- Where the project infomation sheets will be displayed. -->
        <button
            class="btn btn-secondary"
            id="BackInformation"
            type="button"
        >Back</button>
        <div id="InformationSheets">

        </div>

        <div
            class="p-5"
            id="InfoSheetForm"
        >

            <fieldset class="mt-4">
                <legend class="w-auto">
                    <h5>Project Information Sheet:</h5>
                </legend>
                <form action="">
                    <div class="ps-4 pe-2 pt-2">
                        <div class="form-floating mb-3">
                            <input
                                class="form-control"
                                id="projectTitle"
                                type="text"
                                placeholder="Project Title"
                            >
                            <label for="projectTitle">Project Title:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input
                                class="form-control"
                                id="firmName"
                                type="text"
                                placeholder="Name of the Firm"
                            >
                            <label for="firmName">Name of the Firm:</label>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset class="mt-3">
                                    <legend class="w-auto">
                                        <h6>CONTACT PERSON:</h6>
                                    </legend>
                                    <div class="ps-4 pe-2 pt-2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input
                                                        class="form-control"
                                                        id="name"
                                                        type="text"
                                                        placeholder="Name"
                                                    >
                                                    <label for="name">Name:</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating mb-3">
                                                    <input
                                                        class="form-control"
                                                        id="sex"
                                                        type="text"
                                                        placeholder="sex"
                                                    >
                                                    <label for="sex">sex:</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating mb-3">
                                                    <input
                                                        class="form-control"
                                                        id="age"
                                                        type="text"
                                                        placeholder="Age"
                                                    >
                                                    <label for="age">Age:</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input
                                                class="form-control"
                                                id="organizationType"
                                                type="text"
                                                placeholder="Type of Organization/Enterprise"
                                            >
                                            <label for="organizationType">Type of Organization/Enterprise:</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input
                                                class="form-control"
                                                id="businessAddress"
                                                type="text"
                                                placeholder="Business Address"
                                            >
                                            <label for="businessAddress">Business Address:</label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="mt-3">
                                    <legend class="w-auto">
                                        <h6>CONTACT DETAILS:</h6>
                                    </legend>
                                    <div class="ps-4 pe-2 pt-2">
                                        <div class="form-floating mb-3">
                                            <input
                                                class="form-control"
                                                id="landline"
                                                type="text"
                                                placeholder="Landline"
                                            >
                                            <label for="landline">Landline:</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input
                                                class="form-control"
                                                id="fax"
                                                type="text"
                                                placeholder="Fax"
                                            >
                                            <label for="fax">Fax:</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input
                                                class="form-control"
                                                id="mobilePhone"
                                                type="text"
                                                placeholder="Mobile Phone"
                                            >
                                            <label for="mobilePhone">Mobile Phone:</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input
                                                class="form-control"
                                                id="emailAddress"
                                                type="email"
                                                placeholder="Email Address"
                                            >
                                            <label for="emailAddress">Email Address:</label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="mt-3">
                                    <legend>
                                        <h6>ASSISTANCE OBTAINED FROM DOST</h6>
                                    </legend>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            id="productionTechnology"
                                            type="checkbox"
                                            value=""
                                        >
                                        <label
                                            class="form-check-label"
                                            for="productionTechnology"
                                        >
                                            A1 Production Technology
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            id="process"
                                            type="checkbox"
                                            value=""
                                        >
                                        <label
                                            class="form-check-label px-2"
                                            for="process"
                                        >
                                            A.1.1 Process
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            id="equipment"
                                            type="checkbox"
                                            value=""
                                        >
                                        <label
                                            class="form-check-label px-2"
                                            for="equipment"
                                        >
                                            A.1.2 Equipment
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            id="qualityControl"
                                            type="checkbox"
                                            value=""
                                        >
                                        <label
                                            class="form-check-label px-2"
                                            for="qualityControl"
                                        >
                                            A.1.3 Quality Control/Laboratory Testing/Analysis
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            id="productionTechnology1"
                                            type="checkbox"
                                            value=""
                                        >
                                        <label
                                            class="form-check-label px-4"
                                            for="productionTechnology1"
                                        >
                                            1.3.1 Production Technology
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            id="packagingLabeling"
                                            type="checkbox"
                                            value=""
                                        >
                                        <label
                                            class="form-check-label"
                                            for="packagingLabeling"
                                        >
                                            A2 Packaging/Labeling
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            id="postHarvest"
                                            type="checkbox"
                                            value=""
                                        >
                                        <label
                                            class="form-check-label"
                                            for="postHarvest"
                                        >
                                            A3 Post-Harvest
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            id="marketAssistance"
                                            type="checkbox"
                                            value=""
                                        >
                                        <label
                                            class="form-check-label"
                                            for="marketAssistance"
                                        >
                                            A4 Market Assistance
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            id="humanResourceTraining"
                                            type="checkbox"
                                            value=""
                                        >
                                        <label
                                            class="form-check-label"
                                            for="humanResourceTraining"
                                        >
                                            A5 Human Resource training
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            id="consultanceServices"
                                            type="checkbox"
                                            value=""
                                        >
                                        <label
                                            class="form-check-label"
                                            for="consultanceServices"
                                        >
                                            A6 Consultance Services
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            id="otherServices"
                                            type="checkbox"
                                            value=""
                                        >
                                        <label
                                            class="form-check-label"
                                            for="otherServices"
                                        >
                                            A7 other Services (FDA Permit, LGU Registration, Barcoding)
                                        </label>
                                    </div>
                                </fieldset>
                            </div>

                        </div>

                    </div>
                    <div class="text-end">
                        <button
                            class="btn btn-primary"
                            id="createSheetButtonInfo"
                            type="button"
                        >Create
                            Sheet</button>
                    </div>
                </form>
            </fieldset>
            </form>
        </div>
    </div>
    <div
        class="tab-pane fade"
        id="ProjectData-tab-pane"
        role="tabpanel"
        aria-labelledby="ProjectData-tab"
        tabindex="0"
    >
        <!-- Where the project Data sheets will be displayed. -->
        <div class=" me-5 text-end">
            <button
                class="btn"
                id="BackData"
                type="button"
            >Back</button>
        </div>
        <div id="dataSheets">

        </div>
        <div
            class="container p-5"
            id="dataSheets-form"
        >
            <div
                class="p-4"
                id="sw-AddProjectData"
            >
                <ul class="nav nav-progress">
                    <li class="nav-item">
                        <a
                            class="nav-link  .tab-Nav default active z-3"
                            href="#step-1"
                        >
                            <div class="num">1</div>
                            Cooperator Info
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link  default z-3"
                            href="#step-2"
                        >
                            <span class="num">2</span>
                            Assests
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link  default z-3"
                            href="#step-3"
                        >
                            <span class="num">3</span>
                            TOTAL EMPLOYMENT
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link default z-3"
                            href="#step-4"
                        >
                            <span class="num">4</span>
                            PRODUCTION AND SALES
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link  default z-3"
                            href="#step-5"
                        >
                            <span class="num">5</span>
                            Market Outlets
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link  default z-3"
                            href="#step-6"
                        >
                            <span class="num">6</span>
                            Increase in
                        </a>

                    </li>
                </ul>

                <div class="tab-content">
                    <div
                        class="tab-pane"
                        id="step-1"
                        role="tabpanel"
                        aria-labelledby="step-1"
                    >
                        Step content
                        <fieldset>
                            <legend class="w-auto">
                                <h2>Cooperator Info:</h2>
                            </legend>
                            <div class="p-3">
                                <div class="form-group row mt-2">
                                    <label
                                        class="col-12 col-sm-2"
                                        for="project_title"
                                    ><strong>Project
                                            Title:</strong></label>
                                    <div class="col-12 col-sm-10">
                                        <input
                                            class="form-control"
                                            id="project_title"
                                            type="text"
                                            placeholder="[Project Title Value]"
                                        >
                                    </div>
                                </div>
                                <div class="form-group row mt-2">
                                    <label
                                        class="col-12 col-sm-2"
                                        for="firm_name"
                                    ><strong>Name of
                                            Firm:</strong></label>
                                    <div class="col-12 col-sm-10">
                                        <input
                                            class="form-control"
                                            id="firm_name"
                                            type="text"
                                            placeholder="[Firm Name Value]"
                                        >
                                    </div>
                                </div>
                                <div class="form-group row mt-2">
                                    <label
                                        class="col-12 col-sm-2"
                                        for="address"
                                    ><strong>Address:</strong></label>
                                    <div class="col-12 col-sm-10">
                                        <input
                                            class="form-control"
                                            id="address"
                                            type="text"
                                            placeholder="[Address Value]"
                                        >
                                    </div>
                                </div>
                                <div class="form-group row mt-2">
                                    <label
                                        class="col-12 col-sm-2"
                                        for="contact_person"
                                    ><strong>Contact
                                            Person:</strong></label>
                                    <div class="col-12 col-sm-4">
                                        <input
                                            class="form-control"
                                            id="contact_person"
                                            type="text"
                                            placeholder="[Contact Person Value]"
                                        >
                                    </div>
                                    <label
                                        class="col-12 col-sm-2"
                                        for="designation"
                                    ><strong>Designation:</strong></label>
                                    <div class="col-12 col-sm-4">
                                        <input
                                            class="form-control"
                                            id="designation"
                                            type="text"
                                            placeholder="[Designation Value]"
                                        >
                                    </div>
                                    <div class="form-group row mt-2">
                                        <label
                                            class="col-12 col-sm-2"
                                            for="landline"
                                        ><strong>Landline:</strong></label>
                                        <div class="col-12 col-sm-2">
                                            <input
                                                class="form-control"
                                                id="landline"
                                                type="text"
                                                placeholder="[Landline Value]"
                                            >
                                        </div>
                                        <label
                                            class="col-12 col-sm-2"
                                            for="mobile_phone"
                                        ><strong>Mobile
                                                Phone:</strong></label>
                                        <div class="col-12 col-sm-2">
                                            <input
                                                class="form-control"
                                                id="mobile_phone"
                                                type="text"
                                                placeholder="[Mobile Phone Value]"
                                            >
                                        </div>
                                        <label
                                            class="col-12 col-sm-2"
                                            for="email"
                                        ><strong>Email
                                                Address:</strong></label>
                                        <div class="col-12 col-sm-2">
                                            <input
                                                class="form-control"
                                                id="email"
                                                type="text"
                                                placeholder="[Email Address Value]"
                                            >
                                        </div>
                                    </div>
                                </div>
                        </fieldset>
                    </div>
                    <div
                        class="tab-pane"
                        id="step-2"
                        role="tabpanel"
                        aria-labelledby="step-2"
                    >
                        <fieldset class="">
                            <legend class="w-auto">
                                <h4>1.0 ASSETS</h4>
                            </legend>
                            <div class="row ms-md-4 mb-3">
                                <div class="col-12 col-sm-6 col-md-4">
                                    <label for="BuildingAsset">Building:</label>
                                    <input
                                        class="form-control"
                                        id="BuildingAsset"
                                        name="Building"
                                        type="text"
                                        placeholder=""
                                    >
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <label for="Equipment">Equipment:</label>
                                    <input
                                        class="form-control"
                                        id="Equipment"
                                        name="Equipment"
                                        type="text"
                                        placeholder=""
                                    >
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <label for="WorkingCapital">Working Capital:</label>
                                    <input
                                        class="form-control"
                                        id="WorkingCapital"
                                        name="WorkingCapital"
                                        type="text"
                                        placeholder=""
                                    >
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div
                        class="tab-pane"
                        id="step-3"
                        role="tabpanel"
                        aria-labelledby="step-3"
                    >
                        Step content
                        <fieldset class="mt-4">
                            <legend class="w-auto">
                                <h4>2.0 TOTAL EMPLOYMENT FOR THE QUARTER</h4>
                            </legend>
                            <div class="row ms-2 mb-3">
                                <div class="col-sm-12">
                                    <h5>2.1 Direct Labor(Production)</h5>
                                    <div class="row ms-md-2">
                                        <div class="col-sm-12 mt-3">
                                            <h6>2.1a Direct Labor</h6>
                                            <!-- Your input fields here -->
                                            <div class="mb-3">
                                                <table class="table">
                                                    <thead>
                                                        <tr class="table-primary">
                                                            <th scope="col">Male</th>
                                                            <th scope="col">Female</th>
                                                            <th scope="col">Workday</th>
                                                            <th scope="col">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><input
                                                                    class="form-control"
                                                                    id="maleInput"
                                                                    type="text"
                                                                    placeholder=""
                                                                ></td>
                                                            <td><input
                                                                    class="form-control"
                                                                    id="femaleInput"
                                                                    type="text"
                                                                    placeholder=""
                                                                ></td>
                                                            <td><input
                                                                    class="form-control"
                                                                    id="workdayInput"
                                                                    type="text"
                                                                    placeholder=""
                                                                ></td>
                                                            <td>{Total}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mt-3">
                                            <h6>2.1b Part-time</h6>
                                            <!-- Your input fields here -->
                                            <div class="mb-3">
                                                <table class="table">
                                                    <thead>
                                                        <tr class="table-primary">
                                                            <th scope="col">Male</th>
                                                            <th scope="col">Female</th>
                                                            <th scope="col">Workday</th>
                                                            <th scope="col">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><input
                                                                    class="form-control"
                                                                    id="parttimeMaleInput"
                                                                    type="text"
                                                                    placeholder=""
                                                                ></td>
                                                            <td><input
                                                                    class="form-control"
                                                                    id="parttimeFemaleInput"
                                                                    type="text"
                                                                    placeholder=""
                                                                ></td>
                                                            <td><input
                                                                    class="form-control"
                                                                    id="parttimeWorkdayInput"
                                                                    type="text"
                                                                    placeholder=""
                                                                ></td>
                                                            <td>{Total}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <h5>2.2 Indirect Labor(Admin and Marketing)</h5>
                                    <div class="row ms-md-2">
                                        <div class="col-sm-12 mt-3">
                                            <h6>2.2a Regular</h6>
                                            <!-- Your input fields here -->
                                            <div class="mb-3">
                                                <table class="table">
                                                    <thead>
                                                        <tr class="table-primary">
                                                            <th scope="col">Male</th>
                                                            <th scope="col">Female</th>
                                                            <th scope="col">Workday</th>
                                                            <th scope="col">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><input
                                                                    class="form-control"
                                                                    id="regularMaleInput"
                                                                    type="text"
                                                                    placeholder=""
                                                                ></td>
                                                            <td><input
                                                                    class="form-control"
                                                                    id="regularFemaleInput"
                                                                    type="text"
                                                                    placeholder=""
                                                                ></td>
                                                            <td><input
                                                                    class="form-control"
                                                                    id="regularWorkdayInput"
                                                                    type="text"
                                                                    placeholder=""
                                                                ></td>
                                                            <td>{Total}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mt-3">
                                            <h6>2.2b Part-time</h6>
                                            <!-- Your input fields here -->
                                            <div class="mb-3">
                                                <table class="table">
                                                    <thead>
                                                        <tr class="table-primary">
                                                            <th scope="col">Male</th>
                                                            <th scope="col">Female</th>
                                                            <th scope="col">Workday</th>
                                                            <th scope="col">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><input
                                                                    class="form-control"
                                                                    id="parttimeMaleInput"
                                                                    type="text"
                                                                    placeholder=""
                                                                ></td>
                                                            <td><input
                                                                    class="form-control"
                                                                    id="parttimeFemaleInput"
                                                                    type="text"
                                                                    placeholder=""
                                                                ></td>
                                                            <td><input
                                                                    class="form-control"
                                                                    id="parttimeWorkdayInput"
                                                                    type="text"
                                                                    placeholder=""
                                                                ></td>
                                                            <td>{Total}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div
                        class="tab-pane h-auto"
                        id="step-4"
                        role="tabpanel"
                        aria-labelledby="step-4"
                    >
                        <fieldset class="mt-4">
                            <legend class="w-auto">
                                <h4>3.0 PRODUCTION AND SALES DATA FOR THE QUARTER</h4>
                            </legend>
                            <div class="row align-items-center">
                                <div class="col-sm-12">
                                    <fieldset class="mt-4 p-0">
                                        <!-- Your first fieldset content here -->
                                        <legend class="w-auto px-2">
                                            <h5 class="ms-2">3.1 Export Market</h5>
                                        </legend>
                                        <!-- FIXME: Improve the textfield format -->
                                        <div
                                            class="productExport"
                                            id="productExport"
                                        >
                                            <div class="row">
                                                <div class="mb-3">
                                                    <div class="mt-2">
                                                        <div class="d-flex justify-content-end">
                                                            <button
                                                                class="btn btn-primary"
                                                                id="addExportRow"
                                                                data-toggle="tooltip"
                                                                title="Add a new row"
                                                            >
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 64 64"
                                                                    width="25"
                                                                    height="25"
                                                                >
                                                                    <path
                                                                        d="M0 18L0 46L11.666016 46L12.554688 50L6 50L15 62L24 50L17.445312 50L18.333984 46L35.052734 46C35.138734 44.612 35.583 43.27 36 42L4 42L4 22L60 22L60 35.779297C61.549 36.832297 62.904 38.149062 64 39.664062L64 18L0 18 z M 51 36C43.82 36 38 41.82 38 49C38 56.18 43.82 62 51 62C58.18 62 64 56.18 64 49C64 41.82 58.18 36 51 36 z M 50 42L52 42C52 42 52.632625 44.583375 52.890625 47.109375C55.416625 47.367375 58 48 58 48L58 50C58 50 55.416625 50.632625 52.890625 50.890625C52.632625 53.416625 52 56 52 56L50 56C50 56 49.367375 53.416625 49.109375 50.890625C46.583375 50.632625 44 50 44 50L44 48C44 48 46.583375 47.367375 49.109375 47.109375C49.367375 44.583375 50 42 50 42 z"
                                                                        fill="#FFFFFF"
                                                                    />
                                                                </svg>
                                                            </button>
                                                            <button
                                                                class="btn btn-danger deleteExportRow mx-2"
                                                                data-toggle="tooltip"
                                                                type="button"
                                                                title="Delete row"
                                                            >
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 64 64"
                                                                    width="25"
                                                                    height="25"
                                                                >
                                                                    <path
                                                                        d="M0 9L0 47L35.052734 47C35.138734 45.612 35.391594 44.27 35.808594 43L4 43L4 13L60 13L60 34.779297C61.549 35.832297 62.904 37.149062 64 38.664062L64 9L0 9 z M 51 34C43.82 34 38 39.82 38 47C38 54.18 43.82 60 51 60C58.18 60 64 54.18 64 47C64 39.82 58.18 34 51 34 z M 51 45C53.917 45 58 46 58 46L58 48C58 48 53.917 49 51 49C48.083 49 44 48 44 48L44 46C44 46 48.083 45 51 45 z"
                                                                        fill="#FFFFFF"
                                                                    />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <table class="table Export-Outlet">
                                                        <thead>
                                                            <tr class="table-primary">
                                                                <th scope="col">Name of Product</th>
                                                                <th scope="col">Packing Details</th>
                                                                <th scope="col">Volume of Production</th>
                                                                <th scope="col">Gross Sales</th>
                                                                <th scope="col">Estimated Cost of Production
                                                                </th>
                                                                <th scope="col">Net Sales</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><input
                                                                        class="form-control"
                                                                        id="productName"
                                                                        name="productName"
                                                                        type="text"
                                                                    ></td>
                                                                <td>
                                                                    <textarea
                                                                        class="form-control"
                                                                        id="packingDetails"
                                                                        name="packingDetails"
                                                                    ></textarea>
                                                                </td>
                                                                <td><input
                                                                        class="form-control"
                                                                        id="volumeOfProduction"
                                                                        name="volumeOfProduction"
                                                                        type="text"
                                                                    ></td>
                                                                <td><input
                                                                        class="form-control"
                                                                        id="grossSales"
                                                                        name="grossSales"
                                                                        type="text"
                                                                    ></td>
                                                                <td><input
                                                                        class="form-control"
                                                                        id="estimatedCostOfProduction"
                                                                        name="estimatedCostOfProduction"
                                                                        type="text"
                                                                    ></td>
                                                                <td><input
                                                                        class="form-control"
                                                                        id="netSales"
                                                                        name="netSales"
                                                                        type="text"
                                                                    ></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </fieldset>
                                </div>
                                <div class="col-sm-12">
                                    <fieldset class="mt-4 p-0">
                                        <!-- Your second fieldset content here -->
                                        <legend class="w-auto px-2">
                                            <h5 class="ms-2">3.2 Local Market</h5>
                                        </legend>
                                        <!-- FIXME: Improve the textfield format -->
                                        <div
                                            class="productLocal"
                                            id="productLocal"
                                        >
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mt-2">
                                                        <div class="d-flex justify-content-end">
                                                            <button
                                                                class="btn btn-primary"
                                                                id="addLocalRow"
                                                                data-toggle="tooltip"
                                                                title="Add a new row"
                                                            >
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 64 64"
                                                                    width="25"
                                                                    height="25"
                                                                >
                                                                    <path
                                                                        d="M0 18L0 46L11.666016 46L12.554688 50L6 50L15 62L24 50L17.445312 50L18.333984 46L35.052734 46C35.138734 44.612 35.583 43.27 36 42L4 42L4 22L60 22L60 35.779297C61.549 36.832297 62.904 38.149062 64 39.664062L64 18L0 18 z M 51 36C43.82 36 38 41.82 38 49C38 56.18 43.82 62 51 62C58.18 62 64 56.18 64 49C64 41.82 58.18 36 51 36 z M 50 42L52 42C52 42 52.632625 44.583375 52.890625 47.109375C55.416625 47.367375 58 48 58 48L58 50C58 50 55.416625 50.632625 52.890625 50.890625C52.632625 53.416625 52 56 52 56L50 56C50 56 49.367375 53.416625 49.109375 50.890625C46.583375 50.632625 44 50 44 50L44 48C44 48 46.583375 47.367375 49.109375 47.109375C49.367375 44.583375 50 42 50 42 z"
                                                                        fill="#FFFFFF"
                                                                    />
                                                                </svg>
                                                            </button>
                                                            <button
                                                                class="btn btn-danger mx-2 deleteLocalRow"
                                                                data-toggle="tooltip"
                                                                type="button"
                                                                title="Delete row"
                                                            >
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 64 64"
                                                                    width="25"
                                                                    height="25"
                                                                >
                                                                    <path
                                                                        d="M0 9L0 47L35.052734 47C35.138734 45.612 35.391594 44.27 35.808594 43L4 43L4 13L60 13L60 34.779297C61.549 35.832297 62.904 37.149062 64 38.664062L64 9L0 9 z M 51 34C43.82 34 38 39.82 38 47C38 54.18 43.82 60 51 60C58.18 60 64 54.18 64 47C64 39.82 58.18 34 51 34 z M 51 45C53.917 45 58 46 58 46L58 48C58 48 53.917 49 51 49C48.083 49 44 48 44 48L44 46C44 46 48.083 45 51 45 z"
                                                                        fill="#FFFFFF"
                                                                    />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <table class="table local-Outlet">
                                                        <thead>
                                                            <tr class="table-primary">
                                                                <th scope="col">Name of Product</th>
                                                                <th scope="col">Packing Details</th>
                                                                <th scope="col">Volume of Production</th>
                                                                <th scope="col">Gross Sales</th>
                                                                <th scope="col">Estimated Cost of Production
                                                                </th>
                                                                <th scope="col">Net Sales</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><input
                                                                        class="form-control"
                                                                        id="productName"
                                                                        name="productName"
                                                                        type="text"
                                                                    ></td>
                                                                <td>
                                                                    <textarea
                                                                        class="form-control"
                                                                        id="packingDetails"
                                                                        name="packingDetails"
                                                                    ></textarea>
                                                                </td>
                                                                <td><input
                                                                        class="form-control"
                                                                        id="volumeOfProduction"
                                                                        name="volumeOfProduction"
                                                                        type="text"
                                                                    ></td>
                                                                <td><input
                                                                        class="form-control"
                                                                        id="grossSales"
                                                                        name="grossSales"
                                                                        type="text"
                                                                    ></td>
                                                                <td><input
                                                                        class="form-control"
                                                                        id="estimatedCostOfProduction"
                                                                        name="estimatedCostOfProduction"
                                                                        type="text"
                                                                    ></td>
                                                                <td><input
                                                                        class="form-control"
                                                                        id="netSales"
                                                                        name="netSales"
                                                                        type="text"
                                                                    ></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div
                        class="tab-pane h-50"
                        id="step-5"
                        role="tabpanel"
                        aria-labelledby="step-5"
                    >
                        <fieldset class="mt-4">
                            <legend class="w-auto">
                                <h4>4.0 MARKET OUTLETS</h4>
                            </legend>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <h5 class="ms-2">4.1 Export</h5>
                                    <div class="ms-4 mb-3">
                                        <label for="exportTextarea">Export</label>
                                        <textarea
                                            class="form-control"
                                            id="exportTextarea"
                                            placeholder="Export"
                                        ></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <h5 class="ms-2">4.2 Local</h5>
                                    <div class="ms-4 mb-3">
                                        <label for="localTextarea">Local</label>
                                        <textarea
                                            class="form-control"
                                            id="localTextarea"
                                            placeholder="Local"
                                        ></textarea>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                    </div>
                    <div
                        class="tab-pane"
                        id="step-6"
                        role="tabpanel"
                        aria-labelledby="step-5"
                    >
                        <fieldset class="mt-4">
                            <legend class="w-auto">
                                <h3>TO BE ACCOMPLISHED BY DOST XI</h3>
                            </legend>
                            <div>
                                <fieldset class="mt-4">
                                    <legend class="w-auto px-2">
                                        <h5 class="ms-2">Gross Sales Generated</h5>
                                    </legend>
                                    <div class="row ms-4">
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input
                                                    class="form-control"
                                                    id="grossSalesPeriod1"
                                                    name="grossSalesPeriod1"
                                                    type="text"
                                                    placeholder="Gross Sales {period1}"
                                                >
                                                <label for="grossSalesPeriod1">Gross Sales {period1}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input
                                                    class="form-control"
                                                    id="grossSalesPeriod2"
                                                    name="grossSalesPeriod2"
                                                    type="text"
                                                    placeholder="Gross Sales {period2}"
                                                >
                                                <label for="grossSalesPeriod2">Gross Sales {period2}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="col">
                                                <div class="col-md-6">
                                                    <p><strong>TOTAL GROSS SALES GENERATED:{Result}</strong></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>% INCREASE IN PRODUCTIVITY
                                                            GENERATED:{Result}</strong></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="mt-4">
                                    <legend class="w-auto px-2">
                                        <h5 class="ms-2">Employment Information</h5>
                                    </legend>
                                    <div class="row ms-4">
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input
                                                    class="form-control"
                                                    id="TotalEmployment2"
                                                    name="TotalEmployment2"
                                                    type="text"
                                                    placeholder="Gross Sales {period1}"
                                                >
                                                <label for="TotalEmployment2">Total Employment {period1}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input
                                                    class="form-control"
                                                    id="TotalEmployment2"
                                                    name="TotalEmployment2"
                                                    type="text"
                                                    placeholder="Gross Sales {period2}"
                                                >
                                                <label for="TotalEmployment2">Total Employment {period2}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="col">
                                                <div class="col-md-6">
                                                    <p><strong>EMPLOYMENT GENERATED:{Result}</strong></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>% INCREASE IN EMPLOMENT GENERATED:{Result}</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <div class="progress">
                    <div
                        class="progress-bar"
                        role="progressbar"
                        aria-valuenow="0"
                        aria-valuemin="0"
                        aria-valuemax="100"
                        style="width: 0%"
                    ></div>
                </div>
            </div>
            <div class="text-end">
                <button
                    class="btn btn-primary"
                    id="createSheetButton"
                >Create Sheet</button>
            </div>
        </div>

    </div>
    <div
        class="tab-pane fade"
        id="Client-tab-pane"
        role="tabpanel"
        aria-labelledby="Client-tab"
        tabindex="0"
    >
        <div
            class="p-2"
            id="cooperatorInfo"
        >\

        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        var counterExport = 0;
        var counterLocal = 0;

        function addRow(buttonSelector, tableSelector, counter) {
            $(buttonSelector).click(function() {
                counter++;

                var newRow = `
            <tr>
              <td><input type="text" class="form-control" name="productName${counter}"></td>
              <td><textarea class="form-control" name="packingDetails${counter}"></textarea></td>
              <td><input type="text" class="form-control" name="volumeOfProduction${counter}"></td>
              <td><input type="text" class="form-control" name="grossSales${counter}"></td>
              <td><input type="text" class="form-control" name="estimatedCostOfProduction${counter}"></td>
              <td><input type="text" class="form-control" name="netSales${counter}"></td>
            </tr>
          `;



                $(tableSelector).append(newRow);
                updateDeleteButtonState();
            });
        }

        function deleteRow(buttonSelector, tableSelector) {
            $(document).on('click', buttonSelector, function() {
                if ($(tableSelector + ' tr').length > 1) {
                    $(tableSelector + ' tr:last').remove();
                    updateDeleteButtonState();
                }
            });
        }

        function updateDeleteButtonState() {
            ['.deleteExportRow', '.deleteLocalRow'].forEach(function(buttonSelector) {
                var tableSelector = buttonSelector === '.deleteExportRow' ? '.Export-Outlet tbody' :
                    '.local-Outlet tbody';
                if ($(tableSelector + ' tr').length <= 1) {
                    $(buttonSelector).prop('disabled', true);
                } else {
                    $(buttonSelector).prop('disabled', false);
                }
            });
        }

        addRow('#addExportRow', '.Export-Outlet tbody', counterExport);
        deleteRow('.deleteExportRow', '.Export-Outlet tbody');

        addRow('#addLocalRow', '.local-Outlet tbody', counterLocal);
        deleteRow('.deleteLocalRow', '.local-Outlet tbody');

        updateDeleteButtonState();
    });
</script>

<script>
    $(document).ready(function() {
        $('#sw-AddProjectData').smartWizard({
            selected: 0,
            theme: 'dots',
            transition: {
                animation: 'slideHorizontal'
            },
            toolbar: {
                showNextButton: true, // show/hide a Next button
                showPreviousButton: true, // show/hide a Previous button
                position: 'both buttom', // none/ top/ both bottom
                extraHtml: `<button class="btn btn-success" onclick="onFinish()">Submit</button>
                              <button class="btn btn-secondary" onclick="onCancel()">Cancel</button>`
            },
        });
        $("#sw-AddProjectData").on("showStep", function(e, anchorObject, stepIndex, stepDirection,
            stepPosition) {
            var totalSteps = $('#sw-AddProjectData').find('ul li').length;
            // console.log("Step: ", stepNumber);
            console.log("Total Steps:", totalSteps);

            if (stepIndex === totalSteps - 1 && stepPosition === 'last') {
                console.log("Arriving at Last Step - Showing Buttons");
                $('.btn-success, .btn-secondary').show();
            } else {
                console.log("Not Arriving at Last Step - Hiding Buttons");
                $('.btn-success, .btn-secondary').hide();
            }
        });

        $('#sw-AddProjectData').on('click', 'button', function() {
            // Your function goes here
            $('#sw-AddProjectData').smartWizard('fixHeight');
        });

    });
</script>

<script>
    (function() {
        function enableNextCheckbox(currentCheckbox) {
            let parentDiv = currentCheckbox.closest('.checkbox-wrapper-26');
            let nextProgressBar = parentDiv.querySelector(
                '.line'); // Select the progress bar within the same wrapper
            let nextDiv = parentDiv.nextElementSibling; // Select the next checkbox wrapper
            let nextCheckbox = nextDiv ? nextDiv.querySelector('input[type="checkbox"]') : null;

            if (nextCheckbox) {
                nextCheckbox.disabled = false; // Enable the next checkbox
                //Calculate the height of the progress bar based on the position of the checkboxes
                let currentCheckboxBottom = parentDiv.getBoundingClientRect().bottom;
                let nextCheckboxTop = nextDiv.getBoundingClientRect().top;
                let height = nextCheckboxTop - currentCheckboxBottom;
                nextProgressBar.style.height = `68px`; // Set the height of the progress bar
                nextProgressBar.style.visibility = 'visible'; // Make the progress bar visible
                nextProgressBar.style.backgroundColor = '#07D410'; // Change the color of the progress bar
                nextProgressBar.style.bottom = '-10px'; // Align the progress bar to the bottom of the checkbox
                nextProgressBar.style.left = '1.3%'; // Align the progress bar to the center of the checkbox
                nextProgressBar.style.width = '10px'; // Set the width of the progress bar
                nextProgressBar.style.zIndex = '0';

            }
        }

        window.checkOrder = function(currentCheckbox, previousCheckboxId) {
            if (previousCheckboxId) {
                let previousCheckbox = document.getElementById(previousCheckboxId);
                if (!previousCheckbox.checked) {
                    currentCheckbox.checked = false;
                    alert('Please check the previous item first.');
                    return; // Stop further execution
                }
            }

            if (currentCheckbox.checked) {
                enableNextCheckbox(currentCheckbox);
            } else {
                let parentDiv = currentCheckbox.closest('.checkbox-wrapper-26');
                let nextProgressBar = parentDiv.querySelector('.line');
                let nextDiv = parentDiv.nextElementSibling;
                while (nextDiv) {
                    let nextCheckbox = nextDiv.querySelector('input[type="checkbox"]');
                    if (nextCheckbox) {
                        nextCheckbox.checked = false;
                        nextCheckbox.disabled = true;
                    }
                    disableProgressBar(nextProgressBar); // Reset the progress bar for each unchecked checkbox
                    nextProgressBar = nextDiv.querySelector('.line');
                    nextDiv = nextDiv.nextElementSibling;
                }
            }
        }

        function disableProgressBar(progressBar) {
            if (progressBar) {
                progressBar.style.height = '0'; // Reset progress bar height
            }
        }

        console.log("Document ready - Event listeners will be bound here.");

        $('#createSheetButton').click(function(e) {
            e.preventDefault(); // Prevent the default form submission

            $.ajax({
                url: '{{ route('staff.Create-DataSheet') }}', // URL of the PHP file you want to load
                type: 'GET', // GET or POST
                success: function(response) {
                    $('#dataSheets').html(response); // Load the response into the div
                    $('#dataSheets-form').hide(); // Hide the form
                },
                error: function() {
                    alert('Error loading the file');
                }
            });
        });

        $('#BackData').click(function() {
            $('#dataSheets').empty(); // Clear the content of the div
            $('#dataSheets-form').show(); // Unhide the form
        });
        $('#createSheetButtonInfo').click(function(e) {
            e.preventDefault(); // Prevent the default form submission

            $.ajax({
                url: '{{ route('staff.Create-InformationSheet') }}', // URL of the PHP file you want to load
                type: 'GET', // GET or POST
                success: function(response) {
                    $('#InformationSheets').html(response); // Load the response into the div
                    $('#InfoSheetForm').hide(); // Hide the form
                },
                error: function() {
                    alert('Error loading the file');
                }
            });
        });
    })();
</script>
