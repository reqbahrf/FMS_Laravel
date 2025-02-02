import { customDateFormatter, showToastFeedback } from './utilFunctions';
import * as bootstrap from 'bootstrap';
import 'jquery';

export enum RetrievalType {
    Personal = 'personal',
    SelectedStaff = 'selectedStaff'
}
export default class ActivityLogHandler {
    private activityLog: Map<string, any>;
    private DivContainer: JQuery;
    private user_role: string;
    private ActivityLogRoute: string;

    constructor(DivContainer: JQuery, user_role: string, retrievalType: RetrievalType) {
        if (!Object.values(RetrievalType).includes(retrievalType)) {
            throw new Error(
                'Invalid retrieval type. Must be either "personal" or "selectedStaff"'
            );
        }

        this.activityLog = new Map();
        this.DivContainer = DivContainer;
        this.user_role = user_role;
        this.ActivityLogRoute =
            retrievalType === 'personal'
                ? USER_ACTIVITY_LOG_ROUTE
                : USERS_LIST_ROUTE.GET_STAFF_USER_ACTIVITY_LOGS;

        if (retrievalType === 'selectedStaff') {
            this._initializeStaffActivityLogEvents();
        }
    }

    initPersonalActivityLog() {
        this.DivContainer.on('show.bs.modal', async (e) => {
            try {
                const ActivityTableLog = $(e.target).find(
                    '.modal-body #userActivityLogTable tbody'
                );
                ActivityTableLog.empty();
                const data = await this._getActivityLog();
                this._renderActivityLogTable(ActivityTableLog, data.data);
            } catch (error) {
                this._handleError('Error loading activity log:', error);
            }
        });
    }

    _initializeStaffActivityLogEvents() {
        if (this.user_role !== 'admin') {
            this._handleError(
                'Unauthorized:',
                new Error('User role is not admin')
            );
            return;
        }
    }

    async getSelectedStaffActivityLog(user_id: number) {
        try {
            if (!user_id) {
                throw new Error('User ID is required');
            }
            const table = this.DivContainer.find(
                '#StaffActivityLogTable tbody'
            );
            table.empty();
            const data = await this._getUserAuditLogs(user_id);
            this._renderActivityLogTable(table, data.data);
        } catch (error) {
            this._handleError('Error loading activity log:', error);
        }
    }

    _renderActivityLogTable(tableBody: JQuery, logs: any[]) {
        if (!logs.length) {
            tableBody.append(`
                <tr>
                    <td colspan="5" class="text-center">No activity log available.</td>
                </tr>
            `);
            return;
        }
        const tooltipTitlehelperFn = (oldValues: object, newValues: object) => {
            if (!oldValues || !newValues) {
                return '';
            }
            const excludeKeys = ['remember_token', 'password'];
            const formatValues = (obj) => {
                return Object.entries(obj)
                    .filter(([key]) => !excludeKeys.includes(key))
                    .map(([key, value]) => `${key}: ${value}`)
                    .join('<br>');
            };

            return /*html*/`<strong>Old Values:</strong><br>${formatValues(oldValues)}<br><br>
                    <strong>New Values:</strong><br>${formatValues(newValues)}`;
        };

        const toolTipHelperFn = (auditableType: string, oldValues: object, newValues: object) => {
            const toolTipText =
                auditableType?.replace('App\\Models\\', '') || '';
            const toolTipEl = `data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="<strong>${toolTipText}</strong><br>${tooltipTitlehelperFn(oldValues, newValues)}" data-bs-placement="right"`;
            return toolTipText ? toolTipEl.trim() : '';
        };

        const ActivityLogTableContent = (log: any) => {
            return /*html*/`<tr>
                    <td>${log.user_type}</td>
                    <td><span class="fw-bold text-decoration-underline" ${toolTipHelperFn(log.auditable_type, log.old_values, log.new_values)}>${log.event}</span></td>
                    <td>${log.ip_address}</td>
                    <td>${log.user_agent}</td>
                    <td>${customDateFormatter(log.created_at)}</td>
                </tr>`;
        };
        logs.forEach((log) => {
            tableBody.append(ActivityLogTableContent(log));
        });

        const toolTipTriggerList = $('[data-bs-toggle="tooltip"]');
        const toolTipList = [...toolTipTriggerList].map(
            (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
        );
    }

    async _getActivityLog() {
        try {
            if (!this.activityLog.has('personal')) {
                if (!this.ActivityLogRoute) {
                    throw new Error('Activity Log Route is not defined');
                }
                const data = await fetch(this.ActivityLogRoute, {
                    method: 'GET',
                });
                const result = await data.json();
                this.activityLog.set('personal', result);
            }
            return this.activityLog.get('personal');
        } catch (error) {
            this._handleError('Activity Log Retrieval', error);
            throw error;
        }
    }

    async _getUserAuditLogs(user_id) {
        const cacheKey = `user_${user_id}`;
        try {
            if (!this.activityLog.has(cacheKey)) {
                if (!this.ActivityLogRoute) {
                    throw new Error('Activity Log Route is not defined');
                }
                const response = await fetch(
                    this.ActivityLogRoute?.replace(':user_id', user_id),
                    {
                        method: 'GET',
                    }
                );
                const result = await response.json();
                this.activityLog.set(cacheKey, result);
            }
            return this.activityLog.get(cacheKey);
        } catch (error) {
            throw new Error(
                `Failed to fetch user audit logs: ${error.message}`
            );
        }
    }

    _handleError(prefix: string, error: Error) {
        console.error(prefix, error);
        showToastFeedback('text-bg-danger', `${prefix} ${error.message}`);
    }
}
