@props(['TNAdata', 'isEditable', 'isExporting' => false])
@php
    use App\Services\ApplicantFileHandlerService;
    try {
        $organizationalStructure = ApplicantFileHandlerService::getRequirementImageAsBase64(
            'Organizational Structure',
            $TNAdata['business_id'],
        );
        $planLayout = ApplicantFileHandlerService::getRequirementImageAsBase64('Plan Layout', $TNAdata['business_id']);
        $processFlow = ApplicantFileHandlerService::getRequirementImageAsBase64(
            'Process Flow',
            $TNAdata['business_id'],
        );
    } catch (Exception $e) {
        Log::error('Error retrieving file: ' . $e->getMessage());
    }
@endphp
<div id="formWrapper">
    <form
        id="TNAForm"
        @if ($isEditable) action="{{ URL::signedRoute('staff.Applicant.set.tna', ['business_id' => $TNAdata['business_id'], 'application_id' => $TNAdata['application_id']]) }}"
    method="POST" @endif
    >
        @csrf
        @method('PUT')
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                lang="en-US"><strong>DOST TNA Form 01</strong></span></p>
        <p style="text-align: center;background: transparent;line-height: 108%;margin-bottom: 0.28cm;"><br>&nbsp;</p>
        <p style="text-align: center;background: transparent;line-height: 108%;margin-bottom: 0.28cm;"><br>&nbsp;</p>
        <p style="text-align: center;background: transparent;line-height: 108%;margin-bottom: 0.28cm;"><span
                lang="en-US"
            ><u><strong>APPLICATION FOR TECHNOLOGY NEEDS ASSESSMENT</strong></u></span></p>
        <p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
        <table
            id="EnterpriseInformationTable"
            style="width: 100%; table-layout: fixed;"
            cellpadding="7"
        >
            <tbody>
                <tr>
                    <td
                        style="padding: 0cm 0.19cm;vertical-align: center;"
                        colspan="3"
                    >
                        <p style="line-height: 115%;text-align: left;background: transparent;">
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
                    <td style="padding: 0cm 0.19cm;">
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
                        style="padding: 0cm 0.19cm;"
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
                                @else
                                    {{ $TNAdata['designation'] ?? '' }}
                                @endIf
                            </span>
                        </p>
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td
                        style="padding: 0cm 0.19cm;"
                        rowspan="2"
                    >
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0cm;background: transparent;">
                            <span lang="en-US">Office Address:&nbsp;
                                @if ($isEditable)
                                    <input
                                        id="office_address"
                                        name="office_address"
                                        type="text"
                                        value="{{ $TNAdata['office_address'] ?? ($TNAdata['office_landmark'] ?? '') . ' ' . ($TNAdata['office_barangay'] ?? '') . ' ' . ($TNAdata['office_city'] ?? '') . ' ' . ($TNAdata['office_province'] ?? '') . ' ' . ($TNAdata['office_region'] ?? '') . ' ' . ($TNAdata['office_zip_code'] ?? '') }}"
                                        placeholder="Office Address"
                                    >
                                @else
                                    {{ $TNAdata['office_address'] ?? ($TNAdata['office_landmark'] ?? '') . ' ' . ($TNAdata['office_barangay'] ?? '') . ' ' . ($TNAdata['office_city'] ?? '') . ' ' . ($TNAdata['office_province'] ?? '') . ' ' . ($TNAdata['office_region'] ?? '') . ' ' . ($TNAdata['office_zip_code'] ?? '') }}
                                @endIf
                            </span>
                        </p>
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                            <br>
                        </p>
                    </td>
                    <td style="padding: 0cm 0.19cm;">
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                                lang="en-US"
                            >Tel No.:
                                @if ($isEditable)
                                    <input
                                        id="office_telNo"
                                        name="office_telNo"
                                        type="text"
                                        value="{{ $TNAdata['office_telNo'] ?? '' }}"
                                        placeholder="Tel No."
                                    >
                                @else
                                    {{ $TNAdata['office_telNo'] ?? '' }}
                                @endIf
                            </span>
                        </p>
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                            <br>
                        </p>
                    </td>
                    <td style="padding: 0cm 0.19cm;">
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                            <span lang="en-US">Fax No.:
                                @if ($isEditable)
                                    <input
                                        id="office_faxNo"
                                        name="office_faxNo"
                                        type="text"
                                        value="{{ $TNAdata['office_faxNo'] ?? '' }}"
                                        placeholder="Fax No."
                                    >
                                @else
                                    {{ $TNAdata['office_faxNo'] ?? '' }}
                                @endIf
                            </span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td
                        style="padding: 0cm 0.19cm;"
                        colspan="2"
                    >
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                                lang="en-US"
                            >E-mail Address:&nbsp;
                                @if ($isEditable)
                                    <input
                                        id="office_emailAddress"
                                        name="office_emailAddress"
                                        type="text"
                                        value="{{ $TNAdata['office_emailAddress'] ?? '' }}"
                                        placeholder="E-mail Address"
                                    >
                                @else
                                    {{ $TNAdata['office_emailAddress'] ?? '' }}
                                @endIf
                            </span></p>
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                            <br>
                        </p>
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td
                        style="padding: 0cm 0.19cm;"
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
                                        value="{{ $TNAdata['factory_address'] ?? ($TNAdata['office_landmark'] ?? '') . ' ' . ($TNAdata['factory_barangay'] ?? '') . ' ' . ($TNAdata['factory_city'] ?? '') . ' ' . ($TNAdata['factory_province'] ?? '') . ' ' . ($TNAdata['factory_region'] ?? '') . ' ' . ($TNAdata['office_zipcode'] ?? '') }}"
                                        placeholder="Factory Address"
                                    >
                                @else
                                    {{ $TNAdata['factory_address'] ?? ($TNAdata['office_landmark'] ?? '') . ' ' . ($TNAdata['factory_barangay'] ?? '') . ' ' . ($TNAdata['factory_city'] ?? '') . ' ' . ($TNAdata['factory_province'] ?? '') . ' ' . ($TNAdata['factory_region'] ?? '') . ' ' . ($TNAdata['office_zipcode'] ?? '') }}
                                @endIf
                            </span></p>
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                            <br>
                        </p>
                    </td>
                    <td style="padding: 0cm 0.19cm;">
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                                lang="en-US"
                            >Tel No.:
                                @if ($isEditable)
                                    <input
                                        id="factory_telNo"
                                        name="factory_telNo"
                                        type="text"
                                        value="{{ $TNAdata['factory_telNo'] ?? '' }}"
                                        placeholder="Tel No."
                                    >
                                @else
                                    {{ $TNAdata['factory_telNo'] ?? '' }}
                                @endIf
                            </span></p>
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                            <br>
                        </p>
                    </td>
                    <td style="padding: 0cm 0.19cm;">
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                            <span lang="en-US">Fax No.:&nbsp;
                                @if ($isEditable)
                                    <input
                                        id="factory_faxNo"
                                        name="factory_faxNo"
                                        type="text"
                                        value="{{ $TNAdata['factory_faxNo'] ?? '' }}"
                                        placeholder="Fax No."
                                    >
                                @else
                                    {{ $TNAdata['factory_faxNo'] ?? '' }}
                                @endIf
                            </span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td
                        style="padding: 0cm 0.19cm;"
                        colspan="2"
                    >
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                                lang="en-US"
                            >E-mail Address:
                                @if ($isEditable)
                                    <input
                                        id="factory_emailAddress"
                                        name="factory_emailAddress"
                                        type="text"
                                        value="{{ $TNAdata['factory_emailAddress'] ?? '' }}"
                                        placeholder="E-mail Address"
                                    >
                                @else
                                    {{ $TNAdata['factory_emailAddress'] ?? '' }}
                                @endIf
                            </span></p>
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                            <br>
                        </p>
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td
                        style="padding: 0cm 0.19cm;vertical-align: top;"
                        colspan="3"
                    >
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                            <span lang="en-US">Website:
                                @if ($isEditable)
                                    <input
                                        id="website"
                                        name="website"
                                        type="text"
                                        value="{{ $TNAdata['website'] ?? '' }}"
                                        placeholder="Website"
                                    >
                                @else
                                    {{ $TNAdata['website'] ?? '' }}
                                @endIf
                            </span>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
        <p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><span
                lang="en-AU"
            ><strong>GENERAL AGREEMENTS:</strong></span></p>
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
                    When the required inputs to the assessment are already supplied by the applicant, including
                    Attachment
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
                    applicable, to identify technology needs and verify compliance to standards vis-&agrave;-vis
                    existing
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
                    with accompanying recommendations and opportunities for improvement. The report prepared will define
                    the
                    scope of activities, functions, management practices and locations assessed. The applicant shall not
                    claim or otherwise imply that the report applies to other locations, product or activities not
                    covered
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
        <p
            style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;margin-right: 0.02cm;">
            <br>&nbsp;
        </p>
        <p
            style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
            <strong>I agree to undertake and observe the above General Agreements as stipulated by the Department of
                Science
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
        <div style="width: 100%;">
            <table style="width: 40%; margin-left: auto; border-collapse: collapse; text-align: center;">
                <tr>
                    <td>
                        @if ($isEditable)
                            <input
                                id="dost_undertake_contact_person"
                                name="dost_undertake_contact_person"
                                type="text"
                                value="{{ $TNAdata['dost_undertake_contact_person'] ?? ($TNAdata['contact_person'] ?? ($TNAdata['prefix'] ?? '') . ' ' . ($TNAdata['f_name'] ?? '') . ' ' . ($TNAdata['middle_name'] ?? '') . ' ' . ($TNAdata['l_name'] ?? '') . ' ' . ($TNAdata['suffix'] ?? '')) }}"
                                style="width: 100%; text-align: center;"
                                placeholder=""
                            >
                        @else
                            {{ $TNAdata['dost_undertake_contact_person'] ?? ($TNAdata['contact_person'] ?? ($TNAdata['prefix'] ?? '') . ' ' . ($TNAdata['f_name'] ?? '') . ' ' . ($TNAdata['middle_name'] ?? '') . ' ' . ($TNAdata['l_name'] ?? '') . ' ' . ($TNAdata['suffix'] ?? '')) }}
                        @endIf
                    </td>
                </tr>
                <tr>
                    <td style="border-top: 1pt solid black; padding-top: 3pt;">
                        <strong>Signature over Printed Name</strong>
                    </td>
                </tr>
                <tr>
                    <td>
                        @if ($isEditable)
                            <input
                                id="dost_undertake_position"
                                name="dost_undertake_position"
                                type="text"
                                value="{{ $TNAdata['dost_undertake_position'] ?? ($TNAdata['designation'] ?? '') }}"
                                style="width: 100%; text-align: center;"
                                placeholder=""
                            >
                        @else
                            {{ $TNAdata['dost_undertake_position'] ?? ($TNAdata['designation'] ?? '') }}
                        @endIf
                    </td>
                </tr>
                <tr>
                    <td style="border-top: 1pt solid black; padding-top: 3pt;">
                        <strong>Position in the Enterprise</strong>
                    </td>
                </tr>
                <tr>
                    <td>
                        @if ($isEditable)
                            <input
                                id="dost_undertake_date"
                                name="dost_undertake_date"
                                type="date"
                                value="{{ $TNAdata['dost_undertake_date'] ?? '' }}"
                                style="width: 100%; text-align: center;"
                                placeholder=""
                            >
                        @else
                            {{ \Carbon\Carbon::parse($TNAdata['dost_undertake_date'] ?? '')->format('F j, Y') }}
                        @endIf
                    </td>
                </tr>
                <tr>
                    <td style="border-top: 1pt solid black; padding-top: 3pt;">
                        <strong>Date</strong>
                    </td>
                </tr>
            </table>
        </div>

        <p
            style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
            <br>&nbsp;
        </p>
        <p
            style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
            <br>&nbsp;
        </p>

        <x-t-n-a-form.attachment-a
            :TNAdata="$TNAdata"
            :isEditable="$isEditable"
        />
        <x-t-n-a-form.t-n-a-form-one
            :TNAdata="$TNAdata"
            :organizationalStructure="$organizationalStructure ?? ''"
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
        <ul>
            <li>
                <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                        lang="en-US"
                    >Production&nbsp;</span></p>
            </li>
        </ul>
        <div id="productionContainer">
            @if ($isEditable)
                <div
                    class="mb-3"
                    style="text-align: right; "
                >
                    <button
                        class="btn btn-sm btn-success"
                        id="addProductionRow"
                        type="button"
                    ><i class="ri-add-line"></i></button>
                    <button
                        class="btn btn-sm btn-danger"
                        id="removeProductionRow"
                        data-remove-row-btn
                        type="button"
                    ><i class="ri-subtract-line"></i></button>
                </div>
            @endif
            <table
                id="productionTable"
                style="width: 100%; table-layout: fixed; border-collapse: collapse;"
                cellpadding="7"
            >
                <thead>
                    <th width="25%">Product</th>
                    <th width="25%">Volume of <br>Production/Year</th>
                    <th width="25%">Unit Cost of <br>Production (₱)</th>
                    <th width="25%">Annual Cost of <br>Production (₱)</th>
                </thead>
                <tbody>
                    @forelse ($TNAdata['production'] ?? [] as $production)
                        <tr>
                            <td>
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
                            <td>
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
                            <td>
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
                            <td>
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
                    @empty
                        <tr>
                            <td>
                                @if ($isEditable)
                                    <input
                                        class="Product"
                                        type="text"
                                        value=""
                                    />
                                @endIf
                                <br>
                            </td>
                            <td>
                                @if ($isEditable)
                                    <input
                                        class="VolumeProduction"
                                        type="text"
                                        value=""
                                    />
                                @endIf
                                <br>
                            </td>
                            <td>
                                @if ($isEditable)
                                    <input
                                        class="UnitCost"
                                        type="text"
                                        value=""
                                    />
                                @endIf
                                <br>
                            </td>
                            <td>
                                @if ($isEditable)
                                    <input
                                        class="AnnualCost"
                                        type="text"
                                        value=""
                                    />
                                @endIf
                                <br>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;">
            <br>
        </p>
        <ul>
            <li>
                <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                        lang="en-US"
                    >Production Equipment</span></p>
            </li>
        </ul>
        <div id="productionEquipmentContainer">
            @if ($isEditable)
                <div
                    class="mb-3"
                    style="text-align: right;"
                >
                    <button
                        class="btn btn-sm btn-success"
                        id="addProductionEquipmentRow"
                        type="button"
                    ><i class="ri-add-line"></i></button>
                    <button
                        class="btn btn-sm btn-danger"
                        id="removeProductionEquipmentRow"
                        data-remove-row-btn
                        type="button"
                    ><i class="ri-subtract-line"></i></button>
                </div>
            @endif
            <table
                id="productionEquipmentTable"
                style="width: 100%; table-layout: fixed; border-collapse: collapse;"
                cellpadding="7"
            >
                <thead>
                    <th width="33.33%">
                        Type of Equipment
                    </th>
                    <th width="33.33%">
                        Specifications
                    </th>
                    <th width="33.33%">
                        Capacity
                    </th>
                </thead>
                <tbody>
                    @forelse ($TNAdata['productionEquipment'] ?? [] as $productionEquipment)
                        <tr>
                            <td>
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
                            <td>
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
                            <td>
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
                    @empty
                        <tr>
                            <td>
                                @if ($isEditable)
                                    <input
                                        class="TypeOfEquipment"
                                        type="text"
                                        value=""
                                    />
                                @endIf
                            </td>
                            <td>
                                @if ($isEditable)
                                    <input
                                        class="Specification"
                                        type="text"
                                        value=""
                                    />
                                @endIf
                            </td>
                            <td>
                                @if ($isEditable)
                                    <input
                                        class="Capacity"
                                        type="text"
                                        value=""
                                    />
                                @endIf
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
        <ul>
            <li>
                <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                        lang="en-US"
                    >Production Problems and Concern</span></p>
            </li>
        </ul>
        <table
            style="width: 100%; table-layout: fixed;"
            cellpadding="7"
        >
            <tbody>

                <tr>
                    <td style="">
                        <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                            <br>
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
                            <p class="custom--justify">
                                <u>{{ $TNAdata['ProductionProblemAndConcern'] ?? '' }}</u>
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
            style="width: 100%; table-layout: fixed;"
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
                            <p class="custom--justify">
                                <u>{{ $TNAdata['ProductionWasteManageSystem'] ?? '' }}</u>
                            </p>
                        @endIf
                    </td>
                </tr>
            </tbody>
        </table>
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;">
            <br>
        </p>
        <ul>
            <li>
                <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                        lang="en-US"
                    >Production Plan</span></p>
            </li>
        </ul>
        <table
            style="width: 100%; table-layout: fixed;"
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
                            <p class="custom--justify">
                                <u>{{ $TNAdata['ProductionPlan'] ?? '' }}</u>
                            </p>
                        @endIf
                    </td>
                </tr>

            </tbody>
        </table>
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;">
            <br>
        </p>
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;">
            <br>
        </p>
        <ul>
            <li>
                <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                        lang="en-US"
                    >Plant Lay-Out</span>
                </p>
                @if ($isEditable)
                    <div class="plan-layout-image-upload">
                        <label
                            class="form-label"
                            for="planLayout"
                        >Upload Plan Layout</label>
                        <input
                            id="planLayout"
                            name="planLayout"
                            type="file"
                        >
                        <input
                            id="PlanLayoutFileID_Data_Handler"
                            name="PlanLayoutFileID_Data_Handler"
                            type="hidden"
                        >
                    </div>
                @endif
                <table style="width: 100%; table-layout: fixed;">
                    <tbody>
                        <tr>
                            <td style="width: 100%; ">
                                @if (isset($planLayout['base64']) && isset($planLayout['mimeType']))
                                    <img
                                        src="data:{{ $planLayout['mimeType'] }};base64,{{ $planLayout['base64'] }}"
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
            </li>
        </ul>
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;">
            <br>
        </p>
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;">
            <br>
        </p>
        <ul>
            <li>
                <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                        lang="en-US"
                    >Process Flow</span></p>
                @if ($isEditable)
                    <div class="process-flow-image-upload">
                        <label
                            class="form-label"
                            for="processFlow"
                        >Upload Process Flow</label>
                        <input
                            id="processFlow"
                            name="processFlow"
                            type="file"
                        >
                        <input
                            id="ProcessFlowFileID_Data_Handler"
                            name="ProcessFlowFileID_Data_Handler"
                            type="hidden"
                        >
                    </div>
                @endif
                <table style="width: 100%; border-collapse: collapse;">
                    <tbody>
                        <tr>
                            <td>
                                @if (isset($processFlow['base64']) && isset($processFlow['mimeType']))
                                    <img
                                        src="data:{{ $processFlow['mimeType'] }};base64,{{ $processFlow['base64'] }}"
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
            </li>
        </ul>
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
            style="width: 100%; table-layout: fixed;"
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
                            <p class="custom--justify">
                                <u>{{ $TNAdata['InventorySystem'] ?? '' }}</u>
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
            style="width: 100%; table-layout: fixed;"
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
                            <p class="custom--justify">
                                <u>{{ $TNAdata['MaintenanceProgram'] ?? '' }}</u>
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
            style="width: 100%; table-layout: fixed;"
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
                            <p class="custom--justify">
                                <u>{{ $TNAdata['cGMPHACCPActivities'] ?? '' }}</u>
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
            style="width: 100%; table-layout: fixed;"
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
                            <p class="custom--justify">
                                <u>{{ $TNAdata['SuppliesPurchasingSystem'] ?? '' }}</u>
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
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 1.27cm;">
            <br>
        </p>
        <ul>
            <li>
                <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                        lang="en-US"
                    >Marketing Plan</span></p>
            </li>
        </ul>
        <table
            style="width: 100%; table-layout: fixed;"
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
                            <p class="custom--justify">
                                <u>{{ $TNAdata['MarketingPlan'] ?? '' }}</u>
                            </p>
                        @endIf
                    </td>
                </tr>
            </tbody>
        </table>
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;">
            <br>
        </p>
        <ul>
            <li>
                <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                        lang="en-US"
                    >Market Outlets and Number</span></p>
            </li>
        </ul>
        <table
            style="width: 100%; table-layout: fixed;"
            cellpadding="7"
        >
            <tbody>
                <tr>
                    <td
                        style="border-width: medium medium 1px;border-style: none none solid;border-color: currentcolor currentcolor rgb(0, 0, 0);padding: 0cm;vertical-align: top;">
                        @if ($isEditable)
                            <textarea
                                class="form-control"
                                name="MarketOutletsAndNumber"
                                style="width: 100%;"
                            >{{ $TNAdata['MarketOutletsAndNumber'] ?? '' }}</textarea>
                        @else
                            <p class="custom--justify">
                                <u>{{ $TNAdata['MarketOutletsAndNumber'] ?? '' }}</u>
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
            style="width: 100%; table-layout: fixed;"
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
                            <p class="custom--justify">
                                <u>{{ $TNAdata['PromotionalStrategies'] ?? '' }}</u>
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
            style="width: 100%; table-layout: fixed;"
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
                            <p class="custom--justify">
                                <u>{{ $TNAdata['MarketCompetitors'] ?? '' }}</u>
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
                                    style="width: 100%; table-layout: fixed;"
                                    cellpadding="7"
                                >
                                    <tbody>
                                        <tr>
                                            <td style="width: 5%;"></td>
                                            <td style="width: 40%;"></td>
                                            <td style="width: 55%;"></td>
                                        </tr>
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
                                                    {{ isset($TNAdata['nutritionEvaluation']) && $TNAdata['nutritionEvaluation'] == 'on' ? '✓' : '' }}
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
                                                    {{ isset($TNAdata['barCode']) && $TNAdata['barCode'] == 'on' ? '✓' : '' }}
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
                                                    {{ isset($TNAdata['productLabel']) && $TNAdata['productLabel'] == 'on' ? '✓' : '' }}
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
                                                    {{ isset($TNAdata['expiryDate']) && $TNAdata['expiryDate'] == 'on' ? '✓' : '' }}
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
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 1.27cm;">
            <br>
        </p>
        <ul>
            <li>
                <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                        lang="en-US"
                    >Cash Flow or other related documents</span></p>
            </li>
        </ul>
        <table
            style="width: 100%; table-layout: fixed;"
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
                            <p class="custom--justify">
                                <u>{{ $TNAdata['CashFlowAndRelatedDocuments'] ?? '' }}</u>
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
                    >Source(s) of capital/credit</span></p>
            </li>
        </ul>
        <table
            style="width: 100%; table-layout: fixed;"
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
                            <p class="custom--justify">
                                <u>{{ $TNAdata['SourceOfCapitalCredits'] ?? '' }}</u>
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
                    >Accounting System</span></p>
            </li>
        </ul>
        <table
            style="width: 100%; table-layout: fixed;"
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
                            <p class="custom--justify">
                                <u>{{ $TNAdata['AccountingSystem'] ?? '' }}</u>
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
                    ><strong>Human Resources</strong></span></p>
            </li>
        </ul>
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 1.27cm;">
            <br>
        </p>
        <ul>
            <li>
                <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                        lang="en-US"
                    >Hiring and Criteria</span></p>
            </li>
        </ul>
        <table
            style="width: 100%; table-layout: fixed;"
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
                            <p class="custom--justify">
                                <u>{{ $TNAdata['HiringAndCriteria'] ?? '' }}</u>
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
                    >Incentives to Employees</span></p>
            </li>
        </ul>
        <table
            style="width: 100%; table-layout: fixed;"
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
                            <p class="custom--justify">
                                <u>{{ $TNAdata['IncentivesToEmployees'] ?? '' }}</u>
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
                    >Training and Development</span></p>
            </li>
        </ul>
        <table
            style="width: 100%; table-layout: fixed;"
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
                            <p class="custom--justify">
                                <u>{{ $TNAdata['TrainingAndDevelopment'] ?? '' }}</u>
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
                    >Safety Measures Practiced</span></p>
            </li>
        </ul>
        <table
            style="width: 100%; table-layout: fixed;"
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
                            <p class="custom--justify">
                                <u>{{ $TNAdata['SafetyMeasuresPracticed'] ?? '' }}</u>
                            </p>
                        @endIf
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
            style="width: 100%; table-layout: fixed;"
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
                            <p class="custom--justify">
                                <u>{{ $TNAdata['OtherEmployeeWelfare'] ?? '' }}</u>
                            </p>
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
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 1.27cm;">
            <br>
        </p>
        <table
            style="width: 100%; table-layout: fixed;"
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
                            <p class="custom--justify">
                                <u>{{ $TNAdata['OtherConcerns'] ?? '' }}</u>
                            </p>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;">
            <br>
        </p>
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <!-- Prepared by -->
                <td style="width: 50%; vertical-align: top; padding: 10px;">
                    <p style="font-weight: bold; margin-bottom: 20px;">Prepared by:</p>
                    <table style="width: 100%; text-align: center; border-collapse: collapse;">
                        <tr>
                            <td>
                                @if ($isEditable)
                                    <input
                                        id="prepared_by"
                                        name="prepared_by"
                                        type="text"
                                        value="{{ $TNAdata['prepared_by'] ?? ($TNAdata['contact_person'] ?? ($TNAdata['prefix'] ?? '') . ' ' . ($TNAdata['f_name'] ?? '') . ' ' . ($TNAdata['middle_name'] ?? '') . ' ' . ($TNAdata['l_name'] ?? '') . ' ' . ($TNAdata['suffix'] ?? '')) }}"
                                        style="width: 100%; text-align: center;"
                                        placeholder=""
                                    >
                                @else
                                    {{ $TNAdata['prepared_by'] ?? ($TNAdata['contact_person'] ?? ($TNAdata['prefix'] ?? '') . ' ' . ($TNAdata['f_name'] ?? '') . ' ' . ($TNAdata['middle_name'] ?? '') . ' ' . ($TNAdata['l_name'] ?? '') . ' ' . ($TNAdata['suffix'] ?? '')) }}
                                @endIf
                            </td>
                        </tr>
                        <tr style="height: 20px;">
                            <td style="border-top: 1px solid black; padding: 0pt 4pt 4pt 4pt;">
                                <strong>Printed Name and Signature of Owner/Chair/Representative</strong>
                            </td>
                        </tr>
                        <!-- Date row (aligned) -->
                        <tr>
                            <td>
                                @if ($isEditable)
                                    <input
                                        id="prepared_by_date"
                                        name="prepared_by_date"
                                        type="date"
                                        value="{{ $TNAdata['prepared_by_date'] ?? '' }}"
                                        style="width: 100%; text-align: center;"
                                        placeholder=""
                                    >
                                @else
                                    {{ $TNAdata['prepared_by_date'] ?? '' ? \Carbon\Carbon::parse($TNAdata['prepared_by_date'])->format('F j, Y') : '' }}
                                @endIf
                            </td>
                        </tr>
                        <tr>
                            <td style="border-top: 1px solid black; padding-top: 3pt;">
                                <strong>Date</strong>
                            </td>
                        </tr>
                    </table>
                </td>

                <!-- Validated by -->
                <td style="width: 50%; vertical-align: top; padding: 10px;">
                    <p style="font-weight: bold; margin-bottom: 20px;">Validated by:</p>
                    <table style="width: 100%; text-align: center; border-collapse: collapse;">
                        <tr>
                            <td>
                                @if ($isEditable)
                                    <input
                                        id="validated_by"
                                        name="validated_by"
                                        type="text"
                                        value="{{ $TNAdata['validated_by'] ?? '' }}"
                                        style="width: 100%; text-align: center;"
                                        placeholder=""
                                    >
                                @else
                                    {{ $TNAdata['validated_by'] ?? '' }}
                                @endIf
                            </td>
                        </tr>
                        <tr>
                            <td style="border-top: 1pt solid black; padding: 0pt 15pt 15pt 15pt;">
                                <strong>Printed Name and Signature of PSTD</strong>
                            </td>
                        </tr>
                        <!-- Date row (aligned) -->
                        <tr>
                            <td>
                                @if ($isEditable)
                                    <input
                                        id="validated_by_date"
                                        name="validated_by_date"
                                        type="date"
                                        value="{{ $TNAdata['validated_by_date'] ?? '' }}"
                                        style="width: 100%; text-align: center;"
                                        placeholder=""
                                    >
                                @else
                                    {{ $TNAdata['validated_by_date'] ?? '' ? \Carbon\Carbon::parse($TNAdata['validated_by_date'])->format('F j, Y') : '' }}
                                @endIf
                            </td>
                        </tr>
                        <tr>
                            <td style="border-top: 1px solid black; padding-top: 3pt;">
                                <strong>Date</strong>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    </form>
    @if (!$isExporting)
        <div
            class="sticky-bottom buttom-0 py-1 mt-4 pe-none"
            style="z-index:1000;"
        >
            @if ($isEditable && auth()->user()->role === 'Staff')
                <div class="d-flex align-items-center justify-content-end">
                    <select
                        class="form-select w-25 pe-auto"
                        name="tna_doc_status"
                        form="TNAForm"
                    >
                        <option
                            value="pending"
                            selected
                        >Pending</option>
                        <option value="reviewed">Reviewed</option>
                    </select>
                    <button
                        class="btn btn-primary ms-2 pe-auto"
                        form="TNAForm"
                        type="submit"
                    >Set TNA Form</button>
                </div>
            @elseif (auth()->user()->role === 'Staff')
                <div class="d-flex justify-content-end">
                    <button
                        class="btn btn-primary text-end pe-auto"
                        id="exportTNAFormToPDF"
                        data-generated-url="{{ URL::signedRoute('staff.Applicant.generate.tna-document', ['business_id' => $TNAdata['business_id'], 'application_id' => $TNAdata['application_id']]) }}"
                        type="button"
                    >Export as PDF</button>
                </div>
            @endif
        </div>
    @endif
</div>
