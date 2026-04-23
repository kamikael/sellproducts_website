<?php

// Temporarily comment out namespace for direct testing
// namespace App\Services;

class Panier
{
    /**
     * Create a new class instance.
     */

    public $tabPro = [];
    public $Prod = ['id'=> '','nom' => '', 'prix' => '0', 'quantite' => '0'];
    
    public function __construct($Prod = null, $id = null, $nom = null, $prix = null, $quantite = null)
    {
        $this->Prod['id'] = $id;
        $this->Prod['nom'] = $nom;
        $this->Prod['prix'] = $prix;
        $this->Prod['quantite'] = $quantite;
    
        echo "Service Panier initialisé.\n";
        if ($Prod !== null) {
            $this->ajouterProd($Prod);
            
        }
    }

    public function ajouterProd($Prod)
    {
        array_push($this->tabPro, $Prod);
        
        // ajoute un produit au panier
        echo "Produit ajouté au panier.";
    }
    public function removeProd($Prod)
    {

        foreach($this->tabPro as $key => $produit) {
            if($produit['id'] === $Prod['id']) {
                unset($this->tabPro[$key]);
                echo "Produit avec l'ID". $Prod['id'] ."supprimé du panier.";
            }
        }
        echo "Produit avec l'ID". $Prod['id'] ."non trouvé dans le panier.";
    }
}


// Create a new cart and add the test product
$panier = new Panier(null, '1', 'Test Product', '10.99', '1');
