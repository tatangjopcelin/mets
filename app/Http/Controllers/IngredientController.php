<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Http\Requests\StoreIngredientRequest;
use App\Http\Requests\UpdateIngredientRequest;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingredient=Ingredient::orderBy('id','desc')->get();
        $message="";
        if(is_null($ingredient)){
            $message.= "aucune ingredient trouve";
        return response(["message"=> $message],200);
        }else{
            $message.= "en total ".$ingredient->count();

            return response([
                "reponse"=> $ingredient,
                "message"=> $message,
            ],200);  
          }
  }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(StoreIngredientRequest $request)
    {


        // Validation des données
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'description' => 'required|string',
           
        ]);
    
        // Si un fichier image est présent
        if ($request->hasFile('image')) {
            // Téléversement de l'image dans le dossier 'uploads/images'
            $imagePath = $request->file('image')->store('uploads/images', 'public');
            $validatedData['image'] = $imagePath;  // Enregistre le chemin dans la BD
        }
    
       
        $ingredient = Ingredient::create($validatedData);
        return response()->json($ingredient, 201);
    
    
        }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ingredient=Ingredient::find($id);
        if($ingredient){
            $ingredient->files=$ingredient->files;
        return response(["response"=>$ingredient]);
    }else{
        return response(["message"=> "ingredient non trouvée"],404);
    }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ingredient $ingredient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIngredientRequest $request,$id)
    {
        $ingredient = Ingredient::find($id);

    if (!$ingredient) {
        return response()->json(['message' => 'ingredient non trouvée'], 404);
    }

    // Validation des données
    $validatedData = $request->validate([
       'nom' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Validation de l'image
        'description' => 'nullable|string',
       
    ]);

    // Si un fichier image est présent
    if ($request->hasFile('image')) {
        // Téléversement de la nouvelle image
        $imagePath = $request->file('image')->store('uploads/images', 'public');
        $validatedData['image'] = $imagePath;
    }

    // Mise à jour des informations de la ingredient
    $ingredient->update($validatedData);
    return response()->json($ingredient, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient=Ingredient::find($id);
        if ($ingredient && $ingredient->delete()) {
            return response(["response"=>"ingredient : $ingredient->nom a ete supprimer avec success"]);
        }
        return response(["response"=>"ingredient  n'a pas ete supprimer "]);
  
    }
}
