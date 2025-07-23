<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Stand;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nom_entreprise' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Le nom complet est obligatoire.',
            'email.required' => "L'adresse email est obligatoire.",
            'email.email' => "L'adresse email n'est pas valide.",
            'email.unique' => "Cette adresse email est déjà utilisée.",
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'nom_entreprise' => $request->nom_entreprise,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'entrepreneur_en_attente',
        ]);

        // Création du stand associé
        Stand::create([
            'nom_stand' => $request->nom_stand,
            'description' => $request->description_stand,
            'user_id' => $user->id,
        ]);

        Auth::login($user);
        return redirect()->route('attente')->with('status', 'Inscription réussie. Votre demande est en attente de validation.');
    }
}
