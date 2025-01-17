<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Payement extends Model
{
    use HasFactory;

    protected $table ='payements';
    /**
     * @param $payement
     * @return int
     * @throws \Exception
     */
    public function addNew($payement): int
    {
        //$payement['reference'] = generateUniqueReference('PY_',15,$this->table,'reference',true);
        $payement['created_at'] = date_create();
        $payement['updated_at'] = date_create();
        return DB::table($this->table)->insertGetId($payement);
    }

    public function getAll()
    {
        return self::with(['commande.client', 'commande.status', 'status'])
            ->get();
    }
    public function getAllByIdCommande($idCmd)
    {
        return self::where('commande_id', $idCmd)
            ->with(['commande.client', 'commande.status', 'status']) // Charger les relations nécessaires
            ->get(); // Récupérer tous les résultats
    }
    //
    public function getById($id)
    {
        return self::where('id', $id)->first(); // Récupérer tous les résultats
    }
    //
    public function updatePayement(string $id,array $payementInfo)
    {
        return DB::table($this->table)
        ->where('id', $id)  // Trouver le client par son ID
        ->update($payementInfo);
    }

    /*
     * Relation avec les model eloquent
     */
    public function commande(): BelongsTo
    {
        return $this->belongsTo(Commande::class, 'commande_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class,'status_id');
    }
    public function baseDonnee()
    {
    return $this->belongsTo(BaseDonnee::class, 'base_id');
    }

    public function user()
    {
    return $this->belongsTo(User::class, 'user_id');
    }

}
