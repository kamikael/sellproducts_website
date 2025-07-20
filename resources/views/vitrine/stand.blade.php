@php use Illuminate\Support\Str; @endphp
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $stand->nom_stand }} - Vitrine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <!-- Navigation -->
                <div class="mb-4">
                    <a href="{{ route('vitrine.index') }}" class="btn btn-secondary">← Retour à la vitrine</a>
                    <a href="{{ route('commandes.panier') }}" class="btn btn-info float-end">Mon Panier</a>
                </div>

                <!-- Informations du stand -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h1>{{ $stand->nom_stand }}</h1>
                        <p class="lead">{{ $stand->description }}</p>
                        <p class="text-muted">Entrepreneur: {{ $stand->user->name }}</p>
                    </div>
                </div>

                <!-- Produits du stand -->
                @if($stand->produits->count() > 0)
                    <h2>Produits disponibles</h2>
                    <div class="row">
                        @foreach($stand->produits as $produit)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100">
                                    @if($produit->image_url)
                                        @if(Str::startsWith($produit->image_url, ['http://', 'https://']))
                                            <img src="{{ $produit->image_url }}" class="card-img-top mb-2" alt="{{ $produit->nom }}" style="height: 200px; object-fit: cover;" />
                                        @else
                                            <img src="{{ asset($produit->image_url) }}" class="card-img-top mb-2" alt="{{ $produit->nom }}" style="height: 200px; object-fit: cover;" />
                                        @endif
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $produit->nom }}</h5>
                                        <p class="card-text">{{ $produit->description }}</p>
                                        <p class="card-text">
                                            <strong class="text-primary fs-4">{{ number_format($produit->prix, 2) }} €</strong>
                                        </p>
                                        <form action="{{ route('commandes.ajouter-au-panier', $produit) }}" method="POST">
                                            @csrf
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <input type="number" name="quantite" class="form-control" value="1" min="1" max="99" />
                                                </div>
                                                <div class="col-6">
                                                    <button type="submit" class="btn btn-success w-100">
                                                        Ajouter au panier
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info text-center">
                        <h4>Aucun produit disponible</h4>
                        <p>Ce stand n'a pas encore de produits disponibles.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
