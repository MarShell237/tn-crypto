<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepotController extends Controller
{
    public function index()
    {
        return view('depot.index');
    }
}
