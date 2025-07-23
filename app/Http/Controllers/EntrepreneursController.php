<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produit;

class EntrepreneursController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('/'); // Non connecté
        }

        if ($user->role === 'entrepreneur_en_attente') {
            return redirect()->route('attente');
        }

        if ($user->role !== 'entrepreneur_approuve') {
            return redirect('/'); // Pas autorisé
        }

        $products = Produit::with('stand')
            ->whereHas('stand', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->get();

        return view('dashboard', compact('products'));
    }

    public function attente()
    {
        $user = auth()->user();
        if ($user && $user->role === 'entrepreneur_approuve') {
            return redirect()->route('dashboard');
        }
        if ($user && $user->role === 'entrepreneur_en_attente') {
            return view('auth.attente');
        }
        return redirect('/');
    }
}
