@props(['TNAdata', 'isEditable'])
<p style="text-align: justify;background: transparent;line-height: 108%;margin-right: 0.02cm;margin-bottom: 0.28cm;">
    <br>&nbsp;
</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><span
        lang="en-US">Attachment A</span></p>
<p style="text-align: center;background: transparent;line-height: 108%;margin-bottom: 0.28cm;"><span
        lang="en-US">Enterprise Profile</span></p>
<p style="text-align: center;background: transparent;line-height: 108%;margin-bottom: 0.28cm;"><br>&nbsp;</p>
<table
    style="width: 587px;"
    cellpadding="7"
>
    <tbody>
        <tr>
            <td
                style="border: none;padding: 0cm;"
                colspan="3"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Name of Enterprise:
                        @if ($isEditable)
                            <input
                                name="enterprise_name"
                                type="text"
                                value="{{ $TNAdata['firm_name'] ?? '' }}"
                                placeholder="Enterprise Name"
                            >
                        @else
                            {{ $TNAdata['firm_name'] ?? '' }}
                        @endIf
                    </span></p>
            </td>
        </tr>
        <tr>
            <td
                style="border: medium;padding: 0cm;vertical-align: top;"
                colspan="3"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Production Site/ Location:
                        @if ($isEditable)
                            <input
                                name="factory_address"
                                type="text"
                                value="{{ $TNAdata['factory_address'] ?? ($TNAdata['factoryLandmark'] ?? '') . ' ' . ($TNAdata['factoryBarangay'] ?? '') . ' ' . ($TNAdata['factoryCity'] ?? '') . ' ' . ($TNAdata['factoryProvince'] ?? '') . ' ' . ($TNAdata['factoryRegion'] ?? '') . ' ' . ($TNAdata['factoryZipCode'] ?? '') }}"
                                placeholder="Production Site"
                            >
                        @else
                            {{ $TNAdata['factory_address'] ?? ($TNAdata['factoryLandmark'] ?? '') . ' ' . ($TNAdata['factoryBarangay'] ?? '') . ' ' . ($TNAdata['factoryCity'] ?? '') . ' ' . ($TNAdata['factoryProvince'] ?? '') . ' ' . ($TNAdata['factoryRegion'] ?? '') . ' ' . ($TNAdata['factoryZipCode'] ?? '') }}
                        @endIf
                    </span></p>
            </td>

        </tr>
        <tr>
            <td
                style="border: medium;padding: 0cm;vertical-align: top;"
                colspan="2"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Business Permit No:
                        @if ($isEditable)
                            <input
                                name="businessPermitNo"
                                type="text"
                                value="{{ $TNAdata['businessPermitNo'] ?? '' }}"
                                placeholder="Business Permit"
                            >
                        @else
                            {{ $TNAdata['businessPermitNo'] ?? '' }}
                        @endIf
                    </span></p>
            </td>
            <td
                style="border: medium;padding: 0cm;vertical-align: top;"
                colspan="2"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Year Registered:
                        @if ($isEditable)
                            <input
                                name="permitYearRegistered"
                                type="text"
                                value="{{ $TNAdata['permitYearRegistered'] ?? '' }}"
                                placeholder="Year"
                            >
                        @else
                            {{ $TNAdata['permitYearRegistered'] ?? '' }}
                        @endIf
                    </span></p>
            </td>
        </tr>
        <tr>
            <td
                style="border: none;padding: 0cm;"
                colspan="3"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;">
                    <span lang="en-US">Brief Enterprise Background:</span>
                </p>
                @if ($isEditable)
                    <textarea
                        name="briefBackground"
                        style="width:100%"
                    >{{ $TNAdata['briefBackground'] ?? '' }}</textarea>
                @else
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                            lang="en-US"
                        >{{ $TNAdata['briefBackground'] ?? '' }}</span></p>
                @endIf
            </td>
        </tr>
    </tbody>
    <tbody>
        <tr>
            <td colspan="2">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Year enterprise was established:
                        <input
                            name="yearEstablished"
                            type="text"
                            value="{{ $TNAdata['yearEstablished'] ?? '' }}"
                        >
                    </span>
                </p>
            </td>
            <td colspan="2">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Initial Capitalization:
                        @if ($isEditable)
                            <input
                                name="initialCapitalization"
                                type="text"
                                value="{{ $TNAdata['initialCapitalization'] ?? '' }}"
                            >
                        @else
                            {{ $TNAdata['initialCapitalization'] ?? '' }}
                        @endIf
                    </span></p>
            </td>
        </tr>
    </tbody>
</table>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<table
    style="width: 487px;"
    cellpadding="7"
