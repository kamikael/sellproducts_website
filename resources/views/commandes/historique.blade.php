@extends('layouts.app')

@section('title', 'Historique des Commandes')

@section('content')
<div class="container py-5"> {{-- Changed mt-4 to py-5 for consistent vertical spacing --}}
    <div class="row justify-content-center"> {{-- Centered content for better layout --}}
        <div class="col-md-10 col-lg-8"> {{-- Adjusted column size for better aesthetics on larger screens --}}
            <div class="text-center mb-4"> {{-- Centered header content --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#e74c3c" viewBox="0 0 24 24" class="mb-3">
                    <path d="M12 2L1 8v8l11 6 11-6V8L12 2zm0 2.8L20 9v6l-8 4.4-8-4.4V9l8-4.2z"/>
                    <path d="M12 12l-5-2.5V15l5 2.5 5-2.5V9.5L12 12z"/>
                </svg>
                <h2 class="fw-bold text-danger">Historique des Commandes</h2> {{-- Bold and danger color for title --}}
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert"> {{-- Added dismissible alert --}}
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-4 d-flex justify-content-end"> {{-- Moved button to right and increased margin --}}
                <a href="{{ route('produits.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Retour aux produits
                </a> {{-- Changed to outline-secondary and added icon for consistency --}}
            </div>

            @if($commandes->count() > 0)
                <div class="row">
                    @foreach($commandes as $commande)
                        <div class="col-12 mb-4">
                            <div class="card shadow-sm border-0" style="border-radius: 0.75rem;"> {{-- Added shadow, no border, slightly rounded --}}
                                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3" style="border-bottom: 1px solid #eee;"> {{-- White background, custom border, more padding --}}
                                    <h5 class="mb-0 fw-bold text-dark">Commande #{{ $commande->id }}</h5> {{-- Darker, bolder text --}}
                                    <span class="badge bg-primary rounded-pill py-2 px-3 fs-6"> {{-- Larger, rounded pill badge --}}
                                        <i class="bi bi-calendar"></i> {{ $commande->date_commande->format('d/m/Y H:i') }}
                                    </span>
                                </div>
                                <div class="card-body">
                                    <p class="mb-1"><strong>Stand:</strong> <span class="text-muted">{{ $commande->stand->nom_stand }}</span></p>
                                    <p class="mb-3 fs-5 text-danger fw-bold"><strong>Total:</strong> {{ number_format($commande->total, 2) }} €</p> {{-- Prominent total --}}
                                    @if($commande->client_email)
                                        <p class="mb-3"><strong>Client:</strong> <span class="text-muted">{{ $commande->client_email }}</span></p>
                                    @endif
                                    <h6 class="fw-bold text-dark mb-2">Produits commandés:</h6> {{-- Bolder title for products --}}
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-borderless"> {{-- Added striped and hover, removed outer border --}}
                                            <thead>
                                                <tr>
                                                    <th class="text-primary">Produit</th> {{-- Primary color for headers --}}
                                                    <th class="text-primary">Prix unitaire</th>
                                                    <th class="text-primary">Quantité</th>
                                                    <th class="text-primary">Sous-total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($commande->produits as $produit)
    <tr>
        <td>{{ $produit['nom'] ?? 'Produit inconnu' }}</td>
        <td>{{ number_format($produit['prix'] ?? 0, 2) }} €</td>
        <td>{{ $produit['quantite'] ?? 0 }}</td>
        <td>{{ number_format($produit['sous_total'] ?? 0, 2) }} €</td>
    </tr>
@endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-end mt-3"> {{-- Aligned to end --}}
                                        <a href="{{ route('commandes.show', $commande) }}" class="btn btn-info btn-sm">
                                            <i class="bi bi-info-circle"></i> Voir les détails
                                        </a> {{-- Added icon --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info text-center py-4" style="border-radius: 0.75rem;"> {{-- Consistent styling for empty state --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#2980b9" viewBox="0 0 24 24" class="mb-3">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                    </svg>
                    <h4 class="fw-bold text-primary">Aucune commande reçue pour le moment !</h4>
                    <p class="text-muted">Les commandes de vos clients apparaîtront ici. Partagez votre vitrine pour commencer à recevoir des commandes.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

---

@section('styles')
<style>
    .container {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }

    /* Card styling */
    .card {
        background-color: #fff;
        border-radius: 1rem;
        box-shadow: 0 .125rem .25rem rgba(0,0,0,.075); /* Light shadow for cards */
    }
    .card-header {
        background-color: #f8f9fa; /* Light grey header */
        border-bottom: 1px solid #dee2e6; /* Subtle border */
        border-top-left-radius: calc(1rem - 1px);
        border-top-right-radius: calc(1rem - 1px);
        font-weight: 600;
        color: #343a40;
    }

    /* Headings and text */
    h1, h2 {
        font-weight: 700;
        color: #343a40;
    }
    .text-danger {
        color: #e74c3c !important; /* Consistent brand red */
    }
    .fw-bold {
        font-weight: 700 !important;
    }

    /* Buttons */
    .btn-primary {
        background-color: #e74c3c;
        border-color: #e74c3c;
        transition: all 0.3s ease;
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
        border-radius: 0.5rem;
    }
    .btn-primary:hover {
        background-color: #c0392b;
        border-color: #c0392b;
    }
    .btn-outline-secondary {
        border-color: #ced4da;
        color: #6c757d;
        transition: all 0.3s ease;
        padding: 0.6rem 1.2rem; /* Slightly smaller for return button */
        font-size: 1rem;
        border-radius: 0.5rem;
    }
    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: #fff;
    }
    .btn-info { /* Style for 'Voir les détails' button */
        background-color: #3498db;
        border-color: #3498db;
        color: #fff;
        border-radius: 0.3rem;
        font-size: 0.9rem;
    }
    .btn-info:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }

    /* Badge styling */
    .badge.bg-primary {
        background-color: #e74c3c !important; /* Primary badge color */
        color: #fff;
    }
    .badge.rounded-pill {
        border-radius: 50rem !important; /* Truly pill-shaped */
    }

    /* Table styling */
    .table-responsive {
        margin-top: 1rem;
    }
    .table th {
        border-top: none; /* Remove top border for table headers */
        font-weight: 600;
        color: #2c3e50; /* Darker text for table headers */
    }
    .table td {
        vertical-align: middle;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0,0,0,.02); /* Lighter stripe effect */
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,.05); /* Subtle hover effect */
    }
    .table-borderless th, .table-borderless td {
        border: none; /* Ensure no borders */
    }

    /* Alert messages */
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-color: #c3e6cb;
    }
    .alert-info {
        background-color: #d1ecf1;
        color: #0c5460;
        border-color: #bee5eb;
    }
</style>
@endsection
