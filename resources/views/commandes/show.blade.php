@extends('layouts.app')

@section('title', 'Détails de la commande #' . $commande->id)

@section('content')
<div class="container py-5"> {{-- Changed mt-4 to py-5 for consistent vertical spacing --}}
    <div class="row justify-content-center"> {{-- Centered content for better layout --}}
        <div class="col-md-10 col-lg-8"> {{-- Adjusted column size for better aesthetics on larger screens --}}

            <div class="mb-4 d-flex justify-content-start"> {{-- Moved button to left and increased margin --}}
                <a href="{{ route('commandes.historique') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Retour à l'historique
                </a> {{-- Changed to outline-secondary and added icon for consistency --}}
            </div>

            <div class="card shadow-lg border-0" style="border-radius: 1rem;"> {{-- Added shadow, no border, increased rounding --}}
                <div class="card-header bg-white py-4" style="border-bottom: 1px solid #eee;"> {{-- White background, custom border, more padding --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0 fw-bold text-dark">Détails de la Commande #{{ $commande->id }}</h3> {{-- Darker, bolder text --}}
                        <span class="badge bg-primary rounded-pill py-2 px-3 fs-6"> {{-- Larger, rounded pill badge --}}
                            <i class="bi bi-calendar"></i> {{ $commande->date_commande->format('d/m/Y à H:i') }}
                        </span>
                    </div>
                </div>
                <div class="card-body p-4"> {{-- Increased padding for card body --}}
                    <div class="row mb-4"> {{-- Added bottom margin --}}
                        <div class="col-md-6">
                            <h5 class="fw-bold text-dark mb-3">Informations du stand</h5> {{-- Bolder title --}}
                            <p class="mb-1"><strong>Nom:</strong> <span class="text-muted">{{ $commande->stand->nom_stand }}</span></p>
                            <p class="mb-1"><strong>Description:</strong> <span class="text-muted">{{ $commande->stand->description }}</span></p>
                            <p class="mb-0"><strong>Entrepreneur:</strong> <span class="text-muted">{{ $commande->stand->user->name }}</span></p>
                        </div>
                        <div class="col-md-6 border-start ps-4"> {{-- Added left border and padding --}}
                            <h5 class="fw-bold text-dark mb-3">Informations de la commande</h5> {{-- Bolder title --}}
                            <p class="mb-1"><strong>Total:</strong> <span class="text-danger fs-4 fw-bold">{{ number_format($commande->total, 2) }} €</span></p> {{-- Prominent total with brand red --}}
                            @if($commande->client_email)
                                <p class="mb-1"><strong>Client:</strong> <span class="text-muted">{{ $commande->client_email }}</span></p>
                            @endif
                            <p class="mb-0"><strong>Date de Commande:</strong> <span class="text-muted">{{ $commande->date_commande->format('d/m/Y H:i') }}</span></p>
                        </div>
                    </div>

                    <hr class="my-4"> {{-- Increased margin for hr --}}

                    <h5 class="fw-bold text-dark mb-3">Produits commandés</h5> {{-- Bolder title --}}
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-borderless align-middle"> {{-- Added hover, borderless, align-middle for vertical centering --}}
                            <thead>
                                <tr>
                                    <th class="text-primary">Image</th> {{-- Primary color for headers --}}
                                    <th class="text-primary">Produit</th>
                                    <th class="text-primary">Prix unitaire</th>
                                    <th class="text-primary">Quantité</th>
                                    <th class="text-primary">Sous-total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($commande->produits as $produit)
                                    @php
                                        // Attempt to find the full product model if 'id' exists in the stored product data
                                        $produitModel = null;
                                        if (isset($produit['id'])) {
                                            $produitModel = \App\Models\Produit::find($produit['id']);
                                        }
                                    @endphp
                                    <tr>
                                        <td>
                                            @if($produitModel && $produitModel->image_url)
                                                <img src="{{ Str::startsWith($produitModel->image_url, ['http://', 'https://']) ? $produitModel->image_url : asset($produitModel->image_url) }}"
                                                     alt="{{ $produit['nom'] }}"
                                                     class="rounded shadow-sm" style="height:70px; width:70px; object-fit:cover;"> {{-- Increased size, rounded, added shadow --}}
                                            @else
                                                <img src="{{ asset('/storage/images/default_product.png') }}" alt="Produit par défaut" class="rounded shadow-sm" style="height:70px; width:70px; object-fit:cover;">
                                            @endif
                                        </td>
                                        <td>
                                            <strong class="text-dark">{{ $produit['nom'] }}</strong>
                                            @if(isset($produit['description']))
                                                <br><small class="text-muted">{{ Str::limit($produit['description'], 50) }}</small> {{-- Limit description length --}}
                                            @endif
                                        </td>
                                      <td>{{ isset($produit['prix']) ? number_format($produit['prix'], 2) . ' €' : 'N/A' }}</td>
<td>{{ isset($produit['quantite']) ? $produit['quantite'] : 'N/A' }}</td>
<td>
    <strong class="text-dark">
        {{ isset($produit['sous_total']) ? number_format($produit['sous_total'], 2) . ' €' : 'N/A' }}
    </strong>
</td>
</tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end fw-bold fs-5">Total de la commande :</td> {{-- More descriptive text --}}
                                    <td><strong class="text-danger fs-4">{{ number_format($commande->total, 2) }} €</strong></td> {{-- Prominent total --}}
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4"> {{-- Centered button --}}
                        <a href="{{ route('commandes.historique') }}" class="btn btn-primary">
                            <i class="bi bi-arrow-left"></i> Retour à l'historique
                        </a>
                    </div>
                </div>
            </div>
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
        box-shadow: 0 .25rem .75rem rgba(0,0,0,.1); /* Stronger shadow for main card */
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
    h3, h5 {
        font-weight: 700;
        color: #343a40;
    }
    .text-danger {
        color: #e74c3c !important; /* Consistent brand red */
    }
    .text-primary {
        color: #e74c3c !important; /* Re-using primary for your brand red */
    }
    .fw-bold {
        font-weight: 700 !important;
    }
    .text-muted {
        color: #6c757d !important;
    }
    strong {
        font-weight: 600; /* Slightly less bold for general strong text */
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

    /* Image styling within table */
    .table img {
        border: 1px solid #dee2e6; /* Subtle border around product images */
    }
</style>
@endsection
