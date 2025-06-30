<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // اجلب اللغة من الجلسة أو من config الافتراضية
        $locale = Session::get('locale', config('app.locale', 'ar'));
        App::setLocale($locale);
        return $next($request);
    }
}
