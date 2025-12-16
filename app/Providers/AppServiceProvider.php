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
        
        // Share settings with all views using composer for reliability
        view()->composer(['layouts.app', 'layouts.customer', 'layouts.admin', 'welcome'], function ($view) {
            if (!$view->offsetExists('appSettings')) {
                $view->with('appSettings', \App\Models\Setting::all()->pluck('value', 'key'));
            }
            if (!$view->offsetExists('footerColumns')) {
                $view->with('footerColumns', \App\Models\FooterColumn::with('links')->orderBy('order')->get());
            }
        });
    }
}
