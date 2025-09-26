<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalBalance = User::sum('balance');
        $totalReferrals = User::whereNotNull('referred_by')->count();
        $newUsersThisMonth = User::whereMonth('created_at', now()->month)->count();

        // Données pour le graphique : nombre d'utilisateurs par mois
        $usersPerMonth = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                            ->groupBy('month')
                            ->orderBy('month')
                            ->get()
                            ->pluck('count', 'month')
                            ->toArray();

        // Labels de mois
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = Carbon::create()->month($i)->format('M');
            // Assurez-vous qu'il y a une valeur pour chaque mois
            if (!isset($usersPerMonth[$i])) {
                $usersPerMonth[$i] = 0;
            }
        }

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalBalance',
            'totalReferrals',
            'newUsersThisMonth',
            'usersPerMonth',
            'months'
        ));
    }
}  
