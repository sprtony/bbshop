<?php

use Illuminate\Support\Facades\Route;
use Quimaira\Blog\Http\Controllers\PostCategoriesController;

Route::get('blog/{slug?}', [PostCategoriesController::class, 'index'])->name('postOrCategory.index');
