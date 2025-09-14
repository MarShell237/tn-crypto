<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LuckyWin;
use Illuminate\Support\Facades\Auth;

class LuckyLoopController extends Controller
{
    public function index() {
        $recentWins = LuckyWin::latest()->take(5)->get();
        return view('lucky-loop', compact('recentWins'));
    }

    public function spin(Request $request) {
        $user = Auth::user();
        $reward = $request->reward; // ex: "solde x2", "x1", "x2", "Perdu", "Code"

        $soldeAvant = $user->solde ?? 0; // suppose que tu as un champ solde dans users
        $nouveauSolde = $soldeAvant;

        // Appliquer le gain selon le résultat
        switch($reward) {
            case "solde x2":
                $nouveauSolde *= 2;
                break;
            case "x2":
                $nouveauSolde *= 2;
                break;
            case "x1":
                $nouveauSolde *= 1;
                break;
            case "Perdu":
                $nouveauSolde = $soldeAvant; // pas de gain
                break;
            case "Code":
                // Optionnel: enregistrer un code promo ou un bonus
                break;
        }

        // Sauvegarder le nouveau solde
        $user->solde = $nouveauSolde;
        $user->save();

        // Enregistrer le gain dans lucky_wins
        LuckyWin::create([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'reward' => $reward,
        ]);

        return response()->json([
            'success' => true,
            'reward' => $reward,
            'nouveau_solde' => $nouveauSolde
        ]);
    }
}
