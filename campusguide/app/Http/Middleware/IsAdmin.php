<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
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
        // Vérifie si l'utilisateur est connecté et s'il est un administrateur
        if (auth()->check() && auth()->user()->is_admin) {
            return $next($request);  // Si oui, permet l'accès à la requête suivante
        }

        // Sinon, redirige l'utilisateur vers la page d'accueil ou une autre page
        return redirect('/home')->with('error', 'Accès interdit, vous n\'avez pas les droits d\'administration.');
    }
}
