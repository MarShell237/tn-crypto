<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Withdrawal;

class WithdrawalController extends Controller
{
    public function create()
    {
        $methods = ['MOMO', 'OM', 'CRYPTO'];
        return view('withdrawal.create', compact('methods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:2000',
            'method' => 'required|in:MOMO,OM,CRYPTO',
            'phone' => 'nullable|string',
        ]);

        $user = Auth::user();

        // Vérifier le solde
        if ($request->amount > $user->balance) {
            return back()->withErrors(['amount' => 'Solde insuffisant pour ce retrait']);
        }

        // Créer le retrait
        Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'method' => $request->method,
            'phone' => $request->phone,
            'status' => 'pending',
        ]);

        // Débiter le solde immédiatement (optionnel selon la logique)
        $user->decrement('balance', $request->amount);

        return redirect()->route('withdrawal.create')->with('success', 'Retrait initié avec succès !');
    }
}
