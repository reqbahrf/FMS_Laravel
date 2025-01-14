<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use ReflectionClass;

class SimulateEventTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:simulate {eventClass} {--count=1} {--data=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Simulate events and their associated notifications for testing purposes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $eventClass = $this->argument('eventClass');
        $count = $this->option('count');

        // Validate event class
        if (!class_exists($eventClass)) {
            $this->error("Event class not found: {$eventClass}");
            return 1;
        }

        $this->info("Simulating {$count} event(s)...");

        // Parse event data from JSON if provided
        $eventData = [];
        if ($this->option('data')) {
            $eventData = json_decode($this->option('data'), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->error("Invalid JSON data provided");
                return 1;
            }
        }

        // Get constructor parameters using reflection
        $reflection = new ReflectionClass($eventClass);
        $constructor = $reflection->getConstructor();

        for ($i = 0; $i < $count; $i++) {
            try {
                // Create event instance based on provided data
                $event = $constructor
                    ? new $eventClass(...array_values($eventData))
                    : new $eventClass();

                // Dispatch the event
                event($event);

                $this->info("Dispatched event " . ($i + 1) . " of {$count}");

                // Add a small delay to prevent overwhelming the system
                if ($i < $count - 1) {
                    sleep(1);
                }
            } catch (\Exception $e) {
                $this->error("Error dispatching event: " . $e->getMessage());
                return 1;
            }
        }

        $this->info('Event simulation completed!');
        return 0;
    }
}
