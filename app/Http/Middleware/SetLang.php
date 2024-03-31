<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLang
{
    public function handle(Request $request, Closure $next)
    {
        if (! empty(session('lang'))) {
            App::setLocale(session('lang'));
        }

        return $next($request);
    }
}
