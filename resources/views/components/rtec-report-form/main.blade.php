@props(['RTECReportdata', 'isEditable'])
<form id="RTECReportForm"
@if($isEditable)
action="{{ route('staff.Applicant.set.rtec-report', ['business_id' => $RTECReportdata['business_id'], 'application_id' => $RTECReportdata['application_id']]) }}"
@endif
>
    <table id="RTECReportInfoTable" width="100%">
        <tr>
            <td
                style="text-align: center; font-weight: bold; font-size: larger;"
                colspan="2"
            >RTEC REPORT</td>
        </tr>
        <tr>
            <td style="width: 20%;">Project Title:</td>
            <td style="width: 80%;">
                <span id="title"></span>
            </td>
        </tr>
        <tr>
            <td>Proponent:</td>
            <td>
                <span id="proponent"></span>
            </td>
        </tr>
        <tr>
            <td>Contact Person:</td>
            <td>
                <span id="contact"></span>
            </td>
        </tr>
        <tr>
            <td rowspan="5" style="text-align: top; vertical-align: top;">Project Cost:</td>
            <td>
                <span id="project_cost"></span>
            </td>
        </tr>
        <tr>
            <td>Proponent:</td>
            <td>
                <span id="amount_requested"></span>
            </td>
        </tr>
        <tr>
            <td>DOST-SETUP:</td>
            <td>
                <span id="dost_setup"></span>
            </td>
        </tr>
        <tr>
            <td>DOST-LGIA:</td>
            <td>
                <span id="dost_lgia"></span>
            </td>
        </tr>
        <tr>
            <td>Total</td>
            <td>
                <span id="total"></span>
            </td>
        </tr>
    </table>
    <table id="additionInfoTable" style="width: 100%;">
        <tbody>
            <tr>
                <th style="text-align: left;" colspan="2">I. Brief description of the project</th>
            </tr>
            <tr>
                <td style="vertical-align: top;">a.</td>
                <td>Company Profile</td>
            </tr>
            <tr>
                <td style="vertical-align: top;">b.</td>
                <td>Objectives</td>
            </tr>
            <tr>
                <td style="vertical-align: top;">c.</td>
                <td>Expected Outputs/Impact/s of S&T intervention</td>
            </tr>
            <tr>
                <th style="text-align: left;" colspan="2">II. Compliance of Requirements</th>
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
                <td><input
                        name="Letter_of_intent"
                        type="radio"
                        value="complied"
                    ></td>
                <td><input
                        name="Letter_of_intent"
                        type="radio"
                        value="not_complied"
                    ></td>
            </tr>
            <tr>
                <td>Accomplished DOST TNA Form 01 (Application for Technology Needs Assessment)</td>
                <td><input
                        name="TNA_form1"
                        type="radio"
                        value="complied"
                    ></td>
                <td><input
                        name="TNA_form1"
                        type="radio"
                        value="not_complied"
                    ></td>
            </tr>
            <tr>
                <td>Accomplished DOST TNA Form 02 (Technology Needs Assessment Report)</td>
                <td><input
                        name="TNA_form2"
                        type="radio"
                        value="complied"
                    ></td>
                <td><input
                        name="TNA_form2"
                        type="radio"
                        value="not_complied"
                    ></td>
            </tr>
            <tr>
                <td>Proposal following SETUP Form 001 (Project Proposal Format)</td>
                <td><input
                        name="SETUP_form1"
                        type="radio"
                        value="complied"
                    ></td>
                <td><input
                        name="SETUP_form1"
                        type="radio"
                        value="not_complied"
                    ></td>
            </tr>
            <tr>
                <td>Copy of business permits and licenses issued by LGUs and other appropriate government agencies</td>
                <td><input
                        name="business_permits"
                        type="radio"
                        value="complied"
                    ></td>
                <td><input
                        name="business_permits"
                        type="radio"
                        value="not_complied"
                    ></td>
            </tr>
            <tr>
                <td>Financial statements for the past three (3) years for small and medium enterprises and at least one
                    (1) year for micro enterprises together with notarized Sworn Statement that all information provided
                    are true and correct</td>
                <td><input
                        name="financial_statements_past_3"
                        type="radio"
                        value="complied"
                    ></td>
                <td><input
                        name="financial_statements_past_3"
                        type="radio"
                        value="not_complied"
                    ></td>
            </tr>
            <tr>
                <td>Projected financial statements</td>
                <td><input
                        name="projected_financial_statements"
                        type="radio"
                        value="complied"
                    ></td>
                <td><input
                        name="projected_financial_statements"
                        type="radio"
                        value="not_complied"
                    ></td>
            </tr>
            <tr>
                <td>Photocopy of Official Receipt</td>
                <td><input
                        name="official_receipt"
                        type="radio"
                        value="complied"
                    ></td>
                <td><input
                        name="official_receipt"
                        type="radio"
                        value="not_complied"
                    ></td>
            </tr>
            <tr>
                <td>Certificate of registration of business name with the Department of Trade and Industry (DTI),
                    Securities and Exchange Commission (SEC), or Cooperative Development Authority (CDA), whichever is
                    applicable</td>
                <td><input
                        name="certificate_of_registration"
                        type="radio"
                        value="complied"
                    ></td>
                <td><input
                        name="certificate_of_registration"
                        type="radio"
                        value="not_complied"
                    ></td>
            </tr>
            <tr>
                <td>Copy of Articles of Incorporation for cooperatives and associations</td>
                <td><input
                        name="copy_articles_of_incorporation"
                        type="radio"
                        value="complied"
                    ></td>
                <td><input
                        name="copy_articles_of_incorporation"
                        type="radio"
                        value="not_complied"
                    ></td>
            </tr>
            <tr>
                <td>Sworn affidavit of no relation up to third degree of consanguinity and affinity to the approving
                    authority and no bad debt</td>
                <td><input
                        name="sworn_affidavit"
                        type="radio"
                        value="complied"
                    ></td>
                <td><input
                        name="sworn_affidavit"
                        type="radio"
                        value="not_complied"
                    ></td>
            </tr>
            <tr>
                <td>In the case of cooperatives and non-single proprietorship, LGUs, organization, Board/Legislative
                    Council resolution authorizing the availment of the assistance and designating authorized signatory
                    for the financial assistance</td>
                <td><input
                        name="in_the_case_of_cooperative"
                        type="radio"
                        value="complied"
                    ></td>
                <td><input
                        name="in_the_case_of_cooperative"
                        type="radio"
                        value="not_complied"
                    ></td>
            </tr>
            <tr>
                <td>Three (3) quotations for each equipment from suppliers/fabricators of the equipment to be
                    purchased/fabricated</td>
                <td><input
                        name="three_quotations"
                        type="radio"
                        value="complied"
                    ></td>
                <td><input
                        name="three_quotations"
                        type="radio"
                        value="not_complied"
                    ></td>
            </tr>
            <tr>
                <td>Complete technical design/drawing of all equipment to be purchased/fabricated</td>
                <td><input
                        name="complete_technical_design"
                        type="radio"
                        value="complied"
                    ></td>
                <td><input
                        name="complete_technical_design"
                        type="radio"
                        value="not_complied"
                    ></td>
            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th style="text-align: left;" colspan="4">III. Highlights of Evaluation</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="vertical-align: top;">a.</td>
                <td colspan="3">Management/Administrative Aspect</td>
            </tr>
            <tr>
                <td style="vertical-align: top;">b.</td>
                <td colspan="3">Technical Aspect (including the recommended DOST S&T Intervention)</td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-left: 20px;">1.</td>
                <td colspan="2">Production Process</td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-left: 40px;">a.</td>
                <td colspan="2">Process Flow of Production</td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-left: 40px;">b.</td>
                <td colspan="2">Material Balance</td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-left: 20px;">2.</td>
                <td colspan="2">Existing Production Equipment</td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-left: 20px;">3.</td>
                <td colspan="2">Technical constraints on the production line and proposed S&T Intervention</td>
            </tr>
        </tbody>
    </table>
    <table id="processExistingPracticeProblemTable">
        <tr>
            <td
                style="text-align: center;"
                colspan="2"
            >Process/Existing Practice/Problem</td>
            <td style="text-align: center;">Proposed S&T Intervention</td>
            <td style="text-align: center;">Proposed S&T intervention-related equipment/skills upgrading</td>
            <td style="text-align: center;">Impact</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

    </table>
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
                    style="text-align: left;"
                    colspan="4"
                >4. Cost and specification of S&T Intervention Related Equipment</td>
            </tr>
        </tbody>
    </table>
    <table id="equipmentTable">
        <tbody>
            <tr>
                <td
                    style="text-align: center;"
                    colspan="2"
                >S&T Intervention-related equipment/specification</td>
                <td style="text-align: center;">Qty</td>
                <td style="text-align: center;">Unit Cost</td>
                <td style="text-align: center;">Total Cost</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td
                    style="text-align: center;"
                    colspan="4"
                >Total</td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td
                    style="text-align: left;"
                    colspan="4"
                >5. List of equipment fabricators (name and address)</td>
            </tr>
            <tr>
                <td style="vertical-align: top;">c.</td>
                <td colspan="3">Marketing Aspect</td>
            </tr>
            <tr>
                <td style="vertical-align: top;">d.</td>
                <td colspan="3">Financial Aspect (including financial ration and analysis; net profit margin;
                    liquidity ration; ROI; balance sheet, partial budget analysis, detailed line-item budget, and refund
                    schedule)</td>
            </tr>
            <tr>
                <td style="vertical-align: top;">e.</td>
                <td colspan="3">Waste Disposal</td>
            </tr>
            <tr>
                <td style="vertical-align: top;">f.</td>
                <td colspan="3">Risk Management</td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="vertical-align: top;">g. Recommendation (addressing the findings of TNA)</td>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td style="vertical-align: top;"></td>
                <td colspan="3"></td>
            </tr>
        </tbody>
    </table>
</form>
@if($isEditable)
<div class="d-flex justify-content-end">
    <button
        type="submit"
        form="RTECReportForm"
        class="btn btn-primary text-end"
    >Set TNA Form</button>
</div>
@else
<div class="d-flex justify-content-end">
    <button
        type="button"
        data-generated-url="{{ URL::signedRoute('staff.Applicant.generate.rtec-report', ['business_id' => $RTECReportdata['business_id'], 'application_id' => $RTECReportdata['application_id']]) }}"
        id="exportRTECReportFormToPDF"
        class="btn btn-primary text-end"
    >Export as PDF</button>
</div>
@endif

