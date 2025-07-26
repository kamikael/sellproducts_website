<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Stand;
use App\Models\User;
use App\Mail\UserApproved;
use App\Mail\UserRejected;
use Illuminate\Support\Facades\Mail;



class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        // Récupérer les utilisateurs en attente et approuvés
        $pendingRequests = User::where('role', 'entrepreneur_en_attente')->get();
        $approvedEntrepreneurs = User::where('role', 'entrepreneur_approuve')->get();
    
        return view('admin.index', compact('pendingRequests', 'approvedEntrepreneurs'));
    }    
    
    /**
     * Display the specified resource.
     */
    

     public function approve($id)
{
    $user = User::findOrFail($id);

    // Vérifie si l'utilisateur est en attente
    if ($user->role === 'entrepreneur_en_attente') {
        $user->role = 'entrepreneur_approuve';
        $user->save();

        // Envoi d'un email à l'utilisateur
        Mail::to($user->email)->send(new UserApproved($user));

        return redirect()->route('admin.index')->with('success', 'Utilisateur approuvé avec succès.');
    }

    return redirect()->route('admin.index')->with('error', 'Cet utilisateur ne peut pas être approuvé.');
}

//rejet de demande de stande et envoie  d'émail de rejet

public function reject($id)
{
    $user = User::findOrFail($id);
    $motif = request()->input('motif_rejet'); // Récupère le motif du formulaire

    // Envoyer l'e-mail AVANT suppression
    Mail::to($user->email)->send(new UserRejected($user, $motif));
    

    // Facultatif : Mettre à jour un statut avant suppression
    // $user->status = 'rejected';
    // $user->save();

    // Supprimer l'utilisateur
    $user->delete();

    return redirect()->back()->with('success', 'Utilisateur rejeté et supprimé.');
}

}



