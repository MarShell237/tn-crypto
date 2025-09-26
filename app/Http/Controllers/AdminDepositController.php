<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDepositController extends Controller
{
    /**
     * Liste des dépôts
     */
    public function index(Request $request)
    {
        $status = $request->query('status');

        $deposits = Deposit::when($status, function($q, $status) {
            return $q->where('status', $status);
        })->orderBy('created_at', 'desc')->get();

        return view('admin.deposits.index', compact('deposits', 'status'));
    }

    /**
     * Validation d’un dépôt par l’admin
     */
    public function validateDeposit(Deposit $deposit)
    {
        if ($deposit->status !== 'pending') {
            return redirect()->route('admin.deposits.index')
                             ->with('error', 'Le dépôt a déjà été validé ou traité.');
        }

        DB::transaction(function () use ($deposit) {
            // 1. Mise à jour du dépôt
            $deposit->status = 'validated';
            $deposit->save();

            // 2. Créditer le solde de l’utilisateur
            $user = $deposit->user;
            $user->balance += $deposit->amount;
            $user->save();

            // 3. Vérifier si l’utilisateur a un parrain
            if ($user->referred_by) {
                $sponsor = User::find($user->referred_by);

                if ($sponsor) {
                    // Calcul de la commission (15%)
                    $commission = $deposit->amount * 0.15;

                    // Créditer le parrain
                    $sponsor->balance += $commission;
                    $sponsor->save();

                    // Historiser la commission (enregistrée comme "deposit" aussi)
                    Deposit::create([
                        'user_id'   => $sponsor->id,
                        'amount'    => $commission,
                        'status'    => 'completed',
                        'reference' => 'COM-' . strtoupper(uniqid()),
                    ]);
                }
            }
        });

        return redirect()->route('admin.deposits.index')
                         ->with('success', 'Le dépôt a été validé avec succès.');
    }
}
