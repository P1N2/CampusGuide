<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function step1()
    {
        return view('auth.quiz'); // Vue étape 1
    }

    public function postStep1(Request $request)
    {
        $request->validate([
            'bac_type' => 'required|string',
        ]);

        session(['quiz.bac_type' => $request->bac_type]);

        return redirect()->route('quiz.step2');
    }

    public function step2()
    {
        // Empêche l’accès si l’étape 1 n’est pas complétée
        if (!session()->has('quiz.bac_type')) {
            return redirect()->route('quiz.step1');
        }

        return view('auth.quiz2'); // Vue étape 2
    }

    public function postStep2(Request $request)
    {
        $request->validate([
            'favorite_subject' => 'required|string',
        ]);

        session(['quiz.favorite_subject' => $request->favorite_subject]);

        return redirect()->route('quiz.step3');
    }

    public function step3()
    {
        // Empêche d’y accéder sans l’étape précédente
        if (!session()->has('quiz.favorite_subject')) {
            return redirect()->route('quiz.step2');
        }

        return view('auth.quiz3'); // Vue étape 3 corrigée
    }

    public function postStep3(Request $request)
    {
        $request->validate([
            'interest_domain' => 'required|string',
        ]);

        $user = auth()->user();

        // Met à jour l’utilisateur avec les données du quiz
        $user->update([
            'bac_type' => session('quiz.bac_type'),
            'favorite_subject' => session('quiz.favorite_subject'),
            'interest_area' => $request->interest_domain, 
        ]);

        session()->forget('quiz');

        return redirect()->route('home')->with('success', 'Merci d’avoir complété le quiz !');
    }
}
