<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Email</title>
</head>
<body>
    <h1>Vous avez reçu un nouveau message</h1>
    <p><strong>Nom:</strong> {{ $mailData['firstname'] }} {{ $mailData['lastname'] }}</p>
    <p><strong>Email:</strong> {{ $mailData['email'] }}</p>
    <p><strong>Téléphone:</strong> {{ $mailData['phone'] }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $mailData['message'] }}</p>
</body>
</html>
