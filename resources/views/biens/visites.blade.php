@extends('admin.admin')

@section('title', 'Mes Visites')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-white">@yield('title')</h1>
    </div>

    @if(Auth::user()->role === 'agent')
        <div class="table-responsive">
            <h2 class="text-white">Visites où je suis client</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Bien</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Agent immobilier</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mesVisitesClient as $visite)
                        <tr>
                            <td>{{ $visite->titre }}</td>
                            <td>{{ $visite->date_visite }}</td>
                            <td>{{ $visite->heure_visite }}</td>
                            <td>{{ $visite->agent_immobilier }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="table-responsive">
            <h2 class="text-white">Visites de mes biens</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Bien</th>
                        <th>Date</th>
                        <th>Heure</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mesVisitesProprietaire as $visite)
                        <tr>
                            <td>{{ $visite->nom_prenom }}</td>
                            <td>{{ $visite->titre }}</td>
                            <td>{{ $visite->date_visite }}</td>
                            <td>{{ $visite->heure_visite }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="table-responsive">
            <h2 class="text-white">Visites où je suis agent immobilier</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Bien</th>
                        <th>Date</th>
                        <th>Heure</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mesVisitesAgent as $visite)
                        <tr>
                            <td>{{ $visite->nom_prenom }}</td>
                            <td>{{ $visite->titre }}</td>
                            <td>{{ $visite->date_visite }}</td>
                            <td>{{ $visite->heure_visite }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="table-responsive">
            <h2 class="text-white">Mes Visites</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Bien</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Agent immobilier</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mesVisites as $visite)
                        <tr>
                            <td>{{ $visite->titre }}</td>
                            <td>{{ $visite->date_visite }}</td>
                            <td>{{ $visite->heure_visite }}</td>
                            <td>{{ $visite->agent_immobilier }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="table-responsive">
            <h2 class="text-white">Visites de Mes Biens</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Bien</th>
                        <th>Date</th>
                        <th>Heure</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visitesDeMesBiens as $visite)
                        <tr>
                            <td>{{ $visite->nom_prenom }}</td>
                            <td>{{ $visite->titre }}</td>
                            <td>{{ $visite->date_visite }}</td>
                            <td>{{ $visite->heure_visite }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
