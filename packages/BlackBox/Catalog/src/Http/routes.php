<?php

use Illuminate\Support\Facades\Route;
use Quimaira\Catalog\Http\Controllers\ProductsCategoriesController;

Route::fallback([ProductsCategoriesController::class, 'index'])->name('productOrCategory.index');
