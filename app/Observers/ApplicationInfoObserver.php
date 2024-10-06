<?php

namespace App\Observers;

use App\Models\ApplicationInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ApplicationInfoObserver
{
    /**
     * Handle the ApplicationInfo "created" event.
     */
    public function created(ApplicationInfo $applicationInfo): void
    {
        //
    }

    /**
     * Handle the ApplicationInfo "updated" event.
     */
    public function updated(ApplicationInfo $applicationInfo): void
    {
        $org_userId = Auth::user()->orgusername->id;
        Cache::forget('handledProject' . $org_userId);
    }

    /**
     * Handle the ApplicationInfo "deleted" event.
     */
    public function deleted(ApplicationInfo $applicationInfo): void
    {
        //
    }

    /**
     * Handle the ApplicationInfo "restored" event.
     */
    public function restored(ApplicationInfo $applicationInfo): void
    {
        //
    }

    /**
     * Handle the ApplicationInfo "force deleted" event.
     */
    public function forceDeleted(ApplicationInfo $applicationInfo): void
    {
        //
    }
}
