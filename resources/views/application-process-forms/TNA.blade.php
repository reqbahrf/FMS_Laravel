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
        /* A4 width */
        height: 29.7cm;
        /* A4 height */
        margin: 0 auto;
        box-sizing: border-box;
        /* Include padding in width and height */
    }

    #TNAForm table#EnterpriseInformationTable,
    #TNAForm table#productionTable,
    #TNAForm table#productionEquipmentTable,
    #TNAForm table#rawMaterialTable {
        width: 100% !important;
        border-collapse: collapse;
        border: 1px solid #000;
    }

    #TNAForm #EnterpriseInformationTable tr,
    #TNAForm #productionTable tr,
    #TNAForm #productionEquipmentTable tr,
    #TNAForm #rawMaterialTable tr {
        border: 1px solid #000;
        padding: 10px;
    }

    #TNAForm #EnterpriseInformationTable td,
    #TNAForm #productionTable td,
    #TNAForm #productionEquipmentTable td,
    #TNAForm #rawMaterialTable td {
        border: 1px solid #000;
        padding: 10px;
    }

    #TNAForm #EnterpriseInformationTable th,
    #TNAForm #productionTable th,
    #TNAForm #productionEquipmentTable th,
    #TNAForm #rawMaterialTable th {
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
</style>

<body>
    <x-t-n-a-form.main :TNAdata="$TNAdata" />
</body>

</html>
