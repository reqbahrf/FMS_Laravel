<div id="PDSFormContainer" class="h-100 mt-2">
  <!-- FIXME: Breadcrumb not working look for the js event listener -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#" class="revertToSelectDoc">Select Document</a></li>
            <li class="breadcrumb-item active" aria-current="page">Project Data Sheet</li>
        </ol>
    </nav>
    <div class="row gy-3 p-0">
        <div class="col-12">
            <div class="card p-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="projectTitle" class="form-label">Project Title</label>
                            <input type="text" class="bottom_border ms-2" name="projectTitle" id="projectTitle">
                        </div>
                        <div class="col-12">
                            <label for="projectTitle">Firm Name</label>
                            <input type="text" class="bottom_border ms-2" name="firmName" id="firmName">
                        </div>
                        <div class="col-12">
                            <label for="address">Address</label>
                            <input type="text" class="bottom_border ms-2" name="address" id="address">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="ContantPerson" class="form-label">Contact Person</label>
                            <input type="text" class="bottom_border ms-2" name="ContantPerson" id="ContantPerson">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="Designation">Designation</label>
                            <input type="text" class="bottom_border ms-2" name="Designation" id="Designation">
                        </div>
                        <div class="col-12 col-md-3">
                            <Span>Contact Details:</Span>
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="landline">landline</label>
                            <input type="text" class="bottom_border ms-2" name="landline" id="landline">
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="mobile">mobile Phone</label>
                            <input type="text" class="bottom_border ms-2" name="mobile" id="mobile">
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="email">Email</label>
                            <input type="text" class="bottom_border ms-2" name="email" id="email">
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
                        <div class="col-12 col-4">
                            <label for="buildingAsset">1.1 Building</label>
                            <input type="text" class="bottom_border ms-2" name="buildingAsset" id="buildingAsset">
                        </div>
                        <div class="col-12 col-4">
                            <label for="EquipmentAsset">1.2 Equipment</label>
                            <input type="text" class="bottom_border ms-2" name="EquipmentAsset" id="EquipmentAsset">
                        </div>
                        <div class="col-12 col-4">
                            <label for="workingCapitalAsset">1.3 Working Capital</label>
                            <input type="text" class="bottom_border ms-2" name="workingCapitalAsset"
                                id="workingCapitalAsset">
                        </div>
                        <div class="col-12 col-md-3">
                            <span>Classification of Enterprise</span>
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
                            <label for="m=Medium">m=Medium(assets of 15M than 100M)</label>
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
                        <div class="col-12 col-md-2">
                            <span>2.1a regulate</span>
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="DireRegularMale">
                                Male
                            </label>
                            <input type="text" class="bottom_border ms-2" name="DireRegularMale"
                                id="DireRegularMale">
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="DireRegularFemale">
                                Female
                            </label>
                            <input type="text" class="bottom_border ms-2" name="DireRegularFemale"
                                id="DireRegularFemale">
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="DireRegularTotalWorkday">
                                Total Workday
                            </label>
                            <input type="text" class="bottom_border ms-2" name="DireRegularTotalWorkday"
                                id="DireRegularTotalWorkday">
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="RemarkDirectLabor">
                                Remark
                            </label>
                            <input type="text" class="bottom_border ms-2" name="RemarkDirectLabor"
                                id="RemarkDirectLabor">
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="DireRegularTotalManMonth">
                                Total Man-Month
                            </label>
                            <input type="text" class="bottom_border ms-2" name="DireRegularTotalManMonth"
                                id="DireRegularTotalManMonth">
                        </div>
                        <div class="col-12">
                            <span>2.1b Part-time</span>
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="ParttimeMale">Male</label>
                            <input type="text" class="bottom_border ms-2" name="ParttimeMale" id="ParttimeMale">
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="ParttimeFemale">Female</label>
                            <input type="text" class="bottom_border ms-2" name="ParttimeFemale"
                                id="ParttimeFemale">
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="ParttimeTotalWorkday">Total Workday</label>
                            <input type="text" class="bottom_border ms-2" name="ParttimeTotalWorkday"
                                id="ParttimeTotalWorkday">
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
                            <label for="IndirectMale">Male</label>
                            <input type="text" class="bottom_border ms-2" name="IndiRegularMale"
                                id="IndiRegularMale">
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="IndirectFemale">Female</label>
                            <input type="text" class="bottom_border ms-2" name="IndiRegularFemale"
                                id="IndiRegularFemale">
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="IndirectTotalWorkday">Total Workday</label>
                            <input type="text" class="bottom_border ms-2" name="IndiRegularTotalWorkday"
                                id="IndiRegularTotalWorkday">
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
                                id="IndiParttimeMale">
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="IndirectParttimeFemale">Female</label>
                            <input type="text" class="bottom_border ms-2" name="IndiParttimeFemale"
                                id="IndiParttimeFemale">
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
                        <h6>3.0 Prodection and Sales Data for the Quarter</h6>
                    </div>
                    <div class="container mt-2">
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
                            <tbody>
                                <tr>
                                    <td>None</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="container mb-2">
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
                            <tbody>
                                <tr>
                                    <td>None</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="3">Total</td>
                                    <td>₱</td>
                                    <td>₱</td>
                                    <td>₱</td>
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
                            <input type="text" class="bottom_border ms-2" name="ExportOutlet" id="Export">
                        </div>
                        <div class="col-12">
                            <label for="Local">4.2 Local</label>
                            <input type="text" class="bottom_border ms-2" name="LocalOutlet" id="Local">
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
                                            Sales Q2 – Gross Sales Q1</td>
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
                                                Gross Sales Q2 – Gross Sales Q1 x 100<br>
                                                Gross Sales Q1
                                            </div>
                                        </td>
                                        <td colspan="3" class="table-data">1,600,000.00 – 1,556,709.00 x 100 /
                                            1,556,709.00 = 2.78%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
