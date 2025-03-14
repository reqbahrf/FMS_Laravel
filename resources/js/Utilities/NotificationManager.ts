
/**
 * Manages notifications for a user, including fetching, displaying, and handling real-time updates.
 * @exports NotificationManager
 * @requires jquery
 * @requires top-navigation.blade.php component
 *
 * **Notes**
 * - This class is relay on On top-navigation.blade.php component to display notifications.
 */

interface NotificationData {
    title: string;
    message: string;
}

interface NotificationItem {
    id: number;
    data: NotificationData;
    read_at: string | null;
    type: string | null;
    created_at: string;
    time_ago: string;
}
interface ProcessNotificationItem {
    id: number;
    title: string;
    message: string;
    created_at: string;
    time_ago: string;
    type: string | null;
}
interface UpdateOptions {
    append: boolean;
    updateBadge: boolean;
}


class NotificationManager {
    
    private notificationRoute: string;
    private userId: string;
    private userRole: string;
    private notificationContainer: JQuery;
    private badgeAlert: JQuery;
    private currentPage: number;
    private isLoading: boolean;
    private hasMore: boolean;
    private notifications: any[];
    private unreadCount: number;
    constructor(notificationRoute: string, userId: string, userRole: string) {
        this.notificationRoute = notificationRoute;
        this.userId = userId;
        this.userRole = userRole;
        this.notificationContainer = $('#notification--container');
        this.badgeAlert = $('#badge--container');
        this.currentPage = 1;
        this.isLoading = false;
        this.hasMore = true;
        this.notifications = [];
        this.unreadCount = 0;
    }

    static ECHO_NOTIFICATION_CHANNEL =
        '.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated';

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

    /**
     * Fetches notifications from the server.
     * This method retrieves notifications, updates the internal state, and triggers UI updates.
     * It supports pagination and prevents concurrent loading.
     *
     * @async
     * @function fetchNotifications
     * @memberof NotificationManager
     *
     * @param {number} [page=1] - The page number to fetch.
     *
     * @throws {Error} If there is an error during the fetch operation.
     *
     * @fires NotificationManager#_updateNotificationUI
     *
     * @example
     * // Example of fetching the first page of notifications
     * this.fetchNotifications();
     *
     * @example
     * // Example of fetching the second page of notifications
     * this.fetchNotifications(2);
     */
    async fetchNotifications(page = 1) {
        if (this.isLoading || (!this.hasMore && page > 1)) return;

        this.isLoading = true;
        try {
            const response = await fetch(
                `${this.notificationRoute}?page=${page}&limit=10`,
                {
                    method: 'GET',
                }
            );
            const data = await response.json();

            this.hasMore = data.has_more;
            this.currentPage = page;

            if (data.notifications.length > 0) {
                const notifications = data.notifications.map((item: NotificationItem) => ({
                    id: item.id,
                    title: item.data.title,
                    message: item.data.message,
                    type: item.read_at,
                    created_at: item.created_at,
                    time_ago: item.time_ago,
                }));
                this.notifications = notifications;
                this.unreadCount = data.unread;
                this._updateNotificationUI(notifications, {
                    append: page > 1,
                    updateBadge: true,
                });
            } else if (page === 1) {
                this._updateNotificationUI([], {
                    append: false,
                    updateBadge: true,
                });
            }
        } catch (error) {
            console.error('Error fetching notifications:', error);
        } finally {
            this.isLoading = false;
        }
    }

    /**
     * Updates the notification badge count in the UI.
     * If the count is greater than zero, it displays the badge with the count.
     * Otherwise, it hides the badge.
     *
     * @private
     * @function _updateBadgeCount
     * @memberof NotificationManager
     *
     * @param {number} count - The number of unread notifications to display on the badge.
     *
     * @example
     * // Example of updating the badge count
     * this._updateBadgeCount(5); // Displays a badge with the number 5
     * this._updateBadgeCount(0); // Hides the badge
     */
    _updateBadgeCount(count: number) {
        if (count > 0) {
            this.badgeAlert
                .html(
                    `<span class="badge bg-danger rounded-pill">${count}</span>`
                )
                .show();
        } else {
            this.badgeAlert.hide();
        }
    }

