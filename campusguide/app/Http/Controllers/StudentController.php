<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\University;

class StudentController extends Controller
{

public function dashboard()
{
    $user = Auth::user();
      $user->update([
        'last_visited_at' => now(),
    ]);

    $favorites = $user->favorites()->with('university')->get();

    $randomUniversities = University::inRandomOrder()->take(3)->get(); // 3 universités aléatoires

    return view('auth.student', [
        'user' => $user,
        'favorites' => $favorites,
        'randomUniversities' => $randomUniversities,
    ]);
}

    public function updateProfile(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'bac_type' => 'nullable|string|max:255',
        'favorite_subject' => 'nullable|string|max:255',
        'interest_area' => 'nullable|string|max:255',
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'bac_type' => $request->bac_type,
        'favorite_subject' => $request->favorite_subject,
        'interest_area' => $request->interest_area,
    ]);

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
    public function newUniversities()
{
    $user = Auth::user();

    $newUniversities = University::where('created_at', '>', $user->last_visited_at)
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json($newUniversities);
}

}
