<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Affiler extends Model
{
    use HasFactory;
    
    /**
     * Ajouter un membre a l'equipe
     * @throws \Exception
     */
    public  function addNew(array $affilers): int
    {
       // $affilers['code'] = generateUniqueReference('',8,'affilers','code',true);
        $affilers['status_id'] =Status::getIdByName('Actif');
        $affilers['created_at'] = date_create();
        $affilers['updated_at'] = date_create();
        return DB::table('affilers')->insertGetId($affilers);
    }

    /**
     * recuperation d'un membre par ca reference
     * @param $reference
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public function getByCode($code)
    {
        return self::where('code', $code)->first();
    }
   
}
