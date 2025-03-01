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
    <title>Document</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            font-size: 9pt;
        }

        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            margin: 0px auto;
            width: 100%;
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

        .tg td.no-border {
            border: none;
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

        .tg-8d8j {
            font-size: 9pt;
            font-family: Arial, sans-serif;
            text-align: left;
            vertical-align: bottom
        }

        #containerSize {
            width: 100%;
            margin: 0 auto;
        }

        .form-group {
            font-family: Arial, sans-serif;
            font-size: 9pt;
        }

        .main-content {
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

        .label {
            width: 10%;
            font-size: 9pt;
            font-weight: normal;
            vertical-align: top;
        }

        .input {
            font-weight: bold;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
            font-size: 9pt;
        }

        .table--headerText {
            font-weight: bold;
            font-size: 9pt;
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
            font-size: 9pt;
            margin-right: 2px;
        }
    </style>
</head>

<body>
    <x-project-data-sheet.main
        :projectDataSheetData="$projectDataSheetData"
        :isEditable="$isEditable"
        :isExporting="true"
    />
</body>

</html>
