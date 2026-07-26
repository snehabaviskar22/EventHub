<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Share the logged-in user's role with all views for navbar rendering.
        view()->composer('*', function ($view) {
            $view->with('currentUser', auth()->user());
        });
    }
}
