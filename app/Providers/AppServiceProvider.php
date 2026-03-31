<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Institutional;
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
        View::composer(['components.header', 'components.header-secondary', 'components.footer', 'layouts.app', 'layouts.app-secondary'], function ($view) {
            $company = Company::first();
            $view->with('company', $company);
        });

        View::composer('components.footer', function ($view) {
            $interestLinks = Institutional::interestLinks()->active()->ordered()->get();
            $view->with('interestLinks', $interestLinks);
        });
    }
}
