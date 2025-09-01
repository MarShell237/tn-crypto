<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;    

use App\Models\LuckyWin;
class LuckyLoopController extends Controller
{
    public function index() {
        $recentWins = LuckyWin::latest()->take(5)->get(); // Les 5 derniers gains
        return view('lucky-loop', compact('recentWins'));
    }
}
