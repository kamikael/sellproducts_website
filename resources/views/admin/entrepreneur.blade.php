@extends('layouts.app')

@section('title', 'Dashboard - Admin')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Liste des utilisateurs</h1>

    @if($users->isEmpty())
        <div class="alert alert-warning">
            Aucun utilisateur trouvé.
        </div>
    @else
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Créé le</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @switch($user->role)
                            @case('admin')
                                <span class="badge bg-primary">Admin</span>
                                @break
                            @case('entrepreneur_approuve')
                                <span class="badge bg-success">Entrepreneur approuvé</span>
                                @break
                            @case('entrepreneur_en_attente')
                                <span class="badge bg-warning text-dark">En attente</span>
                                @break
                            @default
                                <span class="badge bg-secondary">Inconnu</span>
                        @endswitch
                    </td>
                    <td>
                        {{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'Non défini' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
