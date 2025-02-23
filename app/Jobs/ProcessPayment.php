<?php

namespace App\Jobs;

use App\Services\PaymentProcessingService;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessPayment implements ShouldQueue
{
    use Queueable;

    protected $startDate;
    protected $paymentStructure;
    protected $projectId;
    /**
     * Create a new job instance.
     */
    public function __construct(
        string $startDate,
        array $paymentStructure,
        string $projectId
    ) {
        $this->startDate = $startDate;
        $this->paymentStructure = $paymentStructure;
        $this->projectId = $projectId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        PaymentProcessingService::processPayments(
            $this->startDate,
            $this->paymentStructure,
            $this->projectId
        );
    }
}
