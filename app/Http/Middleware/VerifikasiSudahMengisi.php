<?php

namespace App\Http\Middleware;

use App\Models\LulusanModel;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifikasiSudahMengisi
{
    public function handle(Request $request, Closure $next)
    {
        $id = session('id_lulusan');

        $lulusan = LulusanModel::find($id);

        if ($lulusan->sudah_mengisi) {
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

        return $next($request);
    }
}
