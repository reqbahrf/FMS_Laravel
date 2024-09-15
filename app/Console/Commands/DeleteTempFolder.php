<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteTempFolder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'folder:delete-temp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes files from multiple temporary folder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $folders = [
            'temp',
            'viewRequirementsTemp',
        ];

        foreach ($folders as $folderPath) {
            if (Storage::disk('public')->exists($folderPath)) {
                // Delete the folder and its contents
                Storage::disk('public')->deleteDirectory($folderPath);
                $this->info("Temporary folder '$folderPath' deleted successfully.");

                // Optionally, recreate the folder if needed
                Storage::disk('public')->makeDirectory($folderPath);
                $this->info("Temporary folder '$folderPath' recreated.");
            } else {
                $this->info("Temporary folder '$folderPath' does not exist.");
            }
        }
    }
}
