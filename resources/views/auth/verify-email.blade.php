<x-guest-layout>
    <style>
        /* Styles personnalisés pour la page de vérification de l'adresse e-mail */
        body {
            background: linear-gradient(to right, #000000, #10b1d0);
            color: white;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            margin-top: 100px;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.1);
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .description {
            font-size: 16px;
            margin-bottom: 20px;
            text-align: center;
        }

        .btn-submit, .btn-logout {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-submit {
            background-color: #007bff;
            color: #fff;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .btn-logout {
            background-color: transparent;
            text-decoration: underline;
            font-size: 14px;
            color: #ccc;
            margin-left: 10px;
        }

        .btn-logout:hover {
            color: #fff;
        }

        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px; /* Espace entre les boutons */
        }
    </style>

    <div class="container">
        <h2 class="title">Vérification de l'adresse e-mail</h2>

        <div class="mb-4 text-sm">
            {{ __("Merci de vous être inscrit ! Avant de commencer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer par e-mail ? Si vous n'avez pas reçu l'e-mail, nous vous en enverrons volontiers un autre.") }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __("Un nouveau lien de vérification a été envoyé à l'adresse e-mail que vous avez fournie lors de votre connexion.") }}
            </div>
        @endif

        <div class="mt-4 button-container">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn-submit">
                    {{ __("Renvoyer l'e-mail de vérification") }}
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    {{ __("Déconnexion") }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
