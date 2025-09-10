<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        
        // Handle 404 for API routes
        $exceptions->render(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'error' => [
                        'message'     => 'Record not found',
                        'type'        => 'NotFoundHttpException',
                        'code'        => 4045,
                        'link'        => 'https://example.com/docs/errors#4045',
                        'status_code' => $e->getStatusCode(),
                    ]
                ], 404);
            }
        });

    })->create();
