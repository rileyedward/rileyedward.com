<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleConstruction
{
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->environment('production') && $request->route()->getName() !== 'construction') {
            return redirect()->route('construction');
        }

        return $next($request);
    }
}
