<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,string  ...$roles): Response
    {

        // Vérifiez si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect('/home');
        }
        if (session()->has('role') && session()->get('role') !== $roles) {
            if (session()->get('role') === "Administrateur" || session()->get('role') === "Editeur" || session()->get('role') === "Affilier" || session()->get('role') === "Super Admin") {
                return redirect('/admin/dash');
            }
            return redirect('/home');
        }
        return $next($request);
    }
}
