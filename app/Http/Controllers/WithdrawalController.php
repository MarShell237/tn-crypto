<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WithdrawalController extends Controller
{
    public function create()
    {
        $methods = ['MOMO','OM','CRYPTO'];
        return view('withdrawals.create', compact('methods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => ['required','numeric','min:1000'],
            'method' => ['required','string'],
            'phone'  => ['nullable','required_if:method,MOMO,OM','string'],
        ]);

        $user = Auth::user();

        if ($request->amount > $user->balance) {
            return back()->with('error', 'Solde insuffisant pour ce retrait.');
        }

        Withdrawal::create([
            'user_id'   => $user->id,
            'amount'    => $request->amount,
            'method' => $request->input('method'),
            'phone'     => $request->phone,
            'reference' => 'WD-' . strtoupper(Str::random(8)),
            'status'    => 'pending',
        ]);

        return redirect()->route('withdrawals.history')
                         ->with('success', 'Votre demande de retrait a été enregistrée et est en attente de validation.');
    }

    public function history()
    {
        $withdrawals = Auth::user()->withdrawals()->latest()->get();
        return view('withdrawals.history', compact('withdrawals'));
    }
}
