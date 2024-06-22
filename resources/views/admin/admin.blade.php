<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Administration</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
    
    <!-- Icons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
     
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ajouterannonce.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

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

    <div style="margin-top: 100px"></div>
    <div class="container mt-5">
        @if (session('success'))
            {{-- <div class="alert alert-success">
                {{ session('success') }}
            </div> --}}
        @endif
        @include('shared.flash')
        @yield('content')
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>

    {{-- <script>
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

        const toggle_menu = document.querySelector('.responsive-menu');
        const menu = document.querySelector('.menu');
        toggle_menu.onclick = function() {
            toggle_menu.classList.toggle('active');
            menu.classList.toggle('responsive');
        }
    </script> --}}
</body>

</html>
