<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

// Exemple de modèle Visite avec les relations
class Visite extends Model
{
    use HasFactory;

    protected $fillable = ['id_client', 'nom_prenom', 'id_annonce', 'titre', 'agent_immobilier', 'id_proprietaire', 'date_visite', 'heure_visite'];

    public function client()
    {
        return $this->belongsTo(User::class, 'id_client');
    }

    public function proprietaire()
    {
        return $this->belongsTo(User::class, 'id_proprietaire');
    }

    public function bien()
    {
        return $this->belongsTo(Bien::class, 'id_annonce');
    }
}

