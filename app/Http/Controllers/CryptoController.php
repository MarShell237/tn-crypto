<?php

namespace App\Http\Controllers;

use App\Models\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CryptoController extends Controller
{
    public function acheter(Request $request)
    {
        $user = Auth::user();
        $prixFcfa = $request->input('prix_fcfa');

        if($user->balance >= $prixFcfa) {
              // Enregistrer dans user_produit
            // UserProduit::create([
            //     'user_id'    => $user->id,
            //     'produit_id' => $produit->id,
            //     'duree'      => $produit->duree,
            //     'revenu'     => $produit->revenu,
            //     'prix'       => $request->prix_fcfa,
            // ]);
            // Déduire le montant
            $user->balance -= $prixFcfa;
            $user->save();

            return response()->json([
                'success' => true,
                'nouveau_solde' => $user->balance
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

        // Récupère tous les produits liés à l’utilisateur
        $produits = $user->produits()->withPivot('duree', 'revenu', 'prix')->get();

        return view('produits.mes-produits', compact('produits'));
    }
}
