<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de recherche - "{{ $query }}"</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <a href="{{ route('vitrine.index') }}" class="btn btn-secondary">← Retour à la vitrine</a>
                </div>

                <h1>Résultats de recherche</h1>
                <p class="lead">Recherche pour : <strong>"{{ $query }}"</strong></p>

                @if($stands->count() > 0)
                    <p class="text-muted">{{ $stands->count() }} résultat(s) trouvé(s)</p>
                    
                    <div class="row">
                        @foreach($stands as $stand)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100">
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
                        <h4>Aucun résultat trouvé</h4>
                        <p>Aucun stand ou produit ne correspond à votre recherche "{{ $query }}".</p>
                        <a href="{{ route('vitrine.index') }}" class="btn btn-primary">Voir tous les stands</a>
                    </div>
                @endif

                <!-- Nouvelle recherche -->
                <div class="mt-4">
                    <h5>Nouvelle recherche</h5>
                    <form action="{{ route('vitrine.recherche') }}" method="GET" class="d-flex">
                        <input type="text" name="q" class="form-control me-2" placeholder="Rechercher des stands ou produits..." value="{{ $query }}">
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 