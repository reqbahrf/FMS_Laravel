@props(['projectInfoSheetData', 'isEditable', 'isExporting' => false])
<div id="formWrapper">
    @if (!$isExporting)
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a
                        class="revertToSelectDoc"
                        href="#"
                    >Select Document</a></li>
                <li
                    class="breadcrumb-item active"
                    aria-current="page"
                >Project Status Report Sheet</li>
            </ol>
        </nav>
    @endif
    <form
        class="mt-3"
        id="projectStatusReportSheetForm"
    >
        <x-project-status-report-sheet.project-info />
        <x-project-status-report-sheet.expected-and-actual />
        <x-project-status-report-sheet.equipment-and-facilities-purchased />
        <x-project-status-report-sheet.non-equipment-items />
        <x-project-status-report-sheet.status-fund-utilization />
        <x-project-status-report-sheet.status-of-refund />
        <x-project-status-report-sheet.volume-and-value-production />
        <x-project-status-report-sheet.new-employment-generated />
        <x-project-status-report-sheet.new-indirect-employment-from-the-project />
        <x-project-status-report-sheet.project-status-descriptions />
    </form>
</div>
