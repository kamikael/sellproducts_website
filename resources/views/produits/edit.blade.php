@extends('layouts.app')

@section('title', 'Modifier le produit')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Modifier le produit</h3>
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

                    <form action="{{ route('produits.update', $produit) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom du produit *</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $produit->nom) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $produit->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="prix" class="form-label">Prix (€) *</label>
                            <input type="number" class="form-control" id="prix" name="prix" step="0.01" min="0" value="{{ old('prix', $produit->prix) }}" required>
                        </div>

                        <div class="mb-3" id="image_url_group">
                            <label for="image_url" class="form-label">URL de l'image</label>
                            <input type="url" class="form-control" id="image_url" name="image_url" value="{{ old('image_url', $produit->image_url) }}">
                            <button type="button" class="btn btn-link p-0 mt-1" id="switchToFile">Ou téléversez une image</button>
                        </div>
                        <div class="mb-3 d-none" id="image_file_group">
                            <label for="image_file" class="form-label">Fichier image</label>
                            <input type="file" class="form-control" id="image_file" name="image_file" accept="image/*">
                            <button type="button" class="btn btn-link p-0 mt-1" id="switchToUrl">Ou utilisez une URL</button>
                        </div>

                        <div class="mb-3">
                            <label for="stand_id" class="form-label">Stand *</label>
                            <select class="form-control" id="stand_id" name="stand_id" required>
                                <option value="">Sélectionnez un stand</option>
                                @foreach($stands as $stand)
                                    <option value="{{ $stand->id }}" {{ old('stand_id', $produit->stand_id) == $stand->id ? 'selected' : '' }}>
                                        {{ $stand->nom_stand }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('produits.index') }}" class="btn btn-secondary">Annuler</a>
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const urlGroup = document.getElementById('image_url_group');
        const fileGroup = document.getElementById('image_file_group');
        const switchToFile = document.getElementById('switchToFile');
        const switchToUrl = document.getElementById('switchToUrl');
        const urlInput = document.getElementById('image_url');
        const fileInput = document.getElementById('image_file');

        // Affiche le champ approprié selon ce qui est déjà rempli (pour l'édition)
        if (fileInput.value) {
            urlGroup.classList.add('d-none');
            fileGroup.classList.remove('d-none');
        } else {
            urlGroup.classList.remove('d-none');
            fileGroup.classList.add('d-none');
        }

        switchToFile.addEventListener('click', function() {
            urlGroup.classList.add('d-none');
            fileGroup.classList.remove('d-none');
            urlInput.value = '';
        });
        switchToUrl.addEventListener('click', function() {
            fileGroup.classList.add('d-none');
            urlGroup.classList.remove('d-none');
            fileInput.value = '';
        });
    });
</script>
@endsection
