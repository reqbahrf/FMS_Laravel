<?php

namespace App\Jobs;

use App\Actions\PaymentProcessingService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

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
    ) {}

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
