<?php

namespace App\Http\Middleware;

use App\Models\LulusanModel;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OtpLulusan
{
    public function handle(Request $request, Closure $next)
    {
        $lulusan = LulusanModel::find(session('id_lulusan'));

        if ($lulusan->sudah_mengisi) {
            session()->flush();
            return redirect()->route('tracer-study.thanks')
                ->with('error', 'Anda sudah pernah mengisi tracer study.');
        } else {
            if (!session('otp_verified')) {
                return redirect()->route('tracer-study.konfirmasi', ['id' => session('id_lulusan')])->with('error', 'Silakan konfirmasi data dan verifikasi OTP terlebih dahulu..');
            }
        }

        return $next($request);
    }
}
