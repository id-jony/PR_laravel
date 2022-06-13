<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

use Closure;

class IsAjaxRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->ajax()) {
            return $next($request);
        }

        abort(400);
    }
}
