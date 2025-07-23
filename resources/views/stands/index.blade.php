@extends('layouts.app')

@section('title', 'Mes Stands')

@section('content')
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
