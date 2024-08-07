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
    <h4>Quarterly Report</h4>
</div>
<div class="card m-0 m-md-3">
    <div class="card-header">
        <p class=" m-0">Quarterly Report for Quarter 1</p>
    </div>
    <div class="card-body">
        <div class="quarterly-Report-wrapper">
            <form id="quarterlyForm" action="/Cooperator/QuarterlyReport" method="post">
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
                                        Please Enter the current assets for the Building, Equipment, and Working Capital for the current quarter.
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
                                            placeholder="500,000">
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
                                            placeholder="500,000">
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
                                            name="WorkingCapital" placeholder="500,000">
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
                                                operators, assemblers, and quality control inspectors.</p>
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
                                                                    <label for="maleInput">Male: <span
                                                                            class="requiredFields">
                                                                            *</span></label>
                                                                    <input type="text" name="male_Dir_Regular"
                                                                        class="form-control" id="maleInput">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="maleInput">Female: <span
                                                                            class="requiredFields">
                                                                            *</span></label>
                                                                    <input type="text" name="female_Dir_Regular"
                                                                        class="form-control" id="femaleInput">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="maleInput">Workday: <span
                                                                            class="requiredFields">
                                                                            *</span></label>
                                                                    <input type="text" name="workday_Dir_Regular"
                                                                        class="form-control" id="workdayInput">
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
                                                                    <label for="maleInput">Male: <span
                                                                            class="requiredFields">
                                                                            *</span></label>
                                                                    <input type="text" name="male_Dir_PartT"
                                                                        class="form-control" id="parttimeMaleInput">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="maleInput">Female: <span
                                                                            class="requiredFields">
                                                                            *</span></label>
                                                                    <input type="text" name="female_Dir_PartT"
                                                                        class="form-control" id="parttimeFemaleInput">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="maleInput">workday: <span
                                                                            class="requiredFields">
                                                                            *</span></label>
                                                                    <input type="text" name="workday_Dir_PartT"
                                                                        class="form-control"
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
                                                administrative staff, managers, and maintenance workers.</p>
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
                                                                    <label for="regularMaleInput">Male: <span
                                                                            class="requiredFields">*</span></label>
                                                                    <input type="text" name="male_Indir_Regular"
                                                                        class="form-control" id="regularMaleInput">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="regularFemaleInput">Female: <span
                                                                            class="requiredFields">*</span></label>
                                                                    <input type="text" name="female_Indir_Regular"
                                                                        class="form-control" id="regularFemaleInput">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="regularWorkdayInput">Workday: <span
                                                                            class="requiredFields">*</span></label>
                                                                    <input type="text" name="workday_Indir_Regular"
                                                                        class="form-control" id="regularWorkdayInput">
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
                                                                    <label for="parttimeMaleInput">Male: <span
                                                                            class="requiredFields">*</span></label>
                                                                    <input type="text" name="male_Indir_PartT"
                                                                        class="form-control" id="parttimeMaleInput">

                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="parttimeFemaleInput">Female: <span
                                                                            class="requiredFields">*</span></label>
                                                                    <input type="text" name="female_Indir_PartT"
                                                                        class="form-control" id="parttimeFemaleInput">

                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="parttimeWorkdayInput">Workday: <span
                                                                            class="requiredFields">*</span></label>
                                                                    <input type="text" name="workday_Indir_PartT"
                                                                        class="form-control"
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
                                    <strong>3.1 Export Market</strong>
                                    <div id="productExport" class="productExport">
                                        <div class="row">
                                            <div class="col-12 my-3">
                                                <div class="alert alert-primary m-0" role="alert">
                                                    <i class="ri-information-2-fill ri-lg"></i>
                                                    Please Enter the Products details for the Export and Local Market.
                                                </div>
                                            </div>
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
                                                                                <option value="milliliters">Milliliters
                                                                                    (mL)</option>
                                                                                <option value="cubic-centimeters">Cubic
                                                                                    Centimeters (cm³)</option>
                                                                                <option value="fluid-ounces">Fluid
                                                                                    Ounces (fl oz)</option>
                                                                                <option value="cups">Cups (cup)
                                                                                </option>
                                                                                <option value="pints">Pints (pt)
                                                                                </option>
                                                                                <option value="quarts">Quarts (qt)
                                                                                </option>
                                                                                <option value="liters">Liters (L)
                                                                                </option>
                                                                                <option value="gallons">Gallons (gal)
                                                                                </option>
                                                                                <option value="cubic-inches">Cubic
                                                                                    Inches (in³)</option>
                                                                                <option value="cubic-feet">Cubic Feet
                                                                                    (ft³)</option>
                                                                                <option value="cubic-meters">Cubic
                                                                                    Meters (m³)</option>
                                                                            </optgroup>
                                                                            <!-- Weight Units -->
                                                                            <optgroup label="Weight">
                                                                                <option value="grams">Grams (g)
                                                                                </option>
                                                                                <option value="ounces">Ounces (oz)
                                                                                </option>
                                                                                <option value="pounds">Pounds (lb)
                                                                                </option>
                                                                                <option value="kilograms">Kilograms
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
                                    <strong>3.2 Local Market</strong>
                                    <div id="productLocal" class="productLocal">
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
                                                                                    <option value="milliliters">Milliliters
                                                                                        (mL)</option>
                                                                                    <option value="cubic-centimeters">Cubic
                                                                                        Centimeters (cm³)</option>
                                                                                    <option value="fluid-ounces">Fluid
                                                                                        Ounces (fl oz)</option>
                                                                                    <option value="cups">Cups (cup)
                                                                                    </option>
                                                                                    <option value="pints">Pints (pt)
                                                                                    </option>
                                                                                    <option value="quarts">Quarts (qt)
                                                                                    </option>
                                                                                    <option value="liters">Liters (L)
                                                                                    </option>
                                                                                    <option value="gallons">Gallons (gal)
                                                                                    </option>
                                                                                    <option value="cubic-inches">Cubic
                                                                                        Inches (in³)</option>
                                                                                    <option value="cubic-feet">Cubic Feet
                                                                                        (ft³)</option>
                                                                                    <option value="cubic-meters">Cubic
                                                                                        Meters (m³)</option>
                                                                                </optgroup>
                                                                                <!-- Weight Units -->
                                                                                <optgroup label="Weight">
                                                                                    <option value="grams">Grams (g)
                                                                                    </option>
                                                                                    <option value="ounces">Ounces (oz)
                                                                                    </option>
                                                                                    <option value="pounds">Pounds (lb)
                                                                                    </option>
                                                                                    <option value="kilograms">Kilograms
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
                                <div class="col-md-6 col-sm-6">
                                    <strong class="ms-2">4.1 Export</strong>
                                    <div class="form-floating ms-4">
                                        <textarea class="form-control h-100" name="Market_Export" placeholder="Export" id="exportTextarea"></textarea>
                                        <label for="exportTextarea">Export</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <strong class="ms-2">4.2 Local</strong>
                                    <div class="form-floating ms-4">
                                        <textarea class="form-control h-100" name="Market_local" placeholder="Local" id="localTextarea"></textarea>
                                        <label for="localTextarea">Local</label>
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


