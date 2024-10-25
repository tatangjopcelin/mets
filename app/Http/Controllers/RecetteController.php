<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRecetteRequest;
use App\Http\Requests\UpdateRecetteRequest;

class RecetteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { $recette=Recette::orderBy('id','desc')->get();
        $message="";
        if(is_null($recette)){
            $message.= "aucune recette trouve";
        return response(["message"=> $message],200);
        }else{
            $message.= "en total ".$recette->count();

            return response([
                "reponse"=> $recette,
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
    public function register(StoreRecetteRequest $request)
    {


    // Validation des données
    $validatedData = $request->validate([
        'nom' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',  // Validation de l'image
        'description' => 'required|string',
        'duree'=> 'required|string',
        'budget' => 'required|numeric',
        'abonne_id'=> 'required',
    ]);

    // Si un fichier image est présent
    if ($request->hasFile('image')) {
        // Téléversement de l'image dans le dossier 'uploads/images'
        $imagePath = $request->file('image')->store('uploads/images', 'public');
        $validatedData['image'] = $imagePath;  // Enregistre le chemin dans la BD
    }

    // Créer la recette avec l'image
    $recette = Recette::create($validatedData);
    return response()->json($recette, 201);


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $recette=Recette::find($id);
        if($recette){
            $recette->files=$recette->files;
        return response(["response"=>$recette]);
    }else{
        return response(["message"=> "recette non trouvée"],404);
    }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recette $recette)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecetteRequest $request,$id)
    {
        $recette = Recette::find($id);

    if (!$recette) {
        return response()->json(['message' => 'Recette non trouvée'], 404);
    }

    // Validation des données
    $validatedData = $request->validate([
       'nom' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Validation de l'image
        'description' => 'nullable|string',
        'duree'=> 'nullable|string',
        'budget' => 'nullable|numeric',
        'abonne_id'=> 'nullable',

    ]);

    // Si un fichier image est présent
    if ($request->hasFile('image')) {
        // Téléversement de la nouvelle image
        $imagePath = $request->file('image')->store('uploads/images', 'public');
        $validatedData['image'] = $imagePath;
    }

    // Mise à jour des informations de la recette
    $recette->update($validatedData);
    return response()->json($recette, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $recette=Recette::find($id);
        if ($recette && $recette->delete()) {
            return response(["response"=>"recette : $recette->nom a ete supprimer avec success"]);
        }
        return response(["response"=>"recette  n'a pas ete supprimer "]);
  
    }
}
