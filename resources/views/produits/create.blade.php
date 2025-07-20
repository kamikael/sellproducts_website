<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Ajouter un nouveau produit</h3>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('produits.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom du produit *</label>
                                <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="prix" class="form-label">Prix (€) *</label>
                                <input type="number" class="form-control" id="prix" name="prix" step="0.01" min="0" value="{{ old('prix') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="image_url" class="form-label">URL de l'image</label>
                                <input type="url" class="form-control" id="image_url" name="image_url" value="{{ old('image_url') }}">
                            </div>

                            <div class="mb-3">
                                <label for="stand_id" class="form-label">Stand *</label>
                                <select class="form-control" id="stand_id" name="stand_id" required>
                                    <option value="">Sélectionnez un stand</option>
                                    @foreach($stands as $stand)
                                        <option value="{{ $stand->id }}" {{ old('stand_id') == $stand->id ? 'selected' : '' }}>
                                            {{ $stand->nom_stand }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('produits.index') }}" class="btn btn-secondary">Annuler</a>
                                <button type="submit" class="btn btn-primary">Créer le produit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 