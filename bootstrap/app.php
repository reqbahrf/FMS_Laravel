<?php

use App\Http\Middleware\EmailVerificationRateLimitMiddleware;
use App\Http\Middleware\LoginAttemptRateLimitMiddleware;
use App\Http\Middleware\OrgUserMiddleware;
use App\Http\Middleware\CheckPasswordChangeRequired;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'loginRateLimit' => LoginAttemptRateLimitMiddleware::class,
            'EmailRateLimit' => EmailVerificationRateLimitMiddleware::class,
            'OrgUser' => OrgUserMiddleware::class,
            'check.password.change' => CheckPasswordChangeRequired::class,
        ]);
        //API testing
        $middleware->validateCsrfTokens(except: [
            '/Staff*',
            '/login*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
