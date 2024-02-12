<?php

namespace Quimaira\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Quimaira\Blog\Models\{BlogCategory, BlogPost};

class PostCategoriesController extends Controller
{
    public function index($slug = null)
    {
        if (is_null($slug)) {
            $category = null;
            return view('pages.blog.index', compact('category'));
        }

        // if ($category = BlogCategory::where(['slug' => $slug, 'active' => 1])->first()) {
        //     return view('pages.blog.index', compact('category'));
        // }

        if ($post = BlogPost::where(['slug' => $slug, 'active' => 1])->first()) {
            $posts = BlogPost::where('active', 1)->where('slug', '!=', $slug)->limit(5)->get();
            return view('pages.blog.view', compact('post', 'posts'));
        }

        abort(404);
    }
}
