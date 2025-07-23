@extends('layouts.app')

@section('title', 'Vitrine - Stands et Produits')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-4">🎪 Vitrine des Stands</h1>
            <!-- Barre de recherche -->
            <div class="row justify-content-center mb-4">
                <div class="col-md-6">
                    <form action="{{ route('vitrine.recherche') }}" method="GET" class="d-flex">
                        <input type="text" name="q" class="form-control me-2" placeholder="Rechercher des stands ou produits..." value="{{ request('q') }}">
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </form>
                </div>
            </div>
            @if($stands->count() > 0)
                <div class="row">
                    @foreach($stands as $stand)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100">
                                @if($stand->produits->first() && $stand->produits->first()->image_url)
                                    <img
                                        src="{{ Str::startsWith($stand->produits->first()->image_url, ['http://', 'https://'])
                                            ? $stand->produits->first()->image_url
                                            : asset($stand->produits->first()->image_url) }}"
                                        class="card-img-top mb-2"
                                        alt="Image du produit {{ $stand->produits->first()->nom }}"
                                        style="height: 180px; object-fit: cover;"
                                    >
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $stand->nom_stand }}</h5>
                                    <p class="card-text">{{ $stand->description }}</p>
                                    <p class="card-text"><small class="text-muted">Par: {{ $stand->user->name }}</small></p>
                                    @if($stand->produits->count() > 0)
                                        <h6>Produits disponibles ({{ $stand->produits->count() }})</h6>
                                        <div class="mb-3">
                                            @foreach($stand->produits->take(3) as $produit)
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <span>{{ $produit->nom }}</span>
                                                    <span class="badge bg-primary">{{ number_format($produit->prix, 2) }} €</span>
                                                </div>
                                            @endforeach
                                            @if($stand->produits->count() > 3)
                                                <small class="text-muted">... et {{ $stand->produits->count() - 3 }} autres</small>
                                            @endif
                                        </div>
                                    @else
                                        <p class="text-muted">Aucun produit disponible pour le moment</p>
                                    @endif
                                    <a href="{{ route('vitrine.stand', $stand) }}" class="btn btn-primary">Voir le stand</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info text-center">
                    <h4>Aucun stand disponible</h4>
                    <p>Les stands approuvés apparaîtront ici.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
