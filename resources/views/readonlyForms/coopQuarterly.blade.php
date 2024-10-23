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
    <form id="updateQuarterlyData"  data-quarter-id="{{ $reportId }}" data-quarter-project="{{ $projectId }}" data-quarter-period="{{ $quarter }}" data-quarter-status="{{ $reportStatus }}">
        <div class="card mb-3">
            <div class="card-body" id="AssetsInputs">
                <div class="d-flex align-items-center p-3">
                    <h5>1.0 Assets</h5>
                    <div class="ms-auto">
                        <button type="button" class="btn btn-primary btn-sm editButton"><i
                                class="ri-edit-2-fill"></i></button>
                        <button type="button" class="btn btn-primary btn-sm revertButton" disabled><i
                                class="ri-arrow-go-back-fill"></i></button>
                    </div>
                </div>
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
                                placeholder="500,000" readonly value="{{ $reportData['Building'] }}">
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
                <div class="d-flex align-items-center p-3">
                    <h5>2.0 Total Employment</h5>
                    <div class="ms-auto">
                        <button type="button" class="btn btn-primary btn-sm editButton"><i
                                class="ri-edit-2-fill"></i></button>
                        <button type="button" class="btn btn-primary btn-sm revertButton" disabled><i
                                class="ri-arrow-go-back-fill"></i></button>
                    </div>
                </div>
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
                                                            class="form-control number_input_only" id="maleInput"
                                                            readonly
                                                            value="{{ $reportData['male_Dir_Regular'] ?? '' }}">
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="maleInput">Female:</label>
                                                        <input type="text" name="female_Dir_Regular"
                                                            class="form-control number_input_only" id="femaleInput"
                                                            readonly
                                                            value="{{ $reportData['female_Dir_Regular'] ?? '' }}">
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="maleInput">Workday:</label>
                                                        <input type="text" name="workday_Dir_Regular"
                                                            class="form-control number_input_only" id="workdayInput"
                                                            readonly
                                                            value="{{ $reportData['workday_Dir_Regular'] ?? '' }}">
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
                                                            class="form-control number_input_only"
                                                            id="parttimeMaleInput" readonly
                                                            value="{{ $reportData['male_Dir_PartT'] ?? '' }}">
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="maleInput">Female:</label>
                                                        <input type="text" name="female_Dir_PartT"
                                                            class="form-control number_input_only"
                                                            id="parttimeFemaleInput" readonly
                                                            value="{{ $reportData['female_Dir_PartT'] ?? '' }}">
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="maleInput">Workday:</label>
                                                        <input type="text" name="workday_Dir_PartT"
                                                            class="form-control number_input_only"
                                                            id="parttimeWorkdayInput" readonly
                                                            value="{{ $reportData['workday_Dir_PartT'] ?? '' }}">
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
                                    <h5 class="alert-heading"> <i class="ri-information-2-fill"></i> Indirect
                                        Personnel
                                    </h5>
                                    <p>Indirect personnel are those who are not actively involved in
                                        the production process of the products, such as
                                        Administrative staff, Managers, and Maintenance workers.
                                        <br>
                                    <ul>
                                        <li>Please provide the number of regular and part-time indirect employees for
                                            both
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
                                                            class="form-control number_input_only"
                                                            id="regularMaleInput" readonly
                                                            value="{{ $reportData['male_Indir_Regular'] ?? '' }}">
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="regularFemaleInput">Female:</label>
                                                        <input type="text" name="female_Indir_Regular"
                                                            class="form-control number_input_only"
                                                            id="regularFemaleInput" readonly
                                                            value="{{ $reportData['female_Indir_Regular'] ?? '' }}">
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="regularWorkdayInput">Workday:</label>
                                                        <input type="text" name="workday_Indir_Regular"
                                                            class="form-control number_input_only"
                                                            id="regularWorkdayInput" readonly
                                                            value="{{ $reportData['workday_Indir_Regular'] ?? '' }}">
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
                                                            class="form-control number_input_only"
                                                            id="parttimeMaleInput" readonly
                                                            value="{{ $reportData['male_Indir_PartT'] ?? '' }}">

                                                    </div>
                                                    <div class="col-12">
                                                        <label for="parttimeFemaleInput">Female: </label>
                                                        <input type="text" name="female_Indir_PartT"
                                                            class="form-control number_input_only"
                                                            id="parttimeFemaleInput" readonly
                                                            value="{{ $reportData['female_Indir_PartT'] ?? '' }}">

                                                    </div>
                                                    <div class="col-12">
                                                        <label for="parttimeWorkdayInput">Workday: </label>
                                                        <input type="text" name="workday_Indir_PartT"
                                                            class="form-control number_input_only"
                                                            id="parttimeWorkdayInput" readonly
                                                            value="{{ $reportData['workday_Indir_PartT'] ?? '' }}">
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
            <div class="card-body" id="ProductionAndSalesInputs">
                <div class="d-flex align-items-center p-3">
                    <h5>3.0 PRODUCTION AND SALES DATA FOR THE QUARTER</h5>
                    <div class="ms-auto">
                        <button type="button" class="btn btn-primary btn-sm editButton"><i
                                class="ri-edit-2-fill"></i></button>
                        <button type="button" class="btn btn-primary btn-sm revertButton" disabled><i
                                class="ri-arrow-go-back-fill"></i></button>
                    </div>
                </div>
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
                                            <button type="button" id="addExportRow" class="btn btn-primary AddProductRow"
                                                data-toggle="tooltip" title="Add a new row" disabled>
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
                                                @forelse ($reportData['ExportProduct'] as $exportProduct)
                                                @php
                                                    $exportProductVolume = $exportProduct['volumeOfProduction'] ?? '';

                                                    if(preg_match('/^([\d,]+)\s*(\w+)$/', $exportProductVolume, $exportmatches)) {
                                                        $exportProductVolume = $exportmatches[1];
                                                        $exportProductVolumeUnit = $exportmatches[2];
                                                    }else {
                                                        $exportProductVolume = '';
                                                        $exportProductVolumeUnit = '';
                                                    }
                                                @endphp
                                                    <tr class="table_row">
                                                        <td>
                                                            <input type="text" class="form-control productName"
                                                                readonly value="{{ $exportProduct['ProductName'] ?? '' }}">
                                                        </td>
                                                        <td>
                                                            <textarea class="form-control w-100 packingDetails" readonly>{{ $exportProduct['PackingDetails'] ?? '' }} </textarea>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input type="text"
                                                                    class="form-control productionVolume_val" readonly
                                                                    value="{{ $exportProductVolume }}">
                                                                <select class="form-select volumeUnit" readonly>
                                                                    <!-- Volume Units -->
                                                                    <optgroup label="Volume">
                                                                        <option value="mL" {{ $exportProductVolumeUnit == 'mL' ? 'selected' : '' }}>Milliliters (mL)</option>
                                                                        <option value="cm³" {{ $exportProductVolumeUnit == 'cm³' ? 'selected' : '' }}>Cubic Centimeters (cm³)</option>
                                                                        <option value="fl oz" {{ $exportProductVolumeUnit == 'fl oz' ? 'selected' : '' }}>Fluid Ounces (fl oz)</option>
                                                                        <option value="cup" {{ $exportProductVolumeUnit == 'cup' ? 'selected' : '' }}>Cups (cup)</option>
                                                                        <option value="pt" {{ $exportProductVolumeUnit == 'pt' ? 'selected' : '' }}>Pints (pt)</option>
                                                                        <option value="qt" {{ $exportProductVolumeUnit == 'qt' ? 'selected' : '' }}>Quarts (qt)</option>
                                                                        <option value="L" {{ $exportProductVolumeUnit == 'L' ? 'selected' : '' }}>Liters (L)</option>
                                                                        <option value="gal" {{ $exportProductVolumeUnit == 'gal' ? 'selected' : '' }}>Gallons (gal)</option>
                                                                        <option value="in³" {{ $exportProductVolumeUnit == 'in³' ? 'selected' : '' }}>Cubic Inches (in³)</option>
                                                                        <option value="ft³" {{ $exportProductVolumeUnit == 'ft³' ? 'selected' : '' }}>Cubic Feet (ft³)</option>
                                                                        <option value="cubic-meters" {{ $exportProductVolumeUnit == 'm³' ? 'selected' : '' }}>Cubic Meters (m³)</option>
                                                                    </optgroup>
                                                                    <!-- Weight Units -->
                                                                    <optgroup label="Weight">
                                                                        <option value="g" {{ $exportProductVolumeUnit == 'g' ? 'selected' : '' }}>Grams (g)</option>
                                                                        <option value="oz" {{ $exportProductVolumeUnit == 'oz' ? 'selected' : '' }}>Ounces (oz)</option>
                                                                        <option value="lb" {{ $exportProductVolumeUnit == 'lb' ? 'selected' : '' }}>Pounds (lb)</option>
                                                                        <option value="kg" {{ $exportProductVolumeUnit == 'kg' ? 'selected' : '' }}>Kilograms (kg)</option>
                                                                    </optgroup>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <span class="input-group-text">
                                                                    ₱
                                                                </span>
                                                                <input type="text"
                                                                    class="form-control grossSales_val" readonly
                                                                    value="{{ $exportProduct['grossSales'] ?? '' }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <span class="input-group-text">
                                                                    ₱
                                                                </span>
                                                                <input type="text"
                                                                    class="form-control estimatedCostOfProduction_val"
                                                                    readonly
                                                                    value="{{ $exportProduct['estimatedCostOfProduction'] ?? '' }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <span class="input-group-text">
                                                                    ₱
                                                                </span>
                                                                <input type="text"
                                                                    class="form-control netSales_val" readonly
                                                                    value="{{ $exportProduct['netSales'] ?? '' }}">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr class="table_row">
                                                        <td>
                                                            <input type="text" class="form-control productName"
                                                                readonly>
                                                        </td>
                                                        <td>
                                                            <textarea class="form-control w-100 packingDetails" readonly> </textarea>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input type="text"
                                                                    class="form-control productionVolume_val" readonly>
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
                                                                <input type="text"
                                                                    class="form-control grossSales_val" readonly>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <span class="input-group-text">
                                                                    ₱
                                                                </span>
                                                                <input type="text"
                                                                    class="form-control estimatedCostOfProduction_val"
                                                                    readonly>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <span class="input-group-text">
                                                                    ₱
                                                                </span>
                                                                <input type="text"
                                                                    class="form-control netSales_val" readonly>
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
                                            <button type="button" id="addLocalRow" class="btn btn-primary AddProductRow"
                                                data-toggle="tooltip" title="Add a new row" disabled>
                                                <i class="ri-add-box-fill"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger mx-2 deleteLocalRow"
                                                data-toggle="tooltip" title="Delete row">
                                                <i class="ri-subtract-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table Local-Outlet">
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
                                                @forelse($reportData['LocalProduct'] as $localProduct)
                                                @php
                                                $localProductVolume = $localProduct['volumeOfProduction'] ?? '';

                                                if(preg_match('/^([\d,]+)\s*(\w+)$/', $localProductVolume, $localmatches)) {
                                                    $localProductVolume = $localmatches[1];
                                                    $localProductVolumeUnit = $localmatches[2];
                                                }else{
                                                    $localProductVolume = '';
                                                    $localProductVolumeUnit = '';
                                                }
                                                @endphp
                                                    <tr class="table_row">
                                                        <td><input type="text" class="form-control productName"
                                                                readonly value="{{ $localProduct['ProductName'] ?? '' }}">
                                                        </td>
                                                        <td>
                                                            <textarea class="form-control packingDetails" readonly>{{ $localProduct['PackingDetails'] ?? '' }}</textarea>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input type="text"
                                                                    class="form-control productionVolume_val" readonly
                                                                    value="{{ $localProductVolume }}">
                                                                <select class="form-select volumeUnit">
                                                                    <!-- Volume Units -->
                                                                    <option value="mL" {{ $exportProductVolumeUnit == 'mL' ? 'selected' : '' }}>Milliliters (mL)</option>
                                                                        <option value="cm³" {{ $localProductVolumeUnit == 'cm³' ? 'selected' : '' }}>Cubic Centimeters (cm³)</option>
                                                                        <option value="fl oz" {{ $localProductVolumeUnit == 'fl oz' ? 'selected' : '' }}>Fluid Ounces (fl oz)</option>
                                                                        <option value="cup" {{ $localProductVolumeUnit == 'cup' ? 'selected' : '' }}>Cups (cup)</option>
                                                                        <option value="pt" {{ $localProductVolumeUnit == 'pt' ? 'selected' : '' }}>Pints (pt)</option>
                                                                        <option value="qt" {{ $localProductVolumeUnit == 'qt' ? 'selected' : '' }}>Quarts (qt)</option>
                                                                        <option value="L" {{ $localProductVolumeUnit == 'L' ? 'selected' : '' }}>Liters (L)</option>
                                                                        <option value="gal" {{ $localProductVolumeUnit == 'gal' ? 'selected' : '' }}>Gallons (gal)</option>
                                                                        <option value="in³" {{ $localProductVolumeUnit == 'in³' ? 'selected' : '' }}>Cubic Inches (in³)</option>
                                                                        <option value="ft³" {{ $localProductVolumeUnit == 'ft³' ? 'selected' : '' }}>Cubic Feet (ft³)</option>
                                                                        <option value="cubic-meters" {{ $localProductVolumeUnit == 'm³' ? 'selected' : '' }}>Cubic Meters (m³)</option>
                                                                    </optgroup>
                                                                    <!-- Weight Units -->
                                                                    <optgroup label="Weight">
                                                                        <option value="g" {{ $localProductVolumeUnit == 'g' ? 'selected' : '' }}>Grams (g)</option>
                                                                        <option value="oz" {{ $localProductVolumeUnit == 'oz' ? 'selected' : '' }}>Ounces (oz)</option>
                                                                        <option value="lb" {{ $localProductVolumeUnit == 'lb' ? 'selected' : '' }}>Pounds (lb)</option>
                                                                        <option value="kg" {{ $localProductVolumeUnit == 'kg' ? 'selected' : '' }}>Kilograms (kg)</option>
                                                                    </optgroup>
                                                                </select>
                                                            </div>

                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <span class="input-group-text">₱</span>
                                                                <input type="text"
                                                                    class="form-control grossSales_val" readonly
                                                                    value="{{ $localProduct['grossSales'] ?? '' }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <span class="input-group-text">₱</span>
                                                                <input type="text"
                                                                    class="form-control estimatedCostOfProduction_val"
                                                                    readonly
                                                                    value="{{ $localProduct['estimatedCostOfProduction'] ?? '' }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <span class="input-group-text">₱</span>
                                                                <input type="text"
                                                                    class="form-control netSales_val" readonly
                                                                    value="{{ $localProduct['netSales'] ?? '' }}">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr class="table_row">
                                                        <td><input type="text" class="form-control productName"
                                                                readonly></td>
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
                                                                <input type="text"
                                                                    class="form-control grossSales_val" readonly>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <span class="input-group-text">₱</span>
                                                                <input type="text"
                                                                    class="form-control estimatedCostOfProduction_val"
                                                                    readonly>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <span class="input-group-text">₱</span>
                                                                <input type="text"
                                                                    class="form-control netSales_val" readonly>
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
        <div class="card mb-3">
            <div class="card-body" id="marketOutletInputs">
                <div class="d-flex align-items-center p-3">
                    <h5>4.0 MARKET OUTLETS</h5>
                    <div class="ms-auto">
                        <button type="button" class="btn btn-primary btn-sm editButton"><i
                                class="ri-edit-2-fill"></i></button>
                        <button type="button" class="btn btn-primary btn-sm revertButton" disabled><i
                                class="ri-arrow-go-back-fill"></i></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 my-3">
                        <div class="alert alert-primary h-100 d-none" role="alert">
                            <h5 class="alert-heading">
                                <i class="ri-information-2-fill"></i> Export and Local Market
                            </h5>
                            <p>
                                Kindly provide the necessary information for this Export and Local Market Outlet. The
                                following
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
                            <p class="mb-0 text-secondary text-small">You may enter none or leave blank if not
                                applicable.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <strong class="ms-2">4.1 Export</strong>
                        <div class="ms-4">
                            <textarea class="form-control h-100" name="Market_Export" placeholder="Export" id="exportTextarea" readonly>{{ $reportData['Market_Export'] ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <strong class="ms-2">4.2 Local</strong>
                        <div class="ms-4">
                            <textarea class="form-control h-100" name="Market_local" placeholder="Local" id="localTextarea" readonly>{{ $reportData['Market_local'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-end p-1">
                    <button type="submit" class="btn btn-primary">Submit</button>
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

            function parseValue(value) {
                return parseFloat(value.replace(/,/g, '')) || 0;
            }


            $('.ExportData, .LocalData').on('input', 'tr td:nth-child(n+4):nth-child(-n+5) input', function() {
                let row = $(this).closest('tr');
                let grossSales = parseValue(row.find('.grossSales_val').val());
                let estimatedCostOfProduction = parseValue(row.find('.estimatedCostOfProduction_val')
                    .val());
                let netSales = grossSales - estimatedCostOfProduction;
                let formattedNetSales = netSales.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
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
                    let tableSelector = buttonSelector === '.deleteExportRow' ?
                        '.Export-Outlet tbody' :
                        '.Local-Outlet tbody';
                    if ($(tableSelector + ' tr').length <= 1) {
                        $(buttonSelector).prop('disabled', true);
                    } else {
                        $(buttonSelector).prop('disabled', false);
                    }
                });
            }

            addRow('#addExportRow', '.Export-Outlet tbody', 'export');
            deleteRow('.deleteExportRow', 'export', '.Export-Outlet tbody');

            addRow('#addLocalRow', '.Local-Outlet tbody', 'local');
            deleteRow('.deleteLocalRow', 'local', '.Local-Outlet tbody');

            updateDeleteButtonState();

            const inputContainers = $('#AssetsInputs, #EmploymentInputs, #marketOutletInputs');
            const ProductAndSalesContainer = $('#ProductionAndSalesInputs')

            const Products = {
                exportProduct: ProductAndSalesContainer.find('.productExport'),
                localProduct: ProductAndSalesContainer.find('.productLocal')
            }


            function storeInitialValues(container) {
                const containerData = {};
                container.find('input, textarea').each(function(index, input) {
                    containerData[input.name] = $(input).val();
                });
                return containerData;
            }

            const initialData = {};
            inputContainers.each(function() {
                const container = $(this);
                initialData[container.attr('id')] = storeInitialValues(container);
            });

            const storeProductsData = function() {
                const ExportTable_data = [];
                const LocalTable_data = [];

                Products.exportProduct.find('.ExportData .table_row').each(function() {
                    const row = $(this);
                    const exportData = {
                        ProductName: row.find('.productName').val(),
                        PackingDetails: row.find('.packingDetails').val(),
                        volumeOfProduction: row.find('.volumeOfProduction_val').val() + ' ' + row.find('.volumeUnit').val(),
                        grossSales: row.find('.grossSales_val').val(),
                        estimatedCostOfProduction: row.find('.estimatedCostOfProduction_val').val(),
                        netSales: row.find('.netSales_val').val(),
                    };
                    exportData.productName && exportData.productName !== null ?
                        ExportTable_data.push(exportData) :
                        null;
                });

                initialData.ExportProduct = ExportTable_data;

                Products.localProduct.find('.LocalData .table_row').each(function() {
                    const row = $(this);
                    const localData = {
                        ProductName: row.find('.productName').val(),
                        PackingDetails: row.find('.packingDetails').val(),
                        volumeOfProduction: row.find('.productionVolume_val').val() + ' ' + row.find('.volumeUnit').val(),
                        grossSales: row.find('.grossSales_val').val(),
                        estimatedCostOfProduction: row.find('.estimatedCostOfProduction_val').val(),
                        netSales: row.find('.netSales_val').val(),
                    };
                    localData.productName && localData.productName !== null ?
                        LocalTable_data.push(localData) :
                        null;
                });
                return {
                    ExportProduct: ExportTable_data,
                    LocalProduct: LocalTable_data
                };
            }

            initialData['ProductionAndSalesInputs'] = storeProductsData();

            console.log(initialData);

            inputContainers.on('click', '.editButton', function() {
                // Get the specific card-body container where the button was clicked
                const cardBody = $(this).closest('div.card-body');

                // Toggle the readonly state for all input and textarea elements within the card-body
                cardBody.find('input, textarea').prop('readonly', function(i, val) {
                    return !val; // Toggle the current readonly value (true/false)
                });

                // Enable or disable the Revert button based on the readonly state
                const isReadonly = cardBody.find('input, textarea').prop(
                    'readonly'); // Check if inputs are readonly
                if (!isReadonly) {
                    cardBody.find('.revertButton').prop('disabled',
                        false); // Enable Revert if inputs are editable
                } else {
                    cardBody.find('.revertButton').prop('disabled',
                        true); // Disable Revert if inputs are readonly again
                }
            });

            inputContainers.on('click', '.revertButton', function() {
                console.log('revert');
                const cardBody = $(this).closest('div.card-body');

                console.log(cardBody);
                const containerId = cardBody.attr('id');
                console.log(containerId);

                // Revert inputs back to initial values within this container
                cardBody.find('input, textarea').each(function(index, input) {
                    $(input).val(initialData[containerId][input.name]);
                });

                // Disable Revert button after reverting within this container
                cardBody.find('input, textarea').prop('readonly', true);
                cardBody.find('.revertButton').prop('disabled', true);
            });

            ProductAndSalesContainer.on('click', '.editButton', function() {
                const cardBody = $(this).closest('div.card-body');
                cardBody.find('input, textarea').prop('readonly', function(i, val) {
                    return !val;
                });

                const isReadonly = cardBody.find('input, textarea').prop('readonly');
                if (!isReadonly) {
                    cardBody.find('.revertButton').prop('disabled', false);
                    cardBody.find('.AddProductRow').prop('disabled', false);
                } else {
                    cardBody.find('.revertButton').prop('disabled', true);
                    cardBody.find('.AddProductRow').prop('disabled', true);
                }
            });

            ProductAndSalesContainer.on('click', '.revertButton', function() {
                const initialProductData = initialData['ProductionAndSalesInputs'];

                // Revert export product table
                Products.exportProduct.find('.ExportData .table_row').each(function(index, row) {
                    if (initialProductData.ExportProduct[index]) {
                        $(row).find('.productName').val(initialProductData.ExportProduct[index]
                            .productName);
                        $(row).find('.packingDetails').val(initialProductData.ExportProduct[
                            index].packingDetails);
                        $(row).find('.productionVolume_val').val(initialProductData
                            .ExportProduct[index].volumeOfProduction);
                        $(row).find('.grossSales_val').val(initialProductData.ExportProduct[
                            index].grossSales);
                        $(row).find('.estimatedCostOfProduction_val').val(initialProductData
                            .ExportProduct[index].productionCost);
                        $(row).find('.netSales_val').val(initialProductData.ExportProduct[index]
                            .netSales);
                    } else {
                        // If no initial data exists, clear the inputs
                        console.log("No initial data for export row, clearing inputs:", index);
                        $(row).find('.productName').val('');
                        $(row).find('.packingDetails').val('');
                        $(row).find('.productionVolume_val').val('');
                        $(row).find('.grossSales_val').val('');
                        $(row).find('.estimatedCostOfProduction_val').val('');
                        $(row).find('.netSales_val').val('');
                    }
                });

                // Revert local product table
                Products.localProduct.find('.LocalData .table_row').each(function(index, row) {
                    if (initialProductData.LocalProduct[index]) {
                        $(row).find('.productName').val(initialProductData.LocalProduct[index]
                            .productName);
                        $(row).find('.packingDetails').val(initialProductData.LocalProduct[
                            index].packingDetails);
                        $(row).find('.productionVolume_val').val(initialProductData
                            .LocalProduct[index].volumeOfProduction);
                        $(row).find('.grossSales_val').val(initialProductData.LocalProduct[
                            index].grossSales);
                        $(row).find('.estimatedCostOfProduction_val').val(initialProductData
                            .LocalProduct[index].productionCost);
                        $(row).find('.netSales_val').val(initialProductData.LocalProduct[index]
                            .netSales);
                    } else {
                        // Clear the inputs if no initial data for local product
                        console.log("No initial data for local row, clearing inputs:", index);
                        $(row).find('.productName').val('');
                        $(row).find('.packingDetails').val('');
                        $(row).find('.productionVolume_val').val('');
                        $(row).find('.grossSales_val').val('');
                        $(row).find('.estimatedCostOfProduction_val').val('');
                        $(row).find('.netSales_val').val('');
                    }
                });

                // Disable Revert button after reverting
                ProductAndSalesContainer.find('.AddProductRow').prop('disabled', true);
                ProductAndSalesContainer.find('input, textarea').prop('readonly', true);
                ProductAndSalesContainer.find('.revertButton').prop('disabled', true);
            });

            //TODO: Implove the form Update functionalities
            $('#updateQuarterlyData').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                form.find('button[type="submit"]').prop('disabled', true);
                form.find('input, textarea').prop('readonly', true);
                const quarterId = form.data('quarter-id');
                const quarterProject = form.data('quarter-project');
                const quarterPeriod = form.data('quarter-period');
                const quarterStatus = form.data('quarter-status');

                let formDataObject = {};
                const updatedFormData = form.serializeArray();

                $.each(updatedFormData, function(i, v) {
                    formDataObject[v.name] = v.value;
                });

                formDataObject = { ...formDataObject, ...storeProductsData()};

                $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Quarter-Project': quarterProject,
                    'X-Quarter-Period': quarterPeriod,
                    'X-Quarter-Status': quarterStatus
                },
                    type: 'PUT',
                    url: '{{ route('QuarterlyReport.update', ':quarterId') }}'.replace(':quarterId', quarterId),
                    data: JSON.stringify(formDataObject),
                    contentType: 'application/json',
                    success: function(response) {
                        setTimeout(() => {
                            const toastElement = document.getElementById('successToast');
                            const toast = new bootstrap.Toast(toastElement);
                            toast.show();
                        })
                    },
                    error: function(error) {
                        form.find('button[type="submit"]').prop('disabled', false);
                        form.find('input, textarea').prop('readonly', false);
                        console.log(error);
                    }

                })

            })
        }
    }

    $(document).ready(function() {
        QuarterlyFormEvents.init();
    });
</script>
