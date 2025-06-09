<?php

namespace App\Http\Middleware;

use App\Models\LulusanModel;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Search
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('id_lulusan')) {
            return redirect()->route('tracer-study.index');
        } else {
            if (session('sudah_mengisi')) {
                if ($request->wantsJson() || $request->ajax()) {
                    session()->flush();
                    return response()->json([
                        'success' => false,
                        'message' => 'Anda sudah pernah mengisi tracer study.',
                        'redirect_url' => route('tracer-study.thanks')
                    ]);
                } else {
                    session()->flush();
                    return redirect()->route('tracer-study.thanks')
                        ->with('error', 'Anda sudah pernah mengisi tracer study.');
                }
            } 
        }

        return $next($request);
    }
}
