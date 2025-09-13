<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\UserProduct;
use Illuminate\Http\Request;

class ProduitController extends Controller
{

    public function index()
    {
        $produits = Produit::all();
        return view('produit.index', compact('produits'));
    }

    
}
