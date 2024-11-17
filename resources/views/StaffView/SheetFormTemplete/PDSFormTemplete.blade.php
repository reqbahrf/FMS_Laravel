<div id="PDSFormContainer" class="h-100 mt-2">
    <!-- FIXME: Breadcrumb not working look for the js event listener -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#" class="revertToSelectDoc">Select Document</a></li>
            <li class="breadcrumb-item active" aria-current="page">Project Data Sheet</li>
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
                                <label for="projectTitle" class="form-label">Project Title</label>
                                <input type="text" class="form-control ms-2" name="projectTitle" id="projectTitle"
                                    value="{{ $projectData->project_title ?? '' }}" placeholder="Enter Project Title">
                            </div>
                            <div class="col-12">
                                <label for="firmName" class="form-label">Firm Name</label>
                                <input type="text" class="form-control ms-2" name="firmName" id="firmName"
                                    value="{{ $projectData->firm_name ?? '' }}" placeholder="Enter Firm Name">
                            </div>
                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control ms-2" name="address" id="address"
                                    value="{{ ($projectData->landMark ?? '') . ', ' . ($projectData->barangay ?? '') . ', ' . ($projectData->city ?? '') . ', ' . ($projectData->province ?? '') . ', ' . ($projectData->region ?? '') . ', ' . ($projectData->zip_code ?? '') }}"
                                    placeholder="Enter Address">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="ContactPerson" class="form-label">Contact Person</label>
                                <input type="text" class="form-control ms-2" name="ContactPerson" id="ContactPerson"
                                    value="{{ ($projectData->f_name ?? '') . ' ' . ($projectData->mid_name ?? '') . ' ' . ($projectData->l_name ?? '') . ' ' . ($projectData->suffix ?? '') }}"
                                    placeholder="Enter Contact Person">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="Designation" class="form-label">Designation</label>
                                <input type="text" class="form-control ms-2" name="Designation" id="Designation"
                                    value="{{ $projectData->designation ?? '' }}" placeholder="Enter Designation">
                            </div>
                            <div class="col-12 my-2">
                                <span class="fw-semibold">Contact Details:</span>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="landline" class="form-label">Landline</label>
                                <input type="text" class="form-control ms-2" name="landline" id="landline"
                                    value="{{ $projectData->landline ?? '' }}" placeholder="Enter Landline">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="mobile" class="form-label">Mobile Phone</label>
                                <input type="text" class="form-control ms-2" name="mobile" id="mobile"
                                    value="{{ $projectData->mobile_number ?? '' }}" placeholder="Enter Mobile Number">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control ms-2" name="email" id="email"
                                    value="{{ $projectData->email ?? '' }}" placeholder="Enter Email">
                            </div>
                            <div class="col-12 my-2">
                                <span class="fw-semibold">Period Covered(Please tick)</span>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="FirstQuarter"
                                        name="FirstQuarter">
                                    <label class="form-check-label" for="FirstQuarter">
                                        1st Quarter
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="SecondQuarter" name="SecondQuarter">
                                    <label class="form-check-label" for="SecondQuarter">
                                        2nd Quarter
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="ThirdQuarter"
                                        name="ThirdQuarter">
                                    <label class="form-check-label" for="ThirdQuarter">
                                        3rd Quarter
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="FourthQuarter" name="FourthQuarter">
                                    <label class="form-check-label" for="FourthQuarter">
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
                            <input type="text" class="bottom_border w-25" readonly>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="buildingAsset" class="form-label">1.1 Building</label>
                                <input type="text" class="form-control" name="buildingAsset" id="buildingAsset"
                                    value="{{ $CurrentQuarterlyData['Building'] ?? '' }}">
                            </div>
                            <div class="col-md-4">
                                <label for="EquipmentAsset" class="form-label">1.2 Equipment</label>
                                <input type="text" class="form-control" name="EquipmentAsset" id="EquipmentAsset"
                                    value="{{ $CurrentQuarterlyData['Equipment'] ?? '' }}">
                            </div>
                            <div class="col-md-4">
                                <label for="workingCapitalAsset" class="form-label">1.3 Working Capital</label>
                                <input type="text" class="form-control" name="workingCapitalAsset"
                                    id="workingCapitalAsset"
                                    value="{{ $CurrentQuarterlyData['WorkingCapital'] ?? '' }}">
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="fw-semibold">Classification of Enterprise</span>
                        </div>
                        <div class="row g-3 mt-2">
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="Micro" id="Micro">
                                    <label class="form-check-label" for="Micro">
                                        Micro(assets less than 3M)
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="Small" id="Small">
                                    <label class="form-check-label" for="Small">
                                        Small(assets of 3M than 15M)
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="Large" id="m=Medium">
                                    <label class="form-check-label" for="m=Medium">
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
                                        <td colspan="6" class="fw-bold">2.1 Direct Labor Force (Production)</td>
                                    </tr>
                                    <tr class="DirectRegular">
                                        <td class="ps-4">2.1a Regular</td>
                                        <td><input type="text" class="form-control maleInput"
                                                name="DireRegularMale" id="DireRegularMale"
                                                value="{{ $CurrentQuarterlyData['male_Dir_Regular'] ?? '' }}"></td>
                                        <td><input type="text" class="form-control femaleInput"
                                                name="DireRegularFemale" id="DireRegularFemale"
                                                value="{{ $CurrentQuarterlyData['female_Dir_Regular'] ?? '' }}"></td>
                                        <td><input type="text" class="form-control workdayInput"
                                                name="DireRegularTotalWorkday" id="DireRegularTotalWorkday"
                                                value="{{ $CurrentQuarterlyData['workday_Dir_Regular'] ?? '' }}"></td>
                                        <td><input type="text" class="form-control totalManMonth"
                                                name="DireRegularTotalManMonth" id="DireRegularTotalManMonth"
                                                readonly></td>
                                        <td><input type="text" class="form-control" name="RemarkDirectLabor"
                                                id="RemarkDirectLabor"></td>
                                    </tr>
                                    <tr class="DirectParttime">
                                        <td class="ps-4">2.1b Part Time</td>
                                        <td><input type="text" class="form-control maleInput" name="ParttimeMale"
                                                id="ParttimeMale"
                                                value="{{ $CurrentQuarterlyData['male_Dir_PartT'] ?? '' }}"></td>
                                        <td><input type="text" class="form-control femaleInput"
                                                name="ParttimeFemale" id="ParttimeFemale"
                                                value="{{ $CurrentQuarterlyData['female_Dir_PartT'] ?? '' }}"></td>
                                        <td><input type="text" class="form-control workdayInput"
                                                name="ParttimeTotalWorkday" id="ParttimeTotalWorkday"
                                                value="{{ $CurrentQuarterlyData['workday_Dir_PartT'] ?? '' }}"></td>
                                        <td><input type="text" class="form-control totalManMonth"
                                                name="ParttimeTotalManMonth" id="ParttimeTotalManMonth" readonly></td>
                                        <td><input type="text" class="form-control" name="RemarkParttime"
                                                id="RemarkParttime"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="fw-bold">2.2 Indirect Labor Force (Admin and
                                            Marketing)</td>
                                    </tr>
                                    <tr class="IndirectRegular">
                                        <td class="ps-4">2.2a Regular</td>
                                        <td><input type="text" class="form-control maleInput"
                                                name="IndiRegularMale" id="IndiRegularMale"
                                                value="{{ $CurrentQuarterlyData['male_Indir_Regular'] ?? '' }}"></td>
                                        <td><input type="text" class="form-control femaleInput"
                                                name="IndiRegularFemale" id="IndiRegularFemale"
                                                value="{{ $CurrentQuarterlyData['female_Indir_Regular'] ?? '' }}">
                                        </td>
                                        <td><input type="text" class="form-control workdayInput"
                                                name="IndiRegularTotalWorkday" id="IndiRegularTotalWorkday"
                                                value="{{ $CurrentQuarterlyData['workday_Indir_Regular'] ?? '' }}">
                                        </td>
                                        <td><input type="text" class="form-control totalManMonth"
                                                name="IndiRegularTotalManMonth" id="IndiRegularTotalManMonth"
                                                readonly></td>
                                        <td><input type="text" class="form-control" name="IndiRegularRemark"
                                                id="IndiRegularRemark"></td>
                                    </tr>
                                    <tr class="IndiParttime">
                                        <td class="ps-4">2.2b Part-time</td>
                                        <td><input type="text" class="form-control maleInput"
                                                name="IndiParttimeMale" id="IndiParttimeMale"
                                                value="{{ $CurrentQuarterlyData['male_Indir_PartT'] ?? '' }}"></td>
                                        <td><input type="text" class="form-control femaleInput"
                                                name="IndiParttimeFemale" id="IndiParttimeFemale"
                                                value="{{ $CurrentQuarterlyData['female_Indir_PartT'] ?? '' }}"></td>
                                        <td><input type="text" class="form-control workdayInput"
                                                name="IndiParttimeTotalWorkday" id="IndiParttimeTotalWorkday"
                                                value="{{ $CurrentQuarterlyData['workday_Indir_PartT'] ?? '' }}"></td>
                                        <td><input type="text" class="form-control totalManMonth"
                                                name="IndiParttimeTotalManMonth" id="IndiParttimeTotalManMonth"
                                                readonly></td>
                                        <td><input type="text" class="form-control" name="IndiParttimeRemark"
                                                id="IndiParttimeRemark"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <span class="fw-bold">Total Employment for this Quarter:</span>
                            </div>
                            <div class="col-md-3">
                                <label for="TotalEmployment" class="form-label">No. of Personnel</label>
                                <input type="text" class="form-control" name="TotalEmployment"
                                    id="TotalEmployment" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="TotalManMonth" class="form-label">No. of Man Month</label>
                                <input type="text" class="form-control" name="TotalManMonth" id="TotalManMonth"
                                    readonly>
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
                            <table class="table table-bordered align-middle">
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
                                            <td><input type="text" class="form-control productName"
                                                    value="{{ $ExportProduct['ProductName'] ?? '' }}"></td>
                                            <td><input type="text" class="form-control packingDetails"
                                                    value="{{ $ExportProduct['PackingDetails'] ?? '' }}"></td>
                                            <td><input type="text" class="form-control volumeOfProduction_val"
                                                    value="{{ $ExportProduct['volumeOfProduction'] ?? '' }}"></td>
                                            <td><input type="text" class="form-control grossSales_val"
                                                    value="{{ $ExportProduct['grossSales'] ?? '' }}"></td>
                                            <td><input type="text" class="form-control productionCost_val"
                                                    value="{{ $ExportProduct['estimatedCostOfProduction'] ?? '' }}">
                                            </td>
                                            <td><input type="text" class="form-control netSales_val"
                                                    value="{{ $ExportProduct['netSales'] ?? '' }}"></td>
                                        </tr>
                                    @empty
                                        <!-- Empty Rows Placeholder -->
                                        @for ($i = 0; $i < 3; $i++)
                                            <tr>
                                                <td><input type="text" class="form-control productName"></td>
                                                <td><input type="text" class="form-control packingDetails"></td>
                                                <td><input type="text" class="form-control volumeOfProduction_val">
                                                </td>
                                                <td><input type="text" class="form-control grossSales_val"></td>
                                                <td><input type="text" class="form-control productionCost_val">
                                                </td>
                                                <td><input type="text" class="form-control netSales_val"></td>
                                            </tr>
                                        @endfor
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Local Market Table -->
                        <div class="table-responsive">
                            <h6 class="fw-bold text-primary mt-4">3.2 Local Market</h6>
                            <table class="table table-bordered align-middle">
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
                                            <td><input type="text" class="form-control productName"
                                                    value="{{ $LocalProduct['ProductName'] ?? '' }}"></td>
                                            <td><input type="text" class="form-control packingDetails"
                                                    value="{{ $LocalProduct['PackingDetails'] ?? '' }}"></td>
                                            <td><input type="text" class="form-control volumeOfProduction_val"
                                                    value="{{ $LocalProduct['volumeOfProduction'] ?? '' }}"></td>
                                            <td><input type="text" class="form-control grossSales_val"
                                                    value="{{ $LocalProduct['grossSales'] ?? '' }}"></td>
                                            <td><input type="text" class="form-control productionCost_val"
                                                    value="{{ $LocalProduct['estimatedCostOfProduction'] ?? '' }}">
                                            </td>
                                            <td><input type="text" class="form-control netSales_val"
                                                    value="{{ $LocalProduct['netSales'] ?? '' }}"></td>
                                        </tr>
                                    @empty
                                        <!-- Empty Rows Placeholder -->
                                        @for ($i = 0; $i < 3; $i++)
                                            <tr>
                                                <td><input type="text" class="form-control productName"></td>
                                                <td><input type="text" class="form-control packingDetails"></td>
                                                <td><input type="text" class="form-control volumeOfProduction_val">
                                                </td>
                                                <td><input type="text" class="form-control grossSales_val"></td>
                                                <td><input type="text" class="form-control productionCost_val">
                                                </td>
                                                <td><input type="text" class="form-control netSales_val"></td>
                                            </tr>
                                        @endfor
                                    @endforelse
                                    <tr>
                                        <td colspan="3" class="fw-bold text-end">Total</td>
                                        <td><input name="totalGrossSales" type="text"
                                                class="form-control totalGrossSales_val" id="totalGrossSales"
                                                readonly></td>
                                        <td><input name="totalProductionCost" type="text"
                                                class="form-control totalProductionCost_val" id="totalProductionCost"
                                                readonly></td>
                                        <td><input name="totalNetSales" type="text"
                                                class="form-control totalNetSales_val" id="totalNetSales" readonly>
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
                                <label for="Export" class="form-label">4.1 Export</label>
                                <textarea class="form-control" name="ExportOutlet" id="Export" rows="3">{{ $CurrentQuarterlyData['Market_Export'] ?? '' }}</textarea>
                            </div>
                            <div class="col-12">
                                <label for="Local" class="form-label">4.2 Local</label>
                                <textarea class="form-control" name="LocalOutlet" id="Local" rows="3">{{ $CurrentQuarterlyData['Market_local'] ?? '' }}</textarea>
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
                                                <th colspan="4" class="table-header">TO BE ACCOMPLISHED BY DOST XI</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ToBeAccomplished">
                                            <tr>
                                                <td class="highlight-text" rowspan="2">Gross Sales Generated =<br>Gross
                                                    Sales {{ $CurrentQuarterlyData['quarter'] ?? '' }} - Gross Sales
                                                    {{ $PreviousQuarterlyData['quarter'] ?? '' }}</td>
                                                <td class="table-subheader">Gross Sales
                                                    {{ $CurrentQuarterlyData['quarter'] ?? '' }}
                                                    <br> (for the reporting period)
                                                </td>
                                                <td class="table-subheader">Gross Sales
                                                    {{ $PreviousQuarterlyData['quarter'] ?? '' }} <br> (previous
                                                    quarter)</td>
                                                <td class="table-subheader">TOTAL GROSS SALES GENERATED</td>
                                            </tr>
                                            @php
                                                if ($PreviousQuarterlyData != null) {
                                                    $PreviousGrossSalesTotal = 0;
                                                    foreach ($PreviousQuarterlyData['ExportProduct'] as $ExportProduct) {
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
                                                        <input type="text" class="bottom_border CurrentgrossSales_val"
                                                            name="CurrentgrossSales" value="">
                                                    </div>
                                                </td>
                                                <td class="table-data">
                                                    ₱1,556,709.00
                                                    <div class="d-flex">
                                                        ₱
                                                        <input type="text" class="bottom_border PreviousgrossSales_val"
                                                            name="PreviousgrossSales"
                                                            value="{{ number_format($PreviousGrossSalesTotal ?? null, 2) ?? '' }}">
                                                    </div>
                                                </td>
                                                <td class="table-data">₱43,291.00
                                                    <div class="d-flex">
                                                        ₱
                                                        <input type="text" class="bottom_border TotalgrossSales_val"
                                                            name="TotalgrossSales" readonly>
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
                                                <td colspan="3" class="table-data nowrap" width="50%">1,600,000.00 -
                                                    1,556,709.00 x 100 / 1,556,709.00 = 2.78% <br>
                                                    <span class="CurrentgrossSales_val_cal"></span>
                                                    -
                                                    <span class="PreviousgrossSales_val_cal"></span>
                                                    x 100 / <span class="PreviousgrossSales_val_cal"></span> =
                                                    <span class="totalgrossSales_percent"></span>
                                                    <input type="text" name="totalgrossSales_percent"
                                                        class="bottom_border totalgrossSales_percent" style="width:10%;"
                                                        readonly>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="highlight-text" rowspan="2">Employees Generated =<br>Employement
                                                    {{ $CurrentQuarterlyData['quarter'] ?? '' }} - Employement
                                                    {{ $PreviousQuarterlyData['quarter'] ?? '' }}</td>
                                                <td class="table-subheader">Total Employment
                                                    {{ $CurrentQuarterlyData['quarter'] ?? '' }} <br> (for the reporting
                                                    period)
                                                </td>
                                                <td class="table-subheader">Total Employment
                                                    {{ $PreviousQuarterlyData['quarter'] ?? '' }} <br> (previous quarter)</td>
                                                <td class="table-subheader">TOTAL EMPLOYMENT GENERATED</td>
                                            </tr>
                                            <tr class="EmploymentGenerated">
                                                <td class="table-data">
                                                    10
                                                    <input type="text" name="CurrentEmployment"
                                                        class="bottom_border CurrentEmployment_val">
                                                </td>
                                                <td class="table-data">
                                                    10
                                                    <input type="text" name="PreviousEmployment"
                                                        class="bottom_border PreviousEmployment_val">
                                                </td>
                                                <td class="table-data">0
                                                    <input type="text" name="TotalEmploymentGenerated"
                                                        class="bottom_border TotalEmployment_val" readonly>
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
                                                <td colspan="3" class="table-data nowrap" width="50%">10 - 10 x 100 /
                                                    10 = 0% <br>
                                                    <span class="CurrentEmployment_val_cal"></span>
                                                    -
                                                    <span class="PreviousEmployment_val_cal"></span>
                                                    x 100 / <span class="PreviousEmployment_val_cal"></span> =
                                                    <input type="text" name="totalEmployment_percent"
                                                        class="bottom_border totalEmployment_percent" style="width:10%;"
                                                        readonly>
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
        <button type="button" data-to-export="PDS" class="btn btn-primary ExportPDF">Export as PDF</button>
    </div>
</div>
