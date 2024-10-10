<?php

namespace App\Http\Controllers\client;

use App\Models\Commande;
use App\Models\Payement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Status;

class PayementController extends Controller
{
    //
    public function newPayCommande(Request $request){
       
       $request->validate([
            'amount_type' => 'required',
            'uuid' => 'required',
        ]);
        
        $data =  $request->all();
       

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
                    ]
                ]);
            }
        }
        $commande = (new Commande())->getCommandeByUuid($data['uuid']);
        if($commande){
            $amount_type = $data['amount_type'];
            if($amount_type =='PC'){
                $amount = 3000;
                $description = "payement de la prise de contact";
            }else if($amount_type == 'PS'){
                $amount = $commande->amount;
                $description = "payement des frais de services";
            }
            //$trans = generateUniqueReference('',12,'payements','transaction_id',true,'digits');
            $pay=[
                'commande_id'=> $commande->id,
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
        }else{
            return response()->json([
                "msg" => "Error: file request",
                "success" => false
            ], 500);
        }
        //PC,PS

    }

    public function finishPayement(Request $request){
        $data =  $request->validate([
            'id' => 'required',
            'transaction_id' => 'required',
            'reference'=>'required',
            'status'=>'required',
        ]);

        $pay = (new Payement())->getById($data['id']);
        $commande = (new Commande())->getById($pay->commande_id);
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
                        "cmd_ref"=>$commande->reference,
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
        \FedaPay\FedaPay::setApiKey("sk_sandbox_c3_O0SRDtrnAamS6SLwReQpP");
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
                ]
            ], 200);
        }
    
        // Si le paiement n'est pas trouvé, retourner une erreur
        return response()->json([
            "msg" => "Paiement non trouvé",
            "success" => false,
        ], 404);
    }
    
    public function reclamation(){
        return view('clients.layouts.dash.reclamation');
    }
}
