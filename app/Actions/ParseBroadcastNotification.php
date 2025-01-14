<?php

namespace App\Actions;

use Exception;
use RuntimeException;

/**
 * Executes the parsing of a broadcast notification.
 *
 * @param object $notifiable The notifiable entity.
 * @param string $notificationClass The notification class.
 *
 * @throws Exception
 * @throws RuntimeException
 *
 * @return array An array containing the notification data.
 */
class ParseBroadcastNotification
{
    public static function execute(object $notifiable, string $notificationClass): array
    {
        try {
            $notification = $notifiable->notifications()
                ->where('type', $notificationClass)
                ->latest()
                ->first();

            if (!$notification) {
                throw new RuntimeException('Notification not found');
            }

            $timeAgo = CalculateTimeAgo::execute($notification->created_at);

            return (array) [
                'id' => $notification->id,
                'data' => $notification->data,
                'read_at' => $notification->read_at,
                'created_at' => $notification->created_at,
                'time_ago' => $timeAgo,
            ];
        } catch (Exception $e) {
            throw $e;
        }
    }
}
