<!DOCTYPE html>
<html>

<head>
    <title>Hello, World!</title>
    <style type="text/css">

   #pageSize{
    margin: 20px;
   }

        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            margin: 0px;
        }

        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg th {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg .tg-cly1 {
            text-align: left;
            vertical-align: middle
        }

        .tg .tg-bobw {
            font-weight: bold;
            text-align: center;
            vertical-align: bottom
        }

        .tg .tg-wa1i {
            font-weight: bold;
            margin: 20px;
            text-align: center;
            vertical-align: middle
        }

        .tg .tg-hvke {
            font-family: Arial, Helvetica, sans-serif !important;
            font-weight: bold;
            text-align: left;
            vertical-align: bottom
        }

        .tg .col-fir-header-width{
            width: 80%;
        }

        .tg .col-Sec-header-width{
            width: 20%;
        }

        .tg .tg-j6zm {
            font-weight: bold;
            text-align: left;
            vertical-align: bottom
        }

        .tg .tg-8d8j {
            text-align: center;
            vertical-align: bottom
        }

        .tg .tg-7zrl {
            text-align: left;
            vertical-align: bottom
        }

        .tg .tg-0lax {
            text-align: left;
            vertical-align: top
        }


        #dataSheetTable {
            width: 100%;
            max-width: 210mm;
            /* Width of A4 paper */
            height: 297mm;
            /* Height of A4 paper */
            margin: 0 auto;
            /* Center the table on the page */
        }

        #InfoSheetHeader img {
            width: 100%;
            height: auto;
        }



        @media print {

            .tg {
                width: 100%;
                /* Adjust the width as necessary */
                box-sizing: border-box;
                /* Include padding and borders in the width */
                max-width: 100%;
                /* Ensure it doesn't exceed the page width */
                font-size: 10px;
                /* Reduce font size to fit content */
            }

            .tg td,
            .tg th {
                padding: 5px;
                /* Reduce padding to save space */
            }

        }
    </style>

</head>

