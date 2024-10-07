<style>
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
<div class="m-2 m-md-3">
    <form action="">
        <div class="card mb-3">
            <div class="card-body" id="AssetsInputs">
                <h5>1.0 Assets</h5>
                <div class="row ms-md-4 ms-sm-2 my-4">
                    <div class="col-12 my-3">
                        <div class="alert alert-primary m-0 d-none" role="alert">
                            <i class="ri-information-2-fill ri-lg"></i>
                            Kindly provide the current assets for the building, equipment, and working capital for the
                            current quarter.
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
                                placeholder="500,000" readonly  value="{{ $reportData['Building'] }}">
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
                                placeholder="500,000" readonly value="{{ $reportData['Equipment'] }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="workingCapital">Working Capital <span class="requiredFields">
                                *</span></label>
                        <div class="input-group">

                            <span class="input-group-text">
                                ₱
                            </span>
                            <input type="text" class="form-control" id="WorkingCapital" name="WorkingCapital"
                                placeholder="500,000" readonly value="{{ $reportData['WorkingCapital'] }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body" id="EmploymentInputs">
                <h5>2.0 Total Employment</h5>
                <div class="card mb-0 mb-md-3">
                    <div class="card-header">
                        2.1 Direct Labor(Production)
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-8 d-none">
                                <div class="alert alert-primary h-100 " role="alert">
                                    <h5 class="alert-heading"> <i class="ri-information-2-fill"></i> Direct Personnel
                                    </h5>
                                    <p>Direct personnel are those who are actively involved in the
                                        production process of the products, an example are
                                        Operators, Assemblers, and quality control inspectors.
                                        <br>
                                    <ul>
                                        <li>Please provide the number of regular and part-time direct employees for both
                                            male
                                            and female.</li>
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
                                                            class="form-control number_input_only" id="maleInput" readonly value="{{ $reportData['male_Dir_Regular'] ?? '' }}">
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="maleInput">Female:</label>
                                                        <input type="text" name="female_Dir_Regular"
                                                            class="form-control number_input_only" id="femaleInput" readonly value="{{ $reportData['female_Dir_Regular'] ?? '' }}">
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="maleInput">Workday:</label>
                                                        <input type="text" name="workday_Dir_Regular"
                                                            class="form-control number_input_only" id="workdayInput" readonly value="{{ $reportData['workday_Dir_Regular'] ?? '' }}">
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
                                                            class="form-control number_input_only" id="parttimeMaleInput" readonly value="{{ $reportData['male_Dir_PartT'] ?? '' }}">
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="maleInput">Female:</label>
                                                        <input type="text" name="female_Dir_PartT"
                                                            class="form-control number_input_only" id="parttimeFemaleInput" readonly value="{{ $reportData['female_Dir_PartT'] ?? '' }}">
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="maleInput">Workday:</label>
                                                        <input type="text" name="workday_Dir_PartT"
                                                            class="form-control number_input_only"
                                                            id="parttimeWorkdayInput" readonly value="{{ $reportData['workday_Dir_PartT'] ?? '' }}">
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
                            <div class="col-12 col-md-8 d-none">
                                <div class="alert alert-primary h-100 " role="alert">
                                    <h5 class="alert-heading"> <i class="ri-information-2-fill"></i> Indirect Personnel
                                    </h5>
                                    <p>Indirect personnel are those who are not actively involved in
                                        the production process of the products, such as
                                        Administrative staff, Managers, and Maintenance workers.
                                        <br>
                                    <ul>
                                        <li>Please provide the number of regular and part-time indirect employees for both
                                            male
                                            and female.</li>
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
                                                            class="form-control number_input_only" id="regularMaleInput" readonly value="{{ $reportData['male_Indir_Regular'] ?? '' }}">
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="regularFemaleInput">Female:</label>
                                                        <input type="text" name="female_Indir_Regular"
                                                            class="form-control number_input_only"
                                                            id="regularFemaleInput" readonly value="{{ $reportData['female_Indir_Regular'] ?? '' }}">
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="regularWorkdayInput">Workday:</label>
                                                        <input type="text" name="workday_Indir_Regular"
                                                            class="form-control number_input_only"
                                                            id="regularWorkdayInput" readonly value="{{ $reportData['workday_Indir_Regular'] ?? '' }}">
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
                                                            class="form-control number_input_only" id="parttimeMaleInput" readonly value="{{ $reportData['male_Indir_PartT'] ?? '' }}">

                                                    </div>
                                                    <div class="col-12">
                                                        <label for="parttimeFemaleInput">Female: </label>
                                                        <input type="text" name="female_Indir_PartT"
                                                            class="form-control number_input_only"
                                                            id="parttimeFemaleInput"  readonly value="{{ $reportData['female_Indir_PartT'] ?? '' }}">

                                                    </div>
                                                    <div class="col-12">
                                                        <label for="parttimeWorkdayInput">Workday: </label>
                                                        <input type="text" name="workday_Indir_PartT"
                                                            class="form-control number_input_only"
                                                            id="parttimeWorkdayInput" readonly value="{{ $reportData['workday_Indir_PartT'] ?? '' }}">
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
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <h5>3.0 PRODUCTION AND SALES DATA FOR THE QUARTER</h5>
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="alert alert-primary h-100 d-none" role="alert">
                            <h5 class="alert-heading">
                                <i class="ri-information-2-fill"></i> Export and Local Market Product
                            </h5>
                            <p>Please provide the necesary product Infomarmation for this Export and Local Market. The
                                following are required Information for the product:
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
                                            <button type="button" id="addExportRow" class="btn btn-primary"
                                                data-toggle="tooltip" title="Add a new row">
                                                <i class="ri-add-box-fill"></i>

                                            </button>
                                            <button type="button" class="btn btn-danger deleteExportRow mx-2"
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
                                                @forelse ($reportData['ExportProduct'] as $product)
                                                <tr class="table_row">
                                                    <td>
                                                        <input type="text" class="form-control productName" readonly value="{{ $product['ProductName'] ?? '' }}">
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control w-100 packingDetails" readonly >{{ $product['PackingDetails'] ?? '' }} </textarea>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control productionVolume_val" readonly value="{{ $product['volumeOfProduction'] ?? '' }}">
                                                            <select class="form-select volumeUnit" readonly>
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
                                                            <input type="text" class="form-control grossSales_val" readonly value="{{ $product['grossSales'] ?? '' }}">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                ₱
                                                            </span>
                                                            <input type="text"
                                                                class="form-control estimatedCostOfProduction_val" readonly value="{{ $product['estimatedCostOfProduction'] ?? '' }}">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                ₱
                                                            </span>
                                                            <input type="text" class="form-control netSales_val" readonly value="{{ $product['netSales'] ?? '' }}">
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr class="table_row">
                                                    <td>
                                                        <input type="text" class="form-control productName" readonly >
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control w-100 packingDetails" readonly > </textarea>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control productionVolume_val" readonly >
                                                            <select class="form-select volumeUnit" readonly>
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
                                                            <input type="text" class="form-control grossSales_val" readonly >
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                ₱
                                                            </span>
                                                            <input type="text"
                                                                class="form-control estimatedCostOfProduction_val" readonly >
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                ₱
                                                            </span>
                                                            <input type="text" class="form-control netSales_val" readonly >
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforelse
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
                                            <button type="button" id="addLocalRow" class="btn btn-primary"
                                                data-toggle="tooltip" title="Add a new row">
                                                <i class="ri-add-box-fill"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger mx-2 deleteLocalRow"
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
                                                @forelse($reportData['LocalProduct'] as $product)
                                                <tr class="table_row">
                                                    <td><input type="text" class="form-control productName" readonly value="{{ $product['ProductName'] ?? '' }}"></td>
                                                    <td>
                                                        <textarea class="form-control packingDetails" readonly>{{ $product['PackingDetails'] ?? '' }}</textarea>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control productionVolume_val" readonly value="{{ $product['volumeOfProduction'] ?? '' }}">
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
                                                            <input type="text" class="form-control grossSales_val" readonly value="{{ $product['grossSales'] ?? '' }}">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <span class="input-group-text">₱</span>
                                                            <input type="text"
                                                                class="form-control estimatedCostOfProduction_val" readonly
                                                                value="{{ $product['estimatedCostOfProduction'] ?? '' }}">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <span class="input-group-text">₱</span>
                                                            <input type="text" class="form-control netSales_val" readonly value="{{ $product['netSales'] ?? '' }}">
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr class="table_row">
                                                    <td><input type="text" class="form-control productName" readonly></td>
                                                    <td>
                                                        <textarea class="form-control packingDetails" readonly></textarea>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control productionVolume_val" readonly>
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
                                                            <input type="text" class="form-control grossSales_val" readonly>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <span class="input-group-text">₱</span>
                                                            <input type="text"
                                                                class="form-control estimatedCostOfProduction_val" readonly>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <span class="input-group-text">₱</span>
                                                            <input type="text" class="form-control netSales_val" readonly>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card mb-3">
            <div class="card-body">
                <h5>4.0 MARKET OUTLETS</h5>
                <div class="row">
                    <div class="col-12 my-3">
                        <div class="alert alert-primary h-100 d-none" role="alert">
                            <h5 class="alert-heading">
                                <i class="ri-information-2-fill"></i> Export and Local Market
                            </h5>
                            <p>
                                Kindly provide the necessary information for this Export and Local Market Outlet. The following
                                details are needed.
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
                            <textarea class="form-control h-100" name="Market_Export" placeholder="Export" id="exportTextarea">{{ $reportData['Market_Export'] ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <strong class="ms-2">4.2 Local</strong>
                        <div class="ms-4">
                            <textarea class="form-control h-100" name="Market_local" placeholder="Local" id="localTextarea">{{ $reportData['Market_local'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    const QuarterlyFormEvents = {
        init: () => {
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

            let counters = {
                export: 0,
                local: 0
            };

            const addRow = (buttonSelector, tableSelector, identifier) => {
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

            const deleteRow = (buttonSelector, identifier, tableSelector) => {
                $(document).on('click', buttonSelector, function() {
                    if ($(tableSelector + ' tr').length > 1) {
                        $(tableSelector + ' tr:last').remove();
                        updateDeleteButtonState();
                    }
                    counters[identifier]--;
                });
            }

            const updateDeleteButtonState = () => {
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

            const inputs = $('#AssetsInputs, #EmploymentInputs').find('input');
            const initialData = {};

            inputs.each((index, input) => {
                initialData[input.name] = $(input).val();
            });

        }
    }

    $(document).ready(function() {
        QuarterlyFormEvents.init();
    });
</script>
