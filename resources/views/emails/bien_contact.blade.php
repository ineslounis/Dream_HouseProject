<!DOCTYPE html>
<html>
<head>
    <title>Contact Email</title>
</head>
<body>
    <h1>Proposition d'une offre</h1>
    <p><strong>Prénom:</strong> {{ $mailData['firstname'] }}</p>
    <p><strong>Nom:</strong> {{ $mailData['lastname'] }}</p>
    <p><strong>Téléphone:</strong> {{ $mailData['phone'] }}</p>
    <p><strong>Email:</strong> {{ $mailData['email'] }}</p>
    <p><strong>Offre:</strong> {{ $mailData['message'] }}</p>
    <p><strong>ID de l'annonce:</strong> {{ $mailData['annonce_id'] }}</p>
    <p><strong>Titre de l'annonce:</strong> {{ $mailData['annonce_titre'] }}</p>
</body>
</html>
