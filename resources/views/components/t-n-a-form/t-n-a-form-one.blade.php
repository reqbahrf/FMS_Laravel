@props(['TNAdata', 'organizationalStructure', 'isEditable'])
<p>&nbsp;</p>
<p>&nbsp;</p>
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
        lang="en-US">Business Activity:</span></p>
<table
    id="businessActivityTable"
    style="width: 100%; table-layout: fixed;"
    cellpadding="7"
>
    <tbody>
        <tr>
            <td style="width: 5%;"></td>
            <td style="width: 55%;"></td>
            <td style="width: 40%;"></td>
        </tr>
        <tr>
            <td style="">
                @if ($isEditable)
                    <input
                        name="food_processing_activity"
                        type="checkbox"
                        style="width: 100%;"
                        @checked(isset($TNAdata['food_processing_activity']) && $TNAdata['food_processing_activity'] == 'on')
                    />
                @else
                    {{ isset($TNAdata['food_processing_activity']) && $TNAdata['food_processing_activity'] == 'on' ? '✓' : '' }}
                @endIf
            </td>
            <td style="">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Food processing (please specify specific sector)</span></p>
            </td>
            <td style="border-bottom: 1px solid black;">
                <p>
                    @if ($isEditable)
                        <input
                            name="food_processing_specific_sector"
                            type="text"
                            value="{{ $TNAdata['food_processing_specific_sector'] ?? '' }}"
                            style="width: 100%;"
                        />
                    @else
                        {{ $TNAdata['food_processing_specific_sector'] ?? '' }}
                    @endIf
                </p>
            </td>
        </tr>
        <tr>
            <td style="">
                @if ($isEditable)
                    <input
                        name="furniture_activity"
                        type="checkbox"
                        style="width: 100%;"
                        @checked(isset($TNAdata['furniture_activity']) && $TNAdata['furniture_activity'] == 'on')
                    />
                @else
                    {{ isset($TNAdata['furniture_activity']) && $TNAdata['furniture_activity'] == 'on' ? '✓' : '' }}
                @endIf
            </td>
            <td style="">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Furniture (please specify specific sector)</span></p>
            </td>
            <td style="border-bottom: 1px solid black;">

                @if ($isEditable)
                    <input
                        name="furniture_specific_sector"
                        type="text"
                        value="{{ $TNAdata['furniture_specific_sector'] ?? '' }}"
                        style="width: 100%;"
                    />
                @else
                    {{ $TNAdata['furniture_specific_sector'] ?? '' }}
                @endIf

            </td>
        </tr>
        <tr>
            <td style="">
                @if ($isEditable)
                    <input
                        name="natural_fibers_activity"
                        type="checkbox"
                        style="width: 100%;"
                        @checked(isset($TNAdata['natural_fibers_activity']) && $TNAdata['natural_fibers_activity'] == 'on')
                    />
                @else
                    {{ isset($TNAdata['natural_fibers_activity']) && $TNAdata['natural_fibers_activity'] == 'on' ? '✓' : '' }}
                @endIf
            </td>
            <td style="">
                <p style=""><span lang="en-US">Natural fibers, gifts and home decors and fashion&nbsp;</span>
                </p>
            </td>
            <td style="border-bottom: 1px solid black;">

                @if ($isEditable)
                    <input
                        name="natural_fibers_specific_sector"
                        type="text"
                        value="{{ $TNAdata['natural_fibers_specific_sector'] ?? '' }}"
                        style="width: 100%;"
                    />
                @else
                    {{ $TNAdata['natural_fibers_specific_sector'] ?? '' }}
                @endIf

            </td>
        </tr>
        <tr>
            <td style="">
                @if ($isEditable)
                    <input
                        name="metals_and_engineering_activity"
                        type="checkbox"
                        style="width: 100%;"
                        @checked(isset($TNAdata['metals_and_engineering_activity']) && $TNAdata['metals_and_engineering_activity'] == 'on')
                    />
                @else
                    {{ isset($TNAdata['metals_and_engineering_activity']) && $TNAdata['metals_and_engineering_activity'] == 'on' ? '✓' : '' }}
                @endIf
            </td>
            <td style="">
                <p style=""><span lang="en-US">Metals and engineering (please specify specific sector)</span>
                </p>
            </td>
            <td style="border-bottom: 1px solid black;">

                @if ($isEditable)
                    <input
                        name="metals_and_engineering_specific_sector"
                        type="text"
                        value="{{ $TNAdata['metals_and_engineering_specific_sector'] ?? '' }}"
                        style="width: 100%;"
                    />
                @else
                    {{ $TNAdata['metals_and_engineering_specific_sector'] ?? '' }}
                @endIf

            </td>

        </tr>
        <tr>
            <td style="">
                @if ($isEditable)
                    <input
                        name="aquatic_and_marine_activity"
                        type="checkbox"
                        style="width: 100%;"
                        @checked(isset($TNAdata['aquatic_and_marine_activity']) && $TNAdata['aquatic_and_marine_activity'] == 'on')
                    />
                @else
                    {{ isset($TNAdata['aquatic_and_marine_activity']) && $TNAdata['aquatic_and_marine_activity'] == 'on' ? '✓' : '' }}
                @endIf
            </td>
            <td style="">
                <p style=""><span lang="en-US">Aquatic and marine resources (please specify specific
                        sector)</span></p>
            </td>
            <td style="border-bottom: 1px solid black;">

                @if ($isEditable)
                    <input
                        name="aquatic_and_marine_specific_sector"
                        type="text"
                        value="{{ $TNAdata['aquatic_and_marine_specific_sector'] ?? '' }}"
                        style="width: 100%;"
                    />
                @else
                    {{ $TNAdata['aquatic_and_marine_specific_sector'] ?? '' }}
                @endIf

            </td>
        </tr>
        <tr>
            <td style="">
                @if ($isEditable)
                    <input
                        name="horticulture_activity"
                        type="checkbox"
                        style="width: 100%;"
                        @checked(isset($TNAdata['horticulture_activity']) && $TNAdata['horticulture_activity'] == 'on')
                    />
                @else
                    {{ isset($TNAdata['horticulture_activity']) && $TNAdata['horticulture_activity'] == 'on' ? '✓' : '' }}
                @endIf
            </td>
            <td style="">
                <p style=""><span lang="en-US">Horticulture/Agriculture (please specify specific sector)</span>
                </p>
            </td>
            <td style="border-bottom: 1px solid black;">
                @if ($isEditable)
                    <input
                        name="horticulture_specific_sector"
                        type="text"
                        value="{{ $TNAdata['horticulture_specific_sector'] ?? '' }}"
                        style="width: 100%;"
                    />
                @else
                    {{ $TNAdata['horticulture_specific_sector'] ?? '' }}
                @endIf
            </td>
        </tr>
        <tr>
            <td style="">
                @if ($isEditable)
                    <input
                        name="other_activity"
                        type="checkbox"
                        style="width: 100%;"
                        @checked(isset($TNAdata['other_activity']) && $TNAdata['other_activity'] == 'on')
                    />
                @else
                    {{ isset($TNAdata['other_activity']) && $TNAdata['other_activity'] == 'on' ? '✓' : '' }}
                @endIf
            </td>
            <td style="">
                <p style=""><span lang="en-US">Others, please specify</span></p>
            </td>
            <td style="border-bottom: 1px solid black;">
                @if ($isEditable)
                    <input
                        name="other_specific_sector"
                        type="text"
                        value="{{ $TNAdata['other_specific_sector'] ?? '' }}"
                        style="width: 100%;"
                    />
                @else
                    {{ $TNAdata['other_specific_sector'] ?? '' }}
                @endIf
            </td>
        </tr>
    </tbody>
