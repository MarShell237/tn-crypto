<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CryptoController extends Controller
{
    /**
     * Achat de produit
     */
    public function acheter(Request $request)
    {
        $user = Auth::user();
        $produitId = $request->input('produit_id');
        $produit = Produit::findOrFail($produitId);

        if ($user->balance < $produit->prix) {
            return response()->json([
                'success' => false,
                'message' => 'Solde insuffisant !'
            ]);
        }

        $user->balance -= $produit->prix;
        $user->save();

        $user->produits()->attach($produit->id, [
            'duree'        => $produit->duree,
            'revenu'       => $produit->revenu,
            'prix'         => $produit->prix,
            'montant'      => 0,
            'compte_total' => 0,
            'last_gain_at' => null,
        ]);

        return response()->json([
            'success' => true,
            'nouveau_solde' => $user->balance,
            'message' => 'Produit acheté avec succès !'
        ]);
    }

    /**
     * Liste des produits achetés par l’utilisateur
     * + calcul du temps restant côté backend
     */
    public function mesProduits()
    {
        $user = Auth::user();

        $produits = $user->produits()
            ->withPivot('duree', 'revenu', 'prix', 'montant', 'compte_total', 'last_gain_at')
            ->get()
            ->map(function ($produit) {
                $pivot = $produit->pivot;

                if ($pivot->last_gain_at) {
                    // Prochain moment où l’utilisateur pourra réclamer (24h après)
                    $next = Carbon::parse($pivot->last_gain_at)->addHours(24);

                    // Temps restant avant disponibilité
                    $produit->next_available_at = $next->toIso8601String();
                    $produit->temps_restant = max(0, now()->diffInSeconds($next, false));

                    // Peut réclamer ?
                    $produit->can_claim = $next->isPast();
                } else {
                    // Jamais réclamé => disponible immédiatement
                    $produit->next_available_at = null;
                    $produit->temps_restant = 0;
                    $produit->can_claim = true;
                }

                return $produit;
            });

        return view('produits.mes-produits', compact('produits'));
    }

    /**
     * Réclamer le gain (toutes les 24h)
     */
    public function claimGain($id)
    {
        $user = Auth::user();
        $produit = $user->produits()->where('produit_id', $id)->firstOrFail();
        $pivot   = $produit->pivot;

        // Vérification du délai de 24h
        if ($pivot->last_gain_at) {
            $dernierGain = Carbon::parse($pivot->last_gain_at);
            $next = $dernierGain->addHours(24);

            if ($next->isFuture()) {
                $diff = now()->diffInSeconds($next, false);
                $heures = floor($diff / 3600);
                $minutes = floor(($diff % 3600) / 60);
                $secondes = $diff % 60;

                return back()->with('error', "⏳ Vous devez encore attendre {$heures}h {$minutes}m {$secondes}s avant de réclamer à nouveau.");
            }
        }

        // Mise à jour des gains
        $nouveauMontant = $pivot->montant + $produit->revenu;
        $nouveauCompteTotal = $pivot->compte_total + $produit->revenu;

        $user->produits()->updateExistingPivot($produit->id, [
            'montant'      => $nouveauMontant,
            'compte_total' => $nouveauCompteTotal,
            'last_gain_at' => now(),
            'updated_at'   => now(),
        ]);

        // Ajout au solde utilisateur
        $user->balance += $produit->revenu;
        $user->save();

        return back()->with('success', '✅ Gain ajouté avec succès ! Vous pourrez réclamer à nouveau dans 24 heures.');
    }

    /**
     * Dashboard de l’utilisateur
     */
    public function dashboard()
    {
        $user = Auth::user();

        $totalGains = $user->produits()
            ->withPivot('montant')
            ->get()
            ->sum(fn($p) => $p->pivot->montant);

        return view('dashboard', [
            'totalGains'  => $totalGains,
            'soldeTotal'  => $user->balance,
            'userBalance' => $user->balance,
        ]);
    }
}
