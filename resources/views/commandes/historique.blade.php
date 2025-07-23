@extends('layouts.app')

@section('title', 'Historique des Commandes')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1>Historique des Commandes</h1>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-3">
                <a href="{{ route('produits.index') }}" class="btn btn-primary">Retour aux produits</a>
            </div>

            @if($commandes->count() > 0)
                <div class="row">
                    @foreach($commandes as $commande)
                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Commande #{{ $commande->id }}</h5>
                                        <span class="badge bg-primary">{{ $commande->date_commande->format('d/m/Y H:i') }}</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p><strong>Stand:</strong> {{ $commande->stand->nom_stand }}</p>
                                    <p><strong>Total:</strong> {{ number_format($commande->total, 2) }} €</p>
                                    @if($commande->client_email)
                                        <p><strong>Client:</strong> {{ $commande->client_email }}</p>
                                    @endif
                                    <h6>Produits commandés:</h6>
                                    <div class="table-responsive">
                                        <table class="table table-sm">
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
                                                        <td>{{ $produit['nom'] }}</td>
                                                        <td>{{ number_format($produit['prix'], 2) }} €</td>
                                                        <td>{{ $produit['quantite'] }}</td>
                                                        <td>{{ number_format($produit['sous_total'], 2) }} €</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="{{ route('commandes.show', $commande) }}" class="btn btn-info btn-sm">Voir les détails</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info text-center">
                    <h4>Aucune commande reçue</h4>
                    <p>Les commandes de vos clients apparaîtront ici.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
