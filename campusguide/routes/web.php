<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth.login'); // Affiche la page de login
});
Route::get('/register', function(){
    return view('auth.register');
});

