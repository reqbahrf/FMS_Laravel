@props(['projectStatusReportData', 'isEditable' => false, 'isExporting' => false])
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
    <title>Status Report Sheet</title>
    <style type="text/css">
        #projectStatusReportSheetForm {
            width: 100%;
            min-width: 794px;
            max-width: 794px;
            margin: 0 auto;
            padding: 0.5cm;
        }

        #projectStatusReportSheetForm table {
            width: 100% !important;
            border-collapse: collapse;
            table-layout: fixed;
        }
    </style>
</head>

<body>
    <x-project-status-report-sheet.main
        :projectStatusReportData="$projectStatusReportData"
        :isEditable="$isEditable"
        :isExporting="true"
    />
</body>

</html>
