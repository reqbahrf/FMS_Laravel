<?php

namespace App\Console\Commands;

use App\Models\TemporaryFile;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CleanupTemporaryFiles extends Command
{
    protected $signature = 'app:cleanup-temporary-files';
    protected $description = 'Clean up temporary files older than 5 days';

    public function handle()
    {
        $this->info('Starting temporary files cleanup...');
        
        try {
            // Find files older than 5 days
            $oldFiles = TemporaryFile::where('created_at', '<', Carbon::now()->subDays(5))->get();
            
            $totalFiles = $oldFiles->count();
            $this->info("Found {$totalFiles} files to clean up");
            
            $successCount = 0;
            $failCount = 0;
            
            foreach ($oldFiles as $file) {
                try {
                    // Delete the physical file
                    if (Storage::disk('public')->exists($file->file_path)) {
                        Storage::disk('public')->delete($file->file_path);
                    }
                    
                    // Delete the database record
                    $file->delete();
                    
                    $successCount++;
                } catch (\Exception $e) {
                    $failCount++;
                    Log::error("Failed to delete temporary file: {$file->file_path}", [
                        'error' => $e->getMessage(),
                        'file_id' => $file->id
                    ]);
                }
            }
            
            // Try to cleanup empty tmp directories
            $this->cleanupEmptyTmpDirectories();
            
            $this->info("Cleanup completed:");
            $this->info("- Successfully deleted: {$successCount} files");
            if ($failCount > 0) {
                $this->error("- Failed to delete: {$failCount} files");
            }
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Error during cleanup: " . $e->getMessage());
            Log::error("Error during temporary files cleanup", [
                'error' => $e->getMessage()
            ]);
            return Command::FAILURE;
        }
    }

    private function cleanupEmptyTmpDirectories()
    {
        $directories = Storage::disk('public')->directories('tmp');
        
        foreach ($directories as $directory) {
            if (empty(Storage::disk('public')->files($directory))) {
                Storage::disk('public')->deleteDirectory($directory);
            }
        }
    }
}
