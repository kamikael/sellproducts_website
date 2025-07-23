@extends('layouts.app')

@section('title', $stand->nom_stand . ' - Détails')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <a href="{{ route('stands.index') }}" class="btn btn-secondary">&larr; Retour aux stands</a>
                <a href="{{ route('stands.edit', $stand) }}" class="btn btn-warning float-end">Modifier</a>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h1>{{ $stand->nom_stand }}</h1>
                    <p class="lead">{{ $stand->description }}</p>
                    <p class="text-muted">Créé le {{ $stand->created_at->format('d/m/Y') }}</p>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Produits de ce stand</h2>
                <a href="{{ route('produits.create') }}" class="btn btn-primary">Ajouter un produit</a>
            </div>

            @if($stand->produits->count() > 0)
                <div class="row">
                    @foreach($stand->produits as $produit)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card">
                                @if($produit->image_url)
                                    <img src="{{ Str::startsWith($produit->image_url, ['http://', 'https://']) ? $produit->image_url : asset($produit->image_url) }}" class="card-img-top" alt="{{ $produit->nom }}" style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $produit->nom }}</h5>
                                    <p class="card-text">{{ $produit->description }}</p>
                                    <p class="card-text"><strong>Prix: {{ number_format($produit->prix, 2) }} €</strong></p>
                                    <div class="btn-group">
                                        <a href="{{ route('produits.edit', $produit) }}" class="btn btn-warning btn-sm">Modifier</a>
                                        <form action="{{ route('produits.destroy', $produit) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">
                    <h4>Aucun produit dans ce stand</h4>
                    <p>Ajoutez votre premier produit pour commencer à vendre !</p>
                    <a href="{{ route('produits.create') }}" class="btn btn-primary">Ajouter un produit</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
