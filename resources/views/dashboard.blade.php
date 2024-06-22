<x-app-layout>
    <body>
        <header class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container-fluid" style="background-color: black; height: 70px;">
                <a class="navbar-brand" style="color: #10b1d0; margin-left: 20px;" href="/dashboard">
                    <span style="color: white">Dream</span>-House
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" style="color: white" href="/dashboard">Accueil</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: white" href="{{ route('biens.annonce') }}">Annonces</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: white" href="{{ route('agents.agent') }}">Agents immobiliers</a></li>
                        @if(Auth::check())
                            @if(Auth::user()->role == 'admin')
                                <li class="nav-item"><a class="nav-link" style="color: white" href="{{ route('admin.bien.index') }}">Gestion biens</a></li>
                                <li class="nav-item"><a class="nav-link" style="color: white" href="{{ route('admin.users.index') }}">Gestion utilisateurs</a></li>
                                <li class="nav-item"><a class="nav-link" style="color: white" href="{{ route('indexcontrat') }}">Gestion Contrats</a></li>
                            @elseif(Auth::user()->role == 'agence')
                                <li class="nav-item"><a class="nav-link" style="color: white" href="{{ route('indexcontrat') }}">Gestion Contrats</a></li>
                            @endif
                            <li class="nav-item"><a class="nav-link" style="color: white" href="/visites">Visites</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: white" href="/contact">Contact</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link" style="color: white" href="/contact">Contact</a></li>
                        @endif
                    </ul>
                </div>
                @if(Auth::check())
                    <div class="d-flex align-items-center">
                        <form action="{{ route('logout') }}" method="POST" class="me-3">
                            @csrf
                            @method('delete')
                            <button class="btn-connexion" style="text-decoration: none;">Se déconnecter</button>
                        </form>
                        <li class="nav-item dropdown" style="list-style: none; margin-left: -8px;">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if (Auth::user()->image_user)
                                    <img src="../images/{{Auth::user()->image_user}}" alt="{{ Auth::user()->name }}" width="50px" style="margin-right: 10px; border: none; border-radius: 40px">
                                @else
                                    <img src="{{ asset('images/inconnu.png') }}" width="30px" style="margin-right: 10px; border: none;">
                                @endif
                                <p style="color: white; display: inline;">{{ Auth::user()->name }}</p>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                            </ul>
                        </li>
                    </div>
                @else
                    <a class="btn-connexion" href="/login">Connexion</a>
                @endif
            </div>
        </header>

        <!-- Accueil section -->
        <section id="home" style="width: 100%; margin-top: 70px;">
            <h2 style="color: white;">Nous suivre</h2>
            <h4>Choisissez vos biens en Sécurité</h4>
            <p>Découvrez l'élégance de l'immobilier avec notre Agence: </p>
            <p>Où chaque maison raconte une histoire, chaque propriété une promesse.</p>
            <a href="#annonce-recente" class="btn-connexion home-btn">Acheter, Louer Maintenant</a>
            {{-- <div class="find_trip">
                <form action="">
                    <div>
                        <label>Type:</label>
                        <input type="text" placeholder="Entrez un type">
                    </div>
                    <div>
                        <label>Wilaya</label>
                        <input type="text" placeholder="Entrez une wilaya">
                    </div>
                    <div>
                        <label>Ville</label>
                        <input type="text" placeholder="Entrez une ville">
                    </div>
                    <div>
                        <label>Prix Max</label>
                        <input type="text" placeholder="Entrez le prix max">
                    </div>
                    <div>
                        <label>Prix Min</label>
                        <input type="text" placeholder="Entrez le prix min">
                    </div>
                    <input type="submit" value="Rechercher">
                </form>
            </div> --}}
        </section>

        <!-- Section annonces -->
        <section id="annonce-recente" style="margin-top: 100px">
            <h1 class="title">Annonces récentes</h1>
            <div class="content">
                @foreach ($bien as $bien)
                    @include('biens.card')
                @endforeach
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="divbtn">
                        <a href="/biens.annonce" class="buttonn">
                            <div class="button__line"></div>
                            <div class="button__line"></div>
                            <span class="button__text"><b>Voir Plus</b></span>
                            <div class="button__drow1"></div>
                            <div class="button__drow2"></div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section agents -->
        <section id="agent-immobilier">
            <h1 class="title">Agents immobiliers</h1>
            <div class="content">
                @foreach ($utilisateur as $utilisateur)
                    @if ($utilisateur->hasRole('agent'))
                        @include('agents.card', ['utilisateur' => $utilisateur])
                    @endif
                @endforeach
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="divbtn">
                        <a href="/agents.agent" class="buttonn">
                            <div class="button__line"></div>
                            <div class="button__line"></div>
                            <span class="button__text"><b>Voir Plus</b></span>
                            <div class="button__drow1"></div>
                            <div class="button__drow2"></div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pied de la page -->
        <section class="container-fluid bx">
            <div class="row">
                <div class="col-12 col-md-7">
                    <div class="box1">
                        <h3>A Propos de Nous</h3>
                        <p style="width: 100%">Notre site immobilier propose une sélection de biens immobiliers de qualité,
                            adaptés aux besoins et aux préférences de nos clients. Notre équipe d'experts
                            immobiliers est à votre disposition pour vous guider dans le processus d'achat ou de vente,
                            en offrant un service professionnel et de qualité supérieure. Nous nous engageons à maintenir
                            les normes les plus élevées en matière de service à la clientèle, de professionnalisme et
                            d'intégrité.
                            Nous sommes fiers de notre engagement envers l'excellence et espérons vous aider à réaliser vos
                            rêves
                            immobiliers.</p>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="box2">
                        <h3 style="text-align: center; color: white">Réseaux Sociaux</h3>
                        <div class="text-center">
                            <a href="#"> <i class="fab fa-facebook-f" style=" color: white"></i></a>
                            <a href="#"> <i class="fab fa-instagram" style=" color: white"></i></a>
                            <a href="#"> <i class="fab fa-linkedin" style=" color: white"></i></a>
                            <a href="#"> <i class="fab fa-twitter" style=" color: white"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container mt-5">
            @if (session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            @include('shared.flash')
            @yield('content')
        </div>
        
        @include('footer')
    </body>
</x-app-layout>
