<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DepositController extends Controller
{
    // Affiche le formulaire
    public function create()
    {
        // Liste des méthodes de dépôt
        $methods = Deposit::METHODS;

        return view('deposits.create', compact('methods'));
    }

    // Traite la requête de dépôt
    public function store(Request $request)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:2000'],
            'method' => ['required', 'string'],
            'phone'  => ['nullable', 'required_if:method,MOMO,OM', 'string'],
        ], [
            'amount.min' => 'Le montant minimal est de 5000 FCFA.',
            'phone.required_if' => 'Le numéro de téléphone est requis pour MOMO / OM.',
        ]);

        $user = Auth::user();

        // Créer un dépôt en attente de validation admin
        $deposit = Deposit::create([
            'user_id'   => $user->id,
            'amount'    => $request->input('amount'),
            'method'    => $request->input('method'),
            'status'    => 'pending', // l’admin devra confirmer
            'phone'     => $request->input('phone'),
            'reference' => Str::upper(Str::random(10)),
        ]);

        // Redirection selon la méthode choisie
        if ($deposit->method === 'CRYPTO') {
            return redirect()->route('depot.crypto', $deposit->id);
        }

        if ($deposit->method === 'autres') {
            return redirect()->route('depot.others', $deposit->id);
        }

        // Par défaut, instructions MOMO / OM
        return redirect()->route('depot.instructions', $deposit->id);
    }

    // Vue d'instructions pour MOMO/OM
    public function instructions(Deposit $deposit)
    {
        if (!in_array($deposit->method, ['MOMO', 'OM'])) {
            abort(404);
        }

        return view('deposits.instructions', compact('deposit'));
    }

    // Vue pour crypto (adresse / QR)
    public function crypto(Deposit $deposit)
    {
        if ($deposit->method !== 'CRYPTO') {
            abort(404);
        }

        $walletAddress = config('services.crypto.wallet_address')
            ?? '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa';

        return view('deposits.crypto', compact('deposit', 'walletAddress'));
    }

    // Vue pour "Autres"
    public function others(Deposit $deposit)
    {
        if ($deposit->method !== 'autres') {
            abort(404);
        }

        $paymentLink = 'https://vnvshfpe.mychariow.store/prd_11vdjr/checkout';

        return view('deposits.others', compact('deposit', 'paymentLink'));
    }
}