</table>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><span lang="en-US">1.
        Specific product or service the enterprise offers its customers:</span></p>
<table
    style="width: 587px;"
    cellpadding="7"
>
    <tbody>

        <tr>
            <td>
                @if ($isEditable)
                    <textarea
                        class="form-control"
                        name="specificProductOrService"
                        style="width:100%;"
                        rows="5"
                    >{{ $TNAdata['specificProductOrService'] ?? '' }}
            </textarea>
                @else
                    <p class="custom--justify">
                        <u>{{ $TNAdata['specificProductOrService'] ?? '' }}</u>
                    </p>
                @endif
            </td>
        </tr>
    </tbody>
</table>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><span lang="en-US">2.
        Reasons why assistance is being sought:</span></p>
<table
    style="width: 587px;"
    cellpadding="7"
>
    <tbody>
        <tr>
            <td>
                @if ($isEditable)
                    <textarea
                        class="form-control"
                        name="reasonsWhyAssistanceIsBeingSought"
                        style="width: 100%;"
                        rows="5"
                    >{{ $TNAdata['reasonsWhyAssistanceIsBeingSought'] ?? '' }}
                </textarea>
                @else
                    <p class="custom--justify">
                        <u>{{ $TNAdata['reasonsWhyAssistanceIsBeingSought'] ?? '' }}</u>
                    </p>
                @endif
            </td>
        </tr>
    </tbody>
</table>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;">3. Have you consulted any
    other&nbsp;individual/organization on any assistance?</p>
<table
    style="width: 564px;"
    cellpadding="7"
