const NotifContainer = $('#notification--container');
const BadgeAlert = $('#badge--container');

export default function NotificationContainer(NotificationData) {
    // Clear existing notifications
    NotifContainer.empty();

    if (!NotificationData) {
        const noNotificationsHtml = `
            <p id="no-notifications-message" class="text-center text-muted my-3">No Notifications</p>
        `;
        NotifContainer.html(noNotificationsHtml);
        BadgeAlert.hide();
        return;
    }

    if (Array.isArray(NotificationData)) {
        // Update badge with notification count
        const count = NotificationData.length;
        const displayCount = count > 99 ? '99+' : count;
        BadgeAlert.html(`<span class="badge rounded-pill bg-danger">${displayCount}</span>`);
        BadgeAlert.show();

        // Categorize notifications
        const categorizedNotifications = categorizeNotifications(NotificationData);
        console.log(categorizedNotifications);

        let notificationsHtml = '';
        for (const category in categorizedNotifications) {
            notificationsHtml += `
                <div class="notification-category list-group mb-3">
                    <h6 class="category-title mb-0 mt-3">${category}</h6>
                    ${categorizedNotifications[category].map(notification => `
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
                    `).join('')}
                </div>
            `;
        }

        NotifContainer.html(notificationsHtml);
    }

    // Add click handler for close buttons
    $('.noti-close-btn').off('click').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).closest('.notify-item').fadeOut(300, function() {
            $(this).remove();
            // Check if we need to show "no notifications" message
            if (NotifContainer.children().length === 0) {
                NotifContainer.html(`
                    <p id="no-notifications-message" class="text-center text-muted my-3">No Notifications</p>
                `);
                BadgeAlert.hide();
            } else {
                // Update badge count
                const newCount = NotifContainer.children().length;
                const displayCount = newCount > 99 ? '99+' : newCount;
                BadgeAlert.html(`<span class="badge rounded-pill bg-danger">${displayCount}</span>`);
            }
        });
    });
}

function categorizeNotifications(notifications) {
    const categorized = {
        'New': [],
        'Today': [],
        'Yesterday': [],
        'This Week': [],
        'Older': []
    };

    const now = new Date();
    notifications.forEach(notification => {
        const createdAt = new Date(notification.created_at);
        const diffInDays = Math.floor((now - createdAt) / (1000 * 60 * 60 * 24));

        if (notification.read_at === null) {
            categorized['New'].push(notification);
        } else if (diffInDays === 0) {
            categorized['Today'].push(notification);
        } else if (diffInDays === 1) {
            categorized['Yesterday'].push(notification);
        } else if (diffInDays <= 7) {
            categorized['This Week'].push(notification);
        } else {
            categorized['Older'].push(notification);
        }
    });

    // Remove empty categories
    for (const category in categorized) {
        if (categorized[category].length === 0) {
            delete categorized[category];
        }
    }

    return categorized;
}
