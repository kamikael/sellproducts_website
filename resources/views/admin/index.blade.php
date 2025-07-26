@extends('layouts.app')

@section('title', 'Dashboard Admin - Eat&Drink')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold text-center mb-5" style="color: var(--dark-color);">Tableau de Bord</h1>
    <div class="row g-4">
        <div class="col-md-8">
            <div class="card shadow-lg border-0" style="border-radius: 1rem;">
                <div class="card-header text-dark py-3" style="background-color: var(--secondary-color); border-top-left-radius: 1rem; border-top-right-radius: 1rem;"> {{-- Custom header color from root, rounded corners --}}
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-hourglass-split me-2"></i>
                        Demandes en attente ({{ $pendingRequests->count() }})
                    </h4>
                </div>
                <div class="card-body p-4">
                    @if($pendingRequests->count())
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-borderless align-middle">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="text-primary">Entreprise</th>
                                        <th scope="col" class="text-primary">Contact</th>
                                        <th scope="col" class="text-primary">Date</th>
                                        <th scope="col" class="text-primary text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingRequests as $request)
                                        <tr>
                                            <td>
                                                <strong>{{ $request->nom_entreprise }}</strong><br>
                                                <small class="text-muted">{{ $request->name }}</small> {{-- Added text-muted for small text --}}
                                            </td>
                                            <td>{{ $request->email }}</td>
                                            <td>
                                                {{ $request->created_at ? $request->created_at->format('d/m/Y H:i') : 'Date inconnue' }}
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group gap-2" role="group" aria-label="Actions pour demande"> {{-- Added gap for buttons --}}
                                                    <button type="button" class="btn btn-sm btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#approveModal{{ $request->id }}">
                                                         Approuver
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $request->id }}">
                                                         Rejeter
                                                    </button>
                                                    {{-- Assuming a route for details --}}
                                                    <a href="" class="btn btn-sm btn-outline-info rounded-pill">
                                                         Détails
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="approveModal{{ $request->id }}" tabindex="-1" aria-labelledby="approveModalLabel{{ $request->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content border-0 shadow-lg" style="border-radius: 1rem;">
                                                    <div class="modal-header bg-success text-white" style="border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                                                        <h5 class="modal-title" id="approveModalLabel{{ $request->id }}">Approuver {{ $request->nom_entreprise }}</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        Confirmez-vous l'approbation de la demande de **{{ $request->nom_entreprise }}** ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Annuler</button>
                                                        <form method="POST" action="{{ route('admin.users.approve', $request->id) }}" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success rounded-pill">Approuver</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="rejectModal{{ $request->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $request->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content border-0 shadow-lg" style="border-radius: 1rem;">
                                                    <div class="modal-header bg-danger text-white" style="border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                                                        <h5 class="modal-title" id="rejectModalLabel{{ $request->id }}">Rejeter {{ $request->nom_entreprise }}</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="POST" action="{{ route('admin.users.reject', $request->id) }}">
                                                        @csrf
                                                        <div class="modal-body p-4">
                                                            <div class="mb-3">
                                                                <label for="motif_rejet_{{ $request->id }}" class="form-label fw-bold">Motif de rejet <span class="text-danger">*</span></label>
                                                                <textarea name="motif_rejet" id="motif_rejet_{{ $request->id }}" class="form-control" rows="3" required placeholder="Veuillez indiquer la raison du rejet..."></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Annuler</button>
                                                            <button type="submit" class="btn btn-danger rounded-pill">Rejeter</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5"> {{-- More padding for empty state --}}
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i> {{-- Bootstrap icon, larger size --}}
                            <h5 class="mt-3 text-muted">Aucune nouvelle demande en attente pour le moment.</h5>
                            <p class="text-muted">Toutes les demandes ont été traitées ou il n'y en a pas encore.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-lg border-0" style="border-radius: 1rem;">
                <div class="card-header bg-primary text-white py-3" style="border-top-left-radius: 1rem; border-top-right-radius: 1rem;"> {{-- Used primary color for approved, rounded corners --}}
                    <h5 class="mb-0 fw-bold"><i class="bi bi-patch-check-fill me-2"></i>Entrepreneurs Approuvés ({{ $approvedEntrepreneurs->count() }})</h5> {{-- Bootstrap icon --}}
                </div>
                <div class="card-body p-4">
                    @forelse($approvedEntrepreneurs as $entrepreneur)
                        <div class="d-flex justify-content-between align-items-center py-2 px-3 mb-2" style="background-color: var(--light-color); border-radius: 0.5rem; border: 1px solid #dee2e6;"> {{-- Styled list item --}}
                            <div>
                                <h6 class="mb-0 fw-semibold">{{ $entrepreneur->nom_entreprise }}</h6>
                                <small class="text-muted">{{ $entrepreneur->name }}</small>
                            </div>
                            <div>
                                <a href="" class="btn btn-sm btn-outline-primary rounded-pill">
                                    <i class="bi bi-eye"></i> Voir
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="bi bi-info-circle-fill text-secondary" style="font-size: 3rem;"></i> {{-- Bootstrap icon --}}
                            <p class="text-muted mt-3">Aucun entrepreneur approuvé pour l'instant.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> {{-- Ensure Bootstrap Icons are loaded --}}
<style>
    .container {
        max-width: 1200px;
    }

    .card {
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
        border: none;
    }

    .card-header {
        border-bottom: none;
        font-size: 1.15rem;
        display: flex;
        align-items: center;
    }
    .card-header h4, .card-header h5 {
        font-weight: 700;
    }

    .table-responsive {
        margin-top: 0;
    }
    .table {
        --bs-table-striped-bg: var(--light-color);
        --bs-table-hover-bg: rgba(231, 76, 60, 0.08);
        border-collapse: separate;
        border-spacing: 0 0.5rem;
        width: 100%;
    }
    .table thead th {
        border-top: none;
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        color: var(--dark-color);
        padding: 1rem 1.25rem;
        background-color: #f8f9fa;
    }
    .table tbody tr {
        background-color: white;
        transition: all 0.2s ease-in-out;
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.05);
    }
    .table tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
    }
    .table tbody td {
        vertical-align: middle;
        padding: 0.9rem 1.25rem;
        color: #555;
        border-top: none;
    }

    .btn {
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    .btn-sm {
        padding: 0.4rem 0.9rem;
        font-size: 0.85rem;
    }
    .rounded-pill {
        border-radius: 50rem !important;
    }
    .btn-group.gap-2 > .btn {
        margin-right: 0.5rem;
    }
    .btn-group.gap-2 > .btn:last-child {
        margin-right: 0;
    }

    .modal-content {
        border-radius: 1rem;
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,.2);
    }
    .modal-header {
        border-bottom: none;
        padding: 1.5rem;
        color: white;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .modal-header .btn-close {
        filter: invert(1);
    }
    .modal-body {
        padding: 2rem;
        color: var(--dark-color);
    }
    .modal-footer {
        border-top: none;
        padding: 1.5rem;
    }

    .bg-primary { background-color: var(--primary-color) !important; }
    .bg-secondary { background-color: var(--secondary-color) !important; }
    .bg-success { background-color: #28a745 !important; }
    .bg-danger { background-color: #dc3545 !important; }
    .bg-warning { background-color: #ffc107 !important; }

    .text-primary { color: var(--primary-color) !important; }
    .text-dark { color: var(--dark-color) !important; }

    .btn-outline-primary { border-color: var(--primary-color); color: var(--primary-color); }
    .btn-outline-primary:hover { background-color: var(--primary-color); color: white; }

    .btn-outline-info { border-color: #17a2b8; color: #17a2b8; }
    .btn-outline-info:hover { background-color: #17a2b8; color: white; }
</style>
@endpush
