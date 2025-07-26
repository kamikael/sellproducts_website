@extends('layouts.app')

@section('title', 'Statut en attente')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5 text-center">
                    <div class="status-icon mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#f39c12" viewBox="0 0 16 16">
                            <path d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zm0 13V2a6 6 0 1 1 0 12z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3.5a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4z"/>
                        </svg>
                    </div>
                    <h2 class="fw-bold mb-3 text-warning">Demande en attente de validation</h2>
                    <div class="status-message mb-4">
                        <p class="lead mb-3">Votre demande a bien été prise en compte.</p>
                        <p class="text-muted">Un administrateur va examiner votre demande sous peu. Vous recevrez une notification par email dès que votre compte sera validé.</p>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="/" class="btn btn-danger px-4">
                            <i class="bi bi-house-door me-2"></i> Retour à l'accueil
                        </a>
                        <a href="mailto:{{ config('mail.contact_email') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-envelope me-2"></i> Nous contacter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 15px;
        overflow: hidden;
    }

    .status-icon {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .status-message {
        max-width: 500px;
        margin: 0 auto;
    }

    .btn-danger {
        background-color: #e74c3c;
        border-color: #e74c3c;
    }
</style>
@endsection
