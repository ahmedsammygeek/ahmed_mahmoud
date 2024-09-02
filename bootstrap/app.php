<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RedirectIfNotAdminMiddleware;

use Illuminate\Auth\AuthenticationException;

return Application::configure(basePath: dirname(__DIR__))
->withRouting(
    web: __DIR__.'/../routes/web.php',
    api: __DIR__.'/../routes/api.php',
    commands: __DIR__.'/../routes/console.php',
    health: '/up',
)
->withMiddleware(function (Middleware $middleware) {

    $middleware->alias([
        'admin' => RedirectIfNotAdminMiddleware::class , 
        'phone_verification' => \App\Http\Middleware\StudentMustVerifyHisPhoneNumberMiddleware::class , 
        'localize'                => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
        'localizationRedirect'    => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
        'localeSessionRedirect'   => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
        'localeCookieRedirect'    => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
        'localeViewPath'          => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class , 
        'locale' =>  \App\Http\Middleware\SetLocalMiddleware::class
    ]);
})
->withExceptions(function (Exceptions $exceptions) {
    $exceptions->renderable(function (AuthenticationException $e, $request) {
        if ($request->is('api/*')) {
            return response()->json([
                'status' => 'error' , 
                'errors' => [] , 
                'data' => (object)[] , 
                'message' => trans('api.Unauthenticated')
            ], 401);
        }
    });

})->create();
