@props(['projectDataSheetData', 'isEditable', 'isExporting' => false])
<form id="projectDataSheetForm">
    <div class="form-container">
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
                        :isEditable="$isEditable"
                        :value="$projectDataSheetData['projectTitle']"
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
                        :isEditable="$isEditable"
                        :value="$projectDataSheetData['firmName']"
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
                        :isEditable="$isEditable"
                        :value="$projectDataSheetData['address']"
                    />
                </td>
            </tr>
            <tr>
                <td class="label">Contact Person:</td>
                <td class="input">
                    <x-custom-input.input
                        name="ContactPerson"
                        type="text"
                        :isEditable="$isEditable"
                        :value="$projectDataSheetData['ContactPerson']"
                    />
                </td>
                <td class="label">Designation:</td>
                <td class="input">
                    <x-custom-input.input
                        name="Designation"
                        type="text"
                        :isEditable="$isEditable"
                        :value="$projectDataSheetData['Designation']"
                    />
                </td>
            </tr>
            <tr>
                <td class="label">Contact Details:</td>
                <td
                    class="contactData"
                    colspan="3"
                >
                    <span class="contact-label">Landline:&nbsp;&nbsp;</span>
                    <span class="input">
                        <x-custom-input.input
                            name="landline"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['landline']"
                        />
                    </span>
                    <span class="contact-label">Mobile Phone:&nbsp;&nbsp;</span>
                    <span class="input">
                        <x-custom-input.input
                            name="mobile"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['mobile']"
                        />
                    </span>
                    <span class="contact-label">Email Address:&nbsp;&nbsp;</span>&nbsp;&nbsp;
                    <span class="input">
                        <x-custom-input.input
                            name="email"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['email']"
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
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['reportingQuarter'] == 'Q1'"
                        /> 1st
                        Quarter </label>
                    &nbsp;&nbsp;
                    <label>
                        <x-custom-input.input
                            name="reportingQuarter"
                            type="radio"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['reportingQuarter'] == 'Q2'"
                        /> 2nd
                        Quarter </label>
                    &nbsp;&nbsp;
                    <label>
                        <x-custom-input.input
                            name="reportingQuarter"
                            type="radio"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['reportingQuarter'] == 'Q3'"
                        /> 3rd
                        Quarter </label>
                    &nbsp;&nbsp;
                    <label>
                        <x-custom-input.input
                            name="reportingQuarter"
                            type="radio"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['reportingQuarter'] == 'Q4'"
                        /> 4th
                        Quarter </label>
                </td>
            </tr>
        </table>
    </div>
    <div class="tg-wrap">
        <table class="tg">
            <tbody>
                <tr>
                    <td
                        class="no-border"
                        style="width: 20%;"
                    ></td>
                    <td
                        class="no-border"
                        style="width: 8.88%;"
                    ></td>
                    <td
                        class="no-border"
                        style="width: 8.88%;"
                    ></td>
                    <td
                        class="no-border"
                        style="width: 8.88%;"
                    ></td>
                    <td
                        class="no-border"
                        style="width: 8.88%;"
                    ></td>
                    <td
                        class="no-border"
                        style="width: 8.88%;"
                    ></td>
                    <td
                        class="no-border"
                        style="width: 8.88%;"
                    ></td>
                    <td
                        class="no-border"
                        style="width: 8.88%;"
                    ></td>
                    <td
                        class="no-border"
                        style="width: 8.88%;"
                    ></td>
                    <td
                        class="no-border"
                        style="width: 8.88%;"
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
                            name="buildingAsset"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['buildingAsset']"
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
                            name="equipmentAsset"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['equipmentAsset']"
                        /></td>
                </tr>
                <tr>
                    <td class="tg-7zrl">&nbsp;&nbsp;1.3 Working Capital</td>
                    <td
                        class="tg-8d8j"
                        colspan="6"
                    > <x-custom-input.input
                            name="workingCapitalAsset"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['workingCapitalAsset']"
                        /></td>
                </tr>
                <tr>
                    <td class="tg-wa1i">Classification of Enterprise: </td>
                    <td
                        class="tg-nrix"
                        colspan="9"
                    >
                        <label>
                            <x-custom-input.input
                                name="EnterpriseClass"
                                type="radio"
                                :isEditable="$isEditable"
                                :value="$projectDataSheetData['EnterpriseClass'] == 'Micro'"
                            />
                            Micro(assets&nbsp;&nbsp;&nbsp;Less than 3M)</label>
                        <label>
                            <x-custom-input.input
                                name="EnterpriseClass"
                                type="radio"
                                :isEditable="$isEditable"
                                :value="$projectDataSheetData['EnterpriseClass'] == 'Small'"
                            />
                            Small(assets&nbsp;&nbsp;&nbsp;of 3M to 15M)</label>
                        <label>
                            <x-custom-input.input
                                name="EnterpriseClass"
                                type="radio"
                                :isEditable="$isEditable"
                                :value="$projectDataSheetData['EnterpriseClass'] == 'Medium'"
                            />
                            Medium(assets&nbsp;&nbsp;&nbsp;15M to 100M)</label>
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
                        Days/20 x no Personnel)</td>
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
                            name="DireRegularMale"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['DireRegularMale']"
                        /> <br></td>
                    <td class="tg-8d8j"><x-custom-input.input
                            name="DireRegularFemale"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['DireRegularFemale']"
                        /> <br></td>
                    <td
                        class="tg-8d8j"
                        colspan="2"
                    ><x-custom-input.input
                            name="DireRegularTotalWorkday"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['DireRegularTotalWorkday']"
                        /> <br></td>
                    <td
                        class="tg-8d8j"
                        colspan="2"
                    ><x-custom-input.input
                            name="DireRegularTotalManMonth"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['DireRegularTotalManMonth']"
                        /> <br> </td>
                    <td
                        class="tg-8d8j"
                        colspan="3"
                    ><x-custom-input.input
                            name="RemarkDirectLabor"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['RemarkDirectLabor']"
                        /><br> </td>
                </tr>
                <tr>
                    <td class="tg-cly1">&nbsp;&nbsp;&nbsp;2.1b Part-time </td>
                    <td class="tg-8d8j"> <br><x-custom-input.input
                            name="ParttimeMale"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['ParttimeMale']"
                        /></td>
                    <td class="tg-8d8j"> <br><x-custom-input.input
                            name="ParttimeFemale"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['ParttimeFemale']"
                        /></td>
                    <td
                        class="tg-8d8j"
                        colspan="2"
                    > <br><x-custom-input.input
                            name="ParttimeTotalWorkday"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['ParttimeTotalWorkday']"
                        /></td>
                    <td
                        class="tg-8d8j"
                        colspan="2"
                    > <br><x-custom-input.input
                            name="ParttimeTotalManMonth"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['ParttimeTotalManMonth']"
                        /></td>
                    <td
                        class="tg-8d8j"
                        colspan="3"
                    > <br><x-custom-input.input
                            name="RemarkParttime"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['RemarkParttime']"
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
                            name="IndiRegularMale"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['IndiRegularMale']"
                        /></td>
                    <td class="tg-8d8j"> <br><x-custom-input.input
                            name="IndiRegularFemale"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['IndiRegularFemale']"
                        /></td>
                    <td
                        class="tg-8d8j"
                        colspan="2"
                    > <br><x-custom-input.input
                            name="IndiRegularTotalWorkday"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['IndiRegularTotalWorkday']"
                        /></td>
                    <td
                        class="tg-8d8j"
                        colspan="2"
                    > <br><x-custom-input.input
                            name="IndiRegularTotalManMonth"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['IndiRegularTotalManMonth']"
                        /></td>
                    <td
                        class="tg-8d8j"
                        colspan="3"
                    > <br><x-custom-input.input
                            name="IndiRegularRemark"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['IndiRegularRemark']"
                        /></td>
                </tr>
                <tr>
                    <td class="tg-cly1">&nbsp;&nbsp;&nbsp;2.2bPart-time</td>
                    <td class="tg-8d8j"> <br><x-custom-input.input
                            name="IndiParttimeMale"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['IndiParttimeMale']"
                        /></td>
                    <td class="tg-8d8j"> <br><x-custom-input.input
                            name="IndiParttimeFemale"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['IndiParttimeFemale']"
                        /></td>
                    <td
                        class="tg-8d8j"
                        colspan="2"
                    > <br><x-custom-input.input
                            name="IndiParttimeTotalWorkday"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['IndiParttimeTotalWorkday']"
                        /></td>
                    <td
                        class="tg-8d8j"
                        colspan="2"
                    > <br> <x-custom-input.input
                            name="IndiParttimeTotalManMonth"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['IndiParttimeTotalManMonth']"
                        /></td>
                    <td
                        class="tg-8d8j"
                        colspan="3"
                    > <br> <x-custom-input.input
                            name="IndiParttimeRemark"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['IndiParttimeRemark']"
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
                            :value="$projectDataSheetData['TotalEmployment']"
                        /></td>
                    <td
                        class="tg-cly1"
                        colspan="4"
                    >No. of Man-Months: <x-custom-input.input
                            name="TotalManMonth"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['TotalManMonth']"
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
                    <td class="tg-baqh">Name of Product </td>
                    <td class="tg-baqh">Packaging Details</td>
                    <td class="tg-baqh">Volume of Production</td>
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
                @forelse ($projectDataSheetData['exportProduct'] as $index => $product)
                    <tr>
                        @if ($index === 0)
                            <td
                                class="tg-0lax"
                                rowspan="{{ count($projectDataSheetData['exportProduct']) }}"
                            >&nbsp;&nbsp;3.1 Export Market
                            </td>
                        @endif
                        <td class="tg-8d8j">
                            <x-custom-input.input
                                class="productName"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$product['productName']"
                            />
                        </td>
                        <td class="tg-8d8j"><x-custom-input.input
                                class="packingDetails"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$product['packingDetails']"
                            /></td>
                        <td class="tg-8d8j"><x-custom-input.input
                                class="volumeOfProduction"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$product['volumeOfProduction']"
                            /></td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        ><x-custom-input.input
                                class="grossSales"
                                type="text"
                                :isEditable="$isEditable"
                                :value="'₱ ' . $product['grossSales']"
                            /></td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        ><x-custom-input.input
                                class="productionCost"
                                type="text"
                                :isEditable="$isEditable"
                                :value="'₱ ' . $product['productionCost']"
                            /></td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        ><x-custom-input.input
                                class="netSales"
                                type="text"
                                :isEditable="$isEditable"
                                :value="'₱ ' . $product['netSales']"
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
                                    :isEditable="$isEditable"
                                    :value="$product['productName']"
                                />
                            </td>
                            <td class="tg-8d8j"><x-custom-input.input
                                    class="packingDetails"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$product['packingDetails']"
                                /></td>
                            <td class="tg-8d8j"><x-custom-input.input
                                    class="volumeOfProduction"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$product['volumeOfProduction']"
                                /></td>
                            <td
                                class="tg-8d8j"
                                colspan="2"
                            ><x-custom-input.input
                                    class="grossSales"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="'₱ ' . $product['grossSales']"
                                /></td>
                            <td
                                class="tg-8d8j"
                                colspan="2"
                            ><x-custom-input.input
                                    class="productionCost"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="'₱ ' . $product['productionCost']"
                                /></td>
                            <td
                                class="tg-8d8j"
                                colspan="2"
                            ><x-custom-input.input
                                    class="netSales"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="'₱ ' . $product['netSales']"
                                /></td>
                        </tr>
                    @endfor
                @endforelse
                @forelse ($projectDataSheetData['localProduct'] as $index => $product)
                    <tr>
                        @if ($index === 0)
                            <td
                                class="tg-0lax"
                                rowspan="{{ count($projectDataSheetData['localProduct']) }}"
                            >&nbsp;&nbsp;3.1 Export Market
                            </td>
                        @endif
                        <td class="tg-8d8j">
                            <x-custom-input.input
                                class="productName"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$product['productName']"
                            />
                        </td>
                        <td class="tg-8d8j">
                            <x-custom-input.input
                                class="packingDetails"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$product['packingDetails']"
                            />
                        </td>
                        <td class="tg-8d8j">
                            <x-custom-input.input
                                class="volumeOfProduction"
                                type="text"
                                :isEditable="$isEditable"
                                :value="$product['volumeOfProduction']"
                            />
                        </td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        ><x-custom-input.input
                                class="grossSales"
                                type="text"
                                :isEditable="$isEditable"
                                :value="'₱ ' . $product['grossSales']"
                            /></td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        ><x-custom-input.input
                                class="productionCost"
                                type="text"
                                :isEditable="$isEditable"
                                :value="'₱ ' . $product['productionCost']"
                            /></td>
                        <td
                            class="tg-8d8j"
                            colspan="2"
                        ><x-custom-input.input
                                class="netSales"
                                type="text"
                                :isEditable="$isEditable"
                                :value="'₱ ' . $product['netSales']"
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
                                    :isEditable="$isEditable"
                                    :value="$product['productName']"
                                />
                            </td>
                            <td class="tg-8d8j">
                                <x-custom-input.input
                                    class="packingDetails"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$product['packingDetails']"
                                />
                            </td>
                            <td class="tg-8d8j">
                                <x-custom-input.input
                                    class="volumeOfProduction"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="$product['volumeOfProduction']"
                                />
                            </td>
                            <td
                                class="tg-8d8j"
                                colspan="2"
                            ><x-custom-input.input
                                    class="grossSales"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="'₱ ' . $product['grossSales']"
                                /></td>
                            <td
                                class="tg-8d8j"
                                colspan="2"
                            ><x-custom-input.input
                                    class="productionCost"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="'₱ ' . $product['productionCost']"
                                /></td>
                            <td
                                class="tg-8d8j"
                                colspan="2"
                            ><x-custom-input.input
                                    class="netSales"
                                    type="text"
                                    :isEditable="$isEditable"
                                    :value="'₱ ' . $product['netSales']"
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
                    > <br>{{ $projectDataSheetData['totalGrossSales'] }} </td>
                    <td
                        class="tg-8d8j"
                        colspan="2"
                    > <br>{{ $projectDataSheetData['totalProductionCost'] }}</td>
                    <td
                        class="tg-8d8j"
                        colspan="2"
                    > <br>{{ $projectDataSheetData['totalNetSales'] }}</td>
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
                            name="ExportOutlet"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['ExportOutlet']"
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
                            name="LocalOutlet"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['LocalOutlet']"
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
                    >Gross Sales Generated = Gross Sales Q4 - Gross
                        Sales Q3</td>
                    <td
                        class="tg-baqh"
                        colspan="2"
                    >Gross Sales&nbsp;&nbsp;&nbsp;Q4(for the reporting period)</td>
                    <td
                        class="tg-baqh"
                        colspan="2"
                    >Cross Sales&nbsp;&nbsp;&nbsp;Q3(Previous Quarter)</td>
                    <td
                        class="tg-baqh"
                        colspan="2"
                    >TOTAL GROSS&nbsp;&nbsp;&nbsp;SALES GENERATED</td>
                </tr>
                <tr>
                    <td
                        class="tg-8d8j"
                        colspan="2"
                    >
                        <x-custom-input.input
                            name="CurrentgrossSales"
                            type="text"
                            :isEditable="$isEditable"
                            :value="$projectDataSheetData['CurrentgrossSales']"
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
                            :value="$projectDataSheetData['PreviousgrossSales']"
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
                            :value="$projectDataSheetData['TotalgrossSales']"
                        />
                    </td>
                </tr>
                <tr>
                    <td
                        class="tg-0lax"
                        colspan="4"
                    >% Increase in Productivity Generated =
                        Gross Sales current-Gross Sales previous&nbsp;&nbsp;&nbsp;/ Gross Sales previous X 100 = %</td>
                    <td
                        class="tg-8d8j"
                        colspan="6"
                    >
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                        {{ $projectDataSheetData['CurrentgrossSales'] }}-{{ $projectDataSheetData['PreviousgrossSales'] }}&nbsp;&nbsp;&nbsp;/
                        {{ $projectDataSheetData['PreviousgrossSales'] }} X 100 =
                        {{ $projectDataSheetData['totalgrossSales_percent'] }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                </tr>
                <tr>
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
                            :value="$projectDataSheetData['CurrentEmployment']"
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
                            :value="$projectDataSheetData['PreviousEmployment']"
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
                            :value="$projectDataSheetData['TotalEmploymentGenerated']"
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
                        {{ $CurrentEmployment }}-{{ $PreviousEmployment }}&nbsp;&nbsp;&nbsp;/
                        {{ $PreviousEmployment }} X 100 = {{ $totalEmployment_percent }}
                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                </tr>
            </tbody>
        </table>
        {!! $esignatureElement !!}
    </div>
</form>
