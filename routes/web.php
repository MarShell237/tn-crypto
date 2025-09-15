<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\DepotController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\MinageController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RetraitController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\LuckyLoopController;
use App\Http\Controllers\PartenaireController;
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
    Route::get('/moi/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/moi/update', [UserController::class, 'update'])->name('user.update');
    // Produit - Liste des cryptos
    Route::get('/produits', [App\Http\Controllers\ProduitController::class, 'index'])->name('produit.index');
    // Produit - Achat
    Route::post('/produits/acheter/{id}', [App\Http\Controllers\ProduitController::class, 'acheter'])->name('produit.acheter');
    Route::get('/mes-produits', function () {
        return view('produit.index'); // on créera ce fichier ensuite
    })->name('produits.mes-produits');
    Route::post('/acheter-crypto', [CryptoController::class, 'acheter'])->name('acheter.crypto');
    Route::get('/produit/index', [ProduitController::class, 'index'])->name('produits.mes-produits');
    Route::get('/produits/mes-produits', [ProduitController::class, 'mesProduits'])->name('produits.mes');
    // Route::post('/acheter-crypto', [ProduitController::class, 'acheter'])->name('acheter.crypto');

    
    Route::get('/lucky-loop', [LuckyLoopController::class, 'index'])->name('lucky-loop.index');
    Route::post('/lucky-loop/spin', [LuckyLoopController::class, 'spin'])->name('lucky-loop.spin');
});
Route::get('/moi', [App\Http\Controllers\MoiController::class, 'index'])->middleware('auth')->name('moi');
Route::get('/equipe', [TeamController::class, 'index'])->name('team.index');
Route::middleware(['auth'])->group(function () {

});
Route::get('/bonus', [BonusController::class, 'index'])->name('bonus.index');
Route::get('/minages', [MinageController::class, 'index'])->name('minages.index')->middleware('auth');

Route::get('moi/depots', [DepotController::class, 'index'])->name('depots.index')->middleware('auth');
Route::get('moi/retraits', [RetraitController::class, 'index'])->name('retraits.index')->middleware('auth');
Route::get('/partenaires', [PartenaireController::class, 'index'])->name('partenaire.index')->middleware('auth');
require __DIR__.'/auth.php';
Route::get('/contact', function () {
    return view('contact');
})->name('contact');


// Routes pour l'administration des utilisateurs
Route::prefix('admin')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('admin.users.show');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
});
