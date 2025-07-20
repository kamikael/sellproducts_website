<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitrine - Stands et Produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4">🎪 Vitrine des Stands</h1>

                <!-- Barre de recherche -->
                <div class="row justify-content-center mb-4">
                    <div class="col-md-6">
                        <form action="{{ route('vitrine.recherche') }}" method="GET" class="d-flex">
                            <input type="text" name="q" class="form-control me-2" placeholder="Rechercher des stands ou produits..." value="{{ request('q') }}">
                            <button type="submit" class="btn btn-primary">Rechercher</button>
                        </form>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="text-center mb-4">
                    @auth
                        <a href="{{ route('produits.index') }}" class="btn btn-success me-2">Mes Produits</a>
                        <a href="{{ route('commandes.panier') }}" class="btn btn-info me-2">Mon Panier</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary me-2">Se connecter</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary">S'inscrire</a>
                    @endauth
                </div>

                @if($stands->count() > 0)
                    <div class="row">
                        @foreach($stands as $stand)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100">
                                    @if($stand->produits->first() && $stand->produits->first()->image_url)
                                        <img
                                            src="{{ Str::startsWith($stand->produits->first()->image_url, ['http://', 'https://'])
                                                ? $stand->produits->first()->image_url
                                                : asset($stand->produits->first()->image_url) }}"
                                            class="card-img-top mb-2"
                                            alt="Image du produit {{ $stand->produits->first()->nom }}"
                                            style="height: 180px; object-fit: cover;"
                                        >
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $stand->nom_stand }}</h5>
                                        <p class="card-text">{{ $stand->description }}</p>
                                        <p class="card-text"><small class="text-muted">Par: {{ $stand->user->name }}</small></p>

                                        @if($stand->produits->count() > 0)
                                            <h6>Produits disponibles ({{ $stand->produits->count() }})</h6>
                                            <div class="mb-3">
                                                @foreach($stand->produits->take(3) as $produit)
                                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                                        <span>{{ $produit->nom }}</span>
                                                        <span class="badge bg-primary">{{ number_format($produit->prix, 2) }} €</span>
                                                    </div>
                                                @endforeach
                                                @if($stand->produits->count() > 3)
                                                    <small class="text-muted">... et {{ $stand->produits->count() - 3 }} autres</small>
                                                @endif
                                            </div>
                                        @else
                                            <p class="text-muted">Aucun produit disponible pour le moment</p>
                                        @endif

                                        <a href="{{ route('vitrine.stand', $stand) }}" class="btn btn-primary">Voir le stand</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info text-center">
                        <h4>Aucun stand disponible</h4>
                        <p>Les stands approuvés apparaîtront ici.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
