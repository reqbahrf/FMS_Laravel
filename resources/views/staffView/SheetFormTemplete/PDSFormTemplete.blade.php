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
                                <input type="text" class="bottom_border ms-2" name="projectTitle" id="projectTitle" value="{{ $projectData->project_title }}">
                            </div>
                            <div class="col-12">
                                <label for="projectTitle">Firm Name</label>
                                <input type="text" class="bottom_border ms-2" name="firmName" id="firmName" value="{{ $projectData->firm_name }}">
                            </div>
                            <div class="col-12">
                                <label for="address">Address</label>
                                <input type="text" class="bottom_border ms-2" name="address" id="address" value="{{ $projectData->landMark . ', ' . $projectData->barangay . ', ' . $projectData->city . ', ' . $projectData->province . ', ' . $projectData->region . ', ' .$projectData->zip_code }}">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="ContactPerson" class="form-label">Contact Person</label>
                                <input type="text" class="bottom_border ms-2" name="ContactPerson" id="ContactPerson" value="{{ $projectData->f_name . ' ' . $projectData->mid_name . ' ' . $projectData->l_name . ' ' . $projectData->suffix }}">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="Designation" class="form-label">Designation</label>
                                <input type="text" class="bottom_border ms-2" name="Designation" id="Designation" value="{{ $projectData->designation }}">
                            </div>
                            <div class="col-12 my-2">
                                <Span class="fw-semibold">Contact Details:</Span>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="landline">landline</label>
                                <input type="text" class="bottom_border ms-2" name="landline" id="landline" value="{{ $projectData->landline }}">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="mobile">mobile Phone</label>
                                <input type="text" class="bottom_border ms-2" name="mobile" id="mobile" value="{{ $projectData->mobile_number }}">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="email">Email</label>
                                <input type="text" class="bottom_border ms-2" name="email" id="email" value="{{ $projectData->email }}">
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
                                <input type="text" class="bottom_border ms-2" name="buildingAsset" id="buildingAsset" value="{{ $quarterlyData['Building']; }}">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="EquipmentAsset">1.2 Equipment</label>
                                <input type="text" class="bottom_border ms-2" name="EquipmentAsset" id="EquipmentAsset" value="{{ $quarterlyData['Equipment']; }}">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="workingCapitalAsset">1.3 Working Capital</label>
                                <input type="text" class="bottom_border ms-2" name="workingCapitalAsset"
                                    id="workingCapitalAsset"
                                    value="{{ $quarterlyData['WorkingCapital']; }}">
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
                            <div class="col-12">
                                <span>2.1 Direct Labor Force (Production)</span>
                            </div>
                            <div class="col-12">
                                <span>2.1a regulate</span>
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="DireRegularMale">
                                    Male
                                </label>
                                <input type="text" class="bottom_border ms-2" name="DireRegularMale"
                                    id="DireRegularMale" value="{{ $quarterlyData['male_Dir_Regular']; }}">
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="DireRegularFemale">
                                    Female
                                </label>
                                <input type="text" class="bottom_border ms-2" name="DireRegularFemale"
                                    id="DireRegularFemale" value="{{ $quarterlyData['female_Dir_Regular']; }}">
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="DireRegularTotalWorkday">
                                    Total Workday
                                </label>
                                <input type="text" class="bottom_border ms-2" name="DireRegularTotalWorkday"
                                    id="DireRegularTotalWorkday" value="{{ $quarterlyData['workday_Dir_Regular']; }}">
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="DireRegularTotalManMonth">
                                    Total Man-Month
                                </label>
                                <input type="text" class="bottom_border ms-2" name="DireRegularTotalManMonth"
                                id="DireRegularTotalManMonth">
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="RemarkDirectLabor">
                                    Remark
                                </label>
                                <input type="text" class="bottom_border ms-2" name="RemarkDirectLabor"
                                    id="RemarkDirectLabor">
                            </div>
                            <div class="col-12">
                                <span>2.1b Part-time</span>
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="ParttimeMale">Male</label>
                                <input type="text" class="bottom_border ms-2" name="ParttimeMale" id="ParttimeMale" value="{{ $quarterlyData['male_Dir_PartT']; }}">
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="ParttimeFemale">Female</label>
                                <input type="text" class="bottom_border ms-2" name="ParttimeFemale"
                                    id="ParttimeFemale" value="{{ $quarterlyData['female_Dir_PartT']; }}">
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="ParttimeTotalWorkday">Total Workday</label>
                                <input type="text" class="bottom_border ms-2" name="ParttimeTotalWorkday"
                                    id="ParttimeTotalWorkday"
                                    value="{{ $quarterlyData['workday_Dir_PartT']; }}">
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="ParttimeTotalManMonth">Total Man-Month</label>
                                <input type="text" class="bottom_border ms-2" name="ParttimeTotalManMonth"
                                    id="ParttimeTotalManMonth">
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="RemarkParttime">Remark</label>
                                <input type="text" class="bottom_border ms-2" name="RemarkParttime"
                                    id="RemarkParttime">
                            </div>
                            <div class="col-12">
                                <span>2.2 Indirect Labor Force(Admin and Marketing)</span>
                            </div>
                            <div class="col-12">
                                <span>2.2a Regular</span>
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="IndiRegularMale">Male</label>
                                <input type="text" class="bottom_border ms-2" name="IndiRegularMale"
                                    id="IndiRegularMale" value="{{ $quarterlyData['male_Indir_Regular']; }}">
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="IndiRegularFemale">Female</label>
                                <input type="text" class="bottom_border ms-2" name="IndiRegularFemale"
                                    id="IndiRegularFemale"
                                    value="{{ $quarterlyData['female_Indir_Regular']; }}">
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="IndirectTotalWorkday">Total Workday</label>
                                <input type="text" class="bottom_border ms-2" name="IndiRegularTotalWorkday"
                                    id="IndiRegularTotalWorkday"
                                    value="{{ $quarterlyData['workday_Indir_Regular']; }}">
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="IndirectTotalManMonth">Total Man-Month</label>
                                <input type="text" class="bottom_border ms-2" name="IndiRegularTotalManMonth"
                                    id="IndiRegularTotalManMonth">
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="RemarkIndirect">Remark</label>
                                <input type="text" class="bottom_border ms-2" name="IndiRegularRemark"
                                    id="IndiRegularRemark">
                            </div>
                            <div class="col-12">
                                <span>2.2b Part-time</span>
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="IndirectParttimeMale">Male</label>
                                <input type="text" class="bottom_border ms-2" name="IndiParttimeMale"
                                    id="IndiParttimeMale"
                                    value="{{ $quarterlyData['male_Indir_PartT']; }}">
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="IndirectParttimeFemale">Female</label>
                                <input type="text" class="bottom_border ms-2" name="IndiParttimeFemale" id="IndiParttimeFemale"
                                    value="{{ $quarterlyData['female_Indir_PartT']; }}">
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="IndirectParttimeTotalWorkday">Total Workday</label>
                                <input type="text" class="bottom_border ms-2" name="IndiParttimeTotalWorkday"
                                    id="IndiParttimeTotalWorkday"
                                    value="{{ $quarterlyData['workday_Indir_PartT']; }}">
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="IndiParttimeTotalManMonth">Total Man-Month</label>
                                <input type="text" class="bottom_border ms-2" name="IndiParttimeTotalManMonth"
                                    id="IndiParttimeTotalManMonth">
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="IndiParttimeRemark">Remark</label>
                                <input type="text" class="bottom_border ms-2" name="IndiParttimeRemark"
                                    id="IndiParttimeRemark">
                            </div>
                            <div class="col-12">
                                <span>Total Employment for this Quarter:</span>
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
                            @if(count($quarterlyData['LocalProduct']) > 0)
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
                                    @foreach($quarterlyData['LocalProduct'] as $product)
                                    <tr>
                                        <td></td>
                                        <td>
                                            <input class="bottom_border" type="text" value="{{ $product['ProductName'] }}">
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border" value="{{ $product['PackingDetails'] }}">
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border" value="{{ $product['volumeOfProduction'] }}">
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border grossSales_val" value="{{ $product['grossSales'] }}">
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border productionCost_val" value="{{ $product['estimatedCostOfProduction'] }}">
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border netSales_val" value="{{ $product['netSales'] }}">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                        <div class="container mb-2">
                            @if(count($quarterlyData['ExportProduct']) > 0)
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="2">3.1 Export Market</th>
                                        <th>Name of Product</th>
                                        <th>Packaging Details</th>
                                        <th>Volume of Production</th>
                                        <th>Gross Sales</th>
                                        <th>Estimated Cost of Production</th>
                                        <th>Net Sales</th>
                                    </tr>
                                </thead>
                                <tbody id="exportProducts">
                                    @foreach ($quarterlyData['ExportProduct'] as $Exportproduct)
                                    <tr>
                                        <td></td>
                                        <td>
                                            <input type="text" class="bottom_border" value="{{ $Exportproduct['ProductName'] }}">
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border" value="{{ $Exportproduct['PackingDetails'] }}">
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border" value="{{ $Exportproduct['volumeOfProduction'] }}">
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border grossSales_val" value="{{ $Exportproduct['grossSales'] }}">
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border productionCost_val" value="{{ $Exportproduct['estimatedCostOfProduction'] }}">
                                        </td>
                                        <td>
                                            <input type="text" class="bottom_border netSales_val" value="
                                            {{ $Exportproduct['netSales'] }}">
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4">Total</td>
                                        <td id="totalGrossSales">₱</td>
                                        <td id="totalProductionCost">₱</td>
                                        <td id="totalNetSales">₱</td>
                                    </tr>
                                </tbody>

                            </table>
                            @endif
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
                                <input type="text" class="bottom_border ms-2" name="ExportOutlet" id="Export" value="{{ $quarterlyData['Market_Export']; }}">
                            </div>
                            <div class="col-12">
                                <label for="Local">4.2 Local</label>
                                <input type="text" class="bottom_border ms-2" name="LocalOutlet" id="Local" value="{{ $quarterlyData['Market_local']; }}">
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
                                    <tbody>
                                        <tr>
                                            <td class="highlight-text" rowspan="2">Gross Sales Generated =<br>Gross
                                                Sales Q2 - Gross Sales Q1</td>
                                            <td class="table-subheader">Gross Sales Q2 <br> (for the reporting period)</td>
                                            <td class="table-subheader">Gross Sales Q1 <br> (previous quarter)</td>
                                            <td class="table-subheader">TOTAL GROSS SALES GENERATED</td>
                                        </tr>
                                        <tr>
                                            <td class="table-data">₱1,600,000.00</td>
                                            <td class="table-data">₱1,556,709.00</td>
                                            <td class="table-data">₱43,291.00</td>
                                        </tr>
                                        <tr>
                                            <td class="highlight-text">% Increase in Productivity Generated =<br>
                                                <div style="text-align: center;">
                                                    Gross Sales Q2 - Gross Sales Q1 x 100<br>
                                                    Gross Sales Q1
                                                </div>
                                            </td>
                                            <td colspan="3" class="table-data">1,600,000.00 - 1,556,709.00 x 100 /
                                                1,556,709.00 = 2.78%</td>
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