>
    <tbody>
        <tr>
            <td
                style="border-width: medium 1px medium medium;border-style: none solid none none;border-color: currentcolor rgb(0, 0, 0) currentcolor currentcolor;padding: 0cm 0.19cm 0cm 0cm;vertical-align: top;"
                rowspan="10"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Type of Organization:</span></p>
            </td>
            <td style="">
                @if ($isEditable)
                    <input
                        id="type_of_organization_1"
                        name="type_of_organization"
                        type="radio"
                        value="Single Proprietorship"
                        {{ $TNAdata['enterpriseType'] == 'Sole Proprietorship' ? 'checked' : '' }}
                    >
                @else
                    {{ $TNAdata['enterpriseType'] == 'Sole Proprietorship' ? '/' : '' }}
                @endIf
            </td>
            <td
                style=""
                colspan="3"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Single proprietorship</span></p>
            </td>
        </tr>
        <tr>
            <td style="">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td
                style="border: none;padding: 0cm;"
                colspan="3"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
        </tr>
        <tr>
            <td style="">
                @if ($isEditable)
                    <input
                        id="enterpriseType"
                        name="enterpriseType"
                        type="radio"
                        value="Cooperative"
                        {{ $TNAdata['enterpriseType'] == 'Cooperative' ? 'checked' : '' }}
                    >
                @else
                    {{ $TNAdata['enterpriseType'] == 'Cooperative' ? '/' : '' }}
                @endIf
            </td>
            <td
                style=""
                colspan="3"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Cooperative</span></p>
            </td>
        </tr>
        <tr>
            <td style=";">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td
                style="border: none;padding: 0cm;"
                colspan="3"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
        </tr>
        <tr>
            <td style="">
                @if ($isEditable)
                    <input
                        id="enterpriseType"
                        name="enterpriseType"
                        type="radio"
                        value="Partnership"
                        {{ $TNAdata['enterpriseType'] == 'Partnership' ? 'checked' : '' }}
                    >
                @else
                    {{ $TNAdata['enterpriseType'] == 'Partnership' ? '/' : '' }}
                @endIf
            </td>
            <td
                style=""
                colspan="3"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Partnership</span></p>
            </td>
        </tr>
        <tr>
            <td style="">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td
                style="border: none;padding: 0cm;"
                colspan="3"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
        </tr>
        <tr>
            <td style="">
                @if ($isEditable)
                    <input
                        id="enterpriseType"
                        name="enterpriseType"
                        type="radio"
                        value="Corporation"
                        {{ in_array($TNAdata['enterpriseType'], ['Corporation (Profit)', 'Corporation (Non-Profit)']) ? 'checked' : '' }}
                    >
                @else
                    {{ in_array($TNAdata['enterpriseType'], ['Corporation (Profit)', 'Corporation (Non-Profit)']) ? '/' : '' }}
                @endIf
            </td>
            <td
                style=""
                colspan="3"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Corporation</span></p>
            </td>
        </tr>
        <tr>
            <td style="">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="">
                @if ($isEditable)
                    <input
                        id="type_of_cooperation"
                        name="type_of_cooperation"
                        type="radio"
                        value="Profit"
                        {{ $TNA_data['type_of_cooperation'] ?? ($TNAdata['enterpriseType'] == 'Corporation (Profit)' ? 'checked' : '') }}
                    >
                @else
                    {{ $TNA_data['type_of_cooperation'] ?? ($TNAdata['enterpriseType'] == 'Corporation (Profit)' ? '/' : '') }}
                @endIf
                <span lang="en-US">Profit</span>
            </td>
        </tr>
        <tr>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td
                style="border: none;padding: 0cm;"
                colspan="3"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
        </tr>
        <tr>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="">
                @if ($isEditable)
                    <input
                        id="type_of_cooperation"
                        name="type_of_cooperation"
                        type="radio"
                        value="Non-profit"
                        {{ $TNA_data['type_of_cooperation'] ?? ($TNAdata['enterpriseType'] == 'Corporation (Non-Profit)' ? 'checked' : '') }}
                    ><span lang="en-US">Non-profit</span>
                @else
                    {{ $TNA_data['type_of_cooperation'] ?? ($TNAdata['enterpriseType'] == 'Corporation (Non-Profit)' ? '/' : '') }}
                @endIf
            </td>
        </tr>
    </tbody>
</table>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<table
    style="width: 559px;"
    cellpadding="7"
