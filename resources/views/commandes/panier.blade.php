@extends('layouts.app')

@section('title', 'Mon Panier')

@section('content')
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

@if(session('historique_achats'))
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card border-info">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Historique de vos achats</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $historique = session('historique_achats');
                        @endphp
                        @foreach($historique as $index => $commande)
                            @php $totalHistorique = 0; @endphp
                            <div class="mb-4">
                                <h6 class="fw-bold">Commande n°{{ $index + 1 }}</h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Produit</th>
                                                <th>Quantité</th>
                                                <th>Prix unitaire</th>
                                                <th>Sous-total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($commande as $produitId => $quantite)
                                                @php
                                                    $produit = \App\Models\Produit::find($produitId);
                                                    $sousTotal = $produit ? $produit->prix * $quantite : 0;
                                                    $totalHistorique += $sousTotal;
                                                @endphp
                                                <tr>
                                                    <td>
                                                        @if($produit && $produit->image_url)
                                                            <img src="{{ $produit->image_url }}" alt="{{ $produit->nom }}" style="height:40px; width:40px; object-fit:cover; border-radius:4px; margin-right:8px;">
                                                        @endif
                                                        {{ $produit ? $produit->nom : 'Produit supprimé' }}
                                                    </td>
                                                    <td>{{ $quantite }}</td>
                                                    <td>{{ $produit ? number_format($produit->prix, 2) : '-' }} €</td>
                                                    <td>{{ $produit ? number_format($sousTotal, 2) : '-' }} €</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3" class="text-end"><strong>Total :</strong></td>
                                                <td><strong>{{ number_format($totalHistorique, 2) }} €</strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer text-end">
                        <form action="{{ route('commandes.vider-historique') }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-warning" onclick="return confirm('Vider complètement l\'historique des achats ?')">
                                Vider l'historique
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
