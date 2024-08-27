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

        /* @media screen and (max-width: 767px) {
            .tg {
                width: auto !important;
            }

            .tg col {
                width: auto !important;
            }

            .tg-wrap {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                margin: auto 0px;
            }
        } */

        /* @page {
    size: A4;
  } */

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


        /* #pageSize {
            width: 794px;
            margin: auto;
            padding: 5%;

        }
        */

        @media print {
            /* body * {
      visibility: hidden;
    } */

            #pageSize,
            #pageSize * {
                visibility: visible;
            }

            #pageSize {
                position: absolute;
                left: 0;
                top: 0;
            }

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
                        <td class="tg-8d8j" colspan="5">{{ $projectData->project_title }} &nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-j6zm" colspan="5">Name of Firm:{{ $projectData->firm_name }}</td>
                        <td class="tg-7zrl"></td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="4">Owner: Contact&nbsp;&nbsp;&nbsp;Person:</td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="3">Name: {{ $projectData->f_name . ' ' . $projectData->mid_name . ' ' . $projectData->l_name }}</td>
                        <td class="tg-7zrl">Gender: {{ $projectData->gender }}</td>
                        <td class="tg-7zrl">Age: {{ \Carbon\Carbon::parse($projectData->birth_date)->age  }}</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-j6zm" colspan="5">Type of Organization Enterprize:&nbsp;&nbsp;&nbsp;</td>
                        <td class="tg-7zrl">  </td>
                    </tr>
                    <tr>
                        <td class="tg-8d8j" colspan="5"> {{ $projectData->enterprise_type }}</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-j6zm" colspan="5">Business Address:</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-8d8j" colspan="4">{{ $projectData->landMark . ', ' . $projectData->barangay . ', ' . $projectData->city . ', ' . $projectData->province . ', ' . $projectData->region }}</td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-j6zm">Contact&nbsp;&nbsp;&nbsp;Details: </td>
                        <td class="tg-7zrl">Landline: {{ $projectData->landline }}</td>
                        <td class="tg-7zrl" colspan="3">Fax: </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="2">Mobile Phone: {{ $projectData->mobile_number }}</td>
                        <td class="tg-7zrl" colspan="3">Email Address:
                            {{ $projectData->email }}
                        </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-j6zm" colspan="2">Total Assets</td>
                        <td class="tg-bobw" colspan="3"> &nbsp;&nbsp;</td>
                        <td class="tg-8d8j" rowspan="5"> <br><br><br><br></td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl">Land</td>
                        <td class="tg-8d8j" colspan="3"> &nbsp;&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl">Building </td>
                        <td class="tg-8d8j" colspan="3"> &nbsp;&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl">Equiment </td>
                        <td class="tg-8d8j" colspan="3"> &nbsp;&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl">Working Capital</td>
                        <td class="tg-8d8j" colspan="3">&nbsp;&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="tg-wa1i" colspan="2" >Total&nbsp;&nbsp;&nbsp;Employment Generated
                        </td>
                        <td class="tg-wa1i" colspan="3" >man-mouth</td>
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
                        <td class="tg-7zrl"></td>
                        <td class="tg-7zrl"></td>
                        <td class="tg-7zrl"></td>
                        <td class="tg-7zrl"></td>
                    </tr>

                    <tr>
                        <td class="tg-0lax" colspan="2"> Part-Time</td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
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
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-0lax" colspan="2"> Part-Time</td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
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
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="2">*Part-time</td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
                        <td class="tg-7zrl"> </td>
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
                        <td class="tg-8d8j" colspan="3" rowspan="2"> &nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-cly1" colspan="2" rowspan="2">*Export</td>
                        <td class="tg-8d8j" colspan="3" rowspan="2"> &nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-wa1i" colspan="2" rowspan="2">Total&nbsp;&nbsp;&nbsp;Gross Sales(P):</td>
                        <td class="tg-8d8j" colspan="3" rowspan="2"> &nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-cly1" colspan="2" rowspan="2">*Local(P)</td>
                        <td class="tg-8d8j" colspan="3" rowspan="2"> &nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-cly1" colspan="2" rowspan="2">*Export(P)</td>
                        <td class="tg-8d8j" colspan="3" rowspan="2"> &nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
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
                        <td class="tg-7zrl" colspan="5">A.1 Production&nbsp;&nbsp;&nbsp;Technology</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="5">A.1.1 Process</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="5">A.1.2 Equiment</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="5">A.1.3Quality&nbsp;&nbsp;&nbsp;Control/Laboratory
                            Testing/Analysis</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="5">1.3.1 Production&nbsp;&nbsp;&nbsp;Technology</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="5">A2&nbsp;&nbsp;&nbsp;Packaging/Labeling</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="5">A3 Post-harvest </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="5">A4 Marketing&nbsp;&nbsp;&nbsp;Assistance</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="5">A5 Human Resource&nbsp;&nbsp;&nbsp;Training(Please specify)
                        </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl" colspan="5">A6 Consultancy&nbsp;&nbsp;&nbsp;Services(Please specify)
                        </td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-cly1" colspan="5" rowspan="2">A7 Other&nbsp;&nbsp;&nbsp;Services (FDA
                            Permit, LGU Registration, Bar Coding)</td>
                        <td class="tg-7zrl"> </td>
                    </tr>
                    <tr>
                        <td class="tg-7zrl"> </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
