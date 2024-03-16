<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    'name' => env('APP_NAME', 'Laravel'),
    'env' => env('APP_ENV', 'production'),
    'debug' => (bool) env('APP_DEBUG', false),
    'url' => env('APP_URL', 'http://localhost'),
    'admin_url' => env('APP_ADMIN_URL', 'admin'),
    'force_https' => env('APP_HTTPS', 'false'),
    'asset_url' => env('ASSET_URL'),
    'timezone' => 'UTC',
    'locale' => env('APP_LANG', 'en'),
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => env('APP_KEY'),
    'cipher' => 'AES-256-CBC',

    'maintenance' => [
        'driver' => 'file',
        // 'store'  => 'redis',
    ],


    'providers' => ServiceProvider::defaultProviders()->merge([
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\VoltServiceProvider::class,

        BlackBox\Admin\Providers\AdminServiceProvider::class,
        BlackBox\Admin\Providers\AdminPanelProvider::class,
        BlackBox\Customers\Providers\CustomersServiceProvider::class,
        // BlackBox\Catalog\Providers\CatalogServiceProvider::class,
        // BlackBox\Blog\Providers\BlogServiceProvider::class,
    ])->toArray(),

    'aliases' => Facade::defaultAliases()->merge([
        // 'Example' => App\Facades\Example::class,
    ])->toArray(),

];
