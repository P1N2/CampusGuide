<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;
use App\Models\Field;

class UniversityController extends Controller
{
    public function index()
{
    $universities = University::all();
    $fields = Field::all();

    return view('auth.home', compact('universities', 'fields'));
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
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'history' => 'nullable|string',
        'location' => 'nullable|string',
        'tuition_fee' => 'nullable|numeric',
        'note' => 'nullable|numeric|min:0|max:5',
        'media_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'application_link' => 'nullable|url',
        'pdf_url' => 'nullable|mimes:pdf|max:10240',
    ]);

    $university = new University();
    $university->name = $request->name;
    $university->description = $request->description;
    $university->history = $request->history;
    $university->location = $request->location;
    $university->tuition_fee = $request->tuition_fee;
    $university->note = $request->note;
    if ($request->hasFile('media_url')) {
        $file = $request->file('media_url');
        $university->media_url = $file->store('universities', 'public');
    }
    if ($request->hasFile('pdf_url')) {
        $file = $request->file('pdf_url');
        $university->pdf_url = $file->store('brochures', 'public');
    }
    $university->application_link = $request->application_link;
    $university->save();

    return redirect()->route('universities.index')->with('success', 'Université ajoutée avec succès.');
}

}
