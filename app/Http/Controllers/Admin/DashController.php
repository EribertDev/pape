<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Status;
use App\Models\Commande;
use App\Models\Payement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Cache\ArrayStore;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class DashController extends Controller
{
    //
    public function __invoke(Request $request)
    {
        $data=[];

       if (Role::getNameById(Auth::user()->roles_id) == "Affilier") {
            $code_af = (new Admin())->where('user_id', Auth::user()->id)->first()->code_af;
            if ($code_af !== null) {
                $afTotalMonth = (new Commande())->getTotalCommandeByAffiliateCodeForMonth($code_af, date('m'), date('Y'));
                $monthGain = 1000*$afTotalMonth;
               // dd($afTotalMonth);

                $data = [
                        'code_af' => $code_af,
                        'afTotalMonth' => $afTotalMonth,
                        'monthGain' => $monthGain
                ];
            }
        }else{
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
        }

        // Retourner la vue avec les données
        return view('admin.layouts.dash')->with("data",$data);
    }

}
