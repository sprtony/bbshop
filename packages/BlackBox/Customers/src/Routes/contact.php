<?php

use Illuminate\Support\Facades\Route;

Route::get('contacto', [PagesController::class, 'contact'])->name('contact');
