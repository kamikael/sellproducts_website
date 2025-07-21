<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statut de votre demande - Eat&Drink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">

                    @if($user->role == 'entrepreneur_en_attente')
                        <div class="card-header bg-warning text-dark">
                            <h3 class="mb-0">Statut de votre demande</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="mb-4">
                                <i class="fas fa-clock fa-3x text-warning mb-3"></i>
                                <h4>Demande en cours d'examen</h4>
                            </div>
                            <div class="alert alert-info">
                                <h5>Bonjour {{ $user->name }},</h5>
                                <p>Votre demande de stand pour <strong>{{ $user->nom_entreprise }}</strong> est actuellement en cours d'examen par nos administrateurs.</p>
                                <p>Vous recevrez une notification par email dès que votre demande sera traitée.</p>
                            </div>
                        </div>

                    @elseif($user->role == 'entrepreneur_rejete')
                        <div class="card-header bg-danger text-white">
                            <h3 class="mb-0">Statut de votre demande</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="mb-4">
                                <i class="fas fa-times-circle fa-3x text-danger mb-3"></i>
                                <h4>Demande rejetée</h4>
                            </div>
                            <div class="alert alert-danger">
                                <h5>Bonjour {{ $user->name }},</h5>
                                <p>Nous sommes au regret de vous informer que votre demande de stand pour <strong>{{ $user->nom_entreprise }}</strong> n'a pas pu être acceptée.</p>
                            </div>
                            <div class="card border-danger mt-4">
                                <div class="card-body">
                                    <h6 class="card-title">Motif du rejet :</h6>
                                    <p class="card-text">{{ $user->motif_rejet }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="card-footer text-center">
                        <div class="mt-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary">Se déconnecter</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 