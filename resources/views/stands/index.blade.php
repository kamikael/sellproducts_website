<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Stands</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1>Mes Stands</h1>
                
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-3">
                    <a href="{{ route('stands.create') }}" class="btn btn-primary">Créer un nouveau stand</a>
                    <a href="{{ route('produits.index') }}" class="btn btn-secondary">Gérer mes produits</a>
                </div>

                @if($stands->count() > 0)
                    <div class="row">
                        @foreach($stands as $stand)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $stand->nom_stand }}</h5>
                                        <p class="card-text">{{ $stand->description }}</p>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                {{ $stand->produits->count() }} produit(s)
                                            </small>
                                        </p>
                                        
                                        <div class="btn-group">
                                            <a href="{{ route('stands.show', $stand) }}" class="btn btn-info btn-sm">Voir</a>
                                            <a href="{{ route('stands.edit', $stand) }}" class="btn btn-warning btn-sm">Modifier</a>
                                            <form action="{{ route('stands.destroy', $stand) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce stand ?')">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info">
                        Vous n'avez pas encore de stands. <a href="{{ route('stands.create') }}">Créez votre premier stand</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 