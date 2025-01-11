import { customDateFormatter, showToastFeedback } from './utilFunctions';

export default class ActivityLogHandler {
    constructor(DivContainer, user_role){
        this.activityLog = [];
        this.DivContainer = DivContainer;
        this.user_role = user_role;
        this.route_url = USER_ACTIVITY_LOG_ROUTE;
        this.staffActivityLogRoute = USERS_LIST_ROUTE.GET_STAFF_USER_ACTIVITY_LOGS ?? '';
    }

    initPersonalActivityLog() {
        this.DivContainer.on('show.bs.modal', async (e) => {
            try {
                const ActivityTableLog = $(e.target).find('.modal-body #userActivityLogTable tbody');
                ActivityTableLog.empty();
                const data = await this._getActivityLog();
                data.data.map(log => {
                    ActivityTableLog.append(`
                        <tr>
                            <td>${log.user_type}</td>
                            <td>${log.event}</td>
                            <td>${log.ip_address}</td>
                            <td>${log.user_agent}</td>
                            <td>${customDateFormatter(log.created_at)}</td>
                        </tr>
                    `);
                })
            } catch (error) {
                showToastFeedback('text-bg-danger', 'Error loading activity log:' + error);
            }
        });
    }

     initSelectedStaffActivityLog(user_id){
        if(this.user_role !== 'admin'){
            throw new Error('Unauthorized: User role is not admin');
        }
        this.DivContainer.on('show.bs.offcanvas', async (e) => {
            try {
                const ActivityTableLog = $(e.target).find('.offcanvas-body #StaffActivityLogTable tbody');
                ActivityTableLog.empty();
                const data = await this._getUserAuditLogs(user_id);
                data.data.map(log => {
                    ActivityTableLog.append(`
                        <tr>
                            <td>${log.user_type}</td>
                            <td>${log.event}</td>
                            <td>${log.ip_address}</td>
                            <td>${log.user_agent}</td>
                            <td>${customDateFormatter(log.created_at)}</td>
                        </tr>
                    `);
                })
            } catch (error) {
                showToastFeedback('text-bg-danger', 'Error loading activity log:' + error);
            }
        })

    }


    async _getActivityLog() {
        try {
            if(this.activityLog.length === 0){
                const data = await fetch(this.route_url, {
                    method: 'GET',
                    dataType: 'json',
                });
                const result = await data.json();
                this.activityLog = result;
            }
            return this.activityLog;
        } catch (error) {
            console.log('Error: ', error);
            throw new Error(error.message);
        }
    }

    async _getUserAuditLogs(user_id){
        try {
            const response = await fetch(this.staffActivityLogRoute?.replace(':staff_id', user_id), {
                method: 'GET',
                dataType: 'json',
            });
            const result = await response.json();
            return result;
        }catch(error){
            showToastFeedback('text-bg-danger', 'Error loading user audit logs:' + error);
        }
    }
}