<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Stand;
use App\Models\User;
use App\Mail\UserApproved;
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

}



