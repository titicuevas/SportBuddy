<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRedirectMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()?->esAdmin()) {
            return redirect()->route('admin.index');
        }

        return $next($request);
    }
}
