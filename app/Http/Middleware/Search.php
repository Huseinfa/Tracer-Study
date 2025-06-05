<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Search
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('id_lulusan')) {
            return redirect()->route('tracer-study.index');
        }
        return $next($request);
    }
}
