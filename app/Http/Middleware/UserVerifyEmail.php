<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserVerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('user')->user();
        if ($user && ($user->is_verified == 0 || $user->email_verified_at == null)) {
            return redirect()->route('login.user')->with('error', 'Akun Anda Belum Terverifikasi. Tolong Verifikasi Melalui Kode OTP yang dikirim ke Email Anda');
        }
        return $next($request);
    }
}
