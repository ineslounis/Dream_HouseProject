<!DOCTYPE html>
<html>
<head>
    <title>Contact Email</title>
</head>
<body>
    <h2>Message de: {{ $fromName }}</h2>
    <p><strong>Email:</strong> {{ $fromEmail }}</p>
    <p><strong>Numéro:</strong> {{ $numero }}</p>
    <p><strong>Date:</strong> {{ $date }}</p>
    <p><strong>Détails:</strong> {{ $detail }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $body }}</p>
</body>
</html>
