@extends('layouts.app')

@section('title', 'Mon Panier')

@section('content')
<div class="vitrine-wrapper py-5">
    <div class="px-5">
        <!-- Navigation -->
        <div class="d-flex justify-content-between align-items-center mb-5 animate-in">
            <a href="{{ route('vitrine.index') }}#stands" class="btn btn-glass-dark px-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i> Continuer mes délices
            </a>
            <h1 class="display-5 fw-bold mb-0">Mon Panier</h1>
        </div>

        <div class="vitrine-bg-blobs"></div>

        <!-- Feedback Messages -->
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 animate-in">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif

        @if(count($produits) > 0)
            <div class="row g-5">
                <!-- Basket Items -->
                <div class="col-lg-8">
                    <div class="basket-items-container">
                        @foreach($produits as $item)
                            <div class="glass-card mb-4 p-4 rounded-5 animate-card shadow-sm border border-white border-opacity-25" style="background: rgba(255,255,255,0.3); backdrop-filter: blur(15px);">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        @if($item['produit']->image_url)
                                            <div class="rounded-4 overflow-hidden shadow-sm" style="height: 100px; width: 100px;">
                                                <img src="{{ Str::startsWith($item['produit']->image_url, ['http://', 'https://']) ? $item['produit']->image_url : asset($item['produit']->image_url) }}" 
                                                     class="w-100 h-100 object-fit-cover" alt="{{ $item['produit']->nom }}">
                                            </div>
                                        @else
                                            <div class="bg-light rounded-4 d-flex align-items-center justify-content-center" style="height: 100px; width: 100px;">
                                                <i class="bi bi-image text-muted opacity-25" style="font-size: 2rem;"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <h4 class="fw-bold mb-1">{{ $item['produit']->nom }}</h4>
                                        <span class="badge bg-dark rounded-pill py-2 px-3 fw-normal opacity-50">
                                            <i class="bi bi-shop me-1"></i> {{ $item['produit']->stand->nom_stand }}
                                        </span>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="text-muted small mb-1">Quantité</div>
                                        <div class="fw-bold fs-5">{{ $item['quantite'] }}</div>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <div class="text-muted small mb-1">Total</div>
                                        <div class="fw-bold fs-5">{{ number_format($item['sous_total'], 0, ',', ' ') }} €</div>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <form action="{{ route('commandes.supprimer-du-panier', $item['produit']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-dark opacity-25 p-0" onclick="return confirm('Retirer ce délice ?')">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-4 animate-in">
                        <form action="{{ route('commandes.vider-panier') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-dark fw-bold opacity-75 text-decoration-none px-0" onclick="return confirm('Vider tout votre sélection ?')">
                                <i class="bi bi-x-lg me-2"></i> Effacer ma sélection
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Summary Sidebar -->
                <div class="col-lg-4">
                    <div class="sticky-top animate-in" style="top: 100px;">
                        <div class="p-5 rounded-5 text-white shadow-xl" style="background: #000; border: 1px solid rgba(255,255,255,0.1);">
                            <h3 class="fw-bold mb-5">Votre Sac</h3>
                            
                            <div class="d-flex justify-content-between mb-3 opacity-75">
                                <span>Sous-total</span>
                                <span>{{ number_format($total, 0, ',', ' ') }} €</span>
                            </div>
                            <div class="d-flex justify-content-between mb-5 fs-4 fw-bold border-top pt-4">
                                <span>Total</span>
                                <span class="text-white">{{ number_format($total, 0, ',', ' ') }} €</span>
                            </div>

                            <form action="{{ route('commandes.soumettre') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-light w-100 py-3 rounded-pill fw-bold fs-5 transition-all hover-scale shadow-lg">
                                    FINALISER MON EXPÉRIENCE
                                </button>
                            </form>
                            
                            <p class="text-center mt-4 small opacity-50">
                                <i class="bi bi-stars me-1"></i> Préparation artisanale garantie
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="empty-state text-center py-5 animate-in">
                <i class="bi bi-stars display-1 mb-4 opacity-25"></i>
                <h2 class="fw-bold">Votre sac est vide</h2>
                <p class="text-muted fs-5 mb-5">Laissez-vous tenter par nos créations artisanales.</p>
                <a href="{{ route('vitrine.index') }}#stands" class="btn btn-dark btn-lg px-5 rounded-pill">
                    DÉCOUVRIR L'ARTISANAT
                </a>
            </div>
        @endif

        @if(session('historique_achats'))
                <div class="glass-card p-5 rounded-5 shadow-sm border border-white border-opacity-25" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px);">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <h3 class="fw-bold mb-0">Historique des commandes</h3>
                        <form action="{{ route('commandes.vider-historique') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-muted p-0 text-decoration-none" onclick="return confirm('Effacer l\'historique ?')">
                                <i class="bi bi-trash me-1"></i> Effacer tout
                            </button>
                        </form>
                    </div>

                    @foreach(session('historique_achats') as $index => $commande)
                        <div class="mb-5 pb-5 {{ !$loop->last ? 'border-bottom border-white border-opacity-10' : '' }}">
                            <h5 class="fw-bold mb-4 opacity-50">#{{ $index + 1 }} — Commande terminée</h5>
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle">
                                    <thead>
                                        <tr class="text-muted small uppercase letter-spacing-1">
                                            <th>PRODUIT</th>
                                            <th class="text-center">QTY</th>
                                            <th class="text-end">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $totalH = 0; @endphp
                                        @foreach($commande as $pId => $qty)
                                            @php
                                                $p = \App\Models\Produit::find($pId);
                                                $st = $p ? $p->prix * $qty : 0;
                                                $totalH += $st;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="fw-bold">{{ $p ? $p->nom : 'Produit supprimé' }}</div>
                                                        @if($p && $p->stand)
                                                            <span class="ms-2 px-2 py-0 small rounded-pill bg-dark text-white opacity-25" style="font-size: 0.7rem;">{{ $p->stand->nom_stand }}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="text-center fw-medium">{{ $qty }}</td>
                                                <td class="text-end fw-bold">{{ number_format($st, 0, ',', ' ') }} €</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-end opacity-50">Montant payé</td>
                                            <td class="text-end fw-bold fs-5">{{ number_format($totalH, 0, ',', ' ') }} €</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    .glass-card {
        transition: transform 0.4s cubic-bezier(0.19, 1, 0.22, 1);
    }
    .glass-card:hover {
        transform: translateY(-5px);
        background: rgba(255,255,255,0.35) !important;
    }
    .hover-scale:hover {
        transform: scale(1.02);
    }
    .letter-spacing-1 {
        letter-spacing: 1px;
    }
    .animate-in {
        animation: fadeInUp 0.8s ease-out forwards;
    }
    .animate-card {
        animation: fadeInUp 0.8s ease-out forwards;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
