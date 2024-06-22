<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | DreamHouse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
   
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
                    @if(Auth::check() && Auth::user()->role == 'admin')
                        <li class="nav-item"><a class="nav-link" style="color: white" href="{{ route('admin.bien.index') }}">Gestion biens</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: white" href="{{ route('admin.users.index') }}">Gestion utilisateurs</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: white" href="{{ route('indexcontrat') }}">Gestion Contrats</a></li>
                    @elseif(Auth::check() && Auth::user()->role == 'agence')
                        <li class="nav-item"><a class="nav-link" style="color: white" href="{{ route('indexcontrat') }}">Gestion Contrats</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link" style="color: white" href="/contact">Contact</a></li>
                </ul>
            </div>
            @if(Auth::check())
                <div class="d-flex align-items-center">
                    <form action="{{ route('logout') }}" method="POST" class="me-3">
                        @csrf
                        @method('delete')
                        <button class="btn-connexion" style="text-decoration: none;">Se déconnecter</button>
                    </form>
                    <li class="nav-item dropdown" style="list-style: none;">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../IMAGES/inconnu.png" width="30px" style="margin-right: 10px; border: none;">
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
    <body>
        
   

<div class="containerr1" id="containerr1" style=" margin: auto; margin-top: 80px; margin-bottom: 100px;">
    <div class="row">
        <div class="col-6">
            <div class="form-container1 sign-in">

            </div>
        </div>
        <div class="col-6">
            <div class="form-container1 sign-in">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h1 class="titre">Se Connecter</h1>
                    <div class="social-icons">
                        <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                        <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                        <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                    <span>Ou utiliser votre email pour s'authentifier</span>
                    <input type="email" placeholder="Email" name="email">
                    {{-- @include('shared.flash') --}}
                    <input type="password" placeholder="Mot de passe" name="password">
                    @include('shared.flash')
                    <div class="block mt-4" style="margin-right: 130px;">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" style=" width: 10px" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Se souvenir de moi') }}</span>
                        </label>
                    </div>
                    <button>Se connecter</button>
                    <!-- Remember Me -->
       

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('mot de passe oublié?') }}
                </a>
            @endif

        </div>
                </form>
            </div>
            <div class="toggle-container">
                <div class="toggle">
                
                    <div class="toggle-panel toggle-right titre" >
                        <h1 style="margin-top: 110px">soyez le bienvenue</h1>
                        <p>Connectez-vous avec vos informations personnelles pour utiliser toutes les fonctionnalités du site</p>
                        {{-- <a href="/signup"><button class="hidden" id="register">S'inscrire</button></a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('footer')
<script>
    const toggle_menu = document.querySelector('.responsive-menu');
    const menu = document.querySelector('.menu');
    toggle_menu.onclick = function () {
        toggle_menu.classList.toggle('active');
        menu.classList.toggle('responsive')
    }
</script>
<script>
    $(document).ready(function() {
        $('.carousel').carousel();
    });
</script>
</body>
</html>
