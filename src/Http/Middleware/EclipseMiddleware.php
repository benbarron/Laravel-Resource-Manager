<?php

namespace Barron\Eclips\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EclipseMiddleware
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
        return $next($request);
    }
}
