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

    async fetchNotifications() {
        try {
            const response = await fetch(this.notificationRoute, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
                dataType: 'json',
            });
            const jsonData = await response.json();

            if (jsonData.length > 0) {
                // Transform all notifications at once
                const notifications = jsonData.map((item) => ({
                    id: item.id,
                    title: item.data.title,
                    message: item.data.message,
                    type: item.read_at,
                    created_at: item.created_at,
                    time_ago: item.time_ago,
                }));
                this._updateNotificationUI(notifications);
            } else {
                this._updateNotificationUI(null);
            }
        } catch (error) {
            console.error('Error fetching notifications:', error);
            return [];
        }
    }

    setupEventListeners() {
        Echo.private(`${this.userRole}-notifications.${this.userId}`).listen(
            '.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated',
            (data) => {
                try {
                    console.log('Raw event:', data);
                    if (!data) {
                        throw new Error('Notification data is undefined');
                    }
                    const notificationData = {
                        id: data.id,
                        title: data.data.title,
                        message: data.data.message,
                        type: data.read_at,
                        created_at: data.created_at,
                        time_ago: data.time_ago,
                    };
                    this._updateNotificationUI(notificationData);
                } catch (error) {
                    console.error('Error parsing notification ', error);
                }
            }
        );

        // Add click handler for close buttons
        this.notificationContainer.on('click', '.noti-close-btn', (e) => {
            e.preventDefault();
            e.stopPropagation();
            const item = $(e.currentTarget).closest('.notify-item');
            item.fadeOut(300, () => {
                item.remove();
                this._updateBadgeAndNoMessage();
            });
        });
    }

    _updateNotificationUI(notificationData) {
        this.notificationContainer.empty();

        if (!notificationData) {
            const noNotificationsHtml = `
                <p id="no-notifications-message" class="text-center text-muted my-3">No Notifications</p>
            `;
            this.notificationContainer.html(noNotificationsHtml);
            this.badgeAlert.hide();
            return;
        }

        if (Array.isArray(notificationData)) {
            const count = notificationData.length;
            const displayCount = count > 99 ? '99+' : count;
            this.badgeAlert.html(
                `<span class="badge rounded-pill bg-danger">${displayCount}</span>`
            );
            this.badgeAlert.show();

            const categorizedNotifications =
                this._categorizeNotifications(notificationData);
            let notificationsHtml = '';
            for (const category in categorizedNotifications) {
                notificationsHtml += `
                    <div class="notification-category list-group mb-3">
                        <h6 class="category-title mb-0 mt-3">${category}</h6>
                        ${categorizedNotifications[category]
                            .map(
                                (notification) => `
                            <a href="#" data-id="${notification.id}"
                                class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-2 notification-fade-in">
                                <div class="card-body">
                                    <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="notify-icon bg-primary">
                                                <i class="mdi mdi-comment-account-outline"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-2 text-wrap text-break">
                                            <p class="m-0 fs-5">${notification.title}</p>
                                            <p class="m-0 text-muted fs-6">${notification.message}</p>
                                            <p class="m-0 text-muted fs-6">${notification.time_ago}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        `
                            )
                            .join('')}
                    </div>
                `;
            }
            this.notificationContainer.html(notificationsHtml);
        } else {
            // Handle single notification
            const count = this.notificationContainer.children().length + 1;
            const displayCount = count > 99 ? '99+' : count;
            this.badgeAlert.html(
                `<span class="badge rounded-pill bg-danger">${displayCount}</span>`
            );
            this.badgeAlert.show();

            const categorizedNotifications = this._categorizeNotifications([
                notificationData,
            ]);
            let notificationsHtml = '';
            for (const category in categorizedNotifications) {
                notificationsHtml += `
                    <div class="notification-category list-group mb-3">
                        <h6 class="category-title mb-0 mt-3">${category}</h6>
                        ${categorizedNotifications[category]
                            .map(
                                (notification) => `
                            <a href="#" data-id="${notification.id}"
                                class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-2 notification-fade-in">
                                <div class="card-body">
                                    <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="notify-icon bg-primary">
                                                <i class="mdi mdi-comment-account-outline"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-2 text-wrap text-break">
                                            <p class="m-0 fs-5">${notification.title}</p>
                                            <p class="m-0 text-muted fs-6">${notification.message}</p>
                                            <p class="m-0 text-muted fs-6">${notification.time_ago}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        `
                            )
                            .join('')}
                    </div>
                `;
            }
            this.notificationContainer.prepend(notificationsHtml);
        }
    }

    _updateBadgeAndNoMessage() {
        if (this.notificationContainer.children().length === 0) {
            this.notificationContainer.html(`
                <p id="no-notifications-message" class="text-center text-muted my-3">No Notifications</p>
            `);
            this.badgeAlert.hide();
        } else {
            const newCount = this.notificationContainer.children().length;
            const displayCount = newCount > 99 ? '99+' : newCount;
            this.badgeAlert.html(
                `<span class="badge rounded-pill bg-danger">${displayCount}</span>`
            );
        }
    }

    _categorizeNotifications(notifications) {
        if (!Array.isArray(notifications)) {
            throw new Error('Notifications must be an array');
        }

        const categorized = new Map();
        Object.values(NotificationManager.CATEGORIES).forEach((category) => {
            categorized.set(category, []);
        });

        const now = new Date('2025-01-12T09:16:17+08:00');

        notifications.forEach((notification) => {
            if (!notification?.created_at) {
                console.warn(
                    'Notification missing created_at timestamp',
                    notification
                );
                return;
            }

            const createdAt = new Date(notification.created_at);
            const timeDiff = now - createdAt;
            const diffInDays = Math.floor(
                timeDiff / NotificationManager.TIME_INTERVALS.DAY
            );

            if (notification.read_at === null) {
                categorized
                    .get(NotificationManager.CATEGORIES.NEW)
                    .push(notification);
            } else if (diffInDays === 0) {
                categorized
                    .get(NotificationManager.CATEGORIES.TODAY)
                    .push(notification);
            } else if (diffInDays === 1) {
                categorized
                    .get(NotificationManager.CATEGORIES.YESTERDAY)
                    .push(notification);
            } else if (diffInDays <= 7) {
                categorized
                    .get(NotificationManager.CATEGORIES.THIS_WEEK)
                    .push(notification);
            } else {
                categorized
                    .get(NotificationManager.CATEGORIES.OLDER)
                    .push(notification);
            }
        });

        // Convert Map back to object and remove empty categories
        const result = {};
        for (const [category, notifications] of categorized) {
            if (notifications.length > 0) {
                result[category] = notifications;
            }
        }

        return result;
    }
}

export default NotificationManager;
