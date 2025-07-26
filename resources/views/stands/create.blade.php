@extends('layouts.app')

@section('title', 'Créer un nouveau stand')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-white border-0 py-4">
                    <div class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#e74c3c" viewBox="0 0 24 24" class="me-3">
                            <path d="M12 2L1 8v8l11 6 11-6V8L12 2zm0 2.8L20 9v6l-8 4.4-8-4.4V9l8-4.2z"/>
                            <path d="M12 12l-5-2.5V15l5 2.5 5-2.5V9.5L12 12z"/>
                        </svg>
                        <h3 class="fw-bold mb-0">Créer un nouveau stand</h3>
                    </div>
                </div>
                <div class="card-body px-5 py-4">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <strong>Veuillez corriger les erreurs suivantes :</strong>
                            <ul class="mt-2 mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('stands.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nom_stand" class="form-label fw-semibold">Nom du stand <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg"
                                   id="nom_stand" name="nom_stand"
                                   value="{{ old('nom_stand') }}"
                                   placeholder="Ex: Boulangerie du coin" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea class="form-control" id="description"
                                      name="description" rows="4"
                                      placeholder="Décrivez votre stand en quelques mots...">{{ old('description') }}</textarea>
                            <div class="form-text">Cette description apparaîtra dans la vitrine.</div>
                        </div>

                        <div class="d-flex justify-content-between pt-3">
                            <a href="{{ route('stands.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-arrow-left me-1"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-danger px-4">
                                <i class="bi bi-check-circle me-1"></i> Créer le stand
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 12px;
        overflow: hidden;
    }

    .form-control-lg {
        padding: 12px 16px;
        border-radius: 8px;
    }

    textarea.form-control {
        min-height: 120px;
    }

    .btn {
        border-radius: 8px;
        padding: 10px 20px;
    }

    .card-header {
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
</style>
@endsection
