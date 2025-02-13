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
        size: A4;
        margin: 2cm;
    }

    #TNAForm {
        width: 21cm;
        min-height: 29.7cm;
        margin: 0 auto;
        padding: 2cm;
        background: white;
        font-size: 9pt;
    }

    #TNAForm table {
        width: 100% !important;
        margin-bottom: 15pt;
    }

    #TNAForm td {
        padding: 5pt;
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
    <x-t-n-a-form.main :TNAdata="$TNAdata"/>
</body>

</html>
