@extends('layouts.app')

@section('title', 'Mon Panier')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="fw-bold mb-0">
                    <i class="bi bi-cart3 text-danger me-2"></i>Mon Panier
                </h1>
                <a href="{{ route('vitrine.index') }}" class="btn btn-outline-danger">
                    <i class="bi bi-arrow-left"></i> Continuer les achats
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4">
                    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4">
                    <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(count($produits) > 0)
                <div class="card border-0 shadow-sm mb-5">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0">Produit</th>
                                        <th class="border-0">Stand</th>
                                        <th class="border-0 text-end">Prix unitaire</th>
                                        <th class="border-0 text-center">Quantité</th>
                                        <th class="border-0 text-end">Sous-total</th>
                                        <th class="border-0 text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($produits as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($item['produit']->image_url)
                                                        <div class="img-container me-3" style="width: 60px; height: 60px;">
                                                            <img src="{{ $item['produit']->image_url }}"
                                                                 alt="{{ $item['produit']->nom }}"
                                                                 class="img-fluid rounded"
                                                                 style="width: 100%; height: 100%; object-fit: cover;">
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <strong>{{ $item['produit']->nom }}</strong>
                                                        @if($item['produit']->description)
                                                            <br><small class="text-muted">{{ Str::limit($item['produit']->description, 50) }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <span class="badge bg-light text-dark">
                                                    <i class="bi bi-shop me-1"></i> {{ $item['produit']->stand->nom_stand }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-end">{{ number_format($item['produit']->prix, 2) }} €</td>
                                            <td class="align-middle text-center">{{ $item['quantite'] }}</td>
                                            <td class="align-middle text-end fw-bold text-danger">{{ number_format($item['sous_total'], 2) }} €</td>
                                            <td class="align-middle text-end">
                                                <form action="{{ route('commandes.supprimer-du-panier', $item['produit']) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('Supprimer ce produit du panier ?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="4" class="text-end"><strong>Total :</strong></td>
                                        <td class="text-end fw-bold text-danger">{{ number_format($total, 2) }} €</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <form action="{{ route('commandes.vider-panier') }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-warning"
                                        onclick="return confirm('Vider complètement le panier ?')">
                                    <i class="bi bi-x-circle me-1"></i> Vider le panier
                                </button>
                            </form>

                            <form action="{{ route('commandes.soumettre') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-lg px-4">
                                    <i class="bi bi-check-circle me-1"></i> Confirmer la commande
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="empty-state text-center py-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#ddd" viewBox="0 0 24 24" class="mb-4">
                        <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>
                    </svg>
                    <h3 class="fw-light mb-3">Votre panier est vide</h3>
                    <p class="text-muted mb-4">Découvrez nos stands et produits disponibles !</p>
                    <a href="{{ route('vitrine.index') }}" class="btn btn-danger">
                        <i class="bi bi-arrow-left me-1"></i> Voir la vitrine
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

@if(session('historique_achats'))
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card border-danger mb-5">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Historique de vos achats</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $historique = session('historique_achats');
                        @endphp
                        @foreach($historique as $index => $commande)
                            @php $totalHistorique = 0; @endphp
                            <div class="mb-4 pb-3 border-bottom">
                                <h6 class="fw-bold text-danger">Commande n°{{ $index + 1 }}</h6>
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Produit</th>
                                                <th class="text-center">Quantité</th>
                                                <th class="text-end">Prix unitaire</th>
                                                <th class="text-end">Sous-total</th>
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
                                                        <div class="d-flex align-items-center">
                                                            @if($produit && $produit->image_url)
                                                                <div class="img-container me-3" style="width: 50px; height: 50px;">
                                                                    <img src="{{ $produit->image_url }}"
                                                                         alt="{{ $produit->nom }}"
                                                                         class="img-fluid rounded"
                                                                         style="width: 100%; height: 100%; object-fit: cover;">
                                                                </div>
                                                            @endif
                                                            <div>
                                                                {{ $produit ? $produit->nom : 'Produit supprimé' }}
                                                                @if($produit && $produit->stand)
                                                                    <br><small class="text-muted">{{ $produit->stand->nom_stand }}</small>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-center">{{ $quantite }}</td>
                                                    <td class="align-middle text-end">{{ $produit ? number_format($produit->prix, 2) : '-' }} €</td>
                                                    <td class="align-middle text-end fw-bold">{{ $produit ? number_format($sousTotal, 2) : '-' }} €</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="table-light">
                                            <tr>
                                                <td colspan="3" class="text-end"><strong>Total :</strong></td>
                                                <td class="text-end fw-bold text-danger">{{ number_format($totalHistorique, 2) }} €</td>
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
                            <button type="submit" class="btn btn-outline-warning"
                                    onclick="return confirm('Vider complètement l\'historique des achats ?')">
                                <i class="bi bi-trash me-1"></i> Vider l'historique
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<style>
    .empty-state {
        background: #f8f9fa;
        border-radius: 12px;
    }

    .img-container {
        overflow: hidden;
        border-radius: 8px;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(231, 76, 60, 0.05);
    }

    .card {
        border-radius: 12px;
        overflow: hidden;
    }
</style>
@endsection
