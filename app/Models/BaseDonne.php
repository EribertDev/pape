<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BaseDonne extends Model
{
    use HasFactory;

    protected $table = 'base_donnes';

    /**
     * @throws \Exception
     */
    public function addNew(array $bd){
        $bd['reference'] = generateUniqueReference('BD_',15,$this->table,'reference',true);
        $bd['uuid'] = Str::uuid();
        $bd['status_id'] =Status::getIdByName('Actif');
        $bd['created_at'] = date_create();
        $bd['updated_at'] = date_create();
        return DB::table($this->table)->insertGetId($bd);
    }
    //
    public function getAll(): \Illuminate\Database\Eloquent\Collection|array
    {
        return self::with('status')->whereHas('status', function($query){
            $query->where('name', '!=', 'Supprimé');
        })->get();
    }
    //
 /*   public function getByMarge(int $marge, array $field)
    {
        return self::select($field)
            ->with('status')
            ->whereHas('status', function($query) {
                $query->where('name', '!=', 'Supprimé');
            })
            ->take($marge)
            ->get();
    }*/
    //
    public function getAllAndPaginate($pagine): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return self::with('status')->whereHas('status', function($query){
            $query->where('name', '!=', 'Supprimé');
        })->paginate($pagine);
    }
    //
    public function getByUuid($uuid)
    {
        return self::with('status')
            ->where('uuid', $uuid)
            ->whereHas('status', function($query){
                $query->where('name', '!=', 'Supprimé');
            })->first();
    }

    public function getByUuidOfClient($uuid)
    {
        return self::select('uuid','name','description','amount')->with('status')
            ->where('uuid', $uuid)
            ->whereHas('status', function($query){
                $query->where('name', '!=', 'Supprimé');
            })->first();
    }


    public function updateByUuid($uuid, array $values = []): bool
    {
        return self::where('uuid', $uuid)->update($values) > 0;
    }

    //relations
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
