<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable; 
use Laravel\Sanctum\HasApiTokens; 
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Etape extends Model
{
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;
    protected $fillable = [
        'recette_id',
        'duree',
        'description',
    ]; 

    public function recette(): BelongsTo
    {
        return $this->belongsTo(Recette::class);
    }
}
