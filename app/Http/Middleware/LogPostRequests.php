<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogPostRequests
{
    public function handle(Request $request, Closure $next)
{
    if ($request->isMethod('post')) {
        Log::info('POST request to: ' . $request->path(), $request->all());
    }
    return $next($request);
}
}
