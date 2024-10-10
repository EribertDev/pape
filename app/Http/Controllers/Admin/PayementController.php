<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payement;
use Illuminate\Http\Request;

class PayementController extends Controller
{
    //
    public function index(){
        // $cmds = (new Commande())->getAllCommandes();
        return view('admin.layouts.payement.payements');
    }
    //récupérer tout les payemnets
    public function getAllPayement(){

        try {
            $payt = (new Payement())->getAll();
            $payement = $payt->toArray();
            if (!empty($payement)){
                return response()->json($payement,200);
            }
            return response()->json($payement,200);

        }catch (\Exception $e){
            return response()->json([],200);
        }
    }
}
