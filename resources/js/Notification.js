import NotificationContainer from "./NotificationContainer";
export default async function Notification(){
    try {
        const response = await fetch(NOTIFICATION_ROUTE, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            dataType: 'json',
        });

        const jsonData = await response.json();

        if(jsonData.length > 0) {
            // Transform all notifications at once
            const notifications = jsonData.map((item) => ({
                id: item.id,
                title: item.data.title,
                message: item.data.message,
                type: item.read_at,
                created_at: item.created_at
            }));
            
            // Pass all notifications at once
            NotificationContainer(notifications);
        } else {
            NotificationContainer(null);
        }

    } catch (error) {
        console.error('Error:', error);
    }
}
