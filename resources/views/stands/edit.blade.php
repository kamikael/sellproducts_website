@extends('layouts.app')

@section('title', 'Modifier le stand')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Modifier le stand</h3>
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

                    <form action="{{ route('stands.update', $stand) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nom_stand" class="form-label">Nom du stand *</label>
                            <input type="text" class="form-control" id="nom_stand" name="nom_stand" value="{{ old('nom_stand', $stand->nom_stand) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $stand->description) }}</textarea>
                            <div class="form-text">Décrivez votre stand, vos spécialités, etc.</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('stands.index') }}" class="btn btn-secondary">Annuler</a>
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
