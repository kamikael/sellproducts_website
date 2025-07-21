#!/bin/bash

echo "🚀 Installation de Eat&Drink avec MAMP"
echo "====================================="

# Vérifier si PHP est installé
if ! command -v php &> /dev/null; then
    echo "❌ PHP n'est pas installé ou n'est pas dans le PATH."
    echo "   Assurez-vous que MAMP est installé et que PHP est accessible."
    exit 1
fi

# Vérifier si Composer est installé
if ! command -v composer &> /dev/null; then
    echo "❌ Composer n'est pas installé. Veuillez installer Composer."
    exit 1
fi

echo "✅ PHP et Composer sont installés"

# Vérifier la version de PHP
PHP_VERSION=$(php -r "echo PHP_VERSION;")
echo "📋 Version PHP détectée : $PHP_VERSION"

# Installer les dépendances
echo "📦 Installation des dépendances..."
composer install

# Créer le fichier .env s'il n'existe pas
if [ ! -f .env ]; then
    echo "⚙️  Création du fichier .env pour MAMP..."
    {
        echo "APP_NAME=\"Eat&Drink\""
        echo "APP_ENV=local"
        echo "APP_KEY="
        echo "APP_DEBUG=true"
        echo "APP_URL=http://localhost"
        echo ""
        echo "LOG_CHANNEL=stack"
        echo "LOG_DEPRECATIONS_CHANNEL=null"
        echo "LOG_LEVEL=debug"
        echo ""
        echo "DB_CONNECTION=mysql"
        echo "DB_HOST=127.0.0.1"
        echo "DB_PORT=3306"
        echo "DB_DATABASE=eatdrink_db"
        echo "DB_USERNAME=root"
        echo "DB_PASSWORD="
        echo ""
        echo "BROADCAST_DRIVER=log"
        echo "CACHE_DRIVER=file"
        echo "FILESYSTEM_DISK=local"
        echo "QUEUE_CONNECTION=sync"
        echo "SESSION_DRIVER=file"
        echo "SESSION_LIFETIME=120"
        echo ""
        echo "MAIL_MAILER=log"
        echo "MAIL_HOST=mailpit"
        echo "MAIL_PORT=1025"
        echo "MAIL_USERNAME=null"
        echo "MAIL_PASSWORD=null"
        echo "MAIL_ENCRYPTION=null"
        echo "MAIL_FROM_ADDRESS=\"hello@example.com\""
        echo "MAIL_FROM_NAME=\"\${APP_NAME}\""
    } > .env
fi

# Générer la clé d'application
echo "🔑 Génération de la clé d'application..."
php artisan key:generate

# Instructions pour la base de données
echo ""
echo "🗄️  Configuration de la base de données MySQL :"
echo "   1. Assurez-vous que MAMP est démarré"
echo "   2. Ouvrez phpMyAdmin : http://localhost/phpMyAdmin"
echo "   3. Créez une base de données nommée 'eatdrink_db'"
echo "   4. Utilisateur : root (par défaut)"
echo "   5. Mot de passe : (vide par défaut)"
echo ""

# Demander confirmation
read -p "Avez-vous créé la base de données 'eatdrink_db' ? (y/n) : " -n 1 -r
echo
if [[ ! $REPLY =~ ^[Yy]$ ]]; then
    echo "❌ Veuillez créer la base de données avant de continuer."
    echo "   Consultez le fichier MAMP_SETUP.md pour les instructions détaillées."
    exit 1
fi

# Exécuter les migrations
echo "🔄 Exécution des migrations..."
php artisan migrate

# Seeder la base de données
echo "🌱 Seeding de la base de données..."
php artisan db:seed

echo ""
echo "✅ Installation terminée avec succès !"
echo ""
echo "📋 Informations importantes :"
echo "   - URL d'accès : http://localhost:8888/$(basename $(pwd))/public"
echo "   - Compte admin : admin@eatdrink.com / admin123"
echo ""
echo "🚀 Pour démarrer le serveur de développement :"
echo "   php artisan serve"
echo ""
echo "📖 Consultez le fichier MAMP_SETUP.md pour plus d'informations."
echo ""
echo "🔧 Si vous avez des problèmes :"
echo "   - Vérifiez que MAMP est démarré"
echo "   - Vérifiez que MySQL fonctionne"
echo "   - Vérifiez les paramètres de connexion dans .env" 