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

public function createUniversity()
{
    $fields = Field::all(); // Pour afficher les filières disponibles
    return view('admin.create_university', compact('fields'));
}

public function storeUniversity(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'description' => 'nullable|string',
        'history' => 'nullable|string',
        'location' => 'nullable|string',
        'tuition_fee' => 'nullable|string',
        'note' => 'nullable|string',
        'media_url' => 'nullable|url',
        'application_link' => 'nullable|url',
        'pdf_url' => 'nullable|file|mimes:pdf',
        'fields' => 'array',
        'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        'image_type' => 'required|in:banner,gallery',
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

    return redirect()->route('admin.dashboard')->with('success', 'Université ajoutée avec succès !');
}

}
