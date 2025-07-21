@extends('layouts.app')

@section('title', 'Détails de la commande #' . $commande->id)

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <a href="{{ route('commandes.historique') }}" class="btn btn-secondary">&larr; Retour à l'historique</a>
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
                                    <th>Image</th>
                                    <th>Produit</th>
                                    <th>Prix unitaire</th>
                                    <th>Quantité</th>
                                    <th>Sous-total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($commande->produits as $produit)
                                    @php
                                        $produitModel = \App\Models\Produit::find($produit['id'] ?? null);
                                    @endphp
                                    <tr>
                                        <td>
                                            @if($produitModel && $produitModel->image_url)
                                                <img src="{{ Str::startsWith($produitModel->image_url, ['http://', 'https://']) ? $produitModel->image_url : asset($produitModel->image_url) }}" alt="{{ $produit['nom'] }}" style="height:60px; width:60px; object-fit:cover; border-radius:6px;">
                                            @endif
                                        </td>
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
@endsection
