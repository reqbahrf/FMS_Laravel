/**
 * Manages notifications for a user, including fetching, displaying, and handling real-time updates.
 * @exports NotificationManager
 * @requires jquery
 * @requires top-navigation.blade.php component
 * 
 * **Notes**
 * - This class is relay on On top-navigation.blade.php component to display notifications.
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

        // Group notifications by category
        const categorizedNotifications = this._categorizeNotifications(notifications);
        
        const notificationHTML = Object.entries(categorizedNotifications).map(([category, items]) => {
            if (items.length === 0) return '';
            
            const categoryId = `category-${category.toLowerCase().replace(/\s+/g, '-')}`;
            const notificationItems = items.map(notification => `
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
                const existingCategory = this.notificationContainer.find(`#${categoryId}`);
                if (existingCategory.length) {
                    existingCategory.find('.notification-items').append(notificationItems);
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
        }).join('');

        if (append) {
            // Filter out empty strings before appending
            if (notificationHTML.trim()) {
                this.notificationContainer.append(notificationHTML);
            }
        } else {
            this.notificationContainer.html(notificationHTML);
        }
    }


     /**
     * Categorizes notifications based on their creation date.
     * @param {Array<Object>} notifications - An array of notification objects.
     * @returns {Object} An object containing categorized notifications.
     * @private
     */
    _categorizeNotifications(notifications) {
        const now = new Date();
        const categories = {
            [NotificationManager.CATEGORIES.NEW]: [],
            [NotificationManager.CATEGORIES.TODAY]: [],
            [NotificationManager.CATEGORIES.YESTERDAY]: [],
            [NotificationManager.CATEGORIES.THIS_WEEK]: [],
            [NotificationManager.CATEGORIES.OLDER]: []
        };

        notifications.forEach(notification => {
            const notificationDate = new Date(notification.created_at);
            const timeDiff = now - notificationDate;
            const daysDiff = Math.floor(timeDiff / NotificationManager.TIME_INTERVALS.DAY);

            if (!notification.type) {
                categories[NotificationManager.CATEGORIES.NEW].push(notification);
            } else if (daysDiff === 0) {
                categories[NotificationManager.CATEGORIES.TODAY].push(notification);
            } else if (daysDiff === 1) {
                categories[NotificationManager.CATEGORIES.YESTERDAY].push(notification);
            } else if (daysDiff <= 7) {
                categories[NotificationManager.CATEGORIES.THIS_WEEK].push(notification);
            } else {
                categories[NotificationManager.CATEGORIES.OLDER].push(notification);
            }
        });

        return categories;
    }


     /**
     * Sets up event listeners for new notifications using Laravel Echo.
     * It listens for the `BroadcastNotificationCreated` event on a private channel specific to the user.
     * When a new notification is received, it resets the current page and fetches the updated notifications.
     */
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

        // Add click handler for "Clear All" button
        $('#clearAllNotifications').on('click', async (e) => {
            e.preventDefault();
            e.stopPropagation();
            
            try {
                const response = await fetch('/notifications/mark-all-read', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });

                if (response.ok) {
                    // Fade out all notifications with animation
                    const notifications = this.notificationContainer.find('.notify-item');
                    notifications.fadeOut(300, () => {
                        // After fade out, show no notifications message
                        this.notificationContainer.html('<div class="text-center py-3">No notifications</div>');
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
        const totalNotifications = this.notificationContainer.find('.notify-item').length;
        
        if (totalNotifications === 0) {
            this.notificationContainer.html('<div class="text-center py-3">No notifications</div>');
            this.badgeAlert.hide();
        } else {
            // Clean up empty categories
            this.notificationContainer.find('.notification-category').each((_, category) => {
                const $category = $(category);
                if ($category.find('.notify-item').length === 0) {
                    $category.remove();
                }
            });
        }
    }
}

export default NotificationManager;
