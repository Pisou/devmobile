<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// -----------------------------------------------
// Page d'accueil → redirige vers login
// -----------------------------------------------
// Redirection page d'accueil vers login
Route::get('/', function () {
    return view('welcome');
})->name('home');

// -----------------------------------------------
// ROUTE 1 : Page "Vérifiez votre email"
// -----------------------------------------------
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// -----------------------------------------------
// ROUTE 2 : Traitement du lien reçu par email
// -----------------------------------------------
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

// -----------------------------------------------
// ROUTE 3 : Renvoyer l'email de vérification
// -----------------------------------------------
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Email de vérification renvoyé !');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// -----------------------------------------------
// ROUTES PROTÉGÉES : auth + email vérifié
// -----------------------------------------------
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Gestion des utilisateurs
    Route::resource('users', UserController::class);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
