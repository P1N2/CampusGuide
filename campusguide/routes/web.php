<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function(){
    return redirect('/login');
});
Route::get('/login', function () {
    return view('auth.login'); // Affiche la page de login
});
Route::get('/home', function () {
    return view('auth.home'); 
});
Route::get('/University', function () {
    return view('auth.University'); 
});
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/quiz', function () {
    return view('auth.quiz'); // Affiche la page de quiz
})->name('quiz.step1');
Route::get('/quiz2', function () {
    return view('auth.quiz2'); // Affiche la page de quiz
})->name('quiz.step2');
Route::get('/quiz3', function () {
    return view('auth.quiz3'); // Affiche la page de quiz
})->name('quiz.step3');

