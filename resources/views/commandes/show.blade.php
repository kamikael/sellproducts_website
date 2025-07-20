<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la commande #{{ $commande->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <a href="{{ route('commandes.historique') }}" class="btn btn-secondary">← Retour à l'historique</a>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Commande #{{ $commande->id }}</h3>
                            <span class="badge bg-primary">{{ $commande->date_commande->format('d/m/Y à H:i') }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Informations du stand</h5>
                                <p><strong>Nom:</strong> {{ $commande->stand->nom_stand }}</p>
                                <p><strong>Description:</strong> {{ $commande->stand->description }}</p>
                                <p><strong>Entrepreneur:</strong> {{ $commande->stand->user->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Informations de la commande</h5>
                                <p><strong>Total:</strong> <span class="text-primary fs-4">{{ number_format($commande->total, 2) }} €</span></p>
                                @if($commande->client_email)
                                    <p><strong>Client:</strong> {{ $commande->client_email }}</p>
                                @endif
                                <p><strong>Date:</strong> {{ $commande->date_commande->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>

                        <hr>

                        <h5>Produits commandés</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Prix unitaire</th>
                                        <th>Quantité</th>
                                        <th>Sous-total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($commande->produits as $produit)
                                        <tr>
                                            <td>
                                                <strong>{{ $produit['nom'] }}</strong>
                                                @if(isset($produit['description']))
                                                    <br><small class="text-muted">{{ $produit['description'] }}</small>
                                                @endif
                                            </td>
                                            <td>{{ number_format($produit['prix'], 2) }} €</td>
                                            <td>{{ $produit['quantite'] }}</td>
                                            <td><strong>{{ number_format($produit['sous_total'], 2) }} €</strong></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Total :</strong></td>
                                        <td><strong class="text-primary fs-5">{{ number_format($commande->total, 2) }} €</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('commandes.historique') }}" class="btn btn-primary">Retour à l'historique</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 