<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Discipline;
use App\Models\Status;
use App\Models\ThemeMemoire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ThemeMemoireController extends Controller
{
    //
    public function index(){
      //  $discipline = 
        $categories =Discipline::getAll();
        return view('admin.layouts.theme-memoire.theme-memoires')->with('categories',$categories);
    }
    //
    public function getAll(){
        $tm=(new ThemeMemoire())->getAll();
        return response()->json( $tm,200);
    }
    //
    public function addNewTM(Request $request) {
        try {
                $vald = $request->validate([
                    'theme' => 'required|string|max:255',
                    'description' => 'required|string',
                    'licence' => 'nullable|file|mimes:pdf,doc,docx',
                    'master' => 'nullable|file|mimes:pdf,doc,docx', // Optionnel
                    'doctorat' => 'nullable|file|mimes:pdf,doc,docx', // Optionnel
                    'specifique' => 'nullable|string',
                    'generale' => 'nullable|string',
                    'lieu_collect' => 'nullable|string|max:255',
                    'annee_collect' => 'nullable|integer|min:1900|max:' . date('Y'),
                   // 'categories' => 'required|exists:disciplines,id', // Assurez-vous que la catégorie existe
                ]);
                // Stockage du fichier sur le serveur
                $path = ['licence' => '', 'master' => '', 'doctorat' => '']; // Initialiser le chemin
                $redactor_id = null;
                $types = ['licence', 'master', 'doctorat'];
                foreach ($types as $type) {
                    if ($request->hasFile($type)) {
                        $file = $request->file($type);
                        $uniqueFileName = 'pt_' . $type . '_' . time() . '.' . $file->getClientOriginalExtension(); // Utilisation de l'extension d'origine
                        $path[$type] = $file->storeAs('protocoles', $uniqueFileName, 'public');
                    }
                }
               
                // Ajout du nouvel enregistrement
                $response = (new ThemeMemoire())->addNew([
                    "title" => $vald["theme"],
                    'description' => $vald["description"],
                    'path' => json_encode($path),
                    'redactor_id'=>$redactor_id,
                    'generale' => $vald["generale"],
                    'specifique' => $vald["specifique"],
                    'lieu_collect' => $vald["lieu_collect"],
                    'annee_collect' => $vald["annee_collect"],
                ]);
        
                if ($response) {
                    return response()->json(["message" => "success"]);
                }
        
                return response()->json(["message" => "échec"], 400); // Retourner un code d'erreur
            } catch (\Exception $e) {
                return response()->json(["message" => "Erreur: " . $e->getMessage()], 500); // Gérer les exceptions
            }
    }
    
    //
    public function getTM(Request $request){
        $uuid = $request->input('uuid');
        //  echo $uuid;
        $tm = (new ThemeMemoire())->getByUuid($uuid);
        return response()->json( $tm,200);
    }
    //
    public function editTM(Request $request){
        $vald = $request->validate([
            'theme' => 'required|string|max:255',
            'description' => 'required|string',
            'licence' => 'nullable|file|mimes:pdf,doc,docx', // Optionnel
            'master' => 'nullable|file|mimes:pdf,doc,docx', // Optionnel
            'doctorat' => 'nullable|file|mimes:pdf,doc,docx', 
            'specifique' => 'nullable|string',
            'generale' => 'nullable|string',
            'lieu_collect' => 'nullable|string|max:255',
            'annee_collect' => 'nullable|integer|min:1900|max:' . date('Y'),
            // Optionnel
           // 'categories' => 'required|exists:disciplines,id', // Assurez-vous que la catégorie existe
        ]);

        $uuid = $request->input("uuid");
        $thm = (new ThemeMemoire())->getByUuid($uuid);
        $paths = $thm->path;
        $path = json_decode($paths, true);
        $redactor_id = NULL;
        //stockage du fichier sur le serveur
        $redactor_id = null;
        $types = ['licence', 'master', 'doctorat'];
        foreach ($types as $type) {
            if ($request->hasFile($type)) {
                $file = $request->file($type);
                if (Storage::exists("public/" . $path[$type])) {
                    Storage::delete("public/" . $path[$type]);
                }
                $uniqueFileName = 'pt_' . $type . '_' . time() . '.' . $file->getClientOriginalExtension(); // Utilisation de l'extension d'origine
                $path[$type] = $file->storeAs('protocoles', $uniqueFileName, 'public');
                $redactor_id = (session()->get('adminInfo'))->id;

            }
        }

        $response = (new ThemeMemoire())->updateByUuid($request->input('uuid'),["title"=>$vald["theme"],'description'=>$vald["description"],'path'=>json_encode($path),'redactor_id'=>$redactor_id,'generale' => $vald["generale"],'specifique' => $vald["specifique"],'lieu_collect' => $vald["lieu_collect"],'annee_collect' => $vald["annee_collect"]]);
        if ($response){
            return response()->json(["message"=>"success"]);
        }
        return response()->json(["message"=>"echec"]);
    }
    //
    public function delete(Request $request){
        $uuid = $request->input("uuid");
        $response = (new ThemeMemoire())->updateByUuid($uuid,["status_id"=>Status::getIdByName("Supprimé")]);
        if ($response){
            return response()->json(["message"=>"success"],200);
        }
        return response()->json(["message"=>"echec"],500);
    }
    //
    public function download(Request $request)
    {
        $uuid = $request->input("uuid");

        $tm = (new ThemeMemoire())->getByUuid($uuid);
        if ($tm && Storage::exists("public/".$tm->path)) {
            // Générer une URL temporaire pour le téléchargement
            $url = Storage::url("public/".$tm->path);
            return response()->json([
                "message" => "success",
                "download_url" => $url
            ]);
        }
        return response()->json(["message" => "echec"], 404);
    }
}

