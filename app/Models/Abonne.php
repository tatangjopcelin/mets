<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable; 
use Laravel\Sanctum\HasApiTokens; 
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\hasMany;

use Illuminate\Database\Eloquent\Model;

class Abonne extends Model
{
    use HasApiTokens, HasFactory, SoftDeletes, Notifiable;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'pays',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function recette():hasMany
    {
        return $this->hasMany(Recette::class);
    }
}
