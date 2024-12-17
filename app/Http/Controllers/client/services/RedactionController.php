<?php

namespace App\Http\Controllers\client\services;

use App\Http\Controllers\Controller;
use App\Models\Discipline;
use App\Models\ThemeMemoire;
use App\Models\TypeOfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nnjeim\World\WorldHelper;

class RedactionController extends Controller
{
    /**
     * @throws \JsonException
     */
    
    public function __invoke(Request $request,WorldHelper $world)
    {
       $countries=$world->countries()->data;
      $user=Auth::user();
        $data =  [
            'typeService'=>TypeOfService::getAll(),
            'discipline'=>Discipline::getAll(),
            'TMs'=>(new ThemeMemoire())->getAll(),
        ];

     //  dd(TypeOfService::getAll());
        $options =$data;

        // Retourner la vue avec les données
       return view('clients.layouts.services.redaction-1')->with('options',$options,)->with('countries',$countries)->with('user',$user);
    }
}
