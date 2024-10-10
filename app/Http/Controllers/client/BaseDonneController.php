<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\BaseDonne;
use App\Models\Commande;
use Illuminate\Http\Request;

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
}
