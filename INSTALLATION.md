# Installation et Configuration - Eat&Drink

## Prérequis

- PHP 8.1 ou supérieur
- Composer
- MySQL (MAMP recommandé pour le développement)

## Étapes d'installation

### 1. Configuration de l'environnement

Créez un fichier `.env` à la racine du projet en copiant le contenu suivant :

```env
APP_NAME="Eat&Drink"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eatdrink_db
DB_USERNAME=root
DB_PASSWORD=root

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

### 2. Installation des dépendances

```bash
composer install
```

### 3. Génération de la clé d'application

```bash
php artisan key:generate
```

### 4. Création de la base de données MySQL

```bash
# Créer la base de données MySQL (via phpMyAdmin ou ligne de commande)
# Nom de la base de données : eatdrink_db
# Utilisateur : root (par défaut dans MAMP)
# Mot de passe : (vide par défaut dans MAMP)
```

### 5. Exécution des migrations

```bash
php artisan migrate
```

### 6. Seeding de la base de données

```bash
php artisan db:seed
```

### 7. Démarrage du serveur de développement

```bash
php artisan serve
```

## Comptes par défaut

### Administrateur
- **Email :** admin@eatdrink.com
- **Mot de passe :** admin123

## Fonctionnalités implémentées

### ✅ Authentification et Gestion des Rôles
- Inscription des entrepreneurs (demande de stand)
- Connexion avec vérification des rôles
- Middleware de protection des routes
- Gestion des statuts (en attente, approuvé, rejeté)

### ✅ Tableau de bord Administrateur
- Liste des demandes en attente
- Approbation/rejet des demandes avec motif
- Création automatique de stand lors de l'approbation
- Notification par email lors de l'approbation

### ✅ Interface utilisateur
- Formulaires d'inscription et de connexion
- Page de statut pour les entrepreneurs en attente
- Tableau de bord d'administration complet
- Messages d'erreur en français

### ✅ Sécurité
- Validation des données côté serveur
- Protection CSRF
- Hachage des mots de passe
- Middleware de vérification des rôles

## Structure des rôles

- **admin** : Accès complet à l'administration
- **entrepreneur_en_attente** : Demande en cours d'examen
- **entrepreneur_approuve** : Entrepreneur avec accès au tableau de bord

## Routes principales

- `/` - Page d'accueil
- `/register` - Inscription entrepreneur
- `/login` - Connexion
- `/status` - Statut de la demande (entrepreneurs en attente)
- `/admin/dashboard` - Tableau de bord administrateur
- `/entrepreneur/dashboard` - Tableau de bord entrepreneur

## Installation avec MAMP

Si vous utilisez MAMP, consultez le fichier `MAMP_SETUP.md` pour des instructions spécifiques.

## Prochaines étapes

1. Implémentation de la gestion des produits par les entrepreneurs
2. Création de la vitrine publique
3. Système de commandes
4. Amélioration de l'interface utilisateur
5. Tests unitaires et d'intégration 