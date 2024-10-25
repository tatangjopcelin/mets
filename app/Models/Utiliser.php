<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable; 
use Laravel\Sanctum\HasApiTokens; 
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\belongsToMany;

use Illuminate\Database\Eloquent\Model;

class Utiliser extends Model
{
    protected $table = 'utiliser';
    use HasApiTokens, HasFactory, SoftDeletes, Notifiable;

    protected $fillable = [
        'ingrdient_id',
        'recette_id',
        'quantite',
    ];

    public function ingredient():belongsToMany
    {
        return $this->belongsToMany(Ingredient::class);
    }
    public function recette():belongsToMany
    {
        return $this->belongsToMany(Recette::class);
    }


}
