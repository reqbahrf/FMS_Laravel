@props(['projectInfoSheetData', 'isEditable' => false, 'isExporting' => true])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <meta
        http-equiv="X-UA-Compatible"
        content="ie=edge"
    >
    <title>Project Information Sheet</title>
    <style type="text/css">
        #projectInfoSheetForm {
            width: 100%;
            margin: 0 auto;
        }

        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            margin: 0px auto;
        }

        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 9pt;
            padding: 4px;
            word-break: normal;
        }

        .tg th {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 9pt;
            font-weight: normal;
            padding: 4px;
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
    </style>
</head>

<body>
    <x-project-info-sheet.main
        :projectInfoSheetData="$projectInfoSheetData"
        :isEditable="$isEditable"
        :isExporting="true"
    />
</body>

</html>