>
    <tbody>
        <tr>
            <td style="">
                @if ($isEditable)
                    <input
                        name="consultationAnswer"
                        type="radio"
                        value="yes"
                        {{ ($TNAdata['consultationAnswer'] ?? '') === 'yes' ? 'checked' : '' }}
                    />
                @else
                    {{ ($TNAdata['consultationAnswer'] ?? '') === 'yes' ? '✓' : '' }}
                @endIf
            </td>
            <td style="">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Yes, from what company/agency</span></p>
            </td>
        </tr>
        <tr>
            <td style="">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="">
                @if ($isEditable)
                    <input
                        name="fromWhatCompanyAgency"
                        type="text"
                        value="{{ $TNAdata['fromWhatCompanyAgency'] ?? '' }}"
                        style="width: 100%;"
                    >
                @else
                    {{ $TNAdata['fromWhatCompanyAgency'] ?? '' }}
                @endIf
            </td>
        </tr>
        <tr>
            <td style="border: none;padding: 0cm;">

            </td>
            <td style="">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >Please specify the type of assistance sought</span></p>
            </td>
        </tr>
        <tr>
            <td style="">
            </td>
        </tr>
        <tr>
            <td style="">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="">
                @if ($isEditable)
                    <textarea
                        class="form-control"
                        name="pleaseSpecifyTheTypeOfAssistanceSought"
                        style="width: 100%;"
                    >{{ $TNAdata['pleaseSpecifyTheTypeOfAssistanceSought'] ?? '' }}</textarea>
                    <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br>
                    </p>
                @else
                    <p class="custom--justify">
                        <u>{{ $TNAdata['pleaseSpecifyTheTypeOfAssistanceSought'] ?? '' }}</u>
                    </p>
                @endIf
            </td>
        </tr>
        <tr>
            <td style="">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
        </tr>
        <tr>
            <td style="">
                @if ($isEditable)
                    <input
                        name="consultationAnswer"
                        type="radio"
                        value="no"
                        {{ ($TNAdata['consultationAnswer'] ?? '') === 'no' ? 'checked' : '' }}
                    />
                @else
                    {{ ($TNAdata['consultationAnswer'] ?? '') === 'no' ? '✓' : '' }}
                @endIf
            </td>
            <td style="">
                <p style="line-height: 11%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><span
                        lang="en-US"
                    >No, why not?</span></p>
            </td>
        </tr>
        <tr>
            <td style="">
                <p style="line-height: 11%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="">
                <p style="line-height: 11%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
        </tr>
        <tr>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 11%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="">
                @if ($isEditable)
                    <input
                        name="NoWhyNot"
                        type="text"
                        style="width: 100%;"
                    >
                @else
                    {{ $TNAdata['NoWhyNot'] ?? '' }}
                @endIf
            </td>
        </tr>
        <tr>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
            <td style="border: none;padding: 0cm;">
                <p style="line-height: 115%;text-align: left;margin-bottom: 0.25cm;background: transparent;"><br></p>
            </td>
        </tr>
    </tbody>
</table>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><span
        lang="en-US">Organizational Structure</span></p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
@if ($isEditable)
    <div class="organizational-structure-image-upload">
        <label
            class="form-label"
            for="organizationalStructure"
        >Upload Organizational Structure</label>
        <input
            id="organizationalStructure"
            name="organizationalStructure"
            type="file"
        >
        <input
            id="OrganizationalStructureFileID_Data_Handler"
            name="OrganizationalStructureFileID_Data_Handler"
            type="hidden"
        >
    </div>
@endif
<table style="width: 100%; border-collapse: collapse;">
    <tbody>
        <tr>
            <td style="width: 100%; text-align: center; align-items: center;">
                @if (isset($organizationalStructure['base64']) && isset($organizationalStructure['mimeType']))
                    <img
                        src="data:{{ $organizationalStructure['mimeType'] }};base64,{{ $organizationalStructure['base64'] }}"
                        alt=""
                        style="width: 16.17cm; height: 16.17cm; object-fit: contain; max-width: 100%; max-height: 100%;"
                    >
                @else
                    <p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;">
                        <br>&nbsp;
                    </p>
                    <p>No image available</p>
                    <p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;">
                        <br>&nbsp;
                    </p>
                @endif
            </td>
        </tr>
    </tbody>
</table>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><br>&nbsp;</p>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><span lang="en-US">4.
        Enterprise&rsquo;s plan for the next 5 years?</span></p>
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
                        name="enterprisePlanForTheNext5Years"
                        style="width: 100%;"
                    >{{ $TNAdata['enterprisePlanForTheNext5Years'] ?? '' }}</textarea>
                @else
                    <p class="custom--justify">
                        <u>{{ $TNAdata['enterprisePlanForTheNext5Years'] ?? '' }}</u>
                    </p>
                @endIf
            </td>
        </tr>
    </tbody>
