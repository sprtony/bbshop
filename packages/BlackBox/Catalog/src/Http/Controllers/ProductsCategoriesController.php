<?php

namespace Quimaira\Catalog\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Quimaira\Catalog\Models\{Brand, Category, Product};

class ProductsCategoriesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->fallbackPlaceholder == 'productos') {
            $category = null;
            return view('pages.products.index', compact('category'));
        }
        if ($category = Category::where(['slug' => $request->fallbackPlaceholder, 'visible' => 1])->first()) {
            return view('pages.products.index', compact('category'));
        }
        if ($product = Product::where(['slug' => $request->fallbackPlaceholder, 'active' => 1])->with('related_products')->first()) {
            return view('pages.products.view', compact('product'));
        }

        abort(404);
    }
}
