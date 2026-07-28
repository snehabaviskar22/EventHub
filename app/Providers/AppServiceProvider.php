<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Force HTTPS URLs in production (Railway)
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // Share the logged-in user with all views
        view()->composer('*', function ($view) {
            $view->with('currentUser', auth()->user());
        });
    }
}
