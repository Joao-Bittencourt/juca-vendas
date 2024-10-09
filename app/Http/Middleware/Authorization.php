<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class Authorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (auth()->user()) {
            $routeName = $request->route()->getName();

            if (empty($routeName) || substr($routeName, 0, 3) === 'api') {
                return $next($request);
            }

            $routeFormatted = str_replace(['-', '_', '.'], '_', $routeName);

            Gate::authorize($routeFormatted);
        }

        return $next($request);
    }
}
