<?php

namespace App\Jobs;

use App\Services\PaymentProcessingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $startDate,
        public array $paymentStructure,
        public string $projectId,
        public ?array $refundedPayments = null
    ) {}

    /**
     * Execute the job.
     */
    public function handle(PaymentProcessingService $service): void
    {
        try {
            $service->processPayments(
                $this->startDate,
                $this->paymentStructure,
                $this->projectId,
                $this->refundedPayments
            );
        } catch (\Exception $e) {
            Log::error('Error processing payment: ' . $e->getMessage());
            throw $e; // Re-throw the exception to mark the job as failed
        }
    }
}
