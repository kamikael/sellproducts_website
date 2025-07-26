@extends('layouts.app')

@section('title', 'Modifier le produit')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 p-4" style="border-radius: 1rem;">
                <div class="text-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#e74c3c" viewBox="0 0 24 24" class="mb-3">
                        <path d="M12 2L1 8v8l11 6 11-6V8L12 2zm0 2.8L20 9v6l-8 4.4-8-4.4V9l8-4.2z"/>
                        <path d="M12 12l-5-2.5V15l5 2.5 5-2.5V9.5L12 12z"/>
                    </svg>
                    <h2 class="fw-bold text-danger">Modifier le Produit</h2>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('produits.update', $produit) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom du produit <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom', $produit->nom) }}" required>
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $produit->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="prix" class="form-label">Prix (€) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control form-control-lg @error('prix') is-invalid @enderror" id="prix" name="prix" step="0.01" min="0" value="{{ old('prix', $produit->prix) }}" required>
                        @error('prix')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Image URL Field --}}
                    <div class="mb-3">
                        <label for="image_url" class="form-label">URL de l'image</label>
                        <input type="url" class="form-control @error('image_url') is-invalid @enderror" id="image_url" name="image_url" value="{{ old('image_url', $produit->image_url) }}">
                        @error('image_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted mt-2 d-block">
                            Si vous fournissez une URL, le fichier local ne sera pas utilisé.
                        </small>
                    </div>

                    {{-- Image File Upload Field --}}
                    <div class="mb-3">
                        <label for="image_file" class="form-label">Ou téléversez une nouvelle image</label>
                        <input type="file" class="form-control @error('image_file') is-invalid @enderror" id="image_file" name="image_file" accept="image/*">
                        @error('image_file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted mt-2 d-block">
                            Si vous téléchargez un fichier, l'URL de l'image ne sera pas utilisée.
                            @if($produit->image_url)
                                <br>Image actuelle: <a href="{{ Str::startsWith($produit->image_url, ['http://', 'https://']) ? $produit->image_url : asset($produit->image_url) }}" target="_blank" rel="noopener noreferrer">Voir l'image actuelle</a>
                            @endif
                        </small>
                    </div>

                    <div class="mb-4">
                        <label for="stand_id" class="form-label">Stand <span class="text-danger">*</span></label>
                        <select class="form-select form-control-lg @error('stand_id') is-invalid @enderror" id="stand_id" name="stand_id" required>
                            <option value="">Sélectionnez un stand</option>
                            @foreach($stands as $stand)
                                <option value="{{ $stand->id }}" {{ old('stand_id', $produit->stand_id) == $stand->id ? 'selected' : '' }}>
                                    {{ $stand->nom_stand }}
                                </option>
                            @endforeach
                        </select>
                        @error('stand_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between pt-3">
                        <a href="{{ route('produits.index') }}" class="btn btn-outline-secondary">Annuler</a>
                        <button type="submit" class="btn btn-danger">Mettre à jour le produit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const urlInput = document.getElementById('image_url');
        const fileInput = document.getElementById('image_file');

        // Logic to handle image inputs:
        // If user types in URL, clear file input.
        urlInput.addEventListener('input', function() {
            if (this.value) {
                fileInput.value = ''; // Clear file input if URL is being used
            }
        });

        // If user selects a file, clear URL input.
        fileInput.addEventListener('change', function() {
            if (this.value) {
                urlInput.value = ''; // Clear URL input if file is being uploaded
            }
        });
    });
</script>
@endsection

@section('styles')
<style>
    .card {
        background-color: #fff;
        border-radius: 1rem;
        box-shadow: 0 .25rem .75rem rgba(0,0,0,.1); /* Stronger shadow for main card */
    }
    .card-header {
        background-color: transparent;
        border-bottom: none;
        padding-bottom: 0;
    }
    .form-control-lg {
        height: calc(3.5rem + 2px);
        padding: 0.75rem 1.25rem;
        font-size: 1.25rem;
        border-radius: 0.5rem;
    }
    .form-control {
        border-radius: 0.5rem;
    }
    textarea.form-control {
        min-height: 100px;
    }
    .btn-danger {
        background-color: #e74c3c;
        border-color: #e74c3c;
        transition: all 0.3s ease;
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
        border-radius: 0.5rem;
    }
    .btn-danger:hover {
        background-color: #c0392b;
        border-color: #c0392b;
    }
    .btn-outline-secondary {
        border-color: #ced4da;
        color: #6c757d;
        transition: all 0.3s ease;
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
        border-radius: 0.5rem;
    }
    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: #fff;
    }
    /* Removed btn-link styling as per user request to remove 'switch' links */
    .form-label {
        font-weight: 600;
        color: #343a40;
    }
</style>
@endsection
