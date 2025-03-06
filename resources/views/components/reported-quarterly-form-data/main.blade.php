@props(['reportId', 'projectId', 'quarter', 'reportStatus', 'reportData', 'isEditable' => false])
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
<div id="formWrapper">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a
                    class="revertToSelectDoc"
                    href="#"
                >Select Document</a></li>
            <li
                class="breadcrumb-item active"
                aria-current="page"
            >{{ $quarter }}</li>
        </ol>
    </nav>
    <div class="p-3">
        <h4>Quarterly Report for {{ $quarter }}</h4>
    </div>
    <div class="m-2 m-md-3">
        <form
            id="ReportedQuarterlyData"
            @if ($isEditable) data-quarter-id="{{ $reportId }}"
        data-quarter-project="{{ $projectId }}"
        data-quarter-period="{{ $quarter }}"
        data-quarter-status="{{ $reportStatus }}"
        action="{{ URL::signedRoute('QuarterlyReport.update', $reportId) }}" @endif
        >
            <div class="card mb-3">
                <div
                    class="card-body"
                    id="AssetsInputs"
                >
                    <div class="d-flex align-items-center p-3">
                        <h5>1.0 Assets</h5>
                        @if ($isEditable)
                            <div class="ms-auto">
                                <button
                                    class="btn btn-primary btn-sm editButton"
                                    type="button"
                                ><i class="ri-edit-2-fill"></i></button>
                                <button
                                    class="btn btn-primary btn-sm revertButton"
                                    type="button"
                                    disabled
                                ><i class="ri-arrow-go-back-fill"></i></button>
                            </div>
                        @endif
                    </div>
                    <div class="row ms-md-4 ms-sm-2 my-4">
                        <div class="col-12 my-3">
                            <div
                                class="alert alert-primary m-0 d-none"
                                role="alert"
                            >
                                <i class="ri-information-2-fill ri-lg"></i>
                                Kindly provide the current assets for the building, equipment, and working capital for
                                the
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
                                <input
                                    class="form-control"
                                    id="BuildingAsset"
                                    name="Building"
                                    type="text"
                                    value="{{ $reportData['Building'] ?? '' }}"
                                    placeholder="500,000"
                                    @readonly(!$isEditable)
                                >
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <Label for="Equipment">Equipment <span class="requiredFields">
                                    *</span></Label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    ₱
                                </span>
                                <input
                                    class="form-control"
                                    id="Equipment"
                                    name="Equipment"
                                    type="text"
                                    value="{{ $reportData['Equipment'] ?? '' }}"
                                    placeholder="500,000"
                                    @readonly(!$isEditable)
                                >
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="workingCapital">Working Capital <span class="requiredFields">
                                    *</span></label>
                            <div class="input-group">

                                <span class="input-group-text">
                                    ₱
                                </span>
                                <input
                                    class="form-control"
                                    id="WorkingCapital"
                                    name="WorkingCapital"
                                    type="text"
                                    value="{{ $reportData['WorkingCapital'] ?? '' }}"
                                    placeholder="500,000"
                                    @readonly(!$isEditable)
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div
                    class="card-body"
                    id="EmploymentInputs"
                >
                    <div class="d-flex align-items-center p-3">
                        <h5>2.0 Total Employment</h5>
                        @if ($isEditable)
                            <div class="ms-auto">
                                <button
                                    class="btn btn-primary btn-sm editButton"
                                    type="button"
                                ><i class="ri-edit-2-fill"></i></button>
                                <button
                                    class="btn btn-primary btn-sm revertButton"
                                    type="button"
                                    disabled
                                ><i class="ri-arrow-go-back-fill"></i></button>
                            </div>
                        @endIf
                    </div>
                    <div
                        class="card mb-0 mb-md-3"
                        id="directLaborCard"
                    >
                        <div class="card-header">
                            2.1 Direct Labor(Production)
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-8 d-none">
                                    <div
                                        class="alert alert-primary h-100 "
                                        role="alert"
                                    >
                                        <h5 class="alert-heading"> <i class="ri-information-2-fill"></i> Direct
                                            Personnel
                                        </h5>
                                        <p>Direct personnel are those who are actively involved in the
                                            production process of the products, an example are
                                            Operators, Assemblers, and quality control inspectors.
                                            <br>
                                        <ul>
                                            <li>Please provide the number of regular and part-time direct employees for
                                                both
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
                                                            <input
                                                                class="form-control number_input_only"
                                                                id="maleInput"
                                                                name="male_Dir_Regular"
                                                                type="text"
                                                                value="{{ $reportData['male_Dir_Regular'] ?? '' }}"
                                                                @readonly(!$isEditable)
                                                            >
                                                        </div>
                                                        <div class="col-12">
                                                            <label for="maleInput">Female:</label>
                                                            <input
                                                                class="form-control number_input_only"
                                                                id="femaleInput"
                                                                name="female_Dir_Regular"
                                                                type="text"
                                                                value="{{ $reportData['female_Dir_Regular'] ?? '' }}"
                                                                @readonly(!$isEditable)
                                                            >
                                                        </div>
                                                        <div class="col-12">
                                                            <label for="maleInput">Workday:</label>
                                                            <input
                                                                class="form-control number_input_only"
                                                                id="workdayInput"
                                                                name="workday_Dir_Regular"
                                                                type="text"
                                                                value="{{ $reportData['workday_Dir_Regular'] ?? '' }}"
                                                                @readonly(!$isEditable)
                                                            >
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
                                                            <input
                                                                class="form-control number_input_only"
                                                                id="parttimeMaleInput"
                                                                name="male_Dir_PartT"
                                                                type="text"
                                                                value="{{ $reportData['male_Dir_PartT'] ?? '' }}"
                                                                @readonly(!$isEditable)
                                                            >
                                                        </div>
                                                        <div class="col-12">
                                                            <label for="maleInput">Female:</label>
                                                            <input
                                                                class="form-control number_input_only"
                                                                id="parttimeFemaleInput"
                                                                name="female_Dir_PartT"
                                                                type="text"
                                                                value="{{ $reportData['female_Dir_PartT'] ?? '' }}"
                                                                @readonly(!$isEditable)
                                                            >
                                                        </div>
                                                        <div class="col-12">
                                                            <label for="maleInput">Workday:</label>
                                                            <input
                                                                class="form-control number_input_only"
                                                                id="parttimeWorkdayInput"
                                                                name="workday_Dir_PartT"
                                                                type="text"
                                                                value="{{ $reportData['workday_Dir_PartT'] ?? '' }}"
                                                                @readonly(!$isEditable)
                                                            >
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
                    <div
                        class="card mb-0 mb-md-3"
                        id="indirectLaborCard"
                    >
                        <div class="card-header">
                            2.2 Indirect Labor(Admin and Marketing)
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-8 d-none">
                                    <div
                                        class="alert alert-primary h-100 "
                                        role="alert"
                                    >
                                        <h5 class="alert-heading"> <i class="ri-information-2-fill"></i> Indirect
                                            Personnel
                                        </h5>
                                        <p>Indirect personnel are those who are not actively involved in
                                            the production process of the products, such as
                                            Administrative staff, Managers, and Maintenance workers.
                                            <br>
                                        <ul>
                                            <li>Please provide the number of regular and part-time indirect employees
                                                for
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
                                                            <input
                                                                class="form-control number_input_only"
                                                                id="regularMaleInput"
                                                                name="male_Indir_Regular"
                                                                type="text"
                                                                value="{{ $reportData['male_Indir_Regular'] ?? '' }}"
                                                                @readonly(!$isEditable)
                                                            >
                                                        </div>
                                                        <div class="col-12">
                                                            <label for="regularFemaleInput">Female:</label>
                                                            <input
                                                                class="form-control number_input_only"
                                                                id="regularFemaleInput"
                                                                name="female_Indir_Regular"
                                                                type="text"
                                                                value="{{ $reportData['female_Indir_Regular'] ?? '' }}"
                                                                @readonly(!$isEditable)
                                                            >
                                                        </div>
                                                        <div class="col-12">
                                                            <label for="regularWorkdayInput">Workday:</label>
                                                            <input
                                                                class="form-control number_input_only"
                                                                id="regularWorkdayInput"
                                                                name="workday_Indir_Regular"
                                                                type="text"
                                                                value="{{ $reportData['workday_Indir_Regular'] ?? '' }}"
                                                                @readonly(!$isEditable)
                                                            >
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
                                                            <input
                                                                class="form-control number_input_only"
                                                                id="parttimeMaleInput"
                                                                name="male_Indir_PartT"
                                                                type="text"
                                                                value="{{ $reportData['male_Indir_PartT'] ?? '' }}"
                                                                @readonly(!$isEditable)
                                                            >

                                                        </div>
                                                        <div class="col-12">
                                                            <label for="parttimeFemaleInput">Female: </label>
                                                            <input
                                                                class="form-control number_input_only"
                                                                id="parttimeFemaleInput"
                                                                name="female_Indir_PartT"
                                                                type="text"
                                                                value="{{ $reportData['female_Indir_PartT'] ?? '' }}"
                                                                @readonly(!$isEditable)
                                                            >

                                                        </div>
                                                        <div class="col-12">
                                                            <label for="parttimeWorkdayInput">Workday: </label>
                                                            <input
                                                                class="form-control number_input_only"
                                                                id="parttimeWorkdayInput"
                                                                name="workday_Indir_PartT"
                                                                type="text"
                                                                value="{{ $reportData['workday_Indir_PartT'] ?? '' }}"
                                                                @readonly(!$isEditable)
                                                            >
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
                <div
                    class="card-body"
                    id="ProductionAndSalesInputs"
                >
                    <div class="d-flex align-items-center p-3">
                        <h5>3.0 PRODUCTION AND SALES DATA FOR THE QUARTER</h5>
                        @if ($isEditable)
                            <div class="ms-auto">
                                <button
                                    class="btn btn-primary btn-sm editButton"
                                    type="button"
                                ><i class="ri-edit-2-fill"></i></button>
                                <button
                                    class="btn btn-primary btn-sm revertButton"
                                    type="button"
                                    disabled
                                ><i class="ri-arrow-go-back-fill"></i></button>
                            </div>
                        @endIf
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div
                                class="alert alert-primary h-100 d-none"
                                role="alert"
                            >
                                <h5 class="alert-heading">
                                    <i class="ri-information-2-fill"></i> Export and Local Market Product
                                </h5>
                                <p>Please provide the necesary product Infomarmation for this Export and Local Market.
                                    The
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
                            <div
                                class="productExport"
                                id="productExport"
                            >
                                <strong>3.1 Export Market</strong>
                                <div class="row">
                                    <div class="mb-3">
                                        @if ($isEditable)
                                            <div class="mt-2">
                                                <div
                                                    class="d-flex justify-content-end p-2 addAndRemoveButton_Container">
                                                    <button
                                                        class="btn btn-primary addNewProductRow"
                                                        data-toggle="tooltip"
                                                        type="button"
                                                        title="Add a new row"
                                                        disabled
                                                    >
                                                        <i class="ri-add-box-fill"></i>
                                                    </button>
                                                    <button
                                                        class="btn btn-danger removeRowButton mx-2"
                                                        data-toggle="tooltip"
                                                        type="button"
                                                        title="Delete row"
                                                        disabled
                                                    >
                                                        <i class="ri-subtract-fill"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="table-responsive">
                                            <table
                                                class="table Export-Outlet"
                                                id="ExportOutletTable"
                                            >
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
                                                        <tr class="table_row">
                                                            <td>
                                                                <input
                                                                    class="form-control productName"
                                                                    type="text"
                                                                    value="{{ $exportProduct['ProductName'] ?? '' }}"
                                                                    @readonly(!$isEditable)
                                                                >
                                                            </td>
                                                            <td>
                                                                <textarea
                                                                    class="form-control w-100 packingDetails"
                                                                    @readonly(!$isEditable)
                                                                >{{ $exportProduct['PackingDetails'] ?? '' }} </textarea>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input
                                                                        class="form-control productionVolume_val"
                                                                        type="text"
                                                                        value="{{ $exportProduct['volumeOfProduction']['value'] ?? '' }}"
                                                                        @readonly(!$isEditable)
                                                                    >
                                                                    <select
                                                                        class="form-select volumeUnit"
                                                                        @readonly(!$isEditable)
                                                                    >
                                                                        <!-- Volume Units -->
                                                                        <optgroup label="Volume">
                                                                            <option
                                                                                value="mL"
                                                                                {{ $exportProduct['volumeOfProduction']['unit'] == 'mL' ? 'selected' : '' }}
                                                                            >Milliliters (mL)</option>
                                                                            <option
                                                                                value="cm³"
                                                                                {{ $exportProduct['volumeOfProduction']['unit'] == 'cm³' ? 'selected' : '' }}
                                                                            >Cubic Centimeters (cm³)</option>
                                                                            <option
                                                                                value="fl oz"
                                                                                {{ $exportProduct['volumeOfProduction']['unit'] == 'fl oz' ? 'selected' : '' }}
                                                                            >Fluid Ounces (fl oz)</option>
                                                                            <option
                                                                                value="cup"
                                                                                {{ $exportProduct['volumeOfProduction']['unit'] == 'cup' ? 'selected' : '' }}
                                                                            >Cups (cup)</option>
                                                                            <option
                                                                                value="pt"
                                                                                {{ $exportProduct['volumeOfProduction']['unit'] == 'pt' ? 'selected' : '' }}
                                                                            >Pints (pt)</option>
                                                                            <option
                                                                                value="qt"
                                                                                {{ $exportProduct['volumeOfProduction']['unit'] == 'qt' ? 'selected' : '' }}
                                                                            >Quarts (qt)</option>
                                                                            <option
                                                                                value="L"
                                                                                {{ $exportProduct['volumeOfProduction']['unit'] == 'L' ? 'selected' : '' }}
                                                                            >Liters (L)</option>
                                                                            <option
                                                                                value="gal"
                                                                                {{ $exportProduct['volumeOfProduction']['unit'] == 'gal' ? 'selected' : '' }}
                                                                            >Gallons (gal)</option>
                                                                            <option
                                                                                value="in³"
                                                                                {{ $exportProduct['volumeOfProduction']['unit'] == 'in³' ? 'selected' : '' }}
                                                                            >Cubic Inches (in³)</option>
                                                                            <option
                                                                                value="ft³"
                                                                                {{ $exportProduct['volumeOfProduction']['unit'] == 'ft³' ? 'selected' : '' }}
                                                                            >Cubic Feet (ft³)</option>
                                                                            <option
                                                                                value="cubic-meters"
                                                                                {{ $exportProduct['volumeOfProduction']['unit'] == 'm³' ? 'selected' : '' }}
                                                                            >Cubic Meters (m³)</option>
                                                                        </optgroup>
                                                                        <!-- Weight Units -->
                                                                        <optgroup label="Weight">
                                                                            <option
                                                                                value="g"
                                                                                {{ $exportProduct['volumeOfProduction']['unit'] == 'g' ? 'selected' : '' }}
                                                                            >Grams (g)</option>
                                                                            <option
                                                                                value="oz"
                                                                                {{ $exportProduct['volumeOfProduction']['unit'] == 'oz' ? 'selected' : '' }}
                                                                            >Ounces (oz)</option>
                                                                            <option
                                                                                value="lb"
                                                                                {{ $exportProduct['volumeOfProduction']['unit'] == 'lb' ? 'selected' : '' }}
                                                                            >Pounds (lb)</option>
                                                                            <option
                                                                                value="kg"
                                                                                {{ $exportProduct['volumeOfProduction']['unit'] == 'kg' ? 'selected' : '' }}
                                                                            >Kilograms (kg)</option>
                                                                        </optgroup>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-text">
                                                                        ₱
                                                                    </span>
                                                                    <input
                                                                        class="form-control grossSales_val"
                                                                        type="text"
                                                                        value="{{ $exportProduct['grossSales'] ?? '' }}"
                                                                        @readonly(!$isEditable)
                                                                    >
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-text">
                                                                        ₱
                                                                    </span>
                                                                    <input
                                                                        class="form-control estimatedCostOfProduction_val"
                                                                        type="text"
                                                                        value="{{ $exportProduct['estimatedCostOfProduction'] ?? '' }}"
                                                                        @readonly(!$isEditable)
                                                                    >
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-text">
                                                                        ₱
                                                                    </span>
                                                                    <input
                                                                        class="form-control netSales_val"
                                                                        type="text"
                                                                        value="{{ $exportProduct['netSales'] ?? '' }}"
                                                                        @readonly(!$isEditable)
                                                                    >
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr class="table_row">
                                                            <td>
                                                                <input
                                                                    class="form-control productName"
                                                                    type="text"
                                                                    @readonly(!$isEditable)
                                                                >
                                                            </td>
                                                            <td>
                                                                <textarea
                                                                    class="form-control w-100 packingDetails"
                                                                    @readonly(!$isEditable)
                                                                > </textarea>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input
                                                                        class="form-control productionVolume_val"
                                                                        type="text"
                                                                        @readonly(!$isEditable)
                                                                    >
                                                                    <select
                                                                        class="form-select volumeUnit"
                                                                        @readonly(!$isEditable)
                                                                    >
                                                                        <!-- Volume Units -->
                                                                        <optgroup label="Volume">
                                                                            <option value="mL">Milliliters
                                                                                (mL)
                                                                            </option>
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
                                                                    <input
                                                                        class="form-control grossSales_val"
                                                                        type="text"
                                                                        @readonly(!$isEditable)
                                                                    >
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-text">
                                                                        ₱
                                                                    </span>
                                                                    <input
                                                                        class="form-control estimatedCostOfProduction_val"
                                                                        type="text"
                                                                        @readonly(!$isEditable)
                                                                    >
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-text">
                                                                        ₱
                                                                    </span>
                                                                    <input
                                                                        class="form-control netSales_val"
                                                                        type="text"
                                                                        @readonly(!$isEditable)
                                                                    >
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
                            <div
                                class="productLocal"
                                id="productLocal"
                            >
                                <strong>3.2 Local Market</strong>
                                <div class="row p-0">
                                    <div class="col-12">
                                        @if ($isEditable)
                                            <div class="mt-2">
                                                <div
                                                    class="d-flex justify-content-end p-2 addAndRemoveButton_Container">
                                                    <button
                                                        class="btn btn-primary addNewProductRow"
                                                        data-toggle="tooltip"
                                                        type="button"
                                                        title="Add a new row"
                                                        disabled
                                                    >
                                                        <i class="ri-add-box-fill"></i>
                                                    </button>
                                                    <button
                                                        class="btn btn-danger removeRowButton mx-2"
                                                        data-toggle="tooltip"
                                                        type="button"
                                                        title="Delete row"
                                                        disabled
                                                    >
                                                        <i class="ri-subtract-fill"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="table-responsive">
                                            <table
                                                class="table Local-Outlet"
                                                id="LocalOutletTable"
                                            >
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
                                                        <tr class="table_row">
                                                            <td><input
                                                                    class="form-control productName"
                                                                    type="text"
                                                                    value="{{ $localProduct['ProductName'] ?? '' }}"
                                                                    @readonly(!$isEditable)
                                                                >
                                                            </td>
                                                            <td>
                                                                <textarea
                                                                    class="form-control packingDetails"
                                                                    @readonly(!$isEditable)
                                                                >{{ $localProduct['PackingDetails'] ?? '' }}</textarea>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input
                                                                        class="form-control productionVolume_val"
                                                                        type="text"
                                                                        value="{{ $localProduct['volumeOfProduction']['value'] }}"
                                                                        @readonly(!$isEditable)
                                                                    >
                                                                    <select class="form-select volumeUnit">
                                                                        <!-- Volume Units -->
                                                                        <option
                                                                            value="mL"
                                                                            {{ $localProduct['volumeOfProduction']['unit'] == 'mL' ? 'selected' : '' }}
                                                                        >Milliliters (mL)</option>
                                                                        <option
                                                                            value="cm³"
                                                                            {{ $localProduct['volumeOfProduction']['unit'] == 'cm³' ? 'selected' : '' }}
                                                                        >Cubic Centimeters (cm³)</option>
                                                                        <option
                                                                            value="fl oz"
                                                                            {{ $localProduct['volumeOfProduction']['unit'] == 'fl oz' ? 'selected' : '' }}
                                                                        >Fluid Ounces (fl oz)</option>
                                                                        <option
                                                                            value="cup"
                                                                            {{ $localProduct['volumeOfProduction']['unit'] == 'cup' ? 'selected' : '' }}
                                                                        >Cups (cup)</option>
                                                                        <option
                                                                            value="pt"
                                                                            {{ $localProduct['volumeOfProduction']['unit'] == 'pt' ? 'selected' : '' }}
                                                                        >Pints (pt)</option>
                                                                        <option
                                                                            value="qt"
                                                                            {{ $localProduct['volumeOfProduction']['unit'] == 'qt' ? 'selected' : '' }}
                                                                        >Quarts (qt)</option>
                                                                        <option
                                                                            value="L"
                                                                            {{ $localProduct['volumeOfProduction']['unit'] == 'L' ? 'selected' : '' }}
                                                                        >Liters (L)</option>
                                                                        <option
                                                                            value="gal"
                                                                            {{ $localProduct['volumeOfProduction']['unit'] == 'gal' ? 'selected' : '' }}
                                                                        >Gallons (gal)</option>
                                                                        <option
                                                                            value="in³"
                                                                            {{ $localProduct['volumeOfProduction']['unit'] == 'in³' ? 'selected' : '' }}
                                                                        >Cubic Inches (in³)</option>
                                                                        <option
                                                                            value="ft³"
                                                                            {{ $localProduct['volumeOfProduction']['unit'] == 'ft³' ? 'selected' : '' }}
                                                                        >Cubic Feet (ft³)</option>
                                                                        <option
                                                                            value="cubic-meters"
                                                                            {{ $localProduct['volumeOfProduction']['unit'] == 'm³' ? 'selected' : '' }}
                                                                        >Cubic Meters (m³)</option>
                                                                        </optgroup>
                                                                        <!-- Weight Units -->
                                                                        <optgroup label="Weight">
                                                                            <option
                                                                                value="g"
                                                                                {{ $localProduct['volumeOfProduction']['unit'] == 'g' ? 'selected' : '' }}
                                                                            >Grams (g)</option>
                                                                            <option
                                                                                value="oz"
                                                                                {{ $localProduct['volumeOfProduction']['unit'] == 'oz' ? 'selected' : '' }}
                                                                            >Ounces (oz)</option>
                                                                            <option
                                                                                value="lb"
                                                                                {{ $localProduct['volumeOfProduction']['unit'] == 'lb' ? 'selected' : '' }}
                                                                            >Pounds (lb)</option>
                                                                            <option
                                                                                value="kg"
                                                                                {{ $localProduct['volumeOfProduction']['unit'] == 'kg' ? 'selected' : '' }}
                                                                            >Kilograms (kg)</option>
                                                                        </optgroup>
                                                                    </select>
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-text">₱</span>
                                                                    <input
                                                                        class="form-control grossSales_val"
                                                                        type="text"
                                                                        value="{{ $localProduct['grossSales'] ?? '' }}"
                                                                        @readonly(!$isEditable)
                                                                    >
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-text">₱</span>
                                                                    <input
                                                                        class="form-control estimatedCostOfProduction_val"
                                                                        type="text"
                                                                        value="{{ $localProduct['estimatedCostOfProduction'] ?? '' }}"
                                                                        @readonly(!$isEditable)
                                                                    >
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-text">₱</span>
                                                                    <input
                                                                        class="form-control netSales_val"
                                                                        type="text"
                                                                        value="{{ $localProduct['netSales'] ?? '' }}"
                                                                        @readonly(!$isEditable)
                                                                    >
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr class="table_row">
                                                            <td><input
                                                                    class="form-control productName"
                                                                    type="text"
                                                                    @readonly(!$isEditable)
                                                                ></td>
                                                            <td>
                                                                <textarea
                                                                    class="form-control packingDetails"
                                                                    @readonly(!$isEditable)
                                                                ></textarea>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input
                                                                        class="form-control productionVolume_val"
                                                                        type="text"
                                                                        @readonly(!$isEditable)
                                                                    >
                                                                    <select class="form-select volumeUnit">
                                                                        <!-- Volume Units -->
                                                                        <optgroup label="Volume">
                                                                            <option value="mL">Milliliters
                                                                                (mL)
                                                                            </option>
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
                                                                    <input
                                                                        class="form-control grossSales_val"
                                                                        type="text"
                                                                        @readonly(!$isEditable)
                                                                    >
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-text">₱</span>
                                                                    <input
                                                                        class="form-control estimatedCostOfProduction_val"
                                                                        type="text"
                                                                        @readonly(!$isEditable)
                                                                    >
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-text">₱</span>
                                                                    <input
                                                                        class="form-control netSales_val"
                                                                        type="text"
                                                                        @readonly(!$isEditable)
                                                                    >
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
                    <div
                        class="card-body"
                        id="marketOutletInputs"
                    >
                        <div class="d-flex align-items-center p-3">
                            <h5>4.0 MARKET OUTLETS</h5>
                            @if ($isEditable)
                                <div class="ms-auto">
                                    <button
                                        class="btn btn-primary btn-sm editButton"
                                        type="button"
                                    ><i class="ri-edit-2-fill"></i></button>
                                    <button
                                        class="btn btn-primary btn-sm revertButton"
                                        type="button"
                                        disabled
                                    ><i class="ri-arrow-go-back-fill"></i></button>
                                </div>
                            @endIf
                        </div>
                        <div class="row">
                            <div class="col-12 my-3">
                                <div
                                    class="alert alert-primary h-100 d-none"
                                    role="alert"
                                >
                                    <h5 class="alert-heading">
                                        <i class="ri-information-2-fill"></i> Export and Local Market
                                    </h5>
                                    <p>
                                        Kindly provide the necessary information for this Export and Local Market
                                        Outlet.
                                        The
                                        following
                                        details are needed.
                                    <ul>
                                        <li>
                                            Export - location name in which the outlet is located(example: USA, China,
                                            etc)
                                        </li>
                                        <li>
                                            Local - location name in which the outlet is located(example: Carmin, Tagum,
                                            etc)
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
                                    <textarea
                                        class="form-control h-100"
                                        id="exportTextarea"
                                        name="Market_Export"
                                        placeholder="Export"
                                        @readonly(!$isEditable)
                                    >{{ $reportData['Market_Export'] ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <strong class="ms-2">4.2 Local</strong>
                                <div class="ms-4">
                                    <textarea
                                        class="form-control h-100"
                                        id="localTextarea"
                                        name="Market_local"
                                        placeholder="Local"
                                        @readonly(!$isEditable)
                                    >{{ $reportData['Market_local'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($isEditable)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-end p-1">
                                <button
                                    class="btn btn-primary"
                                    type="submit"
                                >Submit</button>
                            </div>
                        </div>
                    </div>
                @endIf
        </form>
    </div>
</div>
