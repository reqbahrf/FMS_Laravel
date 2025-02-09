<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\ChartYearOf;
use App\Events\ProjectEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewApplicantNotification;

class NewApplicationListener implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(ProjectEvent $event): void
    {
        try {
            if ($event->event_type === 'NEW_APPLICANT') {
                DB::transaction(function () use ($event) {
                    $this->updateChartData($event);
                    $this->sendNotification($event);
                });
            }
        } catch (\Throwable $exception) {
            Log::error('Error processing new application event: ' . $exception->getMessage(), [
                'event' => $event,
                'trace' => $exception->getTraceAsString()
            ]);
        }
    }

    private function updateChartData(ProjectEvent $event): void
    {
        $month = now()->format('F');
        $year = now()->year;

        $chart = ChartYearOf::firstOrCreate(
            ['year_of' => $year],
            ['monthly_project_categories' => json_encode([]), 'project_local_categories' => json_encode([])]
        );

        $monthlyData = $this->updateMonthlyData($chart, $month);
        $localData = $this->updateLocalData($chart, $event);

        $chart->update([
            'monthly_project_categories' => json_encode($monthlyData),
            'project_local_categories' => json_encode($localData)
        ]);
    }

    private function updateMonthlyData(ChartYearOf $chart, string $month): array
    {
        $monthlyData = json_decode($chart->monthly_project_categories, true) ?? [];
        $monthlyData[$month]['Applicants'] = ($monthlyData[$month]['Applicants'] ?? 0) + 1;
        return $monthlyData;
    }

    private function updateLocalData(ChartYearOf $chart, ProjectEvent $event): array
    {
        $localData = json_decode($chart->project_local_categories, true) ?? [];
        $region = $event->location['region'];
        $province = $event->location['province'];
        $city = $event->location['city'];
        $barangay = $event->location['barangay'];
        $enterpriseLevel = $event->enterprise_level;

        $localData[$region]['byProvince'][$province]['byCity'][$city]['byBarangay'][$barangay][$enterpriseLevel] = ($localData[$region]['byProvince'][$province]['byCity'][$city]['byBarangay'][$barangay][$enterpriseLevel] ?? 0) + 1;
        return $localData;
    }

    /**
     * Send notification to multiple users.
     *
     * @param  ProjectEvent  $event
     * @return void
     */
    private function sendNotification(ProjectEvent $event): void
    {
        $users = User::whereIn('role', ['Staff', 'Admin'])->get();
        Notification::send($users, new NewApplicantNotification($event));
    }
}