<script type="module">
    $(document).ready(function() {
        // Select the input fields
        $('#BuildingAsset, #Equipment, #WorkingCapital').on('input', function() {
            // Remove any non-digit characters
            let value = $(this).val().replace(/[^0-9]/g, '');

            // Add commas every three digits
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            // Set the new value to the input field
            $(this).val(value);
        });

        $('#employment input').on('input', function() {
            // Remove any non-digit characters
            let value = $(this).val().replace(/[^0-9]/g, '');

            // Set the new value to the input field
            $(this).val(value);
        });

        $('.ExportData, .LocalData').on('input', 'tr td:nth-child(n+3):nth-child(-n+6) input', function() {
            // Remove any non-digit characters
            let value = $(this).val().replace(/[^0-9]/g, '');

            // Add commas every three digits
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            // Set the new value to the input field
            $(this).val(value);
        });

        function parseValue(value){
            return parseFloat(value.replace(/,/g, '')) || 0;
        }


        $('.ExportData, .LocalData').on('input', 'tr td:nth-child(n+4):nth-child(-n+5) input', function() {
            let row = $(this).closest('tr');
            let grossSales = parseValue(row.find('.grossSales_val').val());
            let estimatedCostOfProduction = parseValue(row.find('.estimatedCostOfProduction_val').val());
            let netSales = grossSales - estimatedCostOfProduction;
            let formattedNetSales = netSales.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            console.log(grossSales, estimatedCostOfProduction, formattedNetSales);
            row.find('.netSales_val').val(formattedNetSales);
        });
    });
