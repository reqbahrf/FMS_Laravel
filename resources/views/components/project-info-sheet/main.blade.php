@props(['projectInfo', 'projectInfoSheetData', 'isEditable', 'isExporting' => false, 'isPreImplementation' => true])
<div id="formWrapper">
    @if (!$isExporting)
        <nav
            class="mt-3 sticky-top position-sticky"
            aria-label="breadcrumb"
        >
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
        @if (!$isExporting)
            <x-project-info-sheet.document-header
                headerSubText="Project Information Sheet (PIS) for On-Going Projects" />
        @endif
        <div class="tg-wrap">
            <table
                class="tg"
                id="dataSheetTable"
                style="overflow: hidden"
                autosize="1"
            >
                <thead>
                    <tr>
                        <th style="border: none; width: 15%;"></th>
                        <th style="border: none; width: 15%;"></th>
                        <th style="border: none; width: 10%;"></th>
                        <th style="border: none; width: 10%;"></th>
                        <th style="border: none; width: 10%;"></th>
                        <th style="border: none; width: 40%;"></th>
                    </tr>
                </thead>
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
                        <td class="tg-j6zm ">Project Code:
                            <x-custom-input.input
                                name="projectCode"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['projectCode'] ?? ''"
                            />
                        </td>
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
                                    readonly
                                    :isEditable="$isEditable"
                                    :value="$projectInfo->project_title ?? ''"
                                />
                            </strong>
                        </td>
                        <td class="tg-7zrl row--description">
                            @if ($isPreImplementation)
                                Indicate here the exact title of the project
                            @else
                                Indicate here the exact title of the project
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-j6zm"
                            colspan="5"
                        >Name of Firm:
                            <x-custom-input.input
                                name="firmName"
                                type="text"
                                readonly
                                :isEditable="$isEditable"
                                :value="$projectInfo->firm_name ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl row--description">
                            @if ($isPreImplementation)
                                Indicate the name of the company if available (usually if
                                registered); if
                                not use surname of owner and add enterprises at the end e.g. Perez Enterprises
                            @else
                                Fill this up only if there has been any change in the information provided earlier
                            @endif
                        </td>
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
                                readonly
                                :isEditable="$isEditable"
                                :value="$projectInfo->prefix .
                                    ' ' .
                                    $projectInfo->f_name .
                                    ' ' .
                                    $projectInfo->mid_name .
                                    ' ' .
                                    $projectInfo->l_name .
                                    ' ' .
                                    $projectInfo->suffix ??
                                    ''"
                            />
                        </td>
                        <td class="tg-7zrl">sex:
                            <x-custom-input.input
                                name="sex"
                                type="text"
                                readonly
                                :isEditable="$isEditable"
                                :value="$projectInfo->sex ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl">Age:
                            <x-custom-input.input
                                name="age"
                                type="text"
                                readonly
                                :isEditable="$isEditable"
                                :value="$projectInfo->birth_date
                                    ? \Carbon\Carbon::parse($projectInfo->birth_date)->age
                                    : ''"
                            />
                        </td>
                        <td class="tg-7zrl row--description">
                            @if ($isPreImplementation)
                                Indicate the owner and the contact person of the company;
                                in some instances
                                the owner may be different from the contact person who generally is the one available
                                more
                                frequently
                            @else
                                Fill this up only if there has been any change in the information provided earlier
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-j6zm"
                            colspan="5"
                        >Type of Organization Enterprize:</td>
                        <td
                            class="tg-7zrl row--description"
                            rowspan="2"
                        >
                            @if ($isPreImplementation)
                                Can be a cooperative, single ownership, partnership or corporation
                            @else
                                Fill this up only if there has been any change in the information provided earlier
                            @endif
                        </td>
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
                                :value="$projectInfoSheetData['typeOfOrganization'] ??
                                    ($projectInfo->enterprise_type ?? '')"
                            />
                        </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-j6zm"
                            colspan="5"
                        >Business Address:</td>
                        <td
                            class="tg-7zrl row--description"
                            rowspan="2"
                        >
                            @if ($isPreImplementation)
                                Please complete the address where the factory is located not where the display area or
                                show
                                room is located
                            @else
                                Fill this up only if there has been any change in the information provided earlier
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-8d8j"
                            colspan="5"
                        ><x-custom-input.input
                                name="businessAddress"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['businessAddress'] ??
                                    ($projectInfo->office_landmark ?? '') .
                                        ', ' .
                                        ($projectInfo->office_barangay ?? '') .
                                        ', ' .
                                        ($projectInfo->office_city ?? '') .
                                        ', ' .
                                        ($projectInfo->office_province ?? '') .
                                        ', ' .
                                        ($projectInfo->office_region ?? '') .
                                        ', ' .
                                        ($projectInfo->office_zip_code ?? '')"
                            /></td>

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
                        <td
                            class="tg-7zrl row--description"
                            rowspan="2"
                        >
                            @if ($isPreImplementation)
                                If email address is not available use DOST Regional office email address as alternative
                            @else
                                Fill this up only if there has been any change in the information provided earlier
                            @endif
                        </td>
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
                    </tr>
                    @if ($isPreImplementation)
                        <tr>
                            <td
                                class="tg-j6zm"
                                colspan="5"
                            >
                                Year Firm Established:
                                <x-custom-input.input
                                    name="yearFirmEstablished"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$projectInfoSheetData['yearFirmEstablished'] ?? ''"
                                />
                            </td>
                            <td class="tg-7zrl row--description">
                                Actual year firm was registered or if not registered year firm started operating
                            </td>
                        </tr>
                        <tr>
                            <td
                                class="tg-j6zm"
                                colspan="5"
                            >
                                Date SETUP Assistance Approved:
                                <x-custom-input.input
                                    id="totalAssests"
                                    name="dateSetupAssistanceApproved"
                                    type="date"
                                    :isEditable="$isEditable"
                                    :value="$projectInfoSheetData['dateSetupAssistanceApproved'] ?? ''"
                                />
                            </td>
                            <td class="tg-7zrl row--description">
                                Date project was approved as indicated in the approval letter
                            </td>
                        </tr>
                    @endif
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
                            class="tg-8d8j row--description"
                            colspan="1"
                            @if ($isPreImplementation) rowspan="5"
                            @else
                                rowspan="1" @endif
                        >
                            @if ($isPreImplementation)
                                Please indicate the estimated value of total assets of the SME prior to SET-UP
                                assistance; Need not be the exact figure but should check to ensure that data provided
                                are realistic and as close to the real value as possible
                            @endif
                        </td>
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
                        @if (!$isPreImplementation)
                            <td class="tg-7zrl row--description">

                            </td>
                        @endif
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
                        @if (!$isPreImplementation)
                            <td class="tg-7zrl row--description">

                            </td>
                        @endif
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl">Equipment </td>
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
                        @if (!$isPreImplementation)
                            <td class="tg-7zrl row--description">

                            </td>
                        @endif
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
                        @if (!$isPreImplementation)
                            <td class="tg-7zrl row--description">

                            </td>
                        @endif
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
                            class="tg-8d8j row--description"
                            @if ($isPreImplementation) colspan="2"
                            rowspan="2"
                            @else
                                colspan="2"
                                rowspan="13" @endif
                        >
                            @if ($isPreImplementation)
                                Please indicate current level of employment when project was approved; please be guided
                                by the definition of employment i.e. 1 man-month (20 working days) = 1 employment; sum
                                of direct & indirect employment
                            @else
                                Please indicate total employment for the period covered; please be guided by the
                                definition of employment i.e. 1 man-month (20 working days) = 1 employment; sum of
                                direct & indirect employment
                            @endif
                        </td>
                    </tr>
                    <tr class="employment--inputs">
                        <td
                            class="tg-7zrl"
                            colspan="5"
                        >Direct&nbsp;Employment:</td>
                    </tr>
                    <tr class="employment--inputs">
                        <td
                            class="tg-0lax"
                            colspan="2"
                        >*Company&nbsp;Hire </td>
                        <td class="tg-7zrl">Male</td>
                        <td class="tg-7zrl">Female</td>
                        <td class="tg-7zrl">Sub-total</td>
                        <td class="tg-7zrl row--description">Refers to the number of employees directly hired by the
                            SME/company and
                            working in the factory/SME itself</td>
                    </tr>
                    <tr class="employment--inputs">
                        <td
                            class="tg-0lax"
                            colspan="2"
                        > Regular</td>
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
                        <td class="tg-7zrl row--description">Works eight hours/day five days/week</td>
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
                        <td class="tg-7zrl row--description">Works less than eight hours per day or less than five days
                            per week</td>
                    </tr>
                    <tr class="employment--inputs">
                        <td
                            class="tg-0lax"
                            colspan="2"
                        >*Sub-contractor Hire</td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl row--description">Refers to the number of employees hired by sub-contractors
                            of the SME;
                            these do not work in the factory itself and are paid by the sub-contractor himself.</td>
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
                        <td class="tg-7zrl row--description">Same as company hire definition</td>
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
                        <td class="tg-7zrl row--description">Same as company hire definition</td>
                    </tr>
                    <tr class="employment--inputs">
                        <td
                            class="tg-0lax"
                            colspan="2"
                        >PWD</td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="maleInput"
                                id="PWD_male"
                                name="PWD_male"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['PWD_male'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="femaleInput"
                                id="PWD_female"
                                name="PWD_female"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['PWD_female'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="thisRowSubtotal"
                                id="PWD_subtotal"
                                name="PWD_subtotal"
                                type="text"
                                readonly
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['PWD_subtotal'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl row--description"></td>
                    </tr>
                    <tr class="employment--inputs">
                        <td
                            class="tg-7zrl"
                            colspan="2"
                        >Senior Citizen</td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="maleInput"
                                id="SeniorCitizen_male"
                                name="SeniorCitizen_male"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['SeniorCitizen_male'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="femaleInput"
                                id="SeniorCitizen_female"
                                name="SeniorCitizen_female"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['SeniorCitizen_female'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl">
                            <x-custom-input.input
                                class="thisRowSubtotal"
                                id="SeniorCitizen_subtotal"
                                name="SeniorCitizen_subtotal"
                                type="text"
                                readonly
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['SeniorCitizen_subtotal'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl row--description"></td>
                    </tr>
                    <tr class="employment--inputs">
                        <td
                            class="tg-7zrl"
                            colspan="2"
                        >Indirect Employment</td>
                        <td class="tg-7zrl">Male</td>
                        <td class="tg-7zrl">Female</td>
                        <td class="tg-7zrl">Sub-total</td>
                        <td class="tg-7zrl row--description">Manufactures components/parts of the whole product; as
                            this is very
                            difficult to measure it is sufficient to only account for the 1st degree employment effect
                        </td>
                    </tr>
                    <tr class="employment--inputs">
                        <td
                            class="tg-7zrl"
                            colspan="2"
                        >*Backward </td>
                        <td class="tg-7zrl">
                            @if (!$isPreImplementation)
                                <x-custom-input.input
                                    class="maleInput"
                                    id="Indirect_backward_male"
                                    name="Indirect_backward_male"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$projectInfoSheetData['Indirect_backward_male'] ?? ''"
                                />
                            @endif
                        </td>
                        <td class="tg-7zrl">
                            @if (!$isPreImplementation)
                                <x-custom-input.input
                                    class="femaleInput"
                                    id="Indirect_backward_female"
                                    name="Indirect_backward_female"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$projectInfoSheetData['Indirect_backward_female'] ?? ''"
                                />
                            @endif
                        </td>
                        <td class="tg-7zrl">
                            @if (!$isPreImplementation)
                                <x-custom-input.input
                                    class="thisRowSubtotal"
                                    id="Indirect_backward_subtotal"
                                    name="Indirect_backward_subtotal"
                                    type="text"
                                    readonly
                                    :isEditable="$isEditable"
                                    :value="$projectInfoSheetData['Indirect_backward_subtotal'] ?? ''"
                                />
                            @endif
                        </td>
                        @if ($isPreImplementation)
                            <td class="tg-7zrl row--description">
                                Refers to employment generated by suppliers of inputs and other raw materials needed to
                                produce the final product of the company
                            </td>
                        @endif
                    </tr>
                    @if ($isPreImplementation)
                        <tr class="employment--inputs">
                            <td
                                class="tg-7zrl"
                                colspan="2"
                            >PWD</td>
                            <td class="tg-7zrl">
                                <x-custom-input.input
                                    class="maleInput"
                                    id="PWD_backward_male"
                                    name="PWD_backward_male"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$projectInfoSheetData['PWD_backward_male'] ?? ''"
                                />
                            </td>
                            <td class="tg-7zrl">
                                <x-custom-input.input
                                    class="femaleInput"
                                    id="PWD_backward_female"
                                    name="PWD_backward_female"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$projectInfoSheetData['PWD_backward_female'] ?? ''"
                                />
                            </td>
                            <td class="tg-7zrl">
                                <x-custom-input.input
                                    class="thisRowSubtotal"
                                    id="PWD_backward_subtotal"
                                    name="PWD_backward_subtotal"
                                    type="text"
                                    readonly
                                    :isEditable="$isEditable"
                                    :value="$projectInfoSheetData['PWD_backward_subtotal'] ?? ''"
                                />
                            </td>
                            <td class="tg-7zrl row--description"></td>
                        </tr>
                        <tr class="employment--inputs">
                            <td
                                class="tg-7zrl"
                                colspan="2"
                            >Senior Citizen</td>
                            <td class="tg-7zrl">
                                <x-custom-input.input
                                    class="maleInput"
                                    id="SeniorCitizen_backward_male"
                                    name="SeniorCitizen_backward_male"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$projectInfoSheetData['SeniorCitizen_backward_male'] ?? ''"
                                />
                            </td>
                            <td class="tg-7zrl">
                                <x-custom-input.input
                                    class="femaleInput"
                                    id="SeniorCitizen_backward_female"
                                    name="SeniorCitizen_backward_female"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$projectInfoSheetData['SeniorCitizen_backward_female'] ?? ''"
                                />
                            </td>
                            <td class="tg-7zrl">
                                <x-custom-input.input
                                    class="thisRowSubtotal"
                                    id="SeniorCitizen_backward_subtotal"
                                    name="SeniorCitizen_backward_subtotal"
                                    type="text"
                                    readonly
                                    :isEditable="$isEditable"
                                    :value="$projectInfoSheetData['SeniorCitizen_backward_subtotal'] ?? ''"
                                />
                            </td>
                            <td class="tg-7zrl row--description"></td>
                        </tr>
                    @endif
                    <tr class="employment--inputs">
                        <td
                            class="tg-7zrl"
                            colspan="2"
                        >*Forward</td>
                        <td class="tg-7zrl">
                            @if ($isPreImplementation)
                                <x-custom-input.input
                                    class="maleInput"
                                    id="Indirect_forward_male"
                                    name="Indirect_forward_male"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$projectInfoSheetData['Indirect_forward_male'] ?? ''"
                                />
                            @endif
                        </td>
                        <td class="tg-7zrl">
                            @if ($isPreImplementation)
                                <x-custom-input.input
                                    class="femaleInput"
                                    id="Indirect_forward_female"
                                    name="Indirect_forward_female"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$projectInfoSheetData['Indirect_forward_female'] ?? ''"
                                />
                            @endif
                        </td>
                        <td class="tg-7zrl">
                            @if ($isPreImplementation)
                                <x-custom-input.input
                                    class="thisRowSubtotal"
                                    id="Indirect_forward_subtotal"
                                    name="Indirect_forward_subtotal"
                                    type="text"
                                    readonly
                                    :isEditable="$isEditable"
                                    :value="$projectInfoSheetData['Indirect_forward_subtotal'] ?? ''"
                                />
                            @endif
                        </td>
                        @if ($isPreImplementation)
                            <td class="tg-7zrl row--description">
                                Refers to employment generated by other companies using the products of the company or
                                as a consequence of the production of the company such as suppliers of packaging
                                materials, transport groups, etc.
                            </td>
                        @endif
                    </tr>
                    @if (!$isPreImplementation)
                        <tr class="employment--inputs">
                            <td
                                class="tg-7zrl"
                                colspan="2"
                            >PWD</td>
                            <td class="tg-7zrl">
                                <x-custom-input.input
                                    class="maleInput"
                                    id="PWD_forward_male"
                                    name="PWD_forward_male"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$projectInfoSheetData['PWD_forward_male'] ?? ''"
                                />
                            </td>
                            <td class="tg-7zrl">
                                <x-custom-input.input
                                    class="femaleInput"
                                    id="PWD_forward_female"
                                    name="PWD_forward_female"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$projectInfoSheetData['PWD_forward_female'] ?? ''"
                                />
                            </td>
                            <td class="tg-7zrl">
                                <x-custom-input.input
                                    class="thisRowSubtotal"
                                    id="PWD_forward_subtotal"
                                    name="PWD_forward_subtotal"
                                    type="text"
                                    readonly
                                    :isEditable="$isEditable"
                                    :value="$projectInfoSheetData['PWD_forward_subtotal'] ?? ''"
                                />
                            </td>
                            <td class="tg-7zrl row--description"></td>
                        </tr>
                        <tr class="employment--inputs">
                            <td
                                class="tg-7zrl"
                                colspan="2"
                            >
                                Senior Citizen
                            </td>
                            <td class="tg-7zrl">
                                <x-custom-input.input
                                    class="maleInput"
                                    id="SeniorCitizen_forward_male"
                                    name="SeniorCitizen_forward_male"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$projectInfoSheetData['SeniorCitizen_forward_male'] ?? ''"
                                />
                            </td>
                            <td class="tg-7zrl">
                                <x-custom-input.input
                                    class="femaleInput"
                                    id="SeniorCitizen_forward_female"
                                    name="SeniorCitizen_forward_female"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$projectInfoSheetData['SeniorCitizen_forward_female'] ?? ''"
                                />
                            </td>
                            <td class="tg-7zrl">
                                <x-custom-input.input
                                    class="thisRowSubtotal"
                                    id="SeniorCitizen_forward_subtotal"
                                    name="SeniorCitizen_forward_subtotal"
                                    type="text"
                                    readonly
                                    :isEditable="$isEditable"
                                    :value="$projectInfoSheetData['SeniorCitizen_forward_subtotal'] ?? ''"
                                />
                            </td>
                            <td class="tg-7zrl row--description"></td>
                        </tr>
                    @endif
                    <tr>
                        <td
                            class="tg-wa1i"
                            colspan="2"
                        >Total Volume of Production
                        </td>
                        <td
                            class="tg-7zrl row--description"
                            colspan="3"
                        >Please specify by type of product and indicate unit of measurement; please use additional sheet
                            for details</td>
                        <td class="tg-7zrl row--description">Total volume of products produced within the period
                            (reckoned on semester
                            basis - Jan/June and July/Dec); Please report volume of production for the semester closest
                            to the date of project approval. </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-cly1"
                            colspan="2"
                        >*Local</td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
                        >
                            &nbsp;&nbsp;<br>&nbsp;&nbsp;
                            @if ($isEditable)
                                <textarea
                                    class="form-control"
                                    name="localProduct"
                                    style="width: 100%; height: 100px;"
                                    :isEditable="$isEditable"
                                >{{ $projectInfoSheetData['localProduct'] ?? '' }}</textarea>
                            @else
                                {{ $projectInfoSheetData['localProduct'] ?? '' }}
                            @endif
                        </td>

                        <td class="tg-7zrl row--description">Refers to products sold within the Philippines</td>
                    </tr>
                    <tr>
                        <td
                            class="tg-cly1"
                            colspan="2"
                        >*Export</td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
                        >
                            &nbsp;&nbsp;<br>&nbsp;&nbsp;
                            @if ($isEditable)
                                <textarea
                                    class="form-control"
                                    name="exportProduct"
                                    style="width: 100%; height: 100px;"
                                    :isEditable="$isEditable"
                                >{{ $projectInfoSheetData['exportProduct'] ?? '' }}</textarea>
                            @else
                                {{ $projectInfoSheetData['exportProduct'] ?? '' }}
                            @endif
                        </td>
                        <td class="tg-7zrl row--description">Refers to products sold outside of the Philippines</td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-wa1i"
                            colspan="2"
                        >Total&nbsp;&nbsp;&nbsp;Gross Sales(₱):
                        </td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
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
                        <td class="tg-7zrl row--description">Total value of products produced during the period closest
                            to the date of
                            project approval; Include inventory losses; </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-cly1"
                            colspan="2"
                        >*Local(₱)</td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
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
                        <td class="tg-7zrl row--description">Peso value of products sold in the Philippines</td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"></td>
                    </tr>
                    <tr>
                        <td
                            class="tg-cly1"
                            colspan="2"
                        >*Export(₱)</td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
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
                        <td class="tg-7zrl row--description">Peso value of products sold outside of the Philippines
                        </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-7zrl"
                            colspan="2"
                        >Country/ies of Destination:</td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
                        >
                            <x-custom-input.input
                                name="country_of_destination"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$projectInfoSheetData['country_of_destination'] ?? ''"
                            />
                        </td>
                        <td class="tg-7zrl row--description">Refers to countries where products are sold if any</td>
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
        </div>
        <table
            style="width: 25%; border-collapse: collapse; font-family: sans-serif; font-size: 14px; margin-top: 10pt; table-layout: fixed; margin-left: 0; position: relative; left: 0;"
        >
            <tbody>
                <tr>
                    <td style="padding-bottom: 7.5pt; text-align: left;">Prepared By:</td>
                </tr>
                <tr>
                    <td style="text-align: left;">Reanz Arthur A. Monera</td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid black; text-align: left;">PSTD/CSTD</td>
                </tr>
            </tbody>
        </table>
    </form>
    @if (!$isExporting)
        <div
            class="position-sticky bottom-0 pb-5 mt-4 pe-none"
            style="z-index: 1000;"
        >
            <div class="container">
                @if ($isEditable)
                    <div class="d-flex justify-content-end">
                        <button
                            class="btn btn-primary pe-auto"
                            form="projectInfoSheetForm"
                            type="submit"
                        >Set Document Data</button>
                    </div>
                @else
                    <div class="d-flex justify-content-end">
                        <button
                            class="btn btn-primary pe-auto"
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
