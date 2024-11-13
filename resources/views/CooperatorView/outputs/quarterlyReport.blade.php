<style>
    #smartwizard th {
        font-size: clamp(12px, 1vw, 13px);
    }

    #smartwizard th.theader {
        font-size: 40px;
    }

    .volumeUnit {
        max-width: 130px;
    }

    .netSales_val {
        pointer-events: none;
    }

    span.requiredFields {
            color: red;
        }

    @media screen and (max-width: 768px) {

        .table th,
        .table td {
            min-width: 35vw;
        }
    }
</style>
<div class="p-3">
    <h4>Quarterly Report for {{ $quarter }}</h4>
</div>
<div class="card m-0 m-md-3">
    <div class="card-body">
        <div class="quarterly-Report-wrapper">
            <form id="quarterlyForm" data-quarter-id="{{ $reportId }}" data-quarter-project="{{ $projectId }}" data-quarter-period="{{ $quarter }}" data-quarter-status="{{ $reportStatus }}">
                <div id="smartwizard" class="my-4">
                    <ul class="nav nav-progress">
                        <li class="nav-item">
                            <a class="nav-link active z-3" href="#step-1">
                                <div class="num">1</div>
                                Assets
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link z-3" href="#step-2">
                                <span class="num">2</span>
                                Total Employment
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link z-3" href="#step-3">
                                <span class="num">3</span>
                                Production and Sales
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link z-3" href="#step-4">
                                <span class="num">4</span>
                                Market Outlets
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                            <h5>1.0 Assets</h5>
                            <div class="row ms-md-4 ms-sm-2 my-4">
                                <div class="col-12 my-3">
                                    <div class="alert alert-primary m-0" role="alert">
                                        <i class="ri-information-2-fill ri-lg"></i>
                                        Kindly provide the current assets for the building, equipment, and working capital for the current quarter.
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="BuildingAsset">Building: <span class="requiredFields">
                                            *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            ₱
                                        </span>
                                        <input type="text" class="form-control" id="BuildingAsset" name="Building"
                                            placeholder="500,000" >
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <Label for="Equipment">Equipment <span class="requiredFields">
                                            *</span></Label>
                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>
                                        <input type="text" class="form-control" id="Equipment" name="Equipment"
                                            placeholder="500,000" >
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="workingCapital">Working Capital <span class="requiredFields">
                                            *</span></label>
                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₱
                                        </span>
                                        <input type="text" class="form-control" id="WorkingCapital"
                                            name="WorkingCapital" placeholder="500,000" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                            <h5>2.0 Total Employment</h5>
                            <div class="card mb-0 mb-md-3">
                                <div class="card-header">
                                    2.1 Direct Labor(Production)
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-8">
                                            <div class="alert alert-primary h-100" role="alert">
                                                <h5 class="alert-heading"> <i
                                                    class="ri-information-2-fill"></i> Direct Personnel
                                            </h5>
                                            <p>Direct personnel are those who are actively involved in the
                                                production process of the products, an example are
                                                Operators, Assemblers, and quality control inspectors.
                                                <br>
                                                <ul>
                                                    <li>Please provide the number of regular and part-time direct employees for both male and female.</li>
                                                    <li>Please also provide the total number of workdays for this quarter.</li>
                                                </ul>
                                            </p>
                                            <hr>
                                            <p class="mb-0 text-secondary text-small">You may enter zero if
                                                none
                                            </p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="card my-2">
                                                        <div class="card-header">
                                                            2.1a Direct Labor
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <label for="maleInput">Male:</label>
                                                                    <input type="text" name="male_Dir_Regular"
                                                                        class="form-control number_input_only" id="maleInput">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="maleInput">Female:</label>
                                                                    <input type="text" name="female_Dir_Regular"
                                                                        class="form-control number_input_only" id="femaleInput">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="maleInput">Workday:</label>
                                                                    <input type="text" name="workday_Dir_Regular"
                                                                        class="form-control number_input_only" id="workdayInput">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="card my-2">
                                                        <div class="card-header">
                                                            2.1b Part Time
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <label for="maleInput">Male:</label>
                                                                    <input type="text" name="male_Dir_PartT"
                                                                        class="form-control number_input_only" id="parttimeMaleInput">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="maleInput">Female:</label>
                                                                    <input type="text" name="female_Dir_PartT"
                                                                        class="form-control number_input_only" id="parttimeFemaleInput">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="maleInput">Workday:</label>
                                                                    <input type="text" name="workday_Dir_PartT"
                                                                        class="form-control number_input_only"
                                                                        id="parttimeWorkdayInput">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-0 mb-md-3">
                                <div class="card-header">
                                    2.2 Indirect Labor(Admin and Marketing)
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-8">
                                            <div class="alert alert-primary h-100" role="alert">
                                                <h5 class="alert-heading"> <i
                                                    class="ri-information-2-fill"></i> Indirect Personnel
                                            </h5>
                                            <p>Indirect personnel are those who are not actively involved in
                                                the production process of the products, such as
                                                Administrative staff, Managers, and Maintenance workers.
                                                <br>
                                                <ul>
                                                    <li>Please provide the number of regular and part-time indirect employees for both male and female.</li>
                                                    <li>Please also provide the total number of workdays for this quarter.</li>
                                                </ul>

                                            </p>
                                            <hr>
                                            <p class="mb-0 text-secondary text-small">You may enter zero if
                                                none</p>
                                            </div>

                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="card my-2">
                                                        <div class="card-header">
                                                            2.2a Direct Labor
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <label for="regularMaleInput">Male:</label>
                                                                    <input type="text" name="male_Indir_Regular"
                                                                        class="form-control number_input_only" id="regularMaleInput">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="regularFemaleInput">Female:</label>
                                                                    <input type="text" name="female_Indir_Regular"
                                                                        class="form-control number_input_only" id="regularFemaleInput">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="regularWorkdayInput">Workday:</label>
                                                                    <input type="text" name="workday_Indir_Regular"
                                                                        class="form-control number_input_only" id="regularWorkdayInput">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="card my-2">
                                                        <div class="card-header">
                                                            2.2b Part Time
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <label for="parttimeMaleInput">Male: </label>
                                                                    <input type="text" name="male_Indir_PartT"
                                                                        class="form-control number_input_only" id="parttimeMaleInput">

                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="parttimeFemaleInput">Female: </label>
                                                                    <input type="text" name="female_Indir_PartT"
                                                                        class="form-control number_input_only" id="parttimeFemaleInput">

                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="parttimeWorkdayInput">Workday: </label>
                                                                    <input type="text" name="workday_Indir_PartT"
                                                                        class="form-control number_input_only"
                                                                        id="parttimeWorkdayInput">

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                            <h5>3.0 PRODUCTION AND SALES DATA FOR THE QUARTER</h5>
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <div class="alert alert-primary h-100" role="alert">
                                        <h5 class="alert-heading">
                                            <i class="ri-information-2-fill"></i> Export and Local Market Product
                                        </h5>
                                    <p>Please provide the necesary product Infomarmation for this Export and Local Market. The following are required Information for the product:
                                        <br>
                                        <ul>
                                            <li>Product Name</li>
                                            <li>Packaging Details</li>
                                            <li>Volume of the product</li>
                                            <li>Gross Sales</li>
                                            <li>Estimated cost of production</li>
                                        </ul>
                                      You may add or delete rows as needed.
                                    </p>
                                    <hr>
                                    <p class="mb-0 text-secondary text-small">You may enter none on the product name if
                                        not applicable.
                                    </p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div id="productExport" class="productExport">
                                        <strong>3.1 Export Market</strong>
                                        <div class="row">
                                            <div class="mb-3">
                                                <div class="mt-2">
                                                    <div class="d-flex justify-content-end p-2">
                                                        <button type="button" id="addExportRow"
                                                            class="btn btn-primary" data-toggle="tooltip"
                                                            title="Add a new row">
                                                            <i class="ri-add-box-fill"></i>

                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-danger deleteExportRow mx-2"
                                                            data-toggle="tooltip" title="Delete row">
                                                            <i class="ri-subtract-fill"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table Export-Outlet">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Name of Product</th>
                                                                <th scope="col">Packing Details</th>
                                                                <th scope="col">Volume of Production</th>
                                                                <th scope="col">Gross Sales</th>
                                                                <th scope="col">Estimated Cost of Production
                                                                </th>
                                                                <th scope="col">Net Sales</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="ExportData table-group-divider">
                                                            <tr class="table_row">
                                                                <td>
                                                                    <input type="text" class="form-control productName"
                                                                    >
                                                                </td>
                                                                <td>
                                                                    <textarea class="form-control w-100 packingDetails"></textarea>
                                                                </td>
                                                                <td>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control productionVolume_val">
                                                                        <select class="form-select volumeUnit">
                                                                            <!-- Volume Units -->
                                                                            <optgroup label="Volume">
                                                                                <option value="mL">Milliliters
                                                                                    (mL)</option>
                                                                                <option value="cm³">Cubic
                                                                                    Centimeters (cm³)</option>
                                                                                <option value="fl oz">Fluid
                                                                                    Ounces (fl oz)</option>
                                                                                <option value="cup">Cups (cup)
                                                                                </option>
                                                                                <option value="pt">Pints (pt)
                                                                                </option>
                                                                                <option value="qt">Quarts (qt)
                                                                                </option>
                                                                                <option value="L">Liters (L)
                                                                                </option>
                                                                                <option value="gal">Gallons (gal)
                                                                                </option>
                                                                                <option value="in³">Cubic
                                                                                    Inches (in³)
                                                                                </option>
                                                                                <option value="ft³">Cubic Feet
                                                                                    (ft³)</option>
                                                                                <option value="m³">Cubic
                                                                                    Meters (m³)
                                                                                </option>
                                                                            </optgroup>
                                                                            <!-- Weight Units -->
                                                                            <optgroup label="Weight">
                                                                                <option value="g">Grams (g)
                                                                                </option>
                                                                                <option value="oz">Ounces (oz)
                                                                                </option>
                                                                                <option value="lb">Pounds (lb)
                                                                                </option>
                                                                                <option value="kg">Kilograms
                                                                                    (kg)</option>
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">
                                                                            ₱
                                                                        </span>
                                                                        <input type="text" class="form-control grossSales_val"
                                                                           >
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">
                                                                            ₱
                                                                        </span>
                                                                        <input type="text" class="form-control estimatedCostOfProduction_val"
                                                                            >
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">
                                                                            ₱
                                                                        </span>
                                                                        <input type="text" class="form-control netSales_val"
                                                                            >
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div id="productLocal" class="productLocal">
                                        <strong>3.2 Local Market</strong>
                                        <div class="row p-0">
                                            <div class="col-12">
                                                <div class="mt-2">
                                                    <div class="d-flex justify-content-end p-2">
                                                        <button type="button" id="addLocalRow"
                                                            class="btn btn-primary" data-toggle="tooltip"
                                                            title="Add a new row">
                                                            <i class="ri-add-box-fill"></i>
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-danger mx-2 deleteLocalRow"
                                                            data-toggle="tooltip" title="Delete row">
                                                            <i class="ri-subtract-fill"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table local-Outlet">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Name of Product</th>
                                                                <th scope="col">Packing Details</th>
                                                                <th scope="col">Volume of Production</th>
                                                                <th scope="col">Gross Sales</th>
                                                                <th scope="col">Estimated Cost of Production
                                                                </th>
                                                                <th scope="col">Net Sales</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="LocalData table-group-divider">
                                                            <tr class="table_row">
                                                                <td><input type="text" class="form-control productName"
                                                                       ></td>
                                                                <td>
                                                                    <textarea class="form-control packingDetails"></textarea>
                                                                </td>
                                                                <td>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control productionVolume_val"
                                                                           >
                                                                            <select class="form-select volumeUnit">
                                                                                <!-- Volume Units -->
                                                                                <optgroup label="Volume">
                                                                                    <option value="mL">Milliliters
                                                                                        (mL)</option>
                                                                                    <option value="cm³">Cubic
                                                                                        Centimeters (cm³)</option>
                                                                                    <option value="fl oz">Fluid
                                                                                        Ounces (fl oz)</option>
                                                                                    <option value="cup">Cups (cup)
                                                                                    </option>
                                                                                    <option value="pt">Pints (pt)
                                                                                    </option>
                                                                                    <option value="qt">Quarts (qt)
                                                                                    </option>
                                                                                    <option value="L">Liters (L)
                                                                                    </option>
                                                                                    <option value="gal">Gallons (gal)
                                                                                    </option>
                                                                                    <option value="in³">Cubic
                                                                                        Inches (in³)</option>
                                                                                    <option value="ft³">Cubic Feet
                                                                                        (ft³)</option>
                                                                                    <option value="cubic-meters">Cubic
                                                                                        Meters (m³)</option>
                                                                                </optgroup>
                                                                                <!-- Weight Units -->
                                                                                <optgroup label="Weight">
                                                                                    <option value="g">Grams (g)
                                                                                    </option>
                                                                                    <option value="oz">Ounces (oz)
                                                                                    </option>
                                                                                    <option value="lb">Pounds (lb)
                                                                                    </option>
                                                                                    <option value="kg">Kilograms
                                                                                        (kg)</option>
                                                                                </optgroup>
                                                                            </select>
                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">₱</span>
                                                                        <input type="text"
                                                                            class="form-control grossSales_val"
                                                                           >
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">₱</span>
                                                                        <input type="text"
                                                                            class="form-control estimatedCostOfProduction_val"
                                                                           >
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">₱</span>
                                                                        <input type="text"
                                                                            class="form-control netSales_val"
                                                                        >
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                            <h5>4.0 MARKET OUTLETS</h5>
                            <div class="row">
                                <div class="col-12 my-3">
                                    <div class="alert alert-primary h-100" role="alert">
                                        <h5 class="alert-heading">
                                            <i class="ri-information-2-fill"></i> Export and Local Market
                                        </h5>
                                    <p>
                                        Kindly provide the necessary information for this Export and Local Market Outlet. The following details are needed.
                                        <ul>
                                            <li>
                                                Export - location name in which the outlet is located(example: USA, China, etc)
                                            </li>
                                            <li>
                                                Local - location name in which the outlet is located(example: Carmin, Tagum, etc)
                                            </li>
                                        </ul>
                                    </p>
                                    <hr>
                                    <p class="mb-0 text-secondary text-small">You may enter none or leave blank if not applicable.
                                    </p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <strong class="ms-2">4.1 Export</strong>
                                    <div class="ms-4">
                                        <textarea class="form-control h-100" name="Market_Export" placeholder="Export" id="exportTextarea"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <strong class="ms-2">4.2 Local</strong>
                                    <div class="ms-4">
                                        <textarea class="form-control h-100" name="Market_local" placeholder="Local" id="localTextarea"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmationModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="confirmationModalLabel">Confirmation</h5>
                    </div>
                    <div class="modal-body">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6>Data Privacy Consent</h6>
                            </div>
                            <div class="card-body">
                                <p class="paragraph-content">The Department of Science and Technology XI respect your privacy and are committed to
                                    protecting
                                    your personal data. This Data Privacy Consent informs you about how we collect, use,
                                    store, and
                                    disclose your personal data when you use this information system.
                                </p>
                                <p class="paragraph-content">
                                    <strong>Information We Collect:</strong> Login credentials: Username, password,
                                    security questions/answers (if
                                    applicable) Personal information: Name, email address, contact number, other
                                    information you
                                    provide during registration or use of the system. Usage data: Log data (e.g. access
                                    times), system
                                    navigation data, information about your use of features and functionalities
                                </p>
                                <p class="paragraph-content">
                                    <strong>How We Use Your Information:</strong> Provide access to the information
                                    system: Verify your identity and
                                    authenticate your login. Manage your account: Process your registration, maintain
                                    your profile, and
                                    respond to your inquiries. Operate and improve the system: Analyze usage data to
                                    optimize
                                    performance and troubleshoot issues. Communicate with you: Send system updates,
                                    announcements, and support messages.
                                </p>
                                <p class="paragraph-content">
                                    <strong>Disclosure of Your Information:</strong> We will not disclose your personal
                                    data to any third party without
                                    your explicit consent, except as required by law or to comply with legal process. We
                                    may share
                                    aggregate and anonymized data with third-party service providers for analytics and
                                    performance
                                    improvement purposes.
                                </p>
                                <p class="paragraph-content">
                                    <strong>Your Rights:</strong> You have the right to access, rectify, erase, and
                                    restrict the processing of your personal
                                    data. You have the right to withdraw your consent at any time. You have the right to
                                    complain to the
                                    relevant data protection authority if you believe your rights have been violated.
                                </p>
                                <p class="paragraph-content">
                                    By logging in to this information system, you acknowledge that you have read and
                                    understood this
                                    Data Privacy Consent and agree to the collection, use, and disclosure of your
                                    personal data as
                                    described herein.
                                </p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h6>Terms and Conditions</h6>
                            </div>
                            <div class="card-body text-justify">
                                <p class="paragraph-content">Welcome to DOST-SETUP-SYS. By accessing and using this website, you agree to comply with and be bound by the following terms and conditions:
                                </p>
                                <p class="paragraph-content">
                                    <strong>Acceptance of Terms:</strong> By using this website, you acknowledge that you have read, understood, and agree to be bound by these terms and conditions
                                </p>
                                <p>
                                    <strong>Use of the Website:</strong> You agree to use this website only for lawful purposes and in a manner that does not infringe the rights of, restrict, or inhibit anyone else's use and enjoyment of the website.
                                </p>
                                <p class="paragraph-content">
                                    <strong>
                                    User Accounts:
                                    </strong>
                                    If you create an account on this website, you are responsible for maintaining the confidentiality of your account information and for all activities that occur under your account.
                                </p>
                                <p class="paragraph-content">
                                    <strong>Changes to Terms:</strong> We reserve the right to modify these terms and conditions at any time. Your continued use of the website after any changes indicates your acceptance of the new terms.
                                </p>
                                <p class="paragraph-content">
                                    <strong>Governing Law:</strong> These terms and conditions are governed by and construed in accordance with the laws of the Philippines.
                                </p>

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" name="detail_confirm" id="detail_confirm"
                                        class="form-check-input" required>
                                    <label for="detail_confirm" class="form-check-label">I hereby confirm that the
                                         information I provided is true and correct.</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" name="agree_terms" id="agree_terms"
                                        class="form-check-input" required>
                                    <label for="agree_terms" class="form-check-label">I have read and agree to the terms and conditions.</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" id="cancelButton"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="confirmButton" disabled>Confirm</button>
                    </div>
                </div>
            </div>
        </div>
<div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer" style="z-index: 1100;">
    <div id="successToast" class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header text-bg-success">
            <strong class="me-auto">Success</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="successToastBody">
            Form submitted successfully!
        </div>
    </div>
</div>


