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
                <div class="card p-0">
                    <div class="card-body">
                        <div class="row gy-2">
                            <div class="col-12">
                                <label for="projectTitle" class="form-label">Project Title</label>
                                <input type="text" class="bottom_border ms-2" name="projectTitle" id="projectTitle"
                                    value="{{ $projectData->project_title }}">
                            </div>
                            <div class="col-12">
                                <label for="projectTitle">Firm Name</label>
                                <input type="text" class="bottom_border ms-2" name="firmName" id="firmName"
                                    value="{{ $projectData->firm_name }}">
                            </div>
                            <div class="col-12">
                                <label for="address">Address</label>
                                <input type="text" class="bottom_border ms-2" name="address" id="address"
                                    value="{{ $projectData->landMark . ', ' . $projectData->barangay . ', ' . $projectData->city . ', ' . $projectData->province . ', ' . $projectData->region . ', ' . $projectData->zip_code }}">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="ContactPerson" class="form-label">Contact Person</label>
                                <input type="text" class="bottom_border ms-2" name="ContactPerson" id="ContactPerson"
                                    value="{{ $projectData->f_name . ' ' . $projectData->mid_name . ' ' . $projectData->l_name . ' ' . $projectData->suffix }}">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="Designation" class="form-label">Designation</label>
                                <input type="text" class="bottom_border ms-2" name="Designation" id="Designation"
                                    value="{{ $projectData->designation }}">
                            </div>
                            <div class="col-12 my-2">
                                <Span class="fw-semibold">Contact Details:</Span>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="landline">landline</label>
                                <input type="text" class="bottom_border ms-2" name="landline" id="landline"
                                    value="{{ $projectData->landline }}">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="mobile">mobile Phone</label>
                                <input type="text" class="bottom_border ms-2" name="mobile" id="mobile"
                                    value="{{ $projectData->mobile_number }}">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="email">Email</label>
                                <input type="text" class="bottom_border ms-2" name="email" id="email"
                                    value="{{ $projectData->email }}">
                            </div>
                            <div class="col-12 my-2">
                                <span class="fw-semibold">Period Covered(Please tick)</span>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="FirstQuarter">1st Quarter</label>
                                <input type="checkbox" class=" ms-2" name="FirstQuarter" id="FirstQuarter">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="SecondQuarter">2nd Quarter</label>
                                <input type="checkbox" class=" ms-2" name="SecondQuarter" id="SecondQuarter">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="ThirdQuarter">3rd Quarter</label>
                                <input type="checkbox" class=" ms-2" name="ThirdQuarter" id="ThirdQuarter">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="FourthQuarter">4th Quarter</label>
                                <input type="checkbox" class=" ms-2" name="FourthQuarter" id="FourthQuarter">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card p-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h6>1.0 Assets</h6>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="buildingAsset">1.1 Building</label>
                                <input type="text" class="bottom_border ms-2" name="buildingAsset"
                                    id="buildingAsset" value="{{ $quarterlyData['Building'] }}">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="EquipmentAsset">1.2 Equipment</label>
                                <input type="text" class="bottom_border ms-2" name="EquipmentAsset"
                                    id="EquipmentAsset" value="{{ $quarterlyData['Equipment'] }}">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="workingCapitalAsset">1.3 Working Capital</label>
                                <input type="text" class="bottom_border ms-2" name="workingCapitalAsset"
                                    id="workingCapitalAsset" value="{{ $quarterlyData['WorkingCapital'] }}">
                            </div>
                            <div class="col-12 my-2">
                                <span class="fw-semibold">Classification of Enterprise</span>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="Micro">Micro(assets less than 3M)</label>
                                <input type="checkbox" class="form-check-input ms-2" name="Micro" id="Micro">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="Small">Small(assets of 3M than 15M)</label>
                                <input type="checkbox" class="form-check-input ms-2" name="Small" id="Small">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="m=Medium">Medium(assets of 15M than 100M)</label>
                                <input type="checkbox" class="form-check-input ms-2" name="Large" id="m=Medium">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card p-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h6>2.0 Total Employment For the Quarter</h6>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th scope="col" width="20%"></th>
                                        <th scope="col" width="10%">Male</th>
                                        <th scope="col" width="10%">Female</th>
                                        <th scope="col" width="10%">Total Workday</th>
                                        <th scope="col" width="10%">Total Man-Month</th>
                                        <th scope="col" width="20%">Remark</th>
                                    </tr>
                                </thead>
                                <tbody id="totalEmployment">
                                    <tr>
                                        <td>
                                            <span>2.1 Direct Labor Force (Production)</span>
                                        </td>
                                    </tr>
                                    <tr class="DirectRegular">
                                        <td>
                                            <span class="ps-3">2.1a regulate</span>
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border ms-2 maleInput"
                                                name="DireRegularMale" id="DireRegularMale"
                                                value="{{ $quarterlyData['male_Dir_Regular'] }}">
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border ms-2 femaleInput"
                                                name="DireRegularFemale" id="DireRegularFemale"
                                                value="{{ $quarterlyData['female_Dir_Regular'] }}">
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border ms-2 workdayInput"
                                                name="DireRegularTotalWorkday" id="DireRegularTotalWorkday"
                                                value="{{ $quarterlyData['workday_Dir_Regular'] }}">
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border ms-2 totalManMonth"
                                                name="DireRegularTotalManMonth" id="DireRegularTotalManMonth"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border ms-2" name="RemarkDirectLabor"
                                                id="RemarkDirectLabor">
                                        </td>
                                    </tr>
                                    <tr class="DirectParttime">
                                        <td>
                                            <span class="ps-3">2.1b Part Time</span>
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border ms-2 maleInput"
                                                name="ParttimeMale" id="ParttimeMale"
                                                value="{{ $quarterlyData['male_Dir_PartT'] }}">
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border ms-2 femaleInput"
                                                name="ParttimeFemale" id="ParttimeFemale"
                                                value="{{ $quarterlyData['female_Dir_PartT'] }}">
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border ms-2 workdayInput"
                                                name="ParttimeTotalWorkday" id="ParttimeTotalWorkday"
                                                value="{{ $quarterlyData['workday_Dir_PartT'] }}">
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border ms-2 totalManMonth"
                                                name="ParttimeTotalManMonth" id="ParttimeTotalManMonth" readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border ms-2" name="RemarkParttime"
                                                id="RemarkParttime">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"> <span>2.2 Indirect Labor Force(Admin and Marketing)</span>
                                        </td>
                                    </tr>
                                    <tr class="IndirectRegular">
                                        <td><span class="ps-3">2.2a Regular</span></td>
                                        <td>

                                            <input type="text" class="bottom_border ms-2 maleInput"
                                                name="IndiRegularMale" id="IndiRegularMale"
                                                value="{{ $quarterlyData['male_Indir_Regular'] }}">
                                        </td>
                                        <td>

                                            <input type="text" class="bottom_border ms-2 femaleInput"
                                                name="IndiRegularFemale" id="IndiRegularFemale"
                                                value="{{ $quarterlyData['female_Indir_Regular'] }}">
                                        </td>
                                        <td>

                                            <input type="text" class="bottom_border ms-2 workdayInput"
                                                name="IndiRegularTotalWorkday" id="IndiRegularTotalWorkday"
                                                value="{{ $quarterlyData['workday_Indir_Regular'] }}">
                                        </td>
                                        <td>

                                            <input type="text" class="bottom_border ms-2 totalManMonth"
                                                name="IndiRegularTotalManMonth" id="IndiRegularTotalManMonth"
                                                readonly>
                                        </td>
                                        <td>

                                            <input type="text" class="bottom_border ms-2" name="IndiRegularRemark"
                                                id="IndiRegularRemark">
                                        </td>
                                    </tr>
                                    <tr class="IndiParttime">
                                        <td><span class="ps-3">2.2b Part-time</span></td>
                                        <td>
                                            <input type="text" class="bottom_border maleInput ms-2"
                                                name="IndiParttimeMale" id="IndiParttimeMale"
                                                value="{{ $quarterlyData['male_Indir_PartT'] }}">
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border femaleInput ms-2"
                                                name="IndiParttimeFemale" id="IndiParttimeFemale"
                                                value="{{ $quarterlyData['female_Indir_PartT'] }}">
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border workdayInput ms-2"
                                                name="IndiParttimeTotalWorkday" id="IndiParttimeTotalWorkday"
                                                value="{{ $quarterlyData['workday_Indir_PartT'] }}">
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border ms-2 totalManMonth"
                                                name="IndiParttimeTotalManMonth" id="IndiParttimeTotalManMonth"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border ms-2"
                                                name="IndiParttimeRemark" id="IndiParttimeRemark">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-12 col-md-6">
                                <span>Total Employment for this Quarter:</span>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="TotalEmployment">No. of Personnel</label>
                                <input type="text" class="bottom_border ms-2" name="TotalEmployment"
                                    id="TotalEmployment">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="TotalManMonth">No. of Man Month</label>
                                <input type="text" class="bottom_border ms-2" name="TotalManMonth"
                                    id="TotalManMonth">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card p-0">
                    <div class="card-body">
                        <div class="w-100">
                            <h6>3.0 Production and Sales Data for the Quarter</h6>
                        </div>
                        <div class="container mt-2">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="4">3.1 Export Market</th>
                                            <th>Name of Product</th>
                                            <th>Packaging Details</th>
                                            <th>Volume of Production</th>
                                            <th>Gross Sales</th>
                                            <th>Estimated Cost of Production</th>
                                            <th>Net Sales</th>
                                        </tr>
                                    </thead>
                                    <tbody id="localProducts">
                                        @forelse ($quarterlyData['LocalProduct'] as $LocalProduct)
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <input class="bottom_border productName" type="text"
                                                        value="{{ $LocalProduct['ProductName'] ?? '' }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="bottom_border packingDetails"
                                                        value="{{ $LocalProduct['PackingDetails'] ?? '' }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="bottom_border volumeOfProduction_val"
                                                        value="{{ $LocalProduct['volumeOfProduction'] ?? '' }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="bottom_border grossSales_val"
                                                        value="{{ $LocalProduct['grossSales'] ?? '' }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="bottom_border productionCost_val"
                                                        value="{{ $LocalProduct['estimatedCostOfProduction'] ?? '' }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="bottom_border netSales_val"
                                                        value="{{ $LocalProduct['netSales'] ?? '' }}">
                                                </td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td></td>
                                            <td>
                                                <input class="bottom_border productName" type="text">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border packingDetails">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border volumeOfProduction_val">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border grossSales_val">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border productionCost_val">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border netSales_val">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <input class="bottom_border productName" type="text">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border packingDetails">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border volumeOfProduction_val">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border grossSales_val">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border productionCost_val">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border netSales_val">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <input class="bottom_border productName" type="text">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border packingDetails">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border volumeOfProduction_val">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border grossSales_val">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border productionCost_val">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border netSales_val">
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                        </div>
                        <div class="container mb-2">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">3.2 Local Market</th>
                                            <th>Name of Product</th>
                                            <th>Packaging Details</th>
                                            <th>Volume of Production</th>
                                            <th>Gross Sales</th>
                                            <th>Estimated Cost of Production</th>
                                            <th>Net Sales</th>
                                        </tr>
                                    </thead>
                                    <tbody id="exportProducts">
                                        @forelse ($quarterlyData['ExportProduct'] as $ExportProduct)
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <input type="text" class="bottom_border productName"
                                                        value="{{ $ExportProduct['ProductName'] ?? '' }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="bottom_border packingDetails"
                                                        value="{{ $ExportProduct['PackingDetails'] ?? '' }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="bottom_border volumeOfProduction_val"
                                                        value="{{ $ExportProduct['volumeOfProduction'] ?? '' }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="bottom_border grossSales_val"
                                                        value="{{ $ExportProduct['grossSales'] ?? '' }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="bottom_border productionCost_val"
                                                        value="{{ $ExportProduct['estimatedCostOfProduction'] ?? '' }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="bottom_border netSales_val"
                                                        value="{{ $ExportProduct['netSales'] ?? '' }}">
                                                </td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td></td>
                                            <td>
                                                <input type="text" class="bottom_border productName">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border packingDetails">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border volumeOfProduction_val">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border grossSales_val">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border productionCost_val">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border netSales_val">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <input type="text" class="bottom_border productName">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border packingDetails">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border volumeOfProduction_val">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border grossSales_val">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border productionCost_val">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border netSales_val">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <input type="text" class="bottom_border productName">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border packingDetails">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border volumeOfProduction_val">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border grossSales_val">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border productionCost_val">
                                            </td>
                                            <td>
                                                <input type="text" class="bottom_border netSales_val">
                                            </td>
                                        </tr>
                                        @endforelse
                                        <tr id="totalRow">
                                            <td colspan="4">Total</td>
                                            <td>
                                                <input name="totalGrossSales" type="text"
                                                    class="bottom_border totalGrossSales_val" id="totalGrossSales">
                                            </td>
                                            <td>
                                                <input name="totalProductionCost" type="text"
                                                    class="bottom_border totalProductionCost_val"
                                                    id="totalProductionCost">
                                            </td>
                                            <td>
                                                <input name="totalNetSales" type="text"
                                                    class="bottom_border totalNetSales_val" id="totalNetSales">
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card p-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h6>4.0 Market Outlets</h6>
                            </div>
                            <div class="col-12">
                                <label for="Export">4.1 Export</label>
                                <input type="text" class="bottom_border ms-2" name="ExportOutlet" id="Export"
                                    value="{{ $quarterlyData['Market_Export'] }}">
                            </div>
                            <div class="col-12">
                                <label for="Local">4.2 Local</label>
                                <input type="text" class="bottom_border ms-2" name="LocalOutlet" id="Local"
                                    value="{{ $quarterlyData['Market_local'] }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card p-0">
                    <div class="card-body">
                        <div class="container my-4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="4" class="table-header">TO BE ACCOMPLISHED BY DOST XI</th>
                                    </tr>
                                </thead>
                                <tbody id="ToBeAccomplished">
                                    <tr>
                                        <td class="highlight-text" rowspan="2">Gross Sales Generated =<br>Gross
                                            Sales Q2 - Gross Sales Q1</td>
                                        <td class="table-subheader">Gross Sales Q2 <br> (for the reporting period)</td>
                                        <td class="table-subheader">Gross Sales Q1 <br> (previous quarter)</td>
                                        <td class="table-subheader">TOTAL GROSS SALES GENERATED</td>
                                    </tr>
                                    <tr class="grossSalesGenerated">
                                        <td class="table-data">
                                            ₱1,600,000.00
                                            <input type="text" class="bottom_border CurrentgrossSales_val"
                                                name="CurrentgrossSales">
                                        </td>
                                        <td class="table-data">
                                            ₱1,556,709.00
                                            <input type="text" class="bottom_border PreviousgrossSales_val"
                                                name="PreviousgrossSales">
                                        </td>
                                        <td class="table-data">₱43,291.00
                                            <input type="text" class="bottom_border TotalgrossSales_val"
                                                name="TotalgrossSales">
                                        </td>
                                    </tr>
                                    <tr class="increaseInProductivity">
                                        <td class="highlight-text">% Increase in Productivity Generated =<br>
                                            <div style="text-align: center;">
                                                Gross Sales Q2 - Gross Sales Q1 x 100<br>
                                                Gross Sales Q1
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
                                                class="bottom_border totalgrossSales_percent" style="width:10%;">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="highlight-text" rowspan="2">Employees Generated =<br>Employement
                                            Q2 - Employement Q1</td>
                                        <td class="table-subheader">Total Employment Q2 <br> (for the reporting period)
                                        </td>
                                        <td class="table-subheader">Total Employment Q1 <br> (previous quarter)</td>
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
                                                class="bottom_border TotalEmployment_val">
                                        </td>
                                    </tr>
                                    <tr class="increaseInEmployment">
                                        <td class="highlight-text">% Increase in Employment Generated =<br>
                                            <div style="text-align: center;">
                                                Employment Q2 - Employment Q1 x 100<br>
                                                Employment Q1
                                            </div>
                                        </td>
                                        <td colspan="3" class="table-data nowrap" width="50%">10 - 10 x 100 /
                                            10 = 0% <br>
                                            <span class="CurrentEmployment_val_cal"></span>
                                            -
                                            <span class="PreviousEmployment_val_cal"></span>
                                            x 100 / <span class="PreviousEmployment_val_cal"></span> =
                                            <input type="text" name="totalEmployment_percent"
                                                class="bottom_border totalEmployment_percent" style="width:10%;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
