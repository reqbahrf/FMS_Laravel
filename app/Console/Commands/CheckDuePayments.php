<?php

namespace App\Console\Commands;

use App\Models\NotificationLog;
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
                $upcomingDuePayments = $this->getUpcomingDuePayments($projectId);
                if ($duePayments->isNotEmpty()) {
                    $this->info("Found " . $duePayments->count() . " due payments for project ID: {$projectId}" . " that will be due on: " . Carbon::now()->addDays(15)->format('Y-m-d'));
                    $this->processPayments($duePayments);
                } else {
                    $this->info("No due payments found for project ID: {$projectId} with due date: " . Carbon::now()->addDays(15)->format('Y-m-d'));
                }

                if ($upcomingDuePayments->isNotEmpty()) {
                    $this->info("Found " . $upcomingDuePayments->count() . " upcoming due payments for project ID: {$projectId}" . " that will be due on: " . Carbon::now()->addDays(15)->format('Y-m-d'));
                    $this->processPayments($upcomingDuePayments);
                } else {
                    $this->info("No upcoming due payments found for project ID: {$projectId} with due date: " . Carbon::now()->addDays(15)->format('Y-m-d'));
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
            $this->info("Updating payment status first for project ID: {$projectId}");

            $currentDate = now()->format('Y-m-d');
            $pendingPayments = PaymentRecord::where('Project_id', $projectId)
                ->whereIn('payment_status', ['Pending', 'Due'])->get();

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
            $duePayments = PaymentRecord::wherein('payment_status', ['Due', 'Overdue'])
                ->where('Project_id', $projectId)
                ->get();

            return $duePayments;
        } catch (Exception $e) {
            throw $e;
        }
    }

    protected function getUpcomingDuePayments(string $projectId): Collection
    {
        try {

            $this->info("Getting upcoming due payments for project ID: {$projectId}");
            $dueDate = now()->addDays(15);
            $duePayments = PaymentRecord::where('payment_status', 'Pending')
                ->whereDate('due_date', $dueDate)
                ->where('Project_id', $projectId)
                ->get();

            return $duePayments;
        } catch (Exception $e) {
            throw $e;
        }
    }

    protected function processPayments(Collection $payments): void
    {
        try {
            $this->info('Processing ' . $payments->count() . ' payments...');

            foreach ($payments as $payment) {
                $this->sendEmailAndNotification($payment->id, $payment->due_date, $payment->Project_id, $payment->amount, $payment->payment_status);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    protected function sendEmailAndNotification(int $paymentId, string $dueDate, string $projectId, string $dueAmount, string $status): void
    {
        try {
            $this->info('Checking if notification already sent for Payment ID: ' . $paymentId);

            $notificationExists = NotificationLog::where('reference_id', $paymentId)
                ->where('reference_type', 'payment')
                ->where('notification_type', $status)
                ->where('created_at', '>=', now()->subDays(7))
                ->exists();

            if ($notificationExists) {
                $this->info('Notification already sent for Payment ID: ' . $paymentId);
                return;
            }

            $this->info('Sending email and notification for Project ID: ' . $projectId);
            // Retrieve the user associated with the project
            $notifiableUser = ProjectInfo::with('businessInfo.userInfo.user')
                ->where('Project_id', $projectId)
                ->first();

            if (!$notifiableUser || !$notifiableUser->businessInfo || !$notifiableUser->businessInfo->userInfo || !$notifiableUser->businessInfo->userInfo->user) {
                $this->info('No notifiable user found for Project ID: ' . $projectId);
                return;
            }
            // Assuming 'user' is the relationship that contains the User model
            $user = $notifiableUser->businessInfo->userInfo->user;
            $user->notify(new DuePayment($dueDate, $projectId, $dueAmount, $status));

            NotificationLog::create([
                'user_id' => $user->id,
                'reference_type' => 'payment',
                'reference_id' => $paymentId,
                'notification_type' => $status,
                'sent_at' => now()
            ]);
        } catch (Exception $e) {
            $this->error('Error in sendEmailAndNotification: ' . $e->getMessage());
            throw $e;
        }
    }
}
