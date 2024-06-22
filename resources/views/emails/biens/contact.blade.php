<!DOCTYPE html>
<html>
<head>
    <title>Contact Email</title>
</head>
<body>
    <h1>Contact Email</h1>
    <p><strong>Prénom:</strong> {{ $data['firstname'] }}</p>
    <p><strong>Nom:</strong> {{ $data['lastname'] }}</p>
    <p><strong>Téléphone:</strong> {{ $data['phone'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Offre:</strong> {{ $data['message'] }}</p>
    <p><strong>ID de l'annonce:</strong> {{ $data['annonce_id'] }}</p>
    <p><strong>Titre de l'annonce:</strong> {{ $data['annonce_titre'] }}</p>
</body>
</html>
