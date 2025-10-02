<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CryptoController extends Controller
{
    public function acheter(Request $request)
    {
        $user = Auth::user();
        $produitId = $request->input('produit_id'); // ID du produit
        $produit = Produit::findOrFail($produitId);

        $prixFcfa = $produit->prix;

        if($user->balance >= $prixFcfa) {
            // Débiter le solde
            $user->balance -= $prixFcfa;
            $user->save();

            // Ajouter le produit à la table pivot user_produit
            $user->produits()->attach($produit->id, [
                'duree'  => $produit->duree,
                'revenu' => $produit->revenu,
                'prix'   => $produit->prix,
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

    /**
     * Afficher les produits achetés par l’utilisateur
     */
    public function mesProduits()
    {
        $user = Auth::user();

        $produits = $user->produits()->withPivot('duree', 'revenu', 'prix')->get();

        return view('produits.mes-produits', compact('produits'));
    }
}