>
    <tbody>
        <tr>
            <td
                style="border: none;padding: 0cm;"
                colspan="2"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Enterprise Registration No.
                        @if ($isEditable)
                            <input
                                id="enterpriseRegistrationNo"
                                name="enterpriseRegistrationNo"
                                type="text"
                                value="{{ $TNAdata['enterpriseRegistrationNo'] ?? '' }}"
                            >
                        @else
                            {{ $TNAdata['enterpriseRegistrationNo'] ?? '' }}
                        @endIf
                    </span></p>
            </td>
            <td
                style=""
                colspan="2"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Year Registered
                        @if ($isEditable)
                            <input
                                id="yearEnterpriseRegistered"
                                name="yearEnterpriseRegistered"
                                type="text"
                                value="{{ $TNAdata['yearEnterpriseRegistered'] ?? '' }}"
                            >
                        @else
                            {{ $TNAdata['yearEnterpriseRegistered'] ?? '' }}
                        @endIf
                    </span></p>
            </td>
            <td style="">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
        </tr>
        <tr>
            <td
                style="border: medium;padding: 0cm;vertical-align: top;"
                colspan="2"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Classification according to capital (PhP)</span></p>
            </td>
            <td
                style="border: medium;padding: 0cm;vertical-align: top;"
                colspan="2"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Present capitalization
                        ₱&nbsp;
                        @if ($isEditable)
                            <input
                                id="present_capitalization"
                                name="present_capitalization"
                                type="text"
                                value="{{ $TNAdata['presentCapitalization'] ?? '' }}"
                            >
                        @else
                            {{ $TNAdata['presentCapitalization'] ?? '' }}
                        @endIf
                    </span></p>
            </td>
            <td
                style=""
                colspan="2"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"></p>
            </td>
        </tr>
    </tbody>
</table>
<table
    style="float: left;width: 411px;"
    dir="ltr"
    cellpadding="7"
