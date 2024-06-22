@extends('base')
@section('title' ,'Se Connecter')
@section('content')
<style>
    body{
        display: flex;
    }
</style>
    <div class="containerr1" id="containerr1">
        {{-- <div class="form-container sign-up " id="inscription">
            <form action="{{url('')}}">
                <h1>Creer un compte</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>Ou utiliser votre email pour s'inscrire</span>
                <input type="text" placeholder="Nom">
                <input type="text" placeholder="Prenom">
                <input type="text" placeholder="Telephone">
                <input type="email" placeholder="Email">
                    <select class="aj" aria-label="Default select example" name="wilaya"  >
                        <option value="">wilaya </option>
                        <option value="1">01 - Adrar</option>
                        <option value="2">02 - Chlef</option>
                        <option value="3">03 - Laghouat</option>
                        <option value="4">04 - Oum-El-Bouaghi</option>
                        <option value="5">05 - Batna</option>
                        <option value="6">06 - Béjaïa</option>
                        <option value="7">07 - Biskra</option>
                        <option value="8">08 - Béchar</option>
                        <option value="9">09 - Blida</option>
                        <option value="10">10 - Bouira</option>
                        <option value="11">11 - Tamanrasset</option>
                        <option value="12">12 - Tébessa</option>
                        <option value="13">13 - Tlemcen</option>
                        <option value="14">14 - Tiaret</option>
                        <option value="15">15 - Tizi-Ouzou</option>
                        <option value="16">16 - Alger</option>
                        <option value="17">17 - Djelfa</option>
                        <option value="18">18 - Jijel</option>
                        <option value="19">19 - Sétif</option>
                        <option value="20">20 - Saida</option>
                        <option value="21">21 - Skikda</option>
                        <option value="22">22 - Sidi-Bel-Abbès</option>
                        <option value="23">23 - Annaba</option>
                        <option value="24">24 - Guelma</option>
                        <option value="25">25 - Constantine</option>
                        <option value="26">26 - Médéa</option>
                        <option value="27">27 - Mostaganem</option>
                        <option value="28">28 - MSila</option>
                        <option value="29">29 - Mascara</option>
                        <option value="30">30 - Ouargla</option>
                        <option value="31">31 - Oran</option>
                        <option value="32">32 - El-Bayadh</option>
                        <option value="33">33 - Illizi</option>
                        <option value="34">34 - Bordj-Bou-Arreridj</option>
                        <option value="35">35 - Boumerdès</option>
                        <option value="36">36 - El-Tarf</option>
                        <option value="37">37 - Tindouf</option>
                        <option value="38">38 - Tissemsilt</option>
                        <option value="39">39 - El-Oued</option>
                        <option value="40">40 - Khenchela</option>
                        <option value="41">41 - Souk-Ahras</option>
                        <option value="42">42 - Tipaza</option>
                        <option value="43">43 - Mila</option>
                        <option value="44">44 - Aïn-Defla</option>
                        <option value="45">45 - Naâma</option>
                        <option value="46">46 - Aïn-Témouchent</option>
                        <option value="47">47 - Ghardaia</option>
                        <option value="48">48 - Relizane</option>
                      </select>
                <input type="password" placeholder="Mot de passe">
                <input type="password" placeholder="Confirmer votre Mot de passe">
                <div class="form-check">
                    <div class="row">
                        <div class="col-auto">
                            <input class="form-check-input" type="checkbox" id="gridCheck" name="cd">
                        </div>
                        <div class="col">
                            <label class="form-check-label" for="gridCheck">
                                J'accepte les <a href="/condition" style="color: orangered;">termes et conditions</a> d'utilisation.
                            </label>
                        </div>
                    </div>
                </div>
                
                <button type="submit">S'inscrire</button>
            </form>
        </div> --}}
        <div class="form-container1 sign-in">
            <form method="POST" action="{{route('login')}}">
                @csrf
                <h1>Se Connecter</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>Ou utiliser votre email pour s'authentifier</span>
                <input type="email" placeholder="Email" name="email">
                {{-- @include('shared.flash') --}}
                <input type="password" placeholder="Mot de passe" name="password">
                @include('shared.flash')
                <a href="#">Mot de passe oublie?</a>
                <button >Se connecter</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>soyez le bienvenue</h1>
                    <p>Entrez vos informations personnelles pour utiliser toutes les fonctionnalités du site</p>
                    <button class="hidden" id="login">Se connecter</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>soyez le bienvenue</h1>
                    <p>Connectez-vous avec vos informations personnelles pour utiliser toutes les fonctionnalités du site</p>
                    
                    {{-- <a href="/signup"><button class="hidden" id="register">S'inscrire</button></a> --}}
                </div>
            </div>
        </div>
    </div>

    


    {{-- <script src="../JS/login.js"></script> --}}
@endsection