<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UniversitySearchController;
use App\Http\Controllers\FieldSearchController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

// Page d'accueil pour les invités
// Page d'accueil (affiche les universités uniquement si l'utilisateur est connecté)
Route::get('/', [UniversityController::class, 'index'])->name('home');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // Redirection vers la page d’accueil en mode invité
})->name('logout');

// Routes d'authentification
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// Routes protégées (uniquement accessibles pour les utilisateurs connectés)
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [UniversityController::class, 'index']);  // Cette route est protégée par auth

    Route::get('/University', function () {
        return view('auth.University');
    });

    Route::get('/field', function () {
        return view('auth.field');
    });

    Route::get('/dashboard', function () {
        return view('auth.dashboard');
    });
    Route::get('/universities/{id}', [UniversityController::class, 'show'])->name('university.show');
});

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/university/store', [AdminController::class, 'storeUniversity'])->name('university.store');
    Route::post('/field/store', [AdminController::class, 'storeField'])->name('field.store');
});
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::put('/user/{id}/role', [AdminController::class, 'toggleRole'])->name('admin.user.toggleRole');
    Route::delete('/user/{id}', [AdminController::class, 'deleteUser'])->name('admin.user.delete');
});

Route::post('/favorites/toggle/{university}', [FavoriteController::class, 'toggle'])->name('favorites.toggle')->middleware('auth');
Route::middleware(['auth'])->group(function () {
    Route::get('/search-universities', [UniversitySearchController::class, 'index'])->name('universities.search');
   Route::get('/ajax-search-universities', [UniversitySearchController::class, 'ajaxSearch'])->name('universities.ajaxSearch');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/search-fields', [FieldSearchController::class, 'index'])->name('fields.search');
    Route::get('/ajax-search-fields', [FieldSearchController::class, 'ajaxSearch'])->name('fields.ajaxSearch');
    Route::get('/filiere/{id}', [FieldSearchController::class, 'showUniversities'])->name('field.universities');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::delete('/student/favorite/{id}', [StudentController::class, 'deleteFavorite'])->name('student.deleteFavorite');
    Route::put('/student/profile', [StudentController::class, 'updateProfile'])->name('student.updateProfile');
});
Route::get('/fields/{field}/universities', [FieldController::class, 'universities'])->name('fields.universities');
Route::middleware('auth')->group(function () {
    Route::get('/quiz', [QuizController::class, 'step1'])->name('quiz.step1');
    Route::post('/quiz', [QuizController::class, 'postStep1']);
    Route::get('/quiz2', [QuizController::class, 'step2'])->name('quiz.step2');
    Route::post('/quiz2', [QuizController::class, 'postStep2']);
    Route::get('/quiz3', [QuizController::class, 'step3'])->name('quiz.step3');
    Route::post('/quiz3', [QuizController::class, 'postStep3']);
});
Route::post('/universities/{university}/rate', [UniversityController::class, 'rate'])->name('universities.rate');
Route::middleware(['auth'])->group(function (){
    Route::get('/ranking', [UniversityController::class, 'ranking'])->name('universities.ranking');
});
// Route::get('/auth/google/redirect', [SocialiteController::class, 'redirectToGoogle'])->name('auth.google');
// Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

Route::get('/password/reset', function () {
    // Formulaire pour saisir l'email
    return view('auth.passwords.email');
})->name('password.request');

Route::post('/password/reset', function (Request $request) {
    // Pas de validation email ici, juste redirection vers formulaire changement mot de passe
    // Tu peux récupérer l'email pour l'utiliser dans la vue de changement si tu veux
    $email = $request->input('email');
    return redirect()->route('password.change', ['email' => $email]);
})->name('password.email');

Route::get('/password/change', function (Request $request) {
    // Formulaire pour changer le mot de passe
    // On récupère l'email passé en paramètre
    $email = $request->query('email');
    return view('auth.passwords.reset', ['email' => $email]);
})->name('password.change');

Route::post('/password/change', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Utilisateur non trouvé.']);
    }

    $user->password = Hash::make($request->password);
    $user->save();

    return redirect('login')->with('statu', 'Mot de passe changé avec succès !');
})->name('password.update');
