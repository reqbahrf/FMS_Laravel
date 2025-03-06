@props(['statusReportData', 'isEditable' => false, 'isExporting' => false])
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
        body {
            width: 100%;
            max-width: 794px;
            margin: 0 auto;
            line-height: 1.5;
            padding-bottom: 20px;
            font-family: Arial, sans-serif;
            font-size: 9pt;
        }

        p {
            line-height: 115%;
            text-align: left;
            orphans: 2;
            widows: 2;
            margin-bottom: 0.25cm;
            direction: ltr;
            background: transparent;
            font-size: 9pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            page-break-inside: avoid;
            margin: 0 auto;
        }

        td,
        th {
            padding: 4px;
            font-family: Arial, sans-serif;
            font-size: 9pt;
        }

        .content-table td,
        .content-table th {
            border: 1px solid #000000;
        }

        /* Override any inline font sizes */
        font[size="2"],
        font[size="3"] {
            font-size: 9pt !important;
        }

        .tg-wrap {
            width: 100%;
            margin: 0 auto;
        }

        /* Ensure consistent font sizes for specific classes */
        .font-normal,
        .tg-cly1,
        .tg-8d8j,
        .tg-nrix,
        .tg-0lax,
        .tg-yla0 {
            font-size: 9pt;
            font-family: Arial, sans-serif;
        }

        /* Remove fixed widths from table cells */
        table[autosize="1"] td {
            width: auto;
        }

        /* Adjust form container */
        .form-container {
            width: 100%;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            font-size: 9pt;
        }

        /* Consistent styling for labels and inputs */
        .label,
        .input,
        .contact-label {
            font-size: 9pt;
            font-family: Arial, sans-serif;
        }
    </style>
</head>

<body>
    <x-status-report-sheet.main
        :statusReportSheetData="$statusReportSheetData"
        :isEditable="$isEditable"
        :isExporting="true"
    />
</body>

</html>
