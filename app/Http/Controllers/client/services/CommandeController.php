<?php

namespace App\Http\Controllers\client\services;

use App\Http\Controllers\Controller;
use App\Mail\NotificationServiceClient;
use App\Mail\OrderReceivedSuccessfully;
use App\Models\Admin;
use App\Models\Affiler;
use App\Models\Commande;
use App\Models\Discipline;
use App\Models\FilePatchOfCommande;
use App\Models\NaturePayment;
use App\Models\Payement;
use App\Models\Status;
use App\Models\ThemeMemoire;
use App\Models\TypeOfService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CommandeController extends Controller
    
{


    public function newCommande(Request $request){

        $validated = $request->validate([
            'subject' => 'required|string',
            'deadline' => 'nullable|date',
            'codeAf'=>  'required|Integer',
            'universite'=>'nullable|string',
            'pays' => 'required|string',
            'type_universite' => 'required|string',
           'structure_stage' => 'nullable|string',
            'commune_stage' => 'nullable|string',

        ]);

        $status ='En attente';//
        $data = $request->all();
        $data["typeService"]=TypeOfService::getByReference($data["typeService"]);
        $prix =  $data["typeService"]->prix;

        //si un theme de la bibliothèque est choisir
        if ($request->has('choose_theme')) {
            $request->validate([
                'theme' => 'required',
            ], [
                'theme.required' => "Le thème est requis."
            ]);
            $theme_uuid = $request->input('theme');
            $tm =(new ThemeMemoire())->getByUuid($theme_uuid);
            $theme_id =$tm?->id;
            $protocoles = json_decode($tm->path, true);
            $service_name= $data["typeService"]->name ;
            switch ($service_name ) {
                case 'Protocole licence':
                    $protocole = $protocoles['licence'];
                    break;
                case 'Protocole Master':
                    $protocole = $protocoles['master'];
                    break;
                case 'Protocole Doctorat':
                    $protocole = $protocoles['doctorat'];
                    break;
                default:
                    # code...
                    break;
            }
            $theme_redactor =$tm?->redactor_id;
            if (isset($protocole)&&$protocole!= '') {
               $status = 'Traiter';
               $data["protocole"]=$protocole;
               $prix +=3000;
            }
        } else {
            $theme_id = NULL; // Définir theme_id à null si la case n'est pas cochée
            $theme_redactor =NULL;
        }
        //
        if ($request->hasFile('descrip_file')) {
            $request->validate([
                'descrip_file' => 'nullable|file|mimes:docx,pdf,doc',
            ], [
                'descrip_file.file' => "Erreur : le fichier doit être un fichier valide.",
                'descrip_file.mimes' => "Erreur : le fichier doit être au format docx, pdf ou doc.",
            ]);
        }
        //
           // try{
                $data["dicipline"]=Discipline::getNameAndIdByReference($data["dicipline"]);
                $client = session()->get("clientInfo");
                $affilier = (new Admin())->getByCode($data['codeAf']);
                $availableCodesAf = DB::table('admins')->pluck('code_af')->toArray();
                $codeAfInput=$codeAfInput = $data['codeAf']; // Code AF saisi par l'utilisateur


                if (in_array($codeAfInput, $availableCodesAf)) {
                    // Appliquer une réduction de 30% au montant
                    $discountedAmount = $prix * 0.7;
                    $discountedAmount = round($discountedAmount / 100) * 100;
                
                }   
                    else {
                      $discountedAmount= $prix;
                    }


            
              
               
                if($affilier){
                    $affilier_id = $affilier->id;
                }else{
                    $affilier_id = NULL;
                }
             
                $idCommande = (new Commande())->addNew([
                    'client_id' => $client->id,
                    'services_id' => $data["typeService"]->id,
                    'discipline_id' => $data["dicipline"]->id,
                    'subject' => $data["subject"],
                    'description' => $data["description"],
                    
                    'deadline' => $data["deadline"],
                    'theme_memoire_id' => $theme_id,
                    'amount'=>  $discountedAmount,
                    'redactor_id'=> $theme_redactor,
                    'admin_af_id'=> $affilier_id,
                    'status_id'=>Status::getIdByName($status),
                    'universite'=>  $data["universite"],
                    'pays' => $data["pays"],
                    'type_universite' => $data["type_universite"],
                    'structure_stage' =>  $data["structure_stage"],
                    'commune_stage' =>  $data["commune_stage"],
                ]);

                if ($request->hasFile('descrip_file')) {
                    $fileBd = $request->file('descrip_file');
                    $finalDestinationPath = 'files/commande';
                    $uniqueFileName = 'cmd_'.time(). '.' . $fileBd->getClientOriginalExtension(); // Utilisation de UUID
                    $path = $fileBd->storeAs( $finalDestinationPath, $uniqueFileName, 'public');
                    $filCmd = new FilePatchOfCommande();
                    $filCmd->addNew(['commande_id'=>$idCommande,'path'=>  $path ,'description'=>'fichier commande'.$idCommande]);
                }
                if (isset($protocole)&&$protocole!= '') {
                    $filCmd = new FilePatchOfCommande();
                    $filCmd->addNew(['commande_id'=>$idCommande,'path'=>  $protocole ,'type'=>true,'description'=>'fichier finale de la commande']);
                 }
                
                 
                Mail::to(Auth::user()->email)->send(new OrderReceivedSuccessfully());
                
                session()->put('idCmd',$idCommande);
                return response()->json([
                    "msg" => "successfully commande add",
                    "success"=>true,
                    "data"=>["idCmd"=>$idCommande]],200);
           /* } catch (\Exception|NotFoundExceptionInterface|ContainerExceptionInterface $e) {
                return response()->json([
                    "msg" => "Error",
                    "success"=>false,
                    ],500);
            }*/
    }
    /**
     * Fonction de vérification de l'information de la commande
     **/
    public function verifyCommande(Request $request): JsonResponse
   {
       /* $validated = $request->validate($rules, [
            'subject.required' => "Le sujet est requis.",
            'nbrPage.required' => "Le nombre de pages est requis.",
            'deadline.required' => "La date limite est requise.",
            'theme.required' => "Le thème est requis si la case à cocher est cochée.",
            'email.email' => "L'email doit être une adresse valide.",
        ]);*/

   //  try {
    
            $request->validate([
        
            'subject' => 'required|string',
            'deadline' => 'nullable|date',
            'codeAf'=>  'required|Integer',
            'universite'=>'nullable|string',
            'pays' => 'required|string',
            'type_universite' => 'required|string',
           'structure_stage' => 'nullable|string',
            'commune_stage' => 'nullable|string',
           ]);
            
           if ($request->has('choose_theme')) {
                $request->validate([
                    'theme' => 'required',
                ], [
                    'theme.required' => "Le thème est requis."
                ]);

                $theme_uuid = $request->input('theme');
                $tm =(new ThemeMemoire())->getByUuid($theme_uuid);
                $theme_id =$tm?->id;
                $theme_redactor =$tm?->redactor_id;
            } else {
                $theme_id = NULL; // Définir theme_id à null si la case n'est pas cochée
                $theme_redactor =NULL;
            }
            // else {

            // }

            $data = $request->all();
           
            $data["typeService"]=TypeOfService::getByReference($data["typeService"]);
           // $typeService =TypeOfService::getByReference($data["typeService"]);
           // dd($typeService);
           // $data["typeService"] = $typeService->id;
           // $data["academicLevel"]=AcademicLevel::getNameAndIdByReference($data["academicLevel"]);
            $data["dicipline"]=Discipline::getNameAndIdByReference($data["dicipline"]);
            $client = session()->get("clientInfo");
        
            $idCommande = (new Commande())->addNew([
             'client_id' => $client->id,
             'services_id' => $data["typeService"]->id,
             'discipline_id' => $data["dicipline"]->id,
             'subject' => $data["subject"],
             'description' => $data["description"],
             'max_pages' => $data["nbrPage"],
             'deadline' => $data["deadline"],
             'universite'=>  $data["universite"],
             'pays' => $data["pays"],
             'type_universite' => $data["type_universite"],
             'structure_stage' =>  $data["structure_stage"],
            'commune_stage'=>$data["commune_stage"],
             'theme_memoire_id' => $theme_id,
             'amount'=> $data["montantFinalInput"],
             'redactor_id'=> $theme_redactor,
         ]);
         /*$tmpFiles = Session::get('tmp_files', []);
         if (!empty($tmpFiles)) {
             $finalDestinationPath = 'files/commande';
             if (!Storage::disk('public')->exists($finalDestinationPath)) {
                 Storage::disk('public')->makeDirectory($finalDestinationPath);
             }
             foreach ($tmpFiles as $tmpFile) {
                 $tmpFilePath = storage_path('app/public/tmp/uploads/' . $tmpFile['name']);
                 if (Storage::disk('public')->put($finalDestinationPath . '/' . $tmpFile['name'], file_get_contents($tmpFilePath))) {
                     $filePath = $finalDestinationPath . '/' . $tmpFile['name'];
                     // $filePath = $finalDestinationPath . '/' . $tmpFile['name'];
                     $filCmd = new FilePatchOfCommande();
                     $filCmd->addNew(['commande_id'=>$idCommande,'path'=>$filePath ,'description'=>'fichier commande']);
                     // Supprimer le fichier temporaire après l'avoir déplacé
                     unlink($tmpFilePath);
                 }
             }
         }*/
        // Session::forget('tmp_files');
         Mail::to(Auth::user()->email)->send(new OrderReceivedSuccessfully());
       
        
        
             session()->put('idCmd',$idCommande);
         return response()->json([
             "msg" => "successfully commande add",
             "success"=>true,
             "data"=>["idCmd"=>$idCommande]],200);
      /* } catch (\Exception|NotFoundExceptionInterface|ContainerExceptionInterface $e) {
         return response()->json([
             "msg" => "Error",
             "success"=>false,
             ],500);
     }*/
   }
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \Exception
     */
    public function finalization(Request $request): JsonResponse
    {
        $public_key ="fab719f0567911ef8f9dbde1664618ec";
        $private_key="tpk_fab719f2567911ef8f9dbde1664618ec";
        $secret ="tsk_fab719f3567911ef8f9dbde1664618ec";
        try{
            //vérification de la transation;
            $transaction_id = $request->get("transactionId");
          /*  $kkiapay = new \Kkiapay\Kkiapay($public_key, $private_key, $secret, $sandbox = true);
            $transaction =$kkiapay->verifyTransaction($transaction_id);
            $transaction_statut = $transaction->status;*/
           // var_dump($data);

        /*$transaction_statut==="SUCCESS"*/
            if (true) {
                $data = session()->get('validatedData');
                $client = session()->get("clientInfo");
                $commande = new Commande();
                $idCommande = $commande->addNew([
                    'client_id' => $client->id,
                    'services_id' => $data["typeService"]->id,
                    'type_document_id' => $data["typeDocument"]->id,
                    'academic_level_id' => $data["academicLevel"]->id,
                    'discipline_id' => $data["dicipline"]->id,
                    'subject' => $data["subject"],
                    'description' => $data["description"],
                   
                    'deadline' => $data["deadline"],
                    'pays' => $data["pays"],
                    'type_universite' => $data["type_universite"],
                    'structure_stage' =>  $data["structure_stage"],
                   'commune_stage'=>$data["commune_stage"],
                    
                ]);
                $payemment = new Payement();
                //ajout payement prise de contacte
                $payemment->addNew([
                    'commande_id' => $idCommande,
                    'status_id' => Status::getIdByName('Payer'),
                    'nature_payement_id' => NaturePayment::getIdByName('Prise contact'),
                    'amount' => $data["freeContact"],
                    'transaction_id' => $transaction_id,
                ]);
                //ajout payement cout
                $payemment->addNew([
                    'commande_id' => $idCommande,
                    'status_id' => Status::getIdByName('En attente de paiement'),
                    'nature_payement_id' => NaturePayment::getIdByName('Service'),
                    'amount' => $data["cost"],
                ]);
                //stockage des fichiers de la commande
                // Récupérer les fichiers temporaires de la session
                $tmpFiles = Session::get('tmp_files', []);
                if (!empty($tmpFiles)) {
                    $finalDestinationPath = 'files/commande';
                    if (!Storage::disk('public')->exists($finalDestinationPath)) {
                        Storage::disk('public')->makeDirectory($finalDestinationPath);
                    }
                    foreach ($tmpFiles as $tmpFile) {
                        $tmpFilePath = storage_path('app/public/tmp/uploads/' . $tmpFile['name']);
                        if (Storage::disk('public')->put($finalDestinationPath . '/' . $tmpFile['name'], file_get_contents($tmpFilePath))) {
                            $filePath = $finalDestinationPath . '/' . $tmpFile['name'];
                           // $filePath = $finalDestinationPath . '/' . $tmpFile['name'];
                           $filCmd = new FilePatchOfCommande();
                           $filCmd->addNew(['commande_id'=>$idCommande,'path'=>$filePath ,'description'=>'fichier commande']);
                            // Supprimer le fichier temporaire après l'avoir déplacé
                            unlink($tmpFilePath);
                        }
                    }
                }
                Session::forget('tmp_files');
                Mail::to(Auth::user()->email)->send(new OrderReceivedSuccessfully());
                return response()->json(["message" => "success"]);
            }
          //  return response()->json(["message" => "echec"]);
        } catch (\Exception|NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            return response()->json([
                'error' => $e
            ], 500);
        }
    }


    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function commandeFinish($idCmd)
    {
        // Récupération de l'idCmd stocké dans la session
        $_idCmd = session()->get('idCmd');
        // Vérifier si l'ID de la commande passée correspond à celui de la session
        if (!($_idCmd === $idCmd)) {
            // Supprimer la clé 'idCmd' de la session
            session()->forget('idCmd');

            Mail::to('serviceclient@cesiebenin.com')->send(new NotificationServiceClient());

            // Retourner la vue de confirmation
            return view('clients.layouts.services.commande-finish');
        }
        // Si les IDs ne correspondent pas, rediriger vers la page précédente
        return back();
    }
    public function commandeStatus()
    {
        return view('clients.layouts.services.commande-status');
    }

    public function downloadFinalFile(Request $request) {
        $uuid = $request->input('uuid');
        $cmd = (new Commande())->getCommandeByUuid($uuid);
        $lastPayment = $cmd->payments->last();
        if (!$cmd || !$cmd->payments) {
            return response()->json(['error' => 'Commande or payment not found.'], 404);
        }

        if ($lastPayment->status_id !== Status::getIdByName('Payer')) {
            return response()->json(['error' => 'Payment status not valid for download.'], 403);
        }

        $filePath = (new Commande())->getFinaleFileByUuid($uuid);
        if (!$filePath) {
            return response()->json(['msg' => 'File not found', 'success' => false], 200);
        }

        $path = storage_path('app/public/' . $filePath);
        if (!file_exists($path)) {
            return response()->json(['msg' => 'File not found on server.', 'success' => false], 200);
        }

        $fileContent = file_get_contents($path);
        $base64 = base64_encode($fileContent);

       
        // Identifier le type MIME pour le fichier
        $mimeType = mime_content_type($path);
    

        return response()->json([
            'msg' => 'File downloaded',
            'filename' => time(),
            'data' => 'data:' . $mimeType . ';base64,' . $base64,
            'success' => true,
        ], 200);

    }

}