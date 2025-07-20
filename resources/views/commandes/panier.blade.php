<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1>Mon Panier</h1>
                
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="mb-3">
                    <a href="{{ route('vitrine.index') }}" class="btn btn-primary">Continuer les achats</a>
                </div>

                @if(count($produits) > 0)
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Produit</th>
                                            <th>Stand</th>
                                            <th>Prix unitaire</th>
                                            <th>Quantité</th>
                                            <th>Sous-total</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($produits as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if($item['produit']->image_url)
                                                            <img src="{{ $item['produit']->image_url }}" alt="{{ $item['produit']->nom }}" style="width: 50px; height: 50px; object-fit: cover;" class="me-3">
                                                        @endif
                                                        <div>
                                                            <strong>{{ $item['produit']->nom }}</strong>
                                                            @if($item['produit']->description)
                                                                <br><small class="text-muted">{{ $item['produit']->description }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $item['produit']->stand->nom_stand }}</td>
                                                <td>{{ number_format($item['produit']->prix, 2) }} €</td>
                                                <td>{{ $item['quantite'] }}</td>
                                                <td><strong>{{ number_format($item['sous_total'], 2) }} €</strong></td>
                                                <td>
                                                    <form action="{{ route('commandes.supprimer-du-panier', $item['produit']) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce produit du panier ?')">
                                                            Supprimer
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-end"><strong>Total :</strong></td>
                                            <td><strong>{{ number_format($total, 2) }} €</strong></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="d-flex justify-content-between mt-3">
                                <form action="{{ route('commandes.vider-panier') }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-warning" onclick="return confirm('Vider complètement le panier ?')">
                                        Vider le panier
                                    </button>
                                </form>
                                
                                <form action="{{ route('commandes.soumettre') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-lg">
                                        Confirmer la commande
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info text-center">
                        <h4>Votre panier est vide</h4>
                        <p>Découvrez nos stands et produits disponibles !</p>
                        <a href="{{ route('vitrine.index') }}" class="btn btn-primary">Voir la vitrine</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 