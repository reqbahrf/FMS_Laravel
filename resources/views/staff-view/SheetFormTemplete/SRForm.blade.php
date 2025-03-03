<div
    class="h-100 mt-2"
    id="SRFormContainer"
>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a
                    class="revertToSelectDoc"
                    href="#"
                >Select Document</a></li>
            <li
                class="breadcrumb-item active"
                aria-current="page"
            >Status Report</li>
        </ol>
    </nav>
    <div class="row gy-3 p-0">
        <x-floating-window />
        <form id="StatusReportForm">
            <div class="col-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">Project Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-3 gy-2">
                            <div class="col-12">
                                <label
                                    class="form-label"
                                    for="projectTitle"
                                >Project Title:</label>
                                <input
                                    class="form-control"
                                    id="projectTitle"
                                    name="projectTitle"
                                    type="text"
                                    placeholder="Enter Project Title"
                                >
                            </div>
                            <div class="col-12 col-md-4">
                                <label
                                    class="form-label"
                                    for="projectCooperator"
                                >Project Cooperator:</label>
                                <input
                                    class="form-control"
                                    id="projectCooperator"
                                    name="projectCooperator"
                                    type="text"
                                    placeholder="Enter Project Cooperator"
                                >
                            </div>
                            <div class="col-12 col-md-4">
                                <label
                                    class="form-label"
                                    for="projectDuration"
                                >Project Duration:</label>
                                <input
                                    class="form-control"
                                    id="projectDuration"
                                    name="projectDuration"
                                    type="text"
                                    placeholder="Enter Project Duration"
                                >
                            </div>
                            <div class="col-12 col-md-4">
                                <label
                                    class="form-label"
                                    for="setupAssistance"
                                >Amount of SETUP Assistance:</label>
                                <input
                                    class="form-control"
                                    id="setupAssistance"
                                    name="setupAssistance"
                                    type="text"
                                    placeholder="Enter Amount of SETUP Assistance"
                                >
                            </div>
                            <div class="col-12 col-md-4">
                                <label
                                    class="form-label"
                                    for="fundsReleasedDate"
                                >Date Funds Released to the Cooperator:</label>
                                <input
                                    class="form-control"
                                    id="fundsReleasedDate"
                                    name="fundsReleasedDate"
                                    type="date"
                                >
                            </div>
                            <div class="col-12 col-md-6">
                                <label
                                    class="form-label"
                                    for="refundPeriod"
                                >Refund Period:</label>
                                <input
                                    class="form-control"
                                    id="refundPeriod"
                                    name="refundPeriod"
                                    type="text"
                                    placeholder="Enter Refund Period"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">Expected Output vs. Actual Accomplishment</h6>
                        <small class="text-light">Include training and consultancy services to be provided</small>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-end align-items-center mb-3 addAndRemoveButton_Container">
                            <button
                                class="btn btn-success btn-sm me-2 addNewRowButton"
                                type="button"
                                title="Add new row"
                            >
                                <i class="ri-add-fill"></i>
                            </button>
                            <button
                                class="btn btn-danger btn-sm removeRowButton"
                                type="button"
                                title="Remove last row"
                            >
                                <i class="ri-subtract-fill"></i>
                            </button>
                        </div>
                        <table
                            class="table table-bordered table-striped"
                            id="expectedAndActualTable"
                        >
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Expected Output</th>
                                    <th scope="col">Actual Accomplishment</th>
                                    <th scope="col">Remarks/Justification</th>
                                </tr>
                            </thead>
                            <tbody class="expectedAndActual_tableRow">
                                <tr>
                                    <td>
                                        <textarea
                                            class="form-control expectedOutput"
                                            type="text"
                                            placeholder="Enter expected output"
                                        ></textarea>
                                    </td>
                                    <td>
                                        <textarea
                                            class="form-control actualAccomplishment"
                                            type="text"
                                            placeholder="Enter actual accomplishment"
                                        ></textarea>
                                    </td>
                                    <td>
                                        <textarea
                                            class="form-control remarksJustification"
                                            type="text"
                                            placeholder="Enter remarks/justification"
                                        ></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">List of Equipment</h6>
                        <small class="text-light">Facilities purchased/fabricated with corresponding cost/value:</small>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                            <button
                                class="btn btn-success btn-sm me-2 addNewRowButton"
                                type="button"
                            >
                                <i class="ri-add-fill"></i>
                            </button>
                            <button
                                class="btn btn-danger btn-sm removeRowButton"
                                type="button"
                            >
                                <i class="ri-subtract-fill"></i>
                            </button>
                        </div>
                        <table
                            class="table table-bordered table-striped"
                            id="equipmentTable"
                        >
                            <thead class="table-light">
                                <tr>
                                    <th
                                        class="text-center"
                                        colspan="3"
                                    >Approved S&T Intervention Related Equipment
                                    </th>
                                    <th
                                        class="text-center"
                                        colspan="3"
                                    >Actual S&T Intervention Related Equipment
                                        Acquired</th>
                                    <th
                                        class="text-center align-middle"
                                        rowspan="2"
                                    >Indicate if with Acknowledgement
                                        Receipt of Equipment</th>
                                    <th
                                        class="text-center align-middle"
                                        rowspan="2"
                                    >Remarks/ Justification</th>
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
                                        <input
                                            class="form-control approved_qty"
                                            type="number"
                                        >
                                    </td>
                                    <td>
                                        <input
                                            class="form-control approved_particulars"
                                            type="text"
                                        >
                                    </td>
                                    <td>
                                        <input
                                            class="form-control approved_cost"
                                            type="text"
                                        >
                                    </td>
                                    <td>
                                        <input
                                            class="form-control actual_qty"
                                            type="number"
                                        >
                                    </td>
                                    <td>
                                        <input
                                            class="form-control actual_particulars"
                                            type="text"
                                        >
                                    </td>
                                    <td>
                                        <input
                                            class="form-control actual_cost"
                                            type="text"
                                        >
                                    </td>
                                    <td>
                                        <input
                                            class="form-control acknowledgement"
                                            type="text"
                                        >
                                    </td>
                                    <td>
                                        <textarea
                                            class="form-control remarks"
                                            type="text"
                                        ></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">Non-equipment items provided</h6>
                        <small class="text-light"> (packaging, etc.):</small>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                            <button
                                class="btn btn-success btn-sm me-2 addNewRowButton"
                                type="button"
                            >
                                <i class="ri-add-fill"></i>
                            </button>
                            <button
                                class="btn btn-danger btn-sm removeRowButton"
                                type="button"
                            >
                                <i class="ri-subtract-fill"></i>
                            </button>
                        </div>
                        <table
                            class="table table-bordered table-striped"
                            id="nonEquipmentTable"
                        >
                            <thead class="table-light">
                                <tr>
                                    <th
                                        class="text-center"
                                        colspan="3"
                                    >Approved Items of Expenditure</th>
                                    <th
                                        class="text-center"
                                        colspan="3"
                                    >Actual Expenditure</th>
                                    <th
                                        class="text-center align-middle"
                                        rowspan="2"
                                    >Remarks/ Justification</th>
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
                                        <input
                                            class="form-control number_input_only non_equipment_approved_qty"
                                            type="number"
                                        >
                                    </td>
                                    <td>
                                        <input
                                            class="form-control non_equipment_approved_particulars"
                                            type="text"
                                        >
                                    </td>
                                    <td>
                                        <input
                                            class="form-control non_equipment_approved_cost"
                                            type="text"
                                        >
                                    </td>
                                    <td>
                                        <input
                                            class="form-control number_input_only non_equipment_actual_qty"
                                            type="number"
                                        >
                                    </td>
                                    <td>
                                        <input
                                            class="form-control non_equipment_actual_particulars"
                                            type="text"
                                        >
                                    </td>
                                    <td>
                                        <input
                                            class="form-control non_equipment_actual_cost"
                                            type="text"
                                        >
                                    </td>
                                    <td>
                                        <textarea
                                            class="form-control non_equipment_remarks"
                                            type="text"
                                        >
                                        </textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">Status of Fund Utilization:</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                2015
                            </div>
                            <div class="col-8">
                                Total Appproved Project Cost
                            </div>
                            <div class="col-4 d-flex justify-content-between">
                                <span>:&nbsp;₱</span>
                                <input
                                    class="bottom_border total_approved_project_cost"
                                    name="total_approved_project_cost"
                                    type="text"
                                >
                            </div>
                            <div class="col-8">
                                Amount Utilized per Financial Report (as of June 2024)
                            </div>
                            <div class="col-4 d-flex justify-content-between">
                                <span>:&nbsp;₱</span>
                                <input
                                    class="bottom_border amount_utilized"
                                    name="amount_utilized"
                                    type="text"
                                >
                            </div>
                            <div class="col-8">
                                Remarks on Status of Utilization
                            </div>
                            <div class="col-4 d-flex justify-content-between">
                                <span>:&nbsp;</span>
                                <input
                                    class="bottom_border"
                                    name="remarks_on_status_of_utilization"
                                    type="text"
                                >
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">Status of Refund</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                2015
                            </div>
                            <div class="col-8">
                                Total amount to be refunded
                            </div>
                            <div class="col-4 d-flex justify-content-between">
                                <span>:&nbsp;₱</span>
                                <input
                                    class="bottom_border total_amount_to_be_refunded"
                                    name="total_amount_to_be_refunded"
                                    type="text"
                                >
                            </div>
                            <div class="col-8">
                                Approved Refund schedule
                            </div>
                            <div class="col-4 d-flex justify-content-between">
                                <span>:&nbsp;</span>
                                <input
                                    class="bottom_border"
                                    name="approved_refund_schedule"
                                    type="text"
                                >
                            </div>
                            <div class="col-8">
                                Total amount already due (as of June 2024)
                            </div>
                            <div class="col-4 d-flex justify-content-between">
                                <span>:&nbsp;₱</span>
                                <input
                                    class="bottom_border total_amount_already_due"
                                    name="total_amount_already_due"
                                    type="text"
                                >
                            </div>
                            <div class="col-8">
                                Total Amount refunded
                            </div>
                            <div class="col-4 d-flex justify-content-between">
                                <span>:&nbsp;₱</span>
                                <input
                                    class="bottom_border total_amount_refunded"
                                    name="total_amount_refunded"
                                    type="text"
                                >
                            </div>
                            <div class="col-8">
                                Unsetted refund
                            </div>
                            <div class="col-4 d-flex justify-content-between">
                                <span>:&nbsp;₱</span>
                                <input
                                    class="bottom_border unsetted_refund"
                                    name="unsetted_refund"
                                    type="text"
                                >
                            </div>
                            <div class="col-8">
                                Refund delayed since
                            </div>
                            <div class="col-4 d-flex justify-content-between">
                                <span>:&nbsp;</span>
                                <input
                                    class="bottom_border"
                                    name="refund_delayed_since"
                                    type="text"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">Volume and value of production including sales generated:</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                            <button
                                class="btn btn-success btn-sm me-2 addNewRowButton"
                                type="button"
                            >
                                <i class="ri-add-fill"></i>
                            </button>
                            <button
                                class="btn btn-danger btn-sm removeRowButton"
                                type="button"
                            >
                                <i class="ri-subtract-fill"></i>
                            </button>
                        </div>
                        <table
                            class="table table-bordered table-striped"
                            id="salesTable"
                        >
                            <thead class="table-light">
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
                                        <input
                                            class="form-control sales_product_service"
                                            type="text"
                                        >
                                    </td>
                                    <td>
                                        <input
                                            class="form-control sales_volume_production"
                                            type="text"
                                        >
                                    </td>
                                    <td>
                                        <input
                                            class="form-control sales_quarter_specify"
                                            type="text"
                                        >
                                    </td>
                                    <td>
                                        <input
                                            class="form-control sales_gross_sales"
                                            type="text"
                                        >
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td
                                        class="text-end"
                                        colspan="3"
                                    >Total</td>
                                    <td><span class="fw-bold">₱1000</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">No. of new employment generated from the project:</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                            <button
                                class="btn btn-success btn-sm me-2 addNewRowButton"
                                type="button"
                            >
                                <i class="ri-add-fill"></i>
                            </button>
                            <button
                                class="btn btn-danger btn-sm removeRowButton"
                                type="button"
                            >
                                <i class="ri-subtract-fill"></i>
                            </button>
                        </div>
                        <table
                            class="table table-bordered table-striped"
                            id="employmentGeneratedTable"
                        >
                            <thead class="table-light">
                                <tr>
                                    <th>No. of Employees</th>
                                    <th>No. of Male</th>
                                    <th>No. of Female</th>
                                    <th>No. of Person with Disability</th>
                                </tr>
                            </thead>
                            <tbody class="employment_generated_tableRow">
                                <tr>
                                    <td><input
                                            class="form-control number_input_only employment_total"
                                            type="number"
                                        ></td>
                                    <td><input
                                            class="form-control number_input_only employment_male"
                                            type="number"
                                        ></td>
                                    <td><input
                                            class="form-control number_input_only employment_female"
                                            type="number"
                                        ></td>
                                    <td><input
                                            class="form-control number_input_only employment_pwd"
                                            type="number"
                                        ></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">No. of new indirect employment from the project:</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                            <button
                                class="btn btn-success btn-sm me-2 addNewRowButton"
                                type="button"
                            >
                                <i class="ri-add-fill"></i>
                            </button>
                            <button
                                class="btn btn-danger btn-sm removeRowButton"
                                type="button"
                            >
                                <i class="ri-subtract-fill"></i>
                            </button>
                        </div>
                        <table
                            class="table table-bordered table-striped"
                            id="indirectEmploymentTable"
                        >
                            <thead class="table-light">
                                <tr>
                                    <th
                                        class="text-center align-middle"
                                        rowspan="2"
                                        colspan="1"
                                        width="50%"
                                    >No. of Indirect Employment</th>
                                    <th
                                        class="text-center"
                                        colspan="3"
                                        width="25%"
                                    >Forward</th>
                                    <th
                                        class="text-center"
                                        colspan="3"
                                        width="25%"
                                    >Backward</th>
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
                                        <input
                                            class="form-control indirect_employment_total"
                                            type="text"
                                        >
                                    </td>
                                    <td>
                                        <input
                                            class="form-control number_input_only indirect_employment_forward_male"
                                            type="number"
                                        >
                                    </td>
                                    <td>
                                        <input
                                            class="form-control number_input_only indirect_employment_forward_female"
                                            type="number"
                                        >
                                    </td>
                                    <td>
                                        <input
                                            class="form-control number_input_only indirect_employment_forward_total"
                                            type="number"
                                        >
                                    </td>
                                    <td>
                                        <input
                                            class="form-control number_input_only indirect_employment_backward_male"
                                            type="number"
                                        >
                                    </td>
                                    <td>
                                        <input
                                            class="form-control number_input_only indirect_employment_backward_female"
                                            type="number"
                                        >
                                    </td>
                                    <td>
                                        <input
                                            class="form-control number_input_only indirect_employment_backward_total"
                                            type="number"
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">List of market penetrated:</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th
                                        class="text-center"
                                        width="40%"
                                    >Existing Market</th>
                                    <th
                                        class="text-center"
                                        width="60%"
                                        colspan="2"
                                    >New Market</th>
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
                                        <textarea
                                            class="form-control"
                                            name="existing_market"
                                            style="width: 100%; height: 100px;"
                                        ></textarea>
                                    </td>
                                    <td>
                                        <textarea
                                            class="form-control"
                                            name="new_market_specific_place"
                                            style="width: 100%; height: 100px;"
                                        ></textarea>
                                    </td>
                                    <td>
                                        <textarea
                                            class="form-control"
                                            name="new_market_effective_date"
                                            style="width: 100%; height: 100px;"
                                        ></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">Improvement in Production efficiency</h6>
                        <small class="text-light">(includes quantitative indicators on improvement in
                            number
                            and quality of materials, number and value of produce, waste minimization, reject reduction,
                            etc.)</small>
                    </div>
                    <div class="card-body">
                        <textarea
                            class="bottom_border"
                            name="improvement_in_production[]"
                        ></textarea>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">Problems met & actions taken during project implementation</h6>
                    </div>
                    <div class="card-body">
                        <h6></h6>
                        <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                            <button
                                class="btn btn-success btn-sm me-2 addNewRowButton"
                                type="button"
                            >
                                <i class="ri-add-fill"></i>
                            </button>
                            <button
                                class="btn btn-danger btn-sm removeRowButton"
                                type="button"
                            >
                                <i class="ri-subtract-fill"></i>
                            </button>
                        </div>
                        <div class="input_list">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>-&nbsp;</span>
                                <input
                                    class="bottom_border"
                                    name="problems_meet[]"
                                    type="text"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">Action/ plan for the improvement of project’s operation</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                            <button
                                class="btn btn-success btn-sm me-2 addNewRowButton"
                                type="button"
                            >
                                <i class="ri-add-fill"></i>
                            </button>
                            <button
                                class="btn btn-danger btn-sm removeRowButton"
                                type="button"
                            >
                                <i class="ri-subtract-fill"></i>
                            </button>
                        </div>
                        <div class="input_list">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>-&nbsp;</span>
                                <input
                                    class="bottom_border"
                                    name="action_and_plan[]"
                                    type="text"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">Linkages/Promotional Plan</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                            <button
                                class="btn btn-success btn-sm me-2 addNewRowButton"
                                type="button"
                            >
                                <i class="ri-add-fill"></i>
                            </button>
                            <button
                                class="btn btn-danger btn-sm removeRowButton"
                                type="button"
                            >
                                <i class="ri-subtract-fill"></i>
                            </button>
                        </div>
                        <div class="input_list">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>-&nbsp;</span>
                                <input
                                    class="bottom_border"
                                    name="linkages_promotional_plan[]"
                                    type="text"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <x-esignature.esignature-main />
        <div class="d-flex justify-content-end p-3">
            <button
                class="btn btn-primary ExportPDF"
                data-to-export="SR"
                type="button"
            >Export as PDF</button>
        </div>
    </div>
</div>
