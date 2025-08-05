<?php

namespace App\Providers;

use App\Http\Kernel;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Kernel $kernel): void
    {
        if (env('INSPECTOR_INGESTION_KEY')) {
            $kernel->appendMiddlewareToGroup('web', \Inspector\Laravel\Middleware\WebRequestMonitoring::class);
            $kernel->appendMiddlewareToGroup('api', \Inspector\Laravel\Middleware\WebRequestMonitoring::class);
        }

        Gate::define('viewPulse', function (User $user) {
            return $user->id == 1;
        });

        Paginator::useBootstrap();
    }
}
