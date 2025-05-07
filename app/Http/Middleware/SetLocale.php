<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // abort(403, 'Unauthorized.');
        dd(auth()->user());
        $locale = auth()->user()->language->code ??Session::get('locale', "ar");
        App::setLocale($locale);
        return $next($request);
    }
}
