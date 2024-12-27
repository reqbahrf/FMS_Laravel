<?php

namespace App\Console\Commands;

use App\Models\FormDraft;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Exception;

class CleanOldFormDrafts extends Command
{
    protected $signature = 'form-drafts:clean {--days=1 : Number of days old to consider for deletion}';
    protected $description = 'Clean up submitted form drafts that are older than specified days (default: 1 day) and already submitted';

    public function handle()
    {
        $this->info('Starting form drafts cleanup...');

        try {
            $days = $this->option('days');
            $cutoffDate = Carbon::now()->subDays($days);

            $this->info("Cleaning up form drafts submitted before: " . $cutoffDate->format('Y-m-d H:i:s'));

            // Get count before deletion for reporting
            $totalCount = FormDraft::where('is_submitted', true)
                ->where('created_at', '<', $cutoffDate)
                ->count();

            if ($totalCount === 0) {
                $this->info("No old form drafts found to delete.");
                return Command::SUCCESS;
            }

            // Perform deletion
            $deletedCount = FormDraft::where('is_submitted', true)
                ->where('created_at', '<', $cutoffDate)
                ->delete();

            $this->info("Successfully deleted {$deletedCount} old form drafts.");
            Log::info("Form drafts cleanup completed: {$deletedCount} records deleted.");

            return Command::SUCCESS;
        } catch (Exception $e) {
            $errorMessage = "Error during form drafts cleanup: " . $e->getMessage();
            $this->error($errorMessage);
            Log::error($errorMessage);
            Log::error($e->getTraceAsString());

            return Command::FAILURE;
        }
    }
}
