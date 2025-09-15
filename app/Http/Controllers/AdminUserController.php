<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // Liste des utilisateurs
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    // Détails d'un utilisateur
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    // Formulaire modification
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Mettre à jour l'utilisateur
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:50',
            'country' => 'nullable|string|max:100',
            'balance' => 'nullable|numeric|min:0',
        ]);

        $user->update($request->all());

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès');
    }

    // Supprimer un utilisateur
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès');
    }
}
