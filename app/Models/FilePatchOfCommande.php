<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FilePatchOfCommande extends Model
{
    use HasFactory;
    protected $table ='file_patch_of_commandes';

    /**
     * @throws \Exception
     */
    public  function addNew(array $fils): int
    {
        $fils['uuid'] = Str::uuid();
        $fils['reference'] = generateUniqueReference('FLC_',15,$this->table,'reference',true);
        $fils['created_at'] = date_create();
        $fils['updated_at'] = date_create();
        return DB::table($this->table)->insertGetId($fils);
    }

    public function getAllByIdCommande($commande_id) {
        return self::where('commande_id', $commande_id)->get();
    }
    //
    public function getFinalByIdCommande($commande_id) {
        return self::where('commande_id', $commande_id)->where('type',1)->first();
    }

    public function getJointByIdCommande($commande_id) {
        return self::where('commande_id', $commande_id)->where('type',0)->get();
    }

    public function updateFile($id, array $values = []) {
        return self::where('id', $id)->update($values) > 0;
    }

    /*
     * Relation avec les model eloquent
     */
    public function commande(): BelongsTo
    {
        return $this->belongsTo(Commande::class, 'commande_id');
    }
}
