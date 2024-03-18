<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

Route::get('/', [PagesController::class, 'home'])->name('home');

//Paginas Legales
Route::view('aviso-de-privacidad', 'pages.cms.index', ['content' => setting('general.privacy')])->name('privacy');
Route::view('terminos-y-condiciones', 'pages.cms.index', ['content' => setting('general.terms')])->name('terms');
