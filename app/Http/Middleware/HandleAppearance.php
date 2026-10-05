<?php

namespace App\Http\Middleware;

use App\Enums\Accent;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class HandleAppearance
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $appearance = $request->cookie('appearance');

        View::share('appearance', in_array($appearance, ['light', 'dark', 'system'], true) ? $appearance : 'system');
        View::share('accent', Accent::fromCookie($request->cookie('accent'))->value);

        return $next($request);
    }
}
