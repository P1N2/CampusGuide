<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use Illuminate\Support\Facades\Log;

class FavoriteController extends Controller
{
    public function toggle($universityId)
    {
        try {
            $user = auth()->user();

            $exists = $user->favorites()->where('university_id', $universityId)->exists();

            if ($exists) {
                $user->favorites()->where('university_id', $universityId)->delete();
                $status = 'removed';
            } else {
                $user->favorites()->create(['university_id' => $universityId]);
                $status = 'added';
            }

            return response()->json([
                'status' => $status,
                'university_id' => $universityId
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur dans FavoriteController@toggle : ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue. Veuillez réessayer.'
            ], 500);
        }
    }
}
