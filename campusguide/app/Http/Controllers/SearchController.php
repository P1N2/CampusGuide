<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;
use App\Models\Field;

class SearchController extends Controller
{
//     public function index(Request $request)
//     {
//         $query = $request->input('query');

//         // Rechercher par nom dans les universités
//         $universities = University::where('name', 'like', "%$query%")->get();

//         // Rechercher aussi dans les filières si tu veux
//         $fields = Field::where('name', 'like', "%$query%")->get();

//         return view('search.results', compact('query', 'universities', 'fields'));
//     }
public function suggest(Request $request)
{
    $query = $request->query('query');

    $universities = University::where('name', 'like', "%$query%")
        ->select('id', 'name')
        ->get()
        ->map(function ($item) {
            return ['id' => $item->id, 'name' => $item->name, 'type' => 'universite'];
        });

    $fields = Field::where('name', 'like', "%$query%")
        ->select('id', 'name')
        ->get()
        ->map(function ($item) {
            return ['id' => $item->id, 'name' => $item->name, 'type' => 'filiere'];
        });

    return response()->json($universities->merge($fields));
}

}

