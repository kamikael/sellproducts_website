# Installation avec MAMP - Eat&Drink

## Prérequis

- MAMP installé et configuré
- PHP 8.1 ou supérieur (inclus dans MAMP)
- Composer installé

## Étapes d'installation avec MAMP

### 1. Démarrer MAMP

1. Lancez MAMP
2. Cliquez sur "Start Servers"
3. Vérifiez que Apache et MySQL sont démarrés (voyants verts)

### 2. Créer la base de données

1. Ouvrez phpMyAdmin : http://localhost/phpMyAdmin
2. Connectez-vous avec :
   - Utilisateur : `root`
   - Mot de passe : (laissez vide)
3. Cliquez sur "Nouvelle base de données"
4. Nom de la base : `eatdrink_db`
5. Interclassement : `utf8mb4_unicode_ci`
6. Cliquez sur "Créer"

### 3. Configuration du projet

1. Placez votre projet dans le dossier `htdocs` de MAMP
2. Ouvrez un terminal dans le dossier du projet
3. Exécutez les commandes suivantes :

```bash
# Installer les dépendances
composer install

# Créer le fichier .env
cp .env.example .env

# Éditer le fichier .env pour MySQL
```

### 4. Configuration du fichier .env

Modifiez le fichier `.env` avec ces paramètres MySQL :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eatdrink_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Finaliser l'installation

```bash
# Générer la clé d'application
php artisan key:generate

# Exécuter les migrations
php artisan migrate

# Seeder la base de données
php artisan db:seed
```

### 6. Accéder à l'application

1. Ouvrez votre navigateur
2. Allez à : `http://localhost:8888/votre-projet/public`
   (Remplacez `votre-projet` par le nom de votre dossier)

### 7. Comptes par défaut

- **Administrateur** :
  - Email : `admin@eatdrink.com`
  - Mot de passe : `admin123`

## Configuration alternative (sans port)

Si vous voulez accéder sans le port 8888 :

1. Dans MAMP, allez dans "Préférences"
2. Onglet "Ports"
3. Cliquez sur "Set Web & MySQL ports to 80 & 3306"
4. Redémarrez MAMP
5. Accédez à : `http://localhost/votre-projet/public`

## Dépannage

### Erreur de connexion MySQL
- Vérifiez que MAMP est démarré
- Vérifiez que MySQL fonctionne
- Vérifiez les paramètres de connexion dans `.env`

### Erreur de permissions
- Vérifiez que le dossier `storage` est accessible en écriture
- Vérifiez que le dossier `bootstrap/cache` est accessible en écriture

### Erreur de clé d'application
- Exécutez : `php artisan key:generate`

### Erreur de migrations
- Vérifiez que la base de données `eatdrink_db` existe
- Vérifiez les paramètres de connexion MySQL 