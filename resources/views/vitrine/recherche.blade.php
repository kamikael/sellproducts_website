@extends('layouts.app')

@section('title', 'Résultats de recherche - ' . $query)

@section('content')

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

            <div class="vitrine-bg-blobs"></div>
            <div class="row justify-content-center mb-5">
                <div class="col-md-8">
                    <form action="{{ route('vitrine.recherche') }}" method="GET" class="search-form-minimal">
                        <div class="search-input-group">
                            <input type="text" name="q" class="search-input"
                                placeholder="Rechercher des stands ou produits..." value="{{ $query }}">
                            <button type="submit" class="search-btn-glass">
                                <i class="bi bi-search"></i>
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
                                        <span class="badge btn-glass-dark fw-normal">{{ $stand->produits->count() }} produits</span>
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
                                                    <span class="fw-bold">{{ number_format($produit->prix, 2) }} €</span>
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

                                    <a href="{{ route('vitrine.stand', $stand) }}" class="btn btn-glass-dark w-100">
                                        <i class="bi bi-shop"></i> Visiter le stand
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state text-center py-5" style="background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 30px;">
                    <i class="bi bi-search-heart display-1 mb-4" style="color: rgba(0,0,0,0.1)"></i>
                    <h4 class="fw-light mb-3">Aucun résultat trouvé</h4>
                    <p class="text-muted">Aucun stand ou produit ne correspond à votre recherche "{{ $query }}".</p>
                    <a href="{{ route('vitrine.index') }}" class="btn btn-glass-dark px-5 mt-3">Retourner à la vitrine</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
