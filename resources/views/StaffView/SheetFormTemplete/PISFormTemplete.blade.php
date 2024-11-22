 <div id="PISFormContainer" class="h-100 mt-2">
     <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="#" class="revertToSelectDoc">Select Document</a></li>
             <li class="breadcrumb-item active" aria-current="page">Project Information Sheet</li>
         </ol>
     </nav>
     <div class="container-fluid">
         <form id="projectInfoForm" class="row gy-3">
             <div class="col-12">
                 <div class="card shadow-sm bg-body rounded">
                     <div class="card-body">
                         <h6 class="card-title">
                             Project Information
                         </h6>
                         <div class="row gy-2">
                             <div class="col-12">
                                 <label for="projectTitle" class="form-label">Project Title</label>
                                 <input type="text" class="form-control" name="projectTitle" id="projectTitle"
                                     value="{{ $projectData->project_title }}">
                             </div>
                             <div class="col-12">
                                 <label for="projectTitle">Firm Name</label>
                                 <input type="text" class="form-control" name="firmName" id="firmName"
                                     value="{{ $projectData->firm_name }}">
                             </div>
                             <div class="col-12">
                                 <h6>
                                     Contact Person:
                                 </h6>
                             </div>
                             <div class="col-12 col-md-6">
                                 <label for="projectTitle">Name</label>
                                 <input type="text" class="form-control" name="name" id="name"
                                     value="{{ $projectData->f_name . ' ' . $projectData->mid_name . ' ' . $projectData->l_name . ' ' . $projectData->suffix }}">
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="projectTitle">sex</label>
                                 <input type="text" class="form-control" name="sex" id="sex"
                                     value="{{ $projectData->sex }}">
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="projectTitle">Age</label>
                                 <input type="text" class="form-control" name="age" id="age"
                                     value="{{ \Carbon\Carbon::parse($projectData->birth_date)->age }}">
                             </div>
                             <div class="col-12">
                                 <label for="typeOfOrganization" class="form-label">Type of Organiztion
                                     Enterprize</label>
                                 <input type="text" class="form-control" name="typeOfOrganization"
                                     id="typeOfOrganization" value="{{ $projectData->enterprise_type }}">
                             </div>
                             <div class="col-12">
                                 <label for="businessAddress" class="form-label">Business Address</label>
                                 <input type="text" class="form-control" name="businessAddress" id="businessAddress"
                                     value="{{ $projectData->landMark . ', ' . $projectData->barangay . ', ' . $projectData->city . ', ' . $projectData->province . ', ' . $projectData->region }}">
                             </div>
                             <div class="col-12">
                                 <h6>
                                     Contact Datails:
                                 </h6>
                             </div>
                             <div class="col-12 col-md-6">
                                 <label for="landline" class="form-label">Landline:</label>
                                 <input type="text" class="form-control" name="landline"
                                     id="landline"="{{ $projectData->landline }}">
                             </div>
                             <div class="col-12 col-md-6">
                                 <label for="fax" class="form-label">Fax:</label>
                                 <input type="text" class="form-control" name="fax" id="fax">
                             </div>
                             <div class="col-12 col-md-6">
                                 <label for="mobile_phone" class="form-label">Mobile Phone:</label>
                                 <input type="text" class="form-control" name="mobile_phone" id="mobile_phone"
                                     value="{{ $projectData->mobile_number }}">
                             </div>
                             <div class="col-12 col-md-6">
                                 <label for="email" class="form-label">Email Address:</label>
                                 <input type="text" class="form-control" name="email" id="email"
                                     value="{{ $projectData->email }}">
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-12">
                 <div class="card shadow-sm bg-body rounded">
                     <div class="card-body">
                         <div class="row">
                             <div class="col-12 mt-3">
                                 <div class="d-flex justify-content-start">
                                     <h6>Total Assets:</h6>
                                     <input type="text" class="form-control form-control-sm w-25"
                                         id="totalAssests" name="totalAssets" readonly>
                                 </div>
                             </div>
                             <div class="col-12 col-md-3">
                                 <div class="form-group">
                                     <label for="land" class="form-label">Land:</label>
                                     <input type="text" class="form-control" id="land_val" name="land">
                                 </div>
                             </div>
                             <div class="col-12 col-md-3">
                                 <div class="form-group">
                                     <label for="building" class="form-label">Building:</label>
                                     <input type="text" class="form-control" id="building_val" name="building">
                                 </div>
                             </div>
                             <div class="col-12 col-md-3">
                                 <div class="form-group">
                                     <label for="equipment" class="form-label">Equipment:</label>
                                     <input type="text" class="form-control" id="equipment_val" name="equipment">
                                 </div>
                             </div>
                             <div class="col-12 col-md-3">
                                 <div class="form-group">
                                     <label for="workingCapital" class="form-label">Working Capital:</label>
                                     <input type="text" class="form-control" id="workingCapital_val"
                                         name="workingCapital">
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-12">
                 <div class="card shadow-sm bg-body rounded">
                     <div class="card-body">
                         <div class="row">
                             <div class="col-12 mb-3">
                                 <h5 class="fw-bold">Total Employment Generated</h5>
                             </div>
                             <div class="col-12 mb-4">
                                 <label class="fw-semibold me-2">Man Months:</label>
                                 <input type="text" class="bottom_border" id="TotalmanMonths"
                                     name="TotalmanMonths" style="width: 15%;" readonly>
                             </div>
                             <div class="col-12">
                                 <table class="table table-bordered align-middle">
                                     <thead class="table-light">
                                         <tr>
                                             <th class="text-start" width="40%">Direct Employment:</th>
                                             <th class="text-center" width="20%">Male</th>
                                             <th class="text-center" width="20%">Female</th>
                                             <th class="text-center" width="20%">Sub-total</th>
                                         </tr>
                                     </thead>
                                     <tbody id="totalEmploymentContainer">
                                         <tr>
                                             <td colspan="4" class="fw-bold">Company Hire:</td>
                                         </tr>
                                         <tr>
                                             <td class="ps-4">Regular:</td>
                                             <td>
                                                 <input type="text" class="bottom_border form-control maleInput"
                                                     id="Regular_male" name="Regular_male">
                                             </td>
                                             <td>
                                                 <input type="text" class="bottom_border form-control femaleInput"
                                                     id="Regular_female" name="Regular_female">
                                             </td>
                                             <td>
                                                 <input type="text"
                                                     class="bottom_border form-control thisRowSubtotal"
                                                     id="Regular_subtotal" name="Regular_subtotal" readonly>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td class="ps-4">Part-time:</td>
                                             <td>
                                                 <input type="text" class="bottom_border form-control maleInput"
                                                     id="Parttime_male" name="Parttime_male">
                                             </td>
                                             <td>
                                                 <input type="text" class="bottom_border form-control femaleInput"
                                                     id="Parttime_female" name="Parttime_female">
                                             </td>
                                             <td>
                                                 <input type="text"
                                                     class="bottom_border form-control thisRowSubtotal"
                                                     id="Parttime_subtotal" name="Parttime_subtotal" readonly>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td colspan="4" class="fw-bold">Sub-contractor Hire:</td>
                                         </tr>
                                         <tr>
                                             <td class="ps-4">Regular:</td>
                                             <td>
                                                 <input type="text" class="bottom_border form-control maleInput"
                                                     id="Regu_Subcont_male" name="Regu_Subcont_male">
                                             </td>
                                             <td>
                                                 <input type="text" class="bottom_border form-control femaleInput"
                                                     id="Regu_Subcont_female" name="Regu_Subcont_female">
                                             </td>
                                             <td>
                                                 <input type="text"
                                                     class="bottom_border form-control thisRowSubtotal"
                                                     id="Regu_Subcont_subtotal" name="Regu_Subcont_subtotal" readonly>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td class="ps-4">Part-time:</td>
                                             <td>
                                                 <input type="text" class="bottom_border form-control maleInput"
                                                     id="Subcont_Parttime_male" name="Subcont_Parttime_male">
                                             </td>
                                             <td>
                                                 <input type="text" class="bottom_border form-control femaleInput"
                                                     id="Subcont_Parttime_female" name="Subcont_Parttime_female">
                                             </td>
                                             <td>
                                                 <input type="text"
                                                     class="bottom_border form-control thisRowSubtotal"
                                                     id="Subcont_Parttime_subtotal" name="Subcont_Parttime_subtotal"
                                                     readonly>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td colspan="4" class="fw-bold">Indirect Employment:</td>
                                         </tr>
                                         <tr>
                                             <td class="ps-4">Regular:</td>
                                             <td>
                                                 <input type="text" class="bottom_border form-control maleInput"
                                                     id="Indirect_Regular_male" name="Indirect_Regular_male">
                                             </td>
                                             <td>
                                                 <input type="text" class="bottom_border form-control femaleInput"
                                                     id="Indirect_Regular_female" name="Indirect_Regular_female">
                                             </td>
                                             <td>
                                                 <input type="text"
                                                     class="bottom_border form-control thisRowSubtotal"
                                                     id="Indirect_Regular_subtotal" name="Indirect_Regular_subtotal"
                                                     readonly>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td class="ps-4">Part-time:</td>
                                             <td>
                                                 <input type="text" class="bottom_border form-control maleInput"
                                                     id="Indirect_Parttime_male" name="Indirect_Parttime_male">
                                             </td>
                                             <td>
                                                 <input type="text" class="bottom_border form-control femaleInput"
                                                     id="Indirect_Parttime_female" name="Indirect_Parttime_female">
                                             </td>
                                             <td>
                                                 <input type="text"
                                                     class="bottom_border form-control thisRowSubtotal"
                                                     id="Indirect_Parttime_subtotal" name="Indirect_Parttime_subtotal"
                                                     readonly>
                                             </td>
                                         </tr>
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>
                 </div>

             </div>
             <div class="col-12">
                 <div class="card shadow-sm bg-body rounded">
                     <div class="card-body">
                         <div class="row">
                             <div class="col-12">
                                 <h6>Production Volume</h6>
                             </div>
                             <div class="col-12 col-md-6">
                                 <div class="mb-3">
                                     <label for="localProduct" class="form-label">Local Product</label>
                                     <input type="text" class="form-control" id="localProduct"
                                         name="localProduct">
                                 </div>
                             </div>
                             <div class="col-12 col-md-6">
                                 <div class="mb-3">
                                     <label for="exportProduct" class="form-label">Export Product</label>
                                     <input type="text" class="form-control" id="exportProduct"
                                         name="exportProduct">
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-12">
                 <div class="card shadow-sm bg-body rounded">
                     <div class="card-body">
                         <div class="row">
                             <div class="col-12">
                                 <h6>
                                     Total Gross Sales ₱
                                     <input type="text" class="bottom_border ms-2" id="totalGrossSales"
                                         name="totalGrossSales" style="width: 15%;" readonly>
                                 </h6>
                             </div>
                             <div class="col-12 col-md-6">
                                 <label for="localProductValue">Local</label>
                                 <input type="text" class="form-control" id="localProduct_Val"
                                     name="localProduct_Val">
                             </div>
                             <div class="col-12 col-md-6">
                                 <label for="exportProductValue">Export</label>
                                 <input type="text" class="form-control" id="exportProduct_Val"
                                     name="exportProduct_Val">
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </form>
         <div class="col-12 mt-3">
             <div class="card shadow-sm bg-body rounded">
                 <div class="card-body">
                     <h6>
                         Assistance obtained from DOST (please check)
                     </h6>
                     <form id="PIS_checklistsForm">
                         <div class="row">
                             <div class="col-12 ps-1">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="productionTechnology"
                                         name="productionTechnology_checkbox">
                                     <label class="form-check-label" for="productionTechnology">
                                         A1 Production Technology
                                     </label>
                                 </div>
                             </div>
                             <div class="col-12 col-md-3 ps-3">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="process"
                                         name="process_checkbox">
                                     <label class="form-check-label " for="process">
                                         A.1.1 Process
                                     </label>
                                 </div>
                             </div>
                             <div class="col-12 col-md-9 ps-4">
                                 <input type="text" class="bottom_border ms-2" name="processDefinition">
                             </div>
                             <div class="col-12 col-md-3 ps-3">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="equipment"
                                         name="equipment_checkbox">
                                     <label class="form-check-label " for="equipment">
                                         A.1.2 Equipment
                                     </label>
                                 </div>
                             </div>
                             <div class="col-md-9 ps-4">
                                 <input type="text" class="bottom_border ms-2" name="equipmentDefinition">
                             </div>
                             <div class="col-12 col-md-3 ps-3">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="qualityControl"
                                         name="qualityControl_checkbox">
                                     <label class="form-check-label " for="qualityControl">
                                         A.1.3 Quality Control/Laboratory Testing/Analysis
                                     </label>
                                 </div>
                             </div>
                             <div class="col-md-9 ps-4">
                                 <input type="text" class="bottom_border ms-2" name="qualityControlDefinition">
                             </div>
                             <div class="col-12 ps-4">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="productionTechnology1"
                                         name="productionTechnology1_checkbox">
                                     <label class="form-check-label " for="productionTechnology1">
                                         1.3.1 Production Technology
                                     </label>
                                 </div>
                             </div>

                             <div class="col-12 col-md-3  ps-1">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="packagingLabeling"
                                         name="packagingLabeling_checkbox">
                                     <label class="form-check-label" for="packagingLabeling">
                                         A2 Packaging/Labeling
                                     </label>
                                 </div>
                             </div>
                             <div class="col-md-9 ps-4">
                                 <input type="text" class="bottom_border ms-2" name="packagingLabelingDefinition">
                             </div>
                             <div class="col-12 col-md-3 ps-1">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="postHarvest"
                                         name="postHarvest_checkbox">
                                     <label class="form-check-label" for="postHarvest">
                                         A3 Post-Harvest
                                     </label>
                                 </div>
                             </div>
                             <div class="col-md-9 ps-4">
                                 <input type="text" class="bottom_border ms-2" name="postHarvestDefinition">
                             </div>
                             <div class="col-12 col-md-3  ps-1">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="marketAssistance"
                                         name="marketAssistance_checkbox">
                                     <label class="form-check-label" for="marketAssistance">
                                         A4 Market Assistance
                                     </label>
                                 </div>
                             </div>
                             <div class="col-md-9 ps-4">
                                 <input type="text" class="bottom_border ms-2" name="marketAssistanceDefinition">
                             </div>
                             <div class="col-12 col-md-3  ps-1">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="humanResourceTraining"
                                         name="humanResourceTraining_checkbox">
                                     <label class="form-check-label" for="humanResourceTraining">
                                         A5 Human Resource training
                                     </label>
                                 </div>
                             </div>
                             <div class="col-md-9 ps-4">
                                 <input type="text" class="bottom_border ms-2"
                                     name="humanResourceTrainingDefinition">
                             </div>
                             <div class="col-12 col-md-3  ps-1">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="consultanceServices"
                                         name="consultanceServices_checkbox">
                                     <label class="form-check-label" for="consultanceServices">
                                         A6 Consultance Services
                                     </label>
                                 </div>
                             </div>
                             <div class=" col-md-9 ps-4">
                                 <input type="text" class="bottom_border ms-2"
                                     name="consultanceServicesDefinition">
                             </div>
                             <div class="col-12 col-md-3  ps-1">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="otherServices"
                                         name="otherServices_checkbox">
                                     <label class="form-check-label" for="otherServices">
                                         A7 other Services (FDA Permit, LGU Registration,
                                         Barcoding)
                                     </label>
                                 </div>
                             </div>
                             <div class="col-md-9 ps-4 ">
                                 <input type="text" class="bottom_border ms-2" name="otherServicesDefinition">
                             </div>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
         <div class="d-flex justify-content-end p-3">
             <button type="button" data-to-export="PIS" class="btn btn-primary ExportPDF">Export as PDF</button>
         </div>
     </div>
 </div>
