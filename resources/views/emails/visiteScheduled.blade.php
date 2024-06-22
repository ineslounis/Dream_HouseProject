<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Visite Programmé</title>
</head>
<body>
    <h2>Nouvelle Visite Programmé</h2>
    <p><strong>Nom du client :</strong> {{ $details['nom_prenom'] }}</p>
    <p><strong>Bien immobilier :</strong> {{ $details['titre'] }}</p>
    {{-- <p><strong>Adresse :</strong> {{ $details['adresse'] }}</p>
    <p><strong>Wilaya :</strong> {{ $details['wilaya'] }}</p> --}}
    <p><strong>Agent immobilier :</strong> {{ $details['agent_immobilier'] }}</p>
    <p><strong>Date de visite :</strong> {{ $details['date_visite'] }}</p>
    <p><strong>Heure de visite :</strong> {{ $details['heure_visite'] }}</p>
</body>
</html>
