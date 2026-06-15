<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class CheckActive
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && !auth()->user()->is_active) {
            auth()->logout();
            return redirect()->route('login')
                ->withErrors(['email' => 'Akun Anda belum diaktifkan. Hubungi Admin.']);
        }
        return $next($request);
    }
}