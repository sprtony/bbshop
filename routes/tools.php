<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

//RUTAS DE LIMPIEZA
Route::get('clean', function () {
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('clear-compiled');
    Artisan::call('filament:clear-cached-components');

    return redirect()->route('home')->with('swal', [
        'title' => 'Cache limpiada',
        'message' => 'Se ha limpiado la cache de laravel',
        'type' => 'success',
    ]);
});

Route::get('storage-link', function () {
    Artisan::call('storage:link');

    return redirect()->route('home')->with('swal', [
        'title' => 'Storage link',
        'message' => 'Se ha creado el acceso directo al storage',
        'type' => 'success',
    ]);
});

Route::get('optimize', function () {
    // composer install --optimize-autoloader --no-dev
    Artisan::call('event:cache');
    Artisan::call('route:cache');
    Artisan::call('view:cache');
    Artisan::call('icons:cache');
    Artisan::call('filament:cache-components');
    Artisan::call('config:cache');
    Artisan::call('optimize');

    return redirect()->route('home')->with('swal', [
        'title' => 'Cache creada',
        'message' => 'Se ha optimizado la cache de laravel',
        'type' => 'success',
    ]);
});

//RUTAS PARA CAMBIO DE LENGUAJE
Route::get('lang/{lang}', function ($lang) {
    session('lang', $lang);

    return redirect()->back();
})
    ->whereIn('lang', ['es', 'en'])
    ->name('lang');
