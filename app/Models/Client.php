<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Client extends Model
{
    use HasFactory;


    protected $table ='client';
    /**
     * @param array $client
     * @return int
     * @throws \Exception
     */
    public  function addNew(array $client): int
    {
        $client['uuid'] = generateUniqueReference('CL_',15,'client','uuid',true);
        $client['status_id'] =Status::getIdByName('Actif');
        $client['created_at'] = date_create();
        $client['updated_at'] = date_create();
        return DB::table('client')->insertGetId($client);
    }
    /**
     *
     * @param string $email
     * @return mixed|null
     */
    public function getIdByEmail(string $email){
        $result = DB::table('client')->select('id')
            ->where('email', $email)
            ->first();
        //$result ? $result->id : null;
        return $result?->id;
    }
    /**
     *
     * @param string $email
     * @return mixed|null
     */
    public function getEmailByIdUser($user_id): mixed
    {
        $result = DB::table('users')->select('email')
            ->where('id', $user_id)
            ->first();
        return $result?->email;
    }
    public function getClientByUserId($user_id){
        return DB::table('client')->select('id','uuid','fist_name','last_name','phone_number','status_id')
            ->where('user_id', $user_id)
            ->first();
    }
    public function getClientById($client_id)
    {

        return DB::table($this->table) // Assure-toi que le nom de la table est bien 'clients'
        ->select('uuid', 'fist_name', 'last_name', 'phone_number', 'status_id','user_id') // Corrige 'fist_name' en 'first_name'
        ->where('id', $client_id)
        ->first(); // Retourne le premier résultat
    }

    public  function updateClient(string $id,array $clientInfo): int
    {
        if (isset($clientInfo['status'])) {
            $data['status_id'] = Status::getIdByName($clientInfo['status']);
        }
        $client['updated_at'] = date_create();
        return DB::table($this->table)
            ->where('id', $id)  // Trouver le client par son ID
            ->update($clientInfo);
    }

    /*
     * Relation avec model eloquente
     */


    public function commandes(): HasMany
    {
        return $this->hasMany(Commande::class, 'client_id');
    }
    
}
