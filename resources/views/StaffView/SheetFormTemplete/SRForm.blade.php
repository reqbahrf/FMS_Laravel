
<div id="SRFormContainer" class="h-100 mt-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#" class="revertToSelectDoc">Select Document</a></li>
            <li class="breadcrumb-item active" aria-current="page">Status Report</li>
        </ol>
    </nav>
    <div class="row gy-3 p-0">
        <x-floating-window />
        <form id="StatusReportForm">
            <div class="col-12 mb-3">
                <div class="card p-0">
                    <div class="card-body">
                        <div class="row gy-2">
                            <div class="col-12">
                                <label for="projectTitle" class="form-label">Project Title:</label>
                                <input type="text" class="bottom_border" name="projectTitle" id="projectTitle">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="projectCooperator" class="form-label">Project Cooperator:</label>
                                <input type="text" class="bottom_border" name="projectCooperator"
                                    id="projectCooperator">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="projectDuration" class="form-label">Project Duration:</label>
                                <input type="text" class="bottom_border" name="projectDuration" id="projectDuration">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="setupAssistance" class="form-label">Amount of SETUP Assistance:</label>
                                <input type="text" class="bottom_border" name="setupAssistance" id="setupAssistance">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="fundsReleasedDate" class="form-label">Date Funds Released to the
                                    Cooperator:</label>
                                <input type="date" class="bottom_border" name="fundsReleasedDate"
                                    id="fundsReleasedDate">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="refundPeriod" class="form-label">Refund Period:</label>
                                <input type="text" class="bottom_border" name="refundPeriod" id="refundPeriod">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card p-0">
                    <div class="card-body">
                        <h6>Expected Output vs. Actual Accomplishment (include training and consultancy service/s to be
                            provided):</h6>
                        <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                            <button type="button" class="btn btn-success btn-sm me-2 addNewRowButton">
                                <i class="ri-add-fill"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm removeRowButton">
                                <i class="ri-subtract-fill"></i>
                            </button>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Expected Output</th>
                                    <th scope="col">Actual Accomplishment</th>
                                    <th scope="col">Remarks/Justification</th>
                                </tr>
                            </thead>
                            <tbody class="expectedAndActual_tableRow">
                                <tr>
                                    <td>
                                        <textarea type="text" class="bottom_border expectedOutput"></textarea>
                                    </td>
                                    <td>
                                        <textarea type="text" class="bottom_border actualAccomplishment"></textarea>
                                    </td>
                                    <td>
                                        <textarea type="text" class="bottom_border remarksJustification"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card p-0">
                    <div class="card-body">
                        <h6>List of equipment/facilities purchased/fabricated with corresponding cost/value:</h6>
                        <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                            <button type="button" class="btn btn-success btn-sm me-2 addNewRowButton">
                                <i class="ri-add-fill"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm removeRowButton">
                                <i class="ri-subtract-fill"></i>
                            </button>
                        </div>
                        <table class="table table-bordered">
                            <thead class="table-white">
                                <tr>
                                    <th colspan="3" class="text-center">Approved S&T Intervention Related Equipment
                                    </th>
                                    <th colspan="3" class="text-center">Actual S&T Intervention Related Equipment
                                        Acquired</th>
                                    <th rowspan="2" class="text-center align-middle">Indicate if with Acknowledgement
                                        Receipt of Equipment</th>
                                    <th rowspan="2" class="text-center align-middle">Remarks/ Justification</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Qty.</th>
                                    <th class="text-center">Particulars</th>
                                    <th class="text-center">(₱)&nbsp;Cost</th>
                                    <th class="text-center">Qty.</th>
                                    <th class="text-center">Particulars</th>
                                    <th class="text-center">(₱)&nbsp;Cost</th>
                                </tr>
                            </thead>
                            <tbody class="equipment_tableRow">
                                <tr>
                                    <td>
                                        <input type="number" class="bottom_border number_input_only approved_qty">
                                    </td>
                                    <td>
                                        <input type="text" class="bottom_border approved_particulars">
                                    </td>
                                    <td>
                                        <input type="text"
                                            class="bottom_border
                                        approved_cost">
                                    </td>
                                    <td>
                                        <input type="number" class="bottom_border number_input_only actual_qty">
                                    </td>
                                    <td>
                                        <input type="text" class="bottom_border actual_particulars">
                                    </td>
                                    <td>
                                        <input type="text" class="bottom_border actual_cost">
                                    </td>
                                    <td>
                                        <input type="text" class="bottom_border acknowledgement">
                                    </td>
                                    <td>
                                        <textarea type="text" class="bottom_border remarks"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card p-0">
                    <div class="card-body">
                        <h6>Non-equipment items provided (packaging, etc.):</h6>
                        <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                            <button type="button" class="btn btn-success btn-sm me-2 addNewRowButton">
                                <i class="ri-add-fill"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm removeRowButton">
                                <i class="ri-subtract-fill"></i>
                            </button>
                        </div>
                        <table class="table table-bordered">
                            <thead class="table-white">
                                <tr>
                                    <th colspan="3" class="text-center">Approved Items of Expenditure</th>
                                    <th colspan="3" class="text-center">Actual Expenditure</th>
                                    <th rowspan="2" class="text-center align-middle">Remarks/ Justification</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Qty.</th>
                                    <th class="text-center">Particulars</th>
                                    <th class="text-center">(₱)&nbsp;Cost</th>
                                    <th class="text-center">Qty.</th>
                                    <th class="text-center">Particulars</th>
                                    <th class="text-center">(₱)&nbsp;Cost</th>
                                </tr>
                            </thead>
                            <tbody class="non_equipment_tableRow">
                                <tr>
                                    <td>
                                        <input type="number" class="bottom_border number_input_only non_equipment_approved_qty">
                                    </td>
                                    <td>
                                        <input type="text"
                                            class="bottom_border non_equipment_approved_particulars">
                                    </td>
                                    <td>
                                        <input type="text" class="bottom_border non_equipment_approved_cost">
                                    </td>
                                    <td>
                                        <input type="number" class="bottom_border number_input_only non_equipment_actual_qty">
                                    </td>
                                    <td>
                                        <input type="text" class="bottom_border non_equipment_actual_particulars">
                                    </td>
                                    <td>
                                        <input type="text" class="bottom_border non_equipment_actual_cost">
                                    </td>
                                    <td>
                                        <textarea type="text" class="bottom_border non_equipment_remarks">
                                        </textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card p-0">
                    <div class="card-body">
                        <div class="row">
                            <h6>Status of Fund Utilization:</h6>
                            <div class="col-12">
                                2015
                            </div>
                            <div class="col-8">
                                Total Appproved Project Cost
                            </div>
                            <div class="col-4 d-flex justify-content-between">
                                <span>:&nbsp;₱</span>
                                <input type="text" class="bottom_border total_approved_project_cost" name="total_approved_project_cost">
                            </div>
                            <div class="col-8">
                                Amount Utilized per Financial Report (as of June 2024)
                            </div>
                            <div class="col-4 d-flex justify-content-between">
                                <span>:&nbsp;₱</span>
                                <input type="text" class="bottom_border amount_utilized" name="amount_utilized">
                            </div>
                            <div class="col-8">
                                Remarks on Status of Utilization
                            </div>
                            <div class="col-4 d-flex justify-content-between">
                                <span>:&nbsp;</span>
                                <input type="text" class="bottom_border" name="remarks_on_status_of_utilization">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card p-0">
                    <div class="card-body">
                        <div class="row">
                            <h6>Status of Refund</h6>
                            <div class="col-12">
                                2015
                            </div>
                            <div class="col-8">
                                Total amount to be refunded
                            </div>
                            <div class="col-4 d-flex justify-content-between">
                                <span>:&nbsp;₱</span>
                                <input type="text" class="bottom_border total_amount_to_be_refunded" name="total_amount_to_be_refunded">
                            </div>
                            <div class="col-8">
                                Approved Refund schedule
                            </div>
                            <div class="col-4 d-flex justify-content-between">
                                <span>:&nbsp;</span>
                                <input type="text" class="bottom_border" name="approved_refund_schedule">
                            </div>
                            <div class="col-8">
                                Total amount already due (as of June 2024)
                            </div>
                            <div class="col-4 d-flex justify-content-between">
                                <span>:&nbsp;₱</span>
                                <input type="text" class="bottom_border total_amount_already_due" name="total_amount_already_due">
                            </div>
                            <div class="col-8">
                                Total Amount refunded
                            </div>
                            <div class="col-4 d-flex justify-content-between">
                                <span>:&nbsp;₱</span>
                                <input type="text" class="bottom_border total_amount_refunded" name="total_amount_refunded">
                            </div>
                            <div class="col-8">
                                Unsetted refund
                            </div>
                            <div class="col-4 d-flex justify-content-between">
                                <span>:&nbsp;₱</span>
                                <input type="text" class="bottom_border unsetted_refund" name="unsetted_refund">
                            </div>
                            <div class="col-8">
                                Refund delayed since
                            </div>
                            <div class="col-4 d-flex justify-content-between">
                                <span>:&nbsp;</span>
                                <input type="text" class="bottom_border" name="refund_delayed_since">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card p-0">
                    <div class="card-body">
                        <h6>Volume and value of production including sales generated:</h6>
                        <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                            <button type="button" class="btn btn-success btn-sm me-2 addNewRowButton">
                                <i class="ri-add-fill"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm removeRowButton">
                                <i class="ri-subtract-fill"></i>
                            </button>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name of Product/Service</th>
                                    <th>Volume of Production</th>
                                    <th>Quarter (Specify)</th>
                                    <th>(₱)&nbsp;Gross Sales</th>
                                </tr>
                            </thead>
                            <tbody class="sales_tableRow">
                                <tr>
                                    <td>
                                        <input type="text" class="bottom_border sales_product_service">
                                    </td>
                                    <td>
                                        <input type="text" class="bottom_border sales_volume_production">
                                    </td>
                                    <td>
                                        <input type="text" class="bottom_border sales_quarter_specify">
                                    </td>
                                    <td>
                                       <input type="text" class="bottom_border sales_gross_sales">
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end">Total</td>
                                    <td><span class="fw-bold">₱1000</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card p-0">
                    <div class="card-body">
                        <h6>No. of new employment generated from the project:</h6>
                        <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                            <button type="button" class="btn btn-success btn-sm me-2 addNewRowButton">
                                <i class="ri-add-fill"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm removeRowButton">
                                <i class="ri-subtract-fill"></i>
                            </button>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No. of Employees</th>
                                    <th>No. of Male</th>
                                    <th>No. of Female</th>
                                    <th>No. of Person with Disability</th>
                                </tr>
                            </thead>
                            <tbody class="employment_generated_tableRow">
                                <tr>
                                    <td><input type="number" class="bottom_border number_input_only employment_total"></td>
                                    <td><input type="number" class="bottom_border number_input_only employment_male"></td>
                                    <td><input type="number" class="bottom_border number_input_only employment_female"></td>
                                    <td><input type="number" class="bottom_border number_input_only employment_pwd"></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card p-0">
                    <div class="card-body">
                        <h6>No. of new indirect employment from the project:</h6>
                        <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                            <button type="button" class="btn btn-success btn-sm me-2 addNewRowButton">
                                <i class="ri-add-fill"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm removeRowButton">
                                <i class="ri-subtract-fill"></i>
                            </button>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2" colspan="1" class="text-center align-middle"
                                        width="50%">No. of Indirect Employment</th>
                                    <th colspan="3" class="text-center" width="25%">Forward</th>
                                    <th colspan="3" class="text-center" width="25%">Backward</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Male</th>
                                    <th class="text-center">Female</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Male</th>
                                    <th class="text-center">Female</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody class="indirect_employment_tableRow">
                                <tr>
                                    <td>
                                        <input type="text" class="bottom_border indirect_employment_total">
                                        </td>
                                    <td>
                                        <input type="number" class="bottom_border number_input_only indirect_employment_forward_male">
                                        </td>
                                    <td>
                                        <input type="number" class="bottom_border number_input_only indirect_employment_forward_female">
                                    </td>
                                    <td>
                                        <input type="number" class="bottom_border number_input_only indirect_employment_forward_total">
                                        </td>
                                    <td>
                                        <input type="number" class="bottom_border number_input_only indirect_employment_backward_male">
                                    </td>
                                    <td>
                                        <input type="number" class="bottom_border number_input_only indirect_employment_backward_female">
                                        </td>
                                    <td>
                                        <input type="number" class="bottom_border number_input_only indirect_employment_backward_total">
                                        </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card p-0">
                    <div class="card-body">
                        <h6>List of market penetrated:</h6>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" width="40%">Existing Market</th>
                                    <th class="text-center" width="60%" colspan="2">New Market</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th class="text-center">Specific Place</th>
                                    <th class="text-center">Effective Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="vertical-align: top;">
                                        <textarea class="bottom_border" name="existing_market" style="width: 100%; height: 100px;"></textarea>
                                    </td>
                                    <td>
                                        <textarea class="bottom_border" name="new_market_specific_place" style="width: 100%; height: 100px;"></textarea>
                                    </td>
                                    <td>
                                        <textarea class="bottom_border" name="new_market_effective_date" style="width: 100%; height: 100px;"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card p-0">
                    <div class="card-body">
                        <h6>Improvement in production efficiency (includes quantitative indicators on improvement in
                            number
                            and quality of materials, number and value of produce, waste minimization, reject reduction,
                            etc.)
                        </h6>
                        <textarea name="improvement_in_production[]" class="bottom_border"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card p-0">
                    <div class="card-body">
                        <h6>Problems met & actions taken during project implementation</h6>
                        <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                            <button type="button" class="btn btn-success btn-sm me-2 addNewRowButton">
                                <i class="ri-add-fill"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm removeRowButton">
                                <i class="ri-subtract-fill"></i>
                            </button>
                        </div>
                        <div class="input_list">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>-&nbsp;</span>
                                <input type="text" class="bottom_border" name="problems_meet[]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card p-0">
                    <div class="card-body">
                        <h6>Action/ plan for the improvement of project’s operation</h6>
                        <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                            <button type="button" class="btn btn-success btn-sm me-2 addNewRowButton">
                                <i class="ri-add-fill"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm removeRowButton">
                                <i class="ri-subtract-fill"></i>
                            </button>
                        </div>
                        <div class="input_list">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>-&nbsp;</span>
                                <input type="text" class="bottom_border" name="action_and_plan[]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card p-0">
                    <div class="card-body">
                        <h6>Linkages/Promotional Plan</h6>
                        <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                            <button type="button" class="btn btn-success btn-sm me-2 addNewRowButton">
                                <i class="ri-add-fill"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm removeRowButton">
                                <i class="ri-subtract-fill"></i>
                            </button>
                        </div>
                        <div class="input_list">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>-&nbsp;</span>
                                <input type="text" class="bottom_border" name="linkages_promotional_plan[]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="d-flex justify-content-end p-3">
            <button type="button" data-to-export="SR" class="btn btn-primary ExportPDF">Export as PDF</button>
        </div>
    </div>
</div>
