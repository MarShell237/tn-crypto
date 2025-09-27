<?php

namespace App\Http\Controllers;

use App\Models\Bonus;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BonusController extends Controller
{
    // Afficher la liste des bonus
    public function index()
    {
        $bonuses = Bonus::latest()->get();
        return view('admin.bonus.index', compact('bonuses'));
    }

    // Générer un nouveau code
    public function generate()
    {
        $code = strtoupper(Str::random(8));
        $bonus = Bonus::create(['code' => $code]);

        return redirect()->route('bonus.edit', $bonus->id)
                         ->with('success', "Code généré : $code");
    }

    // Formulaire pour configurer un bonus
    public function edit($id)
    {
        $bonus = Bonus::findOrFail($id);
        return view('admin.bonus.edit', compact('bonus'));
    }

    // Sauvegarder la config du bonus
    public function update(Request $request, $id)
    {
        $bonus = Bonus::findOrFail($id);

        $request->validate([
            'amount' => 'required|numeric|min:0',
            'expires_at' => 'required|date',
        ]);

        $bonus->update([
            'amount' => $request->amount,
            'expires_at' => $request->expires_at,
        ]);

        return redirect()->route('bonus.index')->with('success', 'Bonus configuré avec succès !');
    }
}