<body>
    <div id="pageSize">
        <div class="tg-wrap">
            <table id="dataSheetTable" class="tg">
                <thead>
                    <tr>
                        <th class="tg-hvke col-fir-header-width" colspan="5">Project title:</th>
                        <th class="tg-j6zm col-Sec-header-width">Project Code</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="tg-8d8j" colspan="5">{{ $projectTitle }} &nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-j6zm" colspan="5">Name of Firm:{{ $firmName }}</td>
                        <td class="tg-7zrl"></td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="4">Owner: Contact&nbsp;&nbsp;&nbsp;Person:</td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="3">Name: {{ $name }}</td>
                        <td class="tg-7zrl">Gender: {{ $gender }}</td>
                        <td class="tg-7zrl">Age: {{ $age  }}</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-j6zm" colspan="5">Type of Organization Enterprize:&nbsp;&nbsp;&nbsp;</td>
                        <td class="tg-7zrl">  </td>
                    </tr>
                    <tr>
                        <td class="tg-8d8j" colspan="5"> {{ $typeOfOrganization }}</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-j6zm" colspan="5">Business Address:</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-8d8j" colspan="4">{{ $businessAddress }}</td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-j6zm">Contact&nbsp;&nbsp;&nbsp;Details: </td>
                        <td class="tg-7zrl">Landline: {{ $landline ?? ' ' }}</td>
                        <td class="tg-7zrl" colspan="3">Fax: {{ $fax ?? ' ' }} </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="2">Mobile Phone: {{ $mobile_phone }}</td>
                        <td class="tg-7zrl" colspan="3">Email Address:
                            {{ $email }}
                        </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-j6zm" colspan="2">Total Assets</td>
                        <td class="tg-bobw" colspan="3"> &nbsp;&nbsp;{{ $totalAssets }}</td>
                        <td class="tg-8d8j" rowspan="5"> <br><br><br><br></td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl">Land</td>
                        <td class="tg-8d8j" colspan="3"> &nbsp;&nbsp;{{ $land }}</td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl">Building </td>
                        <td class="tg-8d8j" colspan="3"> &nbsp;&nbsp;{{ $building }}</td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl">Equiment </td>
                        <td class="tg-8d8j" colspan="3"> &nbsp;&nbsp;{{ $equipment }}</td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl">Working Capital</td>
                        <td class="tg-8d8j" colspan="3">&nbsp;&nbsp;{{ $workingCapital }}</td>
                    </tr>
                    <tr>
                        <td class="tg-wa1i" colspan="2" >Total&nbsp;&nbsp;&nbsp;Employment Generated
                        </td>
                        <td class="tg-wa1i" colspan="3" >{{ $TotalmanMonths }}&nbsp;&nbsp;man-mouth</td>
                        <td class="tg-8d8j" colspan="1" ><br /><br /></td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="5">Direct&nbsp;Employment:</td>
                        <td class="tg-7zrl"></td>
                    </tr>
                    <tr>
                        <td class="tg-0lax" colspan="2">*Company&nbsp;Hire </td>
                        <td class="tg-7zrl">Male</td>
                        <td class="tg-7zrl">Female</td>
                        <td class="tg-7zrl">Sub-total</td>
                        <td class="tg-7zrl"></td>
                    </tr>
                    <tr>
                        <td class="tg-0lax" colspan="2">Regular</td>
                        <td class="tg-7zrl">{{ $Regular_male ?? ' ' }}</td>
                        <td class="tg-7zrl">{{ $Regular_female ?? ' ' }}</td>
                        <td class="tg-7zrl">{{ $Regular_subtotal ?? ' ' }}</td>
                        <td class="tg-7zrl"></td>
                    </tr>

                    <tr>
                        <td class="tg-0lax" colspan="2"> Part-Time</td>
                        <td class="tg-7zrl">{{ $Parttime_male ?? ' ' }}</td>
                        <td class="tg-7zrl">{{ $Parttime_female ?? ' ' }}</td>
                        <td class="tg-7zrl">{{ $Parttime_subtotal ?? ' ' }} </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-0lax" colspan="2">*Sub-contractor Hire</td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-0lax" colspan="2"> Regular</td>
                        <td class="tg-7zrl">{{ $Regu_Subcont_male ?? ' ' }} </td>
                        <td class="tg-7zrl">{{ $Regu_Subcont_female ?? ' ' }}</td>
                        <td class="tg-7zrl">{{ $Regu_Subcont_subtotal ?? ' ' }}</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-0lax" colspan="2"> Part-Time</td>
                        <td class="tg-7zrl">{{ $Subcont_Parttime_male ?? ' ' }}</td>
                        <td class="tg-7zrl">{{ $Subcont_Parttime_female ?? ' ' }}</td>
                        <td class="tg-7zrl">{{ $Subcont_Parttime_subtotal ?? ' ' }}</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="2">Indirect Employment</td>
                        <td class="tg-7zrl">Male</td>
                        <td class="tg-7zrl">Female</td>
                        <td class="tg-7zrl">Sub-total</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="2">*Regular </td>
                        <td class="tg-7zrl">{{ $Indirect_Regular_male ?? ' ' }}</td>
                        <td class="tg-7zrl">{{ $Indirect_Regular_female ?? ' ' }}</td>
                        <td class="tg-7zrl"> {{ $Indirect_Regular_subtotal ?? ' ' }} </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="2">*Part-time</td>
                        <td class="tg-7zrl">{{ $Indirect_Parttime_male ?? ' ' }} </td>
                        <td class="tg-7zrl">{{ $Indirect_Parttime_female ?? ' ' }}</td>
                        <td class="tg-7zrl">{{ $Indirect_Parttime_subtotal ?? ' ' }} </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-wa1i" colspan="2" rowspan="2">Total&nbsp;&nbsp;&nbsp;Volume of Production
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
                        <td class="tg-cly1" colspan="2" rowspan="2">*Local</td>
                        <td class="tg-8d8j" colspan="3" rowspan="2"> &nbsp;&nbsp;<br>&nbsp;&nbsp;{{ $localProduct ?? ' ' }}</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-cly1" colspan="2" rowspan="2">*Export</td>
                        <td class="tg-8d8j" colspan="3" rowspan="2"> &nbsp;&nbsp;<br>&nbsp;&nbsp;{{ $exportProduct ?? ' ' }}</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-wa1i" colspan="2" rowspan="2">Total&nbsp;&nbsp;&nbsp;Gross Sales(P):</td>
                        <td class="tg-8d8j" colspan="3" rowspan="2"> &nbsp;&nbsp;<br>{{ $totalGrossSales }}&nbsp;&nbsp;</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-cly1" colspan="2" rowspan="2">*Local(P)</td>
                        <td class="tg-8d8j" colspan="3" rowspan="2"> &nbsp;&nbsp;<br>&nbsp;&nbsp;{{ $localProduct_Val }}</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-cly1" colspan="2" rowspan="2">*Export(P)</td>
                        <td class="tg-8d8j" colspan="3" rowspan="2"> &nbsp;&nbsp;<br>&nbsp;&nbsp;{{ $exportProduct_Val }}</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="2">Country of&nbsp;&nbsp;&nbsp;Destination:</td>
                        <td class="tg-8d8j" colspan="3"> &nbsp;&nbsp;</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-j6zm" colspan="5">Assistance obtained&nbsp;&nbsp;&nbsp;from DOST(please
                            check)</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="5">A.1 Production&nbsp;&nbsp;&nbsp;Technology{{ $productionTechnology_checkbox == 'on' ? '✓' : ' ' }}</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="5">A.1.1 Process{{ $process_checkbox == 'on' ? '✓' : ' ' }}</td>
                        <td class="tg-7zrl">{{ $processDefinition ?? ' ' }}</td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="5">A.1.2 Equiment{{ $equipment_checkbox == 'on' ? '✓' : ' ' }}</td>
                        <td class="tg-7zrl">{{ $equipmentDefinition ?? ' ' }}</td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="5">A.1.3Quality&nbsp;&nbsp;&nbsp;Control/Laboratory
                            Testing/Analysis{{ $qualityControl_checkbox == 'on' ? '✓' : ' ' }}</td>
                        <td class="tg-7zrl">{{ $qualityControlDefinition ?? ' ' }}</td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="5">1.3.1 Production&nbsp;&nbsp;&nbsp;Technology{{ $productionTechnology1_checkbox == 'on' ? '✓' : ' ' }}</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="5">A2&nbsp;&nbsp;&nbsp;Packaging/Labeling{{ $packagingLabeling_checkbox == 'on' ? '✓' : ' ' }}</td>
                        <td class="tg-7zrl"> {{ $packagingLabelingDefinition ?? ' ' }}</td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="5">A3 Post-harvest{{ $postHarvest_checkbox == 'on' ? '✓' : ' ' }}</td>
                        <td class="tg-7zrl">{{ $postHarvestDefinition ?? ' ' }}</td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="5">A4 Marketing&nbsp;&nbsp;&nbsp;Assistance{{ $marketAssistance_checkbox == 'on' ? '✓' : ' ' }}</td>
                        <td class="tg-7zrl">{{ $marketAssistanceDefinition ?? ' ' }} </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="5">A5 Human Resource&nbsp;&nbsp;&nbsp;Training(Please specify){{ $humanResourceTraining_checkbox == 'on' ? '✓' : ' ' }}
                        </td>
                        <td class="tg-7zrl">{{ $humanResourceTrainingDefinition ?? ' ' }}</td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="5">A6 Consultancy&nbsp;&nbsp;&nbsp;Services(Please specify){{ $consultanceServices_checkbox == 'on' ? '✓' : ' ' }}
                        </td>
                        <td class="tg-7zrl">{{ $consultanceServicesDefinition }}</td>
                    </tr>
                    <tr>
                        <td class="tg-cly1" colspan="5" rowspan="2">A7 Other&nbsp;&nbsp;&nbsp;Services (FDA
                            Permit, LGU Registration, Bar Coding){{ $otherServices_checkbox == 'on' ? '✓' : ' ' }}</td>
                        <td class="tg-7zrl">{{ $otherServicesDefinition ?? ' ' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
