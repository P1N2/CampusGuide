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
    $users = User::all();
    
    // Inscriptions par mois de l'année courante
    $monthlyRegistrations = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->whereYear('created_at', now()->year)
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->pluck('count', 'month')
        ->toArray();

    // On complète les mois manquants avec 0
    $registrationsByMonth = [];
    for ($i = 1; $i <= 12; $i++) {
        $registrationsByMonth[] = $monthlyRegistrations[$i] ?? 0;
    }
    
    return view('admin.dashboard', compact('universitiesCount', 'fieldsCount', 'usersCount', 'fields', 'users','registrationsByMonth'));

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
    try {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'history' => 'nullable|string',
            'location' => 'nullable|string',
            'tuition_fee' => 'nullable|numeric|between:0,99999999.99',
            'note' => 'nullable|numeric|min:0|max:10',
            'media_url' => 'nullable|string',
            'application_link' => 'nullable|url',
            'pdf_url' => 'nullable|url|ends_with:.pdf',
            'slogan' => 'nullable|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:100',
            'fields' => 'nullable|array',
            'fields.*.selected' => 'nullable|boolean',
            'fields.*.fee' => 'nullable|integer|min:0',

        ]);

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
    $selectedFields = collect($request->fields)
        ->filter(fn($item) => isset($item['selected']) && $item['selected']);

    $attachData = [];
    foreach ($selectedFields as $fieldId => $data) {
        $fee = $data['fee'] ?? null;
        $attachData[$fieldId] = ['tuition_fee'  => $fee];
    }

    $university->fields()->attach($attachData);
}

        return redirect()->route('admin.dashboard')->with('good', 'Université ajoutée avec succès !');
    
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Retourner avec les erreurs de validation + les anciennes valeurs du formulaire
        return back()
            ->withErrors($e->validator)
            ->withInput()
            ->with('error', 'Erreur de validation. Vérifie les champs du formulaire.');
    
    } catch (\Throwable $e) {
        // Pour toute autre erreur non liée à la validation
        return back()
            ->withInput()
            ->with('error', 'Erreur inattendue : ' . $e->getMessage());
    }
}

// Changer le rôle de l'utilisateur
public function toggleRole($id)
{
    $user = User::findOrFail($id);
    $user->is_admin = !$user->is_admin;
    $user->save();

    return back()->with('success', 'Rôle mis à jour avec succès.');
}

// Supprimer un utilisateur
public function deleteUser($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return back()->with('success', 'Utilisateur supprimé avec succès.');
}


}
