<?php

namespace Quimaira\Catalog\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Quimaira\Catalog\Livewire\{Buscador, Listado, Cotizador};

class CatalogServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'catalog');
    }

    public function register()
    {
        Livewire::component('catalog::buscador', Buscador::class);
        Livewire::component('catalog::listado', Listado::class);
        Livewire::component('catalog::cotizador', Cotizador::class);
    }
}
