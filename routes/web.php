<?php

use App\Http\Controllers\LuckyLoopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Routes pour les dépôts (accessibles uniquement aux utilisateurs authentifiés)
Route::middleware(['auth'])->group(function () {
    // Afficher le formulaire de dépôt
    Route::get('/deposit', [DepositController::class, 'create'])->name('deposit.create');

    // Enregistrer le dépôt
    Route::get('/lucky-loop', [LuckyLoopController::class, 'index'])->name('lucky-loop.index');
});

require __DIR__.'/auth.php';
