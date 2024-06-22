<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Contrat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_client', 
        'prenom_client', 
        'adresse_client', 
        'email_client', 
        'nom_proprietaire', 
        'prenom_proprietaire', 
        'adresse_proprietaire', 
        'email_proprietaire', 
        'titre', 
        'type', 
        'adresse_bien', 
        'description', 
        'duree_location', 
        'prix_initial', 
        'prix_final'
    ];
}
