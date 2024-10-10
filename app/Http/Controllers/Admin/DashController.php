<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Commande;
use App\Models\Payement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Status;

class DashController extends Controller
{
    //
    public function __invoke(Request $request)
    {
    
        $clientsTotal = (new Client())->count();
        $paymentTotal = (new Payement())->where('status_id', Status::getIdByName('Payer'))->sum('amount');
        $commandeTotal = (new Commande())->count();
        $commandeTraiterTotal = (new Commande())->where('status_id', Status::getIdByName('Traiter'))->count();
        $data = [
            'clientsTotal'=> $clientsTotal,
            'payementTotal'=> $paymentTotal,
            'commandeTotal'=> $commandeTotal,
            'commandeTraiterTotal'=> $commandeTraiterTotal,
        ];
        // Retourner la vue avec les données
        return view('admin.layouts.dash')->with("data",$data);
    }

}
