<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;
use App\Models\Field;

class SearchController extends Controller
{
    public function suggestions(Request $request)
    {
        $query = $request->input('query');

        $universities = University::where('name', 'like', "%{$query}%")
            ->select('id', 'name')
            ->limit(5)
            ->get();

        $fields = Field::where('name', 'like', "%{$query}%")
            ->select('id', 'name')
            ->limit(5)
            ->get();

        return response()->json([
            'universities' => $universities,
            'fields' => $fields,
        ]);
    }
}
