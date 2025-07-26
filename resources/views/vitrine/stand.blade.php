@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('title', $stand->nom_stand . ' - Vitrine')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <!-- Navigation améliorée -->
            <div class="d-flex justify-content-between mb-5">
                <a href="{{ route('vitrine.index') }}" class="btn btn-outline-danger">
                    <i class="bi bi-arrow-left"></i> Retour à la vitrine
                </a>
                <a href="{{ route('commandes.panier') }}" class="btn btn-danger">
                    <i class="bi bi-cart"></i> Mon Panier
                </a>
            </div>

            <!-- Message de succès -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4">
                    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Informations du stand -->
            <div class="card border-0 shadow-sm mb-5">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#e74c3c" viewBox="0 0 24 24" class="me-3">
                            <path d="M12 2L1 8v8l11 6 11-6V8L12 2zm0 2.8L20 9v6l-8 4.4-8-4.4V9l8-4.2z"/>
                            <path d="M12 12l-5-2.5V15l5 2.5 5-2.5V9.5L12 12z"/>
                        </svg>
                        <div>
                            <h1 class="h2 mb-1">{{ $stand->nom_stand }}</h1>
                            <p class="text-muted mb-0">
                                <i class="bi bi-person"></i> {{ $stand->user->name }}
                            </p>
                        </div>
                    </div>
                    <p class="lead text-muted mb-0">{{ $stand->description }}</p>
                </div>
            </div>

            <!-- Produits du stand -->
            <div class="mb-4">
                <h2 class="fw-bold mb-4">Produits disponibles</h2>

                @if($stand->produits->count() > 0)
                    <div class="row g-4">
                        @foreach($stand->produits as $produit)
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                                    @if($produit->image_url)
                                        <div class="card-img-container" style="height: 200px;">
                                            @if(Str::startsWith($produit->image_url, ['http://', 'https://']))
                                                <img src="{{ $produit->image_url }}" class="card-img-top" alt="{{ $produit->nom }}" />
                                            @else
                                                <img src="{{ asset($produit->image_url) }}" class="card-img-top" alt="{{ $produit->nom }}" />
                                            @endif
                                        </div>
                                    @else
                                        <div class="card-img-container bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                            <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $produit->nom }}</h5>
                                        <p class="card-text text-muted">{{ Str::limit($produit->description, 100) }}</p>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="fs-4 fw-bold text-danger">{{ number_format($produit->prix, 2) }} €</span>
                                        </div>
                                        <form action="{{ route('commandes.ajouter-au-panier', $produit) }}" method="POST">
                                            @csrf
                                            <div class="row g-2">
                                                <div class="col-7">
                                                    <input type="number" name="quantite" class="form-control" value="1" min="1" max="99" />
                                                </div>
                                                <div class="col-5">
                                                    <button type="submit" class="btn btn-danger w-100">
                                                        <i class="bi bi-cart-plus"></i> Ajouter
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
                    <div class="empty-state text-center py-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#ddd" viewBox="0 0 24 24" class="mb-4">
                            <path d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 0 0 1.48-5.34c-.47-2.78-2.79-5-5.59-5.34a6.505 6.505 0 0 0-7.27 7.27c.34 2.8 2.56 5.12 5.34 5.59a6.5 6.5 0 0 0 5.34-1.48l.27.28v.79l4.25 4.25c.41.41 1.08.41 1.49 0 .41-.41.41-1.08 0-1.49L15.5 14zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                        </svg>
                        <h3 class="fw-light mb-3">Aucun produit disponible</h3>
                        <p class="text-muted mb-4">Ce stand n'a pas encore de produits à proposer</p>
                        <a href="{{ route('vitrine.index') }}" class="btn btn-danger">
                            <i class="bi bi-arrow-left"></i> Voir d'autres stands
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-img-container {
        overflow: hidden;
    }

    .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }

    .card:hover .card-img-top {
        transform: scale(1.05);
    }

    .empty-state {
        background: #f8f9fa;
        border-radius: 12px;
    }

    .hover-shadow {
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .transition-all {
        transition: all 0.3s ease;
    }
</style>
@endsection
