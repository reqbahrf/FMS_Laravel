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
            width: 21cm;
            /* A4 width */
            height: 29.7cm;
            /* A4 height */
            margin: 0 auto;
            box-sizing: border-box;
            /* Include padding in width and height */
        }

        #ProjectProposalForm table#CompanyProfileTable,
        #ProjectProposalForm table#technicalConstraintTable,
        #ProjectProposalForm table#equipmentTable,
        #ProjectProposalForm table#budgetTable,
        #ProjectProposalForm table#refundStructureTable {
            width: 100% !important;
            border-collapse: collapse;
            border: 1px solid #000;
        }

        #ProjectProposalForm #CompanyProfileTable tr,
        #ProjectProposalForm #technicalConstraintTable tr,
        #ProjectProposalForm #equipmentTable tr,
        #ProjectProposalForm #budgetTable tr,
        #ProjectProposalForm #refundStructureTable tr {
            border: 1px solid #000;
            padding: 3px;
        }

        #ProjectProposalForm #CompanyProfileTable td,
        #ProjectProposalForm #technicalConstraintTable td,
        #ProjectProposalForm #equipmentTable td,
        #ProjectProposalForm #budgetTable td,
        #ProjectProposalForm #refundStructureTable td {
            border: 1px solid #000;
            padding: 3px;
        }
    </style>
</head>

<body>
    <x-project-proposal-form.main :isEditable=false />
</body>

</html>
