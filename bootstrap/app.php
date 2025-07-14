<?php

use App\Http\Middleware\InboundMiddleware;
use App\Http\Middleware\InventMiddleware;
use App\Http\Middleware\OutbondMiddleware;
use App\Http\Middleware\SupervisorMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->appendToGroup('inbound', [
            InboundMiddleware::class,
            
        ]);
        $middleware->appendToGroup('invent', [
            InventMiddleware::class,
            
        ]);
        $middleware->appendToGroup('outbond', [
            OutbondMiddleware::class,
            
        ]);
        $middleware->appendToGroup('supervisor', [
            SupervisorMiddleware::class,
            
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
