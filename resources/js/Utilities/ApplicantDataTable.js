import { formatNumberToCurrency, customDateFormatter } from './utilFunctions';

export default class ApplicantDataTable {
    constructor(userName) {
        this.applicantViewingChannel = 'viewing-Applicant-events';
        this.applicantDataTable = $('#applicant');
        this.dataTableRoute = APPLICANT_TAB_ROUTE.GET_APPLICANTS;
        this.applicantDataTableInstance = this._initializeApplicantDataTable();
        this.currentlyViewingApplicantId = null;
        this.echoChannel = null;
        this.userName = userName;
    }

    _initializeApplicantDataTable() {
        return this.applicantDataTable.DataTable({
            responsive: true,
            autoWidth: false,
            fixedColumns: true,
            columns: [
                {
                    title: 'Applicant',
                    width: '25%',
                },
                {
                    title: 'Designation',
                    width: '10%',
                },
                {
                    title: 'Business Info',
                    width: '35%',
                    orderable: false,
                },
                {
                    title: 'Date Applied',
                    width: '15%',
                    type: 'date',
                },
                {
                    title: 'Status',
                    width: '10%',
                    className: 'text-center',
                },
                {
                    title: 'Action',
                    width: '5%',
                    orderable: false,
                },
            ],
        });
    }
    async _initializeApplicantViewingChannel() {
        return new Promise((resolve) => {
            if (this.echoChannel) {
                this._cleanupEchoListeners();
            }

            this.echoChannel = Echo.private(this.applicantViewingChannel);

            this.echoChannel.listenForWhisper('viewing', (e) => {
                this._updateViewingState(e.applicant_id, e.reviewed_by);
            });

            // When viewing ends
            this.echoChannel.listenForWhisper('viewing-closed', (e) => {
                this._removeViewingState(e.applicant_id);
            });

            Echo.join(this.applicantViewingChannel)
                .here((staff) => {
                    console.log('Current members:', staff);
                    resolve(); // Resolve the promise when initialization is complete
                })
                .joining((staff) => {
                    console.log('New member joining:', staff);
                    if (this.applicantViewingChannel) {
                        echoChannel.whisper('viewing', {
                            applicant_id: this.applicantViewingChannel,
                            reviewed_by: this.userName,
                        });
                    }
                })
                .leaving((staff) => {
                    console.log('Member leaving:', staff);
                });
        });
    }

    _cleanupEchoListeners = () => {
        if (this.currentlyViewingApplicantId) {
            echoChannel?.whisper('viewing-closed', {
                applicant_id: this.applicantViewingChannel,
            });
            this.currentlyViewingApplicantId = null;
        }

        if (echoChannel) {
            Echo.leaveChannel(`private-${this.applicantViewingChannel}`);
            Echo.leaveChannel(`presence-${this.applicantViewingChannel}`);
            this.echoChannel = null;
        }
    };

    _updateViewingState(applicantId, reviewedBy) {
        const applicantButton = $(
            `#ApplicantTableBody button[data-applicant-id="${applicantId}"]`
        );
        const buttonParentTd = applicantButton.closest('td');

        if (!buttonParentTd.data('original-content')) {
            buttonParentTd.data('original-content', buttonParentTd.html());
        }

        applicantButton.css('display', 'none');
        if (reviewedBy) {
            const initials = reviewedBy
                .split(' ')
                .map((n) => n[0])
                .join('');
            // Create a container for the initial and name
            const reviewerContainer = $(
                `<div class="reviewer-container"></div>`
            );
            reviewerContainer.append(
                `<span class="reviewer-initial">${initials}</span>`
            );
            reviewerContainer.append(
                `<span class="reviewer-name">${reviewedBy}</span>`
            );
            reviewerContainer.append(
                `<span class="badge rounded-pill text-bg-success reviewer-badge">reviewing</span>`
            );

            buttonParentTd
                .append(reviewerContainer)
                .addClass('reviewer-name-cell');
        }
    }

    _removeViewingState(applicantId) {
        const applicantButton = $(
            `#ApplicantTableBody button[data-applicant-id="${applicantId}"]`
        );
        const buttonParentTd = applicantButton.closest('td');

        if (buttonParentTd.data('original-content')) {
            buttonParentTd
                .html(buttonParentTd.data('original-content'))
                .removeClass('reviewer-name-cell');
        }
    }

