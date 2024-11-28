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

        const notificationsHtml = NotificationData.map(notification => `
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
                            <p class="m-0 text-muted fs-6">${formatTimeAgo(notification.created_at)}</p>
                        </div>
                    </div>
                </div>
            </a>
        `).join('');

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

function formatTimeAgo(time) {
    const currentTime = new Date();
    const timeDiff = (currentTime - new Date(time)) / 1000; // in seconds

    if (timeDiff < 60) {
        return 'Just now';
    } else if (timeDiff < 3600) {
        return `${Math.floor(timeDiff / 60)} min ago`;
    } else if (timeDiff < 86400) {
        return `${Math.floor(timeDiff / 3600)} hour ago`;
    } else if (timeDiff < 604800) {
        return `${Math.floor(timeDiff / 86400)} day ago`;
    } else if (timeDiff < 2592000) {
        return `${Math.floor(timeDiff / 604800)} week ago`;
    } else {
        return `${Math.floor(timeDiff / 2592000)} month ago`;
    }
}
