@props([
    'reportData',
    'currentQuarter',
    'previousQuarter',
    'isEditable' => false,
    'isExporting' => false,
    'projectId',
    'quarter',
])
<div id="formWrapper">
    @if (!$isExporting)
        <nav
            class="sticky-top position-sticky"
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
                >Project Data Sheet</li>
            </ol>
        </nav>
    @endif
    <form id="projectDataSheetForm">
        @if (!$isExporting)
            <x-document-header />
        @endif
        <div class="form-container mt-4">
            <table
                class="ProjectInfo"
                style="overflow: hidden"
                autosize="1"
            >
                <tr>
                    <td class="label">Project Title:</td>
                    <td
                        class="input"
                        colspan="3"
                    >
                        <x-custom-input.input
                            name="projectTitle"
                            type="text"
                            readonly
                            :isEditable="$isEditable"
                            :value="$reportData->project_title ?? ''"
                        />
                    </td>
                </tr>
                <tr>
                    <td class="label">Name of Firm:</td>
                    <td
                        class="input"
                        colspan="3"
                    >
                        <x-custom-input.input
                            name="firmName"
                            type="text"
                            readonly
                            :isEditable="$isEditable"
                            :value="$reportData->firm_name ?? ''"
                        />
                    </td>
                </tr>
                <tr>
                    <td class="label">Address:</td>
                    <td
                        class="input"
                        colspan="3"
                    >
                        <x-custom-input.input
                            name="address"
                            type="text"
                            readonly
                            :isEditable="$isEditable"
                            :value="$reportData->office_landmark ??
                                '' .
                                    ', ' .
                                    ($reportData->office_barangay ?? '') .
                                    ', ' .
                                    ($reportData->office_city ?? '') .
                                    ', ' .
                                    ($reportData->office_province ?? '') .
                                    ', ' .
                                    ($reportData->office_region ?? '') .
                                    ', ' .
                                    ($reportData->office_zip_code ?? '')"
                        />
                    </td>
                </tr>
                <tr>
                    <td class="label">Contact Person:</td>
                    <td
                        class="input"
                        style="width: 50%;"
                    >
                        <x-custom-input.input
                            name="ContactPerson"
                            type="text"
                            readonly
                            :isEditable="$isEditable"
                            :value="$reportData->f_name .
                                ' ' .
                                $reportData->mid_name .
                                ' ' .
                                $reportData->l_name .
                                ' ' .
                                $reportData->suffix"
                        />
                    </td>
                    <td class="label">Designation:</td>
                    <td
                        class="input"
                        style="width: 50%;"
                    >
                        <x-custom-input.input
                            name="Designation"
                            type="text"
                            readonly
                            :isEditable="$isEditable"
                            :value="$reportData->designation ?? ''"
                        />
                    </td>
                </tr>
                <tr>
                    <td class="label">Contact Details:</td>
                    <td
                        class="contactData"
                        colspan="3"
                    >
                        <span class="contact-label">Landline:</span>
                        <span
                            class="input"
                            style="width: 19%; display: inline-block;"
                        >
                            <x-custom-input.input
                                name="landline"
                                type="text"
                                readonly
                                :isEditable="$isEditable"
                                :value="$reportData->landline ?? ''"
                            />
                        </span>
                        <span class="contact-label">Mobile Phone:</span>
                        <span
                            class="input"
                            style="width: 19%; display: inline-block;"
                        >
                            <x-custom-input.input
                                name="mobile"
                                type="text"
                                readonly
                                :isEditable="$isEditable"
                                :value="$reportData->mobile ?? ''"
                            />
                        </span>
                        <span class="contact-label">Email Address:</span>
                        <span
                            class="input"
                            style="width: 19%; display: inline-block;"
                        >
                            <x-custom-input.input
                                name="email"
                                type="text"
                                readonly
                                :isEditable="$isEditable"
                                :value="$reportData->email ?? ''"
                            />
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="label">Period Covered:</td>
                    <td colspan="3">
                        <label>
                            <x-custom-input.input
                                name="reportingQuarter"
                                type="radio"
                                readonly
                                :isEditable="$isEditable"
                            /> 1st
                            Quarter </label>
                        &nbsp;&nbsp;
                        <label>
                            <x-custom-input.input
                                name="reportingQuarter"
                                type="radio"
                                readonly
                                :isEditable="$isEditable"
                                :value="isset($quarter) && str_starts_with($quarter, 'Q2') ? 'Q2' : ''"
                            /> 2nd
                            Quarter </label>
                        &nbsp;&nbsp;
                        <label>
                            <x-custom-input.input
                                name="reportingQuarter"
                                type="radio"
                                readonly
                                :isEditable="$isEditable"
                                :value="isset($quarter) && str_starts_with($quarter, 'Q3') ? 'Q3' : ''"
                            /> 3rd
                            Quarter </label>
                        &nbsp;&nbsp;
                        <label>
                            <x-custom-input.input
                                name="reportingQuarter"
                                type="radio"
                                readonly
                                :isEditable="$isEditable"
                                :value="isset($quarter) && str_starts_with($quarter, 'Q4') ? 'Q4' : ''"
                            /> 4th
                            Quarter </label>
                    </td>
                </tr>
            </table>
        </div>
        <div class="tg-wrap">
            <table
                class="tg"
                style="table-layout: fixed; width: 100%;"
            >
                <tbody>
                    <tr>
                        <td
                            class="no-border"
                            style="width: 20%;"
                        ></td>
                        <td
                            class="no-border"
                            style="width: 11.88%;"
                        ></td>
                        <td
                            class="no-border"
                            style="width: 11.88%;"
                        ></td>
                        <td
                            class="no-border"
                            style="width: 11.88%;"
                        ></td>
                        <td
                            class="no-border"
                            style="width: 8.88%;"
                        ></td>
                        <td
                            class="no-border"
                            style="width: 6.88%;"
                        ></td>
                        <td
                            class="no-border"
                            style="width: 6.88%;"
                        ></td>
                        <td
                            class="no-border"
                            style="width: 7.88%;"
                        ></td>
                        <td
                            class="no-border"
                            style="width: 7.88%;"
                        ></td>
                        <td
                            class="no-border"
                            style="width: 7.88%;"
                        ></td>
                    </tr>
                    <tr>
                        <td
                            class="tg-yla0 table--headerText"
                            colspan="10"
                        >1.0 ASSETS</td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl">&nbsp;&nbsp;1.1 Building</td>
                        <td
                            class="tg-8d8j"
                            colspan="6"
                        >₱<x-custom-input.input
                                name="Building"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['Building'] ?? ''"
                            /></td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
                            rowspan="3"
                        > &nbsp;&nbsp;<br>&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl">&nbsp;&nbsp;1.2 Equipment</td>
                        <td
                            class="tg-8d8j"
                            colspan="6"
                        > <x-custom-input.input
                                name="Equipment"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['Equipment'] ?? ''"
                            /></td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl">&nbsp;&nbsp;1.3 Working Capital</td>
                        <td
                            class="tg-8d8j"
                            colspan="6"
                        > <x-custom-input.input
                                name="WorkingCapital"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['WorkingCapital'] ?? ''"
                            /></td>
                    </tr>
                    <tr>
                        <td class="tg-wa1i">Classification of Enterprise: </td>
                        @php
                            $building = floatval(str_replace(',', '', $currentQuarter['Building'] ?? 0));
                            $equipment = floatval(str_replace(',', '', $currentQuarter['Equipment'] ?? 0));
                            $workingCapital = floatval(str_replace(',', '', $currentQuarter['WorkingCapital'] ?? 0));
                            $totalAssets = $building + $equipment + $workingCapital;
                        @endphp
                        <td
                            class="tg-nrix"
                            colspan="9"
                        >
                            <label>
                                <x-custom-input.input
                                    name="EnterpriseClass"
                                    type="radio"
                                    :isEditable="$isEditable"
                                    :value="$totalAssets < 3000000 ? 'Micro' : ''"
                                />
                                Micro(assets&nbsp;&nbsp;&nbsp;Less than 3M)
                            </label>
                            <label>
                                <x-custom-input.input
                                    name="EnterpriseClass"
                                    type="radio"
                                    :isEditable="$isEditable"
                                    :value="$totalAssets >= 3000000 && $totalAssets < 15000000 ? 'Small' : ''"
                                />
                                Small(assets&nbsp;&nbsp;&nbsp;of 3M to 15M)
                            </label>
                            <label>
                                <x-custom-input.input
                                    name="EnterpriseClass"
                                    type="radio"
                                    :isEditable="$isEditable"
                                    :value="$totalAssets >= 15000000 && $totalAssets < 100000000 ? 'Medium' : ''"
                                />
                                Medium(assets&nbsp;&nbsp;&nbsp;15M to 100M)
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-j6zm table--headerText"
                            colspan="7"
                        >2.0 TOTAL EMPLOYMENT FOR THE QUARTER</td>
                        <td
                            class="tg-7zrl"
                            colspan="3"
                        > </td>
                    </tr>
                    @php
                        use App\Services\NumberFormatterService as NF;

                        function calculateTotalEmployment($data)
                        {
                            $totalNumPersonnel = 0;
                            $totalManMonth = 0;

                            // Process Direct Labor Regular
                            $maleDirectRegular = NF::parseFormattedNumber($data['male_Dir_Regular'] ?? '0');
                            $femaleDirectRegular = NF::parseFormattedNumber($data['female_Dir_Regular'] ?? '0');
                            $workdaysDirectRegular = NF::parseFormattedNumber($data['workday_Dir_Regular'] ?? '0');
                            $directRegularManMonth =
                                ($maleDirectRegular + $femaleDirectRegular) * ($workdaysDirectRegular / 20);
                            $data['DireRegularTotalManMonth'] = NF::formatNumber($directRegularManMonth);

                            // Process Direct Labor Part-time
                            $maleDirectPartTime = NF::parseFormattedNumber($data['male_Dir_PartT'] ?? '0');
                            $femaleDirectPartTime = NF::parseFormattedNumber($data['female_Dir_PartT'] ?? '0');
                            $workdaysDirectPartTime = NF::parseFormattedNumber($data['workday_Dir_PartT'] ?? '0');
                            $directPartTimeManMonth =
                                ($maleDirectPartTime + $femaleDirectPartTime) * ($workdaysDirectPartTime / 20);
                            $data['ParttimeTotalManMonth'] = NF::formatNumber($directPartTimeManMonth);

                            // Process Indirect Labor Regular
                            $maleIndirectRegular = NF::parseFormattedNumber($data['male_Indir_Regular'] ?? '0');
                            $femaleIndirectRegular = NF::parseFormattedNumber($data['female_Indir_Regular'] ?? '0');
                            $workdaysIndirectRegular = NF::parseFormattedNumber($data['workday_Indir_Regular'] ?? '0');
                            $indirectRegularManMonth =
                                ($maleIndirectRegular + $femaleIndirectRegular) * ($workdaysIndirectRegular / 20);
                            $data['IndiRegularTotalManMonth'] = NF::formatNumber($indirectRegularManMonth);

                            // Process Indirect Labor Part-time
                            $maleIndirectPartTime = NF::parseFormattedNumber($data['male_Indir_PartT'] ?? '0');
                            $femaleIndirectPartTime = NF::parseFormattedNumber($data['female_Indir_PartT'] ?? '0');
                            $workdaysIndirectPartTime = NF::parseFormattedNumber($data['workday_Indir_PartT'] ?? '0');
                            $indirectPartTimeManMonth =
                                ($maleIndirectPartTime + $femaleIndirectPartTime) * ($workdaysIndirectPartTime / 20);
                            $data['IndiParttimeTotalManMonth'] = NF::formatNumber($indirectPartTimeManMonth);

                            // Calculate totals
                            $totalNumPersonnel =
                                $maleDirectRegular +
                                $femaleDirectRegular +
                                $maleDirectPartTime +
                                $femaleDirectPartTime +
                                $maleIndirectRegular +
                                $femaleIndirectRegular +
                                $maleIndirectPartTime +
                                $femaleIndirectPartTime;

                            $totalManMonth =
                                $directRegularManMonth +
                                $directPartTimeManMonth +
                                $indirectRegularManMonth +
                                $indirectPartTimeManMonth;

                            // Set the totals
                            $data['TotalEmployment'] = NF::formatNumber($totalNumPersonnel, 0);
                            $data['TotalManMonth'] = NF::formatNumber($totalManMonth);

                            return $data;
                        }
                        $currentQuarter = calculateTotalEmployment($currentQuarter ?? []);
                    @endphp
                    <tr>
                        <td class="tg-8d8j"> <br><br></td>
                        <td
                            class="tg-baqh"
                            colspan="2"
                        >No. of Personnel </td>
                        <td
                            class="tg-baqh"
                            colspan="2"
                            rowspan="2"
                        >Total Work Days of the Personnel for the Quarter
                        </td>
                        <td
                            class="tg-baqh"
                            colspan="2"
                            rowspan="2"
                        >Total Man-Month=no. of Work
                            Days/20 x no Personnel</td>
                        <td
                            class="tg-baqh"
                            colspan="3"
                            rowspan="2"
                        >Remarks</td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-nrix">Male </td>
                        <td class="tg-nrix">Female </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl">&nbsp;&nbsp;2.1 Direct Labor Force(Production)</td>
                        <td class="tg-8d8j"> <br></td>
                        <td class="tg-8d8j"> <br></td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        > <br></td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        > <br> </td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
                        > <br> </td>
                    </tr>
                    <tr>
                        <td class="tg-cly1">&nbsp;&nbsp;&nbsp;2.1a Regular</td>
                        <td class="tg-8d8j"><x-custom-input.input
                                class="maleInput"
                                name="male_Dir_Regular"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['male_Dir_Regular'] ?? ''"
                            /> <br></td>
                        <td class="tg-8d8j"><x-custom-input.input
                                class="femaleInput"
                                name="female_Dir_Regular"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['female_Dir_Regular'] ?? ''"
                            /> <br></td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        ><x-custom-input.input
                                class="workdayInput"
                                name="workday_Dir_Regular"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['workday_Dir_Regular'] ?? ''"
                            /> <br></td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        ><x-custom-input.input
                                name="DireRegularTotalManMonth totalManMonth"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['DireRegularTotalManMonth'] ?? ''"
                            /> <br> </td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
                        ><x-custom-input.input
                                name="RemarkDirectLabor"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['RemarkDirectLabor'] ?? ''"
                            /><br> </td>
                    </tr>
                    <tr>
                        <td class="tg-cly1">&nbsp;&nbsp;&nbsp;2.1b Part-time </td>
                        <td class="tg-8d8j"> <br><x-custom-input.input
                                class="maleInput"
                                name="male_Dir_PartT"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['male_Dir_PartT'] ?? ''"
                            /></td>
                        <td class="tg-8d8j"> <br><x-custom-input.input
                                class="femaleInput"
                                name="female_Dir_PartT"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['female_Dir_PartT'] ?? ''"
                            /></td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        > <br><x-custom-input.input
                                name="workday_Dir_PartT workdayInput"
                                type="text"
                                :isEditable="$isEditable"
                                readonly
                                :value="$currentQuarter['workday_Dir_PartT'] ?? ''"
                            /></td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        > <br><x-custom-input.input
                                class="form-control totalManMonth"
                                name="ParttimeTotalManMonth"
                                type="text"
                                readonly
                                :isEditable="$isEditable"
                                :value="$currentQuarter['ParttimeTotalManMonth'] ?? ''"
                            /></td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
                        > <br><x-custom-input.input
                                name="RemarkParttime"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['RemarkParttime'] ?? ''"
                            /></td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl">&nbsp;&nbsp;2.2 Indirect Labor Force(Admin and Marketing)</td>
                        <td class="tg-8d8j"> <br><br></td>
                        <td class="tg-8d8j"> <br><br></td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        > <br><br></td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        > <br> <br> </td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
                        > <br> <br> </td>
                    </tr>
                    <tr>
                        <td class="tg-cly1">&nbsp;&nbsp;&nbsp;2.2a Regular </td>
                        <td class="tg-8d8j"> <br><x-custom-input.input
                                name="male_Indir_Regular"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['male_Indir_Regular'] ?? ''"
                            /></td>
                        <td class="tg-8d8j"> <br><x-custom-input.input
                                name="female_Indir_Regular"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['female_Indir_Regular'] ?? ''"
                            /></td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        > <br><x-custom-input.input
                                name="workday_Indir_Regular"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['workday_Indir_Regular'] ?? ''"
                            /></td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        > <br><x-custom-input.input
                                name="IndiRegularTotalManMonth"
                                type="text"
                                :isEditable="$isEditable"
                                readonly
                                :value="$currentQuarter['IndiRegularTotalManMonth'] ?? ''"
                            /></td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
                        > <br><x-custom-input.input
                                name="IndiRegularRemark"
                                type="text"
                                :isEditable="$isEditable"
                                readonly
                                :value="$currentQuarter['IndiRegularRemark'] ?? ''"
                            /></td>
                    </tr>
                    <tr>
                        <td class="tg-cly1">&nbsp;&nbsp;&nbsp;2.2b Part-time</td>
                        <td class="tg-8d8j"> <br><x-custom-input.input
                                name="male_Indir_PartT"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['male_Indir_PartT'] ?? ''"
                            /></td>
                        <td class="tg-8d8j"> <br><x-custom-input.input
                                name="female_Indir_PartT"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['female_Indir_PartT'] ?? ''"
                            /></td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        > <br><x-custom-input.input
                                name="workday_Indir_PartT"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['workday_Indir_PartT'] ?? ''"
                            /></td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        > <br> <x-custom-input.input
                                name="IndiParttimeTotalManMonth"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['IndiParttimeTotalManMonth'] ?? ''"
                            /></td>
                        <td
                            class="tg-8d8j"
                            colspan="3"
                        > <br> <x-custom-input.input
                                name="IndiParttimeRemark"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['IndiParttimeRemark'] ?? ''"
                            /></td>
                    </tr>
                    <tr>
                        <td
                            class="tg-0lax"
                            colspan="3"
                        >Total Employment for this Quarter: </td>
                        <td
                            class="tg-cly1"
                            colspan="3"
                        >No. of Personnel: <x-custom-input.input
                                name="TotalEmployment"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['TotalEmployment'] ?? ''"
                            /></td>
                        <td
                            class="tg-cly1"
                            colspan="4"
                        >No. of Man-Months: <x-custom-input.input
                                name="TotalManMonth"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['TotalManMonth'] ?? ''"
                            /></td>
                    </tr>
                    <tr>
                        <td
                            class="tg-1wig table--headerText"
                            colspan="10"
                        >3.0 PRODUCTION AND SALES DATA FOR THE QUARTER
                        </td>
                    </tr>
                    <tr>
                        <td class="tg-8d8j"> <br><br></td>
                        <td class="tg-baqh">Name of <br>Product </td>
                        <td class="tg-baqh">Packaging <br>Details
                        </td>
                        <td class="tg-baqh">Volume <br>of <br>Production
                        </td>
                        <td
                            class="tg-baqh"
                            colspan="2"
                        >Gross Sales </td>
                        <td
                            class="tg-baqh"
                            colspan="2"
                        >Estimated Cost of Production</td>
                        <td
                            class="tg-baqh"
                            colspan="2"
                        >Net Sales</td>
                    </tr>
                    @php

                        function calculateProductTotals($data)
                        {
                            // Initialize totals
                            $totalGrossSales = 0;
                            $totalProductionCost = 0;
                            $totalNetSales = 0;

                            // Process export products
                            if (isset($data['ExportProduct']) && is_array($data['ExportProduct'])) {
                                foreach ($data['ExportProduct'] as &$product) {
                                    // Remove currency symbol if present
                                    $grossSalesRaw = isset($product['grossSales'])
                                        ? str_replace('₱ ', '', $product['grossSales'])
                                        : '0';
                                    $productionCostRaw = isset($product['estimatedCostOfProduction'])
                                        ? str_replace('₱ ', '', $product['estimatedCostOfProduction'])
                                        : '0';

                                    // Parse the values
                                    $grossSales = NF::parseFormattedNumber($grossSalesRaw);
                                    $productionCost = NF::parseFormattedNumber($productionCostRaw);

                                    // Calculate net sales
                                    $netSales = $grossSales - $productionCost;

                                    // Update the product with calculated net sales
                                    $product['netSales'] = NF::formatNumber($netSales);

                                    // Add to totals
                                    $totalGrossSales += $grossSales;
                                    $totalProductionCost += $productionCost;
                                    $totalNetSales += $netSales;
                                }
                            }

                            // Process local products
                            if (isset($data['LocalProduct']) && is_array($data['LocalProduct'])) {
                                foreach ($data['LocalProduct'] as &$product) {
                                    // Remove currency symbol if present
                                    $grossSalesRaw = isset($product['grossSales'])
                                        ? str_replace('₱ ', '', $product['grossSales'])
                                        : '0';
                                    $productionCostRaw = isset($product['estimatedCostOfProduction'])
                                        ? str_replace('₱ ', '', $product['estimatedCostOfProduction'])
                                        : '0';

                                    // Parse the values
                                    $grossSales = NF::parseFormattedNumber($grossSalesRaw);
                                    $productionCost = NF::parseFormattedNumber($productionCostRaw);

                                    // Calculate net sales
                                    $netSales = $grossSales - $productionCost;

                                    // Update the product with calculated net sales
                                    $product['netSales'] = NF::formatNumber($netSales);

                                    // Add to totals
                                    $totalGrossSales += $grossSales;
                                    $totalProductionCost += $productionCost;
                                    $totalNetSales += $netSales;
                                }
                            }

                            // Update the totals in the data array
                            $data['totalGrossSales'] = '₱ ' . NF::formatNumber($totalGrossSales);
                            $data['totalProductionCost'] = '₱ ' . NF::formatNumber($totalProductionCost);
                            $data['totalNetSales'] = '₱ ' . NF::formatNumber($totalNetSales);
                            $data['CurrentgrossSales_val'] = NF::formatNumber($totalGrossSales);

                            return $data;
                        }

                        // You can use this function in your controller or directly in your blade template
                        $currentQuarter = calculateProductTotals($currentQuarter ?? []);
                    @endphp
                    @forelse ($currentQuarter['ExportProduct'] ?? [] as $index => $product)
                        <tr>
                            @if ($index === 0)
                                <td
                                    class="tg-0lax"
                                    rowspan="{{ count($currentQuarter['ExportProduct']) }}"
                                >&nbsp;&nbsp;3.1 Export Market
                                </td>
                            @endif
                            <td class="tg-8d8j">
                                <x-custom-input.input
                                    class="productName"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$product['ProductName'] ?? ''"
                                />
                            </td>
                            <td class="tg-8d8j"><x-custom-input.input
                                    class="packingDetails"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$product['PackingDetails'] ?? ''"
                                /></td>
                            <td class="tg-8d8j"><x-custom-input.input
                                    class="volumeOfProduction"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$product['volumeOfProduction']['value'] ??
                                        '' . ' ' . $product['volumeOfProduction']['unit']"
                                /></td>
                            <td
                                class="tg-8d8j"
                                colspan="2"
                            ><x-custom-input.input
                                    class="grossSales"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="'₱ ' . $product['grossSales'] ?? ''"
                                /></td>
                            <td
                                class="tg-8d8j"
                                colspan="2"
                            ><x-custom-input.input
                                    class="productionCost"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="'₱ ' . $product['estimatedCostOfProduction'] ?? ''"
                                /></td>
                            <td
                                class="tg-8d8j"
                                colspan="2"
                            ><x-custom-input.input
                                    class="netSales"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="'₱ ' . $product['netSales'] ?? ''"
                                /></td>
                        </tr>
                    @empty
                        @for ($i = 0; $i < 4; $i++)
                            <tr>
                                @if ($i === 0)
                                    <td
                                        class="tg-0lax"
                                        rowspan="{{ 4 - $i }}"
                                    >&nbsp;&nbsp;3.1 Export Market
                                    </td>
                                @endif
                                <td class="tg-8d8j">
                                    <x-custom-input.input
                                        class="productName"
                                        type="text"
                                        value=""
                                        :isEditable="$isEditable"
                                    />
                                </td>
                                <td class="tg-8d8j"><x-custom-input.input
                                        class="packingDetails"
                                        type="text"
                                        value=""
                                        :isEditable="$isEditable"
                                    /></td>
                                <td class="tg-8d8j"><x-custom-input.input
                                        class="volumeOfProduction"
                                        type="text"
                                        value=""
                                        :isEditable="$isEditable"
                                    /></td>
                                <td
                                    class="tg-8d8j"
                                    colspan="2"
                                ><x-custom-input.input
                                        class="grossSales"
                                        type="text"
                                        value=""
                                        :isEditable="$isEditable"
                                    /></td>
                                <td
                                    class="tg-8d8j"
                                    colspan="2"
                                ><x-custom-input.input
                                        class="productionCost"
                                        type="text"
                                        value=""
                                        :isEditable="$isEditable"
                                    /></td>
                                <td
                                    class="tg-8d8j"
                                    colspan="2"
                                ><x-custom-input.input
                                        class="netSales"
                                        type="text"
                                        value=""
                                        :isEditable="$isEditable"
                                    /></td>
                            </tr>
                        @endfor
                    @endforelse
                    @forelse ($currentQuarter['LocalProduct'] ?? [] as $index => $product)
                        <tr>
                            @if ($index === 0)
                                <td
                                    class="tg-0lax"
                                    rowspan="{{ count($currentQuarter['LocalProduct']) }}"
                                >&nbsp;&nbsp;3.2 Local Market
                                </td>
                            @endif
                            <td class="tg-8d8j">
                                <x-custom-input.input
                                    class="productName"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$product['ProductName'] ?? ''"
                                />
                            </td>
                            <td class="tg-8d8j">
                                <x-custom-input.input
                                    class="packingDetails"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$product['PackingDetails'] ?? ''"
                                />
                            </td>
                            <td class="tg-8d8j">
                                <x-custom-input.input
                                    class="volumeOfProduction"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$product['volumeOfProduction']['value'] ??
                                        '' . ' ' . $product['volumeOfProduction']['unit']"
                                />
                            </td>
                            <td
                                class="tg-8d8j"
                                colspan="2"
                            ><x-custom-input.input
                                    class="grossSales"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="'₱ ' . $product['grossSales'] ?? ''"
                                /></td>
                            <td
                                class="tg-8d8j"
                                colspan="2"
                            ><x-custom-input.input
                                    class="productionCost"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="'₱ ' . $product['estimatedCostOfProduction'] ?? ''"
                                /></td>
                            <td
                                class="tg-8d8j"
                                colspan="2"
                            ><x-custom-input.input
                                    class="netSales"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="'₱ ' . $product['netSales'] ?? ''"
                                /></td>
                        </tr>
                    @empty
                        @for ($i = 0; $i < 4; $i++)
                            <tr>
                                @if ($i === 0)
                                    <td
                                        class="tg-0lax"
                                        rowspan="{{ 4 - $i }}"
                                    >&nbsp;&nbsp;3.1 Export Market
                                    </td>
                                @endif
                                <td class="tg-8d8j">
                                    <x-custom-input.input
                                        class="productName"
                                        type="text"
                                        value=""
                                        :isEditable="$isEditable"
                                    />
                                </td>
                                <td class="tg-8d8j">
                                    <x-custom-input.input
                                        class="packingDetails"
                                        type="text"
                                        value=""
                                        :isEditable="$isEditable"
                                    />
                                </td>
                                <td class="tg-8d8j">
                                    <x-custom-input.input
                                        class="volumeOfProduction"
                                        type="text"
                                        value=""
                                        :isEditable="$isEditable"
                                    />
                                </td>
                                <td
                                    class="tg-8d8j"
                                    colspan="2"
                                ><x-custom-input.input
                                        class="grossSales"
                                        type="text"
                                        value=""
                                        :isEditable="$isEditable"
                                    /></td>
                                <td
                                    class="tg-8d8j"
                                    colspan="2"
                                ><x-custom-input.input
                                        class="productionCost"
                                        type="text"
                                        value=""
                                        :isEditable="$isEditable"
                                    /></td>
                                <td
                                    class="tg-8d8j"
                                    colspan="2"
                                ><x-custom-input.input
                                        class="netSales"
                                        type="text"
                                        value=""
                                        :isEditable="$isEditable"
                                    /></td>
                            </tr>
                        @endfor
                    @endforelse
                    <tr>
                        <td
                            class="tg-cly1"
                            colspan="4"
                        >TOTAL </td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        > <br>{{ $currentQuarter['totalGrossSales'] ?? '' }} </td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        > <br>{{ $currentQuarter['totalProductionCost'] ?? '' }}</td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        > <br>{{ $currentQuarter['totalNetSales'] ?? '' }}</td>
                    </tr>

                    <tr>
                        <td
                            class="tg-yla0 table--headerText"
                            colspan="10"
                        >4.0 MARKET OUTLETS</td>
                    </tr>

                    <tr>
                        <td class="tg-cly1">&nbsp;&nbsp;4.1 Export</td>
                        <td
                            class="tg-8d8j"
                            colspan="9"
                        >
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <x-custom-input.input
                                name="Market_Export"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['Market_Export'] ?? ''"
                            />
                        </td>
                    </tr>

                    <tr>
                        <td class="tg-cly1">&nbsp;&nbsp;4.2 Local</td>
                        <td
                            class="tg-8d8j"
                            colspan="9"
                        >
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <x-custom-input.input
                                name="Market_local"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['Market_local'] ?? ''"
                            />
                        </td>
                    </tr>
                    <br>
                    <tr>
                        <td
                            style="height: 10px; border-left: none; border-right: none;"
                            colspan="8"
                        >&nbsp;</td>
                    </tr>
                    <tr>
                        <td
                            class="tg-vkv7 table--headerText"
                            colspan="10"
                        >TO BE ACCOMPLISHED BY DOST XI</td>
                    </tr>

                    <tr>
                        <td
                            class="tg-baqh"
                            colspan="4"
                            rowspan="2"
                        >Gross Sales Generated = Gross Sales {{ $currentQuarter['quarter'] ?? '' }} - Gross
                            Sales {{ $previousQuarter['quarter'] ?? '' }}</td>
                        <td
                            class="tg-baqh"
                            colspan="2"
                        >Gross Sales {{ $currentQuarter['quarter'] ?? '' }}<br>(for the reporting period)
                        </td>
                        <td
                            class="tg-baqh"
                            colspan="2"
                        >Cross Sales {{ $previousQuarter['quarter'] ?? '' }}<br>(Previous Quarter)</td>
                        <td
                            class="tg-baqh"
                            colspan="2"
                        >TOTAL GROSS SALES GENERATED</td>
                    </tr>
                    @php
                        $previousGrossSales = 0;
                        if ($previousQuarter != null) {
                            foreach ($previousQuarter['ExportProduct'] ?? [] as $exportProduct) {
                                $previousGrossSales += (float) str_replace(',', '', $exportProduct['grossSales']);
                            }
                            foreach ($previousQuarter['LocalProduct'] ?? [] as $localProduct) {
                                $previousGrossSales += (float) str_replace(',', '', $localProduct['grossSales']);
                            }
                        }
                        $previous_quarter_gross_sales = NF::parseFormattedNumber(
                            $previousQuarter['PreviousgrossSales'] ?? number_format($previousGrossSales),
                        );
                        $current_quarter_gross_sales = NF::parseFormattedNumber(
                            $currentQuarter['CurrentgrossSales_val'] ?? '',
                        );

                        $total_gross_sales = (float) $current_quarter_gross_sales - $previous_quarter_gross_sales;
                    @endphp
                    <tr>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        >
                            <x-custom-input.input
                                name="CurrentgrossSales_val"
                                type="text"
                                :isEditable="$isEditable"
                                :value="'₱' . ($currentQuarter['CurrentgrossSales_val'] ?? '')"
                            />
                        </td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        >
                            <x-custom-input.input
                                name="PreviousgrossSales"
                                type="text"
                                :isEditable="$isEditable"
                                :value="'₱' .
                                    ' ' .
                                    ($previousQuarter['PreviousgrossSales'] ?? NF::formatNumber($previousGrossSales))"
                            />
                        </td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        >

                            <x-custom-input.input
                                name="TotalgrossSales"
                                type="text"
                                :isEditable="$isEditable"
                                :value="'₱' .
                                    ' ' .
                                    ($currentQuarter['TotalgrossSales'] ?? NF::formatNumber($total_gross_sales))"
                            />
                        </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-0lax"
                            colspan="4"
                        >% Increase in Productivity Generated =
                            Gross Sales current-Gross Sales previous&nbsp;&nbsp;&nbsp;/ Gross Sales previous X 100 = %
                        </td>
                        <td
                            class="tg-8d8j"
                            colspan="6"
                        >
                            @php
                                $total_gross_sales_percent =
                                    ((float) ($current_quarter_gross_sales - $previous_quarter_gross_sales) /
                                        $previous_quarter_gross_sales) *
                                    100;
                            @endphp
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                            <span
                                class="CurrentgrossSales_val_cal">{{ $currentQuarter['CurrentgrossSales_val'] ?? '' }}</span>
                            -
                            <span class="PreviousgrossSales_val_cal">
                                {{ NF::formatNumber($previous_quarter_gross_sales) }}</span>&nbsp;&nbsp;&nbsp;
                            X 100 / =
                            <span class="totalgrossSales_percent">
                                {{ NF::formatNumber($total_gross_sales_percent) . '' . '%' }}</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                    </tr>
                    {{-- <tr>
                        <td
                            class="tg-0lax"
                            colspan="4"
                            rowspan="2"
                        >Employment Generated = Employment Q4 -
                            Employment Q3</td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        >Total&nbsp;&nbsp;&nbsp;Employment Q4(For the reporting period)
                        </td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        >Total&nbsp;&nbsp;&nbsp;Employment Q3 (previous quarter)</td>
                        <td
                            class="tg-baqh"
                            colspan="2"
                        >EMPLOYMENT&nbsp;&nbsp;&nbsp;GENERATED </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        >
                            <x-custom-input.input
                                name="CurrentEmployment"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['CurrentEmployment'] ?? ''"
                            />
                        </td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        >
                            <x-custom-input.input
                                name="PreviousEmployment"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['PreviousEmployment'] ?? ''"
                            />
                        </td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        >
                            <x-custom-input.input
                                name="TotalEmploymentGenerated"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$currentQuarter['TotalEmploymentGenerated'] ?? ''"
                            />
                        </td>
                    </tr>
                    <tr>
                        <td
                            class="tg-8d8j"
                            colspan="4"
                        >% Increase in Employment Generated =
                            -&nbsp;&nbsp;&nbsp;/ X 100 = </td>
                        <td
                            class="tg-8d8j"
                            colspan="6"
                        >
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            {{ $CurrentEmployment ?? '' }}-{{ $PreviousEmployment ?? '' }}&nbsp;&nbsp;&nbsp;/
                            {{ $PreviousEmployment ?? '' }} X 100 = {{ $totalEmployment_percent ?? '' }}
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                    </tr> --}}
                </tbody>
            </table>
            <table
                style="border-collapse: collapse; width: 100%; font-family: sans-serif; font-size: 10pt; margin-top: 7pt;"
            >
                <tbody>
                    <!-- Cooperator Section -->
                    <tr>
                        <td style="width: 20%;">Accomplished by</td>
                        <td style="width: 2%;">:</td>
                        <td style="width: 78%;">
                            <div>Name and
                                Signature of Cooperator</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td style="border-top: 1pt solid black; padding-bottom: 3pt; width: 50%;">
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 7pt; width: 20%;">Date</td>
                        <td style="padding-top: 7pt; width: 2%;">:</td>
                        <td style="padding-top: 7pt; width: 78%;">
                            Date
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td style="border-top: 1pt solid black; padding-bottom: 3pt; width: 50%;">
                        </td>
                    </tr>

                    <!-- Spacer -->
                    <tr>
                        <td
                            style="height: 50px;"
                            colspan="3"
                        ></td>
                    </tr>

                    <!-- PSTD Section -->
                    <tr>
                        <td
                            style="text-align: right;"
                            colspan="3"
                        >
                            <table
                                style="border-collapse: collapse; font-family: sans-serif; font-size: 10pt; width: 70%; float: right;"
                            >
                                <tr>
                                    <td style="width: 40%; text-align: right;">Reviewed and Submitted by</td>
                                    <td style="width: 5%; text-align: center;">:</td>
                                    <td style="width: 55%; border-bottom: 1pt solid black; padding-bottom: 3pt;">
                                        Name and Signature of PSTD
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 7pt; text-align: right;">Date</td>
                                    <td style="padding-top: 7pt; text-align: center;">:</td>
                                    <td style="padding-top: 7pt; border-bottom: 1pt solid black; padding-bottom: 3pt;">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </form>
    @if (!$isExporting)
        @if (!$isExporting)
            <div class="position-sticky bottom-0 py-5 mt-4 pe-none">
                <div class="container">
                    @if ($isEditable)
                        <div class="d-flex justify-content-end">
                            <button
                                class="btn btn-primary pe-auto"
                                form="projectDataSheetForm"
                                type="submit"
                            >Set Document Data</button>
                        </div>
                    @else
                        <div class="d-flex justify-content-end">
                            <button
                                class="btn btn-primary pe-auto"
                                id="exportProjectDataSheetFormToPDF"
                                data-generated-url="{{ URL::signedRoute('staff.Project.generate.data-sheet-document', ['projectId' => $projectId, 'quarter' => $quarter]) }}"
                                type="button"
                            >Export as PDF</button>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    @endif
</div>
