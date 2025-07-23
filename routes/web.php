<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\StandsController;
use App\Http\Controllers\CommandesController;
use App\Http\Controllers\VitrineController;
use Illuminate\Support\Facades\Auth;
use App\Models\Produit;
use App\Http\Controllers\EntrepreneursController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
//login & register

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', [VitrineController::class, 'index'])->name('vitrine.index');

// Routes publiques pour le panier et la commande
Route::get('/panier', [CommandesController::class, 'panier'])->name('commandes.panier');
Route::post('/panier/ajouter/{produit}', [CommandesController::class, 'ajouterAuPanier'])->name('commandes.ajouter-au-panier');
Route::delete('/panier/supprimer/{produit}', [CommandesController::class, 'supprimerDuPanier'])->name('commandes.supprimer-du-panier');
Route::delete('/panier/vider', [CommandesController::class, 'viderPanier'])->name('commandes.vider-panier');
Route::post('/commande/soumettre', [CommandesController::class, 'soumettreCommande'])->name('commandes.soumettre');
Route::delete('/panier/vider-historique', [App\Http\Controllers\CommandesController::class, 'viderHistorique'])->name('commandes.vider-historique');

// Routes publiques pour la vitrine
Route::get('/vitrine/stand/{stand}', [VitrineController::class, 'showStand'])->name('vitrine.stand');
Route::get('/vitrine/recherche', [VitrineController::class, 'rechercher'])->name('vitrine.recherche');

// Routes protégées (auth)
Route::middleware(['auth'])->group(function () {
    // Produits et stands (gestion)
    Route::resource('produits', ProduitsController::class);
    Route::get('stands', [StandsController::class, 'index'])->name('stands.index');
    Route::get('stands/create', [StandsController::class, 'create'])->name('stands.create');
    Route::post('stands', [StandsController::class, 'store'])->name('stands.store');
    Route::get('stands/{stand}/edit', [StandsController::class, 'edit'])->name('stands.edit');
    Route::put('stands/{stand}', [StandsController::class, 'update'])->name('stands.update');
    Route::patch('stands/{stand}', [StandsController::class, 'update']);
    Route::get('stands/{stand}', [StandsController::class, 'show'])->name('stands.show');

    // Historique et détails de commandes (utilisateurs connectés)
    Route::get('/commandes/historique', [CommandesController::class, 'historique'])->name('commandes.historique');
    Route::get('/commandes/{commande}', [CommandesController::class, 'show'])->name('commandes.show');

    // Route admin pour voir toutes les commandes (bonus)
    Route::get('/admin/commandes', [CommandesController::class, 'adminCommandes'])->name('admin.commandes');

    // Ajout des routes attente et dashboard dans le groupe auth
    Route::get('/attente', [EntrepreneursController::class, 'attente'])->name('attente');
    Route::get('/dashboard', [EntrepreneursController::class, 'dashboard'])->name('dashboard');
    Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
    // Approver un utilisateur (POST)
    Route::post('/admin/users/{id}/approve', [AdminController::class, 'approve'])->name('admin.users.approve');
    //pour l'email
    Route::get('/test-gmail', function() {
        Mail::raw('Test SMTP Gmail', function($m) {
            $m->to('destinataire@example.com')->subject('Test');
        });
        return "Email envoyé !";
    });
});
