<?php

namespace App\Models;

use Carbon\Carbon;
use Faker\Core\File;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commande extends Model
{
    use HasFactory;

    protected $table ='commandes';
    /**
     * @param array $commande
     * @return int
     * methode d'ajout d'une nouvelle commande
     * @throws \Exception
     */
    public  function addNew(array $commande): int
    {
        $commande['reference'] = generateUniqueReference('CM_',15,$this->table,'reference',true);
        $commande['uuid'] = Str::uuid();
        $commande['created_at'] = date_create();
        $commande['updated_at'] = date_create();
        return DB::table($this->table)->insertGetId($commande);
    }

    /**
     * Récupérer tout les commandes
     * @return \Illuminate\Database\Eloquent\Collection|array
     */
    public function getAllCommandes(): \Illuminate\Database\Eloquent\Collection|array
    {
        return self::with(['client', 'status', 'service', 'typeDocument', 'discipline', 'academicLevel', 'payments', 'filesPath'])
        ->orderBy('commandes.updated_at', 'desc')
        ->get();
    }

    /**
     * Fonctions de récupération des commandes en fonction des statuses
     * @return \Illuminate\Database\Eloquent\Collection|array
     */
    public function getAllCommandesWhereStatusIs(array $status): \Illuminate\Database\Eloquent\Collection|array
    {
        return self::with(['client', 'status', 'service', 'typeDocument', 'discipline', 'academicLevel', 'payments', 'filesPath'])
        ->whereHas('status', function($query) use ($status) {
            $query->whereIn('name', $status);
        })
        ->orderBy('commandes.updated_at', 'desc')
        ->get();
    }

    public function getCommandeWhereStatusIsNot(array $status): \Illuminate\Database\Eloquent\Collection|array
    {
        return self::with(['client', 'status', 'service', 'typeDocument', 'discipline', 'academicLevel', 'payments', 'filesPath'])
            ->whereHas('status', function($query) use ($status) {
                $query->whereIn('name',$status);
            })
            ->get();
    }

    //recuper les commandes en fontion de l'id client
    public function getAllCommandeByClientId($clientId): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return DB::table($this->table)
            ->select('commandes.uuid', 'commandes.subject', 'commandes.description', 'statuses.name as status_name')
            ->where('commandes.client_id', $clientId)
            ->join('statuses', 'commandes.status_id', '=', 'statuses.id')
            ->where('statuses.name', '!=', 'Supprimé')
            ->orderBy('commandes.id', 'desc') // Spécification de la table pour l'ID
            ->paginate(5);
    }


    public function getTotalCommandeByAffiliateCodeForMonth($affiliateCode, $month, $year)
    {
        // Définir le début et la fin du mois
        $startDate = Carbon::createFromDate($year, $month, 1);
        $endDate = $startDate->copy()->endOfMonth();
        // Compter les commandes de l'utilisateur pour le mois
        $totalOrders = Commande::where('affilier_id', $affiliateCode)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
        return $totalOrders;
    }


    public function getCommandeByUuid($commandeUuid)
    {
        return self::where("uuid", $commandeUuid)
        ->with([
            'client',
            'status',
            'service',
            'discipline',
            'redactor',
            'payments',
            'filesPath'
        ])
        ->first();
    }
    //
    public function _getCommandeByUuid($commandeUuid)
    {
        return self::where("uuid", $commandeUuid)
            ->with([
                'client',
                'status',
                'service',
                'discipline',
                'redactor',
                'payments',
                'filesPath' => function ($query) {
                    $query->where('type', 0); // Filtrer uniquement les filesPath avec type = 0
                }
            ])
            ->first();
    }
    //
    public function getIdByUuid($uuid)
    {
       $cmd = DB::table($this->table)
           ->select('id')
           ->where('uuid',$uuid)
           ->first();
       return $cmd?->id;
    }
    //
    public function getDateLimit()
    {
        $aujourdhui = Carbon::now();
        return DB::table($this->table)
        ->select('deadline')
        ->where('deadline', '>', $aujourdhui) // Filtrer pour les dates futures
        ->groupBy('deadline')
        ->havingRaw('COUNT(*) < 2')
        ->orderBy('deadline') // Trier par ordre croissant
        ->first();
    }
    //
    public function updateCommandeStatusByUuid($uuid,$status): int
    {
        $idStatus = Status::getIdByName($status);
        return DB::table($this->table)
            ->where('uuid', $uuid)
            ->update(['updated_at'=>date_create(),'status_id'=>$idStatus]);
    }
    //
    public function updateCommande($uuid,array $data): int
    {
        if (isset($data["status"])){
            $idStatus = Status::getIdByName($data["status"]);
            $data["status_id"] = $idStatus;
            unset($data["status"]);
        }
        $data["updated_at"] = date_create();
        return DB::table($this->table)
            ->where('uuid', $uuid)
            ->update($data);
    }
    //
    public function getClientByCommandeUuid($uuid)
    {
        $idClient = DB::table($this->table)
            ->select('client_id')
            ->where('uuid', $uuid)
            ->first()?->client_id;
        return (new Client())->getClientById($idClient);
    }

    //
    public function getFinaleFileByUuid($uuid) {
        $commande_id = self::getIdByUuid($uuid);
        return DB::table('file_patch_of_commandes')
        ->select('path')
        ->where('commande_id','=', $commande_id)
        ->where('type', 1)
        ->first()?->path;
    }
    //
    public function getById($id){
        return self::where("id", $id)
        ->with([
            'client',
            'status',
            'service',
            'discipline',
            'redactor',
            'payments',
            'filesPath'
        ])
        ->first();
    }
    /*
     * Définition des relations entre les tables étrangère et la table commande avec le model éloquente
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    //
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    //
    public function service(): BelongsTo
    {
        return $this->belongsTo(TypeOfService::class, 'services_id');
    }
    //
    public function typeDocument(): BelongsTo
    {
        return $this->belongsTo(TypeDocument::class, 'type_document_id');
    }
    //
    public function discipline(): BelongsTo
    {
        return $this->belongsTo(Discipline::class, 'discipline_id');
    }
    //
    public function academicLevel(): BelongsTo
    {
        return $this->belongsTo(AcademicLevel::class, 'academic_level_id');
    }
    //
    public function redactor(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'redactor_id');
    }
    //
    public function payments():HasMany
    {
        return $this->hasMany(Payement::class, 'commande_id');
    }
    //
    public function filesPath(): HasMany
    {
        return $this->hasMany(FilePatchOfCommande::class, 'commande_id');
    }

}
