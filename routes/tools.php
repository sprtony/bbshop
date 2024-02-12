<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

//RUTAS DE LIMPIEZA
Route::get('clean', function () {
    Artisan::call('route:clear');
    Artisan::call('clear-compiled');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');

    return redirect()->route('home')->with('swal', ["title" => 'Cache limpiada', "message" => 'se ha limpiado la cache de laravel', "type" => 'success']);
});

Route::get('storage-link', function () {
    Artisan::call('storage:link');

    return redirect()->route('home')->with('swal', ["title" => 'Storage link', "message" => 'Se ha creado el acceso directo al storage', "type" => 'success']);
});

//RUTAS PARA CAMBIO DE LENGUAJE
Route::get('lang/{lang}', function ($lang) {
    session('lang', $lang);

    return redirect()->back();
})
    ->whereIn('lang', ['es', 'en'])
    ->name('lang');
