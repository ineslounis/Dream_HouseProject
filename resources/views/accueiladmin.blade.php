<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
     <!-- lien des icons -->
     <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>

    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ajouterannonce.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    
    {{-- <link rel="stylesheet" href="{{asset('css/signup.css')}}">  --}}
    {{-- <style>
        @layer reset {
            button {
                all: unset;
            }
        }

        .htmx-indicator {
            display: none;
        }

        .htmx-request .htmx-indicator {
            display: inline-block;
        }

        .htmx-request.htmx-indicator {
            display: inline-block;
        }
    </style> --}}
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
     <!-- acceuil section -->
    
     <section id="home" style="width: 100%">
        <h2 style="color: white;">Nous suivre</h2>
        <h4>Choisissez vos biens en Sécurité</h4>
        <p>Découvrez l'élégance de l'immobilier avec notre Agence: </p>
        <p>Où chaque maison raconte une histoire, chaque propriété une promesse.</p>
        <a href="#annonce-recente" class="btn-connexion home-btn">Acheter, Louer Maintenant</a>
        <div class="find_trip">
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
                    <label>prix Min</label>
                    <input type="text" placeholder="Entrez le prix min">
                </div>

                <input type="submit" value="rechercher">
            </form>
        </div>
    </section>

    <!-- section annonces -->
    <section id="annonce-recente" style="margin-top: 100px">
        <h1 class="title">Annonces recentes</h1>
        <div class="content">
          @foreach ($biens as $bien)
              @include('biens.card')
          @endforeach
            
           
        </div>
        <div class="row">
            <div class="col-12">
                <div class="divbtn">
                    <a href="/biens.annonce" class="buttonn">
                        <div class="button__line"></div>
                        <div class="button__line"></div>
                        <span class="button__text"><b> Voir Plus</b></span>
                        <div class="button__drow1"></div>
                        <div class="button__drow2"></div>
                    </a>
                </div>
            </div>
    </section>

    <!-- section agents -->
    <section id="agent-immobilier">
        <h1 class="title">Agents immobiliers</h1>
        <div class="content">
            <!-- box -->
            <div class="box">
                <img src="../IMAGES/agent1.jpg" alt="">
                <div class="content">
                    <div>
                        <p><b>Nom:</b>Lounis</p>
                        <p><b>Prenom:</b>Ines </p>
                        <p><b>email:</b>lounisines@gmail.com</p>
                        <p><b>tel:</b>0551233475</p>
                        <br>
                        <a href="#">Choisir</a>
                    </div>
                </div>
            </div>
            <!-- box -->
            <div class="box">
                <img src="../IMAGES/agent4.jpg" alt="">
                <div class="content">
                    <div>
                        <p><b>Nom:</b>Lounis</p>
                        <p><b>Prenom:</b>hamid </p>
                        <p><b>email:</b>lounishamid@gmail.com</p>
                        <p><b>tel:</b>0551233473</p>
                        <br>
                        <a href="#">Choisir</a>
                    </div>
                </div>
            </div>
            <!-- box -->
            <div class="box">
                <img src="../IMAGES/agent2.jpg" alt="">
                <div class="content">
                    <div>
                        <div>
                            <p><b>Nom:</b>Lounis</p>
                            <p><b>Prenom:</b>lydia </p>
                            <p><b>email:</b>lounislydia@gmail.com</p>
                            <p><b>tel:</b>0551233471</p>
                            <br>
                            <a href="#">Choisir</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- box -->
            <div class="box">
                <img src="../IMAGES/agent5.webp" alt="">
                <div class="content">
                    <div>
                        <p><b>Nom:</b>Lounis</p>
                        <p><b>Prenom:</b>Lyes </p>
                        <p><b>email:</b>lounisllyes@gmail.com</p>
                        <p><b>tel:</b>0551233472</p>
                        <br>
                        <a href="#">Choisir</a>
                    </div>
                </div>
            </div>
            <!-- box -->
            <div class="box">
                <img src="../IMAGES/agent3.jpg" alt="">
                <div class="content">
                    <div>
                        <p><b>Nom:</b>Meddour</p>
                        <p><b>Prenom:</b>hadia</p>
                        <p><b>email:</b>meddourhadia@gmail.com</p>
                        <p><b>tel:</b>0551233477</p>
                        <br>
                        <a href="#">Choisir</a>
                    </div>
                </div>
            </div>
            <!-- box -->
            <div class="box">
                <img src="../IMAGES/agent6.webp" alt="">
                <div class="content">
                    <div>
                        <p><b>Nom:</b>Fenzi</p>
                        <p><b>Prenom:</b>Sami </p>
                        <p><b>email:</b>fenzisami@gmail.com</p>
                        <p><b>tel:</b>0551233479</p>
                        <br>
                        <a href="#">Choisir</a>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <!--  contact section -->
    <section id="contact">
        <h1 class="title">Contact</h1>
        <form action="">
            <div class="left-right">
                <div class="left">
                    <label>Nom Complet</label>
                    <input type="text">
                    <label>Objet</label>
                    <input type="text">
                    <label>Email</label>
                    <input type="text">
                    <label>Message</label>
                    <textarea name="" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="right">
                    <label>Numéro</label>
                    <input type="text">
                    <label>Date</label>
                    <input type="text">
                    <label>Autres Details</label>
                    <input type="text">
                    <label>Adresse</label>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3197.041069612092!2d5.045256975019456!3d36.74558527077767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x128d334678ff230b%3A0x2c7cd69ba96c8386!2sEURL%20BEINX%20ALGERIE!5e0!3m2!1sfr!2sfr!4v1710253727428!5m2!1sfr!2sfr"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <button>Envoyer</button>
        </form>
    </section>
    <!-- pied de la page -->
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
                    <h3 style="text-align: center;">Réseaux Sociaux</h3>
                    <div class="text-center">
                        <a href="#"> <i class="fab fa-facebook-f"></i></a>
                        <a href="#"> <i class="fab fa-instagram"></i></a>
                        <a href="#"> <i class="fab fa-linkedin"></i></a>
                        <a href="#"> <i class="fab fa-twitter"></i></a>
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
    {{-- <script>
        new TomSelect('select[multiple]', {plugins: {remove_button: {title: 'Supprimer'}}})
    </script> --}}
    @include('footer')
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
</body>

</html>

   

