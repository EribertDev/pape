<?php
namespace App\Http\Controllers\client;

use App\Models\ProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectReceived;
use App\Mail\NewProject;
use App\Models\User;
use App\Models\Payement;
use App\Models\Status;


class ProjectRequestController extends Controller
{
    public function create()
    {
        return view('clients.layouts.project.create');
    }

    public function dashClient()
    {

        $requests = ProjectRequest::where('user_id', Auth::id())->get();
        return view('clients.layouts.dash.project')->with('requests', $requests);
    }

    public function show(ProjectRequest $projectRequest)
    {
        $project = ProjectRequest::with('user.client')->findOrFail($projectRequest->id);
        return view('clients.layouts.dash.project_details', compact('project'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'problem' => 'required|string',
            'general_objective' => 'required|string',
            'specific_objectives' => 'required|string',
            'beneficiaries' => 'required|string',
            'partners' => 'required|string',
            'budget' => 'required|numeric|min:0',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Gestion du fichier
      if ($request->hasFile('document')) {
           $file = $request->file('document');
       
        $path = $file->store('project_documents');
        } else {
            $path = null;
        }
         

        $projectRequest = ProjectRequest::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'problem' => $validated['problem'],
            'general_objective' => $validated['general_objective'],
            'specific_objectives' => $validated['specific_objectives'],
            'beneficiaries' => $validated['beneficiaries'],
            'partners' => $validated['partners'],
            'budget' => $validated['budget'],
            'document_path' => $path,
        ]);

                // Mail à l'administrateur
            Mail::to('serviceclient@cesiebenin.com')->send(new NewProject($projectRequest));
            
            // Mail à l'utilisateur
            Mail::to($projectRequest->user->email)->send(new ProjectReceived($projectRequest));

        return redirect()->route('project_request.confirmation', $projectRequest);
    }

    public function confirmation(ProjectRequest $projectRequest)
    {
        return view('clients.layouts.project.comfirmation', compact('projectRequest'));
    }




    
    public function newPayement(Request $request) {
        $request->validate([
            'amount_type' => 'required',
            'id' => 'required',
        ]);

        $amount = $request->amount;

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
        $project= ProjectRequest::find($data['id']);

        if($project){
            $amount_type = $data['amount_type'];
            if($amount_type =='PROJECT'){
                $amount = $amount;
                $description = "Paiement pour le projet ".$project->title;
            }
            $pay=[
                'commande_id'=> 3,
                'project_id'=> $project->id,
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
                    "id"=>$pay->id,
                    "data"=>[
                        "transaction_id"=> $data['transaction_id'],
                        "id"=>$pay->id,
                        
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
        \FedaPay\FedaPay::setApiKey("sk_sandbox_WHk3VWXx2OoC_xzCkpI8UCqg");
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
                ProjectRequest::where('id', $payement->project_id)->update(['status' => 'paid',
            'updated_at' => date('Y-m-d H:i:s') ]);
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
