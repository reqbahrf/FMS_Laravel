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
    table-layout: auto;
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

    #ongoingTable_wrapper>div:nth-child(2),
    #approvedTable_wrapper>div:nth-child(2),
    #completedTable_wrapper>div:nth-child(2) {
        overflow: auto;
    }

    #approvedDetails,
    #ongoingDetails,
    #completedDetails {
        width: 50vw;
        max-width: 100%;
    }

    #sw-AddProject th {
        font-size: 0.75rem;
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
                        <div class="card-header bg-primary">
                            <h5 class="text-white mb-0">
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
                        <div class="card-header bg-primary">
                            <h5 class="text-white mb-0">
                                <i class="ri-briefcase-fill"></i>
                                Business Info
                            </h5>
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
                        <div class="card-header bg-primary">
                            <h5 class="text-white mb-0">
                                <i class="ri-file-text-fill"></i>
                                Project Details
                            </h5>
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
                        <div class="card-header bg-primary">
                            <h5 class="text-white mb-0">
                                <i class="ri-file-text-fill"></i>
                                Payment History
                            </h5>
                        </div>
                        <div class="card-body">
                            <table id="paymentHistoryTable" class="table table-hover" style="width: 100%";>

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
            <div class="m-2">
                <div class="row gy-3">
                    <div class="card p-0">
                        <div class="card-header bg-primary">
                            <h5 class="text-white mb-0">
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
                        <div class="card-header bg-primary">
                            <h5 class="text-white mb-0">
                                <i class="ri-briefcase-fill"></i>
                                Business Info
                            </h5>
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
                        <div class="card-header bg-primary">
                            <h5 class="text-white mb-0">
                                <i class="ri-file-text-fill"></i>
                                Project Details
                            </h5>
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
                        <div class="card-header bg-primary">
                            <h5 class="text-white mb-0">
                                <i class="ri-file-text-fill"></i>
                                Payment History
                            </h5>
                        </div>
                        <div class="card-body">
                            <table id="paymentTable" class="table table-hover">

                            </table>
                        </div>
                    </div>
                    <div class="card p-0">
                        <div class="card-header bg-primary">
                            <h5 class="text-white mb-0">
                                <i class="ri-file-text-fill"></i>
                                Requirements list
                            </h5>
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

    <div class="">
        <div class="card m-0 m-md-3">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-sm btn-primary" type="button" id="addProjectManualy">
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
                                    {{-- @if (isset($approved) && count($approved) > 0)
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
                                    @endif --}}
                                </tbody>
                            </table>
                        <!-- Where the applicant table end -->
                    </div>
                    <!-- second tab here -->
                    <div class="tab-pane fade" id="Ongoing-tab-pane" role="tabpanel" aria-labelledby="Ongoing-tab"
                        tabindex="0">
                        <!-- Where the Ongoing Table Start -->
                            <table id="ongoingTable" class="table table-hover" style="width:100%">
                                <thead>
                                </thead>
                                <tbody id="OngoingTableBody" class="table-group-divider">
                                </tbody>
                            </table>
                        <!-- Where the Ongoing Table End -->
                    </div>
                    <div class="tab-pane fade" id="completed-tab-pane" role="tabpanel"
                        aria-labelledby="Complete-tab" tabindex="0">
                        <!-- Where the Ongoing Table Start -->
                            <table id="completedTable" class="table table-hover" style="width:100%">
                                <tbody id="CompletedTableBody" class=" table-group-divider">
                                </tbody>
                            </table>
                        <!-- Where the Ongoing Table End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
