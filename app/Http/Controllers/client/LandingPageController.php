<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\BaseDonne;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function __invoke(Request $request)
    {
       // $catThemes = Categorie::getAllSelectField(['id','name','info']);
       // $bd = (new BaseDonne())->getByMarge(4,["reference","name","amount","uuid"]);
        $data = [
        //    "categories"=>$catThemes,
        //    "bd"=>$bd,
        ];

        // Retourner la vue avec les données
        return view('clients.layouts.landing-page-1')->with("data",$data);
    }

}