</table>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><span lang="en-US">Next
        10 years?</span></p>
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
                        name="nextTenYears"
                        style="width: 100%;"
                    >{{ $TNAdata['nextTenYears'] ?? '' }}</textarea>
                @else
                    <p class="custom--justify">
                        <u>{{ $TNAdata['nextTenYears'] ?? '' }}</u>
                    </p>
                @endIf
            </td>
        </tr>
    </tbody>
</table>
<p style="line-height: 108%;text-align: left;margin-bottom: 0.28cm;background: transparent;"><span lang="en-US">5.
        Current agreement and alliances undertaken</span></p>
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
                        name="currentAgreementAndAlliancesUndertaken"
                        style="width: 100%;"
                    >{{ $TNAdata['currentAgreementAndAlliancesUndertaken'] ?? '' }}</textarea>
                @else
                    <p class="custom--justify">
                        <u>{{ $TNAdata['currentAgreementAndAlliancesUndertaken'] ?? '' }}</u>
                    </p>
                @endIf
            </td>
        </tr>
    </tbody>
</table>
<p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
        lang="en-US"><strong>BENCHMARK INFORMATION</strong></span></p>
<ul>
    <li>
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                lang="en-US"><strong>Production and Supply Chain</strong></span></p>
    </li>
</ul>
<p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;margin-left: 1.27cm;"><br></p>
<ul>
    <li>
        <p style="line-height: 100%;text-align: left;margin-bottom: 0cm;background: transparent;"><span
                lang="en-US">Raw Material</span></p>
    </li>
</ul>
<div id="productAndSupplyChainContainer">
    @if ($isEditable)
        <div
            class="mb-3"
            style="text-align: right;"
        >
            <button
                class="btn btn-sm btn-success"
                id="addProductAndSupplyRow"
                type="button"
            ><i class="ri-add-line"></i></button>
            <button
                class="btn btn-sm btn-danger"
                id="removeProductAndSupplyRow"
                data-remove-row-btn
                type="button"
            ><i class="ri-subtract-line"></i></button>
        </div>
    @endif
    <table
        id="productAndSupplyChainTable"
        style="width: 100%; table-layout: fixed; border-collapse: collapse;"
        cellpadding="7"
    >
        <thead>
            <td width="25%">
                Raw Material
            </td>
            <td width="25%">
                Source
            </td>
            <td width="25%">
                Unit Cost (₱)
            </td>
            <td width="25%">
                Volume Used/Year
            </td>
        </thead>
        <tbody>
            @forelse ($TNAdata['productAndSupply'] ?? [] as $productInfo)
                <tr>
                    <td>
                        @if ($isEditable)
                            <input
                                class="RawMaterial"
                                type="text"
                                value="{{ $productInfo['rowMaterial'] ?? '' }}"
                                style="width: 100%;"
                            >
                        @else
                            {{ $productInfo['rowMaterial'] ?? '' }}
                        @endIf
                    </td>
                    <td>
                        @if ($isEditable)
                            <input
                                class="Source"
                                type="text"
                                value="{{ $productInfo['source'] ?? '' }}"
                                style="width: 100%;"
                            >
                        @else
                            {{ $productInfo['source'] ?? '' }}
                        @endIf
                    </td>
                    <td>
                        @if ($isEditable)
                            <input
                                class="UnitCost"
                                type="text"
                                value="{{ $productInfo['unitCost'] ?? '' }}"
                                style="width: 100%;"
                            >
                        @else
                            {{ $productInfo['unitCost'] ?? '' }}
                        @endIf
                    </td>
                    <td>
                        @if ($isEditable)
                            <input
                                class="VolumeUsed"
                                type="text"
                                value="{{ $productInfo['volumeUsed'] ?? '' }}"
                                style="width: 100%;"
                            >
                        @else
                            {{ $productInfo['volumeUsed'] ?? '' }}
                        @endIf
                    </td>
                </tr>
            @empty
                <tr>
                    <td>
                        @if ($isEditable)
                            <input
                                class="RawMaterial"
                                type="text"
                                value=""
                                style="width: 100%;"
                            >
                        @endIf
                    </td>
                    <td>
                        @if ($isEditable)
                            <input
                                class="Source"
                                type="text"
                                value=""
                                style="width: 100%;"
                            >
                        @endIf
                    </td>
                    <td>
                        @if ($isEditable)
                            <input
                                class="UnitCost"
                                type="text"
                                value=""
                                style="width: 100%;"
                            >
                        @endIf
                    </td>
                    <td>
                        @if ($isEditable)
                            <input
                                class="VolumeUsed"
                                type="text"
                                value=""
                                style="width: 100%;"
                            >
                        @endIf
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
