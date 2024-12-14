<?php

namespace App\Listeners;

use App\Events\ProjectEvent;
use App\Models\ChartYearOf;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class NewCompleteListener implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(ProjectEvent $event): void
    {
        try {
            if ($event->event_type === 'NEW_COMPLETED') {
                DB::transaction(function () use ($event) {
                    $this->updateChartData($event);
                });
            }
        } catch (\Throwable $exception) {
            Log::error('Error processing completed project event: ' . $exception->getMessage(), [
                'event' => $event,
                'trace' => $exception->getTraceAsString()
            ]);
        }
    }

    private function updateChartData(ProjectEvent $event): void
    {
        $month = now()->format('F');
        $year = now()->year;

        $chartCache = ChartYearOf::firstOrCreate(
            ['year_of' => $year],
            ['monthly_project_categories' => json_encode([])]
        );

        $monthlyData = $this->updateMonthlyCompletedData($chartCache, $month);

        $chartCache->update([
            'monthly_project_categories' => json_encode($monthlyData)
        ]);
    }

    private function updateMonthlyCompletedData(ChartYearOf $chartCache, string $month): array
    {
        $monthlyData = json_decode($chartCache->monthly_project_categories, true) ?? [];

        // Ensure the month exists with default values
        $monthlyData[$month] = $monthlyData[$month] ?? [
            'Applicants' => 0,
            'Ongoing' => 0,
            'Completed' => 0
        ];

        // Increment completed projects
        $monthlyData[$month]['Completed'] += 1;

        return $monthlyData;
    }
}
