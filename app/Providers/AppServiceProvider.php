<?php

namespace App\Providers;

use App\Facades\Settings as SettingsFacade;
use App\Settings;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Settings', SettingsFacade::class);
        $this->app->singleton('settings', function () {
            return new Settings();
        });

        $this->loadHelpers();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerViewComposers();
    }

    private function loadHelpers(): void
    {
        foreach (glob(__DIR__.'/../Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }

    private function registerViewComposers(): void
    {
    }
}
