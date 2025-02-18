@props(['ProjectProposaldata', 'isEditable'])

<form
    id="ProjectProposalForm"
    @if ($isEditable)
    action="{{ route('staff.Applicant.set.project-proposal', ['business_id' => $ProjectProposaldata['business_id'], 'application_id' => $ProjectProposaldata['application_id']]) }}"
    @endif
>
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
                            name="amount_requested"
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
                    <p style="font-weight: bold;">General Objectives:</p><br>
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="general_objectives"
                        >{{ $ProjectProposaldata['general_objectives'] ?? '' }}</textarea>
                    @else
                        {{ $ProjectProposaldata['general_objectives'] ?? '' }}
                    @endif
                    <p style="font-weight: bold;">Specific Objectives:</p><br>
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="specific_objectives"
                        >{{ $ProjectProposaldata['specific_objectives'] ?? '' }}</textarea>
                    @else
                        {{ $ProjectProposaldata['specific_objectives'] ?? '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td
                    style="font-weight: bold;"
                    colspan="9"
                >PROJECT BACKGROUND:</td>
            </tr>
        </table>
    </div>
    <x-project-proposal-form.company-profile-form :isEditable="$isEditable" :ProjectProposaldata="$ProjectProposaldata" />
</form>
@if($isEditable)
  <button class="btn btn-primary ms-auto" type="submit" form="ProjectProposalForm">SET</button>
@else
<div class="d-flex justify-content-end">
    <button
        type="button"
        data-generated-url="{{ URL::signedRoute('staff.Applicant.generate.project-proposal', ['business_id' => $ProjectProposaldata['business_id'], 'application_id' => $ProjectProposaldata['application_id']]) }}"
        id="exportProjectProposalFormToPDF"
        class="btn btn-primary text-end"
    >Export as PDF</button>
</div>
@endif
