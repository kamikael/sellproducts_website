@extends('layouts.app')

@section('title', 'Créer un nouveau stand')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Créer un nouveau stand</h3>
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

                    <form action="{{ route('stands.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nom_stand" class="form-label">Nom du stand *</label>
                            <input type="text" class="form-control" id="nom_stand" name="nom_stand" value="{{ old('nom_stand') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('stands.index') }}" class="btn btn-secondary">Annuler</a>
                            <button type="submit" class="btn btn-primary">Créer le stand</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
