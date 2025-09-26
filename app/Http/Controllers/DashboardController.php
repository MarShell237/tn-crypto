<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Niveau A = filleuls directs
        $niveauA = $user->referrals()->count();

        // Niveau B = filleuls des filleuls (2ème niveau)
        $niveauB = $user->referrals()->withCount('referrals')->get()->sum('referrals_count');

        // Niveau C = filleuls des filleuls des filleuls (3ème niveau)
        $niveauC = $user->referrals()->with('referrals.referrals')->get()->sum(function ($filleul) {
            return $filleul->referrals->sum(function ($sousFilleul) {
                return $sousFilleul->referrals->count();
            });
        });

        return view('team.index', compact('niveauA', 'niveauB', 'niveauC'));
    }
}
