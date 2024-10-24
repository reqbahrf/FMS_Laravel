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
        $this->forgetCache($applicationInfo);
    }

    /**
     * Handle the ApplicationInfo "updated" event.
     */
    public function updated(ApplicationInfo $applicationInfo): void
    {
        Log::info('ApplicationInfoObserver updated');
        $this->forgetCache($applicationInfo);
    }

    /**
     * Handle the ApplicationInfo "deleted" event.
     */
    public function deleted(ApplicationInfo $applicationInfo): void
    {
        $this->forgetCache($applicationInfo);
    }

    /**
     * Handle the ApplicationInfo "restored" event.
     */
    public function restored(ApplicationInfo $applicationInfo): void
    {
        $this->forgetCache($applicationInfo);
    }

    /**
     * Handle the ApplicationInfo "force deleted" event.
     */
    public function forceDeleted(ApplicationInfo $applicationInfo): void
    {
        $this->forgetCache($applicationInfo);
    }

    protected function forgetCache(ApplicationInfo $applicationInfo)
    {
        $org_userId = Auth::user()->orgUserInfo->id;
        Cache::forget('handled_projects' . $org_userId);
    }
}
