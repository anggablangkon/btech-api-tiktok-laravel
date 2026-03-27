<?php

namespace BtechApi\TiktokLaravel;

use Illuminate\Support\ServiceProvider;

class TikTokShopServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/tiktok.php', 'tiktok');

        $this->app->singleton(TikTokShopService::class, function ($app) {
            return new TikTokShopService();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/tiktok.php' => config_path('tiktok.php'),
        ], 'config');
    }
}