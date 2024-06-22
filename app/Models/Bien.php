<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\Relations\BelongsToMany;
// use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class Bien extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'titre',
        'type',
        'surface',
        'numero_etage',
        'nombre_etages',
        'nombre_chambre',
        'prix',
        'wilaya',
        'adresse',
        'transaction',
        'id_proprietaire',
        'agent_immobilier', 
        'image',
        'imgs',
        'description',
        'etat',
    ];
    public function getSlug(): string
    {
        return Str::slug($this->titre);
    }
    
   
    protected $casts = [
        'imgs' => 'array',
        'etat' => 'boolean',
    ];


    
    public function scopeAvailable(Builder $builder, bool $available = true): Builder
    {
        return $builder->where('etat', $available);
    }
    

    public function scopeRecent( Builder $builder): Builder{
        return $builder -> orderby('created_at','desc');

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
// Inside User model or any relevant model
public function hasRole($role)
{
    return $this->role === $role;
}
public function agent()
{
    return $this->belongsTo(User::class, 'agent_immobilier');
}
public function visites()
{
    return $this->hasMany(Visite::class);
}

public function proprietaire()
{
    return $this->belongsTo(User::class, 'id_proprietaire');
}

}
