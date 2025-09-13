<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        // Exemple de membres de l'équipe
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

        return view('team.index', compact('members'));
    }
}
