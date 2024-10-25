<?php

namespace App\Http\Controllers;

use App\Models\Etape;
use App\Http\Requests\StoreEtapeRequest;
use App\Http\Requests\UpdateEtapeRequest;

class EtapeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etape=Etape::orderBy('id','desc')->get();
        $message="";
        if(is_null($etape)){
            $message.= "aucune etape trouve";
        return response(["message"=> $message],200);
        }else{
            $message.= "en total ".$etape->count();

            return response([
                "reponse"=> $etape,
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
    public function register(StoreEtapeRequest $request)
    {
        $etape = $request->validated();
        $storeEtape=Etape::create($etape);
        return response(["response"=>$storeEtape],201);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $etape=Etape::find($id);
        if($etape){
            $etape->files=$etape->files;
        return response(["response"=>$etape]);
        }else{
            return response(["message"=> "etape non trouvée"],404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etape $etape)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEtapeRequest $request, $id)
    {
        $etape = Etape::find($id);

        if (!$etape) {
            return response()->json(['message' => 'etape non trouvée'], 404);
        }

        $data = $request->validated();
        $etape->update($data);
        return response()->json($etape, 200);    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $etape=Etape::find($id);
        if ($etape && $etape->delete()) {
            return response(["response"=>"etape avec id : $etape->id a ete supprimer avec success" ]);
        }
        return response(["response"=>"etape  n'a pas ete supprimer "]);
  
    }
}
