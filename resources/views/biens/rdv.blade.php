<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prendre un rendez-vous</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
    <!-- lien des icons -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <!-- Inclure Bootstrap JavaScript depuis un CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Reset de styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background: linear-gradient(to right, #000000, #10b1d0);
        }
        /* Style général du formulaire */
        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }
        input[type="date"],
        input[type="time"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .date-disponible {
            background-color: green;
            color: white;
            cursor: pointer; /* Ajoutez cette ligne pour afficher un curseur cliquable */
        }
        .date-prise {
            background-color: red;
            color: white;
        }

        .date-non-disponible {
            background-color: gray;
            color: white;
        }

        .date-prise {
            background-color: gray;
            color: white;
        }

        /* Classe pour entourer les dates prises */
        .date-prise::before {
            content: '';
            position: absolute;
            width: 30px;
            height: 30px;
            border: 2px solid red;
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            box-sizing: border-box;
        }
    </style>
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
    <div class="container" style="margin-top: 100px">
        <h2>Prendre un rendez-vous pour visiter un bien immobilier</h2>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
       @endif
        <form action="{{ route('rdv.store') }}" method="POST"  onsubmit="return verifierDisponibilite()">
            @csrf
            <label for="id_client">Id client :</label>
            <input type="text" id="id_client" name="id_client" value="{{ Auth::id()}}" readonly>
            <label for="nom_prenom">Nom client :</label>
            <input type="text" id="nom_prenom" name="nom_prenom" value="{{ Auth::user()->name }} {{ Auth::user()->prenom }}" readonly>
            <label for="id_annonce">Id Bien immobilier :</label>
            <input type="text" id="id_annonce" name="id_annonce" value="{{ $bien->id }}" readonly>
            <label for="titre">Bien immobilier :</label>
            <input type="text" id="titre" name="titre" value="{{ $bien->titre }}" readonly>
            <label for="agent_immobilier">Agent immobilier :</label>
            <input type="text" id="agent_immobilier" name="agent_immobilier" value="{{ $bien->agent_immobilier }}" readonly>
            <label for="id_proprietaire">ID propriétaire :</label>
            <input type="text" id="id_proprietaire" name="id_proprietaire" value="{{ $bien->id_proprietaire }}" readonly>
            
            <label for="date_visite">Date :</label>
            <input type="date" id="date_visite" name="date_visite" required min="{{ date('Y-m-d') }}">
            <div id="calendrier" class="calendrier"></div> <!-- Ajoutez cette ligne pour afficher le calendrier -->

            <!-- Ajoutez des champs dynamiques pour les heures de visite -->
            <div id="heure_visite_container">
                <div class="heure_visite_input">
                    <label>Choisissez l'heure de la visite :</label>
                    <select name="heure_visite" class="heure_visite">
                        @foreach($horairesDisponibles as $horaire)
                            <option value="{{ $horaire }}">{{ $horaire }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
          
            
            <button type="submit">Confirmer le rendez-vous</button>
        </form>
    </div>
    {{-- <script>
        // JavaScript pour ajouter des champs dynamiques
        document.getElementById("ajouter_heure_visite").addEventListener("click", function() {
            var container = document.getElementById("heure_visite_container");
            var newInput = document.createElement("div");
            newInput.classList.add("heure_visite_input");
            newInput.innerHTML = `
                <label>Choisissez l'heure de la visite :</label>
                <select name="heure_visite[]" class="heure_visite">
                    @foreach($horairesDisponibles as $horaire)
                        <option value="{{ $horaire }}">{{ $horaire }}</option>
                    @endforeach
                </select>`;
            container.appendChild(newInput);
        });
    </script> --}}
    {{-- <script>
        // Dates déjà prises
        const datesPrises = {!! json_encode($datesPrises) !!}; // Récupérez les dates prises du contrôleur
        
        // Fonction pour marquer les dates prises sur le calendrier
        function marquerDatesPrises() {
            const calendrier = document.getElementById("calendrier");
            datesPrises.forEach(date => {
                const cellule = calendrier.querySelector(`.date[data-date="${date}"]`);
                if (cellule) {
                    cellule.classList.add('date-prise');
                }
            });
        }
        
        // Appelez cette fonction au chargement de la page
        window.addEventListener('load', marquerDatesPrises);
    </script> --}}
    {{-- <script>
        // Fonction pour marquer les dates non disponibles sur le calendrier
        function marquerDatesNonDisponibles() {
            const calendrier = document.getElementById("calendrier");
            datesNonDisponibles.forEach(date => {
                const cellule = calendrier.querySelector(`.date[data-date="${date}"]`);
                if (cellule) {
                    cellule.classList.add('date-non-disponible');
                }
            });
        }
    </script> --}}
    {{-- <script>
        function verifierDisponibiliteDate(dateChoisie) {
            // Vérifiez si la date choisie est dans le tableau des dates prises
            return datesPrises.includes(dateChoisie);
        }
    </script> --}}
    {{-- <script>
        function verifierDisponibilite() {
            const dateChoisie = document.getElementById("date_visite").value;
            if (verifierDisponibiliteDate(dateChoisie)) {
                // Affichez une boîte de dialogue en rouge pour indiquer que la date est déjà prise
                alert("Désolé, cette date est déjà prise pour ce bien immobilier, veuillez choisir une autre date!");
                return false; // Empêchez la soumission du formulaire
            }
            return true; // Permettez la soumission du formulaire si la date est disponible
        }
    </script> --}}
</body>
</html>
