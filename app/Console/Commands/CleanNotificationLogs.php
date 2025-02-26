<?php

namespace App\Console\Commands;

use Exception;
use Carbon\Carbon;
use App\Models\NotificationLog;
use Illuminate\Console\Command;

class CleanNotificationLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-notification-logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean notification logs older than 15 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $this->info('Starting notification logs cleanup...');
            $oldNotifications = NotificationLog::where('created_at', '<', Carbon::now()->subDays(15))->get();
            if ($oldNotifications->isNotEmpty()) {
                $this->info('Deleting ' . count($oldNotifications) . ' notification logs...');
                foreach ($oldNotifications as $notification) {
                    $notification->delete();
                }
            } else {
                $this->info('No notification logs to delete.');
            }
            return Command::SUCCESS;
        } catch (Exception $e) {
            $this->error($e->getMessage());
            return Command::FAILURE;
        }
    }
}
