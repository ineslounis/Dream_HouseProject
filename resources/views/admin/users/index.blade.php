@extends('admin.admin')

@section('title', 'Tous les Utilisateurs')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 style="color: white">@yield('title')</h1>
                <a href="{{ route('admin.users.create') }}" class="btn-connexion" style="color: white">Ajouter un utilisateur</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Numéro de téléphone</th>
                            <th>Adresse</th>
                            <th>Rôle</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($utilisateur as $utilisateur)
                        <tr>
                            <td>{{ $utilisateur->id }}</td>
                            <td>{{ $utilisateur->name }}</td>
                            <td>{{ $utilisateur->prenom }}</td>
                            <td>{{ $utilisateur->email }}</td>
                            <td>{{ $utilisateur->tel }}</td>
                            <td>{{ $utilisateur->adresse }}</td>
                            <td>{{ $utilisateur->role }}</td>
                            <td>
                                <div class="d-flex gap-2 justify-content-end">
                                    {{-- <a href="{{ route('admin.users.edit', $utilisateur) }}" class="btn btn-primary">Modifier</a> --}}
                                    <form action="{{ route('admin.users.destroy', $utilisateur) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-danger">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $utilisateur->links() }} --}}
            </div>
        </div>
    </div>
</div>
@endsection
