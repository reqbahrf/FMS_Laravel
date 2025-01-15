<div
    class="h-100 mt-2"
    id="PDSFormContainer"
>
    <!-- FIXME: Breadcrumb not working look for the js event listener -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a
                    class="revertToSelectDoc"
                    href="#"
                >Select Document</a></li>
            <li
                class="breadcrumb-item active"
                aria-current="page"
            >Project Data Sheet</li>
        </ol>
    </nav>
    <form id="projectDataForm">
        <div class="row gy-3 p-0">
            <div class="col-12">
                <div class="card shadow-sm rounded p-0">
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-12">
                                <h6>Project Information</h6>
                            </div>
                            <div class="col-12">
                                <label
                                    class="form-label"
                                    for="projectTitle"
                                >Project Title</label>
                                <input
                                    class="form-control ms-2"
                                    id="projectTitle"
                                    name="projectTitle"
                                    type="text"
                                    value="{{ $projectData->project_title ?? '' }}"
                                    placeholder="Enter Project Title"
                                >
                            </div>
                            <div class="col-12">
                                <label
                                    class="form-label"
                                    for="firmName"
                                >Firm Name</label>
                                <input
                                    class="form-control ms-2"
                                    id="firmName"
                                    name="firmName"
                                    type="text"
                                    value="{{ $projectData->firm_name ?? '' }}"
                                    placeholder="Enter Firm Name"
                                >
                            </div>
                            <div class="col-12">
                                <label
                                    class="form-label"
                                    for="address"
                                >Address</label>
                                <input
                                    class="form-control ms-2"
                                    id="address"
                                    name="address"
                                    type="text"
                                    value="{{ ($projectData->landMark ?? '') . ', ' . ($projectData->barangay ?? '') . ', ' . ($projectData->city ?? '') . ', ' . ($projectData->province ?? '') . ', ' . ($projectData->region ?? '') . ', ' . ($projectData->zip_code ?? '') }}"
                                    placeholder="Enter Address"
                                >
                            </div>
                            <div class="col-12 col-md-6">
                                <label
                                    class="form-label"
                                    for="ContactPerson"
                                >Contact Person</label>
                                <input
                                    class="form-control ms-2"
                                    id="ContactPerson"
                                    name="ContactPerson"
                                    type="text"
                                    value="{{ ($projectData->f_name ?? '') . ' ' . ($projectData->mid_name ?? '') . ' ' . ($projectData->l_name ?? '') . ' ' . ($projectData->suffix ?? '') }}"
                                    placeholder="Enter Contact Person"
                                >
                            </div>
                            <div class="col-12 col-md-6">
                                <label
                                    class="form-label"
                                    for="Designation"
                                >Designation</label>
                                <input
                                    class="form-control ms-2"
                                    id="Designation"
                                    name="Designation"
                                    type="text"
                                    value="{{ $projectData->designation ?? '' }}"
                                    placeholder="Enter Designation"
                                >
                            </div>
                            <div class="col-12 my-2">
                                <span class="fw-semibold">Contact Details:</span>
                            </div>
                            <div class="col-12 col-md-3">
                                <label
                                    class="form-label"
                                    for="landline"
                                >Landline</label>
                                <input
                                    class="form-control ms-2"
                                    id="landline"
                                    name="landline"
                                    type="text"
                                    value="{{ $projectData->landline ?? '' }}"
                                    placeholder="Enter Landline"
                                >
                            </div>
                            <div class="col-12 col-md-3">
                                <label
                                    class="form-label"
                                    for="mobile"
                                >Mobile Phone</label>
                                <input
                                    class="form-control ms-2"
                                    id="mobile"
                                    name="mobile"
                                    type="text"
                                    value="{{ $projectData->mobile_number ?? '' }}"
                                    placeholder="Enter Mobile Number"
                                >
                            </div>
                            <div class="col-12 col-md-3">
                                <label
                                    class="form-label"
                                    for="email"
                                >Email</label>
                                <input
                                    class="form-control ms-2"
                                    id="email"
                                    name="email"
                                    type="text"
                                    value="{{ $projectData->email ?? '' }}"
                                    placeholder="Enter Email"
                                >
                            </div>
                            <div class="col-12 my-2">
                                <span class="fw-semibold">Period Covered(Please tick)</span>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        id="FirstQuarter"
                                        name="reportingQuarter"
                                        type="radio"
                                        value="Q1"
                                        {{ isset($CurrentQuarterlyData['quarter']) && str_starts_with($CurrentQuarterlyData['quarter'], 'Q1') ? 'checked' : '' }}
                                    >
                                    <label
                                        class="form-check-label"
                                        for="FirstQuarter"
                                    >
                                        1st Quarter
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        id="SecondQuarter"
                                        name="reportingQuarter"
                                        type="radio"
                                        value="Q2"
                                        {{ isset($CurrentQuarterlyData['quarter']) && str_starts_with($CurrentQuarterlyData['quarter'], 'Q2') ? 'checked' : '' }}
                                    >
                                    <label
                                        class="form-check-label"
                                        for="SecondQuarter"
                                    >
                                        2nd Quarter
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        id="ThirdQuarter"
                                        name="reportingQuarter"
                                        type="radio"
                                        value="Q3"
                                        {{ isset($CurrentQuarterlyData['quarter']) && str_starts_with($CurrentQuarterlyData['quarter'], 'Q3') ? 'checked' : '' }}
                                    >
                                    <label
                                        class="form-check-label"
                                        for="ThirdQuarter"
                                    >
                                        3rd Quarter
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        id="FourthQuarter"
                                        name="reportingQuarter"
                                        type="radio"
                                        value="Q4"
                                        {{ isset($CurrentQuarterlyData['quarter']) && str_starts_with($CurrentQuarterlyData['quarter'], 'Q4') ? 'checked' : '' }}
                                    >
                                    <label
                                        class="form-check-label"
                                        for="FourthQuarter"
                                    >
                                        4th Quarter
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card p-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">1.0 Assets</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <input
                                class="bottom_border w-25"
                                type="text"
                                readonly
                            >
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label
                                    class="form-label"
                                    for="buildingAsset"
                                >1.1 Building</label>
                                <input
                                    class="form-control"
                                    id="buildingAsset"
                                    name="buildingAsset"
                                    type="text"
                                    value="{{ $CurrentQuarterlyData['Building'] ?? '' }}"
                                >
                            </div>
                            <div class="col-md-4">
                                <label
                                    class="form-label"
                                    for="EquipmentAsset"
                                >1.2 Equipment</label>
                                <input
                                    class="form-control"
                                    id="EquipmentAsset"
                                    name="EquipmentAsset"
                                    type="text"
                                    value="{{ $CurrentQuarterlyData['Equipment'] ?? '' }}"
                                >
                            </div>
                            <div class="col-md-4">
                                <label
                                    class="form-label"
                                    for="workingCapitalAsset"
                                >1.3 Working Capital</label>
                                <input
                                    class="form-control"
                                    id="workingCapitalAsset"
                                    name="workingCapitalAsset"
                                    type="text"
                                    value="{{ $CurrentQuarterlyData['WorkingCapital'] ?? '' }}"
                                >
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="fw-semibold">Classification of Enterprise</span>
                        </div>
                        <div class="row g-3 mt-2">
                            @php
                                $building = floatval(str_replace(',', '', $CurrentQuarterlyData['Building'] ?? 0));
                                $equipment = floatval(str_replace(',', '', $CurrentQuarterlyData['Equipment'] ?? 0));
                                $workingCapital = floatval(
                                    str_replace(',', '', $CurrentQuarterlyData['WorkingCapital'] ?? 0),
                                );
                                $totalAssets = $building + $equipment + $workingCapital;
                            @endphp
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        id="Micro"
                                        name="EnterpriseClass"
                                        type="radio"
                                        value="Micro"
                                        {{ $totalAssets < 3000000 ? 'checked' : '' }}
                                    >
                                    <label
                                        class="form-check-label"
                                        for="Micro"
                                    >
                                        Micro(assets less than 3M)
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        id="Small"
                                        name="EnterpriseClass"
                                        type="radio"
                                        value="Small"
                                        {{ $totalAssets >= 3000000 && $totalAssets < 15000000 ? 'checked' : '' }}
                                    >
                                    <label
                                        class="form-check-label"
                                        for="Small"
                                    >
                                        Small(assets of 3M than 15M)
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        id="Medium"
                                        name="EnterpriseClass"
                                        type="radio"
                                        value="Medium"
                                        {{ $totalAssets >= 15000000 && $totalAssets < 100000000 ? 'checked' : '' }}
                                    >
                                    <label
                                        class="form-check-label"
                                        for="Medium"
                                    >
                                        Medium(assets of 15M than 100M)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">2.0 Total Employment For the Quarter</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th width="25%">Category</th>
                                        <th width="15%">Male</th>
                                        <th width="15%">Female</th>
                                        <th width="15%">Total Workday</th>
                                        <th width="15%">Total Man-Month</th>
                                        <th width="15%">Remark</th>
                                    </tr>
                                </thead>
                                <tbody id="totalEmployment">
                                    <tr>
                                        <td
                                            class="fw-bold"
                                            colspan="6"
                                        >2.1 Direct Labor Force (Production)</td>
                                    </tr>
                                    <tr class="DirectRegular">
                                        <td class="ps-4">2.1a Regular</td>
                                        <td><input
                                                class="form-control maleInput"
                                                id="DireRegularMale"
                                                name="DireRegularMale"
                                                type="text"
                                                value="{{ $CurrentQuarterlyData['male_Dir_Regular'] ?? '' }}"
                                            ></td>
                                        <td><input
                                                class="form-control femaleInput"
                                                id="DireRegularFemale"
                                                name="DireRegularFemale"
                                                type="text"
                                                value="{{ $CurrentQuarterlyData['female_Dir_Regular'] ?? '' }}"
                                            ></td>
                                        <td><input
                                                class="form-control workdayInput"
                                                id="DireRegularTotalWorkday"
                                                name="DireRegularTotalWorkday"
                                                type="text"
                                                value="{{ $CurrentQuarterlyData['workday_Dir_Regular'] ?? '' }}"
                                            ></td>
                                        <td><input
                                                class="form-control totalManMonth"
                                                id="DireRegularTotalManMonth"
                                                name="DireRegularTotalManMonth"
                                                type="text"
                                                readonly
                                            ></td>
                                        <td><input
                                                class="form-control"
                                                id="RemarkDirectLabor"
                                                name="RemarkDirectLabor"
                                                type="text"
                                            ></td>
                                    </tr>
                                    <tr class="DirectParttime">
                                        <td class="ps-4">2.1b Part Time</td>
                                        <td><input
                                                class="form-control maleInput"
                                                id="ParttimeMale"
                                                name="ParttimeMale"
                                                type="text"
                                                value="{{ $CurrentQuarterlyData['male_Dir_PartT'] ?? '' }}"
                                            ></td>
                                        <td><input
                                                class="form-control femaleInput"
                                                id="ParttimeFemale"
                                                name="ParttimeFemale"
                                                type="text"
                                                value="{{ $CurrentQuarterlyData['female_Dir_PartT'] ?? '' }}"
                                            ></td>
                                        <td><input
                                                class="form-control workdayInput"
                                                id="ParttimeTotalWorkday"
                                                name="ParttimeTotalWorkday"
                                                type="text"
                                                value="{{ $CurrentQuarterlyData['workday_Dir_PartT'] ?? '' }}"
                                            ></td>
                                        <td><input
                                                class="form-control totalManMonth"
                                                id="ParttimeTotalManMonth"
                                                name="ParttimeTotalManMonth"
                                                type="text"
                                                readonly
                                            ></td>
                                        <td><input
                                                class="form-control"
                                                id="RemarkParttime"
                                                name="RemarkParttime"
                                                type="text"
                                            ></td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="fw-bold"
                                            colspan="6"
                                        >2.2 Indirect Labor Force (Admin and
                                            Marketing)</td>
                                    </tr>
                                    <tr class="IndirectRegular">
                                        <td class="ps-4">2.2a Regular</td>
                                        <td><input
                                                class="form-control maleInput"
                                                id="IndiRegularMale"
                                                name="IndiRegularMale"
                                                type="text"
                                                value="{{ $CurrentQuarterlyData['male_Indir_Regular'] ?? '' }}"
                                            ></td>
                                        <td><input
                                                class="form-control femaleInput"
                                                id="IndiRegularFemale"
                                                name="IndiRegularFemale"
                                                type="text"
                                                value="{{ $CurrentQuarterlyData['female_Indir_Regular'] ?? '' }}"
                                            >
                                        </td>
                                        <td><input
                                                class="form-control workdayInput"
                                                id="IndiRegularTotalWorkday"
                                                name="IndiRegularTotalWorkday"
                                                type="text"
                                                value="{{ $CurrentQuarterlyData['workday_Indir_Regular'] ?? '' }}"
                                            >
                                        </td>
                                        <td><input
                                                class="form-control totalManMonth"
                                                id="IndiRegularTotalManMonth"
                                                name="IndiRegularTotalManMonth"
                                                type="text"
                                                readonly
                                            ></td>
                                        <td><input
                                                class="form-control"
                                                id="IndiRegularRemark"
                                                name="IndiRegularRemark"
                                                type="text"
                                            ></td>
                                    </tr>
                                    <tr class="IndiParttime">
                                        <td class="ps-4">2.2b Part-time</td>
                                        <td><input
                                                class="form-control maleInput"
                                                id="IndiParttimeMale"
                                                name="IndiParttimeMale"
                                                type="text"
                                                value="{{ $CurrentQuarterlyData['male_Indir_PartT'] ?? '' }}"
                                            ></td>
                                        <td><input
                                                class="form-control femaleInput"
                                                id="IndiParttimeFemale"
                                                name="IndiParttimeFemale"
                                                type="text"
                                                value="{{ $CurrentQuarterlyData['female_Indir_PartT'] ?? '' }}"
                                            ></td>
                                        <td><input
                                                class="form-control workdayInput"
                                                id="IndiParttimeTotalWorkday"
                                                name="IndiParttimeTotalWorkday"
                                                type="text"
                                                value="{{ $CurrentQuarterlyData['workday_Indir_PartT'] ?? '' }}"
                                            ></td>
                                        <td><input
                                                class="form-control totalManMonth"
                                                id="IndiParttimeTotalManMonth"
                                                name="IndiParttimeTotalManMonth"
                                                type="text"
                                                readonly
                                            ></td>
                                        <td><input
                                                class="form-control"
                                                id="IndiParttimeRemark"
                                                name="IndiParttimeRemark"
                                                type="text"
                                            ></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <span class="fw-bold">Total Employment for this Quarter:</span>
                            </div>
                            <div class="col-md-3">
                                <label
                                    class="form-label"
                                    for="TotalEmployment"
                                >No. of Personnel</label>
                                <input
                                    class="form-control"
                                    id="TotalEmployment"
                                    name="TotalEmployment"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-md-3">
                                <label
                                    class="form-label"
                                    for="TotalManMonth"
                                >No. of Man Month</label>
                                <input
                                    class="form-control"
                                    id="TotalManMonth"
                                    name="TotalManMonth"
                                    type="text"
                                    readonly
                                >
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">3.0 Production and Sales Data for the Quarter</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- Export Market Table -->
                            <h6 class="fw-bold text-primary mt-3">3.1 Export Market</h6>
                            <table
                                class="table table-bordered align-middle"
                                id="exportMarketTable"
                            >
                                <colgroup>
                                    <col style="width: 20%;">
                                    <col style="width: 20%;">
                                    <col style="width: 15%;">
                                    <col style="width: 15%;">
                                    <col style="width: 15%;">
                                    <col style="width: 15%;">
                                </colgroup>
                                <thead class="table-light">
                                    <tr>
                                        <th>Name of Product</th>
                                        <th>Packaging Details</th>
                                        <th>Volume of Production</th>
                                        <th>Gross Sales</th>
                                        <th>Estimated Cost of Production</th>
                                        <th>Net Sales</th>
                                    </tr>
                                </thead>
                                <tbody id="exportProducts">
                                    @forelse ($CurrentQuarterlyData['ExportProduct'] ?? [] as $ExportProduct)
                                        <tr>
                                            <td><input
                                                    class="form-control productName"
                                                    type="text"
                                                    value="{{ $ExportProduct['ProductName'] ?? '' }}"
                                                ></td>
                                            <td><input
                                                    class="form-control packingDetails"
                                                    type="text"
                                                    value="{{ $ExportProduct['PackingDetails'] ?? '' }}"
                                                ></td>
                                            <td><input
                                                    class="form-control volumeOfProduction_val"
                                                    type="text"
                                                    value="{{ ($ExportProduct['volumeOfProduction']['value'] ?? '') . ' ' . ($ExportProduct['volumeOfProduction']['unit'] ?? '') }}"
                                                ></td>
                                            <td><input
                                                    class="form-control grossSales_val"
                                                    type="text"
                                                    value="{{ $ExportProduct['grossSales'] ?? '' }}"
                                                ></td>
                                            <td><input
                                                    class="form-control productionCost_val"
                                                    type="text"
                                                    value="{{ $ExportProduct['estimatedCostOfProduction'] ?? '' }}"
                                                >
                                            </td>
                                            <td><input
                                                    class="form-control netSales_val"
                                                    type="text"
                                                    value="{{ $ExportProduct['netSales'] ?? '' }}"
                                                ></td>
                                        </tr>
                                    @empty
                                        <!-- Empty Rows Placeholder -->
                                        @for ($i = 0; $i < 3; $i++)
                                            <tr>
                                                <td><input
                                                        class="form-control productName"
                                                        type="text"
                                                    ></td>
                                                <td><input
                                                        class="form-control packingDetails"
                                                        type="text"
                                                    ></td>
                                                <td><input
                                                        class="form-control volumeOfProduction_val"
                                                        type="text"
                                                    >
                                                </td>
                                                <td><input
                                                        class="form-control grossSales_val"
                                                        type="text"
                                                    ></td>
                                                <td><input
                                                        class="form-control productionCost_val"
                                                        type="text"
                                                    >
                                                </td>
                                                <td><input
                                                        class="form-control netSales_val"
                                                        type="text"
                                                    ></td>
                                            </tr>
                                        @endfor
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Local Market Table -->
                        <div class="table-responsive">
                            <h6 class="fw-bold text-primary mt-4">3.2 Local Market</h6>
                            <table
                                class="table table-bordered align-middle"
                                id="localMarketTable"
                            >
                                <colgroup>
                                    <col style="width: 20%;">
                                    <col style="width: 20%;">
                                    <col style="width: 15%;">
                                    <col style="width: 15%;">
                                    <col style="width: 15%;">
                                    <col style="width: 15%;">
                                </colgroup>
                                <thead class="table-light">
                                    <tr>
                                        <th>Name of Product</th>
                                        <th>Packaging Details</th>
                                        <th>Volume of Production</th>
                                        <th>Gross Sales</th>
                                        <th>Estimated Cost of Production</th>
                                        <th>Net Sales</th>
                                    </tr>
                                </thead>
                                <tbody id="localProducts">
                                    @forelse ($CurrentQuarterlyData['LocalProduct'] ?? [] as $LocalProduct)
                                        <tr>
                                            <td><input
                                                    class="form-control productName"
                                                    type="text"
                                                    value="{{ $LocalProduct['ProductName'] ?? '' }}"
                                                ></td>
                                            <td><input
                                                    class="form-control packingDetails"
                                                    type="text"
                                                    value="{{ $LocalProduct['PackingDetails'] ?? '' }}"
                                                ></td>
                                            <td><input
                                                    class="form-control volumeOfProduction_val"
                                                    type="text"
                                                    value="{{ ($LocalProduct['volumeOfProduction']['value'] ?? '') . ' ' . ($LocalProduct['volumeOfProduction']['unit'] ?? '') }}"
                                                ></td>
                                            <td><input
                                                    class="form-control grossSales_val"
                                                    type="text"
                                                    value="{{ $LocalProduct['grossSales'] ?? '' }}"
                                                ></td>
                                            <td><input
                                                    class="form-control productionCost_val"
                                                    type="text"
                                                    value="{{ $LocalProduct['estimatedCostOfProduction'] ?? '' }}"
                                                >
                                            </td>
                                            <td><input
                                                    class="form-control netSales_val"
                                                    type="text"
                                                    value="{{ $LocalProduct['netSales'] ?? '' }}"
                                                ></td>
                                        </tr>
                                    @empty
                                        <!-- Empty Rows Placeholder -->
                                        @for ($i = 0; $i < 3; $i++)
                                            <tr>
                                                <td><input
                                                        class="form-control productName"
                                                        type="text"
                                                    ></td>
                                                <td><input
                                                        class="form-control packingDetails"
                                                        type="text"
                                                    ></td>
                                                <td><input
                                                        class="form-control volumeOfProduction_val"
                                                        type="text"
                                                    >
                                                </td>
                                                <td><input
                                                        class="form-control grossSales_val"
                                                        type="text"
                                                    ></td>
                                                <td><input
                                                        class="form-control productionCost_val"
                                                        type="text"
                                                    >
                                                </td>
                                                <td><input
                                                        class="form-control netSales_val"
                                                        type="text"
                                                    ></td>
                                            </tr>
                                        @endfor
                                    @endforelse
                                    <tr>
                                        <td
                                            class="fw-bold text-end"
                                            colspan="3"
                                        >Total</td>
                                        <td><input
                                                class="form-control totalGrossSales_val"
                                                id="totalGrossSales"
                                                name="totalGrossSales"
                                                type="text"
                                                readonly
                                            ></td>
                                        <td><input
                                                class="form-control totalProductionCost_val"
                                                id="totalProductionCost"
                                                name="totalProductionCost"
                                                type="text"
                                                readonly
                                            ></td>
                                        <td><input
                                                class="form-control totalNetSales_val"
                                                id="totalNetSales"
                                                name="totalNetSales"
                                                type="text"
                                                readonly
                                            >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card shadow-sm p-0">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">4.0 Market Outlets</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <label
                                    class="form-label"
                                    for="Export"
                                >4.1 Export</label>
                                <textarea
                                    class="form-control"
                                    id="Export"
                                    name="ExportOutlet"
                                    rows="3"
                                >{{ $CurrentQuarterlyData['Market_Export'] ?? '' }}</textarea>
                            </div>
                            <div class="col-12">
                                <label
                                    class="form-label"
                                    for="Local"
                                >4.2 Local</label>
                                <textarea
                                    class="form-control"
                                    id="Local"
                                    name="LocalOutlet"
                                    rows="3"
                                >{{ $CurrentQuarterlyData['Market_local'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card shadow-sm p-0">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">4.0 Market Outlets</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="table-header"
                                                    colspan="4"
                                                >TO BE ACCOMPLISHED BY DOST XI
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="ToBeAccomplished">
                                            <tr>
                                                <td
                                                    class="highlight-text"
                                                    rowspan="2"
                                                >Gross Sales Generated
                                                    =<br>Gross
                                                    Sales {{ $CurrentQuarterlyData['quarter'] ?? '' }} - Gross Sales
                                                    {{ $PreviousQuarterlyData['quarter'] ?? '' }}</td>
                                                <td class="table-subheader">Gross Sales
                                                    {{ $CurrentQuarterlyData['quarter'] ?? '' }} <br> (for the
                                                    reporting
                                                    period)
                                                </td>
                                                <td class="table-subheader">Gross Sales
                                                    {{ $PreviousQuarterlyData['quarter'] ?? '' }} <br> (previous
                                                    quarter)</td>
                                                <td class="table-subheader">TOTAL GROSS SALES GENERATED</td>
                                            </tr>
                                            @php
                                                if ($PreviousQuarterlyData != null) {
                                                    $PreviousGrossSalesTotal = 0;
                                                    foreach (
                                                        $PreviousQuarterlyData['ExportProduct']
                                                        as $ExportProduct
                                                    ) {
                                                        $PreviousGrossSalesTotal += (float) str_replace(
                                                            ',',
                                                            '',
                                                            $ExportProduct['grossSales'],
                                                        );
                                                    }
                                                    foreach ($PreviousQuarterlyData['LocalProduct'] as $LocalProduct) {
                                                        $PreviousGrossSalesTotal += (float) str_replace(
                                                            ',',
                                                            '',
                                                            $LocalProduct['grossSales'],
                                                        );
                                                    }
                                                }
                                            @endphp
                                            <tr class="grossSalesGenerated">
                                                <td class="table-data">
                                                    ₱1,600,000.00
                                                    <div class="d-flex">
                                                        ₱
                                                        <input
                                                            class="bottom_border CurrentgrossSales_val"
                                                            name="CurrentgrossSales"
                                                            type="text"
                                                            value=""
                                                        >
                                                    </div>
                                                </td>
                                                <td class="table-data">
                                                    ₱1,556,709.00
                                                    <div class="d-flex">
                                                        ₱
                                                        <input
                                                            class="bottom_border PreviousgrossSales_val"
                                                            name="PreviousgrossSales"
                                                            type="text"
                                                            value="{{ number_format($PreviousGrossSalesTotal ?? null, 2) ?? '' }}"
                                                        >
                                                    </div>
                                                </td>
                                                <td class="table-data">₱43,291.00
                                                    <div class="d-flex">
                                                        ₱
                                                        <input
                                                            class="bottom_border TotalgrossSales_val"
                                                            name="TotalgrossSales"
                                                            type="text"
                                                            readonly
                                                        >
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="increaseInProductivity">
                                                <td class="highlight-text">% Increase in Productivity Generated =<br>
                                                    <div style="text-align: center;">
                                                        Gross Sales {{ $CurrentQuarterlyData['quarter'] ?? '' }} -
                                                        Gross Sales
                                                        {{ $PreviousQuarterlyData['quarter'] ?? '' }} x 100<br>
                                                        Gross Sales {{ $PreviousQuarterlyData['quarter'] ?? '' }}
                                                    </div>
                                                </td>
                                                <td
                                                    class="table-data nowrap"
                                                    colspan="3"
                                                    width="50%"
                                                >
                                                    1,600,000.00 -
                                                    1,556,709.00 x 100 / 1,556,709.00 = 2.78% <br>
                                                    <span class="CurrentgrossSales_val_cal"></span>
                                                    -
                                                    <span class="PreviousgrossSales_val_cal"></span>
                                                    x 100 / <span class="PreviousgrossSales_val_cal"></span> =
                                                    <span class="totalgrossSales_percent"></span>
                                                    <input
                                                        class="bottom_border totalgrossSales_percent"
                                                        name="totalgrossSales_percent"
                                                        type="text"
                                                        style="width:10%;"
                                                        readonly
                                                    >

                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="highlight-text"
                                                    rowspan="2"
                                                >Employees Generated
                                                    =<br>Employement
                                                    {{ $CurrentQuarterlyData['quarter'] ?? '' }} - Employement
                                                    {{ $PreviousQuarterlyData['quarter'] ?? '' }}</td>
                                                <td class="table-subheader">Total Employment
                                                    {{ $CurrentQuarterlyData['quarter'] ?? '' }} <br> (for the
                                                    reporting
                                                    period)
                                                </td>
                                                <td class="table-subheader">Total Employment
                                                    {{ $PreviousQuarterlyData['quarter'] ?? '' }} <br> (previous
                                                    quarter)</td>
                                                <td class="table-subheader">TOTAL EMPLOYMENT GENERATED</td>
                                            </tr>
                                            <tr class="EmploymentGenerated">
                                                <td class="table-data">
                                                    10
                                                    <input
                                                        class="bottom_border CurrentEmployment_val"
                                                        name="CurrentEmployment"
                                                        type="text"
                                                    >
                                                </td>
                                                <td class="table-data">
                                                    10
                                                    <input
                                                        class="bottom_border PreviousEmployment_val"
                                                        name="PreviousEmployment"
                                                        type="text"
                                                    >
                                                </td>
                                                <td class="table-data">0
                                                    <input
                                                        class="bottom_border TotalEmployment_val"
                                                        name="TotalEmploymentGenerated"
                                                        type="text"
                                                        readonly
                                                    >
                                                </td>
                                            </tr>
                                            <tr class="increaseInEmployment">
                                                <td class="highlight-text">% Increase in Employment Generated =<br>
                                                    <div style="text-align: center;">
                                                        Employment {{ $CurrentQuarterlyData['quarter'] ?? '' }} -
                                                        Employment
                                                        {{ $PreviousQuarterlyData['quarter'] ?? '' }} x 100<br>
                                                        Employment {{ $PreviousQuarterlyData['quarter'] ?? '' }}
                                                    </div>
                                                </td>
                                                <td
                                                    class="table-data nowrap"
                                                    colspan="3"
                                                    width="50%"
                                                >10 - 10 x
                                                    100 /
                                                    10 = 0% <br>
                                                    <span class="CurrentEmployment_val_cal"></span>
                                                    -
                                                    <span class="PreviousEmployment_val_cal"></span>
                                                    x 100 / <span class="PreviousEmployment_val_cal"></span> =
                                                    <input
                                                        class="bottom_border totalEmployment_percent"
                                                        name="totalEmployment_percent"
                                                        type="text"
                                                        style="width:10%;"
                                                        readonly
                                                    >
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="container my-4">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
    <div class="d-flex justify-content-end p-3">
        <button
            class="btn btn-primary ExportPDF"
            data-to-export="PDS"
            type="button"
        >Export as PDF</button>
    </div>
</div>
