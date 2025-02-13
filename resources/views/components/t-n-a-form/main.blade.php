@props(['TNAdata'])
@php
    use App\Services\ApplicantFileHandlerService;
    try {
        $isEditable = false;
        $organizationalStructure = ApplicantFileHandlerService::getFileAsBase64(
            'Organizational Structure',
            $TNAdata['business_id'],
        );
        $planLayout = ApplicantFileHandlerService::getFileAsBase64('Plan Layout', $TNAdata['business_id']);
        $processFlow = ApplicantFileHandlerService::getFileAsBase64('Process Flow', $TNAdata['business_id']);
    } catch (Exception $e) {
        Log::error('Error retrieving file: ' . $e->getMessage());
        $organizationalStructure = null;
        $planLayout = null;
        $processFlow = null;
    }
@endphp
<div id="TNAForm">
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
            lang="en-US"><strong>DOST TNA Form 01</strong></span></p>
    <p style="text-align: center;background: transparent;line-height: 108%;margin-bottom: 0.28cm;"><br>&nbsp;</p>
    <p style="text-align: center;background: transparent;line-height: 108%;margin-bottom: 0.28cm;"><br>&nbsp;</p>
    <p style="text-align: center;background: transparent;line-height: 108%;margin-bottom: 0.28cm;"><span
            lang="en-US"><u><strong>APPLICATION FOR TECHNOLOGY NEEDS ASSESSMENT</strong></u></span></p>
    <p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
    <table
        style="width: 585px;"
        cellpadding="7"
    >
        <tbody>
            <tr>
                <td
                    style="border: 1px solid rgb(0, 0, 0);padding: 0cm 0.19cm;vertical-align: top;"
                    colspan="3"
                >
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                        <span lang="en-US">Name of Enterprise:&nbsp;
                            @if ($isEditable)
                                <input
                                    id="firm_name"
                                    name="firm_name"
                                    type="text"
                                    value="{{ $TNAdata['firm_name'] ?? '' }}"
                                    placeholder="Name of Enterprise"
                                >
                            @else
                                {{ $TNAdata['firm_name'] ?? '' }}
                            @endIf
                        </span>
                    </p>
                </td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                        <span lang="en-US">Contact Person:&nbsp;
                            @if ($isEditable)
                                <input
                                    id="contact_person"
                                    name="contact_person"
                                    type="text"
                                    value="{{ $TNAdata['contact_person'] ?? ($TNAdata['prefix'] ?? '') . ' ' . ($TNAdata['f_name'] ?? '') . ' ' . ($TNAdata['middle_name'] ?? '') . ' ' . ($TNAdata['l_name'] ?? '') . ' ' . ($TNAdata['suffix'] ?? '') }}"
                                    placeholder="Contact Person"
                                >
                            @else
                                {{ $TNAdata['contact_person'] ?? ($TNAdata['prefix'] ?? '') . ' ' . ($TNAdata['f_name'] ?? '') . ' ' . ($TNAdata['middle_name'] ?? '') . ' ' . ($TNAdata['l_name'] ?? '') . ' ' . ($TNAdata['suffix'] ?? '') }}
                            @endIf
                        </span>
                    </p>
                </td>
                <td
                    style="border: 1px solid #000000;padding: 0cm 0.19cm;"
                    colspan="2"
                >
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                        <span lang="en-US">Position in the Enterprise: (wife of the owner)
                            @if ($isEditable)
                                <input
                                    id="designation"
                                    name="designation"
                                    type="text"
                                    value="{{ $TNAdata['designation'] ?? '' }}"
                                    placeholder="Position in the Enterprise"
                                >
                        </span>
                    @else
                        {{ $TNAdata['designation'] ?? '' }}
                        @endIf
                    </p>
                </td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td
                    style="border-top: 1px solid #000000;border-bottom: none;border-left: 1px solid #000000;border-right: 1px solid #000000;padding: 0cm 0.19cm;"
                    rowspan="2"
                >
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0cm;background: transparent;">
                        <span lang="en-US">Office Address:&nbsp;
                            @if ($isEditable)
                                <input
                                    id="office_address"
                                    name="office_address"
                                    type="text"
                                    value="XI"
                                    value="{{ $TNAdata['office_address'] ?? ($TNAdata['officeLandmark'] ?? '') . ' ' . ($TNAdata['officeBarangay'] ?? '') . ' ' . ($TNAdata['officeCity'] ?? '') . ' ' . ($TNAdata['officeProvince'] ?? '') . ' ' . ($TNAdata['officeRegion'] ?? '') . ' ' . ($TNAdata['officeZipCode'] ?? '') }}"
                                    placeholder="Office Address"
                                >
                            @else
                                {{ $TNAdata['office_address'] ?? ($TNAdata['officeLandmark'] ?? '') . ' ' . ($TNAdata['officeBarangay'] ?? '') . ' ' . ($TNAdata['officeCity'] ?? '') . ' ' . ($TNAdata['officeProvince'] ?? '') . ' ' . ($TNAdata['officeRegion'] ?? '') . ' ' . ($TNAdata['officeZipCode'] ?? '') }}
                            @endIf
                        </span>
                    </p>
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br>
                    </p>
                </td>
                <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                            lang="en-US"
                        >Tel No.:
                            @if ($isEditable)
                                <input
                                    id="officeTelNo"
                                    name="officeTelNo"
                                    type="text"
                                    value="XI"
                                    value="{{ $TNAdata['officeTelNo'] ?? '' }}"
                                    placeholder="Tel No."
                                >
                            @else
                                {{ $TNAdata['officeTelNo'] ?? '' }}
                            @endIf
                        </span>
                    </p>
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br>
                    </p>
                </td>
                <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                            lang="en-US"
                        >Fax No.:
                            @if ($isEditable)
                                <input
                                    id="officeFaxNo"
                                    name="officeFaxNo"
                                    type="text"
                                    value="XI"
                                    value="{{ $TNAdata['officeFaxNo'] ?? '' }}"
                                    placeholder="Fax No."
                                >
                            @else
                                {{ $TNAdata['officeFaxNo'] ?? '' }}
                            @endIf
                        </span>
                    </p>
                </td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td
                    style="border: 1px solid #000000;padding: 0cm 0.19cm;"
                    rowspan="2"
                    colspan="2"
                >
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                            lang="en-US"
                        >E-mail Address:&nbsp;
                            @if ($isEditable)
                                <input
                                    id="officeEmailAddress"
                                    name="officeEmailAddress"
                                    type="text"
                                    value="XI"
                                    value="{{ $TNAdata['officeEmailAddress'] ?? '' }}"
                                    placeholder="E-mail Address"
                                >
                            @else
                                {{ $TNAdata['officeEmailAddress'] ?? '' }}
                            @endIf
                        </span></p>
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br>
                    </p>
                </td>
            </tr>
            <tr>
                <td
                    style="border-top: none;border-bottom: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;padding: 0cm 0.19cm;">
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br>
                    </p>
                </td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td
                    style="border: 1px solid #000000;padding: 0cm 0.19cm;"
                    rowspan="2"
                >
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                            lang="en-US"
                        >Factory Address:
                            @if ($isEditable)
                                <input
                                    id="factory_address"
                                    name="factory_address"
                                    type="text"
                                    value="XI"
                                    value="{{ $TNAdata['factory_address'] ?? ($TNAdata['factoryLandmark'] ?? '') . ' ' . ($TNAdata['factoryBarangay'] ?? '') . ' ' . ($TNAdata['factoryCity'] ?? '') . ' ' . ($TNAdata['factoryProvince'] ?? '') . ' ' . ($TNAdata['factoryRegion'] ?? '') . ' ' . ($TNAdata['factoryZipCode'] ?? '') }}"
                                    placeholder="Factory Address"
                                >
                            @else
                                {{ $TNAdata['factory_address'] ?? ($TNAdata['factoryLandmark'] ?? '') . ' ' . ($TNAdata['factoryBarangay'] ?? '') . ' ' . ($TNAdata['factoryCity'] ?? '') . ' ' . ($TNAdata['factoryProvince'] ?? '') . ' ' . ($TNAdata['factoryRegion'] ?? '') . ' ' . ($TNAdata['factoryZipCode'] ?? '') }}
                            @endIf
                        </span></p>
                    >
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br>
                    </p>
                </td>
                <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                            lang="en-US"
                        >Tel No.:
                            @if ($isEditable)
                                <input
                                    id="factoryTelNo"
                                    name="factoryTelNo"
                                    type="text"
                                    value="XI"
                                    value="{{ $TNAdata['factoryTelNo'] ?? '' }}"
                                    placeholder="Tel No."
                                >
                            @else
                                {{ $TNAdata['factoryTelNo'] ?? '' }}
                            @endIf
                        </span></p>
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br>
                    </p>
                </td>
                <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                            lang="en-US"
                        >Fax No.:&nbsp;
                            @if ($isEditable)
                                <input
                                    id="factoryFaxNo"
                                    name="factoryFaxNo"
                                    type="text"
                                    value="XI"
                                    value="{{ $TNAdata['factoryFaxNo'] ?? '' }}"
                                    placeholder="Fax No."
                                >
                            @else
                                {{ $TNAdata['factoryFaxNo'] ?? '' }}
                            @endIf
                        </span></p>
                </td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td
                    style="border: 1px solid #000000;padding: 0cm 0.19cm;"
                    colspan="2"
                >
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                            lang="en-US"
                        >E-mail Address:
                            @if ($isEditable)
                                <input
                                    id="factoryEmailAddress"
                                    name="factoryEmailAddress"
                                    type="text"
                                    value="XI"
                                    value="{{ $TNAdata['factoryEmailAddress'] ?? '' }}"
                                    placeholder="E-mail Address"
                                >
                            @else
                                {{ $TNAdata['factoryEmailAddress'] ?? '' }}
                            @endIf
                        </span></p>
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br>
                    </p>
                </td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td
                    style="border: 1px solid rgb(0, 0, 0);padding: 0cm 0.19cm;vertical-align: top;"
                    colspan="3"
                >
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                            lang="en-US"
                        >Website:
                            @if ($isEditable)
                                <input
                                    id="website"
                                    name="website"
                                    type="text"
                                    value="XI"
                                    value="{{ $TNAdata['website'] ?? '' }}"
                                    placeholder="Website"
                                >
                            @else
                                {{ $TNAdata['website'] ?? '' }}
                            @endIf
                        </span></p>
                </td>
            </tr>
        </tbody>
    </table>
    <p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
    <p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><span
            lang="en-AU"><strong>GENERAL AGREEMENTS:</strong></span></p>
    <p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
    <ol>
        <li>
            <p
                style="text-align: justify;background: transparent;line-height: 100%;margin-right: 0.02cm;margin-bottom: 0cm;">
                The applicant shall, at the earliest opportunity, make available to the DOST Regional Office No.
                @if ($isEditable)
                    <input
                        id="dost_regional_office_no"
                        name="dost_regional_office_no"
                        type="text"
                        value="XI"
                        style="width: 10%"
                        placeholder="DOST Regional Office No."
                    >
                @else
                    XI
                @endIf
                (DOST
                @if ($isEditable)
                    <input
                        id="dost_regional_office_no"
                        name="dost_regional_office_no"
                        type="text"
                        value="XI"
                        style="width: 10%"
                        placeholder="DOST Regional Office No."
                    >
                @else
                    XI
                @endIf
                ) all information (manuals, procedures, etc.) required to establish the technology status of the
                selected core business functions and management systems;
            </p>
        </li>
    </ol>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <br>&nbsp;
    </p>
    <ol start="2">
        <li>
            <p
                style="text-align: justify;background: transparent;line-height: 100%;margin-right: 0.02cm;margin-bottom: 0cm;">
                If DOST
                @if ($isEditable)
                    <input
                        id="dost_satisfaction"
                        name=""
                        type="text"
                        value="XI"
                        style="width: 10%"
                        placeholder="DOST satisfaction"
                    >
                @else
                    XI
                @endIf
                Regional Office No.
                @if ($isEditable)
                    <input
                        id="dost_regional_office_no"
                        name="dost_regional_office_no"
                        type="text"
                        value="XI"
                        style="width: 10%"
                        placeholder="DOST Regional Office No."
                    >
                @else
                    XI
                @endIf
                is not satisfied that all the requirements for business registration are complied with, it shall
                inform the applicant of the observed deficiencies before starting the assessment;
            </p>
        </li>
    </ol>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <br>&nbsp;
    </p>
    <ol start="3">
        <li>
            <p
                style="text-align: justify;background: transparent;line-height: 100%;margin-right: 0.02cm;margin-bottom: 0cm;">
                When the required inputs to the assessment are already supplied by the applicant, including Attachment
                A, the DOST
                @if ($isEditable)
                    <input
                        id="dost_supplied"
                        name="dost_supplied"
                        type="text"
                        value="XI"
                        style="width: 10%"
                        placeholder="DOST Regional Office No."
                    >
                @else
                    XI
                @endIf
                will assess the firm through the core business functions and management systems, whichever is
                applicable, to identify technology needs and verify compliance to standards vis-&agrave;-vis existing
                practices;
            </p>
        </li>
    </ol>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <br>&nbsp;
    </p>
    <ol start="4">
        <li>
            <p
                style="text-align: justify;background: transparent;line-height: 100%;margin-right: 0.02cm;margin-bottom: 0cm;">
                When the DOST
                @if ($isEditable)
                    <input
                        id="dost_regional_TNA"
                        name="dost_regional_TNA"
                        type="text"
                        value="XI"
                        style="width: 10%"
                        placeholder=""
                    >
                @else
                    XI
                @endIf
                has completed the technology assessment, a report will be prepared on the results of the assessment
                with accompanying recommendations and opportunities for improvement. The report prepared will define the
                scope of activities, functions, management practices and locations assessed. The applicant shall not
                claim or otherwise imply that the report applies to other locations, product or activities not covered
                by the report;
            </p>
        </li>
    </ol>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <br>&nbsp;
    </p>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <br>&nbsp;
    </p>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <br>&nbsp;
    </p>
    <ol start="5">
        <li>
            <p
                style="text-align: justify;background: transparent;line-height: 100%;margin-right: 0.02cm;margin-bottom: 0cm;">
                The applicant agrees that the report will not be used until permission has been granted by the DOST
                @if ($isEditable)
                    <input
                        id="dost_permission"
                        name="dost_permission"
                        type="text"
                        value="XI"
                        style="width: 10%"
                    >;
            </p>
        @else
            XI
            @endIf
        </li>
    </ol>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <br>&nbsp;
    </p>
    <ol start="6">
        <li>
            <p
                style="text-align: justify;background: transparent;line-height: 100%;margin-right: 0.02cm;margin-bottom: 0cm;">
                The applicant agrees that the receipt or acknowledgment of the report ends the assessment stage; any
                technical assistance ensuing from the recommendations of the report will be viewed as a separate
                project.</p>
        </li>
    </ol>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;text-indent: -1.27cm;margin-left: 1.27cm;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <br>&nbsp;
    </p>
    <p style="text-align: center;background: transparent;line-height: 108%;margin-bottom: 0cm;"><span
            style="color: rgb(39, 39, 39);"
        ><strong>UNDERTAKING</strong></span></p>
    <p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;margin-right: 0.02cm;">
        <br>&nbsp;
    </p>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <strong>I agree to undertake and observe the above General Agreements as stipulated by the Department of Science
            and Technology Regional Office No.
            @if ($isEditable)
                <input
                    id="dost_undertake"
                    name="dost_undertake"
                    type="text"
                    value="XI"
                    style="width: 10%"
                    placeholder="DOST Regional Office No."
                >.
            @else
                XI
            @endIf
        </strong>.
    </p>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <br>&nbsp;
    </p>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <br>&nbsp;
    </p>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <br>&nbsp;
    </p>

    <x-t-n-a-form.attachment-a :TNAdata="$TNAdata" :isEditable="$isEditable" />
    <x-t-n-a-form.t-n-a-form-one
        :TNAdata="$TNAdata"
        :organizationalStructure="$organizationalStructure"
        :isEditable="$isEditable"
    />

    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Production&nbsp;</span></p>
        </li>
    </ul>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <table
        style="width: 543px;"
        cellpadding="7"
    >
        <thead>
            <tr>
                <th style="border: 1px solid #000000;padding: 0cm 0.19cm;">Product</th>
                <th style="border: 1px solid #000000;padding: 0cm 0.19cm;">Volume of Production/Year</th>
                <th style="border: 1px solid #000000;padding: 0cm 0.19cm;">Unit Cost of Production (₱)</th>
                <th style="border: 1px solid #000000;padding: 0cm 0.19cm;">Annual Cost of Production (₱)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($TNAdata['production'] ?? [] as $production)
                <tr>
                    <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                        @if ($isEditable)
                            <input
                                class="Product"
                                type="text"
                                value="{{ $production['product'] ?? '' }}"
                            />
                        @else
                            {{ $production['product'] ?? '' }}
                        @endIf
                    </td>
                    <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                        @if ($isEditable)
                            <input
                                class="VolumeProduction"
                                type="text"
                                value="{{ $production['volumeProduction'] ?? '' }}"
                            />
                        @else
                            {{ $production['volumeProduction'] ?? '' }}
                        @endIf
                    </td>
                    <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                        @if ($isEditable)
                            <input
                                class="UnitCost"
                                type="text"
                                value="{{ $production['unitCost'] ?? '' }}"
                            />
                        @else
                            {{ $production['unitCost'] ?? '' }}
                        @endIf
                    </td>
                    <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                        @if ($isEditable)
                            <input
                                class="AnnualCost"
                                type="text"
                                value="{{ $production['annualCost'] ?? '' }}"
                            />
                        @else
                            {{ $production['annualCost'] ?? '' }}
                        @endIf
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Production Equipment</span></p>
        </li>
    </ul>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <table
        style="width: 556px;"
        cellpadding="7"
    >
        <tbody>
            <tr>
                <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                    <p style="line-height: 115%;text-align: center;margin-bottom: 0.25cm;background: transparent;">
                        <span lang="en-US"><strong>Type of Equipment</strong></span>
                    </p>
                </td>
                <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                    <p style="line-height: 115%;text-align: center;margin-bottom: 0.25cm;background: transparent;">
                        <span lang="en-US"><strong>Specifications</strong></span>
                    </p>
                </td>
                <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                    <p style="line-height: 115%;text-align: center;margin-bottom: 0.25cm;background: transparent;">
                        <span lang="en-US"><strong>Capacity</strong></span>
                    </p>
                </td>
            </tr>
            @foreach ($TNAdata['productionEquipment'] ?? [] as $productionEquipment)
                <tr>
                    <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                        @if ($isEditable)
                            <input
                                class="TypeOfEquipment"
                                type="text"
                                value="{{ $productionEquipment['typeOfEquipment'] ?? '' }}"
                            />
                        @else
                            {{ $productionEquipment['typeOfEquipment'] ?? '' }}
                        @endIf
                    </td>
                    <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                        @if ($isEditable)
                            <input
                                class="Specification"
                                type="text"
                                value="{{ $productionEquipment['specification'] ?? '' }}"
                            />
                        @else
                            {{ $productionEquipment['specification'] ?? '' }}
                        @endIf
                    </td>
                    <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                        @if ($isEditable)
                            <input
                                class="Capacity"
                                type="text"
                                value="{{ $productionEquipment['capacity'] ?? '' }}"
                            />
                        @else
                            {{ $productionEquipment['capacity'] ?? '' }}
                        @endIf
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Production Problems and Concern</span></p>
        </li>
    </ul>
    <table
        style="width: 587px;"
        cellpadding="7"
    >
        <tbody>
            <tr>
                <td style="">
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br>
                    </p>
                </td>
            </tr>

            <tr>
                <td
                    style="border-width: medium medium 1px;border-style: none none solid;border-color: currentcolor currentcolor rgb(0, 0, 0);padding: 0cm;vertical-align: top;">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="ProductionProblemAndConcern"
                            style="width: 100%;"
                        >{{ $TNAdata['ProductionProblemAndConcern'] ?? '' }}</textarea>
                    @else
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                            <span lang="en-US">{{ $TNAdata['ProductionProblemAndConcern'] ?? '' }}</span>
                        </p>
                    @endIf
                </td>
            </tr>
        </tbody>
    </table>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Production Waste Management System</span></p>
        </li>
    </ul>
    <table
        style="width: 587px;"
        cellpadding="7"
    >
        <tbody>

            <tr>
                <td
                    style="border-width: medium medium 1px;border-style: none none solid;border-color: currentcolor currentcolor rgb(0, 0, 0);padding: 0cm;vertical-align: top;">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="ProductionWasteManageSystem"
                            style="width: 100%;"
                        >{{ $TNAdata['ProductionWasteManageSystem'] ?? '' }}</textarea>
                    @else
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                            <span lang="en-US">{{ $TNAdata['ProductionWasteManageSystem'] ?? '' }}</span>
                        </p>
                    @endIf
                </td>
            </tr>
        </tbody>
    </table>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Production Plan</span></p>
        </li>
    </ul>
    <table
        style="width: 587px;"
        cellpadding="7"
    >
        <tbody>

            <tr>
                <td
                    style="border-width: medium medium 1px;border-style: none none solid;border-color: currentcolor currentcolor rgb(0, 0, 0);padding: 0cm;vertical-align: top;">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="ProductionPlan"
                            style="width: 100%;"
                        >{{ $TNAdata['ProductionPlan'] ?? '' }}</textarea>
                    @else
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                            <span lang="en-US">{{ $TNAdata['ProductionPlan'] ?? '' }}</span>
                        </p>
                    @endIf
                </td>
            </tr>

        </tbody>
    </table>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Plant Lay-Out</span>
            </p>
            @if ($planLayout)
                <img
                    src="data:image/png;base64,{{ $planLayout }}"
                    alt=""
                    style="width: 16.17cm; height: 16.17cm"
                >
            @else
                <p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;
                </p>
                <p>No image available</p>
                <p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;
                </p>
            @endif
        </li>
    </ul>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Process Flow</span></p>
            @if ($processFlow)
                <img
                    src="data:image/png;base64,{{ $processFlow }}"
                    alt=""
                    style="width: 16.17cm; height: 16.17cm"
                >
            @else
                <p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;
                </p>
                <p>No image available</p>
                <p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;
                </p>
            @endif
        </li>
    </ul>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Inventory System</span></p>
        </li>
    </ul>
    <table
        style="width: 587px;"
        cellpadding="7"
    >
        <tbody>
            <tr>
                <td
                    style="border-width: medium medium 1px;border-style: none none solid;border-color: currentcolor currentcolor rgb(0, 0, 0);padding: 0cm;vertical-align: top;">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="InventorySystem"
                            style="width: 100%;"
                        >{{ $TNAdata['InventorySystem'] ?? '' }}</textarea>
                    @else
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                            <span lang="en-US">{{ $TNAdata['InventorySystem'] ?? '' }}</span>
                        </p>
                    @endIf
                </td>
            </tr>
        </tbody>
    </table>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Maintenance Program</span></p>
        </li>
    </ul>
    <table
        style="width: 587px;"
        cellpadding="7"
    >
        <tbody>
            <tr>
                <td
                    style="border-width: medium medium 1px;border-style: none none solid;border-color: currentcolor currentcolor rgb(0, 0, 0);padding: 0cm;vertical-align: top;">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="MaintenanceProgram"
                            style="width: 100%;"
                        >{{ $TNAdata['MaintenanceProgram'] ?? '' }}</textarea>
                    @else
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                            <span lang="en-US">{{ $TNAdata['MaintenanceProgram'] ?? '' }}</span>
                        </p>
                    @endIf
                </td>
            </tr>
        </tbody>
    </table>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >cGMP/HACCP Activities</span></p>
        </li>
    </ul>
    <table
        style="width: 587px;"
        cellpadding="7"
    >
        <tbody>
            <tr>
                <td
                    style="border-width: medium medium 1px;border-style: none none solid;border-color: currentcolor currentcolor rgb(0, 0, 0);padding: 0cm;vertical-align: top;">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="cGMPHACCPActivities"
                            style="width: 100%;"
                        >{{ $TNAdata['cGMPHACCPActivities'] ?? '' }}</textarea>
                    @else
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                            <span lang="en-US">{{ $TNAdata['cGMPHACCPActivities'] ?? '' }}</span>
                        </p>
                    @endIf
                </td>
            </tr>
        </tbody>
    </table>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Supplies/Purchasing System</span></p>
        </li>
    </ul>
    <table
        style="width: 587px;"
        cellpadding="7"
    >
        <tbody>
            <tr>
                <td
                    style="border-width: medium medium 1px;border-style: none none solid;border-color: currentcolor currentcolor rgb(0, 0, 0);padding: 0cm;vertical-align: top;">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="SuppliesPurchasingSystem"
                            style="width: 100%;"
                        >{{ $TNAdata['SuppliesPurchasingSystem'] ?? '' }}</textarea>
                    @else
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                            <span lang="en-US">{{ $TNAdata['SuppliesPurchasingSystem'] ?? '' }}</span>
                        </p>
                    @endIf
                </td>
            </tr>
        </tbody>
    </table>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                ><strong>Marketing</strong></span></p>
        </li>
    </ul>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 1.27cm;"><br>
    </p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Marketing Plan</span></p>
        </li>
    </ul>
    <table
        style="width: 587px;"
        cellpadding="7"
    >
        <tbody>
            <tr>
                <td
                    style="border-width: medium medium 1px;border-style: none none solid;border-color: currentcolor currentcolor rgb(0, 0, 0);padding: 0cm;vertical-align: top;">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="MarketingPlan"
                            style="width: 100%;"
                        >{{ $TNAdata['MarketingPlan'] ?? '' }}</textarea>
                    @else
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                            <span lang="en-US">{{ $TNAdata['MarketingPlan'] ?? '' }}</span>
                        </p>
                    @endIf
                </td>
            </tr>
        </tbody>
    </table>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Market Outlets and Number</span></p>
        </li>
    </ul>
    <table
        style="width: 587px;"
        cellpadding="7"
    >
        <tbody>
            <tr>
                <td
                    style="border-width: medium medium 1px;border-style: none none solid;border-color: currentcolor currentcolor rgb(0, 0, 0);padding: 0cm;vertical-align: top;">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="MarketOutlets"
                            style="width: 100%;"
                        >{{ $TNAdata['MarketOutlets'] ?? '' }}</textarea>
                    @else
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                            <span lang="en-US">{{ $TNAdata['MarketOutlets'] ?? '' }}</span>
                        </p>
                    @endIf
                </td>
            </tr>
        </tbody>
    </table>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Promotional Strategies</span></p>
        </li>
    </ul>
    <table
        style="width: 587px;"
        cellpadding="7"
    >
        <tbody>
            <tr>
                <td
                    style="border-width: medium medium 1px;border-style: none none solid;border-color: currentcolor currentcolor rgb(0, 0, 0);padding: 0cm;vertical-align: top;">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="PromotionalStrategies"
                            style="width: 100%;"
                        >{{ $TNAdata['PromotionalStrategies'] ?? '' }}</textarea>
                    @else
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                            <span lang="en-US">{{ $TNAdata['PromotionalStrategies'] ?? '' }}</span>
                        </p>
                    @endIf
                </td>
            </tr>
        </tbody>
    </table>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Market Competitors</span></p>
        </li>
    </ul>
    <table
        style="width: 587px;"
        cellpadding="7"
    >
        <tbody>
            <tr>
                <td
                    style="border-width: medium medium 1px;border-style: none none solid;border-color: currentcolor currentcolor rgb(0, 0, 0);padding: 0cm;vertical-align: top;">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="MarketCompetitors"
                            style="width: 100%;"
                        >{{ $TNAdata['MarketCompetitors'] ?? '' }}</textarea>
                    @else
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                            <span lang="en-US">{{ $TNAdata['MarketCompetitors'] ?? '' }}</span>
                        </p>
                    @endIf
                </td>
            </tr>
        </tbody>
    </table>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Packaging</span></p>
        </li>
    </ul>
    <dl>
        <dd>
            <dl>
                <dd>
                    <dl>
                        <dd>
                            <table
                                style="width: 455px;"
                                cellpadding="7"
                            >
                                <tbody>
                                    <tr>
                                        <td style="border: none;padding: 0cm;">
                                            @if ($isEditable)
                                                <input
                                                    name="nutritionEvaluation"
                                                    type="checkbox"
                                                    value="on"
                                                    style="width: 15px; height: 15px;"
                                                    {{ isset($TNAdata['nutritionEvaluation']) && $TNAdata['nutritionEvaluation'] == 'on' ? 'checked' : '' }}
                                                />
                                            @else
                                                {{ isset($TNAdata['nutritionEvaluation']) && $TNAdata['nutritionEvaluation'] == 'on' ? '/' : '' }}
                                            @endif
                                        </td>
                                        <td style="border: none;padding: 0cm;">
                                            <p
                                                style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                                                <span lang="en-US">Nutrition Evaluation</span>
                                            </p>
                                        </td>
                                        <td
                                            style="border-top: none;border-bottom: 1px solid #000000;border-left: none;border-right: none;padding: 0cm;">
                                            @if ($isEditable)
                                                <input
                                                    name="nutritionEvaluationDetails"
                                                    type="text"
                                                    value="{{ $TNAdata['nutritionEvaluationDetails'] ?? '' }}"
                                                    style="width: 100%;"
                                                />
                                            @else
                                                {{ $TNAdata['nutritionEvaluationDetails'] ?? '' }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: none;padding: 0cm;">
                                            @if ($isEditable)
                                                <input
                                                    name="barCode"
                                                    type="checkbox"
                                                    value="on"
                                                    style="width: 15px; height: 15px;"
                                                    {{ isset($TNAdata['barCode']) && $TNAdata['barCode'] == 'on' ? 'checked' : '' }}
                                                />
                                            @else
                                                {{ isset($TNAdata['barCode']) && $TNAdata['barCode'] == 'on' ? '/' : '' }}
                                            @endif
                                        </td>
                                        <td style="border: none;padding: 0cm;">
                                            <p
                                                style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                                                <span lang="en-US">Bar Code</span>
                                            </p>
                                        </td>
                                        <td
                                            style="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: none;border-right: none;padding: 0cm;">
                                            @if ($isEditable)
                                                <input
                                                    name="barCodeDetails"
                                                    type="text"
                                                    value="{{ $TNAdata['barCodeDetails'] ?? '' }}"
                                                    style="width: 100%;"
                                                />
                                            @else
                                                {{ $TNAdata['barCodeDetails'] ?? '' }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: none;padding: 0cm;">
                                            @if ($isEditable)
                                                <input
                                                    name="productLabel"
                                                    type="checkbox"
                                                    value="on"
                                                    style="width: 15px; height: 15px;"
                                                    {{ isset($TNAdata['productLabel']) && $TNAdata['productLabel'] == 'on' ? 'checked' : '' }}
                                                />
                                            @else
                                                {{ isset($TNAdata['productLabel']) && $TNAdata['productLabel'] == 'on' ? '/' : '' }}
                                            @endif
                                        </td>
                                        <td style="border: none;padding: 0cm;">
                                            <p
                                                style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                                                <span lang="en-US">Product Label</span>
                                            </p>
                                        </td>
                                        <td
                                            style="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: none;border-right: none;padding: 0cm;">
                                            @if ($isEditable)
                                                <input
                                                    name="productLabelDetails"
                                                    type="text"
                                                    value="{{ $TNAdata['productLabelDetails'] ?? '' }}"
                                                    style="width: 100%;"
                                                />
                                            @else
                                                {{ $TNAdata['productLabelDetails'] ?? '' }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: none;padding: 0cm;">
                                            @if ($isEditable)
                                                <input
                                                    name="expiryDate"
                                                    type="checkbox"
                                                    value="on"
                                                    style="width: 15px; height: 15px;"
                                                    {{ isset($TNAdata['expiryDate']) && $TNAdata['expiryDate'] == 'on' ? 'checked' : '' }}
                                                />
                                            @else
                                                {{ isset($TNAdata['expiryDate']) && $TNAdata['expiryDate'] == 'on' ? '/' : '' }}
                                            @endif
                                        </td>
                                        <td style="border: none;padding: 0cm;">
                                            <p
                                                style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                                                <span lang="en-US">Expiry Date</span>
                                            </p>
                                        </td>
                                        <td
                                            style="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: none;border-right: none;padding: 0cm;">
                                            @if ($isEditable)
                                                <input
                                                    name="expiryDateDetails"
                                                    type="text"
                                                    value="{{ $TNAdata['expiryDateDetails'] ?? '' }}"
                                                    style="width: 100%;"
                                                />
                                            @else
                                                {{ $TNAdata['expiryDateDetails'] ?? '' }}
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </dd>
                    </dl>
                </dd>
            </dl>
        </dd>
    </dl>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                ><strong>Finance</strong></span></p>
        </li>
    </ul>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 1.27cm;"><br>
    </p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Cash Flow or other related documents</span></p>
        </li>
    </ul>
    <table
        style="width: 587px;"
        cellpadding="7"
    >
        <tbody>

            <tr>
                <td
                    style="border-width: medium medium 1px;border-style: none none solid;border-color: currentcolor currentcolor rgb(0, 0, 0);padding: 0cm;vertical-align: top;">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="CashFlowAndRelatedDocuments"
                            style="width: 100%;"
                        >{{ $TNAdata['CashFlowAndRelatedDocuments'] ?? '' }}</textarea>
                    @else
                        {{ $TNAdata['CashFlowAndRelatedDocuments'] ?? '' }}
                    @endif
                </td>
            </tr>

        </tbody>
    </table>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Source(s) of capital/credit</span></p>
        </li>
    </ul>
    <table
        style="width: 587px;"
        cellpadding="7"
    >
        <tbody>

            <tr>
                <td
                    style="border-width: medium medium 1px;border-style: none none solid;border-color: currentcolor currentcolor rgb(0, 0, 0);padding: 0cm;vertical-align: top;">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="SourceOfCapitalCredits"
                            style="width: 100%;"
                        >{{ $TNAdata['SourceOfCapitalCredits'] ?? '' }}</textarea>
                    @else
                        {{ $TNAdata['SourceOfCapitalCredits'] ?? '' }}
                    @endif
                </td>
            </tr>

        </tbody>
    </table>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Accounting System</span></p>
        </li>
    </ul>
    <table
        style="width: 587px;"
        cellpadding="7"
    >
        <tbody>
            <tr>
                <td
                    style="border-width: medium medium 1px;border-style: none none solid;border-color: currentcolor currentcolor rgb(0, 0, 0);padding: 0cm;vertical-align: top;">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="AccountingSystem"
                            style="width: 100%;"
                        >{{ $TNAdata['AccountingSystem'] ?? '' }}</textarea>
                    @else
                        {{ $TNAdata['AccountingSystem'] ?? '' }}
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                ><strong>Human Resources</strong></span></p>
        </li>
    </ul>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 1.27cm;"><br>
    </p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Hiring and Criteria</span></p>
        </li>
    </ul>
    <table
        style="width: 587px;"
        cellpadding="7"
    >
        <tbody>
            <tr>
                <td
                    style="border-width: medium medium 1px;border-style: none none solid;border-color: currentcolor currentcolor rgb(0, 0, 0);padding: 0cm;vertical-align: top;">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="HiringAndCriteria"
                            style="width: 100%;"
                        >{{ $TNAdata['HiringAndCriteria'] ?? '' }}</textarea>
                    @else
                        {{ $TNAdata['HiringAndCriteria'] ?? '' }}
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Incentives to Employees</span></p>
        </li>
    </ul>
    <table
        style="width: 587px;"
        cellpadding="7"
    >
        <tbody>
            <tr>
                <td
                    style="border-width: medium medium 1px;border-style: none none solid;border-color: currentcolor currentcolor rgb(0, 0, 0);padding: 0cm;vertical-align: top;">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="IncentivesToEmployees"
                            style="width: 100%;"
                        >{{ $TNAdata['IncentivesToEmployees'] ?? '' }}</textarea>
                    @else
                        {{ $TNAdata['IncentivesToEmployees'] ?? '' }}
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Training and Development</span></p>
        </li>
    </ul>
    <table
        style="width: 587px;"
        cellpadding="7"
    >
        <tbody>
            <tr>
                <td
                    style="border-width: medium medium 1px;border-style: none none solid;border-color: currentcolor currentcolor rgb(0, 0, 0);padding: 0cm;vertical-align: top;">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="TrainingAndDevelopment"
                            style="width: 100%;"
                        >{{ $TNAdata['TrainingAndDevelopment'] ?? '' }}</textarea>
                    @else
                        {{ $TNAdata['TrainingAndDevelopment'] ?? '' }}
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Safety Measures Practiced</span></p>
        </li>
    </ul>
    <table
        style="width: 587px;"
        cellpadding="7"
    >
        <tbody>
            <tr>
                <td
                    style="border-width: medium medium 1px;border-style: none none solid;border-color: currentcolor currentcolor rgb(0, 0, 0);padding: 0cm;vertical-align: top;">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="SafetyMeasuresPracticed"
                            style="width: 100%;"
                        >{{ $TNAdata['SafetyMeasuresPracticed'] ?? '' }}</textarea>
                    @else
                        {{ $TNAdata['SafetyMeasuresPracticed'] ?? '' }}
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Other Employee Welfare</span></p>
        </li>
    </ul>
    <table
        style="width: 587px;"
        cellpadding="7"
    >
        <tbody>
            <tr>
                <td
                    style="border-width: medium medium 1px;border-style: none none solid;border-color: currentcolor currentcolor rgb(0, 0, 0);padding: 0cm;vertical-align: top;">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="OtherEmployeeWelfare"
                            style="width: 100%;"
                        >{{ $TNAdata['OtherEmployeeWelfare'] ?? '' }}</textarea>
                    @else
                        {{ $TNAdata['OtherEmployeeWelfare'] ?? '' }}
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                ><strong>Other Concerns</strong></span></p>
        </li>
    </ul>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 1.27cm;"><br>
    </p>
    <table
        style="width: 587px;"
        cellpadding="7"
    >
        <tbody>
            <tr>
                <td
                    style="border-width: medium medium 1px;border-style: none none solid;border-color: currentcolor currentcolor rgb(0, 0, 0);padding: 0cm;vertical-align: top;">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="OtherConcerns"
                            style="width: 100%;"
                        >{{ $TNAdata['OtherConcerns'] ?? '' }}</textarea>
                    @else
                        {{ $TNAdata['OtherConcerns'] ?? '' }}
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
</div>
