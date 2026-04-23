@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="auth-raw-page min-vh-100 position-relative d-flex align-items-center" 
     style="background: linear-gradient(90deg, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 60%, rgba(0,0,0,0.2) 100%), url('{{ asset('storage/img/chef2.jpeg') }}') center/cover no-repeat fixed; margin-top: -5rem; padding-top: 5rem;">
    
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-5 col-md-8 offset-lg-1 animate-in">
                <!-- Branding/Icon -->
                <div class="mb-5">
                    <h1 class="display-1 fw-bold text-white mb-0 ls-tight">Bienvenue.</h1>
                    <p class="text-white-50 fs-5 ls-wide text-uppercase">L'expérience commence ici.</p>
                </div>

                @if($errors->any())
                    <div class="mb-4">
                        @foreach($errors->all() as $error)
                            <div class="text-danger small mb-1 ls-1 fw-bold">— {{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="mt-5">
                    @csrf

                    <div class="mb-5">
                        <label for="email" class="text-white small ls-wide text-uppercase d-block mb-3 opacity-50">Adresse Email</label>
                        <input type="email" class="form-control-ghost" 
                               id="email" name="email" value="{{ old('email') }}" placeholder="votre@email.com" required autofocus>
                    </div>

                    <div class="mb-5">
                        <label for="password" class="text-white small ls-wide text-uppercase d-block mb-3 opacity-50">Mot de Passe</label>
                        <input type="password" class="form-control-ghost" 
                               id="password" name="password" placeholder="••••••••" required>
                    </div>

                    <div class="d-flex align-items-center flex-wrap gap-5 mt-5">
                        <button type="submit" class="btn-ghost-action text-nowrap">
                            SE CONNECTER <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                        <a href="{{ route('register') }}" class="text-white-50 text-decoration-none small ls-1 hover-white text-nowrap">
                            NOUVEAU STAND ? S'INSCRIRE
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .ls-tight { letter-spacing: -3px; }
    .ls-wide { letter-spacing: 3px; }
    .ls-1 { letter-spacing: 1px; }
    
    .form-control-ghost {
        background: transparent !important;
        border: none !important;
        border-bottom: 2px solid rgba(255,255,255,0.1) !important;
        border-radius: 0 !important;
        color: white !important;
        font-size: 1.8rem !important;
        font-weight: 300 !important;
        padding: 5px 0 !important;
        width: 100%;
        outline: none !important;
        transition: all 0.5s ease;
        box-shadow: none !important;
    }
    
    .form-control-ghost::placeholder {
        color: rgba(255,255,255,0.05) !important;
    }

    .form-control-ghost:focus {
        border-bottom-color: white !important;
        padding-left: 10px !important;
        color: white !important;
    }

    .btn-ghost-action {
        background: none;
        border: none;
        color: white;
        font-size: 1.2rem;
        font-weight: 800;
        letter-spacing: 2px;
        padding: 0;
        position: relative;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .btn-ghost-action::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 30px;
        height: 2px;
        background: white;
        transition: all 0.3s ease;
    }

    .btn-ghost-action:hover {
        transform: translateX(5px);
    }
    
    .btn-ghost-action:hover::after {
        width: 100%;
    }

    .hover-white:hover {
        color: white !important;
    }

    .animate-in {
        animation: slideLeft 1.5s cubic-bezier(0.19, 1, 0.22, 1) forwards;
    }
    @keyframes slideLeft {
        from { opacity: 0; transform: translateX(-60px); }
        to { opacity: 1; transform: translateX(0); }
    }

    body { background: #000 !important; overflow-x: hidden; }
</style>
@endsection
