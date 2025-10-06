<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Affiche le formulaire d'inscription.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Gère l'inscription de l'utilisateur.
     */
    public function store(Request $request)
    {
        // Validation des champs
        $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'referral_code' => 'nullable|string|exists:users,referral_code', // Vérification du code de parrainage
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'country' => $request->country,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Vérification du code de parrainage
        if ($request->filled('referral_code')) {
            $referrer = User::where('referral_code', $request->referral_code)->first();
            if ($referrer) {
                $user->referred_by = $referrer->id;
                $user->save();

                // Bonus automatique pour le parrain
                $referrer->balance += 250; 
                $referrer->save();
            }
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Compte créé avec succès !');
    }
}
