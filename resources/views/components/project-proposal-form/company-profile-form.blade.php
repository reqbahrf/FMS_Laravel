@props(['isEditable', 'ProjectProposaldata'])
<table
    id="CompanyProfileTable"
    style="border-collapse: collapse; table-layout: fixed;"
    width="100%"
    cellpadding="5"
>
    <tr class="no-border">
        <td width="20%"></td>
        <td width="5%"></td>
        <td width="15%"></td>
        <td width="5%"></td>
        <td width="15%"></td>
        <td width="5%"></td>
        <td width="15%"></td>
        <td width="5%"></td>
        <td width="15%"></td>
    </tr>
    <tr>
        <td>Name of Firm</td>
        <td colspan="8">
            @if ($isEditable)
                <input
                    name="firm_name"
                    type="text"
                    value="{{ $ProjectProposaldata['firm_name'] ?? '' }}"
                    placeholder="XYZ Company"
                >
            @else
                {{ $ProjectProposaldata['firm_name'] ?? '' }}
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
                    value="{{ $ProjectProposaldata['address'] ?? '' }}"
                    placeholder="Purok 1, Barangay 1, City, Province"
                >
            @else
                {{ $ProjectProposaldata['address'] ?? '' }}
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
                    value="{{ $ProjectProposaldata['contact_person'] ?? '' }}"
                    placeholder="John Doe"
                >
            @else
                {{ $ProjectProposaldata['contact_person'] ?? '' }}
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
                    value="{{ $ProjectProposaldata['contact_no'] ?? '' }}"
                    placeholder="09123456789"
                >
            @else
                {{ $ProjectProposaldata['contact_no'] ?? '' }}
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
                    value="{{ $ProjectProposaldata['email_address'] ?? '' }}"
                    placeholder="xyzcompany@gmail.com"
                >
            @else
                {{ $ProjectProposaldata['email_address'] ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td>Year-Established</td>
        <td colspan="8">
            @if ($isEditable)
                <input
                    name="year_established"
                    data-year-input
                    type="text"
                    value="{{ $ProjectProposaldata['year_established'] ?? '' }}"
                    maxlength="4"
                    placeholder="2020"
                >
            @else
                {{ $ProjectProposaldata['year_established'] ?? '' }}
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
                    {{ $ProjectProposaldata['type_of_organization'] ?? '' == 'Single Proprietorship' ? 'checked' : '' }}
                >
            @else
                {{ $ProjectProposaldata['type_of_organization'] ?? '' == 'Single Proprietorship' ? '/' : '' }}
            @endif
        </td>
        <td>Single Proprietorship</td>
        <td>
            @if ($isEditable)
                <input
                    name="type_of_organization"
                    type="radio"
                    value="Partnership"
                    {{ $ProjectProposaldata['type_of_organization'] ?? '' == 'Partnership' ? 'checked' : '' }}
                >
            @else
                {{ $ProjectProposaldata['type_of_organization'] ?? '' == 'Partnership' ? '/' : '' }}
            @endif
        </td>
        <td>Partnership</td>
        <td>
            @if ($isEditable)
                <input
                    name="type_of_organization"
                    type="radio"
                    value="Cooperative"
                    {{ $ProjectProposaldata['type_of_organization'] ?? '' == 'Cooperative' ? 'checked' : '' }}
                >
            @else
                {{ $ProjectProposaldata['type_of_organization'] ?? '' == 'Cooperative' ? '/' : '' }}
            @endif
        </td>
        <td>Cooperative</td>
        <td>
            @if ($isEditable)
                <input
                    name="type_of_organization"
                    type="radio"
                    value="Corporation"
                    {{ $ProjectProposaldata['type_of_organization'] ?? '' == 'Corporation' ? 'checked' : '' }}
                >
            @else
                {{ $ProjectProposaldata['type_of_organization'] ?? '' == 'Corporation' ? '/' : '' }}
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
                    {{ $ProjectProposaldata['profit_status'] ?? '' == 'Profit' ? 'checked' : '' }}
                >
            @else
                {{ $ProjectProposaldata['profit_status'] ?? '' == 'Profit' ? '/' : '' }}
            @endif
        </td>
        <td>Profit</td>
        <td>
            @if ($isEditable)
                <input
                    name="profit_status"
                    type="radio"
                    value="Non-Profit"
                    {{ $ProjectProposaldata['profit_status'] ?? '' == 'Non-Profit' ? 'checked' : '' }}
                >
            @else
                {{ $ProjectProposaldata['profit_status'] ?? '' == 'Non-Profit' ? '/' : '' }}
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
                    {{ $ProjectProposaldata['size_of_organization'] ?? '' == 'Micro' ? 'checked' : '' }}
                >
            @else
                {{ $ProjectProposaldata['size_of_organization'] ?? '' == 'Micro' ? '/' : '' }}
            @endif
        </td>
        <td>Micro<br>(P3M Total Asset Value or less)</td>
        <td>
            @if ($isEditable)
                <input
                    name="size_of_organization"
                    type="radio"
                    value="Small"
                    {{ $ProjectProposaldata['size_of_organization'] ?? '' == 'Small' ? 'checked' : '' }}
                >
            @else
                {{ $ProjectProposaldata['size_of_organization'] ?? '' == 'Small' ? '/' : '' }}
            @endif
        </td>
        <td>Small<br>(P3,000,001.00 - P15M Total Asset Value)</td>
        <td>
            @if ($isEditable)
                <input
                    name="size_of_organization"
                    type="radio"
                    value="Medium"
                    {{ $ProjectProposaldata['size_of_organization'] ?? '' == 'Medium' ? 'checked' : '' }}
                >
            @else
                {{ $ProjectProposaldata['size_of_organization'] ?? '' == 'Medium' ? '/' : '' }}
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
                    data-custom-numeric-input
                    type="text"
                    value="{{ $ProjectProposaldata['direct_workers_male'] ?? '' }}"
                >
            @else
                {{ $ProjectProposaldata['direct_workers_male'] ?? '' }}
            @endif
        </td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="direct_workers_female"
                    data-custom-numeric-input
                    type="text"
                    value="{{ $ProjectProposaldata['direct_workers_female'] ?? '' }}"
                >
            @else
                {{ $ProjectProposaldata['direct_workers_female'] ?? '' }}
            @endif
        </td>
        <td colspan="3">
            @if ($isEditable)
                <input
                    name="direct_workers_total"
                    data-custom-numeric-input
                    type="text"
                    value="{{ $ProjectProposaldata['direct_workers_total'] ?? '' }}"
                    readonly
                >
            @else
                {{ $ProjectProposaldata['direct_workers_total'] ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td colspan="2">Production</td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="production_male"
                    data-custom-numeric-input
                    type="text"
                    value="{{ $ProjectProposaldata['production_male'] ?? '' }}"
                >
            @else
                {{ $ProjectProposaldata['production_male'] ?? '' }}
            @endif
        </td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="production_female"
                    data-custom-numeric-input
                    type="text"
                    value="{{ $ProjectProposaldata['production_female'] ?? '' }}"
                >
            @else
                {{ $ProjectProposaldata['production_female'] ?? '' }}
            @endif
        </td>
        <td colspan="3">
            @if ($isEditable)
                <input
                    name="production_total"
                    data-custom-numeric-input
                    type="text"
                    value="{{ $ProjectProposaldata['production_total'] ?? '' }}"
                    readonly
                >
            @else
                {{ $ProjectProposaldata['production_total'] ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td colspan="2">Non-Production</td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="non_production_male"
                    data-custom-numeric-input
                    type="text"
                    value="{{ $ProjectProposaldata['non_production_male'] ?? '' }}"
                >
            @else
                {{ $ProjectProposaldata['non_production_male'] ?? '' }}
            @endif
        </td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="non_production_female"
                    data-custom-numeric-input
                    type="text"
                    value="{{ $ProjectProposaldata['non_production_female'] ?? '' }}"
                >
            @else
                {{ $ProjectProposaldata['non_production_female'] ?? '' }}
            @endif
        </td>
        <td colspan="3">
            @if ($isEditable)
                <input
                    name="non_production_total"
                    data-custom-numeric-input
                    type="text"
                    value="{{ $ProjectProposaldata['non_production_total'] ?? '' }}"
                    readonly
                >
            @else
                {{ $ProjectProposaldata['non_production_total'] ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td colspan="2">Indirect/Contract Workers</td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="indirect_contract_workers_male"
                    data-custom-numeric-input
                    type="text"
                    value="{{ $ProjectProposaldata['indirect_contract_workers_male'] ?? '' }}"
                >
            @else
                {{ $ProjectProposaldata['indirect_contract_workers_male'] ?? '' }}
            @endif
        </td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="indirect_contract_workers_female"
                    data-custom-numeric-input
                    type="text"
                    value="{{ $ProjectProposaldata['indirect_contract_workers_female'] ?? '' }}"
                >
            @else
                {{ $ProjectProposaldata['indirect_contract_workers_female'] ?? '' }}
            @endif
        </td>
        <td colspan="3">
            @if ($isEditable)
                <input
                    name="indirect_contract_workers_total"
                    data-custom-numeric-input
                    type="text"
                    value="{{ $ProjectProposaldata['indirect_contract_workers_total'] ?? '' }}"
                    readonly
                >
            @else
                {{ $ProjectProposaldata['indirect_contract_workers_total'] ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td colspan="2">Total</td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="total_male"
                    data-custom-numeric-input
                    type="text"
                    value="{{ $ProjectProposaldata['total_male'] ?? '' }}"
                    readonly
                >
            @else
                {{ $ProjectProposaldata['total_male'] ?? '' }}
            @endif
        </td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="total_female"
                    data-custom-numeric-input
                    type="text"
                    value="{{ $ProjectProposaldata['total_female'] ?? '' }}"
                    readonly
                >
            @else
                {{ $ProjectProposaldata['total_female'] ?? '' }}
            @endif
        </td>
        <td colspan="3">
            @if ($isEditable)
                <input
                    name="employee_total"
                    data-custom-numeric-input
                    type="text"
                    value="{{ $ProjectProposaldata['employee_total'] ?? '' }}"
                    readonly
                >
            @else
                {{ $ProjectProposaldata['employee_total'] ?? '' }}
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
                    value="{{ $ProjectProposaldata['dti_registration_number'] ?? '' }}"
                >
            @else
                {{ $ProjectProposaldata['dti_registration_number'] ?? '' }}
            @endif
        </td>
        <td colspan="4">
            @if ($isEditable)
                <input
                    name="dti_date_of_registration"
                    type="date"
                    value="{{ $ProjectProposaldata['dti_date_of_registration'] ?? '' }}"
                >
            @else
                {{ $ProjectProposaldata['dti_date_of_registration'] ?? '' }}
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
                    value="{{ $ProjectProposaldata['sec_registration_number'] ?? '' }}"
                >
            @else
                {{ $ProjectProposaldata['sec_registration_number'] ?? '' }}
            @endif
        </td>
        <td colspan="4">
            @if ($isEditable)
                <input
                    name="sec_date_of_registration"
                    type="date"
                    value="{{ $ProjectProposaldata['sec_date_of_registration'] ?? '' }}"
                >
            @else
                {{ $ProjectProposaldata['sec_date_of_registration'] ?? '' }}
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
                    value="{{ $ProjectProposaldata['cda_registration_number'] ?? '' }}"
                >
            @else
                {{ $ProjectProposaldata['cda_registration_number'] ?? '' }}
            @endif
        </td>
        <td colspan="4">
            @if ($isEditable)
                <input
                    name="cda_date_of_registration"
                    type="date"
                    value="{{ $ProjectProposaldata['cda_date_of_registration'] ?? '' }}"
                >
            @else
                {{ $ProjectProposaldata['cda_date_of_registration'] ?? '' }}
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
                    value="{{ $ProjectProposaldata['lgu_registration_number'] ?? '' }}"
                >
            @else
                {{ $ProjectProposaldata['lgu_registration_number'] ?? '' }}
            @endif
        </td>
        <td colspan="4">
            @if ($isEditable)
                <input
                    name="lgu_date_of_registration"
                    type="date"
                    value="{{ $ProjectProposaldata['lgu_date_of_registration'] ?? '' }}"
                >
            @else
                {{ $ProjectProposaldata['lgu_date_of_registration'] ?? '' }}
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
                    value="{{ $ProjectProposaldata['others_name_of_firm'] ?? '' }}"
                >
            @else
                {{ $ProjectProposaldata['others_name_of_firm'] ?? '' }}
            @endif
        </td>
        <td colspan="2">
            @if ($isEditable)
                <input
                    name="others_registration_number"
                    type="text"
                    value="{{ $ProjectProposaldata['others_registration_number'] ?? '' }}"
                >
            @else
                {{ $ProjectProposaldata['others_registration_number'] ?? '' }}
            @endif
        </td>
        <td colspan="4">
            @if ($isEditable)
                <input
                    name="others_date_of_registration"
                    type="date"
                    value="{{ $ProjectProposaldata['others_date_of_registration'] ?? '' }}"
                >
            @else
                {{ $ProjectProposaldata['others_date_of_registration'] ?? '' }}
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
                    @checked(($ProjectProposaldata['crop_animal_production_hunting_activity'] ?? '') == 'checked')
                >
            @else
                {{ ($ProjectProposaldata['crop_animal_production_hunting_activity'] ?? '') == 'checked' ? '/' : '' }}
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
                    @checked(($ProjectProposaldata['chemicals_manufacturing_activity'] ?? '') == 'checked')
                >
            @else
                {{ ($ProjectProposaldata['chemicals_manufacturing_activity'] ?? '') == 'checked' ? '/' : '' }}
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
                    @checked(($ProjectProposaldata['forestry_logging_activity'] ?? '') == 'checked')
                >
            @else
                {{ ($ProjectProposaldata['forestry_logging_activity'] ?? '') == 'checked' ? '/' : '' }}
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
                    @checked(($ProjectProposaldata['pharmaceutical_manufacturing_activity'] ?? '') == 'checked')
                >
            @else
                {{ ($ProjectProposaldata['pharmaceutical_manufacturing_activity'] ?? '') == 'checked' ? '/' : '' }}
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
                    @checked(($ProjectProposaldata['fishing_and_agriculture_activity'] ?? '') == 'checked')
                >
            @else
                {{ ($ProjectProposaldata['fishing_and_agriculture_activity'] ?? '') == 'checked' ? '/' : '' }}
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
                    @checked(($ProjectProposaldata['plastic_products_manufacturing_activity'] ?? '') == 'checked')
                >
            @else
                {{ ($ProjectProposaldata['plastic_products_manufacturing_activity'] ?? '') == 'checked' ? '/' : '' }}
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
                    @checked(($ProjectProposaldata['food_processing_activity'] ?? '') == 'checked')
                >
            @else
                {{ ($ProjectProposaldata['food_processing_activity'] ?? '') == 'checked' ? '/' : '' }}
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
                    @checked(($ProjectProposaldata['non_metalllic_mineral_products_manufacturing_activity'] ?? '') == 'checked')
                >
            @else
                {{ ($ProjectProposaldata['non_metalllic_mineral_products_manufacturing_activity'] ?? '') == 'checked' ? '/' : '' }}
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
                    @checked(($ProjectProposaldata['beverage_manufacturing_activity'] ?? '') == 'checked')
                >
            @else
                {{ ($ProjectProposaldata['beverage_manufacturing_activity'] ?? '') == 'checked' ? '/' : '' }}
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
                    @checked(($ProjectProposaldata['fabricated_metal_products_manufacturing_activity'] ?? '') == 'checked')
                >
            @else
                {{ ($ProjectProposaldata['fabricated_metal_products_manufacturing_activity'] ?? '') == 'checked' ? '/' : '' }}
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
                    @checked(($ProjectProposaldata['textile_manufacturing_activity'] ?? '') == 'checked')
                >
            @else
                {{ ($ProjectProposaldata['textile_manufacturing_activity'] ?? '') == 'checked' ? '/' : '' }}
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
                    @checked(($ProjectProposaldata['machinery_and_equipment_not_elsewhere_classified_manufacturing'] ?? '') == 'checked')
                >
            @else
                {{ ($ProjectProposaldata['machinery_and_equipment_not_elsewhere_classified_manufacturing'] ?? '') == 'checked' ? '/' : '' }}
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
                    name="wearing_apparel_manufacturing_activity"
                    type="checkbox"
                    value="checked"
                    @checked(($ProjectProposaldata['wearing_apparel_manufacturing_activity'] ?? '') == 'checked')
                >
            @else
                {{ ($ProjectProposaldata['wearing_apparel_manufacturing_activity'] ?? '') == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Wearing apparel Manufacturing
        </td>
        <td>

            @if ($isEditable)
                <input
                    name="other_transport_equipment_manufacturing_activity"
                    type="checkbox"
                    value="checked"
                    @checked(($ProjectProposaldata['other_transport_equipment_manufacturing_activity'] ?? '') == 'checked')
                >
            @else
                {{ ($ProjectProposaldata['other_transport_equipment_manufacturing_activity'] ?? '') == 'checked' ? '/' : '' }}
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
                    name="leather_and_related_products_manufacturing_activity"
                    type="checkbox"
                    value="checked"
                    @checked(($ProjectProposaldata['leather_and_related_products_manufacturing_activity'] ?? '') == 'checked')
                >
            @else
                {{ ($ProjectProposaldata['leather_and_related_products_manufacturing_activity'] ?? '') == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Leather and related products manufacturing
        </td>
        <td>

            @if ($isEditable)
                <input
                    name="furniture_manufacturing_activity"
                    type="checkbox"
                    value="checked"
                    @checked(($ProjectProposaldata['furniture_manufacturing_activity'] ?? '') == 'checked')
                >
            @else
                {{ ($ProjectProposaldata['furniture_manufacturing_activity'] ?? '') == 'checked' ? '/' : '' }}
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
                    name="wood_and_products_of_wood_and_cork_manufacturing_activity"
                    type="checkbox"
                    value="checked"
                    @checked(($ProjectProposaldata['wood_and_products_of_wood_and_cork_manufacturing_activity'] ?? '') == 'checked')
                >
            @else
                {{ ($ProjectProposaldata['wood_and_products_of_wood_and_cork_manufacturing_activity'] ?? '') == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Wood and products of wood and cork manufacturing
        </td>
        <td>
            @if ($isEditable)
                <input
                    name="information_and_communication_manufacturing_activity"
                    type="checkbox"
                    value="checked"
                    @checked(($ProjectProposaldata['information_and_communication_manufacturing_activity'] ?? '') == 'checked')
                >
            @else
                {{ ($ProjectProposaldata['information_and_communication_manufacturing_activity'] ?? '') == 'checked' ? '/' : '' }}
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
                    name="paper_and_paper_products_manufacturing_activity"
                    type="checkbox"
                    value="checked"
                    @checked(($ProjectProposaldata['paper_and_paper_products_manufacturing_activity'] ?? '') == 'checked')
                >
            @else
                {{ ($ProjectProposaldata['paper_and_paper_products_manufacturing_activity'] ?? '') == 'checked' ? '/' : '' }}
            @endif
        </td>
        <td colspan="3">
            Paper and paper products manufacturing
        </td>
        <td>

            @if ($isEditable)
                <input
                    name="other_regional_priority_industries_approved_by_the_regional_development_council_please_specify_activity"
                    type="checkbox"
                    value="checked"
                    @checked(
                        ($ProjectProposaldata[
                            'other_regional_priority_industries_approved_by_the_regional_development_council_please_specify_activity'
                        ] ??
                            '') ==
                            'checked')
                >
            @else
                {{ ($ProjectProposaldata['other_regional_priority_industries_approved_by_the_regional_development_council_please_specify_activity'] ?? '') == 'checked' ? '/' : '' }}
            @endif
        </td>

        <td colspan="3">
            Other regional priority industries approved by the Regional Development Council, please specify: <br>
            @if ($isEditable)
                <input
                    name="other_regional_priority_industries_please_specify_activity"
                    type="text"
                    value="{{ $ProjectProposaldata['other_regional_priority_industries_please_specify_activity'] ?? '' }}"
                >
            @else
                {{ $ProjectProposaldata['other_regional_priority_industries_please_specify_activity'] ?? '' }}
            @endif
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
                >{{ $ProjectProposaldata['products_services'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['products_services'] ?? '' }}
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
                >{{ $ProjectProposaldata['brief_enterprise_background'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['brief_enterprise_background'] ?? '' }}
            @endif
        </td>
    </tr>
</table>
<table
    style="table-layout: fixed;"
    width="100%"
>
    <tr>
        <td style="width: 100%;">
            <p class="section--sub--title">B. Management/Administrative Aspect</p>
        </td>
    </tr>
    <tr>
        <td>
            <p class="section--sub--title">1. Organizational Chart</p>
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <div class="organizational-chart-image-upload">
                    <label
                        class="form-label"
                        for="organizationalChart"
                    >Upload Organizational Chart</label>
                    <input
                        id="organizationalChart"
                        name="organizationalChart"
                        type="file"
                    >
                    <input
                        id="OrganizationalChartFileID_Data_Handler"
                        name="OrganizationalChartFileID_Data_Handler"
                        type="hidden"
                    >
                </div>
            @endif
            <table style="width: 100%; table-layout: fixed;">
                <tbody>
                    <tr>
                        <td style="width: 100%; ">
                            @if (isset($organizationalChart['base64']) && isset($organizationalChart['mimeType']))
                                <img
                                    src="data:{{ $organizationalChart['mimeType'] }};base64,{{ $organizationalChart['base64'] }}"
                                    alt=""
                                    style="width: 16.17cm; height: 16.17cm; object-fit: contain; max-width: 100%; max-height: 100%;"
                                >
                            @else
                                <p
                                    style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;">
                                    <br>&nbsp;
                                </p>
                                <p>No image available</p>
                                <p
                                    style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;">
                                    <br>&nbsp;
                                </p>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

        </td>
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
                >{{ $ProjectProposaldata['skills_and_expertise'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['skills_and_expertise'] ?? '' }}
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
                >{{ $ProjectProposaldata['compensation'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['compensation'] ?? '' }}
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
                >{{ $ProjectProposaldata['plant_site_or_location'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['plant_site_or_location'] ?? '' }}
            @endif
            @if ($isEditable)
                <div class="plant-site-or-layout-image-upload">
                    <label
                        class="form-label"
                        for="plantSiteOrLocation"
                    >Upload Plant Site or Location</label>
                    <input
                        id="plantSiteOrLocation"
                        name="plantSiteOrLocation"
                        type="file"
                    >
                    <input
                        id="PlantSiteOrLocationFileID_Data_Handler"
                        name="PlantSiteOrLocationFileID_Data_Handler"
                        type="hidden"
                    >
                </div>
            @endif
            <table style="width: 100%; table-layout: fixed;">
                <tbody>
                    <tr>
                        <td style="width: 100%; ">
                            @if (isset($plantSiteOrLocation['base64']) && isset($plantSiteOrLocation['mimeType']))
                                <img
                                    src="data:{{ $plantSiteOrLocation['mimeType'] }};base64,{{ $plantSiteOrLocation['base64'] }}"
                                    alt=""
                                    style="width: 16.17cm; height: 16.17cm; object-fit: contain; max-width: 100%; max-height: 100%;"
                                >
                            @else
                                <p
                                    style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;">
                                    <br>&nbsp;
                                </p>
                                <p>No image available</p>
                                <p
                                    style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;">
                                    <br>&nbsp;
                                </p>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
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
                >{{ $ProjectProposaldata['capacity_volume_and_cost_of_production'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['capacity_volume_and_cost_of_production'] ?? '' }}
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
                >{{ $ProjectProposaldata['raw_materials_used_and_sources_of_raw_material'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['raw_materials_used_and_sources_of_raw_material'] ?? '' }}
            @endif
        </td>
    </tr>
</table>
<table
    id="MarketAspectTable"
    width="100%"
>
    <tr>
        <td
            class="section--title"
            style="font-weight: bold;"
        >
            MARKETING ASPECTS
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
                >{{ $ProjectProposaldata['market_situation_product_demand_and_supply'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['market_situation_product_demand_and_supply'] ?? '' }}
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
                >{{ $ProjectProposaldata['product_specifications_and_product_price'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['product_specifications_and_product_price'] ?? '' }}
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
                >{{ $ProjectProposaldata['distribution_channel_local_export'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['distribution_channel_local_export'] ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td>
            <p class="section--sub--title">D. Competitors</p>
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="competitors"
                >{{ $ProjectProposaldata['competitors'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['competitors'] ?? '' }}
            @endif
        </td>
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
                >{{ $ProjectProposaldata['existing_problems_if_any'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['existing_problems_if_any'] ?? '' }}
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
                >{{ $ProjectProposaldata['market_plans_strategies'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['market_plans_strategies'] ?? '' }}
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
            <p class="section--sub--title">A. Production Process</p>
        </td>
    </tr>
    <tr>
        <td
            class="section--sub--title"
            style="padding-left: 20pt;"
        >- Process Flow of Production</td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="process_flow_of_production"
                >{{ $ProjectProposaldata['process_flow_of_production'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['process_flow_of_production'] ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td
            class="section--sub--title"
            style="padding-left: 20pt;"
        >- Material Balance</td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="material_balance"
                >{{ $ProjectProposaldata['material_balance'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['material_balance'] ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td>
            <p class="section--sub--title">B. Existing Production Equipment</p>
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="existing_production_equipment"
                >{{ $ProjectProposaldata['existing_production_equipment'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['existing_production_equipment'] ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td>
            <p class="section--sub--title">C. Technical constraints on the production line and proposed S&T
                intervention</p>
        </td>
    </tr>
</table>
<div id="technicalConstraintTableContainer">
    @if ($isEditable)
        <div
            class="mb-3"
            style="text-align: right;"
        >
            <button
                class="btn btn-sm btn-success"
                id="addTechnicalConstraintRow"
                type="button"
            ><i class="ri-add-line"></i></button>
            <button
                class="btn btn-sm btn-danger"
                id="removeTechnicalConstraintRow"
                data-remove-row-btn
                type="button"
            ><i class="ri-subtract-line"></i></button>
        </div>
    @endif
    <table
        id="technicalConstraintTable"
        style="table-layout: fixed; width: 100%; border-collapse: collapse"
    >
        <thead>
            <tr>
                <td
                    style="text-align: center;"
                    width="25%"
                >Process/Existing Practice/Problem</th>
                <td
                    style="text-align: center;"
                    width="25%"
                >Proposed S&T Intervention</td>
                <td
                    style="text-align: center;"
                    width="25%"
                >Proposed S&T intervention-related equipment / skills upgrading</td>
                <td
                    style="text-align: center;"
                    width="25%"
                >Impact</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ProjectProposaldata['technicalConstraints'] ?? [] as $data)
                <tr>
                    <td>
                        @if ($isEditable)
                            <textarea class="form-control Process_existing_practice_problem">{{ $data['processExistingPracticeProblem'] ?? '' }}</textarea>
                        @else
                            {{ $data['processExistingPracticeProblem'] ?? '' }}
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <textarea class="form-control Proposed_s_t_intervention">{{ $data['proposedSTIntervention'] ?? '' }}</textarea>
                        @else
                            {{ $data['proposedSTIntervention'] ?? '' }}
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <textarea class="form-control Proposed_s_t_intervention_related_equipment_skills_upgrading">{{ $data['proposedSTInterventionRelatedEquipmentSkillsUpgrading'] ?? '' }}</textarea>
                        @else
                            {{ $data['proposedSTInterventionRelatedEquipmentSkillsUpgrading'] ?? '' }}
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <textarea class="form-control Impact">{{ $data['impact'] ?? '' }}</textarea>
                        @else
                            {{ $data['impact'] ?? '' }}
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td>
                        @if ($isEditable)
                            <textarea class="form-control Process_existing_practice_problem"></textarea>
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <textarea class="form-control Proposed_s_t_intervention"></textarea>
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <textarea class="form-control Proposed_s_t_intervention_related_equipment_skills_upgrading"></textarea>
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <textarea class="form-control Impact"></textarea>
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<table width="100%">
    <tr>
        <td
            class="section--title"
            style="font-weight: bold;"
        >
            Proposed Plant Layout
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <div class="proposed-plant-layout-image-upload">
                    <label
                        class="form-label"
                        for="proposedPlantLayout"
                    >Upload Proposed Plant Layout</label>
                    <input
                        id="proposedPlantLayout"
                        name="proposedPlantLayout"
                        type="file"
                    >
                    <input
                        id="ProposedPlantLayoutFileID_Data_Handler"
                        name="ProposedPlantLayoutFileID_Data_Handler"
                        type="hidden"
                    >
                </div>
            @endif
            <table style="width: 100%; table-layout: fixed;">
                <tbody>
                    <tr>
                        <td style="width: 100%; ">
                            @if (isset($proposedPlantLayout['base64']) && isset($proposedPlantLayout['mimeType']))
                                <img
                                    src="data:{{ $proposedPlantLayout['mimeType'] }};base64,{{ $proposedPlantLayout['base64'] }}"
                                    alt=""
                                    style="width: 16.17cm; height: 16.17cm; object-fit: contain; max-width: 100%; max-height: 100%;"
                                >
                            @else
                                <p
                                    style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;">
                                    <br>&nbsp;
                                </p>
                                <p>No image available</p>
                                <p
                                    style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;">
                                    <br>&nbsp;
                                </p>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <p class="section--sub--title">D. Cost and specifications of S&T Intervention-Related Equipment</p>
        </td>
    </tr>
</table>
<div id="equipmentTableContainer">
    @if ($isEditable)
        <div
            class="mb-3"
            style="text-align: right;"
        >
            <button
                class="btn btn-sm btn-success"
                id="addEquipmentRow"
                type="button"
            ><i class="ri-add-line"></i></button>
            <button
                class="btn btn-sm btn-danger"
                id="removeEquipmentRow"
                data-remove-row-btn
                type="button"
            ><i class="ri-subtract-line"></i></button>
        </div>
    @endif
    <table
        id="equipmentTable"
        style="table-layout: fixed; width: 100%; border-collapse: collapse"
    >
        @php
            $total_cost = 0;
        @endphp
        <thead>
            <tr>
                <td style="text-align: center; width: 50%">S&T Intervention-related equipment/specification</td>
                <td style="text-align: center; width: 10%">Qty</td>
                <td style="text-align: center; width: 20%">(₱)Unit Cost</td>
                <td style="text-align: center; width: 20%">(₱)Total Cost</td>
            </tr>
        </thead>
        <tbody>
            @forelse ($ProjectProposaldata['equipment'] ?? [] as $data)
                @php
                    $row_total_cost = floatval($data['qty'] ?? 0) * floatval($data['unit_cost'] ?? 0);
                    $total_cost += $row_total_cost;
                @endphp
                <tr>
                    <td>
                        @if ($isEditable)
                            <input
                                class="S_T_intervention_related_equipment"
                                data-custom-numeric-input
                                type="text"
                                value="{{ $data['stInterventionRelatedEquipment'] ?? '' }}"
                            >
                        @else
                            {{ $data['stInterventionRelatedEquipment'] ?? '' }}
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <input
                                class="Qty"
                                data-custom-numeric-input
                                type="text"
                                value="{{ $data['qty'] ?? '' }}"
                            >
                        @else
                            {{ $data['qty'] ?? '' }}
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <input
                                class="Unit_cost"
                                data-custom-numeric-input
                                type="text"
                                value="{{ $data['unitCost'] ?? '' }}"
                            >
                        @else
                            {{ $data['unitCost'] ?? '' }}
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <input
                                class="Total_cost"
                                data-custom-numeric-input
                                type="text"
                                value="{{ $data['totalCost'] ?? '' }}"
                            >
                        @else
                            {{ $data['totalCost'] ?? '' }}
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td>
                        @if ($isEditable)
                            <input
                                class="S_T_intervention_related_equipment"
                                type="text"
                            >
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <input
                                class="Qty"
                                data-custom-numeric-input
                                type="text"
                            >
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <input
                                class="Unit_cost"
                                data-custom-numeric-input
                                type="text"
                            >
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <input
                                class="Total_cost"
                                data-custom-numeric-input
                                type="text"
                            >
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td
                    class="bold"
                    colspan="3"
                >Total</td>
                <td>{{ number_format($total_cost, 2) }}</td>
            </tr>
        </tfoot>
    </table>
</div>
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
                >{{ $ProjectProposaldata['list_of_equipment_fabricators'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['list_of_equipment_fabricators'] ?? '' }}
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
                >{{ $ProjectProposaldata['schedule_of_activities_for_proposed_project'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['schedule_of_activities_for_proposed_project'] ?? '' }}
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
                <li>
                    Percentage increase in productivity<br>
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="percentage_increase_in_productivity"
                        >{{ $ProjectProposaldata['percentage_increase_in_productivity'] ?? '' }}</textarea>
                    @else
                        {{ $ProjectProposaldata['percentage_increase_in_productivity'] ?? '' }}
                    @endif

                </li>
                <li>
                    Improved quality of products<br>
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="improved_quality_of_products"
                        >{{ $ProjectProposaldata['improved_quality_of_products'] ?? '' }}</textarea>
                    @else
                        {{ $ProjectProposaldata['improved_quality_of_products'] ?? '' }}
                    @endif
                </li>
                <li>
                    Contribution to the production line/process<br>
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="contribution_to_production_line_process"
                        >{{ $ProjectProposaldata['contribution_to_production_line_process'] ?? '' }}</textarea>
                    @else
                        {{ $ProjectProposaldata['contribution_to_production_line_process'] ?? '' }}
                    @endif
                </li>
                <li>
                    Percentage decrease in rejects<br>
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="percentage_decrease_in_rejects"
                        >{{ $ProjectProposaldata['percentage_decrease_in_rejects'] ?? '' }}</textarea>
                    @else
                        {{ $ProjectProposaldata['percentage_decrease_in_rejects'] ?? '' }}
                    @endif
                </li>
                <li>
                    Additional Clients<br>
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="additional_clients"
                        >{{ $ProjectProposaldata['additional_clients'] ?? '' }}</textarea>
                    @else
                        {{ $ProjectProposaldata['additional_clients'] ?? '' }}
                    @endif
                </li>
                <li>
                    Others (please specify)<br>
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="others_please_specify"
                        >{{ $ProjectProposaldata['others_please_specify'] ?? '' }}</textarea>
                    @else
                        {{ $ProjectProposaldata['others_please_specify'] ?? '' }}
                    @endif
                </li>
            </ol>
        </td>
    </tr>
</table>
<table id="WasteManagementTable">
    <tr>
        <td
            class="section--title"
            style="font-weight: bold;"
        >
            WASTE MANAGEMENT/DISPOSAL
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
                >{{ $ProjectProposaldata['volume_of_waste_generated_monthly'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['volume_of_waste_generated_monthly'] ?? '' }}
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
                >{{ $ProjectProposaldata['kinds_of_wastes'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['kinds_of_wastes'] ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td>
            <p class="section--sub--title">D. Methods of disposal</p>
        </td>
    </tr>
    <tr>
        <td>
            @if ($isEditable)
                <textarea
                    class="form-control"
                    name="methods_of_disposal"
                >{{ $ProjectProposaldata['methods_of_disposal'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['methods_of_disposal'] ?? '' }}
            @endif
        </td>
    </tr>
</table>
<table id="FinancialAsspectTable">
    <tr>
        <td
            class="section--title"
            style="font-weight: bold;"
        >
            FINANCIAL ASPECT
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
                <li>Financial ratio and analysis
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="financial_ratio_and_analysis"
                        >{{ $ProjectProposaldata['financial_ratio_and_analysis'] ?? '' }}</textarea>
                    @else
                        {{ $ProjectProposaldata['financial_ratio_and_analysis'] ?? '' }}
                    @endif
                </li>
                <li>Partial Budget Analysis
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="partial_budget_analysis"
                        >{{ $ProjectProposaldata['partial_budget_analysis'] ?? '' }}</textarea>
                    @else
                        {{ $ProjectProposaldata['partial_budget_analysis'] ?? '' }}
                    @endif
                </li>
                <li>Net profit margin ratio
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="net_profit_margin_ratio"
                        >{{ $ProjectProposaldata['net_profit_margin_ratio'] ?? '' }}</textarea>
                    @else
                        {{ $ProjectProposaldata['net_profit_margin_ratio'] ?? '' }}
                    @endif
                </li>
                <li>Liquidity ratio
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="liquidity_ratio"
                        >{{ $ProjectProposaldata['liquidity_ratio'] ?? '' }}</textarea>
                    @else
                        {{ $ProjectProposaldata['liquidity_ratio'] ?? '' }}
                    @endif
                </li>
                <li>ROI
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="roi"
                        >{{ $ProjectProposaldata['roi'] ?? '' }}</textarea>
                    @else
                        {{ $ProjectProposaldata['roi'] ?? '' }}
                    @endif
                </li>
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
                >{{ $ProjectProposaldata['financial_constraints'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['financial_constraints'] ?? '' }}
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
                >{{ $ProjectProposaldata['cash_flow_financial_statement_balance_sheet'] ?? '' }}</textarea>
            @else
                {{ $ProjectProposaldata['cash_flow_financial_statement_balance_sheet'] ?? '' }}
            @endif
        </td>
    </tr>
    <tr>
        <td>
            <p class="section--sub--title">D. Budgetary Requirement for the proposed project</p>
        </td>
    </tr>
</table>
<div id="budgetTableContainer">
    @if ($isEditable)
        <div
            class="mb-3"
            style="text-align: right;"
        >
            <button
                class="btn btn-sm btn-success"
                id="addBudgetRow"
                type="button"
            ><i class="ri-add-line"></i></button>
            <button
                class="btn btn-sm btn-danger"
                id="removeBudgetRow"
                data-remove-row-btn
                type="button"
            ><i class="ri-subtract-line"></i></button>
        </div>
    @endif
    <table
        id="budgetTable"
        style="width: 100%; table-layout: fixed;"
    >
        <thead>

            <tr class="no-border">
                <td width="20%"></td>
                <td width="5%"></td>
                <td width="10%"></td>
                <td width="10%"></td>
                <td width="10%"></td>
                <td width="10%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
            </tr>
            <tr>
                <td>Item of Expenditure</td>
                <td>Qty</td>
                <td>Unit Cost</td>
                <td
                    style="text-align: center"
                    colspan="5"
                >Cost</td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>SETUP</td>
                <td>LGIA</td>
                <td>Cooperator</td>
                <td colspan="2">Total</td>
            </tr>
        </thead>
        <tbody>
            @php
                $total_SETUP = 0;
                $total_LGIA = 0;
                $total_Cooperator = 0;
                $grand_total = 0;
            @endphp
            @forelse ($ProjectProposaldata['budget'] ?? [] as $data)
                @php
                    $row_SETUP = floatval($data['setupCost'] ?? 0);
                    $row_LGIA = floatval($data['lgiaCost'] ?? 0);
                    $row_Cooperator = floatval($data['cooperatorCost'] ?? 0);
                    $row_total_cost = $row_SETUP + $row_LGIA + $row_Cooperator;

                    $total_SETUP += $row_SETUP;
                    $total_LGIA += $row_LGIA;
                    $total_Cooperator += $row_Cooperator;
                    $grand_total += $row_total_cost;
                @endphp
                <tr>
                    <td>
                        @if ($isEditable)
                            <input
                                class="Item_of_expenditure"
                                type="text"
                                value="{{ $data['itemOfExpenditure'] ?? '' }}"
                            >
                        @else
                            {{ $data['itemOfExpenditure'] ?? '' }}
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <input
                                class="Qty"
                                type="text"
                                value="{{ $data['qty'] ?? '' }}"
                            >
                        @else
                            {{ $data['qty'] ?? '' }}
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <input
                                class="Unit_cost"
                                type="text"
                                value="{{ $data['unitCost'] ?? '' }}"
                            >
                        @else
                            {{ $data['unitCost'] ?? '' }}
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <input
                                class="SETUP"
                                data-custom-numeric-input
                                type="text"
                                value="{{ $data['setupCost'] ?? '' }}"
                            >
                        @else
                            {{ $data['setupCost'] ?? '' }}
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <input
                                class="LGIA"
                                data-custom-numeric-input
                                type="text"
                                value="{{ $data['lgiaCost'] ?? '' }}"
                            >
                        @else
                            {{ $data['lgiaCost'] ?? '' }}
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <input
                                class="Cooperator"
                                data-custom-numeric-input
                                type="text"
                                value="{{ $data['cooperatorCost'] ?? '' }}"
                            >
                        @else
                            {{ $data['cooperatorCost'] ?? '' }}
                        @endif
                    </td>
                    <td colspan="2">
                        @if ($isEditable)
                            <input
                                class="Total_cost"
                                data-custom-numeric-input
                                type="text"
                                value="{{ $data['totalCost'] ?? '' }}"
                            >
                        @else
                            {{ $data['totalCost'] ?? '' }}
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td>
                        @if ($isEditable)
                            <input
                                class="Item_of_expenditure"
                                type="text"
                                value=""
                            >
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <input
                                class="Qty"
                                data-custom-numeric-input
                                type="text"
                                value=""
                            >
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <input
                                class="Unit_cost"
                                data-custom-numeric-input
                                type="text"
                                value=""
                            >
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <input
                                class="SETUP"
                                data-custom-numeric-input
                                type="text"
                                value=""
                            >
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <input
                                class="LGIA"
                                data-custom-numeric-input
                                type="text"
                                value=""
                            >
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <input
                                class="Cooperator"
                                data-custom-numeric-input
                                type="text"
                                value=""
                            >
                        @endif
                    </td>
                    <td colspan="2">
                        @if ($isEditable)
                            <input
                                class="Total_cost"
                                data-custom-numeric-input
                                type="text"
                                value=""
                            >
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td
                    class="bold"
                    colspan="3"
                >Total</td>
                <td>{{ number_format($total_SETUP, 2) }}</td>
                <td>{{ number_format($total_LGIA, 2) }}</td>
                <td>{{ number_format($total_Cooperator, 2) }}</td>
                <td colspan="2">{{ number_format($grand_total, 2) }}</td>
            </tr>
        </tfoot>
    </table>
</div>
<table>
    <tr>
        <td>
            <p class="section--sub--title">E. Proposed Refund Structure</p>
        </td>
    </tr>
</table>
@if ($isEditable)
    <div style="display: flex; align-items: center; margin-bottom: 1rem; justify-content: space-between; gap: 1rem;">
        <label
            for="fund_released_date"
            style="margin-right: 1rem;"
        >Fund Release Date:
            <input
                id="fund_released_date"
                name="fund_released_date"
                type="date"
                value="{{ $ProjectProposaldata['fund_released_date'] ?? '' }}"
            >
        </label>
        <label
            for="refund_duration"
            style="margin-right: 1rem;"
        >Refund Duration:
            <input
                id="refund_duration"
                name="refund_duration"
                type="number"
                value="{{ $ProjectProposaldata['refundDuration'] ?? 3 }}"
                min="1"
                max="5"
            >
        </label>
        <button
            class="btn btn-primary"
            id="calculateRefundStructure"
            type="button"
        >Calculate</button>
    </div>
@endif
<table
    id="refundStructureTable"
    style="width: 100%; table-layout: fixed;"
>
    @php
        use App\Services\NumberFormatterService as NF;
        use App\Services\StructurePaymentYearService as SY;

        $totals = SY::calculateTotals($ProjectProposaldata);

        $january_total = NF::parseFormattedNumber($ProjectProposaldata['January_total'] ?? '');
        $february_total = NF::parseFormattedNumber($ProjectProposaldata['February_total'] ?? '');
        $march_total = NF::parseFormattedNumber($ProjectProposaldata['March_total'] ?? '');
        $april_total = NF::parseFormattedNumber($ProjectProposaldata['April_total'] ?? '');
        $may_total = NF::parseFormattedNumber($ProjectProposaldata['May_total'] ?? '');
        $june_total = NF::parseFormattedNumber($ProjectProposaldata['June_total'] ?? '');
        $july_total = NF::parseFormattedNumber($ProjectProposaldata['July_total'] ?? '');
        $august_total = NF::parseFormattedNumber($ProjectProposaldata['August_total'] ?? '');
        $september_total = NF::parseFormattedNumber($ProjectProposaldata['September_total'] ?? '');
        $october_total = NF::parseFormattedNumber($ProjectProposaldata['October_total'] ?? '');
        $november_total = NF::parseFormattedNumber($ProjectProposaldata['November_total'] ?? '');
        $december_total = NF::parseFormattedNumber($ProjectProposaldata['December_total'] ?? '');

        $y1_total = $totals['y1_total'];
        $y2_total = $totals['y2_total'];
        $y3_total = $totals['y3_total'];
        $y4_total = $totals['y4_total'];
        $y5_total = $totals['y5_total'];
        $grand_total = $totals['grand_total'];

        $months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ];
    @endphp
    <tbody>
        <tr class="no-border">
            <td width="14.3%"></td>
            <td width="14.3%"></td>
            <td width="14.3%"></td>
            <td width="14.3%"></td>
            <td width="14.3%"></td>
            <td width="14.3%"></td>
            <td width="14.3%"></td>
        </tr>

        <tr>
            <th style="text-align: center;">Months</th>
            @php
                $fundReleaseYear = isset($ProjectProposaldata['fund_released_date'])
                    ? date('Y', strtotime($ProjectProposaldata['fund_released_date']))
                    : null;
                $yearHeaders = $fundReleaseYear
                    ? range($fundReleaseYear + 1, $fundReleaseYear + 5)
                    : ['Y1', 'Y2', 'Y3', 'Y4', 'Y5'];
            @endphp
            @foreach ($yearHeaders as $year)
                <th style="text-align: center;">{{ $year }}</th>
            @endforeach
            <th style="text-align: center;">Total</th>
        </tr>
        @foreach ($months as $month)
            <tr>
                <td>{{ ucfirst($month) }}</td>
                @for ($year = 1; $year <= 5; $year++)
                    <td>
                        @if ($isEditable)
                            <input
                                class="{{ $month }}_Y{{ $year }}"
                                name="{{ $month }}_Y{{ $year }}"
                                data-custom-numeric-input
                                type="text"
                                value="{{ $ProjectProposaldata[$month . '_Y' . $year] ?? '' }}"
                            >
                        @else
                            {{ $ProjectProposaldata[$month . '_Y' . $year] ?? '' }}
                        @endif
                    </td>
                @endfor
                <td>
                    @if ($isEditable)
                        <input
                            class="{{ $month }}_total"
                            name="{{ $month }}_total"
                            data-custom-numeric-input
                            type="text"
                            value="{{ $ProjectProposaldata[$month . '_total'] ?? '' }}"
                        >
                    @else
                        {{ $ProjectProposaldata[$month . '_total'] ?? '' }}
                    @endif
                </td>
            </tr>
        @endforeach
        <tr>
            <td class="bold">Total</td>
            <td>{{ $y1_total }}</td>
            <td>{{ $y2_total }}</td>
            <td>{{ $y3_total }}</td>
            <td>{{ $y4_total }}</td>
            <td>{{ $y5_total }}</td>
            <td>{{ $grand_total }}</td>
        </tr>
    </tbody>
</table>
<table id="riskManagementPlanTable">
    <tr>
        <td
            class="section--title"
            style="font-weight: bold;"
        >
            RISK MANAGEMENT
        </td>
    </tr>
</table>
<div id="riskTableContainer">
    @if ($isEditable)
        <div
            class="mb-3"
            style="text-align: right;"
        >
            <button
                class="btn btn-sm btn-success"
                id="addRiskRow"
                type="button"
            ><i class="ri-add-line"></i></button>
            <button
                class="btn btn-sm btn-danger"
                id="removeRiskRow"
                data-remove-row-btn
                type="button"
            ><i class="ri-subtract-line"></i></button>
        </div>
    @endif
    <table
        id="riskTable"
        style="table-layout: fixed; width: 100%; border-collapse: collapse"
    >
        <tr>
            <th style="text-align: center; width: 33.33%; font-weight: bold;">OBJECTIVES</th>
            <th style="text-align: center; width: 33.33%; font-weight: bold;">RISKS AND ASSUMPTIONS</th>
            <th style="text-align: center; width: 33.33%; font-weight: bold;">RISK MANAGEMENT PLAN</th>
        </tr>
        <tbody>
            @forelse ($ProjectProposaldata['riskManagement'] ?? [] as $data)
                <tr>
                    <td>
                        @if ($isEditable)
                            <textarea
                                class="Objectives  form-control"
                                type="text"
                            > {{ $data['objectives'] ?? '' }}</textarea>
                        @else
                            {{ $data['objectives'] ?? '' }}
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <textarea
                                class="Risks_and_assumptions  form-control"
                                type="text"
                            >  {{ $data['risksAndAssumptions'] ?? '' }}</textarea>
                        @else
                            {{ $data['risksAndAssumptions'] ?? '' }}
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <textarea
                                class="Risk_management_plan  form-control"
                                type="text"
                            >  {{ $data['riskManagementPlan'] ?? '' }}</textarea>
                        @else
                            {{ $data['riskManagementPlan'] ?? '' }}
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td>
                        @if ($isEditable)
                            <textarea
                                class="Objectives  form-control"
                                type="text"
                            ></textarea>
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <textarea
                                class="Risks_and_assumptions  form-control"
                                type="text"
                            ></textarea>
                        @endif
                    </td>
                    <td>
                        @if ($isEditable)
                            <textarea
                                class="Risk_management_plan form-control"
                                type="text"
                            ></textarea>
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
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
