<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Tambahkan kode ini
        $this->app->bind('path.public', function () {
            // Mengarahkan path.public ke folder public_html
            // yang berada satu level di atas direktori root Laravel (petshop-app)
            return base_path('../public_html');
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
