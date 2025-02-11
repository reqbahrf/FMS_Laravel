@php
    $isEdit = true;
@endphp
<div id="ProjectProposalForm">
    <div class="center">
        <img
            src="media/image1.png"
            alt="Logo"
            width="600"
            height="69"
        >
    </div>
    <table
        id="TopProposalTable"
        style="border-collapse: collapse;"
        width="100%"
        cellpadding="5"
    >
        <tr>
            <td
                style="text-align: center; font-weight: bold; font-size: larger;"
                colspan="9"
            >PROJECT PROPOSAL</td>
        </tr>
        <tr>
            <td class="font-bold label-width">PROJECT TITLE:</td>
            <td colspan="8">
                @if ($isEdit)
                    <input
                        name="project_title"
                        type="text"
                        value="{{ $project_title ?? '' }}"
                        placeholder="(Must already be able to reflect the goal of the project)"
                    >
                @else
                    {{ $project_title ?? '' }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="font-bold label-width">PROPONENT:</td>
            <td colspan="8">
                @if ($isEdit)
                    <input
                        name="proponent"
                        type="text"
                        value="{{ $proponent ?? '' }}"
                        placeholder="(Indicate name and address of Firm)"
                    >
                @else
                    {{ $proponent ?? '' }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="font-bold label-width">PROJECT COST:</td>
            <td colspan="8">
                @if ($isEdit)
                    <input
                        name="project_cost"
                        type="text"
                        value="{{ $project_cost ?? '' }}"
                        placeholder="(Total project cost including counterpart of the proponent)"
                    >
                @else
                    {{ $project_cost ?? '' }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="font-bold label-width">AMOUNT REQUESTED:</td>
            <td colspan="8">
                @if ($isEdit)
                    <input
                        name="amount_requested"
                        type="text"
                        value="{{ $amount_requested ?? '' }}"
                        placeholder="(DOST-SETUP counterpart or amount requested from DOST-SETUP)"
                    >
                @else
                    {{ $amount_requested ?? '' }}
                @endif
            </td>
        </tr>
        <tr>
            <td
                style="font-weight: bold;"
                colspan="9"
            >OBJECTIVES:</td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="8">
                <p style="font-weight: bold;">General Objectives:</p><br>
                @if ($isEdit)
                <textarea
                    class="form-control"
                    name="general_objectives"
                >{{ $general_objectives ?? '' }}</textarea>
                @else
                    {{ $general_objectives ?? '' }}
                @endif
                <p style="font-weight: bold;">Specific Objectives:</p><br>
                @if ($isEdit)
                <textarea
                    class="form-control"
                    name="specific_objectives"
                >{{ $specific_objectives ?? '' }}</textarea>
                @else
                    {{ $specific_objectives ?? '' }}
                @endif
            </td>
        </tr>
        <tr>
            <td
                style="font-weight: bold;"
                colspan="9"
            >PROJECT BACKGROUND:</td>
        </tr>
        <tr>
            <td colspan="9">
                <p style="font-weight: bold;">A. Company Profile</p>
            </td>
        </tr>
    </table>
    <table
        id="CompanyProfileTable"
        style="border-collapse: collapse;"
        width="100%"
        border="1"
        cellpadding="5"
    >
        <tr>
            <td>Name of Firm</td>
            <td colspan="8">
                @if ($isEdit)
                <input
                    name="name_of_firm"
                    type="text"
                    value=""
                    placeholder="XYZ Company"
                >
                @else
                    {{ $name_of_firm ?? '' }}
                @endif
            </td>
        </tr>
        <tr>
            <td>Address</td>
            <td colspan="8">
                @if ($isEdit)
                <input
                    name="address"
                    type="text"
                    value=""
                    placeholder="Purok 1, Barangay 1, City, Province"
                ></td>
                @else
                    {{ $address ?? '' }}
                @endif
            </td>
        </tr>
        <tr>
            <td>Contact Person</td>
            <td colspan="8">
                @if ($isEdit)
                <input
                    name="contact_person"
                    type="text"
                    value=""
                    placeholder="John Doe"
                >
                @else
                    {{ $contact_person ?? '' }}
                @endif
            </td>
        </tr>
        <tr>
            <td>Contact No</td>
            <td colspan="8">
                @if ($isEdit)
                <input
                    name="contact_no"
                    type="text"
                    value=""
                    placeholder="09123456789"
                ></td>
                @else
                    {{ $contact_no ?? '' }}
                @endif
            </td>
        </tr>
        <tr>
            <td>E-mail Address</td>
            <td colspan="8">
                @if ($isEdit)
                <input
                    name="email_address"
                    type="text"
                    value=""
                    placeholder="xyzcompany@gmail.com"
                >
                @else
                    {{ $email_address ?? '' }}
                @endif
            </td>
        </tr>
        <tr>
            <td>Year-Established</td>
            <td colspan="8">
                @if ($isEdit)
                <input
                    name="year_established"
                    type="text"
                    value=""
                    maxlength="4"
                    placeholder="2020"
                >
                @else
                    {{ $year_established ?? '' }}
                @endif
            </td>
        </tr>
        <tr>
            <td rowspan="3">Type of Organization<br>(please check appropriate box in each row)</td>
            <td>
                @if ($isEdit)
                <input
                    name="type_of_organization"
                    type="radio"
                    value="Single Proprietorship"
                >
                @else
                    {{ $type_of_organization == 'Single Proprietorship' ? '/' : '' }}
                @endif
                Single Proprietorship
            </td>
            <td>
                @if ($isEdit)
                <input
                    name="type_of_organization"
                    type="radio"
                    value="Partnership"
                >
                @else
                    {{ $type_of_organization == 'Partnership' ? '/' : '' }}
                @endif
                Partnership
            </td>
            <td>
                @if ($isEdit)
                <input
                    name="type_of_organization"
                    type="radio"
                    value="Cooperative"
                >
                @else
                    {{ $type_of_organization == 'Cooperative' ? '/' : '' }}
                @endif
                Cooperative
            </td>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="type_of_organization"
                    type="radio"
                    value="Corporation"
                >
                @else
                    {{ $type_of_organization == 'Corporation' ? '/' : '' }}
                @endif
                Corporation
            </td>
        </tr>
        <tr>
            <td>
                @if ($isEdit)
                <input
                    name="type_of_organization"
                    type="radio"
                    value="Profit"
                >
                @else
                    {{ $type_of_organization == 'Profit' ? '/' : '' }}
                @endif
                Profit
            </td>
            <td>
                @if ($isEdit)
                <input
                    name="type_of_organization"
                    type="radio"
                    value="Non-Profit"
                >
                @else
                    {{ $type_of_organization == 'Non-Profit' ? '/' : '' }}
                @endif
                Non-Profit
            </td>
            <td></td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td>
                @if ($isEdit)
                <input
                    name="size_of_organization"
                    type="radio"
                    value="Micro"
                >
                @else
                    {{ $size_of_organization == 'Micro' ? '/' : '' }}
                @endif
                Micro<br>(P3M Total Asset Value of less)
            </td>
            <td>
                @if ($isEdit)
                <input
                    name="size_of_organization"
                    type="radio"
                    value="Small"
                >
                @else
                    {{ $size_of_organization == 'Small' ? '/' : '' }}
                @endif
                Small<br>(P3,000,001.00 - P15M Total Asset Value)
            </td>
            <td>
                @if ($isEdit)
                <input
                    name="size_of_organization"
                    type="radio"
                    value="Medium"
                >
                Medium<br>(P15,000,001.00 - P100M Total Asset Value)
                @else
                    {{ $size_of_organization == 'Medium' ? '/' : '' }}
                @endif
            </td>
        </tr>
        <tr>
            <td rowspan="6">Number of Employee<br>(please indicate number of employee)</td>
            <td colspan="1">Type of Employment</td>
            <td>Male</td>
            <td>Female</td>
            <td colspan="2">Total</td>
        </tr>
        <tr>
            <td colspan="1">Direct Workers</td>
            <td>
                @if ($isEdit)
                <input
                    name="direct_workers_male"
                    type="text"
                    value=""
                >
                @else
                    {{ $direct_workers_male }}
                @endif
            </td>
            <td>
                @if ($isEdit)
                <input
                    name="direct_workers_female"
                    type="text"
                    value=""
                >
                @else
                    {{ $direct_workers_female }}
                @endif
            </td>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="direct_workers_total"
                    type="text"
                    value=""
                >
                @else
                    {{ $direct_workers_total }}
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="1">Production</td>
            <td>
                @if ($isEdit)
                <input
                    name="production_male"
                    type="text"
                    value=""
                >
                @else
                    {{ $production_male }}
                @endif
            </td>
            <td>
                @if ($isEdit)
                <input
                    name="production_female"
                    type="text"
                    value=""
                >
                @else
                    {{ $production_female }}
                @endif
            </td>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="production_total"
                    type="text"
                    value=""
                >
                @else
                    {{ $production_total }}
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="1">Non-Production</td>
            <td>
                @if ($isEdit)
                <input
                    name="non_production_male"
                    type="text"
                    value=""
                >
                @else
                    {{ $non_production_male }}
                @endif
            </td>
            <td>
                @if ($isEdit)
                <input
                    name="non_production_female"
                    type="text"
                    value=""
                >
                @else
                    {{ $non_production_female }}
                @endif
            </td>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="non_production_total"
                    type="text"
                    value=""
                >
                @else
                    {{ $non_production_total }}
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="1">Indirect/Contract Workers</td>
            <td>
                @if ($isEdit)
                <input
                    name="indirect_contract_workers_male"
                    type="text"
                    value=""
                >
                @else
                    {{ $indirect_contract_workers_male }}
                @endif
            </td>
            <td>
                @if ($isEdit)
                <input
                    name="indirect_contract_workers_female"
                    type="text"
                    value=""
                >
                @else
                    {{ $indirect_contract_workers_female }}
                @endif
            </td>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="indirect_contract_workers_total"
                    type="text"
                    value=""
                >
                @else
                    {{ $indirect_contract_workers_total }}
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="1">Total</td>
            <td>
                @if ($isEdit)
                <input
                    name="total_male"
                    type="text"
                    value=""
                >
                @else
                    {{ $total_male }}
                @endif
            </td>
            <td>
                @if ($isEdit)
                <input
                    name="total_female"
                    type="text"
                    value=""
                >
                @else
                    {{ $total_female }}
                @endif
            </td>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="total"
                    type="text"
                    value=""
                >
                @else
                    {{ $total }}
                @endif
            </td>
        </tr>
        <tr>
            <td rowspan="7"><b>Registration</b></td>
            <td colspan="1"><b>Office</b></td>
            <td><b>Registration Number</b></td>
            <td colspan="3"><b>Date of Registration</b></td>
        </tr>
        <tr>
            <td colspan="1">DTI</td>
            <td>
                @if ($isEdit)
                <input
                    name="dti_registration_number"
                    type="text"
                    value=""
                >
                @else
                    {{ $dti_registration_number }}
                @endif
            </td>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="dti_date_of_registration"
                    type="text"
                    value=""
                >
                @else
                    {{ $dti_date_of_registration }}
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="1">SEC</td>
            <td>
                @if ($isEdit)
                <input
                    name="sec_registration_number"
                    type="text"
                    value=""
                >
                @else
                    {{ $sec_registration_number }}
                @endif
            </td>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="sec_date_of_registration"
                    type="text"
                    value=""
                >
                @else
                    {{ $sec_date_of_registration }}
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="1">CDA</td>
            <td>
                @if ($isEdit)
                <input
                    name="cda_registration_number"
                    type="text"
                    value=""
                >
                @else
                    {{ $cda_registration_number }}
                @endif
            </td>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="cda_date_of_registration"
                    type="text"
                    value=""
                >
                @else
                    {{ $cda_date_of_registration }}
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="1">LGU</td>
            <td>
                @if ($isEdit)
                <input
                    name="lgu_registration_number"
                    type="text"
                    value=""
                ></td>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="lgu_date_of_registration"
                    type="text"
                    value=""
                >
                @else
                    {{ $lgu_date_of_registration }}
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="1">Others, please specify</td>
            <td></td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="1">
                @if ($isEdit)
                <input
                    name="others_name_of_firm"
                    type="text"
                    value=""
                >
                @else
                    {{ $others_name_of_firm }}
                @endif
            </td>
            <td>
                @if ($isEdit)
                <input
                    name="others_registration_number"
                    type="text"
                    value=""
                >
                @else
                    {{ $others_registration_number }}
                @endif
            </td>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="others_date_of_registration"
                    type="text"
                    value=""
                >
                @else
                    {{ $others_date_of_registration }}
                @endif
            </td>
        </tr>
        <tr>
            <td rowspan="10"><b>Business Activity/ies:</b><br>(please check appropriate box)</td>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="crop_animal_production_hunting_activity"
                    type="checkbox"
                    value="checked"
                >
                @else
                  {{ $crop_animal_production_hunting_activity == 'checked' ? '/' : '' }}
                @endif
                Crop and animal production, hunting, and related service activities
            </td>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="chemicals_manufacturing_activity"
                    type="checkbox"
                    value="checked"
                >
                @else
                  {{ $chemicals_manufacturing_activity == 'checked' ? '/' : '' }}
                @endif
                Chemicals and chemical products manufacturing
            </td>
        </tr>
        <tr>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="forestry_logging_activity"
                    type="checkbox"
                    value="checked"
                >
                @else
                  {{ $forestry_logging_activity == 'checked' ? '/' : '' }}
                @endif
                Forestry and Logging
            </td>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="pharmaceutical_manufacturing_activity"
                    type="checkbox"
                    value="checked"
                >
                @else
                  {{ $pharmaceutical_manufacturing_activity == 'checked' ? '/' : '' }}
                @endif
                Basic pharmaceutical products and pharmaceutical preparations manufacturing
            </td>
        </tr>
        <tr>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="fishing_agriculture_activity"
                    type="checkbox"
                    value="checked"
                >
                @else
                  {{ $fishing_and_agriculture_activity == 'checked' ? '/' : '' }}
                @endif
                Fishing and Agriculture
            </td>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="plastic_products_manufacturing_activity"
                    type="checkbox"
                    value="checked"
                >
                @else
                  {{ $plastic_products_manufacturing_activity == 'checked' ? '/' : '' }}
                @endif
                Rubber and plastic products manufacturing
            </td>
        </tr>
        <tr>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="food_processing_activity"
                    type="checkbox"
                    value="checked"
                >
                @else
                  {{ $food_processing_activity == 'checked' ? '/' : '' }}
                @endif
                Food Processing
            </td>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="non_metalllic_mineral_products_manufacturing_activity"
                    type="checkbox"
                    value="checked"
                >
                @else
                  {{ $nonmetallic_mineral_products_manufacturing == 'checked' ? '/' : '' }}
                @endif
                Non-metallic mineral products manufacturing
            </td>
        </tr>
        <tr>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="beverageManufacturing"
                    type="checkbox"
                    value="checked"
                >
                @else
                  {{ $beverage_manufacturing_activity == 'checked' ? '/' : '' }}
                @endif
                Beverage Manufacturing
            </td>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="fabricated_metal_products_manufacturing_activity"
                    type="checkbox"
                    value="checked"
                >
                @else
                  {{ $fabricated_metal_products_manufacturing_activity == 'checked' ? '/' : '' }}
                @endif
                Fabricated metal products manufacturing
            </td>
        </tr>
        <tr>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="textileManufacturing"
                    type="checkbox"
                    value="checked"
                >
                @else
                  {{ $textile_manufacturing_activity == 'checked' ? '/' : '' }}
                @endif
                Textile Manufacturing
            </td>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="machinery_and_equipment_not_elsewhere_classified_manufacturing"
                    type="checkbox"
                    value="checked"
                >
                Machinery and equipment, Not Elsewhere Classified (NEC) manufacturing
                @else
                  {{ $machinery_and_equipment_not_elsewhere_classified_manufacturing == 'checked' ? '/' : '' }}
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="wearing_apparel_manufacturing"
                    type="checkbox"
                    value="checked"
                >
                @else
                  {{ $wearing_apparel_manufacturing == 'checked' ? '/' : '' }}
                @endif
                Wearing apparel Manufacturing
            </td>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="other_transport_equipment_manufacturing"
                    type="checkbox"
                    value="checked"
                >
                @else
                  {{ $other_transport_equipment_manufacturing == 'checked' ? '/' : '' }}
                @endif
                Other transport equipment manufacturing
            </td>
        </tr>
        <tr>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="leather_and_related_products_manufacturing"
                    type="checkbox"
                    value="checked"
                >
                @else
                  {{ $leather_and_related_products_manufacturing == 'checked' ? '/' : '' }}
                @endif
                Leather and related products manufacturing
            </td>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="furniture_manufacturing"
                    type="checkbox"
                    value="checked"
                >
                @else
                  {{ $furniture_manufacturing == 'checked' ? '/' : '' }}
                @endif
                Furniture manufacturing
            </td>
        </tr>
        <tr>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="wood_and_products_of_wood_and_cork_manufacturing"
                    type="checkbox"
                    value="checked"
                >
                @else
                  {{ $wood_and_products_of_wood_and_cork_manufacturing == 'checked' ? '/' : '' }}
                @endif
                Wood and products of wood and cork manufacturing
            </td>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="information_and_communication_manufacturing"
                    type="checkbox"
                    value="checked"
                >
                @else
                  {{ $information_and_communication_manufacturing == 'checked' ? '/' : '' }}
                @endif
                Information and Communication manufacturing
            </td>
        </tr>
        <tr>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="paper_and_paper_products_manufacturing"
                    type="checkbox"
                    value="checked"
                >
                @else
                  {{ $paper_and_paper_products_manufacturing == 'checked' ? '/' : '' }}
                @endif
                Paper and paper products manufacturing
            </td>
            <td colspan="2">
                @if ($isEdit)
                <input
                    name="other_regional_priority_industries_approved_by_the_regional_development_council_please_specify"
                    type="checkbox"
                    value="checked"
                >
                @else
                  {{ $other_regional_priority_industries_approved_by_the_regional_development_council_please_specify == 'checked' ? '/' : '' }}
                @endif
                Other regional priority industries approved by the Regional Development Council, please specify:
            </td>
        </tr>
        <tr>
            <td><b>Products/Services</b></td>
            <td colspan="6">
                <textarea name="products_services"></textarea>
            </td>
        </tr>
        <tr>
            <td><b>Brief Enterprise Background</b></td>
            <td colspan="6">
                <textarea name="brief_enterprise_background"></textarea>
            </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td>
                <p class="section--title">B. Project Background</p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="section--sub-title">1. Organizational Chart</p>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">2. Skills and expertise of employee/owner (proponent)</p>
            </td>
        </tr>
        <tr>
            <td>
                <textarea name="skills_and_expertise"></textarea>
            </td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">3. Compensation</p>
            </td>
        </tr>
        <tr>
            <td>
                <textarea name="compensation"></textarea>
            </td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">C. Plant site or location (including vicinity map)</p>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">D. Capacity, volume and cost of production</p>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">E. Raw material/s used and sources of raw material</p>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
    </table>
    <table
        id="MarketAspectTable"
        width="100%"
    >
        <tr>
            <td>
                <p class="section--title">MARKETING ASPECTS</p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">A. Market situation, product demand and supply</p>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">B. Product specifications and product price</p>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">C. Distribution channel (local/export)</p>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">D. Competitors</p>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">E. Existing problems (if any)</p>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">F. Market plans/strategies</p>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
    </table>
    <table
        id="TechnicalAspectTable"
        width="100%"
    >
        <tr>
            <td>
                <p class="section--title">
                    TECHNOLOGICAL ASPECTS
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="section--sub-title">A. Production Process</p>
            </td>
        </tr>
        <tr>
            <td>- Process Flow of Production</td>
        </tr>
        <tr>
            <td>- Material Balance</td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">B. Existing Production Equipment</p>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">C. Technical constraints on the production line and proposed S&T
                    intervention</p>
            </td>
        </tr>
        <tr>
            <td>
                <table id="technicalConstraintTable">
                    <tr>
                        <td>Process/Existing Practice/Problem</th>
                        <td>Proposed S&T Intervention</td>
                        <td>Proposed S&T intervention-related equipment / skills upgrading</td>
                        <td>Impact</th>
                    </tr>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <p class="section--title">Proposed Plant Layout</p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">D. Cost and specifications of S&T Intervention-Related Equipment</p>
            </td>
        </tr>
        <tr>
            <td>
                <table id="equipmentTable">
                    <tr>
                        <td>S&T Intervention-related equipment/specification</td>
                        <td>Qty</td>
                        <td>Unit Cost</td>
                        <td>Total Cost</td>
                    </tr>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tr>
                        <td
                            class="bold"
                            colspan="3"
                        >Total</td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">E. List of equipment fabricators (name and address)</p>
            </td>
        </tr>
        <tr>
            <td>

            </td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">F. Schedule of activities for the proposed project</p>
            </td>
        </tr>
        <tr>
            <td>

            </td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">G. Expected Output/Impact (measured results)</p>
            </td>
        </tr>
        <tr>
            <td>
                <ol>
                    <li>Percentage increase in productivity</li>
                    <li>Improved quality of products</li>
                    <li>Contribution to the production line/process</li>
                    <li>Percentage decrease in rejects</li>
                    <li>Additional Clients</li>
                    <li>Others (please specify)</li>
                </ol>
            </td>
        </tr>

    </table>
    <table id="WasteManagementTable">
        <tr>
            <td>
                <p class="section--title">WASTE MANAGEMENT/DISPOSAL</p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">D. Volume of waste generated monthly</p>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">D. Kinds of wastes (plastics, paper, metals, chemicals, pollutants,
                    etc.)</p>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">D. Methods of disposal</p>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
    </table>
    <table id="FinancialAsspectTable">
        <tr>
            <td>
                <p class="section--title">FINANCIAL ASPECT</p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">A. Financial Capacity</p>
            </td>
        </tr>
        <tr>
            <td>
                <ul>
                    <li>Financial ratio and analysis</li>
                    <li>Partial Budget Analysis</li>
                    <li>Net profit margin ratio</li>
                    <li>Liquidity ratio</li>
                    <li>ROI</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">B. Financial Constraints</p>
            </td>
        </tr>
        <tr>
            <td>

            </td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">C. Cash flow/ financial statement/ balance sheet</p>
            </td>
        </tr>
        <tr>
            <td>

            </td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">D. Budgetary Requirement for the proposed project</p>
            </td>
        </tr>
        <tr>
            <td>
                <table id="budgetTable">
                    <tr>
                        <th>Item of Expenditure</th>
                        <th>Qty</th>
                        <th>Unit Cost</th>
                        <th>Cost</th>
                        <th>SETUP</th>
                        <th>LGIA</th>
                        <th>Cooperator</th>
                        <th>Total</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td
                            class="bold"
                            colspan="7"
                        >Total</td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <p class="section--sub--title">E. Proposed Refund Structure</p>
            </td>
        </tr>
        <tr>
            <td>
                <table id="refundStructureTable">
                    <tr>
                        <th>Months</th>
                        <th>Y1</th>
                        <th>Y2</th>
                        <th>Y3</th>
                        <th>Y4</th>
                        <th>Y5</th>
                        <th>Total</th>
                    </tr>
                    <tr>
                        <td>January</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>February</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>March</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>April</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>May</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>June</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>July</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>August</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>September</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>October</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>November</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>December</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="bold">Total</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table id="riskManagementPlanTable">
        <tr>
            <td>
                <p class="section--title">RISK MANAGEMENT</p>
            </td>
        </tr>
        <tr>
            <td>
                <table id="riskTable">
                    <tr>
                        <th>OBJECTIVES</th>
                        <th>RISKS AND ASSUMPTIONS</th>
                        <th>RISK MANAGEMENT PLAN</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
    <p>
        <strong>Note:</strong> Risk -- refers to an uncertain event or condition that its occurrence has a negative
        effect on the project.
    </p>
    <p>
        Assumption -- refers to an event or circumstance that its occurrence will lead to the success of the
        project.
    </p>
    <p>
        Risk Management Plan -- proposed activities to address the risks and assumptions.
    </p>
</div>
