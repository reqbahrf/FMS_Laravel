import { customDateFormatter, showToastFeedback } from './utilFunctions';

export default class ActivityLogHandler {
    constructor(modalContainer){
        this.activityLog = [];
        this.modalContainer = modalContainer;
        this.route_url = USER_ACTIVITY_LOG_ROUTE;
    }

    init() {
        this.modalContainer.on('show.bs.modal', async (e) => {
            try {
                const ActivityTableLog = $(e.target).find('.modal-body #userActivityLogTable tbody');
                ActivityTableLog.empty();
                const data = await this.getActivityLog();
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

    async getActivityLog() {
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
}