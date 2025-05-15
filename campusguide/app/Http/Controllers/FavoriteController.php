<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle($universityId)
{
    $user = auth()->user();

    // Vérifie si l'université est déjà dans les favoris
    $favorite = $user->favorites()->where('university_id', $universityId)->first();

    if ($favorite) {
        $favorite->delete();
        $message = "Université retirée des favoris.";
    } else {
        $user->favorites()->create(['university_id' => $universityId]);
        $message = "Université ajoutée aux favoris.";
    }

    return redirect()->back()->with('status', $message);
}

}
