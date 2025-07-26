<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Eat&Drink')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #f47668;
            --secondary-color: #f39c12;
            --dark-color: #2c3e50;
            --light-color: #ecf0f1;
        }

        body {
            font-family: 'Montserrat', 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
            color: var(--dark-color);
        }

        .navbar {
            background-color: white !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1.5rem 0;
            position: relative;
            z-index: 100;
        }

        /* Hero section for Guests */
        .hero-section {
            position: relative;
            height: 70vh;
            min-height: 600px;
            overflow: hidden;
            display: flex;
            align-items: center;
        }

        .hero-overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.3);
            z-index: 2;
        }

        .hero-images {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
        }

        .hero-image {
            height: 100%;
            flex: 1;
            background-size: cover;
            background-position: center;
            transition: all 0.8s ease;
            position: relative;
            overflow: hidden;
        }

        .hero-image::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.7) 100%);
        }

        .hero-image-left {
            background-image: url('https://i.pinimg.com/1200x/27/a1/96/27a196cfd98812e1eeefddb7e3322a37.jpg');
            clip-path: polygon(0 0, 80% 0, 60% 100%, 0% 100%);
        }

        .hero-image-right {
            background-image: url('https://i.pinimg.com/736x/ab/af/47/abaf47625be9817c6561820b613b47c4.jpg');
            clip-path: polygon(20% 0, 100% 0, 100% 100%, 40% 100%);
            margin-left: -20%;
        }

        .hero-content {
            position: relative;
            z-index: 3;
            color: white;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            text-align: center;
        }

        /* Hero section for Authenticated Users */
        .auth-hero-section {
            background-color: rgb(76, 76, 77);
            padding: 5rem 0;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        .auth-hero-section h1 {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .auth-hero-section .lead {
            color: white;
            font-size: 1.25rem;
            max-width: 700px;
            margin: 0 auto;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;

        }

        .hero-subtitle {
            font-size: 1.5rem;
            font-weight: 300;
            margin-bottom: 2rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-hero {
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--primary-color) !important;
            letter-spacing: 1px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 10px 25px;
        }

        .btn-outline-light {
            border-color: white;
            color: white;
        }

        .btn-outline-light:hover {
            background-color: white;
            color: var(--dark-color);
        }

        .container {
            max-width: 1200px;
        }


        footer {
            background-color: var(--dark-color);
            color: white;
            padding: 4rem 0;
        }

        .footer-title {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }

        .footer-title::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 3px;
            background: var(--primary-color);
            bottom: -10px;
            left: 0;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/">Eat&Drink</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-3">
                    <li class="nav-item">
                        <a class="btn {{ request()->is('/') ? 'btn-primary' : 'btn-outline-dark' }}" href="/">Accueil</a>
                    </li>

                    @guest
                        <li class="nav-item">
                            <a class="btn {{ request()->routeIs('register') ? 'btn-primary' : 'btn-outline-dark' }}" href="{{ route('register') }}">
                                <i class="bi bi-shop"></i> Demande de stand
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn {{ request()->routeIs('login') ? 'btn-primary' : 'btn-outline-dark' }}" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> Accès stand
                            </a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-dark">
                                    <i class="bi bi-box-arrow-right"></i> Déconnexion
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    @if (in_array(Route::currentRouteName(), ['vitrine.index', 'stands.index', 'admin.index']))
    {{-- Hero section for Guests --}}
       @guest
        <section class="hero-section">
            <div class="hero-images">
                <div class="hero-image hero-image-left"></div>
                <div class="hero-image hero-image-right"></div>
            </div>
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h1 class="hero-title">Découvrez nos délices</h1>
                <p class="hero-subtitle">Des produits frais et artisanaux sélectionnés avec passion pour satisfaire les palais les plus exigeants</p>
                <a href="#products" class="btn btn-hero btn-outline-light">Découvrir</a>
            </div>
        </section>
    @endguest

        @auth
        <section class="auth-hero-section">
            <div class="container">
                @if(auth()->user()->role == 'admin')
                    <h1 class="display-4 fw-bold">Bienvenue, Administrateur !</h1>
                    <p class="lead">Gérez les stands, les utilisateurs et l'ensemble de la plateforme Eat&Drink.</p>
                    <a href="{{ route('admin.index') }}" class="btn btn-primary mt-3">Accéder au tableau de bord</a>
                @elseif(auth()->user()->role == 'entrepreneur_en_attente')
                    <h1 class="display-4 fw-bold">Bienvenue, Entrepreneur !</h1>
                    <p class="lead">Votre demande de stand est en cours de traitement.</p>
                @else
                    <h1 class="display-4 fw-bold">Bienvenue, {{ auth()->user()->name }} !</h1>
                    <p class="lead">Gérez votre stand, vos produits et suivez vos commandes.</p>
                    <a href="{{ route('stands.index') }}" class="btn btn-primary mt-3">Accéder à mon espace</a>
                @endif
            </div>
        </section>
    @endif
@endauth

    <main class="container my-5" id="products">
        @yield('content')
    </main>

    <footer class="text-center text-lg-start">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0 text-lg-start">
                    <h3 class="footer-title">Eat&Drink</h3>
                    <p>L'excellence artisanale au service de votre plaisir culinaire.</p>
                </div>
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h3 class="footer-title">Horaires</h3>
                    <p>Vendredi à Samedi: 9h - 20h<br>Dimanche: 9h - 18h</p>
                </div>
                <div class="col-lg-4 text-lg-start">
                    <h3 class="footer-title">Contact</h3>
                    <p><i class="bi bi-envelope me-2"></i> contact@eatdrink.com<br>
                    <i class="bi bi-phone me-2"></i> +229 01 46 86 25 36</p>
                </div>
            </div>
            <hr class="my-5 bg-light">
            <div class="text-center">
                <p class="mb-0">&copy; 2023 Eat&Drink. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
