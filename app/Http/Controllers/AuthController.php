<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nom_entreprise' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'Le nom est requis.',
            'nom_entreprise.required' => 'Le nom de l\'entreprise est requis.',
            'email.required' => 'L\'email est requis.',
            'email.email' => 'L\'email doit être valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.required' => 'Le mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'nom_entreprise' => $request->nom_entreprise,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'entrepreneur_en_attente',
        ]);

        return redirect()->route('login')
            ->with('success', 'Votre demande d\'inscription a été soumise avec succès. Elle sera examinée par un administrateur.');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'L\'email est requis.',
            'email.email' => 'L\'email doit être valide.',
            'password.required' => 'Le mot de passe est requis.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'entrepreneur_en_attente' || $user->role === 'entrepreneur_rejete') {
                // Rediriger vers la page de statut mais sans déconnecter
                return redirect()->route('status');
            }

            $request->session()->regenerate();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('entrepreneur.dashboard');
            }
        }

        return redirect()->back()->with('error', 'Email ou mot de passe incorrect.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home');
    }

    public function showStatus()
    {
        $user = Auth::user();
        return view('auth.status', compact('user'));
    }
} 