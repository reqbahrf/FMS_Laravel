<?php

namespace App\Observers;

use App\Models\ApplicationInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ApplicationInfoObserver
{
    /**
     * Handle the ApplicationInfo "created" event.
     */
    public function created(ApplicationInfo $applicationInfo): void
    {
        $this->ApplicationStatusChanged($applicationInfo);
    }

    /**
     * Handle the ApplicationInfo "updated" event.
     */
    public function updated(ApplicationInfo $applicationInfo): void
    {
      Log::info('ApplicationInfoObserver updated');
      $this->ApplicationStatusChanged($applicationInfo);
    }

    /**
     * Handle the ApplicationInfo "deleted" event.
     */
    public function deleted(ApplicationInfo $applicationInfo): void
    {
        $this->ApplicationStatusChanged($applicationInfo);
    }

    /**
     * Handle the ApplicationInfo "restored" event.
     */
    public function restored(ApplicationInfo $applicationInfo): void
    {
        $this->ApplicationStatusChanged($applicationInfo);
    }

    /**
     * Handle the ApplicationInfo "force deleted" event.
     */
    public function forceDeleted(ApplicationInfo $applicationInfo): void
    {
        $this->ApplicationStatusChanged($applicationInfo);
    }

    protected function ApplicationStatusChanged(ApplicationInfo $applicationInfo)
    {
        $org_userId = Auth::user()->orgusername->id;
        if($applicationInfo->wasChanged('application_status')){
            Cache::forget('handledProject' . $org_userId);
        }
    }
}
