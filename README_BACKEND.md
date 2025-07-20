# Backend Produits & Commandes - Laravel

Ce projet implémente les fonctionnalités de la **Personne 2** pour la gestion des produits, stands et commandes dans un système de vente d'événements.

## 🚀 Fonctionnalités Implémentées

### 1. **CRUD Produits**
- ✅ Ajouter / modifier / supprimer / lister les produits
- ✅ Lier les produits à un stand
- ✅ Interface intuitive avec Bootstrap
- ✅ Validation des données
- ✅ Gestion des images (URL)

### 2. **CRUD Stands**
- ✅ Créer / modifier / supprimer / lister les stands
- ✅ Association automatique à l'utilisateur connecté
- ✅ Affichage du nombre de produits par stand

### 3. **Système de Commandes**
- ✅ Panier temporaire (session)
- ✅ Ajouter/supprimer des produits du panier
- ✅ Soumission de commande
- ✅ Groupement par stand
- ✅ Historique des commandes pour l'entrepreneur

### 4. **Vitrine Publique**
- ✅ Affichage des stands approuvés
- ✅ Détails des stands avec produits
- ✅ Fonctionnalité de recherche
- ✅ Ajout au panier (pour utilisateurs connectés)

### 5. **Sécurité & Autorisations**
- ✅ Policies pour tous les modèles
- ✅ Middleware d'authentification
- ✅ Contrôle d'accès par rôle
- ✅ Validation des données

### 6. **Bonus - Interface Admin**
- ✅ Vue d'ensemble de toutes les commandes
- ✅ Statistiques des ventes
- ✅ Accès aux détails des commandes

## 📁 Structure du Code

### Contrôleurs
- `ProduitsController.php` - Gestion CRUD des produits
- `StandsController.php` - Gestion CRUD des stands
- `CommandesController.php` - Gestion du panier et commandes
- `VitrineController.php` - Vitrine publique et recherche

### Modèles
- `Produit.php` - Modèle produit avec relations
- `Stand.php` - Modèle stand avec relations
- `Commande.php` - Modèle commande avec accesseurs JSON

### Policies
- `ProduitPolicy.php` - Autorisations pour les produits
- `StandPolicy.php` - Autorisations pour les stands
- `CommandePolicy.php` - Autorisations pour les commandes

### Vues
- `resources/views/produits/` - Interface de gestion des produits
- `resources/views/stands/` - Interface de gestion des stands
- `resources/views/commandes/` - Interface du panier et commandes
- `resources/views/vitrine/` - Vitrine publique

## 👥 Comptes de Test

Après avoir lancé les seeders, vous aurez accès à ces comptes :

### Admin
- Email: `admin@example.com`
- Mot de passe: `password`
- Rôle: `admin`

### Entrepreneurs Approuvés
- Email: `jean@example.com`
- Mot de passe: `password`
- Rôle: `entrepreneur_approuve`

- Email: `marie@example.com`
- Mot de passe: `password`
- Rôle: `entrepreneur_approuve`

## 🎯 Routes Principales

### Routes Publiques
- `GET /vitrine` - Vitrine publique
- `GET /vitrine/stand/{stand}` - Détails d'un stand
- `GET /vitrine/recherche` - Recherche de stands/produits

### Routes Authentifiées (Entrepreneurs)
- `GET /produits` - Liste des produits
- `GET /produits/create` - Créer un produit
- `GET /stands` - Liste des stands
- `GET /stands/create` - Créer un stand
- `GET /commandes/historique` - Historique des commandes

### Routes Authentifiées (Clients)
- `GET /panier` - Panier temporaire
- `POST /panier/ajouter/{produit}` - Ajouter au panier
- `POST /commande/soumettre` - Soumettre une commande

### Routes Admin (Bonus)
- `GET /admin/commandes` - Vue d'ensemble des commandes

## 🔐 Système d'Autorisations

### Rôles
- `admin` - Accès complet à toutes les fonctionnalités
- `entrepreneur_approuve` - Peut gérer ses stands et produits
- `entrepreneur_en_attente` - En attente d'approbation (non implémenté ici)

### Policies
- **ProduitPolicy**: Seuls les entrepreneurs approuvés peuvent créer/modifier leurs produits
- **StandPolicy**: Seuls les entrepreneurs approuvés peuvent gérer leurs stands
- **CommandePolicy**: Tout utilisateur connecté peut créer des commandes, seuls les entrepreneurs peuvent voir leurs commandes

## 🛒 Fonctionnement du Panier

1. **Ajout au panier**: Stockage temporaire en session
2. **Gestion des quantités**: Cumul automatique des produits identiques
3. **Groupement par stand**: Les commandes sont automatiquement séparées par stand
4. **Soumission**: Création d'une commande par stand avec tous les détails

## 📊 Structure des Données

### Commande JSON
```json
{
  "produits": [
    {
      "produit_id": 1,
      "nom": "Confiture de fraises",
      "prix": 5.50,
      "quantite": 2,
      "sous_total": 11.00
    }
  ],
  "total": 11.00,
  "client_id": 1,
  "client_email": "client@example.com"
}
```

## 🎨 Interface Utilisateur

- **Bootstrap 5** pour un design moderne et responsive
- **Messages de succès/erreur** pour le feedback utilisateur
- **Navigation intuitive** entre les différentes sections
- **Formulaires validés** avec messages d'erreur clairs
- **Design responsive** pour mobile et desktop

## 🔧 Personnalisation

### Ajouter de nouveaux champs
1. Modifier la migration correspondante
2. Ajouter le champ dans le modèle (`$fillable`)
3. Mettre à jour les contrôleurs et vues

### Modifier les autorisations
1. Éditer les policies correspondantes
2. Ajouter de nouveaux gates si nécessaire

### Ajouter de nouvelles fonctionnalités
1. Créer le contrôleur
2. Définir les routes
3. Créer les vues
4. Ajouter les policies si nécessaire

## 🚀 Déploiement

1. Configurer l'environnement de production
2. Optimiser les performances (cache, etc.)
3. Configurer la sécurité (HTTPS, etc.)
4. Mettre en place les sauvegardes

---

**Note**: Ce backend est conçu pour fonctionner avec le système d'authentification et de gestion des rôles de la Personne 1. Assurez-vous que les modèles User et les migrations correspondantes sont en place. 