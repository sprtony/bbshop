<?php

namespace BlackBox\Customers\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class CustomersServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'customers');

        $this->loadRoutesFrom(__DIR__ . '/../Routes/auth.php');
    }

    public function register()
    {
    }

    private function registerLivewireComponents()
    {
    }
}
