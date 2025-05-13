<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\AdminController;
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

    Route::get('/profile', function () {
        return view('auth.profile');
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


Route::get('/quiz', function () {
    return view('auth.quiz');
})->name('quiz.step1');

Route::get('/quiz2', function () {
    return view('auth.quiz2');
})->name('quiz.step2');

Route::get('/quiz3', function () {
    return view('auth.quiz3');
})->name('quiz.step3');