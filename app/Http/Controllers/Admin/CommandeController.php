<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Status;
use http\Env\Response;
use App\Models\Commande;
use App\Models\Payement;
use Illuminate\Http\Request;
use App\Mail\CommandeApprouvee;
use function Pest\Laravel\json;
use Illuminate\Http\JsonResponse;
use App\Models\FilePatchOfCommande;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CommandeController extends Controller
{
    //
    public function index(){

       // $cmds = (new Commande())->getAllCommandes();
        return view('admin.layouts.commande.commandes');
    }

    //Commandes approuvées ou en cours de traitement
    public function getProcessingCommande():JsonResponse
    {
        try {
            return response()->json((new Commande())->getAllCommandesWhereStatusIs(['Approuvé','En traitement','Traiter']), 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une erreur est survenue lors de la récupération des commandes.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    //Commandes nouvelles commande
    public function allNewCommande(): JsonResponse
    {
        try {
            return response()->json((new Commande())->getAllCommandesWhereStatusIs(['En attente']), 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une erreur est survenue lors de la récupération des commandes.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    //Rejeter une commande
    public function rejectCommande(Request $request): JsonResponse
    {
        $uuid = $request->input("uuid");
        try {
            if ((new Commande())->updateCommandeStatusByUuid($uuid,"Rejeté")){
                return response()->json(['message'=>'success'],200);
            }
            return response()->json(['message'=>'echec'],200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une erreur est survenue lors de la récupération des commandes.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    //approuvé une commande
    public function approvedCommande(Request $request){
        $validate = $request->validate([
            'uuid'=>'required',
        ]);

      //  try {
            $commande = (new Commande())->_getCommandeByUuid($validate["uuid"]);
            $cmdId = $commande->id;
            $client = (new Commande())->getClientByCommandeUuid($validate["uuid"]);
            $clientEmail = (new Client())->getEmailByIdUser($client->user_id);
            if ($cmdId){
               $statutId = Status::getIdByName("Approuvé");
                
                (new Commande())->updateCommandeStatusByUuid($validate["uuid"],'Approuvé');
                Mail::to($clientEmail)->send(new CommandeApprouvee($commande, $client));
                return response()->json(["message"=>"success"],200);
            }
            return response()->json(["message"=>"echec"],200);


      /*  }catch (\Exception $e){

        }*/

    }

    //
    public function addRedactor(Request $request){

        $redactorId = $request->input('redactorId');
        $cmdUuid = $request ->input('cmdUuid');
        $cmd= (new Commande())->updateCommande($cmdUuid,["redactor_id"=>$redactorId,"status"=>"En traitement"]);
        if ($cmd){
            return response()->json(["message"=>"success"]);
        }
        return response()->json(["message"=>"echec"]);
    }

    //
    public function getCommande($uuid){
       $cmd =(new Commande())->getCommandeByUuid($uuid);
       $commande = $cmd;
       //dd($commande);
       $userEmail = (new User())->getUserEmailByID($commande["client"]["user_id"]);
       $commande["client"]["email"]= $userEmail;
       $redactors = (new Admin())->getAllByRole("Editeur");
       $data = ["commande"=>$commande,"redactors"=>$redactors];
       //dd($data);

     return view('admin.layouts.commande.commande-detailes')->with('data',$data);
    }

    public function fileUpdate(Request $request){
        $idCmd = (new Commande())->getIdByUuid($request -> input('uuid'));
        $ff = (new FilePatchOfCommande())->getFinalByIdCommande($idCmd);
        $cmdStatus = 'Traiter';
        if ($ff) {
            // Vérifie si un fichier a été téléchargé
            if ($request->hasFile('customFile')) {
                $file = $request->file('customFile');
                
                // Si le fichier précédent existe, le supprimer
                if (Storage::exists("public/" . $ff->path)) {
                    Storage::delete("public/" . $ff->path);
                }
                
                // Génére un nom de fichier unique
                $uniqueFileName = 'fncmd_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('files/commande', $uniqueFileName, 'public');
                // Met à jour le chemin dans la base de données
                (new FilePatchOfCommande())->updateFile($ff->id, ['path' => $path]);
                (new Commande())->updateCommandeStatusByUuid($request -> input('uuid'),$cmdStatus);
                return response()->json([
                    "msg" => "File uploaded",
                    "success" => true,
                    "data" =>[
                        "path" => $path,
                        "cmd_status"=>$cmdStatus,
                    ]
                ], 200);
            }
            return response()->json([
                "msg" => "Error: file request",
                "success" => false
            ], 500);
        } else {
            // Gestion du cas où $ff est nul
            if ($request->hasFile('customFile')) {
                $file = $request->file('customFile');
                $uniqueFileName = 'fncmd_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('files/commande', $uniqueFileName, 'public');
                
                // Ajoute un nouvel enregistrement
                (new FilePatchOfCommande())->addNew([
                    'path' => $path,
                    "type" => 1,
                    "commande_id" => $idCmd,
                    "description" => "Fichier final de la commande"
                ]);

                (new Commande())->updateCommandeStatusByUuid($request -> input('uuid'),$cmdStatus);
                return response()->json([
                    "msg" => "File uploaded",
                    "success" => true,
                    "data" =>[
                        "path" => $path,
                        "cmd_status"=>$cmdStatus,
                    ]
                ], 200);
            }
            return response()->json([
                "msg" => "Error: file request",
                "success" => false
            ], 500);
        }
        
    }
}
