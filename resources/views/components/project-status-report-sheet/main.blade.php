@props(['projectStatusReportData', 'isEditable' => false, 'isExporting' => false])
<div id="formWrapper">
    @if (!$isExporting)
        <nav
            class="mt-3 sticky-top position-sticky"
            aria-label="breadcrumb"
        >
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
        <x-floating-window />
    @endif

    <form
        class="mt-3"
        id="projectStatusReportSheetForm"
        @if ($isEditable) action="{{ URL::signedRoute('staff.Project.set.status-report', ['projectId' => $projectStatusReportData['project_info_id'], 'applicationId' => $projectStatusReportData['application_info_id'], 'businessId' => $projectStatusReportData['business_info_id'], 'forYear' => $projectStatusReportData['for_period']]) }}" @endif
    >
        @if (!$isExporting)
            <x-document-header />
        @endif
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
            :volume-and-value-production="$projectStatusReportData['volume_and_value_production'] ?? []"
            :isEditable="$isEditable"
        />
        <x-project-status-report-sheet.new-employment-generated
            :new-employment-generated="$projectStatusReportData['newEmploymentGenerated'] ?? []"
            :isEditable="$isEditable"
        />
        <x-project-status-report-sheet.new-indirect-employment-from-the-project
            :new-indirect-employment-from-the-project="$projectStatusReportData['new_indirect_employment_from_the_project'] ?? []"
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
        <table style="width: 100%; text-align: center; margin-top: 50px;">
            <tr>
                <td style="width: 33%; text-align: center; padding: 7.5pt;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="text-align: left;">
                                Prepared by:
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; padding-top: 7pt;">
                                @if ($isEditable)
                                    <input
                                        id="prepared_by"
                                        name="prepared_by"
                                        type="text"
                                        value="{{ $formData['prepared_by'] ?? '' }}"
                                        style="width: 100%; text-align: center;"
                                        placeholder="Prepared by"
                                    >
                                @else
                                    {{ $formData['prepared_by'] ?? '' }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="border-top: 1px solid black; padding-bottom: 5px;">
                                PSTD
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width: 33%; text-align: center; padding: 7.5pt;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>

                            <td style="text-align: left;">
                                Reviewed and Endorsed by:
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;  padding-top: 7pt;">
                                @if ($isEditable)
                                    <input
                                        id="reviewed_by"
                                        name="reviewed_by"
                                        type="text"
                                        value="{{ $formData['reviewed_by'] ?? '' }}"
                                        style="width: 100%; text-align: center;"
                                        placeholder="Reviewed and Endorsed by"
                                    >
                                @else
                                    {{ $formData['reviewed_by'] ?? '' }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="border-top: 1px solid black; padding-bottom: 5px;">
                                RPMO Manager
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width: 33%; text-align: center; padding: 7.5pt;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>

                            <td style="text-align: left;">
                                Noted by:
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;  padding-top: 7pt;">
                                @if ($isEditable)
                                    <input
                                        id="noted_by"
                                        name="noted_by"
                                        type="text"
                                        value="{{ $formData['noted_by'] ?? '' }}"
                                        style="width: 100%; text-align: center;"
                                        placeholder="Noted by"
                                    >
                                @else
                                    {{ $formData['noted_by'] ?? '' }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="border-top: 1px solid black; padding-bottom: 5px;">
                                Regional Director
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

        </table>
    </form>
    @if (!$isExporting)
        <div class="position-sticky bottom-0 pb-5 mt-4 pe-none">
            <div class="container">
                @if ($isEditable)
                    <div class="d-flex justify-content-end mb-5">
                        <button
                            class="btn btn-primary pe-auto"
                            form="projectStatusReportSheetForm"
                        >Set Document Data</button>
                    </div>
                @else
                    <div class="d-flex justify-content-end">
                        <button
                            class="btn btn-primary pe-auto"
                            id="exportProjectStatusReportFormToPDF"
                            data-generated-url="{{ URL::signedRoute('staff.Project.generate.status-report-document', ['projectId' => $projectStatusReportData['project_info_id'], 'applicationId' => $projectStatusReportData['application_info_id'], 'businessId' => $projectStatusReportData['business_info_id'], 'forYear' => $projectStatusReportData['for_period']]) }}"
                            type="button"
                        >Export as PDF</button>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
