<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class FavoriteController extends Controller
{


public function toggle(Request $request)
{
    $user = Auth::user();
    $universityId = $request->input('university_id');

    $existing = Favorite::where('user_id', $user->id)
                        ->where('university_id', $universityId)
                        ->first();

    if ($existing) {
        $existing->delete();
        return response()->json(['status' => 'removed']);
    } else {
        Favorite::create([
            'user_id' => $user->id,
            'university_id' => $universityId,
        ]);
        return response()->json(['status' => 'added']);
    }
}

}
