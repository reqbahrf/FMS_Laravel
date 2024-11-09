<?php

namespace App\Listeners;

use App\Events\ProjectEvent;
use App\Models\ChartCache;
use App\Models\User;
use App\Notifications\NewApplicantNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;

class NewApplicationListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProjectEvent $event): void
    {
        $this->updateChartData($event);
        $this->sendNotification($event);


    }

    private function updateChartData(ProjectEvent $event)
    {
        if ($event->event_type == 'NEW_APPLICANT') {

            $businessId = $event->businessId;
            $enterprise_type = $event->enterprise_type;
            $enterprise_level = $event->enterprise_level;
            $city = $event->city;

            $month = date('F');

            $chartCache = ChartCache::updateOrCreate(
                ['year_of' => date('Y')],
                []
            );

            $monthlyData = json_decode($chartCache->mouthly_project_categories, true);
            if (!isset($monthlyData[$month])) {
                $monthlyData[$month] = [
                    'Applicants' => 0,
                    'Ongoing' => 0,
                    'Completed' => 0
                ];
            }

            $monthlyData[$month]['Applicants'] += 1;
            $chartCache->mouthly_project_categories = json_encode($monthlyData);
            $chartCache->save();

            $localData = json_decode($chartCache->project_local_categories, true);
            if (!isset($localData[$city])) {
                $localData[$city] = [
                    "Micro Enterprise" => 0,
                    "Small Enterprise" => 0,
                    "Medium Enterprise" => 0,
                ];
            }

            $localData[$city][$enterprise_level] += 1;
            $chartCache->project_local_categories = json_encode($localData);
            $chartCache->save();
        }
    }

    private function sendNotification(ProjectEvent $event) 
    {
        $org_users = User::whereIn('role', ['Staff', 'Admin'])->get();
        $org_users->map(function ($user) use ($event) {
            $user->notify(new NewApplicantNotification($event));
        });
    }
}
