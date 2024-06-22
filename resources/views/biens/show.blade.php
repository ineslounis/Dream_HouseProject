@extends('base')

@section('title', $bien->title)

@section('content')
<div class="container" style="background-color: white;">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <img src="../images/{{$bien->image}}" alt="" class="img-fluid" style="width: 100%;margin-top: 55px;">
            </div>
            <div class="col-md-6 mt-4 mt-md-0" style="margin-bottom: 40px">
                <h1 class="titres text-center" style="margin-top: 90px; font-size: 2rem;">{{ $bien->titre }}</h1>
                <h2 class="titres" style="font-size: 2rem;">{{ $bien->nombre_chambre }} Chambres - {{ $bien->surface }} m²</h2>
                <div class="fw-bold text-center" style="font-size: 3rem; color: #10b1d0">
                    {{ number_format($bien->prix, 0, ',', ' ') }} DA
                </div>
                <hr>
                <div class="mt-4">
                    <h4 class="text-center">{{ __('Intéressé par ce bien :title ?', ['title' => $bien->title]) }}</h4>
                    <h4 class="text-center">Proposez vos offres</h4>
                    @include('shared.flash')

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('biens.contact', $bien) }}" method="POST" class="vstack gap-3">
                        @csrf
                        <div class="row">
                            @auth
                                @include('shared.input', ['class' => 'col', 'name' => 'firstname', 'label' => 'Prénom', 'value' => Auth::user()->prenom])
                                @include('shared.input', ['class' => 'col', 'name' => 'lastname', 'label' => 'Nom', 'value' => Auth::user()->name])
                            @else
                                @include('shared.input', ['class' => 'col', 'name' => 'firstname', 'label' => 'Prénom'])
                                @include('shared.input', ['class' => 'col', 'name' => 'lastname', 'label' => 'Nom'])
                            @endauth
                        </div>
                        <div class="row">
                            @auth
                                @include('shared.input', ['class' => 'col', 'name' => 'phone', 'label' => 'Téléphone', 'value' => Auth::user()->tel])
                                @include('shared.input', ['type' => 'email', 'class' => 'col', 'name' => 'email', 'label' => 'Email', 'value' => Auth::user()->email])
                            @else
                                @include('shared.input', ['class' => 'col', 'name' => 'phone', 'label' => 'Téléphone'])
                                @include('shared.input', ['type' => 'email', 'class' => 'col', 'name' => 'email', 'label' => 'Email'])
                            @endauth
                        </div>
                        @include('shared.input', ['type' => 'text', 'class' => 'col', 'name' => 'message', 'label' => 'Votre offre'])

                        <input type="hidden" name="annonce_id" value="{{ $bien->id }}">
                        <input type="hidden" name="annonce_titre" value="{{ $bien->titre }}">

                        <div class="text-center">
                            <button class="btn btn-primary text-white" name="contact">Nous contacter</button>
                        </div>
                    </form>
                </div>
                @auth
                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'agence')
                    @if($offre_max)
                        <div class="alert alert-info mt-4">
                            <strong>Offre maximale actuelle :</strong> {{ number_format($offre_max->message, 0, ',', ' ') }} DA
                            <br>
                            <strong>Proposée par :</strong> {{ $offre_max->firstname }} {{ $offre_max->lastname }}
                            <br>
                            <strong>Contact :</strong> {{ $offre_max->phone }} | {{ $offre_max->email }}
                        </div>
                    @else
                        <div class="alert alert-info mt-4">
                            Aucune offre n'a été proposée pour le moment.
                        </div>
                    @endif
                @endif
            @endauth
            
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <div id="carousel" class="carousel slide" data-bs-ride="carousel" style="margin-bottom: 40px">
                    <div class="carousel-inner">
                        @foreach (json_decode($bien->imgs, true) as $key => $img)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <img src="{{ asset('images/' . $img) }}" class="d-block w-100" alt="Image {{ $key }}">
                        </div>
                    @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-6 mt-4 mt-md-0">
                <div class="col-8">
                    <h2 class="titre">Caractéristiques</h2>
                    <table class="table table-striped">
                        <tr>
                            <td>id</td>
                            <td>{{ $bien->id }} </td>
                        </tr>
                        <tr>
                            <td>Type</td>
                            <td>{{ $bien->type }} </td>
                        </tr>
                        <tr>
                            <td>Transaction</td>
                            <td>{{ $bien->transaction }} </td>
                        </tr>
                        <tr>
                            <td>Surface habitable</td>
                            <td>{{ $bien->surface }} m²</td>
                        </tr>
                        @if($bien->type === 'Appartement')
                        <tr>
                            <td>Numero Etage</td>
                            <td>{{ $bien->numero_etage }}</td>
                        </tr>
                        @endif
                        @if($bien->nombre_chambre)
                        <tr>
                            <td>Chambres</td>
                            <td>{{ $bien->nombre_chambre}} Chambres</td>
                        </tr>
                        @endif
                        @if($bien->nombre_etages)
                        <tr>
                            <td>Etages</td>
                            <td>{{ $bien->nombre_etages}} Etages</td>
                        </tr>
                        @endif
                        <tr>
                            <td>Localisation</td>
                            <td>
                                {{ $bien->adresse }}<br>
                                {{ $bien->wilaya }}
                            </td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{{ $bien->description }}</td>
                        </tr>
                    </table>
                </div>
                @auth
                    <div class="btn-connexion text-center" >
                        <a href="{{ route('rdv.showForm', $bien) }}"  name="visite" id="visite" style="background-color: #10b1d0; color: white">Rendez-vous</a>
                    </div>
                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'agence')
                        <div class="btn-connexion text-center" style="margin-top: 20px">
                            <a href="{{ route('contrat.create', $bien) }}" style="background-color: #10b1d0; color: white" name="contrat" id="contrat">Générer Contrat</a>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
