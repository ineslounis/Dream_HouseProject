@php
    $label ??= null;
    $type ??= 'text';
    $class ??= null;
    $name ??= '';
    $value ??= '';
@endphp
@extends('admin.admin')

@section('title', $utilisateur->exists ? "Editer un utilisateur" : "Créer un utiisateur")

@section('content')
<style>
    body{
        display: flex;
    }
</style>
    <div class="containerr" id="containerr" style="margin-left: 170px">
        <div class="form-container sign-in" >
            <form action="{{ route($utilisateur->exists ? 'admin.users.update' : 'admin.users.store', $utilisateur ) }}"
                method="POST" enctype="multipart/form-data">
                {{-- {{ dd($utilisateur) }} --}}
               {{-- {{ dd($utilisateur->exists)}} --}}
                @csrf
                @method($utilisateur->exists ? 'put' : 'post')
                <h1>Ajouter un utilisateur</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <input type="text" placeholder="Nom" name="name" autocomplete="name"  value="{{ $utilisateur->name }}">
                @error('name')
                <div class="text text-danger"> 
                      {{$message}}
                </div>
         @enderror
         <input type="text" placeholder="Prenom" name="prenom" autocomplete="name"  value="{{ $utilisateur->prenom }}">
         @error('prenom')
         <div class="text text-danger"> 
               {{$message}}
         </div>
  @enderror
  <input type="tel" placeholder="Telephone" name="tel" autocomplete="tel" value="{{ $utilisateur->tel }}">
  @error('tel')
  <div class="text text-danger"> 
        {{$message}}
  </div>
@enderror
         <input type="email" placeholder="Email" name="email" autocomplete="name"  value="{{ $utilisateur->email }}">
         @error('email')
         <div class="text text-danger"> 
               {{$message}}
         </div>
         @enderror
    
     
             
              
                <input type="text" placeholder="adresse" name="adresse"autocomplete="name" value="{{ $utilisateur->adresse }}">
                @error('adresse')
                <div class="text text-danger"> 
                      {{$message}}
                </div>
         @enderror
                <input type="text" placeholder="wilaya" name="wilaya" autocomplete="name"  value="{{ $utilisateur->wilaya }}">
                @error('wilaya')
                <div class="text text-danger"> 
                      {{$message}}
                </div>
         @enderror
         <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role" class="form-control">
                <option value="">-- Sélectionnez un rôle --</option>
                <option value="agence" {{ $utilisateur->role == 'agence' ? 'selected' : '' }}>Agence</option>
                <option value="client" {{ $utilisateur->role == 'client' ? 'selected' : '' }}>Client</option>
                <option value="agent" {{ $utilisateur->role == 'agent' ? 'selected' : '' }}>Agent</option>
            </select>
            @error('role')
                <div class="text text-danger">{{ $message }}</div>
            @enderror
        </div>
        
         <div class="row">
            <label for="image_user">Image</label>                            
            <input type="file" name="image_user" id="image_user">
        </div>
         <input type="password" placeholder="Mot de passe" name="password" autocomplete="name"  value="{{ $utilisateur->password }}">
         @error('password')
         <div class="text text-danger"> 
               {{$message}}
         </div>
       @enderror
     
                <div class="form-check">
                    <div class="row">
                        <div class="col-auto">
                            <input class="form-check-input" type="checkbox" id="gridCheck" name="cd">
                        </div>
                        <div class="col">
                            <label class="form-check-label" for="gridCheck">
                                J'accepte les <a href="/condition" style="color: orangered;">termes et conditions</a>
                                d'utilisation.
                            </label>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 30px; margin-bottom: 20px;">
                    <button class="btn-connexion">
                        @if($utilisateur->exists)
                            Modifier
                        @else
                            Ajouter
                        @endif
                    </button>
                </div>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                    <h1>soyez le bienvenue</h1>
                    <p>Entrez vos informations personnelles pour utiliser toutes les fonctionnalités du site</p>
                    
                    <a href="/login"><button class="hidden" id="register">Se connecter</button></a>
                </div>
            </div>
        </div>
    </div>

    


    {{-- <script src="../JS/login.js"></script> --}}
@endsection