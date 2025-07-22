<?php

namespace App\Http\Controllers\client\services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __invoke(Request $request)
    {




        // Exemple de données à passer à la vue
        /* $data = [
             'title' => 'Bienvenue sur notre site',
             'description' => 'Ceci est une description exemple pour notre page.'
         ];*/

        // Retourner la vue avec les données
        return view('clients.layouts.services.services', ['type' => $type]);
    }

      public function showOffers()
    {
        return view('clients.layouts.services.offre');
    }

   
}
