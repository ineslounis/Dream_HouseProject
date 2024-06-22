<x-app-layout>
    <style>
        /* Style pour les cartes personnalisées */
        .custom-card {
            background: linear-gradient(to right, #000000, #10b1d0);
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(228, 102, 102, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s;
            color: #ffffff; 
        }

        /* .custom-card:hover {
            transform: translateY(-5px);
        } */

        /* Style pour les titres des cartes */
        .custom-card h3 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }

        /* Style pour les formulaires à l'intérieur des cartes */
        .custom-card form {
            margin-top: 20px;
            background: white;
            color: black;
            border-radius: 10px;
            padding: 20px;
        }

        .custom-card form input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .custom-card form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .custom-card form label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .custom-card form input[type="email"] {
            width: calc(100% - 22px); /* ajuster la largeur pour tenir compte du padding */
            padding: 10px;
            font-size: 16px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
    </style>
   

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="custom-card">
                <h3 style="margin-top: 80px;">Mettre à jour les informations du profil</h3>
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="custom-card">
                <h3>Mettre à jour le mot de passe</h3>
                @include('profile.partials.update-password-form')
            </div>

            <div class="custom-card">
                <h3>Supprimer l'utilisateur</h3>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
