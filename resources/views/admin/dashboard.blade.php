<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Admin - Eat&Drink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Eat&Drink - Administration</a>
            <div class="navbar-nav ms-auto">
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">Déconnexion</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">
                            <i class="fas fa-clock me-2"></i>
                            Demandes en attente ({{ $pendingRequests->count() }})
                        </h4>
                    </div>
                    <div class="card-body">
                        @if($pendingRequests->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Entreprise</th>
                                            <th>Contact</th>
                                            <th>Date de demande</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pendingRequests as $request)
                                            <tr>
                                                <td>
                                                    <strong>{{ $request->nom_entreprise }}</strong><br>
                                                    <small class="text-muted">{{ $request->name }}</small>
                                                </td>
                                                <td>{{ $request->email }}</td>
                                                <td>{{ $request->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-sm btn-success" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#approveModal{{ $request->id }}">
                                                            <i class="fas fa-check"></i> Approuver
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#rejectModal{{ $request->id }}">
                                                            <i class="fas fa-times"></i> Rejeter
                                                        </button>
                                                        <a href="{{ route('admin.user.details', $request->id) }}" 
                                                           class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i> Détails
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Modal Approuver -->
                                            <div class="modal fade" id="approveModal{{ $request->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Approuver la demande</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Êtes-vous sûr de vouloir approuver la demande de <strong>{{ $request->nom_entreprise }}</strong> ?</p>
                                                            <p>Un stand sera automatiquement créé et un email de notification sera envoyé.</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                            <form method="POST" action="{{ route('admin.approve', $request->id) }}" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success">Approuver</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Rejeter -->
                                            <div class="modal fade" id="rejectModal{{ $request->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Rejeter la demande</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <form method="POST" action="{{ route('admin.reject', $request->id) }}">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <p>Êtes-vous sûr de vouloir rejeter la demande de <strong>{{ $request->nom_entreprise }}</strong> ?</p>
                                                                <div class="mb-3">
                                                                    <label for="motif_rejet" class="form-label">Motif du rejet *</label>
                                                                    <textarea class="form-control" id="motif_rejet" name="motif_rejet" rows="3" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                <button type="submit" class="btn btn-danger">Rejeter</button>
                                                            </form>
                                                        </div>
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
                                <h5>Aucune demande en attente</h5>
                                <p class="text-muted">Toutes les demandes ont été traitées.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-users me-2"></i>
                            Entrepreneurs approuvés ({{ $approvedEntrepreneurs->count() }})
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($approvedEntrepreneurs->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($approvedEntrepreneurs as $entrepreneur)
                                    <div class="list-group-item">
                                        <h6 class="mb-1">{{ $entrepreneur->nom_entreprise }}</h6>
                                        <small class="text-muted">{{ $entrepreneur->name }} - {{ $entrepreneur->email }}</small>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted text-center">Aucun entrepreneur approuvé pour le moment.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 