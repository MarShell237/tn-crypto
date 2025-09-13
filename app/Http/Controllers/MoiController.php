<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoiController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // récupère l'utilisateur connecté
        return view('moi', compact('user'));
    }
}
