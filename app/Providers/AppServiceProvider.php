<?php

namespace App\Providers;

use App\Models\ApplicationInfo;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\Telescope;
use App\Models\PaymentRecord;
use App\Observers\PaymentRecordObserver;
use App\Observers\ApplicationInfoObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Telescope::night();
        if ($this->app->environment('local')) {
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
