<?php

namespace App\Services\Settings;

use Exception;
use App\Models\ProjectSetting;

/**
 * Service class for managing notification settings related to deadlines.
 *
 * Handles retrieval, creation, updating, and checking existence of
 * notification duration settings in the project settings.
 */
class NotifyOnService
{
    public const DURATION_KEY = 'duration_before_deadline';
    public const INTERVAL_KEY = 'notify_interval';

    public function __construct(
        private ProjectSetting $projectSetting
    ) {}

    /**
     * Retrieves the notification duration in days before deadline.
     *
     * @return int The number of days before deadline to send notifications (defaults to 15 if not found)
     * @throws Exception If an error occurs during retrieval
     */
    public function getNotifyDuration(): int
    {
        try {
            $dayDurationBeforeDeadline = $this->projectSetting
                ->where('key', self::DURATION_KEY)
                ->first()
                ->value ?? 15;

            return (int) $dayDurationBeforeDeadline;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Retrieves the notification frequency setting.
     *
     * @return int The Interval of notifications before sending new notification in days (defaults to 5 if not found)
     * @throws Exception If an error occurs during retrieval
     */
    public function getNotifyEvery(): int
    {
        try {
            $dayDurationBeforeDeadline = $this->projectSetting
                ->where('key', self::INTERVAL_KEY)
                ->first()
                ->value ?? 5;

            return (int) $dayDurationBeforeDeadline;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Updates or creates the notification duration setting in days before deadline.
     *
     * @param int $dayDurationBeforeDeadline The number of days before deadline to send notifications
     * @return void
     * @throws Exception If an error occurs during update or creation
     */
    public function updateOrCreateNotifyDuration(int $dayDurationBeforeDeadline): void
    {
        try {
            $this->projectSetting->updateOrCreate(
                ['key' => self::DURATION_KEY],
                ['value' => $dayDurationBeforeDeadline]
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Updates or creates the notification frequency setting in days.
     *
     * @param int $dayDurationBeforeDeadline The interval in days before sending new notifications
     * @return void
     * @throws Exception If an error occurs during update or creation
     */
    public function updateOrCreateNotifyEvery(int $dayDurationBeforeDeadline): void
    {
        try {
            $this->projectSetting->updateOrCreate(
                ['key' => self::INTERVAL_KEY],
                ['value' => $dayDurationBeforeDeadline]
            );
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Checks if the day before deadline notification setting exists.
     *
     * @return bool True if the setting exists, false otherwise
     */
    public function notifyDurationExists(): bool
    {
        return $this->projectSetting
            ->where('key', self::DURATION_KEY)
            ->exists();
    }
}