    /**
     * Update the notification UI with new notifications
     * @param {Array} [notifications=null] - Optional notifications array. If not provided, uses this.notifications
     * @param {Object} [options={ append: false, updateBadge: true }] - Update options
     */
    _updateNotificationUI(
        notifications: NotificationItem[] | null = null,
        options: UpdateOptions = { append: false, updateBadge: true }
    ) {
        const notificationsToShow = notifications || this.notifications;

        if (!notificationsToShow || notificationsToShow.length === 0) {
            if (!options.append) {
                this.notificationContainer.html(
                    '<div class="text-center py-3">No notifications</div>'
                );
            }
            return;
        }

        // Group notifications by category
        const categorizedNotifications =
            this._categorizeNotifications(notificationsToShow);

        const notificationHTML = Object.entries(categorizedNotifications)
            .map(([category, items]) => {
                if (items.length === 0) return '';

                const categoryId = `category-${category.toLowerCase().replace(/\s+/g, '-')}`;
                const notificationItems = items
                    .map(
                        (notification: ProcessNotificationItem) => /*html*/`
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
            `
                    )
                    .join('');

                if (options.append) {
                    const existingCategory = this.notificationContainer.find(
                        `#${categoryId}`
                    );
                    if (existingCategory.length) {
                        existingCategory
                            .find('.notification-items')
                            .append(notificationItems);
                        return '';
                    }
                }

                return `
                <div class="notification-category" id="${categoryId}">
                    <h6 class="notification-category-title px-2 pt-2">${category}</h6>
                    <div class="notification-items">
                        ${notificationItems}
                    </div>
                </div>
            `;
            })
            .join('');

        if (options.append) {
            // Filter out empty strings before appending
            if (notificationHTML.trim()) {
                this.notificationContainer.append(notificationHTML);
            }
        } else {
            this.notificationContainer.html(notificationHTML);
        }

        // Update badge count if needed
        if (options.updateBadge) {
            this._updateBadgeCount(this.unreadCount);
        }
    }

    /**
     * Categorizes notifications based on their creation date.
     * @param {Array<Object>} notifications - An array of notification objects.
     * @returns {Object} An object containing categorized notifications.
     * @private
     */
    _categorizeNotifications(notifications: Array<ProcessNotificationItem>): Record<string, ProcessNotificationItem[]> {
        const now = new Date();
        const categories: Record<string, ProcessNotificationItem[]> = {
            [NotificationManager.CATEGORIES.NEW]: [],
            [NotificationManager.CATEGORIES.TODAY]: [],
            [NotificationManager.CATEGORIES.YESTERDAY]: [],
            [NotificationManager.CATEGORIES.THIS_WEEK]: [],
            [NotificationManager.CATEGORIES.OLDER]: [],
        };

        notifications.forEach((notification) => {
            const notificationDate = new Date(notification.created_at);
            const timeDiff = Number(now) - Number(notificationDate);
            const daysDiff = Math.floor(
                timeDiff / NotificationManager.TIME_INTERVALS.DAY
            );

            // Convert NotificationItem to ProcessNotificationItem
            const processNotification: ProcessNotificationItem = {
                id: notification.id,
                title: notification.title,
                message: notification.message,
                type: notification.type,
                created_at: notification.created_at,
                time_ago: notification.time_ago,
            };

            if (!notification.type) {
                categories[NotificationManager.CATEGORIES.NEW].push(
                    processNotification
                );
            } else if (daysDiff === 0) {
                categories[NotificationManager.CATEGORIES.TODAY].push(
                    processNotification
                );
            } else if (daysDiff === 1) {
                categories[NotificationManager.CATEGORIES.YESTERDAY].push(
                    processNotification
                );
            } else if (daysDiff <= 7) {
                categories[NotificationManager.CATEGORIES.THIS_WEEK].push(
                    processNotification
                );
            } else {
                categories[NotificationManager.CATEGORIES.OLDER].push(
                    processNotification
                );
            }
        });

        return categories;
    }

