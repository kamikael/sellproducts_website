@extends('layouts.app')

@section('title', 'Mes Produits')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="fw-bold mb-0">
                    <i class="bi bi-box-seam text-danger me-2"></i>Mes Produits
                </h1>

                <div class="d-flex gap-2">
                    <a href="{{ route('produits.create') }}" class="btn btn-danger">
                        <i class="bi bi-plus-circle me-1"></i> Ajouter un produit
                    </a>
                    <a href="{{ route('stands.index') }}" class="btn btn-outline-danger">
                        <i class="bi bi-shop me-1"></i> Mes stands
                    </a>
                    <a href="{{ route('commandes.historique') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-clock-history me-1"></i> Commandes
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4">
                    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($products->count() > 0)
                <div class="row g-4">
                    @foreach($products as $product)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                                @if($product->image_url)
                                    <div class="card-img-container" style="height: 200px;">
                                        <img src="{{ $product->image_url }}"
                                             class="card-img-top"
                                             alt="{{ $product->nom }}"
                                             style="object-position: center;">
                                    </div>
                                @else
                                    <div class="card-img-container bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title mb-0">{{ $product->nom }}</h5>
                                        <span class="badge bg-danger">{{ number_format($product->prix, 2) }} €</span>
                                    </div>
                                    <p class="card-text text-muted mb-2">{{ Str::limit($product->description, 80) }}</p>
                                    <p class="text-muted small mb-3">
                                        <i class="bi bi-shop"></i> {{ $product->stand->nom_stand }}
                                    </p>

                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('produits.edit', $product) }}" class="btn btn-outline-secondary btn-sm">
                                            <i class="bi bi-pencil me-1"></i> Modifier
                                        </a>
                                        <form action="{{ route('produits.destroy', $product) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                                <i class="bi bi-trash me-1"></i> Supprimer
                                            </button>
                                        </form>
                                    </div>
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
                    <h3 class="fw-light mb-3">Aucun produit enregistré</h3>
                    <p class="text-muted mb-4">Commencez par ajouter vos premiers produits à votre stand</p>
                    <a href="{{ route('produits.create') }}" class="btn btn-danger">
                        <i class="bi bi-plus-circle me-1"></i> Ajouter un produit
                    </a>
                </div>
            @endif
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