</script>
<script type="module">
    $(document).ready(function() {
        let counters = {
            export: 0,
            local: 0
        };

        window.addRow = function(buttonSelector, tableSelector, identifier) {
            $(buttonSelector).click(function() {
                counters[identifier]++;

                let newRow = `
            <tr class="table_row">
                <td><input type="text" class="form-control productName"></td>
                <td><textarea class="form-control packingDetails"></textarea></td>
                <td>
                    <div class="input-group">
                         <input type="text" class="form-control productionVolume_val">
                                                                        <select class="form-select volumeUnit">
                                                                            <!-- Volume Units -->
                                                                            <optgroup label="Volume">
                                                                                <option value="milliliters">Milliliters
                                                                                    (mL)</option>
                                                                                <option value="cubic-centimeters">Cubic
                                                                                    Centimeters (cm³)</option>
                                                                                <option value="fluid-ounces">Fluid
                                                                                    Ounces (fl oz)</option>
                                                                                <option value="cups">Cups (cup)
                                                                                </option>
                                                                                <option value="pints">Pints (pt)
                                                                                </option>
                                                                                <option value="quarts">Quarts (qt)
                                                                                </option>
                                                                                <option value="liters">Liters (L)
                                                                                </option>
                                                                                <option value="gallons">Gallons (gal)
                                                                                </option>
                                                                                <option value="cubic-inches">Cubic
                                                                                    Inches (in³)</option>
                                                                                <option value="cubic-feet">Cubic Feet
                                                                                    (ft³)</option>
                                                                                <option value="cubic-meters">Cubic
                                                                                    Meters (m³)</option>
                                                                            </optgroup>
                                                                            <!-- Weight Units -->
                                                                            <optgroup label="Weight">
                                                                                <option value="grams">Grams (g)
                                                                                </option>
                                                                                <option value="ounces">Ounces (oz)
                                                                                </option>
                                                                                <option value="pounds">Pounds (lb)
                                                                                </option>
                                                                                <option value="kilograms">Kilograms
                                                                                    (kg)</option>
                                                                            </optgroup>
                                                                        </select>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control grossSales_val">
                    </div>
                </td>
                <td>
                     <div class="input-group">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control estimatedCostOfProduction_val">
                    </div>
                </td>
                <td>
                     <div class="input-group">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control netSales_val">
                    </div>
                </td>
            </tr>
            `;

                $(tableSelector).append(newRow);
                updateDeleteButtonState();
            });
        }

        window.deleteRow = function(buttonSelector, identifier, tableSelector) {
            $(document).on('click', buttonSelector, function() {
                if ($(tableSelector + ' tr').length > 1) {
                    $(tableSelector + ' tr:last').remove();
                    updateDeleteButtonState();
                }
                counters[identifier]--;
            });
        }

        window.updateDeleteButtonState = function() {
            ['.deleteExportRow', '.deleteLocalRow'].forEach(function(buttonSelector) {
                let tableSelector = buttonSelector === '.deleteExportRow' ? '.Export-Outlet tbody' :
                    '.local-Outlet tbody';
                if ($(tableSelector + ' tr').length <= 1) {
                    $(buttonSelector).prop('disabled', true);
                } else {
                    $(buttonSelector).prop('disabled', false);
                }
            });
        }

        addRow('#addExportRow', '.Export-Outlet tbody', 'export');
        deleteRow('.deleteExportRow', 'export', '.Export-Outlet tbody');

        addRow('#addLocalRow', '.local-Outlet tbody', 'local');
        deleteRow('.deleteLocalRow', 'local', '.local-Outlet tbody');

        updateDeleteButtonState();
    });
