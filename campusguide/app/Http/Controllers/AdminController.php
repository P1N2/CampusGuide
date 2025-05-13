<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\Field;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Assurer que seul un admin puisse accéder à cette page
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->is_admin !== 1) {
                return redirect('/home'); // Rediriger si l'utilisateur n'est pas admin
            }
            return $next($request);
        });
    }

    public function dashboard()
{
    $universitiesCount = University::count();
    $fieldsCount = Field::count();
    $usersCount = User::count();
    $fields = Field::all(); // Ajouté

    return view('admin.dashboard', compact('universitiesCount', 'fieldsCount', 'usersCount', 'fields'));
}
public function storeField(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:100',
        'description' => 'nullable|string',
        'image' => 'nullable|string',
    ]);

    Field::create($validated);

    return redirect()->route('admin.dashboard')->with('success', 'Filière ajoutée avec succès !');
}

public function storeUniversity(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
    'description' => 'nullable|string',
    'history' => 'nullable|string',
    'location' => 'nullable|string',
    'tuition_fee' => 'nullable|numeric|between:0,99999999.99',   // CHANGÉ ici
    'note' => 'nullable|numeric',         // CHANGÉ ici
    'media_url' => 'nullable|string',
    'application_link' => 'nullable|url',
    'pdf_url' => 'nullable|file|mimes:pdf',
    ]);

    if ($request->hasFile('pdf_url')) {
        $validated['pdf_url'] = $request->file('pdf_url')->store('pdfs', 'public');
    }

    $university = University::create($validated);

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('universities', 'public');
            $university->images()->create([
                'url' => $path,
                'type' => $request->image_type,
            ]);
        }
    }

    if ($request->fields) {
        $university->fields()->sync($request->fields);
    }

    return redirect()->route('admin.dashboard')->with('good', 'Université ajoutée avec succès !');
}

}
