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
}
