<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
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
    public function boot(): void
    {
        // Sử dụng phân trang Bootstrap 5
        Paginator::useBootstrapFive();

        // Ép Laravel tạo đường dẫn HTTPS trên hosting
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
