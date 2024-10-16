<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Status;
use App\Models\Commande;
use App\Models\Payement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class DashController extends Controller
{
    //
    public function __invoke(Request $request)
    {

      /*  if (Role::getNameById(Auth::user()->role_id) == "Affiliator") {
            # code...
        }*/
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
