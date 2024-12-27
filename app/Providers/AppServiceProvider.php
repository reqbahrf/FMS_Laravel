<?php

namespace App\Providers;

use App\Models\PaymentRecord;
use App\Models\ApplicationInfo;
use Illuminate\Support\ServiceProvider;
use App\Observers\PaymentRecordObserver;
use App\Observers\ApplicationInfoObserver;
use App\Providers\TelescopeServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local') && class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        PaymentRecord::observe(PaymentRecordObserver::class);
        ApplicationInfo::observe(ApplicationInfoObserver::class);
    }
}
