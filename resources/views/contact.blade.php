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
         
        <section id="contact">
            <h1 class="title">Contact</h1>
            <form action="{{ route('envoyer.email') }}" method="POST">
                @csrf
                <div class="left-right">
                    <div class="left">
                        <label for="nom">Nom Complet</label>
                        <input type="text" name="nom" id="nom">
                        <label for="objet">Objet</label>
                        <input type="text" name="objet" id="objet">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" cols="30" rows="10"></textarea>
                    </div>
                    <div class="right">
                        <label for="numero">Numéro</label>
                        <input type="text" name="numero" id="numero">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date">
                        <label for="detail">Autres Détails</label>
                        <input type="text" name="detail" id="detail">
                        <label for="adresse">Adresse</label>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3197.041069612092!2d5.045256975019456!3d36.74558527077767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x128d334678ff230b%3A0x2c7cd69ba96c8386!2sEURL%20BEINX%20ALGERIE!5e0!3m2!1sfr!2sfr!4v1710253727428!5m2!1sfr!2sfr"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <button type="submit" name="envoyer" id="envoyer">Envoyer</button>
            </form>
        </section>
        
   
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

        <script>
            const toggle_menu = document.querySelector('.responsive-menu');
            const menu = document.querySelector('.menu');
            toggle_menu.onclick = function () {
                toggle_menu.classList.toggle('active');
                menu.classList.toggle('responsive')
            }
        </script>

        @include('footer')
    </body>
</x-app-layout>
