<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use App\Models\Stand;
use Illuminate\Http\Request;

class CommandesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Afficher le panier temporaire
     */
    public function panier()
    {
        $panier = session()->get('panier', []);
        $produits = [];
        $total = 0;

        foreach ($panier as $produitId => $quantite) {
            $produit = Produit::with('stand')->find($produitId);
            if ($produit) {
                $produits[] = [
                    'produit' => $produit,
                    'quantite' => $quantite,
                    'sous_total' => $produit->prix * $quantite
                ];
                $total += $produit->prix * $quantite;
            }
        }

        return view('commandes.panier', compact('produits', 'total'));
    }

    /**
     * Ajouter un produit au panier
     */
    public function ajouterAuPanier(Request $request, Produit $produit)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1'
        ]);

        $panier = session()->get('panier', []);
        $quantite = $request->quantite;

        if (isset($panier[$produit->id])) {
            $panier[$produit->id] += $quantite;
        } else {
            $panier[$produit->id] = $quantite;
        }

        session()->put('panier', $panier);

        return redirect()->back()->with('success', 'Produit ajouté au panier.');
    }

    /**
     * Supprimer un produit du panier
     */
    public function supprimerDuPanier(Produit $produit)
    {
        $panier = session()->get('panier', []);
        unset($panier[$produit->id]);
        session()->put('panier', $panier);

        return redirect()->route('commandes.panier')->with('success', 'Produit supprimé du panier.');
    }

    /**
     * Vider le panier
     */
    public function viderPanier()
    {
        session()->forget('panier');
        return redirect()->route('commandes.panier')->with('success', 'Panier vidé.');
    }

    /**
     * Soumettre la commande
     */
    public function soumettreCommande(Request $request)
    {
        $panier = session()->get('panier', []);
        
        if (empty($panier)) {
            return redirect()->route('commandes.panier')->with('error', 'Votre panier est vide.');
        }

        // Grouper les produits par stand
        $commandesParStand = [];
        foreach ($panier as $produitId => $quantite) {
            $produit = Produit::with('stand')->find($produitId);
            if ($produit) {
                $standId = $produit->stand_id;
                if (!isset($commandesParStand[$standId])) {
                    $commandesParStand[$standId] = [];
                }
                $commandesParStand[$standId][] = [
                    'produit_id' => $produit->id,
                    'nom' => $produit->nom,
                    'prix' => $produit->prix,
                    'quantite' => $quantite,
                    'sous_total' => $produit->prix * $quantite
                ];
            }
        }

        // Créer une commande pour chaque stand
        foreach ($commandesParStand as $standId => $produits) {
            $totalStand = array_sum(array_column($produits, 'sous_total'));
            
            Commande::create([
                'stand_id' => $standId,
                'details_commande' => [
                    'produits' => $produits,
                    'total' => $totalStand,
                    'client_id' => auth()->id(),
                    'client_email' => auth()->user()->email
                ],
                'date_commande' => now()
            ]);
        }

        // Vider le panier
        session()->forget('panier');

        return redirect()->route('commandes.historique')->with('success', 'Commande soumise avec succès.');
    }

    /**
     * Afficher l'historique des commandes pour l'entrepreneur
     */
    public function historique()
    {
        $this->authorize('viewAny', Commande::class);
        
        $commandes = Commande::whereHas('stand', function($query) {
            $query->where('user_id', auth()->id());
        })->with('stand')->orderBy('created_at', 'desc')->get();

        return view('commandes.historique', compact('commandes'));
    }

    /**
     * Afficher les détails d'une commande
     */
    public function show(Commande $commande)
    {
        $this->authorize('view', $commande);
        return view('commandes.show', compact('commande'));
    }

    /**
     * Afficher les commandes pour l'admin (bonus)
     */
    public function adminCommandes()
    {
        $this->authorize('viewAdmin', Commande::class);
        
        $commandes = Commande::with(['stand.user'])->orderBy('created_at', 'desc')->get();
        return view('commandes.admin', compact('commandes'));
    }
} 