<style>
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

    /* Off canvas style */

    #approvedTable, #ongoingTable, #completedTable {
    table-layout: fixed;
}
    #ongoingTable_wrapper>div:first-child,
    #approvedTable_wrapper>div:first-child,
    #completedTable_wrapper>div:first-child {
        background-color: #318791;
        padding-top: 1rem;
        padding-bottom: 1rem;
        color: white;
        margin-top: 0 !important;
    }

    #approvedDetails,
    #ongoingDetails,
    #completedDetails {
        width: 50vw;
        max-width: 100%;
    }

    #sw-AddProject th {
        font-size: 12px;
    }

    /* Off canvas style end */


    /* Menu Button on Approved Project Information  */

    .menu-container {
        position: absolute;
        right: 0;
        bottom: 1%;
        padding: 2rem;
    }

    .menu-button {
        background-color: #318791;
        border-radius: 100%;
        position: absolute;
        top: 50%;
        right: 0;
        transform: translate(-50%, -50%);
        cursor: pointer;
        z-index: 10;
    }

    .menu {
        position: absolute;
        top: 50%;
        right: 0;
        transform: translate(-50%, -50%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 0;
        height: 0;
        opacity: 0;
        transition: opacity 0.3s, width 0.3s, height 0.3s;
    }

    .menu.open {
        width: 100px;
        height: 200px;
        opacity: 1;
    }

    .menu-item {
        background-color: #318791;
        color: white;
        position: absolute;
        width: auto;
        height: 40px;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 10px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .menu-item:nth-child(1) {
        transform: rotate(0deg) translate(-100px) rotate(0deg);
    }

    .menu-item:nth-child(2) {
        transform: rotate(45deg) translate(-70px) rotate(-45deg);
    }

    .menu-item:nth-child(3) {
        transform: rotate(90deg) translate(-100px) rotate(-90deg);
    }

    /* Menu Button on Approved Project Information  */

    .bottom_border {
        width: 50%;
        border-top: 0;
        border-left: 0;
        border-right: 0;
        border-bottom: 1px solid #ced4da;
    }

    .bottom_border:focus {
        outline: none;
    }
</style>
<div>
    <h4 class="p-3">Projects</h4>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb px-3">
        <li class="breadcrumb-item active">Projects</li>
    </ol>
</nav>
<div>
    {{-- offcanvas Approved Start --}}
    <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="approvedDetails"
        aria-labelledby="staticBackdropLabel">
        <div class="offcanvas-header bg-primary">
            <h5 class="offcanvas-title text-white fs-4" id="staticBackdropLabel">
                <i class="ri-file-check-fill ri-lg"></i>
                Approved Details
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="m-2">
                <div class="row gy-3 section-container" id="cooperatorDetails">
                    <div class="card p-0">
                        <div class="card-header">
                            <h5>
                                <i class="ri-contacts-fill"></i>
                                Personal Info
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row gy-2">
                                <div class="col-12 col-md-8">
                                    <label for="cooperatorName">Cooperator Name:</label>
                                    <input type="text" id="cooperatorName" class="form-control" readonly>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="designation">Designation:</label>
                                    <input type="text" id="designation" class="form-control" readonly>
                                </div>
                                <h6>Contact Details:</h6>
                                <div class="col-12 col-md-4">
                                    <label for="landline">Landline:</label>
                                    <input type="text" id="landline" class="form-control" readonly>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="mobilePhone">Mobile Phone:</label>
                                    <input type="text" id="mobilePhone" class="form-control" readonly>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="email">Email:</label>
                                    <input type="text" id="email" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card p-0">
                        <div class="card-header">
                            <span class="fw-bold fs-5">
                                <i class="ri-briefcase-fill"></i>
                                Business Info
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="row gy-2">
                                <input type="hidden" name="b_id" id="b_id">
                                <div class="col-12">
                                    <label for="businessAddress">Business Address:</label>
                                    <input type="text" id="businessAddress" class="form-control" readonly>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="typeOfEnterprise">Type of Enterprise:</label>
                                    <input type="text" id="typeOfEnterprise" class="form-control" readonly>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="enterpriseLevel">Enterprise Level:</label>
                                    <input type="text" id="enterpriseLevel" class="form-control" readonly>
                                </div>
                                <h6>Assets:</h6>
                                <div class="col-12 col-md-4">
                                    <label for="building" class="ps-2">Building:</label>
                                    <input type="text" id="building" class="form-control" readonly>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="equipment" class="ps-2">Equipment:</label>
                                    <input type="text" id="equipment" class="form-control" readonly>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="land" class="ps-2">Working Capital:</label>
                                    <input type="text" id="workingCapital" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card p-0">
                        <div class="card-header">
                            <span class="fw-bold fs-5">
                                <i class="ri-draft-fill"></i>
                                Project Information
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="row gy-2">
                                <div class="col-12 col-md-3">
                                    <label for="ProjectId_fetch">Project Id:</label>
                                    <input type="text" id="ProjectId" class="form-control" readonly value="">
                                </div>
                                <div class="col-12 col-md-9">
                                    <label for="ProjectTitle_fetch">Project Title:</label>
                                    <input type="text" id="ProjectTitle" class="form-control" readonly
                                        value="">
                                </div>
                                <div class="col-12 col-md-8">
                                    <label for="Amount_fetch">Amount:</label>
                                    <input type="text" id="Amount" class="form-control" readonly
                                        value="">
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="Applied_fetch">Date Applied:</label>
                                    <input type="text" id="Applied" class="form-control" readonly
                                        value="">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="evaluated_fetch">Evaluated by:</label>
                                    <input type="text" id="evaluated" class="form-control" readonly
                                        value="">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="Assigned_to">Assigned to:</label>
                                    <input type="text" id="Assigned_to" class="form-control" readonly
                                        value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row gy-3 section-container" id="cooperatorRequirementsLinks" style="display: none;">
                    <div class="d-flex justify-between align-items-center">
                        <h6>Cooperator Requirements:</h6>
                        <button type="button" class="btn btn-primary ms-auto" id="addRequirement"><i
                                class="ri-add-fill ri-lg"></i></button>
                    </div>
                    <div id="linkContainer">
                        <div class="col-12 linkConstInstance">
                            <div class="col-12 m-2">
                                <label for="requirements_name" class="">Requirement Name:</label>
                                <input type="text" name="requirements_name" class=" bottom_border">
                            </div>
                            <div class="input-group">
                                <label for="requirements_link" class="input-group-text"><i
                                        class="ri-links-fill"></i></label>
                                <input type="text" name="requirements_link" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row gy-3 section-container" id="createPIS" style="display: none;">
                        <div class="card p-0">
                            <div class="card-header">
                                Assistance obtained from DOST (please check)
                            </div>
                            <div class="card-body">
                                <form action="" id="PIS_checklistsForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 ps-1">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="productionTechnology">
                                                <label class="form-check-label" for="productionTechnology">
                                                    A1 Production Technology
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 ps-3">
                                            <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="process" name="process">
                                                    <label class="form-check-label " for="process">
                                                        A.1.1 Process
                                                    </label>
                                            </div>
                                            <div class="ps-4">
                                                <input type="text" class="bottom_border" name="processDefinition">
                                            </div>
                                        </div>
                                        <div class="col-12 ps-3">
                                            <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="equipment" name="equipment">
                                                    <label class="form-check-label " for="equipment">
                                                        A.1.2 Equipment
                                                    </label>
                                            </div>
                                            <div class="ps-4">
                                                <input type="text" class="bottom_border" name="processDefinition">
                                            </div>
                                        </div>
                                        <div class="col-12 ps-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="qualityControl" name="qualityControl">
                                                <label class="form-check-label " for="qualityControl">
                                                    A.1.3 Quality Control/Laboratory Testing/Analysis
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 ps-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="productionTechnology1" name="productionTechnology1">
                                                <label class="form-check-label " for="productionTechnology1">
                                                    1.3.1 Production Technology
                                                </label>
                                            </div>
                                             <div class="ps-4">
                                                <input type="text" class="bottom_border" name="qualityControlDefinition">
                                            </div>
                                        </div>
                                        <div class="col-12 ps-1">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="packagingLabeling" name="packagingLabeling">
                                                <label class="form-check-label" for="packagingLabeling">
                                                    A2 Packaging/Labeling
                                                </label>
                                            </div>
                                             <div class="ps-4">
                                                <input type="text" class="bottom_border" name="packagingLabelingDefinition">
                                            </div>
                                        </div>
                                        <div class="col-12 ps-1">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="postHarvest" name="postHarvest">
                                                <label class="form-check-label" for="postHarvest">
                                                    A3 Post-Harvest
                                                </label>
                                            </div>
                                            <div class="ps-4">
                                                <input type="text" class="bottom_border" name="postHarvestDefinition">
                                            </div>
                                        </div>
                                        <div class="col-12 ps-1">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="marketAssistance" name="marketAssistance">
                                                <label class="form-check-label" for="marketAssistance">
                                                    A4 Market Assistance
                                                </label>
                                            </div>
                                             <div class="ps-4">
                                                <input type="text" class="bottom_border" name="marketAssistanceDefinition">
                                            </div>
                                        </div>
                                        <div class="col-12 ps-1">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="humanResourceTraining" name="humanResourceTraining">
                                                <label class="form-check-label" for="humanResourceTraining">
                                                    A5 Human Resource training
                                                </label>
                                            </div>
                                             <div class="ps-4">
                                                <input type="text" class="bottom_border" name="humanResourceTrainingDefinition">
                                            </div>
                                        </div>
                                        <div class="col-12 ps-1">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="consultanceServices" name="consultanceServices">
                                                <label class="form-check-label" for="consultanceServices">
                                                    A6 Consultance Services
                                                </label>
                                            </div>
                                            <div class="ps-4">
                                                <input type="text" class="bottom_border" name="consultanceServicesDefinition">
                                            </div>
                                        </div>
                                        <div class="col-12 ps-1">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="otherServices" name="otherServices">
                                                <label class="form-check-label" for="otherServices">
                                                    A7 other Services (FDA Permit, LGU Registration, Barcoding)
                                                </label>
                                            </div>
                                             <div class="ps-4">
                                                <input type="text" class="bottom_border" name="consultanceServicesDefinition">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" id="createPISButton">Create Sheet</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Offcanvas Approved End --}}
    {{-- offcanvas Ongoing start --}}
    <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="ongoingDetails"
        aria-labelledby="staticBackdropLabel">
        <div class="offcanvas-header bg-primary">
            <h5 class="offcanvas-title text-white fs-4" id="staticBackdropLabel">
                <i class="ri-progress-3-fill ri-lg"></i>
                Ongoing Details
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="m-2">
                <div class="row gy-3">
                    <div class="card p-0">
                        <div class="card-header">
                            <h5>
                                <i class="ri-contacts-fill"></i>
                                Personal Info
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row gy-2">
                                <div class="col-12 col-md-8">
                                    <label for="cooperatorName">Cooperator Name:</label>
                                    <input type="text" class="form-control cooperatorName" readonly>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="designation">Designation:</label>
                                    <input type="text" class="form-control designation" readonly>
                                </div>
                                <h6>Contact Details:</h6>
                                <div class="col-12 col-md-4">
                                    <label for="landline">Landline:</label>
                                    <input type="text" class="form-control landline" readonly>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="mobilePhone">Mobile Phone:</label>
                                    <input type="text" class="form-control mobile_number" readonly>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="email">Email:</label>
                                    <input type="text" class="form-control email" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card p-0">
                        <div class="card-header">
                            <span class="fw-bold fs-5">
                                <i class="ri-briefcase-fill"></i>
                                Business Info
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="row gy-2">
                                <input type="hidden" name="b_id" class="b_id">
                                <div class="col-12">
                                    <label for="firmName">
                                        Firm Name:
                                    </label>
                                    <input type="text" class="form-control firmName" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="businessAddress">Business Address:</label>
                                    <input type="text"  class="form-control businessAddress" readonly>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="typeOfEnterprise">Type of Enterprise:</label>
                                    <input type="text"  class="form-control typeOfEnterprise" readonly>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="enterpriseLevel">Enterprise Level:</label>
                                    <input type="text"  class="form-control enterpriseLevel" readonly>
                                </div>
                                <h6>Assets:</h6>
                                <div class="col-12 col-md-4">
                                    <label for="building" class="ps-2">Building:</label>
                                    <input type="text"  class="form-control building" readonly>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="equipment" class="ps-2">Equipment:</label>
                                    <input type="text"  class="form-control equipment" readonly>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="land" class="ps-2">Working Capital:</label>
                                    <input type="text"  class="form-control workingCapital" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card p-0">
                        <div class="card-header">
                            <span class="fw-bold fs-5">
                                <i class="ri-file-text-fill"></i>
                                Project Details
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="row gy-2">
                                <div class="col-12 col-md-3">
                                    <label for="ProjectId_fetch">Project Id:</label>
                                    <input type="text" id="" class="form-control ProjectId" readonly value="">
                                </div>
                                <div class="col-12 col-md-9">
                                    <label for="ProjectTitle_fetch">Project Title:</label>
                                    <input type="text" id="" class="form-control ProjectTitle" readonly
                                        value="">
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="Amount_fetch">Approved Amount:</label>
                                    <input type="text" id="" class="form-control funded_amount" readonly
                                        value="">
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="amount_to_be_refunded">Amount to be refunded:</label>
                                    <input type="text" id="" class="form-control amount_to_be_refunded" readonly>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="amount_to_be_refunded">Refunded:</label>
                                    <input type="text" id="" class="form-control refunded" readonly>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="date_applied">Date Applied:</label>
                                    <input type="text" id="" class="form-control date_applied" readonly
                                        value="">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="evaluated_fetch">Evaluated by:</label>
                                    <input type="text" id="" class="form-control evaluated_by" readonly
                                        value="">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="handle_by">Assigned to:</label>
                                    <input type="text" id="" class="form-control handle_by" readonly
                                        value="">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card p-0">
                        <div class="card-header">
                            <span class="fw-bold fs-5">
                                <i class="ri-file-text-fill"></i>
                                Payment History
                            </span>
                        </div>
                        <div class="card-body">
                            <table id="paymentTable" class="table table-hover">

                            </table>
                        </div>
                    </div>
                    <div class="card p-0">
                        <div class="card-header">
                            <span class="fw-bold fs-5">
                                <i class="ri-file-text-fill"></i>
                                Requirements list
                            </span>
                        </div>
                        <div class="card-body">
                            <table id="requirementsTable" class="table table-hover">

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Offcanva Ongoing End --}}
    {{-- offcanva Complete Start --}}
    <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="completedDetails"
        aria-labelledby="staticBackdropLabel">
        <div class="offcanvas-header bg-primary">
            <h5 class="offcanvas-title text-white fs-4" id="staticBackdropLabel">
                <i class="ri-contract-fill"></i>
                Completed Details
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>Need More Info for the content</div>
        </div>
    </div>

    {{-- offcanva Complete End --}}
    {{-- Offcanva Add existing Project Start --}}
    <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="addExistingProject"
        aria-labelledby="staticBackdropLabel">
        <div class="offcanvas-header bg-primary">
            <h5 class="offcanvas-title text-white fs-4" id="staticBackdropLabel">
                <i class="ri-file-add-fill"></i>
                Add Existing Project
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                <div id="sw-AddProject" class="p-4">
                    <ul class="nav nav-progress">
                        <li class="nav-item">
                            <a class="nav-link default active z-3" href="#step-1">
                                <div class="num">1</div>
                                Cooperator Info
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link default z-3" href="#step-2">
                                <span class="num">2</span>
                                Assests
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link default z-3" href="#step-3">
                                <span class="num">3</span>
                                TOTAL EMPLOYMENT
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link default z-3" href="#step-4">
                                <span class="num">4</span>
                                PRODUCTION AND SALES
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link default z-3" href="#step-5">
                                <span class="num">5</span>
                                Market Outlets
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link default z-3" href="#step-6">
                                <span class="num">6</span>
                                Increase in
                            </a>

                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                            Step content
                            <fieldset>
                                <legend class="w-auto">
                                    <h2>Cooperator Info:</h2>
                                </legend>
                                <div class="p-3">
                                    <div class="form-group row mt-2">
                                        <label for="project_title" class="col-12 col-sm-2"><strong>Project
                                                Title:</strong></label>
                                        <div class="col-12 col-sm-10">
                                            <input type="text" class="form-control" id="project_title"
                                                placeholder="[Project Title Value]">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-2">
                                        <label for="firm_name" class="col-12 col-sm-2"><strong>Name of
                                                Firm:</strong></label>
                                        <div class="col-12 col-sm-10">
                                            <input type="text" class="form-control" id="firm_name"
                                                placeholder="[Firm Name Value]">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-2">
                                        <label for="address"
                                            class="col-12 col-sm-2"><strong>Address:</strong></label>
                                        <div class="col-12 col-sm-10">
                                            <input type="text" class="form-control" id="address"
                                                placeholder="[Address Value]">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-2">
                                        <label for="contact_person" class="col-12 col-sm-2"><strong>Contact
                                                Person:</strong></label>
                                        <div class="col-12 col-sm-4">
                                            <input type="text" class="form-control" id="contact_person"
                                                placeholder="[Contact Person Value]">
                                        </div>
                                        <label for="designation"
                                            class="col-12 col-sm-2"><strong>Designation:</strong></label>
                                        <div class="col-12 col-sm-4">
                                            <input type="text" class="form-control" id="designation"
                                                placeholder="[Designation Value]">
                                        </div>
                                        <div class="form-group row mt-2">
                                            <label for="landline"
                                                class="col-12 col-sm-2"><strong>Landline:</strong></label>
                                            <div class="col-12 col-sm-2">
                                                <input type="text" class="form-control" id="landline"
                                                    placeholder="[Landline Value]">
                                            </div>
                                            <label for="mobile_phone" class="col-12 col-sm-2"><strong>Mobile
                                                    Phone:</strong></label>
                                            <div class="col-12 col-sm-2">
                                                <input type="text" class="form-control" id="mobile_phone"
                                                    placeholder="[Mobile Phone Value]">
                                            </div>
                                            <label for="email" class="col-12 col-sm-2"><strong>Email
                                                    Address:</strong></label>
                                            <div class="col-12 col-sm-2">
                                                <input type="text" class="form-control" id="email"
                                                    placeholder="[Email Address Value]">
                                            </div>
                                        </div>
                                    </div>

                            </fieldset>
                        </div>
                        <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                            <fieldset class="">
                                <legend class="w-auto">
                                    <h4>1.0 ASSETS</h4>
                                </legend>
                                <div class="row ms-md-4 mb-3">
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <label for="BuildingAsset">Building:</label>
                                        <input type="text" class="form-control" id="BuildingAsset"
                                            name="Building" placeholder="">
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <label for="Equipment">Equipment:</label>
                                        <input type="text" class="form-control" id="Equipment" name="Equipment"
                                            placeholder="">
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <label for="WorkingCapital">Working Capital:</label>
                                        <input type="text" class="form-control" id="WorkingCapital"
                                            name="WorkingCapital" placeholder="">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
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
                                                                <td><input type="text" class="form-control"
                                                                        id="maleInput" placeholder=""></td>
                                                                <td><input type="text" class="form-control"
                                                                        id="femaleInput" placeholder=""></td>
                                                                <td><input type="text" class="form-control"
                                                                        id="workdayInput" placeholder=""></td>
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
                                                                <td><input type="text" class="form-control"
                                                                        id="parttimeMaleInput" placeholder="">
                                                                </td>
                                                                <td><input type="text" class="form-control"
                                                                        id="parttimeFemaleInput" placeholder="">
                                                                </td>
                                                                <td><input type="text" class="form-control"
                                                                        id="parttimeWorkdayInput" placeholder="">
                                                                </td>
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
                                                                <td><input type="text" class="form-control"
                                                                        id="regularMaleInput" placeholder=""></td>
                                                                <td><input type="text" class="form-control"
                                                                        id="regularFemaleInput" placeholder="">
                                                                </td>
                                                                <td><input type="text" class="form-control"
                                                                        id="regularWorkdayInput" placeholder="">
                                                                </td>
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
                                                                <td><input type="text" class="form-control"
                                                                        id="parttimeMaleInput" placeholder="">
                                                                </td>
                                                                <td><input type="text" class="form-control"
                                                                        id="parttimeFemaleInput" placeholder="">
                                                                </td>
                                                                <td><input type="text" class="form-control"
                                                                        id="parttimeWorkdayInput" placeholder="">
                                                                </td>
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
                        <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
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
                                            <div id="productExport" class="productExport">
                                                <div class="row">
                                                    <div class="mb-3">
                                                        <div class="mt-2">
                                                            <div class="d-flex justify-content-end">
                                                                <button id="addExportRow" class="btn btn-primary"
                                                                    data-toggle="tooltip" title="Add a new row">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 64 64" width="25"
                                                                        height="25">
                                                                        <path
                                                                            d="M0 18L0 46L11.666016 46L12.554688 50L6 50L15 62L24 50L17.445312 50L18.333984 46L35.052734 46C35.138734 44.612 35.583 43.27 36 42L4 42L4 22L60 22L60 35.779297C61.549 36.832297 62.904 38.149062 64 39.664062L64 18L0 18 z M 51 36C43.82 36 38 41.82 38 49C38 56.18 43.82 62 51 62C58.18 62 64 56.18 64 49C64 41.82 58.18 36 51 36 z M 50 42L52 42C52 42 52.632625 44.583375 52.890625 47.109375C55.416625 47.367375 58 48 58 48L58 50C58 50 55.416625 50.632625 52.890625 50.890625C52.632625 53.416625 52 56 52 56L50 56C50 56 49.367375 53.416625 49.109375 50.890625C46.583375 50.632625 44 50 44 50L44 48C44 48 46.583375 47.367375 49.109375 47.109375C49.367375 44.583375 50 42 50 42 z"
                                                                            fill="#FFFFFF" />
                                                                    </svg>
                                                                </button>
                                                                <button type="button"
                                                                    class="btn btn-danger deleteExportRow mx-2"
                                                                    data-toggle="tooltip" title="Delete row">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 64 64" width="25"
                                                                        height="25">
                                                                        <path
                                                                            d="M0 9L0 47L35.052734 47C35.138734 45.612 35.391594 44.27 35.808594 43L4 43L4 13L60 13L60 34.779297C61.549 35.832297 62.904 37.149062 64 38.664062L64 9L0 9 z M 51 34C43.82 34 38 39.82 38 47C38 54.18 43.82 60 51 60C58.18 60 64 54.18 64 47C64 39.82 58.18 34 51 34 z M 51 45C53.917 45 58 46 58 46L58 48C58 48 53.917 49 51 49C48.083 49 44 48 44 48L44 46C44 46 48.083 45 51 45 z"
                                                                            fill="#FFFFFF" />
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
                                                                    <td><input type="text" class="form-control"
                                                                            id="productName" name="productName">
                                                                    </td>
                                                                    <td>
                                                                        <textarea class="form-control" id="packingDetails" name="packingDetails"></textarea>
                                                                    </td>
                                                                    <td><input type="text" class="form-control"
                                                                            id="volumeOfProduction"
                                                                            name="volumeOfProduction"></td>
                                                                    <td><input type="text" class="form-control"
                                                                            id="grossSales" name="grossSales">
                                                                    </td>
                                                                    <td><input type="text" class="form-control"
                                                                            id="estimatedCostOfProduction"
                                                                            name="estimatedCostOfProduction"></td>
                                                                    <td><input type="text" class="form-control"
                                                                            id="netSales" name="netSales"></td>
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
                                            <div id="productLocal" class="productLocal">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mt-2">
                                                            <div class="d-flex justify-content-end">
                                                                <button id="addLocalRow" class="btn btn-primary"
                                                                    data-toggle="tooltip" title="Add a new row">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 64 64" width="25"
                                                                        height="25">
                                                                        <path
                                                                            d="M0 18L0 46L11.666016 46L12.554688 50L6 50L15 62L24 50L17.445312 50L18.333984 46L35.052734 46C35.138734 44.612 35.583 43.27 36 42L4 42L4 22L60 22L60 35.779297C61.549 36.832297 62.904 38.149062 64 39.664062L64 18L0 18 z M 51 36C43.82 36 38 41.82 38 49C38 56.18 43.82 62 51 62C58.18 62 64 56.18 64 49C64 41.82 58.18 36 51 36 z M 50 42L52 42C52 42 52.632625 44.583375 52.890625 47.109375C55.416625 47.367375 58 48 58 48L58 50C58 50 55.416625 50.632625 52.890625 50.890625C52.632625 53.416625 52 56 52 56L50 56C50 56 49.367375 53.416625 49.109375 50.890625C46.583375 50.632625 44 50 44 50L44 48C44 48 46.583375 47.367375 49.109375 47.109375C49.367375 44.583375 50 42 50 42 z"
                                                                            fill="#FFFFFF" />
                                                                    </svg>
                                                                </button>
                                                                <button type="button"
                                                                    class="btn btn-danger mx-2 deleteLocalRow"
                                                                    data-toggle="tooltip" title="Delete row">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 64 64" width="25"
                                                                        height="25">
                                                                        <path
                                                                            d="M0 9L0 47L35.052734 47C35.138734 45.612 35.391594 44.27 35.808594 43L4 43L4 13L60 13L60 34.779297C61.549 35.832297 62.904 37.149062 64 38.664062L64 9L0 9 z M 51 34C43.82 34 38 39.82 38 47C38 54.18 43.82 60 51 60C58.18 60 64 54.18 64 47C64 39.82 58.18 34 51 34 z M 51 45C53.917 45 58 46 58 46L58 48C58 48 53.917 49 51 49C48.083 49 44 48 44 48L44 46C44 46 48.083 45 51 45 z"
                                                                            fill="#FFFFFF" />
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
                                                                    <td><input type="text" class="form-control"
                                                                            id="productName" name="productName">
                                                                    </td>
                                                                    <td>
                                                                        <textarea class="form-control" id="packingDetails" name="packingDetails"></textarea>
                                                                    </td>
                                                                    <td><input type="text" class="form-control"
                                                                            id="volumeOfProduction"
                                                                            name="volumeOfProduction"></td>
                                                                    <td><input type="text" class="form-control"
                                                                            id="grossSales" name="grossSales">
                                                                    </td>
                                                                    <td><input type="text" class="form-control"
                                                                            id="estimatedCostOfProduction"
                                                                            name="estimatedCostOfProduction"></td>
                                                                    <td><input type="text" class="form-control"
                                                                            id="netSales" name="netSales"></td>
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
                        <div id="step-5" class="tab-pane h-50" role="tabpanel" aria-labelledby="step-5">
                            <fieldset class="mt-4">
                                <legend class="w-auto">
                                    <h4>4.0 MARKET OUTLETS</h4>
                                </legend>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <h5 class="ms-2">4.1 Export</h5>
                                        <div class="ms-4 mb-3">
                                            <label for="exportTextarea">Export</label>
                                            <textarea class="form-control" placeholder="Export" id="exportTextarea"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <h5 class="ms-2">4.2 Local</h5>
                                        <div class="ms-4 mb-3">
                                            <label for="localTextarea">Local</label>
                                            <textarea class="form-control" placeholder="Local" id="localTextarea"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                        </div>
                        <div id="step-6" class="tab-pane" role="tabpanel" aria-labelledby="step-5">
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
                                                    <input type="text" class="form-control" id="grossSalesPeriod1"
                                                        name="grossSalesPeriod1" placeholder="Gross Sales {period1}">
                                                    <label for="grossSalesPeriod1">Gross Sales {period1}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="grossSalesPeriod2"
                                                        name="grossSalesPeriod2" placeholder="Gross Sales {period2}">
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
                                                                GENERATED:{Result}</strong>
                                                        </p>
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
                                                    <input type="text" class="form-control" id="TotalEmployment2"
                                                        name="TotalEmployment2" placeholder="Gross Sales {period1}">
                                                    <label for="TotalEmployment2">Total Employment
                                                        {period1}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="TotalEmployment2"
                                                        name="TotalEmployment2" placeholder="Gross Sales {period2}">
                                                    <label for="TotalEmployment2">Total Employment
                                                        {period2}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="col">
                                                    <div class="col-md-6">
                                                        <p><strong>EMPLOYMENT GENERATED:{Result}</strong></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><strong>% INCREASE IN EMPLOMENT
                                                                GENERATED:{Result}</strong>
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
                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- offcanva Add existing Project end  --}}
    <div class="">
        <!--Project Information sheet Modal start-->
        <div class="modal fade" id="PISModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Project Information Sheet</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div id="PIS_Modal_container">

                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ongoing Modal end-->
        <div class="modal fade" id="OngoingModal" tabindex="-1" aria-labelledby="OngoingModalLabel"
            aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="OngoingModalLabel">Ongoing Project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Modal content goes here -->
                        <div>
                            <h6>Project Title:</h6>
                            <p class="ps-2">"Improvent the business 1"</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-dismiss="modal" id="dashboardLink"
                            onclick="loadPage('/org-access/viewCooperatorInfo.php','projectLink');">View</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="card m-0 m-md-3">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#addExistingProject" aria-controls="addExistingProject">
                        <i class="ri-file-add-fill"></i>
                    </button>
                </div>

                <div class="col-12">
                    <ul class="nav nav-tabs ps-3" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tab-Nav active" id="Approved-tab" data-bs-toggle="tab"
                                data-bs-target="#Approved-tab-pane" type="button" role="tab"
                                aria-controls="Approved-tab-pane" aria-selected="true">
                                <i class="ri-file-check-fill ri-lg"></i>
                                Approved Projects
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tab-Nav" id="Ongoing-tab" data-bs-toggle="tab"
                                data-bs-target="#Ongoing-tab-pane" type="button" role="tab"
                                aria-controls="Ongoing-tab-pane" aria-selected="false">
                                <i class="ri-progress-3-fill ri-lg"></i>
                                Ongoing Projects
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tab-Nav" id="Complete-tab" data-bs-toggle="tab"
                                data-bs-target="#completed-tab-pane" type="button" role="tab"
                                aria-controls="completed-tab-pane" aria-selected="false">
                                <i class="ri-contract-fill ri-lg"></i>
                                Completed Projects
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="tab-content bg-white mt-0 mx-3 mb-3" id="myTabContent">
                    <!-- first tab here -->
                    <div class="tab-pane fade show active" id="Approved-tab-pane" role="tabpanel"
                        aria-labelledby="Approved-tab" tabindex="0">
                        <!-- Where the applicant table start -->
                        <div class="table-responsive-sm">
                            <table id="approvedTable" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Project #</th>
                                        <th>Client Name</th>
                                        <th>Firm Name</th>
                                        <th>Project Title</th>
                                        <th>Date Approved</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="ApprovedtableBody" class=" table-group-divider">
                                    @if (isset($approved) && count($approved) > 0)
                                        @foreach ($approved as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->f_name }} {{ $item->l_name }}</td>
                                                <td>{{ $item->designation }}</td>
                                                <td>{{ $item->firm_name }}</td>
                                                <td>
                                                    <div>
                                                        <strong>Business Address:</strong> <br> {{ $item->landMark }},
                                                        {{ $item->barangay }}, {{ $item->city }},
                                                        {{ $item->province }}, {{ $item->region }} <br>
                                                        <strong>Type of Enterprise:</strong>
                                                        {{ $item->enterprise_type }}
                                                        <br>
                                                        <strong>Level of Enterprise:</strong>
                                                        {{ $item->enterprise_level }}
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <strong>Assets:</strong> <br>
                                                        <span class="ps-2">Land:
                                                            {{ number_format($item->building_value, 2) }}</span><br>
                                                        <span class="ps-2">Building:
                                                            {{ number_format($item->equipment_value, 2) }}</span> <br>
                                                        <span class="ps-2">Equipment:
                                                            {{ number_format($item->working_capital, 2) }}</span>
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <strong>Contact Details:</strong><br>
                                                        <span class="p-2">Mobile Phone:</span>
                                                        {{ $item->mobile_number }}
                                                        <br>
                                                        <span class="p-2">Email:</span> {{ $item->email }} <br>
                                                        <span class="p-2">Landline:</span> {{ $item->landline }}
                                                        <br>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p>
                                                        <strong>Title of the Project:</strong> <br>
                                                        <span class="ps-2">{{ $item->project_title }}</span><br>
                                                        <strong>Approved fund:</strong><br>
                                                        <span
                                                            class="ps-2">{{ number_format($item->fund_amount, 2) }}</span><br>
                                                        <strong>Approved Date:</strong><br>
                                                        <span class="ps-2">{{ $item->date_approved }}</span><br><br>
                                                        <strong>Assigned Staff:</strong><br>
                                                        <span class="ps-2">{{ $item->full_name }}</span>
                                                    </p>
                                                </td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button class="btn btn-primary" type="button"
                                                        data-bs-toggle="offcanvas" data-bs-target="#approvedDetails"
                                                        aria-controls="approvedDetails">
                                                        <i class="ri-menu-unfold-4-line ri-1x"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                        </div>

                        <!-- Where the applicant table end -->
                    </div>
                    <!-- second tab here -->
                    <div class="tab-pane fade" id="Ongoing-tab-pane" role="tabpanel" aria-labelledby="Ongoing-tab"
                        tabindex="0">
                        <!-- Where the Ongoing Table Start -->
                        <div class="table-responsive-sm">
                            <table id="ongoingTable" class="table table-hover" style="width:100%">
                                <thead>
                                </thead>
                                <tbody id="OngoingTableBody" class="table-group-divider">
                                </tbody>
                            </table>
                        </div>
                        <!-- Where the Ongoing Table End -->
                    </div>
                    <div class="tab-pane fade" id="completed-tab-pane" role="tabpanel"
                        aria-labelledby="Complete-tab" tabindex="0">
                        <div class=" table-responsive-sm">
                            <table id="completedTable" class="table table-hover mx-2" style="width:100%">
                                <tbody id="tableBody" class=" table-responsive-sm">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#approvedDetails').on('click', '.menu-button', function() {
                event.stopPropagation();
                console.log('Menu button clicked');
                $('.menu').toggleClass('open');
                if ($('.menu').hasClass('open')) {
                    $('.menu').css('display', 'flex');
                    $('#menu-icon-state').removeClass('ri-menu-2-fill ri-lg').addClass(
                        'ri-close-fill ri-lg');
                } else {
                    $('.menu').css('display', 'none');
                    $('#menu-icon-state').removeClass('ri-close-fill ri-lg').addClass(
                        'ri-menu-2-fill ri-lg');
                }
            });
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

    <script type="module">
        $(document).ready(function() {
            $('#sw-AddProject').smartWizard({
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
            $("#sw-AddProject").on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {
                var totalSteps = $('#sw-AddProject').find('ul li').length;
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
            $('#sw-AddProject').on('click', 'button', function() {
                // Your function goes here
                $('#sw-AddProject').smartWizard('fixHeight');
            });

        });
    </script>
