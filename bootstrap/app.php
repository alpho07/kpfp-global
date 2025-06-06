<?php
use App\Http\Middleware\SetTenant;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
       // $middleware
            //->prepend(\Illuminate\Session\Middleware\StartSession::class)
            //->prepend(\Illuminate\Auth\Middleware\Authenticate::class)
            //->append(SetTenant::class); // Ensure it runs after authentication
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
