<?php

use App\Http\Middleware\HandleAppearance;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->encryptCookies(except: ['appearance', 'sidebar_state']);

        $middleware->web(append: [
            HandleAppearance::class,
            HandleInertiaRequests::class,
            // Only the first entries (CSS, entry chunk) matter for 103 Early Hints; an unbounded
            // Link header outgrows the origin's per-header buffer (8 KB Apache/FastCGI, 4 KB nginx)
            // on chunk-heavy pages and the response is cut off before the browser sees it.
            AddLinkHeadersForPreloadedAssets::using(limit: 20),
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
