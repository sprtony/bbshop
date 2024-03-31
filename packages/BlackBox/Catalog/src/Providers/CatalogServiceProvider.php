<?php

namespace BlackBox\Catalog\Providers;

use BlackBox\Catalog\Livewire\ProductList;
use BlackBox\Catalog\Livewire\SearchBar;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class CatalogServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__.'/../Http/routes.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'catalog');
    }

    public function register()
    {

        $this->registerLivewireComponents();
    }

    private function registerLivewireComponents()
    {
        Livewire::component('catalog::search-bar', SearchBar::class);
        Livewire::component('catalog::product-list', ProductList::class);
    }
}
