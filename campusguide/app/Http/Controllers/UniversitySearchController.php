<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;

class UniversitySearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $universities = University::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->get();

        return view('auth.UniversitySearch', compact('universities', 'search'));
    }
    public function search(Request $request)
{
    $query = $request->input('query');

    $universities = \App\Models\University::when($query, function ($q) use ($query) {
        return $q->where('name', 'like', '%' . $query . '%');
    })->get();

    return view('auth.UniversitySearch', compact('universities', 'query'));
}
public function ajaxSearch(Request $request)
{
    try {
        $query = $request->input('query');

        $universities = University::where('name', 'LIKE', '%' . $query . '%')
            ->select('id', 'name', 'description')
            ->get();

        return response()->json($universities);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

}
