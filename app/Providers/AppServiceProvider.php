<?php

namespace App\Providers;

use App\Http\Middleware\CheckRole;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    Route::middleware('web')
        ->group(function () {
            // ...
        });

    $this->app['router']->aliasMiddleware('role', CheckRole::class);
}
}
