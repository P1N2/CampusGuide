<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // Affiche le formulaire d'inscription
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Gère la connexion de l'utilisateur
    public function login(Request $request)
    {
        // Valider les champs du formulaire de connexion
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tente de connecter l'utilisateur
        if (auth()->attempt($credentials)) {
            $request->session()->regenerate(); // Sécurité : éviter le vol de session

            // Vérifie si l'utilisateur est un administrateur
            if (auth()->user()->is_admin) {
                return redirect()->route('admin.dashboard');  // Redirige vers le dashboard admin
            }

            // Sinon, redirige vers la page d'accueil de l'utilisateur
            return redirect()->intended('/home');
        }

        // Si échec, retourne une erreur
        return back()->withErrors([
            'email' => 'mot de passe ou email incorrect. Reessayez !',
        ])->onlyInput('email');
    }
}
