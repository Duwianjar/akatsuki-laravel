<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class cek_admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userRole = session('user_role');
        if ($userRole=='superadmin') {
            return $next($request);
        }
        return redirect()->to('/profil');
    }
}