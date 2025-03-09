@props(['projectStatusReportData', 'isEditable' => false, 'isExporting' => false])
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
        <x-project-status-report-sheet.project-info
            :projectStatusReportData="$projectStatusReportData"
            :isEditable="$isEditable"
        />
        <x-project-status-report-sheet.expected-and-actual
            :projectStatusReportData="$projectStatusReportData"
            :isEditable="$isEditable"
        />
        <x-project-status-report-sheet.equipment-and-facilities-purchased
            :projectStatusReportData="$projectStatusReportData"
            :isEditable="$isEditable"
        />
        <x-project-status-report-sheet.non-equipment-items
            :projectStatusReportData="$projectStatusReportData"
            :isEditable="$isEditable"
        />
        <x-project-status-report-sheet.status-fund-utilization
            :projectStatusReportData="$projectStatusReportData"
            :isEditable="$isEditable"
        />
        <x-project-status-report-sheet.status-of-refund
            :projectStatusReportData="$projectStatusReportData"
            :isEditable="$isEditable"
        />
        <x-project-status-report-sheet.volume-and-value-production
            :projectStatusReportData="$projectStatusReportData"
            :isEditable="$isEditable"
        />
        <x-project-status-report-sheet.new-employment-generated
            :projectStatusReportData="$projectStatusReportData"
            :isEditable="$isEditable"
        />
        <x-project-status-report-sheet.new-indirect-employment-from-the-project
            :projectStatusReportData="$projectStatusReportData"
            :isEditable="$isEditable"
        />
        <x-project-status-report-sheet.list-of-market-penetrated
            :projectStatusReportData="$projectStatusReportData"
            :isEditable="$isEditable"
        />
        <x-project-status-report-sheet.project-status-descriptions
            :projectStatusReportData="$projectStatusReportData"
            :isEditable="$isEditable"
        />
    </form>
</div>
