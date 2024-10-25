<?php

namespace App\Http\Controllers;
use App\Models\Abonne;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateAbonne;

class AbonneController extends Controller
{
    public function index()
    { $abonne=Abonne::orderBy('id','desc')->get();
        $message="";
        if(is_null($abonne)){
            $message.= "aucune abonne trouve";
        return response(["message"=> $message],200);
        }else{
            $message.= "en total ".$abonne->count();

            return response([
                "reponse"=> $abonne,
                "message"=> $message,
            ],200);  
          }

    }

    public function register(Request $request)
    {
        // Validation des données entrantes
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:abonnes',
            'pays'=> 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

       
        $abonne = Abonne::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'pays'=> $request->pays,
            'password' => Hash::make($request->password),
        ]);

        // Génération du token d'authentification
        $token = $abonne->createToken('auth_token')->plainTextToken;

        // Réponse JSON avec le token
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'message' => 'Inscription réussie',
            'abonne' => $abonne,
        ], 201);
    }

    public function update(UpdateAbonne $request,$id)
    {
        $data = $request->validated();
        $abonne=Abonne::find($id);
        $abonne->update($data);
        return response(["response"=>$abonne]);
    }

    

    
    public function login(Request $request)
    {
        // Validation des données entrantes
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $abonne = Abonne::where('email', $request->email)->first();

        // Vérification du mot de passe
        if (!$abonne || !Hash::check($request->password, $abonne->password)) {
            throw ValidationException::withMessages([
                'email' => ['Les informations d\'identification sont incorrectes.'],
            ]);
        }

        // Génération du token d'authentification
        $token = $abonne->createToken('auth_token')->plainTextToken;

        // Réponse JSON avec le token
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'message' => 'Connexion réussie',
            'abonne' => $abonne,
        ]);
    }

    public function show($id)
    {
        $abonne=Abonne::find($id);
        if($abonne){
            $abonne->files=$abonne->files;
        return response(["response"=>$abonne]);
    }else{
        return response(["message"=> "abonne avec id : $abonne->id non trouvée"],404);
    }
    }

    public function destroy($id)
    {
        $abonne=Abonne::find($id);
        if ($abonne && $abonne->delete()) {
            return response(["response"=>"abonne $abonne->email a ete supprimer avec success"]);
        }
        return response(["response"=>"abonne avec id : $abonne->id n'a pas ete supprimer "]);

    }


    /**
     */
    public function logout(Request $request)
{
    // Vérifiez si l'utilisateur est authentifié
    if ($request->user()) {
        // Suppression du token actuel
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Déconnexion réussie'
        ]);
    }

    return response()->json([
        'message' => 'Aucun utilisateur authentifié'
    ], 401); // Code d'erreur HTTP 401 Unauthorized
}

    

   
}
