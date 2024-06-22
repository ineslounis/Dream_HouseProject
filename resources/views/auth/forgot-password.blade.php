<x-guest-layout>
    <style>
        /* Styles personnalisés pour la page de réinitialisation du mot de passe */
        body{
            background: linear-gradient(to right, #000000, #10b1d0);
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 0 20px;
            margin-top: 100px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            color: white;
        }

        .description {
            font-size: 16px;
            color: #ffffff;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            color: white;
        }

        .form-group input[type="email"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ffffff;
            border-radius: 5px;
        }

        .btn-submit {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="container">
        <img src="../IMAGES/inconnu.png" width="30px" style="margin-right: 10px; border: none; margin: auto; width: 100px"> 

        <h2 class="title">Mot de passe oublié</h2>
        <p class="description">Pas de problème. Indiquez simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation de mot de passe par e-mail qui vous permettra d'en choisir un nouveau.</p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="form-group">
                <button type="submit" class="btn-submit" style="background-color: #10b1d0">Envoyer le lien de réinitialisation du mot de passe</button>
            </div>
        </form>
    </div>
</x-guest-layout>
