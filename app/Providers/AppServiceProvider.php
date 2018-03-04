<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('ASSETMGR_LOG_SQL_QUERIES', false)) {
            \DB::listen(function ($query) {
                \Log::info('SQL> ' . $query->sql);
            });
        }
    }
}
