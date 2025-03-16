@props(['projectInfoSheetData', 'isEditable', 'isExporting' => false])
<div id="formWrapper">
    @if (!$isExporting)
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
    @endif
    <form
        class="mt-3"
        id="projectInfoSheetForm"
        @if ($isEditable) action="{{ URL::signedRoute('staff.Project.set.information-sheet', [
            'projectId' => $projectInfoSheetData['project_info_id'],
            'applicationId' => $projectInfoSheetData['application_info_id'],
            'businessId' => $projectInfoSheetData['business_info_id'],
            'forYear' => $projectInfoSheetData['for_period'],
        ]) }}" @endif
    >
        <div class="tg-wrap">
            <table
                class="tg"
                id="dataSheetTable"
                style="overflow: hidden"
                autosize="1"
            >
                <tbody>
                    <tr>
                        <td
                            class="tg-hvke"
                            style="border: none;"
                            colspan="5"
                        ></td>
                        <td
                            class="tg-7zrl"
                            style="text-align: left; border: none;"
                        >For the Period:
                            {{ $projectInfoSheetData['for_period'] }}</td>
                    </tr>
                    <tr>
                        <td
                            class="tg-hvke"
                            colspan="5"
                        >Project title:</td>
                        <td class="tg-j6zm ">Project Code</td>
                    </tr>
                    <tr>
                        <td
                            class="tg-8d8j"
                            colspan="5"
                        >
                            <strong>
                                <x-custom-input.input
                                    name="projectTitle"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$projectInfoSheetData['projectTitle'] ?? ''"
                                />
                            </strong>
                        </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-j6zm"
                            colspan="5"
                        >Name of Firm:
                            <x-custom-input.input
                                name="firmName"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['firmName'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl"></td>
                    </tr>
                    <tr>
                        <td
                            class="tg-7zrl"
                            colspan="4"
                        >Owner: Contact Person:</td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-7zrl"
                            colspan="3"
                        >Name:
                            <x-custom-input.input
                                name="name"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['name'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl">sex:
                            <x-custom-input.input
                                name="sex"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['sex'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl">Age:
                            <x-custom-input.input
                                name="age"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['age'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-j6zm"
                            colspan="5"
                        >Type of Organization Enterprize:</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-8d8j"
                            colspan="5"
                        >
                            <x-custom-input.input
                                name="typeOfOrganization"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['typeOfOrganization'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-j6zm"
                            colspan="5"
                        >Business Address:</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-8d8j"
                            colspan="4"
                        ><x-custom-input.input
                                name="businessAddress"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['businessAddress'] ?? ''"
                            /></td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-j6zm">Contact Details: </td>
                        <td class="tg-7zrl">Landline:
                            <x-custom-input.input
                                name="landline"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['landline'] ?? ''"
                            />
                        </td>
                        <td
                            class="tg-7zrl"
                            colspan="3"
                        >Fax: <x-custom-input.input
                                name="fax"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['fax'] ?? ''"
                            /> </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-7zrl"
                            colspan="2"
                        >Mobile Phone:
                            <x-custom-input.input
                                name="mobile_phone"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['mobile_phone'] ?? ''"
                            />
                        </td>
                        <td
                            class="tg-7zrl"
                            colspan="3"
                        >Email Address:
                            <x-custom-input.input
                                name="email"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['email'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-j6zm"
                            colspan="2"
                        >Total Assets</td>
                        <td
                            class="tg-bobw"
                            colspan="3"
                        > &nbsp;&nbsp;₱
                            <x-custom-input.input
                                id="totalAssests"
                                name="totalAssets"
                                type="text"
                                style="width: 90%;"
                                :isEditable="$isEditable"
                                readonly
                                :value="$projectInfoSheetData['totalAssets'] ?? ''"
                            />
                        </td>
                        <td
                            class="tg-8d8j"
                            rowspan="5"
                        > <br><br><br><br></td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl">Land</td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
                        >&nbsp;&nbsp;₱
                            <x-custom-input.input
                                id="land_val"
                                name="land"
                                type="text"
                                style="width: 90%;"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['land'] ?? ''"
                            />
                        </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl">Building </td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
                        > &nbsp;&nbsp;₱
                            <x-custom-input.input
                                id="building_val"
                                name="building"
                                type="text"
                                style="width: 90%;"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['building'] ?? ''"
                            />
                        </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl">Equiment </td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
                        > &nbsp;&nbsp;₱
                            <x-custom-input.input
                                id="equipment_val"
                                name="equipment"
                                type="text"
                                style="width: 90%;"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['equipment'] ?? ''"
                            />
                        </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl">Working Capital</td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
                        >&nbsp;&nbsp;₱
                            <x-custom-input.input
                                id="workingCapital_val"
                                name="workingCapital"
                                type="text"
                                style="width: 90%;"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['workingCapital'] ?? ''"
                            />
                        </td>
                    </tr>
                    <tr class="employment--inputs">
                        <td
                            class="tg-wa1i"
                            colspan="2"
                        >Total&nbsp;&nbsp;&nbsp;Employment Generated
                        </td>
                        <td
                            class="tg-wa1i"
                            colspan="3"
                        ><x-custom-input.input
                                id="TotalmanMonths"
                                name="TotalmanMonths"
                                type="text"
                                readonly
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['TotalmanMonths'] ?? ''"
                            />&nbsp;&nbsp;man-mouth</td>
                        <td
                            class="tg-8d8j"
                            colspan="1"
                        ><br /><br /></td>
                    </tr>
                    <tr class="employment--inputs">
                        <td
                            class="tg-7zrl"
                            colspan="5"
                        >Direct&nbsp;Employment:</td>
                        <td class="tg-7zrl"></td>
                    </tr>
                    <tr class="employment--inputs">
                        <td
                            class="tg-0lax"
                            colspan="2"
                        >*Company&nbsp;Hire </td>
                        <td class="tg-7zrl">Male</td>
                        <td class="tg-7zrl">Female</td>
                        <td class="tg-7zrl">Sub-total</td>
                        <td class="tg-7zrl"></td>
                    </tr>
                    <tr class="employment--inputs">
                        <td
                            class="tg-0lax"
                            colspan="2"
                        >Regular</td>
                        <td class="tg-7zrl"><x-custom-input.input
                                class="maleInput"
                                id="Regular_male"
                                name="Regular_male"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['Regular_male'] ?? ''"
                            /></td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="femaleInput"
                                id="Regular_female"
                                name="Regular_female"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['Regular_female'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="thisRowSubtotal"
                                id="Regular_subtotal"
                                name="Regular_subtotal"
                                type="text"
                                readonly
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['Regular_subtotal'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl"></td>
                    </tr>

                    <tr class="employment--inputs">
                        <td
                            class="tg-0lax"
                            colspan="2"
                        > Part-Time</td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="maleInput"
                                id="Parttime_male"
                                name="Parttime_male"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['Parttime_male'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="femaleInput"
                                id="Parttime_female"
                                name="Parttime_female"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['Parttime_female'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="thisRowSubtotal"
                                id="Parttime_subtotal"
                                name="Parttime_subtotal"
                                type="text"
                                readonly
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['Parttime_subtotal'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr class="employment--inputs">
                        <td
                            class="tg-0lax"
                            colspan="2"
                        >*Sub-contractor Hire</td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr class="employment--inputs">
                        <td
                            class="tg-0lax"
                            colspan="2"
                        > Regular</td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="maleInput"
                                id="Regu_Subcont_male"
                                name="Regu_Subcont_male"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['Regu_Subcont_male'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="femaleInput"
                                id="Regu_Subcont_female"
                                name="Regu_Subcont_female"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['Regu_Subcont_female'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="thisRowSubtotal"
                                id="Regu_Subcont_subtotal"
                                name="Regu_Subcont_subtotal"
                                type="text"
                                readonly
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['Regu_Subcont_subtotal'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr class="employment--inputs">
                        <td
                            class="tg-0lax"
                            colspan="2"
                        > Part-Time</td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="maleInput"
                                id="Subcont_Parttime_male"
                                name="Subcont_Parttime_male"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['Subcont_Parttime_male'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="femaleInput"
                                id="Subcont_Parttime_female"
                                name="Subcont_Parttime_female"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['Subcont_Parttime_female'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="thisRowSubtotal"
                                id="Subcont_Parttime_subtotal"
                                name="Subcont_Parttime_subtotal"
                                type="text"
                                readonly
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['Subcont_Parttime_subtotal'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr class="employment--inputs">
                        <td
                            class="tg-7zrl"
                            colspan="2"
                        >Indirect Employment</td>
                        <td class="tg-7zrl">Male</td>
                        <td class="tg-7zrl">Female</td>
                        <td class="tg-7zrl">Sub-total</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr class="employment--inputs">
                        <td
                            class="tg-7zrl"
                            colspan="2"
                        >*Regular </td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="maleInput"
                                id="Indirect_Regular_male"
                                name="Indirect_Regular_male"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['Indirect_Regular_male'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="femaleInput"
                                id="Indirect_Regular_female"
                                name="Indirect_Regular_female"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['Indirect_Regular_female'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="thisRowSubtotal"
                                id="Indirect_Regular_subtotal"
                                name="Indirect_Regular_subtotal"
                                type="text"
                                readonly
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['Indirect_Regular_subtotal'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr class="employment--inputs">
                        <td
                            class="tg-7zrl"
                            colspan="2"
                        >*Part-time</td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="maleInput"
                                id="Indirect_Parttime_male"
                                name="Indirect_Parttime_male"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['Indirect_Parttime_male'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="femaleInput"
                                id="Indirect_Parttime_female"
                                name="Indirect_Parttime_female"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['Indirect_Parttime_female'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="thisRowSubtotal"
                                id="Indirect_Parttime_subtotal"
                                name="Indirect_Parttime_subtotal"
                                type="text"
                                readonly
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['Indirect_Parttime_subtotal'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-wa1i"
                            colspan="2"
                            rowspan="2"
                        >Total Volume of Production
                        </td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-cly1"
                            colspan="2"
                            rowspan="2"
                        >*Local</td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
                            rowspan="2"
                        >
                            &nbsp;&nbsp;<br>&nbsp;&nbsp;
                            <x-custom-input.input
                                name="localProduct"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['localProduct'] ?? ''"
                            />
                        </td>

                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-cly1"
                            colspan="2"
                            rowspan="2"
                        >*Export</td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
                            rowspan="2"
                        >
                            &nbsp;&nbsp;<br>&nbsp;&nbsp;
                            <x-custom-input.input
                                name="exportProduct"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['exportProduct'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-wa1i"
                            colspan="2"
                            rowspan="2"
                        >Total&nbsp;&nbsp;&nbsp;Gross Sales(₱):
                        </td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
                            rowspan="2"
                        >
                            &nbsp;&nbsp;<br>₱
                            <x-custom-input.input
                                id="totalGrossSales"
                                name="totalGrossSales"
                                type="text"
                                style="width: 90%"
                                readonly
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['totalGrossSales'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-cly1"
                            colspan="2"
                            rowspan="2"
                        >*Local(₱)</td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
                            rowspan="2"
                        >
                            &nbsp;&nbsp;<br>&nbsp;&nbsp;₱
                            <x-custom-input.input
                                id="localProduct_Val"
                                name="localProduct_Val"
                                type="text"
                                style="width: 90%"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['localProduct_Val'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-cly1"
                            colspan="2"
                            rowspan="2"
                        >*Export(₱)</td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
                            rowspan="2"
                        >
                            &nbsp;&nbsp;<br>&nbsp;&nbsp;₱
                            <x-custom-input.input
                                id="exportProduct_Val"
                                name="exportProduct_Val"
                                type="text"
                                style="width: 90%"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['exportProduct_Val'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-7zrl"
                            colspan="2"
                        >Country of Destination:</td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
                        > &nbsp;&nbsp;</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-j6zm"
                            colspan="5"
                        >Assistance obtained from DOST(please
                            check)</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-7zrl"
                            colspan="5"
                        >A.1 Production
                            Technology
                            <x-custom-input.input
                                name="productionTechnology_checkbox"
                                type="checkbox"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['productionTechnology_checkbox'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-7zrl"
                            colspan="5"
                        >&nbsp;&nbsp;&nbsp;&nbsp;A.1.1
                            Process<x-custom-input.input
                                name="process_checkbox"
                                type="checkbox"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['process_checkbox'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl"><x-custom-input.input
                                name="processDefinition"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['processDefinition'] ?? ''"
                            /></td>
                    </tr>
                    <tr>
                        <td
                            class="tg-7zrl"
                            colspan="5"
                        >&nbsp;&nbsp;&nbsp;&nbsp;A.1.2
                            Equipment<x-custom-input.input
                                name="equipment_checkbox"
                                type="checkbox"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['equipment_checkbox'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl"><x-custom-input.input
                                name="equipmentDefinition"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['equipmentDefinition'] ?? ''"
                            /></td>
                    </tr>
                    <tr>
                        <td
                            class="tg-7zrl"
                            colspan="5"
                        >
                            &nbsp;&nbsp;&nbsp;&nbsp;A.1.3Quality&nbsp;&nbsp;&nbsp;Control/Laboratory
                            Testing/Analysis
                            <x-custom-input.input
                                name="qualityControl_checkbox"
                                type="checkbox"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['qualityControl_checkbox'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                name="qualityControlDefinition"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['qualityControlDefinition'] ?? ''"
                            />
                        </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-7zrl"
                            colspan="5"
                        >
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.3.1
                            Production&nbsp;&nbsp;&nbsp;Technology
                            <x-custom-input.input
                                name="productionTechnology1_checkbox"
                                type="checkbox"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['productionTechnology1_checkbox'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-7zrl"
                            colspan="5"
                        >
                            A2&nbsp;&nbsp;&nbsp;Packaging/Labeling<x-custom-input.input
                                name="packagingLabeling_checkbox"
                                type="checkbox"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['packagingLabeling_checkbox'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl"> <x-custom-input.input
                                name="packagingLabelingDefinition"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['packagingLabelingDefinition'] ?? ''"
                            /></td>
                    </tr>
                    <tr>
                        <td
                            class="tg-7zrl"
                            colspan="5"
                        >A3
                            Post-harvest<x-custom-input.input
                                name="postHarvest_checkbox"
                                type="checkbox"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['postHarvest_checkbox'] ?? ''"
                            /></td>
                        <td class="tg-7zrl"><x-custom-input.input
                                name="postHarvestDefinition"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['postHarvestDefinition'] ?? ''"
                            /></td>
                    </tr>
                    <tr>
                        <td
                            class="tg-7zrl"
                            colspan="5"
                        >A4
                            Marketing&nbsp;&nbsp;&nbsp;Assistance<x-custom-input.input
                                name="marketAssistance_checkbox"
                                type="checkbox"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['marketAssistance_checkbox'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl"><x-custom-input.input
                                name="marketAssistanceDefinition"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['marketAssistanceDefinition'] ?? ''"
                            /></td>
                    </tr>
                    <tr>
                        <td
                            class="tg-7zrl"
                            colspan="5"
                        >A5 Human Resource&nbsp;&nbsp;&nbsp;Training(Please
                            specify)<x-custom-input.input
                                name="humanResourceTraining_checkbox"
                                type="checkbox"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['humanResourceTraining_checkbox'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl"><x-custom-input.input
                                name="humanResourceTrainingDefinition"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['humanResourceTrainingDefinition'] ?? ''"
                            /></td>
                    </tr>
                    <tr>
                        <td
                            class="tg-7zrl"
                            colspan="5"
                        >A6 Consultancy&nbsp;&nbsp;&nbsp;Services(Please
                            specify)
                            <x-custom-input.input
                                name="consultanceServices_checkbox"
                                type="checkbox"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['consultanceServices_checkbox'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                name="consultanceServicesDefinition"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['consultanceServicesDefinition'] ?? ''"
                            />
                        </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-cly1"
                            colspan="5"
                            rowspan="2"
                        >A7 Other&nbsp;&nbsp;&nbsp;Services (FDA
                            Permit, LGU Registration, Bar
                            Coding)<x-custom-input.input
                                name="otherServices_checkbox"
                                type="checkbox"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['otherServices_checkbox'] ?? ''"
                            /></td>
                        <td class="tg-7zrl"><x-custom-input.input
                                name="otherServicesDefinition"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['otherServicesDefinition'] ?? ''"
                            /></td>
                    </tr>
                </tbody>
            </table>
            {!! $esignatureElement ?? '' !!}
        </div>
    </form>
    @if (!$isExporting)
        <div
            class="position-sticky bottom-0 py-1 mt-4"
            style="z-index: 1000;"
        >
            <div class="container">
                @if ($isEditable)
                    <div class="d-flex justify-content-end">
                        <button
                            class="btn btn-primary"
                            form="projectInfoSheetForm"
                            type="submit"
                        >Set Document Data</button>
                    </div>
                @else
                    <div class="d-flex justify-content-end">
                        <button
                            class="btn btn-primary"
                            id="exportProjectInfoSheetFormToPDF"
                            data-generated-url="{{ URL::signedRoute('staff.Project.generate.information-sheet-document', ['projectId' => $projectInfoSheetData['project_info_id'], 'applicationId' => $projectInfoSheetData['application_info_id'], 'businessId' => $projectInfoSheetData['business_info_id'], 'forYear' => $projectInfoSheetData['for_period']]) }}"
                            type="button"
                        >Export as PDF</button>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
