<?php

use Illuminate\Support\Facades\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('reports:close')->daily();
Schedule::command('app:check-due-payments')->dailyAt('09:00');
Schedule::command('app:cleanup-temporary-files')->daily();
Schedule::command('form-drafts:clean')->daily();
