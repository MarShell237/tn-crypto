<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // Afficher le formulaire de dépôt
    public function create()
    {
        $countries = [
            'Cameroun' => 'XAF',
            'Gabon' => 'XAF',
            'Congo' => 'XAF',
            'Tchad' => 'XAF',
            'RCA' => 'XAF',
            'Guinée équatoriale' => 'XAF',
        ];

        return view('deposits.create', compact('countries'));
    }

    // Enregistrer le dépôt
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'country' => 'required|string',
        ]);

        $currencies = [
            'Cameroun' => 'XAF',
            'Gabon' => 'XAF',
            'Congo' => 'XAF',
            'Tchad' => 'XAF',
            'RCA' => 'XAF',
            'Guinée équatoriale' => 'XAF',
        ];

        $currency = $currencies[$request->country] ?? 'XAF';
        $minAmount = 1000;

        if ($request->amount < $minAmount) {
            return back()->with('error', "Le dépôt minimum est de $minAmount $currency");
        }

        Deposit::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'currency' => $currency,
            'country' => $request->country,
            'status' => 'completed', // dépôt automatique
        ]);

        return redirect()->route('dashboard')->with('success', 'Dépôt effectué avec succès !');
    }
}
