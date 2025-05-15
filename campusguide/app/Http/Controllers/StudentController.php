<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class StudentController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Récupérer les favoris avec leurs universités associées
        $favorites = $user->favorites()->with('university')->get();

        // Variables commentées pour l'instant, à réactiver plus tard
        // $searchCount = SearchHistory::where('user_id', $user->id)->count();
        // $visitedUniversities = $user->visited_universities ?? 0; // à implémenter si tracking des visites
        // $history = SearchHistory::where('user_id', $user->id)->orderBy('created_at', 'desc')->limit(10)->get();

        return view('auth.student', [
            'user' => $user,
            'favorites' => $favorites,
            // 'searchCount' => $searchCount,
            // 'visitedUniversities' => $visitedUniversities,
            // 'history' => $history
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->back()->with('success', 'Profil mis à jour avec succès !');
    }

    public function deleteFavorite($id)
    {
        $user = Auth::user();

        // Supprimer le favori correspondant à l'utilisateur et l'université
        Favorite::where('user_id', $user->id)
                ->where('university_id', $id)
                ->delete();

        return redirect()->back()->with('success', 'Université retirée des favoris.');
    }
}
