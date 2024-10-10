<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Commande;

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
                return view('clients.layouts.dash.commande-detail')->with('commande', $commande);
            }
        return redirect()->route('dash.client');
    }
}
