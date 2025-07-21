<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Stand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApprovalNotification;

class AdminController extends Controller
{
    public function __construct()
    {
        // Les middlewares sont gérés dans les routes
    }

    public function dashboard()
    {
        $pendingRequests = User::where('role', 'entrepreneur_en_attente')->get();
        $approvedEntrepreneurs = User::where('role', 'entrepreneur_approuve')->get();
        
        return view('admin.dashboard', compact('pendingRequests', 'approvedEntrepreneurs'));
    }

    public function approveRequest(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        if ($user->role !== 'entrepreneur_en_attente') {
            return redirect()->back()->with('error', 'Cette demande ne peut pas être approuvée.');
        }

        $user->update(['role' => 'entrepreneur_approuve']);

        // Créer automatiquement un stand pour l'entrepreneur
        Stand::create([
            'nom_stand' => $user->nom_entreprise,
            'description' => 'Stand de ' . $user->nom_entreprise,
            'user_id' => $user->id,
        ]);

        // Envoyer un email de notification
        try {
            Mail::to($user->email)->send(new ApprovalNotification($user));
        } catch (\Exception $e) {
            // Log l'erreur mais ne pas bloquer le processus
            \Log::error('Erreur lors de l\'envoi de l\'email: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'La demande de ' . $user->nom_entreprise . ' a été approuvée avec succès.');
    }

    public function rejectRequest(Request $request, $id)
    {
        $request->validate([
            'motif_rejet' => 'required|string|max:500',
        ], [
            'motif_rejet.required' => 'Le motif de rejet est requis.',
            'motif_rejet.max' => 'Le motif de rejet ne peut pas dépasser 500 caractères.',
        ]);

        $user = User::findOrFail($id);
        
        if ($user->role !== 'entrepreneur_en_attente') {
            return redirect()->back()->with('error', 'Cette demande ne peut pas être rejetée.');
        }

        $user->update([
            'role' => 'entrepreneur_rejete',
            'motif_rejet' => $request->motif_rejet,
        ]);

        return redirect()->back()->with('success', 'La demande de ' . $user->nom_entreprise . ' a été rejetée.');
    }

    public function showUserDetails($id)
    {
        $user = User::findOrFail($id);
        $stand = $user->stands()->first();
        
        return view('admin.user-details', compact('user', 'stand'));
    }
} 