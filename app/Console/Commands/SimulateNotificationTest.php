<?php

namespace App\Console\Commands;

use App\Events\ProjectEvent;
use App\Models\User;
use Illuminate\Console\Command;

class SimulateNotificationTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:simulate {notificationClass} {--users=} {--count=1}';
    protected $description = 'Simulate notifications for testing purposes';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $notificationClass = $this->argument('notificationClass');
        $count = $this->option('count');
        
        // Validate notification class
        if (!class_exists($notificationClass)) {
            $this->error("Notification class not found: {$notificationClass}");
            return 1;
        }

        // Get target users (Staff and Admin by default)
        $users = $this->option('users') 
            ? User::whereIn('id', explode(',', $this->option('users')))->get()
            : User::whereIn('role', ['Staff', 'Admin'])->get();
            
        $this->info("Simulating {$count} notification(s) for " . $users->count() . " users...");

        for ($i = 0; $i < $count; $i++) {
            // Create a sample project event
            $event = new ProjectEvent(
                businessId: rand(1, 100),
                enterprise_type: 'Sample Enterprise',
                enterprise_level: 'Level ' . rand(1, 3),
                city: 'Sample City',
                event_type: 'new_applicant'
            );

            // Send notification to each user
            foreach ($users as $user) {
                $user->notify(new $notificationClass($event, $users));
            }

            $this->info("Sent notification " . ($i + 1) . " of {$count}");
            
            // Add a small delay to prevent overwhelming the system
            if ($i < $count - 1) {
                sleep(1);
            }
        }

        $this->info('Notification simulation completed!');
        return 0;
    }
}