    async _fetchApplicants() {
        try {
            const response = await fetch(this.dataTableRoute, {
                method: 'GET',
                dataType: 'json',
            });
            const data = await response.json();
            this.applicantDataTableInstance.clear();
            this.applicantDataTableInstance.rows
                .add(
                    data.map((item) => {
                        return [
                            `${
                                (item?.prefix ?? '') +
                                ' ' +
                                item.f_name +
                                ' ' +
                                (item?.mid_name ?? '') +
                                ' ' +
                                item.l_name +
                                ' ' +
                                (item?.suffix ?? '')
                            }
                        <input type="hidden" name="sex" value="${item.sex}">`,
                            `${item.designation}`,
                            `<div>
            <strong>Firm Name:</strong> <span class="firm_name">${
                item.firm_name
            }</span><br>
            <strong>Business Address:</strong>
            <input type="hidden" name="userID" value="${item.user_id}">
            <input type="hidden" name="applicationID" value="${
                item.Application_ID
            }">
            <input type="hidden" name="businessID" value="${item.business_id}">
            <input type="hidden" name="male_direct_re" value="${
                item.male_direct_re || '0'
            }">
            <input type="hidden" name="female_direct_re" value="${
                item.female_direct_re || '0'
            }">
            <input type="hidden" name="male_direct_part" value="${
                item.male_direct_part || '0'
            }">
            <input type="hidden" name="female_direct_part" value="${
                item.female_direct_part || '0'
            }">
            <input type="hidden" name="male_indirect_re" value="${
                item.male_indirect_re || '0'
            }">
            <input type="hidden" name="female_indirect_re" value="${
                item.female_indirect_re || '0'
            }">
            <input type="hidden" name="male_indirect_part" value="${
                item.male_indirect_part || '0'
            }">
            <input type="hidden" name="female_indirect_part" value="${
                item.female_indirect_part || '0'
            }">
            <input type="hidden" name="total_personnel" value="${
                parseInt(item.male_direct_re || 0) +
                parseInt(item.female_direct_re || 0) +
                parseInt(item.male_direct_part || 0) +
                parseInt(item.female_direct_part || 0) +
                parseInt(item.male_indirect_re || 0) +
                parseInt(item.female_indirect_re || 0) +
                parseInt(item.male_indirect_part || 0) +
                parseInt(item.female_indirect_part || 0)
            }">
            <span class="b_address text-truncate">${item.landMark}, ${
                item.barangay
            }, ${item.city}, ${item.province}, ${item.region}</span><br>
            <strong>Type of Enterprise:</strong> <span class="enterprise_l">${
                item.enterprise_type
            }</span>
            <p>
                <strong>Assets:</strong> <br>
                <span class="ps-2">Building: ${formatNumberToCurrency(
                    parseFloat(item.building_value)
                )}</span><br>
                <span class="ps-2">Equipment: ${formatNumberToCurrency(
                    parseFloat(item.equipment_value)
                )}</span> <br>
                <span class="ps-2">Working Capital: ${formatNumberToCurrency(
                    parseFloat(item.working_capital)
                )}</span>
            </p>
            <strong>Contact Details:</strong>
            <p>
                <strong class="p-2">Landline:</strong> <span class="landline">${
                    item.landline
                }</span> <br>
                <strong class="p-2">Mobile Phone:</strong> <span class="mobile_num">${
                    item.mobile_number
                }</span> <br>
                <strong class="p-2">Email:</strong> <span class="email_add">${
                    item.email
                }</span>
            </p>
        </div>`,
                            `${customDateFormatter(item.date_applied)}`,
                            `<span class="badge ${
                                item.application_status === 'new'
                                    ? 'bg-primary'
                                    : item.application_status === 'evaluation'
                                      ? 'bg-info'
                                      : item.application_status === 'pending'
                                        ? 'bg-primary'
                                        : 'bg-danger'
                            }">${item.application_status}</span>`,
                            `   <button class="btn btn-primary applicantDetailsBtn" data-applicant-id="${item.Application_ID}" type="button"
                                    data-bs-toggle="offcanvas" data-bs-target="#applicantDetails"
                                    aria-controls="applicantDetails">
                                    <i class="ri-menu-unfold-4-line ri-1x"></i>
                            </button>`,
                        ];
                    })
                )
                .draw();
        } catch (e) {
            throw new Error('Failed to fetch applicants: ' + e.message);
        }
    }

    _attactEventListener() {
        $(document).on('page:changing', function (e, data) {
            const { from, to } = data;
            if (from === 'Applicationlink') {
                this._cleanupEchoListeners();
            }
        });
    }

    async init() {
        await this._fetchApplicants();
        await this._initializeApplicantViewingChannel();
        this._attactEventListener();
    }
}
