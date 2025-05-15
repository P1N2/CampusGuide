<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Field;

class FieldSearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $fields = Field::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->get();

        return view('auth.FieldSearch', compact('fields', 'search'));
    }

    public function ajaxSearch(Request $request)
    {
        $query = $request->input('query');

        $fields = Field::where('name', 'like', '%' . $query . '%')->get();

        return response()->json($fields);
    }
    public function showUniversities($id)
{
    $field = \App\Models\Field::with('universities')->findOrFail($id);
    return view('auth.FieldUniversities', compact('field'));
}
}
