<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'home'])->name('home');

//Paginas Legales
Route::view('aviso-de-privacidad', 'pages.cms.index', ['content' => setting('general.privacy')])->name('privacy');
Route::view('terminos-y-condiciones', 'pages.cms.index', ['content' => setting('general.terms')])->name('terms');
