import * as DataTables from 'datatables.net';
import 'laravel-echo';
import { formatNumber, customDateFormatter } from './utilFunctions';

/**
 * Manages applicant data table functionality with real-time collaborative viewing features.
 *
 * Handles initialization and management of a DataTable for applicant information,
 * including real-time updates through Echo channels for collaborative viewing states.
 * Provides methods for fetching applicant data, managing viewing states, and
 * broadcasting real-time events.
 *
 * @class
 * @param {string} userName - The name of the current user
 * @requires Echo
 * @requires jQuery
 * @requires DataTables
 */
export default class ApplicantDataTable {
    private applicantViewingChannel: string;
    private applicantDataTable: JQuery<HTMLElement>;
    private dataTableRoute: string;
    private applicantDataTableInstance: DataTables.Api;
    private currentlyViewingApplicantId: number | null;
    private echoChannel: ReturnType<(typeof Echo)['channel']> | null;
    private userName: string;

    constructor(userName: string) {
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
            autoWidth: false,
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
        }) as DataTables.Api;
    }

    /**
     * Initializes a real-time Echo channel for collaborative applicant viewing.
     *
     * This method establishes a private channel to enable real-time tracking
     * of applicant viewing states across multiple users. It handles:
     * - Channel initialization
     * - Listening to viewing and viewing-closed events
     * - Tracking channel membership
     *
     * @async
     * @returns {Promise<void>} A promise that resolves when the channel is successfully set up
     *
     * @workflow
     * 1. Clean up any existing Echo channel listeners
     * 2. Create a private channel for applicant viewing events
     * 3. Set up whisper event listeners for 'viewing' and 'viewing-closed' states
     * 4. Handle channel membership events (here, joining, leaving)
     *
     * @fires Echo#whisper:viewing - Broadcast when a user starts viewing an applicant
     * @fires Echo#whisper:viewing-closed - Broadcast when a user stops viewing an applicant
     *
     * @listens Echo.join().here - Logs current members when joining the channel
     * @listens Echo.join().joining - Broadcasts current viewing state when a new member joins
     * @listens Echo.join().leaving - Logs when a member leaves the channel
     *
     * @example
     * // Typical usage within the class initialization
     * try {
     *   await this._initializeApplicantViewingChannel();
     *   console.log('Applicant viewing channel initialized');
     * } catch (error) {
     *   console.error('Failed to initialize channel', error);
     * }
     *
     * @throws {Error} If there are issues initializing the Echo channel
     *
     * @see {@link _cleanupEchoListeners} For channel cleanup method
     * @see {@link _updateViewingState} For handling viewing state updates
     */
    async _initializeApplicantViewingChannel() {
        return new Promise((resolve) => {
            if (this.echoChannel) {
                this._cleanupEchoListeners();
            }
            this.echoChannel = Echo.private(this.applicantViewingChannel);

            if (!this.echoChannel) return;
            this.echoChannel.listenForWhisper(
                'viewing',
                (e: { applicant_id: number; reviewed_by: string }) => {
                    this._updateViewingState(e.applicant_id, e.reviewed_by);
                }
            );

            // When viewing ends
            this.echoChannel.listenForWhisper(
                'viewing-closed',
                (e: { applicant_id: number }) => {
                    this._removeViewingState(e.applicant_id);
                }
            );

            Echo.join(this.applicantViewingChannel)
                .here((staff: string) => {
                    console.log('Current members:', staff);
                    resolve(true); // Resolve the promise when initialization is complete
                })
                .joining((staff: string) => {
                    console.log('New member joining:', staff);
                    if (this.applicantViewingChannel) {
                        this.echoChannel.whisper('viewing', {
                            applicant_id: this.currentlyViewingApplicantId,
                            reviewed_by: this.userName,
                        });
                    }
                })
                .leaving((staff: string) => {
                    console.log('Member leaving:', staff);
                });
        }).catch((error) => {
            throw new Error('Error initializing Echo channel: ' + error);
        });
    }

    /**
     * Initializes the Echo channel for real-time applicant viewing events.
     *
     * This method sets up a private Echo channel to handle real-time events related to
     * applicant viewing status. It performs the following key actions:
     * 1. Cleans up any existing Echo listeners
     * 2. Creates a private channel for applicant viewing events
     * 3. Sets up listeners for 'viewing' and 'viewing-closed' whisper events
     * 4. Joins the channel and handles member presence events
     *
     * @async
     * @returns {Promise<void>} A promise that resolves when the channel is initialized
     *
     * @fires Echo#listenForWhisper 'viewing' - Triggered when another user starts viewing an applicant
     * @fires Echo#listenForWhisper 'viewing-closed' - Triggered when a user stops viewing an applicant
     *
     * @listens Echo.join().here - Logs current members when joining the channel
     * @listens Echo.join().joining - Broadcasts current viewing state when a new member joins
     * @listens Echo.join().leaving - Logs when a member leaves the channel
     *
     * @example
     * // Typical usage within the class initialization
     * await this._initializeApplicantViewingChannel();
     *
     * @throws {Error} Potential errors from Echo channel initialization
     */
    _cleanupEchoListeners() {
        try {
            if (this.currentlyViewingApplicantId) {
                this.echoChannel?.whisper('viewing-closed', {
                    applicant_id: this.currentlyViewingApplicantId,
                });
                this.currentlyViewingApplicantId = null;
            }

            if (this.echoChannel) {
                Echo.leaveChannel(`private-${this.applicantViewingChannel}`);
                Echo.leaveChannel(`presence-${this.applicantViewingChannel}`);
                this.echoChannel = null;
            }
        } catch (e) {
            throw new Error('Error cleaning up Echo listeners: ' + e);
        }
    }

    /**
     * Updates the visual state of an applicant row in the data table to show who is reviewing it.
     * Stores original content and displays reviewer information with initials and badge.
     *
     * @param {string|number} applicantId - The ID of the applicant being reviewed
     * @param {string} reviewedBy - The name of the reviewer (optional)
     * @throws {Error} If there is an error updating the viewing state
     */
    _updateViewingState(applicantId: number, reviewedBy: string) {
        try {
            const applicantButton = this.applicantDataTable.find(
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
        } catch (e) {
            throw new Error('Error updating viewing state: ' + e);
        }
    }

    /**
     * Removes the viewing state from an applicant row in the data table.
     * Restores the original content and styling of the cell.
     *
     * @param {string|number} applicantId - The ID of the applicant to remove viewing state from
     * @throws {Error} If there is an error removing the viewing state
     */
    _removeViewingState(applicantId: number) {
        try {
            const applicantButton = $(
                `#ApplicantTableBody button[data-applicant-id="${applicantId}"]`
            );
            const buttonParentTd = applicantButton.closest('td');

            if (buttonParentTd.data('original-content')) {
                buttonParentTd
                    .html(buttonParentTd.data('original-content'))
                    .removeClass('reviewer-name-cell');
            }
        } catch (e) {
            throw new Error('Error removing viewing state: ' + e);
        }
    }

    /**
     * Fetches and populates the applicant data table with applicant information.
     *
     * This asynchronous method retrieves applicant data from the server and dynamically
     * renders a comprehensive DataTable with detailed applicant information. The method:
     * - Sends a GET request to the predefined data table route
     * - Processes and transforms raw applicant data
     * - Clears and redraws the DataTable with formatted rows
     *
     * @async
     * @returns {Promise<void>} A promise that resolves when applicants are successfully fetched and rendered
     *
     * @workflow
     * 1. Fetch applicant data from server using predefined route
     * 2. Parse JSON response
     * 3. Clear existing DataTable
     * 4. Transform applicant data into DataTable row format
     * 5. Add transformed rows to DataTable
     * 6. Redraw DataTable
     *
     * @requires formatNumber - Utility function to format numeric values
     * @requires customDateFormatter - Utility function to format dates
     *
     * @example
     * // Typical usage within the class
     * try {
     *   await this._fetchApplicants();
     *   console.log('Applicant table populated successfully');
     * } catch (error) {
     *   console.error('Failed to fetch applicants', error);
     * }
     *
     * @throws {Error} If there is an issue fetching or processing applicant data
     *
     * @description
     * Each applicant row includes:
     * - Full name
     * - Designation
     * - Detailed business information
     * - Application date
     * - Application status
     * - Action button for applicant details
     */
    async _fetchApplicants() {
        try {
            const response = await fetch(this.dataTableRoute, {
                method: 'GET',
            });
            const data = await response.json();
            this.applicantDataTableInstance.clear();
            this.applicantDataTableInstance.rows
                .add(
                    data.map((item: any) => {
                        return [
                            /*html*/ `${
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
                                <input
                                    type="hidden"
                                    name="sex"
                                    value="${item.sex}"
                                />
                                <input
                                    type="hidden"
                                    name="birth_date"
                                    value="${item.birth_date}"
                                />
                                <input
                                    type="hidden"
                                    name="applicant_home_address"
                                    value="${item.landmark || ''}, ${item.barangay || ''}, ${item.city || ''}, ${item.province || ''}, ${item.region || ''}, ${item.zip_code || ''}"
                                />`,
                            `${item.designation}`,
                            /*html*/ `<div>
                                <strong>Firm Name:</strong>
                                <span class="firm_name">${item.firm_name}</span
                                ><br />
                                <strong>Business Address:</strong>
                                <br>
                                <input type="hidden" name="sectors" value="${item.sectors}" />
                                <input
                                    type="hidden"
                                    name="userID"
                                    value="${item.user_id}"
                                />
                                <input
                                    type="hidden"
                                    name="applicationID"
                                    value="${item.Application_ID}"
                                />
                                <input
                                    type="hidden"
                                    name="businessID"
                                    value="${item.business_id}"
                                />
                                <input
                                    type="hidden"
                                    name="male_direct_re"
                                    value="${item.male_direct_re || '0'}"
                                />
                                <input
                                    type="hidden"
                                    name="female_direct_re"
                                    value="${item.female_direct_re || '0'}"
                                />
                                <input
                                    type="hidden"
                                    name="male_direct_part"
                                    value="${item.male_direct_part || '0'}"
                                />
                                <input
                                    type="hidden"
                                    name="female_direct_part"
                                    value="${item.female_direct_part || '0'}"
                                />
                                <input
                                    type="hidden"
                                    name="male_indirect_re"
                                    value="${item.male_indirect_re || '0'}"
                                />
                                <input
                                    type="hidden"
                                    name="female_indirect_re"
                                    value="${item.female_indirect_re || '0'}"
                                />
                                <input
                                    type="hidden"
                                    name="male_indirect_part"
                                    value="${item.male_indirect_part || '0'}"
                                />
                                <input
                                    type="hidden"
                                    name="female_indirect_part"
                                    value="${item.female_indirect_part || '0'}"
                                />
                                <input
                                    type="hidden"
                                    name="total_personnel"
                                    value="${
                                        parseInt(item.male_direct_re || 0) +
                                        parseInt(item.female_direct_re || 0) +
                                        parseInt(item.male_direct_part || 0) +
                                        parseInt(item.female_direct_part || 0) +
                                        parseInt(item.male_indirect_re || 0) +
                                        parseInt(item.female_indirect_re || 0) +
                                        parseInt(item.male_indirect_part || 0) +
                                        parseInt(item.female_indirect_part || 0)
                                    }"
                                />
                                <strong class="ps-2"> Office Address:</strong>
                                <span class="business_address text-truncate ps-3"
                                    >${item.office_landmark || ''}, ${item.office_barangay || ''},
                                    ${item.office_city || ''}, ${item.office_province || ''},
                                    ${item.office_region || ''}</span
                                ><br />
                                <strong class="ps-2">Factory Address:</strong>
                                <span class="factory_address text-truncate ps-3"
                                    >${item.factory_landmark || ''}, ${item.factory_barangay || ''},
                                    ${item.factory_city || ''}, ${item.factory_province || ''},
                                    ${item.factory_region || ''}</span
                                ><br />
                                <strong>Type of Enterprise:</strong>
                                <span class="enterprise_l"
                                    >${item.enterprise_type}</span
                                >
                                <p>
                                    <strong>Assets:</strong> <br />
                                    <span class="ps-2 asset-building"
                                        >Building:
                                        ${formatNumber(
                                            parseFloat(item.building_value)
                                        )}</span
                                    ><br />
                                    <span class="ps-2 asset-equipment"
                                        >Equipment:
                                        ${formatNumber(
                                            parseFloat(item.equipment_value)
                                        )}</span
                                    >
                                    <br />
                                    <span class="ps-2 asset-working-capital"
                                        >Working Capital:
                                        ${formatNumber(
                                            parseFloat(item.working_capital)
                                        )}</span
                                    >
                                </p>
                                <strong>Contact Details:</strong>
                                <p>
                                    <strong class="p-2">Landline:</strong>
                                    <span class="landline"
                                        >${item.landline}</span
                                    >
                                    <br />
                                    <strong class="p-2">Mobile Phone:</strong>
                                    <span class="mobile_num"
                                        >${item.mobile_number}</span
                                    >
                                    <br />
                                    <strong class="p-2">Email:</strong>
                                    <span class="email_add">${item.email}</span>
                                </p>
                            </div>`,
                            `${customDateFormatter(item.date_applied)}`,
                            /*html*/ `<span
                                class="badge ${
                                    item.application_status === 'new'
                                        ? 'bg-primary'
                                        : item.application_status ===
                                            'evaluation'
                                          ? 'bg-info'
                                          : item.application_status ===
                                              'pending'
                                            ? 'bg-primary'
                                            : 'bg-danger'
                                }"
                                >${item.application_status}</span
                            ><input
                                type="hidden"
                                name="requested_fund_amount"
                                value="${item.requested_fund_amount}"
                            />`,
                            /*html*/ ` <button
                                class="btn btn-primary applicantDetailsBtn"
                                data-applicant-id="${item.Application_ID}"
                                type="button"
                                data-bs-toggle="offcanvas"
                                data-bs-target="#applicantDetails"
                                aria-controls="applicantDetails"
                            >
                                <i class="ri-menu-unfold-4-line ri-1x"></i>
                            </button>`,
                        ];
                    })
                )
                .draw();
        } catch (e) {
            throw new Error('Failed to fetch applicants: ' + e);
        }
    }

    _attactEventListener() {
        $(document).on('page:changing', (e, data) => {
            const { from, to } = data;
            if (from === 'Applicationlink') {
                this._cleanupEchoListeners();
            }
        });
    }

    /**
     * Broadcasts a real-time event indicating that an applicant is being viewed.
     *
     * This method sends a whisper event through the private Echo channel to notify
     * other users about the current applicant being reviewed. It:
     * - Sends a 'viewing' whisper event with applicant and reviewer details
     * - Updates the currently viewed applicant ID
     *
     * @param {string|number} viewedApplicant_id - The unique identifier of the applicant being viewed
     * @param {string} reviewer - The name of the user reviewing the applicant
     *
     * @throws {Error} If there is an issue broadcasting the viewing event
     *
     * @example
     * // Broadcast that user is viewing an applicant
     * try {
     *   this.broadcastViewingEvent(123, 'John Doe');
     *   console.log('Viewing event broadcasted successfully');
     * } catch (error) {
     *   console.error('Failed to broadcast viewing event', error);
     * }
     *
     * @fires Echo#whisper:viewing - Notifies other users about the current applicant review
     */
    broadcastViewingEvent(viewedApplicant_id: number, reviewer: string) {
        try {
            Echo.private(this.applicantViewingChannel).whisper('viewing', {
                applicant_id: viewedApplicant_id,
                reviewed_by: reviewer,
            });
            this.currentlyViewingApplicantId = viewedApplicant_id;
        } catch (error) {
            throw new Error('Error broadcasting viewing event: ' + error);
        }
    }

    /**
     * Broadcasts a real-time event indicating that an applicant review has ended.
     *
     * This method sends a whisper event through the private Echo channel to notify
     * other users that the current applicant review is complete. It:
     * - Sends a 'viewing-closed' whisper event with the applicant ID
     * - Resets the currently viewed applicant ID
     *
     * @throws {Error} If there is an issue broadcasting the closed viewing event
     *
     * @example
     * // Broadcast that applicant review is complete
     * try {
     *   this.broadcastClosedViewingEvent();
     *   console.log('Closed viewing event broadcasted successfully');
     * } catch (error) {
     *   console.error('Failed to broadcast closed viewing event', error);
     * }
     *
     * @fires Echo#whisper:viewing-closed - Notifies other users that applicant review has ended
     */
    broadcastClosedViewingEvent() {
        try {
            Echo.private(this.applicantViewingChannel).whisper(
                'viewing-closed',
                {
                    applicant_id: this.currentlyViewingApplicantId,
                }
            );
            this.currentlyViewingApplicantId = null;
        } catch (e) {
            throw new Error('Error broadcasting closed viewing event: ' + e);
        }
    }

    async init() {
        await this._fetchApplicants();
        await this._initializeApplicantViewingChannel();
        this._attactEventListener();
    }
}
