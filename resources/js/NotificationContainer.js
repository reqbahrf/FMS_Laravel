export default function NotificationContainer(NotificationData) {
    const notificationHtml = `
    <a href="#"
        class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-2">
        <div class="card-body">
            <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <div class="notify-icon bg-primary">
                        <i class="mdi mdi-comment-account-outline"></i>
                    </div>
                </div>
                <div class="flex-grow-1 ms-2 text-wrap text-break">
                    <p class="m-0 fs-5">${NotificationData.title}</p>
                    <p class="m-0 text-muted fs-6">${NotificationData.message}</p>
                    <p class="m-0 text-muted fs-6">${formatTimeAgo(NotificationData.created_at)}</p>
                </div>
            </div>
        </div>
    </a>
`;

return notificationHtml;
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
