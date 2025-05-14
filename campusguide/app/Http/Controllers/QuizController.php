<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    // Étape 1 : Enregistrer le type de bac
   public function step1(Request $request)
{
    // Valider et enregistrer la réponse dans la session
    $request->validate([
        'bac_type' => 'required|string',
    ]);

    // Enregistrer la réponse dans la session
    session(['bac_type' => $request->bac_type]);

    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Mettre à jour ses infos dans la base de données
    $user->update([
        'bac_type' => session('bac_type'),
    ]);

    // Vérifier si l'utilisateur a déjà rempli le quiz
    if ($user->bac_type && $user->favorite_subject && $user->interest_area) {
        return redirect()->route('home')->with('message', 'Vous avez déjà complété le quiz.');
    }

    // Rediriger vers l'étape suivante
    return redirect()->route('quiz.step2');
}


    // Étape 2 : (ajouter ici les autres étapes)
    public function step2(Request $request)
    {
        
    // Valider et enregistrer la réponse dans la session
    $request->validate([
        'favorite_subject' => 'required|string',
    ]);

    // Enregistrer la réponse dans la session
    session(['favorite_subject' => $request->favorite_subject]);
    if (Auth::user()->bac_type && Auth::user()->favorite_subject && Auth::user()->interest_area) {
    return redirect()->route('home')->with('message', 'Vous avez déjà complété le quiz.');
}

    // Rediriger vers l'étape suivante
    return redirect()->route('quiz.step3');
    }

    // Étape 3 : (ajouter ici l'étape 3)
    public function step3(Request $request)
    {
         // Valider la réponse de la dernière étape
    $request->validate([
        'interest_area' => 'required|string',
    ]);

    // Enregistrer la réponse dans la session
    session(['interest_area' => $request->interest_area]);

    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Mettre à jour ses infos dans la base de données
    $user->update([
        'bac_type' => session('bac_type'),
        'favorite_subject' => session('favorite_subject'),
        'interest_area' => session('interest_area'),
    ]);

    // Nettoyer la session si tu veux (optionnel)
    session()->forget(['bac_type', 'favorite_subject', 'interest_area']);
    if (Auth::user()->bac_type && Auth::user()->favorite_subject && Auth::user()->interest_area) {
    return redirect()->route('home')->with('message', 'Vous avez déjà complété le quiz.');
}

    // Rediriger vers la page d’accueil
    return redirect()->route('home')->with('success', 'Quiz terminé avec succès !');
}
}