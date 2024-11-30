<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OngoingQuarterlyReport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CloseQuarterlyReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reports:close';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically close quarterly reports when the open_until date is reached';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to close expired quarterly reports...');

        try {
            $currentDate = Carbon::now()->toDateString();

            // Get the count of reports that will be affected
            $reportsToClose = OngoingQuarterlyReport::where('open_until', '<=', $currentDate)
                ->where('report_status', 'open')
                ->count();

            if ($reportsToClose === 0) {
                $this->info('No expired reports found to close.');
                return Command::SUCCESS;
            }

            // Perform the update
            OngoingQuarterlyReport::where('open_until', '<=', $currentDate)
                ->where('report_status', 'open')
                ->update(['report_status' => 'closed']);

            $message = "{$reportsToClose} expired quarterly report(s) closed successfully";
            $this->info($message);
            Log::info($message);

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $errorMessage = "Error while closing quarterly reports: " . $e->getMessage();
            $this->error($errorMessage);
            Log::error($errorMessage);

            return Command::FAILURE;
        }
    }
}
