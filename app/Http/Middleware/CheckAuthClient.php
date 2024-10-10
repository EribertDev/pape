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
    public function handle(Request $request, Closure $next,string $role): Response
    {
        // Vérifiez si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect('/home');
        }

        // Vérifiez si l'utilisateur a le rôle requis
        if (session()->has('role') && session()->get('role') !== $role) {
            // Vérifie si l'utilisateur est un administrateur ou rédacteur
            if (session()->get('role') === "Administrateur" || session()->get('role') === "Rédacteur" || session()->get('role') === "Charger Clientelle" || session()->get('role') === "Super Admin") {
                return redirect('/admin/dash');
            }
            // Redirection vers la page utilisateur standard
            return redirect('/home');
        }

        return $next($request);
    }
}
