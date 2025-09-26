<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 🔹 Calcul des filleuls directs (Niveau A)
        $niveauA = $user->referrals()->count();

        // 🔹 Niveau B = filleuls des filleuls (2ème niveau)
        $niveauB = $user->referrals()->withCount('referrals')->get()->sum('referrals_count');

        // 🔹 Niveau C = filleuls des filleuls des filleuls (3ème niveau)
        $niveauC = $user->referrals()->with('referrals.referrals')->get()->sum(function ($filleul) {
            return $filleul->referrals->sum(function ($sousFilleul) {
                return $sousFilleul->referrals->count();
            });
        });

        // 🔹 Progression vers partenaire
        $directReferralsCount = $niveauA; // filleuls directs = niveau A
        $progress = min(100, ($directReferralsCount / 50) * 100);

        // Exemple de membres de l'équipe (statique)
        $members = [
            [
                'name' => 'Alice Dupont',
                'role' => 'CEO',
                'photo' => asset('IMAGES/team/alice.jpg')
            ],
            [
                'name' => 'Marc Leblanc',
                'role' => 'CTO',
                'photo' => asset('IMAGES/team/marc.jpg')
            ],
            [
                'name' => 'Sophie Martin',
                'role' => 'Responsable Marketing',
                'photo' => asset('IMAGES/team/sophie.jpg')
            ],
            [
                'name' => 'David Moreau',
                'role' => 'Développeur Full Stack',
                'photo' => asset('IMAGES/team/david.jpg')
            ],
        ];

        return view('team.index', compact(
            'members',
            'niveauA',
            'niveauB',
            'niveauC',
            'directReferralsCount',
            'progress'
        ));
    }
}
