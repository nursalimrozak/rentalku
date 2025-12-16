<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
    public function boot()
    {
        Paginator::useBootstrapFive();
        
        // Share settings with all views
        view()->composer('*', function ($view) {
            $view->with('appSettings', \App\Models\Setting::all()->pluck('value', 'key'));
            $view->with('footerColumns', \App\Models\FooterColumn::with('links')->orderBy('order')->get()); // Add Footer Columns
        });
    }
}
