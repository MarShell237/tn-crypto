<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
        ]);

        $user->update($request->only('name', 'email', 'phone', 'country'));

        return redirect()->route('moi')->with('success', 'Vos informations ont été mises à jour !');
    }
}
