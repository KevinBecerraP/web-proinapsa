<?php

namespace App\Providers;

use App\Models\Company;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer(['components.header', 'components.header-secondary', 'layouts.app', 'layouts.app-secondary'], function ($view) {
            $company = Company::first();
            $view->with('company', $company);
        });
    }
}
