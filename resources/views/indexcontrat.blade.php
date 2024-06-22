@extends('admin.admin')

@section('title', 'Tous les contrats')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-white" style="color: white">@yield('title')</h1>
        {{-- <a href="#" class=" btn-connexion" style="color: white">Ajouter un contrat</a> --}}
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id contrat</th>
                    {{-- <th>Type contrat</th> --}}
                    <th>Nom Client</th>
                    <th>Nom Proprietaire</th>
                    <th>Bien</th>
                    <th>Type Bien</th>
                    <th>Date et heure</th>
                    <!-- Ajoutez d'autres en-têtes de colonnes selon vos besoins -->
                </tr>
            </thead>
            <tbody>
                @foreach ($contrats as $contrat)
                    <tr>
                        <td>{{ $contrat->id }}</td>
                        <td>{{ $contrat->nom_client }}</td>
                        <td>{{ $contrat->nom_proprietaire}}</td>
                        <td>{{ $contrat->titre}}</td>
                        <td>{{ $contrat->type}}</td>
                        <td>{{ $contrat->created_at }}</td>
                        <!-- Ajoutez d'autres colonnes selon vos besoins -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- {{ $contrats->links() }} --}}

@endsection
