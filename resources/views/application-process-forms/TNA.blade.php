@props(['TNAdata', 'isEditable' => false])
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title></title>
</head>
<style>
    #TNAForm {
        width: 21cm;
        height: 29.7cm;
        margin: 0 auto;
        box-sizing: border-box;
        padding: 0.5cm;
    }

    #TNAForm table#EnterpriseInformationTable,
    #TNAForm table#productionContainer,
    #TNAForm table#productionEquipmentContainer,
    #TNAForm table#productAndSupplyChainContainer {
        width: 100% !important;
        border-collapse: collapse;
        border: 1px solid #000;
    }

    #TNAForm #EnterpriseInformationTable tr,
    #TNAForm #productionContainer tr,
    #TNAForm #productionEquipmentContainer tr,
    #TNAForm #productAndSupplyChainContainer tr {
        border: 1px solid #000;
        padding: 10px;
    }

    #TNAForm #EnterpriseInformationTable td,
    #TNAForm #productionContainer td,
    #TNAForm #productionEquipmentContainer td,
    #TNAForm #productAndSupplyChainContainer td {
        border: 1px solid #000;
        padding: 10px;
    }

    #TNAForm #EnterpriseInformationTable th,
    #TNAForm #productionContainer th,
    #TNAForm #productionEquipmentContainer th,
    #TNAForm #productAndSupplyChainContainer th {
        border: 1px solid #000;
        padding: 10px;
    }

    #TNAForm p {
        margin-bottom: 8pt;
        line-height: 1.5;
    }

    #TNAForm .padding-md {
        padding: 12pt;
    }

    #TNAForm input[type="text"] {
        border: none;
        border-bottom: 1px solid #000;
        outline: none;
        padding: 5pt;
        width: 100%;
    }

    /* Convert common px values to pt */
    #TNAForm .margin-sm {
        margin: 8pt;
    }

    #TNAForm .padding-sm {
        padding: 8pt;
    }

    #TNAForm .margin-md {
        margin: 12pt;
    }

    #TNAForm .padding-md {
        padding: 12pt;
    }

    .custom--justify {
        text-align: justify;
        white-space: normal;
        text-decoration: underline;
        text-underline-offset: 2px;
        /* Optional: makes underline more readable */
    }
</style>

<body>
    <x-t-n-a-form.main
        :TNAdata="$TNAdata"
        :isEditable="$isEditable"
        :isExporting="true"
    />
</body>

</html>
