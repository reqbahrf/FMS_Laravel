<?php

namespace App\Console\Commands;

use Exception;
use App\Models\User;
use App\Models\ProjectInfo;
use App\Models\PaymentRecord;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use App\Notifications\DuePayment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;


class CheckDuePayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-due-payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check due payments and send email and notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {


            $this->info('Checking due payments...');
            $projectIDs = $this->getUniqueProjectIds();
            foreach ($projectIDs as $projectId) {
                $this->updatePaymentStatus($projectId);
                $duePayments = $this->getDuePayments($projectId);
                if ($duePayments->isNotEmpty()) {
                    $this->info("Found " . $duePayments->count() . " due payments for project ID: {$projectId}" . " that will be due on: " . Carbon::now()->addDays(15)->format('Y-m-d'));
                    $this->processDuePayments($duePayments);
                } else {
                    $this->info("No due payments found for project ID: {$projectId} with due date: " . Carbon::now()->addDays(15)->format('Y-m-d'));
                }
            }
            return Command::SUCCESS;
        } catch (Exception $e) {
            Log::error('Error checking due payments: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
    protected function getUniqueProjectIds(): Collection
    {
        try {
            $projectID = PaymentRecord::distinct()->pluck('Project_id');
            return $projectID;
        } catch (Exception $e) {
            throw $e;
        }
    }
    protected function updatePaymentStatus(string $projectId): void
    {
        try {
            $this->info("Updating payment status for project ID: {$projectId}");

            $currentDate = now()->format('Y-m-d');
            $pendingPayments = PaymentRecord::where('Project_id', $projectId)
                ->where('payment_status', 'Pending')->get();

            $duePaymentIds = [];
            $overduePaymentIds = [];

            foreach ($pendingPayments as $payment) {
                if ($payment->due_date->format('Y-m-d') == $currentDate) {
                    $duePaymentIds[] = $payment->id;
                } else if ($payment->due_date->format('Y-m-d') < $currentDate) {
                    $overduePaymentIds[] = $payment->id;
                }
            }

            if (!empty($duePaymentIds)) {
                $this->info("Found " . count($duePaymentIds) . " due payments for project ID: {$projectId}");
                PaymentRecord::whereIn('id', $duePaymentIds)->update(['payment_status' => 'Due']);
            }
            if (!empty($overduePaymentIds)) {
                $this->info("Found " . count($overduePaymentIds) . " overdue payments for project ID: {$projectId}");
                PaymentRecord::whereIn('id', $overduePaymentIds)->update(['payment_status' => 'Overdue']);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    protected function getDuePayments(string $projectId): Collection
    {
        try {

            $this->info("Getting due or overdue payments for project ID: {$projectId}");
            $dueDate = now()->addDays(15);
            $duePayments = PaymentRecord::wherein('payment_status', ['Due', 'Overdue'])
                ->whereDate('due_date', $dueDate)
                ->where('Project_id', $projectId)
                ->get();

            return $duePayments;
        } catch (Exception $e) {
            throw $e;
        }
    }

    protected function processDuePayments(Collection $duePayments): void
    {
        try {
            $this->info('Processing due payments...');

            foreach ($duePayments as $duePayment) {
                $this->sendEmailAndNotification($duePayment->due_date, $duePayment->Project_id, $duePayment->amount);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    protected function sendEmailAndNotification(string $dueDate, string $projectId, string $dueAmount): void
    {
        try {
            $this->info('Sending email and notification for Project ID: ' . $projectId);

            // Retrieve the user associated with the project
            $notifiableUser = ProjectInfo::with('businessInfo.userInfo.user')->where('Project_id', $projectId)->first();

            if (!$notifiableUser || !$notifiableUser->businessInfo || !$notifiableUser->businessInfo->userInfo || !$notifiableUser->businessInfo->userInfo->user) {
                $this->info('No notifiable user found for Project ID: ' . $projectId);
                return;
            }

            // Assuming 'user' is the relationship that contains the User model
            $user = $notifiableUser->businessInfo->userInfo->user;
            $user->notify(new DuePayment($dueDate, $projectId, $dueAmount));
        } catch (Exception $e) {
            throw $e;
        }
    }
}
