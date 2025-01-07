<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Mail\ProtocolReadyMail;
use App\Models\Commande;
use App\Models\FilePatchOfCommande;
use App\Models\Payement;
use App\Models\ThemeMemoire;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ClientDashController extends Controller
{
    //
    public function index(){
        $commandes = (new Commande())->getAllCommandeByClientId(session()->get("clientInfo")->id);
        if ($commandes){
            return view('clients.layouts.dash.dash-client')->with('commandes', $commandes);
        }
        return view('clients.layouts.dash.dash-client');
    }

    public function commandeDetaile($uuid){
        $commande = (new Commande())->_getCommandeByUuid($uuid);
        //dd($commande->payments);
        if ($commande){

            $totalPaid = $commande->payments->where('status_id', '20')->sum('amount');

            // Vérifier si le montant total attendu est atteint
            if ($totalPaid >= $commande->amount) {
        
               
                $pendingOrders = Payement::where('commande_id', $commande->id)
                                ->whereIn('status_id', [3, 21])
                                ->get();
        
                // Supprimer les commandes en attente
                foreach ($pendingOrders as $pendingOrder) {
                    $pendingOrder->delete();
                }
            }

                $theme_id =$commande->theme_memoire_id;
                $files = FilePatchOfCommande::where('commande_id', $commande->id)->get();

                 $tm = ThemeMemoire::where('id',$theme_id)->first();     
               
                   
                if(  $theme_id && $files->isEmpty() &&
                
                (
                    !empty($protocoles['licence']) || 
                    !empty($protocoles['master']) || 
                    !empty($protocoles['doctorat'])
                )
                )  {
                    $protocoles = json_decode($tm->path, true);
                    $service_name=$commande->services_id;
                    
                   
                    if($service_name =='5' )  {
                      

                        $file =$protocoles['licence'];

                            $pathInfo = pathinfo($file); // Récupère des informations sur le fichier
                          $extension = $pathInfo['extension']; // Récupère l'extension du fichier

                          $uniqueFileName = 'fncmd_' . time() . '.' . $extension; // Conserve l'extension d'origine

                          $destinationPath = 'files/commande';
                          $newPath = $destinationPath . '/' . $uniqueFileName;
                          
                          // Copier le fichier source vers le nouvel emplacement
                          if (Storage::exists('public/' . $file)) {
                              Storage::copy('public/' . $file, 'public/' . $newPath);
                           
                          
                            $type = "protocole_repertoire";
                            // Ajoute un nouvel enregistrement
                            (new FilePatchOfCommande())->addNew([
                                'path' => $newPath,
                                "type" => 1,        
                                "commande_id" => $commande->id,
                                "description" => $type
                            ]);
                         $cmdStatus="Traiter";
                        (new Commande())->updateCommandeStatusByUuid($commande->uuid,$cmdStatus);
                        $clientEmail = Auth::user()->email;
                         $theme = $commande->subject;  // Exemple pour inclure des détails du thème
                         $service = 'Protocole Licence';
                         $client = $commande->client->fist_name;
                         
                         Mail::to($clientEmail)->send(new ProtocolReadyMail($client,$theme,$service));
                         }
                        }
                         elseif($service_name =='6')
                           {
                            $file =$protocoles['doctorat'];

                            $pathInfo = pathinfo($file); // Récupère des informations sur le fichier
                            $extension = $pathInfo['extension']; // Récupère l'extension du fichier

                            $uniqueFileName = 'fncmd_' . time() . '.' . $extension; // Conserve l'extension d'origine

                            $destinationPath = 'files/commande';
                            $newPath = $destinationPath . '/' . $uniqueFileName;
                            
                            // Copier le fichier source vers le nouvel emplacement
                            if (Storage::exists('public/' . $file)) {
                                Storage::copy('public/' . $file, 'public/' . $newPath);
                            
                            
                            $type = "protocole_repertoire";
                            // Ajoute un nouvel enregistrement
                            (new FilePatchOfCommande())->addNew([
                                'path' => $newPath,
                                "type" => 1,
                                "commande_id" => $commande->id,
                                "description" => $type
                            ]);
                         $cmdStatus="Traiter";
                         (new Commande())->updateCommandeStatusByUuid($commande->uuid,$cmdStatus);
                         $clientEmail = Auth::user()->email;
                         $theme = $commande->subject;  // Exemple pour inclure des détails du thème
                         $service = 'Protocole Doctorat';
                         $client = $commande->client->fist_name;
                         
                         Mail::to($clientEmail)->send(new ProtocolReadyMail($client,$theme,$service));
                         
                        }          
                    }

                    elseif($service_name =='4')
                    {
                            $file =$protocoles['master'];

                            $pathInfo = pathinfo($file); // Récupère des informations sur le fichier
                            $extension = $pathInfo['extension']; // Récupère l'extension du fichier

                            $uniqueFileName = 'fncmd_' . time() . '.' . $extension; // Conserve l'extension d'origine

                            $destinationPath = 'files/commande';
                            $newPath = $destinationPath . '/' . $uniqueFileName;
                            
                            // Copier le fichier source vers le nouvel emplacement
                            if (Storage::exists('public/' . $file)) {
                                Storage::copy('public/' . $file, 'public/' . $newPath);
                            
                            
                            $type = "protocole_repertoire";
                            // Ajoute un nouvel enregistrement
                            (new FilePatchOfCommande())->addNew([
                                'path' => $newPath,
                                "type" => 1,
                                "commande_id" => $commande->id,
                                "description" => $type
                            ]);
                         $cmdStatus="Traiter";
                         (new Commande())->updateCommandeStatusByUuid($commande->uuid,$cmdStatus);
                         $clientEmail = Auth::user()->email;
                         $theme = $commande->subject;  // Exemple pour inclure des détails du thème
                         $service = 'Protocole Master';
                         $client = $commande->client->fist_name;
                         
                         Mail::to($clientEmail)->send(new ProtocolReadyMail($client,$theme,$service));
                        }          
                    }
    

                }   
                           
                
               








 



            return view('clients.layouts.dash.commande-detail')->with('commande', $commande);
            }
        return redirect()->route('dash.client');
    }
}


