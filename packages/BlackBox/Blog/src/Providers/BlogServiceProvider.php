<?php

namespace Quimaira\Blog\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Quimaira\Blog\Livewire\Listado;

class BlogServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__.'/../Http/routes.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'blog');
    }

    public function register()
    {
        Livewire::component('blog::listado', Listado::class);
    }
}
