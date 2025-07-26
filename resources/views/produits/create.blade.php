@extends('layouts.app')

@section('title', 'Ajouter un produit')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6"> {{-- Adjusted column size for better aesthetics --}}
            <div class="card shadow-lg border-0 p-4" style="border-radius: 1rem;"> {{-- Added shadow, no border, increased padding --}}
                <div class="text-center mb-4"> {{-- Centered header content --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#e74c3c" viewBox="0 0 24 24" class="mb-3">
                        <path d="M12 2L1 8v8l11 6 11-6V8L12 2zm0 2.8L20 9v6l-8 4.4-8-4.4V9l8-4.2z"/>
                        <path d="M12 12l-5-2.5V15l5 2.5 5-2.5V9.5L12 12z"/>
                    </svg>
                    <h2 class="fw-bold text-danger">Ajouter un Nouveau Produit</h2> {{-- Bold and danger color for title --}}
                </div>

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert"> {{-- Added dismissible alert --}}
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom du produit <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required> {{-- Added form-control-lg and error handling --}}
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea> {{-- Adjusted rows and error handling --}}
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="prix" class="form-label">Prix (€) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control form-control-lg @error('prix') is-invalid @enderror" id="prix" name="prix" step="0.01" min="0" value="{{ old('prix') }}" required> {{-- Added form-control-lg and error handling --}}
                        @error('prix')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image_url" class="form-label">URL de l'image</label>
                        <input type="url" class="form-control @error('image_url') is-invalid @enderror" id="image_url" name="image_url" value="{{ old('image_url') }}"> {{-- Added error handling --}}
                        @error('image_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image_file" class="form-label">Ou téléversez une image</label>
                        <input type="file" class="form-control @error('image_file') is-invalid @enderror" id="image_file" name="image_file" accept="image/*"> {{-- Added error handling --}}
                        @error('image_file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4"> {{-- Increased bottom margin --}}
                        <label for="stand_id" class="form-label">Stand <span class="text-danger">*</span></label>
                        <select class="form-select form-control-lg @error('stand_id') is-invalid @enderror" id="stand_id" name="stand_id" required> {{-- Added form-control-lg and error handling --}}
                            <option value="">Sélectionnez un stand</option>
                            @foreach($stands as $stand)
                                <option value="{{ $stand->id }}" {{ old('stand_id') == $stand->id ? 'selected' : '' }}>
                                    {{ $stand->nom_stand }}
                                </option>
                            @endforeach
                        </select>
                        @error('stand_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between pt-3"> {{-- Added top padding --}}
                        <a href="{{ route('produits.index') }}" class="btn btn-outline-secondary">Annuler</a>
                        <button type="submit" class="btn btn-danger">Créer le produit</button> {{-- Changed to btn-danger for consistency --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const imageUrlInput = document.getElementById('image_url');
    const imageFileInput = document.getElementById('image_file');
    imageUrlInput.addEventListener('input', function() {
        imageFileInput.disabled = !!this.value;
    });
    imageFileInput.addEventListener('change', function() {
        imageUrlInput.disabled = !!this.value;
    });
</script>
@endsection

---

@section('styles')
<style>
    /* Styles for the card container */
    .card {
        background-color: #fff;
        border-radius: 1rem; /* Rounded corners for consistency */
    }

    /* Styles for form controls */
    .form-control-lg {
        height: calc(3.5rem + 2px); /* Taller input fields */
        padding: 0.75rem 1.25rem;
        font-size: 1.25rem;
        border-radius: 0.5rem; /* Slightly rounded corners for inputs */
    }
    .form-control {
        border-radius: 0.5rem; /* Consistent border radius */
    }
    textarea.form-control {
        min-height: 100px; /* Minimum height for text areas */
    }

    /* Styles for buttons */
    .btn-danger {
        background-color: #e74c3c; /* Consistent brand red */
        border-color: #e74c3c;
        transition: all 0.3s ease; /* Smooth transition on hover */
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
        border-radius: 0.5rem; /* Rounded corners for buttons */
    }
    .btn-danger:hover {
        background-color: #c0392b; /* Darker red on hover */
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
    .btn-link {
        font-size: 0.9rem;
        color: #e74c3c; /* Consistent link color */
    }
    .btn-link:hover {
        color: #c0392b;
        text-decoration: underline;
    }

    /* Styles for form labels */
    .form-label {
        font-weight: 600; /* Bolder labels */
        color: #343a40; /* Darker text for labels */
    }
</style>
@endsection
