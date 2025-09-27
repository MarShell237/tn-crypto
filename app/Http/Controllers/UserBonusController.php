<?php

namespace App\Http\Controllers;

use App\Models\Bonus;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserBonusController extends Controller
{
    // Formulaire pour entrer un code
    public function showForm()
    {
        return view('bonus.use');
    }

    // Vérifier et appliquer un code
    public function apply(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $user = auth()->user();
        $bonus = Bonus::where('code', $request->code)->first();

        if (!$bonus) {
            return back()->withErrors(['code' => 'Code invalide.']);
        }

        // Vérifier si le bonus est actif
        if (!$bonus->is_active) {
            return back()->withErrors(['code' => 'Ce code n’est plus actif.']);
        }

        // Vérifier expiration
        if ($bonus->expires_at && now()->greaterThan($bonus->expires_at)) {
            return back()->withErrors(['code' => 'Ce code a expiré.']);
        }

        // Vérifier si déjà utilisé par cet utilisateur
        if ($user->bonuses()->where('bonus_id', $bonus->id)->exists()) {
            return back()->withErrors(['code' => 'Vous avez déjà utilisé ce code.']);
        }

        // Vérifier si montant défini
        if (!$bonus->amount) {
            return back()->withErrors(['code' => 'Ce code n’est pas encore activé.']);
        }

        // Associer le code à l’utilisateur
        $user->bonuses()->attach($bonus->id);

        // Créditer le wallet de l’utilisateur
        $user->balance += $bonus->amount;
        $user->save();

        return back()->with('success', "Félicitations ! Vous avez reçu {$bonus->amount} USDT ");
    }
}
