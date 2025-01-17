<div class="container mt-5 shadow">
    <div id="smartwizard">
        <ul class="nav nav-progress">
            <li class="nav-item">
                <a
                    class="nav-link default active"
                    href="#step-1"
                >
                    <div class="num">1</div>
                    Personal Info
                </a>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link default"
                    href="#step-2"
                >
                    <span class="num">2</span>
                    Business Info
                </a>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link default"
                    href="#step-3"
                >
                    <span class="num">3</span>
                    Requirements
                </a>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link default"
                    href="#step-4"
                >
                    <span class="num">4</span>
                    Confirm Details
                </a>
            </li>
        </ul>
        <form
            class="g-3 p-5"
            id="applicationForm"
            novalidate
        >
            @csrf
            <div
                class="tab-content h-auto"
                style="height: auto;"
            >
                <div
                    class="alert alert-primary m-0"
                    role="alert"
                >
                    <i class="ri-information-2-fill ri-lg"></i>
                    Please fill out all the <span class="requiredFields">*</span> required fields
                </div>
                <div
                    class="tab-pane py-5"
                    id="step-1"
                    role="tabpanel"
                    aria-labelledby="step-1"
                    style="position: static; left: 0px; display: block;"
                >
                    <!-- Where Personal Info Displayed -->
                    <div class="row mb-3 gy-3">
                        @if (auth()->user()->hasRole('Staff'))
                            <div class="col-12 col-md-6">
                                <label for="email">Email: <span class="requiredFields">*</span></label>
                                <input
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    type="email"
                                    value=""
                                    title="Please enter a valid email address"
                                    required
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                >
                                <div class="form-text text-muted">To ensure successful delivery of login
                                    credentials, please enter a valid email address for the registered user.</div>
                                <div class="invalid-feedback">Please enter a valid email address.</div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="projectStatus">Status:</label>
                                <select
                                    class="form-select"
                                    id="projectStatus"
                                    name="projectStatus"
                                    required
                                >
                                    <option value="new">New</option>
                                    <option value="ongoing">Ongoing</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a project status.
                                </div>
                            </div>
                            <div
                                class="col-12 col-md-3"
                                style="display: none"
                            >
                                <label for="project_id">Project ID:</label>
                                <input
                                    class="form-control"
                                    id="project_id"
                                    name="project_id"
                                    data-status-dependency="ongoing"
                                    type="text"
                                    value=""
                                    required
                                >
                                <div
                                    class="invalid-feedback"
                                    disabled
                                >
                                    Please enter a valid project ID.
                                </div>
                            </div>
                            <div
                                class="col-12 col-md-9"
                                style="display: none"
                            >
                                <label for="project_title">Project Title:</label>
                                <input
                                    class="form-control"
                                    id="project_title"
                                    name="project_title"
                                    data-status-dependency="ongoing"
                                    type="text"
                                    required
                                >
                                <div
                                    class="invalid-feedback"
                                    disabled
                                >
                                    Please enter a valid project title.
                                </div>
                            </div>
                            <div
                                class="col-12 col-md-4"
                                style="display: none"
                            >
                                <label for="funded_amount">Funded Amount:</label>
                                <input
                                    class="form-control"
                                    id="funded_amount"
                                    name="funded_amount"
                                    data-status-dependency="ongoing"
                                    type="text"
                                    required
                                >
                                <div
                                    class="invalid-feedback"
                                    disabled
                                >
                                    Please enter a valid funded amount.
                                </div>
                            </div>
                            <div
                                class="col-12 col-md-4"
                                style="display: none"
                            >
                                <label for="funded_date">Funded Date:</label>
                                <input
                                    class="form-control"
                                    id="funded_date"
                                    name="funded_date"
                                    data-status-dependency="ongoing"
                                    type="date"
                                    required
                                >
                                <div
                                    class="invalid-feedback"
                                    disabled
                                >
                                    Please enter a valid funded date.
                                </div>
                            </div>
                            <hr>
                        @endif
                        <h5>Contact Person:</h5>
                        <div class="col-12 col-md-2">
                            <label for="prefix">Prefix:</label>
                            <input
                                class="form-control"
                                id="prefix"
                                name="prefix"
                                list="prefixOptions"
                            >
                            <datalist id="prefixOptions">
                                <option value="Mx.">Mx.</option>
                                <option value="Mr.">Mr.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Miss">Miss</option>
                                <option value="Ms.">Ms.</option>
                                <option value="Dr.">Dr.</option>
                                <option value="Prof.">Prof.</option>
                                <option value="Rev.">Rev.</option>
                                <option value="Hon.">Hon.</option>
                                <option value="Atty.">Atty.</option>
                            </datalist>
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="f_name">First Name: <span class="requiredFields"> *</span></label>
                            <input
                                class="form-control"
                                id="f_name"
                                name="f_name"
                                type="text"
                                value="{{ old('f_name') }}"
                                placeholder="John"
                                required
                            >
                            <div class="invalid-feedback">
                                Please enter your first name.
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="middle_name">Middle Name:</label>
                            <input
                                class="form-control"
                                id="middle_name"
                                name="middle_name"
                                type="text"
                                value="{{ old('middle_name') }}"
                                placeholder="Doe"
                            >
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="l_name">Last Name: <span class="requiredFields"> *</span></label>
                            <input
                                class="form-control"
                                id="l_name"
                                name="l_name"
                                type="text"
                                value="{{ old('l_name') }}"
                                placeholder="Doe"
                                required
                            >
                            <div class="invalid-feedback">
                                Please enter your last name.
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="suffix">Suffix: </label>
                            <input
                                class="form-control"
                                id="suffix"
                                name="suffix"
                                value="{{ old('suffix') }}"
                                list="suffixList"
                            >
                            <datalist id="suffixList">
                                <option value="Jr.">Jr.</option>
                                <option value="Sr.">Sr.</option>
                                <option value="II">II</option>
                                <option value="III">III</option>
                                <option value="IV">IV</option>
                                <option value="Esq.">Esq.</option>
                                <option value="Ph.D.">Ph.D.</option>
                            </datalist>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="row">
                                <div class="col-12 me-auto">
                                    <label for="sex">sex: <span class="requiredFields">*</span></label>
                                    <select
                                        class="form-select"
                                        id="sex"
                                        name="sex"
                                        required
                                    >
                                        <option value="">Select...</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select your sex.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="row">
                                <div class="col-12 mx-auto">
                                    <label for="designation">Designation: <span class="requiredFields">*</span>
                                    </label>
                                    <input
                                        class="form-control"
                                        id="designation"
                                        name="designation"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="right"
                                        type="text"
                                        value="{{ old('designation') }}"
                                        title="Example: Manager, Owner, CEO, etc."
                                        placeholder="Designation"
                                        required
                                    >
                                    <div class="invalid-feedback">
                                        Please enter your Designation.
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="row">
                                <div class="col-12 ms-auto">
                                    <label for="b_date">Birth Date: <span class="requiredFields">
                                            *</span></label>

                                    <input
                                        class="form-control"
                                        id="b_date"
                                        name="b_date"
                                        type="date"
                                        value="{{ old('b_date') }}"
                                        placeholder="DD/MM/YYYY"
                                        required
                                    >
                                    <div class="invalid-feedback">
                                        Please enter your Birth Date.
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12 ">
                            <h5>Contact Info:</h5>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label for="Mobile_no">Mobile Number: <span
                                            class="requiredFields">*</span></label>
                                    <div class="input-group">
                                        <select
                                            class="form-select"
                                            id="country_code"
                                            name="country_code"
                                            style="max-width: 11.25rem;"
                                            required
                                        >
                                            <option value="+93">Afghanistan (+93)</option>
                                            <option value="+355">Albania (+355)</option>
                                            <option value="+213">Algeria (+213)</option>
                                            <option value="+376">Andorra (+376)</option>
                                            <option value="+244">Angola (+244)</option>
                                            <option value="+1">Antigua and Barbuda (+1)</option>
                                            <option value="+54">Argentina (+54)</option>
                                            <option value="+374">Armenia (+374)</option>
                                            <option value="+61">Australia (+61)</option>
                                            <option value="+43">Austria (+43)</option>
                                            <option value="+994">Azerbaijan (+994)</option>
                                            <option value="+1">Bahamas (+1)</option>
                                            <option value="+973">Bahrain (+973)</option>
                                            <option value="+880">Bangladesh (+880)</option>
                                            <option value="+1">Barbados (+1)</option>
                                            <option value="+375">Belarus (+375)</option>
                                            <option value="+32">Belgium (+32)</option>
                                            <option value="+501">Belize (+501)</option>
                                            <option value="+229">Benin (+229)</option>
                                            <option value="+975">Bhutan (+975)</option>
                                            <option value="+591">Bolivia (+591)</option>
                                            <option value="+387">Bosnia and Herzegovina (+387)</option>
                                            <option value="+267">Botswana (+267)</option>
                                            <option value="+55">Brazil (+55)</option>
                                            <option value="+673">Brunei (+673)</option>
                                            <option value="+359">Bulgaria (+359)</option>
                                            <option value="+226">Burkina Faso (+226)</option>
                                            <option value="+257">Burundi (+257)</option>
                                            <option value="+855">Cambodia (+855)</option>
                                            <option value="+237">Cameroon (+237)</option>
                                            <option value="+1">Canada (+1)</option>
                                            <option value="+238">Cape Verde (+238)</option>
                                            <option value="+236">Central African Republic (+236)</option>
                                            <option value="+235">Chad (+235)</option>
                                            <option value="+56">Chile (+56)</option>
                                            <option value="+86">China (+86)</option>
                                            <option value="+57">Colombia (+57)</option>
                                            <option value="+269">Comoros (+269)</option>
                                            <option value="+242">Congo (+242)</option>
                                            <option value="+506">Costa Rica (+506)</option>
                                            <option value="+385">Croatia (+385)</option>
                                            <option value="+53">Cuba (+53)</option>
                                            <option value="+357">Cyprus (+357)</option>
                                            <option value="+420">Czech Republic (+420)</option>
                                            <option value="+45">Denmark (+45)</option>
                                            <option value="+253">Djibouti (+253)</option>
                                            <option value="+1">Dominica (+1)</option>
                                            <option value="+1">Dominican Republic (+1)</option>
                                            <option value="+670">East Timor (+670)</option>
                                            <option value="+593">Ecuador (+593)</option>
                                            <option value="+20">Egypt (+20)</option>
                                            <option value="+503">El Salvador (+503)</option>
                                            <option value="+240">Equatorial Guinea (+240)</option>
                                            <option value="+291">Eritrea (+291)</option>
                                            <option value="+372">Estonia (+372)</option>
                                            <option value="+251">Ethiopia (+251)</option>
                                            <option value="+679">Fiji (+679)</option>
                                            <option value="+358">Finland (+358)</option>
                                            <option value="+33">France (+33)</option>
                                            <option value="+241">Gabon (+241)</option>
                                            <option value="+220">Gambia (+220)</option>
                                            <option value="+995">Georgia (+995)</option>
                                            <option value="+49">Germany (+49)</option>
                                            <option value="+233">Ghana (+233)</option>
                                            <option value="+30">Greece (+30)</option>
                                            <option value="+1">Grenada (+1)</option>
                                            <option value="+502">Guatemala (+502)</option>
                                            <option value="+224">Guinea (+224)</option>
                                            <option value="+245">Guinea-Bissau (+245)</option>
                                            <option value="+592">Guyana (+592)</option>
                                            <option value="+509">Haiti (+509)</option>
                                            <option value="+504">Honduras (+504)</option>
                                            <option value="+852">Hong Kong (+852)</option>
                                            <option value="+36">Hungary (+36)</option>
                                            <option value="+354">Iceland (+354)</option>
                                            <option value="+91">India (+91)</option>
                                            <option value="+62">Indonesia (+62)</option>
                                            <option value="+98">Iran (+98)</option>
                                            <option value="+964">Iraq (+964)</option>
                                            <option value="+353">Ireland (+353)</option>
                                            <option value="+972">Israel (+972)</option>
                                            <option value="+39">Italy (+39)</option>
                                            <option value="+1">Jamaica (+1)</option>
                                            <option value="+81">Japan (+81)</option>
                                            <option value="+962">Jordan (+962)</option>
                                            <option value="+7">Kazakhstan (+7)</option>
                                            <option value="+254">Kenya (+254)</option>
                                            <option value="+686">Kiribati (+686)</option>
                                            <option value="+850">North Korea (+850)</option>
                                            <option value="+82">South Korea (+82)</option>
                                            <option value="+965">Kuwait (+965)</option>
                                            <option value="+996">Kyrgyzstan (+996)</option>
                                            <option value="+856">Laos (+856)</option>
                                            <option value="+371">Latvia (+371)</option>
                                            <option value="+961">Lebanon (+961)</option>
                                            <option value="+266">Lesotho (+266)</option>
                                            <option value="+231">Liberia (+231)</option>
                                            <option value="+218">Libya (+218)</option>
                                            <option value="+423">Liechtenstein (+423)</option>
                                            <option value="+370">Lithuania (+370)</option>
                                            <option value="+352">Luxembourg (+352)</option>
                                            <option value="+853">Macau (+853)</option>
                                            <option value="+389">Macedonia (+389)</option>
                                            <option value="+261">Madagascar (+261)</option>
                                            <option value="+265">Malawi (+265)</option>
                                            <option value="+60">Malaysia (+60)</option>
                                            <option value="+960">Maldives (+960)</option>
                                            <option value="+223">Mali (+223)</option>
                                            <option value="+356">Malta (+356)</option>
                                            <option value="+692">Marshall Islands (+692)</option>
                                            <option value="+222">Mauritania (+222)</option>
                                            <option value="+230">Mauritius (+230)</option>
                                            <option value="+52">Mexico (+52)</option>
                                            <option value="+691">Micronesia (+691)</option>
                                            <option value="+373">Moldova (+373)</option>
                                            <option value="+377">Monaco (+377)</option>
                                            <option value="+976">Mongolia (+976)</option>
                                            <option value="+382">Montenegro (+382)</option>
                                            <option value="+212">Morocco (+212)</option>
                                            <option value="+258">Mozambique (+258)</option>
                                            <option value="+95">Myanmar (+95)</option>
                                            <option value="+264">Namibia (+264)</option>
                                            <option value="+674">Nauru (+674)</option>
                                            <option value="+977">Nepal (+977)</option>
                                            <option value="+31">Netherlands (+31)</option>
                                            <option value="+64">New Zealand (+64)</option>
                                            <option value="+505">Nicaragua (+505)</option>
                                            <option value="+227">Niger (+227)</option>
                                            <option value="+234">Nigeria (+234)</option>
                                            <option value="+47">Norway (+47)</option>
                                            <option value="+968">Oman (+968)</option>
                                            <option value="+92">Pakistan (+92)</option>
                                            <option value="+680">Palau (+680)</option>
                                            <option value="+970">Palestine (+970)</option>
                                            <option value="+507">Panama (+507)</option>
                                            <option value="+675">Papua New Guinea (+675)</option>
                                            <option value="+595">Paraguay (+595)</option>
                                            <option value="+51">Peru (+51)</option>
                                            <option
                                                value="+63"
                                                selected
                                            >Philippines (+63)</option>
                                            <option value="+48">Poland (+48)</option>
                                            <option value="+351">Portugal (+351)</option>
                                            <option value="+974">Qatar (+974)</option>
                                            <option value="+40">Romania (+40)</option>
                                            <option value="+7">Russia (+7)</option>
                                            <option value="+250">Rwanda (+250)</option>
                                            <option value="+1">Saint Kitts and Nevis (+1)</option>
                                            <option value="+1">Saint Lucia (+1)</option>
                                            <option value="+1">Saint Vincent and the Grenadines (+1)</option>
                                            <option value="+685">Samoa (+685)</option>
                                            <option value="+378">San Marino (+378)</option>
                                            <option value="+239">Sao Tome and Principe (+239)</option>
                                            <option value="+966">Saudi Arabia (+966)</option>
                                            <option value="+221">Senegal (+221)</option>
                                            <option value="+381">Serbia (+381)</option>
                                            <option value="+248">Seychelles (+248)</option>
                                            <option value="+232">Sierra Leone (+232)</option>
                                            <option value="+65">Singapore (+65)</option>
                                            <option value="+421">Slovakia (+421)</option>
                                            <option value="+386">Slovenia (+386)</option>
                                            <option value="+677">Solomon Islands (+677)</option>
                                            <option value="+252">Somalia (+252)</option>
                                            <option value="+27">South Africa (+27)</option>
                                            <option value="+211">South Sudan (+211)</option>
                                            <option value="+34">Spain (+34)</option>
                                            <option value="+94">Sri Lanka (+94)</option>
                                            <option value="+249">Sudan (+249)</option>
                                            <option value="+597">Suriname (+597)</option>
                                            <option value="+268">Swaziland (+268)</option>
                                            <option value="+46">Sweden (+46)</option>
                                            <option value="+41">Switzerland (+41)</option>
                                            <option value="+963">Syria (+963)</option>
                                            <option value="+886">Taiwan (+886)</option>
                                            <option value="+992">Tajikistan (+992)</option>
                                            <option value="+255">Tanzania (+255)</option>
                                            <option value="+66">Thailand (+66)</option>
                                            <option value="+228">Togo (+228)</option>
                                            <option value="+676">Tonga (+676)</option>
                                            <option value="+1">Trinidad and Tobago (+1)</option>
                                            <option value="+216">Tunisia (+216)</option>
                                            <option value="+90">Turkey (+90)</option>
                                            <option value="+993">Turkmenistan (+993)</option>
                                            <option value="+688">Tuvalu (+688)</option>
                                            <option value="+256">Uganda (+256)</option>
                                            <option value="+380">Ukraine (+380)</option>
                                            <option value="+971">United Arab Emirates (+971)</option>
                                            <option value="+44">United Kingdom (+44)</option>
                                            <option value="+1">United States (+1)</option>
                                            <option value="+598">Uruguay (+598)</option>
                                            <option value="+998">Uzbekistan (+998)</option>
                                            <option value="+678">Vanuatu (+678)</option>
                                            <option value="+379">Vatican City (+379)</option>
                                            <option value="+58">Venezuela (+58)</option>
                                            <option value="+84">Vietnam (+84)</option>
                                            <option value="+967">Yemen (+967)</option>
                                            <option value="+260">Zambia (+260)</option>
                                            <option value="+263">Zimbabwe (+263)</option>
                                        </select>
                                        <input
                                            class="form-control"
                                            id="Mobile_no"
                                            name="Mobile_no"
                                            type="tel"
                                            value="{{ old('Mobile_no') }}"
                                            title="Please enter a valid mobile number in the format XXX-XXX-XXXX"
                                            placeholder="965-453-5432"
                                            pattern="\d{3}-\d{3}-\d{4}"
                                            required
                                        >
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter a valid mobile number.
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="landline">Landline:</label>
                                    <input
                                        class="form-control"
                                        id="landline"
                                        name="landline"
                                        type="tel"
                                        value="{{ old('landline') }}"
                                        placeholder="(XX) YYY ZZZZ"
                                    >
                                    <div class="invalid-feedback">
                                        Please enter a valid landline number.
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="tab-pane py-5"
                    id="step-2"
                    role="tabpanel"
                    aria-labelledby="step-2"
                    style="position: static; left: 0px; display: none;"
                >
                    <!-- Where the business info displayed -->
                    <div class="row g-3">
                        <div class="col-12 col-md-8">
                            <label for="firm_name">Name of Firm: <span class="requiredFields">
                                    *</span></label>
                            <input
                                class="form-control"
                                id="firm_name"
                                name="firm_name"
                                type="text"
                                value="{{ old('firm_name') }}"
                                placeholder="ABC Company"
                                required
                            >
                            <div class="invalid-feedback">
                                Please enter the name of the firm.
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="enterpriseType">Type Of Enterprise <span class="requiredFields">
                                    *</span></label>
                            <select
                                class="form-select"
                                id="enterpriseType"
                                name="enterpriseType"
                                required
                            >
                                <option value="">Select Enterprise</option>
                                <option
                                    value="Sole Proprietorship"
                                >Sole
                                    Proprietorship</option>
                                <option
                                    value="Partnership"
                                >Partnership
                                </option>
                                <option value="Corporation">Corporation</option>
                                {{-- TODO: Edit the Enum values of the database for Non-Profit and Profit --}}
                                {{-- <option
                                    value="Corporation (Non-Profit)"
                                >Corporation (Non-Profit)
                                </option>
                                <option
                                    value="Corporation (Profit)"
                                >Corporation (Profit)
                                </option> --}}
                            </select>
                            <div class="invalid-feedback">
                                Please select a type of enterprise.
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <label for="briefBackground">Brief Enterprise Background: <span class="requiredFields">
                                    *</span></label>
                            <textarea
                                class="form-control"
                                id="briefBackground"
                                name="briefBackground"
                                rows="3"
                                placeholder="Enter Brief Enterprise Background"
                                required
                            ></textarea>
                            <div class="invalid-feedback">
                                Please enter the brief enterprise background.
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="businessPermitNo">Business Permit No.: <span class="requiredFields">
                                    *</span></label>
                            <input
                                class="form-control"
                                id="businessPermitNo"
                                name="businessPermitNo"
                                type="text"
                                value="{{ old('businessPermitNo') }}"
                                placeholder="Enter Business Permit No."
                                required
                            >
                            <div class="invalid-feedback">
                                Please enter the business permit no.
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="yearRegistered">Year Registered: <span class="requiredFields">
                                    *</span></label>
                            <input
                                class="form-control"
                                id="permitYearRegistered"
                                name="permitYearRegistered"
                                type="date"
                                value="{{ old('permitYearRegistered') }}"
                                max="{{ date('Y-m') }}"
                                required
                            >
                            <div class="invalid-feedback">
                                Please enter the year registered.
                            </div>
                        </div>
                      
                        <div class="col-12 col-md-6">
                            <label for="enterpriseRegistrationNo">Enterprise Registration No.: <span class="requiredFields">
                                    *</span></label>
                            <input
                                class="form-control"
                                id="enterpriseRegistrationNo"
                                name="enterpriseRegistrationNo"
                                type="text"
                                value="{{ old('enterpriseRegistrationNo') }}"
                                placeholder="Enter Enterprise Registration No."
                                required
                            >
                            <div class="invalid-feedback">
                                Please enter the enterprise registration no.
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="yearEnterpriseRegistered">Year Enterprise Registered: <span class="requiredFields">
                                    *</span></label>
                            <input
                                class="form-control"
                                id="yearEnterpriseRegistered"
                                name="yearEnterpriseRegistered"
                                type="date"
                                value="{{ old('yearEnterpriseRegistered') }}"
                                max="{{ date('Y-m') }}"
                                required
                            >
                            <div class="invalid-feedback">
                                Please enter the year enterprise registered.
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="initialCapitalization">Initial Capitalization: <span class="requiredFields">
                                    *</span></label>
                            <input
                                class="form-control"
                                id="initialCapitalization"
                                name="initialCapitalization"
                                type="number"
                                value="{{ old('initialCapitalization') }}"
                                placeholder="0.00"
                                required
                            >
                            <div class="invalid-feedback">
                                Please enter the initial capitalization.
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="presentCapitalization">Present Capitalization: <span class="requiredFields">
                                    *</span></label>
                            <input
                                class="form-control"
                                id="presentCapitalization"
                                name="presentCapitalization"
                                type="number"
                                value="{{ old('presentCapitalization') }}"
                                placeholder="0.00"
                                required
                            >
                            <div class="invalid-feedback">
                                Please enter the present capitalization.
                            </div>
                        </div>

                        <div class="card p-0">
                            <div class="card-header fw-bold">
                                Office Address:
                            </div>
                            <div class="card-body">
                                <div class="row gy-3">
                                    <div class="col-12 col-md-3">
                                        <label for="region">Region:<span class="requiredFields">*</span></label>
                                        <select
                                            class="form-select"
                                            id="officeRegion"
                                            name="officeRegion"
                                            required
                                        >
                                            <option value="">Select Region</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a region</div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="province">Province:<span class="requiredFields">*</span></label>
                                        <select
                                            class="form-select"
                                            id="officeProvince"
                                            name="officeProvince"
                                            required
                                            disabled
                                        >
                                            <option value="">Select Province</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a Province</div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="city">City:<span class="requiredFields">*</span></label>
                                        <select
                                            class="form-select"
                                            id="officeCity"
                                            name="officeCity"
                                            required
                                            disabled
                                        >
                                            <option value="">Select City</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a City</div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="barangay">Barangay:<span class="requiredFields">*</span></label>
                                        <select
                                            class="form-select"
                                            id="officeBarangay"
                                            name="officeBarangay"
                                            required
                                            disabled
                                        >
                                            <option value="">Select Barangay</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a Barangey</div>
                                    </div>
                                    <div class="col-12 col-md-10">
                                        <label for="Landmark">Landmark: <span class="requiredFields">
                                                *</span></label>
                                        <input
                                            class="form-control"
                                            id="officeLandmark"
                                            name="officeLandmark"
                                            type="text"
                                            value="{{ old('officeLandmark') }}"
                                            placeholder="Street Name, or Purok, Building No."
                                            required
                                        >
                                        <div class="invalid-feedback">
                                            Please enter the landmark.
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="zipcode">Zip Code: <span class="requiredFields"> *</span">
                                        </label>
                                        <input
                                            class="form-control"
                                            id="officeZipcode"
                                            name="officeZipcode"
                                            type="text"
                                            value="{{ old('officeZipcode') }}"
                                            placeholder="8000"
                                            required
                                        >
                                        <div class="invalid-feedback">
                                            Please enter the zipcode.
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="telNo">Telephone No:</label>
                                        <input
                                            class="form-control"
                                            id="officeTelNo"
                                            name="officeTelNo"
                                            type="text"
                                            value="{{ old('officeTelNo') }}"
                                            placeholder="1234567"
                                        >
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="faxNo">Fax No:</label>
                                        <input
                                            class="form-control"
                                            id="officeFaxNo"
                                            name="officeFaxNo"
                                            type="text"
                                            value="{{ old('officeFaxNo') }}"
                                            placeholder="1234567"
                                        >
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="emailAddress">Email Address:</label>
                                        <input
                                            class="form-control"
                                            id="officeEmailAddress"
                                            name="officeEmailAddress"
                                            type="email"
                                            value="{{ old('emailAddress') }}"
                                            placeholder="example@domain.com"
                                        >
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card p-0">
                            <div class="card-header fw-bold">
                                Factory Address:
                            </div>
                            <div class="card-body">
                                <div class="row gy-3">
                                    <div class="col-12 col-md-3">
                                        <label for="region">Region:<span class="requiredFields">*</span></label>
                                        <select
                                            class="form-select"
                                            id="factoryRegion"
                                            name="factoryRegion"
                                            required
                                        >
                                            <option value="">Select Region</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a region</div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="province">Province:<span class="requiredFields">*</span></label>
                                        <select
                                            class="form-select"
                                            id="factoryProvince"
                                            name="factoryProvince"
                                            required
                                            disabled
                                        >
                                            <option value="">Select Province</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a Province</div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="city">City:<span class="requiredFields">*</span></label>
                                        <select
                                            class="form-select"
                                            id="factoryCity"
                                            name="factoryCity"
                                            required
                                            disabled
                                        >
                                            <option value="">Select City</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a City</div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="barangay">Barangay:<span class="requiredFields">*</span></label>
                                        <select
                                            class="form-select"
                                            id="factoryBarangay"
                                            name="factoryBarangay"
                                            required
                                            disabled
                                        >
                                            <option value="">Select Barangay</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a Barangey</div>
                                    </div>
                                    <div class="col-12 col-md-10">
                                        <label for="Landmark">Landmark: <span class="requiredFields">
                                                *</span></label>
                                        <input
                                            class="form-control"
                                            id="factoryLandmark"
                                            name="factoryLandmark"
                                            type="text"
                                            value="{{ old('factoryLandmark') }}"
                                            placeholder="Street Name, or Purok, Building No."
                                            required
                                        >
                                        <div class="invalid-feedback">
                                            Please enter the landmark.
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="zipcode">Zip Code: <span class="requiredFields"> *</span">
                                        </label>
                                        <input
                                            class="form-control"
                                            id="factoryZipcode"
                                            name="factoryZipcode"
                                            type="text"
                                            value="{{ old('factoryZipcode') }}"
                                            placeholder="8000"
                                            required
                                        >
                                        <div class="invalid-feedback">
                                            Please enter the zipcode.
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="telNo">Telephone No:</label>
                                        <input
                                            class="form-control"
                                            id="factoryTelNo"
                                            name="factoryTelNo"
                                            type="text"
                                            placeholder="1234567"
                                        >
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="faxNo">Fax No:</label>
                                        <input
                                            class="form-control"
                                            id="factoryFaxNo"
                                            name="factoryFaxNo"
                                            type="text"
                                            placeholder="1234567"
                                        >
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="emailAddress">Email Address:</label>
                                        <input
                                            class="form-control"
                                            id="factoryEmailAddress"
                                            name="factoryEmailAddress"
                                            type="email"
                                            placeholder="example@domain.com"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center my-1 g-3">
                        <div class="card p-0">
                            <div class="card-header fw-bold">
                                Assets:
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label for="buildings">Buildings: <span class="requiredFields">
                                                *</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                ₱
                                            </span>
                                            <input
                                                class="form-control"
                                                id="buildings"
                                                name="buildings"
                                                type="text"
                                                value="{{ old('buildings') }}"
                                                placeholder="500,000.00"
                                                required
                                            >
                                        </div>
                                        <div class="invalid-feedback">
                                            Please enter the value of buildings.
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="equipments">Equipments: <span class="requiredFields">
                                                *</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                ₱
                                            </span>
                                            <input
                                                class="form-control"
                                                id="equipments"
                                                name="equipments"
                                                type="text"
                                                value="{{ old('equipments') }}"
                                                placeholder="500,000.00"
                                                required
                                            >
                                        </div>
                                        <div class="invalid-feedback">
                                            Please enter the value of equipments.
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="working_capital">Working Capital: <span class="requiredFields">
                                                *</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                ₱
                                            </span>
                                            <input
                                                class="form-control"
                                                id="working_capital"
                                                name="working_capital"
                                                type="text"
                                                value="{{ old('working_capital') }}"
                                                placeholder="500,000.00"
                                                required
                                            >
                                        </div>
                                        <div class="invalid-feedback">
                                            Please enter the value of working capital.
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-center mt-3">
                                    <div class="col-12 col-md-6">
                                        <p class="fw-normal">Total Assets: <span id="to_Assets"></span></p>

                                    </div>
                                    <div class="col-12 col-md-6">
                                        <p class="fw-normal">Enterprise Level: <span id="Enterprise_Level"></span>
                                        </p>

                                    </div>
                                </div>
                                <input
                                    id="EnterpriseLevelInput"
                                    name="enterprise_level"
                                    type="hidden"
                                >
                            </div>
                        </div>
                        <div class="card p-0">
                            <div class="card-header fw-bold">
                                Business Activity
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Business Activity:</label>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="form-check mr-3">
                                            <input class="form-check-input" type="checkbox" name="foodProcessing" id="foodProcessing">
                                        </div>
                                        <label class="form-check-label flex-grow-1" for="foodProcessing">
                                            Food processing (please specify specific sector)
                                        </label>
                                        <input type="text" class="form-control ml-3" name="foodProcessingSpecificSector" id="foodProcessingSpecificSector" style="max-width: 300px;">
                                    </div>
                        
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="form-check mr-3">
                                            <input class="form-check-input" type="checkbox" name="furniture" id="furniture">
                                        </div>
                                        <label class="form-check-label flex-grow-1" for="furniture">
                                            Furniture (please specify specific sector)
                                        </label>
                                        <input type="text" class="form-control ml-3" name="furnitureSpecificSector" id="furnitureSpecificSector" style="max-width: 300px;">
                                    </div>
                        
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="form-check mr-3">
                                            <input class="form-check-input" type="checkbox" name="naturalFibers" id="naturalFibers">
                                        </div>
                                        <label class="form-check-label flex-grow-1" for="naturalFibers">
                                            Natural fibers, gifts and home decors and fashion accessories (please specify specific sector)
                                        </label>
                                        <input type="text" class="form-control ml-3" name="naturalFibersSpecificSector" id="naturalFibersSpecificSector" style="max-width: 300px;">
                                    </div>
                        
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="form-check mr-3">
                                            <input class="form-check-input" type="checkbox" name="metals" id="metals">
                                        </div>
                                        <label class="form-check-label flex-grow-1" for="metals">
                                            Metals and engineering (please specify specific sector)
                                        </label>
                                        <input type="text" class="form-control ml-3" name="metalsSpecificSector" id="metalsSpecificSector" style="max-width: 300px;">
                                    </div>
                        
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="form-check mr-3">
                                            <input class="form-check-input" type="checkbox" name="aquatic" id="aquatic">
                                        </div>
                                        <label class="form-check-label flex-grow-1" for="aquatic">
                                            Aquatic and marine resources (please specify specific sector)
                                        </label>
                                        <input type="text" class="form-control ml-3" name="aquaticSpecificSector" id="aquaticSpecificSector" style="max-width: 300px;">
                                    </div>
                        
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="form-check mr-3">
                                            <input class="form-check-input" type="checkbox" name="horticulture" id="horticulture">
                                        </div>
                                        <label class="form-check-label flex-grow-1" for="horticulture">
                                            Horticulture/Agriculture (please specify specific sector)
                                        </label>
                                        <input type="text" class="form-control ml-3" name="horticultureSpecificSector" style="max-width: 300px;">
                                    </div>
                        
                                    <div class="d-flex align-items-center">
                                        <div class="form-check mr-3">
                                            <input class="form-check-input" type="checkbox" name="others" id="others">
                                        </div>
                                        <label class="form-check-label flex-grow-1" for="others">
                                            Others, please specify
                                        </label>
                                        <input type="text" class="form-control ml-3" name="othersSpecificSector" style="max-width: 300px;">
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label" for="specificProductOrService">
                                            1. Specific product or service the enterprise offers its customers:
                                        </label>
                                        <textarea class="form-control" id="specificProductOrService" name="specificProductOrService" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label" for="reasonsWhyAssistanceIsBeingSought">
                                           2. Reasons why assistance is being sought:
                                        </label>
                                        <textarea class="form-control" id="reasonsWhyAssistanceIsBeingSought" name="reasonsWhyAssistanceIsBeingSought" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">
                                            3. Have you consulted any other individual/organization on any assistance?
                                        </label>
                                        <div class="ms-3">
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="consultationAnswer" id="consultationYes" value="yes">
                                                    <label class="form-check-label" for="consultationYes">
                                                        Yes, from what company/agency
                                                    </label>
                                                </div>
                                                <input type="text" class="form-control consultation-input" id="fromWhatCompanyAgency" name="fromWhatCompanyAgency">
                                                <label class="form-label mt-2">Please specify the type of assistance sought</label>
                                                <textarea class="form-control consultation-input" id="pleaseSpecifyTheTypeOfAssistanceSought" name="pleaseSpecifyTheTypeOfAssistanceSought" rows="3"></textarea>
                                            </div>
                                            
                                            <div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="consultationAnswer" id="consultationNo" value="no">
                                                    <label class="form-check-label" for="consultationNo">
                                                        No, why not?
                                                    </label>
                                                </div>
                                                <textarea class="form-control consultation-input" id="whyNot" name="whyNot" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label" for="enterprisePlanForTheNext5Years">
                                            4. Enterprise plan for the next 5 years:
                                        </label>
                                        <textarea class="form-control" id="enterprisePlanForTheNext5Years" name="enterprisePlanForTheNext5Years" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label ms-2" for="nextTenYears">
                                            Next 10 years?
                                        </label>
                                        <textarea class="form-control" id="nextTenYears" name="nextTenYears" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label" for="currentAgreementAndAlliancesUndertaken">
                                            5. Current agreement and alliances undertaken:
                                        </label>
                                        <textarea class="form-control" id="currentAgreementAndAlliancesUndertaken" name="currentAgreementAndAlliancesUndertaken" rows="3"></textarea>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                        <div class="card p-0">
                            <div class="card-header fw-bold">
                                BENCHMARK INFORMATION
                            </div>
                            <div class="card-body" >
                                <hr>
                                <h6 class="my-4">*Product and Supply Chain</h6>
                                <hr>
                                <div id="productAndSupplyChainContainer">
                                    <div class="mt-2">
                                        <div
                                            class="d-flex justify-content-end p-2 addAndRemoveButton_Container">
                                            <button
                                                class="btn btn-primary addProductAndSupplyChainRow"
                                                data-toggle="tooltip"
                                                type="button"
                                                title="Add a new row"
                                            >
                                                <i class="ri-add-box-fill"></i>
                                            </button>
                                            <button
                                                class="btn btn-danger removeRowButton mx-2"
                                                data-toggle="tooltip"
                                                type="button"
                                                title="Delete row"
                                                disabled
                                            >
                                                <i class="ri-subtract-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="productAndSupplyChainTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Raw Material</th>
                                                    <th scope="col">Source</th>
                                                    <th scope="col">Unit Cost (₱)</th>
                                                    <th scope="col">Volume Used/Year</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control RawMaterial" />
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control Source" />
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control UnitCost" />
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control VolumeUsed" />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <h6 class="my-4">*Production</h6>
                                <hr>
                                <div id="productionContainer">

                                    <div class="mt-2">
                                        <div
                                            class="d-flex justify-content-end p-2 addAndRemoveButton_Container">
                                            <button
                                                class="btn btn-primary addProductionRow"
                                                data-toggle="tooltip"
                                                type="button"
                                                title="Add a new row"
                                            >
                                                <i class="ri-add-box-fill"></i>
                                            </button>
                                            <button
                                                class="btn btn-danger removeRowButton mx-2"
                                                data-toggle="tooltip"
                                                type="button"
                                                title="Delete row"
                                                disabled
                                            >
                                                <i class="ri-subtract-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="productionTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Product</th>
                                                    <th scope="col">Volume of Production/Year</th>
                                                    <th scope="col">Unit Cost of Production (₱)</th>
                                                    <th scope="col">Annual Cost of Production (₱)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control Product" />
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control VolumeProduction" />
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control UnitCost" />
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control AnnualCost" />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <h6 class="my-4">*Production Equipment</h6>
                                <hr>
                                <div id="productionEquipmentContainer">
                                    <div class="mt-2">
                                        <div
                                            class="d-flex justify-content-end p-2 addAndRemoveButton_Container">
                                            <button
                                                class="btn btn-primary addProductionEquipmentRow"
                                                data-toggle="tooltip"
                                                type="button"
                                                title="Add a new row"
                                            >
                                                <i class="ri-add-box-fill"></i>
                                            </button>
                                            <button
                                                class="btn btn-danger removeRowButton mx-2"
                                                data-toggle="tooltip"
                                                type="button"
                                                title="Delete row"
                                                disabled
                                            >
                                                <i class="ri-subtract-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="productionEquipmentTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Type of Equipment</th>
                                                    <th scope="col">Specification</th>
                                                    <th scope="col">Capacity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control TypeOfEquipment" />
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control Specification" />
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control Capacity" />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row gy-3">
                                    <div class="col-12">
                                        <label for="ProductionProblemAndConcern" class="form-label">-Production Problem and Concern</label>
                                        <textarea class="form-control" id="ProductionProblemAndConcern" name="ProductionProblemAndConcern" rows="3"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="ProductionWasteManageSystem" class="form-label">-Production Waste Management System</label>
                                        <textarea class="form-control" id="ProductionWasteManageSystem" name="ProductionWasteManageSystem" rows="3"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="ProductionPlan" class="form-label">-Production Plan</label>
                                        <textarea class="form-control" id="ProductionPlan" name="ProductionPlan" rows="3"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="InventorySystem" class="form-label">-Inventory System</label>
                                        <textarea class="form-control" id="InventorySystem" name="InventorySystem" rows="3"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="MaintenanceProgram" class="form-label">-Maintenance Program</label>
                                        <textarea class="form-control" id="MaintenanceProgram" name="MaintenanceProgram" rows="3"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="cGMPHACCPActivities" class="form-label">-cGMP/HACCP Activities</label>
                                        <textarea class="form-control" id="cGMPHACCPActivities" name="cGMPHACCPActivities" rows="3"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="SuppliesPurchasingSystem" class="form-label">-Supplies/Purchasing System</label>
                                        <textarea class="form-control" id="SuppliesPurchasingSystem" name="SuppliesPurchasingSystem" rows="3"></textarea>
                                    </div>
                                </div>
                                <hr>
                                <h6  class="my-4">*Marketing</h6>
                                <hr>
                                <div class="row gy-3">
                                    <div class="col-12">
                                        <label for="MarketingPlan" class="form-label">-Marketing Plan</label>
                                        <textarea class="form-control" id="MarketingPlan" name="MarketingPlan" rows="3"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="MarketOutletsAndNumber" class="form-label">-Market Outlets and Number</label>
                                        <textarea class="form-control" id="MarketOutletsAndNumber" name="MarketOutletsAndNumber" rows="3"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="PromotionalStrategies" class="form-label">-Promotional Strategies</label>
                                        <textarea class="form-control" id="PromotionalStrategies" name="PromotionalStrategies" rows="3"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="MarketCompetitors" class="form-label">-Market Competitors</label>
                                        <textarea class="form-control" id="MarketCompetitors" name="MarketCompetitors" rows="3"></textarea>
                                    </div>
                                    <h6>-Packaging</h6>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" id="nutritionEvaluation" name="nutritionEvaluation">
                                                    <label class="form-check-label" for="nutritionEvaluation">
                                                        Nutrition Evaluation
                                                    </label>
                                                </div>
                                                <input type="text" class="form-control mt-2 ms-2" id="nutritionEvaluationDetails" name="nutritionEvaluationDetails">
                                            </div>
                                            <div class="form-group">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" id="barCode" name="barCode">
                                                    <label class="form-check-label" for="barCode">
                                                        Bar Code
                                                    </label>
                                                </div>
                                                <input type="text" class="form-control mt-2 ms-2" id="barCodeDetails" name="barCodeDetails">
                                            </div>

                                            <div class="form-group">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" id="productLabel" name="productLabel">
                                                    <label class="form-check-label" for="productLabel">
                                                        Product Label
                                                    </label>
                                                </div>
                                                <input type="text" class="form-control mt-2 ms-2" id="productLabelDetails" name="productLabelDetails">
                                            </div>

                                            <div class="form-group">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" id="expiryDate" name="expiryDate">
                                                    <label class="form-check-label" for="expiryDate">
                                                        Expiry Date
                                                    </label>
                                                </div>
                                                <input type="text" class="form-control mt-2 ms-2" id="expiryDateDetails" name="expiryDateDetails">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <hr>
                                <h6 class="my-4">Finance</h6>
                                <hr>
                                <div class="row gy-3">
                                    <div class="col-12">
                                        <label class="form-label" for="CashFlowAndRelatedDocuments">
                                            Cash Flow or other related documents:
                                        </label>
                                        <textarea class="form-control" id="CashFlowAndRelatedDocuments" name="CashFlowAndRelatedDocuments" rows="3"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="SourceOfCapitalCredit">
                                            Source(s) of capital/credit:
                                        </label>
                                        <textarea class="form-control" id="SourceOfCapitalCredit" name="SourceOfCapitalCredit" rows="3"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="AccountingSystem">
                                            Accounting System:
                                        </label>
                                        <textarea class="form-control" id="AccountingSystem" name="AccountingSystem" rows="3"></textarea>
                                    </div>
                                    

                                </div>
                                <hr>
                                <h6 class="my-4">Finance</h6>
                                <hr>
                                <div class="row gy-3">
                                    <div class="col-12">
                                        <label class="form-label" for="HiringAndCriteria">
                                            Hiring and Criteria:
                                        </label>
                                        <textarea class="form-control" id="HiringAndCriteria" name="HiringAndCriteria" rows="3"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="IncentivesToEmployees">
                                            Incentives to Employees:
                                        </label>
                                        <textarea class="form-control" id="IncentivesToEmployees" name="IncentivesToEmployees" rows="3"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="TrainingAndDevelopment">
                                            Training and Development:
                                        </label>
                                        <textarea class="form-control" id="TrainingAndDevelopment" name="TrainingAndDevelopment" rows="3"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="SafetyMeasuresPracticed">
                                            Safety Measures Practiced:
                                        </label>
                                        <textarea class="form-control" id="SafetyMeasuresPracticed" name="SafetyMeasuresPracticed" rows="3"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="OtherEmployeeWelfare">
                                            Other Employee Welfare:
                                        </label>
                                        <textarea class="form-control" id="OtherEmployeeWelfare" name="OtherEmployeeWelfare" rows="3"></textarea>
                                    </div>
                                </div>
                                <hr>
                                <h6 class="my-4">Other Concerns</h6>
                                <hr>
                                <div class="row gy-3">
                                    <div class="col-12">
                                        <label class="form-label" for="OtherConcerns">
                                            Other Concerns:
                                        </label>
                                        <textarea class="form-control" id="OtherConcerns" name="OtherConcerns" rows="3"></textarea>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="row p-0 mt-0 g-3">
                            <div class="col-12 p-0">
                                <div class="card">
                                    <div class="card-header fw-bold">
                                        Number of Personnel Direct(Production):
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-8">
                                                <div
                                                    class="alert alert-primary"
                                                    role="alert"
                                                >
                                                    <h5 class="alert-heading"> <i class="ri-information-2-fill"></i>
                                                        Direct Personnel
                                                    </h5>
                                                    <p>Direct personnel are those who are actively involved in the
                                                        production process of the products, an example are
                                                        operators, assemblers, and quality control inspectors.</p>
                                                    <hr>
                                                    <p class="mb-0 text-secondary text-small">You may enter zero if
                                                        none
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                Regular
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="col-12">
                                                                    <label for="m_personelDiRe">Male:
                                                                    </label>
                                                                    <input
                                                                        class="form-control num_only"
                                                                        id="m_personnelDiRe"
                                                                        name="m_personnelDiRe"
                                                                        type="text"
                                                                        value="{{ old('m_personnelDiRe') }}"
                                                                        placeholder="No. Male Regular"
                                                                        pattern="[0-9]"
                                                                    >

                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="f_personnelDiRe">Female:
                                                                    </label>
                                                                    <input
                                                                        class="form-control num_only"
                                                                        id="f_personnelDiRe"
                                                                        name="f_personnelDiRe"
                                                                        type="text"
                                                                        value="{{ old('f_personnelDiRe') }}"
                                                                        placeholder="No. Female Regular"
                                                                        pattern="[0-9]"
                                                                    >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                Part-time
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="col-12">
                                                                    <label for="m_personnelDiPart">Male:
                                                                    </label>
                                                                    <input
                                                                        class="form-control num_only"
                                                                        id="m_personnelDiPart"
                                                                        name="m_personnelDiPart"
                                                                        type="text"
                                                                        value="{{ old('m_personnelDiPart') }}"
                                                                        placeholder="No. Male Part-time"
                                                                        pattern="[0-9]"
                                                                    >
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="f_personnelDiPart">Female:
                                                                    </label>
                                                                    <input
                                                                        class="form-control num_only"
                                                                        id="f_personnelDiPart"
                                                                        name="f_personnelDiPart"
                                                                        type="text"
                                                                        value="{{ old('f_personnelDiPart') }}"
                                                                        placeholder="Number of Female Part-time"
                                                                        pattern="[0-9]"
                                                                    >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 p-0">
                                <div class="card p-0">
                                    <div class="card-header fw-bold">
                                        Number of Personnel Indirect(Admin and Marketing):
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-8">
                                                <div
                                                    class="alert alert-primary"
                                                    role="alert"
                                                >
                                                    <h5 class="alert-heading"> <i class="ri-information-2-fill"></i>
                                                        Indirect Personnel
                                                    </h5>
                                                    <p>Indirect personnel are those who are not actively involved in
                                                        the production process of the products, such as
                                                        administrative staff, managers, and maintenance workers.</p>
                                                    <hr>
                                                    <p class="mb-0 text-secondary text-small">You may enter zero if
                                                        none</p>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                Regular
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="col-12">
                                                                    <label for="m_personnelIndRe">Male:
                                                                    </label>
                                                                    <input
                                                                        class="form-control num_only"
                                                                        id="m_personnelIndRe"
                                                                        name="m_personnelIndRe"
                                                                        type="text"
                                                                        value="{{ old('m_personnelIndRe') }}"
                                                                        placeholder="No. Male Regular"
                                                                        pattern="[0-9]"
                                                                    >

                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="f_personnelIndRe">Female:
                                                                    </label>
                                                                    <input
                                                                        class="form-control num_only"
                                                                        id="f_personnelIndRe"
                                                                        name="f_personnelIndRe"
                                                                        type="text"
                                                                        value="{{ old('f_personnelIndRe') }}"
                                                                        placeholder="No. Female Regular"
                                                                        pattern="[0-9]"
                                                                    >

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                Part-time
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="col-12">
                                                                    <label for="m_personnelIndPart">Male</label>
                                                                    <input
                                                                        class="form-control num_only"
                                                                        id="m_personnelIndPart"
                                                                        name="m_personnelIndPart"
                                                                        type="text"
                                                                        value="{{ old('m_personnelIndPart') }}"
                                                                        placeholder="No. Male Part-time"
                                                                        pattern="[0-9]"
                                                                    >

                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="f_personnelIndPart">Female</label>
                                                                    <input
                                                                        class="form-control num_only"
                                                                        id="f_personnelIndPart"
                                                                        name="f_personnelIndPart"
                                                                        type="text"
                                                                        value="{{ old('f_personnelIndPart') }}"
                                                                        placeholder="Number of Female Part-time"
                                                                        pattern="[0-9]"
                                                                    >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3 p-0">
                            <div class="card">
                                <div class="card-header fw-bold">
                                    Market Outlet
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div
                                                class="alert alert-primary"
                                                role="alert"
                                            >
                                                <i class="ri-information-2-fill ri-lg"></i>
                                                Please input the Products name for the Export and Local Market
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 mb-4"
                                            id="localMarketContainer"
                                        >
                                            <h5>Local Market Products</h5>
                                            <div class="mt-2">
                                                <div
                                                    class="d-flex justify-content-end p-2 addAndRemoveButton_Container">
                                                    <button
                                                        class="btn btn-primary addNewProductRow"
                                                        data-toggle="tooltip"
                                                        type="button"
                                                        title="Add a new row"
                                                    >
                                                        <i class="ri-add-box-fill"></i>
                                                    </button>
                                                    <button
                                                        class="btn btn-danger removeRowButton mx-2"
                                                        data-toggle="tooltip"
                                                        type="button"
                                                        title="Delete row"
                                                        disabled
                                                    >
                                                        <i class="ri-subtract-fill"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-bordered"
                                                    id="localMarketTable"
                                                >
                                                    <thead>
                                                        <tr>
                                                            <th>Enterprise Location</th>
                                                            <th>Sell Product</th>
                                                            <th>Volume</th>
                                                            <th>Unit</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><input
                                                                    class="form-control location"
                                                                    type="text"
                                                                    placeholder="Enter location"
                                                                ></td>
                                                            <td><input
                                                                    class="form-control product"
                                                                    type="text"
                                                                    placeholder="Enter product"
                                                                ></td>
                                                            <td><input
                                                                    class="form-control volume"
                                                                    type="number"
                                                                    placeholder="Enter volume"
                                                                ></td>
                                                            <td>
                                                                <select class="form-select unit">
                                                                    <option value="kg">Kilogram (kg)</option>
                                                                    <option value="g">Gram (g)</option>
                                                                    <option value="l">Liter (L)</option>
                                                                    <option value="ml">Milliliter (ml)</option>
                                                                    <option value="pcs">Pieces (pcs)</option>
                                                                    <option value="dozen">Dozen</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div
                                            class="col-12"
                                            id="exportMarketContainer"
                                        >
                                            <h5>Export Market Products</h5>
                                            <div class="mt-2">
                                                <div
                                                    class="d-flex justify-content-end p-2 addAndRemoveButton_Container">
                                                    <button
                                                        class="btn btn-primary addNewProductRow"
                                                        data-toggle="tooltip"
                                                        type="button"
                                                        title="Add a new row"
                                                    >
                                                        <i class="ri-add-box-fill"></i>
                                                    </button>
                                                    <button
                                                        class="btn btn-danger removeRowButton mx-2"
                                                        data-toggle="tooltip"
                                                        type="button"
                                                        title="Delete row"
                                                        disabled
                                                    >
                                                        <i class="ri-subtract-fill"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-bordered"
                                                    id="exportMarketTable"
                                                >
                                                    <thead>
                                                        <tr>
                                                            <th>Enterprise Location</th>
                                                            <th>Sell Product</th>
                                                            <th>Volume</th>
                                                            <th>Unit</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><input
                                                                    class="form-control location"
                                                                    type="text"
                                                                    placeholder="Enter location"
                                                                ></td>
                                                            <td><input
                                                                    class="form-control product"
                                                                    type="text"
                                                                    placeholder="Enter product"
                                                                ></td>
                                                            <td><input
                                                                    class="form-control volume"
                                                                    type="number"
                                                                    placeholder="Enter volume"
                                                                ></td>
                                                            <td>
                                                                <select class="form-select unit">
                                                                    <option value="kg">Kilogram (kg)</option>
                                                                    <option value="g">Gram (g)</option>
                                                                    <option value="l">Liter (L)</option>
                                                                    <option value="ml">Milliliter (ml)</option>
                                                                    <option value="pcs">Pieces (pcs)</option>
                                                                    <option value="dozen">Dozen</option>
                                                                </select>
                                                            </td>

                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="tab-pane py-5"
                    id="step-3"
                    role="tabpanel"
                    aria-labelledby="step-3"
                    style="position: static; left: 0px; display: none; "
                >
                    <h3>Upload the Following Requirements:</h3>
                    <div class="row mb-12 p-5">
                        <div class="mb-3">
                            <label
                                class="form-label"
                                for="IntentFile"
                            >Letter of Intent:
                                <span
                                    class="requiredFields">{{ auth()->user()->hasRole('Cooperator') ? '*' : '' }}</span>
                            </label>
                            <input
                                class="fileUploads"
                                id="IntentFile"
                                name="IntentFile"
                                type="file"
                                accept="application/pdf"
                                {{ auth()->user()->hasRole('Cooperator') ? 'required' : '' }}
                            >
                            <div class="invalid-feedback">
                                Please upload the Letter of Intent.
                            </div>
                            <div class="form-text">Accepted formats: .pdf. Maximum file size: 10MB</div>
                        </div>
                        <div class="mb-3">
                            <label
                                class="form-label"
                                for="DtiSecCdafile"
                            >DTI/SEC/CDA
                                <span class="form-text">(Certificate of Registration):</span>
                                <span
                                    class="requiredFields">{{ auth()->user()->hasRole('Cooperator') ? '*' : '' }}</span>
                            </label>
                            <div class="row">
                                <div class="col-2 d-flex align-items-center justify-content-center">
                                    <select
                                        class="form-select form-select-lg"
                                        id="DtiSecCdaSelector"
                                        name="DSC_file_Selector"
                                    >
                                        <option value="">Choose...</option>
                                        <option value="DTI">DTI</option>
                                        <option value="SEC">SEC</option>
                                        <option value="CDA">CDA</option>
                                    </select>
                                </div>
                                <div
                                    class="col-10"
                                    id="DtiSecCdaContainer"
                                >
                                    <input
                                        class="fileUploads"
                                        id="DTI_SEC_CDA_File"
                                        name="DTI_SEC_CDA_File"
                                        type="file"
                                        {{ auth()->user()->hasRole('Cooperator') ? 'required' : '' }}
                                    >
                                    <div class="invalid-feedback">
                                        Please upload the DTI/SEC/CDA document.
                                    </div>
                                </div>
                            </div>
                            <div class="form-text">Choose 1 out of 3 documents above. the accepted formats: .pdf.
                                Maximum file size: 10MB
                            </div>
                        </div>
                        <div class="mb-3">
                            <label
                                class="form-label"
                                for="businessPermitFile"
                            >Business Permit:
                                <span
                                    class="requiredFields">{{ auth()->user()->hasRole('Cooperator') ? '*' : '' }}</span>
                            </label>
                            <input
                                class="fileUploads"
                                id="businessPermitFile"
                                name="businessPermitFile"
                                type="file"
                                {{ auth()->user()->hasRole('Cooperator') ? 'required' : '' }}
                            >
                            <div class="invalid-feedback">
                                Please upload the Business Permit.
                            </div>
                            <div class="form-text">Accepted formats: .pdf.</div>
                        </div>
                        <div class="mb-3">
                            <label
                                class="form-label"
                                for="fdaLtoFile"
                            >FDA/LTO
                                <span class="form-text">(Certificate of Registration):</span>
                                <span class="fw-lighter">
                                    (if Applicable)
                                </span>
                                <span class="form-text text-secondary fw-lighter">
                                    Food and Drug Administration(FDA) or Food and Drug Administration(LTO)
                                </span>
                            </label>
                            <div class="row">
                                <div class="col-2 d-flex align-items-center justify-content-center">
                                    <select
                                        class="form-select form-select-lg"
                                        id="fdaLtoSelector"
                                        name="Fda_Lto_Selector"
                                    >
                                        <option value="">Choose...</option>
                                        <option value="FDA">FDA</option>
                                        <option value="LTO">LTO</option>
                                    </select>
                                </div>
                                <div class="col-10">
                                    <input
                                        class="fileUploads"
                                        id="fdaLtoFile"
                                        name="fdaLtoFile"
                                        type="file"
                                    >
                                </div>
                            </div>
                            <div class="form-text">Choose 1 out of 2 documents above. the accepted formats: .pdf
                                Maximum file size: 10MB
                            </div>
                        </div>
                        <div class="mb-3">
                            <label
                                class="form-label"
                                for="receiptFile"
                            >Official Receipt of the Business:
                                <span
                                    class="requiredFields">{{ auth()->user()->hasRole('Cooperator') ? '*' : '' }}</span>
                            </label>
                            <input
                                class="fileUploads"
                                id="receiptFile"
                                name="receiptFile"
                                type="file"
                                {{ auth()->user()->hasRole('Cooperator') ? 'required' : '' }}
                            >
                            <div class="invalid-feedback">
                                Please upload the Official Receipt of the Business.
                            </div>
                            <div class="form-text">Accepted formats: .pdf.</div>
                        </div>
                        <div class="mb-3">
                            <label
                                class="form-label"
                                for="govIdFile"
                            >Government Valid ID:
                                <span
                                    class="requiredFields">{{ auth()->user()->hasRole('Cooperator') ? '*' : '' }}</span>
                            </label>
                            <div class="row">
                                <div class="col-2 d-flex align-items-center justify-content-center">
                                    <Select
                                        class="form-select form-select-lg"
                                        id="GovIdSelector"
                                        name="GovIdSelector"
                                    >
                                        <option value="">Choose...</option>
                                        <option value="National ID">National ID</option>
                                        <option value="SSS ID">SSS UMID</option>
                                        <option value="GSIS ID">GSIS UMID</option>
                                        <option value="Passport ID">Philippine Passport</option>
                                    </Select>
                                </div>
                                <div class="col-10">
                                    <input
                                        class="fileUploads"
                                        id="govIdFile"
                                        name="govIdFile"
                                        type="file"
                                        capture="environment"
                                        {{ auth()->user()->hasRole('Cooperator') ? 'required' : '' }}
                                    >
                                    <div class="invalid-feedback">
                                        Please upload the Copy of Government Valid ID.
                                    </div>
                                    <div class="form-text">Accepted formats: .jpeg, .png. Maximum file size: 10MB</div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label
                                class="form-label"
                                for="BIRFile"
                            >BIR
                                <span class="form-text">(Certificate of Registration):</span>
                                <span
                                    class="requiredFields">{{ auth()->user()->hasRole('Cooperator') ? '*' : '' }}</span>
                                <span class="form-text text-secondary fw-lighter">
                                    Bureau of Internal Revenue(BIR) Certificate of Registration
                                </span>
                            </label>
                            <input
                                class="fileUploads"
                                id="BIRFile"
                                name="BIRFile"
                                type="file"
                                {{ auth()->user()->hasRole('Cooperator') ? 'required' : '' }}
                            >
                            <div class="form-text">Accepted formats: .pdf. Maximum file size: 10MB</div>
                            <div class="invalid-feedback">
                                Please upload the BIR.
                            </div>
                        </div>
                        <div
                            class="alert alert-primary m-0"
                            role="alert"
                        >
                            <i class="ri-information-2-fill ri-lg"></i>
                            Please, before you proceed to the next step, make sure you have double-checked all the
                            uploaded files.
                        </div>
                        <input
                            id="IntentFileID_Data_Handler"
                            name="IntentFileID_Data_Handler"
                            type="hidden"
                        >
                        <input
                            id="DtiSecCdaFileID_Data_Handler"
                            name="DtiSecCdaFileID_Data_Handler"
                            type="hidden"
                        >
                        <input
                            id="BusinessPermitFileID_Data_Handler"
                            name="BusinessPermitFileID_Data_Handler"
                            type="hidden"
                        >
                        <input
                            id="FdaLtoFileID_Data_Handler"
                            name="FdaLtoFileID_Data_Handler"
                            type="hidden"
                        >
                        <input
                            id="ReceiptFileID_Data_Handler"
                            name="ReceiptFileID_Data_Handler"
                            type="hidden"
                        >
                        <input
                            id="GovIdFileID_Data_Handler"
                            name="GovIdFileID_Data_Handler"
                            type="hidden"
                        >
                        <input
                            id="BIRFileID_Data_Handler"
                            name="BIRFileID_Data_Handler"
                            type="hidden"
                        >
                    </div>
                </div>
                <div
                    class="tab-pane py-5"
                    id="step-4"
                    role="tabpanel"
                    aria-labelledby="step-4"
                    style="position: static; left: 0px; display: none;"
                >
                    <div class="row mb-3">
                        <div class="col-md-12 mb-4">
                            <h5>Review and confirm the details provided before submission.</h5>
                        </div>
                        <div class="row gy-3">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        Personal Infomation
                                    </div>
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <div class="col-12 col-md-6">
                                                <label for="re_full_name">Full Name</label>
                                                <input
                                                    class="form-control mb-3"
                                                    id="re_Full_name"
                                                    type="text"
                                                    readonly
                                                >
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="designa">Designation</label>
                                                <input
                                                    class="form-control mb-3"
                                                    id="re_designa"
                                                    type="text"
                                                    readonly
                                                >
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <label for="b_Date">Birth Date</label>
                                                <input
                                                    class="form-control mb-3"
                                                    id="re_b_Date"
                                                    type="text"
                                                    readonly
                                                >
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="Mobile_no">Mobile Number</label>
                                                <input
                                                    class="form-control mb-3"
                                                    id="re_Mobile_no"
                                                    type="text"
                                                    readonly
                                                >
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="landline">Landline</label>
                                                <input
                                                    class="form-control mb-3"
                                                    id="re_landline"
                                                    type="text"
                                                    readonly
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        Business Information
                                    </div>
                                    <div class="card-body">
                                        <div class="row gy-3">
                                            <div class="col-12 col-md-8">
                                                <label for="firm_name">Firm Name</label>
                                                <input
                                                    class="form-control mb-3"
                                                    id="re_firm_name"
                                                    type="text"
                                                    readonly
                                                >

                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="type_enterprise">Type of Enterprise</label>
                                                <input
                                                    class="form-control mb-3"
                                                    id="re_type_enterprise"
                                                    type="text"
                                                    readonly
                                                >
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <label for="briefBackground">Brief Enterprise Background: <span class="requiredFields">
                                                        *</span></label>
                                                <textarea
                                                    class="form-control"
                                                    id="re_briefBackground"
                                                    name="briefBackground"
                                                    rows="3"
                                                    readonly
                                                ></textarea>
                                                <div class="invalid-feedback">
                                                    Please enter the brief enterprise background.
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="businessPermitNo">Business Permit No.: <span class="requiredFields">
                                                        *</span></label>
                                                <input
                                                    class="form-control"
                                                    id="re_businessPermitNo"
                                                    name="businessPermitNo"
                                                    type="text"
                                                    value="{{ old('businessPermitNo') }}"
                                                    readonly
                                                >
                                                <div class="invalid-feedback">
                                                    Please enter the business permit no.
                                                </div>
                                            </div>
                    
                                            <div class="col-12 col-md-6">
                                                <label for="yearRegistered">Year Registered: <span class="requiredFields">
                                                        *</span></label>
                                                <input
                                                    class="form-control"
                                                    id="re_yearRegistered"
                                                    name="yearRegistered"
                                                    type="date"
                                                    value="{{ old('yearRegistered') }}"
                                                    max="{{ date('Y-m') }}"
                                                    readonly
                                                >
                                                <div class="invalid-feedback">
                                                    Please enter the year registered.
                                                </div>
                                            </div>
                                          
                                            <div class="col-12 col-md-6">
                                                <label for="enterpriseRegistrationNo">Enterprise Registration No.: <span class="requiredFields">
                                                        *</span></label>
                                                <input
                                                    class="form-control"
                                                    id="re_enterpriseRegistrationNo"
                                                    name="enterpriseRegistrationNo"
                                                    type="text"
                                                    value="{{ old('enterpriseRegistrationNo') }}"
                                                    readonly
                                                >
                                                <div class="invalid-feedback">
                                                    Please enter the enterprise registration no.
                                                </div>
                                            </div>
                    
                                            <div class="col-12 col-md-6">
                                                <label for="yearEnterpriseRegistered">Year Enterprise Registered: <span class="requiredFields">
                                                        *</span></label>
                                                <input
                                                    class="form-control"
                                                    id="re_yearEnterpriseRegistered"
                                                    name="yearEnterpriseRegistered"
                                                    type="date"
                                                    value="{{ old('yearEnterpriseRegistered') }}"
                                                    max="{{ date('Y-m') }}"
                                                    readonly
                                                >
                                                <div class="invalid-feedback">
                                                    Please enter the year enterprise registered.
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="initialCapitalization">Initial Capitalization: <span class="requiredFields">
                                                        *</span></label>
                                                <input
                                                    class="form-control"
                                                    id="re_initialCapitalization"
                                                    name="initialCapitalization"
                                                    type="number"
                                                    value="{{ old('initialCapitalization') }}"
                                                    readonly
                                                >
                                                <div class="invalid-feedback">
                                                    Please enter the initial capitalization.
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="presentCapitalization">Present Capitalization: <span class="requiredFields">
                                                        *</span></label>
                                                <input
                                                    class="form-control"
                                                    id="re_presentCapitalization"
                                                    name="presentCapitalization"
                                                    type="number"
                                                    value="{{ old('presentCapitalization') }}"
                                                    readonly
                                                >
                                                <div class="invalid-feedback">
                                                    Please enter the present capitalization.
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label
                                                    class="fw-bold"
                                                    for="Address"
                                                >Office Address</label>
                                                <input
                                                    class="form-control mb-3"
                                                    id="re_OfficeAddress"
                                                    type="text"
                                                    readonly
                                                >
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="officeTelNo">Telephone No:</label>
                                                <input
                                                    class="form-control mb-3"
                                                    id="re_officeTelNo"
                                                    type="text"
                                                    readonly
                                                >
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="officeFaxNo">Fax No:</label>
                                                <input
                                                    class="form-control mb-3"
                                                    id="re_officeFaxNo"
                                                    type="text"
                                                    readonly
                                                >
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="officeEmailAddress">Email Address:</label>
                                                <input
                                                    class="form-control mb-3"
                                                    id="re_officeEmailAddress"
                                                    type="email"
                                                    readonly
                                                >
                                            </div>
                                            <div class="col-12">
                                                <label
                                                    class="fw-bold"
                                                    for="factoryAddress"
                                                >Factory Address</label>
                                                <input
                                                    class="form-control mb-3"
                                                    id="re_factoryAddress"
                                                    type="text"
                                                    readonly
                                                >
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="factoryTelNo">Telephone No:</label>
                                                <input
                                                    class="form-control mb-3"
                                                    id="re_factoryTelNo"
                                                    type="text"
                                                    readonly
                                                >
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="factoryFaxNo">Fax No:</label>
                                                <input
                                                    class="form-control mb-3"
                                                    id="re_factoryFaxNo"
                                                    type="text"
                                                    readonly
                                                >
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="factoryEmailAddress">Email Address:</label>
                                                <input
                                                    class="form-control mb-3"
                                                    id="re_factoryEmailAddress"
                                                    type="email"
                                                    readonly
                                                >
                                            </div>
                                            <div class="card my-3">
                                                <div class="card-header fw-bold">
                                                    Business Activity
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label>Business Activity:</label>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="form-check mr-3">
                                                                <input class="form-check-input" type="checkbox" id="re_foodProcessing" readonly>
                                                            </div>
                                                            <label class="form-check-label flex-grow-1" for="re_foodProcessing">
                                                                Food processing (please specify specific sector)
                                                            </label>
                                                            <input type="text" class="form-control ml-3" style="max-width: 300px;" readonly id="re_foodProcessingSpecificSector">
                                                        </div>
                                            
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="form-check mr-3">
                                                                <input class="form-check-input" type="checkbox" id="re_furniture" readonly>
                                                            </div>
                                                            <label class="form-check-label flex-grow-1" for="re_furniture">
                                                                Furniture (please specify specific sector)
                                                            </label>
                                                            <input type="text" class="form-control ml-3" style="max-width: 300px;" readonly id="re_furnitureSpecificSector">
                                                        </div>
                                            
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="form-check mr-3">
                                                                <input class="form-check-input" type="checkbox" id="re_naturalFibers" readonly>
                                                            </div>
                                                            <label class="form-check-label flex-grow-1" for="re_naturalFibers">
                                                                Natural fibers, gifts and home decors and fashion accessories (please specify specific sector)
                                                            </label>
                                                            <input type="text" class="form-control ml-3" style="max-width: 300px;" readonly id="re_naturalFibersSpecificSector">
                                                        </div>
                                            
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="form-check mr-3">
                                                                <input class="form-check-input" type="checkbox" id="re_metals" readonly>
                                                            </div>
                                                            <label class="form-check-label flex-grow-1" for="re_metals">
                                                                Metals and engineering (please specify specific sector)
                                                            </label>
                                                            <input type="text" class="form-control ml-3" style="max-width: 300px;" readonly id="re_metalsSpecificSector">
                                                        </div>
                                            
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="form-check mr-3">
                                                                <input class="form-check-input" type="checkbox" id="re_aquatic" readonly>
                                                            </div>
                                                            <label class="form-check-label flex-grow-1" for="re_aquatic">
                                                                Aquatic and marine resources (please specify specific sector)
                                                            </label>
                                                            <input type="text" class="form-control ml-3" style="max-width: 300px;" readonly id="re_aquaticSpecificSector">
                                                        </div>
                                            
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="form-check mr-3">
                                                                <input class="form-check-input" type="checkbox" id="re_horticulture" readonly>
                                                            </div>
                                                            <label class="form-check-label flex-grow-1" for="re_horticulture">
                                                                Horticulture/Agriculture (please specify specific sector)
                                                            </label>
                                                            <input type="text" class="form-control ml-3" style="max-width: 300px;" readonly id="re_horticultureSpecificSector">
                                                        </div>
                                            
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check mr-3">
                                                                <input class="form-check-input" type="checkbox" id="re_others" readonly>
                                                            </div>
                                                            <label class="form-check-label flex-grow-1" for="re_others">
                                                                Others, please specify
                                                            </label>
                                                            <input type="text" class="form-control ml-3" style="max-width: 300px;" readonly id="re_othersSpecificSector">
                                                        </div>
                                                    </div>
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <label for="re_specificProductOrService">
                                                                Specific product or service the enterprise offers its customers:
                                                            </label>
                                                            <textarea class="form-control" id="re_specificProductOrService" name="specificProductOrService" rows="3" readonly></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <label for="re_reasonsWhyAssistanceIsBeingSought">
                                                                Reasons why assistance is being sought:
                                                            </label>
                                                            <textarea class="form-control" id="re_reasonsWhyAssistanceIsBeingSought" name="reasonsWhyAssistanceIsBeingSought" rows="3" readonly></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <label class="form-label">
                                                                3. Have you consulted any other individual/organization on any assistance?
                                                            </label>
                                                            <div class="ms-3">
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="radio" name="consultationAnswer" id="re_consultationYes" value="yes" readonly>
                                                                    <label class="form-check-label" for="re_consultationYes">
                                                                        Yes, from what company/agency
                                                                    </label>
                                                                    <div class="ms-4 mt-2" id="re_yesConsultationDetails">
                                                                        <input type="text" class="form-control mb-3" id="re_fromWhatCompanyAgency" name="fromWhatCompanyAgency" readonly>
                                                                        <label class="form-label">Please specify the type of assistance sought</label>
                                                                        <textarea class="form-control" id="re_pleaseSpecifyTheTypeOfAssistanceSought" name="pleaseSpecifyTheTypeOfAssistanceSought" rows="3" readonly></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="consultationAnswer" id="re_consultationNo" value="no" readonly>
                                                                    <label class="form-check-label" for="re_consultationNo">
                                                                        No, why not?
                                                                    </label>
                                                                    <div class="ms-4 mt-2" id="re_noConsultationDetails">
                                                                        <textarea class="form-control" id="re_whyNot" name="whyNot" rows="3" readonly></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <label class="form-label" for="re_enterprisePlanForTheNext5Years">
                                                                4. Enterprise plan for the next 5 years:
                                                            </label>
                                                            <textarea class="form-control" id="re_enterprisePlanForTheNext5Years" rows="3" readonly></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <label class="form-label ms-2" for="re_nextTenYears">
                                                                Next 10 years?
                                                            </label>
                                                            <textarea class="form-control" id="re_nextTenYears" rows="3" readonly></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <label class="form-label" for="re_currentAgreementAndAlliancesUndertaken">
                                                                5. Current agreement and alliances undertaken:
                                                            </label>
                                                            <textarea class="form-control" id="re_currentAgreementAndAlliancesUndertaken" rows="3" readonly></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 my-3">
                                                <div class="card">
                                                    <div class="card-header">
                                                        Assets
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-md-4">
                                                                <label for="buildings">Buildings</label>
                                                                <input
                                                                    class="form-control mb-3"
                                                                    id="re_buildings"
                                                                    type="text"
                                                                    readonly
                                                                >
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <label for="equipments">Equipments</label>
                                                                <input
                                                                    class="form-control mb-3"
                                                                    id="re_equipments"
                                                                    type="text"
                                                                    readonly
                                                                >
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <label for="working_capital">Working
                                                                    Capital</label>
                                                                <input
                                                                    class="form-control mb-3"
                                                                    id="re_working_capital"
                                                                    type="text"
                                                                    readonly
                                                                >
                                                            </div>
                                                            <div class="row text-center">
                                                                <div class="col-12 col-md-6">
                                                                    <p>Total Assets: <span id="re_to_Assets"></span>
                                                                    </p>
                                                                </div>
                                                                <div class="col-12 col-md-6">
                                                                    <p>Enterprise Level: <span
                                                                            id="re_Enterprise_Level"
                                                                        ></span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                Number of Personnel Direct(Production):
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        Regular
                                                                    </div>
                                                                    <div class="card-body">

                                                                        <div class="col-12">
                                                                            <label
                                                                                for="re_m_personnelDiRe">Male</label>
                                                                            <div class="mb-3">
                                                                                <input
                                                                                    class="form-control"
                                                                                    id="re_m_personnelDiRe"
                                                                                    name="re_m_personnelDiRe"
                                                                                    type="text"
                                                                                    readonly
                                                                                >
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label
                                                                                for="re_f_personnelDiRe">Female</label>
                                                                            <div class="mb-3">
                                                                                <input
                                                                                    class="form-control"
                                                                                    id="re_f_personnelDiRe"
                                                                                    name="re_f_personnelDiRe"
                                                                                    type="text"
                                                                                    readonly
                                                                                >
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="card my-3">
                                                                    <div class="card-header">
                                                                        Part-time
                                                                    </div>
                                                                    <div class="card-body">

                                                                        <div class="col-12">
                                                                            <label for="">Male</label>
                                                                            <div class="mb-3">
                                                                                <input
                                                                                    class="form-control"
                                                                                    id="re_m_personnelDiPart"
                                                                                    name="re_m_personnelDiPart"
                                                                                    type="text"
                                                                                    readonly
                                                                                >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label for="">Female</label>
                                                                            <div class="mb-3">
                                                                                <input
                                                                                    class="form-control"
                                                                                    id="re_f_personnelDiPart"
                                                                                    name="re_f_personnelDiPart"
                                                                                    type="text"
                                                                                    readonly
                                                                                >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                Number of Personnel Indirect(Admin and Marketing):
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        Regular
                                                                    </div>
                                                                    <div class="card-body">

                                                                        <div class="col-12">
                                                                            <label for="re_m_personnelIndRe">Male
                                                                            </label>
                                                                            <div class="mb-3">
                                                                                <input
                                                                                    class="form-control"
                                                                                    id="re_m_personnelIndRe"
                                                                                    name="re_m_personnelIndRe"
                                                                                    type="text"
                                                                                    readonly
                                                                                >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label
                                                                                for="re_f_personnelIndRe">Female</label>
                                                                            <div class="mb-3">
                                                                                <input
                                                                                    class="form-control"
                                                                                    id="re_f_personnelIndRe"
                                                                                    name="re_f_personnelIndRe"
                                                                                    type="text"
                                                                                    readonly
                                                                                >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card my-3">
                                                                    <div class="card-header">
                                                                        Part-time
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="col-12">
                                                                            <label
                                                                                for="re_m_personnelIndPart">Male</label>
                                                                            <div class="mb-3">
                                                                                <input
                                                                                    class="form-control"
                                                                                    id="re_m_personnelIndPart"
                                                                                    name="re_m_personnelIndPart"
                                                                                    type="text"
                                                                                    readonly
                                                                                >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label
                                                                                for="re_f_personnelIndPart">Female</label>
                                                                            <div class="mb-3">
                                                                                <input
                                                                                    class="form-control"
                                                                                    id="re_f_personnelIndPart"
                                                                                    name="re_f_personnelIndPart"
                                                                                    type="text"
                                                                                    readonly
                                                                                >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                Market Outlet
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="col-12">
                                                                    <label for="Export">Export</label>
                                                                    <textarea
                                                                        class="form-control mb-3"
                                                                        id="re_ExportMar"
                                                                        readonly
                                                                    ></textarea>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="Local">Local</label>
                                                                    <textarea
                                                                        class="form-control mb-3"
                                                                        id="re_LocalMar"
                                                                        readonly
                                                                    ></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- Modal Start --}}
    <div
        class="modal fade"
        id="confirmationModal"
        data-bs-backdrop="static"
        role="dialog"
        aria-labelledby="confirmationModalLabel"
        aria-hidden="true"
        tabindex="-1"
    >
        <div
            class="modal-dialog"
            role="document"
        >
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5
                        class="modal-title"
                        id="confirmationModalLabel"
                    >Confirmation</h5>
                </div>
                <div class="modal-body">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6>Data Privacy Consent</h6>
                        </div>
                        <div class="card-body">
                            <p class="paragraph-content">The Department of Science and Technology XI respect your
                                privacy and are committed to
                                protecting
                                your personal data. This Data Privacy Consent informs you about how we collect, use,
                                store, and
                                disclose your personal data when you use this information system.
                            </p>
                            <p class="paragraph-content">
                                <strong>Information We Collect:</strong> Login credentials: Username, password,
                                security questions/answers (if
                                applicable) Personal information: Name, email address, contact number, other
                                information you
                                provide during registration or use of the system. Usage data: Log data (e.g. access
                                times), system
                                navigation data, information about your use of features and functionalities
                            </p>
                            <p class="paragraph-content">
                                <strong>How We Use Your Information:</strong> Provide access to the information
                                system: Verify your identity and
                                authenticate your login. Manage your account: Process your registration, maintain
                                your profile, and
                                respond to your inquiries. Operate and improve the system: Analyze usage data to
                                optimize
                                performance and troubleshoot issues. Communicate with you: Send system updates,
                                announcements, and support messages.
                            </p>
                            <p class="paragraph-content">
                                <strong>Disclosure of Your Information:</strong> We will not disclose your personal
                                data to any third party without
                                your explicit consent, except as required by law or to comply with legal process. We
                                may share
                                aggregate and anonymized data with third-party service providers for analytics and
                                performance
                                improvement purposes.
                            </p>
                            <p class="paragraph-content">
                                <strong>Your Rights:</strong> You have the right to access, rectify, erase, and
                                restrict the processing of your personal
                                data. You have the right to withdraw your consent at any time. You have the right to
                                complain to the
                                relevant data protection authority if you believe your rights have been violated.
                            </p>
                            <p class="paragraph-content">
                                By logging in to this information system, you acknowledge that you have read and
                                understood this
                                Data Privacy Consent and agree to the collection, use, and disclosure of your
                                personal data as
                                described herein.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h6>Terms and Conditions</h6>
                        </div>
                        <div class="card-body text-justify">
                            <p class="paragraph-content">Welcome to DOST-SETUP-SYS. By accessing and using this
                                website, you agree to comply with and be bound by the following terms and
                                conditions:
                            </p>
                            <p class="paragraph-content">
                                <strong>Acceptance of Terms:</strong> By using this website, you acknowledge that
                                you have read, understood, and agree to be bound by these terms and conditions
                            </p>
                            <p>
                                <strong>Use of the Website:</strong> You agree to use this website only for lawful
                                purposes and in a manner that does not infringe the rights of, restrict, or inhibit
                                anyone else's use and enjoyment of the website.
                            </p>
                            <p class="paragraph-content">
                                <strong>
                                    User Accounts:
                                </strong>
                                If you create an account on this website, you are responsible for maintaining the
                                confidentiality of your account information and for all activities that occur under
                                your account.
                            </p>
                            <p class="paragraph-content">
                                <strong>Changes to Terms:</strong> We reserve the right to modify these terms and
                                conditions at any time. Your continued use of the website after any changes
                                indicates your acceptance of the new terms.
                            </p>
                            <p class="paragraph-content">
                                <strong>Governing Law:</strong> These terms and conditions are governed by and
                                construed in accordance with the laws of the Philippines.
                            </p>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    id="detail_confirm"
                                    name="detail_confirm"
                                    type="checkbox"
                                    required
                                >
                                <label
                                    class="form-check-label"
                                    for="detail_confirm"
                                >I hereby confirm that the
                                    information I provided is true and correct.</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    id="agree_terms"
                                    name="agree_terms"
                                    type="checkbox"
                                    required
                                >
                                <label
                                    class="form-check-label"
                                    for="agree_terms"
                                >I have read and agree to the
                                    terms and conditions.</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        class="btn"
                        id="cancelButton"
                        data-bs-dismiss="modal"
                        type="button"
                    >Cancel</button>
                    <button
                        class="btn btn-primary"
                        id="confirmButton"
                        type="button"
                        disabled
                    >Confirm</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal End --}}
</div>
