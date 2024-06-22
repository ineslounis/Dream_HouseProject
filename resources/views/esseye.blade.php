<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>Responsive Section</title>
    {{-- <style>
        .bx {
            background-color: #f7f7f7;
            padding: 20px;
        }

        .box1,
        .box2 {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style> --}}
</head>

<body>

    <section class="container-fluid bx">
        <div class="row">
            <div class="col-12 col-md-7">
                <div class="box1">
                    <h3>A Propos de Nous</h3>
                    <p>Notre site immobilier propose une sélection de biens immobiliers de qualité,
                        adaptés aux besoins et aux préférences de nos clients. Notre équipe d'experts
                        immobiliers est à votre disposition pour vous guider dans le processus d'achat ou de vente,
                        en offrant un service professionnel et de qualité supérieure. Nous nous engageons à maintenir
                        les normes les plus élevées en matière de service à la clientèle, de professionnalisme et
                        d'intégrité.
                        Nous sommes fiers de notre engagement envers l'excellence et espérons vous aider à réaliser vos
                        rêves
                        immobiliers.</p>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <div class="box2">
                    <h3 style="text-align: center;">Réseaux Sociaux</h3>
                    <div class="text-center">
                        <a href="#"> <i class="fab fa-facebook-f"></i></a>
                        <a href="#"> <i class="fab fa-instagram"></i></a>
                        <a href="#"> <i class="fab fa-linkedin"></i></a>
                        <a href="#"> <i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
