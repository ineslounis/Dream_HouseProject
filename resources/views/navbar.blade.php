<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- lien vers bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- lien des icons -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <!-- lien vers css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{asset('css/annonce.css')}}">
    <link rel="stylesheet" href="{{asset('css/ajouterannonce.css')}}">
    <link rel="stylesheet" href="{{asset('css/condition.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}"> 
    <link rel="stylesheet" href="{{asset('css/signup.css')}}"> 
    

</head>

<body>

    <header>
        <div class="logo">
            <a href="/"> <span>Dream</span> House</a>
        </div>
        <ul class="menu">                                                                                                                                                                                                                                                                                                                                                                                           
            <li><a href="/">Acceuil</a></li>
            <li><a href="/annonce">Annonces</a></li>
            <li><a href="/ajouterannonce">Deposer annonce</a></li>
            <li><a href="#agent-immobilier">Agents immobiliers</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        <form action="#">
            <a href="login" class="btn-connexion">Connexion</a>
            <a href="signup" class="btn-connexion">Inscription</a>
        </form>
        <div class="responsive-menu"></div>
    </header>
   
    <div>@yield('content')</div> 
    <script>
        const toggle_menu = document.querySelector('.responsive-menu');
        const menu = document.querySelector('.menu');
        toggle_menu.onclick = function () {
            toggle_menu.classList.toggle('active');
            menu.classList.toggle('responsive')
        }
    </script>
    @include('footer')