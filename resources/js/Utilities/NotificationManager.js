/**
 * Manages notifications for a user, including fetching, displaying, and handling real-time updates.
 */
class NotificationManager {
    /**
     * Constructor for the NotificationManager class.
     * @param {string} notificationRoute - The API endpoint to fetch notifications.
     * @param {string} userId - The ID of the current user.
     * @param {string} userRole - The role of the current user.
     */
    constructor(notificationRoute, userId, userRole) {
        this.notificationRoute = notificationRoute;
        this.userId = userId;
        this.userRole = userRole;
        this.notificationContainer = $('#notification--container');
        this.badgeAlert = $('#badge--container');
        this.currentPage = 1;
        this.isLoading = false;
        this.hasMore = true;
    }

    // Constants for notification categories
    static CATEGORIES = {
        NEW: 'New',
        TODAY: 'Today',
        YESTERDAY: 'Yesterday',
        THIS_WEEK: 'This Week',
        OLDER: 'Older',
    };

    // Constants for time intervals in milliseconds
    static TIME_INTERVALS = {
        DAY: 24 * 60 * 60 * 1000,
        WEEK: 7 * 24 * 60 * 60 * 1000,
    };

    async fetchNotifications(page = 1) {
        if (this.isLoading || (!this.hasMore && page > 1)) return;
        
        this.isLoading = true;
        try {
            const response = await fetch(`${this.notificationRoute}?page=${page}&limit=10`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                dataType: 'json',
            });
            const data = await response.json();
            
            this.hasMore = data.has_more;
            this.currentPage = page;

            if (data.notifications.length > 0) {
                const notifications = data.notifications.map((item) => ({
                    id: item.id,
                    title: item.data.title,
                    message: item.data.message,
                    type: item.read_at,
                    created_at: item.created_at,
                    time_ago: item.time_ago,
                }));
                this._updateNotificationUI(notifications, page > 1);
                this._updateBadgeCount(data.unread);
            } else if (page === 1) {
                this._updateNotificationUI(null);
            }
        } catch (error) {
            console.error('Error fetching notifications:', error);
        } finally {
            this.isLoading = false;
        }
    }

    _updateBadgeCount(count) {
        if (count > 0) {
            this.badgeAlert.html(`<span class="badge bg-danger rounded-pill">${count}</span>`).show();
        } else {
            this.badgeAlert.hide();
        }
    }

    _updateNotificationUI(notifications, append = false) {
        if (!notifications) {
            this.notificationContainer.html('<div class="text-center py-3">No notifications</div>');
            return;
        }

        const notificationHTML = notifications.map(notification => `
            <div class="notify-item ${!notification.type ? 'unread' : ''}" data-id="${notification.id}">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="m-0 font-14">${notification.title}</h5>
                        <p class="m-0 text-muted font-13 text-truncate">${notification.message}</p>
                        <p class="m-0 text-muted font-11">
                            <small>${notification.time_ago}</small>
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <button class="btn btn-sm btn-link noti-close-btn">
                            <i class="ri-close-line text-muted"></i>
                        </button>
                    </div>
                </div>
            </div>
        `).join('');

        if (append) {
            this.notificationContainer.append(notificationHTML);
        } else {
            this.notificationContainer.html(notificationHTML);
        }
    }

    setupEventListeners() {
        Echo.private(`${this.userRole}-notifications.${this.userId}`).listen(
            '.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated',
            (data) => {
                try {
                    if (!data) {
                        throw new Error('Notification data is undefined');
                    }
                    this.currentPage = 1;
                    this.fetchNotifications();
                } catch (error) {
                    console.error('Error parsing notification ', error);
                }
            }
        );

        // Add click handler for close buttons
        this.notificationContainer.on('click', '.noti-close-btn', async (e) => {
            e.preventDefault();
            e.stopPropagation();
            const item = $(e.currentTarget).closest('.notify-item');
            const notificationId = item.data('id');
            
            try {
                await fetch(`/notifications/${notificationId}/mark-as-read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                item.fadeOut(300, () => {
                    item.remove();
                    this._updateBadgeAndNoMessage();
                });
            } catch (error) {
                console.error('Error marking notification as read:', error);
            }
        });

        // Add scroll listener for infinite loading
        this.notificationContainer.on('scroll', () => {
            if (this.hasMore && !this.isLoading) {
                const { scrollTop, scrollHeight, clientHeight } = this.notificationContainer[0];
                if (scrollTop + clientHeight >= scrollHeight - 50) {
                    this.fetchNotifications(this.currentPage + 1);
                }
            }
        });

        // Add click handler for "View All" button
        $('.dropdown-item.text-center').on('click', async (e) => {
            e.preventDefault();
            try {
                await fetch('/notifications/mark-all-read', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                this.fetchNotifications(1);
            } catch (error) {
                console.error('Error marking all notifications as read:', error);
            }
        });
    }

    _updateBadgeAndNoMessage() {
        if (this.notificationContainer.children('.notify-item').length === 0) {
            this.notificationContainer.html('<div class="text-center py-3">No notifications</div>');
            this.badgeAlert.hide();
        }
    }
}

export default NotificationManager;
