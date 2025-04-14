@props(['ProjectProposaldata', 'isEditable' => false])
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
        #ProjectProposalForm {
            /* A4 width */
            height: 29.7cm;
            /* A4 height */
            margin: 0 auto;
            box-sizing: border-box;
            /* Include padding in width and height */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        #ProjectProposalForm table#CompanyProfileTable,
        #ProjectProposalForm table#technicalConstraintTable,
        #ProjectProposalForm table#equipmentTable,
        #ProjectProposalForm table#budgetTable,
        #ProjectProposalForm table#refundStructureTable,
        #ProjectProposalForm table#riskTable {
            border: 1px solid #000;
        }

        .section--title {
            font-weight: bolder;
        }

        .section--sub--title {
            font-weight: bold;
            padding-left: 10pt;
        }

        #ProjectProposalForm #CompanyProfileTable tr:not(:first-child),
        #ProjectProposalForm #technicalConstraintTable tr:not(:first-child),
        #ProjectProposalForm #equipmentTable tr:not(:first-child),
        #ProjectProposalForm #budgetTable tr:not(:first-child),
        #ProjectProposalForm #refundStructureTable tr:not(:first-child),
        #ProjectProposalForm #riskTable tr:not(:first-child) {
            border: 1px solid #000;
            padding: 3px;
        }

        #ProjectProposalForm #CompanyProfileTable td,
        #ProjectProposalForm #technicalConstraintTable td,
        #ProjectProposalForm #equipmentTable td,
        #ProjectProposalForm #budgetTable td,
        #ProjectProposalForm #refundStructureTable td,
        #ProjectProposalForm #riskTable td {
            border: 1px solid #000;
            padding: 3px;
        }

        .no-border,
        .no-border td,
        .no-border tr,
        table.no-border,
        table.no-border tr,
        table.no-border td {
            border: none !important;
            border-width: 0 !important;
            border-collapse: collapse !important;
        }

        table.no-border {
            border-collapse: separate !important;
            border-spacing: 0 !important;
        }

        #ProjectProposalForm table {
            width: 100% !important;
            margin-bottom: 15pt;
        }

        #ProjectProposalForm td {
            padding: 5pt;
        }

        #ProjectProposalForm p {
            margin-bottom: 8pt;
            line-height: 1.5;
        }

        #ProjectProposalForm .padding-md {
            padding: 12pt;
        }

        /* Convert common px values to pt */
        #ProjectProposalForm .margin-sm {
            margin: 8pt;
        }

        #ProjectProposalForm .padding-sm {
            padding: 8pt;
        }

        #ProjectProposalForm .margin-md {
            margin: 12pt;
        }

        #ProjectProposalForm .padding-md {
            padding: 12pt;
        }
    </style>
</head>

<body>
    <x-project-proposal-form.main
        :ProjectProposaldata="$ProjectProposaldata"
        :isEditable="$isEditable"
        :isExporting="true"
    />
</body>

</html>
