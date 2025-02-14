@props(['isEditable' => false])

<div id="ProjectProposalForm">
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
                            value="{{ $project_title ?? '' }}"
                            placeholder="(Must already be able to reflect the goal of the project)"
                        >
                    @else
                        {{ $project_title ?? '' }}
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
                            value="{{ $proponent ?? '' }}"
                            placeholder="(Indicate name and address of Firm)"
                        >
                    @else
                        {{ $proponent ?? '' }}
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
                            value="{{ $project_cost ?? '' }}"
                            placeholder="(Total project cost including counterpart of the proponent)"
                        >
                    @else
                        {{ $project_cost ?? '' }}
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
                            value="{{ $amount_requested ?? '' }}"
                            placeholder="(DOST-SETUP counterpart or amount requested from DOST-SETUP)"
                        >
                    @else
                        {{ $amount_requested ?? '' }}
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
                        >{{ $general_objectives ?? '' }}</textarea>
                    @else
                        {{ $general_objectives ?? '' }}
                    @endif
                    <p style="font-weight: bold;">Specific Objectives:</p><br>
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="specific_objectives"
                        >{{ $specific_objectives ?? '' }}</textarea>
                    @else
                        {{ $specific_objectives ?? '' }}
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
    <x-project-proposal-form.company-profile-form :isEditable="$isEditable" />
</div>
