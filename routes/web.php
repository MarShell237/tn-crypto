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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LuckyLoopController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\AdminDepositController;
use App\Http\Controllers\AdminReferralController;
use App\Http\Controllers\AdminDashboardController;
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


    // Affichage de tous les produits disponibles à l’achat
    Route::get('/produit/index', [ProduitController::class, 'index'])->name('produits.index');

    // Acheter un produit
    Route::post('/acheter-crypto', [CryptoController::class, 'acheter'])->name('acheter.crypto');

    // Voir mes produits achetés
    Route::get('/produits/mes-produits', [CryptoController::class, 'mesProduits'])->name('produits.mes');


    // Route::post('/acheter-crypto', [ProduitController::class, 'acheter'])->name('acheter.crypto');
     Route::get('/team', [DashboardController::class, 'index'])->name('team.index');
    
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
// Route::get('/partenaires', [PartenaireController::class, 'index'])->name('partenaire.index')->middleware('auth');

Route::get('/partenaires', function () {
    $partners = [
        [
            'name' => 'Binance',
            'url' => 'https://www.binance.com',
            'logo' => 'binance.png',
            'description' => "Exchange crypto leader mondial."
        ],
        [
            'name' => 'Deriv',
            'url' => 'https://www.deriv.com',
            'logo' => 'deriv.png',
            'description' => "Plateforme de trading en ligne."
        ],
        [
            'name' => 'XM',
            'url' => 'https://www.xm.com',
            'logo' => 'xm.png',
            'description' => "Broker forex et CFD connu."
        ],
        [
            'name' => 'Exness',
            'url' => 'https://www.exness.com',
            'logo' => 'exness.png',
            'description' => "Broker forex global."
        ],
        [
            'name' => 'OKX',
            'url' => 'https://www.okx.com',
            'logo' => 'okx.png',
            'description' => "Exchange crypto et services dérivés."
        ],
        [
            'name' => 'FBS',
            'url' => 'https://www.fbs.com',
            'logo' => 'fbs.png',
            'description' => "Broker - optionnel 'autre partenaire'."
        ],
    ];

    return view('partenaire.index', compact('partners'));
})->name('partenaire.index')->middleware('auth');
require __DIR__.'/auth.php';
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::middleware('auth')->group(function () {
    Route::get('/depot/create', [DepositController::class, 'create'])->name('depot.create');
    Route::post('/depot', [DepositController::class, 'store'])->name('depot.store');

    // pages d'instructions / récap
    Route::get('/depot/{deposit}/instructions', [DepositController::class, 'instructions'])->name('depot.instructions');
    Route::get('/depot/{deposit}/crypto', [DepositController::class, 'crypto'])->name('depot.crypto');
});

Route::prefix('admin')->middleware(['auth', IsAdmin::class])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/referrals', [AdminReferralController::class, 'index'])->name('referrals.index');

    // Dépôts
    Route::get('/deposits', [AdminDepositController::class, 'index'])->name('deposits.index');
    Route::post('/deposit/{deposit}/validate', [AdminDepositController::class, 'validateDeposit'])->name('deposit.validate');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
});


// web.php
Route::middleware('auth')->group(function () {
    Route::get('/withdrawal/create', [WithdrawalController::class, 'create'])->name('withdrawal.create');
    Route::post('/withdrawal', [WithdrawalController::class, 'store'])->name('withdrawal.store');
});
