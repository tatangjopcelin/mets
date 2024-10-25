<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbonneController;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\EtapeController;
use App\Http\Controllers\IngredientController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('utilisateur')->group(function () {
    Route::controller(AbonneController::class)->group(function () {
        Route::get('/affiche_tout_abonne',"index");
        Route::get('afficher_abonne/{id}',"show");
        Route::post('/register',"register");
        Route::put('modifier_abonne/{id}',"update");
        Route::delete('supprimer_abonne/{id}',"destroy");
        Route::post('/login',"login");
        Route::post('/logout',"logout");
    });

    
});

Route::prefix('recette')->group(function () {
    Route::controller(RecetteController::class)->group(function () {
        Route::get('/affiche_tout_recette',"index");
        Route::get('afficher_recette/{id}',"show");
        Route::post('/register',"register");
        Route::patch('modifier_recette/{id}',"update");
        Route::delete('supprimer_recette/{id}',"destroy");
    });

    
});

Route::prefix('etape')->group(function () {
    Route::controller(EtapeController::class)->group(function () {
        Route::get('/affiche_tout_etape',"index");
        Route::get('affiche_etape/{id}',"show");
        Route::post('/register',"register");
        Route::put('modifier_etape/{id}',"update");
        Route::delete('supprimer_etape/{id}',"destroy");
    });

    
});

Route::prefix('ingredient')->group(function () {
    Route::controller(IngredientController::class)->group(function () {
        Route::get('/affiche_tout_ingredient',"index");
        Route::get('affiche_ingredient/{id}',"show");
        Route::post('/register',"register");
        Route::put('modifier_ingredient/{id}',"update");
        Route::delete('supprimer_ingredient/{id}',"destroy");
    });

    
});
