@extends('layouts.app')

@section('title', 'Mes Stands')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="fw-bold mb-0">
                    <i class="bi bi-shop text-danger me-2"></i>Mes Stands
                </h1>

                <div class="d-flex gap-3">
                    <a href="{{ route('stands.create') }}" class="btn btn-danger">
                        <i class="bi bi-plus-circle me-1"></i> Nouveau stand
                    </a>
                    <a href="{{ route('produits.index') }}" class="btn btn-outline-danger">
                        <i class="bi bi-box-seam me-1"></i> Gérer les produits
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4">
                    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($stands->count() > 0)
                <div class="row g-4">
                    @foreach($stands as $stand)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <h5 class="card-title mb-0">{{ $stand->nom_stand }}</h5>
                                        <span class="badge bg-danger">{{ $stand->produits->count() }} produit(s)</span>
                                    </div>
                                    <p class="card-text text-muted mb-4">{{ Str::limit($stand->description, 100) }}</p>

                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('stands.show', $stand) }}" class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-eye me-1"></i> Voir
                                        </a>
                                        <a href="{{ route('stands.edit', $stand) }}" class="btn btn-outline-secondary btn-sm">
                                            <i class="bi bi-pencil me-1"></i> Modifier
                                        </a>
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
                    <h3 class="fw-light mb-3">Aucun stand créé</h3>
                    <p class="text-muted mb-4">Commencez par créer votre premier stand pour vendre vos produits</p>
                    <a href="{{ route('stands.create') }}" class="btn btn-danger">
                        <i class="bi bi-plus-circle me-1"></i> Créer un stand
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

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
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
