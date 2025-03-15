<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\RequirementToProjectFileTransferService;
use Illuminate\Database\Eloquent\Collection;

class TransferRequirementFiles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $requirements;
    protected $projectId;
    protected $fileTransferService;

    /**
     * Create a new job instance.
     *
     * @param Collection $requirements
     * @param string $projectId
     * @param RequirementToProjectFileTransferService $fileTransferService
     * @return void
     */
    public function __construct(
        Collection $requirements,
        string $projectId,
        RequirementToProjectFileTransferService $fileTransferService
    ) {
        $this->requirements = $requirements;
        $this->projectId = $projectId;
        $this->fileTransferService = $fileTransferService;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!$this->fileTransferService) {
            $this->fileTransferService = app(RequirementToProjectFileTransferService::class);
        }

        $this->fileTransferService->transferMultipleFiles($this->requirements, $this->projectId);
    }
}
