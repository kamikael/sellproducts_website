@extends('layouts.app')

@section('title', 'Dashboard Admin - Eat&Drink')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Demandes en attente -->
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">
                        <i class="fas fa-clock me-2"></i>
                        Demandes en attente ({{ $pendingRequests->count() }})
                    </h4>
                </div>
                <div class="card-body">
                    @if($pendingRequests->count())
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Entreprise</th>
                                        <th>Contact</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingRequests as $request)
                                        <tr>
                                            <td>
                                                <strong>{{ $request->nom_entreprise }}</strong><br>
                                                <small>{{ $request->name }}</small>
                                            </td>
                                            <td>{{ $request->email }}</td>
                                            <td>
                                                {{ $request->created_at ? $request->created_at->format('d/m/Y H:i') : 'Date inconnue' }}
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#approveModal{{ $request->id }}">
                                                        <i class="fas fa-check"></i> Approuver
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $request->id }}">
                                                        <i class="fas fa-times"></i> Rejeter
                                                    </button>
                                                    <a href="#" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i> Détails
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal Approuver -->
                                        <div class="modal fade" id="approveModal{{ $request->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Approuver {{ $request->nom_entreprise }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Confirmer l'approbation de la demande ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                        
                                                        <form method="POST" action="{{ route('admin.users.approve', $request->id) }}">
                                                            @csrf
                                                            <button class="btn btn-success">Approuver</button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Rejeter -->
                                        <div class="modal fade" id="rejectModal{{ $request->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Rejeter {{ $request->nom_entreprise }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="POST" action="">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label>Motif *</label>
                                                                <textarea name="motif_rejet" class="form-control" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                            <button class="btn btn-danger">Rejeter</button>
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
                        <div class="text-center py-4">
                            <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                            <h5>Aucune demande</h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Entrepreneurs approuvés -->
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5><i class="fas fa-users me-2"></i>Approuvés ({{ $approvedEntrepreneurs->count() }})</h5>
                </div>
                <div class="card-body">
                    @forelse($approvedEntrepreneurs as $entrepreneur)
                        <div class="list-group-item">
                            <h6>{{ $entrepreneur->nom_entreprise }}</h6>
                            <small>{{ $entrepreneur->name }} - {{ $entrepreneur->email }}</small>
                        </div>
                    @empty
                        <p class="text-muted text-center">Aucun pour l’instant.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
