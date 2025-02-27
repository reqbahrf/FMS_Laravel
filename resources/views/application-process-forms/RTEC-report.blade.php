@props(['RTECReportdata', 'isEditable' => false])
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
    <style>
        #RTECReportForm {
            width: 100%;
            max-width: 794px;
        }

        #RTECReportForm table#complianceOfRequirementTable,
        #RTECReportForm table#processExistingPracticeProblemTable,
        #RTECReportForm table#equipmentTable {
            width: 100% !important;
            border-collapse: collapse;
            border: 1px solid #000;
        }

        #RTECReportForm table#complianceOfRequirementTable th,
        #RTECReportForm table#processExistingPracticeProblemTable th,
        #RTECReportForm table#equipmentTable th {
            border: 1px solid #000;
            padding: 10px;
        }

        #RTECReportForm table#complianceOfRequirementTable td,
        #RTECReportForm table#processExistingPracticeProblemTable td,
        #RTECReportForm table#equipmentTable td {
            border: 1px solid #000;
            padding: 10px;
        }

        #RTECReportForm table:is(#complianceOfRequirementTable, #processExistingPracticeProblemTable, #equipmentTable) tr {
            border: 1px solid #000;
            padding: 10px;
        }
    </style>
</head>

<body>
    <x-rtec-report-form.main
        :RTECReportdata="$RTECReportdata"
        :isEditable="$isEditable"
        :isExporting="true"
    />
</body>

</html>
