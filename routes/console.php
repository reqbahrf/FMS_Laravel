<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('reports:close')
    ->daily();

Schedule::command('app:check-due-payments')
    ->dailyAt('09:00');

Schedule::command('app:clean-notification-logs')
    ->monthlyOn(15, '00:00');

Schedule::command('app:cleanup-temporary-files')
    ->daily();

Schedule::command('form-drafts:clean')
    ->daily();
