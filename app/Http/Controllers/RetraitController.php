<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RetraitController extends Controller
{
    public function index()
    {
        return view('retrait.index');
    }
}
