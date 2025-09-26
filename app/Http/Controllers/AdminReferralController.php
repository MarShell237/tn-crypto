<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminReferralController extends Controller
{
    public function index()
    {
        // Récupérer tous les utilisateurs qui ont des filleuls
        $usersWithReferrals = User::with('referrals')->whereHas('referrals')->paginate(15);

        return view('admin.referrals.index', compact('usersWithReferrals'));
    }
}