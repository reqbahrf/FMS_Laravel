@props(['projectInfoSheetData', 'isEditable', 'isExporting' => false])
<form id="projectInfoSheetForm">
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
                        {{ date('Y') }}</td>
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
                            {{ $projectTitle }}
                            <x-custom-input.input
                                name="projectTitle"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectTitle"
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
                            :value="$firmName"
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
                            :value="$name"
                        />
                    </td>
                    <td class="tg-7zrl">sex:
                        <x-custom-input.input
                            name="sex"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$sex"
                        />
                    </td>
                    <td class="tg-7zrl">Age:
                        <x-custom-input.input
                            name="age"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$age"
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
                            :value="$typeOfOrganization"
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
                            :value="$businessAddress"
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
                            :value="$landline"
                        />
                    </td>
                    <td
                        class="tg-7zrl"
                        colspan="3"
                    >Fax: <x-custom-input.input
                            name="fax"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$fax"
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
                            :value="$mobile_phone"
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
                            :value="$email"
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
                            name="totalAssets"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$totalAssets"
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
                    > &nbsp;&nbsp;₱
                        <x-custom-input.input
                            name="land"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$land"
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
                            name="building"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$building"
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
                            name="equipment"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$equipment"
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
                            name="workingCapital"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$workingCapital"
                        />
                    </td>
                </tr>
                <tr>
                    <td
                        class="tg-wa1i"
                        colspan="2"
                    >Total&nbsp;&nbsp;&nbsp;Employment Generated
                    </td>
                    <td
                        class="tg-wa1i"
                        colspan="3"
                    ><x-custom-input.input
                            name="TotalmanMonths"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$TotalmanMonths"
                        />&nbsp;&nbsp;man-mouth</td>
                    <td
                        class="tg-8d8j"
                        colspan="1"
                    ><br /><br /></td>
                </tr>
                <tr>
                    <td
                        class="tg-7zrl"
                        colspan="5"
                    >Direct&nbsp;Employment:</td>
                    <td class="tg-7zrl"></td>
                </tr>
                <tr>
                    <td
                        class="tg-0lax"
                        colspan="2"
                    >*Company&nbsp;Hire </td>
                    <td class="tg-7zrl">Male</td>
                    <td class="tg-7zrl">Female</td>
                    <td class="tg-7zrl">Sub-total</td>
                    <td class="tg-7zrl"></td>
                </tr>
                <tr>
                    <td
                        class="tg-0lax"
                        colspan="2"
                    >Regular</td>
                    <td class="tg-7zrl"><x-custom-input.input
                            name="Regular_male"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$Regular_male"
                        /></td>
                    <td class="tg-7zrl">
                        <x-custom-input.input
                            name="Regular_female"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$Regular_female"
                        />
                    </td>
                    <td class="tg-7zrl">
                        <x-custom-input.input
                            name="Regular_subtotal"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$Regular_subtotal"
                        />
                    </td>
                    <td class="tg-7zrl"></td>
                </tr>

                <tr>
                    <td
                        class="tg-0lax"
                        colspan="2"
                    > Part-Time</td>
                    <td class="tg-7zrl">
                        <x-custom-input.input
                            name="Parttime_male"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$Parttime_male"
                        />
                    </td>
                    <td class="tg-7zrl">
                        <x-custom-input.input
                            name="Parttime_female"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$Parttime_female"
                        />
                    </td>
                    <td class="tg-7zrl">
                        <x-custom-input.input
                            name="Parttime_subtotal"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$Parttime_subtotal"
                        />
                    </td>
                    <td class="tg-7zrl"> </td>
                </tr>
                <tr>
                    <td
                        class="tg-0lax"
                        colspan="2"
                    >*Sub-contractor Hire</td>
                    <td class="tg-7zrl"> </td>
                    <td class="tg-7zrl"> </td>
                    <td class="tg-7zrl"> </td>
                    <td class="tg-7zrl"> </td>
                </tr>
                <tr>
                    <td
                        class="tg-0lax"
                        colspan="2"
                    > Regular</td>
                    <td class="tg-7zrl">
                        <x-custom-input.input
                            name="Regu_Subcont_male"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$Regu_Subcont_male"
                        />
                    </td>
                    <td class="tg-7zrl">
                        <x-custom-input.input
                            name="Regu_Subcont_female"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$Regu_Subcont_female"
                        />
                    </td>
                    <td class="tg-7zrl">
                        <x-custom-input.input
                            name="Regu_Subcont_subtotal"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$Regu_Subcont_subtotal"
                        />
                    </td>
                    <td class="tg-7zrl"> </td>
                </tr>
                <tr>
                    <td
                        class="tg-0lax"
                        colspan="2"
                    > Part-Time</td>
                    <td class="tg-7zrl">
                        <x-custom-input.input
                            name="Subcont_Parttime_male"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$Subcont_Parttime_male"
                        />
                    </td>
                    <td class="tg-7zrl">
                        <x-custom-input.input
                            name="Subcont_Parttime_female"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$Subcont_Parttime_female"
                        />
                    </td>
                    <td class="tg-7zrl">
                        <x-custom-input.input
                            name="Subcont_Parttime_subtotal"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$Subcont_Parttime_subtotal"
                        />
                    </td>
                    <td class="tg-7zrl"> </td>
                </tr>
                <tr>
                    <td
                        class="tg-7zrl"
                        colspan="2"
                    >Indirect Employment</td>
                    <td class="tg-7zrl">Male</td>
                    <td class="tg-7zrl">Female</td>
                    <td class="tg-7zrl">Sub-total</td>
                    <td class="tg-7zrl"> </td>
                </tr>
                <tr>
                    <td
                        class="tg-7zrl"
                        colspan="2"
                    >*Regular </td>
                    <td class="tg-7zrl">
                        <x-custom-input.input
                            name="Indirect_Regular_male"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$Indirect_Regular_male"
                        />
                    </td>
                    <td class="tg-7zrl">
                        <x-custom-input.input
                            name="Indirect_Regular_female"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$Indirect_Regular_female"
                        />
                    </td>
                    <td class="tg-7zrl">
                        <x-custom-input.input
                            name="Indirect_Regular_subtotal"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$Indirect_Regular_subtotal"
                        />
                    </td>
                    <td class="tg-7zrl"> </td>
                </tr>
                <tr>
                    <td
                        class="tg-7zrl"
                        colspan="2"
                    >*Part-time</td>
                    <td class="tg-7zrl"><x-custom-input.input
                            name="Indirect_Parttime_male"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$Indirect_Parttime_male"
                        /></td>
                    <td class="tg-7zrl">
                        <x-custom-input.input
                            name="Indirect_Parttime_female"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$Indirect_Parttime_female"
                        />
                    </td>
                    <td class="tg-7zrl">
                        <x-custom-input.input
                            name="Indirect_Parttime_subtotal"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$Indirect_Parttime_subtotal"
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
                            :value="$localProduct"
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
                            :value="$exportProduct"
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
                        &nbsp;&nbsp;<br>
                        <x-custom-input.input
                            name="totalGrossSales"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$totalGrossSales"
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
                        &nbsp;&nbsp;<br>&nbsp;&nbsp;
                        <x-custom-input.input
                            name="localProduct_Val"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$localProduct_Val"
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
                        &nbsp;&nbsp;<br>&nbsp;&nbsp;
                        <x-custom-input.input
                            name="exportProduct_Val"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$exportProduct_Val"
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
                            :value="$productionTechnology_checkbox"
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
                            :value="$process_checkbox"
                        />
                    </td>
                    <td class="tg-7zrl"><x-custom-input.input
                            name="processDefinition"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$processDefinition"
                        /></td>
                </tr>
                <tr>
                    <td
                        class="tg-7zrl"
                        colspan="5"
                    >&nbsp;&nbsp;&nbsp;&nbsp;A.1.2
                        Equiment<x-custom-input.input
                            name="equipment_checkbox"
                            type="checkbox"
                            :isEditable="$isEditable"
                            :value="$equipment_checkbox"
                        />
                    </td>
                    <td class="tg-7zrl"><x-custom-input.input
                            name="equipmentDefinition"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$equipmentDefinition"
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
                            :value="$qualityControl_checkbox"
                        />
                    </td>
                    <td class="tg-7zrl">
                        <x-custom-input.input
                            name="qualityControlDefinition"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$qualityControlDefinition"
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
                            :value="$productionTechnology1_checkbox"
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
                            :value="$packagingLabeling_checkbox"
                        />
                    </td>
                    <td class="tg-7zrl"> <x-custom-input.input
                            name="packagingLabelingDefinition"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$packagingLabelingDefinition"
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
                            :value="$postHarvest_checkbox"
                        />{{ ($postHarvest_checkbox ?? '') == 'on' ? '✓' : ' ' }}</td>
                    <td class="tg-7zrl"><x-custom-input.input
                            name="postHarvestDefinition"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$postHarvestDefinition"
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
                            :value="$marketAssistance_checkbox"
                        />
                    </td>
                    <td class="tg-7zrl"><x-custom-input.input
                            name="marketAssistanceDefinition"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$marketAssistanceDefinition"
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
                            :value="$humanResourceTraining_checkbox"
                        />
                    </td>
                    <td class="tg-7zrl"><x-custom-input.input
                            name="humanResourceTrainingDefinition"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$humanResourceTrainingDefinition"
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
                            :value="$consultanceServices_checkbox"
                        />
                    </td>
                    <td class="tg-7zrl">
                        <x-custom-input.input
                            name="consultanceServicesDefinition"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$consultanceServicesDefinition"
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
                            :value="$otherServices_checkbox"
                        /></td>
                    <td class="tg-7zrl"><x-custom-input.input
                            name="otherServicesDefinition"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$otherServicesDefinition"
                        /></td>
                </tr>
            </tbody>
        </table>
        {!! $esignatureElement !!}
    </div>
</form>
