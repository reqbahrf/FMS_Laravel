@props(['RTECReportdata', 'isEditable', 'isExporting' => false])
<form
    id="RTECReportForm"
    @if ($isEditable) action="{{ URL::signedRoute('staff.Applicant.set.rtec-report', ['business_id' => $RTECReportdata['business_id'], 'application_id' => $RTECReportdata['application_id']]) }}" @endif
>
    @if (!$isExporting)
        <x-document-header />
    @endif
    <table
        id="RTECReportInfoTable"
        width="100%"
    >
        <tr>
            <td
                style="text-align: center; font-weight: bold; font-size: larger;"
                colspan="2"
            >RTEC REPORT</td>
        </tr>
        <tr>
            <td style="width: 20%;">Project Title:</td>
            <td style="width: 80%;">
                @if ($isEditable)
                    <input
                        name="project_title"
                        type="text"
                        value="{{ $RTECReportdata['project_title'] ?? '' }}"
                    >
                @else
                    {{ $RTECReportdata['project_title'] ?? '' }}
                @endif
            </td>
        </tr>
        <tr>
            <td>Proponent:</td>
            <td>
                @if ($isEditable)
                    <input
                        name="proponent"
                        type="text"
                        value="{{ $RTECReportdata['proponent'] ?? '' }}"
                    >
                @else
                    {{ $RTECReportdata['proponent'] ?? '' }}
                @endif
            </td>
        </tr>
        <tr>
            <td>Contact Person:</td>
            <td>
                @if ($isEditable)
                    <input
                        name="contact_person"
                        type="text"
                        value="{{ $RTECReportdata['contact_person'] ?? '' }}"
                    >
                @else
                    {{ $RTECReportdata['contact_person'] ?? '' }}
                @endif
            </td>
            </td>
        </tr>
        <tr>
            <td
                style="text-align: top; vertical-align: top;"
                rowspan="5"
            >Project Cost:</td>
            <td>
                <span id="project_cost"></span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span style="width: 100%;">
                    <p style="width: 100px; display: inline-block;">Proponent:&nbsp;</p>
                    @if ($isEditable)
                        <input
                            name="proponent_cost"
                            data-custom-numeric-input
                            type="text"
                            value="{{ $RTECReportdata['proponent_cost'] ?? '' }}"
                            style="display: inline-block; width: 100px;"
                        >
                    @else
                        {{ $RTECReportdata['proponent_cost'] ?? '' }}
                    @endif
                </span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span style="width: 100%;">
                    <p style="width: 100px; display: inline-block;">DOST-SETUP:&nbsp;</p>
                    @if ($isEditable)
                        <input
                            name="dost_setup_cost"
                            data-custom-numeric-input
                            type="text"
                            value="{{ $RTECReportdata['dost_setup_cost'] ?? '' }}"
                            style="display: inline-block; width: 100px;"
                        >
                    @else
                        {{ $RTECReportdata['dost_setup_cost'] ?? '' }}
                    @endif
                </span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span style="width: 100%;">
                    <p style="width: 100px; display: inline-block;">DOST-LGIA:&nbsp;</p>
                    @if ($isEditable)
                        <input
                            name="dost_lgia_cost"
                            data-custom-numeric-input
                            type="text"
                            value="{{ $RTECReportdata['dost_lgia_cost'] ?? '' }}"
                            style="display: inline-block; width: 100px;"
                        >
                    @else
                        {{ $RTECReportdata['dost_lgia_cost'] ?? '' }}
                    @endif
                </span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span style="width: 100%;">
                    <p style="width: 100px; display: inline-block;">Total:&nbsp;</p>
                    @if ($isEditable)
                        <input
                            name="total_cost"
                            data-custom-numeric-input
                            type="text"
                            value="{{ $RTECReportdata['total_cost'] ?? '' }}"
                            style="display: inline-block; width: 100px;"
                        >
                    @else
                        {{ $RTECReportdata['total_cost'] ?? '' }}
                    @endif
                </span>
            </td>
        </tr>
    </table>
    <table
        id="additionInfoTable"
        style="width: 100%;"
    >
        <tbody>
            <tr>
                <th
                    style="text-align: left;"
                    colspan="2"
                >I. Brief description of the project</th>
            </tr>
            <tr>
                <td style="vertical-align: top;">a.</td>
                <td>Company Profile</td>
            </tr>
            <tr>
                <td colspan="2">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="company_profile"
                        >{{ $RTECReportdata['company_profile'] ?? '' }}</textarea>
                    @else
                        {{ $RTECReportdata['company_profile'] ?? '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">b.</td>
                <td>Objectives</td>
            </tr>
            <tr>
                <td colspan="2">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="objectives"
                        >{{ $RTECReportdata['objectives'] ?? '' }}</textarea>
                    @else
                        {{ $RTECReportdata['objectives'] ?? '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">c.</td>
                <td>Expected Outputs/Impact/s of S&T intervention</td>
            </tr>
            <tr>
                <td colspan="2">
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="expected_outputs"
                        >{{ $RTECReportdata['expected_outputs'] ?? '' }}</textarea>
                    @else
                        {{ $RTECReportdata['expected_outputs'] ?? '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <th
                    style="text-align: left;"
                    colspan="2"
                >II. Compliance of Requirements</th>
            </tr>
        </tbody>
    </table>
    <table id="complianceOfRequirementTable">
        <tbody>
            <tr>
                <td style="text-align: center;">Requirements</td>
                <td>Complied</td>
                <td>Not Complied</th>
            </tr>
            <tr>
                <td>Letter of intent to avail of SETUP assistance, stating commitment to refund the iFund support and
                    cover the insurance cost for the equipment</td>
                <td>
                    @if ($isEditable)
                        <input
                            name="Letter_of_intent"
                            type="radio"
                            value="complied"
                            @checked(($RTECReportdata['Letter_of_intent'] ?? '') === 'complied')
                        >
                    @else
                        {{ ($RTECReportdata['Letter_of_intent'] ?? '') === 'complied' ? '/' : '' }}
                    @endif
                </td>
                <td>
                    @if ($isEditable)
                        <input
                            name="Letter_of_intent"
                            type="radio"
                            value="not_complied"
                            @checked(($RTECReportdata['Letter_of_intent'] ?? '') === 'not_complied')
                        >
                    @else
                        {{ ($RTECReportdata['Letter_of_intent'] ?? '') === 'not_complied' ? '/' : '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Accomplished DOST TNA Form 01 (Application for Technology Needs Assessment)</td>
                <td>
                    @if ($isEditable)
                        <input
                            name="TNA_form1"
                            type="radio"
                            value="complied"
                            @checked(($RTECReportdata['TNA_form1'] ?? '') === 'complied')
                        >
                    @else
                        {{ ($RTECReportdata['TNA_form1'] ?? '') === 'complied' ? '/' : '' }}
                    @endif
                </td>
                <td>
                    @if ($isEditable)
                        <input
                            name="TNA_form1"
                            type="radio"
                            value="not_complied"
                            @checked(($RTECReportdata['TNA_form1'] ?? '') === 'not_complied')
                        >
                    @else
                        {{ ($RTECReportdata['TNA_form1'] ?? '') === 'not_complied' ? '/' : '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Accomplished DOST TNA Form 02 (Technology Needs Assessment Report)</td>
                <td>
                    @if ($isEditable)
                        <input
                            name="TNA_form2"
                            type="radio"
                            value="complied"
                            @checked(($RTECReportdata['TNA_form2'] ?? '') === 'complied')
                        >
                    @else
                        {{ ($RTECReportdata['TNA_form2'] ?? '') === 'complied' ? '/' : '' }}
                    @endif
                </td>
                <td>
                    @if ($isEditable)
                        <input
                            name="TNA_form2"
                            type="radio"
                            value="not_complied"
                            @checked(($RTECReportdata['TNA_form2'] ?? '') === 'not_complied')
                        >
                    @else
                        {{ ($RTECReportdata['TNA_form2'] ?? '') === 'not_complied' ? '/' : '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Proposal following SETUP Form 001 (Project Proposal Format)</td>
                <td>
                    @if ($isEditable)
                        <input
                            name="SETUP_form1"
                            type="radio"
                            value="complied"
                            @checked(($RTECReportdata['SETUP_form1'] ?? '') === 'complied')
                        >
                    @else
                        {{ ($RTECReportdata['SETUP_form1'] ?? '') === 'complied' ? '/' : '' }}
                    @endif
                </td>
                <td>
                    @if ($isEditable)
                        <input
                            name="SETUP_form1"
                            type="radio"
                            value="not_complied"
                            @checked(($RTECReportdata['SETUP_form1'] ?? '') === 'not_complied')
                        >
                    @else
                        {{ ($RTECReportdata['SETUP_form1'] ?? '') === 'not_complied' ? '/' : '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Copy of business permits and licenses issued by LGUs and other appropriate government agencies</td>
                <td>
                    @if ($isEditable)
                        <input
                            name="business_permits"
                            type="radio"
                            value="complied"
                            @checked(($RTECReportdata['business_permits'] ?? '') === 'complied')
                        >
                    @else
                        {{ ($RTECReportdata['business_permits'] ?? '') === 'complied' ? '/' : '' }}
                    @endif
                </td>
                <td>
                    @if ($isEditable)
                        <input
                            name="business_permits"
                            type="radio"
                            value="not_complied"
                            @checked(($RTECReportdata['business_permits'] ?? '') === 'not_complied')
                        >
                    @else
                        {{ ($RTECReportdata['business_permits'] ?? '') === 'not_complied' ? '/' : '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Financial statements for the past three (3) years for small and medium enterprises and at least one
                    (1) year for micro enterprises together with notarized Sworn Statement that all information provided
                    are true and correct</td>
                <td>
                    @if ($isEditable)
                        <input
                            name="financial_statements_past_3"
                            type="radio"
                            value="complied"
                            @checked(($RTECReportdata['financial_statements_past_3'] ?? '') === 'complied')
                        >
                    @else
                        {{ ($RTECReportdata['financial_statements_past_3'] ?? '') === 'complied' ? '/' : '' }}
                    @endif
                </td>
                <td>
                    @if ($isEditable)
                        <input
                            name="financial_statements_past_3"
                            type="radio"
                            value="not_complied"
                            @checked(($RTECReportdata['financial_statements_past_3'] ?? '') === 'not_complied')
                        >
                    @else
                        {{ ($RTECReportdata['financial_statements_past_3'] ?? '') === 'not_complied' ? '/' : '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Projected financial statements</td>
                <td>
                    @if ($isEditable)
                        <input
                            name="projected_financial_statements"
                            type="radio"
                            value="complied"
                            @checked(($RTECReportdata['projected_financial_statements'] ?? '') === 'complied')
                        >
                    @else
                        {{ ($RTECReportdata['projected_financial_statements'] ?? '') === 'complied' ? '/' : '' }}
                    @endif
                </td>
                <td>
                    @if ($isEditable)
                        <input
                            name="projected_financial_statements"
                            type="radio"
                            value="not_complied"
                            @checked(($RTECReportdata['projected_financial_statements'] ?? '') === 'not_complied')
                        >
                    @else
                        {{ ($RTECReportdata['projected_financial_statements'] ?? '') === 'not_complied' ? '/' : '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Photocopy of Official Receipt</td>
                <td>
                    @if ($isEditable)
                        <input
                            name="official_receipt"
                            type="radio"
                            value="complied"
                            @checked(($RTECReportdata['official_receipt'] ?? '') === 'complied')
                        >
                    @else
                        {{ ($RTECReportdata['official_receipt'] ?? '') === 'complied' ? '/' : '' }}
                    @endif
                </td>
                <td>
                    @if ($isEditable)
                        <input
                            name="official_receipt"
                            type="radio"
                            value="not_complied"
                            @checked(($RTECReportdata['official_receipt'] ?? '') === 'not_complied')
                        >
                    @else
                        {{ ($RTECReportdata['official_receipt'] ?? '') === 'not_complied' ? '/' : '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Certificate of registration of business name with the Department of Trade and Industry (DTI),
                    Securities and Exchange Commission (SEC), or Cooperative Development Authority (CDA), whichever is
                    applicable</td>
                <td>
                    @if ($isEditable)
                        <input
                            name="certificate_of_registration"
                            type="radio"
                            value="complied"
                            @checked(($RTECReportdata['certificate_of_registration'] ?? '') === 'complied')
                        >
                    @else
                        {{ ($RTECReportdata['certificate_of_registration'] ?? '') === 'complied' ? '/' : '' }}
                    @endif
                </td>
                <td>
                    @if ($isEditable)
                        <input
                            name="certificate_of_registration"
                            type="radio"
                            value="not_complied"
                            @checked(($RTECReportdata['certificate_of_registration'] ?? '') === 'not_complied')
                        >
                    @else
                        {{ ($RTECReportdata['certificate_of_registration'] ?? '') === 'not_complied' ? '/' : '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Copy of Articles of Incorporation for cooperatives and associations</td>
                <td>
                    @if ($isEditable)
                        <input
                            name="copy_articles_of_incorporation"
                            type="radio"
                            value="complied"
                            @checked(($RTECReportdata['copy_articles_of_incorporation'] ?? '') === 'complied')
                        >
                    @else
                        {{ ($RTECReportdata['copy_articles_of_incorporation'] ?? '') === 'complied' ? '/' : '' }}
                    @endif
                </td>
                <td>
                    @if ($isEditable)
                        <input
                            name="copy_articles_of_incorporation"
                            type="radio"
                            value="not_complied"
                            @checked(($RTECReportdata['copy_articles_of_incorporation'] ?? '') === 'not_complied')
                        >
                    @else
                        {{ ($RTECReportdata['copy_articles_of_incorporation'] ?? '') === 'not_complied' ? '/' : '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Sworn affidavit of no relation up to third degree of consanguinity and affinity to the approving
                    authority and no bad debt</td>
                <td>
                    @if ($isEditable)
                        <input
                            name="sworn_affidavit"
                            type="radio"
                            value="complied"
                            @checked(($RTECReportdata['sworn_affidavit'] ?? '') === 'complied')
                        >
                    @else
                        {{ ($RTECReportdata['sworn_affidavit'] ?? '') === 'complied' ? '/' : '' }}
                    @endif
                </td>
                <td>
                    @if ($isEditable)
                        <input
                            name="sworn_affidavit"
                            type="radio"
                            value="not_complied"
                            @checked(($RTECReportdata['sworn_affidavit'] ?? '') === 'not_complied')
                        >
                    @else
                        {{ ($RTECReportdata['sworn_affidavit'] ?? '') === 'not_complied' ? '/' : '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>In the case of cooperatives and non-single proprietorship, LGUs, organization, Board/Legislative
                    Council resolution authorizing the availment of the assistance and designating authorized signatory
                    for the financial assistance</td>
                <td>
                    @if ($isEditable)
                        <input
                            name="in_the_case_of_cooperative"
                            type="radio"
                            value="complied"
                            @checked(($RTECReportdata['in_the_case_of_cooperative'] ?? '') === 'complied')
                        >
                    @else
                        {{ ($RTECReportdata['in_the_case_of_cooperative'] ?? '') === 'complied' ? '/' : '' }}
                    @endif
                </td>
                <td>
                    @if ($isEditable)
                        <input
                            name="in_the_case_of_cooperative"
                            type="radio"
                            value="not_complied"
                            @checked(($RTECReportdata['in_the_case_of_cooperative'] ?? '') === 'not_complied')
                        >
                    @else
                        {{ ($RTECReportdata['in_the_case_of_cooperative'] ?? '') === 'not_complied' ? '/' : '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Three (3) quotations for each equipment from suppliers/fabricators of the equipment to be
                    purchased/fabricated</td>
                <td>
                    @if ($isEditable)
                        <input
                            name="three_quotations"
                            type="radio"
                            value="complied"
                            @checked(($RTECReportdata['three_quotations'] ?? '') === 'complied')
                        >
                    @else
                        {{ ($RTECReportdata['three_quotations'] ?? '') === 'complied' ? '/' : '' }}
                    @endif
                </td>
                <td>
                    @if ($isEditable)
                        <input
                            name="three_quotations"
                            type="radio"
                            value="not_complied"
                            @checked(($RTECReportdata['three_quotations'] ?? '') === 'not_complied')
                        >
                    @else
                        {{ ($RTECReportdata['three_quotations'] ?? '') === 'not_complied' ? '/' : '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Complete technical design/drawing of all equipment to be purchased/fabricated</td>
                <td>
                    @if ($isEditable)
                        <input
                            name="complete_technical_design"
                            type="radio"
                            value="complied"
                            @checked(($RTECReportdata['complete_technical_design'] ?? '') === 'complied')
                        >
                    @else
                        {{ ($RTECReportdata['complete_technical_design'] ?? '') === 'complied' ? '/' : '' }}
                    @endif
                </td>
                <td>
                    @if ($isEditable)
                        <input
                            name="complete_technical_design"
                            type="radio"
                            value="not_complied"
                            @checked(($RTECReportdata['complete_technical_design'] ?? '') === 'not_complied')
                        >
                    @else
                        {{ ($RTECReportdata['complete_technical_design'] ?? '') === 'not_complied' ? '/' : '' }}
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
            <tr>
                <th
                    style="text-align: left;"
                    colspan="4"
                >III. Highlights of Evaluation</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="vertical-align: top;"></td>
                <td colspan="3">a.Management/Administrative Aspect
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="management_administrative_aspect"
                        >{{ $RTECReportdata['management_administrative_aspect'] ?? '' }}</textarea>
                    @else
                        {{ $RTECReportdata['management_administrative_aspect'] ?? '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;"></td>
                <td colspan="3">b. Technical Aspect (including the recommended DOST S&T Intervention)
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="technical_aspect"
                        >{{ $RTECReportdata['technical_aspect'] ?? '' }}</textarea>
                    @else
                        {{ $RTECReportdata['technical_aspect'] ?? '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-left: 20px;vertical-align: baseline;">1. </td>
                <td colspan="2">Production Process
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-left: 40px;"></td>
                <td colspan="2">a. Process Flow of Production
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="process_flow_of_production"
                        >{{ $RTECReportdata['process_flow_of_production'] ?? '' }}</textarea>
                    @else
                        {{ $RTECReportdata['process_flow_of_production'] ?? '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-left: 20px;vertical-align: baseline;"></td>
                <td colspan="2">b.Material Balance
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="material_balance"
                        >{{ $RTECReportdata['material_balance'] ?? '' }}</textarea>
                    @else
                        {{ $RTECReportdata['material_balance'] ?? '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-left: 20px;vertical-align: baseline;">2.</td>
                <td colspan="2"> Existing Production Equipment
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="existing_production_equipment"
                        >{{ $RTECReportdata['existing_production_equipment'] ?? '' }}</textarea>
                    @else
                        {{ $RTECReportdata['existing_production_equipment'] ?? '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-left: 20px;vertical-align: baseline;">3. </td>
                <td colspan="2">Technical constraints on the production line and proposed S&T Intervention
                    @if ($isEditable)
                        <textarea
                            class="form-control"
                            name="technical_constraints_on_the_production_line_and_proposed_s_t_intervention"
                        >{{ $RTECReportdata['technical_constraints_on_the_production_line_and_proposed_s_t_intervention'] ?? '' }}</textarea>
                    @else
                        {{ $RTECReportdata['technical_constraints_on_the_production_line_and_proposed_s_t_intervention'] ?? '' }}
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <div id="processExistingPractiveProblemTableContainer">
        @if ($isEditable)
            <div
                class="mb-3"
                style="text-align: right;"
            >
                <button
                    class="btn btn-sm btn-success"
                    id="addProcessExistingPractiveProblemTableRow"
                    type="button"
                ><i class="ri-add-line"></i></button>
                <button
                    class="btn btn-sm btn-danger"
                    id="removeProcessExistingPractiveProblemTableRow"
                    data-remove-row-btn
                    type="button"
                ><i class="ri-subtract-line"></i></button>
            </div>
        @endif
        <table
            id="processExistingPracticeProblemTable"
            style="width: 100%;"
        >
            <thead>
                <tr>
                    <td style="text-align: center; width: 25%">Process/Existing Practice/Problem</td>
                    <td style="text-align: center; width: 25%">Proposed S&T Intervention</td>
                    <td style="text-align: center; width: 25%">Proposed S&T intervention-related equipment/skills
                        upgrading
                    </td>
                    <td style="text-align: center; width: 25%">Impact</td>
                </tr>
            </thead>
            <tbody>
                @forelse($RTECReportdata['processExistingPracticeProblem'] ?? [] as $data)
                    <tr>
                        <td>
                            @if ($isEditable)
                                <textarea class="form-control Process_Existing_PracticeProblem">{{ $data['processExistingPracticeProblem'] ?? '' }}</textarea>
                            @else
                                {{ $data['processExistingPracticeProblem'] ?? '' }}
                            @endif
                        </td>
                        <td>
                            @if ($isEditable)
                                <textarea class="form-control ProposedS_TIntervention">{{ $data['proposedSTIntervention'] ?? '' }}</textarea>
                            @else
                                {{ $data['proposedSTIntervention'] ?? '' }}
                            @endif
                        </td>
                        <td>
                            @if ($isEditable)
                                <textarea class="form-control ProposedS_TInterventionRelatedEquipmentSkillsUpgrading">{{ $data['proposedSTInterventionRelatedEquipmentSkillsUpgrading'] ?? '' }}</textarea>
                            @else
                                {{ $data['proposedSTInterventionRelatedEquipmentSkillsUpgrading'] ?? '' }}
                            @endif
                        </td>
                        <td>
                            @if ($isEditable)
                                <textarea class="form-control Impact">{{ $data['impact'] ?? '' }}</textarea>
                            @else
                                {{ $data['impact'] ?? '' }}
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            @if ($isEditable)
                                <textarea class="form-control Process_Existing_PracticeProblem"></textarea>
                            @endif
                        </td>
                        <td>
                            @if ($isEditable)
                                <textarea class="form-control ProposedS_TIntervention"></textarea>
                            @endif
                        </td>
                        <td>
                            @if ($isEditable)
                                <textarea class="form-control ProposedS_TInterventionRelatedEquipmentSkillsUpgrading"></textarea>
                            @endif
                        </td>
                        <td>
                            @if ($isEditable)
                                <textarea class="form-control Impact"></textarea>
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <table>
        <tbody>
            <tr>
                <td
                    style="text-align: left;"
                    colspan="4"
                >Proposed Plant-Layout</td>
            </tr>
            <tr>
                <td
                    style="padding-left: 20px;vertical-align: baseline;"
                    colspan="4"
                >4. Cost and specification of S&T Intervention Related Equipment</td>
            </tr>
        </tbody>
    </table>
    <div id="equipmentTableContainer">
        @if ($isEditable)
            <div
                class="mb-3"
                style="text-align: right;"
            >
                <button
                    class="btn btn-sm btn-success"
                    id="addEquipmentTableRow"
                    type="button"
                ><i class="ri-add-line"></i></button>
                <button
                    class="btn btn-sm btn-danger"
                    id="removeEquipmentTableRow"
                    data-remove-row-btn
                    type="button"
                ><i class="ri-subtract-line"></i></button>
            </div>
        @endif
        <table id="equipmentTable">
            <thead>
                <tr>
                    <td style="text-align: center; width: 50%">S&T Intervention-related equipment/specification</td>
                    <td style="text-align: center; width: 10%">Qty</td>
                    <td style="text-align: center; width: 20%">Unit Cost</td>
                    <td style="text-align: center; width: 20%">Total Cost</td>
                </tr>
            </thead>
            <tbody>
                @php
                    $grand_total_cost = 0;
                @endphp
                @forelse($RTECReportdata['equipment'] ?? [] as $data)
                    @php
                        $row_total_cost =
                            doubleval(str_replace(',', '', $data['qty'] ?? 0)) *
                            doubleval(str_replace(',', '', $data['unit_cost'] ?? 0));
                        $grand_total_cost += $row_total_cost;
                    @endphp
                    <tr>
                        <td>
                            @if ($isEditable)
                                <textarea class="S_TInterventionRelatedEquipmentSpecification form-control">{{ $data['stnInterventionRelatedEquipmentSpecification'] ?? '' }}</textarea>
                            @else
                                {{ $data['stnInterventionRelatedEquipmentSpecification'] ?? '' }}
                            @endif
                        </td>
                        <td>
                            @if ($isEditable)
                                <input
                                    class="Qty"
                                    data-custom-numeric-input
                                    type="text"
                                    value="{{ $data['qty'] ?? '' }}"
                                >
                            @else
                                {{ $data['qty'] ?? '' }}
                            @endif
                        </td>
                        <td>
                            @if ($isEditable)
                                <input
                                    class="UnitCost"
                                    data-custom-numeric-input
                                    type="text"
                                    value="{{ $data['unitCost'] ?? '' }}"
                                >
                            @else
                                {{ $data['unitCost'] ?? '' }}
                            @endif
                        </td>
                        <td>
                            @if ($isEditable)
                                <input
                                    class="TotalCost"
                                    data-custom-numeric-input
                                    type="text"
                                    value="{{ $data['totalCost'] ?? ($row_total_cost ?? '') }}"
                                >
                            @else
                                {{ $data['totalCost'] ?? ($row_total_cost ?? '') }}
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            @if ($isEditable)
                                <textarea class="form-control S_TInterventionRelatedEquipmentSpecification"></textarea>
                            @endif
                        </td>
                        <td>
                            @if ($isEditable)
                                <input
                                    class="Qty"
                                    data-custom-numeric-input
                                    type="text"
                                >
                            @endif
                        </td>
                        <td>
                            @if ($isEditable)
                                <input
                                    class="UnitCost"
                                    data-custom-numeric-input
                                    type="text"
                                >
                            @endif
                        </td>
                        <td>
                            @if ($isEditable)
                                <input
                                    class="TotalCost"
                                    data-custom-numeric-input
                                    type="text"
                                >
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td
                        style="text-align: center;"
                        colspan="3"
                    >Total</td>
                    <td>{{ $grand_total_cost }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <table>
        <tbody>
            <tr>
                <td
                    style="padding-left: 20px;vertical-align: baseline;"
                    colspan="4"
                >5. List of equipment fabricators (name and address)</td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-left: 40px;"></td>
                <td colspan="2">c. Marketing Aspect
                    @if ($isEditable)
                        <textarea class="form-control MarketingAspect">{{ $RTECReportdata['marketing_aspect'] ?? '' }}</textarea>
                    @else
                        {{ $RTECReportdata['marketing_aspect'] ?? '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-left: 40px;"></td>
                <td colspan="2">d. Financial Aspect (including financial ration and analysis; net profit margin;
                    liquidity ration; ROI; balance sheet, partial budget analysis, detailed line-item budget, and refund
                    schedule)
                    @if ($isEditable)
                        <textarea class="form-control FinancialAspect">{{ $RTECReportdata['financial_aspect'] ?? '' }}</textarea>
                    @else
                        {{ $RTECReportdata['financial_aspect'] ?? '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-left: 40px;"></td>
                <td colspan="2">e. Waste Disposal
                    @if ($isEditable)
                        <textarea class="form-control WasteDisposal">{{ $RTECReportdata['waste_disposal'] ?? '' }}</textarea>
                    @else
                        {{ $RTECReportdata['waste_disposal'] ?? '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-left: 40px;"></td>
                <td colspan="2">Risk Management
                    @if ($isEditable)
                        <textarea class="form-control RiskManagement">{{ $RTECReportdata['risk_management'] ?? '' }}</textarea>
                    @else
                        {{ $RTECReportdata['risk_management'] ?? '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-left: 40px;"></td>
                <td colspan="2">g. Recommendation (addressing the findings of TNA)
                    @if ($isEditable)
                        <textarea class="form-control Recommendation">{{ $RTECReportdata['recommendation'] ?? '' }}</textarea>
                    @else
                        {{ $RTECReportdata['recommendation'] ?? '' }}
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    <table
        style="width: 100%; border-collapse: collapse; margin: auto; font-family: sans-serif; font-size: 14px; page-break-inside:avoid"
    >
        <tbody>
            <tr>
                <td
                    style="padding-bottom: 30px; vertical-align: top;"
                    colspan="3"
                >
                    Evaluated by:
                </td>
            </tr>
            <tr>
                <td
                    style="text-align: center; padding-top: 7.5pt; vertical-align: bottom;"
                    colspan="3"
                >
                    @if ($isEditable)
                        <input
                            id="rtec_chairperson"
                            name="rtec_chairperson"
                            type="text"
                            value="{{ $RTECReportdata['rtec_chairperson'] ?? '' }}"
                            style="width: 50%; text-align: center;"
                            placeholder="RTEC Chairperson"
                        >
                    @else
                        {{ $RTECReportdata['rtec_chairperson'] ?? '' }}
                    @endIf
                </td>
            </tr>
            <tr>
                <td
                    style="text-align: center; padding-bottom: 15pt; vertical-align: bottom;"
                    colspan="3"
                >
                    <div
                        style="display: inline-block; border-top: 1px solid black; padding-left: 37.5pt; padding-right: 37.5pt;">
                        RTEC Chairperson
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 33%; text-align: center; padding: 7.5pt;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="text-align: center;">
                                @if ($isEditable)
                                    <input
                                        id="rtec_member1"
                                        name="rtec_member1"
                                        type="text"
                                        value="{{ $RTECReportdata['rtec_member1'] ?? '' }}"
                                        style="width: 100%; text-align: center;"
                                        placeholder="RTEC Member 1"
                                    >
                                @else
                                    {{ $RTECReportdata['rtec_member1'] ?? '' }}
                                @endIf
                            </td>
                        </tr>
                        <tr>
                            <td style="border-top: 1px solid black; padding-bottom: 5px;">
                                RTEC Member
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width: 33%; text-align: center; padding: 7.5pt ">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="text-align: center;">
                                @if ($isEditable)
                                    <input
                                        id="rtec_member2"
                                        name="rtec_member2"
                                        type="text"
                                        value="{{ $RTECReportdata['rtec_member2'] ?? '' }}"
                                        style="width: 100%; text-align: center;"
                                        placeholder="RTEC Member 2"
                                    >
                                @else
                                    {{ $RTECReportdata['rtec_member2'] ?? '' }}
                                @endIf
                            </td>
                        </tr>
                        <tr>
                            <td style="border-top: 1px solid black; padding-bottom: 5px;">
                                RTEC Member
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width: 33%; text-align: center; padding: 7.5pt; ">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="text-align: center;">
                                @if ($isEditable)
                                    <input
                                        id="rtec_member3"
                                        name="rtec_member3"
                                        type="text"
                                        value="{{ $RTECReportdata['rtec_member3'] ?? '' }}"
                                        style="width: 100%; text-align: center;"
                                        placeholder="RTEC Member 3"
                                    >
                                @else
                                    {{ $RTECReportdata['rtec_member3'] ?? '' }}
                                @endIf
                            </td>
                        </tr>
                        <tr>
                            <td style="border-top: 1px solid black; padding-bottom: 5px;">
                                RTEC Member
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding-top: 30pt; vertical-align: top;">
                    Reviewed and Endorsed By: <br>
                    @if ($isEditable)
                        <input
                            id="rtec_rpmo_manager"
                            name="rtec_rpmo_manager"
                            type="text"
                            value="{{ $RTECReportdata['rtec_rpmo_manager'] ?? '' }}"
                            style="width: 100%; text-align: center;"
                            placeholder="Reviewed and Endorsed By"
                        >
                    @else
                        <br>
                        <br>

                        {{ $RTECReportdata['rtec_rpmo_manager'] ?? '' }}
                    @endIf
                </td>
                <td style="vertical-align: top;">
                </td>
                <td style="padding-top: 30pt; vertical-align: top;">
                    Noted By: <br>
                    @if ($isEditable)
                        <input
                            id="rtec_noted_by"
                            name="rtec_noted_by"
                            type="text"
                            value="{{ $RTECReportdata['rtec_noted_by'] ?? '' }}"
                            style="width: 100%; text-align: center; "
                            placeholder="Noted By"
                        >
                    @else
                        <br>
                        <br>
                        {{ $RTECReportdata['rtec_noted_by'] ?? '' }}
                    @endIf
                </td>
            </tr>
            <tr>
                <td
                    style="text-align: center; padding-top: 7pt; padding-bottom: 4.5pt; border-top: 1px solid black; vertical-align: bottom;">
                    RPMO Manager
                </td>
                <td>
                </td>
                <td
                    style="text-align: center; padding-top: 7pt; padding-bottom: 4.5pt; border-top: 1px solid black; vertical-align: bottom;">
                    Regional Director
                </td>
            </tr>
        </tbody>
    </table>

</form>
@if (!$isExporting)
    @if ($isEditable && auth()->user()->role === 'Staff')
        <div class="sticky-bottom d-flex justify-content-end pe-none">
            <select
                class="form-select w-25 pe-auto"
                name="rtec_report_doc_status"
                form="RTECReportForm"
            >
                <option value="pending">Pending</option>
                <option value="reviewed">Reviewed</option>
            </select>
            <button
                class="btn btn-primary ms-2 pe-auto"
                form="RTECReportForm"
                type="submit"
            >Set RTEC Report Form</button>
        </div>
    @elseif (auth()->user()->role === 'Staff')
        <div class="sticky-bottom d-flex justify-content-end pe-none">
            <button
                class="btn btn-primary text-end pe-auto"
                id="exportRTECReportFormToPDF"
                data-generated-url="{{ URL::signedRoute('staff.Applicant.generate.rtec-report', ['business_id' => $RTECReportdata['business_id'], 'application_id' => $RTECReportdata['application_id']]) }}"
                type="button"
            >Export as PDF</button>
        </div>
    @endif
@endif
