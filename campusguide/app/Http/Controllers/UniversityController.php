<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;

class UniversityController extends Controller
{
    public function index()
    {
        $universities = auth()->check() ? University::all() : [];
    
        return view('auth.home', compact('universities'));
    }
    public function show($id)
{
    // On récupère l'université depuis la base de données
    $university = \App\Models\University::findOrFail($id);

    // On charge les images associées sans modifier l'objet principal
    $bannerImages = $university->bannerImages;
    $galleryImages = $university->galleryImages;
    $fields = $university->fields;

    return view('auth.University', compact('university', 'bannerImages', 'galleryImages', 'fields'));

}
    // (optionnel plus tard) Formulaire d’ajout d’université
    public function create()
    {
        return view('admin.create_university');
    }

    // (optionnel plus tard) Enregistrer une nouvelle université
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'history' => 'nullable|string',
            'location' => 'nullable|string',
            'tuition_fee' => 'nullable|string',
            'note' => 'nullable|string',
            'media_url' => 'nullable|string',
            'application_link' => 'nullable|string',
            'pdf_url' => 'nullable|string',
        ]);

        University::create($validated);
        return redirect()->route('universities.index')->with('success', 'Université ajoutée avec succès.');
    }
}
