@extends('layouts.app')

@section('title', 'Statut en attente')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h1 class="mb-4 text-warning"><i class="bi bi-hourglass-split"></i> Demande en attente...</h1>
                    <p class="lead mb-3">Votre demande a bien été prise en compte.</p>
                    <p class="mb-4">Un administrateur va examiner votre demande. Vous recevrez un email dès que votre compte sera validé.<br>
                    Merci de votre patience !</p>
                    <a href="/" class="btn btn-primary">Retour à l'accueil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
