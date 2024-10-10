<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BaseDonne;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BaseDonneController extends Controller
{
    //
    public function index(){
        return view('admin.layouts.base-donne.base-donnees');
    }

    /**
     * @throws \Exception
     */
    public function addNew(Request $request){
        $vald = $request->validate(
            [
                'title'=>'required|string',
                'amount'=>'required',
                'path'=>'required|file|mimes:zip',
                'description'=>'required|string'
            ]
        );
        //stockage du fichier sur le serveur
        if ($request->hasFile('path')) {
            $fileBd = $request->file('path');
            $uniqueFileName = 'bd_'.time(). '.' . $fileBd->getClientOriginalExtension(); // Utilisation de UUID
            $path = $fileBd->storeAs('bd', $uniqueFileName, 'public');
        }
        $response = (new BaseDonne())->addNew(["name"=>$vald["title"],'description'=>$vald["description"],'amount'=>$vald["amount"],'path'=>$path]);
       if ($response){
           return response()->json(["message"=>"success"]);
       }
       return response()->json(["message"=>"echec"]);
    }
    //
    public function getAllBd(){
        $bd=(new BaseDonne())->getAll();
        return response()->json( $bd,200);
    }
    //
    public function getBd(Request $request){
        $uuid = $request->input('uuid');
      //  echo $uuid;
        $bd = (new BaseDonne())->getByUuid($uuid);
      return response()->json( $bd,200);
    }
    //
    public function editBd(Request $request){

        $vald = $request->validate(
            [
                'title'=>'required|string',
                'amount'=>'required',
                'path'=>'file|mimes:zip',
                'description'=>'required|string'
            ]
        );

        $uuid = $request->input("uuid");
        $bd = (new BaseDonne())->getByUuid($uuid);
        $path = $bd->path;
        //stockage du fichier sur le serveur
        if ($request->hasFile('path')) {
            if (Storage::exists("public/".$bd->path)){
                Storage::delete("public/".$bd->path);
            }
            $fileBd = $request->file('path');
            $uniqueFileName = 'bd_'.time(). '.' . $fileBd->getClientOriginalExtension(); // Utilisation de UUID
            $path = $fileBd->storeAs('bd', $uniqueFileName, 'public');
        }
        $response = (new BaseDonne())->updateByUuid($uuid,["name"=>$vald["title"],'description'=>$vald["description"],'amount'=>$vald["amount"],'path'=>$path]);
        if ($response){
            return response()->json(["message"=>"success"]);
        }
        return response()->json(["message"=>"echec"]);
    }
    //
    public function delete(Request $request){
        $uuid = $request->input("uuid");
        $response = (new BaseDonne())->updateByUuid($uuid,["status_id"=>Status::getIdByName("Supprimé")]);
        if ($response){
            return response()->json(["message"=>"success"]);
        }
        return response()->json(["message"=>"echec"]);
    }
    //
    public function download(Request $request)
    {
        $uuid = $request->input("uuid");
        $bd = (new BaseDonne())->getByUuid($uuid);
        if ($bd && Storage::exists("public/".$bd->path)) {
            // Générer une URL temporaire pour le téléchargement
            $url = Storage::url("public/".$bd->path);
            return response()->json([
                "message" => "success",
                "download_url" => $url
            ]);
        }
        return response()->json(["message" => "echec"], 404);
    }
}
