<?php

namespace App\Providers;

use App\Models\Setting;
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
        // Site-wide contact info / cross-site links, editable in one place
        // (admin Settings page) and available as $siteSettings in every view,
        // including error pages. Setting::current() never throws.
        View::share('siteSettings', Setting::current());
    }
}
