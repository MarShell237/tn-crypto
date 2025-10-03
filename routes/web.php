<?php

use App\Models\Withdrawal;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
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
use App\Http\Controllers\UserBonusController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\AdminDepositController;
use App\Http\Controllers\AdminReferralController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminWithdrawalController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Accueil
Route::get('/', function () {
    return view('welcome');
});

// Profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dépôts et Produits
Route::get('/depot/others/{deposit}', [DepositController::class, 'others'])->name('depot.others');
Route::post('/produits/{id}/claim', [CryptoController::class, 'claimGain'])->name('produits.claim');

Route::middleware(['auth'])->group(function () {
    // Dépôt
    Route::get('/deposit', [DepositController::class, 'create'])->name('deposit.create');
    Route::get('/depot/create', [DepositController::class, 'create'])->name('depot.create');
    Route::post('/depot', [DepositController::class, 'store'])->name('depot.store');
    Route::get('/depot/{deposit}/instructions', [DepositController::class, 'instructions'])->name('depot.instructions');
    Route::get('/depot/{deposit}/crypto', [DepositController::class, 'crypto'])->name('depot.crypto');

    // Lucky Loop
    Route::get('/lucky-loop', [LuckyLoopController::class, 'index'])->name('lucky-loop.index');
    Route::post('/lucky-loop/spin', [LuckyLoopController::class, 'spin'])->name('lucky-loop.spin');

    // Utilisateur
    Route::get('/moi/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/moi/update', [UserController::class, 'update'])->name('user.update');

    // Produits
    Route::get('/produits', [ProduitController::class, 'index'])->name('produit.index');
    Route::post('/produits/acheter/{id}', [ProduitController::class, 'acheter'])->name('produit.acheter');
    Route::get('/produit/index', [ProduitController::class, 'index'])->name('produits.index');
    Route::post('/acheter-crypto', [CryptoController::class, 'acheter'])->name('acheter.crypto');
    Route::get('/produits/mes-produits', [CryptoController::class, 'mesProduits'])->name('produits.mes');
});

// Pages diverses
Route::get('/moi', [App\Http\Controllers\MoiController::class, 'index'])->middleware('auth')->name('moi');
Route::get('/equipe', [TeamController::class, 'index'])->name('team.index');
Route::get('/bonus', [BonusController::class, 'index'])->name('bonus.index');
Route::get('/minages', [MinageController::class, 'index'])->middleware('auth')->name('minages.index');
Route::get('/moi/depots', [DepotController::class, 'index'])->middleware('auth')->name('depots.index');
Route::get('/moi/retraits', [RetraitController::class, 'index'])->middleware('auth')->name('retraits.index');

Route::get('/partenaires', function () {
    $partners = [
        ['name' => 'Binance','url' => 'https://www.binance.com','logo' => 'binance.png','description' => "Exchange crypto leader mondial."],
        ['name' => 'Deriv','url' => 'https://www.deriv.com','logo' => 'deriv.png','description' => "Plateforme de trading en ligne."],
        ['name' => 'XM','url' => 'https://www.xm.com','logo' => 'xm.png','description' => "Broker forex et CFD connu."],
        ['name' => 'Exness','url' => 'https://www.exness.com','logo' => 'exness.png','description' => "Broker forex global."],
        ['name' => 'OKX','url' => 'https://www.okx.com','logo' => 'okx.png','description' => "Exchange crypto et services dérivés."],
        ['name' => 'FBS','url' => 'https://www.fbs.com','logo' => 'fbs.png','description' => "Broker - optionnel 'autre partenaire'."]
    ];
    return view('partenaire.index', compact('partners'));
})->middleware('auth')->name('partenaire.index');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Withdrawals utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/withdrawals/create', [WithdrawalController::class, 'create'])->name('withdrawals.create');
    Route::post('/withdrawals/store', [WithdrawalController::class, 'store'])->name('withdrawals.store');
    Route::get('/withdrawals/history', [WithdrawalController::class, 'history'])->name('withdrawals.history');
});

// Bonus utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/bonus/use', [UserBonusController::class, 'showForm'])->name('bonus.use');
    Route::post('/bonus/use', [UserBonusController::class, 'apply'])->name('bonus.apply');
});

// Chat utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
});

// Dashboard utilisateur
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [CryptoController::class, 'dashboard'])->name('dashboard');
});

// =======================
// Routes ADMIN regroupées
// =======================
Route::prefix('admin')->middleware(['auth', IsAdmin::class])->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Referrals
    Route::get('/referrals', [AdminReferralController::class, 'index'])->name('referrals.index');

    // Dépôts
    Route::get('/deposits', [AdminDepositController::class, 'index'])->name('deposits.index');
    Route::post('/deposit/{deposit}/validate', [AdminDepositController::class, 'validateDeposit'])->name('deposit.validate');

    // Utilisateurs
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // Withdrawals
    Route::get('/withdrawals', [AdminWithdrawalController::class, 'index'])->name('withdrawals.index');
    Route::post('/withdrawals/{withdrawal}/validate', [AdminWithdrawalController::class, 'validateWithdrawal'])->name('withdrawals.validate');
    Route::post('/withdrawals/{withdrawal}/complete', [AdminWithdrawalController::class, 'completeWithdrawal'])->name('withdrawals.complete');
    Route::post('/withdrawals/{withdrawal}/reject', [AdminWithdrawalController::class, 'rejectWithdrawal'])->name('withdrawals.reject');

});

Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/bonus', [BonusController::class, 'index'])->name('bonus.index');
    Route::post('/bonus/generate', [BonusController::class, 'generate'])->name('bonus.generate');
    Route::get('/bonus/{id}/edit', [BonusController::class, 'edit'])->name('bonus.edit');
    Route::post('/bonus/{id}', [BonusController::class, 'update'])->name('bonus.update');
});


// Auth scaffolding
require __DIR__.'/auth.php';