    /**
     * Sets up event listeners for real-time notifications using Laravel Echo.
     * This method listens on a private channel specific to the user and their role,
     * processing incoming notifications and updating the UI accordingly.
     *
     *
     * @function setupEventListeners
     * @memberof NotificationManager
     *
     * @throws {Error} If the notification data is undefined or cannot be parsed.
     *
     * @listens Echo~private:userRole-notifications.userId
     * @fires NotificationManager#_updateNotificationUI
     *
     * @example
     * // Example of how the notification data is structured
     * {
     *   id: 123,
     *    {
     *     title: 'New Message',
     *     message: 'You have a new message from John Doe.',
     *     read_at: null,
     *   },
     *   created_at: '2023-10-27T12:00:00.000Z',
     *   time_ago: '5 minutes ago',
     * }
     */
    setupEventListeners() {
        Echo.private(`${this.userRole}.notifications.${this.userId}`).notification((notification: any) => {
                try {
                    if (!notification || !notification.data) {
                        throw new Error('Notification data is undefined');
                    }

                    // First parse: the entire notification data
                    const parsedData =
                        typeof notification.data === 'string'
                            ? JSON.parse(notification.data)
                            : notification.data;

                    const NOTIFICATION_OBJECT = {
                        id: notification.id,
                        title: parsedData.title,
                        message: parsedData.message,
                        type: notification.read_at,
                        created_at: notification.created_at,
                        time_ago: notification.time_ago,
                    };

                    // Add the new notification to the beginning of the list
                    this.notifications.unshift(NOTIFICATION_OBJECT);

                    // Update the unread count
                    if (!parsedData.read_at) {
                        this.unreadCount++;
                    }

                    // Trigger UI update
                    this._updateNotificationUI();
                } catch (error) {
                    console.error(
                        'Error parsing notification:',
                        error,
                        'Raw data:',
                        notification
                    );
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
                    headers: new Headers({
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content'
                        ) || '',
                    }),
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
                const { scrollTop, scrollHeight, clientHeight } =
                    this.notificationContainer[0];
                if (scrollTop + clientHeight >= scrollHeight - 50) {
                    this.fetchNotifications(this.currentPage + 1);
                }
            }
        });

        // Add click handler for "Clear All" button
        $('#clearAllNotifications').on('click', async (e) => {
            e.preventDefault();
            e.stopPropagation();

            try {
                const response = await fetch('/notifications/mark-all-read', {
                    method: 'POST',
                    headers: new Headers({
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content'
                        ) || '',
                    }),
                });

                if (response.ok) {
                    // Fade out all notifications with animation
                    const notifications =
                        this.notificationContainer.find('.notify-item');
                    notifications.fadeOut(300, () => {
                        // After fade out, show no notifications message
                        this.notificationContainer.html(
                            '<div class="text-center py-3">No notifications</div>'
                        );
                        this.badgeAlert.hide();
                    });
                }
            } catch (error) {
                console.error('Error clearing all notifications:', error);
            }
        });
    }

    /**
     * Updates the badge and no message display based on the number of notifications.
     * Hides the badge and displays "No notifications" if there are no notifications,
     * otherwise shows the badge with the total number of notifications.
     * @private
     */
    _updateBadgeAndNoMessage() {
        // Check if any notifications exist in any category
        const totalNotifications =
            this.notificationContainer.find('.notify-item').length;

        if (totalNotifications === 0) {
            this.notificationContainer.html(
                '<div class="text-center py-3">No notifications</div>'
            );
            this.badgeAlert.hide();
        } else {
            // Clean up empty categories
            this.notificationContainer
                .find('.notification-category')
                .each((_, category) => {
                    const $category = $(category);
                    if ($category.find('.notify-item').length === 0) {
                        $category.remove();
                    }
                });
        }
    }
}

export default NotificationManager;
