<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\StandsController;
use App\Http\Controllers\CommandesController;
use App\Http\Controllers\VitrineController;

Route::get('/', [VitrineController::class, 'index'])->name('accueil');



// Routes publiques pour le panier et la commande
Route::get('/panier', [CommandesController::class, 'panier'])->name('commandes.panier');
Route::post('/panier/ajouter/{produit}', [CommandesController::class, 'ajouterAuPanier'])->name('commandes.ajouter-au-panier');
Route::delete('/panier/supprimer/{produit}', [CommandesController::class, 'supprimerDuPanier'])->name('commandes.supprimer-du-panier');
Route::delete('/panier/vider', [CommandesController::class, 'viderPanier'])->name('commandes.vider-panier');
Route::post('/commande/soumettre', [CommandesController::class, 'soumettreCommande'])->name('commandes.soumettre');

// Routes publiques pour la vitrine
Route::get('/vitrine', [VitrineController::class, 'index'])->name('vitrine.index');
Route::get('/vitrine/stand/{stand}', [VitrineController::class, 'showStand'])->name('vitrine.stand');
Route::get('/vitrine/recherche', [VitrineController::class, 'rechercher'])->name('vitrine.recherche');

// Routes protégées (auth)
Route::middleware(['auth'])->group(function () {
    // Produits et stands (gestion)
    Route::resource('produits', ProduitsController::class);
    Route::resource('stands', StandsController::class);

    // Historique et détails de commandes (utilisateurs connectés)
    Route::get('/commandes/historique', [CommandesController::class, 'historique'])->name('commandes.historique');
    Route::get('/commandes/{commande}', [CommandesController::class, 'show'])->name('commandes.show');

    // Route admin pour voir toutes les commandes (bonus)
    Route::get('/admin/commandes', [CommandesController::class, 'adminCommandes'])->name('admin.commandes');
});

