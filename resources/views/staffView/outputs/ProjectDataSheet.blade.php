<style type="text/css">

body{
    font-family: Arial, sans-serif;
    font-size: 14px;
}
    .tg {
        border-collapse: collapse;
        border-spacing: 0;
        margin: 0px auto;
        width: 100%;
        table-layout: fixed;
    }

    .tg td {
        border-color: black;
        border-style: solid;
        border-width: 1px;
        overflow: hidden;
        padding: 2px 6px;
        word-break: normal;
    }

    .tg th {
        border-color: black;
        border-style: solid;
        border-width: 1px;
        font-family: Arial, sans-serif;
        font-size: 12px;
        font-weight: normal;
        overflow: hidden;
        padding: 10px 5px;
        word-break: normal;
    }


    .tg .tg-cly1 {
        text-align: left;
        vertical-align: middle
    }

    .tg .tg-1wig {
        font-weight: bold;
        text-align: left;
        vertical-align: top
    }

    .tg .tg-baqh {
        text-align: center;
        vertical-align: top
    }

    .tg .tg-wa1i {
        font-weight: bold;
        text-align: center;
        vertical-align: middle
    }

    .tg .tg-vkv7 {
        background-color: #FF0;
        font-weight: bold;
        text-align: left;
        vertical-align: middle
    }

    .tg .tg-j6zm {
        font-weight: bold;
        text-align: left;
        vertical-align: bottom
    }

    .tg .tg-7zrl {
        text-align: left;
        vertical-align: bottom
    }

    .tg .tg-8d8j {
        font-size: 12px;
        font-family: Arial, sans-serif;
        text-align: left;
        vertical-align: bottom
    }

    .tg .tg-nrix {
        font-family: arial, sans-serif;
        text-align: center;
        vertical-align: middle
    }

    .tg .tg-0lax {
        text-align: left;
        vertical-align: top
    }

    .tg .tg-yla0 {
        font-weight: bold;
        text-align: left;
        vertical-align: middle
    }

    .form-group {
        font-family: Arial, sans-serif;
        font-size: 12px;
    }

    #dataSheetHeader img {
        width: 100%;
        height: auto;
    }


    #containerSize {
        width: 794px;
    }

.form-container {
    font-family: Arial, sans-serif;
    width: 100%;
    max-width: 794px;
    margin: 0 auto;
    line-height: 1.5;
    padding-bottom: 20px;
}

table .ProjectInfo {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    table-layout: fixed;
}

.ProjectInfo td:nth-child(1) {
    width: 15%;
}

.ProjectInfo td:nth-child(2) {
    width: 85%;
}
.ProjectInfo td {
    border-color: black;
        border-style: solid;
        border-width: 1px;
}


.label {
    width: 10%;
    font-size: 12px;
    font-weight: normal;
    vertical-align: top;
}

.input {
    font-weight: bold;
    border-bottom: 1px solid #000;
    padding-bottom: 5px;
    font-size: 12px;
}

.small-label {
    width: 10%;
    font-weight: bold;
    vertical-align: top;
}

.small-input {
    width: 30%;
    border-bottom: 1px solid #000;
    padding-bottom: 5px;
}

input[type="checkbox"] {
    margin-right: 10px;
}

.bottomBorder {
    width: 100%;
    border: 0px;
}



.contact-label {
    font-weight: normal;
    font-size: 10px;
    margin-right: 2px;
}



