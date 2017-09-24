<?php

namespace SickRage\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
      \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
      \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
      \SickRage\Http\Middleware\TrimStrings::class,
      \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
      \SickRage\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
      'web' => [
        \SickRage\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
          // \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \SickRage\Http\Middleware\VerifyCsrfToken::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
      ],

      'api' => [
        'throttle:60,1',
        'bindings',
      ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
      'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
      'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
      'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
      'can' => \Illuminate\Auth\Middleware\Authorize::class,
      'guest' => \SickRage\Http\Middleware\RedirectIfAuthenticated::class,
      'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ];

    function bootstrap()
    {
        parent::bootstrap();
        $config = config();
        if ($config->get('app.force_url')) {
            \URL::forceRootUrl($config->get('app.url'));
        }
    }
}
