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
use App\Mail\NotificationServiceClient;
use App\Mail\RedactionFinished;
use App\Mail\RédactorMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelIgnition\FlareMiddleware\AddJobs;

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
        $redactor = Admin::find($redactorId);
        
        $redactorEmail = $redactor->user->email;
        $cmdUuid = $request ->input('cmdUuid');
        $commande = Commande::where('uuid', $cmdUuid)->first(); 
        $clientInfo = $commande->client;
       

        $cmd= (new Commande())->updateCommande($cmdUuid,["redactor_id"=>$redactorId,"status"=>"En traitement"]);
        if ($cmd){
  // Récupérer le fichier attaché à la commande
  $filePatch = FilePatchOfCommande::where('commande_id', $commande->id)->first();
  $filePath = $filePatch ? storage_path('app/public/' . $filePatch->path) : null;
  $fiche_techniqu= FilePatchOfCommande::where('commande_id', $commande->id)->where('type', 2)->first();
  $fiche_technique = $fiche_techniqu ? storage_path('app/public/' . $fiche_techniqu->path) : null;


            Mail::to($redactorEmail)->send(new RédactorMail($commande,$clientInfo,$filePath,$fiche_technique));

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
        $commande=(new Commande())->getCommandeByUuid($request -> input('uuid'));
        $user=(new Commande())->getClientByCommandeUuid($request -> input('uuid'));
        $userEmail = (new User())->getUserEmailByID($commande["client"]["user_id"]);
        $ff = (new FilePatchOfCommande())->getFinalByIdCommande($idCmd);
        $cmdStatus = 'Traiter';
      
        if ($ff) {
            // Vérifie si un fichier a été téléchargé
            if ($request->hasFile('customFile')) {
                
                $file = $request->file('customFile');
                $type = $request->input('type');
                // Si le fichier précédent existe, le supprimer
                if (Storage::exists("public/" . $ff->path)) {
                    Storage::delete("public/" . $ff->path);
                  
                }
               
   
                // Génére un nom de fichier unique
                $uniqueFileName = 'fncmd_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('files/commande', $uniqueFileName, 'public');
                // Met à jour le chemin dans la base de données
                (new FilePatchOfCommande())->updateFile($ff->id, ['path' => $path,'description' => $type]);
               
                
              
                (new Commande())->updateCommandeStatusByUuid($request -> input('uuid'),$cmdStatus);
                Mail::to($userEmail)->send(new RedactionFinished($commande,$ff,$user));

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
                $type = $request->input('type');
                // Ajoute un nouvel enregistrement
                (new FilePatchOfCommande())->addNew([
                    'path' => $path,
                    "type" => 1,
                    "commande_id" => $idCmd,
                    "description" => $type
                ]);

                (new Commande())->updateCommandeStatusByUuid($request -> input('uuid'),$cmdStatus);
                Mail::to($userEmail)->send(new RedactionFinished($commande,$ff,$user));

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
    public function updateFiche(Request $request){

        $idCmd = (new Commande())->getIdByUuid($request -> input('uuid'));
        $commande=(new Commande())->getCommandeByUuid($request -> input('uuid'));
        $ff = (new FilePatchOfCommande())->getFinalByIdCommande($idCmd);

      
        if($ff){
            if ($request->hasFile('fiche_technique')) {
                
                $file = $request->file('fiche_technique');
                $type = $request->input('type');
                // Si le fichier précédent existe, le supprimer
                if (Storage::exists("public/" . $ff->path)) {
                    Storage::delete("public/" . $ff->path);
                  
                }
               
   
                // Génére un nom de fichier unique
                $uniqueFileName = 'fncmd_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('files/commande', $uniqueFileName, 'public');
                // Met à jour le chemin dans la base de données
                (new FilePatchOfCommande())->updateFile($ff->id, ['path' => $path,'description' => $type]);
               
                
            
                return response()->json([
                    "msg" => "File uploaded",
                    "success" => true,
                    "data" =>[
                        "path" => $path,
                      
                       
                       
                    ]
                ], 200);
    
            }
            return response()->json([
                "msg" => "Error: file request",
                "success" => false
            ], 500);
        }
       
      
       else{

        if ($request->hasFile('fiche_technique')) {
            // Enregistrer le fichier dans le dossier public (ou un autre dossier si nécessaire)
            $file = $request->file('fiche_technique');
            $uniqueFileName = 'fncmd_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('files/commande', $uniqueFileName, 'public');
            $type = $request->input('type');
            // Ajoute un nouvel enregistrement
            (new FilePatchOfCommande())->addNew([
                'path' => $path,
                "type" => 2,
                "commande_id" => $idCmd,
                "description" => $type
            ]);

          

            return response()->json([
                "msg" => "File uploaded",
                "success" => true,
                "data" =>[
                    "path" => $path,
                   
                ]
            ], 200);

        }
        return response()->json([
            "msg" => "Error: file request ",
            "success" => false
        ], 500);


       }
    }

     public function addFile(Request $request, Commande $commande)
    {
        $validated = $request->validate([
        'commande_id' => 'required|exists:commandes,id',
        'file' => 'required|file'
    ]);

    $commande = Commande::find($validated['commande_id']);
    
    // Stocker le fichier
    $path = $request->file('file')->store('attachments');
    
    // Mettre à jour la demande
    $commande->update(['attachments' => $path,
           ]);
    

    return response()->json([
        'success' => true,
        'message' => 'Fichier ajouté avec successe'
    ]);
    } 
  
}