</style>
<div id="containerSize">
    <div class="form-container">
        <table class="ProjectInfo" style="overflow: hidden" autosize="1">
            <tr>
                <td class="label">Project Title:</td>
                <td class="input" colspan="3">{{ $projectTitle }}</td>
            </tr>
            <tr>
                <td class="label">Name of Firm:</td>
                <td class="input" colspan="3">{{ $firmName }}</td>
            </tr>
            <tr>
                <td class="label">Address:</td>
                <td class="input" colspan="3">{{ $address }}</td>
            </tr>
            <tr>
                <td class="label">Contact Person:</td>
                <td class="input">{{ $ContactPerson }}</td>
                <td class="label">Designation:</td>
                <td class="input">{{ $Designation }}</td>
            </tr>
            <tr>
                <td class="label">Contact Details:</td>
                <td class="contactData" colspan="3">
                        <span class="contact-label">Landline:&nbsp;&nbsp;</span>
                        <span class="input">{{ $landline ?? 'None' }}</span>
                        <span class="contact-label">Mobile Phone:&nbsp;&nbsp;</span>
                        <span class="input">{{ $mobile }}</span>
                        <span class="contact-label">Email Address:&nbsp;&nbsp;</span>&nbsp;&nbsp;
                        <span class="input">{{ $email }}</span>
                </td>
            </tr>
            <tr>
                <td class="label">Period Covered:</td>
                <td colspan="3">
                    <label><input type="checkbox"> 1st Quarter </label> &nbsp;&nbsp;
                    <label><input type="checkbox"> 2nd Quarter </label> &nbsp;&nbsp;
                    <label><input type="checkbox"> 3rd Quarter </label> &nbsp;&nbsp;
                    <label><input type="checkbox"> 4th Quarter </label>
                </td>
            </tr>
        </table>
    </div>

    <div class="tg-wrap">
        <table class="tg">
            <tbody>
                <tr>
                    <td style="width: 20%;"></td>
                    <td style="width: 10%;"></td>
                    <td style="width: 10%;"></td>
                    <td style="width: 10%;"></td>
                    <td style="width: 10%;"></td>
                    <td style="width: 10%;"></td>
                    <td style="width: 10%;"></td>
                    <td style="width: 15%;"></td>
                </tr>
                <tr>
                    <td class="tg-yla0" colspan="8">1.0 ASSETS</td>
                </tr>
                <tr>
                    <td class="tg-7zrl">&nbsp;&nbsp;1.1 Building</td>
                    <td class="tg-8d8j" colspan="4"> {{ '₱ ' . $buildingAsset }}</td>
                    <td class="tg-8d8j" colspan="3" rowspan="3"> &nbsp;&nbsp;<br>&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td class="tg-7zrl">&nbsp;&nbsp;1.2 Equipment</td>
                    <td class="tg-8d8j" colspan="4"> {{ '₱ ' . $EquipmentAsset }}</td>
                </tr>
                <tr>
                    <td class="tg-7zrl">&nbsp;&nbsp;1.3 Working Capital</td>
                    <td class="tg-8d8j" colspan="4"> {{ '₱ ' . $workingCapitalAsset }}</td>
                </tr>
                <tr>
                    <td class="tg-wa1i">Classification of Enterprise: </td>
                    <td class="tg-nrix" colspan="2">Micro(assets&nbsp;&nbsp;&nbsp;Less than 3M)</td>
                    <td class="tg-nrix" colspan="2">Small(assets&nbsp;&nbsp;&nbsp;of 3M to 15M)</td>
                    <td class="tg-nrix" colspan="3">Medium(assets&nbsp;&nbsp;&nbsp;15M to 100M)</td>
                </tr>
                <tr>
                    <td class="tg-j6zm" colspan="6">2.0 TOTAL EMPLOYMENT FOR THE QUARTER</td>
                    <td class="tg-7zrl" colspan="2"> </td>
                </tr>
                <tr>
                    <td class="tg-8d8j"> <br><br></td>
                    <td class="tg-baqh" colspan="2">No. of Personnel </td>
                    <td class="tg-baqh" rowspan="2">Total Work Days of the Personnel for the Quarter
                    </td>
                    <td class="tg-baqh" colspan="2" rowspan="2">Total Man-Month=no. of Work
                        Days/20 x no Personnel)</td>
                    <td class="tg-baqh" colspan="2" rowspan="2">Remarks</td>
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
                    <td class="tg-8d8j"> <br></td>
                    <td class="tg-8d8j" colspan="2"> <br> </td>
                    <td class="tg-8d8j" colspan="2"> <br> </td>
                </tr>
                <tr>
                    <td class="tg-cly1">&nbsp;&nbsp;&nbsp;2.1a Regular</td>
                    <td class="tg-8d8j">{{ $DireRegularMale }} <br></td>
                    <td class="tg-8d8j">{{ $DireRegularFemale }} <br></td>
                    <td class="tg-8d8j">{{ $DireRegularTotalWorkday }} <br></td>
                    <td class="tg-8d8j" colspan="2">{{ $DireRegularTotalManMonth }} <br> </td>
                    <td class="tg-8d8j" colspan="2">{{ $RemarkDirectLabor }} <br> </td>
                </tr>
                <tr>
                    <td class="tg-cly1">&nbsp;&nbsp;&nbsp;2.1b Part-time </td>
                    <td class="tg-8d8j"> <br>{{ $ParttimeMale }}</td>
                    <td class="tg-8d8j"> <br>{{ $ParttimeFemale }}</td>
                    <td class="tg-8d8j"> <br>{{ $ParttimeTotalWorkday }}</td>
                    <td class="tg-8d8j" colspan="2"> <br>{{ $ParttimeTotalManMonth }} </td>
                    <td class="tg-8d8j" colspan="2"> <br>{{ $RemarkParttime }} </td>
                </tr>
                <tr>
                    <td class="tg-7zrl">&nbsp;&nbsp;2.2 Indirect Labor Force(Admin and Marketing)</td>
                    <td class="tg-8d8j"> <br><br></td>
                    <td class="tg-8d8j"> <br><br></td>
                    <td class="tg-8d8j"> <br><br></td>
                    <td class="tg-8d8j" colspan="2"> <br> <br> </td>
                    <td class="tg-8d8j" colspan="2"> <br> <br> </td>
                </tr>
                <tr>
                    <td class="tg-cly1">&nbsp;&nbsp;&nbsp;2.2a Regular </td>
                    <td class="tg-8d8j"> <br>{{ $IndiRegularMale }}</td>
                    <td class="tg-8d8j"> <br>{{ $IndiRegularFemale }}</td>
                    <td class="tg-8d8j"> <br>{{ $IndiRegularTotalWorkday }}</td>
                    <td class="tg-8d8j" colspan="2"> <br> {{ $IndiRegularTotalManMonth }}</td>
                    <td class="tg-8d8j" colspan="2"> <br> {{ $IndiRegularRemark }}</td>
                </tr>
                <tr>
                    <td class="tg-cly1">&nbsp;&nbsp;&nbsp;2.2bPart-time</td>
                    <td class="tg-8d8j"> <br>{{ $IndiParttimeMale }}</td>
                    <td class="tg-8d8j"> <br>{{ $IndiParttimeFemale }}</td>
                    <td class="tg-8d8j"> <br>{{ $IndiParttimeTotalWorkday }}</td>
                    <td class="tg-8d8j" colspan="2"> <br> {{ $IndiParttimeTotalManMonth }}</td>
                    <td class="tg-8d8j" colspan="2"> <br> {{ $IndiParttimeRemark }}</td>
                </tr>
                <tr>
                    <td class="tg-0lax" colspan="3">Total Employment for this Quarter: </td>
                    <td class="tg-cly1" colspan="2">No. of Personnel: {{ $TotalEmployment }}</td>
                    <td class="tg-cly1" colspan="3">No. of Man-Months: {{ $TotalManMonth }}</td>
                </tr>
                <tr>
                    <td class="tg-1wig" colspan="8">3.0 PRODUCTION AND SALES DATA FOR THE QUARTER
                    </td>
                </tr>
                <tr>
                    <td class="tg-8d8j"> <br><br></td>
                    <td class="tg-baqh">Name of Product </td>
                    <td class="tg-baqh">Packaging Details</td>
                    <td class="tg-baqh">Volume of Production</td>
                    <td class="tg-baqh" colspan="2">Gross Sales </td>
                    <td class="tg-baqh">Estimated Cost of Production</td>
                    <td class="tg-baqh">Net Sales</td>
                </tr>
                @foreach ($exportProduct as $index => $product)
                    <tr>
                        @if ($index === 0)
                            <td class="tg-0lax" rowspan="{{ count($exportProduct) }}">&nbsp;&nbsp;3.1 Export Market</td>
                        @endif
                        <td class="tg-8d8j">{{ $product['productName'] }}</td>
                        <td class="tg-8d8j">{{ $product['packingDetails'] }}</td>
                        <td class="tg-8d8j">{{ $product['volumeOfProduction'] }}</td>
                        <td class="tg-8d8j" colspan="2">{{ $product['grossSales'] }}</td>
                        <td class="tg-8d8j">{{ $product['productionCost'] }}</td>
                        <td class="tg-8d8j">{{ $product['netSales'] }}</td>
                    </tr>
                @endforeach
                @foreach ($localProduct as $index => $product)
                    <tr>
                        @if ($index === 0)
                            <td class="tg-0lax" rowspan="{{ count($localProduct) }}">&nbsp;&nbsp;3.1 Export Market</td>
                        @endif
                        <td class="tg-8d8j">{{ $product['productName'] }}</td>
                        <td class="tg-8d8j">{{ $product['packingDetails'] }}</td>
                        <td class="tg-8d8j">{{ $product['volumeOfProduction'] }}</td>
                        <td class="tg-8d8j" colspan="2">{{ $product['grossSales'] }}</td>
                        <td class="tg-8d8j">{{ $product['productionCost'] }}</td>
                        <td class="tg-8d8j">{{ $product['netSales'] }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td class="tg-cly1" colspan="4">TOTAL </td>
                    <td class="tg-8d8j" colspan="2"> <br>{{ $totalGrossSales }} </td>
                    <td class="tg-8d8j"> <br>{{ $totalProductionCost }}</td>
                    <td class="tg-8d8j"> <br>{{ $totalNetSales }}</td>
                </tr>

                <tr>
                    <td class="tg-yla0" colspan="8">4.0 MARKET OUTLETS</td>
                </tr>

                <tr>
                    <td class="tg-cly1">&nbsp;&nbsp;4.1 Export</td>
                    <td class="tg-8d8j" colspan="7">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $ExportOutlet }}</td>
                </tr>

                <tr>
                    <td class="tg-cly1">&nbsp;&nbsp;4.2 Local</td>
                    <td class="tg-8d8j" colspan="7">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $LocalOutlet }}</td>
                </tr>
                <br>
                <tr>
                    <td colspan="8" style="height: 10px; border-left: none; border-right: none;">&nbsp;</td>
                </tr>
                <tr>
                    <td class="tg-vkv7" colspan="8">TO BE ACCOMPLISHED BY DOST XI</td>
                </tr>

                <tr>
                    <td class="tg-baqh" colspan="2" rowspan="2">Gross Sales Generated = Gross Sales Q4 - Gross
                        Sales Q3</td>
                    <td class="tg-baqh" colspan="2">Gross Sales&nbsp;&nbsp;&nbsp;Q4(for the reporting period)</td>
                    <td class="tg-baqh" colspan="2">Cross Sales&nbsp;&nbsp;&nbsp;Q3(Previous Quarter)</td>
                    <td class="tg-baqh" colspan="2">TOTAL GROSS&nbsp;&nbsp;&nbsp;SALES GENERATED</td>
                </tr>
                <tr>
                    <td class="tg-8d8j" colspan="2">{{ $CurrentgrossSales }}</td>
                    <td class="tg-8d8j" colspan="2">{{ $PreviousgrossSales }}</td>
                    <td class="tg-8d8j" colspan="2">{{ $TotalgrossSales }}</td>
                </tr>
                <tr>
                    <td class="tg-0lax" colspan="2">% Increase in Productivity Generated =
                        Gross Sales current-Gross Sales previous&nbsp;&nbsp;&nbsp;/ Gross Sales previous X 100 =  %</td>
                    <td class="tg-8d8j" colspan="6">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                        {{ $CurrentgrossSales }}-{{ $PreviousgrossSales }}&nbsp;&nbsp;&nbsp;/ {{ $PreviousgrossSales }} X 100 = {{ $totalgrossSales_percent }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                </tr>
                <tr>
                    <td class="tg-0lax" colspan="2" rowspan="2">Employment Generated = Employment Q4 -
                        Employment Q3</td>
                    <td class="tg-8d8j" colspan="2">Total&nbsp;&nbsp;&nbsp;Employment Q4(For the reporting period)
                    </td>
                    <td class="tg-8d8j" colspan="2">Total&nbsp;&nbsp;&nbsp;Employment Q3 (previous quarter)</td>
                    <td class="tg-baqh" colspan="2">EMPLOYMENT&nbsp;&nbsp;&nbsp;GENERATED </td>
                </tr>
                <tr>
                    <td class="tg-8d8j" colspan="2">{{ $CurrentEmployment }}</td>
                    <td class="tg-8d8j" colspan="2"> {{ $PreviousEmployment }} </td>
                    <td class="tg-8d8j" colspan="2"> {{ $TotalEmploymentGenerated }}</td>
                </tr>
                <tr>
                    <td class="tg-8d8j" colspan="2">% Increase in Employment Generated =
                        -&nbsp;&nbsp;&nbsp;/ X 100 = </td>
                    <td class="tg-8d8j" colspan="6">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ $CurrentEmployment }}-{{ $PreviousEmployment }}&nbsp;&nbsp;&nbsp;/ {{ $PreviousEmployment }} X 100 = {{ $totalEmployment_percent }}
                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
