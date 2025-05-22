<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;
use App\Models\Field;
use App\Models\Avis;

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
    $logo = $university->logo;
    $fields = $university->fields;

    return view('auth.University', compact('university', 'bannerImages', 'galleryImages', 'fields', 'logo'));

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
        'adresse' => 'nullable|string',
        'telephone' => 'nullable|string',
        'email' => 'nullable|email',
        'tuition_fee' => 'nullable|numeric',
        'note' => 'nullable|numeric|min:0|max:5',
        'media_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'application_link' => 'nullable|url',
        'pdf_url' => 'nullable|url',
    ]);

    $university = new University();
    $university->name = $request->name;
    $university->description = $request->description;
    $university->history = $request->history;
    $university->location = $request->location;
    $university->adresse = $request->adresse;
    $university->telephone = $request->telephone;
    $university->email = $request->email;
    $university->tuition_fee = $request->tuition_fee;
    $university->note = $request->note;

    if ($request->hasFile('media_url')) {
        $file = $request->file('media_url');
        $university->media_url = $file->store('universities', 'public');
    }

    $university->application_link = $request->application_link;
    $university->pdf_url = $request->pdf_url; // 🔁 juste l’URL, pas de stockage

    $university->save();

    return redirect()->route('universities.index')->with('success', 'Université ajoutée avec succès.');
}
public function rate(Request $request, University $university)
{
    $request->validate([
        'note' => 'required|integer|min:1|max:5',
    ]);

    $userId = auth()->id();

    // Vérifie si l'utilisateur a déjà noté cette université
    $avis = Avis::updateOrCreate(
        ['user_id' => $userId, 'university_id' => $university->id],
        ['note' => $request->note]
    );

    // Recalcul de la moyenne
    $moyenne = Avis::where('university_id', $university->id)->avg('note');
    $university->note = round($moyenne * 2, 1); // Si on veut une note sur 10
    $university->save();

    return response()->json(['message' => 'Merci pour votre note !']);
}
public function ranking()
{
    $universities = University::orderByDesc('note')->get(); // tri par meilleure note
    return view('auth.ranking', compact('universities'));
}

}
