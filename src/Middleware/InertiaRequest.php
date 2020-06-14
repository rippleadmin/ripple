<?php

namespace WaterAdmin\Middleware;

use Closure;
use Inertia\Inertia;

class InertiaRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Inertia::setRootView('water-admin::layout');

        return $next($request);
    }
}
