<div class="admin-dashboard-wrapper min-vh-100 py-5" style="background: transparent; color: #1e293b; padding-top: 15rem;">
    <div class="container-fluid px-5 py-4">
        <div class="d-flex justify-content-between align-items-end mb-5 animate-in">
            <div class="glass-container p-4 rounded-5 border border-white border-opacity-50">
                <p class="text-secondary small ls-2 text-uppercase mb-2 fw-bold" style="letter-spacing: 4px;">Détails Transaction</p>
                <h1 class="display-3 fw-bold mb-0 text-dark">Bon de Commande #{{ $commande->id }}.</h1>
                <p class="fs-5 text-muted mt-3 fw-medium">Résumé complet des articles et informations de paiement pour cette commande.</p>
            </div>
            <div class="text-end pb-3">
                <a href="{{ route('commandes.historique') }}" class="btn btn-glass-auth shadow-sm fw-bold">
                    <i class="bi bi-arrow-left me-2"></i>RETOUR HISTORIQUE
                </a>
            </div>
        </div>

        <div class="row g-5 animate-in" style="animation-delay: 0.1s;">
            <div class="col-lg-8">
                <div class="glass-container p-5 rounded-5 shadow-sm border border-white mb-5">
                    <h4 class="fw-bold text-dark mb-4 text-uppercase ls-1">Articles Commandés</h4>
                    <div class="table-responsive">
                        <table class="table admin-fancy-table align-middle m-0">
                            <thead>
                                <tr class="small text-uppercase">
                                    <th class="border-0 pb-3 text-secondary fw-bold">Visuel</th>
                                    <th class="border-0 pb-3 text-secondary fw-bold">Désignation</th>
                                    <th class="border-0 pb-3 text-secondary fw-bold text-center">Prix Unit.</th>
                                    <th class="border-0 pb-3 text-secondary fw-bold text-center">Qté</th>
                                    <th class="border-0 pb-3 text-end text-secondary fw-bold">Sous-total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($commande->produits as $produit)
                                    @php
                                        $produitModel = isset($produit['id']) ? \App\Models\Produit::find($produit['id']) : null;
                                    @endphp
                                    <tr>
                                        <td class="py-3">
                                            <div class="rounded-4 overflow-hidden shadow-sm" style="width: 70px; height: 70px;">
                                                @if($produitModel && $produitModel->image_url)
                                                    <img src="{{ Str::startsWith($produitModel->image_url, ['http://', 'https://']) ? $produitModel->image_url : asset($produitModel->image_url) }}" class="w-100 h-100 object-fit-cover">
                                                @else
                                                    <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center text-secondary opacity-25">
                                                        <i class="bi bi-image"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-3 fw-bold text-dark">
                                            {{ $produit['nom'] }}
                                            @if(isset($produit['description']))
                                                <div class="text-secondary small fw-normal">{{ Str::limit($produit['description'], 40) }}</div>
                                            @endif
                                        </td>
                                        <td class="py-3 text-center text-secondary">{{ number_format($produit['prix'] ?? 0, 2) }} €</td>
                                        <td class="py-3 text-center">
                                            <span class="badge glass-pill text-dark px-3 py-1 rounded-pill">{{ $produit['quantite'] ?? 0 }}</span>
                                        </td>
                                        <td class="py-3 text-end fw-bold text-dark">{{ number_format($produit['sous_total'] ?? 0, 2) }} €</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="glass-container p-5 rounded-5 shadow-sm border border-white mb-4">
                    <h4 class="fw-bold text-dark mb-4 text-uppercase ls-1">Résumé & Client</h4>
                    <div class="mb-4">
                        <p class="text-secondary small text-uppercase ls-1 mb-1">Montant Total</p>
                        <h1 class="display-5 fw-bold text-primary">{{ number_format($commande->total, 2) }} €</h1>
                    </div>
                    
                    <div class="border-top border-white border-opacity-50 pt-4 mb-4">
                        <p class="text-secondary small text-uppercase ls-1 mb-1">Date d'opération</p>
                        <h6 class="text-dark fw-bold"><i class="bi bi-calendar3 me-2 text-primary"></i>{{ $commande->date_commande->format('d M Y, H:i') }}</h6>
                    </div>

                    @if($commande->client_email)
                        <div class="border-top border-white border-opacity-50 pt-4">
                            <p class="text-secondary small text-uppercase ls-1 mb-1">Contact Client</p>
                            <h6 class="text-dark fw-bold"><i class="bi bi-envelope me-2 text-primary"></i>{{ $commande->client_email }}</h6>
                        </div>
                    @endif
                </div>

                <div class="glass-container p-5 rounded-5 shadow-sm border border-white">
                    <h5 class="fw-bold text-dark mb-3 text-uppercase ls-1">Origine</h5>
                    <div class="d-flex align-items-center">
                        <div class="icon-box bg-soft-primary me-3" style="width: 50px; height: 50px;">
                            <i class="bi bi-shop fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark mb-0">{{ $commande->stand->nom_stand }}</h6>
                            <p class="text-secondary small mb-0">{{ $commande->stand->user->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .ls-1 { letter-spacing: 1px; }
    .ls-2 { letter-spacing: 2px; }
    
    .glass-container {
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(30px);
        -webkit-backdrop-filter: blur(30px);
        border: 1px solid rgba(255, 255, 255, 0.6) !important;
        transition: all 0.4s ease;
    }

    .icon-box {
        display: flex; align-items: center; justify-content: center;
        border-radius: 15px; background: rgba(244, 118, 104, 0.1); color: #f47668;
    }

    .bg-soft-primary { background: rgba(244, 118, 104, 0.1); color: #f47668; }

    .glass-pill {
        background: rgba(255, 255, 255, 0.8) !important;
        backdrop-filter: blur(10px);
    }

    .btn-glass-auth {
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(0, 0, 0, 0.05) !important;
        color: #64748b !important;
        border-radius: 50px !important;
        transition: all 0.3s ease;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
    }

    .btn-glass-auth:hover {
        background: #fff; color: #000 !important;
        transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    .animate-in {
        animation: slideIn 1.2s cubic-bezier(0.19, 1, 0.22, 1) forwards;
        opacity: 0;
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .admin-fancy-table th { font-family: 'Syne', sans-serif; }
</style>
