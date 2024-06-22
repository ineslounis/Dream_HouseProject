<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrat de location ou de vente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .section {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        .section h2, h1 {
            color: #10b1d0;
        }
        .details {
            margin-top: 10px;
        }
        .details label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .details input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #10b1d0;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .alert {
            padding: 20px;
            background-color: #4CAF50;
            color: white;
            margin-bottom: 15px;
        }
        /* .signature-placeholder {
            border-top: 1px solid #000;
            margin-top: 30px;
            padding-top: 5px;
            width: 45%;
            float: left;
            text-align: center;
        } */
        .signature-placeholder.right {
            float: right;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        @media print {
            .btn {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Contrat de {{ $bien->transaction }}</h1>
        
        <!-- Message de succès -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contrat.store', ['bien' => $bien->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="bien_id" value="{{ $bien->id }}">

            <!-- Section Propriétaire -->
            <div class="section">
                <h2>Informations du propriétaire</h2>
                <div class="details">
                    <label for="nom_proprietaire">Nom :</label>
                    <input type="text" id="nom_proprietaire" name="nom_proprietaire" value="{{ $bien->proprietaire->name }}" readonly>
                    
                    <label for="prenom_proprietaire">Prénom :</label>
                    <input type="text" id="prenom_proprietaire" name="prenom_proprietaire" value="{{ $bien->proprietaire->prenom }}" readonly>
                    
                    <label for="adresse_proprietaire">Adresse :</label>
                    <input type="text" id="adresse_proprietaire" name="adresse_proprietaire" value="{{ $bien->proprietaire->adresse }}" readonly>
                    
                    <label for="email_proprietaire">Email :</label>
                    <input type="email" id="email_proprietaire" name="email_proprietaire" value="{{ $bien->proprietaire->email }}" readonly>
                </div>
            </div>

            <!-- Section Annonce -->
            <div class="section">
                <h2>Informations de l'annonce</h2>
                <div class="details">
                    <label for="titre">Titre :</label>
                    <input type="text" id="titre" name="titre" value="{{ $bien->titre }}" readonly>
                    
                    <label for="type">Type :</label>
                    <input type="text" id="type" name="type" value="{{ $bien->type }}" readonly>
                    
                    <label for="adresse_bien">Adresse du bien :</label>
                    <input type="text" id="adresse_bien" name="adresse_bien" value="{{ $bien->adresse }}" readonly>
                    
                    <label for="description">Description :</label>
                    <input type="text" id="description" name="description" value="{{ $bien->description }}" readonly>
                </div>
            </div>

            <!-- Section Client -->
            <div class="section">
                <h2>Informations du client</h2>
                <div class="details">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom_client">
                    
                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom_client">
                    
                    <label for="adresse">Adresse :</label>
                    <input type="text" id="adresse" name="adresse_client">
                    
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email_client">
                </div>
            </div>

            <!-- Section Contrat -->
            <div class="section">
                <h2>Informations du contrat</h2>
                <div class="details">
                    @if($bien->transaction === 'Location')
            <label for="duree_location">Durée de location (mois) :</label>
            <input type="number" id="duree_location" name="duree_location" value="{{ old('duree_location') }}">
        @endif

                    <label for="prix_initial">Prix initial :</label>
                    <input type="text" id="prix_initial" name="prix_initial" value="{{ $bien->prix }}">
                    
                    <label for="prix_final">Prix final :</label>
                    <input type="text" id="prix_final" name="prix_final" value="{{ old('prix_final') }}">
                </div>
            </div>

            <!-- Section Signatures -->
            <div class="section clearfix">
                <h2>Signatures</h2>
                <div class="details">
                    <div class="signature-placeholder">
                        Signature du client
                    </div>
                    
                    <div class="signature-placeholder right">
                        Signature du propriétaire
                    </div>
                </div>
            </div>

            <button type="submit" class="btn"style="margin-left: 250px;">Enregistrer</button>
            <button type="submit" class="btn" style="margin-left: 100px;">Imprimer</button>
        </form>
    </div>
</body>
</html>
