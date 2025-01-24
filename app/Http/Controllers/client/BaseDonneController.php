<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\BaseDonne;
use App\Models\Commande;
use App\Models\Status;
use App\Models\Payement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseDonneController extends Controller
{
    //
    public function index(){
        $bds = (new BaseDonne())->getAllAndPaginate(10);
        return view('clients.layouts.bds.bds')->with('bds', $bds);
    }
    public function getBdDetail($uuid){
        $bd = (new BaseDonne())->getByUuidOfClient($uuid);


       // dd($bd);
        if ($bd){
            return view('clients.layouts.bds.bd-details')->with('bd',$bd);
        }
        return redirect('bds.all');
        }
        public function downloadFinalFile(Request $request) {

            $data=$request->all();

            $uuid = $request->input('uuid');
            $pay_id = $request->input('pay_id');
            $bd=(new BaseDonne())->getByUuid($uuid);
           


            if (!$bd) {
                return response()->json(['error' => 'Commande or payment not found.'], 404);
            }
    
         
    
            $filePath =$bd->path;
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

    public function newPayement(Request $request) {
        $request->validate([
            'amount_type' => 'required',
            'uuid' => 'required',
        ]);

        $data=$request->all();

        if (session()->has('clientInfo')) {
            $client = session()->get('clientInfo');
        } else {
            return response()->json([
                "msg" => "Client not connected",
                "success" => false
            ]);
        }
        if($data['pay_id']!==""){
            $payement = (new Payement())->getById($data['pay_id']);


            if($payement && $payement->status_id !== Status::getIdByName('Payer')){
              
                return response()->json([
                    "msg" => "Payment already registered",
                    "success" => true,
                    "data"=>[
                        "id"=>$payement->id,
                        "description"=>$payement->description,
                        "amount"=>(int)$payement->amount,
                        "transaction_id"=>$payement->transaction_id,
                        "reference"=>$payement->reference,
                        "client"=>$client,
                        ""
                        
                    ]
                ]);
            }
        }
        $bd=(new BaseDonne())->getByUuid($data['uuid']);

        if($bd){
            $amount_type = $data['amount_type'];
            if($amount_type =='BD'){
                $amount = $bd->amount;
                $description = "Paiement de la base de données ".$bd->name;
            }
            $pay=[
                'commande_id'=> 3,
                'base_id'=> $bd->id,
                'user_id'=> Auth::user()->id,
                'status_id'=>Status::getIdByName('En attente de paiement'),
                'amount'=> $amount,
                'description'=> $description,
                //"client"=>$client->id,
              //  'transaction_id'=>$trans
            ];
            $id_pay = (new Payement())->addNew($pay) ;
            if($id_pay){
                return response()->json([
                    "msg" => "Payment successfully registered",
                    "success" => true,
                    "data"=>[
                        "id"=>(int)$id_pay,
                        "description"=>$description,
                        "amount"=>(int)$amount,
                        "client"=>$client,
                      //  "transaction_id"=>$trans
                    ]
                ], 200);
            } 
        }
    else{
        return response()->json([
            "msg" => "Error: file request",
            "success" => false
        ], 500);
    }
    }


    public function finishPayement(Request $request){
        $data =  $request->validate([
            'id' => 'required',
            'transaction_id' => 'required',
            'reference'=>'required',
            'status'=>'required',
        ]);

        $pay = (new Payement())->getById($data['id']);
      
        $staut = "En attente";

        if($pay){
            $_pay = (new Payement())->updatePayement(
                $data['id'],
    [
                    'status_id'=>Status::getIdByName($staut),
                    'transaction_id'=> $data['transaction_id'],
                    'reference'=>$data['reference'],
                ]);
           if($_pay){
                return response()->json([
                    "msg" => "Payment successfully registered",
                    "success" => true,
                    "data"=>[
                        "transaction_id"=> $data['transaction_id'],
                       
                    ]
                ], 200);
           } 
        }else{
            return response()->json([
                "msg" => "Error: file request",
                "success" => false
            ], 500);
        }
    }


    public function confirmePayement(Request $request) {
        //Api key 
        \FedaPay\Fedapay::setApiKey("sk_live_JTay4TNNiNyZNWExXuO0Khks");
        // mode test ou live
        \FedaPay\FedaPay::setEnvironment('sandbox'); // ou setEnvironment('live');
        // Validation des données d'entrée
        $data = $request->validate([
            'pay_id' => 'required'
        ]);
        // Initialisation du statut
        $status = "En attente";
        // Récupération du paiement par ID
        $payement = (new Payement())->getById($data['pay_id']);
        if ($payement) {
            // Récupération de la transaction
            $transaction = \FedaPay\Transaction::retrieve($payement->transaction_id);
            // Vérification du statut de la transaction
        
            if ($transaction && $transaction->status === "approved") {
                $status = "Payer";
            }
            // Mise à jour du statut du paiement
            (new Payement())->updatePayement($data['pay_id'], ['status_id' => Status::getIdByName(name: $status)]);
            // Réponse JSON
            return response()->json([
                "msg" => "Paiement vérifié avec succès",
                "success" => true,
                "data" => [
                    "status" => $status,
                   "st"=>$transaction->status
                ]
            ], 200);
        }
    
        // Si le paiement n'est pas trouvé, retourner une erreur
        return response()->json([
            "msg" => "Paiement non trouvé",
            "success" => false,
        ], 404);
    }
}
