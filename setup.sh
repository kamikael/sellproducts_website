#!/bin/bash

echo "🚀 Installation de Eat&Drink - Plateforme de Gestion de Stands"
echo "=========================================================="

# Vérifier si PHP est installé
if ! command -v php &> /dev/null; then
    echo "❌ PHP n'est pas installé. Veuillez installer PHP 8.1 ou supérieur."
    exit 1
fi

# Vérifier si Composer est installé
if ! command -v composer &> /dev/null; then
    echo "❌ Composer n'est pas installé. Veuillez installer Composer."
    exit 1
fi

echo "✅ PHP et Composer sont installés"

# Installer les dépendances
echo "📦 Installation des dépendances..."
composer install

# Créer le fichier .env s'il n'existe pas
if [ ! -f .env ]; then
    echo "⚙️  Création du fichier .env..."
    cp .env.example .env 2>/dev/null || {
        echo "APP_NAME=\"Eat&Drink\"" > .env
        echo "APP_ENV=local" >> .env
        echo "APP_KEY=" >> .env
        echo "APP_DEBUG=true" >> .env
        echo "APP_URL=http://127.0.0.1:8000" >> .env
        echo "" >> .env
        echo "LOG_CHANNEL=stack" >> .env
        echo "LOG_DEPRECATIONS_CHANNEL=null" >> .env
        echo "LOG_LEVEL=debug" >> .env
        echo "" >> .env
        echo "DB_CONNECTION=mysql" >> .env
        echo "DB_HOST=127.0.0.1" >> .env
        echo "DB_PORT=3306" >> .env
        echo "DB_DATABASE=eatdrink" >> .env
        echo "DB_USERNAME=root" >> .env
        echo "DB_PASSWORD=root" >> .env
        echo "" >> .env
        echo "BROADCAST_DRIVER=log" >> .env
        echo "CACHE_DRIVER=file" >> .env
        echo "FILESYSTEM_DISK=local" >> .env
        echo "QUEUE_CONNECTION=sync" >> .env
        echo "SESSION_DRIVER=file" >> .env
        echo "SESSION_LIFETIME=120" >> .env
        echo "" >> .env
        echo "MAIL_MAILER=log" >> .env
        echo "MAIL_HOST=mailpit" >> .env
        echo "MAIL_PORT=1025" >> .env
        echo "MAIL_USERNAME=null" >> .env
        echo "MAIL_PASSWORD=null" >> .env
        echo "MAIL_ENCRYPTION=null" >> .env
        echo "MAIL_FROM_ADDRESS=\"hello@example.com\"" >> .env
        echo "MAIL_FROM_NAME=\"\${APP_NAME}\"" >> .env
    }
fi

# Générer la clé d'application
echo "🔑 Génération de la clé d'application..."
php artisan key:generate

# Vérifier la connexion MySQL
echo "🗄️  Vérification de la connexion MySQL..."
echo "⚠️  Assurez-vous que MAMP est démarré et que MySQL fonctionne"
echo "⚠️  Créez une base de données nommée 'eatdrink_db' dans phpMyAdmin"

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
echo "   - URL d'accès : http://localhost:8000"
echo "   - Compte admin : admin@eatdrink.com / admin123"
echo ""
echo "🚀 Pour démarrer le serveur de développement :"
echo "   php artisan serve"
echo ""
echo "📖 Consultez le fichier INSTALLATION.md pour plus d'informations." 