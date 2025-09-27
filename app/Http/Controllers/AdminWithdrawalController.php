<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminWithdrawalController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $withdrawals = Withdrawal::when($status, fn($q) => $q->where('status', $status))
                                 ->with('user')
                                 ->latest()
                                 ->get();

        return view('admin.withdrawals.index', compact('withdrawals','status'));
    }

    /**
     * Valider un retrait
     */
    public function validateWithdrawal(Withdrawal $withdrawal)
    {
        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'Ce retrait a déjà été traité.');
        }

        try {
            DB::transaction(function () use ($withdrawal) {
                $user = User::where('id', $withdrawal->user_id)->lockForUpdate()->first();

                if (! $user) {
                    throw new \Exception("Utilisateur introuvable.");
                }

                if ($user->balance < $withdrawal->amount) {
                    throw new \Exception("Solde insuffisant pour valider ce retrait.");
                }

                // Déduire le solde
                $user->balance -= $withdrawal->amount;
                $user->save();

                // Marquer comme validé
                $withdrawal->status = 'validated';
                $withdrawal->save();
            });

            return back()->with('success', 'Retrait validé avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Rejeter un retrait
     */
    public function rejectWithdrawal(Withdrawal $withdrawal)
    {
        try {
            DB::transaction(function () use ($withdrawal) {
                $user = User::where('id', $withdrawal->user_id)->lockForUpdate()->first();

                if (! $user) {
                    throw new \Exception("Utilisateur introuvable.");
                }

                if ($withdrawal->status === 'pending') {
                    $withdrawal->status = 'rejected';
                    $withdrawal->save();
                } elseif ($withdrawal->status === 'validated') {
                    // remboursement si déjà validé
                    $user->balance += $withdrawal->amount;
                    $user->save();

                    $withdrawal->status = 'rejected';
                    $withdrawal->save();
                } else {
                    throw new \Exception("Impossible de rejeter un retrait déjà payé.");
                }
            });

            return back()->with('success', 'Retrait rejeté avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Marquer comme payé
     */
    public function completeWithdrawal(Withdrawal $withdrawal)
    {
        if ($withdrawal->status !== 'validated') {
            return redirect()->back()->with('error', 'Seuls les retraits validés peuvent être marqués comme payés.');
        }

        $withdrawal->status = 'validated';
        $withdrawal->save();

        return redirect()->back()->with('success', 'Le retrait a été marqué comme payé.');
    }
}
