<?php

namespace App\Listeners;

use App\Events\ProjectEvent;
use App\Models\ChartCache;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewOngoingListener
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
        if($event->event_type == 'new_ongoing') {

            $month = date('F');
            $chartCache = ChartCache::updateOrCreate(
                 ['year_of' => date('Y')],
                 []
             );

             $monthlyData = json_decode($chartCache->mouthly_project_categories, true);
             if(!isset($monthlyData[$month])){
                 $monthlyData[$month] = [
                     'Applicants' => 0,
                     'Ongoing' => 0,
                     'Completed' => 0
                 ];
             }

             $monthlyData[$month]['Ongoing'] += 1;
             $chartCache->mouthly_project_categories = json_encode($monthlyData);
             $chartCache->save();
        }
    }
}
