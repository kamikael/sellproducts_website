@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 p-4" style="border-radius: 1rem;">
                <div class="text-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#e74c3c" viewBox="0 0 24 24" class="mb-3">
                        <path d="M12 2L1 8v8l11 6 11-6V8L12 2zm0 2.8L20 9v6l-8 4.4-8-4.4V9l8-4.2z"/>
                        <path d="M12 12l-5-2.5V15l5 2.5 5-2.5V9.5L12 12z"/>
                    </svg>
                    <h2 class="fw-bold text-danger">Connexion</h2>
                </div>

                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse email</label>
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Se souvenir de moi</label>
                    </div>

                    <button type="submit" class="btn btn-danger btn-lg w-100 fw-bold">Se connecter</button>
                </form>

                <div class="mt-4 text-center">
                    <a href="{{ route('register') }}" class="text-decoration-none text-muted">
                        <small>Pas encore de compte ? Passez une demande</small>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
