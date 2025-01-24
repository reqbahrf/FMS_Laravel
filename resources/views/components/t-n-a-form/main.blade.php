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
                        <span lang="en-US">Name of Enterprise:&nbsp;<input
                                id="firm_name"
                                name="firm_name"
                                type="text"
                                value="{{ $TNAdata['firm_name'] ?? '' }}"
                                placeholder="Name of Enterprise"
                            ></span>
                    </p>
                </td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                        <span lang="en-US">Contact Person:&nbsp;<input
                                id="contact_person"
                                name="contact_person"
                                type="text"
                                value="{{ $TNAdata['contact_person'] ?? ($TNAdata['prefix'] ?? '') . ' ' . ($TNAdata['f_name'] ?? '') . ' ' . ($TNAdata['middle_name'] ?? '') . ' ' . ($TNAdata['l_name'] ?? '') . ' ' . ($TNAdata['suffix'] ?? '') }}"
                                placeholder="Contact Person"
                            ></span>
                    </p>
                </td>
                <td
                    style="border: 1px solid #000000;padding: 0cm 0.19cm;"
                    colspan="2"
                >
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                        <span lang="en-US">Position in the Enterprise: (wife of the owner) <input
                                id="position_in_enterprise"
                                name="position_in_enterprise"
                                type="text"
                                placeholder="Position in the Enterprise"
                            ></span>
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
                        <span lang="en-US">Office Address:&nbsp; <input
                                id="office_address"
                                name="office_address"
                                type="text"
                                value="{{ $TNAdata['office_address'] ?? ($TNAdata['officeLandmark'] ?? '') . ' ' . ($TNAdata['officeBarangay'] ?? '') . ' ' . ($TNAdata['officeCity'] ?? '') . ' ' . ($TNAdata['officeProvince'] ?? '') . ' ' . ($TNAdata['officeRegion'] ?? '') . ' ' . ($TNAdata['officeZipCode'] ?? '') }}"
                                placeholder="Office Address"
                            ></span>
                    </p>
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br>
                    </p>
                </td>
                <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                            lang="en-US"
                        >Tel No.: <input
                                id="officeTelNo"
                                name="officeTelNo"
                                type="text"
                                value="{{ $TNAdata['officeTelNo'] ?? '' }}"
                                placeholder="Tel No."
                            ></span></p>
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br>
                    </p>
                </td>
                <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                            lang="en-US"
                        >Fax No.: <input
                                id="officeFaxNo"
                                name="officeFaxNo"
                                type="text"
                                value="{{ $TNAdata['officeFaxNo'] ?? '' }}"
                                placeholder="Fax No."
                            ></span></p>
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
                        >E-mail Address:&nbsp; <input
                                id="officeEmailAddress"
                                name="officeEmailAddress"
                                type="text"
                                value="{{ $TNAdata['officeEmailAddress'] ?? '' }}"
                                placeholder="E-mail Address"
                            ></span></p>
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
                        >Factory Address: <input
                                id="factory_address"
                                name="factory_address"
                                type="text"
                                value="{{ $TNAdata['factory_address'] ?? ($TNAdata['factoryLandmark'] ?? '') . ' ' . ($TNAdata['factoryBarangay'] ?? '') . ' ' . ($TNAdata['factoryCity'] ?? '') . ' ' . ($TNAdata['factoryProvince'] ?? '') . ' ' . ($TNAdata['factoryRegion'] ?? '') . ' ' . ($TNAdata['factoryZipCode'] ?? '') }}"
                                placeholder="Factory Address"
                            ></span></p>
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br>
                    </p>
                </td>
                <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                            lang="en-US"
                        >Tel No.: <input
                                id="factoryTelNo"
                                name="factoryTelNo"
                                type="text"
                                value="{{ $TNAdata['factoryTelNo'] ?? '' }}"
                                placeholder="Tel No."
                            ></span></p>
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br>
                    </p>
                </td>
                <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                            lang="en-US"
                        >Fax No.:&nbsp; <input
                                id="factoryFaxNo"
                                name="factoryFaxNo"
                                type="text"
                                value="{{ $TNAdata['factoryFaxNo'] ?? '' }}"
                                placeholder="Fax No."
                            ></span></p>
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
                        >E-mail Address: <input
                                id="factoryEmailAddress"
                                name="factoryEmailAddress"
                                type="text"
                                value="{{ $TNAdata['factoryEmailAddress'] ?? '' }}"
                                placeholder="E-mail Address"
                            ></span></p>
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
                        >Website:&nbsp; <input
                                id="website"
                                name="website"
                                type="text"
                                value="{{ $TNAdata['website'] ?? '' }}"
                                placeholder="Website"
                            ></span></p>
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
                The applicant shall, at the earliest opportunity, make available to the DOST Regional Office No. <input
                    id="dost_regional_office_no"
                    name="dost_regional_office_no"
                    type="text"
                    style="width: 10%"
                    placeholder="DOST Regional Office No."
                > (DOST <input
                    id="dost_regional_office_no"
                    name="dost_regional_office_no"
                    type="text"
                    style="width: 10%"
                    placeholder="DOST Regional Office No."
                > ) all information (manuals, procedures, etc.) required to establish the technology status of the
                selected core business functions and management systems;</p>
        </li>
    </ol>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <br>&nbsp;</p>
    <ol start="2">
        <li>
            <p
                style="text-align: justify;background: transparent;line-height: 100%;margin-right: 0.02cm;margin-bottom: 0cm;">
                If DOST <input
                    id="dost_satisfaction"
                    name=""
                    type="text"
                    style="width: 10%"
                    placeholder="DOST satisfaction"
                > Regional Office No. <input
                    id="dost_regional_office_no"
                    name="dost_regional_office_no"
                    type="text"
                    style="width: 10%"
                    placeholder="DOST Regional Office No."
                > is not satisfied that all the requirements for business registration are complied with, it shall
                inform the applicant of the observed deficiencies before starting the assessment;</p>
        </li>
    </ol>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <br>&nbsp;</p>
    <ol start="3">
        <li>
            <p
                style="text-align: justify;background: transparent;line-height: 100%;margin-right: 0.02cm;margin-bottom: 0cm;">
                When the required inputs to the assessment are already supplied by the applicant, including Attachment
                A, the DOST <input
                    id="dost_supplied"
                    name=""
                    type="text"
                    style="width: 10%"
                    placeholder="DOST Regional Office No."
                > will assess the firm through the core business functions and management systems, whichever is
                applicable, to identify technology needs and verify compliance to standards vis-&agrave;-vis existing
                practices;</p>
        </li>
    </ol>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <br>&nbsp;</p>
    <ol start="4">
        <li>
            <p
                style="text-align: justify;background: transparent;line-height: 100%;margin-right: 0.02cm;margin-bottom: 0cm;">
                When the DOST <input
                    id=""
                    name="dost_regional_TNA"
                    type="text"
                    style="width: 10%"
                    placeholder=""
                > has completed the technology assessment, a report will be prepared on the results of the assessment
                with accompanying recommendations and opportunities for improvement. The report prepared will define the
                scope of activities, functions, management practices and locations assessed. The applicant shall not
                claim or otherwise imply that the report applies to other locations, product or activities not covered
                by the report;</p>
        </li>
    </ol>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <br>&nbsp;</p>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <br>&nbsp;</p>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <br>&nbsp;</p>
    <ol start="5">
        <li>
            <p
                style="text-align: justify;background: transparent;line-height: 100%;margin-right: 0.02cm;margin-bottom: 0cm;">
                The applicant agrees that the report will not be used until permission has been granted by the DOST
                <input
                    id="dost_permission"
                    name="dost_permission"
                    type="text"
                    style="width: 10%"
                >;</p>
        </li>
    </ol>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <br>&nbsp;</p>
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
        <br>&nbsp;</p>
    <p style="text-align: center;background: transparent;line-height: 108%;margin-bottom: 0cm;"><span
            style="color: rgb(39, 39, 39);"
        ><strong>UNDERTAKING</strong></span></p>
    <p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;margin-right: 0.02cm;">
        <br>&nbsp;</p>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <strong>I agree to undertake and observe the above General Agreements as stipulated by the Department of Science
            and Technology Regional Office No. <input
                id="dost_undertake"
                name=""
                type="text"
                style="width: 10%"
                placeholder="DOST Regional Office No."
            >.</strong>.</p>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <br>&nbsp;</p>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <br>&nbsp;</p>
    <p
        style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
        <br>&nbsp;</p>

    <x-t-n-a-form.t-n-a-form-one />
    <x-t-n-a-form.attachment-a />

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
        <tbody>
            @foreach ($TNAdata['production'] ?? [] as $production)
                <tr>
                    <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                        <input
                            class="product"
                            name="product"
                            type="text"
                            value="{{ $production['product'] ?? '' }}"
                        />
                    </td>
                    <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                        <input
                            class="volumeProduction"
                            name="volumeProduction"
                            type="text"
                            value="{{ $production['volumeProduction'] ?? '' }}"
                        />
                    </td>
                    <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                        <input
                            class="unitCost"
                            name="unitCost"
                            type="text"
                            value="{{ $production['unitCost'] ?? '' }}"
                        />
                    </td>
                    <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                        <input
                            class="annualCost"
                            name="annualCost"
                            type="text"
                            value="{{ $production['annualCost'] ?? '' }}"
                        />
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
                        <span lang="en-US"><strong>Type of Equipment</strong></span></p>
                </td>
                <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                    <p style="line-height: 115%;text-align: center;margin-bottom: 0.25cm;background: transparent;">
                        <span lang="en-US"><strong>Specifications</strong></span></p>
                </td>
                <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                    <p style="line-height: 115%;text-align: center;margin-bottom: 0.25cm;background: transparent;">
                        <span lang="en-US"><strong>Capacity</strong></span></p>
                </td>
            </tr>
            @foreach ($TNAdata['productionEquipment'] ?? [] as $productionEquipment)
                <tr>
                    <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                        <input
                            class="typeOfEquipment"
                            name="typeOfEquipment"
                            type="text"
                            value="{{ $productionEquipment['typeOfEquipment'] ?? '' }}"
                        />
                    </td>
                    <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                        <input
                            class="specification"
                            name="specification"
                            type="text"
                            value="{{ $productionEquipment['specification'] ?? '' }}"
                        />
                    </td>
                    <td style="border: 1px solid #000000;padding: 0cm 0.19cm;">
                        <input
                            class="capacity"
                            name="capacity"
                            type="text"
                            value="{{ $productionEquipment['capacity'] ?? '' }}"
                        />
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
                    <textarea
                        class="form-control"
                        name="ProductionProblemAndConcern"
                        style="width: 100%;"
                    >{{ $TNAdata['productionProblemAndConcern'] ?? '' }}</textarea>
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
                    <textarea
                        class="form-control"
                        name="ProductionWasteManageSystem"
                        style="width: 100%;"
                    >{{ $TNAdata['ProductionWasteManageSystem'] ?? '' }}</textarea>
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
                    <textarea
                        class="form-control"
                        name="ProductionPlan"
                        style="width: 100%;"
                    >{{ $TNAdata['ProductionPlan'] ?? '' }}</textarea>
                </td>
            </tr>

        </tbody>
    </table>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Plant Lay-Out</span></p>
        </li>
    </ul>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 2.54cm;"><br>
    </p>
    <ul>
        <li>
            <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                    lang="en-US"
                >Process Flow</span></p>
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
                    <textarea
                        class="form-control"
                        name="InventorySystem"
                        style="width: 100%;"
                    >{{ $TNAdata['InventorySystem'] ?? '' }}</textarea>
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
                    <textarea
                        class="form-control"
                        name="MaintenanceProgram"
                        style="width: 100%;"
                    >{{ $TNAdata['MaintenanceProgram'] ?? '' }}</textarea>
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
                    <textarea
                        class="form-control"
                        name="cGMPHACCPActivities"
                        style="width: 100%;"
                    >{{ $TNAdata['cGMPHACCPActivities'] ?? '' }}</textarea>
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
                    <textarea
                        class="form-control"
                        name="SuppliesPurchasingSystem"
                        style="width: 100%;"
                    >{{ $TNAdata['SuppliesPurchasingSystem'] ?? '' }}</textarea>
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
                    <textarea
                        class="form-control"
                        name="MarketingPlan"
                        style="width: 100%;"
                    >{{ $TNAdata['MarketingPlan'] ?? '' }}</textarea>
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
                    <textarea
                        class="form-control"
                        name="MarketOutlets"
                        style="width: 100%;"
                    >{{ $TNAdata['MarketOutlets'] ?? '' }}</textarea>
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
                    <textarea
                        class="form-control"
                        name="PromotionalStrategies"
                        style="width: 100%;"
                    >{{ $TNAdata['PromotionalStrategies'] ?? '' }}</textarea>
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
                    <textarea
                        class="form-control"
                        name="MarketCompetitors"
                        style="width: 100%;"
                    >{{ $TNAdata['MarketCompetitors'] ?? '' }}</textarea>
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
                                            <input
                                                name="nutritionEvaluation"
                                                type="checkbox"
                                                value="on"
                                                style="width: 15px; height: 15px;"
                                                {{ isset($TNAdata['nutritionEvaluation']) && $TNAdata['nutritionEvaluation'] == 'on' ? 'checked' : '' }}
                                            />
                                        </td>
                                        <td style="border: none;padding: 0cm;">
                                            <p
                                                style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                                                <span lang="en-US">Nutrition Evaluation</span></p>
                                        </td>
                                        <td
                                            style="border-top: none;border-bottom: 1px solid #000000;border-left: none;border-right: none;padding: 0cm;">
                                            <input
                                                name="nutritionEvaluationDetails"
                                                type="text"
                                                value="{{ $TNAdata['nutritionEvaluationDetails'] ?? '' }}"
                                                style="width: 100%;"
                                            />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: none;padding: 0cm;">
                                            <input
                                                name="barCode"
                                                type="checkbox"
                                                value="on"
                                                style="width: 15px; height: 15px;"
                                                {{ isset($TNAdata['barCode']) && $TNAdata['barCode'] == 'on' ? 'checked' : '' }}
                                            />
                                        </td>
                                        <td style="border: none;padding: 0cm;">
                                            <p
                                                style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                                                <span lang="en-US">Bar Code</span></p>
                                        </td>
                                        <td
                                            style="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: none;border-right: none;padding: 0cm;">
                                            <input
                                                name="barCodeDetails"
                                                type="text"
                                                value="{{ $TNAdata['barCodeDetails'] ?? '' }}"
                                                style="width: 100%;"
                                            />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: none;padding: 0cm;">
                                            <input
                                                name="productLabel"
                                                type="checkbox"
                                                value="on"
                                                style="width: 15px; height: 15px;"
                                                {{ isset($TNAdata['productLabel']) && $TNAdata['productLabel'] == 'on' ? 'checked' : '' }}
                                            />
                                        </td>
                                        <td style="border: none;padding: 0cm;">
                                            <p
                                                style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                                                <span lang="en-US">Product Label</span></p>
                                        </td>
                                        <td
                                            style="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: none;border-right: none;padding: 0cm;">
                                            <input
                                                name="productLabelDetails"
                                                type="text"
                                                value="{{ $TNAdata['productLabelDetails'] ?? '' }}"
                                                style="width: 100%;"
                                            />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: none;padding: 0cm;">
                                            <input
                                                name="expiryDate"
                                                type="checkbox"
                                                value="on"
                                                style="width: 15px; height: 15px;"
                                                {{ isset($TNAdata['expiryDate']) && $TNAdata['expiryDate'] == 'on' ? 'checked' : '' }}
                                            />
                                        </td>
                                        <td style="border: none;padding: 0cm;">
                                            <p
                                                style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                                                <span lang="en-US">Expiry Date</span></p>
                                        </td>
                                        <td
                                            style="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: none;border-right: none;padding: 0cm;">
                                            <input
                                                name="expiryDateDetails"
                                                type="text"
                                                value="{{ $TNAdata['expiryDateDetails'] ?? '' }}"
                                                style="width: 100%;"
                                            />
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
                    <textarea
                        class="form-control"
                        name="CashFlowAndRelatedDocuments"
                        style="width: 100%;"
                    >{{ $TNAdata['CashFlowAndRelatedDocuments'] ?? '' }}</textarea>
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
                    <textarea
                        class="form-control"
                        name="SourceOfCapitalCredits"
                        style="width: 100%;"
                    >{{ $TNAdata['SourceOfCapitalCredits'] ?? '' }}</textarea>
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
                    <textarea
                        class="form-control"
                        name="AccountingSystem"
                        style="width: 100%;"
                    >{{ $TNAdata['AccountingSystem'] ?? '' }}</textarea>
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
                    <textarea
                        class="form-control"
                        name="HiringAndCriteria"
                        style="width: 100%;"
                    >{{ $TNAdata['HiringAndCriteria'] ?? '' }}</textarea>
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
                    <textarea
                        class="form-control"
                        name="IncentivesToEmployees"
                        style="width: 100%;"
                    >{{ $TNAdata['IncentivesToEmployees'] ?? '' }}</textarea>
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
                    <textarea
                        class="form-control"
                        name="TrainingAndDevelopment"
                        style="width: 100%;"
                    >{{ $TNAdata['TrainingAndDevelopment'] ?? '' }}</textarea>
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
                    <textarea
                        class="form-control"
                        name="SafetyMeasuresPracticed"
                        style="width: 100%;"
                    >{{ $TNAdata['SafetyMeasuresPracticed'] ?? '' }}</textarea>
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
                    <textarea
                        class="form-control"
                        name="OtherEmployeeWelfare"
                        style="width: 100%;"
                    >{{ $TNAdata['OtherEmployeeWelfare'] ?? '' }}</textarea>
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
                    <textarea
                        class="form-control"
                        name="OtherConcerns"
                        style="width: 100%;"
                    >{{ $TNAdata['OtherConcerns'] ?? '' }}</textarea>
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
