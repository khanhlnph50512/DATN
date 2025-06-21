<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->routes(function () {
            // Routes cho client
            Route::middleware('web')
                ->group(base_path('routes/client.php'));

            // Routes cho admin
            Route::middleware('web')
                ->group(base_path('routes/admin.php'));
        });
    }
}
