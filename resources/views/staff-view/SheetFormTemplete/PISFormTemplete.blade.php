 <div
     class="h-100 mt-2"
     id="PISFormContainer"
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
             >Project Information Sheet</li>
         </ol>
     </nav>
     <div class="container-fluid">
         <form
             class="row gy-3"
             id="projectInfoForm"
         >
             <div class="col-12">
                 <div class="card shadow-sm bg-body rounded">
                     <div class="card-header bg-primary">
                         <h6 class="mb-0 text-white">
                             Project Information
                         </h6>
                     </div>
                     <div class="card-body">
                         <div class="row gy-2">
                             <div class="col-12">
                                 <label
                                     class="form-label"
                                     for="projectTitle"
                                 >Project Title</label>
                                 <input
                                     class="form-control"
                                     id="projectTitle"
                                     name="projectTitle"
                                     type="text"
                                     value="{{ $projectData->project_title }}"
                                 >
                             </div>
                             <div class="col-12">
                                 <label for="projectTitle">Firm Name</label>
                                 <input
                                     class="form-control"
                                     id="firmName"
                                     name="firmName"
                                     type="text"
                                     value="{{ $projectData->firm_name }}"
                                 >
                             </div>
                             <div class="col-12">
                                 <h6>
                                     Contact Person:
                                 </h6>
                             </div>
                             <div class="col-12 col-md-6">
                                 <label for="projectTitle">Name</label>
                                 <input
                                     class="form-control"
                                     id="name"
                                     name="name"
                                     type="text"
                                     value="{{ $projectData->f_name . ' ' . $projectData->mid_name . ' ' . $projectData->l_name . ' ' . $projectData->suffix }}"
                                 >
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="projectTitle">sex</label>
                                 <input
                                     class="form-control"
                                     id="sex"
                                     name="sex"
                                     type="text"
                                     value="{{ $projectData->sex }}"
                                 >
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="projectTitle">Age</label>
                                 <input
                                     class="form-control"
                                     id="age"
                                     name="age"
                                     type="text"
                                     value="{{ \Carbon\Carbon::parse($projectData->birth_date)->age }}"
                                 >
                             </div>
                             <div class="col-12">
                                 <label
                                     class="form-label"
                                     for="typeOfOrganization"
                                 >Type of Organiztion
                                     Enterprize</label>
                                 <input
                                     class="form-control"
                                     id="typeOfOrganization"
                                     name="typeOfOrganization"
                                     type="text"
                                     value="{{ $projectData->enterprise_type }}"
                                 >
                             </div>
                             <div class="col-12">
                                 <label
                                     class="form-label"
                                     for="businessAddress"
                                 >Business Address</label>
                                 <input
                                     class="form-control"
                                     id="businessAddress"
                                     name="businessAddress"
                                     type="text"
                                     value="{{ $projectData->landMark . ', ' . $projectData->barangay . ', ' . $projectData->city . ', ' . $projectData->province . ', ' . $projectData->region }}"
                                 >
                             </div>
                             <div class="col-12">
                                 <h6>
                                     Contact Datails:
                                 </h6>
                             </div>
                             <div class="col-12 col-md-6">
                                 <label
                                     class="form-label"
                                     for="landline"
                                 >Landline:</label>
                                 <input
                                     class="form-control"
                                     id="landline"="{{ $projectData->landline }}"
                                     name="landline"
                                     type="text"
                                 >
                             </div>
                             <div class="col-12 col-md-6">
                                 <label
                                     class="form-label"
                                     for="fax"
                                 >Fax:</label>
                                 <input
                                     class="form-control"
                                     id="fax"
                                     name="fax"
                                     type="text"
                                 >
                             </div>
                             <div class="col-12 col-md-6">
                                 <label
                                     class="form-label"
                                     for="mobile_phone"
                                 >Mobile Phone:</label>
                                 <input
                                     class="form-control"
                                     id="mobile_phone"
                                     name="mobile_phone"
                                     type="text"
                                     value="{{ $projectData->mobile_number }}"
                                 >
                             </div>
                             <div class="col-12 col-md-6">
                                 <label
                                     class="form-label"
                                     for="email"
                                 >Email Address:</label>
                                 <input
                                     class="form-control"
                                     id="email"
                                     name="email"
                                     type="text"
                                     value="{{ $projectData->email }}"
                                 >
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-12">
                 <div class="card shadow-sm bg-body rounded">
                     <div class="card-header bg-primary">
                         <h6 class="mb-0 text-white">Assets</h6>
                     </div>
                     <div class="card-body">
                         <div class="row">
                             <div class="col-12 mt-3">
                                 <div class="d-flex justify-content-start">
                                     <h6>Total Assets:</h6>
                                     <input
                                         class="form-control form-control-sm w-25"
                                         id="totalAssests"
                                         name="totalAssets"
                                         type="text"
                                         readonly
                                     >
                                 </div>
                             </div>
                             <div class="col-12 col-md-3">
                                 <div class="form-group">
                                     <label
                                         class="form-label"
                                         for="land"
                                     >Land:</label>
                                     <input
                                         class="form-control"
                                         id="land_val"
                                         name="land"
                                         type="text"
                                     >
                                 </div>
                             </div>
                             <div class="col-12 col-md-3">
                                 <div class="form-group">
                                     <label
                                         class="form-label"
                                         for="building"
                                     >Building:</label>
                                     <input
                                         class="form-control"
                                         id="building_val"
                                         name="building"
                                         type="text"
                                     >
                                 </div>
                             </div>
                             <div class="col-12 col-md-3">
                                 <div class="form-group">
                                     <label
                                         class="form-label"
                                         for="equipment"
                                     >Equipment:</label>
                                     <input
                                         class="form-control"
                                         id="equipment_val"
                                         name="equipment"
                                         type="text"
                                     >
                                 </div>
                             </div>
                             <div class="col-12 col-md-3">
                                 <div class="form-group">
                                     <label
                                         class="form-label"
                                         for="workingCapital"
                                     >Working Capital:</label>
                                     <input
                                         class="form-control"
                                         id="workingCapital_val"
                                         name="workingCapital"
                                         type="text"
                                     >
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-12">
                 <div class="card shadow-sm bg-body rounded">
                     <div class="card-header bg-primary">
                         <h6 class="mb-0 text-white">Total Employment Generated</h6>
                     </div>
                     <div class="card-body">
                         <div class="row">
                             <div class="col-12 mb-4">
                                 <label class="fw-semibold me-2">Man Months:</label>
                                 <input
                                     class="bottom_border"
                                     id="TotalmanMonths"
                                     name="TotalmanMonths"
                                     type="text"
                                     style="width: 15%;"
                                     readonly
                                 >
                             </div>
                             <div class="col-12">
                                 <table class="table table-bordered align-middle">
                                     <thead class="table-light">
                                         <tr>
                                             <th
                                                 class="text-start"
                                                 width="40%"
                                             >Direct Employment:</th>
                                             <th
                                                 class="text-center"
                                                 width="20%"
                                             >Male</th>
                                             <th
                                                 class="text-center"
                                                 width="20%"
                                             >Female</th>
                                             <th
                                                 class="text-center"
                                                 width="20%"
                                             >Sub-total</th>
                                         </tr>
                                     </thead>
                                     <tbody id="totalEmploymentContainer">
                                         <tr>
                                             <td
                                                 class="fw-bold"
                                                 colspan="4"
                                             >Company Hire:</td>
                                         </tr>
                                         <tr>
                                             <td class="ps-4">Regular:</td>
                                             <td>
                                                 <input
                                                     class="bottom_border form-control maleInput"
                                                     id="Regular_male"
                                                     name="Regular_male"
                                                     type="text"
                                                 >
                                             </td>
                                             <td>
                                                 <input
                                                     class="bottom_border form-control femaleInput"
                                                     id="Regular_female"
                                                     name="Regular_female"
                                                     type="text"
                                                 >
                                             </td>
                                             <td>
                                                 <input
                                                     class="bottom_border form-control thisRowSubtotal"
                                                     id="Regular_subtotal"
                                                     name="Regular_subtotal"
                                                     type="text"
                                                     readonly
                                                 >
                                             </td>
                                         </tr>
                                         <tr>
                                             <td class="ps-4">Part-time:</td>
                                             <td>
                                                 <input
                                                     class="bottom_border form-control maleInput"
                                                     id="Parttime_male"
                                                     name="Parttime_male"
                                                     type="text"
                                                 >
                                             </td>
                                             <td>
                                                 <input
                                                     class="bottom_border form-control femaleInput"
                                                     id="Parttime_female"
                                                     name="Parttime_female"
                                                     type="text"
                                                 >
                                             </td>
                                             <td>
                                                 <input
                                                     class="bottom_border form-control thisRowSubtotal"
                                                     id="Parttime_subtotal"
                                                     name="Parttime_subtotal"
                                                     type="text"
                                                     readonly
                                                 >
                                             </td>
                                         </tr>
                                         <tr>
                                             <td
                                                 class="fw-bold"
                                                 colspan="4"
                                             >Sub-contractor Hire:</td>
                                         </tr>
                                         <tr>
                                             <td class="ps-4">Regular:</td>
                                             <td>
                                                 <input
                                                     class="bottom_border form-control maleInput"
                                                     id="Regu_Subcont_male"
                                                     name="Regu_Subcont_male"
                                                     type="text"
                                                 >
                                             </td>
                                             <td>
                                                 <input
                                                     class="bottom_border form-control femaleInput"
                                                     id="Regu_Subcont_female"
                                                     name="Regu_Subcont_female"
                                                     type="text"
                                                 >
                                             </td>
                                             <td>
                                                 <input
                                                     class="bottom_border form-control thisRowSubtotal"
                                                     id="Regu_Subcont_subtotal"
                                                     name="Regu_Subcont_subtotal"
                                                     type="text"
                                                     readonly
                                                 >
                                             </td>
                                         </tr>
                                         <tr>
                                             <td class="ps-4">Part-time:</td>
                                             <td>
                                                 <input
                                                     class="bottom_border form-control maleInput"
                                                     id="Subcont_Parttime_male"
                                                     name="Subcont_Parttime_male"
                                                     type="text"
                                                 >
                                             </td>
                                             <td>
                                                 <input
                                                     class="bottom_border form-control femaleInput"
                                                     id="Subcont_Parttime_female"
                                                     name="Subcont_Parttime_female"
                                                     type="text"
                                                 >
                                             </td>
                                             <td>
                                                 <input
                                                     class="bottom_border form-control thisRowSubtotal"
                                                     id="Subcont_Parttime_subtotal"
                                                     name="Subcont_Parttime_subtotal"
                                                     type="text"
                                                     readonly
                                                 >
                                             </td>
                                         </tr>
                                         <tr>
                                             <td
                                                 class="fw-bold"
                                                 colspan="4"
                                             >Indirect Employment:</td>
                                         </tr>
                                         <tr>
                                             <td class="ps-4">Regular:</td>
                                             <td>
                                                 <input
                                                     class="bottom_border form-control maleInput"
                                                     id="Indirect_Regular_male"
                                                     name="Indirect_Regular_male"
                                                     type="text"
                                                 >
                                             </td>
                                             <td>
                                                 <input
                                                     class="bottom_border form-control femaleInput"
                                                     id="Indirect_Regular_female"
                                                     name="Indirect_Regular_female"
                                                     type="text"
                                                 >
                                             </td>
                                             <td>
                                                 <input
                                                     class="bottom_border form-control thisRowSubtotal"
                                                     id="Indirect_Regular_subtotal"
                                                     name="Indirect_Regular_subtotal"
                                                     type="text"
                                                     readonly
                                                 >
                                             </td>
                                         </tr>
                                         <tr>
                                             <td class="ps-4">Part-time:</td>
                                             <td>
                                                 <input
                                                     class="bottom_border form-control maleInput"
                                                     id="Indirect_Parttime_male"
                                                     name="Indirect_Parttime_male"
                                                     type="text"
                                                 >
                                             </td>
                                             <td>
                                                 <input
                                                     class="bottom_border form-control femaleInput"
                                                     id="Indirect_Parttime_female"
                                                     name="Indirect_Parttime_female"
                                                     type="text"
                                                 >
                                             </td>
                                             <td>
                                                 <input
                                                     class="bottom_border form-control thisRowSubtotal"
                                                     id="Indirect_Parttime_subtotal"
                                                     name="Indirect_Parttime_subtotal"
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

             </div>
             <div class="col-12">
                 <div class="card shadow-sm bg-body rounded">
                     <div class="card-header bg-primary">
                         <h6 class="text-white mb-0">Production Volume</h6>
                     </div>
                     <div class="card-body">
                         <div class="row">
                             <div class="col-12 col-md-6">
                                 <div class="mb-3">
                                     <label
                                         class="form-label"
                                         for="localProduct"
                                     >Local Product</label>
                                     <textarea
                                         class="form-control"
                                         id="localProduct"
                                         name="localProduct"
                                         rows="3"
                                     ></textarea>
                                 </div>
                             </div>
                             <div class="col-12 col-md-6">
                                 <div class="mb-3">
                                     <label
                                         class="form-label"
                                         for="exportProduct"
                                     >Export Product</label>
                                     <textarea
                                         class="form-control"
                                         id="exportProduct"
                                         name="exportProduct"
                                         rows="3"
                                     ></textarea>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-12">
                 <div class="card shadow-sm bg-body rounded">
                     <div class="card-header bg-primary">
                         <h6 class="text-white mb-0">Gross Sales</h6>
                     </div>
                     <div class="card-body">
                         <div class="row">
                             <div class="col-12">
                                 <h6>
                                     Total Gross Sales ₱
                                     <input
                                         class="bottom_border ms-2"
                                         id="totalGrossSales"
                                         name="totalGrossSales"
                                         type="text"
                                         style="width: 15%;"
                                         readonly
                                     >
                                 </h6>
                             </div>
                             <div class="col-12 col-md-6">
                                 <label for="localProductValue">Local</label>
                                 <input
                                     class="form-control"
                                     id="localProduct_Val"
                                     name="localProduct_Val"
                                     type="text"
                                 >
                             </div>
                             <div class="col-12 col-md-6">
                                 <label for="exportProductValue">Export</label>
                                 <input
                                     class="form-control"
                                     id="exportProduct_Val"
                                     name="exportProduct_Val"
                                     type="text"
                                 >
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </form>
         <div class="col-12 mt-3">
             <div class="card shadow-sm bg-body rounded">
                 <div class="card-header bg-primary">
                     <h6 class="text-white mb-0"> Assistance obtained from DOST (please check)</h6>
                 </div>
                 <div class="card-body">
                     <form id="PIS_checklistsForm">
                         <div class="row">
                             <div class="col-12 ps-1">
                                 <div class="form-check">
                                     <input
                                         class="form-check-input"
                                         id="productionTechnology"
                                         name="productionTechnology_checkbox"
                                         type="checkbox"
                                     >
                                     <label
                                         class="form-check-label"
                                         for="productionTechnology"
                                     >
                                         A1 Production Technology
                                     </label>
                                 </div>
                             </div>
                             <div class="col-12 col-md-3 ps-3">
                                 <div class="form-check">
                                     <input
                                         class="form-check-input"
                                         id="process"
                                         name="process_checkbox"
                                         type="checkbox"
                                     >
                                     <label
                                         class="form-check-label "
                                         for="process"
                                     >
                                         A.1.1 Process
                                     </label>
                                 </div>
                             </div>
                             <div class="col-12 col-md-9 ps-4">
                                 <input
                                     class="bottom_border ms-2"
                                     name="processDefinition"
                                     type="text"
                                 >
                             </div>
                             <div class="col-12 col-md-3 ps-3">
                                 <div class="form-check">
                                     <input
                                         class="form-check-input"
                                         id="equipment"
                                         name="equipment_checkbox"
                                         type="checkbox"
                                     >
                                     <label
                                         class="form-check-label "
                                         for="equipment"
                                     >
                                         A.1.2 Equipment
                                     </label>
                                 </div>
                             </div>
                             <div class="col-md-9 ps-4">
                                 <input
                                     class="bottom_border ms-2"
                                     name="equipmentDefinition"
                                     type="text"
                                 >
                             </div>
                             <div class="col-12 col-md-3 ps-3">
                                 <div class="form-check">
                                     <input
                                         class="form-check-input"
                                         id="qualityControl"
                                         name="qualityControl_checkbox"
                                         type="checkbox"
                                     >
                                     <label
                                         class="form-check-label "
                                         for="qualityControl"
                                     >
                                         A.1.3 Quality Control/Laboratory Testing/Analysis
                                     </label>
                                 </div>
                             </div>
                             <div class="col-md-9 ps-4">
                                 <input
                                     class="bottom_border ms-2"
                                     name="qualityControlDefinition"
                                     type="text"
                                 >
                             </div>
                             <div class="col-12 ps-4">
                                 <div class="form-check">
                                     <input
                                         class="form-check-input"
                                         id="productionTechnology1"
                                         name="productionTechnology1_checkbox"
                                         type="checkbox"
                                     >
                                     <label
                                         class="form-check-label "
                                         for="productionTechnology1"
                                     >
                                         1.3.1 Production Technology
                                     </label>
                                 </div>
                             </div>

                             <div class="col-12 col-md-3  ps-1">
                                 <div class="form-check">
                                     <input
                                         class="form-check-input"
                                         id="packagingLabeling"
                                         name="packagingLabeling_checkbox"
                                         type="checkbox"
                                     >
                                     <label
                                         class="form-check-label"
                                         for="packagingLabeling"
                                     >
                                         A2 Packaging/Labeling
                                     </label>
                                 </div>
                             </div>
                             <div class="col-md-9 ps-4">
                                 <input
                                     class="bottom_border ms-2"
                                     name="packagingLabelingDefinition"
                                     type="text"
                                 >
                             </div>
                             <div class="col-12 col-md-3 ps-1">
                                 <div class="form-check">
                                     <input
                                         class="form-check-input"
                                         id="postHarvest"
                                         name="postHarvest_checkbox"
                                         type="checkbox"
                                     >
                                     <label
                                         class="form-check-label"
                                         for="postHarvest"
                                     >
                                         A3 Post-Harvest
                                     </label>
                                 </div>
                             </div>
                             <div class="col-md-9 ps-4">
                                 <input
                                     class="bottom_border ms-2"
                                     name="postHarvestDefinition"
                                     type="text"
                                 >
                             </div>
                             <div class="col-12 col-md-3  ps-1">
                                 <div class="form-check">
                                     <input
                                         class="form-check-input"
                                         id="marketAssistance"
                                         name="marketAssistance_checkbox"
                                         type="checkbox"
                                     >
                                     <label
                                         class="form-check-label"
                                         for="marketAssistance"
                                     >
                                         A4 Market Assistance
                                     </label>
                                 </div>
                             </div>
                             <div class="col-md-9 ps-4">
                                 <input
                                     class="bottom_border ms-2"
                                     name="marketAssistanceDefinition"
                                     type="text"
                                 >
                             </div>
                             <div class="col-12 col-md-3  ps-1">
                                 <div class="form-check">
                                     <input
                                         class="form-check-input"
                                         id="humanResourceTraining"
                                         name="humanResourceTraining_checkbox"
                                         type="checkbox"
                                     >
                                     <label
                                         class="form-check-label"
                                         for="humanResourceTraining"
                                     >
                                         A5 Human Resource training
                                     </label>
                                 </div>
                             </div>
                             <div class="col-md-9 ps-4">
                                 <input
                                     class="bottom_border ms-2"
                                     name="humanResourceTrainingDefinition"
                                     type="text"
                                 >
                             </div>
                             <div class="col-12 col-md-3  ps-1">
                                 <div class="form-check">
                                     <input
                                         class="form-check-input"
                                         id="consultanceServices"
                                         name="consultanceServices_checkbox"
                                         type="checkbox"
                                     >
                                     <label
                                         class="form-check-label"
                                         for="consultanceServices"
                                     >
                                         A6 Consultance Services
                                     </label>
                                 </div>
                             </div>
                             <div class=" col-md-9 ps-4">
                                 <input
                                     class="bottom_border ms-2"
                                     name="consultanceServicesDefinition"
                                     type="text"
                                 >
                             </div>
                             <div class="col-12 col-md-3  ps-1">
                                 <div class="form-check">
                                     <input
                                         class="form-check-input"
                                         id="otherServices"
                                         name="otherServices_checkbox"
                                         type="checkbox"
                                     >
                                     <label
                                         class="form-check-label"
                                         for="otherServices"
                                     >
                                         A7 other Services (FDA Permit, LGU Registration,
                                         Barcoding)
                                     </label>
                                 </div>
                             </div>
                             <div class="col-md-9 ps-4 ">
                                 <input
                                     class="bottom_border ms-2"
                                     name="otherServicesDefinition"
                                     type="text"
                                 >
                             </div>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
         <x-esignature.esignature-main
             :hasDate="false"
             :layout="'default'"
         />
         <div class="d-flex justify-content-end p-3">
             <button
                 class="btn btn-primary ExportPDF"
                 data-to-export="PIS"
                 type="button"
             >Export as PDF</button>
         </div>
     </div>
 </div>
