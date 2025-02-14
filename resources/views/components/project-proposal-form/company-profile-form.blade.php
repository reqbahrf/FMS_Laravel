<table
    id="CompanyProfileTable"
    style="border-collapse: collapse; table-layout: fixed;"
    width="100%"
    border="1"
    cellpadding="5"
>
    <tr>
        <td width="15%"></td>
        <td width="5%"></td>
        <td width="15%"></td>
        <td width="5%"></td>
        <td width="15%"></td>
        <td width="5%"></td>
        <td width="15%"></td>
        <td width="5%"></td>
        <td width="20%"></td>
    </tr>
    <tr>
        <td colspan="9"><b>A. Company Profile</b></td>
    </tr>
    <tr>
        <td>Name of Firm</td>
        <td colspan="8">
            @if ($isEditable)
                <input
                    name="name_of_firm"
                    type="text"
                    value="{{ $name_of_firm ?? '' }}"
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
            @if ($isEditable)
                <input
                    name="address"
                    type="text"
                    value="{{ $address ?? '' }}"
                    placeholder="Purok 1, Barangay 1, City, Province"
                >
            @else
                {{ $address ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td>Contact Person</td>
        <td colspan="8">
            @if ($isEditable)
                <input
                    name="contact_person"
                    type="text"
                    value="{{ $contact_person ?? '' }}"
                    placeholder="John Doe"
                >
            @else
                {{ $contact_person ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td>Contact No.</td>
        <td colspan="8">
            @if ($isEditable)
                <input
                    name="contact_no"
                    type="text"
                    value="{{ $contact_no ?? '' }}"
                    placeholder="09123456789"
                >
            @else
                {{ $contact_no ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td>E-mail Address</td>
        <td colspan="8">
            @if ($isEditable)
                <input
                    name="email_address"
                    type="text"
                    value="{{ $email_address ?? '' }}"
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
            @if ($isEditable)
                <input
                    name="year_established"
                    type="text"
                    value="{{ $year_established ?? '' }}"
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
            @if ($isEditable)
                <input
                    name="type_of_organization"
                    type="radio"
                    value="Single Proprietorship"
                    {{ $type_of_organization ?? '' == 'Single Proprietorship' ? 'checked' : '' }}
                >
            @else
                {{ $type_of_organization ?? '' == 'Single Proprietorship' ? '/' : '' }}
            @endif
        </td>
        <td>Single Proprietorship</td>
        <td>
            @if ($isEditable)
                <input
                    name="type_of_organization"
                    type="radio"
                    value="Partnership"
                    {{ $type_of_organization ?? '' == 'Partnership' ? 'checked' : '' }}
                >
            @else
                {{ $type_of_organization ?? '' == 'Partnership' ? '/' : '' }}
            @endif
        </td>
        <td>Partnership</td>
        <td>
            @if ($isEditable)
                <input
                    name="type_of_organization"
                    type="radio"
                    value="Cooperative"
                    {{ $type_of_organization ?? '' == 'Cooperative' ? 'checked' : '' }}
                >
            @else
                {{ $type_of_organization ?? '' == 'Cooperative' ? '/' : '' }}
            @endif
        </td>
        <td>Cooperative</td>
        <td>
            @if ($isEditable)
                <input
                    name="type_of_organization"
                    type="radio"
                    value="Corporation"
                    {{ $type_of_organization ?? '' == 'Corporation' ? 'checked' : '' }}
                >
            @else
                {{ $type_of_organization ?? '' == 'Corporation' ? '/' : '' }}
            @endif
        </td>
        <td>Corporation</td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <input
                    name="profit_status"
                    type="radio"
                    value="Profit"
                    {{ $profit_status ?? '' == 'Profit' ? 'checked' : '' }}
                >
            @else
                {{ $profit_status ?? '' == 'Profit' ? '/' : '' }}
            @endif
        </td>
        <td>Profit</td>
        <td>
            @if ($isEditable)
                <input
                    name="profit_status"
                    type="radio"
                    value="Non-Profit"
                    {{ $profit_status ?? '' == 'Non-Profit' ? 'checked' : '' }}
                >
            @else
                {{ $profit_status ?? '' == 'Non-Profit' ? '/' : '' }}
            @endif
        </td>
        <td>Non-Profit</td>
        <td colspan="4"></td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <input
                    name="size_of_organization"
                    type="radio"
                    value="Micro"
                    {{ $size_of_organization ?? '' == 'Micro' ? 'checked' : '' }}
                >
            @else
                {{ $size_of_organization ?? '' == 'Micro' ? '/' : '' }}
            @endif
        </td>
        <td>Micro<br>(P3M Total Asset Value or less)</td>
        <td>
            @if ($isEditable)
                <input
                    name="size_of_organization"
                    type="radio"
                    value="Small"
                    {{ $size_of_organization ?? '' == 'Small' ? 'checked' : '' }}
                >
            @else
                {{ $size_of_organization ?? '' == 'Small' ? '/' : '' }}
            @endif
        </td>
        <td>Small<br>(P3,000,001.00 - P15M Total Asset Value)</td>
        <td>
            @if ($isEditable)
                <input
                    name="size_of_organization"
                    type="radio"
                    value="Medium"
                    {{ $size_of_organization ?? '' == 'Medium' ? 'checked' : '' }}
                >
            @else
                {{ $size_of_organization ?? '' == 'Medium' ? '/' : '' }}
            @endif
        </td>
        <td colspan="4">Medium<br>(P15,000,001.00 - P100M Total Asset Value)</td>
    </tr>
    <tr>
        <td rowspan="6">Number of Employee<br>(please indicate number of employee)</td>
        <td colspan="2">Type of Employment</td>
        <td colspan="2">Male</td>
        <td colspan="2">Female</td>
        <td colspan="3">Total</td>
    </tr>
    <tr>
        <td colspan="2">Direct Workers</td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="direct_workers_male"
                    type="text"
                    value="{{ $direct_workers_male ?? '' }}"
                >
            @else
                {{ $direct_workers_male ?? '' }}
            @endif
        </td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="direct_workers_female"
                    type="text"
                    value="{{ $direct_workers_female ?? '' }}"
                >
            @else
                {{ $direct_workers_female ?? '' }}
            @endif
        </td>
        <td colspan="3">
            @if ($isEditable)
                <input
                    name="direct_workers_total"
                    type="text"
                    value="{{ $direct_workers_total ?? '' }}"
                >
            @else
                {{ $direct_workers_total ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td colspan="2">Production</td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="production_male"
                    type="text"
                    value="{{ $production_male ?? '' }}"
                >
            @else
                {{ $production_male ?? '' }}
            @endif
        </td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="production_female"
                    type="text"
                    value="{{ $production_female ?? '' }}"
                >
            @else
                {{ $production_female ?? '' }}
            @endif
        </td>
        <td colspan="3">
            @if ($isEditable)
                <input
                    name="production_total"
                    type="text"
                    value="{{ $production_total ?? '' }}"
                >
            @else
                {{ $production_total ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td colspan="2">Non-Production</td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="non_production_male"
                    type="text"
                    value="{{ $non_production_male ?? '' }}"
                >
            @else
                {{ $non_production_male ?? '' }}
            @endif
        </td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="non_production_female"
                    type="text"
                    value="{{ $non_production_female ?? '' }}"
                >
            @else
                {{ $non_production_female ?? '' }}
            @endif
        </td>
        <td colspan="3">
            @if ($isEditable)
                <input
                    name="non_production_total"
                    type="text"
                    value="{{ $non_production_total ?? '' }}"
                >
            @else
                {{ $non_production_total ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td colspan="2">Indirect/Contract Workers</td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="indirect_contract_workers_male"
                    type="text"
                    value="{{ $indirect_contract_workers_male ?? '' }}"
                >
            @else
                {{ $indirect_contract_workers_male ?? '' }}
            @endif
        </td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="indirect_contract_workers_female"
                    type="text"
                    value="{{ $indirect_contract_workers_female ?? '' }}"
                >
            @else
                {{ $indirect_contract_workers_female ?? '' }}
            @endif
        </td>
        <td colspan="3">
            @if ($isEditable)
                <input
                    name="indirect_contract_workers_total"
                    type="text"
                    value="{{ $indirect_contract_workers_total ?? '' }}"
                >
            @else
                {{ $indirect_contract_workers_total ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td colspan="2">Total</td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="total_male"
                    type="text"
                    value="{{ $total_male ?? '' }}"
                >
            @else
                {{ $total_male ?? '' }}
            @endif
        </td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="total_female"
                    type="text"
                    value="{{ $total_female ?? '' }}"
                >
            @else
                {{ $total_female ?? '' }}
            @endif
        </td>
        <td colspan="3">
            @if ($isEditable)
                <input
                    name="total"
                    type="text"
                    value="{{ $total ?? '' }}"
                >
            @else
                {{ $total ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td
            rowspan="7"
            colspan="1"
        ><b>Registration</b></td>
        <td colspan="2"><b>Office</b></td>
        <td colspan="2"><b>Registration Number</b></td>
        <td colspan="4"><b>Date of Registration</b></td>
    </tr>
    <tr>
        <td colspan="2">DTI</td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="dti_registration_number"
                    type="text"
                    value="{{ $dti_registration_number ?? '' }}"
                >
            @else
                {{ $dti_registration_number ?? '' }}
            @endif
        </td>
        <td colspan="4">
            @if ($isEditable)
                <input
                    name="dti_date_of_registration"
                    type="text"
                    value="{{ $dti_date_of_registration ?? '' }}"
                >
            @else
                {{ $dti_date_of_registration ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td colspan="2">SEC</td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="sec_registration_number"
                    type="text"
                    value="{{ $sec_registration_number ?? '' }}"
                >
            @else
                {{ $sec_registration_number ?? '' }}
            @endif
        </td>
        <td colspan="4">
            @if ($isEditable)
                <input
                    name="sec_date_of_registration"
                    type="text"
                    value="{{ $sec_date_of_registration ?? '' }}"
                >
            @else
                {{ $sec_date_of_registration ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td colspan="2">CDA</td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="cda_registration_number"
                    type="text"
                    value="{{ $cda_registration_number ?? '' }}"
                >
            @else
                {{ $cda_registration_number ?? '' }}
            @endif
        </td>
        <td colspan="4">
            @if ($isEditable)
                <input
                    name="cda_date_of_registration"
                    type="text"
                    value="{{ $cda_date_of_registration ?? '' }}"
                >
            @else
                {{ $cda_date_of_registration ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td colspan="2">LGU</td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="lgu_registration_number"
                    type="text"
                    value="{{ $lgu_registration_number ?? '' }}"
                >
            @else
                {{ $lgu_registration_number ?? '' }}
            @endif
        </td>
        <td colspan="4">
            @if ($isEditable)
                <input
                    name="lgu_date_of_registration"
                    type="text"
                    value="{{ $lgu_date_of_registration ?? '' }}"
                >
            @else
                {{ $lgu_date_of_registration ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td colspan="2">Others, please specify</td>
        <td colspan="2"></td>
        <td colspan="4"></td>
    </tr>
    <tr>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="others_name_of_firm"
                    type="text"
                    value="{{ $others_name_of_firm ?? '' }}"
                >
            @else
                {{ $others_name_of_firm ?? '' }}
            @endif
        </td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="others_registration_number"
                    type="text"
                    value="{{ $others_registration_number ?? '' }}"
                >
            @else
                {{ $others_registration_number ?? '' }}
            @endif
        </td>
        <td colspan="4">
            @if ($isEditable)
                <input
                    name="others_date_of_registration"
                    type="text"
                    value="{{ $others_date_of_registration ?? '' }}"
                >
            @else
                {{ $others_date_of_registration ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td rowspan="10"><b>Business Activity/ies:</b><br>(please check appropriate box)</td>
        <td>
            @if ($isEditable)
                <input
                    name="crop_animal_production_hunting_activity"
                    type="checkbox"
                    value="checked"
                    @checked($crop_animal_production_hunting_activity ?? '' == 'checked')
                >
            @else
                {{ $crop_animal_production_hunting_activity ?? '' == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Crop and animal production, hunting, and related service activities
        </td>
        <td>
            @if ($isEditable)
                <input
                    name="chemicals_manufacturing_activity"
                    type="checkbox"
                    value="checked"
                    @checked($chemicals_manufacturing_activity ?? '' == 'checked')
                >
            @else
                {{ $chemicals_manufacturing_activity ?? '' == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Chemicals and chemical products manufacturing
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <input
                    name="forestry_logging_activity"
                    type="checkbox"
                    value="checked"
                    @checked($forestry_logging_activity ?? '' == 'checked')
                >
            @else
                {{ $forestry_logging_activity ?? '' == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Forestry and Logging
        </td>
        <td>
            @if ($isEditable)
                <input
                    name="pharmaceutical_manufacturing_activity"
                    type="checkbox"
                    value="checked"
                    @checked($pharmaceutical_manufacturing_activity ?? '' == 'checked')
                >
            @else
                {{ $pharmaceutical_manufacturing_activity ?? '' == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Basic pharmaceutical products and pharmaceutical preparations manufacturing
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <input
                    name="fishing_agriculture_activity"
                    type="checkbox"
                    value="checked"
                    @checked($fishing_and_agriculture_activity ?? '' == 'checked')
                >
            @else
                {{ $fishing_and_agriculture_activity ?? '' == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Fishing and Agriculture
        </td>
        <td>
            @if ($isEditable)
                <input
                    name="plastic_products_manufacturing_activity"
                    type="checkbox"
                    value="checked"
                    @checked($plastic_products_manufacturing_activity ?? '' == 'checked')
                >
            @else
                {{ $plastic_products_manufacturing_activity ?? '' == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Rubber and plastic products manufacturing
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <input
                    name="food_processing_activity"
                    type="checkbox"
                    value="checked"
                    @checked($food_processing_activity ?? '' == 'checked')
                >
            @else
                {{ $food_processing_activity ?? '' == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Food Processing
        </td>
        <td>
            @if ($isEditable)
                <input
                    name="non_metalllic_mineral_products_manufacturing_activity"
                    type="checkbox"
                    value="checked"
                    @checked($nonmetallic_mineral_products_manufacturing ?? '' == 'checked')
                >
            @else
                {{ $nonmetallic_mineral_products_manufacturing ?? '' == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Non-metallic mineral products manufacturing
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <input
                    name="beverage_manufacturing_activity"
                    type="checkbox"
                    value="checked"
                    @checked($beverage_manufacturing_activity ?? '' == 'checked')
                >
            @else
                {{ $beverage_manufacturing_activity ?? '' == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Beverage Manufacturing
        </td>
        <td>
            @if ($isEditable)
                <input
                    name="fabricated_metal_products_manufacturing_activity"
                    type="checkbox"
                    value="checked"
                    @checked($fabricated_metal_products_manufacturing_activity ?? '' == 'checked')
                >
            @else
                {{ $fabricated_metal_products_manufacturing_activity ?? '' == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Fabricated metal products manufacturing
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <input
                    name="textile_manufacturing_activity"
                    type="checkbox"
                    value="checked"
                    @checked($textile_manufacturing_activity ?? '' == 'checked')
                >
            @else
                {{ $textile_manufacturing_activity ?? '' == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Textile Manufacturing
        </td>
        <td>
            @if ($isEditable)
                <input
                    name="machinery_and_equipment_not_elsewhere_classified_manufacturing"
                    type="checkbox"
                    value="checked"
                    @checked($machinery_and_equipment_not_elsewhere_classified_manufacturing ?? '' == 'checked')
                >
            @else
                {{ $machinery_and_equipment_not_elsewhere_classified_manufacturing ?? '' == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Machinery and equipment, Not Elsewhere Classified (NEC) manufacturing
        </td>
    </tr>
    <tr>
        <td>

            @if ($isEditable)
                <input
                    name="wearing_apparel_manufacturing"
                    type="checkbox"
                    value="checked"
                    @checked($wearing_apparel_manufacturing ?? '' == 'checked')
                >
            @else
                {{ $wearing_apparel_manufacturing ?? '' == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Wearing apparel Manufacturing
        </td>
        <td>

            @if ($isEditable)
                <input
                    name="other_transport_equipment_manufacturing"
                    type="checkbox"
                    value="checked"
                    @checked($other_transport_equipment_manufacturing ?? '' == 'checked')
                >
            @else
                {{ $other_transport_equipment_manufacturing ?? '' == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Other transport equipment manufacturing
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <input
                    name="leather_and_related_products_manufacturing"
                    type="checkbox"
                    value="checked"
                    @checked($leather_and_related_products_manufacturing ?? '' == 'checked')
                >
            @else
                {{ $leather_and_related_products_manufacturing ?? '' == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Leather and related products manufacturing
        </td>
        <td>

            @if ($isEditable)
                <input
                    name="furniture_manufacturing"
                    type="checkbox"
                    value="checked"
                    @checked($furniture_manufacturing ?? '' == 'checked')
                >
            @else
                {{ $furniture_manufacturing ?? '' == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Furniture manufacturing
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <input
                    name="wood_and_products_of_wood_and_cork_manufacturing"
                    type="checkbox"
                    value="checked"
                    @checked($wood_and_products_of_wood_and_cork_manufacturing ?? '' == 'checked')
                >
            @else
                {{ $wood_and_products_of_wood_and_cork_manufacturing ?? '' == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Wood and products of wood and cork manufacturing
        </td>
        <td>
            @if ($isEditable)
                <input
                    name="information_and_communication_manufacturing"
                    type="checkbox"
                    value="checked"
                    @checked($information_and_communication_manufacturing ?? '' == 'checked')
                >
            @else
                {{ $information_and_communication_manufacturing ?? '' == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Information and Communication manufacturing
        </td>
    </tr>
    <tr>
        <td>

            @if ($isEditable)
                <input
                    name="paper_and_paper_products_manufacturing"
                    type="checkbox"
                    value="checked"
                    @checked($paper_and_paper_products_manufacturing ?? '' == 'checked')
                >
            @else
                {{ $paper_and_paper_products_manufacturing ?? '' == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Paper and paper products manufacturing
        </td>
        <td>

            @if ($isEditable)
                <input
                    name="other_regional_priority_industries_approved_by_the_regional_development_council_please_specify"
                    type="checkbox"
                    value="checked"
                    @checked($other_regional_priority_industries_approved_by_the_regional_development_council_please_specify ?? '' == 'checked')
                >
            @else
                {{ $other_regional_priority_industries_approved_by_the_regional_development_council_please_specify ?? '' == 'checked' ? '/' : '' }}
            @endif
        </td>

        <td colspan="3">
            Other regional priority industries approved by the Regional Development Council, please specify:
        </td>
    </tr>
    <!-- Continue with remaining business activities in similar pattern -->
    <tr>
        <td><b>Products/Services</b></td>
        <td colspan="8">
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="products_services"
                >{{ $products_services ?? '' }}</textarea>
            @else
                {{ $products_services ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td><b>Brief Enterprise Background</b></td>
        <td colspan="8">
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="brief_enterprise_background"
                >{{ $brief_enterprise_background ?? '' }}</textarea>
            @else
                {{ $brief_enterprise_background ?? '' }}
            @endif
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
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="skills_and_expertise"
                >{{ $skills_and_expertise ?? '' }}</textarea>
            @else
                {{ $skills_and_expertise ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td>
            <p class="section--sub--title">3. Compensation</p>
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="compensation"
                >{{ $compensation ?? '' }}</textarea>
            @else
                {{ $compensation ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td>
            <p class="section--sub--title">C. Plant site or location (including vicinity map)</p>
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="plant_site_or_location"
                >{{ $plant_site_or_location ?? '' }}</textarea>
            @else
                {{ $plant_site_or_location ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td>
            <p class="section--sub--title">D. Capacity, volume and cost of production</p>
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="capacity_volume_and_cost_of_production"
                >{{ $capacity_volume_and_cost_of_production ?? '' }}</textarea>
            @else
                {{ $capacity_volume_and_cost_of_production ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td>
            <p class="section--sub--title">E. Raw material/s used and sources of raw material</p>
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="raw_materials_used_and_sources_of_raw_material"
                >{{ $raw_materials_used_and_sources_of_raw_material ?? '' }}</textarea>
            @else
                {{ $raw_materials_used_and_sources_of_raw_material ?? '' }}
            @endif
        </td>
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
        <td>
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="market_situation_product_demand_and_supply"
                >{{ $market_situation_product_demand_and_supply ?? '' }}</textarea>
            @else
                {{ $market_situation_product_demand_and_supply ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td>
            <p class="section--sub--title">B. Product specifications and product price</p>
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="product_specifications_and_product_price"
                >{{ $product_specifications_and_product_price ?? '' }}</textarea>
            @else
                {{ $product_specifications_and_product_price ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td>
            <p class="section--sub--title">C. Distribution channel (local/export)</p>
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="distribution_channel_local_export"
                >{{ $distribution_channel_local_export ?? '' }}</textarea>
            @else
                {{ $distribution_channel_local_export ?? '' }}
            @endif
        </td>
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
        <td>
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="existing_problems_if_any"
                >{{ $existing_problems_if_any ?? '' }}</textarea>
            @else
                {{ $existing_problems_if_any ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td>
            <p class="section--sub--title">F. Market plans/strategies</p>
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="market_plans_strategies"
                >{{ $market_plans_strategies ?? '' }}</textarea>
            @else
                {{ $market_plans_strategies ?? '' }}
            @endif
        </td>
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
</table>
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
<table width="100%">
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
</table>
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
    <table>
    <tr>
        <td>
            <p class="section--sub--title">E. List of equipment fabricators (name and address)</p>
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="list_of_equipment_fabricators"
                >{{ $list_of_equipment_fabricators ?? '' }}</textarea>
            @else
                {{ $list_of_equipment_fabricators ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td>
            <p class="section--sub--title">F. Schedule of activities for the proposed project</p>
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="schedule_of_activities_for_proposed_project"
                >{{ $schedule_of_activities_for_proposed_project ?? '' }}</textarea>
            @else
                {{ $schedule_of_activities_for_proposed_project ?? '' }}
            @endif
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
        <td>
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="volume_of_waste_generated_monthly"
                >{{ $volume_of_waste_generated_monthly ?? '' }}</textarea>
            @else
                {{ $volume_of_waste_generated_monthly ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td>
            <p class="section--sub--title">D. Kinds of wastes (plastics, paper, metals, chemicals, pollutants,
                etc.)</p>
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="kinds_of_wastes"
                >{{ $kinds_of_wastes ?? '' }}</textarea>
            @else
                {{ $kinds_of_wastes ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="methods_of_disposal"
                >{{ $methods_of_disposal ?? '' }}</textarea>
            @else
                {{ $methods_of_disposal ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td>
            <p class="section--sub--title">E. List of equipment fabricators (name and address)</p>
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="list_of_equipment_fabricators"
                >{{ $list_of_equipment_fabricators ?? '' }}</textarea>
            @else
                {{ $list_of_equipment_fabricators ?? '' }}
            @endif
        </td>
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
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="financial_constraints"
                >{{ $financial_constraints ?? '' }}</textarea>
            @else
                {{ $financial_constraints ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td>
            <p class="section--sub--title">C. Cash flow/ financial statement/ balance sheet</p>
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="cash_flow_financial_statement_balance_sheet"
                >{{ $cash_flow_financial_statement_balance_sheet ?? '' }}</textarea>
            @else
                {{ $cash_flow_financial_statement_balance_sheet ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td>
            <p class="section--sub--title">D. Budgetary Requirement for the proposed project</p>
        </td>
    </tr>
</table>
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
<table>
    <tr>
        <td>
            <p class="section--sub--title">E. Proposed Refund Structure</p>
        </td>
    </tr>
</table>
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
                    <td><input
                            class="objects"
                            type="text"
                        ></td>
                    <td><input
                            class="risks-and-assumptions"
                            type="text"
                        ></td>
                    <td><input
                            class="risk-management-plan"
                            type="text"
                        ></td>
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