>
    @php
        $total = 0;
        $total += floatval(str_replace(',', '', $TNAdata['buildings']));
        $total += floatval(str_replace(',', '', $TNAdata['equipments']));
        $total += floatval(str_replace(',', '', $TNAdata['working_capital']));
    @endphp
    <tbody>
        <tr>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td
                style="border: none;padding: 0cm;"
                colspan="3"
            >
                @if ($isEditable)
                    <input
                        name="CapitalClassification"
                        type="radio"
                        value="Small (less - 1.5M)"
                        {{ $total <= 1500000 ? 'checked' : '' }}
                    >
                @else
                    {{ $total <= 1500000 ? '/' : '' }}
                @endIf
                <span lang="en-US">Small (1.5 &ndash; 15M)</span><span lang="en-US">Micro (less than 1.5M)</span>
            </td>
        </tr>
        <tr>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td
                style="border: none;padding: 0cm;"
                colspan="3"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
        </tr>
        <tr>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td
                style="border: none;padding: 0cm;"
                colspan="3"
            >
                @if ($isEditable)
                    <input
                        name="CapitalClassification"
                        type="radio"
                        value="Small (1.5 - 15M)"
                        {{ $total <= 1500000 && $total >= 1500000 ? 'checked' : '' }}
                    >
                @else
                    {{ $total <= 1500000 && $total >= 1500000 ? '/' : '' }}
                @endIf
                <span lang="en-US">Small (1.5 &ndash; 15M)</span>
            </td>
        </tr>
        <tr>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td
                style="border: none;padding: 0cm;"
                colspan="3"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
        </tr>
        <tr>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td
                style="border: none;padding: 0cm;"
                colspan="3"
            >
                @if ($isEditable)
                    <input
                        name="CapitalClassification"
                        type="radio"
                        value="Medium (15M - 100M)"
                        {{ $total > 1500000 && $total < 10000000 ? 'checked' : '' }}
                    >
                @else
                    {{ $total > 1500000 && $total < 10000000 ? '/' : '' }}
                @endIf
                <span lang="en-US">Medium (15 &ndash; 100M)</span>
            </td>
        </tr>
        <tr>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td
                style="border: none;padding: 0cm;"
                colspan="3"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
        </tr>
        <tr>
            <td
                style="border: medium;padding: 0cm;vertical-align: top;"
                colspan="6"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Classification according to employment (number of employees)</span></p>
            </td>
        </tr>
        @php
            $ProductionEmployees = 0;
            $NonProductionEmployees = 0;
            $DirectEmployees =
                ($TNAdata['m_personnelDiRe'] ?? 0) +
                ($TNAdata['f_personnelDiRe'] ?? 0) +
                ($TNAdata['m_personnelDiPart'] ?? 0) +
                ($TNAdata['f_personnelDiPart'] ?? 0);
            $IndirectEmployees =
                ($TNAdata['m_personnelIndRe'] ?? 0) +
                ($TNAdata['f_personnelIndRe'] ?? 0) +
                ($TNAdata['m_personnelIndPart'] ?? 0) +
                ($TNAdata['f_personnelIndPart'] ?? 0);

            $TotalEmployees = ($DirectEmployees ?? 0) + ($IndirectEmployees ?? 0);

        @endphp
        <tr>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td
                style="border: none;padding: 0cm 0.19cm;"
                colspan="3"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
        </tr>
        <tr>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm 0.19cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td
                style="border: none;padding: 0cm;"
                colspan="3"
            >
                @if ($isEditable)
                    <input
                        name="mumberOfEmployees"
                        type="radio"
                        value="Small (1 - 9)"
                        {{ $TotalEmployees <= 9 && $TotalEmployees >= 1 ? 'checked' : '' }}
                    >
                @else
                    {{ $TotalEmployees <= 9 && $TotalEmployees >= 1 ? '/' : '' }}
                @endIf
                <span lang="en-US">Medium (1 &ndash; 9)</span>
            </td>
        </tr>
        <tr>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border:none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td
                style="border: none;padding: 0cm;"
                colspan="3"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
        </tr>
        <tr>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td
                style="border: none;padding: 0cm;"
                colspan="3"
            >
                @if ($isEditable)
                    <input
                        name="mumberOfEmployees"
                        type="radio"
                        value="Small (10 - 99)"
                        {{ $TotalEmployees <= 99 && $TotalEmployees >= 10 ? 'checked' : '' }}
                    >
                @else
                    {{ $TotalEmployees <= 99 && $TotalEmployees >= 10 ? '/' : '' }}
                @endIf
                <span lang="en-US">Small (10 - 99)</span>
            </td>
        </tr>
        <tr>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td
                style="border: none;padding: 0cm;"
                colspan="3"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
        </tr>
        <tr>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td
                style="border: none;padding: 0cm;"
                colspan="3"
            >
                @if ($isEditable)
                    <input
                        name="mumberOfEmployees"
                        type="radio"
                        value="Small (100 - 199)"
                        {{ $TotalEmployees <= 199 && $TotalEmployees >= 100 ? 'checked' : '' }}
                    >
                @else
                    {{ $TotalEmployees <= 199 && $TotalEmployees >= 100 ? '/' : '' }}
                @endIf
                <span lang="en-US">Medium (100 &ndash; 199)</span>
            </td>
        </tr>
        <tr>
            <td
                style="border: none;padding: 0cm;"
                colspan="4"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0cm;background: transparent;"><br></p>
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Number of Employees:</span></p>
            </td>
            <td
                style="border: none;padding: 0cm;"
                colspan="2"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
        </tr>
        <tr>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td
                style="border: none;padding: 0cm;"
                colspan="3"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Direct Workers</span></p>
            </td>
            <td style="border: none;padding: 0cm;">
                @if ($isEditable)
                    <input
                        name="DirectWorkers"
                        type="text"
                        value="{{ $DirectEmployees }}"
                    >
                @else
                    {{ $DirectEmployees }}
                @endIf
            </td>
            <td style="">
                <p style="line-height: 115%;text-align: center;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
        </tr>
        <tr>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Production</span></p>
            </td>
            <td style="">
                @if ($isEditable)
                    <input
                        id="production"
                        name="production"
                        type="text"
                        value="{{ $ProductionEmployees }}"
                    >
                @else
                    {{ $ProductionEmployees }}
                @endIf
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
        </tr>
        <tr>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Non-production</span></p>
            </td>
            <td style="">
                @if ($isEditable)
                    <input
                        id="non_production"
                        name="non_production"
                        type="text"
                        value="{{ $NonProductionEmployees }}"
                    >
                @else
                    {{ $NonProductionEmployees }}
                @endIf
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
        </tr>
        <tr>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td
                style="border: none;padding: 0cm;"
                colspan="3"
            >
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Indirect/Contract Workers</span></p>
            </td>
            <td style="">
                @if ($isEditable)
                    <input
                        name="indirect_workers"
                        type="text"
                        value="{{ $IndirectEmployees }}"
                    >
                @else
                    {{ $IndirectEmployees }}
                @endIf
            </td>
            <td style="">

            </td>
        </tr>
        <tr>
            <td
                style="border: none;padding: 0cm;"
                colspan="5"
            >
                <span lang="en-US">Total</span>
                @if ($isEditable)
                    <input
                        id="total"
                        name="total"
                        type="text"
                        value="{{ $TotalEmployees }}"
                        style="width:20%;"
                    >
                @else
                    {{ $TotalEmployees }}
                @endIf
            </td>
            <td style="">
                <p style="line-height: 115%;text-align: center;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
        </tr>
    </tbody>
</table>
