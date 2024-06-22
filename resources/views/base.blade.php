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

        <main style="margin-top: 100px;">
            @yield('content')
        </main>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const userRole = "{{ Auth::user()->role ?? '' }}";
            
                const gestionBienLink = document.getElementById("gestion_bien");
                const gestionUserLink = document.getElementById("gestion_user");
                const gestionContratLink = document.getElementById("gestion_contrat");
            
                if (userRole === "admin") {
                    gestionBienLink.style.display = "block";
                    gestionUserLink.style.display = "block";
                    gestionContratLink.style.display = "block";
                } else if (userRole === "agence") {
                    gestionUserLink.style.display = "none";
                    gestionContratLink.style.display = "block";
                } else if (userRole === "agent" || userRole === "client") {
                    gestionBienLink.style.display = "none";
                    gestionUserLink.style.display = "none";
                    gestionContratLink.style.display = "none";
                }
            });
        </script>

        @include('footer')
    </body>
</x-app-layout>
