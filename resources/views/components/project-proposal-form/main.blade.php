@props(['ProjectProposaldata', 'isEditable', 'isExporting' => false])

<form
    id="ProjectProposalForm"
    @if ($isEditable) action="{{ URL::signedRoute('staff.Applicant.set.project-proposal', ['business_id' => $ProjectProposaldata['business_id'], 'application_id' => $ProjectProposaldata['application_id']]) }}" @endif
>
    @if (!$isExporting)
        <x-document-header />
    @endif
    @csrf
    <div class="center">
        <table
            id="TopProposalTable"
            style="border-collapse: collapse;"
            width="100%"
            cellpadding="5"
        >
            <tr>
                <td
                    style="text-align: center; font-weight: bold; font-size: larger;"
                    colspan="9"
                >PROJECT PROPOSAL</td>
            </tr>
            <tr>
                <td class="font-bold label-width">PROJECT TITLE:</td>
                <td colspan="8">
                    @if ($isEditable)
                        <input
                            name="project_title"
                            type="text"
                            value="{{ $ProjectProposaldata['project_title'] ?? '' }}"
                            placeholder="(Must already be able to reflect the goal of the project)"
                        >
                    @else
                        {{ $ProjectProposaldata['project_title'] ?? '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="font-bold label-width">PROPONENT:</td>
                <td colspan="8">
                    @if ($isEditable)
                        <input
                            name="proponent"
                            type="text"
                            value="{{ $ProjectProposaldata['proponent'] ?? '' }}"
                            placeholder="(Indicate name and address of Firm)"
                        >
                    @else
                        {{ $ProjectProposaldata['proponent'] ?? '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="font-bold label-width">PROJECT COST:</td>
                <td colspan="8">
                    @if ($isEditable)
                        <input
                            name="project_cost"
                            data-custom-numeric-input
                            type="text"
                            value="{{ $ProjectProposaldata['project_cost'] ?? '' }}"
                            placeholder="(Total project cost including counterpart of the proponent)"
                        >
                    @else
                        {{ $ProjectProposaldata['project_cost'] ?? '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="font-bold label-width">AMOUNT REQUESTED:</td>
                <td colspan="8">
                    @if ($isEditable)
                        <input
                            id="amount_requested"
                            name="amount_requested"
                            data-custom-numeric-input
                            type="text"
                            value="{{ $ProjectProposaldata['amount_requested'] ?? '' }}"
                            placeholder="(DOST-SETUP counterpart or amount requested from DOST-SETUP)"
                        >
                    @else
                        {{ $ProjectProposaldata['amount_requested'] ?? '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td
                    style="font-weight: bold;"
                    colspan="9"
                >OBJECTIVES:</td>
            </tr>
            <tr>
                <td colspan="1"></td>
                <td colspan="8">
                    <p style="font-weight: bold;">General Objectives:</p>
                    <x-custom-input.list-text-formatter
                        name="general_objectives"
                        :is-editable="$isEditable"
                        :text="$ProjectProposaldata['general_objectives'] ?? ''"
                    />
                    <p style="font-weight: bold;">Specific Objectives:</p>
                    <x-custom-input.list-text-formatter
                        name="specific_objectives"
                        :is-editable="$isEditable"
                        :text="$ProjectProposaldata['specific_objectives'] ?? ''"
                    />
                </td>
            </tr>
            <tr>
                <td
                    style="font-weight: bold;"
                    colspan="9"
                >PROJECT BACKGROUND:</td>
            </tr>
            <tr>
                <td
                    style="font-weight: bold;"
                    colspan="9"
                >A. Company Profile</td>
            </tr>
        </table>
    </div>
    <x-project-proposal-form.company-profile-form
        :isEditable="$isEditable"
        :ProjectProposaldata="$ProjectProposaldata"
    />
</form>
@if (!$isExporting)
    @if ($isEditable && auth()->user()->role === 'Staff')
        <div class="d-flex justify-content-end">
            <select
                class="form-select w-25"
                name="project_proposal_doc_status"
                form="ProjectProposalForm"
            >
                <option
                    value="pending"
                    selected
                >Pending</option>
                <option value="reviewed">Reviewed</option>
            </select>
            <button
                class="btn btn-primary ms-2"
                form="ProjectProposalForm"
                type="submit"
            >Set Project Proposal</button>
        </div>
    @elseif (auth()->user()->role === 'Staff')
        <div class="d-flex justify-content-end">
            <button
                class="btn btn-primary text-end"
                id="exportProjectProposalFormToPDF"
                data-generated-url="{{ URL::signedRoute('staff.Applicant.generate.project-proposal', ['business_id' => $ProjectProposaldata['business_id'], 'application_id' => $ProjectProposaldata['application_id']]) }}"
                type="button"
            >Export as PDF</button>
        </div>
    @endif
@endif
