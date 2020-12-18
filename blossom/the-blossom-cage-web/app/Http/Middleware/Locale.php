<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Locale {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if ($request->method() === 'GET') {
            $segment = $request->segment(1);

            if (!in_array($segment, config('app.locales'))) {
                $segments = $request->segments();
                $fallback = session('locale') ?: config('app.fallback_locale');
                $segments = array_prepend($segments, $fallback);
                return redirect()->to(implode('/', $segments));
            }
            if (empty(session()->get('cur_currency'))) {
                session()->put('cur_currency', 'SAR');
                session()->put('amount_per_unit', 1);
            }
            session()->put('locale', $segment);
            app()->setLocale($segment);
        }
        return $next($request);
    }

}
