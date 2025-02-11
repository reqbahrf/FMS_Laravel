<div id="ProjectProposalForm">
        <div class="center">
            <img
                src="media/image1.png"
                alt="Logo"
                width="600"
                height="69"
            >
        </div>
        <table
            id="TopProposalTable"
            width="100%"
            style="border-collapse: collapse;"
            cellpadding="5"
        >
            <tr>
                <td
                    style="text-align: center; font-weight: bold; font-size: larger;"
                    colspan="9"
                >PROJECT PROPOSAL</td>
            </tr>
            <tr>
                <td style="font-weight: bold; width: 25%;">PROJECT TITLE:</td>
                <td style="width: 75%;" colspan="8"><input type="text" name="project_title" value="" placeholder="(Must already be able to reflect the goal of the project)"></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">PROPONENT:</td>
                <td colspan="8"><input type="text" name="proponent" value="" placeholder="(Indicate name and address of Firm)"></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">PROJECT COST:</td>
                <td colspan="8"><input type="text" name="project_cost" value="" placeholder="(Total project cost including counterpart of the proponent)"></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">AMOUNT REQUESTED:</td>
                <td colspan="8"><input type="text" name="amount_requested" value="" placeholder="(DOST-SETUP counterpart or amoount requested from DOST-SETUP)"></td>
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
                    <textarea name="general_objectives" class="form-control"></textarea>
                    <p style="font-weight: bold;">Specific Objectives:</p><br>
                    <textarea name="specific_objectives" class="form-control"></textarea>
                </td>
            </tr>
            <tr>
                <td
                    style="font-weight: bold;"
                    colspan="9"
                >PROJECT BACKGROUND:</td>
            </tr>
            <tr>
                <td colspan="9">
                    <p style="font-weight: bold;">A. Company Profile</p>
                </td>
            </tr>
        </table>
        <table
            id="CompanyProfileTable"
            style="border-collapse: collapse;"
            width="100%"
            border="1"
            cellpadding="5"
        >
            <tr>
                <td>Name of Firm</td>
                <td colspan="8"><input type="text" name="name_of_firm" value="" placeholder="XYZ Company"></td>
            </tr>
            <tr>
                <td>Address</td>
                <td colspan="8"><input type="text" name="address" value="" placeholder="Purok 1, Barangay 1, City, Province"></td>
            </tr>
            <tr>
                <td>Contact Person</td>
                <td colspan="8"><input type="text" name="contact_person" value="" placeholder="John Doe"></td>
            </tr>
            <tr>
                <td>Contact No</td>
                <td colspan="8"><input type="text" name="contact_no" value="" placeholder="09123456789"></td>
            </tr>
            <tr>
                <td>E-mail Address</td>
                <td colspan="8"><input type="text" name="email_address" value="" placeholder="xyzcompany@gmail.com"></td>
            </tr>
            <tr>
                <td>Year-Established</td>
                <td colspan="8"><input type="text" name="year_established" maxlength="4" value="" placeholder="2020"></td>
            </tr>
            <tr>
                <td rowspan="3">Type of Organization<br>(please check appropriate box in each row)</td>
                <td>
                    <input type="radio" name="type_of_organization" value="Single Proprietorship">
                    Single Proprietorship
                </td>
                <td>
                    <input type="radio" name="type_of_organization" value="Partnership">
                    Partnership
                </td>
                <td>
                    <input type="radio" name="type_of_organization" value="Cooperative">
                    Cooperative
                </td>
                <td colspan="2">
                    <input type="radio" name="type_of_organization" value="Corporation">
                    Corporation
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="type_of_organization" value="Profit">
                    Profit
                </td>
                <td>
                    <input type="radio" name="type_of_organization" value="Non-Profit">
                    Non-Profit
                </td>
                <td></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="size_of_organization" value="Micro">
                    Micro<br>(P3M Total Asset Value of less)
                </td>
                <td>
                    <input type="radio" name="size_of_organization" value="Small">
                    Small<br>(P3,000,001.00 - P15M Total Asset Value)
                </td>
                <td>
                    <input type="radio" name="size_of_organization" value="Medium">
                    Medium<br>(P15,000,001.00 - P100M Total Asset Value)
                </td>
            </tr>
            <tr>
                <td rowspan="6">Number of Employee<br>(please indicate number of employee)</td>
                <td colspan="1">Type of Employment</td>
                <td>Male</td>
                <td>Female</td>
                <td>Total</td>
            </tr>
            <tr>
                <td colspan="1">Direct Workers</td>
                <td><input type="text" name="direct_workers_male" value=""></td>
                <td><input type="text" name="direct_workers_female" value=""></td>
                <td><input type="text" name="direct_workers_total" value=""></td>
            </tr>
            <tr>
                <td colspan="1">Production</td>
                <td><input type="text" name="production_male" value=""></td>
                <td><input type="text" name="production_female" value=""></td>
                <td><input type="text" name="production_total" value=""></td>
            </tr>
            <tr>
                <td colspan="1">Non-Production</td>
                <td><input type="text" name="non_production_male" value=""></td>
                <td><input type="text" name="non_production_female" value=""></td>
                <td><input type="text" name="non_production_total" value=""></td>
            </tr>
            <tr>
                <td colspan="1">Indirect/Contract Workers</td>
                <td><input type="text" name="indirect_contract_workers_male" value=""></td>
                <td><input type="text" name="indirect_contract_workers_female" value=""></td>
                <td><input type="text" name="indirect_contract_workers_total" value=""></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="1">Total</td>
                <td><input type="text" name="total_male" value=""></td>
                <td><input type="text" name="total_female" value=""></td>
                <td><input type="text" name="total" value=""></td>
            </tr>
            <tr>
                <td rowspan="6"><b>Registration</b></td>
                <td colspan="1"><b>Office</b></td>
                <td><b>Registration Number</b></td>
                <td colspan="3"><b>Date of Registration</b></td>
            </tr>
            <tr>
                <td colspan="1">DTI</td>
                <td></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="1">SEC</td>
                <td></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="1">CDA</td>
                <td></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="1">LGU</td>
                <td></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="1">Others, please specify</td>
                <td></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td rowspan="10"><b>Business Activity/ies:</b><br>(please check appropriate box)</td>
                <td colspan="2">Crop and animal production, hunting, and related service activities</td>
                <td colspan="2">Chemicals and chemical products manufacturing</td>
            </tr>
            <tr>
                <td colspan="2">Forestry and Logging</td>
                <td colspan="2">Basic pharmaceutical products and pharmaceutical preparations manufacturing</td>
            </tr>
            <tr>
                <td colspan="2">Fishing and Agriculture</td>
                <td colspan="2">Rubber and plastic products manufacturing</td>
            </tr>
            <tr>
                <td colspan="2">Food Processing</td>
                <td colspan="2">Non-metallic mineral products manufacturing</td>
            </tr>
            <tr>
                <td colspan="2">Beverage Manufacturing</td>
                <td colspan="2">Fabricated metal products manufacturing</td>
            </tr>
            <tr>
                <td colspan="2">Textile Manufacturing</td>
                <td colspan="2">Machinery and equipment, Not Elsewhere Classified (NEC) manufacturing</td>
            </tr>
            <tr>
                <td colspan="2">Wearing apparel Manufacturing</td>
                <td colspan="2">Other transport equipment manufacturing</td>
            </tr>
            <tr>
                <td colspan="2">Leather and related products manufacturing</td>
                <td colspan="2">Furniture manufacturing</td>
            </tr>
            <tr>
                <td colspan="2">Wood and products of wood and cork manufacturing</td>
                <td colspan="2">Information and Communication</td>
            </tr>
            <tr>
                <td colspan="2">Paper and paper products manufacturing</td>
                <td colspan="2">Other regional priority industries approved by the Regional Development Council,
                    please specify:</td>
            </tr>
            <tr>
                <td><b>Products/Services</b></td>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td><b>Brief Enterprise Background</b></td>
                <td colspan="6"></td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td>
                    <p class="section--title">B. Project Background</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub-title">1. Organizational Chart</p>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">2. Skills and expertise of employee/owner (proponent)</p>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">3. Compensation</p>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">C. Plant site or location (including vicinity map)</p>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">D. Capacity, volume and cost of production</p>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">E. Raw material/s used and sources of raw material</p>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>
        <table
            id="MarketAspectTable"
            width="100%"
        >
            <tr>
                <td>
                    <p class="section--title">MARKETING ASPECTS</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">A. Market situation, product demand and supply</p>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">B. Product specifications and product price</p>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">C. Distribution channel (local/export)</p>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">D. Competitors</p>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">E. Existing problems (if any)</p>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">F. Market plans/strategies</p>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>
        <table
            id="TechnicalAspectTable"
            width="100%"
        >
            <tr>
                <td>
                    <p class="section--title">
                        TECHNOLOGICAL ASPECTS
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub-title">A. Production Process</p>
                </td>
            </tr>
            <tr>
                <td>- Process Flow of Production</td>
            </tr>
            <tr>
                <td>- Material Balance</td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">B. Existing Production Equipment</p>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">C. Technical constraints on the production line and proposed S&T
                        intervention</p>
                </td>
            </tr>
            <tr>
                <td>
                    <table id="technicalConstraintTable">
                        <tr>
                            <td>Process/Existing Practice/Problem</th>
                            <td>Proposed S&T Intervention</td>
                            <td>Proposed S&T intervention-related equipment / skills upgrading</td>
                            <td>Impact</th>
                        </tr>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="section--title">Proposed Plant Layout</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">D. Cost and specifications of S&T Intervention-Related Equipment</p>
                </td>
            </tr>
            <tr>
                <td>
                    <table id="equipmentTable">
                        <tr>
                            <td>S&T Intervention-related equipment/specification</td>
                            <td>Qty</td>
                            <td>Unit Cost</td>
                            <td>Total Cost</td>
                        </tr>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tr>
                            <td
                                class="bold"
                                colspan="3"
                            >Total</td>
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">E. List of equipment fabricators (name and address)</p>
                </td>
            </tr>
            <tr>
                <td>

                </td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">F. Schedule of activities for the proposed project</p>
                </td>
            </tr>
            <tr>
                <td>

                </td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">G. Expected Output/Impact (measured results)</p>
                </td>
            </tr>
            <tr>
                <td>
                    <ol>
                        <li>Percentage increase in productivity</li>
                        <li>Improved quality of products</li>
                        <li>Contribution to the production line/process</li>
                        <li>Percentage decrease in rejects</li>
                        <li>Additional Clients</li>
                        <li>Others (please specify)</li>
                    </ol>
                </td>
            </tr>

        </table>
        <table id="WasteManagementTable">
            <tr>
                <td>
                    <p class="section--title">WASTE MANAGEMENT/DISPOSAL</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">D. Volume of waste generated monthly</p>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">D. Kinds of wastes (plastics, paper, metals, chemicals, pollutants,
                        etc.)</p>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">D. Methods of disposal</p>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>
        <table id="FinancialAsspectTable">
            <tr>
                <td>
                    <p class="section--title">FINANCIAL ASPECT</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">A. Financial Capacity</p>
                </td>
            </tr>
            <tr>
                <td>
                    <ul>
                        <li>Financial ratio and analysis</li>
                        <li>Partial Budget Analysis</li>
                        <li>Net profit margin ratio</li>
                        <li>Liquidity ratio</li>
                        <li>ROI</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">B. Financial Constraints</p>
                </td>
            </tr>
            <tr>
                <td>

                </td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">C. Cash flow/ financial statement/ balance sheet</p>
                </td>
            </tr>
            <tr>
                <td>

                </td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">D. Budgetary Requirement for the proposed project</p>
                </td>
            </tr>
            <tr>
                <td>
                    <table id="budgetTable">
                        <tr>
                            <th>Item of Expenditure</th>
                            <th>Qty</th>
                            <th>Unit Cost</th>
                            <th>Cost</th>
                            <th>SETUP</th>
                            <th>LGIA</th>
                            <th>Cooperator</th>
                            <th>Total</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td
                                class="bold"
                                colspan="7"
                            >Total</td>
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="section--sub--title">E. Proposed Refund Structure</p>
                </td>
            </tr>
            <tr>
                <td>
                    <table id="refundStructureTable">
                        <tr>
                            <th>Months</th>
                            <th>Y1</th>
                            <th>Y2</th>
                            <th>Y3</th>
                            <th>Y4</th>
                            <th>Y5</th>
                            <th>Total</th>
                        </tr>
                        <tr>
                            <td>January</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>February</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>March</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>April</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>May</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>June</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>July</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>August</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>September</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>October</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>November</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>December</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="bold">Total</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table id="riskManagementPlanTable">
            <tr>
                <td>
                    <p class="section--title">RISK MANAGEMENT</p>
                </td>
            </tr>
            <tr>
                <td>
                    <table id="riskTable">
                        <tr>
                            <th>OBJECTIVES</th>
                            <th>RISKS AND ASSUMPTIONS</th>
                            <th>RISK MANAGEMENT PLAN</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>
        <p>
            <strong>Note:</strong> Risk -- refers to an uncertain event or condition that its occurrence has a negative
            effect on the project.
        </p>
        <p>
            Assumption -- refers to an event or circumstance that its occurrence will lead to the success of the
            project.
        </p>
        <p>
            Risk Management Plan -- proposed activities to address the risks and assumptions.
        </p>
</div>



