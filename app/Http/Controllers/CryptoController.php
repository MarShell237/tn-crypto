<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CryptoController extends Controller
{
    // Achat de produit
    public function acheter(Request $request)
    {
        $user = Auth::user();
        $produitId = $request->input('produit_id');
        $produit = Produit::findOrFail($produitId);

        if ($user->balance >= $produit->prix) {
            $user->balance -= $produit->prix;
            $user->save();

            $user->produits()->attach($produit->id, [
                'duree'       => $produit->duree,
                'revenu'      => $produit->revenu,
                'prix'        => $produit->prix,
                'montant'     => 0,
                'compte_total'=> 0,
                'last_gain_at'=> null,
            ]);

            return response()->json([
                'success' => true,
                'nouveau_solde' => $user->balance,
                'message' => 'Produit acheté avec succès !'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Solde insuffisant !'
        ]);
    }

    // Affichage des produits achetés
    public function mesProduits()
    {
        $user = Auth::user();

        $produits = $user->produits()
            ->withPivot('duree', 'revenu', 'prix', 'montant', 'compte_total', 'last_gain_at')
            ->get();

        return view('produits.mes-produits', compact('produits'));
    }

    // Réclamer le gain journalier
    public function claimGain($id)
    {
        $user = Auth::user();

        $produit = $user->produits()->where('produit_id', $id)->firstOrFail();
        $pivot   = $produit->pivot;

        // Vérification 24 heures
        if ($pivot->last_gain_at && now()->diffInHours($pivot->last_gain_at) < 24) {
            return back()->with('error', '⏳ Vous devez attendre 24h avant de réclamer vos gains.');
        }

        // Mise à jour du cumul du produit
        $nouveauMontant = $pivot->montant + $produit->revenu;
        $nouveauCompteTotal = $pivot->compte_total + $produit->revenu;

        $user->produits()->updateExistingPivot($produit->id, [
            'montant'      => $nouveauMontant,
            'compte_total' => $nouveauCompteTotal,
            'last_gain_at' => now(),
            'updated_at'   => now(),
        ]);

        // Mise à jour du solde de l'utilisateur
        $user->balance += $produit->revenu;
        $user->save();

        return back()->with('success', 'Gain journalier ajouté avec succès !');
    }

    // Méthode pour le dashboard
    public function dashboard()
    {
        $user = Auth::user();

        // Gains cumulés
        $totalGains = $user->produits()
            ->withPivot('montant')
            ->get()
            ->sum(fn($p) => $p->pivot->montant);

        // Le solde total est simplement la balance du user
        $soldeTotal = $user->balance;

        return view('dashboard', [
            'totalGains'   => $totalGains,
            'soldeTotal'   => $soldeTotal,
            'userBalance'  => $user->balance
        ]);
    }
}
