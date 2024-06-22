<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offre extends Model
{
    use HasFactory;
    use SoftDeletes ;
    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'email',
        'message',
        'annonce_id',
        'annonce_titre',
    ];
}
