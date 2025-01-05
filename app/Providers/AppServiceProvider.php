<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Modules\Clients\App\Models\Tenant;
use Modules\Clients\App\Observers\TenantObserver;
use Modules\Members\App\Models\User;
use Modules\Members\App\Observers\UserObserver;

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
        Schema::defaultStringLength(191);

        //observe tenant model
        // Tenant::observe(TenantObserver::class);
        User::observe(UserObserver::class);
    }
}
