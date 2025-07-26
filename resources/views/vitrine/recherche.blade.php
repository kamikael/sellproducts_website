@extends('layouts.app')

@section('title', 'Résultats de recherche - ' . $query)

@section('content')
<style>
    /* Styles pour la page de recherche */
    .search-form .form-control {
        border-radius: 50px 0 0 50px !important;
        padding: 12px 20px;
        border-right: none;
    }

    .search-form .btn {
        border-radius: 0 50px 50px 0 !important;
        padding: 12px 25px;
    }

    .card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-img-container {
        height: 200px;
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
    }

    .card:hover .card-img-top {
        transform: scale(1.05);
    }

    .product-preview {
        background: #f9f9f9;
        border-radius: 8px;
        padding: 10px;
    }

    .empty-state {
        background: #f8f9fa;
        border-radius: 12px;
    }
</style>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="text-center mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#e74c3c" viewBox="0 0 24 24" class="mb-3">
                    <path d="M12 2L1 8v8l11 6 11-6V8L12 2zm0 2.8L20 9v6l-8 4.4-8-4.4V9l8-4.2z"/>
                    <path d="M12 12l-5-2.5V15l5 2.5 5-2.5V9.5L12 12z"/>
                </svg>
                <h1 class="display-4 fw-bold mb-3">Résultats de recherche</h1>
                <p class="lead text-muted">Stands et produits pour : **"{{ $query }}"**</p>
                <p class="text-muted">{{ $stands->count() }} résultat(s) trouvé(s)</p>
            </div>

            <div class="row justify-content-center mb-5">
                <div class="col-md-8">
                    <form action="{{ route('vitrine.recherche') }}" method="GET" class="search-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control form-control-lg border-end-0"
                                placeholder="Rechercher des stands ou produits..." value="{{ $query }}">
                            <button type="submit" class="btn btn-danger px-4">
                                <i class="bi bi-search"></i> Rechercher
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @if($stands->count() > 0)
                <div class="row g-4">
                    @foreach($stands as $stand)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                                @if($stand->produits->first() && $stand->produits->first()->image_url)
                                    <div class="card-img-container">
                                        <img
                                            src="{{ Str::startsWith($stand->produits->first()->image_url, ['http://', 'https://'])
                                                ? $stand->produits->first()->image_url
                                                : asset($stand->produits->first()->image_url) }}"
                                            class="card-img-top"
                                            alt="Image du produit {{ $stand->produits->first()->nom }}"
                                        >
                                    </div>
                                @endif
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title mb-0">{{ $stand->nom_stand }}</h5>
                                        <span class="badge bg-danger">{{ $stand->produits->count() }} produits</span>
                                    </div>
                                    <p class="card-text text-muted mb-3">{{ Str::limit($stand->description, 100) }}</p>
                                    <p class="text-muted small mb-3">
                                        <i class="bi bi-person"></i> {{ $stand->user->name }}
                                    </p>

                                    @if($stand->produits->count() > 0)
                                        <div class="product-preview mb-4">
                                            @foreach($stand->produits->take(3) as $produit)
                                                <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                                    <span>{{ $produit->nom }}</span>
                                                    <span class="fw-bold text-danger">{{ number_format($produit->prix, 2) }} €</span>
                                                </div>
                                            @endforeach
                                            @if($stand->produits->count() > 3)
                                                <div class="text-center mt-2">
                                                    <small class="text-muted">
                                                        + {{ $stand->produits->count() - 3 }} autres produits
                                                    </small>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="alert alert-light mb-4">
                                            <small class="text-muted">Aucun produit disponible pour le moment</small>
                                        </div>
                                    @endif

                                    <a href="{{ route('vitrine.stand', $stand) }}" class="btn btn-outline-danger w-100">
                                        <i class="bi bi-shop"></i> Visiter le stand
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state text-center py-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#ddd" viewBox="0 0 24 24" class="mb-4">
                        <path d="M12 2L1 8v8l11 6 11-6V8L12 2zm0 2.8L20 9v6l-8 4.4-8-4.4V9l8-4.2z"/>
                        <path d="M12 12l-5-2.5V15l5 2.5 5-2.5V9.5L12 12z"/>
                    </svg>
                    <h4 class="fw-light mb-3">Aucun résultat trouvé</h4>
                    <p class="text-muted">Aucun stand ou produit ne correspond à votre recherche "{{ $query }}".</p>
                    <a href="{{ route('vitrine.index') }}" class="btn btn-primary">Retourner à la vitrine</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
