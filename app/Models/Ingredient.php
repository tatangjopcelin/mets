<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable; 
use Laravel\Sanctum\HasApiTokens; 
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\belongsToMany;




class Ingredient extends Model

{
    use HasApiTokens, HasFactory, SoftDeletes, Notifiable;
    protected $fillable = [
        'nom',
        'image',
        'description',
    ];
    public function recette():belongsToMany
    {
        return $this->belongsToMany(Recette::class);
    }
}
