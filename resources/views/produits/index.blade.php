<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1>Mes Produits</h1>
                
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-3">
                    <a href="{{ route('produits.create') }}" class="btn btn-primary">Ajouter un produit</a>
                    <a href="{{ route('stands.index') }}" class="btn btn-secondary">Gérer mes stands</a>
                    <a href="{{ route('commandes.historique') }}" class="btn btn-info">Voir mes commandes</a>
                </div>

                @if($products->count() > 0)
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    @if($product->image_url)
                                        <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->nom }}">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->nom }}</h5>
                                        <p class="card-text">{{ $product->description }}</p>
                                        <p class="card-text"><strong>Prix: {{ number_format($product->prix, 2) }} €</strong></p>
                                        <p class="card-text"><small>Stand: {{ $product->stand->nom_stand }}</small></p>
                                        
                                        <div class="btn-group">
                                            <a href="{{ route('produits.edit', $product) }}" class="btn btn-warning btn-sm">Modifier</a>
                                            <form action="{{ route('produits.destroy', $product) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info">
                        Vous n'avez pas encore de produits. <a href="{{ route('produits.create') }}">Ajoutez votre premier produit</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 