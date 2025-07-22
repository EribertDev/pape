<?php

namespace App\Http\Controllers\client\services;

use App\Http\Controllers\Controller;
use App\Models\Discipline;
use App\Models\ThemeMemoire;
use App\Models\TypeOfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Nnjeim\World\WorldHelper;

class RedactionController extends Controller
{
    /**
     * @throws \JsonException
     */
    
    public function __invoke(Request $request,WorldHelper $world,$type = 'standard')
    {
    $countries=$world->countries()->data;
   
     $validTypes = ['vip', 'standard'];
    $type = in_array(strtolower($type), $validTypes) ? strtolower($type) : 'standard';
      $user=Auth::user();
        $data =  [
            'typeService'=>TypeOfService::getAll(),
            'discipline'=>Discipline::getAll(),
            'TMs'=>(new ThemeMemoire())->getAll(),
           
        ];

        $codesPromoValides= DB::table('admins')->pluck('code_Af'); 

       $departements = [
                'Alibori' => [
                    'Banikoara', 'Gogounou', 'Kandi', 'Karimama', 'Malanville', 'Ségbana'
                ],
                'Atacora' => [
                    'Boukoumbé', 'Cobly', 'Kérou', 'Kouandé', 'Matéri', 'Natitingou', 'Péhunco', 'Tanguiéta', 'Toucountouna'
                ],
                'Atlantique' => [
                    'Abomey-Calavi', 'Allada', 'Kpomassè', 'Ouidah', 'Sô-Ava', 'Toffo', 'Tori-Bossito', 'Zè'
                ],
                'Borgou' => [
                    'Bembèrèkè', 'Kalalé', 'N\'Dali', 'Nikki', 'Parakou', 'Pèrèrè', 'Sinendé', 'Tchaourou'
                ],
                'Collines' => [
                    'Bantè', 'Dassa-Zoumè', 'Glazoué', 'Ouèssè', 'Savalou', 'Savè'
                ],
                'Couffo' => [
                    'Aplahoué', 'Djakotomey', 'Dogbo', 'Klouékanmè', 'Lalo', 'Toviklin'
                ],
                'Donga' => [
                    'Bassila', 'Copargo', 'Djougou', 'Ouaké'
                ],
                'Littoral' => [
                    'Cotonou'
                ],
                'Mono' => [
                    'Athiémé', 'Bopa', 'Comè', 'Grand-Popo', 'Houéyogbé', 'Lokossa'
                ],
                'Ouémé' => [
                    'Adjarra', 'Adjohoun', 'Aguégués', 'Akpro-Missérété', 'Avrankou', 'Bonou', 'Dangbo', 'Porto-Novo', 'Sèmè-Podji'
                ],
                'Plateau' => [
                    'Adja-Ouèrè', 'Ifangni', 'Kétou', 'Pobè', 'Sakété'
                ],
                'Zou' => [
                    'Abomey', 'Agbangnizoun', 'Bohicon', 'Covè', 'Djidja', 'Ouinhi', 'Zagnanado', 'Za-Kpota', 'Zogbodomey'
                ],
  ] ;

      
     //  dd(TypeOfService::getAll());
        $options =$data;

        // Retourner la vue avec les données
       return view('clients.layouts.services.redaction-1',['type' => $type])->with('options',$options,)->with('countries',$countries)->with('user',$user)->with('codesPromoValides',$codesPromoValides)->with('departements',$departements);
    }



   
  
    
}
