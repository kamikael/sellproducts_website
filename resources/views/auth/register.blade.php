@extends('layouts.app')

@section('title', 'Demande de Stand')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow-sm border-0 p-4">
                <h2 class="mb-4 text-center text-primary">Demande de Stand</h2>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom de l'entreprise</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <div class="mb-3">
                        <label for="nom_stand" class="form-label">Nom du stand</label>
                        <input type="text" name="nom_stand" id="nom_stand" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description_stand" class="form-label">Description du stand</label>
                        <textarea name="description_stand" id="description_stand" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Demander</button>
                </form>
                <div class="mt-3 text-center">
                    <a href="{{ route('login') }}">Déjà une demande approuvée ? Se connecter</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
