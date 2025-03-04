<?php

namespace App\Console\Commands;

use App\Models\NotificationLog;
use Exception;
use App\Models\PaymentRecord;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use App\Notifications\DuePayment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use App\Services\Settings\NotifyOnService;


class CheckDuePayments extends Command
{

    public function __construct(
        protected NotifyOnService $notifyOn,
        protected PaymentRecord $payment,
        protected NotificationLog $notificationLog
    ) {
        parent::__construct();
    }
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
            $this->error('Error checking due payments: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
    protected function getUniqueProjectIds(): Collection
    {
        try {
            $projectID = $this->payment->distinct()->pluck('Project_id');
            return $projectID;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Updates payment status for a specific project based on due dates.
     *
     * Retrieves pending and due payments for the project, then categorizes them as 'Due'
     * (due today) or 'Overdue' (past due date) based on comparison with the current date.
     * Updates the payment status in the database accordingly.
     *
     * @param string $projectId The ID of the project to update payment statuses for
     * @return void
     * @throws Exception If there's an error during the update process
     */
    protected function updatePaymentStatus(string $projectId): void
    {
        try {
            $this->info("Updating payment status first for project ID: {$projectId}");

            $currentDate = now()->format('Y-m-d');
            $pendingPayments = $this->payment->where('Project_id', $projectId)
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
                $this->payment->whereIn('id', $duePaymentIds)->update(['payment_status' => 'Due']);
            }
            if (!empty($overduePaymentIds)) {
                $this->info("Found " . count($overduePaymentIds) . " overdue payments for project ID: {$projectId}");
                $this->payment->whereIn('id', $overduePaymentIds)->update(['payment_status' => 'Overdue']);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Retrieves all due or overdue payments for a specific project.
     *
     * Queries the database for payment records with status 'Due' or 'Overdue'
     * that are associated with the given project ID.
     *
     * @param string $projectId The ID of the project to retrieve payments for
     * @return Collection A collection of due or overdue payment records
     * @throws Exception If there's an error during the retrieval process
     */
    protected function getDuePayments(string $projectId): Collection
    {
        try {

            $this->info("Getting due or overdue payments for project ID: {$projectId}");
            $duePayments = $this->payment->wherein('payment_status', ['Due', 'Overdue'])
                ->where('Project_id', $projectId)
                ->get();

            return $duePayments;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Retrieves upcoming due payments for a specific project.
     *
     * Queries the database for payment records with status 'Pending' that will be due
     * on a future date determined by the notification duration setting.
     *
     * @param string $projectId The ID of the project to retrieve upcoming payments for
     * @return Collection A collection of upcoming due payment records
     * @throws Exception If there's an error during the retrieval process
     */
    protected function getUpcomingDuePayments(string $projectId): Collection
    {
        try {

            $this->info("Getting upcoming due payments for project ID: {$projectId}");
            $durationSetting = $this->notifyOn->getNotifyDuration();
            $dueDate = now()->addDays($durationSetting);
            $duePayments = $this->payment->where('payment_status', 'Pending')
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

    /**
     * Sends email and notification to users about payment status if not already sent within the notification interval.
     *
     * Checks if a notification has already been sent for the payment within the configured interval.
     * If not, finds the associated user through project relationships and sends a notification.
     * Records the notification in the notification log.
     *
     * @param int $paymentId The ID of the payment record
     * @param string $dueDate The due date of the payment
     * @param string $projectId The ID of the project associated with the payment
     * @param string $dueAmount The amount due for the payment
     * @param string $status The current status of the payment (Due, Overdue, etc.)
     * @return void
     * @throws Exception If there's an error during the notification process
     */
    protected function sendEmailAndNotification(
        int $paymentId,
        string $dueDate,
        string $projectId,
        string $dueAmount,
        string $status
    ): void {
        try {
            $this->info('Checking if notification already sent for Payment ID: ' . $paymentId);

            $notifyInterval = $this->notifyOn->getNotifyEvery();
            $this->info('Notification interval: ' . $notifyInterval);
            $notificationExists = $this->notificationLog->where('reference_id', $paymentId)
                ->where('reference_type', 'payment')
                ->where('notification_type', $status)
                ->where('created_at', '>=', now()->subDays($notifyInterval))
                ->exists();

            if ($notificationExists) {
                $this->info('Notification already sent for Payment ID: ' . $paymentId);
                return;
            }

            $this->info('Sending email and notification for Project ID: ' . $projectId);
            // Retrieve the user associated with the project
            $notifiableUser = $this->payment::with('projectInfo.businessInfo.userInfo.user')
                ->where('Project_id', $projectId)
                ->first();

            if (!$notifiableUser || !$notifiableUser->projectInfo || !$notifiableUser->projectInfo->businessInfo || !$notifiableUser->projectInfo->businessInfo->userInfo || !$notifiableUser->projectInfo->businessInfo->userInfo->user) {
                $this->info('No notifiable user found for Project ID: ' . $projectId);
                return;
            }
            // Assuming 'user' is the relationship that contains the User model
            $user = $notifiableUser->projectInfo->businessInfo->userInfo->user;
            $user->notify(new DuePayment($dueDate, $projectId, $dueAmount, $status));

            $this->notificationLog->create([
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