</script>
<script type="module">
    $(document).ready(function() {
        $('#smartwizard').smartWizard({
            selected: 0,
            theme: 'dots',
            transition: {
                animation: 'slideHorizontal'
            },
            toolbar: {
                showNextButton: true, // show/hide a Next button
                showPreviousButton: true, // show/hide a Previous button
                position: 'both buttom', // none/ top/ both bottom
                extraHtml: `<button class="btn btn-success" onclick="">Submit</button>
                              <button class="btn btn-secondary" onclick="onCancel()">Cancel</button>`
            },
        });
        $("#smartwizard").on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {
            let totalSteps = $('#smartwizard').find('ul li').length;
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
        $('#smartwizard').on('click', 'button', function() {
            // Your function goes here
            $('#smartwizard').smartWizard('fixHeight');
        });
    });
</script>
<script type="module">


    $(document).ready(function() {
        $('form').submit(function(event) {
            event.preventDefault();

            let formData = $(this).serializeArray();
            let dataObject = {};
            $.each(formData, function(i, v) {
                dataObject[v.name] = v.value;
            });

            const ExportTable_row = $('.ExportData .table_row');
            const localTable_row = $('.LocalData .table_row');
            const ExportTable_data = [];
            const localTable_data = [];


        ExportTable_row.each(function() {
            const row = $(this); // Wrap `this` with jQuery to use jQuery methods
            const exporttable_row = {
                ProductName: row.find('.productName').val(),
                PackingDetails: row.find('.packingDetails').val(),
                volumeOfProduction: row.find('.productionVolume_val').val() + ' ' + row.find('.volumeUnit').val(),
                grossSales: row.find('.grossSales_val').val(),
                estimatedCostOfProduction: row.find('.estimatedCostOfProduction_val').val(),
                netSales: row.find('.netSales_val').val()
            };
            ExportTable_data.push(exporttable_row);
        });

        // const ExportwrappedData = {ExportProductInfo: ExportTable_data};
       dataObject.ExportProduct = ExportTable_data;


        localTable_row.each(function() {
            const row = $(this); // Wrap `this` with jQuery to use jQuery methods
            const localtable_row = {
                ProductName: row.find('.productName').val(),
                PackingDetails: row.find('.packingDetails').val(),
                volumeOfProduction: row.find('.productionVolume_val').val() + ' ' + row.find('.volumeUnit').val(),
                grossSales: row.find('.grossSales_val').val(),
                estimatedCostOfProduction: row.find('.estimatedCostOfProduction_val').val(),
                netSales: row.find('.netSales_val').val()
            };
            localTable_data.push(localtable_row);
        });

        // const LocalwrappedData = {LocalProductInfo: localTable_data};
        dataObject.LocalProduct = localTable_data;


            // Send form data using AJAX
            $.ajax({
                heaeders: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: $(this).attr('action'),
                data: JSON.stringify(dataObject), // Send the new data object
                contentType: 'application/json', // Set content type to JSON
                success: function(response) {
                    // Handle the response if needed
                    $('#qReport').removeClass('d-none');
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle any errors
                }
            });
        });
    });
</script>
