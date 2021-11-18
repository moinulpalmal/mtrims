<?php

namespace App\Http;

use App\Http\Middleware\CheckAdministrator;
use App\Http\Middleware\CheckCreateUser;
use App\Http\Middleware\CheckDeliveryTrimsItem;
use App\Http\Middleware\CheckEditUser;
use App\Http\Middleware\CheckLpd1;
use App\Http\Middleware\CheckLpd2;
use App\Http\Middleware\CheckLPDOnePI;
use App\Http\Middleware\CheckLPDOnePOCreate;
use App\Http\Middleware\CheckLPDTwoPI;
use App\Http\Middleware\CheckMachineSetup;
use App\Http\Middleware\CheckManagement;
use App\Http\Middleware\CheckSectionSetup;
use App\Http\Middleware\CheckLPDTwoPOCreate;
use App\Http\Middleware\CheckMerchandising;
use App\Http\Middleware\CheckProduction;
use App\Http\Middleware\CheckReceiveTrimsItem;
use App\Http\Middleware\CheckResetPassword;
use App\Http\Middleware\CheckRestoreUser;
use App\Http\Middleware\CheckStore;
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
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\ApprovalMiddleware::class,
        ],

        'api' => [
            'throttle:60,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
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
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'administrator' => CheckAdministrator::class,
        'lpd2' => CheckLpd2::class,
        'lpd1' => CheckLpd1::class,
        'production' => CheckProduction::class,
        'store' => CheckStore::class,
        'merchandising' => CheckMerchandising::class,
        'createuser' => CheckCreateUser::class,
        'restoreuser' => CheckRestoreUser::class,
        'updateuser' => CheckEditUser::class,
        'receivefinishedtrims' => CheckReceiveTrimsItem::class,
        'createchallantrims' => CheckDeliveryTrimsItem::class,
        'lpdonecreatepo' => CheckLPDOnePOCreate::class,
        'lpdtwocreatepo' => CheckLPDTwoPOCreate::class,
        'resetpassword' => CheckResetPassword::class,
		'sectionsetup' => CheckSectionSetup::class,
		'machinesetup' => CheckMachineSetup::class,
        'lpdtwopi' => CheckLPDTwoPI::class,
        'lpdonepi' => CheckLPDOnePI::class,
        'management' => CheckManagement::class,
    ];
}
