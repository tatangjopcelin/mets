<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable; 
use Laravel\Sanctum\HasApiTokens; 
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\hasMany, BelongsTo;



class Recette extends Model
{
    use HasApiTokens, HasFactory, SoftDeletes, Notifiable;

    protected $fillable = [
        'nom',
        'image',
        'description',
        'duree',
        'budget',
        'abonne_id',
    ];
    public function ingredient():hasMany
    {
        return $this->hasMany(Ingredient::class);
    }

    public function etape(): hasMany
    {
        return $this->hasMany(Etape::class);
    }

    public function abonne(): BelongsTo

    {
        return $this->belongsTo(Abonne::class);
    }
}
