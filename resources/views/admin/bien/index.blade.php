@extends('admin.admin')

@section('title', 'Tous les biens')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-white" style="color: white">@yield('title')</h1>
        <a href="{{ route('admin.bien.create') }}" class=" btn-connexion" style="color: white">Ajouter un bien</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Type</th>
                    <th>Surface</th>
                    <th>Prix</th>
                    <th>Wilaya</th>
                    <th>Etat</th>
                    <th>Agent immobilier</th>
                    <th>Id propriétaire</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($biens as $bien)
                    <tr>
                        <td>{{ $bien->titre }}</td>
                        <td>{{ $bien->type }}</td>
                        <td>{{ $bien->surface }}m²</td>
                        <td>{{ number_format($bien->prix, 0, ',', ' ') }} DA</td>
                        <td>{{ $bien->wilaya }}</td>
                        <td>{{ $bien->etat }}</td>
                        <td>{{ $bien->agent_immobilier }}</td>
                        <td>{{ $bien->id_proprietaire}}</td>
                        <td>
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('admin.bien.edit', $bien) }}" class="btn btn-primary">Editer</a>
                                {{-- @can("delete", $bien) --}}
                                    <form action="{{ route('admin.bien.destroy', $bien) }}" method="POST">
                                        @csrf
                                        @method("delete")
                                        <button class="btn btn-danger">Supprimer</button>
                                    </form>
                                {{-- @endcan --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $biens->links() }}
    <script>
        // Assurez-vous que userRole est correctement initialisée avec le rôle de l'utilisateur
        const userRole = "{{ Auth::user()->role ?? '' }}";
    
        // Assurez-vous que les identifiants des éléments HTML correspondent
        const gestionBienLink = document.getElementById("gestion_bien");
        const gestionUserLink = document.getElementById("gestion_user");
    
        // Affichage des éléments de la navbar en fonction du rôle de l'utilisateur
        if (userRole === "admin") {
            gestionBienLink.style.display = "block";
            gestionUserLink.style.display = "block";
        } else if (userRole === "agence") {
            gestionUserLink.style.display = "none";
        } else if (userRole === "agent" || userRole === "client") {
            gestionBienLink.style.display = "none";
            gestionUserLink.style.display = "none";
        }
    </script>
@endsection
